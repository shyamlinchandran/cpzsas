<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emp
 *
 * @author u43255
 */
//require_once(FUEL_PATH.'/libraries/Fuel_MY_Controller.php');
class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model', 'dash');
        //$this->load->model('clinic/dash_model', 'cdash');
        $this->load->database();
        // $this->load->helper(array('form', 'url'));
        // $this->load->model('chart_m');
        $this->load->library('session');
        $this->load->helper(array('url','html','form'));
    }
	
	public function cashbankcollection(){
		return $this->dash->cashbankcollection();
	}
	
	public function Toplist(){
		return $this->dash->Toplist();
	}

    public function saleslist(){
  
       return $this->dash->sales();
      
    }

    public function purchaselist(){

    return $this->dash->purchase();
    
    }

    public function paymentreceiptlist(){

    return $this->dash->paymentreceipt();
    
    }

    public function totalcollectionlist(){

    return $this->dash->collectionvalues();
    
    }
	
	public function stockvalue(){
		$data =  $this->dash->stockvalue();
		print_r($data);
	}

    public function receivablelist(){

    return $this->dash->receivablepayable();
    
    }



    public function getCategorysales() {
        return $this->dash->getCategorysales();
    }

    public function getMargin() {
        return $this->dash->getMargin();
    }

    public function getCategorysalesnew() {
        return $this->dash->getCategorysalesnew();
    }

    public function getMarginnew() {
        return $this->dash->getMarginnew();
    }

     public function getMargindash() {
        return $this->dash->getMargindash();
        

    }


    public function getMarginpurchase() {
        return $this->dash->getMarginpurchase();
    }



    public function calculator() {
        $this->load->view('calculator');
    }
	
	public function yoga(){
		$this->download();
		//$this->load->view('_blocks/subpages/create');
		$this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
		$data['id'] = $this->dash->getscheduleid();
		$data['classes'] = $this->dash->getclasses();
		$data['times'] = $this->dash->gettimes();
        $this->load->view('dashboard/yoga',$data);
        $this->load->view('_blocks/lte_layout/footer');
	}

    public function superadmin() {
        $this->download();
        $this->load->view('_blocks/subpages/create');
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['bank'] = $this->dash->banksales();
        $data['estimate'] = $this->dash->estimates();
        $data['sreturn'] = $this->dash->salereturn();
        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['preturn'] = $this->dash->purchasereturn();
        //$this->download();
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
        $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dashboard/main');
    }

    public function admin() {
        $this->download();
        $user = $this->session->userdata('user');
       
       // $data['preturn'] = $this->dash->purchasereturn(); 
      //  $data['chart_details'] = $this->dash->getsales();
       // $data['purchase_details'] = $this->dash->getpurchase();
        //$data['companies'] = $this->dash->companies();
        $settings = $this->dash->getCompanySettings();
        $dahsboard_analytics = 0;
        if(isset($settings[0]['dahsboard_analytics'])){
            $dahsboard_analytics = $settings[0]['dahsboard_analytics'];
            
        }
        if($dahsboard_analytics > 0 ){
                    $data['bank'] = $this->dash->banksales();
            $data['cash'] = $this->dash->cntcashsales();
            $data['credit'] = $this->dash->cntcreditsales();
            $data['estimate'] = $this->dash->estimates(' and invoice_date = CURDATE() ');
            $data['sreturn'] = $this->dash->salereturn();
            $data['purchase'] = $this->dash->purchasereport(' and date = CURDATE() ');
            $data['porder'] = $this->dash->purchaseorder(' and date = CURDATE() ');
            $data['quickmenu'] = $this->dash->quickmenu($user['Id']);
        }
        $data['quickmenu'] = $this->dash->quickmenu($user['Id']);
        $data['dahsboard_analytics'] = $dahsboard_analytics;
        $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/main', $data);
        $this->load->view('_blocks/lte_layout/footer');
    }

    public function admindashboard(){
        //        $this->download();
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['estimate'] = $this->dash->estimates();
        $data['sreturn'] = $this->dash->salereturn();
        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['preturn'] = $this->dash->purchasereturn();
        //$this->download();
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
        $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/admindashboard', $data);
        $this->load->view('_blocks/lte_layout/footer');
    }

     public function purchase_admin()
    {
        $this->download();
        $data['tot_purchase'] = $this->dash->tot_purchase_order();
        $data['purchase_comp'] = $this->dash->purchase_completed();
        $data['pur_pend_amount'] = $this->dash->pur_pending_amount();
        $data['pur_comp_amount'] = $this->dash->pur_completed_amount();

        $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/purchase_admin', $data);
        $this->load->view('_blocks/lte_layout/footer');

    }

    public function sub_admin()
    {
        $this->download();
        $data['tot_sales'] = $this->dash->tot_sales_order();
        $data['sales_comp'] = $this->dash->Sales_completed();
        $data['pend_amount'] = $this->dash->pending_amount();
        $data['comp_amount'] = $this->dash->completed_amount();



        $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/sub_admin', $data);
        $this->load->view('_blocks/lte_layout/footer');
    }


    function purchase_productionstatus()
    {
        return $this->dash->purchase_productionstatus();
    }
    function productionstatus()
    {
       return $this->dash->productionstatus();
    }


    public function productionstatus_time()
    {
        return $this->dash->productionstatus_time();
    }


    public function new() {
          $this->download();
          $user = $this->session->userdata('user'); 

        $data['salescount'] = $this->dash->salescount();
        $data['salesvalue'] = $this->dash->salesvalue();
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['bank'] = $this->dash->banksales();

        $data['purchasecount'] = $this->dash->purchasecount();
        $data['purchasevalue'] = $this->dash->purchasevalue();
        $data['purchasecash'] = $this->dash->cashpurchase();
        $data['purchasecredit'] = $this->dash->creditpurchase();
        $data['purchasebank'] = $this->dash->bankpurchase();

        $data['estimate'] = $this->dash->estimates();
        $data['estimatevalue'] = $this->dash->estimatesvalue();

        $data['sreturn'] = $this->dash->salereturn();
        $data['salesreturnvalue'] = $this->dash->salesreturnvalue();
        $data['cashreturn'] = $this->dash->cashreturn();
        $data['creditreturn'] = $this->dash->creditreturn();
        $data['bankreturn'] = $this->dash->bankreturn();

        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['pordervalue'] = $this->dash->purchaseordervalue();

        $data['cashpayment'] = $this->dash->cashpayment();
        $data['bankpayment'] = $this->dash->bankpayment();
        $data['cashcollection'] = $this->dash->cashcollection();
        $data['bankcollection'] = $this->dash->bankcollection();

        // $data['collectionvalue'] = $this->dash->collectionvalue();

        $data['preturn'] = $this->dash->purchasereturn(); 
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
         $data['quickmenu'] = $this->dash->quickmenu($user['Id']);
       
        
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
          $this->load->view('_blocks/lte_layout/header');
        $this->load->view('dashboard/new',$data);
         
        $this->load->view('_blocks/lte_layout/footer');
    }

    


    public function newdash() {

         $this->download();
        $user = $this->session->userdata('user'); 
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['estimate'] = $this->dash->estimates();
        $data['sreturn'] = $this->dash->salereturn();
        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['preturn'] = $this->dash->purchasereturn(); 
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
         $data['quickmenu'] = $this->dash->quickmenu($user['Id']);
         
         $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/newdash',$data);
         $this->load->view('_blocks/lte_layout/footer');
    }

     public function dashnew() {

         $this->download();
        $user = $this->session->userdata('user'); 

        $data['salescount'] = $this->dash->salescount();
        $data['salesvalue'] = $this->dash->salesvalue();
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['bank'] = $this->dash->banksales();

        $data['purchasecount'] = $this->dash->purchasecount();
        $data['purchasevalue'] = $this->dash->purchasevalue();
        $data['purchasecash'] = $this->dash->cashpurchase();
        $data['purchasecredit'] = $this->dash->creditpurchase();
        $data['purchasebank'] = $this->dash->bankpurchase();

        $data['estimate'] = $this->dash->estimates();
        $data['estimatevalue'] = $this->dash->estimatesvalue();

        $data['sreturn'] = $this->dash->salereturn();
        $data['salesreturnvalue'] = $this->dash->salesreturnvalue();
        $data['cashreturn'] = $this->dash->cashreturn();
        $data['creditreturn'] = $this->dash->creditreturn();
        $data['bankreturn'] = $this->dash->bankreturn();

        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['pordervalue'] = $this->dash->purchaseordervalue();

        $data['cashpayment'] = $this->dash->cashpayment();
        $data['bankpayment'] = $this->dash->bankpayment();
        $data['cashcollection'] = $this->dash->cashcollection();
        $data['bankcollection'] = $this->dash->bankcollection();

        // $data['collectionvalue'] = $this->dash->collectionvalue();

        $data['preturn'] = $this->dash->purchasereturn(); 
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
         $data['quickmenu'] = $this->dash->quickmenu($user['Id']);

         $this->load->view('_blocks/lte_layout/header');
         $this->load->view('_blocks/subpages/list');
         $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/dashnew',$data);
         $this->load->view('_blocks/lte_layout/footer');
    }

       public function adminlte() {

         $this->download();
        $user = $this->session->userdata('user'); 
        
        $data['salescount'] = $this->dash->salescount();
        $data['salesvalue'] = $this->dash->salesvalue();
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['bank'] = $this->dash->banksales();

        $data['purchasecount'] = $this->dash->purchasecount();
        $data['purchasevalue'] = $this->dash->purchasevalue();
        $data['purchasecash'] = $this->dash->cashpurchase();
        $data['purchasecredit'] = $this->dash->creditpurchase();
        $data['purchasebank'] = $this->dash->bankpurchase();

        $data['estimate'] = $this->dash->estimates();
        $data['estimatevalue'] = $this->dash->estimatesvalue();

        $data['sreturn'] = $this->dash->salereturn();
        $data['salesreturnvalue'] = $this->dash->salesreturnvalue();
        $data['cashreturn'] = $this->dash->cashreturn();
        $data['creditreturn'] = $this->dash->creditreturn();
        $data['bankreturn'] = $this->dash->bankreturn();

        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['pordervalue'] = $this->dash->purchaseordervalue();

        $data['cashpayment'] = $this->dash->cashpayment();
        $data['bankpayment'] = $this->dash->bankpayment();
        $data['cashcollection'] = $this->dash->cashcollection();
        $data['bankcollection'] = $this->dash->bankcollection();

        // $data['totalcollection'] = $this->dash->collectionvalues();

        $data['preturn'] = $this->dash->purchasereturn(); 
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
        $data['quickmenu'] = $this->dash->quickmenu($user['Id']);

       // $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/adminlte',$data);
      //  $this->load->view('_blocks/lte_layout/footer');
    }

     public function summary() {

         $this->download();
        $user = $this->session->userdata('user'); 
        
        $data['salescount'] = $this->dash->salescount();
        $data['salesvalue'] = $this->dash->salesvalue();
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['bank'] = $this->dash->banksales();

        $data['purchasecount'] = $this->dash->purchasecount();
        $data['purchasevalue'] = $this->dash->purchasevalue();
        $data['purchasecash'] = $this->dash->cashpurchase();
        $data['purchasecredit'] = $this->dash->creditpurchase();
        $data['purchasebank'] = $this->dash->bankpurchase();

        $data['estimate'] = $this->dash->estimates();
        $data['estimatevalue'] = $this->dash->estimatesvalue();

        $data['sreturn'] = $this->dash->salereturn();
        $data['salesreturnvalue'] = $this->dash->salesreturnvalue();
        $data['cashreturn'] = $this->dash->cashreturn();
        $data['creditreturn'] = $this->dash->creditreturn();
        $data['bankreturn'] = $this->dash->bankreturn();

        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['pordervalue'] = $this->dash->purchaseordervalue();

        $data['cashpayment'] = $this->dash->cashpayment();
        $data['bankpayment'] = $this->dash->bankpayment();
        $data['cashcollection'] = $this->dash->cashcollection();
        $data['bankcollection'] = $this->dash->bankcollection();

        // $data['totalcollection'] = $this->dash->collectionvalues();

        $data['preturn'] = $this->dash->purchasereturn(); 
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
        $data['quickmenu'] = $this->dash->quickmenu($user['Id']);

       // $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/adminlte',$data);
      //  $this->load->view('_blocks/lte_layout/footer');
    }

     public function dark() {

         $this->download();
        $user = $this->session->userdata('user'); 
        $data['cash'] = $this->dash->cashsales();
        $data['credit'] = $this->dash->creditsales();
        $data['estimate'] = $this->dash->estimates();
        $data['sreturn'] = $this->dash->salereturn();
        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['preturn'] = $this->dash->purchasereturn(); 
        $data['chart_details'] = $this->dash->getsales();
        $data['purchase_details'] = $this->dash->getpurchase();
        $data['companies'] = $this->dash->companies();
        $data['quickmenu'] = $this->dash->quickmenu($user['Id']);
         
         $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('dashboard/dark',$data);
         $this->load->view('_blocks/lte_layout/footer');
    }

    public function clinic() {
        $this->download();
        $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $data['appointments'] = $this->dash->appointments();
        $data['approvals'] = $this->dash->patient_status('Approve');
        $data['checkedp'] = $this->dash->patient_status('Checked');
        $data['paidp'] = $this->dash->patient_status('Payed');
        $this->load->view('dashboard/clinic', $data);
        $this->load->view('_blocks/lte_layout/footer');
    }

    public function users() {
        $this->download(); 
        $user = $this->session->userdata('user');
        $this->load->view('_blocks/lte_layout/header');
        $this->load->view('_blocks/subpages/list');
        $data['cash'] = $this->dash->cntcashsales();
        $data['credit'] = $this->dash->cntcreditsales();
        $data['estimate'] = $this->dash->estimates();
        $data['sreturn'] = $this->dash->salereturn();
        $data['purchase'] = $this->dash->purchasereport();
        $data['porder'] = $this->dash->purchaseorder();
        $data['preturn'] = $this->dash->purchasereturn();
        $data['quickmenu'] = $this->dash->quickmenu($user['Id']);
        $this->load->view('dashboard/sadmin', $data);
        $this->load->view('_blocks/lte_layout/footer');
    }

    function quickmenu() {
        $user = $this->session->userdata('user');
        $data = $this->dash->quickmenu($user['Id']);
        echo json_encode($data);
    }

    function search($type, $search) {
        $data['type'] = $type;
        $data['search'] = $this->dash->search($type, $search);
        $this->load->view('dashboard/search', $data);
    }

    public function getsession() {
        $createdby = $this->session->userdata('logged_in');
        echo $createdby;
    }

    public function ajax_list() {
        $this->dash->where();
        $list = $this->dash->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->name;
            // $row[] = $vouchers->narration;
            // $row[] = $vouchers->tax;
            $row[] = $vouchers->total;
            $row[] = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                    . ' <a href="' . base_url() . 'transaction/sales/view/' . $vouchers->sales_id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'transaction/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dash->count_all(),
            "recordsFiltered" => $this->dash->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function clinic_list($type) {
        $this->cdash->where($type);
        $list = $this->cdash->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $dashitem) {
            $no++;
            $row = array();
            $row[] = $dashitem->Bok_Id;
            $row[] = $dashitem->Pat_Name;
            $row[] = $dashitem->Pat_Phone;
            $row[] = '';
            /* $row[] = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $dashitem->sales_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
              . ' <a href="' . base_url() . 'transaction/sales/view/' . $dashitem->sales_id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>'
              . ' <a href="' . base_url() . 'transaction/sales/' . $dashitem->stype . '/' . $dashitem->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>'; */
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->cdash->count_all(),
            "recordsFiltered" => $this->cdash->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function checklist() {
        $this->dash->checklistmismatch();
        $list = $this->dash->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $vouchers->trn_tp;
            $row[] = $vouchers->voucher_no;
            $row[] = $vouchers->a;
            $row[] = $vouchers->b;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dash->count_all(),
            "recordsFiltered" => $this->dash->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function checklistmismatchcnt() {
        $this->dash->checklistmismatchcnt();
    }

    public function debitdetails() {
        $this->dash->debitDetails();
        $list = $this->dash->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $vouchers->Name;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->edate;
            $row[] = $vouchers->sdate;
            $row[] = $vouchers->gtotal;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dash->count_all(),
            "recordsFiltered" => $this->dash->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function creditdetails() {
        $this->dash->creditDetails();
        $list = $this->dash->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $vouchers->Name;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->edate;
            $row[] = $vouchers->sdate;
            $row[] = $vouchers->gtotal;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dash->count_all(),
            "recordsFiltered" => $this->dash->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function getmyhistory() {
        return $this->dash->getmyhistory();
    }

}
