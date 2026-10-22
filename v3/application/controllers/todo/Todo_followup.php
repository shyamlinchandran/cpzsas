<?php

class Todo_followup extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->helper('download');
        $this->load->model('todo/Todofollowup_model', 'Todo_followup');
    }

    public function getsing($id = 0) {
        if($this->input->post('var_id')){
        if($this->input->post('var_id') >0){
            $id = $this->input->post('var_id');
        }
    }
        $this->Todo_followup->where($id);
        $this->Todo_followup->getsing($id);
        $list = $this->Todo_followup->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->date; 
            $row[] = substr($item->updated_date, 0,10);
            $row[] = $item->next_follow_up_date;
            $row[] = $item->remarks;
            if($item->file == 'noimage'){

                $act = '<p style = "font-size:12px;color:grey"><i>No Files<i><p>';

            }
            else{
                $act = '<a role="button" tp="new" align = "center"  href="' . base_url() . 'crm_general/Todo_followup/downloads/' . $item->id . '" style = "padding-left:15px"><span align = "center" class="glyphicon glyphicon-download"></span></a>';
                // $act = '<a role = "button" id = "download"  ids="'.$item->id.'" align = "center" back="' . base_url() . 'crm_general/Todo_followup/" onclick="downloadfile(this)" href="#" class = "" style = "padding-left:15px"><span align = "center" class="glyphicon glyphicon-download"></span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Todo_followup->count_all() + 1,
            "recordsFiltered" => $this->Todo_followup->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }
    public function show() {
        return $this->Todo_followup->show();
    }

    public function save() {


            if (!isset($_FILES["file"]['name'])) {
                
                    $new_name = "noimage";
                    $insert_id = $this->Todo_followup->save($new_name);
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

                        $insert_id = $this->Todo_followup->save($new_name);
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
        
        $filename = $this->Todo_followup->downloads($id);

        if(!strpos($filename['file'], '.jpg') || !strpos($filename['file'], '.png')){
            $pth    =   file_get_contents(base_url()."assets/images/".$filename['file']);
            force_download('assets/images/'.$filename['file'], $pth);
            
        }
        else{
            force_download('assets/images/'.$filename['file'], null);
            
        }
        
       

        
    }

    

}
