<?php

class AlertDues extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AlertDues_model', 'alertdues');
    }

    /* ---------- ALERT METHODS ---------- */

    public function alert_list() {
        $data['title'] = 'Alert Settings';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/alert/list_all', $data);
    }

    public function alert_create($id = 0, $view = "create") {
        $data['id']    = $id;
        $data['view']  = $view;
        $data['title'] = 'Alert Create';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/alert/create', $data);
    }

    public function alert_edit($id) {
        $data['id']    = $id;
        $data['view']  = 'edit';
        $data['title'] = 'Alert Edit';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/alert/create', $data);
    }

    /* ---------- DUES METHODS ---------- */

    public function dues_list() {
        $data['title']      = 'Dues Report';
        $data['start_date'] = $this->input->post('start_date') ? $this->input->post('start_date') : date('Y-m-01');
        $data['end_date']   = $this->input->post('end_date') ? $this->input->post('end_date') : date('Y-m-t');
        
        $this->load->view('settings/dues/list_all', $data);
    }

    public function ajax_dues_report() {
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');
        
        $list = $this->alertdues->get_ageing_dues($start_date, $end_date);
        $data = array();
        $no   = 0;
        
        foreach ($list as $row) {
            $no++;
            $r = array();
            $r[] = $no;
            $r[] = $row['ledger_name'];
            $r[] = $row['voucher_no'];
            $r[] = $row['tb_name'];
            $r[] = $row['remarks'] ? $row['remarks'] : '---';
            $r[] = number_format($row['balance'], 2);
            $r[] = date('d-m-Y', strtotime($row['due_date'] ? $row['due_date'] : $row['tb_crdate']));
            
            // Add Edit/Reschedule button
            // $btn = '<button type="button" class="btn btn-xs btn-primary reschedule-btn" 
            //             data-id="'.$row['age_id'].'" 
            //             data-date="'.($row['due_date'] ? $row['due_date'] : $row['duedate']).'" 
            //             data-time="'.$row['due_time'].'">
            //             <i class="fa fa-clock-o"></i> Reschedule
            //         </button>';
            // $r[] = $btn;
            
            $data[] = $r;
        }
        
        echo json_encode(array("data" => $data));
    }

    public function dues_create($id = 0, $view = "create") {
        $data['id']    = $id;
        $data['view']  = $view;
        $data['title'] = 'Dues Create';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/dues/create', $data);
    }

    public function dues_edit($id) {
        $data['id']    = $id;
        $data['view']  = 'edit';
        $data['title'] = 'Dues Edit';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/dues/create', $data);
    }

    /* ---------- COMMON METHODS ---------- */

    public function getsing($id) {
        return $this->alertdues->getsing($id);
    }

    public function getcompanies() {
        return $this->alertdues->getcompanies();
    }

    public function save() {
        $this->alertdues->save();
    }

    public function delete($id) {
        $this->alertdues->delete($id);
    }

    public function ajax_list() {
        $type = $this->input->post('type');
        $this->alertdues->where($type);
        $list = $this->alertdues->get_datatables();
        $data = array();
        $no   = $this->input->post('start');
        foreach ($list as $row) {
            $no++;
            $r    = array();
            $r[]  = $no;
            $r[]  = $row->name;
            
            if ($type == 'alert') {
                $r[] = $row->task;
                $r[] = $row->date;
                $r[] = $row->time;
                $r[] = $row->task_from;
                $r[] = $row->task_to;
                $edit_url = base_url() . 'settings/AlertDues/alert_edit/' . $row->id;
            } else {
                $r[] = $row->voucherno;
                $r[] = $row->ledger;
                $r[] = $row->remarks;
                $r[] = $row->amount;
                $r[] = $row->duedate;
                $r[] = $row->time;
                $edit_url = base_url() . 'settings/AlertDues/dues_edit/' . $row->id;
            }
            
            $act  = '<a href="' . $edit_url . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a href="#" onclick="deleteRecord(' . $row->id . ')" title="Delete" data-toggle="tooltip" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';
            $r[]  = $act;
            $data[] = $r;
        }
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->alertdues->count_all(),
            "recordsFiltered" => $this->alertdues->count_filtered(),
            "data"            => $data,
        );
        echo json_encode($output);
    }

    public function reschedule_due() {
        $age_id = $this->input->post('age_id');
        $date   = $this->input->post('due_date');
        $time   = $this->input->post('due_time');
        
        if ($age_id) {
            $data = array(
                'due_date' => $date,
                'due_time' => $time
            );
            $this->db->where('age_id', $age_id);
            $this->db->update('acc_ageing', $data);
            echo json_encode(array('status' => true));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Invalid Age ID'));
        }
    }
}
