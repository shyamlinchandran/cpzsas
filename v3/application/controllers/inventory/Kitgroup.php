<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Kitgroup extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('inventory/Kitgroup_model', 'kit');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('inventory/kitgroup/list_all');
    }

    public function getbarcode() {
        return $this->item->getbarcode();
    }

    function create($id = 0, $type = '') {
        $this->load->view('_blocks/subpages/create');
        $data['tags_items'] = $this->kit->tag_items($id);
        $data['tags'] = $this->kit->getalltags();
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $itemtype = $this->kit->Itemtype();
        $settings = $this->kit->getCompanySettings();
        $data['settings'] = $settings;
        $data['itemtype'] = $itemtype;
        $data['id'] = $id;
        $data['type'] = $type;
        $data['view'] = "create";
        $this->load->view('inventory/kitgroup/create', $data);
    }

    function getsing($id) {
        $this->kit->getsing($id);
    }

    function check_barcode($id) {
        $this->kit->check_barcode($id);
    }

    function godownitem($id) {
        $this->kit->getgodownitem($id);
        // echo json_encode($result);
    }

    function otheritem($id) {
        $this->kit->getotheritem($id);
        // echo json_encode($result);
    }

    function allgodown() {
        $this->kit->getallgodown();
    }

    function gettaxldg($id) {
        $this->kit->gettaxldg($id);
    }

    public function taxldg_find($type) {
        $search = strtolower($_GET['term']);
        return $this->kit->taxldg_find($search, $type);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $data['tags'] = $this->kit->getalltags();
        $data['tags_items'] = $this->kit->tag_items($id);
        $data['isbatch'] = $this->getKey('isbatch');
        $settings = $this->kit->getCompanySettings();
        $itemtype = $this->kit->Itemtype();
        $data['itemtype'] = $itemtype;
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('inventory/kitgroup/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $data['tags'] = $this->kit->getalltags();
        $data['tags_items'] = $this->kit->tag_items($id);
        $data['isbatch'] = $this->getKey('isbatch');
        $settings = $this->kit->getCompanySettings();
        $itemtype = $this->kit->Itemtype();
        $data['itemtype'] = $itemtype;
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('inventory/items/create', $data);
    }

    public function delete($id) {
        $this->kit->delete($id);
    }

    public function barcode_list() {
        $this->kit->barcode();
        $list = $this->kit->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $count = 1;
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            if ($no < 2) {
                $name = $item->name;
                $sid = $item->sid;
            } else {
                $count = $count * $item->unit_count;
                $item->srate = $item->srate * $count;
                if ($item->sid === 0) {
                    $item->irate = 'add rate';
                }
            }
            $row = array();
            $row[] = $no;
            $row[] = $name;
            $row[] = $item->unit;
            $row[] = $count;
            $row[] = $item->irate;
            $row[] = $item->item_barcode;
            $act = '<a  href="' . base_url() . 'inventory/kitgroup/editbarcode/' . $sid . '/' . $item->uid . '" title="Edit" data-toggle="Change Barcode" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a><span></span><a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'inventoryitem/bill/' . $sid . '/' . $item->id . '" title="Print Barcode"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->kit->count_all(),
            "recordsFiltered" => $this->kit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->kit->where();
        $list = $this->kit->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $itemcount = $this->kit->getledgeritem($item->id);
            //print_r($itemcount);
            $row = array();
            $row[] = $no;
            $row[] = $item->barcode;
            $row[] = $item->itemname;
            $row[] = $item->category;
            $row[] = $item->prate;
            $row[] = $item->salerate;
            $row[] = $item->total;
            ///////////////////////////////////////////Barcode colmn hide//////////////////////////////////////////////////
//            if ($isbatch == 0) {
//                $row[] = $items->barcode;
//            }
            //$row[] = $item->group_name;
            //$row[] = $item->unit;
            // $row[] = $item->tax;
            $act = '<a  href="' . base_url() . 'inventory/kitgroup/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'inventory/kitgroup/bill/' . $item->id . '" title="Print Barcode"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>
                  <a  href="' . base_url() . 'inventory/kitgroup/printlist/' . $item->id . '/' . $item->unit_id . '" title="Multiple Barcode" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-modal-window"></span></a>
<a  class="btn btn-info "  href="' . base_url() . 'inventory/kitgroup/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            if ($itemcount == 0) {
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'inventory/kitgroup/listall/' . '"  success="Delete ' . $item->itemname . ' successfuly "  message="Do you want Delete ' . $item->itemname . '?"  href="' . base_url() . 'inventory/kitgroup/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->kit->count_all(),
            "recordsFiltered" => $this->kit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function savebarcode() {
        $this->kit->savebarcode();
    }

    function save() {
        $img_a = '';
        $img_b = '';
        $img_c = '';
        $vdo_a = '';
        $vdo_b = '';
        if (isset($_FILES['file_a'])) {
            $file = $_FILES['file_a'];
            $type = 'image';
            //upload file  
            $fileid = 'file_a';
            $this->itemuploads($file, $type, $fileid);
            $img_a = $_FILES['file_a']['name'];
            $fileid = 'file_a';
        }
        if (isset($_FILES['file_b'])) {
            $file = $_FILES['file_b'];
            $type = 'image';
            //upload file  
            $fileid = 'file_b';
            $this->itemuploads($file, $type, $fileid);
            $img_b = $_FILES['file_b']['name'];
        }
        if (isset($_FILES['file_c'])) {
            $file = $_FILES['file_c'];
            $type = 'image';
            //upload file  
            $fileid = 'file_c';
            $this->itemuploads($file, $type, $fileid);
            $img_c = $_FILES['file_c']['name'];
        }
        if (isset($_FILES['vidfile_a'])) {
            $vidfile = $_FILES['vidfile_a'];
            $type = 'video';
            //upload file  
            $fileid = 'vidfile_a';
            $this->itemuploads($vidfile, $type, $fileid);
            $vdo_a = $_FILES['vidfile_a']['name'];
        }
        if (isset($_FILES['vidfile_b'])) {
            $vidfile = $_FILES['vidfile_b'];
            $type = 'video';
            //upload file  
            $fileid = 'vidfile_b';
            $this->itemuploads($vidfile, $type, $fileid);
            $vdo_b = $_FILES['vidfile_b']['name'];
        }
        $this->kit->save($img_a, $img_b, $img_c, $vdo_a, $vdo_b);
    }

    function printbarcode() {
        $insert_id = $this->item->printbarcode();
        $this->barcodedata = $insert_id;
        $response = array(
            'valid' => false,
            'type' => 1,
            'bill' => base_url() . 'item/print_item_barcode/' . $insert_id,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function bill($id) {
        $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(76.2, 50.8), 'margin_bottom' => 0, 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->language = "ac";
        $this->lang->load('ac_site', 'ac');
        $com = $this->item->getCompany();
        $pdf->SetDirectionality('rtl');
        $data = $this->item->getpitem($id, 0)[0];
        $html = '<style>
            body{
                font-family: sans-serif;
            }</style><p style="text-align:center;margin-top: 0px;margin-bottom: 0px;"><font style="font-size:15px;font-weight:bold;" >' . $com['name'] . '</font><br><barcode style="width: 50%;" code="' . $data['barcode'] . '" size=".7" type="C39" height="1.5" text="1" /> <font style="font-size:20px;font-weight:bold;" >'
                . $data['barcode'] . '</font><br /><font style="font-size:16px;font-weight:bold;" >' . $data['name'] . '</font><br /><font style="font-size:16px;font-weight:bold;" >Salerate:' . $data['srate'] . '</font></p>';
        $pdf->writeHTML($html);
        $pdf->Output('example_021.pdf', 'I');
    }

    public function _callback_name($value, $row) {
        if ($row->name_lan == '') {
            return $row->name;
        } else {
            return $row->name_lan;
        }
    }

    public function racks() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('item_racks_master');
            $crud->set_subject(label('Racks', $this, $this->user));
            $crud->required_fields('name', 'rows');
            $crud->columns('name', 'rows');
            $crud->unique_fields('name');
            $crud->display_as('name', 'Name');
            if ($this->multiple == 0) {
                $crud->fields('name', 'rows');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'rows');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $columns = array('name', 'rows', 'name_lan');
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
