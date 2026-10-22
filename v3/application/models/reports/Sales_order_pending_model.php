<?php
class Sales_order_pending_model extends DataTable
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function where()
    {
        $startdate = $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
        $item = $this->input->post('item_id');
        $customer = $this->input->post('customer_id');

        $this->select = 's.sales_id,si.sal_itms_id ,s.delivery_date,s.invoice_date,s.invoice as so_no, su.name as customer_name,
        i.name as item_name,si.quantity as order_qty,si.estimate_quantity as billed_qty , CASE WHEN(si.quantity > si.estimate_quantity) 
        THEN ((si.quantity-si.estimate_quantity)) else "0" END AS balance_qty';
        $this->table = 'sales as s left join sales_items as si on si.sales_id=s.sales_id left join suppliers as su on su.id=s.customer_id
         left join item as i on i.id = si.item_id';
        $this->column_order = array('s.sales_id', 'su.name', 'i.name');
        $this->column_search = array('su.name', 'i.name');
        $this->order = array('s.sales_id' => 'desc');
        $this->wherecondition = "where s.status!='completed' and s.type = 'estimate' ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date>="' . $startdate . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date<="' . $enddate . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . 'and su.id = "' . $customer . '"';
        }
        if ($this->input->post('item')) {
            $this->wherecondition = $this->wherecondition . 'and i.id = "' . $item . '"';
        }
    }
    public function get_item($search)
    {
        $qry = "SELECT id,name as label FROM item where name like('%$search%')";
        $result = $this->db->Query($qry);
        echo json_encode($result->result_array());
    }
    public function get_customer($search)
    {
        $qry = "SELECT id,name as label FROM suppliers where name like('%$search%')";
        $result = $this->db->Query($qry);
        echo json_encode($result->result_array());
    }
}
