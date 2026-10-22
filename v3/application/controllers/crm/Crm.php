<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CRM controller
 *
 * @author S
 */
class Crm extends MY_Controller {

    public function __construct() {
         parent::__construct();
        $this->load->helper('url');
        $this->load->model('crm_model', 'crm');
    }

    /*
     * constructor
     * 
     * 
     */

   public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm/enquiry');
    }
    function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        //$location = $this->crm->location();
        $source = $this->crm->enquiry();
        $btype = $this->crm->business();
        $product = $this->crm->product();
        $data['enquiry'] = $source;
        $data['btype'] = $btype;
        $data['product'] = $product;
        //$isbatch = $this->getKey('isbatch');
        $data['id'] = $id;
        $data['view'] = 'create';
        $this->load->view('crm/create', $data);
    }

     function edit($id) {
        $this->load->view('_blocks/subpages/create');
        //$isbatch = $this->getKey('isbatch');
        $source = $this->crm->enquiry();
        $btype = $this->crm->business();
        $product = $this->crm->product();
        $data['enquiry'] = $source;
        $data['btype'] = $btype;
        $data['product'] = $product;
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('crm/create', $data);
    }


    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $source = $this->crm->enquiry();
        $btype = $this->crm->business();
        $product = $this->crm->product();
        $data['enquiry'] = $source;
        $data['btype'] = $btype;
        $data['product'] = $product;
        //$isbatch = $this->getKey('isbatch');
        // $data['type'] = $type;
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('crm/create', $data);
    }



     public function customers() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            //$crud->where('type', 'cus');
            $crud->set_table('crm_customers');
            $crud->set_subject('Customers');
            $crud->required_fields('name', 'phone', 'address');
            $crud->columns('name', 'phone', 'email', 'address');
            $crud->unique_fields('email', 'phone');
            //$crud->display_as('gst', 'State Code');
            $crud->set_rules('email', 'Email', 'trim|valid_email');
            $crud->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            // $crud->callback_after_insert(array($this, 'create_ledger'));
            $crud->set_relation('district', 'crm_district', 'name');
            
            $output = $crud->render();
            $this->load->view('crm/customers', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


    function customer($id) {
       return $this->crm->customer($id);
    }


     public function crm_customer() {
        $search = strtolower($_GET['term']);
        return $this->crm->crm_customer($search);
    }


    public function district_master() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('crm_district');
            $crud->set_subject('District Master');
            $crud->unique_fields('name');
            $crud->required_fields('name');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $crud->field_type('published', 'hidden', 'yes');
            $output = $crud->render();
            $this->load->view('crm/customers', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }



    public function product_master() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('crm_product');
            $crud->set_subject('Products Master');
            $crud->unique_fields('name');
            $crud->required_fields('name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $output = $crud->render();
            $this->load->view('crm/customers', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function status_master() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('crm_enq_status');
            $crud->set_subject('Status Master');
            $crud->unique_fields('status');
            $crud->columns('status','is_closed');
            $crud->required_fields('status');
            $output = $crud->render();
            $this->load->view('crm/customers', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


    public function enquiry_source() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('crm_enq_src');
            $crud->set_subject('Source of enquiry');
            $crud->unique_fields('name');
            $crud->required_fields('name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $output = $crud->render();
            $this->load->view('crm/customers', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


    public function business_nature() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('crm_busn_ntr');
            $crud->set_subject('Nature of business');
            $crud->unique_fields('name');
            $crud->required_fields('name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $output = $crud->render();
            $this->load->view('crm/customers', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    


    public function ajax_list() {
        //$this->item->where();

        $list = $this->crm->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->date;
            $row[] = $item->company;
            $row[] = $item->location;
            $row[] = $item->contact;
            $row[] = $item->phone;
            $row[] = $item->email;
            $row[] = $item->remarks;
             /*$row[] = $item->enq_source;
            $row[] = $item->business_nature;
            $row[] = $item->product;
            $row[] = $item->follow_date;
            $row[] = $item->in_time;
            $row[] = $item->out_time;*/


            $act = '<a  href="' . base_url() . 'crm/crm/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'crm/crm/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->crm->count_all(),
            "recordsFiltered" => $this->crm->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function getsing($id) {
        $this->crm->getsing($id);
    }

    function save() {
        $this->crm->save();
    }
}