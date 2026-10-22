<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Itemtype extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Itemtype_model', 'itemtype');
    }

    public function listall() {
        $data['title'] = 'Item Type Master';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('itemtype/listall', $data);
    }
	
	public function delete($id){
		$qry ="delete from itemtypevalue where id=".$id;
		$this->db->query($qry);
	}

   

    public function create($id = 0) {
		$qry = "select * from itemtypemaster where id =".$id;
		$data['details'] = $this->db->query($qry)->row_array();
        $this->load->view('_blocks/subpages/create');
		$this->load->view('_blocks/subpages/list');
        $data['title'] = 'Item Type Master';
        $data['id'] = $id;
        $data['settings'] = $this->itemtype->getCompanySettings();
        $this->load->view('itemtype/create', $data);
    }

    public function kit_items($id) {
        return $this->kit->kit_items($id);
    }

    public function get_kit_items($id) {
        return $this->kit->get_kit_items($id);
    }

    public function kitgroup($customer_id = 0) {
        $search = strtolower($_GET['term']);
        return $this->kit->kitgroup($search, $note_id);
    }
	
	public function editrow(){
		return $this->itemtype->editrow();
	}
	
	public function item_list() {
        $this->itemtype->where_item();
        $list = $this->itemtype->get_datatables();
        $type = 'create';
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->description;
            $act = '<a  href="#" onclick="editrow('.$item->id.')" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . ' <a tp="confirm" base="' . base_url() . '/Itemtype/create/' . $item->itemtypeid . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'Itemtype/delete/'  .$item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemtype->count_all(),
            "recordsFiltered" => $this->itemtype->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->itemtype->where();
        $list = $this->itemtype->get_datatables();
        $type = 'create';
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->description;
            $act = '<a  href="' . base_url() . 'Itemtype/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemtype->count_all(),
            "recordsFiltered" => $this->itemtype->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	public function save_Itemtype(){
		$id = $this->itemtype->save_Itemtype();
		$response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}

    public function save() {
        $id = $this->itemtype->save();
        print_r($id);
    }

}
