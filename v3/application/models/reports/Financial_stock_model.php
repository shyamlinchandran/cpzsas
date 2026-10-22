<?php
class Financial_stock_model extends DataTable
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->select = 'f.*';
        $this->table = 'financial_stock as f';
        $this->column_search = array('f.created_by');
        $this->column_order = array('f.id');
        $this->order = array('id'=>'desc');
    }
    public function save()
    {
        $id = $this->input->post('id');
        $item_code_id = $this->input->post('item_code_id',true);
        $invoice = $this->input->post('invoice');
        $date = $this->input->post('date');
        $item_code = $this->input->post('item_code',true);
        $name = $this->input->post('name',true);
        $hsn =  $this->input->post('hsn_code',true);
        $vendor = $this->input->post('vendor',true);
        $prate = $this->input->post('prate',true);
        $srate = $this->input->post('srate',true);
        $gst = $this->input->post('gst',true);
        $cgst = $this->input->post('cgst',true);
        $sgst = $this->input->post('sgst',true);
        $igst = $this->input->post('igst',true);
        $quantity = $this->input->post('qty',true);

        $data = array(
           'invoice'=> $invoice,
           'created_date'=> $date
        );
        if($id == 0)
        {
            $this->db->insert('financial_stock',$data);
            $insert_id = $this->db->insert_id();
        }else{
            $insert_id = $id;
            $this->db->where('id',$id);
            $this->db->update('financial_stock',$data);
            // $qry = "delete from financial_stock_items where stock_id =" . $id;
            // $this->db->Query($qry);
        }
        if ($this->input->post('item_code_id', true)) {

            $length = sizeof($item_code_id);
            for ($i = 0; $i < $length; $i++) {
                $data_items = array(

                    'stock_id' => $insert_id,
                    'item_id' => $item_code_id[$i],
                    'code' => $item_code[$i],
                    'name' => $name[$i],
                    'hsn' => $hsn[$i],
                    'vendor' => $vendor[$i],
                    'prate' => $prate[$i],
                    'srate' => $srate[$i],
                    'cgst' => $cgst[$i],
                    'sgst' => $sgst[$i],
                    'igst' => $igst[$i],
                    'gst' => $gst[$i],
                    'quantity' => $quantity[$i]
                );
                $qry ="select * from financial_stock_items where stock_id=" .$insert_id ." and  item_id=" . $item_code_id[$i]; 
                $query = $this->db->query($qry);
                if($query->num_rows() > 0 )
                {
                    $qry = "update financial_stock_items set quantity = quantity+".(float) $quantity[$i]. " where  stock_id=" .$insert_id ." and item_id=".$item_code_id[$i]; 
                    $this->db->query($qry);
                }else{
                    $this->db->insert('financial_stock_items',$data_items);
                }
            }
        }
        $response = array(
            'valid' =>false,
            'type' => 1,
            'message' =>'Saved Successfully'
        );
        echo json_encode($response);
    }
    public function delete($id)
    {
        $qry = 'Delete from financial_stock where id=' .$id;
        $this->db->query($qry);
    }
    function getsing($id)
    {
        $qry = 'select f.* from financial_stock as f where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());       
    }
    public function auto_item($search,$type)
    {
        $qry = 'SELECT i.id as item_id,i.name as label,i.barcode ,h.hsncode,ic.name as vendor,i.prate,i.srate,t.GST/2 as sgst,t.GST/2 as cgst,0 as igst,
        t.GST,1 as quantity FROM item as i LEFT JOIN item_category as ic on ic.id =i.item_category_id left JOIN hsncode as h on
        h.hsnid = i.hsncode left JOIN taxgst as t on t.gstid =i.tax_id where i.name like("%'.$search.'%")';
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    public function auto_barcode($search)
    {
        $qry = 'SELECT i.id as item_id,i.name,i.barcode as label,h.hsncode,ic.name as vendor,i.prate,i.srate,t.GST/2 as sgst,t.GST/2 as cgst,0 as igst,
        t.GST,1 as quantity FROM item as i LEFT JOIN item_category as ic on ic.id =i.item_category_id left JOIN hsncode as h on
        h.hsnid = i.hsncode left JOIN taxgst as t on t.gstid =i.tax_id where i.barcode = "' .$search.'"';
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    public function get_data()
    {
        $this->load->database();
        $this->select = 'f.*';
        $this->table = 'financial_stock_items as f';
        $this->column_search = array('f.vendor','f.name','f.hsn');
        $this->column_order = array('f.id');
        $this->order = array('id'=>'desc');
		if($this->input->post('id') ){
			$this->wherecondition = ' where stock_id = '.$this->input->post('id');
		}
		
    }
}
