<?php
class Bom_model extends DataTable{
    
    public function __construct()
    {
        parent::__construct();
        $this->select = 'a.*,b.name';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'bom_main as a inner join item as b on a.itemid=b.id and b.published ="yes" ';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable   
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    } 
    function where(){

        $this->wherecondition = " where a.is_available = 'Yes' ";

    }

    function delete($id){
        $data['is_available']='No';

        $qry = $this->db->where('id',$id)->update('bom_main',$data);
        if($qry){

            $this->db->where('productid',$id)->update('bom_sub_material',$data);
            $this->db->where('productid',$id)->update('bom_sub_ledger',$data);

        }
    }
    function getData($id){

       $qry = $this->db->select('a.*,b.name')->from('bom_main as a')->join('item as b','a.itemid = b.id')->where('a.id',$id)->get()->row_array();
       return $qry;
       echo json_encode($qry);

    }
    function getMaterialData($id){
        $qry = $this->db->select('a.*,b.name')->from('bom_sub_material as a')->join('item as b','a.materialid = b.id')->where('a.productid', $id)->where('is_available','Yes')->get()->result_array();
        return $qry;
    }
    function getLedgerData($id){
        $qry = $this->db->select('a.*,b.name')->from('bom_sub_ledger as a')->join('acc_ledgers as b','a.ledgerid = b.id')->where('a.productid', $id)->where('is_available','Yes')->get()->result_array();
        return $qry;
    }

     function product_search($search){
        $qry= $this->db->like('name',$search,'AFTER')->where('material_type','1')->where('published','yes')->get('item');

        if($qry->num_rows()>0)  {

            $result =$qry->result_array();
            foreach ($result as $row){
                $new_row['value'] = htmlentities(stripcslashes($row['name']));
                $new_row['id'] = htmlentities(stripcslashes($row['id']));
                $row_set[]=$new_row;
            }
            echo json_encode($row_set);
            
        }
    }
    function search_material($search){

        $qry=   $this->db->like('name',$search,'AFTER')->where('material_type','2')->where('published','yes')->get('item');

        if($qry->num_rows()>0){

            $result= $qry->result_array();
            foreach($result as $row){
            $new_row['value'] = htmlentities(stripcslashes($row['name']));
            $new_row['id'] = htmlentities(stripcslashes($row['id']));
            $new_row['prate'] = htmlentities(stripcslashes($row['prate']));

            $row_set[] = $new_row;
        }
        echo json_encode($row_set);
      }
    }

    function search_ledger($search){
        $qry = $this->db->like('name',$search,'AFTER')->get('acc_ledgers');

        if($qry->num_rows()>0){

            $result= $qry->result_array();
            foreach($result as $row){

            $new_row['value'] = htmlentities(stripcslashes($row['name']));
            $new_row['id'] = htmlentities(stripcslashes($row['id']));
            $row_set[] = $new_row;
        }
        echo json_encode($row_set);
      }
    }

     function save(){
        $settings = $this->getCompanySettings();
        $is_export_invoice = 0;
        if (isset($settings[0]['is_export_invoice'])) {
            $is_export_invoice = $settings[0]['is_export_invoice'];
        }
        $item_id=$this->input->post('item_id');
        $product_id = $this->input->post('product_id');
        $product_quantity = $this->input->post('pro_quantity');
        $price_per_product = $this->input->post('price_per_product1');
        $grandTotal = $this->input->post('amount');
        $ledgerTotal = $this->input->post('ledgeramount');
        $materialTotal = $this->input->post('materialamount');
        $materialid = $this->input->post('materialid',TRUE);
        $material_quantity = $this->input->post('quantity',TRUE);
        $material_price = $this->input->post('price',TRUE);
        $total = $this->input->post('total',TRUE);
        $percentage = $this->input->post('percentage',TRUE);
        $ledgerid = $this->input->post('ledgerid',TRUE);
        $ledger_amount = $this->input->post('ledger_amount',TRUE);
        $materialtableid = $this->input->post('materialtableid',TRUE);
        $ledgertableid = $this->input->post('ledgertableid',TRUE);
        $llength=0;
        $mlength=0;
        if($this->input->post('total',TRUE)){
                $mlength = sizeof($total);
        }
        if($this->input->post('ledger_amount',TRUE)>0){
            $llength = sizeof($ledger_amount);
    }
        $pro_data=array(
            "itemid"=>$product_id,
            "quantity"=>$product_quantity,
            "price_per_quantity"=>$price_per_product,
            'ledgertotal'=>$ledgerTotal,
            'materialtotal'=>$materialTotal,
            "grandtotal"=>$grandTotal
        );  
            if($item_id == 0)
            {

            $this->db->insert('bom_main',$pro_data);
            $id= $this->db->insert_id();
            }

            else{

                $this->db->where('id',$item_id);
                $this->db->update('bom_main',$pro_data);
                $id= $item_id;

                if($this->input->post('materialtableid',TRUE)) {
                    $material_table_id =implode(',', $materialtableid);
                    $updatedata['is_available'] = 'No';
                    $this->db->where("id NOT IN ($material_table_id) and productid = $id");
                    $this->db->update('bom_sub_material',$updatedata);
                }
                else    {
                    $updatedata['is_available'] = 'No';
                    $this->db->where('productid',$id);
                    $this->db->update('bom_sub_material',$updatedata);
                }
                 if($this->input->post('ledgertableid',TRUE)) {
                    $ledger_table_id =implode(',', $ledgertableid);
                    $updatedata['is_available'] = 'No';
                    $this->db->where("id NOT IN ($ledger_table_id) and productid = $id");
                    $this->db->update('bom_sub_ledger',$updatedata);
                }
                else    {
                    $updatedata['is_available'] = 'No';
                    $this->db->where('productid',$id);
                    $this->db->update('bom_sub_ledger',$updatedata);
                }
            }

            if($id){
                
                for($i=0; $i < $mlength ; $i++){
                $material_table_id=$materialtableid[$i];
                $mat_data=array(
                    'materialid'=>$materialid[$i],
                    'productid'=>$id,
                    'quantity'=>$material_quantity[$i],
                    'price'=>$material_price[$i],
                    'total'=>$total[$i]

                );
                if ($is_export_invoice > 0) {
                    $mat_data['percentage'] = isset($percentage[$i]) ? $percentage[$i] : 0;
                }
                if($material_table_id == 0){

                $this->db->insert('bom_sub_material', $mat_data);

                }
                else{
                    $this->db->where('id', $material_table_id)->update('bom_sub_material', $mat_data);

                }
            }
           

            for($i=0; $i <$llength ; $i++){
                $ledger_table_id=$ledgertableid[$i];
                $led_data=array(
                    'ledgerid'=>$ledgerid[$i],
                    'productid'=>$id,
                    'amount'=>$ledger_amount[$i]
                   
                );
                if($ledger_table_id == 0 ){
                $this->db->insert('bom_sub_ledger', $led_data);
                }
                else{
                    $this->db->where('id', $ledger_table_id)->update('bom_sub_ledger', $led_data);

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

    
}



?>