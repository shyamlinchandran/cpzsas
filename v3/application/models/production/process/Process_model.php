<?php
class process_model extends DataTable{
    
    public function __construct()
    {
        parent::__construct();
        $this->select = 'a.id,a.bill_no,a.date,b.status,c.user_name,a.voucher_no';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'production_process_main as a inner join production_status as b on a.status=b.id inner join users as c on a.user=c.id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'bill_no'); //set column field database for datatable orderable   
        $this->column_search = array('bill_no'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    } 
    function where(){

        $this->wherecondition = " where a.is_available = 'Yes' ";

    }


    function statusSearch(){
        $qry= $this->db->get('production_status')->result_array();
        return $qry;

        }
    function userSearch(){
         $qry= $this->db->get('users')->result();
         return $qry;
    }

        function productSearch($search){
            $qry=$this->db->select('a.*,b.name,b.srate,b.MRP')->from('bom_main as a')->join('item as b','a.itemid=b.id')->like('b.name',$search,'AFTER')->where('a.is_available','Yes')->group_by('b.id')->get()->result_array();
            foreach($qry as $row){
                $new_row['value']=htmlentities(stripcslashes($row['name']));
                $new_row['id']=htmlentities(stripcslashes($row['id']));
                $new_row['quantity']=htmlentities(stripcslashes($row['quantity']));
				$new_row['item_id']=htmlentities(stripcslashes($row['itemid']));
				$new_row['srate']=htmlentities(stripcslashes($row['srate']));
				$new_row['MRP']=htmlentities(stripcslashes($row['MRP']));
                $row_set[]= $new_row;
            }  
            echo json_encode($row_set);

        }
       function ledgerSearch($search){
            
        $qry=$this->db->like('name',$search,'AFTER')->get('acc_ledgers')->result_array();
            foreach($qry as $row)   {

                $new_row['value']=htmlentities(stripcslashes($row['name']));
                $new_row['id']=htmlentities(stripcslashes($row['id']));
                $row_set[]= $new_row;
            }  
            echo json_encode($row_set);
    
        }

        function getMaterialList($id){

            $qry=$this->db->select('a.*,b.name')->from('bom_sub_material as a')->join('item as b','a.materialid=b.id')->where('a.productid',$id)->where('a.is_available','Yes')->get()->result_array();
            echo json_encode($qry);
                
                    }
        function getLedgerList($id){
            $qry=$this->db->select('a.*,b.name')->from('bom_sub_ledger as a')->join('acc_ledgers as b','a.ledgerid=b.id')->where('a.productid',$id)->where('a.is_available','Yes')->get()->result_array();
            echo json_encode($qry);
                            
       }
        
        
		function restore_process($id){
			$qry = 'update item_ledger set published ="no" where trans_status ="man_journal" and trans_id =  '.$id;
			$this->db->query($qry);
			$qry = 'update acc_ledger_trans set published ="no" where tb_name = "man_journal" and tb_id = '.$id.' ';
			$this->db->query($qry);
			$qry = "select * from production_process_products where main_id =".$id." and is_available ='Yes' ";
			$result = $this->db->query($qry)->result_array();
			foreach($result as $item){
				$ttp = 'cr';
				$this->godown_stock_trans(0, $item['item_id'], $item['quantity'], $ttp, 'man_journal', $item['godown_id'], 0);
			}
			$qry = "select * from production_process_material_table where main_table_id = ".$id." and is_available='Yes' ";
			$result = $this->db->query($qry)->result_array();
			foreach($result as $item){
				$ttp = 'dt';
				$this->godown_stock_trans(0, $item['material_id'], $item['material_quantity'], $ttp, 'man_journal', $item['godown_id'], 0);
			}
		}
		
		public function getinvoice(){
			$qry ="select * from production_process_main where is_available ='yes' and voucher_no!='' order by id desc limit 0,1";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0 ){
				$query = $query->row_array();
				$invoice = str_replace('MJ', "", $query['voucher_no']);
				$invoice = (int) $invoice + 1;
				return 'MJ'.$invoice;
			}else{
			return 'MJ1';
			}
		
		}
	
	
        function save(){
			$tmp = $this->session->userdata('user');
			$userid = $tmp['Id'];
			$voucher_no =$this->getinvoice();
            $id=$this->input->post('id');
            $bill_no =$this->input->post('bill_no');
            $date = $this->getDate($this->input->post('date'));
            $status =$this->input->post('status');
            $user =  $this->input->post('user');
            $product_id=$this->input->post('product_id',TRUE);
            $product_quantity=$this->input->post('quantity',TRUE);
            $sale_rate=$this->input->post('sale_rate',TRUE);
            $mrp=$this->input->post('mrp',TRUE);
            $addtnl_ledger_id=$this->input->post('adtnl_ledger_id',TRUE);
            $addtnl_ledger_amount=$this->input->post('adtnl_ledger_amount',TRUE);
            $material_id=$this->input->post('material_id',TRUE);
            $material_row_total=$this->input->post('material_row_total',TRUE);
            $material_quantity=$this->input->post('material_quantity',TRUE);
            $material_price=$this->input->post('material_price',TRUE);
            $sub_product_id=$this->input->post('sub_product_id',TRUE);
            $production_rate=$this->input->post('production_rate',TRUE);
			$production_unit_rate = $this->input->post('production_unit_rate',TRUE);
            $ledger_id=$this->input->post('ledger_id',TRUE);
            $ledger_amount=$this->input->post('ledger_amount',TRUE);
            $ledger_product_id=$this->input->post('sub_ledger_product_id',TRUE);
            $ledger_table_id=$this->input->post('ledger_table_id',TRUE);
            $material_table_id=$this->input->post('material_table_id',TRUE);
            $product_table_id=$this->input->post('products_table_id',TRUE);
			$material_godown = $this->input->post('material_godown',TRUE);
            $addtnl_ledger_table_id=$this->input->post('addtnl_ledger_table_id',TRUE);
			$products_godown_id = $this->input->post('products_godown_id',TRUE);
			$item_ids = $this->input->post('item_ids',TRUE);
            $ledger_table_length=0;
            $length=0; $addtnl_ledger_length=0; $material_table_length=0;
            if($this->input->post('ledger_id',TRUE))  {

                $ledger_table_length = sizeof($this->input->post('ledger_id',TRUE));
 
             }
            if($this->input->post('product_id',TRUE))  {

               $length = sizeof($this->input->post('product_id',TRUE));

            }
            if($this->input->post('adtnl_ledger_id',TRUE))  {

                $addtnl_ledger_length = sizeof($this->input->post('adtnl_ledger_id',TRUE));
            }
            if($this->input->post('material_id',TRUE))  {

                $material_table_length = sizeof($this->input->post('material_id',TRUE));
            }

            $data = array(
               'bill_no'=>$bill_no,
                'date'=>$date,
                'status'=>$status,
                'user'=>$user
            );

         if($id== 0){
			$data['voucher_no'] = $voucher_no;
            $this->db->insert('production_process_main',$data);
            $id = $this->db->insert_id();

        }
        else{
			$qry = "select * from production_process_main where id =".$id;
			$main_data = $this->db->query($qry)->row_array();
			$voucher_no = $main_data['voucher_no'];
			$this->restore_process($id);
            $this->db->where('id',$id)->update('production_process_main',$data);

            if($this->input->post('products_table_id',TRUE)) {
                $product_table_ids =implode(',', $product_table_id);
                $updatedata['is_available'] = 'No';
                $this->db->where("id NOT IN ($product_table_ids) and main_id = $id");
                $this->db->update('production_process_products',$updatedata);
            }
            else    {
                $updatedata['is_available'] = 'No';
                $this->db->where('main_id',$id);
                $this->db->update('production_process_products',$updatedata);
            }
            if($this->input->post('addtnl_ledger_table_id',TRUE)) {
                $ledger_table_id =implode(',', $addtnl_ledger_table_id);
                $updatedata['is_available'] = 'No';
                $this->db->where("id NOT IN ($ledger_table_id) and main_table_id = $id");
                $this->db->update('production_process_additional_ledgers',$updatedata);
            }
            else    {
                $updatedata['is_available'] = 'No';
                $this->db->where('main_table_id',$id);
                $this->db->update('production_process_additional_ledgers',$updatedata);
            }

        }
            if($id){
                for($i=0; $i < $length; $i++) {
					$itemData = array(
						'prate'=>$production_unit_rate[$i],
						'srate'=>$sale_rate[$i],
						'MRP'=>$mrp[$i]
					);
					$this->db->where('id',$item_ids[$i]);
					$this->db->update('item',$itemData);
                    $pro_data =array(
                        'main_id'=>$id,
						'godown_id'=>$products_godown_id[$i],
						'item_id'=>$item_ids[$i],
                        'product_id'=>$product_id[$i],
                        'quantity'=>$product_quantity[$i],
                        'sales_rate'=>$sale_rate[$i],
                        'mrp'=>$mrp[$i],
                        'production_cost'=>$production_rate[$i]
                    );
                    if($product_table_id[$i] == 0){

                         $this->db->insert('production_process_products',$pro_data);

                    }
                    else{
                        $this->db->where('id',$product_table_id[$i])->update('production_process_products',$pro_data);

                    }
					$ttp = 'dt';
					$this->stock_trans(0,$item_ids[$i], $product_quantity[$i], $date, $ttp, 'man_journal', $id, $sale_rate[$i], $sale_rate[$i], 0,  $products_godown_id[$i], $voucher_no, 0);
					$this->godown_stock_trans(0, $item_ids[$i], $product_quantity[$i], $ttp, 'man_journal', $products_godown_id[$i], 0);

                 }
                 for($j=0; $j < $material_table_length; $j++)    {
                    $material_table_data =array(
                        'main_table_id'=>$id,
						'godown_id'=>$material_godown[$j],
                        'product_table_id'=> $sub_product_id[$j],
                        'material_id'=>$material_id[$j],
                        'material_quantity'=>$material_quantity[$j],
                        'material_price'=>$material_price[$j],
                        'material_row_total'=>$material_row_total[$j]
                    );
                    if($material_table_id[$j]== 0){

                    $this->db->insert('production_process_material_table',$material_table_data );
                    }
                    else{

                        $this->db->where('id',$material_table_id[$j])->update('production_process_material_table',$material_table_data );

                    }
					$ttp = 'cr';
					$this->stock_trans(0,$material_id[$j], $material_quantity[$j], $date, $ttp, 'man_journal', $id, $material_price[$j], $material_price[$j], 0,  $material_godown[$j], $voucher_no, 0);
					$this->godown_stock_trans(0,$material_id[$j], $material_quantity[$j], $ttp, 'man_journal', $material_godown[$j], 0);
                }
                for($k=0; $k < $ledger_table_length; $k++)    {

                    $ledger_table_data =array(
                        'main_table_id'=>$id,
                        'product_table_id'=> $ledger_product_id[$k],
                        'ledger_id'=> $ledger_id[$k],
                        'ledger_amount'=>$ledger_amount[$k],
                       
                    );
                    if($ledger_table_id[$k]== 0){

                    $this->db->insert('production_process_ledger_table',$ledger_table_data );
                    }
                    else
                    {

                        $this->db->where('id',$ledger_table_id[$k])->update('production_process_ledger_table',$ledger_table_data );

                    }
					$this->trans_save($voucher_no, $id, "man_journal", "man_journal", $this->cashaccount, $ledger_id[$k], $date, '0.00', $ledger_amount[$k], 'naration', $userid, 0, 0);
					$this->trans_save($voucher_no, $id, "man_journal", "man_journal",$ledger_id[$k], $this->cashaccount, $date, $ledger_amount[$k], '0.00', 'naration', $userid, 0, 0);

                }
                 for($i=0; $i < $addtnl_ledger_length; $i++) {

                    $addtnl_ledger_data =array(
                        'main_table_id'=>$id,
                        'ledger_id'=>$addtnl_ledger_id[$i],
                        'ledger_amount'=>$addtnl_ledger_amount[$i],
                    );
                    if($addtnl_ledger_table_id[$i]== 0){

                    $this->db->insert('production_process_additional_ledgers',$addtnl_ledger_data);
                    }
                    else{

                        $this->db->where('id',$addtnl_ledger_table_id[$i])->update('production_process_additional_ledgers',$addtnl_ledger_data);

                    }
                 }
                 
            }

            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
            echo json_encode($response);

            
        }
        function delete($id){
			$this->restore_process($id);
            $data=[
                'is_available'=>"No"
            ];
            $this->db->where('id',$id)->update('production_process_main',$data);

        }
        function getData($id){

            $qry = $this->db->select('a.id,a.bill_no,a.date,a.status,a.user')->from('production_process_main as a')->where('a.id',$id)->get()->row_array();
            return $qry;
            echo json_encode($qry);
     
         }
         function getProductData($id){
            $qry = $this->db->select('a.*,c.name,ig.godown_code as godown_name')->from('production_process_products as a')->join('ims_godown as ig','ig.id = a.godown_id')->join('item as c','a.item_id=c.id')->where('a.main_id', $id)->where('a.is_available', 'Yes')->get()->result_array();
            return $qry;
        }
         function getMaterialData($id){
            //$qry = $this->db->select('a.,b.name,ig.godown_code as godown_name,ppp.quantity as product_quantity')->from('production_process_material_table as a')->join('production_process_products as ppp','ppp.product_id = a.product_table_id and ppp.is_available = "yes"  and a.is_available ="yes"')->join('ims_godown as ig','ig.id = a.godown_id')->join('item as b','a.material_id = b.id')->where('a.main_table_id', $id)->get()->result_array();
            $qry = "SELECT `a`.*, `b`.`name`, `ig`.`godown_code` as `godown_name`, `ppp`.`quantity` as `product_quantity`
FROM `production_process_material_table` as `a`
JOIN `production_process_products` as `ppp` ON `ppp`.`product_id` = `a`.`product_table_id` and `ppp`.`is_available` = 'yes' and `a`.`is_available` ='yes'
JOIN `ims_godown` as `ig` ON `ig`.`id` = `a`.`godown_id`
JOIN `item` as `b` ON `a`.`material_id` = `b`.`id`
WHERE `a`.`main_table_id` = ".$id." and main_id =".$id." ";
			$qry = $this->db->query($qry)->result_array();
			return $qry;
        }
        function getLedgerData($id){
            $qry = $this->db->select('a.*,b.name')->from('production_process_ledger_table as a')->join('acc_ledgers as b','a.ledger_id = b.id')->where('a.main_table_id', $id)->get()->result_array();
            return $qry;
        }
        function getAddtnlLedgerData($id){
            $qry = $this->db->select('a.*,b.name')->from('production_process_additional_ledgers as a')->join('acc_ledgers as b','a.ledger_id = b.id')->where('a.main_table_id', $id)->where('a.is_available', 'Yes')->get()->result_array();
            return $qry;
        }
}
?>