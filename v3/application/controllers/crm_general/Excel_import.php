<?php

class Excel_import extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('crm_general/Excel_import_model', 'import');
		$this->load->library('excel'); //load PHPExcel library 
        $this->load->model('excel_data_insert_model', 'itemexcel');
    }
	
	function savefromexcel()
    {
        ini_set('max_execution_time', 300);
        $this->import->savefromexcel();
    }
	
	public function excel()
    {
        $this->load->view('_blocks/subpages/create');
        $data['page'] = 'item';
        $data['title'] = 'Item';
        $data['mymsg'] = '';
        $this->load->view('crm_general/import/excel_import', $data);
    }
	
	public function Upload_ExcelData()
    {
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
        $this->load->view('crm_general/import/listall_exceldata', $data);
    }
	    public function list_excel($filename, $table_name)
    {
        $array1 = $this->excelToArray(FCPATH . 'uploads/excel/' . $filename);
        //        foreach ($array1 as $item) {
        //            $item1 = json_encode($item, JSON_UNESCAPED_UNICODE);
        //            $data1 = array(
        //                'val' => $item1
        //            );
        //            $this->db->insert('new', $data1);
        //        }
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
                    echo '<input type="hidden" name="txtt_' . $m . '_' . $i . '" value="' . $column[$k] . '" />' . $column[$k];
                    echo '</td>';
                    $count = $i;
                    $col = $m;
                } else {
                    echo '<td>';
                    echo '<input type="hidden" name="txt_' . $m . '_' . $i . '" value="' . $column[$k] . '" />' . $column[$k];
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
	
	




}
