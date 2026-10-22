<?php
header("Access-Control-Allow-Credentials: true");
//header("Access-Control-Max-Age: 1000");
//header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author jijodileep
 */
class Sales extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
//        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
//        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
//        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    function create_post() {
        //database 
        $global_data['hostname'] = 'localhost';
        $global_data['username'] = 'root';
        $global_data['password'] = '';
        $global_data['database'] = 'dims_latest';
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);
        $this->load->model('sales_model', 'sales');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        for ($i = 0; $i < count($tmp); $i++) {
            $obj = $tmp[$i];
            $or_type = $obj->type;
            $billtype = $obj->bill_type;
            /* if ($billtype == '') {
              $invoice = $this->sales->getinoviceno($or_type);
              } else {
              $invoice = $this->sales->getinoviceno($billtype);
              } */
            $invoice = $obj->invoice;
            $invoicedate = $this->sales->getDate($obj->invoice_date, '-');
            $id = $obj->id;
            $subtot = $obj->subtot;
            $taxtotal = $obj->taxtotal;
            $rount = $obj->roundoff;
            $narration = $or_type . ' Invoice:- ' . $invoice . ' on  ' . $invoicedate;
            $data = array(
                'invoice_date' => $invoicedate,
                'customer_id' => $obj->customer_id,
                'cash_type' => $obj->cash_type,
                'delivery_date' => $this->sales->getDate($obj->delivery_date, '-'),
                'credit_eod' => $this->sales->getDate($obj->credit_eod, '-'),
                'total' => $obj->total,
                'salesman' => $obj->salesman,
                'route' => $obj->route,
                'vehicle' => $obj->vehicle,
                'area' => $obj->area,
                'tax' => $obj->tax,
                'ref_amount' => $obj->ref_amount,
                'tax_id' => 0,
                'advance' => $obj->advance,
                'other' => $obj->other,
                'freight' => $obj->freight,
                'discount' => $obj->discount,
                'roundoff' => $obj->roundoff,
                'invoice' => $invoice,
                'ref_id' => $obj->ref_id,
                'created_date' => date('Y-m-d H:i:s', time()),
                'narration' => $narration,
                'created_by' => 2,
                'type' => $or_type,
                'bill_type' => $billtype,
                'cusname' => $obj->cusname,
                'cusdetails' => $obj->cusdetails,
                'cusemail' => $obj->cusemail,
                'published' => 'yes'
            );
            $insert_id = 0;
            if ($id == 0) {
                $insert_id = $this->sales->InsertSales($data);
            } else {
                $this->sales->UpdateSales($data, $id, $or_type);
                $insert_id = $id;
            }

            foreach ($obj->salesitems as $sale) {
                $data_items = array(
                    'sales_id' => $insert_id,
                    'item_id' => $sale->item_id,
                    'godown' => $sale->godown,
                    'unit_id' => $sale->unit_id,
                    'base_unit_id' => $sale->base_unit_id,
                    'quantity' => $sale->quantity,
                    'rate' => 0,
                    'mrp' => $sale->rate,
                    'tax_id' => $sale->tax_id,
                    'tax' => $sale->tax,
                    'discount' => 0,
                    'total' => $sale->total,
                    'published' => 'yes'
                );
                $this->sales->InsertSales_items($data_items, $or_type, $invoicedate);
            }
            $this->sales->savesub($data, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id);
        }
        $msg = [
            'status' => TRUE, 
            'message' => 'items are attached to the result'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

}
