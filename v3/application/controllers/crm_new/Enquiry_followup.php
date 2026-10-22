<?php

class Enquiry_followup extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->helper('download');
        $this->load->model('crm_new/Enquiryfollowup_model', 'Enquiry_followup');
    }

    public function getsing($id = 0) {
        $this->Enquiry_followup->where($id);
        $this->Enquiry_followup->getsing($id);
        $list = $this->Enquiry_followup->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = substr($item->date, 0,10);
            $row[] = substr($item->next_follow_up_date, 0,10);
            $row[] = substr($item->updated_date, 0,10);
            $row[] = $item->labels; 
            $row[] = $item->statuss;
            $row[] = $item->remarks;
            if($item->file == 'noimage'){

                $act = '<p style = "font-size:12px;color:grey"><i>No Files<i><p>';

            }
            else{
                $act = '<a role="button" tp="new" align = "center"  href="' . base_url() . 'crm_new/Enquiry_followup/downloads/' . $item->id . '" style = "padding-left:15px"><span align = "center" class="glyphicon glyphicon-download"></span></a>';
                // $act = '<a role = "button" id = "download"  ids="'.$item->id.'" align = "center" back="' . base_url() . 'crm_new/Enquiry_followup/" onclick="downloadfile(this)" href="#" class = "" style = "padding-left:15px"><span align = "center" class="glyphicon glyphicon-download"></span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Enquiry_followup->count_all() + 1,
            "recordsFiltered" => $this->Enquiry_followup->count_filtered() + 1, 
            "data" => $data,
        );
        //output to json format
        echo json_encode($output); 

    }

    public function label_list() {
        $this->Enquiry_followup->label_list();
        $list = $this->Enquiry_followup->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->label; 
            $row[] = $item->note;
            $act = ' <a  back="' . base_url() . 'crm_new/Enquiry_followup/listLabel"  href="' . base_url() . 'crm_new/Enquiry_followup/addLabel/' . $item->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'crm_new/Enquiry_followup/listLabel' . '"  success="Delete ' . $item->label . ' successfuly "  message="Do you want to Delete ' . $item->label . '?"  href="' . base_url() . 'crm_new/Enquiry_followup/deleteLabel/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Enquiry_followup->count_all() + 1,
            "recordsFiltered" => $this->Enquiry_followup->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output); 

    }
    //Status Master

    public function status_list() {
        $this->Enquiry_followup->status_list();
        $list = $this->Enquiry_followup->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->status; 
            $row[] = $item->note;
            $act = ' <a  back="' . base_url() . 'crm_new/Enquiry_followup/listStatus"  href="' . base_url() . 'crm_new/Enquiry_followup/addStatus/' . $item->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'crm_new/Enquiry_followup/listStatus' . '"  success="Delete ' . $item->status . ' successfuly "  message="Do you want to Delete ' . $item->status . '?"  href="' . base_url() . 'crm_new/Enquiry_followup/deleteStatus/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Enquiry_followup->count_all() + 1,
            "recordsFiltered" => $this->Enquiry_followup->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output); 

    }

    public function show() {
        return $this->Enquiry_followup->show();
    }

    public function listLabel()
    {
        $data['settings']=$this->Enquiry_followup->getCompanySettings();
        // $date = date('Y-m-d');
        // $data['datenow'] = $date;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_followup/listlabel', $data);
    }
    // Status master
    public function listStatus()
    {
        $data['settings']=$this->Enquiry_followup->getCompanySettings();
        // $date = date('Y-m-d');
        // $data['datenow'] = $date;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_followup/liststatus', $data);
    }

    public function deleteLabel($id)
    {
        $this->Enquiry_followup->deleteLabel($id);
    }
// Status master
    public function deleteStatus($id)
    {
        $this->Enquiry_followup->deleteStatus($id);
    }

    public function addLabel($id = 0)
    {
        $data['option'] = 'create';
        $data['id'] = $id;
        $data['settings']=$this->Enquiry_followup->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_followup/addLabel', $data);
    }

    public function addStatus($id = 0)
    {
        $data['option'] = 'create';
        $data['id'] = $id;
        $data['settings']=$this->Enquiry_followup->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_followup/addStatus', $data);
    }

    public function getLabel($id = 0)
    {
        $this->Enquiry_followup->getLabel($id);
    }

    public function getStatus($id = 0)
    {
        $this->Enquiry_followup->getStatus($id);
    }

    public function saveLabel()
    {
        $this->Enquiry_followup->saveLabel();
    }

    public function saveStatus()
    {
        $this->Enquiry_followup->saveStatus();
    }
    

    public function save() {


            if (!isset($_FILES["file"]['name'])) {
                
                    $new_name = "noimage";
                    $insert_id = $this->Enquiry_followup->save($new_name);
                    // if($insert_id == 1){
                        $response = array(
                            'valid' => false,
                            'type' => 1,
                            'message' => 'Saved Successfully.'
                        );
                
                        echo json_encode($response);
                    // }
            }
            else{       
                $ms = $_FILES['file'];

                    $new_name = time() . $_FILES["file"]['name'];
                    $config['upload_path'] = 'assets/images/';
                    $config['allowed_types'] = '*';
                    $config['max_filename'] = '255';
                    $config['max_size'] = '2048';
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config); 
                    if ($this->upload->do_upload('file')) {

                        $insert_id = $this->Enquiry_followup->save($new_name);
                        if($insert_id == 1){
                            $response = array(
                                'valid' => true,
                                'type' => 1,
                                'message' => 'Saved Successfully.'
                            );
                    
                            echo json_encode($response);
                        }
            
                    }
                    else{

                        $response = array(
                            'valid' => false,
                            'type' => 1,
                            'message' => $this->upload->display_errors()
                        );
                        echo json_encode($response);
                        return;

                    }
        }

        
    }

    public function downloads($id) {
        
        $filename = $this->Enquiry_followup->downloads($id);

        if(!strpos($filename['file'], '.jpg') || !strpos($filename['file'], '.png')){
            $pth    =   file_get_contents(base_url()."assets/images/".$filename['file']);
            force_download('assets/images/'.$filename['file'], $pth);
            
        }
        else{
            force_download('assets/images/'.$filename['file'], null);
            
        }
        
       

        
    }

    

}
