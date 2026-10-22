<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author Althaf
 */
class Items_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $this->select = "landing_cost,a.MRP,h.hsncode as hsn,DATE_FORMAT(exp_date,'%d/%m/%Y') as exp,DATE_FORMAT(mfg_date,'%d/%m/%Y') as mfg, IFNULL(open,0) as open,IFNULL(c.total,0) as total,unit_id,a.id,a.name as itemname,IFNULL(a.barcode,'') as barcode,IFNULL(a.srate,0) as salerate,IFNULL(b.name,'') as category,IFNULL(a.description,'') as description,IFNULL(a.open_stock,0) as open_stock,IFNULL(a.current_stock,0) as current_stock,IFNULL(a.prate,0) as prate";
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'item as a left join hsncode as h on h.hsnid = a.hsncode left join item_category as b on a.item_category_id =b.id left join (select sum(current_stock+open_stock) as total,sum(open_stock) as open,item_id  from item_godown group by item_id) as c on c.item_id=a.id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'itemname', 'category', 'salerate', null); //set column field database for datatable orderable   
        $this->column_search = array('a.name', 'a.barcode', 'b.name', 'a.description','a.part_no1','a.part_no2'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }
	
	public function get_item_quantity_price($id){
		$qry  ="select * from item_quantity_price where published = 'yes' and qprice_item = ".$id; 
		$result = $this->db->query($qry)->result_array();
		 echo json_encode($result);
	}

    function where()
    {
        //$this->wherecondition = "where a.item_type_id = '" . $this->input->post('sale_type') . "'";
        $this->wherecondition = "where a.published='yes'";

        if ($this->input->post('category_id')) {
            $this->wherecondition = $this->wherecondition . 'and a.item_category_id=' . $this->input->post('category_id');
        }
        if ($this->input->post('material_type')) {
            $this->wherecondition = $this->wherecondition . ' and a.material_type=' . $this->input->post('material_type');
        }
		if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . ' and a.brand_id=' . $this->input->post('brand');
        }
		if ($this->input->post('tax_id')) {
            $this->wherecondition = $this->wherecondition . ' and a.tax_id=' . $this->input->post('tax_id');
        }
    }
    function Itemtype()
    {
        $qry = 'select id ,name from item_type order by id asc';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    public function deleteImage($file)
    {
        $qry = 'DELETE from item_image where iim_id = ' . $file;
        $this->db->query($qry);
    }

    public function upload_video()
    {
        $in_id = $this->input->post('ins_id');
        $rad = $this->input->post('radio');
        if ($rad == 'url') {
            $urls = $this->input->post('urls', true);
            $length = count($urls);
            if ($length > 0) {
                $qry = "delete from item_image where iim_type = 'url' and item_id = " . $in_id;
                $this->db->query($qry);
                for ($i = 0; $i < $length; $i++) {
                    $ur = substr($urls[$i], 30);
                    $this->insert_image($in_id, 'url', $ur);
                }
            }
        } else {
            if (isset($_FILES['videos'])) {

                $vidfile = $_FILES['videos'];
                $exp = explode(".", $_FILES['videos']['name']);
                $type = 'video';
                //upload file  
                $fileid = 'videos';
                $filename = rand() . '.' . $exp[1];

                $filename = $this->itemuploads($vidfile, $type, $fileid, $filename);
                $qry = "delete from item_image where iim_type = 'url' and iim_type = 'video' and item_id = " . $in_id;
                $this->insert_image($in_id, 'video', $filename);
            }
            echo (1);
        }
    }

    function itemuploads($file, $type, $fileid, $filename)
    {

        if ($type == "image") {
            $config['upload_path'] = 'uploads/images/item/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['file_name'] = $filename;
            $config['max_size'] = '5024000'; //1 MB

        } else {
            $config['upload_path'] = 'uploads/video/item/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['file_name'] = $filename;
            $config['max_size'] = '102400'; //10 MB  

        }
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($fileid)) {
            $uploaded_data = $this->upload->data();
            $f_name = $uploaded_data['file_name'];
            return $f_name;
        } else {
            return;
        }
    }

    function getCategoryBarcode($item_category_id,$mrp,$prate,$item_id,$type){
        $return_data['is_new'] = 0 ; 
        $mrp = (int) $mrp;
        $qry = "SELECT * FROM item_category WHERE id = ".$item_category_id;
        $category = $this->db->query($qry)->row_array();
        $return = '';
        $code = $category['category_code'];
        $qry = "select * from category_barcode where item_id = ".$item_id." order by id desc limit 0,1";
        $data = $this->db->query($qry);
        if($data->num_rows() > 0 ){
            $data = $data->row_array();
            if((int) $data['mrp'] == (int)$mrp && (float)$prate ==  (float)$data['prate'] ){
                $return = $data['barcode'];
            }else{
                $qry = "select * from category_barcode where category_id = ".$item_category_id." order by id desc limit 0,1 ";
                $cat = $this->db->query($qry)->row_array();
                $increment = $cat['increment'];
                $increment = $increment + 1;
                $data_array = array(
                    'date'=>date('Y-m-d'),
                    'item_id'=>$item_id,
                    'mrp'=>$mrp,
                    'category_id'=>$item_category_id,
                    'prate'=>$prate,
                    'increment'=>$increment,
                    'barcode'=>$code.$increment.$mrp
                );
                $this->db->insert('category_barcode',$data_array);
                $return = $code.$increment.$mrp;
                $return_data['is_new'] = 1 ; 
            }
        }else{
            $qry = "select * from category_barcode where category_id = ".$item_category_id." order by id desc limit 0,1 ";
            $cat = $this->db->query($qry)->row_array();
            $increment = $cat['increment'];
            $increment = $increment + 1;
            $data_array = array(
                'date'=>date('Y-m-d'),
                'item_id'=>$item_id,
                'mrp'=>$mrp,
                'category_id'=>$item_category_id,
                'prate'=>$prate,
                'increment'=>$increment,
                'barcode'=>$code.$increment.$mrp
            );
            $return = $code.$increment.$mrp;
            $this->db->insert('category_barcode',$data_array);
            $return_data['is_new'] = 1 ; 

        }
        $return_data['return'] = $return ; 

        return $return_data;
    }

    function save()
    {
        exit;

        $category_barcode = 0 ;
        $settings = $this->getCompanySettings();
        if(isset($settings[0]['category_barcode'])){
            $category_barcode = $settings[0]['category_barcode'];
        }
		$part_no1 = '';
		$part_no2 = '';
		if( $this->input->post('pno2') ){
			$part_no2 = $this->input->post('pno2');
		}
		if( $this->input->post('pno1') ){
			$part_no1 = $this->input->post('pno1');
		}
		$special_rate = 0 ;
		if($this->input->post('special_rate') ){
			$special_rate = $this->input->post('special_rate');
		}
		$sub_unit_one = 0;
		$sub_unit_two = 0;
		if($this->input->post('sub_unit_one')){
			$sub_unit_one = $this->input->post('sub_unit_one');
		}
		if($this->input->post('sub_unit_two')){
			$sub_unit_two = $this->input->post('sub_unit_two');
		}
		$item_cess = 0;
		if($this->input->post('item_cess')){
			$item_cess = $this->input->post('item_cess');
		}
        $analytics_id = 0;
        $material_type = 1;
        $taxldg_id = 0; //get tax id from acc ledgers
        $saletax_id = 0;
        $purctax_id = 0;
        $open_stock = 0;
        $commission = 0;
        $wholerate = 0;
        $up_id = 0;
        $is_multipleunit = $this->input->post('is_multipleunit');
        $unit = $this->input->post('unit_id');
        $id = $this->input->post('ins_id');
        $up_id = $id;
        if($category_barcode < 1 ){
            $is_autobarcode = $this->input->post('is_autobarcode');
            $barcode = $this->input->post('barcode');
		    $barcode =  preg_replace('/\s+/', ' ', $barcode);
		    $barcode =  preg_replace('/\s+/', '', $barcode);
		    $barcode =  preg_replace('/\s+/', '', $barcode);
        }
        $brand_id = 0;
		$war_period = 0;
		if($this->input->post('war_period')){
			$war_period = $this->input->post('war_period');
		}
		if($this->input->post('brand_id')){
			$brand_id = $this->input->post('brand_id');
		}
        $is_rack = $this->input->post('is_rack');
        $is_production = $this->input->post('is_production');
        $is_analytics = $this->input->post('is_analytics');
		$item_type = '';
		if($this->input->post('itemtype')){
			$item_type = $this->input->post('itemtype');
		}
        $name = $this->input->post('name'); // if it is zero then we will add the item
		$hsncode_id = 0;
		if($this->input->post('hsn_id')){
			$hsncode_id = $this->input->post('hsn_id');
		}
		$price_code = 0;
		if($this->input->post('price_code')){
			$price_code = $this->input->post('price_code');
		}
        $name_lan = $this->input->post('name_lan');
		$item_category_id = 0;
		if($this->input->post('item_category_id')){
			$item_category_id = $this->input->post('item_category_id');
		}
        $isgodown = $this->input->post('isgodown');
		$isbatch = $this->input->post('isbatch');
		$part_no = "";
		if($this->input->post('pno')){
			$part_no = $this->input->post('pno');
		}
		$make_model = '';
		if($this->input->post('mmodel')){
			$make_model = $this->input->post('mmodel');
		}
        $is_multipletax = $this->input->post('is_multipletax');
        $item_group_id = $this->input->post('item_group_id');
        $minimum = $this->input->post('minimuml');
        if ($minimum == '') {
            $minimum = 0;
        }
        $maximum = $this->input->post('maxl');
        if ($maximum == '') {
            $maximum = 0;
        }
        $online_item = $this->input->post('online_item');
        if($category_barcode < 1 ){
            $barcode_count = $this->chk_barcode($barcode);
        }
        if ($this->input->post('commission')) {
            $commission = $this->input->post('commission');
        }
        if ($this->input->post('wholerate')) {
            $wholerate = $this->input->post('wholerate');
        }
        $mfgdate = $this->input->post('mfgdate');
        $description = $this->input->post('description');
        if ($mfgdate) {
            $mfgdate = $this->getDate($this->input->post('mfgdate'));
            $expdate = $this->getDate($this->input->post('expdate'));
        } else {
            $mfgdate = date('Y-m-d');
            $expdate = date('Y-m-d');
        }
        if ($isgodown != 1 && $isbatch !=1) {
            $open_stock = $this->input->post('open_stock');
        }
        if ($this->input->post('taxldg_id')) {
            $taxldg_id = $this->input->post('taxldg_id');
        }
        if ($this->input->post('saletax_id')) {
            $saletax_id = $this->input->post('saletax_id');
        }
        if ($this->input->post('purctax_id')) {
            $purctax_id = $this->input->post('purctax_id');
        }
        if ($is_production != 0) {
            $material_type = $this->input->post('material_type');
        }
        if ($is_analytics != 0) {
            if ($this->input->post('analytics_id')) {
                $analytics_id = $this->input->post('analytics_id');
            }
        }
        // $current_stock = $this->input->post('current_stock');
        $reorder_point = $this->input->post('reorder_point');
        if ($reorder_point == '') {
            $reorder_point = 0;
        }
        $prate = 0; // if it is zero then we will add the item
        if ($this->input->post('prate')) {
            $prate = $this->input->post('prate');
        }
        $srate = 0;
        if ($this->input->post('srate')) {
            $srate = $this->input->post('srate');
        }
		$open_stk_rate = 0;
		if($this->input->post('open_stk_rate')){
			$open_stk_rate = $this->input->post('open_stk_rate');
		}
        if ($open_stk_rate == 0 || $open_stk_rate == "") {
            $open_stk_rate = $prate;
        }
        $MRP = 0;
        if ($this->input->post('MRP')) {
            $MRP = $this->input->post('MRP');
        }
        $tax_id = 0;
        if ($this->input->post('tax_id')) {
            $tax_id = $this->input->post('tax_id');
        }
        $item_image = $this->input->post('photo_enable');
        $item_video = $this->input->post('video_enable');
        $item_alternates = $this->input->post('alternate_item_set');
        if ($isgodown != 0 || $isbatch != 0) {
			$length = 0;
			$godown = $this->getgodown();
			$gwn_qty = $open_stock;
			if($this->input->post('gid', TRUE)){
				$godown = $this->input->post('gid', TRUE);
				$gwn_qty = $this->input->post('gqty', TRUE);
				$length = sizeof($gwn_qty);
			}
        } else {
            $godown = $this->getgodown();
            $gwn_qty = $open_stock;
            $length = 1;
        }
        /*
          if ($isgodown != 0) {
          $godown = $this->input->post('gdnid', TRUE);
          $gwn_qty = $this->input->post('gdnqty', TRUE);
          $length = sizeof($gwn_qty);
          } else {
          $godown = 1;
          $gwn_qty = $open_stock;
          $length = 1;
          } */
        $rrow = 0 ;
        if ($is_rack != 0) {
            $rack = $this->input->post('rack_id');
            $rrow = $this->input->post('rrow');
            if ($rack == "") {
                $rack = 0;
                $rrow = 0;
            }
        } else {
            $rack = 0;
        }
        
        if ($item_alternates != 0) {
            $alt_item = $this->input->post('alt_itemids', TRUE);
            if (isset($alt_item)) {
                $alt_length = sizeof($alt_item);
            } else {
                $alt_length = 0;
            }
        } else {
            $alt_length = 0;
        }
		$landing_cost = 0;
		if($this->input->post('landing_cost') ){
			$landing_cost = $this->input->post('landing_cost');
		}


        $is_active = 0;
        if($this->input->post('is_active') ){
			$is_active = $this->input->post('is_active');
		}
        $data = array(
           'is_active'=>$is_active,
			'sub_unit_two'=>$sub_unit_two,
			'sub_unit_one'=>$sub_unit_one,
			'landing_cost'=>$landing_cost,
            'name' => $name,
            'brand_id' => $brand_id,
            'hsncode' => $hsncode_id,
            'price_code' => $price_code,
            'item_category_id' => $item_category_id,
            'item_group_id' => $item_group_id,
            'item_type_id' => $item_type,
            'unit_id' => $unit,
            'min_level' => $minimum,
			'cess_id'=>$item_cess,
            'max_level' => $maximum,
            'wh_rate' => $wholerate,
            'open_stock' => $open_stock,
            'rack' => $rack,
            'row'=>$rrow,
            // 'current_stock' => $current_stock,
            'reorder_point' => $reorder_point,
            'prate' => $prate,
            'srate' => $srate,
			'part_no1'=>$part_no1,
			'part_no2'=>$part_no2,
            'part_no' => $part_no,
            'make_model' => $make_model,
            'open_stk_rate' => $open_stk_rate,
            'MRP' => $MRP,
            'commission' => $commission,
            'tax_id ' => $tax_id,
            'tax_ledger_id' => $taxldg_id,
            'tax_sales_id' => $saletax_id,
            'tax_purchase_id' => $purctax_id,
            'mfg_date' => $mfgdate,
            'exp_date' => $expdate,
            'material_type' => $material_type,
            'analytics_id' => $analytics_id,
			'special_rate'=>$special_rate,
            'item_online' => $online_item,
            'description' => $description,
            'war_period' => $war_period,
         );
         $open_stock_wt = 0 ;
         if($this->input->post('open_stock_wt')){
            $data['open_stock_wt'] = $this->input->post('open_stock_wt');
            $open_stock_wt = $this->input->post('open_stock_wt');
         }
         if($this->input->post('package_date')){
            $data['package_date'] = $this->getDate($this->input->post('package_date'));
		}

        if($this->input->post('net_weight')){
            $data['net_weight'] = $this->input->post('net_weight');
		}

        
        if ($this->input->post('item_size')) {
            $data['item_size_id'] = $this->input->post('item_size');
        }
        if ($isgodown == 0 && $isbatch == 0) {
            $data['godown'] = $godown;
        }
        if($category_barcode < 1 ){
            $data['barcode'] = $barcode;
            if ($this->input->post('manual')) {
                $isbarcode = $this->input->post('manual');
                $data['is_autobarcode'] = $isbarcode;
            }
        }else{
            $data['is_autobarcode'] = '0';
        }
            
		 if ($this->input->post('supid')) {
            $data['supplier'] = $this->input->post('supid');
        }

        if ($this->input->post('name_lan')) {
            $data['name_lan'] = $this->input->post('name_lan');
        }
        if ($id == 0) {
            if($category_barcode < 1 ){
                $barcode_count = $this->chk_barcode($barcode);
                if ($barcode_count > 0 && $is_autobarcode == 1) {
                    $data['barcode'] = $this->getnewbarcode();
                }
            }
            // this is  for log 

            // $this->updateAuditLog("Item Created", [], $data);

           
            $this->db->insert('item', $data);
            $insert_id = $this->db->insert_id();
            if($category_barcode > 0 ){
                $barcode_data = $this->getCategoryBarcode($data['item_category_id'],$MRP,$prate,$insert_id,0);
                $new_data['barcode']  = $barcode_data['return'];
                $this->db->where('id',$insert_id);
                $this->db->update('item',$new_data);
            }
            if ($rack != 0) {
                $rack_data = array(
                    'item_id' => $insert_id,
                    'rack_id' => $rack,
                    'row' => $rrow
                );
                $this->db->insert('item_racks', $rack_data);
            }
            $published = 'yes';
            $exist = 0;
			if($this->input->post('itm_batch',TRUE)){
				$itm_batch = $this->input->post('itm_batch',TRUE);
			}
            for ($i = 0; $i < $length; $i++) {
                if ($isgodown != 0 || $isbatch != 0) {
                    $data1 = array(
                        'godown_id' => $godown[$i],
                        'item_qty' => $gwn_qty[$i],
                        'open_stock' => $gwn_qty[$i],
                        'item_id' => $insert_id,
                        'published' => $published,
                    );
                } else {
                    $data1 = array(
                        'godown_id' => $godown,
                        'item_qty' => $gwn_qty,
                        'item_id' => $insert_id,
                        'published' => $published,
                        'open_stock' => $gwn_qty,
                    );

                    if(isset($data['open_stock_wt'])){
                        $data1['open_stock_wt'] = $data['open_stock_wt'];
                    }
                }
			if($this->input->post('itm_batch',TRUE)){
				$data1['batch'] = $itm_batch[$i];
			}
                $this->db->insert('item_godown', $data1);
            }
        } else {
            $published = 'yes';
            // $delqry = "delete from item_image where item_id =" . $id;
            // $this->db->query($delqry);
            $delqry = "delete from item_alternates where item_id =" . $id;
            $this->db->query($delqry);
			$j = 0;
			if($isbatch !=0){
				$j = 0;
			}
            for ($i = $j; $i <= $length - 1; $i++) {
                if ($isgodown != 0 || $isbatch !=0) {
					$txt  ="";
					$whtext ="";
					if($this->input->post('itm_batch',TRUE)){
						$itm_batch = $this->input->post('itm_batch',TRUE);
						$item_stkrate  = $this->input->post('item_stkrate',TRUE);
						$item_srate  = $this->input->post('item_srate',TRUE);
						$item_Prate  = $this->input->post('itmprate',TRUE);
						$item_MRP  = $this->input->post('item_MRP',TRUE);
						$item_WHRATE  = $this->input->post('item_WHRATE',TRUE);
						$txt = " ,batch='".$itm_batch[$i]."',item_srate='".$item_srate[$i]."',item_prate='".$item_Prate[$i]."',item_whrate='".$item_WHRATE[$i]."',item_mrp='".$item_MRP[$i]."',item_opnstkrate='".$item_stkrate[$i]."'  ";
						$whtext = " and batch ='".$itm_batch[$i]."'  ";
					}
					
                    $qry = "select  count(id) as cnt,open_stock from  item_godown where item_id ='" . $id . "'  ".$whtext." and godown_id ='" . $godown[$i] . "'";
                    $query = $this->db->query($qry)->row_array();
                    $itemcount = $query['cnt'];
                    $qry = "update  item_godown set item_qty ='" . $gwn_qty[$i] . "',open_stock ='" . $gwn_qty[$i] . "'  ".$txt." where item_id ='" . $id . "'and godown_id ='" . $godown[$i] . "' ".$whtext." ";
                    $this->db->query($qry);
                    if ($itemcount == '0') {
                        $qry = "insert into item_godown(godown_id,item_id,item_qty,open_stock) values(" . $godown[$i] . " , " . $id . " , " . $gwn_qty[$i] . " , " . $gwn_qty[$i] . ")";
                        if($this->input->post('itm_batch',TRUE)){
							$itm_batch = $this->input->post('itm_batch',TRUE);
							$item_stkrate  = $this->input->post('item_stkrate',TRUE);
							$item_srate  = $this->input->post('item_srate',TRUE);
							$item_Prate  = $this->input->post('itmprate',TRUE);
							$item_MRP  = $this->input->post('item_MRP',TRUE);
							$item_WHRATE  = $this->input->post('item_WHRATE',TRUE);
							$qry = "insert into item_godown(godown_id,item_id,item_qty,open_stock,batch,item_srate,item_prate,item_whrate,item_mrp,item_opnstkrate) values(" . $godown[$i] . " , " . $id . " , " . $gwn_qty[$i] . " , " . $gwn_qty[$i] . ", '" . $itm_batch[$i] . "', '" . $item_srate[$i] . "', '" . $item_Prate[$i] . "', '" . $item_WHRATE[$i] . "', '" . $item_MRP[$i] . "', '" . $item_stkrate[$i] . "')";
						}
						$this->db->query($qry);
                    }
                } else {
                    $txt_open_stock_wt = '';
                    if(isset($data['open_stock_wt'])){
                        $txt_open_stock_wt = ' ,open_stock_wt = "'.$open_stock_wt.'" ';
                    }
                    $qry = "update item_godown set item_qty ='" . $gwn_qty . "',open_stock ='" . $gwn_qty . "' ".$txt_open_stock_wt." where item_id ='" . $id . "'and godown_id ='" . $godown . "'";
                    $this->db->query($qry);
                }
            }
			if ($isgodown == 0 && $isbatch == 0) {

                $txt_open_stock_wt = '';
                if(isset($data['open_stock_wt'])){
                    $txt_open_stock_wt = ' ,open_stock_wt = "'.$open_stock_wt.'" ';
                }
				$qry = "update item_godown set item_qty ='" . $gwn_qty . "',open_stock ='" . $gwn_qty . "' ".$txt_open_stock_wt." where item_id ='" . $id . "'and godown_id ='" . $godown . "'";
				$this->db->query($qry);
			}

            // log for update base array
            $this->db->where('id', $id);
            $query = $this->db->get('item');
            if($category_barcode < 1 ){
			    $data['barcode'] = $this->input->post('barcode');
            }else{
			    $data['barcode'] = $this->input->post('catbarcode');
            }

            if($category_barcode > 0 ){
                 $barcode_data = $this->getCategoryBarcode($data['item_category_id'],$MRP,$prate,$id,0);
                 if((int)$barcode_data['is_new'] > 0 ){
                    $data['barcode'] = $barcode_data['return'];
                    $this->db->insert('item', $data);
                 }else{
                    $this->db->where('id', $id);
                    $this->db->update('item', $data);
                 }
            }else{
                $this->db->where('id', $id);
                $this->db->update('item', $data);
            }
           
			$qry = "update item_quantity_price set published = 'no' where qprice_item =".$id;
			$this->db->query($qry);
            if ($is_rack != 0) {
                $rack_data = array(
                    'rack_id' => $rack,
                    'row' => $rrow
                );
                $this->db->where('item_id', $id);
                $this->db->update('item_racks', $rack_data);
            }
            // log for update new array
            $this->db->where('id', $id);
            $queryn = $this->db->get('item');
            //  $this->updateAuditLog("Item Updated", $query->row_array(), $queryn->row_array());

            $insert_id = $id;
            $published = 'yes';
            $exist = 1;
        }

        for ($i = 0; $i < $alt_length; $i++) {
            $alt_data = array(
                'item_id' => $insert_id,
                'alt_item_id' => $alt_item[$i],
            );
            $this->db->insert('item_alternates', $alt_data);
        }
		if($this->input->post('otherField', true)){
			$fields = $this->input->post('otherField', true);
			$f_len = count($fields);
			if ($f_len > 0) {
				for ($i = 0; $i < $f_len; $i++) {
					$inc = $i + 1;
					$datas['field_' . $inc] = $fields[$i];
				}
				$this->db->where('id', $insert_id);
				$this->db->update('item', $datas);
			}
		}
        if ($is_multipleunit == 1 && $category_barcode < 1) {
            $this->item_barcode($id, $insert_id, $unit, $this->input->post('barcode'), $srate);
        }
		if($this->input->post('feature',TRUE)){
			$itemtypevalue = $this->input->post('feature',TRUE);
			$qry  = "update item_feature set published='no' where item_id = ".$insert_id;
			$this->db->query($qry);
			$length = sizeof($itemtypevalue);
			for($i=0;$i<$length;$i++){
				$data = array(
						'item_id'=>$insert_id,
						'itemtypevalue'=>$itemtypevalue[$i],
						'published'=>'yes'
				);
				$this->db->insert('item_feature',$data);
			}
			
		}
        // if ($up_id > 0) {
		
		if($this->input->post('sel_quantity_price') ){
			$sel_quantity_price = $this->input->post('sel_quantity_price');
			if($sel_quantity_price == 'above'){
				$qprice_rate = $this->input->post('quantity_price_above_value');
				$data = array(
					'qprice_item'=>$insert_id,
					'qprice_above'=>$this->input->post('quantity_price_above'),
					'qprice_type'=>$sel_quantity_price,
					'qprice_rate'=>$qprice_rate
				);
			}
			if($sel_quantity_price == 'below'){
				$qprice_rate = $this->input->post('quantity_price_below_value');
				$data = array(
					'qprice_item'=>$insert_id,
					'qprice_below'=>$this->input->post('quantity_price_below'),
					'qprice_type'=>$sel_quantity_price,
					'qprice_rate'=>$qprice_rate
				);
			}
			if($sel_quantity_price == 'between'){
				$qprice_rate = $this->input->post('quantity_price_rate');
				$data = array(
					'qprice_item'=>$insert_id,
					'qprice_min'=>$this->input->post('quantity_price_min'),
					'qprice_max'=>$this->input->post('quantity_price_max'),
					'qprice_type'=>$sel_quantity_price,
					'qprice_rate'=>$qprice_rate
				);
			}
			$this->db->insert('item_quantity_price',$data);
		}
        $response = array(
            'id' => $insert_id,
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
        // } else {
        //     $ins = array(
        //         'ins_id' => $insert_id,
        //     );
        //     echo json_encode($ins);
        // }
    }

    public function checkItemName()
    {
        $typed = $this->input->post('typed');
        if ($this->input->post('itemorbar') == "item") {
            $qry = "select i.* from item as i where name = '" . $typed . "'";
            $res = $this->db->query($qry);
            echo json_encode($res->row_array());
        } else {
            $qry = "select i.* from item as i where barcode = '" . $typed . "'";
            $res = $this->db->query($qry);
            echo json_encode($res->row_array());
        }
    }

    function chk_barcode($barcode)
    {
        $qry = "select count(id) as no from item as a where barcode ='" . $barcode . "'";
        $query = $this->db->query($qry);
        $result = $query->row()->no;
        return $result;
    }

    function insert_image($insert_id, $type, $filename)
    {

        $img_data = array(
            'item_id' => $insert_id,
            'iim_name' => $filename,
            'iim_type' => $type,
        );
        $this->db->insert('item_image', $img_data);
    }

    public function allImages($item_id)
    {
        $qry = "select * from item_image as iimage where iim_type = 'image' and item_id = " . $item_id;
        $res = $this->db->query($qry)->result_array();
        echo json_encode($res);
    }

    public function allVideos($item_id)
    {
        $qry = "select * from item_image as iimage where iim_type = 'video' and item_id = " . $item_id;
        $res = $this->db->query($qry)->result_array();
        echo json_encode($res);
    }

    public function allUrl($item_id)
    {
        $qry = "select * from item_image as iimage where iim_type = 'url' and item_id = " . $item_id;
        $res = $this->db->query($qry)->result_array();
        echo json_encode($res);
    }

    function item_barcode($id, $insert_id, $unit, $barcode, $srate)
    {
        if ($id == 0) {
            $units = $this->getunits($unit);
            $units = explode(",", $units);
            $rate = $srate;
            $length = sizeof($units);
            for ($i = 0; $i < $length; $i++) {
                if ($i == 0) {
                    $item_barcode = $barcode;
                } else {
                    $qry = "select * from units where id=" . $units[$i];
                    $query = $this->db->query($qry);
                    $query = $query->row_array();
                    $rate = $rate * $query['unit_count'];
                    $item_barcode = $barcode . '-' . $units[$i];
                }
                $item_data = array(
                    'item_id' => $insert_id,
                    'unit_id' => $units[$i],
                    'barcode' => $item_barcode,
                    'rate' => $rate,
                );
                $this->db->insert('item_barcode', $item_data);
            }
        } else {
            $qry = "select * from item_barcode where item_id=" . $insert_id . " order by id asc limit 1";
            $query = $this->db->query($qry);
            $query = $query->row_array();
            $uid = $query['unit_id'];
            if ($uid != $unit) {
                $qry = "delete  from item_barcode where item_id=" . $insert_id;
                $this->db->query($qry);
                $units = $this->getunits($unit);
                $units = explode(",", $units);
                $length = sizeof($units);
                for ($i = 0; $i < $length; $i++) {
                    $item_barcode = $barcode . '-' . $units[$i];
                    if ($i == 0) {
                        $item_barcode = $barcode;
                    }
                    $item_data = array(
                        'item_id' => $insert_id,
                        'unit_id' => $units[$i],
                        'barcode' => $item_barcode,
                    );
                    $this->db->insert('item_barcode', $item_data);
                }
            }
        }
    }

    function getunits($search)
    {
        $id = $search;
        $count = 1;
        $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->row_array();
        $stack = array('"' . $query["id"] . '"');
        $unit = $query["id"];
        for ($i = 2; $i >= 2; $i++) {
            $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $id . "'";
            $query = $this->db->query($qry)->row_array();
            $i = $query['count'];
            $count = $count * $query["unit_count"];
            if ($query['count'] > 0) {
                $id = $query['id'];
                array_push($stack, '"' . $query["id"] . '"');
                $unit = $unit . ',' . $query["id"];
            }
        }
        return $unit;
    }

    function getbarcodebatch($id)
    {
        $qry = 'select * from barcode_batch_items  as a left join(select sum(b.quantity) as total,b.id as bid from barcode_batch_items as b where b.published="yes" and b.batch_id=' . $id . ') as c on a.id=bid where a.published="yes" and batch_id=' . $id;
        print_r($qry);
        $settings = $this->db->query($qry);
        return $settings->result_array();
    }

    function printbarcode()
    {
        $id = $this->input->post('id');
        $batch_name = $this->input->post('batch_name');
        if ($id > 0) {
            $qry = "update  barcode_batch set batch_name='" . $batch_name . "'where barcode_batch_id =" . $id;
            $this->db->query($qry);
            $insert_id = $id;
            $query = "update  barcode_batch_items set published='no' where batch_id = " . $id;
            $this->db->query($query);
        } else {
            $batch_data = array(
                'batch_name' => $batch_name,
                'published' => 'yes'
            );
            $this->db->insert('barcode_batch', $batch_data);
            $insert_id = $this->db->insert_id();
        }
        $item_id = $this->input->post('item_id', true);
        $quantity = $this->input->post('item_qty', true);
        $barcode = $this->input->post('item_barcode', true);
        $rate = $this->input->post('item_rate', true);
        $item_name = $this->input->post('item_name', true);
        $item_MRP = $this->input->post('item_MRP', true);
        $totquantity = 0;


        $length = sizeof($item_id);
        for ($i = 0; $i < $length; $i++) {
            $barcode_data = array(
                'batch_id' => $insert_id,
                'item_id' => $item_id[$i],
                'quantity' => $quantity[$i],
                'barcode' => $barcode[$i],
                'rate' => $rate[$i],
                'item_name' => $item_name[$i],
                'mrp' => $item_MRP[$i],
            );
            $data[$i] = $barcode_data;
            $this->db->insert('barcode_batch_items', $barcode_data);
            $totquantity = $totquantity + $quantity[$i];
        }
        return $insert_id;
    }

    function barcode()
    {
        $this->select = 'irate,item_barcode,b.name,b.barcode,a.name as unit,a.id as uid,a.unit_count as unit_count,srate,IFNULL(sid,0) as sid,a.id,iid';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'units as a left join (select i.rate as irate,i.id as iid,i.barcode as item_barcode,i.unit_id as unit,IFNULL(c.id, 0) as sid,c.* from item as c left join item_barcode as i on i.item_id=c.id where c.id=' . $this->input->post('id') . ' order by c.id desc) as b on a.id=b.unit';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable   
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('-b.iid ' => 'desc'); // defau
        $this->wherecondition = 'where a.id in(' . $this->input->post('unit') . ')';
    }


    function getproducts($id)
    {
        $qry = "select DATE_FORMAT(a.created_date, '%d/%m/%Y' ) as dtp,a.product_id as pid,i.id as bid,  a.published as pub,i.name as sname,i.id as sid, a.*,b.* from prd_stock as a inner join prd_stockitem as b on a.id =b.stock_prod_id  inner join item as i on i.id=b.sal_item_id where b.published='yes' and   a.id =" . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function gettablefields($table_name)
    {
        $dropdownvalue = "";
        if ($table_name == 'item') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="item_type_id">Goods/service</option><option value="barcode">Barcode</option><option value="godown">Godown</option><option value="open_stock">Open Stock</option>  <option value="unit_id">Unit</option>     <option value="item_category_id">Category</option>      <option value="item_group_id">Item Discount Group</option>    <option value="reorder_point">Reorder Point</option><option value="min_level">Min Level</option><option value="max_level">Max Level</option><option value="rack">Rack</option><option value="prate">Purchase Rate</option><option value="srate">SaleRate</option><option value="wh_rate">WholsaleRate</option><option value="MRP">Mrp</option><option value="open_stk_rate">OpenStockRate</option><option value="commission">Commission</option><option value="tax_id">Tax</option><option value="tax_ledger_id">TaxLedgerId</option><option value="tax_sales_id">TaxSalesId</option><option value="tax_purchase_id">TaxPurchaseId</option><option value="hsncode">HsncodeId</option><option value="description">Description</option><option value="mfg_date">MFGDate</option><option value="exp_date">ExpireyDate</option><option value="analytics_id">AnalyticsId</option>';
        }
        if ($table_name == 'suppliers') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="district">district</option><option value="cst">State</option><option value="phone">Phone</option><option value="tin">GST/TIN</option>  <option value="email">Email</option>     <option value="address_line1">Address</option>      <option value="details">Details</option>    <option value="bank">Bank</option><option value="account_no"> Account No</option><option value="ifsc_code">IFSC CODE</option>';
        }
        if ($table_name == 'customer') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="phone">Phone</option><option value="tin">GST/TIN</option>  <option value="email">Email</option>     <option value="address_line1">Address</option>      <option value="details">Details</option>    <option value="bank">Bank</option><option value="account_no"> Account No</option><option value="ifsc_code">IFSC CODE</option>';
        }
        return $dropdownvalue;
        // if($table_name == 'supplier'){
        // }
        // if($table_name == 'item'){
        // }
    }

    function gettransfer($id)
    {
        $qry = "select DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,name,item_id from item_transfer as a inner join item_transfer_sub as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b.
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getsing($id)
    {
        $qry = 'select DATE_FORMAT(package_date,"%d/%m/%Y") as packagedate ,ifnull(sup.name,"") as supname,IFNULL(cat.name,"") as catname,IFNULL(item_stock,0) as item_stock,a.*,a.name as name,y.any_name,y.any_id,x.id as taxldgid,x.name as taxldg,w.id as saletxid,w.name as saletxldg, z.id as purctxid, z.name as purctxldg from item as a left join item_category as cat on cat.id=a.item_category_id left join (select sum(z.open_stock) as item_stock,z.item_id as iid from item_godown as z group by z.item_id ) as x on x.iid=a.id left outer join analytics_center as y on a.analytics_id=y.any_id left outer join acc_ledgers as x on a.tax_ledger_id=x.id left outer join acc_ledgers as w on a.tax_sales_id=w.id left outer join acc_ledgers as z on a.tax_purchase_id=z.id  left join suppliers as sup on sup.id = a.supplier where a.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function getpitem($id, $uid)
    {
        if ($uid == 0) {
            $qry = 'select DATE_FORMAT(exp_date	, "%d/%m/%Y" ) as expd,DATE_FORMAT(mfg_date, "%d/%m/%Y" ) as mfgd,ibr_name,ic.name as cat,DATE_FORMAT(curdate(), "%d/%m/%Y" ) as mfg,IFNULL(c.barcode,a.barcode) as itembarcode, c.rate as itemrate,a.* from item as a left join item_category as ic on ic.id = a.item_category_id left join item_brand as ib on ib.ibr_id = a.brand_id left join (select * from item_barcode as b where item_id=' . $id . ' order by id asc limit 1) as c on c.item_id=a.id where   a.id =' . $id;
        } else {
            $qry = 'select DATE_FORMAT(exp_date	, "%d/%m/%Y" ) as expd,DATE_FORMAT(mfg_date, "%d/%m/%Y" ) as mfgd,ibr_name,ic.name as cat,DATE_FORMAT(curdate(), "%d/%m/%Y" ) as mfg,IFNULL(c.barcode,a.barcode) as itembarcode,c.rate as itemrate,a.* from item as a left join item_category as ic on ic.id = a.item_category_id left join item_brand as ib on ib.ibr_id = a.brand_id left join (select * from item_barcode as b where item_id=' . $id . ' and b.unit_id =' . $uid . '  order by id asc limit 1) as c on c.item_id=a.id where   a.id =' . $id;
        }
        // $qry = 'select * from item as a where   a.id =' . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }
    function savebarcode()
    {
        $rate = $this->input->post('rate', TRUE);
        $item_id = $this->input->post('item_id', TRUE);
        $unit_id = $this->input->post('unit_id', TRUE);
        $barcode = $this->input->post('barcode', TRUE);
        $length = sizeof($unit_id);
        for ($i = 0; $i < $length; $i++) {
            if ($item_id[$i] > 0) {
                $item_data = array(
                    'barcode' => $barcode[$i],
                    'rate' => $rate[$i],
                );
                $this->db->where('item_id', $item_id[$i]);
                $this->db->where('unit_id', $unit_id[$i]);
                $this->db->update('item_barcode', $item_data);
            } else {
                $item_data = array(
                    'barcode' => $barcode[$i],
                    'rate' => $rate[$i],
                    'item_id' => $item_id[0],
                    'unit_id' => $unit_id[$i],
                );
                $this->db->insert('item_barcode', $item_data);
            }
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function getitembarcode($id)
    {
        $qry = "select count(id) as count,a.* from item as a  where a.`id`='" . $id . "'";
        $query = $this->db->query($qry)->row_array();
        $unit = $this->getunits($query['unit_id']);
        $qry = 'SELECT IFNULL(irate,0) as rate,item_barcode,IFNULL(b.name,"") as name,IFNULL(b.barcode,"") as barcode,a.name as unit,a.id as uid,a.unit_count as unit_count,srate,IFNULL(sid,0) as sid,a.id,iid from units as a left join (select IFNULL(i.rate,0) as irate,i.id as iid,i.barcode as item_barcode,i.unit_id as unit,IFNULL(c.id, 0) as sid,c.* from item as c left join item_barcode as i on i.item_id=c.id where c.id=' . $id . ' order by c.id desc) as b on a.id=b.unit WHERE a.id in( ' . $unit . ' ) ORDER BY -iid desc';
        $query = $this->db->query($qry);
        echo json_encode($query->result_array());
    }

    function getitems($id)
    {
        $qry = 'select * from item as a';
        if ($id != 0) {
            $qry = $qry . ' where   a.item_category_id =' . $id;
        }
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function material_types()
    {
        $qry = "select a.* from material_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["mty_id"] . '">' . $row["mty_name"] . '</option>';
        }
        print_r($option);
    }

    function item_category()
    {
        $qry = "SELECT * FROM `item_category` ORDER BY `id` ASC";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function godown($godown)
    {
        $qry = 'select * from ims_godown';
        $gwn = $this->db->query($qry);
        return $gwn->result_array();
    }

    function racks()
    {
        $qry = 'select * from item_racks_master';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function brands()
    {
        $qry = 'select * from item_brand';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function tax()
    {
        $qry = 'select gstid,GST from taxgst order by gstid asc';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function getproductslist($search = '')
    {

        $qry = 'select a.*,a.name as name,b.id as categoryid,b.name as category,d.GST as GST,d.gstid,c.name as grp,c.id as groupid,u.name as unit,u.id as unitid,t.id as typeid,t.name as typename,r.name as rack,r.id as rackid from item as a left outer join item_category as b on a.item_category_id=b.id left outer join item_group as c on a.item_group_id=c.id left outer join taxgst as d on a.tax_id=d.gstid left outer join units as u on u.id=a.unit_id left outer join item_type as t on t.id=a.item_type_id left outer join item_racks_master as r on r.id=a.rack ';
        if ($search != '') {
            $qry = $qry . " where  a.name like('%$search%') ";
        }
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function getproductslistbc($search = '')
    {

        $qry = 'select a.*,a.name as name,b.id as categoryid,b.name as category,d.GST as GST,d.gstid,c.name as grp,c.id as groupid,u.name as unit,u.id as unitid,t.id as typeid,t.name as typename,r.name as rack,r.id as rackid from item as a left outer join item_category as b on a.item_category_id=b.id left outer join item_group as c on a.item_group_id=c.id left outer join taxgst as d on a.tax_id=d.gstid left outer join units as u on u.id=a.unit_id left outer join item_type as t on t.id=a.item_type_id left outer join item_racks_master as r on r.id=a.rack ';
        if ($search != '') {
            $qry = $qry . " where  a.barcode like('%$search%') ";
        }
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function unit()
    {
        $qry = 'select id,name from units order by id';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function item_size()
    {
        $qry = "select a.* from item_size as a order by size_id";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function getalltags()
    {
        $qry = "select * from tags";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tag_items($id)
    {
        $qry = "select a.*,IFNULL(b.item_id,0) as item_id from item_sub_tags as a left join item_tags as b on a.id=b.tag_id and b.item_id=" . $id;
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function Hsncode()
    {
        $qry = "select a.* from hsncode as a order by hsnid";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function ItemsCategory()
    {
        $qry = 'select id ,name from item_category where id  in ( SELECT DISTINCT item_category_id from item)';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function ItemsSubCategory($id)
    {
        $qry = 'select id ,name from item_category where  item_category_id=' . $id;
        $res = $this->db->query($qry);
        return $res->result_array();
    }

   function getbarcode()
    {
        $barcode = $this->getCompanySettings();;
        $qry = "select barcode from  item   where is_autobarcode='1' and published='yes' order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            print_r($barcode[0]['barcode_preffix'].$barcode[0]['auto_barcode']);
        } else {
            $query = $query->row_array();
			$item_barcode = $query['barcode'];
			$item_barcode = str_replace($barcode[0]['barcode_preffix'],'',$item_barcode);
			$item_barcode = (int) $item_barcode  +1;
            print_r($barcode[0]['barcode_preffix'].$item_barcode);
        }
    }

    function getnewbarcode()
    {
        $barcode = $this->getCompanySettings();;
        $qry = "select barcode from  item   where is_autobarcode='1' and published='yes' order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $barcode[0]['barcode_preffix'].$barcode[0]['auto_barcode'];
        } else {
            $query = $query->row_array();
			$item_barcode = $query['barcode'];
			$item_barcode = str_replace($barcode[0]['barcode_preffix'],'',$item_barcode);
			$item_barcode = (int) $item_barcode  +1;
            return $barcode[0]['barcode_preffix'].$item_barcode;
        }
    }

    function Group()
    {
        $qry = 'select id,name,discount from item_group order by id';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }
	function item_transaction($id){
		$qry = "SELECT  ifnull(sum(CASE WHEN trans_status = 'damage' THEN quantity else 0 end ),0) as damage,ifnull(sum(CASE WHEN trans_status = 'purchase' THEN quantity else 0 end ),0) as purchase,ifnull(sum(CASE WHEN trans_status = 'purchase_return' THEN quantity else 0 end ),0) as purchase_return,ifnull(sum(CASE WHEN trans_status = 'sales' THEN quantity else 0 end ),0) as sales,ifnull(sum(CASE WHEN trans_status = 'sales_return' THEN quantity else 0 end ),0) as sales_return,ifnull(sum(CASE WHEN trans_status = 'stock_journal' and trans_type ='dt' THEN quantity else 0 end ),0) as received,ifnull(sum(CASE WHEN trans_status = 'stock_journal' and trans_type ='cr' THEN quantity else 0 end ),0) as issued FROM `item_ledger` WHERE published ='yes' and item_id =".$id;
		$result = $this->db->query($qry)->row_array();
		return $result;
	}
	function item_stock($id){
		$qry = 'SELECT sum(open_stock) + sum(current_stock) as stock,ig.godown_name FROM `item_godown` as i INNER JOIN ims_godown as ig on ig.id = i.godown_id where item_id = '.$id.' group by  i.godown_id';
		$result = $this->db->query($qry)->result_array();
		return $result;
	}
	
	function item_details($id){
		$qry = "SELECT racks.*,ifnull(itg.stock,'0') as item_stock,ifnull(ib.ibr_name,'') as brandname,ifnull(h.hsncode,'') as hsnname,ifnull(c.name,'') as catname,t.GST,i.* FROM item as i LEFT JOIN category as c on i.item_category_id = c.id left JOIN taxgst as t on t.gstid = i.tax_id left JOIN hsncode as h on h.hsnid =i.hsncode left JOIN item_brand as ib on ib.ibr_id = i.brand_id left join (SELECT sum(ig.open_stock) + sum(ig.current_stock) as stock,ig.item_id as item_id FROM `item_godown` as ig where item_id = ".$id.") as itg on itg.item_id =i.id left join (SELECT r.name as rackname,ir.row,ir.item_id as iid FROM `item_racks` ir INNER JOIN item_racks_master as r on r.id = ir.rack_id WHERE ir.item_id= ".$id.") as racks on racks.iid =i.id WHERE i.id = ".$id." ";
		$result = $this->db->query($qry)->row_array();
		return $result;
	}
	
	function getfeature(){
		$category  = $this->input->post('categoryid');
		$item_id  = $this->input->post('item_id');
		$qry = "SELECT IFNULL(c.id,0) as status,b.name,b.itemtypeid,b.id FROM `itemtypecategory` as a INNER join itemtypevalue as b on a.itemtypevalue =b.id left join item_feature as c on c.item_id='".$item_id."' and c.itemtypevalue=a.itemtypevalue and c.published='yes' WHERE a.published='yes' and a.categoryid='".$category."' ";
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}

    function getgodownitem($id)
    {
        $qry = 'select IFNULL(open_stock,0) as open_stock,IFNULL(item_id,'.$id.') as item_id,b.id as godownid,b.godown_name from ims_godown as b left JOIN (select * from item_godown WHERE item_id='.$id.') as a on a.godown_id=b.id';
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function item_spec($id)
    {
        $qry = 'select * from item_order_specification where spec_item=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getotheritem($id)
    {
        $qry = 'SELECT a.item_id,a.alt_item_id as otherid,b.name as othername FROM `item_alternates` as a LEFT JOIN item as b on a.alt_item_id=b.id WHERE a.item_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getallgodown()
    {
        $qry = 'select * from ims_godown';
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getcategorycount($name)
    {
        $qry = "select count(id) from item_category as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getanycount($table, $field, $name, $condition)
    {
        $this->db->select("count($field)");
        $query = $this->db->get($table);
        $this->db->where($condition, $name);
        return $query->row_array();
    }

    function getanyid($table, $field, $name, $condition)
    {
        $this->db->select($field);
        $query = $this->db->get($table);
        $this->db->where($condition, $name);
        return $query->result();
    }

    function getidcount($table, $name)
    {
        $this->db->select("count(id)");
        $query = $this->db->get($table);
        $this->db->where('name', $name);
        return $query->row_array();
    }

    function getid($table, $name)
    {
        $this->db->select('id');
        $query = $this->db->get($table);
        $this->db->where('name', $name);
        return $query->result();
    }

    function getcategory($name)
    {
        $qry = "select a.* from item_category as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    function gettaxcount($name)
    {
        $qry = "select count(gstid) from taxgst as a where GST ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function saveitemledger($new_insertid)
    {
        $qry = 'SELECT e.id as cid,i.tax_id,a.id as gid,c.id as uid,IFNULL(i.godown,0) as godown FROM item as i left join ims_godown as a on 1=1 left join ( select * from units as b order by b.id asc limit 1) as c on 1=1 left join ( select * from item_category as d order by d.id asc limit 1) as e on 1=1 where i.id=' . $new_insertid . ' order by a.id asc limit 1';
        $query = $this->db->query($qry)->row_array();
        $id = $query['tax_id'];
        $tqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='tax' AND acc_main_id = 10";
        $tquery = $this->db->query($tqry);
        $sqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='saletax' AND acc_main_id = 21";
        $squery = $this->db->query($sqry);
        $pqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='purtax' AND acc_main_id = 19";
        $pquery = $this->db->query($pqry);
        $data['tax'] = $tquery->row_array();
        $data['saletax'] = $squery->row_array();
        $data['purctax'] = $pquery->row_array();
        //        $qry = "update item set item_category_id=IFNULL(item_category_id," . $query['cid'] . ") ,unit_id=IFNULL(unit_id," . $query['uid'] . ") ,godown=IFNULL(godown," . $query['gid'] . "), tax_ledger_id = " . $data['tax']['id'] . " , tax_sales_id = " . $data['saletax']['id'] . ",tax_purchase_id=" . $data['purctax']['id'] . " where id =" . $new_insertid;
        $qry = "update item set item_category_id=IFNULL(item_category_id," . $query['cid'] . ") ,unit_id=IFNULL(unit_id,'0') ,godown=IFNULL(godown," . $query['gid'] . "), tax_ledger_id = " . $data['tax']['id'] . " , tax_sales_id = " . $data['saletax']['id'] . ",tax_purchase_id=" . $data['purctax']['id'] . " where id =" . $new_insertid;
        $this->db->query($qry);
        $qry = "update item set godown= " . $query['gid'] . " where godown=0 and id =" . $new_insertid;
        $this->db->query($qry);
        $qry = "select IFNULL(godown,0) as godown,IFNULL(open_stock,0) as open_stock from item where id=" . $new_insertid;
        $query = $this->db->query($qry)->row_array();
        $qry = "insert INTO item_godown (godown_id,item_id,item_qty,current_stock,open_stock) values (" . $query['godown'] . "," . $new_insertid . "," . $query['open_stock'] . ",0," . $query['open_stock'] . ")";
        $this->db->query($qry);
    }

    function gettaxldg($id)
    {
        $tqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='tax' AND acc_main_id = 10";
        $tquery = $this->db->query($tqry);
        $sqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='saletax' AND acc_main_id = 21";
        $squery = $this->db->query($sqry);
        $pqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='purtax' AND acc_main_id = 19";
        $pquery = $this->db->query($pqry);
        $data['tax'] = $tquery->row_array();
        $data['saletax'] = $squery->row_array();
        $data['purctax'] = $pquery->row_array();
        echo json_encode($data);
    }

    function taxldg_find($search, $type)
    {
        if ($type == "tax") {
            $mainledger = 7;
        } elseif ($type == "saletax") {
            $mainledger = 21;
        } else {
            $mainledger = 19;
        }
        $qry = "select a.name as label,a.* from acc_ledgers as a where (name like('$search%') and acc_main_id=" . $mainledger . ")";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getitemcount($name)
    {
        $qry = "select count(id) as no from item as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        // return $query->row_array();
        $count = 0;
        $result = $query->result();
        foreach ($query->result() as $tt) {
            $total = $tt->no;
            if ($total > 0) {
                $count = 1;
            }
        }

        return $count;
    }



    function check_barcode($id)
    {
        $code = $this->input->post('barcode');
        if ($id == 0) {
            $result = $this->chk_barcode($code);
        } else {
            $qry = "select count(id) as no from item as a where id=" . $id . " and barcode ='" . $code . "'";
            $query = $this->db->query($qry);
            $pre_exist = $query->row()->no;
            if ($pre_exist > 0) {
                $result = 0;
            } else {
                $result = $this->chk_barcode($code);
            }
        }

        if ($result == 0) {
            $response = array('valid' => true);
        } else {
            // Barcode is available
            $response = array('valid' => false, 'message' => 'barcode exists.');
        }
        echo json_encode($response);
    }

    function gettaxid($name)
    {
        $qry = "select gstid from taxgst as a where GST ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    function gethsncount($name)
    {
        $qry = "select count(hsnid) from hsncode as a where hsncode ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function gethsnid($name)
    {
        $qry = "select hsnid from hsncode as a where hsncode ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    public function Add_item($data_item)
    {
        $this->db->insert('item', $data_item);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function Add_item_ledger($data_item_ledger)
    {
        $this->db->insert('item_ledger', $data_item_ledger);

        /* $response = array(
          'valid' => false,
          'type' => 1,
          'message' => 'Saved Successfully.'
          );
          echo json_encode($response); */
    }

    function getgroupcount($name)
    {
        $qry = "select count(id) from item_group as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getitemgroup($name)
    {
        $qry = "select a.* from item_group as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    function getunitcount($name)
    {
        $qry = "select count(id) from units as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getunit($name)
    {
        $qry = "select a.* from units as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    function getgodown()
    {
        $qry = 'select * from ims_godown where id>0 order by id asc limit 1';
        $query = $this->db->query($qry)->row_array();
        return $query['id'];
    }

    function getautocomplete($q, $type)
    {
        $query = $this->db->query("select CONCAT(a.name,' ',a.barcode) as label,a.id,b.current_stock from item as a LEFT JOIN item_godown as b on a.id=b.item_id  where name like ('%" . $q . "%') or barcode  like ('%" . $q . "%') and item_type_id=1 limit 25")->result_array();
        print_r(json_encode($query));
    }

    function getledgeritem($id)
    {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

    function delete($id)
    {
        $qry = "UPDATE `item` SET `published` = 'no' WHERE `item`.`id` = " . $id;
        $this->db->query($qry);
        /* $qry = "delete from item where id =" . $id;
          $this->db->query($qry);
          $gqry = "delete from item_godown where item_id =" . $id;
          $this->db->query($gqry); */
    }
}
