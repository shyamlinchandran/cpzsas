<?php

class Holidays_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,DATE_FORMAT(start_date, "%d/%m/%Y") as start,DATE_FORMAT(start_date, "%d/%m/%Y") as end';
        $this->table = 'hr_holidays as a ';
        $this->column_order = array(null, 'holi_name'); //set column field database for datatable orderable
        $this->column_search = array('holi_name'); //set column field database for datatable searchable 
        $this->order = array('holi_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_holidays where holi_id=' .$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_holidays where holi_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $holi_name = $this->input->post('holi_name');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $holi_id = $this->input->post('holi_id');
        $data = array(
            'holi_name' => $holi_name,
            'start_date' => $this->getDate($start_date),
            'end_date' => $this->getDate($end_date)
        );
        if ($holi_id == '0') {
            $this->db->insert('hr_holidays', $data);
        } else {
            $this->db->where('holi_id', $holi_id);
            $this->db->update('hr_holidays', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
