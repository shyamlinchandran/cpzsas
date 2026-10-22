<?php
class Purchase_order_pending_model extends DataTable
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

        $this->select = 'p.id,p.date,p.rdate,p.invoice as po_no, su.name as supplier_name, i.name as item_name,pi.base_quantity as 
        order_qty,pi.order_quantity as billed_qty , CASE WHEN(pi.base_quantity > pi.order_quantity) THEN ((pi.base_quantity-pi.order_quantity)) 
        else "0" END AS balance_qty ';
        $this->table = 'purchase as p left join 

        purchase_items as pi on pi.purchase_id=p.id
        left join suppliers as su on su.id=p.supplier_id left join 
        item as i on i.id = pi.item_id';
        $this->column_order = array('p.id', 'su.name', 'i.name');
        $this->column_search = array('su.name', 'i.name');
        $this->order = array('p.id' => 'desc');
        $this->db->wherecondition = "where type='order' p.status!='completed'";
        if ($this->input->post('startdate')) {
            $this->db->wherecondition = $this->wherecondition . ' and p.date>="' . $startdate . '"';
        }
        if ($this->input->post('enddate')) {
            $this->db->wherecondition = $this->wherecondition . ' and p.date<="' . $enddate . '"';
        }
        if ($this->input->post('supname')) {
            $this->db->wherecondition = $this->wherecondition . 'and su.id = "' . $customer . '"';
        }
        if ($this->input->post('item')) {
            $this->db->wherecondition = $this->wherecondition . 'and i.id = "' . $item . '"';
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
