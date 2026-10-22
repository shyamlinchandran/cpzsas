<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author u43255
 */
class Loadsheet extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('LoadSheet_model', 'sheet');
    }

    public function getcancelledexcel($id){
        $qry = "update load_sheet_settlement set final_quantity = 0,final_freequantity =0  where sales_id  in(select sales_id from sales where published = 'no' )" ;
		$this->db->query($qry);

        $qry = "select group_concat(sales_id) as sales_id from load_sheet_settlement where load_sheet_id =".$id." and is_delete = 0";
        $datas = $this->db->query($qry)->row_array();
        $ids = $datas['sales_id'];


        $qry = "UPDATE load_sheet_settlement LEFT JOIN (SELECT si.item_id,s.sales_id,sum(si.quantity * box.base_unit_count) as quantitys ,sum(si.base_free_quantity) as free_quantity,s.total from (select * from sales where sales_id in (".$ids.") ) as s INNER JOIN (select * from sales_items where  published = 'yes' and sales_id in (".$ids.") ) as si on s.sales_id =si.sales_id and si.published ='yes' and s.published = 'yes' INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (".$ids." ) group by s.sales_id ,si.item_id) as countitems ON load_sheet_settlement.sales_id = countitems.sales_id and load_sheet_settlement.item_id =countitems.item_id SET load_sheet_settlement.final_freequantity = IFNULL(countitems.free_quantity,0), load_sheet_settlement.final_quantity = IFNULL(countitems.quantitys,0), load_sheet_settlement.final_total = IFNULL(countitems.total,0) where load_sheet_id =".$id."        ";
        $this->db->query($qry);


        //$qry = "SELECT i.unit_id,sub_unit_one,sub_unit_two,sum(si.quantity * box.base_unit_count) as quantitys ,u.code,i.name,sum(si.base_quantity) as quantity,sum(si.base_free_quantity) as free_quantity  from sales as s  inner join set_billtype as sb on sb.id =s.bill_type and s.published = 'no' INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' LEFT JOIN suppliers as cus on cus.id =s.customer_id INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (SELECT invoice_id FROM `loading_sheet_items` WHERE status = 'active' and loading_sheet_id = ".$id.") GROUP by i.id";
        $qry = "SELECT u.code,i.name,i.unit_id,sub_unit_one,sub_unit_two,a.item_id,sum(a.quantity - a.final_quantity) as quantitys,sum(a.free_quantity - a.final_freequantity)  as free_quantity FROM `load_sheet_settlement` as a INNER JOIN sales as s on a.sales_id = s.sales_id inner join item as i on i.id = a.item_id inner join units as u on u.id = i.unit_id WHERE a.quantity - a.final_quantity  > 0  and  is_delete = 0 and load_sheet_id = ".$id." group by i.id";
        $data['details'] = $this->db->query($qry)->result_array();


        $qry = "SELECT * FROM `units` WHERE unit_id = 0 or unit_id is null ";
		//$qry = "SELECT * FROM `units` WHERE  name = 'No' ";
		$query = $this->db->query($qry)->result_array();
		$unit_data = [];
       
		foreach($query as $item){
			$qry = "SELECT * FROM units WHERE `unit_id` = ".$item['id']." UNION SELECT * FROM units WHERE unit_id IN (SELECT id FROM units WHERE unit_id = ".$item['id'].") order by unit_count desc";
			$result = $this->db->query($qry);
			$unit_array = [];
			if($result->num_rows() > 0 ){
				$result = $result->result_array();
				$i  = 0 ;
				foreach($result as $items){
					$unit_array[$i]['name'] = $items['name'];
					$unit_array[$i]['count'] = $items['unit_count'];
					$unit_array[$i]['id'] = $items['id'];
					$i++;
				}
				$unit_data[$item['id']] = $unit_array;
			}
		}
        $data['unit_data'] = $unit_data;
        $data['title'] = 'Settlement';
		$this->load->view('excellloadsheet',$data);
    }


    public function getexcel($id){

        $qry = "update load_sheet_settlement set final_quantity = 0,final_freequantity =0  where sales_id  in(select sales_id from sales where published = 'no' )" ;
		$this->db->query($qry);

        $qry = "select group_concat(sales_id) as sales_id from load_sheet_settlement where load_sheet_id =".$id." and is_delete = 0";
        $datas = $this->db->query($qry)->row_array();
        $ids = $datas['sales_id'];

        //$qry = "UPDATE load_sheet_settlement LEFT JOIN 
       // (SELECT si.item_id,s.sales_id,sum(si.quantity * box.base_unit_count) as quantitys ,sum(si.base_free_quantity) as free_quantity,s.total from sales as s INNER JOIN (select * from sales_items where sales_items.published = 'yes' ) as si on s.sales_id =si.sales_id and si.published ='yes' and s.published = 'yes' INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (select sales_id from load_sheet_settlement where load_sheet_id =".$id." and is_delete = 0 ) group by s.sales_id ,si.item_id) as countitems ON load_sheet_settlement.sales_id = countitems.sales_id and load_sheet_settlement.item_id =countitems.item_id SET load_sheet_settlement.final_freequantity = IFNULL(countitems.free_quantity,0), load_sheet_settlement.final_quantity = IFNULL(countitems.quantitys,0), load_sheet_settlement.final_total = IFNULL(countitems.total,0) where load_sheet_id =".$id."        ";
        //$this->db->query($qry);

        $qrys = "UPDATE load_sheet_settlement LEFT JOIN 
        (SELECT si.item_id,s.sales_id,sum(si.quantity * box.base_unit_count) as quantitys ,sum(si.base_free_quantity) as free_quantity,s.total from (select * from sales where sales_id in (".$ids.")  )  as s INNER JOIN (select * from sales_items where sales_items.published = 'yes' and sales_id in (".$ids.")  ) as si on s.sales_id =si.sales_id and si.published ='yes' and s.published = 'yes' INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (".$ids.") group by s.sales_id ,si.item_id) as countitems ON load_sheet_settlement.sales_id = countitems.sales_id and load_sheet_settlement.item_id =countitems.item_id SET load_sheet_settlement.final_freequantity = IFNULL(countitems.free_quantity,0), load_sheet_settlement.final_quantity = IFNULL(countitems.quantitys,0), load_sheet_settlement.final_total = IFNULL(countitems.total,0) where load_sheet_id =".$id."        ";
        $this->db->query($qry);

// print_r($qry);print_r($qrys);exit;
        //$qry = "SELECT i.unit_id,sub_unit_one,sub_unit_two,sum(si.quantity * box.base_unit_count) as quantitys ,u.code,i.name,sum(si.base_quantity) as quantity,sum(si.base_free_quantity) as free_quantity  from sales as s  inner join set_billtype as sb on sb.id =s.bill_type  INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' LEFT JOIN suppliers as cus on cus.id =s.customer_id INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (SELECT invoice_id FROM `loading_sheet_items` WHERE status = 'active' and loading_sheet_id = ".$id.") GROUP by i.id";
        $qry = "SELECT u.code,i.name,i.unit_id,sub_unit_one,sub_unit_two,a.item_id,sum(a.quantity) as quantitys,sum(a.free_quantity)   as free_quantity FROM `load_sheet_settlement` as a INNER JOIN sales as s on a.sales_id = s.sales_id inner join item as i on i.id = a.item_id inner join units as u on u.id = i.unit_id WHERE   is_delete = 0 and load_sheet_id = ".$id." group by i.id";
        $data['details'] = $this->db->query($qry)->result_array();


        $qry = "SELECT * FROM `units` WHERE unit_id = 0 or unit_id is null ";
		//$qry = "SELECT * FROM `units` WHERE  name = 'No' ";
		$query = $this->db->query($qry)->result_array();
		$unit_data = [];
       
		foreach($query as $item){
			$qry = "SELECT * FROM units WHERE `unit_id` = ".$item['id']." UNION SELECT * FROM units WHERE unit_id IN (SELECT id FROM units WHERE unit_id = ".$item['id'].") order by unit_count desc";
			$result = $this->db->query($qry);
			$unit_array = [];
			if($result->num_rows() > 0 ){
				$result = $result->result_array();
				$i  = 0 ;
				foreach($result as $items){
					$unit_array[$i]['name'] = $items['name'];
					$unit_array[$i]['count'] = $items['unit_count'];
					$unit_array[$i]['id'] = $items['id'];
					$i++;
				}
				$unit_data[$item['id']] = $unit_array;
			}
		}
        $data['unit_data'] = $unit_data;
        $data['title'] = 'Loadsheet';
		$this->load->view('excellloadsheet',$data);
    }
	
    public function list_all() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['title'] = 'Load Sheet';
        $this->load->view('loadsheet/list_all',$data);
    }

    public function invoice_list() {
        $this->sheet->Invoice();
        $list = $this->sheet->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $chk_assign = '<input  class="enquiry" type="checkbox" name="check[]" value="' . $items->sales_id . '"> ';

            $row[] = $chk_assign.$no;
            $row[] = $items->invoice;
            $row[] = $items->invoice_date;
            $row[] = $items->name;
            $row[] = (float) $items->total ;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sheet->count_all(),
            "recordsFiltered" => $this->sheet->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	public function save(){
			$this->sheet->save();
	}

    public function switch(){
        $this->sheet->switch();
}
	
	public function getsing($id){
        echo json_encode($this->unit->getsing($id));
	}
	
	public function edit($id ) {
		$data['id'] = $id;
		$data['title'] = 'Edit LoadSheet';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('loadsheet/create',$data);
    }

    function delete($id){
        $this->sheet->delete($id);
    }

    function remove(){
        $this->sheet->remove();
    }

    public function ajax_list() {
//        $this->unit->where();
        $list = $this->sheet->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->created_date;
            $row[] = $vouchers->voucher_no;
            $row[] = $vouchers->salesman;
            $row[] = $vouchers->salesman;
            $act = '<a  href="' . base_url() . 'Loadsheet/edit/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/Loadsheet/list_all' . '"  success="Delete ' . $vouchers->voucher_no . ' successfuly "  message="Do you want to Delete ' . $vouchers->voucher_no . '?"  href="' . base_url() . 'Loadsheet/delete/' . $vouchers->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  tp="new" target="_blank" id="doc_download" href="' . base_url() . 'Loadsheet/getexcel/' . $vouchers->id . '" ">Loading Sheet</a>';
            $act .= ' <a style ="color:red"  tp="new" target="_blank" id="doc_downloads" href="' . base_url() . 'Loadsheet/getcancelledexcel/' . $vouchers->id . '" ">Settlement</a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sheet->count_all() + 1,
            "recordsFiltered" => $this->sheet->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function loadsheet_list() {
        $qry = "update load_sheet_settlement set final_quantity = 0,final_freequantity =0  where sales_id  in(select sales_id from sales where published = 'no' )" ;
		//$this->db->query($qry);
        $qry = "UPDATE load_sheet_settlement LEFT JOIN (SELECT si.item_id,s.sales_id,sum(si.quantity * box.base_unit_count) as quantitys ,sum(si.base_free_quantity) as free_quantity,s.total from sales as s INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' and s.published = 'yes' INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (select sales_id from load_sheet_settlement where load_sheet_id =".$this->input->post('loadsheetid')." and is_delete = 0 ) group by s.sales_id ,si.item_id) as countitems ON load_sheet_settlement.sales_id = countitems.sales_id and load_sheet_settlement.item_id =countitems.item_id SET load_sheet_settlement.final_freequantity = IFNULL(countitems.free_quantity,0), load_sheet_settlement.final_quantity = IFNULL(countitems.quantitys,0), load_sheet_settlement.final_total = IFNULL(countitems.total,0) where load_sheet_id =".$this->input->post('loadsheetid')."        ";
       // $this->db->query($qry);

                    $this->sheet->where();
                $list = $this->sheet->get_datatables();
                $data = array();
                $no = $this->input->post('start');
                foreach ($list as $vouchers) {
                    $chk_assign = '<input class="enquiry" type="checkbox" name="check[]" value="' . $vouchers->invoice_id . '"> ';

                    $no++;
                    $row = array();
                    $row[] =  $chk_assign .$no;
                    $row[] = $vouchers->invoice;
                    $row[] = $vouchers->invoice_date;
                    $row[] = $vouchers->name;
                    $row[] = $vouchers->totals;
                    $row[] = $vouchers->total;
                    $act = ''; 
                    //$act = '<a  href="' . base_url() . 'Loadsheet/edit/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
                   $act .= ' <button invoice_id = '.$vouchers->invoice_id.' invid = '.$vouchers->id.' invname = "'.$vouchers->invoice.'"  data-toggle="tooltip" title="Delete" class="btn btn-danger btnremoveloadsheet"><span class="glyphicon glyphicon-remove-circle"></span></button>';
                   if( $vouchers->spub == 'yes'){
                        $act = $act . ' <a tp="confirm" base="' . base_url() . '/Loadsheet/edit/' . $vouchers->loading_sheet_id . '"   success="Cancelled ' . $vouchers->invoice . ' successfuly "  message="Do you want Cancel ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/cancel/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
                    }else{
                        $act = $act .'<span style ="color:orange">Cancelled</span> ';
                    }
                   $row[] = $act;
                    $data[] = $row;
                }
        
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->sheet->count_all() ,
                    "recordsFiltered" => $this->sheet->count_filtered() ,
                    "data" => $data,
                );
                //output to json format
                echo json_encode($output);
            }





            public function bill($id) {
                $this->generateBill($id);
            }
            
            private function generateBill($id) {
                $format  ='bill';
                $size =24;
                $orient = 'A4';
                $pdf_type = "Mpdf";
                $paper = 'A4';
                $this->load->library('M_pdf');
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->lang->load('en_site', 'en');
                $this->language = "en";

                
                $transfer = $this->items->get_transfer($id);
                $taxdetails = $this->items->taxdetails($id);
                $totals = $this->items->gettotals($id);
                $tcnt = $this->items->getTransferItemscnt($id);
                $papersiize ='A4';
                $inc = number_format(($tcnt) / $size, 2);
                $page = explode(".", $inc);
                $mode = (int) $page[1];
                $inc = (int) $page[0];
                if ($mode > 0) {
                    $inc = $inc + 1;
                }
                if ($inc == 0) {
                    $inc = $inc + 1;
                }
                for ($i = 0; $i < $inc; $i++) {
                   $len = $size * $i;
                   $list = $this->items->getTransferItems($id, $len, $size);
                   $this->pages($pdf, $list, $transfer, $size, $len, $format, $i, $inc,$orient,$pdf_type,$taxdetails,$totals);
               }
               $pdf->Output('example_021.pdf', 'I');
            }
            
            
            function pages($pdf, $list, $transfer, $size, $len, $format, $i, $inc,$orient,$pdf_type,$taxdetails,$totals){
                if (count($list) != 0) {
                    $papersiize = 'A4';
                    $paperorient = $this->items->getValue('paperorient');  
                    $pdf->AddPage('P', 'A4');
                    $data['msd'] = $this->Show_Amount_In_Words(round($totals['total'],0));
                    $data['transfer'] = $transfer;
                    $data['size'] = $size;
                    $data['len'] = $len;
                    $data['inc'] = $inc;
                    $data['totals'] = $totals;
                    $data['cpz'] = $i;
                    $data['taxdetails'] = $taxdetails;
                    $data['transfer_items'] = $list;
                    $data['company'] = $this->items->getCompany();
                    $settings = $this->items->getCompanySettings();
                    $data['settings'] = $settings;
                    $html = $this->load->view('master/items/bill', $data, true);
                    //ob_end_clean();
                    $pdf->writeHTML($html);
                }
            }

}
