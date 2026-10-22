<?php

class Enquiry_followup extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('Enquiryfollowup_model', 'Enquiry_followup');
    }
    
    public function getsing($id){
        return $this->Enquiry_followup->getsing($id);
    }

    public function save() {
//        if (isset($_FILES['file'])) {
            $ms = $_FILES['file'];
            //upload file
            $config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '2048';
            $new_name = time() . $_FILES["file"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $response = array(
                    'valid' => false,
                    'type' => 1,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;
            }
            $insert_id = $this->Enquiry_followup->save($new_name);
    }

}
