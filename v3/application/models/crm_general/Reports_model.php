<?php


class Reports_model extends DataTable
{



    public function __construct()
    {
        parent::__construct();

        $this->select = 'l.*, se.source_of_enquiry as soe, a.area as areas, u.user_name as username, st.StateName as states, l.remarks as remm';
        $this->table = 'lead_register as l inner join source_enquiry as se on l.source = se.id inner join ims_area as a on l.area = a.id inner join users as u on l.loggedin = u.Id inner join state st on st.StateID = l.location';

        $this->wherecondition = 'where 1';
        if ($this->input->post('dat') == 'date') {
            $sDate = $this->getDate($this->input->post('fromDate'));
            $eDate = $this->getDate($this->input->post('toDate'));
            $this->wherecondition = $this->wherecondition . " and l.date >= '" . $sDate . "' and l.date <= '" . $eDate . "'";
        }
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and l.user = " . $this->input->post('userr');
        }
        if ($this->input->post('source')) {
            $this->wherecondition = $this->wherecondition . " and l.source = " . $this->input->post('source');
        }
        if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . " and l.area = " . $this->input->post('area');
        }
        if ($this->input->post('state')) {
            $this->wherecondition = $this->wherecondition . " and l.location = " . $this->input->post('state');
        }
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName'); //set column field database for datatable searchable 
        $this->order = array('l.id' => 'desc'); // default order 
    }

    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

    public function enquiry_report()
    {
        $this->select = 'r.*, r.totalAmount as tamount, IFNULL(item_id,"") as item_id,IFNULL(itemname,"Nothing") itemname, se.source_of_enquiry as soe, a.area as areas, u.user_name as username, st.StateName as states';
        $this->table = 'enquiry_register as r inner join source_enquiry as se on r.source = se.id left join ims_area as a on r.area = a.id inner join users as u on r.loggedin = u.Id inner join state st on st.StateID = r.location left join (SELECT enquiry_id,GROUP_CONCAT(product_id) as item_id,GROUP_CONCAT(i.name) as itemname FROM `enquiry_product` as ep INNER JOIN item as i on i.id=ep.product_id GROUP by enquiry_id) as pr on pr.enquiry_id=r.id';

        $this->wherecondition = 'where 1';
        if ($this->input->post('dat') == 'date') {
            $sDate = $this->getDate($this->input->post('fromDate'));
            $eDate = $this->getDate($this->input->post('toDate'));
            $this->wherecondition = $this->wherecondition . " and r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
        }
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and r.user = " . $this->input->post('userr');
        }
        if ($this->input->post('source')) {
            $this->wherecondition = $this->wherecondition . " and r.source = " . $this->input->post('source');
        }
        if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . " and r.area = " . $this->input->post('area');
        }
        if ($this->input->post('state')) {
            $this->wherecondition = $this->wherecondition . " and r.location = " . $this->input->post('state');
        }
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

    public function product_report()
    {
        $this->select = 'r.*, ep.*, i.name as itemname, se.source_of_enquiry as soe, a.area as areas, u.user_name as username, st.StateName as states';
        $this->table = 'enquiry_register as r inner join enquiry_product as ep on ep.enquiry_id = r.id inner join item as i on ep.product_id = i.id inner join source_enquiry as se on r.source = se.id left join ims_area as a on r.area = a.id inner join users as u on r.loggedin = u.Id inner join state st on st.StateID = r.location';

        $this->wherecondition = 'where 1';
        if ($this->input->post('dat') == 'date') {
            $sDate = $this->getDate($this->input->post('fromDate'));
            $eDate = $this->getDate($this->input->post('toDate'));
            $this->wherecondition = " and r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
        }
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and r.user = " . $this->input->post('userr');
        }
        if ($this->input->post('source')) {
            $this->wherecondition = $this->wherecondition . " and r.source = " . $this->input->post('source');
        }
        if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . " and r.area = " . $this->input->post('area');
        }
        if ($this->input->post('state')) {
            $this->wherecondition = $this->wherecondition . " and r.location = " . $this->input->post('state');
        }
        if ($this->input->post('types') > 0) {
            $this->wherecondition = $this->wherecondition . " and r.type = " . $this->input->post('types');
        }
        if ($this->input->post('productss') > 0) {
            $this->wherecondition = $this->wherecondition . " and ep.product_id = " . $this->input->post('productss');
        }
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName', 'i.name'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only 
  |          for backwards compatibility purposes!
  |
  */

    public function completion_report()
    {
        $this->select = 'r.date as edate, ea.Edate as allodate, IFNULL(item_id,"") as item_id,IFNULL(itemname,"Nothing") itemname, ea.Ddate as delidate, ec.dates as closedate, ec.amounts as closedamount, r.user as enquser, ea.user as allouser, u.user_name as username, usr.user_name as userss, r.companyName as company';
        $this->table = 'enquiry_register as r inner join enquiry_allocation as ea on ea.enq_id = r.id inner join enquiry_closure as ec on r.id = ec.enq_id inner join users as u on r.user = u.Id inner join users as usr on ea.user = usr.Id left join (SELECT enquiry_id,GROUP_CONCAT(product_id) as item_id,GROUP_CONCAT(i.name) as itemname FROM `enquiry_product` as ep INNER JOIN item as i on i.id=ep.product_id GROUP by enquiry_id) as pr on pr.enquiry_id=r.id';

        $this->wherecondition = 'where 1';
        if ($this->input->post('dat') == 'date') {
            $sDate = $this->getDate($this->input->post('fromDate'));
            $eDate = $this->getDate($this->input->post('toDate'));
            // print_r($eDate);
            // exit();
            $this->wherecondition = $this->wherecondition . " and r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
        }
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and r.loggedin = " . $this->input->post('userr');
        }
        if ($this->input->post('cuser')) {
            $this->wherecondition = $this->wherecondition . " and ea.user = " . $this->input->post('cuser');
        }
        if ($this->input->post('stat') > 0) {
            $this->wherecondition = $this->wherecondition . " and r.value = " . $this->input->post('stat');
        }
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('r.date', 'u.user_name', 'usr.user_name'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

    public function allocated_report()
    {
        $this->select = 'r.*, ea.Edate as allodate,  IFNULL(item_id,"") as item_id,IFNULL(itemname,"Nothing") itemname, ea.Ddate as delidate, r.totalAmount as amount, ea.remark as alloremark, u.user_name as allouser';
        $this->table = 'enquiry_register as r inner join enquiry_allocation as ea on r.id = ea.enq_id inner join users as u on ea.user = u.Id left join (SELECT enquiry_id,GROUP_CONCAT(product_id) as item_id,GROUP_CONCAT(i.name) as itemname FROM `enquiry_product` as ep INNER JOIN item as i on i.id=ep.product_id GROUP by enquiry_id) as pr on pr.enquiry_id=r.id';

        //$this->wherecondition = 'where 1';
        if ($this->input->post('dat') == 'date') {
            $sDate = $this->getDate($this->input->post('fromDate'));
            $eDate = $this->getDate($this->input->post('toDate'));
            $this->wherecondition = " where r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
            if ($this->input->post('userr')) {

                $this->wherecondition = $this->wherecondition . " and ea.user = " . $this->input->post('userr');
            }
        }
        elseif($this->input->post('userr')) {
            $this->wherecondition ="where ea.user = " . $this->input->post('userr');
        }
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName', 'i.name'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

    public function followup_report()
    {
        $this->select = 'dates,g.next_follow_up_date as nextsecond, r.date as edate, IFNULL(it.items,"Nothing") itemname, r.totalAmount as amount, r.next_follow_up_date as nextdate, ef.remarks as rem, r.companyName as company';
        $this->table = 'enquiry_register as r inner join enquiry_followup as ef on r.id = ef.enquiry_id left join (SELECT er.id, companyName, GROUP_CONCAT(i.name) as items FROM `enquiry_product` as ep inner join enquiry_register as er on er.id = ep.enquiry_id inner join item as i on ep.product_id = i.id group by ep.enquiry_id) as it on it.id = r.id LEFT JOIN (SELECT f.*,GROUP_CONCAT(f.next_follow_up_date) as dates FROM `enquiry_followup` as f GROUP by f.enquiry_id ORDER by f.next_follow_up_date asc ) as g on g.enquiry_id=r.id';

        $this->wherecondition = 'where 1';
        if ($this->input->post('dat') == 'date') {
            $sDate = $this->getDate($this->input->post('fromDate'));
            $eDate = $this->getDate($this->input->post('toDate'));
            $this->wherecondition = $this->wherecondition . " and r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
        }
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and r.user = " . $this->input->post('userr');
        }
        if ($this->input->post('pending') != 'none') {
            $this->wherecondition = $this->wherecondition . " and r.status < 4 ";
        }
        $this->group = 'ef.enquiry_id';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName', 'i.name'); //set column field database for datatable searchable 
        $this->order = array('ef.id' => 'desc'); // default order 
    }

    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

    public function bussinessplan_report()
    {
        $this->select = 'r.date as edate,  IFNULL(item_id,"") as item_id,IFNULL(itemname,"Nothing") itemname, r.totalAmount as amount, ec.amounts as closeamount, ec.remark as closedrem, u.user_name as allouser, r.companyName as company, r.id as enq_id, r.status as rstatus';
        $this->table = 'enquiry_register as r inner join enquiry_closure as ec on r.id = ec.enq_id inner join enquiry_allocation as ea on r.id = ea.enq_id inner join users as u on ea.user = u.Id left join (SELECT enquiry_id,GROUP_CONCAT(product_id) as item_id,GROUP_CONCAT(i.name) as itemname FROM `enquiry_product` as ep INNER JOIN item as i on i.id=ep.product_id GROUP by enquiry_id) as pr on pr.enquiry_id=r.id';

        $this->wherecondition = 'where 1 and r.value <> 2';
        if ($this->input->post('dat') == 'date') {
            $sDate = $this->getDate($this->input->post('fromDate'));
            $eDate = $this->getDate($this->input->post('toDate'));
            $this->wherecondition = $this->wherecondition . " and r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
        }
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and ea.user = " . $this->input->post('userr');
        }
        if ($this->input->post('bill') == 1) {
            $this->wherecondition = $this->wherecondition . " and r.status = 7";
        }
        if ($this->input->post('bill') == 2) {
            $this->wherecondition = $this->wherecondition . " and r.status <> 7";
        }
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName', 'i.name'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }


    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

  public function opportunity_report() 
  {
      $this->select = 'u.user_name,GROUP_CONCAT(z.closeamount) as amo ,GROUP_CONCAT(z.months) as mon, GROUP_CONCAT(z.yearss) as yz, datess, z.regid, z.usersss';
      $this->table = "users as u inner join(select ea.user as usersss, ea.Ddate as datess, sum(ec.amounts) as closeamount, (month(ea.Ddate)) as months,year(ea.Ddate) as yearss,ea.user, r.id as regid from enquiry_register as r inner join enquiry_allocation as ea on r.id = ea.enq_id inner join (select er.id, sum(ep.price*ep.quantity) as amounts from enquiry_register as er INNER join enquiry_allocation as ea on er.id = ea.enq_id inner join enquiry_product as ep on er.id = ep.enquiry_id GROUP by ep.enquiry_id) as ec on r.id = ec.id GROUP BY ea.user, month(ea.Ddate) order by month(ea.Ddate) asc) as z on z.user=u.Id";

      $this->wherecondition = 'where 1';
      if ($this->input->post('dat') == 'date') {
          $sDate = $this->getDate($this->input->post('fromDate'));
          $eDate = $this->getDate($this->input->post('toDate'));
          $this->wherecondition = $this->wherecondition . " and r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
      }
      if ($this->input->post('userr')) {
          $this->wherecondition = $this->wherecondition . " and z.usersss = " . $this->input->post('userr');
      }
      // print_r($this->input->post('year'));
      // exit();
      if ($this->input->post('year')) {
          $this->wherecondition = $this->wherecondition . " and z.yearss = " . $this->input->post('year');
      }
      $this->group = 'u.Id';
      $this->column_order = array(null, 'name'); //set column field database for datatable orderable
      $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName', 'i.name'); //set column field database for datatable searchable 
      $this->order = array('z.regid' => 'desc'); // default order 
  }


    // public function opportunity_report() 
    // {
    //     $this->select = 'u.user_name,GROUP_CONCAT(z.closeamount) as amo ,GROUP_CONCAT(z.months) as mon, datess, z.regid, z.usersss';
    //     $this->table = "users as u inner join(select ea.user as usersss, ea.Ddate as datess, sum(ec.amounts) as closeamount, (month(ea.Ddate)) as months,ea.user, r.id as regid from enquiry_register as r inner join enquiry_allocation as ea on r.id = ea.enq_id inner join enquiry_closure as ec on r.id = ec.enq_id GROUP BY ea.user, month(ea.Ddate) order by month(ea.Ddate) asc) as z on z.user=u.Id";

    //     $this->wherecondition = 'where 1';
    //     if ($this->input->post('dat') == 'date') {
    //         $sDate = $this->getDate($this->input->post('fromDate'));
    //         $eDate = $this->getDate($this->input->post('toDate'));
    //         $this->wherecondition = $this->wherecondition . " and r.date >= '" . $sDate . "' and r.date <= '" . $eDate . "'";
    //     }
    //     if ($this->input->post('userr')) {
    //         $this->wherecondition = $this->wherecondition . " and z.usersss = " . $this->input->post('userr');
    //     }
    //     // print_r($this->input->post('year'));
    //     // exit();
    //     // if ($this->input->post('year')) {
    //     //     $this->wherecondition = $this->wherecondition . " and z.yearss = " . $this->input->post('year');
    //     // }
    //     $this->group = 'u.Id';
    //     $this->column_order = array(null, 'name'); //set column field database for datatable orderable
    //     $this->column_search = array('u.user_name', 'se.source_of_enquiry', 'a.area', 'st.StateName', 'i.name'); //set column field database for datatable searchable 
    //     $this->order = array('z.regid' => 'desc'); // default order 
    // }
}
