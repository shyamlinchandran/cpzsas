<?php

defined('BASEPATH') OR exit('No direct script access allowed');
    
class Schedule extends MY_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('education/Schedule_model', 'schedule');
    }
	
	
    public function listall() {
        $data['title'] = 'Schedule';
        $data['settings'] = $this->schedule->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('schedule/list_all', $data); 
    }
	
	public function getsing($id){
        $this->schedule->getsing($id);
	}

    public function save()
    {
        $this->schedule->save();
    }

    /*
     ***********************************************************************************************
     * 
     * feeStructure: for retrieving fee structure
     * 
     * @author Althaf
     * @created on: 14-10-2019
     * 
     * *******************************************************************************************
     */

	function delete($id){
		$qry = "delete from yoga_schedule where schedule_id = ".$id;
		$this->db->query($qry);
	}

    function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$data['classes'] = $this->schedule->getclasses();
		$data['times'] = $this->schedule->gettimes();
        $data['settings'] = $this->schedule->getCompanySettings();
        $data['id'] = $id;
        $this->load->view('schedule/create', $data);
    }

    function view($id = 0) {
         $this->load->view('_blocks/subpages/create');
		$data['classes'] = $this->schedule->getclasses();
		$data['times'] = $this->schedule->gettimes();
        $data['settings'] = $this->schedule->getCompanySettings();
        $data['id'] = $id;
        $this->load->view('schedule/view', $data);
    }


    public function ajax_list($ls = 0)
    {   
        $list = $this->schedule->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucfirst($item->schedule_name);
            $row[] = $item->start_date;
            $row[] = $item->end_date;
            $row[] = $item->description;

            
            $act = '<a id = "edittor"  href="' . base_url() . 'education/Schedule/create/' . $item->schedule_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'education/Schedule/view/' . $item->schedule_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            // if ($itemcount == 0) {
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/Schedule/listall' . '"  success="Delete ' . $item->schedule_name . ' successfuly "  message="Do you want Delete ' . $item->schedule_name . '?"  href="' . base_url() . 'education/Schedule/delete/' . $item->schedule_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            // }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->schedule->count_all(),
            "recordsFiltered" => $this->schedule->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

   
   
    

}