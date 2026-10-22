<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of items
 *
 * @author u43255
 */
class Items extends MY_Controller {

    public $fitem = 4;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('items_model', 'items');
        $this->load->helper('url');
    }
	
	
		public function clone_data(){
		ini_set('max_execution_time', 30000000);
		
		$DB_HOST = 'localhost';
$DB_USER = 'ozonejk';
$DB_PASS = 'ozone@8891';

$DB_SRC = 'spanish_2021';
$DB_DST = 'newly_created_dbs';



// MYSQL Connect

$mysqli = new mysqli( $DB_HOST, $DB_USER, $DB_PASS ) or die( $mysqli->error );
		$mysqli->query( "CREATE DATABASE $DB_DST" ) or die( $mysqli->error );



// Iterate through tables of source database

$tables = $mysqli->query( "SHOW TABLES FROM $DB_SRC where Tables_in_$DB_SRC not like '%hotel%' " ) or die( $mysqli->error );

while( $table = $tables->fetch_array() ): $TABLE = $table[0];


    // Copy table and contents in destination database

    $mysqli->query( "CREATE TABLE $DB_DST.$TABLE LIKE $DB_SRC.$TABLE" ) or die( $mysqli->error );
    $mysqli->query( "INSERT INTO $DB_DST.$TABLE SELECT * FROM $DB_SRC.$TABLE" ) or die( $mysqli->error );


endwhile;
	}
	
	
	

    public function itemtype() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('item_type');
            $crud->set_subject(label('Item Types', $this, $this->user));
            $crud->unique_fields('name');
            $crud->required_fields('name');
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->columns('name');
            if ($this->multiple == 0) {
                $crud->fields('name');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $columns = array('name','name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function itemgroup() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('item_group');
            $crud->set_subject(label('Item Discount Group', $this, $this->user));
            $crud->unique_fields('name');
            $crud->columns('name', 'discount');
            $grpdiscount = $this->getKey('grpdiscount');
            if ($grpdiscount == 0) {
                $crud->columns('name');
                $crud->field_type('discount', 'hidden', '0');
            }
            $crud->required_fields('name', 'discount');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('published', 'hidden', 'yes');            
            if ($this->multiple == 0) {
                $crud->fields('name', 'discount');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'discount');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $columns = array('name', 'discount','name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_name($value, $row) {
        if ($row->name_lan == '') {
            return $row->name;
        } else {
            return $row->name_lan;
        }
    }
	
	    public function itemcategory() {
        try {
            $crud = new grocery_CRUD();
            $category_barcode = 0 ;
            $settings = $this->items->getCompanySettings();
            if(isset($settings[0]['category_barcode'])){
                $category_barcode = $settings[0]['category_barcode'];
            }
            $crud->set_theme('datatables');
            $crud->set_table('item_category');
            if($category_barcode>0 ){
                $crud->display_as('category_code', 'Code');
            }
            $crud->display_as('item_category_id', 'Parent');
            $crud->set_subject(label('Item Categories', $this, $this->user));
            $crud->set_relation('discount', 'item_group', 'name');
            $crud->columns('name', 'item_category_id','discount');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            //$crud->where('item_type_id', $type);
            //$crud->set_relation('item_category_id', 'item_category as a', 'name', array('a.item_type_id' => $type, 'published' => 'yes'), 'name ASC');
            $crud->unique_fields('name');
            $crud->required_fields('name');
            //$crud->set_relation('item_type_id', 'item_type', 'name');
            $crud->set_relation('item_category_id', 'item_category', 'name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('item_type_id', 'hidden', '3');
            $columns = array('name', 'item_category_id','name_lan','discount');
            if ($this->multiple == 0) {
                $crud->fields('name', 'item_category_id','discount');
                if($category_barcode>0 ){
                    $crud->fields('name', 'item_category_id','category_code','discount');
                }
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'item_category_id','discount');
                    if($category_barcode>0 ){
                        $crud->columns('name_lan', 'item_category_id','category_code','discount');
                    }
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    // public function itemcategory() {
    //     try {
    //         $crud = new grocery_CRUD();
    //         $crud->set_theme('datatables');
    //         $crud->set_table('item_category');
    //         $crud->display_as('item_category_id', 'Parent');
    //         $crud->set_subject(label('Item Categories', $this, $this->user));
    //         $crud->columns('name', 'item_category_id', 'image');
    //         $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
    //         $crud->unset_columns(array('published', 'updatedate'));
    //         //$crud->where('item_type_id', $type);
    //         //$crud->set_relation('item_category_id', 'item_category as a', 'name', array('a.item_type_id' => $type, 'published' => 'yes'), 'name ASC');
    //         $crud->unique_fields('name');
    //         $crud->required_fields('name','image');
    //         //$crud->set_relation('item_type_id', 'item_type', 'name');
    //         $crud->set_relation('item_category_id', 'item_category', 'name');
    //         $crud->field_type('published', 'hidden', 'yes');
    //         $crud->field_type('item_type_id', 'hidden', '3');
    //         $crud->set_field_upload('image','assets/uploads/');
    //         $columns = array('name', 'item_category_id','name_lan','image');
            
    //         if ($this->multiple == 0) {
    //             $crud->fields('name', 'item_category_id','image');
    //         } else {
    //             if ($this->language != 'en') {
    //                 $crud->columns('name_lan', 'item_category_id','image');
    //                 $crud->callback_column('name_lan', array($this, '_callback_name'));
    //             }
    //         }
    //         foreach ($columns as $column) {
    //             $crud->display_as($column, label($column, $this, $this->user));
    //         }
    //         $output = $crud->render();
    //         $this->load->view('masters/masters', $output);
    //     } catch (Exception $e) {
    //         show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
    //     }
    // }

    public function list_category()
    {
        $data['settings'] = $this->items->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $data['id'] = 0;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/list_category', $data);
    }

    public function fooditem() {
        try {
            $type = 12;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->where('item_type_id', $type);
            $crud->set_table('item');
            $crud->display_as('item_type_id', 'Type');
            $crud->display_as('item_category_id', 'Category');
            $crud->display_as('tax_id', 'Tax');
            $crud->display_as('srate', 'Sales Rate');
            $crud->display_as('unit_id', 'Unit');
            $crud->set_subject('Food Items');
            $crud->unique_fields('name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            $grpdiscount = $this->getKey('grpdiscount');
            if ($grpdiscount == 0) {
                $crud->columns('name');
                $crud->field_type('discount', 'hidden', '0');
            }
            $crud->required_fields('name', 'barcode', 'item_category_id', 'unit_id', 'tax_id');
            $crud->set_rules('MRP', 'MRP', 'required|numeric');
            $crud->set_rules('srate', 'srate', 'required|numeric');
            $crud->set_rules('open_stock', 'open_stock', 'required|numeric');
            $crud->set_relation('unit_id', 'units', 'name');
            $crud->set_relation('tax_id', 'tax', 'name');
            $crud->set_relation('item_category_id', 'item_category', 'name', array('item_type_id' => $type, 'published' => 'yes'), 'name ASC');
            $crud->field_type('prate', 'hidden', 'yes');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('current_stock', 'hidden', 0);
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function ingradient() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->where('item_type_id', $type);
            $crud->set_table('item');
            $crud->set_subject('Ingredients');
            $crud->display_as('item_type_id', 'Type');
            $crud->display_as('item_category_id', 'Category');
            $crud->display_as('tax_id', 'Tax');
            $crud->display_as('prate', 'Purchase Rate');
            $crud->display_as('unit_id', 'Unit');
            $crud->unique_fields('name');
            $crud->required_fields('name', 'barcode', 'item_category_id', 'unit_id', 'tax_id');
            $crud->set_rules('MRP', 'MRP', 'required|numeric');
            $crud->set_rules('prate', 'srate', 'required|numeric');
            $crud->set_rules('open_stock', 'open_stock', 'required|numeric');
            $crud->set_relation('unit_id', 'units', 'name');
            $crud->set_relation('tax_id', 'tax', 'name');
            $crud->set_relation('item_category_id', 'item_category', 'name', array('item_type_id' => $type, 'published' => 'yes'), 'name ASC');
            $crud->field_type('srate', 'hidden', 'yes');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('current_stock', 'hidden', 0);
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function item() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('item');
            $crud->set_subject('Items');
            $crud->display_as('item_type_id', 'Type');
            $crud->display_as('item_group_id', 'Group');
            $crud->display_as('item_category_id', 'Category');
            $crud->display_as('prate', 'Purchase Rate');
            $crud->display_as('srate', 'Sales Rate');
            $crud->display_as('unit_id', 'Unit');
            $crud->unique_fields('name');
            $crud->display_as('tax_id', 'GST');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            //////////////////////Textbox hide when value=1///////////////////////////////////
            $isbatch = $this->getKey('isbatch');
            if ($isbatch != 0) {
                $crud->columns('name', 'item_category_id', 'unit_id', 'item_group_id');
                $crud->field_type('open_stock', 'hidden', '0');
                $crud->field_type('prate', 'hidden', '0');
                $crud->field_type('barcode', 'hidden', '0');
                $crud->field_type('open_stock', 'hidden', '0');
                $crud->field_type('MRP', 'hidden', '0');
                $crud->required_fields('name', 'item_type_id', 'item_category_id', 'unit_id');
            } else {
                $crud->columns('name', 'barcode', 'item_category_id', 'unit_id', 'tax_id', 'item_group_id');
                $crud->required_fields('name', 'barcode', 'item_category_id', 'unit_id');
                $crud->set_rules('MRP', 'MRP', 'required|numeric');
                $crud->set_rules('prate', 'srate', 'required|numeric');
                $crud->set_rules('open_stock', 'open_stock', 'required|numeric');
            }
            $crud->set_relation('tax_id', 'taxgst', 'GST');
            $crud->set_relation('hsncode', 'hsncode', 'hsncode');
            $crud->unset_back_to_list();
            $crud->set_relation('unit_id', 'units', 'name');
            $crud->set_relation('item_group_id', 'item_group', 'name');
            $crud->set_relation('item_category_id', 'item_category', 'name', array('item_type_id' => $type, 'published' => 'yes'), 'name ASC');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('current_stock', 'hidden', 0);
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_category($id = 0, $opt = "create")
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['option'] = $opt;
        $data['settings'] = $this->items->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/create_category', $data);
    }

    public function get_category()
    {
        $this->items->get_category();
    }

    public function save_category()
    {
        if (!isset($_FILES["file"]['name'])) {
                
            $new_name = "";
            $insert_id = $this->items->save_category($new_name);

    }
    else{       
        $ms = $_FILES['file'];

            $new_name = time() . $_FILES["file"]['name'];
            $new_name = str_replace(' ','',$new_name);
            $config['upload_path'] = 'assets/uploads/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '2048';
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config); 
            if ($this->upload->do_upload('file')) {
                $insert_id = $this->items->save_category($new_name);
            }

        }
    }

    public function delete_category($id)
    {
        $this->items->delete_category($id);
    }

    public function get_cat_data($id)
    {
        $this->items->get_cat_data($id);
    }
	
	public function savefeature(){
        $this->items->savefeature();

	}
	
	public function features($id){
		$qry ="select * from item_category where id=".$id;
		$data['category'] = $this->db->query($qry)->row_array();
		$data['id'] = $id;
		$qry = "select * from itemtypemaster";
		$data['itemtypemaster'] =  $this->db->query($qry)->result_array();
		$qry  ="SELECT  a.*,IFNULL(b.id,0) as category FROM `itemtypevalue` as a left JOIN itemtypecategory as b on a.id=b.itemtypevalue and b.published='yes' and b.categoryid=".$id." where   a.published='yes' ";
		$data['categoryfeature'] =  $this->db->query($qry)->result_array();
		$this->load->view('_blocks/subpages/create');
        $this->load->view('items/addfeatures', $data);

	}

    public function category_list()
    {
        $act = "";
        //$this->Enquiry_allocation->where();
        $this->items->category_list();
        $list = $this->items->get_datatables();
        
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $datass = $this->items->getCompanySettings();
            if($datass[0]['is_image'] == 'yes'){
                if($items->icimage != ""){
                    $row[] = '<img src="'.base_url().'assets/uploads/' .$items->icimage. '" height="60px" width="100px" />';
                }
                else{
                    $row[] = '<img src="'.base_url().'assets/uploads/noimage.jpg" height="60px" width="100px" />';
                }
            }
            $row[] = $items->name;
            $row[] = $items->iccname;
            $act = ' <a  back="' . base_url() . 'Items/list_category"  href="' . base_url() . 'Items/create_category/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'Items/list_category' . '"  success="Delete ' . $items->name . ' successfuly "  message="Do you want to Delete ' . $items->name . '?"  href="' . base_url() . 'Items/delete_category/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'Items/list_category"  href="' . base_url() . 'Items/create_category/' . $items->id . '/view" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act .= ' <a  back="' . base_url() . 'Items/list_category"  href="' . base_url() . 'Items/features/' . $items->id . '" data-toggle="tooltip" title="Add Feature" class="btn btn-info ">Add Feature</a>';

            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all(),
            "recordsFiltered" => $this->items->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
