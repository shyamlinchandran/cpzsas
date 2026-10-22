<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of booking_model
 *
 * @author u43255
 */
class Booking_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getDate($date) {
        $parts = explode('/', $date);
        return "$parts[2]-$parts[1]-$parts[0]";
    }

    function save() {
        $id = $this->input->post('p_id'); // if it is zero then we will add the item
        $sdate = $this->getDate($this->input->post('sdate'));
        $edate = $this->getDate($this->input->post('edate'));
        $nodays = $this->input->post('nodays');
        $type = $this->input->post('type');
        $no_adults = $this->input->post('no_adults');
        $no_children = $this->input->post('no_children');




        $other = $this->input->post('other');
        $discount = $this->input->post('discount');
        $rount = $this->input->post('rount');
        $tax = $this->input->post('tax');
        $gtotal = $this->input->post('gtotal');
        $memid = $this->input->post('memid');
        // $narration = 'Purchase invoice' . $invoice . ' on  ' . $date;

        /* // not using now //st('memname');
          $phone = $this->input->post('phone');
          $email = $this->input->post('email');
          $address_line1 = $this->input->post('address_line1');
          $address_line2 = $this->input->post('address_line2');
          $address_line1 = $this->input->post('address_line1');
          $address_line2 = $this->input->post('address_line2');
          $details = $this->input->post('details');
         */


        $data = array(
            'book_type' => 'booking',
            'start_date' => $sdate,
            'end_date' => $edate,
            'booked_date' => date('Y-m-d H:i:s', now()),
            'no_days' => $nodays,
            'no_adults' => $no_adults,
            'no_childers' => $no_children,
            'no_extrabed' => 0,
            'member_id' => $memid,
            'total_gt' => $gtotal,
            'total_tax' => $tax,
            'total_other' => $other,
            'round' => $rount,
            'discount' => $discount,
            'tran_crtd_dt' => date('Y-m-d H:i:s', now())
        );
        $insert_id = 0;
        if ($id == 0) {
            $this->db->insert('room_book_master', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('id', $id);
            $this->db->update('room_book_master', $data);
        }
        $room_category = $this->input->post('room_category', TRUE);
        $member_category = $this->input->post('member_category', TRUE);
        $room_id = $this->input->post('room_id', TRUE);
        $rate = $this->input->post('rate', TRUE);
        $norooms = $this->input->post('norooms', TRUE);
        $taxp = $this->input->post('taxp', TRUE);
        $taxamt = $this->input->post('taxamt', TRUE);
        $totalrow = $this->input->post('totalrow', TRUE);
        $length = sizeof($room_category);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'book_id' => $insert_id,
                'room_id' => $room_id[$i],
                'room_category_id' => $room_category[$i],
                'member_category_id' => $member_category[$i],
                'rate' => $rate[$i],
                'norooms' => $norooms[$i], 
                'taxp' => $taxp[$i],
                'tax' => $taxamt[$i],
                'total' => $totalrow[$i],
                'discount' => 0//,
               //'published' => 'yes'
            );
            $this->db->insert('room_booking', $data);
        }
        //echo  $this->db->last_query();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
