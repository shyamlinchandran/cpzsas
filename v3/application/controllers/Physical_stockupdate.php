<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Physical_stockupdate extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Physical_stockupdate_model', 'stock');
    }
	
	public function listall(){
        
		$settings = $this->stock->getCompanySettings();
		$isbatch = $settings[0]['is_batch'];
        $data['settings'] = $settings;
        $data['isbatch'] = $isbatch;
		if( (float) $isbatch < 1 ){
			$qry = "update item_godown as aa inner JOIN (SELECT a.id,a.current_stock,stk from item_godown as a INNER JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown from item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id and x.godown = a.godown_id HAVING stk !=current_stock) as y on y.id = aa.id set aa.current_stock = stk";
			//$this->db->query($qry);
		}else{
            $qry = "update item_godown as aa inner JOIN (SELECT a.id,a.current_stock,stk,a.batch from item_godown as a INNER JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown,b.batch from item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown,b.batch) as x on x.item_id = a.item_id and x.godown = a.godown_id AND x.batch = a.batch HAVING stk !=current_stock) as y on y.id = aa.id set aa.current_stock = stk";
           // $this->db->query($qry);
        }
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('physical_stockupdate/listall',$data);
	}
    function create($id = 0, $view = '') {

    $settings = $this->stock->getCompanySettings();
		$isbatch = $settings[0]['is_batch'];
        $data['settings'] = $settings;
        $data['isbatch'] = $isbatch;
		
        $data['id'] = $id;
        $data['enq_id'] = 0;

        $data['title'] = 'Physical Stock Update create';
        $data['type'] = 'Physical stock update';
        $data['eid'] = '';
        $data['usrtype']='User Type';
        $data['compny']='Company';
        $data['branch']='Branch';
        
        $data['option'] = $view;
        $data['view'] = "create";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('physical_stockupdate/create',$data);

    }
    public function view($id = 0,$view='') {
    $settings = $this->stock->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $isbatch = $settings[0]['is_batch'];
        $data['settings'] = $settings;
        $data['isbatch'] = $isbatch;
        $data['id'] = $id;
        $data['title'] = 'Physical Stock Update create';
        $data['type'] = 'client';
        $data['eid'] = '';
        $data['option'] = $view;
        $data['view'] = "view";
        $this->load->view('physical_stockupdate/create', $data);
    }
	 
    public function ajax_list($ls = 0)
    {   
        $list = $this->stock->get_datatables();
            $data = array();
            $no = $this->input->post('start');
            foreach ($list as $item) {
                $no++;
            $row = array();			
            $row[] = $no;
            $row[] = ucfirst($item->date); 
            $row[] = ucfirst($item->voucher_no); 
                      $act = '<a style ="display:none"  id = "edittor"  href="' . base_url() . 'Physical_stockupdate/create/' . $item->phy_stk_Id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'Physical_stockupdate/view/' . $item->phy_stk_Id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                    $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'Physical_stockupdate/listall' . '"  success="Delete ' . $item->date . ' successfuly "  message="Do you want Delete ' . $item->date . '?"  href="' . base_url() . 'Physical_stockupdate/delete/' . $item->phy_stk_Id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
                    
            
                    $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stock->count_all(),
            "recordsFiltered" => $this->stock->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function save()
    {
        return $this->stock->save();
    }
    
    public function getitem($type= 'name')
    {
        return $this->stock->getitem($type);
    }
    public function getbatch()
    {
        return $this->stock->getbatch();
    }
    public function getgodown()
    {
        return $this->stock->getgodown();
    }
    
    public function getuser(){
        return $this->stock->getuser();
    }
    
    public function getdetails($id){
        return $this->stock->getdetails($id);
    }
    public function getstockupdate($id){
        return $this->stock->getstockupdate($id);
    }
    public function delete($id){
        return $this->stock->delete($id);
    }
    public function getactualstock($id){
        return $this->stock->getactualstock($id);
    }
}

