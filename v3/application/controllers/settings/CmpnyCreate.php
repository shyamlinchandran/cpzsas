<?php


class CmpnyCreate extends MY_Controller {
 

    public function __construct() {
        parent::__construct();
            $this->load->model('Company_model', 'Company');
    }
    function list_all() {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/list');
        
         $this->load->view('Company/company');
         
              
    }

    public function ajax_list() {
        $this->company->where();
        $list = $this->company->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $company) {
            $no++;

            $row = array();
            $row[] = $company->com_id;
            $row[] = $company->name;
            $row[] = $company->logo;
            $row[] = $company->header; 
            $row[] = $company->address;
             $row[] = $company->phone;
            $row[] = $company->tin;
            $row[] = $company->cst; 
            $row[] = $company->details;
              $row[] = $company->currency;
            $row[] = $company->currrncy_symbol;
            $row[] = $company->isdemo; 
            $row[] = $company->no_days;
            
          
       $act = '<a tp="pdf" href="' . base_url() . 'master/supplier/read/' . $supplier->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                    . ' <a href="' . base_url() . 'master/supplier/edit/' . $supplier->id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>'
                     . ' <a href="' . base_url() . 'master/supplier/delete/' . $supplier->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
       $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->supplier->count_all(),
            "recordsFiltered" => $this->supplier->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        
    }
     function delete($id) {
         
        $this->supplier->delete($id);
    }
}
