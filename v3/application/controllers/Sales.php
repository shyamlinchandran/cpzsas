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

defined('BASEPATH') or exit('No direct script access allowed');

use AliAbdalla\Tafqeet\Core\Tafqeet;

class Sales extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }
	

    public function bill($id)
    {
        $this->generateBill($id);
    }


    private function generateBill($id)
    {
        $size = 4;
        $paper = '[180, 140 ]';
        $this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
        $this->lang->load('en_site', 'en');
        $this->language = "en";
        $qry ="select * from sales_items where published = 'yes' and sales_id =  ".$id;
        $list = $this->db->query($qry);
        $tcnt = $list->num_rows();
        $inc = number_format(($tcnt) / $size, 2);
        $inc = ceil($inc);
        $inc = 1;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
           $list = $this->sales->getSalesItems($id,0,4);
           $sales = $this->sales->getSales($id);
            $this->pages($pdf,$list,$sales);
        }
       
        $pdf->Output('example_021.pdf', 'I');
    }

    function pages($pdf,$list,$sales)
    {
        if (count($list) != 0) {

            $papersiize = '[180, 140 ]';
            $orient = 'L';
            $pdf->AddPage($orient, $papersiize,'','','',5,0,10,10);
            $data['list'] = $list;
            $data['sales'] = $sales;
            $data['settings'] = $this->sales->getCompanySettings();
            $html = $this->load->view('transaction/sales/token', $data, true);
            $pdf->writeHTML($html);
            //ob_end_clean();
        }
    }
	    
}
