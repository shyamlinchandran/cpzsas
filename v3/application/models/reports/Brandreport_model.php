<?php
class Brandreport_model extends DataTable{
    public function __construct()
    {
       parent::__construct();
       $this->load->database(); 
    }
	
	public function brand_list(){	
		$this->wherecondition = " where s.published ='yes' and  si.published ='yes' ";
        
        if($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  s.bill_type  =' . $this->input->post('btype');
        }

        if($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
		
        if($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		
        if($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  i.id  =' . $this->input->post('toid');
        }
		
        if($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.customer_id  =' . $this->input->post('cusid');
        }
		
        if ($this->input->post('hsnid')) {
            $this->wherecondition = $this->wherecondition . ' and  i.hsncode  =' . $this->input->post('hsnid');
        }
		
		if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and  s.area  =' . $this->input->post('area');
        }
		
		if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and  s.route  =' . $this->input->post('route');
        }
		
		
		
		if ($this->input->post('category')) {
			$category = $this->input->post('category',true);
			$category_text = '';
			foreach($category as $brnd){
				if($brnd != '' ){
					if($category_text != '' ){
						$category_text = $category_text .' or ';
					}
					$category_text = $category_text . '  i.item_category_id = '.$brnd.'  ';
				}
			}
			if($category_text != ''){
				$this->wherecondition = $this->wherecondition . ' and('.$category_text.')';
			}
        }
		
		
		if ($this->input->post('brand')) {
			$brand = $this->input->post('brand',true);
			$brand_text = '';
			foreach($brand as $brnd){
				if($brnd != '' ){
					if($brand_text != '' ){
						$brand_text = $brand_text .' or ';
					}
					$brand_text = $brand_text . '  i.brand_id = '.$brnd.'  ';
				}
			}
			if($brand_text != ''){
				$this->wherecondition = $this->wherecondition . ' and('.$brand_text.')';
			}
        }
		
		if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and s.salesman ="' . $this->input->post('salesman') . '"';
        }
		
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  s.created_by  =' . $this->input->post('user');
		}
        
		if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and s.ref_id ="' . $this->input->post('reference') . '"';
        }
		
		if ($this->input->post('branch')) {
			$this->wherecondition = $this->wherecondition . ' and  sb.branch_id  ="' . $this->input->post('branch').'"';
		}
		if($this->input->post('filter_by') == 'brand' ){
			$this->group = "i.brand_id";	
		}else{
			$this->group = "i.item_category_id";	
		}
        
        $this->table ="sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and s.published ='yes' and si.published = 'yes' INNER JOIN item as i on i.id = si.item_id LEFT JOIN item_brand as ib on ib.ibr_id =i.brand_id left join item_category as ic on ic.id = i.item_category_id LEFT JOIN set_billtype as sb on sb.id = s.bill_type LEFT JOIN suppliers as sup on sup.id = s.customer_id ";
		$this->column_order = array(null, 'sup.name', 'sup.name','sup.name', 'sup.name'); //set column field database for datatable orderable
        $this->column_search = array('i.barcode','sup.name', 'i.name'); //set column field database for datatable searchable 
        $this->select =  " ic.name as categoryname,sum(dis_amt) as dis_amt,IFNULL(ibr_name,'Nil') as brand,CASE WHEN IFNULL(sup.name,s.cusname) ='' THEN 'Cash' else IFNULL(sup.name,s.cusname) end as customer,sum(si.total - si.tax - si.itm_raw_ces) as taxable,sum(si.tax) as tax,sum(si.itm_raw_ces) as cess,sum(si.total) as total";
		$this->order = array('sup.name' => 'asc'); // default order 
	}
	public function brand_category_list(){
		$this->wherecondition = " where s.published ='yes' and  si.published ='yes'";
        
        if($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  s.bill_type  =' . $this->input->post('btype');
        }

        if($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
		
        if($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		
        if($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  i.id  =' . $this->input->post('toid');
        }
		
        if($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.customer_id  =' . $this->input->post('cusid');
        }
		
        if($this->input->post('hsnid')) {
            $this->wherecondition = $this->wherecondition . ' and  i.hsncode  =' . $this->input->post('hsnid');
        }
		
		if($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and  s.area  =' . $this->input->post('area');
        }
		
		if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and  s.route  =' . $this->input->post('route');
        }
		
		if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and  i.item_category_id  =' . $this->input->post('category');
        }
		
		if ($this->input->post('brand')) {
			$brand = $this->input->post('brand',true);
			$brand_text = '';
			foreach($brand as $brnd){
				if($brand_text != '' ){
					$brand_text = $brand_text .' or ';
				}
				$brand_text = $brand_text . '  i.brand_id = '.$brnd.'  ';
			}
            $this->wherecondition = $this->wherecondition . ' and('.$brand_text.')';
        }
		
		if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and s.salesman ="' . $this->input->post('salesman') . '"';
        }
		
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  s.created_by  =' . $this->input->post('user');
		}
		
        if($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and s.ref_id ="' . $this->input->post('reference') . '"';
        }
		
		if($this->input->post('branch')) {
			$this->wherecondition = $this->wherecondition . ' and  sb.branch_id  ="' . $this->input->post('branch').'"';
		}
		
        $this->group = "s.customer_id";
        $this->table ="sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and s.published ='yes' and si.published = 'yes' INNER JOIN item as i on i.id = si.item_id LEFT JOIN item_brand as ib on ib.ibr_id =i.brand_id LEFT JOIN set_billtype as sb on sb.id = s.bill_type LEFT JOIN suppliers as sup on sup.id = s.customer_id ";
		$this->column_order = array(null, 'sup.name', 'sup.name','sup.name', 'sup.name'); //set column field database for datatable orderable
        $this->column_search = array('i.barcode','sup.name', 'i.name'); //set column field database for datatable searchable 
        $this->select =  " CASE WHEN IFNULL(sup.name,s.cusname) ='' THEN 'Cash' else IFNULL(sup.name,s.cusname) end as customer,sum(si.total - si.tax -  si.itm_raw_ces) as taxable,sum(si.tax) as tax,sum(si.itm_raw_ces) as cess,sum(si.total) as total";
		$this->order = array('sup.name' => 'asc'); // default order 
	}
}