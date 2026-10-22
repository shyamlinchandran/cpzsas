<?php

class Process_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('production/process/process_model', 'process');
    }

    public function listall()
    {
        $data['title'] = 'Process List';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/process/listall', $data);
    }
    public function create($id = 0)
    {
        $data['title'] = 'Process Create';
        $data['id'] = $id;
        $data['view'] = "create";
		if($id < 1){
			$data['invoice'] = $this->process->getinvoice();
		}else{
			$qry = "select * from production_process_main where id =".$id;
			$main_data = $this->db->query($qry)->row_array();
			$data['invoice'] = $main_data['voucher_no'];
		}
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/process/create', $data);
    }
    public function edit($id = 0)
    {
        $data['title'] = 'Process';
        $data['id'] = $id;
        $data['view'] = "edit";
		if($id < 1){
			$data['invoice'] = $this->process->getinvoice();
		}else{
			$qry = "select * from production_process_main where id =".$id;
			$main_data = $this->db->query($qry)->row_array();
			$data['invoice'] = $main_data['voucher_no'];
		}
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/process/create', $data);
    }
    public function view($id = 0)
    {
        $data['title'] = 'Process view';
        $data['id'] = $id;
        $data['view'] = "view";
		if($id < 1){
			$data['invoice'] = $this->process->getinvoice();
		}else{
			$qry = "select * from production_process_main where id =".$id;
			$main_data = $this->db->query($qry)->row_array();
			$data['invoice'] = $main_data['voucher_no'];
		}
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/process/create', $data);
    }
    public function delete($id){

       $this->process->delete($id);

    }

    public function statusSearch()  {
       $result= $this->process->statusSearch();
       $option='<option value="" >Select</option>';
       foreach($result as $row){

        $option.='<option value="'.$row["id"].'">'.$row["status"].'</option>';
       }
       echo $option;
    }
    public function userSearch()  {
		$tmp = $this->session->userdata('user');
		$userid = $tmp['Id'];
        $result= $this->process->userSearch();
        $option='<option value="" selected> Select</option>';
        foreach($result as $row){
			$text = '';
			if($userid == $row->Id){
				$text = 'selected';
			}
			$option.='<option '.$text.' value="'.$row->Id.'">'.$row->username.'</option>';

         }
         echo $option;
     }
     public function productSearch()  {
        $search= strtolower($_GET['term']);
        $this->process->productSearch($search);
       
     }
     public function ledgerSearch()  {
        $search= strtolower($_GET['term']);
        $this->process->ledgerSearch($search);
       
     }
     public function getMaterialList($id)  {
        
        $this->process->getMaterialList($id);
       
     }
     public function getLedgerList($id){

      $this->process->getLedgerList($id);

     }

    public function save(){
         $this->process->save();

      }
      public function ajaxListAll()
      {   $this->process->where();
          $list = $this->process->get_datatables();
          $no = $this->input->post('start');
          $data = array();
          foreach ($list as $item) {
              $no++;
              $row = array();
              $row[]  = $no;
              $row[] = $item->voucher_no;
              $row[] = $item->status;
              $row[] = $item->user_name;
              $row[] = $item->date;
              $act = '<a base="' . base_url() . 'production/process/process_controller/listall/' . '" href="' . base_url() . 'production/process/process_controller/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
              <a  class="btn btn-info " base="' . base_url() . 'production/process/process_controller/listall/' . '" href="' . base_url() . 'production/process/process_controller/view/' .  $item->id. '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
              $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'production/process/process_controller/listall/' .  $item->id . '"  success="Delete ' .  $item->id . ' successfuly "  message="Do you want Delete ' . $item->id . '?"  href="' . base_url() . 'production/process/process_controller/delete/' .  $item->id. ' " data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
              $row[] = $act;
              $data[] = $row;
          }
          $output = array(
              "draw" => $this->input->post('draw'),
              "recordsTotal" => $this->process->count_all(),
              "recordsFiltered" => $this->process->count_filtered(),
              "data" => $data
          );
  
          echo json_encode($output);
      }
      public function getData($id)
      {
  
          $result = $this->process->getData($id);
          $product = $this->process->getProductData($id);
          $Addtnlledger = $this->process->getAddtnlLedgerData($id);
          $materialData = $this->process->getMaterialData($id);
         $ledgerData = $this->process->getLedgerData($id);
          $return = [
               'result' => $result,
               'product' => $product,
               'Addtnlledger' => $Addtnlledger,
               'materialData'=>  $materialData,
               'ledgerData'=> $ledgerData
          ];
          echo  json_encode($return);
      }

      
}
?>