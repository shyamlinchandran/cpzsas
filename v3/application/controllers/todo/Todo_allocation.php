<?php

class Todo_allocation extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('todo/Todoallocation_model', 'Todo_allocation');
    }

/*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

    public function list_all()
    {
        $data['settings'] = $this->Todo_allocation->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $data['id'] = 0;
        $data['option'] = 'create';
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_allocation/list', $data);
    }

    /**
     * *******************************************************************************************************
     * 
     * create : For create an enquiry
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function create($id = 0, $opt = "create")
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $data['logged'] = $userid;
        $data['option'] = $opt;
        $data['settings'] = $this->Todo_allocation->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_allocation/create', $data);
    }

    public function getdata($id)
    {
        $this->Todo_allocation->getdata($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * view : For view a particular enquiry
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function view($id)
    {
        $data['settings'] = $this->Todo_allocation->getCompanySettings();
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_allocation/create', $data);
    }

    /**
     * *******************************************************************************************************
     * 
     * getsing : **
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */


    public function getsing($id)
    {
        $this->Todo_allocation->getsing($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * save : save the enquiry into dattabase
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function save()
    {
        return $this->Todo_allocation->save();
    }

    public function getStatus(){
        return $this->Todo_allocation->getStatus();
    }
    /**
     * *******************************************************************************************************
     * 
     * save : save the enquiry into dattabase
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function getcompanydet($master)
    {
        $search = strtolower($_GET['term']);
        return $this->Todo_allocation->getcompanydet($master, $search);
    }

    /**
     * *******************************************************************************************************
     * 
     * save_allocation : save allocation from admin
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */


    public function save_todo_allocation()
    {

        $idsss = $this->input->post('isbulk');

        if ($idsss > 0) {
            $this->Todo_allocation->save_bulkallocation();
        } else {
            $this->Todo_allocation->save_todo_allocation();
        }
    }

    /**
     * *******************************************************************************************************
     * 
     * save_followup : save followups
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */


    public function save_followup()
    {
        $this->Todo_allocation->save_followup();
    }

    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */


    public function getItems($id = 0)
    {
        $this->Todo_allocation->getItems($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */


    public function getAllItems($type = 0) 
    {
        $this->Todo_allocation->getAllItems($type);
    }

    

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function getItemTypes()
    {
        return $this->Todo_allocation->getItemTypes();
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function save_closure()
    {
        $this->Todo_allocation->save_closure();
    }

    /**
     * *******************************************************************************************************
     * 
     * varify function for varify the enquiry 
     * 
     * @author Althaf
     * @created on : 29-10-2019
     * 
     **********************************************************************************************************
     */

    public function varify()
    {
        $this->Todo_allocation->varify();
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function save_product()
    {
        $this->enquiry_product->save_product();
    }

    public function completion()
    {
        $this->Todo_allocation->completion();
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function user()
    {
        $this->Todo_allocation->user();
    }

    public function company()
    {
        $search = strtolower($_GET['term']);
        return $this->Todo_allocation->company($search);
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function getfollowups($id)
    {
        $data['settings'] = $this->Todo_allocation->getCompanySettings();
        $date = date('Y-m-d');
        $data['id'] = $id;
        $data['datenow'] = $date;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_allocation/list', $data);
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function product()
    {
        $search = strtolower($_GET['term']);
        return $this->Todo_register->product($search);
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    function otheritem($id)
    {
        $this->Todo_allocation->otheritem($id);
    }

    function delete($id)
    {
        $this->Todo_allocation->delete($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * ajaxlist list all values into the table 
     * 
     * @author Althaf
     * @created on : 29-10-2019
     * 
     **********************************************************************************************************
     */

    public function ajax_list()
    {

        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $act = "";

        $list = $this->Todo_allocation->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $id = $this->input->post('allocate_id');
        foreach ($list as $items) {
            $no++;
            $row = array();
            // check boxes
            $row[] = '<input class="enquiry" type="checkbox" name="check[]" value="' . $items->id . '"> &nbsp;' . $no;
            $dates = substr($items->date, 0, 10);
            $row[] = $dates;
            $row[] = $items->task;
            $row[] = $items->stats;
            $row[] = $items->usss;
            if ($items->state != 0) {
                $row[] = $items->toname;
            } else {
                $row[] = 'Nil';
            }

                //edit
                $act = ' <a  back="' . base_url() . 'todo/Todo_allocation/list_all"  data-toggle="modal" data-target="#myTodoModal" title="edit" id ="' .$items->id. '"  class="btn btn-success editmod"><span class="glyphicon glyphicon-edit"></span></a>';
        
                    //delete
                $act .= ' <a tp="confirm" base="' . base_url() . 'todo/Todo_allocation/list_all' . '"  success="Delete ' . $items->task . ' successfuly "  message="Do you want to Delete ' . $items->task . '?"  href="' . base_url() . 'todo/Todo_allocation/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
      
                //view
                $act .= '  <a  back="' . base_url() . 'todo/Todo_allocation/list_all"  data-toggle="modal" data-target="#myTodoModal" title="edit" id ="' .$items->id. '"  class="btn btn-success viewmod"><span class="glyphicon glyphicon-eye-open"></span></a>';
                
                //completion
                if($items->state == 3){
                    $act .= ' <a  back="' . base_url() . 'todo/Todo_allocation/list_all"  data-toggle="modal" data-target="#myFollowupModal" title="edit" id ="' .$items->id. '"  class="btn btn-success followup">Complete Task</a>';
                }
              
         
            

            


            $row[] = $act;
            $data[] = $row;
            }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Todo_allocation->count_all(),
            "recordsFiltered" => $this->Todo_allocation->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


}
