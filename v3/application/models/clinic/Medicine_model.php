<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Medicine_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'b.name as part,a.id as id,a.name,bok_name';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'cli_medicines as a inner join cli_parts as b on b.id=a.part_id inner join cli_book as c on c.id=a.book_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'a.name', 'bok_name'); //set column field database for datatable orderable   
        $this->column_search = array('a.name', 'bok_name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
        //$this->wherecondition = "where a.item_type_id = '" . $this->input->post('sale_type') . "'";
        $this->wherecondition = "";
        if ($this->input->post('bodypart')) {
            $this->wherecondition = $this->wherecondition . 'where a.part_id=' . $this->input->post('bodypart');
        }
    }

    function Medicine($id) {
        $qry = "select a.details,a.id as med_id,a.book_id,a.part_id,b.symptom_id,c.symptom from cli_medicines as a left join cli_medicine_symptoms as b on a.id=b.med_id left join  cli_symptoms as c on c.id=b.symptom_id where b.published='yes' and a.id=" . $id;
        $result = $this->db->query($qry);
//        print_r($qry);
        echo json_encode($result->result_array());
    }

    function book() {
        $qry = "select a.* from cli_book as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '"><b>' . $row["bok_name"] . '</b></option>';
        }
        print_r($option);
    }



    function save() {
        $textarea = $this->input->post('textsummer');
        $book_id = $this->input->post('book');
        $bodypart_id = $this->input->post('bodypart');
        $symptom = $this->input->post('answerid', TRUE);
        $id = $this->input->post('id');
        $data = array(
            'details' => $textarea,
            'part_id' => $bodypart_id,
            'book_id' => $book_id,
        );
        if ($id == 0) {
            $this->db->insert('cli_medicines', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('cli_medicines', $data);
            $insert_id = $id;
            $qry = "update  cli_medicine_symptoms set published ='no' where med_id =" . $id;
            $this->db->query($qry);
            $qry = "update  cli_medicine_image set published ='no' where med_id =" . $id;
            $this->db->query($qry);
            $qry = "update  cli_medicine_parts set published ='no' where med_id =" . $id;
            $this->db->query($qry);
        }
        $length = sizeof($symptom);
        for ($i = 0; $i < $length; $i++) {
            $qry = "insert into cli_medicine_symptoms (med_id,symptom_id) values ('" . $insert_id . "','" . $symptom[$i] . "')";
            $this->db->query($qry);
        }
        return $insert_id;
    }

}
