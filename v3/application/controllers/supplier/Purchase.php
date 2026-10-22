<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchase
 *
 * @author u43255
 */
class Purchase extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('ledgers_model', 'ledgers');
        $this->load->model('purchase_model', 'purchase');
    }

    public function listall($type) {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/purchase/list_all', $data);
    }

    function create($type) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['view'] = 'create';
        $data['type'] = $type;
        $settings = $this->purchase->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('transaction/purchase/create', $data);
        
    }
     function delete($id) {
        $this->purchase->delete($id);
    }

 function cancel($id) {
        $this->purchase->cancel($id);
    }
    

    function edit($type,$id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'edit';
        $data['type'] = $type;
        $settings = $this->purchase->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('transaction/purchase/create', $data);
    }

    function view($type,$id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'view';
        $data['type'] = $type;
        $settings = $this->purchase->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('transaction/purchase/create', $data);
    }

    function pert($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'return';
        $this->load->view('transaction/purchase/create', $data);
    }

    public function ajax_list() {
        $max = $this->purchase->max();
        $max_id = $max['max_id'];
        $this->purchase->wheresupplier();
        $list = $this->purchase->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $purchase) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $purchase->invoice;
            $row[] = $purchase->date;
            $row[] = $purchase->name;
            $row[] = $purchase->total;
            $act = '<a  href="' . base_url() . 'transaction/purchase/edit/' . $purchase->ptype . '/' . $purchase->pid . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'transaction/purchase/view/'  . $purchase->ptype . '/' . $purchase->pid . '"  title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>
                   <a tp="pdf" class="btn btn-info "  href="' . base_url() . 'transaction/purchase/bill/' . $purchase->pid . '" title="Bill"  data-toggle="tooltip"><span class="glyphicon glyphicon-print"></span></i></a>';
            if ($purchase->pid == $max_id) {

                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/purchase/listall/' . $purchase->ptype . '"  success="Delete ' . $purchase->invoice . ' successfuly "  message="Do you want Delete ' . $purchase->invoice . '?"  href="' . base_url() . 'transaction/purchase/delete/' . $purchase->pid . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            }
            else{
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/purchase/listall/' . $purchase->ptype . '"   success="Cancelled ' . $purchase->invoice . ' successfuly "  message="Do you want Cancel ' . $purchase->invoice . '?"  href="' . base_url() . 'transaction/purchase/cancel/' . $purchase->pid  . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';           
            }
             if ($purchase->pub != 'yes') {
                $act = '<a tp="pdf" href="' . base_url() . 'transaction/purchase/bill/' . $purchase->pid . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                        . ' <a href="' . base_url() . 'transaction/purchase/view/purchase/' . $purchase->pid . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
                $act = $act . ' <span class="btn btn-warning">Cancelled<span>';
            }

            $row[]=$act;  
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->purchase->count_all(),
            "recordsFiltered" => $this->purchase->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

  

}
