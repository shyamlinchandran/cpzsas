<?php

class Sales_vehicle_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.name,c.veh_number,d.pro_fname';
//        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = ' veh_trip as a inner join suppliers as b on b.id=a.trip_customer inner join veh_details as c on c.id=a.trip_vehicle inner join hr_profile as d on d.emp_id=a.trip_driver ';
//        inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array('trip_startdate', 'trip_enddate', 'veh_number', 'pro_fname', 'name', 'trip_total'); //set column field database for datatable orderable   
        $this->column_search = array('a.trip_vehicle', 'a.trip_driver'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = "select a.*,b.id as customer_id,b.name as customer,c.id as vehicle_id,c.veh_number as vehicle FROM veh_trip as a left join suppliers as b on a.`trip_customer`=b.id INNER JOIN veh_details as c on c.id=a.trip_vehicle where a.id=" . $id;
        $result = $this->db->query($qry)->result_array();
        echo json_encode($result);
    }

    public function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.invoice,CONVERT(LEFT(string,length(string)-" . $suffix . "),UNSIGNED INTEGER) as top FROM veh_trip as a INNER join(select SUBSTRING(INVOICE," . $preffix . ") as string,id from veh_trip as b WHERE bill_type='" . $type . "') as c on c.id=a.id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['invoice']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];

            return $num;
        }
    }

    function save() {
        $btype = $this->input->post('btype');
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        if ($id == 0) {
            $invoice = $this->getinoviceno($btype);
        }
        $trip_from = $this->input->post('trip_from');
        $trip_to = $this->input->post('trip_to');
        $branch = $this->getbranch($btype);
        $invoice_date = $this->input->post('date');
        $pay_type = $this->input->post('pay_type');
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $startkm = $this->input->post('startkm');
        $endkm = $this->input->post('endkm');
        $vehicle = $this->input->post('vehicle_id');
        $driver = $this->input->post('driver');
        $fare = $this->input->post('fare');
        $tax = $this->input->post('tax');
        $description = $this->input->post('description');
        $othercharges = $this->input->post('othercharges');
        $totalkm = $this->input->post('totalkm');
        $customer = $this->input->post('customer_id');
        $total = $this->input->post('total');
        $Costcenter = $this->input->post('Costcenter');
        $trip_taxamt = $this->input->post('tax_amt');
        $data = array(
            'trip_taxamt' => $trip_taxamt,
            'branch' => $branch,
            'Costcenter' => $Costcenter,
            'invoice' => $invoice,
            'trip_from' => $trip_from,
            'trip_to' => $trip_to,
            'bill_type' => $btype,
            'invoice_date' => $this->getDate($invoice_date),
            'trip_startdate' => $this->getDate($startdate),
            'trip_enddate' => $this->getDate($enddate),
            'trip_startkm' => $startkm,
            'trip_endkm' => $endkm,
            'trip_vehicle' => $vehicle,
            'trip_driver' => $driver,
            'trip_fare' => $fare,
            'trip_tax' => $tax,
            'pay_type' => $pay_type,
            'trip_description' => $description,
            'trip_othercharges' => $othercharges,
            'trip_totalkm' => $totalkm,
            'trip_customer' => $customer,
            'trip_total' => $total,
        );

        if ($id == 0) {
            $this->db->insert('veh_trip', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('veh_trip', $data);
            $insert_id = $id;
            $qry = "update acc_ledger_trans set published ='no' where tb_name='veh_trip'  and tb_id=" . $id;
            $this->db->query($qry);
        }
        $toid = $this->cashaccount;
        if ($pay_type == "Credit") {
            $res = $this->getLedgers($customer, '', ' in ("cus","sup")');
            $toid = $res['id'];
        }
        $or_type = 'Trip';
        $this->trans_save($invoice, $insert_id, 'veh_trip', $or_type, $this->sales, $toid, $this->getDate($invoice_date), '0.00', $total, $description, 1, $Costcenter, $branch);
        $res = $this->getLedgersSing($tax, 'SaleTax');
        $this->trans_save($invoice, $insert_id, 'veh_trip', $or_type, $toid, $res, $this->getDate($invoice_date), $total - $tax, '0.00', $description, 1, $Costcenter, $branch);
        $res = $this->getLedgersSing($tax, 'Tax');
        $this->trans_save($invoice, $insert_id, 'veh_trip', $or_type, $toid, $res, $this->getDate($invoice_date), $tax, '0.00', $description, 1, $Costcenter, $branch);
    }

    function delete($id) {
        $qry = "delete from veh_trip where id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  veh_trip where  id =" . $id;
        $this->db->query($qry);
    }

    function driver_lookup($keyword) {
        $this->db->select('a.*,a.emp_id as id , a.pro_fname as label')->from('hr_profile as a ');
        $this->db->like('pro_fname', $keyword);
        $query = $this->db->get();
        return $query->result();
    }

    function vehicle_lookup($keyword) {
        $this->db->select('a.* , a.veh_number as label')->from('veh_details as a ');
        $this->db->like('veh_number', $keyword);
        $query = $this->db->get();
        return $query->result();
    }

    function customer_lookup($keyword) {
        $this->db->select('a.*,a.id as id , a.name as label')->from('suppliers as a ');
        $this->db->like('name', $keyword);
        $query = $this->db->get();
        return $query->result();
    }

}
