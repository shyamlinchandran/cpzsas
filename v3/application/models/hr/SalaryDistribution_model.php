<?php

class SalaryDistribution_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*, MONTHNAME(STR_TO_DATE(month, "%m")) as monthname';
        $this->table = 'hr_salary_distribution as a';
        $this->column_order = array(null, 'year'); //set column field database for datatable orderable
        $this->column_search = array('year'); //set column field database for datatable searchable 
        $this->order = array('year' => 'desc'); // default order 
    }

    public function employeedetails($distribution_id) {
        $qry = "select a.*,l.id as ledger_id,c.* from hr_profile as a inner join acc_ledgers as l on l.ref_id=a.emp_id  and l.ref_code='employee' left join hr_emp_dist_details as c on c.employee_id=a.emp_id where  c.published='yes' and c.distribution_id='" . $distribution_id . "' GROUP by ledger_id ORDER by pro_fname asc";
        $employee = $this->db->query($qry);
        return $employee->result_array();
    }

    public function getsing($id) {
        $qry = "SELECT IFNULL(emp_salary,0)-IFNULL(employee_paid,0) as balance,c.emp_salary,IFNULL(c.employee_paid,0) as employee_paid,a.*,b.*,c.leave_days,c.status as stat,c.extra_leaves FROM `hr_salary_distribution` as a inner join  hr_sal_dist_components as b on a.distribution_id=b.sal_dis_id inner join hr_emp_dist_details as c on c.employee_id=b.emp_id and c.distribution_id=a.distribution_id  where b.published='yes' and a.distribution_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function employee_components($distribution_id) {
        $qry = "select * from hr_sal_dist_components where published='yes'  and sal_dis_id='" . $distribution_id . "'";
        $employee = $this->db->query($qry);
        return $employee->result_array();
    }

    public function getemployeePackage($id, $employee) {
        $qry = "SELECT a.*,IFNULL(amount,0) as totalamount ,d.*,IFNULL(pro_fname,'') as employee,IFNULL(emp_id,'') as employee_id FROM hr_paysettings as a left join (select b.*,c.amount,c.component_id,p.pro_fname FROM hr_salary_package as b inner JOIN hr_sal_pack_components as c on b.package_id=c.sal_pack_id inner join hr_profile as p on p.emp_id=b.emp_id WHERE b.status='active' and c.published ='yes' and b.emp_id =" . $employee . ") as d on d.component_id=a.pay_id where pay_type='" . $id . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getemployees() {
        $qry = "SELECT a.*,b.*,c.pro_fname FROM hr_salary_package as a INNER JOIN hr_sal_pack_components as b on a.package_id=b.sal_pack_id INNER JOIN hr_profile as c on c.emp_id=a.emp_id WHERE a.status='active' and b.published='yes' ORDER by c.pro_fname,c.emp_id asc";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function employee() {
        $qry = "select a.*,l.id as ledger_id from hr_profile as a inner join acc_ledgers as l on l.ref_id=a.emp_id  and l.ref_code='employee'";
        $employee = $this->db->query($qry);
        return $employee->result_array();
    }
	
	public function salaryemployee($id){
		if((float) $id < 1 ){
			$qry = "select a.*,l.id as ledger_id from hr_profile as a inner join acc_ledgers as l on l.ref_id=a.emp_id  and l.ref_code='employee' and pro_status = 1 ";
			$employee = $this->db->query($qry);
			return $employee->result_array();
		}else{
			$qry = "select a.*,l.id as ledger_id from hr_profile as a inner join hr_emp_dist_details as hedd on hedd.distribution_id = ".$id." and hedd.employee_id = a.emp_id  and hedd.published = 'yes' inner join acc_ledgers as l on l.ref_id=a.emp_id  and l.ref_code='employee'  ";
			$employee = $this->db->query($qry);
			return $employee->result_array();
		}
	}

    public function components() {
        $qry = "select * from hr_paysettings order by pay_type desc";
        $components = $this->db->query($qry);
        return $components->result_array();
    }

    function getemployee($search) {
        $qry = "select a.*,a.pro_fname as label from hr_profile as a where pro_fname like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_paysettings where pay_id =' . $id;
        $this->db->query($qry);
    }

    function loadleaves($distribution_id) {
        $year = $this->input->post('year');
        $qry = "SELECT IFNULL(GROUP_CONCAT(month),'') as months  FROM `hr_salary_distribution` where year='" . $year . "' and distribution_id not in ($distribution_id)";
        $result = $this->db->query($qry);
        if ($result->num_rows() == 0) {
            $months = '';
        } else {
            $result = $result->row_array();
            $months = $result['months'];
        }
        $qry = "select '$months' as months,IFNULL(leaves,0) as leaves,employee_id,emp_id from hr_profile as a  left join (select sum(leave_days) as leaves,employee_id,year from hr_emp_dist_details as e inner join hr_salary_distribution as s on s.distribution_id=e.distribution_id where s.year='" . $year . "' and published='yes' and e.distribution_id not in (" . $distribution_id . ") group by employee_id) as c on a.emp_id=c.employee_id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save_payment() {
        $grand_salary = 0;
        $total_earnings = 0;
        $total_deduction = 0;
        $insert_id = $this->input->post('distribution_id');
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $emp_id = $this->input->post('emp_id');
        $length = sizeof($emp_id);
        for ($i = 0; $i < $length; $i++) {
            if ($this->input->post('check' . $emp_id[$i])) {
//                $qry = "update  acc_ledger_trans set published ='no' where tb_name='salary' and  trn_tp='payment' and tb_id =" . $insert_id;
//                $this->db->query($qry);
                $qry = "update hr_emp_dist_details set status='paid' where employee_id='" . $emp_id[$i] . "' and distribution_id=" . $insert_id;
                $this->db->query($qry);
                if ($this->input->post('payment_notes')) {
                    $qry = "update hr_salary_distribution set notes ='" . $this->input->post('payment_notes') . "' where distribution_id=" . $insert_id;
                    $this->db->query($qry);
                }
                $ref_id = 0;
                $qry = 'select * from acc_ledgers where ref_id=' . $emp_id[$i] . " and ref_code in('employee')";
                $query = $this->db->query($qry);
                if ($query->num_rows() == 0) {
                    $$ref_id = 0;
                } else {
                    $query = $query->row_array();
                    $ref_id = $query['id'];
                }
                $emp_salary = 0;
                $employee_paying = 0;
                if ($this->input->post('employee_paying' . $emp_id[$i])) {
					if((float) $this->input->post('employee_paying' . $emp_id[$i]) > 0 ){
						$employee_paying = $this->input->post('employee_paying' . $emp_id[$i]);
					}
                    
                }
                if ($this->input->post('emp_salary' . $emp_id[$i])) {
                    $emp_salary = $this->input->post('emp_salary' . $emp_id[$i]);
                }
                $pay_date = $this->input->post('pay_date');
                $paid = 0;
                if ($this->input->post('paid' . $emp_id[$i])) {
                    $paid = $this->input->post('paid' . $emp_id[$i]);
                }
                $data = array(
                    'distribution_id' => $insert_id,
                    'employee_id' => $emp_id[$i],
                    'paying_amount' => $employee_paying,
                    'date' => $this->getDate($pay_date),
                    'paid_amount' => $paid
                );
                if ($this->input->post('payment_notes')) {
                    $data['notes'] = $this->input->post('payment_notes');
                }
                $this->db->insert('hr_pay_details', $data);
                $qry = "update hr_emp_dist_details set employee_paid=IFNULL(employee_paid,0)+" . $employee_paying . " where employee_id=" . $emp_id[$i] . " and distribution_id=" . $insert_id . " ";
                $this->db->query($qry);
				
				$component= $emp_id[$i];
				$total_deduction = 0;
				$component_id = $this->input->post('component_id' . $component, TRUE);
				$component_length = sizeof($component_id);
				for ($j = 0; $j < $component_length; $j++) {
					$amount = 0;
					if ($this->input->post('emp_amount_' . $component . '_' . $component_id[$j])) {
                    $amount = $this->input->post('emp_amount_' . $component . '_' . $component_id[$j]);
					}
					$type = $this->input->post('com_type_' . $component . '_' . $component_id[$j]);
					if ($type == "Deductions") {
                    $total_deduction = (float) $total_deduction + (float) $amount;
					}
				}
				$total_deduction = $total_deduction ;
				
				$qry ="SELECT * FROM `acc_ledger_trans`   WHERE trn_tp='advance' and tb_name='salary' and tb_id = ".$insert_id." and published='yes' and  (ledger_id = ".$ref_id." or to_ledger_id= ".$ref_id." )";
				$query = $this->db->query($qry);
				if($query->num_rows()>0){
					$qry = "update acc_ledger_trans set tran_amt =".$total_deduction .",tran_debit=".$total_deduction.",tran_credit=0 where trn_tp='advance' and tb_name='salary' and tb_id = ".$insert_id." and published='yes' and ledger_id=".$ref_id." ";
					$this->db->query($qry);
					$qry = "update acc_ledger_trans set tran_amt =".$total_deduction .",tran_credit=".$total_deduction.",tran_debit=0 where trn_tp='advance' and tb_name='salary' and tb_id = ".$insert_id." and published='yes' and to_ledger_id=".$ref_id." ";
					$this->db->query($qry);
				}else{
                    $this->trans_save($month . '/' . $year, $insert_id, 'salary', 'advance', $ref_id, $this->cashaccount, $this->getDate($pay_date), $total_deduction, '0.00', $month . '/' . $year, 1, 1, 1);
                    $this->trans_save($month . '/' . $year, $insert_id, 'salary', 'advance', $this->cashaccount, $ref_id, $this->getDate($pay_date), '0.00', $total_deduction, $month . '/' . $year, 1, 1, 1);
				}
                if ($employee_paying > 0) {
                    $qry = "update hr_emp_dist_details set last_paid_date='" . $this->getDate($pay_date) . "' where employee_id=" . $emp_id[$i] . " and distribution_id=" . $insert_id . " ";
                    $this->db->query($qry);
                    $this->trans_save($month . '/' . $year, $insert_id, 'salary', 'payment', $ref_id, $this->cashaccount, $this->getDate($pay_date), $employee_paying, '0.00', $month . '/' . $year, 1, 1, 1);
                    $this->trans_save($month . '/' . $year, $insert_id, 'salary', 'payment', $this->cashaccount, $ref_id, $this->getDate($pay_date), '0.00', $employee_paying, $month . '/' . $year, 1, 1, 1);
                }
            }
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

    function save() {
        $grand_salary = 0;
        $total_earnings = 0;
        $total_deduction = 0;
        $distribution_id = $this->input->post('distribution_id');
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $emp_id = $this->input->post('emp_id');
        $length = sizeof($emp_id);
        $data = array(
            'month' => $month,
            'year' => $year,
        );
        if ($this->input->post('payment_notes')) {
            $data['notes'] = $this->input->post('payment_notes');
        }
        if ($distribution_id == 0) {
            $data['date'] = date('Y-m-d H:i:s', time());
            $this->db->insert('hr_salary_distribution', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $qry = "update  acc_ledger_trans set published ='no' where trn_tp='salary' and tb_id =" . $distribution_id;
            $this->db->query($qry);
            $insert_id = $distribution_id;
            $qry = "update hr_sal_dist_components set published='no' where sal_dis_id = " . $insert_id;
            $this->db->query($qry);
            $qry = "update hr_emp_dist_details set published='no' where distribution_id =" . $insert_id;
            $this->db->query($qry);
            $this->db->where('distribution_id', $distribution_id);
            $this->db->update('hr_salary_distribution', $data);
        }
        $qry = "select * from hr_salary_distribution where distribution_id=" . $insert_id;
        $query = $this->db->query($qry)->row_array();
        $trans_date =$query['date'];
        for ($i = 0; $i < $length; $i++) {
            $total_earnings = 0;
            $total_deduction = 0;
            $component = $emp_id[$i];
            $component_id = $this->input->post('component_id' . $component, TRUE);
            $component_length = sizeof($component_id);
            for ($j = 0; $j < $component_length; $j++) {
                $amount = 0;
                if ($this->input->post('emp_amount_' . $component . '_' . $component_id[$j])) {
                    $amount = $this->input->post('emp_amount_' . $component . '_' . $component_id[$j]);
                }
                $type = $this->input->post('com_type_' . $component . '_' . $component_id[$j]);
                if ($type == 'Earnings') {
                    $total_earnings = (float) $total_earnings + (float) $amount;
                }if ($type == "Deductions") {
                    $total_deduction = (float) $total_deduction + (float) $amount;
                }
                $data = array(
                    'sal_dis_id' => $insert_id,
                    'emp_id' => $emp_id[$i],
                    'amount' => $amount,
                    'component_id' => $component_id[$j],
                    'component_type' => $type,
                    'status' => 'created',
                );
                $this->db->insert('hr_sal_dist_components', $data);
            }
            $total = (float) $total_earnings - (float) $total_deduction;
            $grand_salary = (float) $grand_salary + (float) $total;
            $leaves = 0;
            $emp_salary = 0;
			$emp_salary_ledger = $total_deduction;
            if ($this->input->post('leaves' . $emp_id[$i])) {
                $leaves = $this->input->post('leaves' . $emp_id[$i]);
            }
            if ($this->input->post('emp_salary' . $emp_id[$i])) {
                $emp_salary = $this->input->post('emp_salary' . $emp_id[$i]);
				$emp_salary_ledger = (float) $emp_salary_ledger  + (float) $emp_salary;
            }
            $data = array(
                'employee_id' => $emp_id[$i],
                'total' => $total,
                'distribution_id' => $insert_id,
                'leave_days' => $leaves,
                'emp_salary' => $emp_salary,
                'published' => 'yes'
            );
            if ($distribution_id != 0) {
                $qry = "select * from hr_emp_dist_details where distribution_id='" . $insert_id . "' and employee_id='" . $emp_id[$i] . "'";
                $query = $this->db->query($qry);
                if ($query->num_rows() > 0) {
                    $query = $query->row_array();
                    $data['employee_paid'] = $query['employee_paid'];
                }
            }
            if ($this->input->post('ext_leave' . $emp_id[$i])) {
                $data['extra_leaves'] = $this->input->post('ext_leave' . $emp_id[$i]);
            }
            $this->db->insert('hr_emp_dist_details', $data);
            $ref_id = 0;
            $qry = 'select * from acc_ledgers where ref_id=' . $emp_id[$i] . " and ref_code in('employee')";
            $query = $this->db->query($qry);
            if ($query->num_rows() == 0) {
                $$ref_id = 0;
            } else {
                $query = $query->row_array();
                $ref_id = $query['id'];
            }
            if ($emp_salary < 0) {
                $emp_salary = 0;
            }
			$totaldeduction = (float) $total_deduction ;
			$qry = "update acc_ledger_trans set tran_amt =".$totaldeduction .",tran_debit=".$totaldeduction.",tran_credit=0 where trn_tp='advance' and tb_name='salary' and tb_id = ".$insert_id." and published='yes' and ledger_id=".$ref_id." ";
			$this->db->query($qry);
			$qry = "update acc_ledger_trans set tran_amt =".$totaldeduction .",tran_credit=".$totaldeduction.",tran_debit=0 where trn_tp='advance' and tb_name='salary' and tb_id = ".$insert_id." and published='yes' and to_ledger_id=".$ref_id." ";
			$this->db->query($qry);
            $this->trans_save($month . '/' . $year, $insert_id, 'salary', 'salary', $this->cashaccount, $ref_id, $trans_date, $emp_salary_ledger, '0.00', $month . '/' . $year, 1, 1, 1);
            $this->trans_save($month . '/' . $year, $insert_id, 'salary', 'salary', $ref_id, $this->cashaccount, $trans_date, '0.00', $emp_salary_ledger, $month . '/' . $year, 1, 1, 1);
        }

        $qry = "update hr_salary_distribution set total='" . $grand_salary . "' where distribution_id=" . $insert_id;
        $this->db->query($qry);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
