<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Sales_vehicle extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sales_vehicle_model', 'vehicle');
//        $this->load->library('excel'); //load PHPExcel library 
//        $this->load->model('excel_data_insert_model', 'itemexcel');
    }

    public function getsing($id) {
        return $this->vehicle->getsing($id);
    }

    public function getinoviceno($type) {
        print_r($this->vehicle->getinoviceno($type));
    }

//    public function profile($id) {
//        $data['title'] = 'customers';
//        $this->load->view('_blocks/subpages/create');
//        $this->load->view('_blocks/subpages/list');
//        $date = date("d/m/Y");
//        $data['type'] = 'cus';
//        $data['stype'] = 'sales';
//        $data['vtype'] = '';
//        $ldg_id = $this->vehicle->getledgerid($id);
//        $data['toid'] = $ldg_id;
//        $data['settings'] = $this->vehicle->getCompanySettings();
//        $data['sales'] = $this->vehicle->getsales('sales', $id);
//        $data['estimate'] = $this->vehicle->getsales('estimate', $id);
//        $data['salesreturn'] = $this->vehicle->getsales('sales_return', $id);
//        $data['ledgbal'] = $this->vehicle->getLedegerbalance($date, $ldg_id, 'cl', $ls = 0);
//        $data['openbal'] = $this->vehicle->getLedegerbalance('', $ldg_id, 'op', $ls = 0);
//        $data['vouchers'] = $this->vehicle->getvouchers($id);
//        $data['id'] = $id;
//        $this->load->view('sales_vehicle/profile', $data);
//    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('sales_vehicle/listall');
    }

    function create($id = 0) {
        $data['id'] = $id;
        $data['view'] = 'add';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('sales_vehicle/create', $data);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->vehicle->getCompanySettings();
        $data['settings'] = $this->vehicle->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'Sales Vehicle edit';
        $data['view'] = "view";
        $data['type'] = 'cus';
        $this->load->view('sales_vehicle/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->vehicle->getCompanySettings();
        $data['settings'] = $this->vehicle->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'Sales Vehicle edit';
        $data['view'] = "edit";
        $data['type'] = 'cus';
        $this->load->view('sales_vehicle/create', $data);
    }
    public function delete($id) {
        $this->vehicle->delete($id);
    }

    public function ajax_list() {
        $list = $this->vehicle->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //print_r($itemcount);
            $row = array();
            $row[] = $no;
            $row[] = $item->invoice;
            $row[] = $item->trip_startdate;
            $row[] = $item->trip_enddate;
            $row[] = $item->veh_number;
            $row[] = $item->pro_fname;
            $row[] = $item->name;
            $row[] = $item->trip_total;

            $act = '<a  href="' . base_url() . 'sales_vehicle/Sales_vehicle/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'sales_vehicle/Sales_vehicle/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/sales_vehicle/Sales_vehicle/listall' . '"  success="Delete ' . $item->trip_vehicle . ' successfuly "  message="Do you want Delete ' . $item->trip_vehicle . '?"  href="' . base_url() . 'sales_vehicle/Sales_vehicle/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->vehicle->count_all(),
            "recordsFiltered" => $this->vehicle->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $this->vehicle->save();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function driver_lookup() {
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response  
        $query = $this->vehicle->driver_lookup($keyword); //Search DB  
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response  
            $data['message'] = $query; //Create array  
        }
        echo json_encode($data); //echo json string if ajax request  
    }

    public function vehicle_lookup() {
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response  
        $query = $this->vehicle->vehicle_lookup($keyword); //Search DB  
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response  
            $data['message'] = $query; //Create array  
        }
        echo json_encode($data); //echo json string if ajax request  
    }

    public function customer_lookup() {
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response  
        $query = $this->vehicle->customer_lookup($keyword); //Search DB  
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response  
            $data['message'] = $query; //Create array  
        }
        echo json_encode($data); //echo json string if ajax request  
    }

}
