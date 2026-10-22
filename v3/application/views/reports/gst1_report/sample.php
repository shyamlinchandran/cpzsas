HSN REPORT -  SELECT h.hsncode,i.name,u.name as unit,sum(si.quantity) as quantity,sum(si.total) as total,sum(si.total-si.tax) as taxable,sum(si.tax)/2 as sgst,sum(si.ces_amt) as ces from sales as s INNER JOIN sales_items as si on si.sales_id= s.sales_id and s.published='yes' and si.published ='yes' INNER JOIN item as i on i.id=si.item_id INNER JOIN hsncode as h on h.hsnid = i.hsncode INNER JOIN units as u on u.id=i.unit_id GROUP by h.hsnid
SELECT s.invoice,s.invoice_date,sum(si.total -si.tax) as taxable,sum(si.tax) as tax,sum(ces_amt) as cess from sales as s INNER JOIN suppliers as c on s.customer_id = c.id INNER JOIN sales_items as si on si.sales_id =s.sales_id and si.published ='yes' and s.published ='yes' left JOIN state as st on st.StateID = c.cst GROUP by si.sales_id,si.tax_id




Load In Constructor
				parent::__construct();
				$this->load->library('excel'); //load PHPExcel library 
-------------------------------------------------------------------------------------------------------------------------------
Function 
		
function action()
    {
        // Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Create a first sheet, representing sales data
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Help Instructions<br>											
	1. The offline tool for generating the JSON file will not take the data available in the sheets exemp and docs.											
	2. The values in these sheets are in the same order as in the portal.											
	3. You can manually enter the data from these sheets directly into the GSTN portal.											
											
	Visit TallyHelp for more information on:											
	1. GSTR1 Filing											
	2. Data captured in GSTR1 Return											
											
	Please Note											
	1. This Excel workbook works best with Microsoft Excel 2003 or later.                     											
	2. We recommend that you do not modify the data in Excel after exporting from Tally.ERP 9.                                                                                     											
	3. Use separate Excel workbooks for each month, with the month name as a part of the file name. In case there are multiple uploads for a month, use Part A, Part B, and so on, in the file name to avoid confusion. Similarly, if you import invoice data multiple times in a tax period, follow a similar pattern for the JSON file name.											
	4. If any data exists in the offline tool when you are importing data from Excel, all the existing data will be overwritten.											
	');

	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle(' REPORT');

	// Create a new worksheet, after the default sheet
	$objPHPExcel->createSheet();

	// Add some data to the second sheet, resembling some different data types
	$objPHPExcel->setActiveSheetIndex(1);
	$date = $this->getDate($this->input->post('date'));
	$qry ="SELECT h.hsncode,i.name,u.name as unit,sum(si.quantity) as quantity,sum(si.total) as total,sum(si.total-si.tax) as taxable,sum(si.tax)/2 as sgst,sum(si.ces_amt) as ces from sales as s INNER JOIN sales_items as si on si.sales_id= s.sales_id and s.published='yes' and si.published ='yes' INNER JOIN item as i on i.id=si.item_id INNER JOIN hsncode as h on h.hsnid = i.hsncode INNER JOIN units as u on u.id=i.unit_id GROUP by h.hsnid,si.item_id";
	$result = $this->db->query($qry)->result_array();
	$rowCount = 1;
		
	foreach($result as $row){
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['hsncode']);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['name']);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['unit']);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['quantity']);
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['total']);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['taxable']);
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['sgst']);
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['sgst']);
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['ces']);
		$rowCount++;	

	}

	// Rename 2nd sheet
	$objPHPExcel->getActiveSheet()->setTitle('HSN REPORT');

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="name_of_file.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
 }

---------------------------------------------------------------------------------------------------------------------------------

$url = site_url('item/action');

Button click
	<a role="button" tp="new"  target="_blank" class="btn  btn-success align-bottom" href="<?php echo $url ?>">
                            Get Excel 
                        </a>