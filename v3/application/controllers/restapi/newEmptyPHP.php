function videocreate_post() {
//        $json_request_body = file_get_contents('php://input');
//        $tmp = (array) json_decode($json_request_body);
//        if (isset($tmp['id'])) {
//            $id = $tmp['id'];
//        } else {
//            $id = 0;
//        }
        //if (isset($_FILES['filename'])) {
//                $video_received = $tmp['video'];
//                $video_parts = explode(";base64,", $video_received);
//                $video_type_aux = explode("E:/xampp/htdocs/videoapp/uploads/video/", $video_parts[0]);
//                $video_base64 = base64_decode($video_parts[1]);
//                $vid_name = uniqid() . '.mp4';
//                $folderPath = "E:/xampp/htdocs/videoapp/uploads/video/";
//                $file = $folderPath . $vid_name;
//                file_put_contents($file, $video_received);
            //log_message('error1', $decoded);
        try{
            $file = $_FILES['file'];
            $vid_name = $_FILES['file']['name'];
            echo $vid_name;
            $config['upload_path'] = 'E:/xampp/htdocs/videoapp/uploads/video/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '1024000'; //100 MB
            $this->load->library('upload', $config);
            $this->upload->do_upload($file);
//        } else {
//            $vid_name = 0;
//        }
        //'user_id' => $tmp['user_id'],
        $data = array(
            'user_id' => 1,
            'vid_name' => $vid_name
        );
        $id =0;
        if ($vid_name != 0) {
            if ($id == 0) {
                $insert_id = $this->subdt->Insertvideo($data);
            } else {
                $this->subdt->Updatevideo($data, $id);
            }
            $msg = [
                'status' => TRUE,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        }
    }
catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($ex, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    /* function otpcreate_post() {
      $json_request_body = file_get_contents('php://input');
      $tmp = (array) json_decode($json_request_body);
      if (isset($tmp['id'])) {
      $id = $tmp['id'];
      } else {
      $id = 0;
      }
      $data = array(
      'user_id' => $tmp['user_id'],
      'otp' => $tmp['otp'],
      'status' => $tmp['status']
      );
      if ($id == 0) {
      $insert_id = $this->subdt->Insertotp($data);
      } else {
      $this->subdt->Updateotp($data, $id);
      }
      $msg = [
      'status' => TRUE,
      'message' => 'items are attached to the result'
      ];
      $this->response($msg, REST_Controller::HTTP_OK);
      } */