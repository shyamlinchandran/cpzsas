<?php

class Menus extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('menusettings_model', 'menus');
    }

    function menuuser() {
        $data['list'] = $this->menus->menus();
        $re = $this->menus->user();
        $data['user'] = $re;
        $this->load->view('settings/usermenu', $data);
    }
	
	function save_visible(){
		'[{"targets": 3, "visible": false },{"targets": 1, "visible": false }]';
		$save_url = $this->input->post('save_url');
		$vis = $this->input->post('vis',TRUE);
		$text ='[';
		$target_txt = ', "visible": false }';
		if($this->input->post('vis',TRUE)){
			$length = sizeof($vis);
			for($i=0;$i<$length;$i++){
				if($i > 0 ){
					$text = $text .',';
				}
				$text = $text .'{"targets": '.$vis[$i].' ';
				$text = $text . $target_txt;
			}
		}
		$text = $text .']';
		$qry = "SELECT * FROM `menus` WHERE Url = '".$save_url."'";
		$query = $this->db->query($qry)->row_array();
		$id = $query['id'];
		$data = array(
			'visibility'=>$text
		);
		$this->db->where('id',$id);
		$this->db->update('menus',$data);
		print_r($text);
	}

    function save() {
        $this->menus->save();
    }

    public function user_menu() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('menu_to_user');
            $crud->set_subject(label('My Menu', $this, $this->user));
            $crud->set_relation('menu_id', 'menus', 'ListName');
            $crud->unset_fields('menu_id','user_id','is_read','is_write','is_delete','updatedate');
            $crud->display_as('is_dashboard', 'Dashboard');
            $crud->display_as('menu_id', 'Menu');
            $crud->columns('menu_id', 'is_dashboard');
            $crud->unique_fields('menu_id');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->unset_delete();
            $crud->unset_read();
            $crud->unset_add();
            $crud->where('user_id',$userid);
            $crud->where('url!=',"");
            $columns = array('menu_id', 'is_dashboard');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}
