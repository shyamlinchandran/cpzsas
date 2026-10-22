<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stock
 *
 * @author jijodileep
 */
class Items extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/items_model', 'items');
    }
	
	 function order_items($type ="estimate") {
		$data['type'] = $type;
		$data['title'] = 'Order Item Report';
		if($type =='sales'){
			$data['title'] = 'Sales Item Report';
		}
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/order_items',$data);
    }
	
	function fifo_lifo(){
		$data['title'] = 'Stock Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/fifo_lifo',$data);
	}

    function export_report(){
		$data['title'] = 'Export Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/export',$data);
	}

   public function refreshreport() {
    try {
        $apiUrl = 'http://dw.cpzsas.in/jobs/run_item_report.php';
        $apiData['ref_id'] = 1;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only for testing, remove in production
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return [
                'success' => false,
                'message' => 'API request failed',
                'error' => $error
            ];
        }
        
        curl_close($ch);

        return [
            'success' => true,
            'message' => 'Report request logged successfully',
            'existing' => false
        ];

    } catch (Exception $e) {
        error_log("Error in refreshreport: " . $e->getMessage());
        
        return [
            'success' => false,
            'message' => 'Failed to log report request',
            'error' => $e->getMessage()
        ];
    }
}

    public function export_report_list(){
		$this->items->export_report_list();
		$list = $this->items->get_datatables();
		$data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
        $string = '';
        $jsonString = $item->filters ?? '{}';
            $filterData = json_decode($jsonString, true);

            // Initialize an array to store non-empty values
            $nonEmptyValues = [];

            // Check each field and add to array if not empty
            foreach ($filterData as $key => $value) {
                if (!empty($value)) {
                    $nonEmptyValues[$key] = $value;
                }
            }

            // Now display the values
            if (!empty($nonEmptyValues)) {
                foreach ($nonEmptyValues as $key => $value) {
                }
            } else {
            }

            // If you specifically want to handle date differently:
            if (!empty($filterData['date'])) {
                $string = $string .  "Date: " . htmlspecialchars($filterData['date']) ;
            }

            // For other specific fields like brand:
            if (!empty($filterData['brand'])) {
                $qry ="SELECT * FROM item_brand WHERE ibr_id = ".$filterData['brand'];
                $dat = $this->db->query($qry)->row_array();
                 $string = $string . " , Brand ".htmlspecialchars($dat['ibr_name']);
            }


			$no++;
            $row = array();
			$row[] = $no;
			$row[] = $item->createdat;
			$row[] = $item->type;
			$row[] = $item->status;
            $row[] = $string;
        // Add status with clickable download link for completed items
        if ($item->status === 'completed' && !empty($item->file)) {
            $fileUrl = 'https://dw.cpzsas.in/public/exports/' . $item->file;
            $row[] = '<a target="_blank"  tp ="new" href="'.$fileUrl.'"  style="color:blue;text-decoration:underline">Download</a>';
        } else {
            $row[] = ''; // Regular status for non-completed items
        }
$data[] = $row;
		}
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all() + 1,
            "recordsFiltered" => $this->items->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	public function fifo_lifo_list(){
		$this->items->fifo_lifo();
		$list = $this->items->get_datatables();
		$data = array();
        $no = $this->input->post('start');
		$closing_stk_value = 0;
        foreach ($list as $item) {
			//$rate = $item->rate ;
			$rate = 0 ;
			if((float) $rate < 1 ){
				$rate = $item->open_stk_rate;
			}
			$no++;
            $row = array();
			$row[] = $no;
			$row[] = $item->name;
			$row[] = $item->barcode;
			//$row[] = $item->open;
			//$row[] = $item->stock;
			$row[] = (float) $item->open + (float) $item->stock;
			$row[] = round($rate,2);
			$row[] = round(((float) $item->open + (float) $item->stock) * $rate,2);
			$closing_stk_value = (float) $closing_stk_value + ( ((float) $item->open + (float) $item->stock) * $rate);
			$data[] = $row;
		}
		 $row = array();
			$row[] = '';
			$row[] = 'Total ';
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = round($closing_stk_value,3);
			$data[] = $row;
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all() + 1,
            "recordsFiltered" => $this->items->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	public function order_items_list() {
        $this->items->order_items();
        $list = $this->items->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "SELECT * FROM `units` WHERE unit_id = 0 or unit_id is null ";
		//$qry = "SELECT * FROM `units` WHERE  name = 'No' ";
		$query = $this->db->query($qry)->result_array();
		$unit_data = [];
		foreach($query as $item){
			$qry = "SELECT * FROM units WHERE `unit_id` = ".$item['id']." UNION SELECT * FROM units WHERE unit_id IN (SELECT id FROM units WHERE unit_id = ".$item['id'].") order by unit_count desc";
			$result = $this->db->query($qry);
			$unit_array = [];
			if($result->num_rows() > 0 ){
				$result = $result->result_array();
				$i  = 0 ;
				foreach($result as $items){
					$unit_array[$i]['name'] = $items['name'];
					$unit_array[$i]['count'] = $items['unit_count'];
					$unit_array[$i]['id'] = $items['id'];
					$i++;
				}
				$unit_data[$item['id']] = $unit_array;
			}
		}
        foreach ($list as $items) {
			$chk = $items->sub_unit_one + $items->sub_unit_two;
			$i_stock = $items->quantity;
			$text = '';
			if((int) $i_stock > 0 ){
				if(isset($unit_data[$items->unit_id]) ){
					$datas = $unit_data[$items->unit_id];
					foreach($datas as $ustock){
						if($i_stock >= $ustock['count']){
							if($chk < 1 || (int) $items->sub_unit_one == (int)$ustock['id'] || (int) $items->sub_unit_two == (int)$ustock['id'] ){
								$calc = $i_stock / $ustock['count'];
								$calc = floor($calc);
								$i_stock = $i_stock % $ustock['count'];
						
								if($text !=''){
									$text = $text .',';
								}
								$text = $text.' ' . $ustock['name'].' : '.$calc;
							}
							if($i_stock < 2){
								 break;
							}
						}
					}
				}
			}
			if($text !=''){
				$text = $text .',';
			}
			$text = $text.' ' . $items->code.' : '.$i_stock;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->quantity;
            $row[] = $items->code;
			 $row[] = $text;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all(),
            "recordsFiltered" => $this->items->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	
    public function batch_stock() {
		$data['title'] = 'Batch Stock';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/batch_stock',$data);
    }

    public function batch_stock_list() {
        //$this->itemdtl->stocknow();
        $this->items->batch_stock();
        $list = $this->items->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->batch;
            $row[] = $this->number_fm($item->quantity_dr - $item->quantity_cr);
            $row[] = $this->number_fm($item->nos_dr - $item->nos_cr);
            $data[] = $row;
        }
      
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all() + 1,
            "recordsFiltered" => $this->items->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }



	 public function unit_stock() {
		$data['title'] = 'Stock Details';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/unit_stock',$data);
    }
	
	public function unit_stock_list(){
		$this->items->unit_stock();
        $list = $this->items->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "SELECT * FROM `units` WHERE unit_id = 0 or unit_id is null ";
		//$qry = "SELECT * FROM `units` WHERE  name = 'No' ";
		$query = $this->db->query($qry)->result_array();
		$unit_data = [];
		foreach($query as $item){
			$qry = "SELECT * FROM units WHERE `unit_id` = ".$item['id']." UNION SELECT * FROM units WHERE unit_id IN (SELECT id FROM units WHERE unit_id = ".$item['id'].") order by unit_count desc";
			$result = $this->db->query($qry);
			$unit_array = [];
			if($result->num_rows() > 0 ){
				$result = $result->result_array();
				$i  = 0 ;
				foreach($result as $items){
					$unit_array[$i]['name'] = $items['name'];
					$unit_array[$i]['count'] = $items['unit_count'];
					$unit_array[$i]['id'] = $items['id'];
					$i++;
				}
				$unit_data[$item['id']] = $unit_array;
			}
		}
		
        foreach ($list as $items) {
			$chk = $items->sub_unit_one + $items->sub_unit_two;
			$i_stock = $items->stock;
			$text = '';
			if((int) $i_stock > 0 ){
				if(isset($unit_data[$items->unit_id]) ){
					$datas = $unit_data[$items->unit_id];
					foreach($datas as $ustock){
						if($i_stock >= $ustock['count']){
							if($chk < 1 || (int) $items->sub_unit_one == (int)$ustock['id'] || (int) $items->sub_unit_two == (int)$ustock['id'] ){
								$calc = $i_stock / $ustock['count'];
								$calc = floor($calc);
								$i_stock = $i_stock % $ustock['count'];
						
								if($text !=''){
									$text = $text .',';
								}
								$text = $text.' ' . $ustock['name'].' : '.$calc;
							}
							if($i_stock < 2){
								 break;
							}
						}
					}
				}
			}
			if($text !=''){
				$text = $text .',';
			}
			$text = $text.' ' . $items->code.' : '.$i_stock;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->barcode;
            $row[] = $items->code;
            $row[] = $items->stock;
			$row[] = $text;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all(),
            "recordsFiltered" => $this->items->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
	}

    public function listall() {
       $settings = $this->items->getCompanySettings();
		$is_batch = 0 ;
		if(isset($settings[0]['is_batch'])){
			$is_batch = $settings[0]['is_batch'];
		}
        $data['is_batch'] = $is_batch;
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/items',$data);
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/items_list');
    }

    public function listvalue() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/value');
    }

    public function item_list() {
        $this->items->where();
        $list = $this->items->get_datatables();
        
        $item_status = $this->input->post('item_status');
        $target_date = $this->input->post('date') ? $this->items->getDate($this->input->post('date')) : '2030-01-01';
        $settings = $this->items->getCompanySettings();
        $is_batch = 0 ;
        if(isset($settings[0]['is_batch'])){
            $is_batch = $settings[0]['is_batch'];
        }

        // Deduplicate rows from UNION ALL to prevent double-counting in PHP
        $seen_keys = array();
        $unique_list = array();
        foreach ($list as $item) {
            $key = $item->item_id . '_' . $item->id . ($is_batch > 0 ? '_' . $item->batch : '');
            if (isset($seen_keys[$key])) {
                continue;
            }
            $seen_keys[$key] = true;
            $unique_list[] = $item;
        }
        $list = $unique_list;

        // Fetch all debit/credit details in a single bulk query to avoid running N queries in PHP
        $ledger_data = array();
        if (!$item_status) {
            $ledger_where = " WHERE published = 'yes' and trans_date <= " . $this->db->escape($target_date);
            $ledger_join = "";
            if ($this->input->post('godown')) {
                $ledger_where .= ' and godown = ' . $this->db->escape($this->input->post('godown'));
            }
            if ($this->input->post('toid')) {
                $ledger_where .= ' and item_id = ' . $this->db->escape($this->input->post('toid'));
            }
            if ($this->input->post('category') || $this->input->post('brand') || $this->input->post('hsn') || $this->input->post('tax') || $this->input->post('material_type')) {
                $ledger_join = " INNER JOIN item as sub_i on sub_i.id = item_ledger.item_id and sub_i.published = 'yes' ";
                if ($this->input->post('category')) {
                    $ledger_where .= ' and sub_i.item_category_id = ' . $this->db->escape($this->input->post('category'));
                }
                if ($this->input->post('brand')) {
                    $ledger_where .= ' and sub_i.brand_id = ' . $this->db->escape($this->input->post('brand'));
                }
                if ($this->input->post('hsn')) {
                    $ledger_where .= ' and sub_i.hsncode = ' . $this->db->escape($this->input->post('hsn'));
                }
                if ($this->input->post('tax')) {
                    $ledger_where .= ' and sub_i.tax_id = ' . $this->db->escape($this->input->post('tax'));
                }
                if ($this->input->post('material_type')) {
                    $ledger_where .= ' and sub_i.material_type = ' . $this->db->escape($this->input->post('material_type'));
                }
            }
            
            $ledger_query = "SELECT item_id, godown, batch,
                SUM(CASE WHEN trans_type = 'dt' THEN quantity ELSE 0 END) as debit,
                SUM(CASE WHEN trans_type = 'cr' THEN quantity ELSE 0 END) as credit
                FROM item_ledger
                " . $ledger_join . "
                " . $ledger_where . "
                GROUP BY item_id, godown, batch";
            
            $ledger_results = $this->db->query($ledger_query)->result_array();
            foreach ($ledger_results as $row) {
                $key = $row['item_id'] . '_' . $row['godown'] . ($is_batch > 0 ? '_' . $row['batch'] : '');
                $ledger_data[$key] = $row;
            }
        }

        $data = array();
        $no = $this->input->post('start');
        $open_value = 0;
        $in_value = 0;
        $out_value = 0;
        $close_value = 0;
        foreach ($list as $item) {
            if (!$item_status) {
                $key = $item->item_id . '_' . $item->id . ($is_batch > 0 ? '_' . $item->batch : '');
                $item->debit = $ledger_data[$key]['debit'] ?? 0;
                $item->credit = $ledger_data[$key]['credit'] ?? 0;
            }
            
            $open_value = (float) $open_value + (float) $item->stock * $item->open_stk_rate;
            $in_value = (float) $in_value + ((float) $item->purchaserate * $item->debit);
            $out_value = (float) $out_value + (float) $item->salerate * $item->credit;
            
            $op_rate = $item->open_stk_rate > 0 ? $item->open_stk_rate : $item->purchaserate;
            $closing_val = ($item->stock * $op_rate) + (($item->debit - $item->credit) * $item->purchaserate);
            $close_value = (float) $close_value + $closing_val;
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a name= "'.$item->item.'" id="'.$item->item_id.'" onclick = "showstockledeger(this)" >'.$item->item.'</a>';
            $row[] = $item->barcode;
            $row[] = $item->hsn;
            $row[] = $item->unit;
            $row[] = $item->GST;
            $row[] = $item->godown;
            $row[] = $item->stock;
            $row[] = $item->open_stk_rate;
            $row[] = number_format($item->stock * $item->open_stk_rate,$this->company_roundoff);
            $row[] = $item->debit;
            $row[] = $item->salerate;
            $row[] = number_format($item->purchaserate* $item->debit);
            $row[] = $item->credit;
            $row[] = $item->purchaserate;
            $row[] = number_format($item->salerate* $item->credit);
            $row[] = number_format($item->stock + ($item->debit - $item->credit),$this->company_roundoff);
            $row[] = number_format($item->purchaserate,$this->company_roundoff);
            $row[] = number_format($closing_val,$this->company_roundoff);
            $data[] = $row;
        }
        $row = array();
        $row[] = 'Total';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>' . number_format($open_value,$this->company_roundoff) . '</b>';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>' . number_format($in_value,$this->company_roundoff) . '</b>';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>' . number_format($out_value,$this->company_roundoff) . '</b>';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>' . number_format($close_value,$this->company_roundoff) . '</b>';
        $data[] = $row;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all() + 1,
            "recordsFiltered" => $this->items->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        //$this->itemdtl->stocknow();
        $this->items->where();
        $list = $this->items->get_datatables();
        
        $item_status = $this->input->post('item_status');
        $target_date = $this->input->post('date') ? $this->items->getDate($this->input->post('date')) : '2030-01-01';
        $settings = $this->items->getCompanySettings();
		$is_batch = 0 ;
		if(isset($settings[0]['is_batch'])){
			$is_batch = $settings[0]['is_batch'];
		}

        // Deduplication is now handled directly in SQL inside Items_model.php, so no PHP loop is needed.
        
        // Fetch all debit/credit details in a single bulk query to avoid running N queries in PHP
        $ledger_data = array();
        if (!$item_status) {
            $ledger_where = " WHERE published = 'yes' and trans_date <= " . $this->db->escape($target_date);
            $ledger_join = "";
            if ($this->input->post('godown')) {
                $ledger_where .= ' and godown = ' . $this->db->escape($this->input->post('godown'));
            }
            if ($this->input->post('toid')) {
                $ledger_where .= ' and item_id = ' . $this->db->escape($this->input->post('toid'));
            }
            if ($this->input->post('category') || $this->input->post('brand') || $this->input->post('hsn') || $this->input->post('tax') || $this->input->post('material_type')) {
                $ledger_join = " INNER JOIN item as sub_i on sub_i.id = item_ledger.item_id and sub_i.published = 'yes' ";
                if ($this->input->post('category')) {
                    $ledger_where .= ' and sub_i.item_category_id = ' . $this->db->escape($this->input->post('category'));
                }
                if ($this->input->post('brand')) {
                    $ledger_where .= ' and sub_i.brand_id = ' . $this->db->escape($this->input->post('brand'));
                }
                if ($this->input->post('hsn')) {
                    $ledger_where .= ' and sub_i.hsncode = ' . $this->db->escape($this->input->post('hsn'));
                }
                if ($this->input->post('tax')) {
                    $ledger_where .= ' and sub_i.tax_id = ' . $this->db->escape($this->input->post('tax'));
                }
                if ($this->input->post('material_type')) {
                    $ledger_where .= ' and sub_i.material_type = ' . $this->db->escape($this->input->post('material_type'));
                }
            }
            
            $ledger_query = "SELECT item_id, godown, batch,
                SUM(CASE WHEN trans_type = 'dt' THEN quantity ELSE 0 END) as debit,
                SUM(CASE WHEN trans_type = 'cr' THEN quantity ELSE 0 END) as credit
                FROM item_ledger
                " . $ledger_join . "
                " . $ledger_where . "
                GROUP BY item_id, godown, batch";
            
            $ledger_results = $this->db->query($ledger_query)->result_array();
            foreach ($ledger_results as $row) {
                $key = $row['item_id'] . '_' . $row['godown'] . ($is_batch > 0 ? '_' . $row['batch'] : '');
                $ledger_data[$key] = $row;
            }
        }
        
        $openstockvalue = 0;
        $closingstockvalue = 0;
        $openstock = 0;
        $closingstock = 0;
        $cl = 0;
        $cl_val = 0;
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            if (!$item_status) {
                $key = $item->item_id . '_' . $item->id . ($is_batch > 0 ? '_' . $item->batch : '');
                $item->debit = $ledger_data[$key]['debit'] ?? 0;
                $item->credit = $ledger_data[$key]['credit'] ?? 0;
            }
            
            $openstock = $openstock + $item->stock;
            $openstockvalue = $openstockvalue + $item->stock * $item->open_stk_rate;
            
            $op_rate = $item->open_stk_rate > 0 ? $item->open_stk_rate : $item->purchaserate;
            $closing = ($item->stock * $op_rate) + (($item->debit - $item->credit) * $item->purchaserate);
            
            $closingstockvalue = $closingstockvalue + $closing;
            $closingstock = $closingstock + ($item->stock + ($item->debit - $item->credit));
            $cl = $cl + (float) $item->debit - $item->credit + $item->stock;
            $cl_val = $cl_val + $closing;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a name= "'.$item->item.'" id="'.$item->item_id.'" onclick = "showstockledeger(this)" >'.$item->itemname.'</a>';
            $row[] = $item->barcode;
            if($is_batch > 0 ){
                $row[] = $item->batch;
            }
            // $row[] = $item->unit;
            $row[] = $item->godown;
            //$row[] = $item->stock;
          //  $row[] = $item->open_stk_rate;
            //$row[] = number_format($item->stock * $item->open_stk_rate,$this->company_roundoff);
            $row[] = number_format($item->debit - $item->credit + $item->stock,$this->company_roundoff);
            // $row[] = $item->stock + ($item->debit - $item->credit);
            $row[] = number_format($item->purchaserate,$this->company_roundoff);
            $row[] = number_format($closing,$this->company_roundoff);
            // $row[] = $item->salerate;
            // $row[] = $item->MRP;
            $data[] = $row;
        }
        $no++;
        $row = array();
        $row[] = $no;
        if($is_batch > 0 ){
            $row[] = '';
        }
        $row[] = '';
        $row[] = '';
        $row[] = '<b>Total</b>';

        // $row[] = $item->hsn;
        // $row[] = $item->unit;
        // $row[] = $item->godown;
        $row[] = $cl;
        $row[] = '';
        $row[] = '<b>' . number_format($cl_val,$this->company_roundoff) . '</b>';
        $data[] = $row;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all() + 1,
            "recordsFiltered" => $this->items->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function value_list() {
        //$this->itemdtl->stocknow();
        $this->items->where();
        $list = $this->items->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        $ssum = 0;
        $psum = 0;
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a name= "'.$item->item.'" id="'.$item->item_id.'" onclick = "showstockledeger(this)" >'.$item->item.'</a>';
            $row[] = $item->godown;
            $row[] = $item->quantity;
            $row[] = $this->number_fm($item->salerate);
            $row[] = $this->number_fm($item->salerate * $item->quantity);
            $row[] = $this->number_fm($item->purchaserate);
            $row[] = $this->number_fm($item->purchaserate * $item->quantity);
            $data[] = $row;

            $ssum = $ssum + ($item->salerate * $item->quantity);
            $psum = $psum + ($item->purchaserate * $item->quantity);
        }
        $row = array();
        $row[] = "";
        $row[] = "";
        $row[] = label("Total", $this, $this->user);
        $row[] = "";
        $row[] = label("Sales", $this, $this->user);
        $row[] = $this->number_fm($ssum);
        $row[] = label("Purchase", $this, $this->user);
        $row[] = $this->number_fm($psum);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all() + 1,
            "recordsFiltered" => $this->items->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
