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
class Questioner_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'b.name as part,a.question_id as id,question';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'cli_questions as a inner join cli_parts as b on b.id=a.que_part_id ';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'a.question', 'b.name'); //set column field database for datatable orderable   
        $this->column_search = array('a.question', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('a.question_id' => 'desc'); // default order 
    }

    function where() {
        //$this->wherecondition = "where a.item_type_id = '" . $this->input->post('sale_type') . "'";
        $this->wherecondition = "";
        if ($this->input->post('bodypart')) {
            $this->wherecondition = $this->wherecondition . 'where a.que_part_id=' . $this->input->post('bodypart');
        }
    }


    function getquestion($id) {
        $qry = "select question,que_part_id,symptom,c.id as sid from cli_questions as a inner join cli_answers as b on a.question_id=b.question_id inner join cli_symptoms as c on c.id=b.ans_symptom_id where a.question_id=".$id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function save(){
        $question =  $this->input->post('questione');
        $answer   =  $this->input->post('answerid', TRUE);
        $part     =  $this->input->post('bodypart');
        $id       =  $this->input->post('id');
        if($id==0){
            $qry = "insert into cli_questions (question,que_part_id) values ('".$question."','".$part."')";
             $this->db->query($qry);
            $insert_id = $this->db->insert_id();
        }
        else{
            $insert_id = $id;
            $qry = "update cli_questions set question = '".$question."' ,que_part_id ='".$part."' where question_id =".$id;
             $this->db->query($qry);
             $qry = "delete from cli_answers where question_id =".$id;
             $this->db->query($qry);
        }
        if ($this->input->post('answerid')) {
        $length = sizeof($answer);
        for ($i = 0; $i < $length; $i++) {
            $qry = "insert into cli_answers (question_id,ans_symptom_id) values ('".$insert_id."','".$answer[$i]."')";
            $this->db->query($qry);  
             }

        }
        return $insert_id;

    }

   

}
