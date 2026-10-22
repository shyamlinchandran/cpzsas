<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchase
 *
 * @author u43255
 */
class ItemstockEntry extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('ItemstockEntry_model', 'stockentry');
    }

    public function getsing($id) {
        return $this->stockentry->getsing($id);
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'stock_entry';
        $this->load->view('itemstockentry/list_all', $data);
    }

    function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $zeroindex = $this->stockentry->zeroindex();
        $data['zeroindex'] = $zeroindex;
        $data['id'] = $id;
        $data['view'] = 'create';
        $data['type'] = 'stock_entry';
        $settings = $this->stockentry->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('itemstockentry/stockentry', $data);
    }

    function delete($id) {
        $this->stockentry->delete($id);
    }

    function confirm_order($id, $type = "") {
        $qry = "update purchase set purchase_status ='confirmed'  where id=" . $id;
        $this->db->query($qry);
    }

    function cancel($id) {
        $this->stockentry->cancel($id);
    }

    public function ajax_list() {
        $list = $this->stockentry->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $stock) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $stock->invoice;
            $row[] = $stock->total;
            $act = ' <a  href="' . base_url() . 'ItemstockEntry/create/' . $stock->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->stockentry->count_all(),
            "recordsFiltered" => $this->stockentry->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $this->stockentry->save();
    }

    public function save_order($type) {
        $this->stockentry->save_order($type);
    }

    public function bill($id) {
        $this->generateBill($id);
    }

    private function generateBill($id) {

        //$this->load->view('transaction/purchase/bill', $data);new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); //
        $size = 15;
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->purchase->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $purchase = $this->purchase->getpurchase($id);
        $purchase = $this->purchase->getpurchase($id);

        $order_id = $purchase[0]['order_id'];
        $order_details = "";
        if ($order_id != "0") {
            $order_details = $this->purchase->getorderdetails($order_id);
        }
        $tcnt = $this->purchase->getpurchaseItemscnt($id);
        $hcnt = $this->purchase->getHsnItemscnt($id);
        $papersiize = $this->purchase->getValue('paper');
        $hsn = $this->purchase->getHsnItems($id);

        if ($papersiize == 'A4') {
            $size = 38; //38
        }
        $inc = ($tcnt + $hcnt + 1) / $size;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->purchase->getpurchaseItems($id, $len, $size);
            $this->pages($pdf, $list, $purchase, $img_file, $size, $len, $hsn, $order_details);
        }
//        ob_end_clean();

        $pdf->Output('example_021.pdf', 'I');
    }

    function pages($pdf, $list, $purchase, $img_file, $size, $len, $hsn, $order_details) {
//        if (count($list) != 0) {
        $pdf->setCellPaddings(0, 0, 0, 0);
        $papersiize = $this->purchase->getValue('paper');
        $paperorient = $this->purchase->getValue('paperorient');
        $pdf->AddPage($paperorient, $papersiize);
        $data['msd'] = $this->Show_Amount_In_Words($purchase[0]['total']);
        $data['purchase'] = $purchase;
        $data['size'] = $size;
        $data['order_details'] = $order_details;
        $data['len'] = $len;
        $data['hsn'] = $hsn;
        if ($purchase[0]['pub'] == 'no') {
            $img_file = base_url() . 'assets/images/cancelled.png';
            $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
        }
        $data['purchase_items'] = $list;
        $data['company'] = $this->purchase->getCompany();
        $html = $this->load->view('transaction/purchase/bill', $data, true);
        $pdf->writeHTML($html);
        // $pdf->Image($img_file, 110, 90, 40, 29);
    }

//    }
}
