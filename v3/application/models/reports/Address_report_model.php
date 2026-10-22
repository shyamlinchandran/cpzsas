<?php
class Address_report_model extends DataTable{
    function __construct()
    {    parent ::__construct();
            $this->select = 'contact_person,contact_number,a.details,credit_period,credit_amount,bank,account_no,ifsc_code,route.route_name,route.route_name,p.price_list as plist,name,tin,phone, email,c.area, address_line1,StateName';
            $this->table = 'suppliers as a left join state as b on b.StateID=a.cst left join ims_area as c on c.id= a.area   left JOIN ims_route as route on route.id = a.route left JOIN price_list as p on p.id= a.price_list';
            $this->column_order = array(null, 'name'); //set column field database for datatable orderable
            $this->column_search = array('name','Phone'); //set column field database for datatable searchable 
            $this->order = array('name' => 'desc'); // default order 
        }
		
		function Reedeem(){
			 $this->table = 'suppliers as a LEFT JOIN point_transaction as b on a.id = b.customer_id and b.published ="yes" left JOIN point_settings as c on 1';
			$this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
			$this->column_search = array('a.name'); //set column field database for datatable searchable 
			$this->select = 'a.name,sum(b.total_amount) as total,a.total_points,a.redeemed_points,a.total_points - a.redeemed_points as reedeemable_point,(a.total_points - a.redeemed_points) /c.one_currency_equivalent as reedeemable ';
			$this->order = array('a.name' => 'asc'); // default order 
			$this->group = 'a.id';
			$this->wherecondition = " where 1 ";
			if ($this->input->post('toid')) {
				$this->wherecondition = $this->wherecondition . ' and  b.customer_id  =' . $this->input->post('toid');
			}
		}

        function CashCustomer(){
			 $this->table = '(select sales_id,total,cusname,cusdetails,cusemail,invoice_date from sales as a where TYPE = "sales" AND customer_id = 0  ) as a ';
			$this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
			$this->column_search = array('a.name'); //set column field database for datatable searchable 
			$this->select = 'SUM(total) AS total,COUNT(sales_id) AS cnt,cusname,cusdetails,cusemail ';
			$this->order = array('a.cusname' => 'asc'); // default order 
			$this->group = 'cusname,cusdetails,cusemail';
			$this->wherecondition = " where cusname!= '' or cusdetails != '' ";
			
		}

        function where() {
            $this->wherecondition = '';
            $tmp = $this->session->userdata('user');
            $created_by = $tmp['Id'];
           
           
          if ($this->input->post('type')) {
          if ($this->wherecondition == '') {
                    $this->wherecondition = "where a.type = '" .$this->input->post('type') . "'";
                } else {
                    $this->wherecondition = $this->wherecondition . " and a.type = '" . $this->input->post('type') . "'";
                }
            }
            if ($this->input->post('areaid')) {
                if ($this->wherecondition == '') {
                          $this->wherecondition = "where a.area = '" .$this->input->post('areaid') . "'";
                      } else {
                          $this->wherecondition = $this->wherecondition . " and a.area = '" . $this->input->post('areaid') . "'";
                      }
                  }
                  if ($this->input->post('stateid')) {
                    if ($this->wherecondition == '') {
                              $this->wherecondition = "where a.cst = '" .$this->input->post('stateid') . "'";
                          } else {
                              $this->wherecondition = $this->wherecondition . " and a.cst = '" . $this->input->post('stateid') . "'";
                          }
                      }
        }



        function getautocomplete_area($q) {

            $qry = "select * from  ims_area where area like ('%" . $q . "%') ";
            $query = $this->db->query($qry);
         
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $new_row['value'] = htmlentities(stripslashes($row['area']));
                    $new_row['id'] = htmlentities(stripslashes($row['id']));

                    
                    $row_set[] = $new_row;  //build an array
                }
                echo json_encode($row_set); //format the array into json data
            }
        }

        function getautocomplete_state($q) {

            $qry = "select * from  state where StateName like ('%" . $q . "%') ";
            $query = $this->db->query($qry);
         
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $new_row['value'] = htmlentities(stripslashes($row['StateName']));
                    $new_row['id'] = htmlentities(stripslashes($row['StateID']));
                    $row_set[] = $new_row;  //build an array
                }
                echo json_encode($row_set); //format the array into json data
            }
        }









    }


?>
