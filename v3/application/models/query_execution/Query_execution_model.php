<?php
class Query_execution_model extends DataTable{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function list_db()
    {
       $this->select = "c.com_id as new_id,name,comkey,sdb_name";
       $this->table =  "company as c INNER join set_database as s on c.com_id = s.com_id";
       $this->column_search = array('name','sdb_name');
       //$this->column_order = array('name');
    }
    public function execute_query()
    {
        $text_qry = $this->input->post('new_textarea');
        $check_item = $this->input->post('check_item',true);
        $length = sizeof($check_item);
        for($i=0;$i<$length;$i++)
        {
            $com_id = $check_item[$i];
            $qry = "use cpzsas_main";
            $this->db->query($qry);
            $qry = "select * from company as c INNER join set_database as s on c.com_id = s.com_id  where c.com_id = " .$com_id;
           $result = $this->db->query($qry);
            if($result->num_rows() > 0)
            {
                $result = $result->row_array();
                $database = $result['sdb_name'];

                $execute = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$database."' ";
                if($this->db->query($execute)->num_rows() > 0)
                {
                    print_r($database);
                    $qry = "use ".$database." ";
                    $this->db->query($qry); 
                    $this->db->query($text_qry); 

                }
            }
        }
        $qry = "use cpzsas_main";
        $this->db->query($qry);
        
    }
}