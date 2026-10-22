<?php
class Voucher_model extends DataTable
{

  public function __construct()
  {

    parent::__construct();
    $this->select = 'DATE_FORMAT(a.date, "%d/%m/%Y" ) as date,a.id, b.user_name as salesman,c.user_name as user,voucherno';
    $this->table = 'quickvoucher as a inner join users as b on a.salesman = b.Id inner join users as c on a.user=c.Id';
    $this->column_order = array('a.date', 'salesman', 'user');
    $this->column_search = array('salesman', 'user');
    $this->order = array('a.id' => 'desc');
	$this->wherecondition = ' where type = "'.$this->input->post('type').'" ';
    $this->load->database();
  }
  public function getledger($acc_main_id)
  {
    $search = strtolower($_GET['term']);
    $qry = "select IFNULL(balance,0)+case when type = 'Dr' then  openning_bal else -1*openning_bal end as balance,a.* from (select a.*,name as label FROM acc_ledgers as a where a.name like('%$search%') and acc_main_id = '".$acc_main_id."') as a left join (select sum(a.tran_debit) - sum(a.tran_credit) as balance,ledger_id from acc_ledger_trans  as a where published = 'yes' group by ledger_id) as b on a.id= b.ledger_id where IFNULL(balance,0)+case when type = 'Dr' then  openning_bal else -1*openning_bal end != 0 ";
    $result = $this->db->query($qry);
    echo json_encode($result->result_array());


  }

  public function listvouchers()
  {

    $this->select = 'DATE_FORMAT(a.date, "%d/%m/%Y" ) as date,a.id, b.user_name as salesman,c.user_name as user';
    $this->table = 'quickvoucher as a inner join users as b on a.salesman = b.Id inner join users as c on a.user=c.Id';
    $this->column_order = array('a.date', 'salesman', 'user');
    $this->column_search = array('salesman', 'user');
    $this->order = array('a.id' => 'desc');
    $this->load->database();

  }

  public function getuser()
  {
    $qry = "select * from users";
    $result = $this->db->query($qry);
    $result = $result->result_array();
    $option = '<option value=""> Select</option>';
    foreach ($result as $row) {
      $option .= '<option value="' . $row["Id"] . '">' . $row["user_name"] . '</option>';
    }
    print_r($option);

  }
  public function getsalesman()
  {
    $qry = "select * from users";
    $result = $this->db->query($qry);
    $result = $result->result_array();
    $option = '<option value=""> Select</option>';
    foreach ($result as $row) {
      $option .= '<option value="' . $row["Id"] . '">' . $row["user_name"] . '</option>';
    }
    print_r($option);

  }

  public function getledgername($id)
  {

    $qry = "select * from acc_ledgers where acc_main_id=" . $id;
    $result = $this->db->query($qry);
    $result = $result->result_array();
    $option = '<option value=""> Select</option>';
    foreach ($result as $row) {
      $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }
    print_r($option);
  }

  public function savevoucher()
  {

    $id = $this->input->post('id');
    $dates = $this->input->post('dates');
    $salesman = $this->input->post('salesman');
    $users = $this->input->post('user');
    $acc_main_id = $this->input->post('acc_main_id');
    $ledger = $this->input->post('ledger');
    $voucherno = $this->input->post('invoice');
    $billtype = $this->input->post('btype');
    $autoinvoice = $this->input->post('autoinvoice');
    $new_invoice = $this->input->post('new_invoice');
    $voucher_no = $this->voucher->generatevouchernumber($billtype);
    $grndtot=$this->input->post('grndtot');
    $costcenter = 0;
    if ($this->input->post('Costcenter')) {
        $costcenter = $this->input->post('Costcenter');
    }
    $data = array(
      'date' => $dates,
      'salesman' => $salesman,
      'cost_center' => $costcenter,
      'user' => $users,
      'acc_main_id' => $acc_main_id,
      'ledger_id' => $ledger,
      'billtype' => $billtype,
	    'type'=>'payment',
      'totalamount'=>$grndtot
    );
    //print_r($data);
    if ($id == 0) {
	  $data['voucherno'] =$voucher_no;
      $this->db->insert('quickvoucher', $data);
      $insert_id = $this->db->insert_id();

    } else {
	  $qry = 'select * from quickvoucher where id =  '.$id;
	  $old= $this->db->query($qry)->row_array();
	  $voucherno = $old['voucherno'];
      $this->db->where('id', $id);
      $this->db->update('quickvoucher', $data);
      $insert_id = $id;

      $data3 = array(
        'is_disabled' => 1

      );
      $this->db->where('quickvoucherid', $id);
      $this->db->update('quickvoucheritems', $data3);


      $updatedata = array(
        'published' => 'no'
      );

      $this->db->where('tb_id', $id);
      $this->db->where('tb_name', 'quickvoucher');
      $this->db->update('acc_ledger_trans', $updatedata);

    }

    $quickvoucherid = $insert_id;
    $index = $this->input->post('index', true);
    $ledgid = $this->input->post('ledgerid1', true);
    $ledgername1 = $this->input->post('ledgername1', true);
    $amount = $this->input->post('amount1', true);
    $narration = $this->input->post('narration1', true);
    $x = 0;

    $len = sizeof($ledgid);
    //print_r($len);
    for ($i = 0; $i < $len; $i++) {
      $x = (float) $x + (float) $amount[$i];
      $data1 = array(
        'quickvoucherid' => $quickvoucherid,
        'ledgerid' => $ledgid[$i],
        'amount' => $amount[$i],
        'narration' => $narration[$i],
        'is_disabled' => 0
      );
      if ((int) $index[$i] < 1) {

        $this->db->insert('quickvoucheritems', $data1);
        $insert_ids = $this->db->insert_id();


      } else {

        $this->db->insert('quickvoucheritems', $data1);

      }
      $this->trans_save($voucher_no, $insert_id, "quickvoucher", "payment", $ledger, $ledgid[$i], $dates, '0.00', $amount[$i], $narration[$i] . ';;' . '1', $costcenter, $costcenter, 1);
      $this->trans_save($voucher_no, $insert_id, "quickvoucher", "payment", $ledgid[$i], $ledger, $dates, $amount[$i], '0.00', $narration[$i] . ';;' . '1', $costcenter, $costcenter, 1);



    }

    $response = array(
      'valid' => false,
      'type' => 1,
      'message' => 'Saved Successfully.'
    );

    echo json_encode($response);

  }

  function generatevouchernumber($type) {
    $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
    $query1 = $this->db->query($qry1);
    $query1 = $query1->row_array();
    $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
    $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
    $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
    $qry = "SELECT c.*,a.voucherno,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
            . ",UNSIGNED INTEGER) as top FROM quickvoucher as a INNER join(select SUBSTRING(voucherno," . $preffix . ")"
            . " as string,b.id from quickvoucher as b WHERE  billtype=" . $type . ") as c on"
            . " c.id=a.id order by top desc limit 1";
    $query = $this->db->query($qry);
    if ($query->num_rows() == 0) {
        return $code;
    } else {
        $query = $query->row_array();
        $res = $query['top'] + 1;
        $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];
        return $num;
    }
}
  public function save()
  {

    $id = $this->input->post('id');
    $dates = $this->input->post('dates');
    $salesman = $this->input->post('salesman');
    $users = $this->input->post('user');
    $acc_main_id = $this->input->post('acc_main_id');
    $ledger = $this->input->post('ledger');
    $voucherno = $this->input->post('invoice');
    $billtype = $this->input->post('btype');
    $autoinvoice = $this->input->post('autoinvoice');
    $new_invoice = $this->input->post('new_invoice');
    $voucher_no = $this->voucher->generatevouchernumber($billtype);
    $grndtot=$this->input->post('grndtot');
    $costcenter = 0;
    if ($this->input->post('Costcenter')) {
        $costcenter = $this->input->post('Costcenter');
    }
    $data = array(
      'date' => $dates,
      'salesman' => $salesman,
      'cost_center' => $costcenter,
      'user' => $users,
      'acc_main_id' => $acc_main_id,
      'ledger_id' => $ledger,
      'voucherno' => $voucher_no,
      'billtype' => $billtype,
      'totalamount'=>$grndtot,
	  'type'=>'receipt'
    );
    //print_r($data);
    if ($id == 0) {

      $this->db->insert('quickvoucher', $data);
      $insert_id = $this->db->insert_id();

    } else {
	  $qry = 'select * from quickvoucher where id =  '.$id;
	  $old= $this->db->query($qry)->row_array();
	  $voucherno = $old['voucherno'];
      $this->db->where('id', $id);
      $this->db->update('quickvoucher', $data);
      $insert_id = $id;

      $data3 = array(
        'is_disabled' => 1

      );
      $this->db->where('quickvoucherid', $id);
      $this->db->update('quickvoucheritems', $data3);


      $updatedata = array(
        'published' => 'no'
      );

      $this->db->where('tb_id', $id);
      $this->db->where('tb_name', 'quickvoucher');
      $this->db->update('acc_ledger_trans', $updatedata);

    }



    $quickvoucherid = $insert_id;
    $index = $this->input->post('index', true);
    $ledgid = $this->input->post('ledgerid1', true);
    $ledgername1 = $this->input->post('ledgername1', true);
    $amount = $this->input->post('amount1', true);
    $narration = $this->input->post('narration1', true);
    $x = 0;

    $len = sizeof($ledgid);
    //print_r($len);
    for ($i = 0; $i < $len; $i++) {
      $x = (float) $x + (float) $amount[$i];
      $data1 = array(
        'quickvoucherid' => $quickvoucherid,
        'ledgerid' => $ledgid[$i],
        'amount' => $amount[$i],
        'narration' => $narration[$i],
        'is_disabled' => 0
      );
      if ((int) $index[$i] < 1) {


        $this->db->insert('quickvoucheritems', $data1);
        $insert_ids = $this->db->insert_id();


      } else {

        $this->db->insert('quickvoucheritems', $data1);

      }



      $this->trans_save($voucherno, $insert_id, 'quickvoucher', "receipt", $ledgid[$i], $ledger, $dates, '0.00', $amount[$i], $narration[$i] . ';;' . '1', '1', $costcenter, 1);
      $this->trans_save($voucherno, $insert_id, 'quickvoucher', "receipt", $ledger, $ledgid[$i], $dates, $amount[$i], '0.00', $narration[$i] . ';;' . '1', '1', $costcenter, 1);

    }

    $response = array(
      'valid' => false,
      'type' => 1,
      'message' => 'Saved Successfully.'
    );

    echo json_encode($response);

  }


  public function getdetails($id)
  {
    $qry = "select * from quickvoucher where id=" . $id;
    $result = $this->db->query($qry);
    echo json_encode($result->row_array());

  }

  public function getvoucheritems($id)
  {
    $qry = "select a.*,b.id,b.name from quickvoucheritems as a  inner join acc_ledgers as b on a.ledgerid=b.id where is_disabled=0 and  quickvoucherid=" . $id;
    $result = $this->db->query($qry);
    echo json_encode($result->result_array());
  }

  public function delete($id)
  {
     $updatedata = array(
        'published' => 'no'
      );

      $this->db->where('tb_id', $id);
      $this->db->where('tb_name', 'quickvoucher');
      $this->db->update('acc_ledger_trans', $updatedata);
    $qry = "delete from quickvoucher where id=$id";
    $this->db->Query($qry);
  }


}
?>