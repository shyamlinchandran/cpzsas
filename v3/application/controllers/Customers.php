<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Customers extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('customers_model', 'item');
        $this->load->library('excel'); //load PHPExcel library 
        $this->load->model('excel_data_insert_model', 'itemexcel');
    }
	
	 function check_gst() {
        $this->item->check_gst();
    }


    public function profile($id) {
        $data['title'] = 'customers';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $date = date("d/m/Y");
        $data['type'] = 'cus';
        $data['stype'] = 'sales';
        $data['vtype'] = '';
		$qry = "select sum(total) as total from sales where customer_id= ".$id;
		$result = $this->db->query($qry)->row_array();
		$data['totalsalesamount'] = $result['total'];
        $ldg_id =  $this->item->getledgerid($id);
        $data['toid'] = $ldg_id;
        $data['settings'] = $this->item->getCompanySettings();
        $data['sales'] = $this->item->getsales('sales', $id);
        $data['estimate'] = $this->item->getsales('estimate', $id);
        $data['salesreturn'] = $this->item->getsales('sales_return', $id);
        $data['ledgbal'] = $this->item->getLedegerbalance($date, $ldg_id, 'cl', $ls = 0);
        $data['openbal'] = $this->item->getLedegerbalance('', $ldg_id, 'op', $ls = 0);
        $data['vouchers'] = $this->item->getvouchers($id);
        $data['id'] = $id;
        $this->load->view('customers/profile', $data);
    }

    public function listall() {
        $data['title'] = 'customers';
        $data['settings'] = $this->item->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'cus';
        $this->load->view('customers/list_all', $data);
    }

    function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['settings'] = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'customer create';
        $data['type'] = 'cus';
        $data['view'] = "create";
        $this->load->view('customers/create', $data);
    }

    public function getstatecode($id) {
        return $this->item->getstatecode($id);
    }

    public function price_list() {
        return $this->item->price_list();
    }

    function getsing($id) {
        $this->item->getsing($id);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['settings'] = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'customer edit';
        $data['type'] = 'cus';
        $data['view'] = "edit";

        $this->load->view('customers/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['settings'] = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'customer view';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('customers/create', $data);
    }

    public function delete($id) {
        $this->item->delete($id);
    }

    public function ajax_list() {
        $settings = $this->item->getCompanySettings();
        $this->item->where();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            if ($this->language != 'en') {

                if ($item->name_lan == '') {
                    $row[] = $item->name;
                } else {
                    $row[] = $item->name_lan;
                }
            } else {
                $row[] = $item->name;
            }

            $row[] = $item->tin;
            $row[] = $item->phone;
            $row[] = $item->email;
            $row[] = $item->address_line1;
            $row[] = $item->area;
            $customer_branch = 0 ;
            if(isset( $settings[0]['customer_branch']) ){
                $row[] = $item->brc_name;
            }
            $act = '<a  href="' . base_url() . 'customers/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'customers/profile/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/customers/listall' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'customers/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            //$act = $act . '<iframe style="display:none" tp="pdf" target="_blank" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data='.$item->id.'">';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $this->item->save();
    }

}
