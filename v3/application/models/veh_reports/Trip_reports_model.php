<?php

class Trip_reports_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.name,c.veh_number,d.pro_fname';
//        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = ' veh_trip as a inner join suppliers as b on b.id=a.trip_customer inner join veh_details as c on c.id=a.trip_vehicle inner join hr_profile as d on d.emp_id=a.trip_driver ';
//        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array('trip_startdate', 'trip_enddate', 'veh_number', 'pro_fname', 'name', 'trip_total'); //set column field database for datatable orderable  
        $this->column_search = array('a.trip_vehicle', 'a.trip_driver'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
        $startdate = $this->getDate($this->input->post('startdate'));
        $enddate = $this->getDate($this->input->post('enddate'));
        $this->wherecondition = ' where a.invoice_date>="' . $startdate . '"';
        $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $enddate . '"';
        if ($this->input->post('customer_id')) {
            $this->wherecondition = $this->wherecondition . ' and a.trip_customer ="' . $this->input->post('customer_id') . '"';
        }
        if ($this->input->post('vehicle_id')) {
            $this->wherecondition = $this->wherecondition . ' and a.trip_vehicle ="' . $this->input->post('vehicle_id') . '"';
        }
        if ($this->input->post('driver')) {
            $this->wherecondition = $this->wherecondition . ' and a.trip_driver ="' . $this->input->post('driver') . '"';
        }
// else {
//     
// }
    }

}
