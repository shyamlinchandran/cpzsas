<?php
class GST1Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('excel');   //load PHPExcel library
        $this->load->model('reports/GST1Report_model', 'gst');
    }
    public function list_sales()
    {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data['titles'] = 'GSTR1 Report';
        $this->load->view('reports/gst1_report/list', $data);
    }
	
	 public function list_purchase()
    {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data['titles'] = 'GSTR2 Report';
        $this->load->view('reports/gst1_report/list_purchase', $data);
    }
	
	
 public function sales_hsn($id)
    {
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

//first sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');


        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
// Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(0);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');
		$result = $this->gst->hsn($id);

		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->setCellValueByColumnAndRow(0, 1, "Bill No : ".$result[0]['invoice']);
		$sheet->mergeCells('A1:G1');
		
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->setCellValueByColumnAndRow(0,2, "Bill Date : ".$result[0]['date']);
		$sheet->mergeCells('A2:G2');
		
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->setCellValueByColumnAndRow(0, 3, "Customer Name : ".$result[0]['cusname']);
		$sheet->mergeCells('A3:G3');
		
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->setCellValueByColumnAndRow(0, 4, "Customer GSTN : ".$result[0]['gstin']);
		$sheet->mergeCells('A4:G4');
		
		$from = 'A2';
		$to = 'C2';
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
		
		
		$from = 'A3';
		$to = 'C3';
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
		
		
		$from = 'A4';
		$to = 'C4';
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
		
		
		$from = 'A5';
		$to = 'G5';
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
		
		$sheet->getStyle('A1')->getAlignment()->applyFromArray(
		array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		);
		
		$sheet->getStyle('A3')->getAlignment()->applyFromArray(
		array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		);
		
		$sheet->getStyle('A4')->getAlignment()->applyFromArray(
		array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		);
		
		
		$sheet->getStyle('A2')->getAlignment()->applyFromArray(
		array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
		);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $table_columns = array("HSN/SAC", "Quantity", "Taxable Value", "SGST", "CGST", "IGST","Total GST");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A4:I1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

		
        $rowCount = 6;
		$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
		$taxable_value = 0;
		$quantity = 0;
		$sgst = 0;
		$tax_amount = 0;
        foreach ($result as $row) {
			$taxable_value = (float) $taxable_value + (float) $row['taxable'];
			$tax_amount = (float) $tax_amount + (float) $row['tax_amount'];
			$quantity = (float) $quantity + (float) $row['quantity'];
			$sgst = (float) $sgst + (float) $row['sgst'];
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['hsn']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 0);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['tax_amount']);
          //  $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['sgst']);
           // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['ces']);
            $rowCount++;
        }
        // Rename 2nd sheet
			$rowCount++;
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $quantity);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $taxable_value);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 0);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $tax_amount);
			
			
        $objPHPExcel->getActiveSheet()->setTitle('hsncode');




//9th sheet start here

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="GSTR-1.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        // $filepath ="./uploads/date('Y-m-d')name.xls";
        $filepath = './uploads/SalesHSnReport.xls';
        
        //    $filepath = './Users/eldho/name_of_file.xls';
        $objWriter->save($filepath);

        print_r($filepath);

    }
	
		 public function action()
    {   

         $settings =  $settings = $this->gst->getCompanySettings();
        $is_cigarette_cess = 0;
        if($settings[0]['is_cigarette_cess']){
            $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
        } 
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
		//first sheet from here
        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');
        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();
        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(0);
        $table_columns = array("Instructions");
        $column = 0;
        $letter = 'A';
        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:L1")->applyFromArray(array("font" => array("bold" => true)));
            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->instructions();
        //  $result = $this->gst->get_datatables();
        $rowCount = 2;
        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['content'])->setShowGridlines(false);
            $rowCount++;
        }
        // Rename 1st sheet
        $objPHPExcel->getActiveSheet()->setTitle('Help Instruction');


//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("GSTIN of Supplier", "Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Reverse Charge", "Invoice Type", "Rate", "Taxable Value", "Integrated Tax Paid","Central Tax Paid","State/UT Tax Paid", "Cess Paid","Eligibility For ITC","Availed ITC Integrated Tax","Availed ITC Central Tax","Availed ITC State/UT Tax","Availed ITC Cess");
        if( $is_cigarette_cess > 0 ){
            $table_columns = array("GSTIN of Supplier", "Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Reverse Charge", "Invoice Type", "Rate", "Taxable Value", "Integrated Tax Paid","Central Tax Paid","State/UT Tax Paid", "Cess Paid", "Cig. Cess","Eligibility For ITC","Availed ITC Integrated Tax","Availed ITC Central Tax","Availed ITC State/UT Tax","Availed ITC Cess");
        }
        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:R1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->purchase_data('purchase','B2B',' GROUP by b.invoice,a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['tin']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 'N');
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, 'Regular');
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['taxableamt']);
			if($row['comstate'] == $row['cusstate']){
				$sgst = 0 ;
				if((float)  $row['tax'] > 0 ){
					$sgst = (float)  $row['tax'] / 2;
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, 0);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $sgst);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $sgst);
			}else{
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $row['tax']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, 0);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, 0);
			}
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount,$row['item_cess']);
            if( $is_cigarette_cess > 0 ){
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $row['cessamts']);
                $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, '');
            }else{
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, '');
            }
			
           
			
			
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2b');

//3rd sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(2);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Supplier Name", "Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Reverse Charge", "Invoice Type", "Rate", "Taxable Value", "Integrated Tax Paid","Central Tax Paid","State/UT Tax Paid", "Cess Paid","Eligibility For ITC","Availed ITC Integrated Tax","Availed ITC Central Tax","Availed ITC State/UT Tax","Availed ITC Cess");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:R1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->purchase_data('purchase','B2C',' GROUP by b.invoice,a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 'N');
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, 'Regular');
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['taxableamt']);
			if($row['comstate'] == $row['cusstate']){
				$sgst = 0 ;
				if((float)  $row['tax'] > 0 ){
					$sgst = (float)  $row['tax'] / 2;
				}
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, 0);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $sgst/2);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $sgst/2);
			}else{
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $row['gst']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, 0);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, 0);
			}
			
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount,$row['item_cess']);
			
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, '');
			
			
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2bur');

//4th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(3);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(3);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Applicable % Tax Rate", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->purchase_data('purchase','B2C',' GROUP by a.tax_id,b.id ',' having comstate != cusstate ','cl');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['gst']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,$row['item_cess']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, '');
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2cl');
		
//4th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(4);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(4);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Applicable % Tax Rate", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->purchase_data('purchase','B2C',' GROUP by a.tax_id,b.id ',' having comstate != cusstate ','cs');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['gst']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,$row['item_cess']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, '');
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2cs');

//5th sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(5);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(5);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("GSTIN", "Receiver Name", "Note Number", "Note Date", "Note Type", "Place Of Supply", "Reverse Charge", "Note Supply Type", "Note Value", "Applicable % of Tax Rate","Rate", "Taxable Value", "Cess Amount");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->purchase_data('purchase_return','B2B',' GROUP by b.invoice,a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['tin']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount,'');
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount,$row['item_cess']);
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('cdnr');


//6th sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(6);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(6);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("UR TYPE",  "Note Number", "Note Date", "Note Type", "Place Of Supply", "Note Value", "Applicable % of Tax Rate","Rate", "Taxable Value", "Cess Amount");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->purchase_data('purchase_return','B2C',' GROUP by b.invoice,a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount,  $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('j' . $rowCount,$row['item_cess']);
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('cdnur');
		
		
//7th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(7);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(7);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Hsncode",  "UQC", "Total Quantity", "Total Value ", "Taxable Value", " IGST", "CGST", "SGST","CESS");
         
        if($is_cigarette_cess > 0 ){
        $table_columns = array("Hsncode",  "UQC", "Total Quantity", "Total Value ", "Taxable Value", " IGST", "CGST", "SGST","CESS","Cig.CESS");
         
        }

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->pur_hsn_data();

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['hsncode']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['itemname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, round($row['total'] - $row['tax'],$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, round($row['igst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount,round($row['sgst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, round($row['sgst'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,$row['cess']);
            if($is_cigarette_cess > 0 ){
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount,$row['cessamts']);
            }
            //$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $row['GSTRATE']);
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('hsn');
		

		
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="GSTR-1.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        // $filepath ="./uploads/date('Y-m-d')name.xls";
        $filepath = './uploads/GSTR2export.xls';
        
        //    $filepath = './Users/eldho/name_of_file.xls';
        $objWriter->save($filepath);

        print_r($filepath);

    }
	
	
	 public function action_sales()
    {
        
        $settings =  $settings = $this->gst->getCompanySettings();
        $is_cigarette_cess = 0;
        if($settings[0]['is_cigarette_cess']){
            $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
        } 
        // Cre
        // ate new PHPExcel object
        $objPHPExcel = new PHPExcel();
		//first sheet from here
        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');
        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();
        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(0);
        $table_columns = array("Instructions");
        $column = 0;
        $letter = 'A';
        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:L1")->applyFromArray(array("font" => array("bold" => true)));
            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->instructions();
        //  $result = $this->gst->get_datatables();
        $rowCount = 2;
        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['content'])->setShowGridlines(false);
            $rowCount++;
        }
        // Rename 1st sheet
        $objPHPExcel->getActiveSheet()->setTitle('Help Instruction');


//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("GSTIN", "Receiver Name", "Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Reverse Charge","Applicable % Tax Rate", "Invoice Type", "E-Commerce GSTIN", "Rate", "Taxable Value", "Cess Amount");
        if( $is_cigarette_cess > 0 ){
            $table_columns = array("GSTIN", "Receiver Name", "Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Reverse Charge","Applicable % Tax Rate", "Invoice Type", "E-Commerce GSTIN", "Rate", "Taxable Value", "Cess Amount","Cig.Cess");
        }
        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->sales_data('sales','B2B',' GROUP by b.invoice,a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['tin']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount,'');
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount,$row['item_cess']);
            if( $is_cigarette_cess > 0 ){
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount,$row['cessamts']);
            }
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2b');

//3rd sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(2);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Type", "Place Of Supply", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->sales_data('sales','B2C',' GROUP by a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'OE');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['item_cess']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, '');
      
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2c');

//4th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(3);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(3);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Applicable % Tax Rate", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->sales_data('sales','B2C',' GROUP by a.tax_id,b.sales_id ',' having comstate != cusstate ','cl');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['gst']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,$row['item_cess']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, '');
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2cl');
		
//4th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(4);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(4);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Applicable % Tax Rate", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->sales_data('sales','B2C',' GROUP by a.tax_id,b.sales_id ',' having comstate != cusstate ','cs');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['gst']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,$row['item_cess']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, '');
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('b2cs');

//5th sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(5);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(5);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("GSTIN", "Receiver Name", "Note Number", "Note Date", "Note Type", "Place Of Supply", "Reverse Charge", "Note Supply Type", "Note Value", "Applicable % of Tax Rate","Rate", "Taxable Value", "Cess Amount");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->sales_data('sales_return','B2B',' GROUP by b.invoice,a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['tin']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount,'');
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount,$row['item_cess']);
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('cdnr');


//6th sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(6);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(6);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("UR TYPE",  "Note Number", "Note Date", "Note Type", "Place Of Supply", "Note Value", "Applicable % of Tax Rate","Rate", "Taxable Value", "Cess Amount");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->sales_data('sales_return','B2C',' GROUP by b.invoice,a.tax_id ');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['in_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['place']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount,  $row['invoicetotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['taxableamt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('j' . $rowCount,$row['item_cess']);
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('cdnur');
		
		
    //7th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(7);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(7);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS");
        if($is_cigarette_cess > 0){
            $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS","Cig.Cess");
        }
        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->new_hsn_data();

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['hsncode']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['GSTRATE']);
          //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['beforetax'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, round($row['igst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,round($row['sgst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, round($row['sgst'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,$row['cess']);
             if($is_cigarette_cess > 0){

			    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount,$row['cessamts']); 
             }
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('hsn');


        //8th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(8);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(8);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS");
        if($is_cigarette_cess > 0){
            $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS","Cig.Cess");
        }
        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->new_hsn_data('sales','b2c');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['hsncode']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['GSTRATE']);
          //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['beforetax'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, round($row['igst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,round($row['sgst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, round($row['sgst'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,$row['cess']);
            if($is_cigarette_cess > 0){
			    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount,$row['cessamts']);
            }
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('hsn b2c');



        //9th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(9);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(9);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS");
        if($is_cigarette_cess > 0){
            $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS","Cig.Cess");
        }
        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->new_hsn_data('sales','b2b');

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['hsncode']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['GSTRATE']);
          //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['beforetax'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, round($row['igst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,round($row['sgst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, round($row['sgst'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,$row['cess']);
            if($is_cigarette_cess > 0){
			    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount,$row['cessamts']);
            }
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('hsn b2b');




        //7th sheet from here
		//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(10);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(10);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS");
        if($is_cigarette_cess > 0){
            $table_columns = array("Hsncode", "Desciption", "UQC", "Total Quantity", "Total Value ","RATE", "Taxable Value", " IGST", "CGST", "SGST","CESS","Cig.Cess");
        }
        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->hsn_data();

        $rowCount = 2;
        $beforetax = 0 ;
        $igst = 0;
        $sgst = 0;
        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['hsncode']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['GSTRATE']);
          //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['beforetax'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, round($row['igst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,round($row['sgst'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, round($row['sgst'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,$row['cess']);
             if($is_cigarette_cess > 0){
			    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount,$row['cessamts']);
             }
            $rowCount++;
            $beforetax = (float)  $beforetax  + (float)  $row['beforetax'];
            $igst = (float)  $igst  + (float)  $row['igst'];
            $sgst = (float)  $sgst  + (float)  $row['sgst'];
            $beforetaxes =  $beforetax ;
        }

        $rowCount++;
        $rowCount++;

        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, '');
      //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($beforetax ,$this->company_roundoff));
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, round($igst ,$this->company_roundoff));
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,round($sgst ,$this->company_roundoff));
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, round($sgst ,$this->company_roundoff));
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,'');
        $rowCount++;
        // Rename 2nd sheet
        $rowCount++;
        $rowCount++;

        $result_detailed = $this->gst->hsn_data_det();
        foreach ($result_detailed as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, strtoupper($row['saletype']).' Sales');
          //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['beforetax'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, '');
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,'');
            $rowCount++;
          
        }
        $rowCount++;

        $rowCount++;

        $result_detailed = $this->gst->hsn_return_det();
        foreach ($result_detailed as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Less ');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, ' Sales Return');
          //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['beforetax'] ,$this->company_roundoff));
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,'');
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, '');
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,'');
            $rowCount++;
           $beforetax = $beforetax - $row['beforetax'];
        }
        $rowCount++;
        $rowCount++;

        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, '');
      //  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($row['total'] - $row['tax']  - $row['cess'] ,$this->company_roundoff));
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, round($beforetax ,$this->company_roundoff));
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,'');
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, '');
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount,'');


        $objPHPExcel->getActiveSheet()->setTitle('hsn With Summary');
		
		

		
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="GSTR-1.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        // $filepath ="./uploads/date('Y-m-d')name.xls";
        $filepath = './uploads/GSTR1REPORT.xls';
        
        //    $filepath = './Users/eldho/name_of_file.xls';
        $objWriter->save($filepath);

        print_r($filepath);

    }
	
	
	
    public function action_old()
    {
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

//first sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');


        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(0);

        $table_columns = array("Instructions");

        $column = 0;
        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:L1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->instructions();
        //  $result = $this->gst->get_datatables();

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['content'])->setShowGridlines(false);
            $rowCount++;
        }


        // Rename 1st sheet
        $objPHPExcel->getActiveSheet()->setTitle('Help Instruction');

//Second sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);
        // Rename sheet
                      // $objPHPExcel->getActiveSheet()->setTitle('REPORT');


        $table_columns = array("HSN Code", "Name", "Unit", "Quantity", "Total", "Taxable", "SGST", "SGST", "CES");

        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }

        $result = $this->gst->hsncode();

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['hsncode']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['unit']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['sgst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['ces']);
            $rowCount++;
        }
        // Rename 2nd sheet

        $objPHPExcel->getActiveSheet()->setTitle('hsncode');

//3rd sheet from here

        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');


        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(2);

        $table_columns = array("GSTIN/UIN of Recipient", "Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Reverse Charge", "Applicable % of Tax Rate", "Invoice Type", "E-Commerce GSTIN", "Rate", "Taxable Value", "Cess Amount");

        $column = 0;
        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:L1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->b2b();
        //  $result = $this->gst->get_datatables();

        $rowCount = 2;

        foreach ($result as $row) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['tin']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['invoice_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '32-Kerala');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 'N');
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, 'Regular');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $rowCount, $row['Rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $rowCount, $row['ces_amt']);
            $rowCount++;
        }

        // Rename 2nd sheet
        $objPHPExcel->getActiveSheet()->setTitle('B2B');

//4th sheet start here



        // Create a first sheet, representing sales data
        $objPHPExcel->setActiveSheetIndex(3);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');


        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(3);

        $table_columns = array("Invoice Number", "Invoice Date", "Invoice Value", "Place Of Supply", "Applicable % of Tax Rate",  "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN", "Sale from Bonded WH");


        $column = 0;

        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->b2c();
        //  $result = $this->gst->get_datatables();

        $rowCount = 2;

        foreach ($result as $row) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['invoice_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '33-Tamilnadu');

            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '');

            $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, $row['Rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowCount, $row['ces_amt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, 'N');
            $rowCount++;
        }

        // Rename 3rd sheet
        $objPHPExcel->getActiveSheet()->setTitle('b2cl');


//5th sheet start here


        $objPHPExcel->setActiveSheetIndex(4);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(4);

        $table_columns = array("Type", "Place Of Supply", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");


        $column = 0;
        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->b2cs();
        //  $result = $this->gst->get_datatables();

        $rowCount = 2;

        foreach ($result as $row) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'OE');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '32-Kerala');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row['Rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, $row['ces_amt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, '');
            $rowCount++;
        }

        // Rename 2nd sheet
        $objPHPExcel->getActiveSheet()->setTitle('b2cs');

//6th Sheet start here

        $objPHPExcel->setActiveSheetIndex(5);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(5);

        $table_columns = array("Document Type", "Place Of Supply", "Note/Refund Voucher Value", "Applicable % Tax Rate", "Rate", "Taxable Value", "Cess Amount", "Pre GST");


        $column = 0;
        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->cdnr();
        //  $result = $this->gst->get_datatables();

        $rowCount = 2;

        foreach ($result as $row) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'C');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '32-Kerala');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['refund']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, $row['Rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, $row['ces_amt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('h' . $rowCount, 'N');
            $rowCount++;
        }

        // Rename 2nd sheet
        $objPHPExcel->getActiveSheet()->setTitle('cdnr');

//7th sheet Start here

        $objPHPExcel->setActiveSheetIndex(6);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(6);

        $table_columns = array("Applicable % of Tax Rate", "Rate", "Taxable Value", "Cess Amount", "Pre GST");


        $column = 0;
        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->cdnur();
        //  $result = $this->gst->get_datatables();

        $rowCount = 2;

        foreach ($result as $row) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $row['Rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $row['ces_amt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'N');
            $rowCount++;
        }

        // Rename 7th sheet
        $objPHPExcel->getActiveSheet()->setTitle('cdnur');

//8th Sheet Start here

        $objPHPExcel->setActiveSheetIndex(7);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', '');

        // Create a new worksheet, after the default sheet
        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(7);

        $table_columns = array("Export Type","Invoice Number","Invoice date","Invoice Value","Port Code","Shipping Bill Number","Shipping Bill Date","Applicable % of Tax Rate", "Rate", "Taxable Value", "Cess Amount");



        $column = 0;
        $letter = 'A';

        foreach ($table_columns as $field) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->applyFromArray(array("font" => array("bold" => true)));

            $column++;
            $letterAscii = ord($letter);
            $letterAscii++;
            $letter = chr($letterAscii); // 'B'
        }
        $result = $this->gst->exp();
        //  $result = $this->gst->get_datatables();

        $rowCount = 2;

        foreach ($result as $row) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $row['invoice']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row['invoice_date']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $row['total']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount,'');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount,'');
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $rowCount, $row['Rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $rowCount, $row['taxable']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $rowCount, $row['ces_amt']);
            $rowCount++;
        }

        // Rename 8th sheet
        $objPHPExcel->getActiveSheet()->setTitle('exp');

//9th sheet start here

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="GSTR-1.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        // $filepath ="./uploads/date('Y-m-d')name.xls";
        $filepath = './uploads/name_of_file.xls';
        
        //    $filepath = './Users/eldho/name_of_file.xls';
        $objWriter->save($filepath);

        print_r($filepath);

    }
}
