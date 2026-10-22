<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 */

/**
 *
 * @author Althaf/dimind
 */
class Item extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventory_model/Items_model', 'item');
        $this->load->library('excel'); //load PHPExcel library 
        $this->load->library('slim');
        $this->load->model('excel_data_insert_model', 'itemexcel');
    }
	
    public function change_item_rate(){
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('inventory_master/item/change_item_rate');
	}

    public function update_item_rate(){
		$audit_text = $this->input->post('text');
		$tax_id = $this->input->post('tax_id');
		$brand_id = $this->input->post('brand_id');
		$hsn_id = $this->input->post('hsn_id');
		$category = $this->input->post('category');
		$type  = $this->input->post('type');  //values comes increase decrease
		$where_text = '';
		if($this->input->post('tax_id')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			
			$where_text = $where_text . '  tax_id = ' . $tax_id;
		}
		
		if($this->input->post('brand_id')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			$where_text = $where_text . '  brand_id = ' . $brand_id;
		}
		
		if($this->input->post('hsn_id')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			$where_text = $where_text . '  hsncode = ' . $hsn_id;
		}
		
		if($this->input->post('category')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			$where_text = $where_text . '  item_category_id = ' . $category;
		}
		
        if ($this->input->post('type') && $this->input->post('percentage') && $this->input->post('field')) {
    $type       = $this->input->post('type');       // "increase" or "decrease"
    $percentage = (float)$this->input->post('percentage');
    $field      = $this->input->post('field');      // e.g., "mrp", "sale_rate"

    // Prevent SQL injection (only allow certain fields to be updated)
    $allowed_fields = ['MRP', 'srate','wh_rate','special_rate'];
    if (!in_array($field, $allowed_fields)) {
        return; // invalid field
    }

    // Build update expression
    if ($type === "increase") {
        $update_expr = "$field = $field + ($field * $percentage / 100)";
    } elseif ($type === "decrease") {
        $update_expr = "$field = $field - ($field * $percentage / 100)";
    } else {
        return; // invalid type
    }

    // Final SQL
    $sql = "UPDATE item SET $update_expr";
    if ($where_text != '') {
        $sql .= " WHERE $where_text";
    }

    // Execute query
    $this->db->query($sql);
}

		
	}


	public function change_item_tax(){
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('inventory_master/item/change_item_tax');
	}
	
	public function update_item_tax(){
		$audit_text = $this->input->post('text');
		$tax_id = $this->input->post('tax_id');
		$brand_id = $this->input->post('brand_id');
		$hsn_id = $this->input->post('hsn_id');
		$category = $this->input->post('category');
		$to_tax_id = $this->input->post('to_tax_id');
		$where_text = '';
		if($this->input->post('tax_id')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			
			$where_text = $where_text . '  tax_id = ' . $tax_id;
		}
		
		if($this->input->post('brand_id')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			$where_text = $where_text . '  brand_id = ' . $brand_id;
		}
		
		if($this->input->post('hsn_id')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			$where_text = $where_text . '  hsncode = ' . $hsn_id;
		}
		
		if($this->input->post('category')){
			if($where_text != '' ){
				$where_text = $where_text . ' and ';
			}
			$where_text = $where_text . '  item_category_id = ' . $category;
		}
		
		if($this->input->post('to_tax_id')){
			$tqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $to_tax_id . " and ref_code='tax' AND acc_main_id = 10";
			$tquery = $this->db->query($tqry);
			$sqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $to_tax_id . " and ref_code='saletax' AND acc_main_id = 21";
			$squery = $this->db->query($sqry);
			$pqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $to_tax_id . " and ref_code='purtax' AND acc_main_id = 19";
			$pquery = $this->db->query($pqry);
			$data['tax'] = $tquery->row_array();
			$data['saletax'] = $squery->row_array();
			$data['purctax'] = $pquery->row_array();
			if($where_text !=''){
				$qry = "update item set tax_id = ".$to_tax_id." , tax_ledger_id = " . $data['tax']['id'] . " , tax_sales_id = " . $data['saletax']['id'] . ",tax_purchase_id=" . $data['purctax']['id'] . " where  ".$where_text;
				$this->db->query($qry);
			}
			$tmp = $this->session->userdata('user');
			$created_by = $tmp['Id'];
			$data = array(
				'description'=>$audit_text,
				'tb_name'=>'Item',
				'user'=>$created_by
			);
			//$this->db->insert('auditLog',$data);
		}
	}

	
	public function get_item_quantity_price($id){
		$this->item->get_item_quantity_price($id);
	}
	
	public function gettxt(){
		$qry = "select a.id,a.barcode,a.name,case when a.srate = '' or a.srate is null then 0 else a.srate end as salerate,b.code,case WHEN b.code ='kg' then 1 else 2 end as unit from item as a INNER JOIN units as b on a.unit_id = b.id WHERE b.code ='kg' or b.code='no' and a.published = 'yes'";
		$result = $this->db->query($qry)->result_array();
		$myfile = fopen("PLU.txt", "w") or die("Unable to open file!");
		foreach($result as $item){
			$txt = $item['id'].','.$item['barcode'].','.$item['name'].','.$item['salerate'].','.$item['unit'];
			fwrite($myfile, $txt);
			$txt = "\n";
			fwrite($myfile, $txt);
		}
		fclose($myfile);
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename('PLU.txt'));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize('PLU.txt'));
		ob_clean();
		flush();
		readfile('PLU.txt');
		exit;
	}

    public function listall()
    {
        $settings = $this->item->getCompanySettings();
		$isbatch = $settings[0]['is_batch'];
		if( (float) $isbatch < 1 ){
			$qry = "update item_godown as aa inner JOIN (SELECT a.id,a.current_stock,stk from item_godown as a INNER JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown from item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id and x.godown = a.godown_id HAVING stk !=current_stock) as y on y.id = aa.id set aa.current_stock = stk";
			$this->db->query($qry);
		}else{
            // $qry = "update item_godown as aa inner JOIN (SELECT a.id,a.current_stock,stk,a.batch from item_godown as a INNER JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown,b.batch from item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown,b.batch) as x on x.item_id = a.item_id and x.godown = a.godown_id AND x.batch = a.batch HAVING stk !=current_stock) as y on y.id = aa.id set aa.current_stock = stk";
            // $this->db->query($qry);
        }
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('inventory_master/item/list_all');
    }
    public function uploadvideo()
    {

        $this->item->upload_video();
        
    }

	function view_item($id){
		$data['title'] = 'Item';
		$data['id'] = $id;
		$data['item_details'] = $this->item->item_details($id);
		$data['stock'] = $this->item->item_stock($id);
		$data['item_transaction'] = $this->item->item_transaction($id);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$this->load->view('inventory_master/item/view', $data);
	}
    function itemuploads($file, $fileid)
    {
        $config['upload_path'] = 'uploads/video/item/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '10240'; //1 MB            
        $this->load->library('upload', $config);
        $this->upload->do_upload($fileid);
        return;
    }

    public function deleteImage($file)  
    {
        $this->item->deleteImage($file);
    }

    public function upload()
    {
        $cookie_str = '';
        $target_dir = "uploads/images/item";
        $target_file = $target_dir;
        $image = '';
        $insert_id = $this->input->post('ins_id');
        try {
            $images = Slim::getImages();
            $toplogo = $images[0];
            $name = $toplogo['output']['name'];
            $name = str_replace(" ","_",$name);
            $name = str_replace("(","",$name);
            $name = str_replace(")","",$name);
            print_r($name);
            $data = $toplogo['output']['data'];
            $output = Slim::saveFile($data, $name, $target_dir);
            $image = $output['path'];
            $file_name = $output['name'];
            $this->item->insert_image($insert_id, 'image', $file_name);
        } catch (Exception $e) {
        }
    }
    function save()
    {
        $this->item->save();
    }
    public function allImages($item_id)
    {
        $this->item->allImages($item_id);
    }

    public function allVideos($item_id) 
    {
        $this->item->allVideos($item_id);
    }
    public function allUrl($item_id)
    {
        $this->item->allUrl($item_id);
    }

    function create($id = 0, $type = 'create')
    {
		$login_comid = $this->session->userdata('login_base_comid');
		$data['login_comid'] = $login_comid; 
        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $itemtype = $this->item->Itemtype();
        $settings = $this->item->getCompanySettings();
        $data['settings'] = $settings;
        $data['itemtype'] = $itemtype;
        $data['id'] = $id;
        $data['view'] = $type;
		$qry = "select * from itemtypemaster";
		$data['itemtypemaster'] =  $this->db->query($qry)->result_array();
        $this->load->view('inventory_master/item/create', $data);
    }

    public function checkItemName()
    {
        $this->item->checkItemName();
    }

    public function ajax_list()
    {
        $this->item->where();
        $list = $this->item->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->barcode;
            $row[] = $item->hsn;
            $row[] = $item->itemname;
            $row[] = $item->category;
            $row[] = $item->prate;
            $row[] = $item->landing_cost;
            $row[] = $item->salerate;
            $row[] = $item->MRP;
            $row[] = $item->total;
            $act = '<a  href="' . base_url() . 'inventory_master/Item/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'inventory_master/Item/bill/' . $item->id . '" title="Print Barcode"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>
                    <a  href="' . base_url() . 'inventory_master/Item/printlist/' . $item->id . '/' . $item->unit_id . '" title="Multiple Barcode" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-modal-window"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'inventory_master/Item/view_item/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            if ($itemcount == 0) {
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'inventory_master/Item/listall/' . '"  success="Delete ' . $item->itemname . ' successfuly "  message="Do you want Delete ' . $item->itemname . '?"  href="' . base_url() . 'inventory_master/Item/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function barcode_print($id = 0) {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('inventory/items/print_barcode', $data);
    }

    public function getitembarcode($id) {
        return $this->item->getitembarcode($id);
    }

    public function printlist($item_id, $unit_id) {
        $data['units'] = $this->item->getunits($unit_id);
        $data['id'] = $item_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/printlist', $data);
    }
	
    function editbarcode($id, $unit_id) {
        $data['id'] = $id;
        $data['unit_id'] = $unit_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('items/editbarcode', $data);
    }

    public function getbarcode() {
        return $this->item->getbarcode();
    }

    function getsing($id) {
        $this->item->getsing($id);
    }

    function check_barcode($id) {
        $this->item->check_barcode($id);
    }

    function godownitem($id) {
        $this->item->getgodownitem($id);
        // echo json_encode($result);
    }

    function item_spec($id) {
        $this->item->item_spec($id);
        // echo json_encode($result);
    }

    function otheritem($id) {
        $this->item->getotheritem($id);
        // echo json_encode($result);
    }

    function allgodown() {
        $this->item->getallgodown();
    }

    function gettaxldg($id) {
        $this->item->gettaxldg($id);
    }

    public function taxldg_find($type) {
        $search = strtolower($_GET['term']);
        return $this->item->taxldg_find($search, $type);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $data['tags'] = $this->item->getalltags();
        $data['tags_items'] = $this->item->tag_items($id);
        $data['isbatch'] = $this->getKey('isbatch');
        $settings = $this->item->getCompanySettings();
        $itemtype = $this->item->Itemtype();
        $data['itemtype'] = $itemtype;
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('inventory/items/create', $data);
    }
	
	function getfeature(){
		$this->item->getfeature();
	}

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $data['tags'] = $this->item->getalltags();
        $data['tags_items'] = $this->item->tag_items($id);
        $data['isbatch'] = $this->getKey('isbatch');
        $settings = $this->item->getCompanySettings();
        $itemtype = $this->item->Itemtype();
        $data['itemtype'] = $itemtype;
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'view';
		$qry = "select * from itemtypemaster";
		$data['itemtypemaster'] =  $this->db->query($qry)->result_array();
        $this->load->view('inventory/items/create', $data);
    }

    public function delete($id) {
        $this->item->delete($id);
    }

    public function barcode_list() {
        $this->item->barcode();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $count = 1;
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            if ($no < 2) {
                $name = $item->name;
                $sid = $item->sid;
            } else {
                $count = $count * $item->unit_count;
                $item->srate = $item->srate * $count;
                if ($item->sid === 0) {
                    $item->irate = 'add rate';
                }
            }
            $row = array();
            $row[] = $no;
            $row[] = $name;
            $row[] = $item->unit;
            $row[] = $count;
            $row[] = $item->irate;
            $row[] = $item->item_barcode;
            $act = '<a  href="' . base_url() . 'inventory/item/editbarcode/' . $sid . '/' . $item->uid . '" title="Edit" data-toggle="Change Barcode" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a><span></span><a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'inventoryitem/bill/' . $sid . '/' . $item->id . '" title="Print Barcode"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function savebarcode() {
        $this->item->savebarcode();
    }



    function printbarcode() {
        $insert_id = $this->item->printbarcode();
        $this->barcodedata = $insert_id;
        $response = array(
            'valid' => false,
            'type' => 1,
            'bill' => base_url() . 'item/print_item_barcode/' . $insert_id,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

	
     function bill1($id,$uid=0) {
		$tmp = $this->session->userdata('user');
		$address = $tmp['user_address'];
        $uid = 0 ;
        $this->load->library('Pdf');
        $pdf = new TCPDF("L", "mm", array(103, 25), true, 'UTF-8', false);
        $pdf->SetMargins(0, 0, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $settings = $this->item->getCompanySettings();
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $date = date("ny");
        $data = $this->item->getpitem($id,$uid)[0];
        //print_r($data);
        for ($i = 0; $i < 1; $i++) {
            $pdf->AddPage();
            $style = array(
                //'border' => true,
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => array(255, 255, 255),
                ///'text' => true,
                'font' => 'helvetica',
                'fontsize' => 8,
                'stretchtext' => 4
            );
            $date ='';
            $data['name'] =$result = substr($data['name'], 0, 22);

            $html = '<table margin="2" cellpadding="0" cellspacing="3">
              <tr>
              <td style="text-align:Center;">
             <b style="font-size: 10px;">'.$address.'</b> <br/>
            <b style="font-size: 10px;">' . $data['name'] . ',' . $data['barcode'] . ' ' . $date . ' </b> <br/> 
            <b style="font-size: 11px;font-weight:bold"> MRP:₹' . $data['MRP'] . ' </b>  
              ' . $pdf->write1DBarcode($data['barcode'], 'C39', '5', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              <td style="text-align:Center;">
              <b style="font-size: 10px;">'.$address.'</b> <br/>
            <b style="font-size: 10px;">' . $data['name'] . ',' . $data['barcode'] . '' . $date . ' </b> <br/> 
            <b style="font-size: 11px;font-weight:bold"> MRP:₹' . $data['MRP'] . ' </b>  
              ' . $pdf->write1DBarcode($data['barcode'], 'C39', '60', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              </tr>
              </table>'; /*  for walk liineEAN13 */
            /* $html = '<table margin="2" cellpadding="1" cellspacing="2">
              <tr>
              <td style="text-align:Center;">
              <b style="font-size: small;">Dimind Innovations</b> <br/>
              <b style="font-size: x-small;">' . $data['name'] . '-A214s </b> <br/>
              <b style="font-size: small;">Rate :₹245.' . $data['MRP'] . ' MRP:₹232.' . $data['MRP'] . ' </b>
              ' . $pdf->write1DBarcode('2jk14s', 'C39', '5', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              <td style="text-align:Center;">
              <b style="font-size: small;">Dimind Innovations</b> <br/>
              <b style="font-size: x-small;">' . $data['name'] . '-A214s </b> <br/>
              <b style="font-size: small;">Rate :₹245.' . $data['MRP'] . ' MRP:₹232.' . $data['MRP'] . ' </b>
              ' . $pdf->write1DBarcode('2a14s', 'C39', '60', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              </tr>
              </table>';/*  for JK */
            $pdf->writeHTML($html, false, false, false, false, '');
        }
        $pdf->Output('example_021.pdf', 'I');
    }
function billsvs($id,$uid=0){
	
			 $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' => 2,'margin_right' => 0, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $pdf->SetDirectionality('ltr');
		$settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
		$data = $this->item->getpitem($id,$uid)[0];
		$html = '<style>body{
                font-family: sans-serif;
           }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;padding-left:2px;">
							<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
							<td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:30px;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="font-weight:bold;padding-left:14px;font-size:12px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							<td style="font-weight:bold;font-size:12px;line-height:8px;width:50.5%;padding-left:30px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:14px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1.3" text="1" /></td>
							<td style="padding-left:30px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1.3" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="padding-left:14px;font-size:10px;line-height:5px;">'.$data['barcode'].'</td>
							
							
							<td colspan="4" style="font-size:10px;line-height:5px;padding-left:28px;">'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="2" style="padding-left:14px;font-size:11px;line-height:8px;">MRP:'.$data['MRP'].'   </td>
							<td colspan="2" style="font-size:11px;padding-right:11px !important;">Rate:'.$data['srate'].'</td>
							
							<td colspan="2" style="font-size:11px;line-height:8px;padding-left:30px;">MRP:'.$data['MRP'].'  </td>
							<td colspan="2" style="font-size:11px;padding-right:10px !important;">Rate:'.$data['srate'].'</td>	
						</tr>
                    </table>
                    <table>
                   
                    </table>';
					  $pdf->writeHTML($html);
					    $pdf->Output('example_021.pdf', 'I');
}


function billaakaar($id,$uid=0){
    $paddingtext = '14';
    
	$login_comid = $this->session->userdata('login_base_comid');
    $margin_top = 5;

    if(strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  || strtolower($login_comid) == 'seasons' ){
        $margin_top = 1;
    }
    $tp = "C93";
    $this->load->library('M_pdf');
    if(strtolower($login_comid) == 'aakaar' || strtolower($login_comid) == 'cochinsilks'){
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' => 6,'margin_right' => 0, 'autoPageBreak' => TRUE];

    }else if( strtolower($login_comid) === 'kideez' ){
        $tp = "C39";
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>1,'margin_right' => 0, 'autoPageBreak' => TRUE];

    }else if(strtolower($login_comid) === 'senzation'  || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone' ){
        $tp = "C39";
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>0,'margin_right' => 0, 'autoPageBreak' => TRUE];

    }else if(strtolower($login_comid) === 'fashion'  || strtolower($login_comid) == 'seasons' || strtolower($login_comid) == 'ssaluva' ){
        $tp = "C39";
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>$margin_top,'margin_right' => 0, 'margin_left' => 7,'autoPageBreak' => TRUE];
    }else if(strtolower($login_comid) === 'kuppayam'  ){
        $tp = "C39";
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>$margin_top,'margin_right' => 0, 'margin_left' => 5,'autoPageBreak' => TRUE];
    }else{
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>6,'margin_right' => 0, 'autoPageBreak' => TRUE];
    }
    $paddingbarcode = $paddingtext;
    if(strtolower($login_comid) === 'kideez'){
        $paddingtext = '18';
        $paddingbarcode = '23';
    }

  


$this->m_pdf->load();
$pdf = $this->m_pdf->pdf;
$this->language = "ac";
$this->lang->load('ac_site', 'ac');
$pdf->SetDirectionality('ltr');
$settings = $this->item->getCompanySettings();
$address = $settings[0]['name'];
$address ='UF20 JEANS CO.';
if(strtolower($login_comid) === 'senzation'  || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'seasons' || strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  || strtolower($login_comid) === 'ssaluva'   || strtolower($login_comid) === 'boyszone' ){
    $address = $settings[0]['name'];
}
$qry ="select IFNULL(b.`code`,'') AS CODE ,case when RIGHT(YEAR(DATE),2 ) = 0 then '' ELSE RIGHT(YEAR(DATE),2 ) END  AS year  FROM item AS a LEFT  JOIN suppliers AS b ON a.supplier_id = b.id where a.id = ".$id;
$supdata = $this->db->query($qry)->row_array();
$mtext = '';
if($supdata['CODE'] != ''){
    $mtext = $supdata['CODE'];
}
if($supdata['year'] != ''){
    $mtext =  $mtext.$supdata['year'];
}
if($mtext !=''){
    $mtext = ' - '.$mtext;
}

$data = $this->item->getpitem($id,$uid)[0];
$iname = $data['name'];
if(strtolower($login_comid) == 'kideez' ){
    $iname = substr($iname, 0, 18);
}
if(strtolower($login_comid) == 'aakaar' ){
    $address ='AAKAAR';
    $iname =  $data['cat'];
}

if(strtolower($login_comid) == 'cochinsilks' ){
    $iname =  $data['cat'];
     $address ='Cochin Silks';
}


if(strtolower($login_comid) == 'boyszone' ){
    $iname =  $data['cat'];
}
$font = '12px';
$mrptext = 'MRP Rs :'.$data['MRP'].' ';
if(strtolower($login_comid) === 'seasons'     || strtolower($login_comid) === 'fashion'  || strtolower($login_comid) === 'ssaluva'){
   $mrptext = 'Price :'.$data['srate'].' ';
}
if( strtolower($login_comid) === 'kuppayam'){
    $mrptext = 'Price :'.$data['MRP'].' ';
}
$html = '<style>body{
       font-family: sans-serif;
  }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
               
               <tr style="papadding-top:0px;padding-left:2px;">
                   <td style="padding-top:0px;line-height:6px;width:49.5%;text-align:left;padding-left:'.$paddingtext.'px;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                   <td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:9px;text-align:left;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
               </tr>
         
               <tr>
                   <td colspan = "4"><barcode  style="padding-left:'.$paddingbarcode.'px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".7" type="'.$tp.'" height="1" text="1" /></td>
                   <td style="padding-left:10px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".7" type="'.$tp.'" height="1" text="1" /></td>
               </tr>
               <tr>
               <td colspan="4" style="padding-left:'.$paddingtext.'px;font-size:10px;line-height:5px;"><b>'.$data['barcode'].$mtext.' &nbsp;&nbsp;'.$data['lcode'].'</b></td>
               
               
               <td colspan="4" style="font-size:10px;line-height:5px;padding-left:8px;"><b>'.$data['barcode'].$mtext.' &nbsp;&nbsp;'.$data['lcode'].' </b></td>
               
           </tr>
            <tr>
               <td style="font-weight:bold;padding-left:'.$paddingtext.'px;font-size:12px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$iname.'</b></td>
               <td style="font-weight:bold;font-size:12px;line-height:8px;width:50.5%;padding-left:9px;" colspan = "4"><b>'.$iname.'</b></td>
           </tr>  
             
               <tr>
                   <td colspan="4" style="padding-left:'.$paddingtext.'px;font-size:'.$font.';line-height:8px;"><b>'.$mrptext.'   </b> </td>
                   
                   <td colspan="4" style="font-size:'.$font.';line-height:8px;padding-left:9px;"><b>'.$mrptext.'   </b></td>
               </tr>
           </table>
           <table>
          
           </table>';
             $pdf->writeHTML($html);
               $pdf->Output('example_021.pdf', 'I');
}


function billuf20($id,$uid=0){
	
    $this->load->library('M_pdf');
    if(strtolower($login_comid) == 'aakaar'){
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0, 'autoPageBreak' => TRUE];

    }else{
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>1,'margin_right' => 0, 'autoPageBreak' => TRUE];
    }
$this->m_pdf->load();
$pdf = $this->m_pdf->pdf;
$this->language = "ac";
$this->lang->load('ac_site', 'ac');
$pdf->SetDirectionality('ltr');
$settings = $this->item->getCompanySettings();
$address = $settings[0]['name'];
$login_comid = $this->session->userdata('login_base_comid');
$address ='UF20 JEANS CO.';


$data = $this->item->getpitem($id,$uid)[0];
$iname = $data['name'];
if(strtolower($login_comid) == 'aakaar'){
    $address ='AAKAAR';
    $iname =  $data['cat'];
}
$html = '<style>body{
       font-family: sans-serif;
  }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
               
               <tr style="papadding-top:0px;padding-left:2px;">
                   <td style="padding-top:0px;line-height:6px;width:49.5%;text-align:left;padding-left:14px;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                   <td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:9px;text-align:left;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
               </tr>
         
               <tr>
                   <td colspan = "4"><barcode  style="padding-left:14px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1" text="1" /></td>
                   <td style="padding-left:10px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1" text="1" /></td>
               </tr>
               <tr>
               <td colspan="4" style="padding-left:14px;font-size:10px;line-height:5px;"><b>'.$data['barcode'].' </b></td>
               
               
               <td colspan="4" style="font-size:10px;line-height:5px;padding-left:8px;"><b>'.$data['barcode'].' </b></td>
               
           </tr>
            <tr>
               <td style="font-weight:bold;padding-left:14px;font-size:12px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$iname.'</b></td>
               <td style="font-weight:bold;font-size:12px;line-height:8px;width:50.5%;padding-left:9px;" colspan = "4"><b>'.$iname.'</b></td>
           </tr>  
             
               <tr>
                   <td colspan="4" style="padding-left:14px;font-size:12px;line-height:8px;"><b>MRP RS :'.$data['MRP'].'   </b> </td>
                   
                   <td colspan="4" style="font-size:12px;line-height:8px;padding-left:9px;"><b>MRP RS :'.$data['MRP'].'  </b></td>
               </tr>
           </table>
           <table>
          
           </table>';
             $pdf->writeHTML($html);
               $pdf->Output('example_021.pdf', 'I');
}


function billvismaya($id,$uid=0) {
		 $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(85, 28), 'margin_bottom' => 0,'margin_top' => 2,'margin_right' => 0,'margin_left' => 0, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $pdf->SetDirectionality('ltr');
		$settings = $this->item->getCompanySettings();
		$address = 'VISMAYA';
		$data = $this->item->getpitem($id,$uid)[0];
		$data['name'] = substr($data['name'], 0, 20);
		$html = '<style>body{
                font-family: sans-serif;
           }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;">
							<td style="padding-top:0px;padding-right:30px;line-height:6px;width:49.5%;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
							
							<td style="padding-top:0px;padding-right:30px;line-height:8px;width:50.5%;padding-left:0px;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="padding-left:25px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							
							<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:2px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:33px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
							
							<td style="padding-left:10px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
							
							
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="4" style="padding-left:25px;font-size:10px;line-height:8px;"><b>MRP:'.$data['MRP'].'   &nbsp;&nbsp;Rate:'.$data['srate'].' <br /><br /> '.$data['ibr_name'].'</b> </td>
							
							<td colspan="4" style="font-size:10px;line-height:8px;padding-left:0px;"><b>MRP:'.$data['MRP'].'  &nbsp;&nbsp; Rate:'.$data['srate'].'<br /><br /> '.$data['ibr_name'].'  </b></td>
						</tr>
						
                    </table>
                    <table>
                   
                    </table>';
					ob_end_clean();
					 $pdf->AddPage();
					  $pdf->writeHTML($html);
						
					    $pdf->Output('example_021.pdf', 'I');
									//ob_end_clean();


}

function billkabini($id,$uid=0) {
    $this->load->library('M_pdf');
    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(103.9876, 50.8), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
    $this->m_pdf->load();
    $pdf = $this->m_pdf->pdf;
    $this->language = "ac";
    $this->lang->load('ac_site', 'ac');
    $pdf->SetDirectionality('ltr');
    $settings = $this->item->getCompanySettings();
    $address = $settings[0]['name'];
    $data = $this->item->getpitem($id,$uid)[0];
    $data['name'] = substr($data['name'], 0, 20);
    $html = '<style>body{
            font-family: sans-serif;
            
       }</style><table  class ="clstble" style="padding-top:5px ;padding-left:15px;cellpadding:0px;width:100%">
                    
                    <tr style="papadding-top:0px;">
                        <td style="padding-top:0px;line-height:6px;width:49.5%;text-align:left;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
                        <td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:0px;text-align:left;font-size: 10px;font-weight:bold;padding-right:30px" colspan="4">'.$address.'</td>
                    </tr>
                    <tr>
                        <td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                        <td style="font-size:8px;line-height:8px;width:50.5%;padding-left:10px;" colspan = "4"><b>'.$data['name'].'</b></td>
                    </tr>           
                    <tr>
                        <td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
                        <td style="padding-left:0px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;padding-left:10px;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                        
                        
                        <td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;padding-left:10px;"><b>'.$data['barcode'].'</td>
                        
                    </tr>
                   
                    <tr>
                        <td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;"><b> Price:'.$data['srate'].'</b>   </td>							
                        <td colspan="4" style="font-size:11px;line-height:8px;padding-left:10px;"><b> Price:'.$data['srate'].' </b> </td>
                    </tr>
                </table>
                <table>
               
                </table>';
                  $pdf->writeHTML($html);

                    $pdf->Output('example_021.pdf', 'I');
                                ob_end_clean();



}


function billplaystore($id,$uid=0) {
		$this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(103.9876, 50.8), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $pdf->SetDirectionality('ltr');
		$settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
		$data = $this->item->getpitem($id,$uid)[0];
		$data['name'] = substr($data['name'], 0, 20);
		$html = '<style>body{
                font-family: sans-serif;
				
           }</style><table  class ="clstble" style="padding-top:5px ;padding-left:15px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;">
							<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
							<td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:0px;text-align:center;font-size: 10px;font-weight:bold;padding-right:30px" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:10px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
							<td style="padding-left:0px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;padding-left:10px;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
							
							
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;padding-left:10px;"><b>'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;">MRP:'.$data['MRP'].'   </td>							
							<td colspan="4" style="font-size:11px;line-height:8px;padding-left:10px;">MRP:'.$data['MRP'].'  </td>
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;"><b> Price:'.$data['srate'].'</b>   </td>							
							<td colspan="4" style="font-size:11px;line-height:8px;padding-left:10px;"><b> Price:'.$data['srate'].' </b> </td>
						</tr>
                    </table>
                    <table>
                   
                    </table>';
					  $pdf->writeHTML($html);

					    $pdf->Output('example_021.pdf', 'I');
									ob_end_clean();



}



function billhanger($id,$uid=0) {
		 $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' => 3,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $pdf->SetDirectionality('ltr');
		$settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
		$data = $this->item->getpitem($id,$uid)[0];
		$data['name'] = substr($data['name'], 0, 20);
		$html = '<style>body{
                font-family: sans-serif;
           }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;">
							<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
							<td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:17px;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:26px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
							<td style="padding-left:34px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
							
							
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;">MRP:'.$data['MRP'].'   </td>							
							<td colspan="4" style="font-size:11px;line-height:8px;padding-left:32px;">MRP:'.$data['MRP'].'  </td>
						</tr>
						
                    </table>
                    <table>
                   
                    </table>';
					ob_end_clean();
					  $pdf->writeHTML($html);
						
					    $pdf->Output('example_021.pdf', 'I');
									//ob_end_clean();


}



function billsvt($id,$uid=0) {
		 $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(110, 24.9), 'margin_bottom' => 0,'margin_top' => 2,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $pdf->SetDirectionality('ltr');
		$settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
		$data = $this->item->getpitem($id,$uid)[0];
		$data['name'] = substr($data['name'], 0, 20);
		$length  = strlen($data['barcode']);
		$qry = "select * from item_godown where item_id = ".$id."  and item_srate > 0  order by id desc limit 0,1";
		$res = $this->db->query($qry);
		if($res->num_rows() > 0 ){
			$res = $res->row_array();
			if((float) $res['item_srate'] > 0  ){
				$data['srate'] = $res['item_srate'];
			}
			
			if((float) $res['item_mrp'] > 0  ){
				$data['MRP'] = $res['item_mrp'];
			}
		}
		if($length < 5){
			$size = .8;
			$height = .8;
			$typeb = 'C39';
		}else{
			$size = .8;
			$height = 1.2;
			$typeb = 'C93';
		}
		$html = '<style>body{
                font-family: sans-serif;
           }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;">
							<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
							<td style="padding-top:0px;line-height:7px;width:50.5%;padding-left:15px;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="padding-left:35px;font-size:8px;line-height:5px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							<td style="font-size:8px;line-height:5px;width:50.5%;padding-left:30px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size="'.$size.'" type="'.$typeb.'" height="'.$height.'" text="1" /></td>
							<td style="padding-left:32px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size="'.$size.'" type="'.$typeb.'" height="'.$height.'" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
							
							
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:8px;line-height:5px;"><b>MRP:'.$data['MRP'].'</b>   </td>							
							<td colspan="4" style="font-size:8px;line-height:5px;padding-left:30px;"><b>MRP :'.$data['MRP'].' </b> </td>
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:8px;line-height:5px;"> <b>mfg: ' . $data['mfg_date'] . ', exp: ' . $data['exp_date'] . '  </b> </td>							
							<td colspan="4" style="font-size:8px;line-height:5px;padding-left:30px;"> <b>mfg: ' . $data['mfg_date'] . ', exp: ' . $data['exp_date'] . ' </b>  </td>
						</tr>
						
                    </table>
                    <table>
                   
                    </table>';
					  $pdf->writeHTML($html);

					    $pdf->Output('example_021.pdf', 'I');
									//ob_end_clean();


}
function billmjs($id,$uid=0) {
		 $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(78, 25), 'margin_bottom' => 0,'margin_top' => 2,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $pdf->SetDirectionality('ltr');
		$settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
		$data = $this->item->getpitem($id,$uid)[0];
		$data['name'] = substr($data['name'], 0, 20);
		$length  = strlen($data['barcode']);
		$qry = "select * from item_godown where item_id = ".$id."  and item_srate > 0  order by id desc limit 0,1";
		$res = $this->db->query($qry);
		if($res->num_rows() > 0 ){
			$res = $res->row_array();
			if((float) $res['item_srate'] > 0  ){
				$data['srate'] = $res['item_srate'];
			}
			
			if((float) $res['item_mrp'] > 0  ){
				$data['MRP'] = $res['item_mrp'];
			}
		}
		if($length < 5){
			$size = .8;
			$height = .8;
			$typeb = 'C39';
		}else{
			$size = .8;
			$height = 1.2;
			$typeb = 'C93';
		}
		$html = '<style>body{
                font-family: sans-serif;
           }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;">
							<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
							<td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:17px;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:32px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size="'.$size.'" type="'.$typeb.'" height="'.$height.'" text="1" /></td>
							<td style="padding-left:34px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size="'.$size.'" type="'.$typeb.'" height="'.$height.'" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
							
							
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;">MRP:'.$data['MRP'].'   </td>							
							<td colspan="4" style="font-size:11px;line-height:8px;padding-left:32px;">MRP:'.$data['MRP'].'  </td>
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:12px;line-height:8px;"><b>Fair Price:'.$data['srate'].'</b>   </td>							
							<td colspan="4" style="font-size:12px;line-height:8px;padding-left:32px;"><b>Fair Price:'.$data['srate'].' </b> </td>
						</tr>
                    </table>
                    <table>
                   
                    </table>';
					  $pdf->writeHTML($html);

					    $pdf->Output('example_021.pdf', 'I');
									//ob_end_clean();


}

function bill_aditi($id,$uid=0) {
	$tmp = $this->session->userdata('user');
		$address = $tmp['user_address'];
        $uid = 0 ;
        $this->load->library('Pdf');
        $pdf = new TCPDF("L", "mm", array(95, 28), true, 'UTF-8', false);
        $pdf->SetMargins(17, 0, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $date = date("ny");
        $data = $this->item->getpitem($id,$uid)[0];
        //print_r($data);
        for ($i = 0; $i < 1; $i++) {
            $pdf->AddPage();
            $style = array(
                //'border' => true,
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => array(255, 255, 255),
                ///'text' => true,
                'font' => 'helvetica',
                'fontsize' => 8,
                'stretchtext' => 4
            );
            $date ='';
            $data['name'] =$result = substr($data['name'], 0, 22);

            $html = '<table style="" margin="0" cellpadding="0" cellspacing="2">
              <tr>
				<td style="font-size:5px;text-align:center" colspan="2">
					<b>'.$address.'</b>
				</td>
				<td style="font-size:5px;text-align:center" colspan="2">
					<b>'.$address.'</b>
				</td>
              </tr>
			   <tr>
				<td colspan="2" >
					' . $pdf->write1DBarcode($data['barcode'], 'C128B', '16', '2', '40', 9, 0.4, $style, 'L') . '
				</td>
				<td colspan="2" style="padding-left:10px;">
					' . $pdf->write1DBarcode($data['barcode'], 'C128A', '55', '2', '40', 9, 0.4, $style, 'L') . '
				</td>
			   </tr>
			   <tr>
					<td style="padding-top:5px;font-size:6px;text-align:center;" colspan="2">' . $data['name'] . '(' . $data['barcode'] . ')</td>
					<td style="padding-top:5px;font-size:6px;text-align:center;" colspan="2">' . $data['name'] . '(' . $data['barcode'] . ')</td>
			   </tr>
			   <tr>
				<td style="font-size:9px;text-align:center;"><b>₹' . $data['MRP'] . '</b></td>
				<td style="font-size:9px;text-align:center;"><b>' . $data['cat'] . '</b></td>
				<td style="font-size:9px;text-align:center;"><b>₹' . $data['MRP'] . '</b></td>
				<td style="font-size:9px;text-align:center;"><b>' . $data['cat'] . '</b></td>
			   </tr>
			   <tr>
					<td style="font-size:6px;text-align:center;" colspan="2">PKD :' . $data['mfg'] . '</td>
					<td style="font-size:6px;text-align:center;" colspan="2">PKD : ' . $data['mfg'] . '</td>
			   </tr>
              </table>'; /*  for walk liineEAN13 */

            $pdf->writeHTML($html, false, false, false, false, '');
        }
        $pdf->Output('example_021.pdf', 'I');

}

function billftfa2($id,$uid=0,$batch ="",$mrp = 0){
    $pad ='35px';
    $txt = '';
    $font ='12px';
    $fontitem = '8px';
    $hgt = '1.1';
    if(strtolower($this->session->userdata('login_base_comid')) =='msa' ){
        $font ='7px';
        $hgt = '.9';
        $fontitem = '6px';
        $pad = "12px";
    }
    $this->load->library('M_pdf');
    if(strtolower($this->session->userdata('login_base_comid')) =='everest'){
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(76, 25), 'margin_bottom' => 0,'margin_top' => -1.5,'margin_right' => 0,'margin_left' => 0, 'autoPageBreak' => TRUE];
    }else{
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => -2,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
    }
    $this->m_pdf->load();
    $pdf = $this->m_pdf->pdf;
    $this->language = "ac";
    $this->lang->load('ac_site', 'ac');
    $pdf->SetDirectionality('ltr');
    $settings = $this->item->getCompanySettings();
    $address = $settings[0]['name'];
    if(strtolower($this->session->userdata('login_base_comid')) =='mrlk'){
        $address  ='MRL KUTTANADAN';
    }
    $data = $this->item->getpitem($id,$uid)[0];
    if($data['exp_d'] !='' && (strtolower($this->session->userdata('login_base_comid')) =='everest' || strtolower($this->session->userdata('login_base_comid')) =='mrlk' || strtolower($this->session->userdata('login_base_comid')) =='msa' )){
        $txt = '<tr>
                                    <td colspan="4" style="padding-left:0px;font-size:8px;line-height:8px;"><b>Pkd:'.$data['mfg_d'].',Exp :'.$data['exp_d'].' <b></td>							
                                    <td colspan="4" style="font-size:8px;line-height:8px;padding-left:5px;"><b>Pkd:'.$data['mfg_d'].',Exp :'.$data['exp_d'].' <b> </td>
                                </tr>';
    }
    $data['name'] = substr($data['name'], 0, 20);
    $price_text = '&nbsp;&nbsp;Price:'.$data['srate'];
    $namemsa = '';
    $nameitem = $data['name'];;
    if(strtolower($this->session->userdata('login_base_comid')) =='msa' ){
        $price_text ='';
        $namemsa = $data['name'];
        $nameitem = 'CC 230531 fssai: 11312006000198';

    }
       $barcodes = $data['barcode'];
            $barcodes = str_replace("Y","",$barcodes);
            $pleft = 0;
            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 1000 ){
                    $pleft = 12;
                };
            }

            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 100 ){
                    $pleft = 12;
                }
            }
            if(is_numeric($barcodes) ){
                if((int) $barcodes < 10 ){
                    $pleft = 22;
                }
            }
            if($mrp > 0 ){
                $data['MRP'] = $mrp;
            }
            $text = '  <tr><td style="padding-left:12px;font-size:'.$fontitem.';line-height:8px;width:49.5%;" colspan = "4"><b>'.$nameitem.'</b></td>
<td style="font-size:8px;line-height:'.$fontitem.';width:50.5%;padding-left:18px;" colspan = "4"><b>'.$nameitem.'</b></td>
                                </tr>        ';
                                if(strtolower($this->session->userdata('login_base_comid')) =='msa' ){

                                    $text = '  <tr><td style="padding-left:6px;font-size:'.$fontitem.';line-height:8px;width:49.5%;" colspan = "4"><b>'.$nameitem.'</b></td>
                                    <td style="font-size:6px;line-height:'.$fontitem.';width:50.5%;padding-left:12px;" colspan = "4"><b>'.$nameitem.'</b></td>
                                                                    </tr>        ';
                                }                        
            $html ='<style>body{
                        font-family: sans-serif;
                   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                
                                <tr style="papadding-top:0px;">
                                    <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: '.$font.';font-weight:bold" colspan="4">'.$address.'</td>
                                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:17px;text-align:left;font-size: '.$font.';font-weight:bold" colspan="4">'.$address.'</td>
                                </tr>'.
                                $text .
                               ' <tr>
                                    <td  style="padding-left:'.$pad.';" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="'.$hgt .'" text="1" /></td>
                                    <td style="padding-left:'.$pad.';" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="'.$hgt .'" text="1" /></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:'.$pad.';text-align:left;font-size:7px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].' '.$namemsa.'</b></td>
                                    
                                    
                                    <td colspan="4" style="padding-left:'.$pad.';text-align:left;font-size:7px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].' '.$namemsa.'</td>
                                    
                                </tr>
                                '.$txt.'
                                <tr>
                                    <td colspan="4" style="padding-left:4px;line-height:8px;"><b><font style ="font-size:10px;" ><font style ="font-size:8px;" >MRP:'.$data['MRP'].' &nbsp;&nbsp;'.$batch.'  </font>'.$price_text.'</font> <b></td>							
                                    <td colspan="4" style="line-height:8px;padding-left:5px;"><b><font style ="font-size:8px;" >MRP:'.$data['MRP'].' &nbsp;&nbsp;'.$batch.' <b></font><font style ="font-size:10px;" >'.$price_text.'</font> </td>
                                </tr>
                                
                            </table>
                           ';


                           $login_comid = $this->session->userdata('login_base_comid');
                            if(strtolower($login_comid) == 'palack'){
                           $html ='<style>body{
                            font-family: sans-serif;
                       }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                    
                                    <tr style="papadding-top:0px;">
                                        <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 13px;font-weight:bold" colspan="4"><br />'.$address.'</td>
                                        <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:17px;text-align:left;font-size: 13px;font-weight:bold" colspan="4"><br />'.$address.'</td>
                                    </tr>
                                         
                                    <tr>
                                        <td colspan = "4"><barcode  style="padding-left:10px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1.5" text="1" /></td>
                                        <td style="padding-left:29px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1.5" text="1" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                                        
                                        
                                        <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                                        
                                    </tr>
                                  
                                </table>
                               ';
                            }
                     $pdf->writeHTML($html);

                       $pdf->Output('example_021.pdf', 'I');
                                   //ob_end_clean();


}

function billideal($id,$uid=0){
    $this->load->library('M_pdf');
       $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(103.124, 27), 'margin_bottom' => 0,'margin_top' => -1.95,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
       $this->m_pdf->load();
       $pdf = $this->m_pdf->pdf;
       $this->language = "ac";
       $this->lang->load('ac_site', 'ac');
       $pdf->SetDirectionality('ltr');
       $settings = $this->item->getCompanySettings();
       $address = $settings[0]['name'];
       $data = $this->item->getpitem($id,$uid)[0];
       $data['name'] = substr($data['name'], 0, 20);
       $barcodes = $data['barcode'];
            $barcodes = str_replace("Y","",$barcodes);
            $pleft = 0;
            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 1000 ){
                    $pleft = 10;
                }
            }

            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 100 ){
                    $pleft = 10;
                }
            }
            if(is_numeric($barcodes) ){
                if((int) $barcodes < 10 ){
                    $pleft = 25;
                }
            }
       $html = '<style>body{
        font-family: sans-serif;
   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                
                <tr style="papadding-top:0px;">
                    <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:center;font-size: 11px;font-weight:bold" colspan="4">'.$address.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:-1px;text-align:left;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                </tr>
                <tr>
                    <td style="padding-left:35px;font-size:10px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                    <td style="font-size:10px;line-height:10px;width:50.5%;padding-left:22px;" colspan = "4"><b>'.$data['name'].'</b></td>
                </tr>           
                <tr>
                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                    <td style="padding-left:'.$pleft.'px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                    
                    
                    <td colspan="4" style="padding-left:32px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:35px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:22px;"><b>Price:'.$data['srate'].' <b> </td>
                </tr>
                
            </table>
            <table>
           
            </table>';
                     $pdf->writeHTML($html);

                       $pdf->Output('example_021.pdf', 'I');
                                   //ob_end_clean();


}

function inworld($id,$uid=0){
    $this->load->library('M_pdf');
       $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0,'margin_left' => 3  , 'autoPageBreak' => TRUE];
       $this->m_pdf->load();
       $pdf = $this->m_pdf->pdf;
       $this->language = "ac";
       $this->lang->load('ac_site', 'ac');
       $pdf->SetDirectionality('ltr');
       $settings = $this->item->getCompanySettings();
       $address = $settings[0]['name'];
       $data = $this->item->getpitem($id,$uid)[0];
       $data['name'] = substr($data['name'], 0, 20);
       $barcodes = $data['barcode'];
            $barcodes = str_replace("Y","",$barcodes);
            $pleft = 0;
            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 1000 ){
                    $pleft = 10;
                }
            }

            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 100 ){
                    $pleft = 10;
                }
            }
            if(is_numeric($barcodes) ){
                if((int) $barcodes < 10 ){
                    $pleft = 20;
                }
            }
       $html = '<style>body{
        font-family: sans-serif;
   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                
                <tr style="papadding-top:0px;">
                    <td style="padding-left:15px;padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 12px;font-weight:bold" colspan="4">'.$address.'</td>
                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:0px;text-align:left;font-size: 12px;font-weight:bold" colspan="4">'.$address.'</td>
                </tr>
                <tr>
                    <td style="padding-left:15px;font-size:10px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                    <td style="font-size:10px;line-height:10px;width:50.5%;padding-left:0px;" colspan = "4"><b>'.$data['name'].'</b></td>
                </tr>           
                <tr>
                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                    <td style="padding-left:0px" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                    
                    
                    <td colspan="4" style="padding-left:0px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:20px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:0px;"><b>Price:'.$data['srate'].' <b> </td>
                </tr>
                
            </table>
            <table>
           
            </table>';
                     $pdf->writeHTML($html);

                       $pdf->Output('example_021.pdf', 'I');
                                   //ob_end_clean();


}


function billftfa($id,$uid=0){
    $this->load->library('M_pdf');
       $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(103.9876, 27), 'margin_bottom' => 0,'margin_top' => -2,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
       $this->m_pdf->load();
       $pdf = $this->m_pdf->pdf;
       $this->language = "ac";
       $this->lang->load('ac_site', 'ac');
       $pdf->SetDirectionality('ltr');
       $settings = $this->item->getCompanySettings();
       $address = $settings[0]['name'];
       $data = $this->item->getpitem($id,$uid)[0];
       $data['name'] = substr($data['name'], 0, 20);
       $barcodes = $data['barcode'];
            $barcodes = str_replace("Y","",$barcodes);
            $pleft = 0;
            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 1000 ){
                    $pleft = 10;
                }
            }

            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 100 ){
                    $pleft = 10;
                }
            }
            if(is_numeric($barcodes) ){
                if((int) $barcodes < 10 ){
                    $pleft = 20;
                }
            }
       $html = '<style>body{
        font-family: sans-serif;
   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                
                <tr style="papadding-top:0px;">
                    <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:right;font-size: 13px;font-weight:bold" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$address.'</td>
                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:3px;text-align:left;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
                </tr>
                <tr>
                    <td style="padding-left:35px;font-size:10px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                    <td style="font-size:10px;line-height:10px;width:50.5%;padding-left:25px;" colspan = "4"><b>'.$data['name'].'</b></td>
                </tr>           
                <tr>
                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                    <td style="padding-left:'.$pleft.'px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                    
                    
                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:35px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:32px;"><b>Price:'.$data['srate'].' <b> </td>
                </tr>
                
            </table>
            <table>
           
            </table>';
                     $pdf->writeHTML($html);

                       $pdf->Output('example_021.pdf', 'I');
                                   //ob_end_clean();


}

function billhugs($id,$uid=0){
	 $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => -2,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $pdf->SetDirectionality('ltr');
		$settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
		$data = $this->item->getpitem($id,$uid)[0];
		$data['name'] = substr($data['name'], 0, 20);
		$html = '<style>body{
                font-family: sans-serif;
           }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;">
							<td style="padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
							<td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:17px;text-align:left;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:32px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="1.5" text="1" /></td>
							<td style="padding-left:34px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="1.5" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
							
							
							<td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
							<td colspan="4" style="font-size:13px;line-height:8px;padding-left:32px;"><b>Price:'.$data['srate'].' <b> </td>
						</tr>
						
                    </table>
                    <table>
                   
                    </table>';
					  $pdf->writeHTML($html);

					    $pdf->Output('example_021.pdf', 'I');
									//ob_end_clean();


}


function billasr($id,$uid=0){
    		$login_comid = $this->session->userdata('login_base_comid');

    $this->load->library('M_pdf');
       $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 30), 'margin_bottom' => 0,'margin_top' => -3,'margin_right' => 0,'margin_left' => 10, 'autoPageBreak' => TRUE];
       $this->m_pdf->load();
       $pdf = $this->m_pdf->pdf;
       $this->language = "ac";
       $this->lang->load('ac_site', 'ac');
       $pdf->SetDirectionality('ltr');
       $settings = $this->item->getCompanySettings();
       $address = $settings[0]['name'];
       $data = $this->item->getpitem($id,$uid)[0];
       $data['name'] = substr($data['name'], 0, 20);
      $txt_brand ="";
       if($data['ibr_name'] != '' &&  $data['ibr_name'] != '' &&  $data['ibr_name'] != 'null' && $data['ibr_name'] != null && strtolower($login_comid) === 'krtraders'){
            $txt_brand = '<tr style="padding-top:0px;margin-top:0px;">
                           <td style="padding-top:10px;line-height:6px;width:50%;text-align:left;font-size: 10px;font-weight:bold" colspan="4">'.$data['ibr_name'].'</td>
                           <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:2px;text-align:left;font-size: 10px;font-weight:bold" colspan="4">'.$data['ibr_name'].'</td>
                       </tr>';
            // $txt_brand = '<tr style="padding-top:0px;margin-top:0px;">
            //                 <td style="padding-left:0px;font-size:10px;line-height:8px;width:50%;" colspan = "4"><b> '.$data['ibr_name'].'</b></td>
            //                 <td style="font-size:10px;line-height:10px;width:50%;padding-left:2px;" colspan = "4"><b> '.$data['ibr_name'].'</b></td>
            //            </tr>  ';
       }
       $html = '<style>body{
               font-family: sans-serif;
          }</style><table style="padding-top:0px;cellpadding:0px;width:100%">
                       '.$txt_brand.'
                       <tr style="padding-top:0px;">
                           <td style="padding-top:10px;line-height:6px;width:50%;text-align:left;font-size: 10px;font-weight:bold" colspan="4">'.$data['name'].'</td>
                           <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:2px;text-align:left;font-size: 10px;font-weight:bold" colspan="4">'.$data['name'].'</td>
                       </tr>
                       <tr>
                           <td style="padding-left:0px;font-size:10px;line-height:8px;width:50%;" colspan = "4"><b>Net Wt : '.$data['net_weight'].'</b></td>
                           <td style="font-size:10px;line-height:10px;width:50%;padding-left:2px;" colspan = "4"><b>Net Wt : '.$data['net_weight'].'</b></td>
                       </tr>   
                       <tr>
                       <td colspan="4" style="padding-left:0px;font-size:11px;line-height:8px;"><b>MRP:'.$data['MRP'].'   <b></td>							
                       <td colspan="4" style="font-size:11px;line-height:8px;padding-left:2px;"><b>MRP:'.$data['MRP'].' <b> </td>
                     </tr>    
                       <tr>
                           <td style="padding-left:0px;font-size:10px;line-height:8px;width:50%;" colspan = "4"><b>Exp Dt : '.$data['expd'].'</b></td>
                           <td style="font-size:10px;line-height:10px;width:50%;padding-left:2px;" colspan = "4"><b>Exp Dt : '.$data['expd'].'</b></td>
                       </tr>    
                       
                       <tr>
                           <td style="padding-left:7px;" colspan = "4"><barcode  style="padding-left:0px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C93" height="1" text="1" /></td>
                           <td style="padding-left:10px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="1" text="1" /></td>
                       </tr>
                       <tr>
                           <td colspan="4" style="padding-left:0px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                           
                           
                           <td colspan="4" style="padding-left:5px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                           
                       </tr>
                      
                       
                   </table>
                   <table>
                  
                   </table>';
                     $pdf->writeHTML($html);

                       $pdf->Output('example_021.pdf', 'I');
                                   //ob_end_clean();


}

function palack($id, $uid = 0) {
    // 1. Fetch User/Branch Logic
    $tmp = $this->session->userdata('user');
    $user = $tmp['Id'];
    $address = 'PCH Adimali';
    $phone = '8281732599';
    
    $qry = "SELECT b.* FROM users a INNER JOIN company_branch AS b ON b.brc_id = a.branch WHERE a.Id =" . $user;
    $user_data = $this->db->query($qry);
    if ($user_data->num_rows() > 0) {
        $user_data = $user_data->row_array();
        $address = 'PCH ' . $user_data['brc_name'];
        $phone = $user_data['brc_phone'];
    }

    // 2. Initialize M_PDF using the settings from billhugs
    $this->load->library('M_pdf');
    $this->m_pdf->param = [
        'mode' => 'utf-8', 
        'format' => array(100, 27), // Using 27mm height from billhugs
        'margin_bottom' => 0,
        'margin_top' => 0,
        'margin_right' => 0,
        'margin_left' => 6, 
        'autoPageBreak' => TRUE
    ];
    $this->m_pdf->load();
    $pdf = $this->m_pdf->pdf;
    $pdf->SetDirectionality('ltr');

    // 3. Fetch Data
    $data = $this->item->getpitem($id, $uid)[0];

    // 4. Build the HTML using your requested table structure but billhugs barcode style
    $html = '
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
    </style>

    <table style="width:100%; cellpadding:0px;padding:0px;padding-top:0px;">
        <tr>
            <td style="padding-top:10px; line-height:6px; width:49.5%; text-align:left; font-size:15px; font-weight:bold" colspan="4">'.$address.'</td>
            <td style="padding-top:10px; line-height:8px; width:50.5%; padding-left:1px; text-align:left; font-size:15px; font-weight:bold" colspan="4">'.$address.'</td>
        </tr>
        
        <tr>
            <td style="padding-top:5px;padding-left:1px; font-size:12px; line-height:8px; width:49.5%;" colspan="4">SHOP. '.$phone.'</td>
            <td style="padding-top:5px;font-size:12px; line-height:8px; width:50.5%; padding-left:1px;" colspan="4">SHOP. '.$phone.'</td>
        </tr> 

        <tr>
            <td colspan="4">
                <barcode style="padding-top:5px;padding-left:1px; " code="'.trim($data['barcode']).'" size=".5" type="C39" height="1.8" text="1" />
            </td>
            <td style="padding-top:5px;padding-left:1px;" colspan="4">
                <barcode style="" code="'.trim($data['barcode']).'" size=".5" type="C39" height="1.8" text="1" />
            </td>
        </tr>

        <tr>
            <td colspan="4" style="padding-top:5px;padding-left:2px; text-align:left; font-size:10px; line-height:5px;"><b>'.$data['barcode'].'</b></td>
            <td colspan="4" style="padding-top:5px;padding-left:1px; text-align:left; font-size:10px; line-height:5px;"><b>'.$data['barcode'].'</b></td>
        </tr>
    </table>';

    $pdf->writeHTML($html);
    $pdf->Output('barcode_label.pdf', 'I');
}

function palack_copy($id,$uid){
	    $tmp = $this->session->userdata('user');
        $user = $tmp['Id'];
        $address ='PCH Adimali';
        $phone = '8281732599';
        $qry = "SELECT b.* FROM users a INNER JOIN  company_branch AS b ON b.brc_id = a.branch WHERE a.Id =".$user;
        $user_data = $this->db->query($qry);
        if($user_data->num_rows() > 0 ){
            $user_data  = $user_data->row_array();
            $address ='PCH '.$user_data['brc_name'];
            $phone = $user_data['brc_phone'];
        }
        $uid = 0 ;
        $this->load->library('Pdf');
        $pdf = new TCPDF("L", "mm", array(75,38 ), true, 'UTF-8', false);
        $pdf->SetMargins(0, 3, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $settings = $this->item->getCompanySettings();
	//	$address = $settings[0]['name'];
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('freeserif', '', 8);
        $pdf->SetFont('freeserif', '', 8);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $date = date("ny");
        $data = $this->item->getpitem($id,$uid)[0];
        //print_r($data);
        for ($i = 0; $i < 1; $i++) {
            $pdf->AddPage();
            $style = array(
                //'border' => true,
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => array(255, 255, 255),
                ///'text' => true,
                'font' => 'helvetica',
                'fontsize' => 8,
                'stretchtext' => 1
            );
            $date ='';
            $data['name'] =$result = substr($data['name'], 0, 50);

           /* $html = '<table margin="2" padding="4px" cellspacing="3">
              <tr>
              <td style="text-align:Center;">
             <b style="font-size: 12px;">'.$address.'</b> <br/>
             <b style="font-size: 10px;">'.$settings[0]['address'].'</b> <br/>
             <b style="font-size: 10px;">'.$settings[0]['phone'].' , '.$settings[0]['email'].'</b> <br/>
            <b style="font-size: 12px;">' . $data['name'] . ' </b> <br/> 
			<b style="font-size: 12px;">' . $data['barcode'] . ' </b> <br/> 
			<b style="font-size: 12px;">MRP : ' . $data['MRP'] . ' </b> <br/> <br /><br />
              ' . $pdf->write1DBarcode($data['barcode'], 'C39', '15', '20', '40', 12, 1.2, $style, 'L') . '
              </td>
             
              </tr>
              </table>';*/
         //    $address ='PCH Adimali';
			 $html = '<table style ="width:100%"  >
						<tr>
							<td style = "width:10%;">&nbsp;</td>
							<td colspan="3" style = "width:90%;font-size:18px;" ><b>'.$address.'</b></td>
						</tr>
                        <tr>
							<td style = "width:10%;">&nbsp;</td>
							<td colspan="3" style = "width:90%;padding-top:30px;font-size:10px" >SHOP. '.$phone.' </td>
						</tr>
						<tr>
			
							<td colspan ="4" style = "align:center"> ' . $pdf->write1DBarcode($data['barcode'], 'C128', '10', '15', '45', 12, 1, $style, 'L') . '</td>
						</tr>
                        <tr>
							<td style = "width:10%;">&nbsp;</td>
							<td colspan="3" style = "width:90%;padding-top:30px;font-size:11px;" ><br /><br /><br /><b>'.$data['barcode'].'</b></td>
						</tr>
						 
						 
					 
						 
					</table>';
			  
            $pdf->writeHTML($html, false, false, false, false, '');
		}
		 $pdf->Output('example_021.pdf', 'I');
	}


    

function kreatech($id,$uid){
    $this->load->library('M_pdf');
			$this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(78, 25), 'margin_bottom' => 1,'margin_top' => 1,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
			$this->m_pdf->load();
			$pdf = $this->m_pdf->pdf;
			$this->language = "ac";
			$this->lang->load('ac_site', 'ac');
			$pdf->SetDirectionality('ltr');
              $settings = $this->item->getCompanySettings();
       $address = $settings[0]['name'];
       $data = $this->item->getpitem($id,$uid)[0];
       $data['name'] = substr($data['name'], 0, 20);
	        $html =   '<style>body{
							font-family: sans-serif;
				   }</style><table  style="height:94.4881889775px !important;papadding-top:0px;cellpadding:0px;width:100%">
								
								<tr style="papadding-top:0px;">
									<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
									<td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:17px;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
								</tr>
								<tr>
									<td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
									<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:32px;" colspan = "4"><b>'.$data['name'].'</b></td>
								</tr>           
								<tr>
									<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
									<td style="padding-left:25px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
								</tr>
								<tr>
									<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
									
									
									<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
									
								</tr>
								<tr>
									<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;">MRP:'.$data['MRP'].'   </td>							
									<td colspan="4" style="font-size:11px;line-height:8px;padding-left:32px;">MRP:'.$data['MRP'].'  </td>
								</tr>
								<tr>
									<td colspan="4" style="padding-left:35px;font-size:12px;line-height:8px;"><b>Fair Price:'.$data['srate'].'</b>   </td>							
									<td colspan="4" style="font-size:12px;line-height:8px;padding-left:32px;"><b>Fair Price:'.$data['srate'].' </b> </td>
								</tr>
							</table>
							';	
			  $pdf->writeHTML($html);

                       $pdf->Output('example_021.pdf', 'I');
                     
		}
	

 function bill($id,$uid=0,$batch ='',$mrp=0) {
		$login_comid = $this->session->userdata('login_base_comid');
        if(strtolower($login_comid) === 'kreatech'){
			$this->kreatech($id,$uid);
        }
        else if(strtolower($login_comid) === 'uf20'){
			$this->billuf20($id,$uid);
        }else if( strtolower($login_comid) === 'palack'){
			$this->palack($id,$uid);
        }else if(strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  || strtolower($login_comid) == 'seasons' ||  strtolower($login_comid) === 'ssaluva' || strtolower($login_comid) == 'aakaar' || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez'  || strtolower($login_comid) === 'boyszone' || strtolower($login_comid) === 'cochinsilks'  ){
			$this->billaakaar($id,$uid);
        }else if(strtolower($login_comid) === 'msa' || strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'royal' || strtolower($login_comid) === 'choice' || strtolower($login_comid) === 'everest' || strtolower($this->session->userdata('login_base_comid')) =='mrlk' || strtolower($login_comid) === 'royalf' ){
			$this->billftfa2($id,$uid,$batch,$mrp);
        } else if( strtolower($login_comid) === 'newideal' ){
			$this->billideal($id,$uid);
        }else if( strtolower($login_comid) === 'inworld' ){
			$this->inworld($id,$uid);
        }
        else if(strtolower($login_comid) === 'ftfa' ||  strtolower($login_comid) === 'seas' || strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'newideal'  || strtolower($login_comid) === 'inworld' ){
			$this->billftfa($id,$uid);
        }
        else if(strtolower($login_comid) === 'asrfoods' || strtolower($login_comid) === 'krtraders' ){
			$this->billasr($id,$uid);
		}else if(strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'ftfa' ){
			$this->billhugs($id,$uid);
		}
		else if(strtolower($login_comid) === 'playstore' || strtolower($login_comid) === 'kabini' ){
			$this->billplaystore($id,$uid);
		}
		else if(strtolower($login_comid) === 'vismaya'){
			$this->billvismaya($id,$uid);
		}
		else if($login_comid === 'amara' || $login_comid  == '123456' || $login_comid  == 'AMARA' || $login_comid === 'vismaya' ){
			$this->billhanger($id,$uid);
		}else if( $login_comid === 'hugs' ){
			$this->billhugs($id,$uid);
		}else if($login_comid  == 'mjs' || $login_comid  == 'instyle' ){
			$this->billmjs($id,$uid);
		}else if($login_comid  == 'svt'){
			$this->billsvt($id,$uid);
		}
		else if($login_comid === 'svs'){
			$this->billsvs($id,$uid);
		}else if($login_comid == 'aditi'){
			$this->bill_aditi($id,$uid);
		}else if($login_comid !='123456'){
		$tmp = $this->session->userdata('user');
        $uid = 0 ;
        $this->load->library('Pdf');
        $pdf = new TCPDF("L", "mm", array(150, 40), true, 'UTF-8', false);
        $pdf->SetMargins(0, 0, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $settings = $this->item->getCompanySettings();
		$address = $settings[0]['name'];
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $date = date("ny");
        $data = $this->item->getpitem($id,$uid)[0];
        //print_r($data);
        for ($i = 0; $i < 1; $i++) {
            $pdf->AddPage();
            $style = array(
                //'border' => true,
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => array(255, 255, 255),
                ///'text' => true,
                'font' => 'helvetica',
                'fontsize' => 8,
                'stretchtext' => 4
            );
            $date ='';
            $data['name'] =$result = substr($data['name'], 0, 22);

            $html = '<table margin="2" padding="4px" cellspacing="3">
              <tr>
              <td style="text-align:Center;">
             <b style="font-size: 12px;">'.$address.'</b> <br/>
            <b style="font-size: 12px;">' . $data['name'] . ' </b> <br/> 
			<b style="font-size: 12px;">' . $data['barcode'] . ' </b> <br/> 
			<b style="font-size: 12px;">MRP : ' . $data['MRP'] . ' </b> <br/> <br /><br />
              ' . $pdf->write1DBarcode($data['barcode'], 'C39', '15', '20', '40', 12, 1.2, $style, 'L') . '
              </td>
              <td style="text-align:Center;">
              <b style="font-size: 12px;">'.$address.'</b> <br/>
            <b style="font-size: 12px;">' . $data['name'] . ' </b> <br/> 
			<b style="font-size: 12px;">' . $data['barcode'] . ' </b> <br/> 
			<b style="font-size: 12px;">MRP : ' . $data['MRP'] . ' </b> <br/> <br /><br />
              ' . $pdf->write1DBarcode($data['barcode'], 'C39', '95', '20', '40', 12, 1.2, $style, 'L') . '

              </td>
              </tr>
              </table>'; 
              if(strtolower($login_comid) == 'palack'){
                $html = '<table margin="2" padding="4px" cellspacing="3">
                <tr>
                <td style="text-align:Center;">
               <b style="font-size: 12px;">'.$address.'</b> <br/>
              <b style="font-size: 12px;">' . $data['barcode'] . ' </b> <br/> 
                ' . $pdf->write1DBarcode($data['barcode'], 'C39', '15', '20', '40', 12, 1.5, $style, 'L') . '
                </td>
                <td style="text-align:Center;">
                <b style="font-size: 12px;">'.$address.'</b> <br/>
              <b style="font-size: 12px;">' . $data['barcode'] . ' </b> <br/> 
                ' . $pdf->write1DBarcode($data['barcode'], 'C39', '95', '20', '40', 12, 1.5, $style, 'L') . '
  
                </td>
                </tr>
                </table>'; 
              }
              /*  for walk liineEAN13 */
            /* $html = '<table margin="2" cellpadding="1" cellspacing="2">
              <tr>
              <td style="text-align:Center;">
              <b style="font-size: small;">Dimind Innovations</b> <br/>
              <b style="font-size: x-small;">' . $data['name'] . '-A214s </b> <br/>
              <b style="font-size: small;">Rate :₹245.' . $data['MRP'] . ' MRP:₹232.' . $data['MRP'] . ' </b>
              ' . $pdf->write1DBarcode('2jk14s', 'C39', '5', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              <td style="text-align:Center;">
              <b style="font-size: small;">Dimind Innovations</b> <br/>
              <b style="font-size: x-small;">' . $data['name'] . '-A214s </b> <br/>
              <b style="font-size: small;">Rate :₹245.' . $data['MRP'] . ' MRP:₹232.' . $data['MRP'] . ' </b>
              ' . $pdf->write1DBarcode('2a14s', 'C39', '60', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              </tr>
              </table>';/*  for JK */
            $pdf->writeHTML($html, false, false, false, false, '');
        }
        $pdf->Output('example_021.pdf', 'I');
		}else{
			$this->bill1($id,$uid);
		}
    }

    public function _callback_name($value, $row) {
        if ($row->name_lan == '') {
            return $row->name;
        } else {
            return $row->name_lan;
        }
    }

    public function racks() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('item_racks_master');
            $crud->set_subject(label('Racks', $this, $this->user));
            $crud->required_fields('name', 'rows');
            $crud->columns('name', 'rows');
            $crud->unique_fields('name');
            $crud->display_as('name', 'Name');
            if ($this->multiple == 0) {
                $crud->fields('name', 'rows');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'rows');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $columns = array('name', 'rows', 'name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}

