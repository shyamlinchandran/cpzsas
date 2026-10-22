<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Item extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('items_model', 'item');
        $this->load->library('excel'); //load PHPExcel library 
        $this->load->model('excel_data_insert_model', 'itemexcel');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/list_all');
    }

    public function getitembarcode($id) {
        return $this->item->getitembarcode($id);
    }

    public function printlist($item_id, $unit_id) {
        $data['units'] = $this->item->getunits($unit_id);
        $data['id'] = $item_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/printlist', $data);
    }

    function editbarcode($id, $unit_id) {
        $data['id'] = $id;
        $data['unit_id'] = $unit_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('items/editbarcode', $data);
    }

    public function getbarcode() {
        return $this->item->getbarcode();
    }

    function create($id = 0, $type = '') {
        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $itemtype = $this->item->Itemtype();
        $settings = $this->item->getCompanySettings();
        $data['settings'] = $settings;
        $data['itemtype'] = $itemtype;
        $data['id'] = $id;
        $data['type'] = $type;
        $data['view'] = "create";
        $this->load->view('items/create', $data);
    }

    function getsing($id) {
        $this->item->getsing($id);
    }

    function check_barcode($id) {
        $this->item->check_barcode($id);
    }

    function godownitem($id) {
        $this->item->getgodownitem($id);
        // echo json_encode($result);
    }

    function otheritem($id) {
        $this->item->getotheritem($id);
        // echo json_encode($result);
    }

    function allgodown() {
        $this->item->getallgodown();
    }

    function gettaxldg($id) {
        $this->item->gettaxldg($id);
    }

    public function taxldg_find($type) {
        $search = strtolower($_GET['term']);
        return $this->item->taxldg_find($search, $type);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $data['isbatch'] = $this->getKey('isbatch');
        $settings = $this->item->getCompanySettings();
        $itemtype = $this->item->Itemtype();
        $data['itemtype'] = $itemtype;
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('items/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $data['isbatch'] = $this->getKey('isbatch');
        $settings = $this->item->getCompanySettings();
        $itemtype = $this->item->Itemtype();
        $data['itemtype'] = $itemtype;
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('items/create', $data);
    }

    public function delete($id) {
        $this->item->delete($id);
    }

    public function barcode_list() {
        $this->item->barcode();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $count=1;
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            if ($no < 2) {
                 $name = $item->name;
                 $sid= $item->sid;
            } else {
                $count = $count * $item->unit_count;
                $item->srate = $item->srate*$count;
                if($item->sid===0){
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
            $act = '<a  href="' . base_url() . 'item/editbarcode/' . $sid . '/' . $item->uid . '" title="Edit" data-toggle="Change Barcode" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a><span></span><a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'item/bill/' . $sid . '/' . $item->id . '" title="Print Barcode"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->item->where();
        $list = $this->item->get_datatables();
//        print_r($list);
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $itemcount = $this->item->getledgeritem($item->id);
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
            $act = '<a  href="' . base_url() . 'item/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'item/bill/' . $item->id . '" title="Print Barcode"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>
                  <a  href="' . base_url() . 'item/printlist/' . $item->id . '/' . $item->unit_id . '" title="Multiple Barcode" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-modal-window"></span></a>
<a  class="btn btn-info "  href="' . base_url() . 'item/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            if ($itemcount == 0) {
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/item/listall/' . '"  success="Delete ' . $item->itemname . ' successfuly "  message="Do you want Delete ' . $item->itemname . '?"  href="' . base_url() . 'item/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function savebarcode() {
        $this->item->savebarcode();
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
        $this->item->save($img_a, $img_b, $img_c, $vdo_a, $vdo_b);
    }

    function itemuploads($file, $type, $fileid) {
        if ($type == "image") {
            $config['upload_path'] = 'uploads/images/item/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '1024'; //1 MB
        } else {
            $config['upload_path'] = 'uploads/video/item/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '1024'; //1 MB            
        }
        $this->load->library('upload', $config);
        $this->upload->do_upload($fileid);
        return;
        /* if (file_exists($config['upload_path'] . $file['name'])) {
          $response = array(
          'valid' => false,
          'type' => 1,
          'message' => 'File already exists : ' . $config['upload_path'] . $file['name']
          );
          echo json_encode($response);
          return;
          } else {
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload($fileid)) {
          $response = array(
          'valid' => false,
          'type' => 1,
          'message' => $this->upload->display_errors()
          );
          echo json_encode($response);
          return;
          }
          } */
    }

    function savefromexcel() {
        ini_set('max_execution_time', 300);
        $this->item->savefromexcel();
    }

    function bill($id, $uid = "") {
        $unit = "";
//        if ($uid !== "") {
//            $unit = '/' . $uid;
//        }
        $this->load->library('Pdf');
        $pdf = new TCPDF("L", "mm", array(103, 25), true, 'UTF-8', false);
        $pdf->SetMargins(0, 0, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->setFontSubsetting(true);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetFont('freeserif', '', 12);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $date = date("ny");
        $data = $this->item->getpitem($id)[0];
        if ($uid !== "") {
            $data['barcode'] = $uid;
        }
        //print_r($data);
        for ($i = 0; $i < 1; $i++) {
            $pdf->AddPage();
            $style = array(
                //'border' => true,
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => array(255, 255, 255),
                ///'text' => true,
                'font' => 'helvetica',
                'fontsize' => 8,
                'stretchtext' => 4
            );
            $html = '<table margin="2" cellpadding="1" cellspacing="2">
              <tr>
              <td style="text-align:Center;">
             <b style="font-size: small;">Company</b> <br/>
            <b style="font-size: x-small;">' . $data['name'] . '-' . $data['barcode'] . '/' . $date . ' </b> <br/> 
            <b style="font-size: small;"> MRP:₹' . $data['MRP'] . ' </b>  
              ' . $pdf->write1DBarcode($data['barcode'] . $unit, 'C39', '5', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              <td style="text-align:Center;">
              <b style="font-size: small;">Company</b> <br/>
            <b style="font-size: x-small;">' . $data['name'] . '-' . $data['barcode'] . '/' . $date . ' </b> <br/> 
            <b style="font-size: small;"> MRP:₹' . $data['MRP'] . ' </b>  
              ' . $pdf->write1DBarcode($data['barcode'] . $unit, 'C39', '60', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              </tr>
              </table>'; /*  for walk liineEAN13 */
            /* $html = '<table margin="2" cellpadding="1" cellspacing="2">
              <tr>
              <td style="text-align:Center;">
              <b style="font-size: small;">Dimind Innovations</b> <br/>
              <b style="font-size: x-small;">' . $data['name'] . '-A214s </b> <br/>
              <b style="font-size: small;">Rate :₹245.' . $data['MRP'] . ' MRP:₹232.' . $data['MRP'] . ' </b>
              ' . $pdf->write1DBarcode('2jk14s', 'C39', '5', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              <td style="text-align:Center;">
              <b style="font-size: small;">Dimind Innovations</b> <br/>
              <b style="font-size: x-small;">' . $data['name'] . '-A214s </b> <br/>
              <b style="font-size: small;">Rate :₹245.' . $data['MRP'] . ' MRP:₹232.' . $data['MRP'] . ' </b>
              ' . $pdf->write1DBarcode('2a14s', 'C39', '60', '15', '40', 9, 0.5, $style, 'L') . '
              </td>
              </tr>
              </table>';/*  for JK */
            $pdf->writeHTML($html, false, false, false, false, '');
        }
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

    public function excel() {
        $this->load->view('_blocks/subpages/create');
        $data['page'] = 'item';
        $data['title'] = 'Item';
        $data['mymsg'] = '';
        $this->load->view('excelupload', $data);
    }

    public function Upload_ExcelData() {
        $config['upload_path'] = 'uploads/excel';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        //$config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB
        $this->load->library('upload', $config);
        $this->upload->do_upload('file');
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name']; //uploded file name
        $extension = $upload_data['file_ext'];
        $table_name = $this->input->post('table_name');
        $data['table_name'] = $table_name;
        $data['file_name'] = $file_name;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/listall_exceldata', $data);
    }

    public function list_excel($filename, $table_name) {
        $objReader = PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007     
        //Set to read only
        $objReader->setReadDataOnly(true);
        //Load excel file
        $objPHPExcel = $objReader->load(FCPATH . 'uploads/excel/' . $filename);
        $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel  
        $HighestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();   //Count Numbe of rows avalable in excel  
        if ($totalrows > 5000) {
            
        }
        //$totalcol = $objPHPExcel->setActiveSheetIndex(0);   //Count Numbe of rows avalable in excel  
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->setActiveSheetIndex(0);
// $sheet = $objPHPExcel->getActiveSheet();
        $sheet = $objPHPExcel->getActiveSheet()->rangeToArray('A1:' . $HighestColumn . '' . $totalrows . '', NULL, True, True);

        $inc = 0;
        $count = $col = 0;
        $selectoptions = $this->item->gettablefields($table_name);
        $i = 0;
        foreach ($sheet as $column) {
            $i++;
            if ($i == 1) {
                echo '<tr>';
                $j = 0;
                $m = 0;
                $leng = sizeof($column);
                for ($k = 0; $k < $leng; $k++) {
                    $m++;
                    echo '<th>';
                    echo '<select name="colselect_' . $m . '" class="form-control" style="width : 200px;">"' . $selectoptions . '"</select></th>';
                }
                echo '</tr>';
            }

            echo '<tr>';
            $j = 0;
            $m = 0;
            $leng = sizeof($column);
            for ($k = 0; $k < $leng; $k++) {
                $m++;
                if ($i < 2) {
                    echo '<td>';
                    echo '<input type="hidden" name="txtt_' . $m . $i . '" value="' . $column[$k] . '" />' . $column[$k];
                    echo '</td>';
                    $count = $i;
                    $col = $m;
                } else {
                    echo '<td>';
                    echo '<input type="hidden" name="txt_' . $m . $i . '" value="' . $column[$k] . '" />' . $column[$k];
                    echo '</td>';
                    $count = $i;
                    $col = $m;
                }
            }
            echo '</tr>';
        }




// foreach($sheet->getRowIterator() as $row)
// {
//     $inc++;
//        if($inc==1){
//             echo '<tr>';
//         $nc=0;
//         foreach($row->getCellIterator() as $key => $cell)
//     {
//          if ($cell->getCalculatedValue()!=''){
//               $nc++;
//             echo '<th>';
//             echo '<select name="colselect_'. $nc.'" class="form-control" style="width : 200px;">"'.$selectoptions.'"</select></th>';
//         }
//         }
//         echo '</tr>';
//             }
//           echo '<tr>';
//            $nc=0;
//     foreach($row->getCellIterator() as $key => $cell)
//     {
//         $nc++;
//         //echo $key; // 0, 1, 2...
//         // if ($cell->getCalculatedValue()!=''){
//         if($inc<2){
//              echo '<td>';
//             echo '<input type="hidden" name="txtt_'.$nc. $inc.'" value="'. $cell->getCalculatedValue().'" />' . $cell->getCalculatedValue(); 
//                    echo '</td>';
//                    $count=$inc;
//                    $col=$nc;
//         }
//          else
//            { echo '<td>';
//                        echo '<input type="hidden" name="txt_'.$nc. $inc.'" value="'. $cell->getCalculatedValue().'" />' . $cell->getCalculatedValue(); 
//                               echo '</td>';
//                               $count=$inc;
//                               $col=$nc;}
//         // }
//     }
//         echo '</tr>';
// }

        echo ' <input type="hidden" name="counttotal" value="' . $count . '">';
        echo ' <input type="hidden" name="countcol" value="' . $col . '">';
        //loop from first data untill last data

        /*  $no = $this->input->post('start');
          for ($i = 2; $i <= $totalrows; $i++) {
          $no++;
          $row = array();
          $row[] = $no;
          $row[] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
          $row[] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
          $row[] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
          $row[] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
          $row[] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
          $row[] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();


          $row[] = '';
          $data[] = $row;
          }
          $output = array(
          "draw" => $this->input->post('draw'),
          "recordsTotal" => $this->item->count_all(),
          "recordsFiltered" => $this->item->count_filtered(),
          "data" => $data,
          );
          //output to json format
          echo json_encode($output); */
    }

    public function ExcelDataAdd() {
        //upload file
        $config['upload_path'] = 'uploads/excel';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        //$config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB
        $this->load->library('upload', $config);
        $this->upload->do_upload('file');
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name']; //uploded file name
        $extension = $upload_data['file_ext'];
        //echo 'File successfully uploaded : uploads/excel' . $_FILES['file']['name'];
        //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $objReader = PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007     
        //Set to read only
        $objReader->setReadDataOnly(true);
        //Load excel file
        $objPHPExcel = $objReader->load(FCPATH . 'uploads/excel/' . $file_name);
        $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel         
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        //loop from first data untill last data
        for ($i = 2; $i <= $totalrows; $i++) {
            $name = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
            $barcode = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue(); //Excel Column 1
            $price_code = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue(); //Excel Column 2
            $item_category = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue(); //Excel Column 3
            $item_group = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue(); //Excel Column 4
            $unit = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue(); //Excel Column 5
            $open_stock = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue(); //Excel Column 6
            $current_stock = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue(); //Excel Column 7
            $reorder_point = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue(); //Excel Column 8
            $prate = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue(); //Excel Column 9
            $srate = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue(); //Excel Column 10
            $MRP = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue(); //Excel Column 11
            $commission = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue(); //Excel Column 12
            $tax = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue(); //Excel Column 13
            $hsn = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue(); //Excel Column 14
            $item_type = $objWorksheet->getCellByColumnAndRow(15, $i)->getValue(); //Excel Column 15
            $godown = $objWorksheet->getCellByColumnAndRow(16, $i)->getValue(); //Excel Column 16
            $date = date("Y-m-d");
            $getcategorycount = $this->item->getidcount('item_category', $item_category); // check if item category exists
            if ($getcategorycount > 0) {
                $getcategoryid = $this->item->getid('item_category', $item_category); // get category id from name
                foreach ($getcategoryid as $item) {
                    $item_category_id = $item->id;
                }
            } else {
                $item_category_id = 1;
            }
            $getgroupcount = $this->item->getidcount('item_group', $item_group); // check if item group exists
            if ($getgroupcount > 0) {
                $getgroupid = $this->item->getid('item_group', $item_group); // get group id from name
                foreach ($getgroupid as $item) {
                    $item_group_id = $item->id;
                }
            } else {
                $item_group_id = 1;
            }
            $getunitcount = $this->item->getidcount('units', $unit); // check if unit exists
            if ($getunitcount != 0) {
                $getunitid = $this->item->getid('units', $unit); // get unit id from name

                foreach ($getunitid as $item) {
                    $unit_id = $item->id;
                }
            } else {
                $unit_id = 1;
            }
            $gettaxcount = $this->item->gettaxcount($tax); // check if tax exists
            if ($gettaxcount != 0) {
                $gettaxid = $this->item->gettaxid($tax); // get tax id from name

                foreach ($gettaxid as $item) {
                    $tax_id = $item->gstid;
                }
            } else {
                $tax_id = 1;
            }
            $gethsncount = $this->item->gethsncount($hsn); // check if tax exists
            if ($gethsncount != 0) {
                $gethsnid = $this->item->gethsnid($hsn); // get tax id from name

                foreach ($gethsnid as $item) {
                    $hsncode = $item->hsnid;
                }
            } else {
                $hsncode = 1;
            }

            $gettypecount = $this->item->getidcount('item_type', $item_type); // check if item group exists

            if ($gettypecount > 0) {
                $gettypeid = $this->item->getid('item_type', $item_type); // get group id from name
                foreach ($gettypeid as $item) {
                    $item_type_id = $item->id;
                }
            } else {
                $item_type_id = 1;
            }

            $getitemcount = $this->item->getitemcount($name); // check if item exists
            if ($getitemcount > 0) {
                echo $getitemcount;
            } else {
                $data_item = array('name' => $name, 'barcode' => $barcode, 'price_code' => $price_code, 'item_category_id' => 1, 'item_group_id' => 1, 'unit_id' => 1, 'open_stock' => $open_stock, 'current_stock' => $current_stock, 'reorder_point' => $reorder_point, 'min_level' => 1, 'max_level' => 10, 'rack' => 0, 'prate' => $prate, 'srate' => $srate, 'wh_rate' => 0, 'MRP' => $MRP, 'open_stk_rate' => 1, 'commission' => $commission, 'tax_ledger_id' => 1, 'tax_sales_id' => 1, 'tax_purchase_id' => 1, 'hsncode' => 1, 'item_type_id' => 1, 'godown' => $godown, 'description' => 'test');
                $this->item->Add_item($data_item);
            }
            //print_r($data_item);
            //$this->itemexcel->Add_item($data_item);
            //$insert_id = $this->db->insert_id();
            /* $data_ledger=array('item_id'=>$insert_id, 'open_stock'=>$open_stock,'quantity'=>$current_stock,' trans_date'=>$date,'trans_type'=>'cr','trans_status'=>'sales','trans_id'=>1,'rate'=>$prate,'MRP'=>$MRP,'tax_id'=>$tax_id,'godown'=>$godown);
              $this->itemexcel->Add_item_ledger($data_ledger); */
        }
        unlink('././uploads/excel/' . $file_name); //File Deleted After uploading in database .           
        //redirect(base_url() . "dashboard/main");
    }

}
