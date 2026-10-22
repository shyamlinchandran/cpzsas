<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
/**
 * Description of NewMaster
 *
 * @author admin
 */
class NewMaster extends MY_Controller {

//    public $fitem = 4;


    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ledgers_model', 'ledger');
        }
		
	 public function set_target($id) {
		$data['id'] = $id;
		$qry = "SELECT b.*,a.user_name from users as a left JOIN user_target as b on a.Id = b.user_id where a.id = ".$id;
		$data['user'] = $this->db->query($qry)->row_array();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/set_target',$data);
    }


	public function save_target(){
		$this->ledger->save_target();
	}
    public function Branch() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('name', 'address', 'details', 'company_id');
            $crud->set_table('branch');
            $crud->set_subject('Branch');
            $crud->display_as('name', 'Name');
            $crud->display_as('address', 'Address');
            $crud->display_as('details', 'Details');
            $crud->display_as('company_id', 'Company');
            $crud->unset_back_to_list();
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->required_fields('name', 'address', 'company_id');
            $crud->set_relation('company_id', 'company', 'name');
            $output = $crud->render();
//            $global_data['listurl'] = base_url() . 'master/items/list_all';
//            $this->load->vars($global_data);
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function _callback_coupon($value, $row) {
        if ($row->name_lan == '') {
            return $row->cou_code;
        } else {
            return $row->name_lan;
        }
    }

    public function Coupons() {
        try {
            $tmp = $this->session->userdata('user');
            $userid = $tmp['Id'];
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('coupons');
            $crud->columns('cou_code', 'date_from', 'date_to');
            $crud->set_subject(label('Coupons', $this, $this->user));
            $crud->display_as('cou_code', 'Code');
            $crud->display_as('cou_discountp', 'Discount%');
            $crud->display_as('cou_discount', 'Discount Rate');
            $crud->display_as('date_from', 'Start Date');
            $crud->display_as('date_to', 'End Date');
            if ($this->multiple == 0) {
                $crud->fields('cou_code', 'date_from', 'date_to');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'date_from', 'date_to');
                    $crud->callback_column('name_lan', array($this, '_callback_coupon'));
                }
            }
            //$crud->unset_back_to_list();
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->field_type('created_date', 'hidden', date('Y/m/d', time()));
            $crud->field_type('created_by', 'hidden', $userid);
            $crud->unset_columns(array('updatedate', 'created_by', 'created_date'));
            $crud->required_fields('cou_code');
            //$crud->add_fields('cou_code', 'cou_discount', 'cou_discountp', 'date_from', 'date_to');
            //$crud->edit_fields('cou_code', 'cou_discount', 'cou_discountp', 'date_from', 'date_to');            
            $columns = array('cou_code', 'cou_discount', 'cou_discountp', 'date_from', 'date_to','name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function UserTypes() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('name');
            $crud->set_table('user_type');
            $crud->set_subject('Types');
            $crud->display_as('name', 'Name');
            $crud->required_fields('name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function company_branch() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('brc_name');
            $crud->set_table('company_branch');
            $crud->set_subject('Branches');
            $crud->display_as('brc_name', 'Branch Name');
            $crud->required_fields('brc_name');
            $crud->unset_delete();
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function Users() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('user_name', 'user_address', 'user_mobile', 'user_phone', 'user_email', 'username', 'user_password','user_type');
            $crud->columns('user_name', 'user_address', 'user_mobile', 'user_phone', 'user_email', 'username', 'user_password','user');

            $crud->set_table('users');
            $crud->set_subject(label('Users', $this, $this->user));
            $crud->unique_fields('user_name', 'username');
            $crud->required_fields('user_name', 'user_mobile', 'user_email', 'user_password', 'company', 'username', 'company');
            $crud->where('is_hide', 0);
            $crud->display_as('user_name', 'Name');
            $crud->display_as('branch', 'Branch');
            $crud->display_as('user_address', 'Address');
            $crud->display_as('user_mobile', 'Mobile');
            $crud->display_as('user_phone', 'Phone');
            $crud->set_relation('branch', 'company_branch', 'brc_name');
            $crud->display_as('user_email', 'Email');
            $crud->display_as('username', 'Username');
            //$crud->display_as('user_password', 'Password');
            $crud->display_as('user_type', 'User Type');
            $crud->set_rules('user_mobile', 'Phone Number', 'required|integer');
            $crud->set_rules('user_email', 'Email', 'trim|valid_email');
            $crud->field_type('is_hide', 'hidden', 0);
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate','user_password'));
            $crud->unset_back_to_list();
            $crud->set_relation('user_type', 'user_type', 'name');
			//$crud->add_action('More', '', 'settings/NewMaster/set_target','ui-icon-plus');
            $crud->set_relation('company', 'company', 'name');
            $columns = array('user_name', 'user_address', 'user_mobile','user_type', 'user_phone', 'user_email', 'username', 'user_password', 'company', 'is-active');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->callback_after_insert(array($this, 'encrypt_password'));
            $crud->callback_after_update(array($this, 'encrypt_password'));
            /*$crud->unset_add();
            $crud->unset_delete();*/
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

     public function user_settings()
{
    try {
        $crud = new grocery_CRUD();
        $crud->set_theme('datatables');

        $crud->set_table('user_settings');
        $crud->set_subject(label('User Settings', $this, $this->user));

        $crud->columns(
            'user_id',
            'user_default_godown',
            'user_default_billtype',
            'user_default_printtype',
            'user_default_printer',
            'edit_sale_rate'
        );

        $crud->unique_fields('user_id');

        $crud->required_fields(
            'user_id',
            'user_default_billtype',
            'user_default_printtype',
            'user_default_printer',
            'user_default_analytics',
            'user_default_costcenter',
            'edit_sale_rate'
        );

        // Display names
        $crud->display_as('edit_sale_rate', 'Edit Sales Rate');
        $crud->display_as('user_default_godown', 'Default Godown');
        $crud->display_as('user_default_billtype', 'Default Billtype');
        $crud->display_as('user_default_printtype', 'Default Printtype');
        $crud->display_as('user_default_printer', 'Default Printer');
        $crud->display_as('user_default_costcenter', 'Default Cost Center');
        $crud->display_as('user_default_analytics', 'Default Analytics Center');
        $crud->display_as('user_start_time', 'Start Time');
        $crud->display_as('user_end_time', 'End Time');

        // Hidden update date
        $crud->field_type('updatedate', 'hidden', date('Y-m-d H:i:s'));
        $crud->unset_columns(['updatedate']);
        $crud->unset_back_to_list();

        // Relations
        $crud->set_relation('user_id', 'users', 'user_name');
        $crud->set_relation('user_default_godown', 'ims_godown', 'godown_name');
        $crud->set_relation('user_default_billtype', 'set_billtype', 'type', ['transaction' => 'sales']);
        $crud->set_relation('default_purchase_billtype', 'set_billtype', 'type', ['transaction' => 'Purchase']);
        $crud->set_relation('default_preturn_billtype', 'set_billtype', 'type', ['transaction' => 'purchase_return']);
        $crud->set_relation('default_porder_billtype', 'set_billtype', 'type', ['transaction' => 'order']);
        $crud->set_relation('default_sreturn_billtype', 'set_billtype', 'type', ['transaction' => 'sales_return']);
        $crud->set_relation('default_sorder_billtype', 'set_billtype', 'type', ['transaction' => 'estimate']);
        $crud->set_relation('default_rec_billtype', 'set_billtype', 'type', ['transaction' => 'rec']);
        $crud->set_relation('default_pay_billtype', 'set_billtype', 'type', ['transaction' => 'pay']);
        $crud->set_relation('user_default_printtype', 'set_printtype', 'name');
        $crud->set_relation('user_default_printer', 'printers', 'prn_name');
        $crud->set_relation('user_default_analytics', 'analytics_center', 'any_name');
        $crud->set_relation('user_default_costcenter', 'cost_centre', 'cost_name');

        /* =====================================================
           FORCE TIME PICKER (WORKS IN ALL groceryCRUD VERSIONS)
           ===================================================== */

        // ADD FORM
        $crud->callback_add_field('user_start_time', function () {
            return '<input type="time" name="user_start_time" class="form-control">';
        });

        $crud->callback_add_field('user_end_time', function () {
            return '<input type="time" name="user_end_time" class="form-control">';
        });

        // EDIT FORM
        $crud->callback_edit_field('user_start_time', function ($value) {
            return '<input type="time" name="user_start_time" class="form-control" value="' .
                ($value ? substr($value, 0, 5) : '') . '">';
        });

        $crud->callback_edit_field('user_end_time', function ($value) {
            return '<input type="time" name="user_end_time" class="form-control" value="' .
                ($value ? substr($value, 0, 5) : '') . '">';
        });

        /* ======================================
           CONVERT TEXT → TIME BEFORE SAVE
           ====================================== */
        $crud->callback_before_insert([$this, 'fix_user_time']);
        $crud->callback_before_update([$this, 'fix_user_time']);

        $output = $crud->render();
        $this->load->view('masters/masters', $output);

    } catch (Exception $e) {
        show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
    }
}

    public function user_settingsold() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('user_id','user_default_godown','user_default_billtype','user_default_printtype','user_default_printer','edit_sale_rate');
            $crud->set_table('user_settings');
            $crud->set_subject(label('User Settings', $this, $this->user));
            $crud->unique_fields('user_id');
            $crud->required_fields('user_id','user_default_billtype','user_default_printtype','user_default_printer','user_default_analytics','user_default_costcenter','edit_sale_rate');
            $crud->display_as('edit_sale_rate', 'Edit Sales Rate');
			$crud->display_as('user_default_godown', 'Default Godown');
            $crud->display_as('user_default_billtype', 'Default Billtype');
            $crud->display_as('user_default_printtype', 'Default Printype');
            $crud->display_as('user_default_printer', 'Default Printer');
            $crud->display_as('user_default_costcenter', 'Default Cost Center');
            $crud->display_as('user_default_analytics', 'Default Analytics Center');
            $crud->display_as('user_email', 'Email');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->unset_back_to_list();
            $crud->set_relation('user_id', 'users', 'user_name');
            $crud->set_relation('user_default_godown', 'ims_godown', 'godown_name');
            $crud->set_relation('user_default_billtype', 'set_billtype', 'type',array('transaction' => 'sales'));
            $crud->set_relation('default_purchase_billtype', 'set_billtype', 'type',array('transaction' => 'Purchase'));
            $crud->set_relation('default_preturn_billtype', 'set_billtype', 'type',array('transaction' => 'purchase_return'));
            $crud->set_relation('default_porder_billtype', 'set_billtype', 'type',array('transaction' => 'order'));
            $crud->set_relation('default_sreturn_billtype', 'set_billtype', 'type',array('transaction' => 'sales_return'));
            $crud->set_relation('default_sorder_billtype', 'set_billtype', 'type',array('transaction' => 'estimate'));
            $crud->set_relation('default_rec_billtype', 'set_billtype', 'type',array('transaction' => 'rec'));
            $crud->set_relation('default_pay_billtype', 'set_billtype', 'type',array('transaction' => 'pay'));
			
            $crud->set_relation('user_default_printtype', 'set_printtype', 'name');
            $crud->set_relation('user_default_printer', 'printers', 'prn_name');
            $crud->set_relation('user_default_analytics', 'analytics_center', 'any_name');
            $crud->set_relation('user_default_costcenter', 'cost_centre', 'cost_name');
            $columns = array('user_id','user_default_godown','user_default_billtype','user_default_printtype','user_default_printer','user_default_analytics','user_default_costcenter','user_is_margin','edit_sale_rate');
            //foreach ($columns as $column) {
               // $crud->display_as($column, label($column, $this, $this->user));
           // }
            /*$crud->unset_add();
            $crud->unset_delete();*/
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function encrypt_password($post_array, $primary_key) {
        $this->encryptpaswrd($post_array['user_password'], $primary_key);
        return TRUE;
    }

    public function encryptpaswrd($password, $id) {
        $this->ledger->encryptpaswrd($password, $id);
        return TRUE;
    }

}
