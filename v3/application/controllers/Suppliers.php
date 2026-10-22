<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Suppliers extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('suppliers_model', 'item');
        $this->load->library('excel');//load PHPExcel library 
        $this->load->model('excel_data_insert_model','itemexcel');
    }
    public function listall($type) {
        $data['title'] = label('Suppliers', $this, $this->user);
        $data['settings'] = $this->item->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('suppliers/list_all',$data);
    }
    public function profile($id) {
        $data['title'] = 'suppliers';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $date = date("d/m/Y");
        $data['type'] = 'sup';
        $data['stype'] = 'sales';
        $data['vtype'] = '';
        $ldg_id =  $this->item->getledgerid($id);
        $data['toid'] = $ldg_id;
        $data['settings'] = $this->item->getCompanySettings();
        $data['purchase']=$this->item->getpurchase('',$id);
        $data['purchorder']=$this->item->getpurchase('estimate',$id);
        $data['purchreturn']=$this->item->getpurchase('sales_return',$id);
        $data['ledgbal'] = $this->item->getLedegerbalance($date, $ldg_id, 'cl', $ls = 0);
        $data['openbal'] = $this->item->getLedegerbalance('', $ldg_id, 'op', $ls = 0);
        $data['vouchers']=$this->item->getvouchers($id);
        $data['id'] = $id;
        $this->load->view('suppliers/profile',$data);
    }
    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $states = $this->item->states();
        $data['settings'] = $settings;
        $data['states'] = $states;
        $data['id'] = $id;
        $data['title'] = 'supplier create';
        $data['type'] = 'sup';
        $data['view'] = "create";
        
        $this->load->view('suppliers/create', $data);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $states = $this->item->states();
        $data['settings'] = $settings;
        $data['states'] = $states;
        $data['id'] = $id;
        $data['title'] = 'supplier edit';
        $data['type'] = 'sup';
        $data['view'] = "edit";
        
        $this->load->view('suppliers/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $states = $this->item->states();
        $data['settings'] = $settings;
        $data['states'] = $states;
        $data['id'] = $id;
        $data['title'] = 'supplier view';
        $data['type'] = 'sup';
        $data['view'] = "view";
        
        $this->load->view('suppliers/create', $data);
    }
    public function delete($id)
    {
      $this->item->delete($id);
    }
    public function ajax_list() {
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
            $row[] = $item->name;
            $row[] = $item->tin;
            $row[] = $item->phone;
            $row[] = $item->email;
            $row[] = $item->address_line1;
            $row[] = $item->area;
            $act = '<a  href="' . base_url() . 'suppliers/edit/'.$item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'suppliers/profile/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/suppliers/listall/sup'.'"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'suppliers/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
