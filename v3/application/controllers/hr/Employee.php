<?php

class Employee extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Employee_model', 'Employee');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/employee/list');
    }

    function itemuploads($file, $type, $fileid) {
        $config['upload_path'] = 'uploads/images';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '6024'; //1 MB
        $this->load->library('upload', $config);
        $this->upload->do_upload($fileid);
    }

    public function savedocument() {
        if (isset($_FILES['document'])) {
            $file = $_FILES['document'];
            $type = 'image';
            //upload file  
            $fileid = 'document';

            $new_name = time() . str_replace(' ', '_', $_FILES['document']['name']);
            $_FILES['document']['name'] = $new_name;
            $imgname[0] = $new_name;
            $this->itemuploads($file, $type, $fileid);
            $fileid = 'document';
            print_r($new_name);
        } else {
            print_r('');
        }
    }

    public function saveprofile() {
        if (isset($_FILES['document'])) {
            $file = $_FILES['document'];
            $type = 'image';
            //upload file  
            $fileid = 'document';

            $new_name = time() . str_replace(' ', '_', $_FILES['document']['name']);
            $_FILES['document']['name'] = $new_name;
            $imgname[0] = $new_name;
            $this->itemuploads($file, $type, $fileid);
            $fileid = 'document';
            print_r($new_name);
        } else {
            print_r('');
        }
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/employee/create', $data);
    }

    public function education($id) {
        return $this->Employee->education($id);
    }

    public function getdocuments($id) {
        return $this->Employee->getdocuments($id);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/employee/create', $data);
    }

    public function getsing($id) {
        $this->Employee->getsing($id);
    }

    public function visadetails($id) {
        $this->Employee->visadetails($id);
    }

    public function jobdetails($id) {
        $this->Employee->jobdetails($id);
    }

    public function delete($id) {
        $this->Employee->delete($id);
    }

    public function save() {
        $insert_id = $this->Employee->save();
    }

    public function salary_list($id) {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/employee/salary_list', $data);
    }

    public function department() {
        return $this->Employee->department();
    }

    public function visa_type() {
        return $this->Employee->visa_type();
    }

      public function ledger_balance($id, $ls = 1) {
        $qry = "select * from acc_ledgers where ref_id=" . $id . "  and ref_code='employee'";
        $query = $this->db->query($qry)->row_array();
        $ledger = $query['id'];
        $amt = $this->Employee->getLedegerbalance(date('d/m/Y'), $ledger, 'cl', $ls);
        if($amt == 0){
            return 0;
        }else{
        if ($amt < 0) {
            return round(($amt * -1), 2) . ' Dr';
        } else {
            return $amt . ' Cr';
        }
        }
    }

    public function receipt($pay_id) {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->Employee->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->AddPage('P', 'A4');
        $Payment = $this->Employee->getpaymentDetails($pay_id);
        $ledger_balance = $this->ledger_balance($Payment['employee_id']);
        if ($ledger_balance == 0 || $ledger_balance == '0' || $ledger_balance == "") {
            $ledger_balance = 0.00;
        }
        $data['ledger_balance'] = $ledger_balance;
        $salary_components = $this->Employee->getDetails($Payment['distribution_id'], $Payment['employee_id']);
        $data['salary_components'] = $salary_components;
        $data['payment'] = $Payment;
        $data['company'] = $com;
        $html = $this->load->view('hr/employee/receipt', $data, true);
        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

    public function course() {
        return $this->Employee->course();
    }

    function set_bonus($emp_id) {
        $data['id'] = $emp_id;
        $data['leave_types'] = $this->Employee->leave_types();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/employee/bonus', $data);
    }

    public function doc_type() {
        return $this->Employee->doc_type();
    }

    function getemployee_leaves() {
        return $this->Employee->getemployee_leaves();
    }

    public function role() {
        return $this->Employee->role();
    }

    public function salary_ajax_list() {
        $this->Employee->where();
        $list = $this->Employee->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->pro_fname;
            $row[] = $items->year;
            $row[] = $items->monthname;
            $row[] = $items->date;
            $row[] = $items->emp_salary;
            $row[] = $items->employee_paid;

            $act = "";
            $act = ' <a tp="pdf" href="' . base_url() . 'hr/Employee/receipt/' . $items->pay_id . '" data-toggle="tooltip" title="Print Slip" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Employee->count_all(),
            "recordsFiltered" => $this->Employee->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Employee->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->pro_fname;
            $row[] = '<font style="' . $items->iqama . '" >' . $items->iqama_end_date . '</font >';
            $row[] = '<font style="' . $items->lice . '" >' . $items->licence_end_date . '</font >';
            $row[] = '<font style="' . $items->insu . '" >' . $items->insurence_end_date . '</font >';
            $row[] = $items->pro_mobile;
            $row[] = $items->iqama_no;

            $act = ' <a  back="' . base_url() . 'hr/employee/list_all"  href="' . base_url() . 'hr/employee/create/' . $items->empid . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . ' <a tp="confirm" base="' . base_url() . '/hr/employee/list_all' . '"  success="Delete ' . $items->pro_fname . ' successfuly "  message="Do you want Delete ' . $items->pro_fname . '?"  href="' . base_url() . 'hr/employee/delete/' . $items->empid . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/employee/list_all"  href="' . base_url() . 'hr/employee/view/' . $items->empid . '" data-toggle="tooltip" title="view" class="btn btn-warning "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act = $act . ' &nbsp;<a  back="' . base_url() . 'hr/employee/list_all"  href="' . base_url() . 'hr/employee/salary_list/' . $items->empid . '" data-toggle="tooltip" title="edit" class="btn btn-primary ">Payment Details</span></a>';
//            $act = $act . '&nbsp;<a  back="' . base_url() . 'hr/employee/list_all"  href="' . base_url() . 'hr/employee/set_bonus/' . $items->empid . '" data-toggle="tooltip" title="edit" class="btn btn-primary ">Set Bonus</span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Employee->count_all(),
            "recordsFiltered" => $this->Employee->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
