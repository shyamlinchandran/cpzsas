<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Pricelist extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pricelist_model', 'Price');
    }

    public function listall() {
        $data['title'] = 'Price List';
        $data['field'] = 'Price List';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('pricelist/listall', $data);
    }

    public function itemsearch() {
		$search = strtolower($_GET['term']);
        return $this->Price->itemsearch($search);
	}
   

    public function create($id = 0) {
		$qry = "select * from price_list where id =".$id;
		$data['details'] = $this->db->query($qry)->row_array();
        $this->load->view('_blocks/subpages/create');
		$this->load->view('_blocks/subpages/list');
        $data['title'] = 'Price List';
        $data['Field'] = 'Kit Group*';
        $data['id'] = $id;
        $data['settings'] = $this->Price->getCompanySettings();
        $this->load->view('pricelist/create', $data);
    }

    public function kit_items($id) {
        return $this->kit->kit_items($id);
    }

    public function deleteitem(){
        $id = $this->input->post('id');
        $qry = 'update price_list_items set published = "no" where id = '.$id;
        $this->db->query($qry);
    }

    public function get_kit_items($id) {
        return $this->kit->get_kit_items($id);
    }

    public function kitgroup($customer_id = 0) {
        $search = strtolower($_GET['term']);
        return $this->kit->kitgroup($search, $note_id);
    }
	
    public function delete($id){
		$qry = 'delete from price_list where id = '.$id;
        $this->db->query($qry);
	}
	public function editrow(){
		return $this->Price->editrow();
	}
	
	public function item_list() {
        $this->Price->where_item();
        $list = $this->Price->get_datatables();
        $type = 'create';
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->sales_rate;
            $row[] = $item->price_discount;
            $row[] = $item->price_discount_amount;
            $row[] = $item->sales_rate - $item->price_discount_amount;
            $act = '<button  type="button" onclick="editrow('.$item->id.')" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button>';
            $act = $act .'<button  type="button" onclick="deleterow('.$item->id.')" title="Edit" data-toggle="tooltip" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Price->count_all(),
            "recordsFiltered" => $this->Price->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->Price->where();
        $list = $this->Price->get_datatables();
        $type = 'create';
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->price_list;
            $row[] = $item->note;
            $act = '<a  href="' . base_url() . 'pricelist/Pricelist/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'pricelist/Pricelist/listall"  success="Delete ' . $item->price_list . ' successfuly "  message="Do you want Delete ' . $item->price_list . '?"  href="' . base_url() . 'pricelist/Pricelist/delete/' . $item->id . ' " data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';

            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Price->count_all(),
            "recordsFiltered" => $this->Price->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $id = $this->Price->save();
        print_r($id);
    }

}
