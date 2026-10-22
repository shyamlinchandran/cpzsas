
<?php


class Driver extends MY_Controller {


    public function __construct() {
        parent::__construct();
       
        $this->load->model('Driver_model', 'driver');
    }

        function create($id = 0, $view = '') {
		
            $data['id'] = $id;
            $data['enq_id'] = 0;
    
            $data['title'] = 'Driver create';
            $data['type'] = 'driver';
            $data['eid'] = '';
            $data['usrtype']='User Type';
            $data['compny']='Company';
            $data['branch']='Branch';
            
            $data['option'] = $view;
            $data['view'] = "create";
            $this->load->view('_blocks/subpages/create');
            $this->load->view('_blocks/subpages/list');
            $this->load->view('driver/create',$data);	
    
        }
        public function listall()
    {
		$data['title'] = 'Driver';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$data['type'] = 'usr';
        $this->load->view('driver/listall',$data);
    }
    public function view($id = 0,$view='') {
        $this->load->view('_blocks/subpages/create');
       
        $data['id'] = $id;
        $data['title'] = 'Driver create';
        $data['type'] = 'driver';
        $data['eid'] = '';
        $data['option'] = $view;
        $data['view'] = "view";
        $this->load->view('driver/create', $data);
    }

   
    

    public function state()
    {
        return $this->driver->state();
    }
      
   
	public function save()
    {
        return $this->driver->save();
    }
   
	public function ajax_list($ls = 0)
    {   
        $list = $this->driver->get_datatables();
            $data = array();
            $no = $this->input->post('start');
            foreach ($list as $item) {
                $no++;
            $row = array();			
            $row[] = $no;
            $row[] = ucfirst($item->Driver_name); 
            $row[] = $item->licence_no;  
            $row[]=$item->Mobile;        
                      $act = '<a id = "edittor"  href="' . base_url() . 'Driver/create/' . $item->Id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'Driver/view/' . $item->Id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                    $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'Driver/listall' . '"  success="Delete ' . $item->Driver_name . ' successfuly "  message="Do you want Delete ' . $item->Driver_name . '?"  href="' . base_url() . 'Driver/delete/' . $item->Id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
                                
                    $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->driver->count_all(),
            "recordsFiltered" => $this->driver->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    
    public function getdetails($id) {
    return $this->driver->getdetails($id);
    }

    public function delete($id) {
        return  $this->driver->delete($id);
      }


}