<?php

class Roombooking_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,b.name';
        $this->table = 'hotel_booking as a inner join suppliers as b on a.customer_id=b.id';
        $this->column_order = array(null, 'booking_date'); //set column field database for datatable orderable
        $this->column_search = array('booking_date'); //set column field database for datatable searchable 
        $this->order = array('customer_id' => 'desc'); // default order 
    }

    public function where() {
        $this->wherecondition = " where booking_status='" . $this->input->post('status') . "'";
    }

    function getsing($id) {
        $qry = 'select a.*,b.name as customer_name,b.address_line1,b.phone from hotel_booking as a inner join suppliers as b on a.customer_id=b.id where a.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function book_details($id) {
        $qry = "select a.*,b.room_name from hotel_booking_details as a  inner join hotel_room as b on b.id=a.room_id where a.published='yes' and  a.book_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function delete($id) {
        $qry = 'delete from  hotel_booking where customer_id =' . $id;
        $this->db->query($qry);
    }

    function getrooms($search) {
        $start_date = ($_GET['Start_Date']);
        $end_date = ($_GET['End_date']);
        $floor = $_GET['room_floor'];
        $type = $_GET['room_roomtype'];
        $in = "";
        if ($floor) {
            $in = " and b.flr_id=" . $floor;
        }
        if ($type) {
            $in = $in . " and c.room_type=" . $type;
        }
        $qry = "SELECT a.id as roomid,a.room_name as label,a.*,e.room_id,c.* FROM `hotel_room` as a INNER join hotel_floor as b on a.flr_id=b.flr_id LEFT JOIN hotel_room_rate as c on c.room_id=a.id LEFT join (SELECT GROUP_CONCAT(d.room_id) as rooms,d.room_id FROM `hotel_booking` as d where bok_start_date NOT BETWEEN '" . $this->getDate($start_date) . "' AND '" . $this->getDate($end_date) . "' and bok_end_date NOT BETWEEN '" . $start_date . "' AND '" . $end_date . "'  GROUP by d.room_id) as e on e.room_id=a.id WHERE room_name like'%" . $search . "%'  and e.room_id is null " . $in . " Group by a.id ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function itemuploads($file, $fileid) {
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '1024'; //1 MB
        $this->load->library('upload', $config);
        $this->upload->do_upload($fileid);
        return;
    }

    function save($image = "", $id_proof = "") {
        $status = $this->input->post('book_status');
        $customer_phone = $this->input->post('phone');
        $insert_id = $this->input->post('book_id');
        $bok_id = $insert_id;
        if ($this->input->post('customer_id')) {
            $customer_id = $this->input->post('customer_id');
        } else {
            $customer_name = $this->input->post('customer');
            $customer_address = $this->input->post('address');
            $customer_phone = $this->input->post('phone');
            $data = array(
                'name' => $customer_name,
                'address_line1' => $customer_address,
                'phone' => $customer_phone
            );
            $this->db->insert('suppliers', $data);
            $customer_id = $this->db->insert_id();
            $ledger_data = array(
                "name" => $customer_name,
                "code" => $customer_phone,
                "ref_id" => $customer_id,
                "ref_code" => 'cus',
                "is_default" => true,
                "acc_main_id" => 25,
                "openning_bal" => 0.00,
                "published" => 'yes'
            );

            $this->db->insert('acc_ledgers', $ledger_data);
            $ledgers_code = $this->db->insert_id();
            $this->ledgers_code(1, $ledgers_code);
        }
        $start_date = $this->getDate($this->input->post('start_date'));
        $end_date = $this->getDate($this->input->post('end_date'));
        $total = $this->input->post('total');
        $advance = $this->input->post('advance');
        $contact = $customer_phone;
        $booking_tax = $this->input->post('total_tax');
        $total_amount = $this->input->post('total_amount');
        if ($this->input->post('contact')) {
            $contact = $this->input->post('contact');
        }
        $data = array(
            'customer_id' => $customer_id,
            'booking_phone' => $contact,
            'booking_amount' => $total_amount,
            'booking_tax' => $booking_tax,
            'booking_advance' => $advance
        );
        if ($status == 'check') {
            $data['booking_status'] = 'Checkin';
            $data['checkin_date'] = $start_date;
            $data['bok_end_date'] = $end_date;
        }
        if ($status == 'booking') {
            $data['booking_status'] = 'Created';
            $data['bok_start_date'] = $start_date;
            $data['bok_end_date'] = $end_date;
        }
        if ($status == 'Checkin') {
            $data['booking_status'] = 'Checkin';
            $data['checkin_date'] = $start_date;
            $data['checkout_date'] = $end_date;
        }
        if ($image) {
            $data['image'] = $image;
        }
        if ($id_proof) {
            $data['id_proof'] = $id_proof;
        }
        if ($insert_id == '0') {
            $this->db->insert('hotel_booking', $data);
            $bok_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $bok_id);
            $this->db->update('hotel_booking', $data);
            $qry = "update hotel_booking_details set published='no' where book_id=" . $bok_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='hotel_booking' and tb_id =" . $bok_id;
            $this->db->query($qry);
        }
        $bok_floor_id = $this->input->post('bok_floor_id', true);
        $bok_type_id = $this->input->post('bok_type_id', true);
        $bok_room_id = $this->input->post('bok_room_id', true);
        $bok_tax_id = $this->input->post('bok_tax_id', true);
        $bok_extra_beds = $this->input->post('bok_extra_beds', true);
        $bok_rate = $this->input->post('bok_rate', true);
        $bok_single_bed_rate = $this->input->post('bok_single_bed_rate', true);
        $bok_total_bed_rate = $this->input->post('bok_total_bed_rate', true);
        $bok_rowtax = $this->input->post('bok_rowtax', true);
        $bok_row_total = $this->input->post('bok_row_total', true);
        if ($this->input->post('bok_floor_id', true)) {
            $length = sizeof($bok_floor_id);
            for ($i = 0; $i < $length; $i++) {
                $data = array(
                    'book_id' => $bok_id,
                    'floor_id' => $bok_floor_id[$i],
                    'room_type_id' => $bok_type_id[$i],
                    'room_id' => $bok_room_id[$i],
                    'tax_id' => $bok_tax_id[$i],
                    'extra_beds' => $bok_extra_beds[$i],
                    'room_rate' => $bok_rate[$i],
                    'extra_bed_rate' => $bok_single_bed_rate[$i],
                    'total_extra_bed_rate' => $bok_total_bed_rate[$i],
                    'tax' => $bok_rowtax[$i],
                    'total' => $bok_row_total[$i],
                    'published' => 'yes'
                );
                $this->tax_add($data['tax_id'], $data['total'], $data['tax'], $data['total'] - $data['tax']);

                $this->db->insert('hotel_booking_details', $data);
            }
        }
        $or_type = 'Booking';
        $this->trans_save($bok_id, $bok_id, 'hotel_booking', $or_type, $this->sales, $this->cashaccount, $start_date, '0.00', $advance, 'booking', 1, 1, 1);
        $res = $this->getLedgers($customer_id, '', ' in ("cus","sup")');
        $toid = $res['id'];
        $this->trans_save($bok_id, $insert_id, 'hotel_booking', $or_type, $this->sales, $res['id'], $start_date, '0.00', $total_amount - $advance, 'booking', 1, 1, 1);
        $this->tax_save($bok_id, $bok_id, $or_type, $toid, $start_date, 'booking', 'hotel_booking', 1, 1, 1, 0);

        $response = array(
            'msg' => true,
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
