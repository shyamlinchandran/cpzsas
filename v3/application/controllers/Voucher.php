<?php

class Voucher extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Voucher_model', 'voucher');
    }
    function create($id = 0, $view = '')
    {


        $settings = $this->voucher->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['ids'] = $id;
        $data['enq_id'] = 0;

        $data['title'] = 'Voucher';

        $data['eid'] = '';
        $data['usrtype'] = 'User Type';
        $data['compny'] = 'Company';
        $data['branch'] = 'Branch';
        $data['option'] = $view;
        $data['view'] = "create";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('voucher/create', $data);

    }

    function createpaymntvoucher($id = 0, $view = '')
    {

        $settings = $this->voucher->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['ids'] = $id;
        $data['enq_id'] = 0;

        $data['title'] = 'Voucher';

        $data['eid'] = '';
        $data['usrtype'] = 'User Type';
        $data['compny'] = 'Company';
        $data['branch'] = 'Branch';
        $data['option'] = $view;
        $data['view'] = "create";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('paymentvoucher/create', $data);

    }
    function viewpaymntvoucher($id = 0, $view = '')
    {
        $this->load->view('_blocks/subpages/create');

        $data['id'] = $id;
        $data['title'] = 'Voucher';
        $data['type'] = ' ';
        $data['eid'] = '';
        $data['option'] = $view;
        $data['view'] = "view";
        $this->load->view('paymentvoucher/create', $data);

    }
    public function view($id = 0, $view = '')
    {
        $this->load->view('_blocks/subpages/create');

        $data['id'] = $id;
        $data['title'] = 'Voucher';
        $data['type'] = ' ';
        $data['eid'] = '';
        $data['option'] = $view;
        $data['view'] = "view";
        $this->load->view('voucher/create', $data);
    }

    public function getledger($acc_main_id)
    {
        return $this->voucher->getledger($acc_main_id);
    }
    public function getuser()
    {
        return $this->voucher->getuser();
    }
    public function getsalesman()
    {
        return $this->voucher->getsalesman();
    }

    public function save()
    {
        return $this->voucher->save();
    }

    public function savevoucher(){
        return $this->voucher->savevoucher();
    }
    public function listall()
    {
        $data['title'] = 'Voucher';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'usr';
        $this->load->view('voucher/listall', $data);
    }
    public function list_all()
    {
        $data['title'] = 'Quick Payment Voucher';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'usr';
        $this->load->view('paymentvoucher/listall', $data);
    }
   
    public function  listvouchers($ls = 0)
    {
        $list = $this->voucher->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->voucherno;
            $row[] = ucfirst($item->date);
            $row[] = $item->salesman;
            $row[] = $item->user;

            $act = '<a id = "edittor"  href="' . base_url() . 'Voucher/createpaymntvoucher/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
            <a  class="btn btn-info "  href="' . base_url() . 'Voucher/viewpaymntvoucher/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'Voucher/list_all' . '"  success="Delete ' . $item->salesman . ' successfuly "  message="Do you want Delete ' . $item->user . '?"  href="' . base_url() . 'Voucher/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';


            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->voucher->count_all(),
            "recordsFiltered" => $this->voucher->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list($ls = 0)
    {
        $list = $this->voucher->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->voucherno;
            $row[] = ucfirst($item->date);
			
            $row[] = $item->salesman;
            $row[] = $item->user;


            $act = '<a id = "edittor"  href="' . base_url() . 'Voucher/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
            <a  class="btn btn-info "  href="' . base_url() . 'Voucher/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'Voucher/listall' . '"  success="Delete ' . $item->salesman . ' successfuly "  message="Do you want Delete ' . $item->user . '?"  href="' . base_url() . 'Voucher/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';


            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->voucher->count_all(),
            "recordsFiltered" => $this->voucher->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getdetails($id)
    {
        return $this->voucher->getdetails($id);
    }

    public function getvoucheritems($id)
    {
        return $this->voucher->getvoucheritems($id);
    }

    public function delete($id)
    {
        return $this->voucher->delete($id);
    }

    public function getledgername($id)
    {
        return $this->voucher->getledgername($id);
    }

}
?>