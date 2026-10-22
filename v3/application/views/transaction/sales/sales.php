<?php

$is_export_invoice  = 0;
if(isset($settings[0]['is_export_invoice']) ){
	$is_export_invoice = $settings[0]['is_export_invoice'];
}


$AlertExpiry = 0;
if(isset($settings[0]['AlertExpiry']) ){
	$AlertExpiry = $settings[0]['AlertExpiry'];
}

$AlertDuplicate = 0;
if(isset($settings[0]['AlertDuplicate']) ){
	$AlertDuplicate = $settings[0]['AlertDuplicate'];
}



$purchase_tax_on_mrp = 0 ;
if(isset($settings[0]['purchase_tax_on_mrp'])){
    $purchase_tax_on_mrp = $settings[0]['purchase_tax_on_mrp'];
}


$agent_required = 0 ;
if(isset($settings[0]['agent_required'])){
    $agent_required = $settings[0]['agent_required'] ;
}

$salesman_required = 0 ;
if(isset($settings[0]['salesman_required'])){
    $salesman_required = $settings[0]['salesman_required'] ;
}

$gpay_number_required = 0 ;
if(isset($settings[0]['gpay_number_required'])){
    $gpay_number_required = $settings[0]['gpay_number_required'] ;
}



$UnitPriceMargin = 0 ;
if(isset($settings[0]['UnitPriceMargin'])){
    $UnitPriceMargin = $settings[0]['UnitPriceMargin'] ;
}
$is_cigarette_cess = 0 ;
if(isset($settings[0]['is_cigarette_cess']) ){
    $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
}

$negative_stock_billing  = 1;
if(isset($settings[0]['negative_stock_billing']) ){
	$negative_stock_billing  = $settings[0]['negative_stock_billing'];
}
$tmp = $this->session->userdata('user');
        $utype = $tmp['utype'];
        $userid = $tmp['Id'];

$is_tcs  = 0 ;
if(isset($settings[0]['is_tcs'] ) ){
	$is_tcs  = $settings[0]['is_tcs'];
}

$is_com = 0 ;
if(isset($settings[0]['item_commission'] ) ){
    $is_com = $settings[0]['item_commission'];
}
$margin_increase = 0 ;
if(isset($settings[0]['margin_increase'] ) ){
	$margin_increase = $settings[0]['margin_increase'];
}

$barcode_qty_inc = 0;
if(isset($settings[0]['barcode_qty_inc']) ){
	$barcode_qty_inc = $settings[0]['barcode_qty_inc'];

}

$show_criterion = 0 ;
if(isset($settings[0]['show_criterion'] ) ){
	$show_criterion = $settings[0]['show_criterion'];
}
$tmp = $this->session->userdata('user');
$user_type  = $tmp['user_type'];

$bill_discount = 0 ;
if(isset($settings[0]['bill_discount']) ){
	$bill_discount = $settings[0]['bill_discount'];

}
if(strtolower($this->session->userdata('login_base_comid')) != 'test' ){
    //$bill_discount = 0 ;
}
$Is_SQFT = 0 ;
$cls_sqft = '';
$Scheme_Discount = 0 ;
if(isset($settings[0]['Scheme_Discount']) ){
	$Scheme_Discount = $settings[0]['Scheme_Discount'];

}
$Is_row_Sqft = 0;
if(isset($settings[0]['Is_SQFT'] ) ){
	$Is_SQFT = $settings[0]['Is_SQFT'];
}

if(strtolower($this->session->userdata('login_comid')) == 'pushpa'){
    $Is_SQFT = 0;
    $Is_row_Sqft = 1;

}
$Is_SQFT_cal = 0 ;
if(strtolower($this->session->userdata('login_base_comid')) == 'swararag' || strtolower($this->session->userdata('login_base_comid')) == 'pushpa' ){
    $Is_SQFT_cal = 1;
}


if($Is_SQFT > 0 ){
    $cls_sqft = 'itemsqft';
}

$is_bata = 0;

if(strtolower($this->session->userdata('login_base_comid')) == 'asekar' ){
    $is_bata = 1;
}

$logincom = strtolower($this->session->userdata('login_base_comid'));
if($logincom == 'test'){
    //$logincom = 'kmtrading';
}
$purchase_barcode = 0 ;
if (isset($settings[0]['purchase_barcode'])) {
    $purchase_barcode = $settings[0]['purchase_barcode'];
}

$bill_mrp = 0;
if(isset($settings[0]['bill_mrp'] ) ){
	$bill_mrp = $settings[0]['bill_mrp'];
}

$day_balance = 0;
if(isset($settings[0]['day_balance'] ) ){
	$day_balance = $settings[0]['day_balance'];
}


$def_bank = 0 ;
if(isset($settings[0]['default_bank'] ) ){
		$def_bank = $settings[0]['default_bank'];
}
$enable_barcode = 1;
if(isset($settings[0]['enable_barcode'] ) ){
	$enable_barcode = $settings[0]['enable_barcode'];
}
$discount_on = 'item';
if(isset($settings[0]['discount_on'] ) ){
	$discount_on = $settings[0]['discount_on'];
}
$additional_cess = 0;
$cash_status = 0;
$estimate_type = '';
$is_round_off = 1;
$is_weiging = 0;
$is_cashe = 0;
$sale_cash_type = 'Cash';
$quantity_price = 0 ;

$onsync_discount = 0 ;
if(isset($settings[0]['onsync_discount'] ) ){
	$onsync_discount = $settings[0]['onsync_discount'];
}


if(isset($settings[0]['quantity_price']) ){
	$quantity_price = $settings[0]['quantity_price'];

}
if (isset($settings[0]['sale_cash_type'])) {
    $sale_cash_type = $settings[0]['sale_cash_type'];
}
if (isset($settings[0]['is_cashe'])) {
    $is_cashe = $settings[0]['is_cashe'];
}
if (isset($settings[0]['is_weiging'])) {
    $is_weiging = $settings[0]['is_weiging'];
}
if (isset($settings[0]['round_off'])) {
    $is_round_off = $settings[0]['round_off'];
}
if (isset($est_type)) {
    $estimate_type = $est_type;
}
if (isset($settings[0]['cash_status'])) {
    $cash_status = $settings[0]['cash_status'];
}
if (isset($settings[0]['additional_cess'])) {
    $additional_cess = $settings[0]['additional_cess'];
}
$item_damage = 0;
if (isset($settings[0]['item_damage'])) {
    $item_damage = $settings[0]['item_damage'];
}
$receipt_entry = 0;
if (isset($settings[0]['receipt_entry'])) {
    $receipt_entry = $settings[0]['receipt_entry'];
}
$sales_item_order = 'FIFO';
$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0; //tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$is_taxincuded = $settings[0]['is_taxincluded'];
// if it i one then tax inclusive 
$is_discount = 1;
$sale_discount = 1;
$is_size = $settings[0]['is_size'];
$is_size = 0;
//this is for discount then no sales rate   
$is_SettngsEnabled = 1;
$global_mrp  = 0;
$global_discount  = 0;
if (isset($settings[0]['global_mrp'])) {
    $global_mrp = $settings[0]['global_mrp'];
}
if (isset($settings[0]['global_discount'])) {
    $global_discount = $settings[0]['global_discount'];
}
$zeroindex = $zeroindex[0]['gstid'];
$freequantity = 0;
if (isset($settings[0]['is_freequantity'])) {
    $freequantity = $settings[0]['is_freequantity'];
}
$global_mrp_value = 0;
if (isset($settings[0]['global_mrp_value'])) {
    $global_mrp_value =  $settings[0]['global_mrp_value'];
}
$customer_points = 0;
if (isset($settings[0]['customer_points'])) {
    $customer_points = $settings[0]['customer_points'];
}
$is_godown = $settings[0]['is_godown'];
$barcode_settings = $settings[0]['barcode_settings'];
$is_billtype = $settings[0]['is_billtype'];
$is_multipleunit = $settings[0]['is_unit'];
$is_analytics = $settings[0]['is_analytics'];
$is_bkground_print = $settings[0]['is_bkground_print'];
$cost_centre = $settings[0]['is_costcenter'];
$is_multipletax = $settings[0]['is_multipletax'];
$terms_condition = $settings[0]['terms_condition'];
$is_kitgroup = $settings[0]['is_kitgroup'];
$is_kitcustomer = $settings[0]['is_kitcustomer'];
$is_composite = $settings[0]['is_composite'];
$taxtype = $settings[0]['com_tax_type'];
$is_adjustment = $settings[0]['is_adjustment'];
$is_that = $settings[0]['is_cash_collection'];
$print_size = 1;
if (isset($settings[0]['print_size'])) {
    $print_size = $settings[0]['print_size'];
}
if ($taxtype == 'VAT') {
    $taxtype = 'VAT';
}
$is_itemcode = $settings[0]['is_itemcode'];
$is_extra = $settings[0]['is_discription'];
if ($is_godown == 0) {
    $ghidden = 'hidden';
} else {
    $ghidden = '';
}
if ($is_billtype == 0) {
    $bill = 'hidden';
} else {
    $bill = '';
}
if ($is_multipleunit == 0) {
    $unit = 'hidden';
} else {
    $unit = '';
}
$user_is_margin = 0;
$user = $this->session->userdata('user');
$user_id = $user['Id'];
$user_default_godown = $user['user_default_godown'];
if((int) $user_default_godown < 1 ){
	$user_default_godown = '';
}
$user_default_printtype = $user['user_default_printtype'];
$user_default_billtype = '';
if ($user['user_is_margin'] != "") {
    $user_is_margin = $user['user_is_margin'];
}
if($tmp['utype'] == 'Admin'){
    $user_is_margin = 1;
}
if (ucfirst($type) == 'Sales') {
    $user_default_billtype = $user['user_default_billtype'];
}
if (ucfirst($type) == 'Estimate') {
    $user_default_billtype = $user['default_sorder_billtype'];
}
if (ucfirst($type) == 'Sales_return') {
    $user_default_billtype = $user['default_sreturn_billtype'];
}
$notShow = '';
$title = $type;
if ($type == 'estimate') {
    $title = 'Sales Order';
}

$edit_sale_rate = 1;
if (isset($user['edit_sale_rate'])) {
    $edit_sale_rate = $user['edit_sale_rate'];
}
$edit_sale_discount = 1;
if (isset($user['edit_sale_discount'])) {
    $edit_sale_discount = $user['edit_sale_discount'];
}

$txt_sale_rate = '';
if((float) $edit_sale_rate < 1 ){
	$txt_sale_rate = 'readonly';

}
$txt_sale_dis = '';
if((float) $edit_sale_discount < 1 ){
	$txt_sale_dis = 'readonly';

}
?>
<style>

<?php if($show_criterion > 0 && $id < 1 ){?>
		.trred td input{
			background-color:red !important;
			color: #fff !important
		}
		.trorange td input{
			background-color:orange !important;
			color: #fff !important
			 
		}
        .tryellow td input{
			background-color:#958441 !important;
			color: #fff !important
			 
		}
		.trMaroon td input{
			background-color:Maroon !important;
			color: #fff !important
		}
<?php }?>


    #saletype{
        cursor: none;
        pointer-events: none;
    }
    .box-title {
        text-transform: capitalize;
    }

    .sma {
        width: 60px !important;
    }

    .boo {
        position: absolute;
        bottom: 30px;
        left: 95px;
    }

    .table-condensed>thead>tr>td,
    .table-condensed>tbody>tr>td,
    .table-condensed>thead>tr>th {
        padding: 1px !important;
    }

    .datepicker.dropdown-menu th, .datepicker.dropdown-menu td {
        padding: 4px 5px !important;
    }

    .table-condensed .form-control {
        padding: 2px !important;
    }

    .span {
        font-size: 15px;
        font-weight: 600;
        padding-right: 15px;
        padding-left: 15px;
    }

    .new-invoice {
        font-size: 15px;
        font-weight: 600;
        padding-right: 15px;
        padding-left: 15px;
    }

    .spec2 {
        display: none;
    }

    .spec1 {
        display: block;
    }

    .tableBodyScroll {
        max-height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #000;
    }

    .select2-selection.select2-selection--multiple {
        min-height: 25px;
        max-height: 25px;
    }

    .nav-tabs-custom>.nav-tabs>li>a {
        color: #000;
        border-radius: 0;
    }

    .nav-tabs-custom>.nav-tabs>li.active>a {
        text-transform: capitalize;
        font-weight: bold;
    }

    .nav-tabs-custom>.nav-tabs>li>a {
        text-transform: capitalize;
    }

    <?php
    if ($type == 'estimate') {
        $notShow = 'hidden';
    ?>.nav-tabs-custom>.nav-tabs {
        background-color: #ca46cc;
    }

    <?php
    } else if ($type == 'sales_return') {
    ?>.nav-tabs-custom>.nav-tabs {
        background-color: #ccc246;
    }

    <?php
    } else {
    ?>.nav-tabs-custom>.nav-tabs {
        background: #9fcc46
    }

    <?php } ?>
</style>



<div class="modal fade" id="modal-itmdec">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="itmdecrowid" value="0" id="itmdecrowid" class="form-control" />
                   
                    <div class ="row">

                       
                        <div  class="col-sm-12">
                            <?= label('Desciption', $this, $user) ?>
                            <input type ="text"  name="itmdec"  id="itmdec" class="form-control" >
                        </div>

                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_itmdec" class="btn btn-primary" data-dismiss="modal">Add
                    </button>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>

    </div>


<div class="modal fade" id="modal-sqft">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="sqftrowid" value="0" id="sqftrowid" class="form-control" />
                    <div class ="row">
                        <div class="col-sm-8">
                            <?= label('Quantity*', $this, $user) ?>
                            <input  autofocus name="sqft_quantity" id="sqft_quantity" class="form-control clssqftmodal" />
                        </div>
                    </div>
                    <br /> <br />
                    <div class ="row">
                        <div class="col-sm-4">
                            <?= label('Number', $this, $user) ?>
                            <input  name="sqft_number" id="sqft_number" class="form-control clssqftmodal" />
                        </div>
                        <div <?php if($Is_SQFT_cal > 0 ){ echo 'style ="display:none" ';}?> class="col-sm-4">
                            <?= label('SQFT', $this, $user) ?>
                            <input name="item_SQFT" readonly id="item_SQFT" class="form-control" />
                        </div>

                        <div <?php if(strtolower($this->session->userdata('login_base_comid')) != 'pushpa' ){ echo 'style ="display:none" ';} ?> class="col-sm-4">
                            <?= label('Unit', $this, $user) ?>
                            <input type ="hidden" name ="last_sqftunit" id ="last_sqftunit" value =""/>
                            <select name="sqftunit"  id="sqftunit" class="form-control" >
                            </select>
                        </div>

                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_SQFTquantity" class="btn btn-primary" data-dismiss="modal">Add
                    </button>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>

    </div>



<link href="<?php echo base_url(); ?>asset/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />

<form method="post" clr="salesitems<?php echo $type . $id; ?>" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/sales/sales/' . $type); ?>" action="<?php echo site_url('transaction/sales/save/' . $type); ?>" class="form-horizontal frmcreate">
       <input type="hidden" value="<?php echo $this->session->userdata('login_base_comid');?>" id="login_base_comids" name="login_base_comids" />
           <input type="hidden" value="<?php echo $is_tcs; ?>" id="is_tcs" name="is_tcs" />
     <input type="hidden" value="<?php echo $AlertDuplicate; ?>" id="AlertDuplicate" name="AlertDuplicate" />
    <input type="hidden" value="<?php echo $AlertExpiry; ?>" id="AlertExpiry" name="AlertExpiry" />
    <input type="hidden" value="<?php echo $deliver_note; ?>" id="deliver_note_id" name="deliver_note_id" />
    <input type="hidden" value="<?php echo $Is_SQFT; ?>" id="Is_SQFT" name="Is_SQFT" />
    <input type="hidden" value="<?php echo $Is_row_Sqft; ?>" id="Is_row_Sqft" name="Is_row_Sqft" />
    <input type="hidden" value="0" id="sales_commission" name="sales_commission" />
        <input type="hidden" value="<?php echo $is_cigarette_cess; ?>" id="is_cigarette_cess" name="is_cigarette_cess" />

    <input type="hidden" value="<?php echo $Is_SQFT_cal; ?>" id="Is_SQFT_cal" name="Is_SQFT_cal" />
    <input type="hidden" value="0" id="unit_pur_rate" name="unit_pur_rate" />
    <input type="hidden" value="<?php echo $discount_on; ?>" id="discount_on" name="discount_on" />
    <input type="hidden" value="<?php echo $enable_barcode; ?>" id="enable_barcode" name="enable_barcode" />
    <input type="hidden" value="<?php echo strtolower($logincom);?>" id="login_comid" name="login_comid" />
    <input type="hidden" value="<?php echo $is_bata;?>" id="is_bata" name="is_bata" />
    <input type="hidden" value="<?php echo $purchase_barcode;?>" id="purchase_barcode" name="purchase_barcode" />
	<input type="hidden" value="0" id="itm_mrp" name="itm_mrp" />
    <input type="hidden" value="0" id="itm_srate" name="itm_srate" />
    <input type="hidden" value="0" id="itm_whrate" name="itm_whrate" />
    <input type="hidden" value="0" id="itm_spclrate" name="itm_spclrate" />
    <input type="hidden" value="0" id="bill_dis_per" name="bill_dis_per" />
    <input type="hidden" value="0" id="row_dis_per" name="row_dis_per" />
    <input type="hidden" value="<?php echo $show_criterion; ?>" id="show_criterion" name="show_criterion" />
    <input type="hidden" value="<?php echo $barcode_qty_inc; ?>" id="barcode_qty_inc" name="barcode_qty_inc" />

	
    <input type="hidden" value="<?php echo $this->company_roundoff;?>" id="company_roundoff" name="company_roundoff" />
    <input type="hidden" value="" id="emei" name="emei" />
    <input type="hidden" value="0" id="pindexid" name="pindexid" />
    <input type="hidden" value="0" id="emei_pur_id" name="emei_pur_id" />
    <input type="hidden" value="<?php echo $bill_discount;?>" id="bill_discount" name="bill_discount" />
    <input type="hidden" value="<?php echo $txt_sale_rate;?>" id="txt_sale_rate" name="txt_sale_rate" />
    <input type="hidden" value="" id="cus_rate" name="cus_rate" />
    <input type="hidden" value="<?php echo $copy_id; ?>" id="copy_id" name="copy_id" />
    <input type="hidden" value="<?php echo $estimate_type; ?>" id="estimate_type" name="estimate_type" />
    <input type="hidden" value="<?php echo $is_cashe; ?>" id="is_cashe" name="is_cashe" />
    <input type="hidden" value="<?php echo $additional_cess; ?>" id="additional_cess" name="additional_cess" />
    <input type="hidden" name="receipt_entry" id="receipt_entry" value="<?php echo $receipt_entry; ?>" />
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id" />
    <input type="hidden" value="<?php echo $sale_cash_type; ?>" id="sale_cash_type" name="sale_cash_type" />
    <input type="hidden" value="<?= $onsync_discount ?>" name="onsync_discount" id="onsync_discount" />
    <input type="hidden" value="<?php echo $bill_mrp; ?>" name="bill_mrp" id='bill_mrp' />
    <input type="hidden" name="item_damage" id="item_damage" value="<?php echo $item_damage; ?>" class="form-control" />
    <input type="hidden" name="customer_points" id="customer_points" value="<?php echo $customer_points; ?>">
    <input type="hidden" value="<?php echo $global_discount; ?>" id="global_discount" name="global_discount" />
    <input type="hidden" value="<?php echo $global_mrp; ?>" id="global_mrp" name="global_mrp" />
    <input type="hidden" value="<?php echo $copy; ?>" id="copy" name="copy" />
    <input type="hidden" value="<?php echo $is_size; ?>" name="is_size" id="is_size" />
    <input type="hidden" value="0" name="p_id" />
    <input type="hidden" id="new_invoice" name="new_invoice" />
    <input type="hidden" value="<?= $def_bank ?>" name="def_bank" id="def_bank" />
    <input type="hidden" value='' id="itembatch" name="itembatch" />
    <input type="hidden" name="reedemable_amunt" id="reedemable_amunt" value="0" />
    <input type="hidden" id="iv_no" name="iv_no" />
    <input type="hidden" name="newtype" id="newtype" />
    <input type="hidden" id="autoinvoice" name="autoinvoice" />

     <input type="hidden" value="<?php echo $agent_required ; ?>" name="agent_required" id='agent_required' />
    <input type="hidden" value="<?php echo $salesman_required ; ?>" name="salesman_required" id='salesman_required' />
    <input type="hidden" value="<?php echo $gpay_number_required ; ?>" name="gpay_number_required" id='gpay_number_required' />
    


    <input type="hidden" value="<?php echo $UnitPriceMargin; ?>" name="UnitPriceMargin" id='UnitPriceMargin' />
    <input type="hidden" value="<?php echo $quantity_price; ?>" name="quantity_price" id='quantity_price' />
    <input type="hidden" value="<?php echo $freequantity; ?>" name="freequantity" id='freequantity' />
    <input type="hidden" value="0" name="one_currency_equivalent" id='one_currency_equivalent' />
    <input type="hidden" value="<?php echo $user_default_godown; ?>" name="user_default_godown" id='user_default_godown' />
    <input type="hidden" value="<?php echo $zeroindex; ?>" name="zeroindex" id='zeroindex' />
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id='user_id' />
    <input type="hidden" value="<?php echo $is_multipletax; ?>" name="is_multipletax" id='is_multipletax' />
    <input type="hidden" value="<?php echo $barcode_settings; ?>" name="barcode_settings" id='barcode_settings' />
    <input type="hidden" value="0" name="invoice" id='Invoice' />
    <input type="hidden" id="totstock" name="totstock" value="0" />
    <input type="hidden" value="" name="item_mrp" id='item_mrp' />
    <input type="hidden" value="<?php echo $is_that; ?>" name="is_that" id='is_that' />
    <input type="hidden" value="<?php echo $is_composite; ?>" name="is_composite" id='is_composite' />
    <input type="hidden" value="<?php echo $user_default_billtype; ?>" name="user_default_billtype" id='user_default_billtype' />
    <input type="hidden" value="<?php echo $is_adjustment; ?>" name="is_adjustment" id='is_adjustment' />
    <input type="hidden" value="<?php echo $user_default_printtype; ?>" name="user_default_printtype" id='user_default_printtype' />
    <input type="hidden" value="<?php echo $is_extra; ?>" name="is_extra" id='is_extra' />
    <input type="hidden" value="" name="tax_led_id" id='tax_led_id' />

    <input type="hidden" value="0" name="is_ban" id='is_ban' />
    <input type="hidden" value="0" name="is_warning" id='is_warning' />
    
    <input type="hidden" value="<?php echo $cost_centre; ?>" name="cost_centre" id='cost_centre' />
    <input type="hidden" value="<?php echo $terms_condition; ?>" name="terms_condition" id='terms_condition' />
    <input type="hidden" value="<?php echo $is_bkground_print; ?>" name="is_bkground_print" id='is_bkground_print' />
    <input type="hidden" value="<?php echo $is_analytics; ?>" name="is_analytics" id='is_analytics' />
    <input type="hidden" id="estid" name="estid" value='0' />
    <input type="hidden" id="total_points" name="total_points" value='0' />
    <input type="hidden" value="<?php echo $is_itemcode; ?>" name="is_itemcode" id='is_itemcode' />
    <input type="hidden" value="<?php echo $user_is_margin; ?>" name="user_is_margin" id='user_is_margin' />
    <input type="hidden" name="pur_rate" id='pur_rate' />
    <input type="hidden" value="<?php echo $is_discount; ?>" id="is_discount" name="is_discount" />
    <input type="hidden" value="<?php echo $type; ?>" name="ttype" id="ttype" />
    <input type="hidden" value="<?php echo $is_godown; ?>" id="is_godown" name="is_godown" />
    <input type="hidden" value="<?php echo $is_billtype; ?>" id="is_billtype" name="is_billtype" />
    <input type="hidden" id="unitvalue" name="unitvalue" />
    <input type="hidden" id="paytype" name="paytype" />
    <input type="hidden" value="<?php echo $is_kitgroup; ?>" id="is_kitgroup" name="is_kitgroup" />
    <input type="hidden" value="<?php echo $is_kitcustomer; ?>" id="is_kitcustomer" name="is_kitcustomer" />
    <input type="hidden" value="<?php echo $is_multipleunit; ?>" id="is_multipleunit" name="is_multipleunit" />
    <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded" />
    <input type="hidden" value="<?php echo $dprate; ?>" id="dprate" name="dprate" />
    <input type="hidden" value="<?php echo $comontax; ?>" name="comontax" id="comontax" />
    <input type="hidden" id="txtEstimate_id" class="form-control" value="<?php echo $deliver_note; ?>" name="txtEstimate_id" />
    <input data-validation="required" type="hidden" name="base_unit" id="base_unit" />
    <input type="hidden" value="<?php echo $is_round_off; ?>" name="is_round_off" id="is_round_off" />
    <input type="hidden" value="<?php echo $is_weiging; ?>" name="is_weiging" id="is_weiging" />
    <input type="hidden" value="0" name="item_landing_cost" id="item_landing_cost" />
    <input type="hidden" value="<?php echo $purchase_tax_on_mrp; ?>" name="purchase_tax_on_mrp" id="purchase_tax_on_mrp"/> 
     <input type = "hidden" name="item_tax_on_mrp" value="0" id="item_tax_on_mrp" >

    <style>
        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd
        }

        .clsitmdis{
            padding: 10px;
        }
    </style>
	<div class="modal fade" id="modal-margin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="item_header_margin"> </h4>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive" style ="width:100%" border="2" cellpadding="0" cellspacing="0">
										<tr>
											<th colspan="5" style="text-align:center" >Prate Margin</th>
										</tr>
										<tr>
											<td style ="width:20%;"></td>
											<td style ="width:20%;" >Rate </td>
											<td style ="width:20%;" >Prate</td>
											<td style ="width:20%;">Margin</td>
											<td style ="width:20%;">Margin %</td>
										</tr>
										<tr>
											<td>Srate</td>
											<td class ="margin_srate" > </td>
											<td  class="cls_prate"></td>
											<td id ="prate_margin_salerate"></td>
											<td id ="percentage_margin_salerate"></td>
										</tr>
										<tr>
											<td >MRP</td>
											<td class ="margin_mrp"> </td>
											<td class="cls_prate"></td>
											<td id ="prate_margin_mrp"></td>
											<td id ="percentage_margin_mrp"></td>
										</tr>
										<tr>
											<td >Whrate</td>
											<td class ="margin_whrate"> </td>
											<td class="cls_prate"></td>
											<td id ="prate_margin_wharte"></td>
											<td id ="percentage_margin_wharte"></td>
										</tr>
										<tr>
											<td >Special Rate</td>
											<td class ="margin_special_rate"> </td>
											<td class="cls_prate"></td>
											<td id ="prate_margin_special_rate"></td>
											<td id ="percentage_margin_special_rate"></td>
										</tr>
										<tr>
											<th  colspan="5" style="text-align:center" >Landing Cost Margin</th>
										</tr>
										<tr>
											<td></td>
											<td>Rate </td>
											<td>Landing Cost</td>
											<td>Margin</td>
											<td>Margin %</td>
										</tr>
										<tr>
											<td>Srate</td>
											<td class ="margin_srate" > </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_salerate"></td>
											<td id ="lcp_margin_salerate"></td>
										</tr>
										<tr>
											<td >MRP</td>
											<td class ="margin_mrp"> </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_mrp"></td>
											<td id ="lcp_margin_mrp"></td>
										</tr>
										<tr>
											<td >Whrate</td>
											<td class ="margin_whrate"> </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_wharte"></td>
											<td id ="lcp_margin_wharte"></td>
										</tr>
										<tr>
											<td >Special Rate</td>
											<td class ="margin_special_rate"> </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_special_rate"></td>
											<td id ="lcp_margin_special_rate"></td>
										</tr>
									</table>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	
    <div class="modal fade" id="modal-old-srate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="item_header"> </h4>
                </div>
                <div class="modal-body">
                    <table style="width:100%" class="table">
                        <tr>
                            <td>Date</td>
                            <td>Invoice</td>
                            <td>Rate</td>
                        </tr>
                        <tbody id="bodyrate">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-damage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="rowid" value="0" id="rowid" class="form-control" />
                    <div class="">
                        <?= label('Actual Quantity*', $this, $user) ?>
                        <input value="1" name="actual_quantity" id="actual_quantity" class="form-control clsdamage" />
                    </div>
                    <div class="">
                        <?= label('Damage Quantity*', $this, $user) ?>
                        <input name="damage_quantity" id="damage_quantity" class="form-control clsdamage" />
                    </div>
                    <div class="">
                        <?= label('Item Quantity*', $this, $user) ?>
                        <input name="sales_quantity" id="sales_quantity" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_damage" class="btn btn-primary" data-dismiss="modal">Add
                    </button>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>

    </div>
	
	
	
	  <div class="modal fade" id="modal-discount">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="add_dis_to_amt" value="0" id="add_dis_to_amt" class="form-control" />
                    <input type="hidden" name="modal_discount_rowid" value="0" id="modal_discount_rowid" class="form-control" />
                    <div class=""  >
                        Amount : <span id ="add_dis_to" name ="add_dis_to">0</span><br />
                    </div>
                    <div class="">
                        <?= label('Discount %', $this, $user) ?>
                        <input  autofocus type ="number"  value="0" name="add_dis_per" id="add_dis_per" class="form-control" />
                    </div>
                    <div   class="">
                        <?= label('Discount Amount', $this, $user) ?>
                        <input readonly type ="number"  value="0" name="add_dis_amt" id="add_dis_amt" class="form-control" />
                    </div>

                   
                    <div class="">
                        <?= label('Amount', $this, $user) ?>
                        <input type ="number" readonly  value="0" name="add_dis_balance" id="add_dis_balance" class="form-control" />
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_unit_dis" class="btn btn-primary" data-dismiss="modal">Update
                    </button>
                    <button type="button" id="add_unit_dis_add" class="btn btn-primary" data-dismiss="modal">Close
                    </button>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>

    </div>
	
	
	
	<div class="modal fade" id="modal-quantity">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="modal_quantity_rowid" value="0" id="modal_quantity_rowid" class="form-control" />
                    <div class="">
                        <?= label('Quantity*', $this, $user) ?>
                        <input type ="number"  value="0" name="unit_qty" id="unit_qty" class="form-control" />
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_unit_qty" class="btn btn-primary" data-dismiss="modal">Update
                    </button>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>

    </div>
	
	
    <div class="modal fade" id="modal-alter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" id="myDropdownhide" class="hidden btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <div id="myDropdown" class="dropdown-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " tabindex="-1" id="creditmodal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label id="credittxt" style="padding: 20px;">Customer Has Exceeded his/her Credit Period</label>
                </div>
                <div class="modal-footer">
                    <button data-toggle="tooltip" type="button" title="Add To save" id="btndiscontinue" class="btn btn-danger" href="#">
                        Block Customer
                    </button>
                    <button type="button" id="btncontinue" class="btn btn-success" data-dismiss="modal"> Continue anyway</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " tabindex="-1" id="creditmodals" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label id="credittxts" style="padding: 20px;">Customer Has Exceeded his/her Credit Period</label>
                </div>
                <div class="modal-footer">
                    <button data-toggle="tooltip" type="button" title="Add To save" id="btndiscontinued" class="btn btn-danger" href="#">
                        Block Customer
                    </button>
                    <button type="button" id="btncontinued" class="btn btn-success" data-dismiss="modal"> Continue anyway</button>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#mainSale" data-toggle="tab"><?= label(ucfirst(str_replace('_', ' ', $title)), $this, $user) ?></a></li>
                        <li><a href="#otherTab" data-toggle="tab"><?= label('Other Details', $this, $user) ?></a></li>
                        <?php if ($type != 'delivery_note' && $type != 'estimate') { ?>
                            <li><a href="#service" data-toggle="tab"><?= label('Additional Ledger', $this, $user) ?></a></li>
                        <?php } ?>
                        <?php if ($type != 'delivery_note' && $type != 'estimate') { ?>
                            <li class="pull-right">
                                <div class="input-group" style="width:130px;padding: 4px">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    <input type="text" id="txtEstimate" style="height:30px !important" class="form-control" name="txtEstimate" />
                                </div>
                            </li>
                        <?php } ?>
                        <?php if ($is_kitgroup == '1') { ?>
                            <li class="pull-right">
                                <div class="input-group" style="width:130px;padding: 4px">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    <input type="text" id="txtkit" onkeydown="kitsearch(event)" style="height:30px !important" placeholder="<?= label('Kit Group', $this, $user) ?>" class="form-control" name="txtkit" />
                                </div>
                            </li>
                        <?php } ?>

                        <li class="pull-right">
                            <div class="input-group" style="width:130px;padding: 4px">
                                <select name="set_rate" data-validation="required" style="height:30px !important" id="set_rate" class="form-control">
                                    <option value="srate">Sale Rate</option>
                                    <option value="MRP">MRP</option>
                                    <option value="wh_rate">WholeSale Rate</option>
									<option value ="special_rate" >Special Rate</option>
									<option value ="last_srate" >Last Sales Rate</option>
                                </select>
                            </div>
                        </li>
                        <li class="pull-right">
                            <div class="input-group" style="width:130px;padding: 4px">
                                <select name="saletype" data-validation="required" style="height:30px !important" id="saletype" class="form-control">
                                    <option value="b2c">B2C</option>
                                    <option value="b2b">B2B</option>
                                </select>
                            </div>
                        </li>
                        <li class="pull-right">
                            <div class="input-group" style="width:130px;padding: 4px">
                                <select name="is_tax" data-validation="required" style="height:30px !important" id="is_tax" class="form-control">
                                    <option value="1"><?= label($taxtype, $this, $user) ?> <?= label('Included', $this, $user) ?></option>
                                    <option value="0"><?= label($taxtype, $this, $user) ?> <?= label('Excluded', $this, $user) ?></option>
                                </select>
                            </div>
                        </li>
                        <?php if ($cost_centre == '1') { ?>
                            <li class="pull-right">
                                <div class="input-group" style="width:130px;padding: 4px">
                                    <select id="Costcenter" name="Costcenter" style="height:30px !important" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </li>
                        <?php } ?>

                    </ul>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="mainSale">
                            <div class="box-body">
                                <table class="table table-striped table-condensed">
                                    <tr>
                                        <td class="col "><?= label('Invoice date', $this, $user) ?></td>
                                        <td class="col  <?php echo $bill; ?>"><?= label('Bill Types', $this, $user) ?></td>
                                        <td class="col "><?= label('Cash/Credit', $this, $user) ?></td>
                                        <?php if ($comontax == 1) { ?>
                                            <td class="col "><?= label($taxtype, $this, $user) ?></td>
                                        <?php } ?>
                                        <td>
                                           <button hddid="sales" data-toggle="tooltip" type="button" title="TotalAdd To save" class="sma btn btn-primary btnaddcustomer" href="#">
                                                        New
                                             </button>
                                            <?= label('Customer', $this, $user) ?>
                                        </td>
                                        <td><?= label('Billing Name', $this, $user) ?></td>
                                        <td><?= label('Phone Number', $this, $user) ?></td>
                                        <td><?= label('Address', $this, $user) ?></td>
                                    </tr>
                                    <tr><td> <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date"></td><!--                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="Date"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="Date"></td>-->
                                        <td <?php echo $bill; ?>>
                                            <select tabindex="-1" id="btype" data-validation="required" name="btype" class="form-control ">
                                            </select>
                                        </td>
                                        <td><select name="type" data-validation="required" id="type" class="form-control">
                                                <option value="Cash"><?= label('Cash', $this, $user) ?></option>
                                                <option value="Bank"><?= label('Bank', $this, $user) ?></option>
                                                <option value="Credit"><?= label('Credit', $this, $user) ?></option>
                                                <?php if($type != 'sales_return'){?>
                                                        <option style="color:gray" value="COB"><?= label('Cash/Bank', $this, $user) ?></option>
                                                        <option style="color:gray" value="Ca_Cr"><?= label('Cash/Credit', $this, $user) ?></option>
                                                        <option style="color:gray" value="Ba_Cr"><?= label('Bank/Credit', $this, $user) ?></option>
                                                        <option style="color:gray" value="Ba_Ca_Cr"><?= label('Bank/Cash/Credit', $this, $user) ?></option>
                                                <?php }?>
                                            </select>
                                        </td>
                                        <?php if ($comontax == 1) { ?>
                                            <td><select data-validation="required" id="tax_common" name="tax_common" class="form-control">
                                                    <option value="">Select</option>
                                                </select>
                                            </td>
                                        <?php } ?>

                                        <td><input data-validation type="hidden" name="customer_id" id="supid" />
                                            <input name="supname" id="supname" type="text" next="true" data-validation class="form-control" placeholder="<?= label('Customer', $this, $user) ?>">
                                        </td>
                                        <td><input  noTab = "true" name="bname" type="text" id="bname" class="form-control cashcustomer" placeholder="<?= label('Billing Name', $this, $user) ?>"></td>
                                        <td><input  noTab = "true"  name="phone" pattern="[0-9]{0,13}" type="text" id="phone" class="form-control cashcustomer" placeholder="<?= label('Phone Number', $this, $user) ?>"></td>
                                        <td><input name="email" type="text" id="address_line1" next="itemcode" class="form-control" placeholder="<?= label('Address', $this, $user) ?>"></td>
                                    </tr>
                                </table>
                                <table id="tablex" class="table table-striped table-condensed" hidden="hidden">
                                    <tr>
                                        <td>
                                            <!--                                        <td><button type="button" url="<?php echo base_url(); ?>masters/customers/add"  class="btn btn-primary myModalPop">
                                                New
                                            </button>-->
                                            Customer
                                        </td>
                                        <td>Phone</td>
                                        <td>Email</td>
                                        <td>GST/CST Number</td>
                                    </tr>
                                    <tr>
                                        <td><input name="phone-ol" type="text" id="phone" class="form-control" placeholder="Phone"></td>
                                        <td><input name="email-ol" type="text" id="email" class="form-control" placeholder="Email"></td>
                                        <td><input name="cst" type="text" id="cst" class="form-control" placeholder="CST"></td>
                                        <td><input name="cst" type="text" id="cst" class="form-control" placeholder="CST"></td>
                                    </tr>
                                    <tr>
                                        <td>Tin Number </td>
                                        <td>Address</td>
                                        <td>Address 2</td>
                                        <td>Details</td>
                                    </tr>
                                    <tr>
                                        <td><input name="tin" type="text" id="tin" class="form-control" placeholder="Tin"></td>
                                        <td><input name="address_line1" type="text" id="address_line1" class="form-control" placeholder="address line1"></td>
                                        <td><input name="address_line2" type="text" id="address_line2" class="form-control" placeholder="address line2"></td>
                                        <td><input name="details" type="text" id="details" class="form-control" placeholder="details"></td>
                                    </tr>
                                </table>

                                <p><span class="new-invoice"><label spellcheck="false" id="prefix"></label><label spellcheck="false" id="sep_first"></label><label class="two-digits price" ondblclick="changeinvoice()" NoTab="true" spellcheck="false" id="b_no"></label><label spellcheck="false" id="sep_second"></label><label spellcheck="false" id="suffix"></label></span>
                                <?php if ($day_balance > 0) { ?>
                                    <span Class="span" id="">Daybalance:<?php echo $daybalance; ?></span>
                                <?php }?>
                                <span Class="span" id="redp"></span> <span Class="span" id="i_stock"></span> <span <?php if ($user_is_margin == 0) { ?> style = "display:none" <?php } ?> Class="span" id="b_mgn">&nbsp;</span>   
                                <span <?php if ($is_com == 0) { ?> hidden<?php } ?> Class="span" id="span_commission">&nbsp;</span>
                                <span <?php if ($user_is_margin == 0) { ?> style="display: none;" <?php } ?> Class="span" id="i_mgn">&nbsp;</span></span><span style = "display:none"  <?php if ($user_is_margin == 0) { ?> hidden<?php } ?> Class="span" id="i_mgnper">&nbsp;</span> <span class="span" id="balance"></span><span class="span" style="display:none;text-weight:bold;" id="reedemable">Redeemable :</span>  <span class="span" style="text-weight:bold;" id="showrack"></span>             <span class="span pull-right"><input style="display:none" type="text" value="0" class="col-lg-6" name="commi_amt_hi" id="commi_amt" /> </span></p>
                                <div class="col-sm-12" <?php if ($global_mrp > 0 || $global_discount > 0) {
                                                            echo 'style="height:60px;"';
                                                        } ?>>
                                    <div <?php if ($global_mrp < 1) {
                                                echo 'style="display:none"';
                                            } ?> class="col-sm-4">
                                        <label>Global MRP</label>
                                        <input value="<?php echo $global_mrp_value; ?>" class="two-digits " type="text" name="txtglobalmrp" id="txtglobalmrp" value="0" />
                                    </div>

                                    <div <?php if ($global_discount < 1) {
                                                echo 'style="display:none"';
                                            } ?> class="col-sm-4">
                                        <label>Global Discount</label>
                                        <input value="" class="two-digits " type="text" name="txtglobaldiscount" id="txtglobaldiscount" value="0" />
                                    </div>

                                    <?php if($margin_increase > 0 ){?>
                                     <div class="col-sm-4 " >
                                        <label>U/M</label>
                                        <input value="" class="two-digits " type="number" step ="any" name="txtglobalitemdis" id="txtglobalitemdis" value="0" />
                                    

                                    </div>

                                <?php }?>
                                 

                                </div>

                             

                                <div style = "min-height:150px" class="tableBodyScroll col-sm-12">
                                    <table id="salesTable"  class="table table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <td><?= label('SNo', $this, $user) ?></td>
                                                <?php if ($is_itemcode == 1) { ?>
                                                    <td><?= label('Item Code', $this, $user) ?></td>
                                                <?php } ?>
                                                <td>
                                                    <button hddid="sales" data-toggle="tooltip" type="button" title="TotalAdd To save" class="sma btn btn-primary btnadditem" href="#">
                                                        New
                                                    </button>
                                                    <?= label('New', $this, $user) ?>
                                                    <?= label('Item Name', $this, $user) ?>
                                                </td>
                                                <?php if ($is_analytics == 1) { ?>
                                                    <td><?= label('Analytics', $this, $user) ?></td>
                                                <?php } ?>
                                                <?php if ($is_size == 1) { ?>
                                                    <td><?= label('Item Size', $this, $user) ?></td>
                                                <?php } ?>
                                                <?php if(strtolower($this->session->userdata('login_base_comid')) == 'pushpa' ){  ?>
                                                    <td><?= label('Unit', $this, $user) ?></td>
                                                <?php } ?>
                                                <td <?php echo $ghidden; ?>>
                                                    <?= label('Godown', $this, $user) ?>
                                                </td>
                                                <td><?= label('Qty', $this, $user) ?></td>
                                                <?php if($Is_row_Sqft > 0 ){?>
                                                    <td><?= label('SQFT', $this, $user) ?></td>
                                                <?php }?>
                                                <?php if ($freequantity == 1) { ?>
                                                    <td><?= label('Free qty', $this, $user) ?></td>
                                                <?php } ?>
                                                <td <?php echo $unit; ?>><?= label('Unit', $this, $user) ?></td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td <?php if ($is_composite == 1) { ?> hidden<?php } ?>><?= label($taxtype, $this, $user) ?></td>
                                                <?php } ?>

                                                <?php if((float) $bill_mrp > 0 ){?>
                                                    <td><?= label('MRP', $this, $user) ?></td>
                                                <?php } ?>
                                                <td><?= label('Rate', $this, $user) ?></td>
                                                <?php if ($is_discount == 1) { ?>
                                                    <td><?= label('Dis Amt', $this, $user) ?></td>
                                                    <td><?= label('Dis', $this, $user) ?></td>
                                                <?php } ?>

                                                <?php if (!$comontax == 1) { ?>
                                                    <td <?php if ($is_composite == 1) { ?> hidden<?php } ?>><?= label($taxtype, $this, $user) ?> <?= label('Amt', $this, $user) ?></td>
                                                <?php } ?>
                                                <?php if ($additional_cess > 0) { ?>
                                                    <td><?= label('Cess', $this, $user) ?></td>
                                                <?php } ?>
                                                <td><?= label('Total', $this, $user) ?></td>
                                                <td> </td>
                                            </tr>
                                            <tr id="add">
                                                <td class="sma" style="text-align: center;"><input title="1" style="height:25px" id="totnolist" class="form-control  text-right" readonly="readonly" /></td>
                                                <?php if ($is_itemcode == 1) { ?>
                                                    <td class="col-lg-1"> <input noTab = "True" id="itemcode" <?php if ($barcode_settings === "1") { ?> class="form-control" onchange="itemsearch()" <?php } else { ?>class="form-control ItemMatchBarcode" <?php } ?>stype="barcode" data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>" type="text" placeholder="<?= label('Item Code', $this, $user) ?>" /></td> <?php } else { ?>
                                                <?php } ?>

                                                <td class="col-lg-3"> 
                                                <input type = "hidden" name="cig_ces_per_amount" value="0" id="cig_ces_per_amount" >
													<input type = "hidden" name="cig_ces_amt" value="0" id="cig_ces_amt" >
													<input type = "hidden" name="cig_ces_per" value="0" id="cig_ces_per" ><input type = "hidden" value="0" name="unit_cig_ces_amt"  id="unit_cig_ces_amt" >
                                                
                                                <input NoTab="true" id="itemname" stype="name" data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>" class="form-control" type="text" placeholder="<?= label('Item Name', $this, $user) ?>" /></td>
                                                <?php if ($is_analytics == 1) { ?>
                                                    <td><select tabindex="-1" id="analyticscenter" class="form-control col-lg-1">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </td>
                                                <?php } ?>

                                                <?php if ($is_size == 1) { ?>
                                                    <td><select tabindex="-1" id="item_size" class="form-control sma">
                                                            <option value="">Select</option>
                                                        </select></td>
                                                <?php } ?>
                                                 <?php if(strtolower($this->session->userdata('login_base_comid')) == 'pushpa' ){  ?>
                                                    <td><select readonly tabindex="-1" id="un" class="form-control">
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($is_size == 0) { ?>
                                                    <input type="hidden" id="item_size" value="0" />
                                                <?php } ?>

                                                <td <?php echo $ghidden; ?>><select tabindex="-1" id="godown" class="form-control">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                                <td> 
                                                <input type ="hidden" name ="itemsqft" id ="itemsqft"  />     
                                                <input style='height:25px' id="item_qty" type="text" class="form-control text-right  two-digits price <?php echo $cls_sqft;?> " placeholder="<?= label('Quantity', $this, $user) ?>" /></td>
                                                <?php if($Is_row_Sqft > 0 ){?>
                                                    <td> <input style='height:25px' id="row_sqft" type="text" value="0.00" class="form-control " placeholder="<?= label('SQFT', $this, $user) ?>" /></td>
                                                <?php }?>
                                               
                                                <?php if ($freequantity == 1) { ?>
                                                    <td> <input style='height:25px' id="free_qty" type="text" value="0.00" class="form-control text-right  two-digits price " placeholder="<?= label('Free Qty', $this, $user) ?>" /></td>
                                                <?php } ?>
                                                <td class="sma" <?php echo $unit; ?>><select tabindex="-1" id="unit_item" class="form-control ">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td <?php if ($is_composite == 1) { ?> hidden<?php } ?> class="sma"><select tabindex="-1" id="tax_item" class="form-control ">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </td>
                                                <?php } ?>

                                                <?php if((float) $bill_mrp > 0 ){?>
                                                    <td> <input id="sale_mrp" type="text" readonly class="form-control  text-right two-digits" placeholder="<?= label('MRP', $this, $user) ?>" /></td>
                                                <?php }else{ ?>
                                                     <input id="sale_mrp" type="text"  class="form-control  text-right two-digits"  style = "display:none;" placeholder="<?= label('MRP', $this, $user) ?>" />
                                                <?php } ?>

                                                <input id="salitms_mrp" type="hidden"  class="form-control  text-right two-digits"   placeholder="<?= label('MRP', $this, $user) ?>" />
                                                <td><input type="hidden" NoTab="true" tabindex="-1" name="commission" id="commission" /> <input id="mrp_item" type="text" <?php echo $txt_sale_rate;?> class="form-control  text-right two-digits" placeholder="<?= label('Rate', $this, $user) ?>" /></td>
                                                <td <?php if ($is_discount == 0) { ?>hidden<?php } ?>> <input id="dis_amt" type="text" class="form-control text-right price  two-digits"  <?php echo $txt_sale_dis;?>  placeholder="<?= label('Dis Amt', $this, $user) ?>" /></td>
                                                <td <?php if ($is_discount == 0) { ?>hidden<?php } ?>> <input id="prate_item" type="text" class="form-control text-right price  two-digits" <?php echo $txt_sale_dis;?> placeholder="<?= label('Dis', $this, $user) ?>%" /></td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td <?php if ($is_composite == 1) { ?> hidden<?php } ?>>
                                                        <input style="height:25px" class='form-control  two-digits' id="rowTax" readonly="readonly" />
                                                    </td>
                                                <?php } ?>
                                                <?php if ($additional_cess > 0) { ?>
                                                    <td><input type="hidden" id="item_ces_per" name="item_ces_per" value="0"><input type="hidden" id="item_ces_name" name="item_ces_name" value=""><input type="hidden" id="item_ces_id" name="item_ces_id" value="0"><input style="height:25px" class='form-control  two-digits' id="itemcesamt" readonly="readonly" /></td>
                                                <?php } else{ ?>
                                                    <td style="display:none;"><input type="hidden" id="item_ces_per" name="item_ces_per" value="0"><input type="hidden" id="item_ces_name" name="item_ces_name" value=""><input type="hidden" id="item_ces_id" name="item_ces_id" value="0"><input type="hidden" class='form-control  two-digits' id="itemcesamt"  /></td>
												 <?php } ?>
                                                <td><input style="height:25px" class='form-control  two-digits' id="rowTotal" readonly="readonly" /></td>
                                                <td>

                                                    <!--                                        hidden-->
                                                    <input type="hidden" id="row_cess_amount" name="row_cess_amount" />
                                                    <input type="hidden" id="row_cess" name="row_cess" />
                                                    <input type="hidden" name="item_free_qty" id="item_free_qty" />
                                                    <input type="hidden" name="item_free_qty_for" id="item_free_qty_for" />
                                                    <input type="hidden" name="item_id" id="item_id" />
                                                    <button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtra" class="btn btn-success" href="#">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="rowm">

                                        </tbody>
                                    </table>
                                </div>
                                <table class="table table-striped table-condensed" style="padding:0;">
                                    <tr>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-1"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-1"></td>
                                        <input type="hidden" name="billmargin" id="billmargin" placeholder="Bill Margin" readonly="readonly" type="text" class="text-right  form-control" placeholder="Total Tax">
                                        <td class="col-lg-1"><input type="text" id="rowdis" name="rowdis" readonly="readonly" class="form-control  text-right" placeholder="Discount"></td>
                                        <td class="col-lg-1"><input name="totsaletax" id="totsaletax" placeholder="Total Tax" readonly="readonly" type="text" class="text-right  form-control" placeholder="Total Tax"></td>
                                        <td class="col-lg-2"><input style="height:25px" type="text" id="total" name="subtot" readonly="readonly" class="form-control  text-right" placeholder="Total"></td>
                                    </tr>
                                </table>
                                <div class="col-sm-4" style="padding:3px;" id="payment_div" class="row <?= $notShow ?>">
                                    <div style="padding:3px;" class="col-sm-12">
                                        <div class="col-sm-5">
                                            <?= label('Select Bank', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <select name="bank_account" id="bank_account" class="form-control">
                                                <option value="">Select Bank</option>
                                            </select>
                                        </div>
                                    </div>
									<div style="display:none" style="padding:3px;" class="col-sm-12 bankdiv">
                                        <div class="col-sm-5">
                                        </div>
                                        <div class="col-sm-7">
												Card&nbsp;<input checked type="radio" id="bank_pay_method1" name="bank_pay_method" value="Card">&nbsp;
												Gpay&nbsp;<input type="radio" id="bank_pay_method2" name="bank_pay_method" value="gpay">&nbsp;
                                        </div>
                                    </div>
									<div style="display:none" style="padding:3px;" class="col-sm-12 gpaydiv">
                                        <div class="col-sm-5">
                                            <?= label('Gpay No', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="gpay_number" id="gpay_number" value="" class="form-control" placeholder="Gpay No" />

                                        </div>
                                    </div>
                                    <div style="display:none" style="padding:3px;" class="col-sm-12 carddiv">
                                        <div class="col-sm-5">
                                            <?= label('Card No', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="card_number" id="card_number" value="" class="form-control" placeholder="Card No" />

                                        </div>
                                    </div>
                                    <div style="display:none" style="padding:3px;" class="col-sm-12 carddiv">
                                        <div class="col-sm-5">
                                            <?= label('Ref No', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="bank_ref_code" id="bank_ref_code" value="" class="form-control" placeholder="Ref Code" />

                                        </div>
                                    </div>
                                    <div style="padding:3px;" class="col-sm-12">
                                        <div class="col-sm-5">
                                            <?= label('Bank Amount', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="bank_amount" id="bank_amount" value="0.00" class="form-control tatalcal text-right  two-digits price" placeholder="Amount Paid In Account" />
                                        </div>
                                    </div>
                                    <div style="padding:3px;" class="col-sm-12">
                                        <div style="display:none;padding: 0px;margin-top: 0px;" class="col-sm-6">
                                            <?= label('Cash Ledger', $this, $user) ?><br />
                                            <input readonly="readonly" type="text" name="Cash_in_hand" id="Cash_in_hand" class="form-control" />
                                        </div>
                                        <div class="col-sm-5">
                                            <?= label('Cash Amount', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control price text-right  two-digits tatalcal" value="0.00" name="cash_amount" id="cash_amount" placeholder="Amount Paid In Cash" />
                                        </div>
                                    </div>
                                    <div style="padding:3px;" class="col-sm-12">
                                        <div class="col-sm-5">
                                            <?= label('Credit Amount', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" readonly="readonly" class="form-control price text-right  two-digits tatalcal" name="pending_amount" id="pending_amount" placeholder="Amount Pending" />
                                        </div>
                                    </div>
									<div style="padding:3px;" class="col-sm-12">
                                        <div class="col-sm-5">
                                            <?= label('Remarks', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text"  class="form-control" name="remarks" id="remarks" placeholder="Remarks" />
                                        </div>
                                    </div>
                                </div>
                                <div style="padding:3px;" class="col-sm-4  ">
                                    <?php if ($cash_status > 0) { ?>

                                        <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Cash Status', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <select id="cash_status" name="cash_status" class="form-control">
                                                    <option value="1">Collected</option>
                                                    <option value="0">Not Collected</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Distance', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                         <input type ="number" name = "distance" id ="distance" class = "form-control"/>  
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Agent/Reference', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                        <select <?php if($agent_required >0 ){?> data-validation="required" <?php }?> style="width:100%;" id="reference" name="reference" class="form-control select2">
                                                        <option value="">Select</option>
                                                    </select>                                        </div>
                                    </div>
                                 
                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Sales Man', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <select <?php if($salesman_required >0 ){?> data-validation="required" <?php }?> id="salesman" name="SalesMan" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if ($is_adjustment == 1) { ?>
                                        <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Exchange Amount', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input id="adjustment" name="adjustment" style="height:25px" type="text" class="form-control text-right  two-digits price" placeholder="Exchange Amt">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Exchange Ref.', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input id="exc_ref" name="exc_ref" style="height:25px" type="text" class="form-control " placeholder="Exchange Reference">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Exchange Balance', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readonly="readonly" id="exc_bal" name="exc_bal" style="height:25px" type="text" class="form-control " placeholder="Exchange Reference">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($is_that == 1) { ?>
                                        <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Cash Tendered', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input name="col_amt" value="0.00" id="col_amt" placeholder="<?= label('Collected', $this, $user) ?>  " type="text" class="form-control text-right  two-digits price tatalcal" placeholder="<?= label('Pur/Tax', $this, $user) ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Balance', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input type="text" id="bal_amt" name="bal_amt" readonly="readonly" class="form-control    text-right" placeholder="<?= label('Balance Amt', $this, $user) ?>">
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div style="display:none;" class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Print Type', $this, $user) ?>
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <select id="printtype" name="printtype" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if ($receipt_entry == 1 && $type == 'sales') { ?>
                                        <div style="" class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Receipt Amount', $this, $user) ?>
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input type="text" id="receipt_amount" name="receipt_amount" class="tatalcal form-control two-digits" />
                                            </div>
                                        </div>
                                        <div style="" class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Balance', $this, $user) ?>
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input type="text" readonly id="receipt_balance" name="receipt_balance" class="form-control two-digits" />
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div style="padding:3px;" class="col-sm-4  ">
                                    <?php if($bill_discount > 0 ){?>

                                        <div class="col-sm-12">
                                        <?php if ($sale_discount == 1) { ?><div style="padding:3px;" class="col-sm-5"><?= label('Discount %', $this, $user) ?></div><?php } ?>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <input <?php if ($sale_discount == 0) { ?>style="display: none;" value="0" <?php } ?> name="bill_discount_per" value='0.00' id="bill_discount_per" placeholder="<?= label('Discount%', $this, $user) ?>" type="text" class="text-right  form-control two-digits tatalcal">
                                        </div>
                                    </div>


                                    <?php } ?>
                                    <div class="col-sm-12">
                                        <?php if ($sale_discount == 1) { ?><div style="padding:3px;" class="col-sm-5"><?= label('Discount', $this, $user) ?></div><?php } ?>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <input <?php if ($sale_discount == 0) { ?>style="display: none;" value="0" <?php } ?> name="discount" value='0.00' id="discount" placeholder="<?= label('Discount', $this, $user) ?>" type="text" class="text-right  form-control two-digits tatalcald">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php if ($customer_points == 1) { ?>
                                            <div style="padding:3px;" class="col-sm-5"><?= label('Redeem Points', $this, $user) ?>

                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input name="redeem_points" id="redeem_points" placeholder="<?= label('Redeem Points', $this, $user) ?>" type="text" class="tatalcal text-right two-digits form-control">
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <div class="col-sm-12">
                                        <?php if ($customer_points == 1) { ?>
                                            <div style="padding:3px;" class="col-sm-5"><?= label('Redeem Amount', $this, $user) ?>

                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readonly="readonly" name="redeem_amount" id="redeem_amount" placeholder="<?= label('Redeem Amount', $this, $user) ?>" type="text" class="tatalcal text-right two-digits form-control">
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Total Before', $this, $user) ?> <?= label($taxtype, $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <input name="totrate" id="totrate" placeholder="<?= label('Total Before Tax', $this, $user) ?>" readonly="readonly" type="text" class="tatalcal text-right  form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label($taxtype, $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <input name="taxtotal" id="taxtotal" placeholder="<?= label($taxtype, $this, $user) ?>" readonly="readonly" type="text" class="text-right  form-control">
                                        </div>
                                    </div>
                                    <?php if ($additional_cess > 0) { ?>
                                        <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-5">
                                                <?= label('Item Cess', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readonly="readonly" class="form-control two-digits text-right " type="text" name="itm_net_ces" id="itm_net_ces">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div <?php if($settings[0]['com_tax_type'] == 'VAT' ){ echo "style='display:none' ";} ?> class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Kerala Flood Cess', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <input readonly="readonly" class="form-control two-digits text-right " type="text" name="tot_cess" id="tot_cess">
                                        </div>
                                    </div>

                                    <?php if($is_cigarette_cess > 0 ){?>
                                        
                                        <div class="col-sm-12">
                                            <div style="padding:3px;"  class="col-sm-5">
                                                <?= label('Cigarette Cess Amount', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;"  class="col-sm-7">
                                                <input readonly="readonly" class="form-control two-digits text-right " type="text" name="tot_cig_ces_amt" id="tot_cig_ces_amt">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div style="padding:3px;"  class="col-sm-5">
                                                <?= label('Cigarette Cess% Amount', $this, $user) ?><br />
                                            </div>
                                            <div style="padding:3px;"  class="col-sm-7">
                                                <input readonly="readonly" class="form-control two-digits text-right " type="text" name="tot_cig_per_ces_amt" id="tot_cig_per_ces_amt">
                                            </div>
                                        </div>
                                    <?php }?>

                                    <?php if($is_tcs > 0 ){?>
                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('TCS', $this, $user) ?>
                                            <input type="checkbox" id="is_tcs" name="is_tcs" style="margin-left: 10px;">
                                            <label for="is_tcs"><?= label('Apply', $this, $user) ?></label><br />
                                        </div>
                                         <div style="padding:3px;" class="col-sm-3">
                                            <input name="tcs_percentage" id="tcs_percentage" 
                                                   style="font-size: 15pt; font-weight: bold;" 
                                                   placeholder="<?= label('TCS %', $this, $user) ?>" 
                                                   readonly="readonly" type="text" 
                                                   class="text-right form-control" value="0" max ="100">
                                        </div>
                                        <div style="padding:3px;" class="col-sm-4">
                                            <input name="tcs_amount" id="tcs_amount" 
                                                   style="font-size: 15pt; font-weight: bold;" 
                                                   placeholder="<?= label('TCS Amount', $this, $user) ?>" 
                                                   readonly="readonly" type="text" 
                                                   class="text-right form-control" value="0">
                                        </div>
                                    </div>
                                    <?php }?>

                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Round Off', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <input name="rount" id="rount" placeholder="<?= label('Round Off', $this, $user) ?>" readonly="readonly" type="text" class="text-right  form-control">
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div style="padding:3px;" class="col-sm-5">
                                            <?= label('Grand Total', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;" class="col-sm-7">
                                            <input name="gtotal" style='font-size: 15pt;font-weight: bold;' id="gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>" readonly="readonly" type="text" class="text-right  form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="otherTab">
                            <div class="box-body">
                                <!-- <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-2"><?= label('State', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('State Code', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?></td> 
                                        <td class="col col-lg-3"><?= label('E-Way Bill Number', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('E-Way Bill Date', $this, $user) ?></td>
                                    </tr>
                                    <tr> 
                                        <td><select  id="states"   name="states" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="stcode" type="text" id="stcode"  class="form-control  "   placeholder="<?= label('State Code', $this, $user) ?>"></td>
                                        <td>  <input name="gst" type="text" id="gst"  class="form-control  col-lg-2"   placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                        <td>  <input name="ewbno" type="text" id="ewbno"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Number', $this, $user) ?>"></td>
                                        <td>  <input name="ewbdetails" type="text" id="ewbdetails"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Details', $this, $user) ?>"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Delivery Date', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Credit Days', $this, $user) ?></td>
                                        <td class="col col-lg-3"></td> 
                                        <td class="col col-lg-3"><?= label('Agent/Reference', $this, $user) ?></td> 
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>  <input name="ddate" id="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="<?= label('Delivery Date', $this, $user) ?>"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="<?= label('Credit Days', $this, $user) ?>"></td>
                                        <td>
                                        </td> 
                                        <td><select  id="reference"  name="reference" class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Area', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Route', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Vehicle', $this, $user) ?></td>
                                        <td class="col "><?= label('Coolie', $this, $user) ?></td>
                                        <td class="col "><?= label('Freight', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td><select  id="area"  name="area" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="route"  name="route" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="vehicle"  name="vehicle" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="other" id="other" type="text"   class="form-control  tatalcal" value="0.00"  placeholder="<?= label('Coolie', $this, $user) ?>"></td>
                                        <td>  <input name="freight" type="text" id="freight" value="0.00" class="form-control  tatalcal"  placeholder="<?= label('Freight', $this, $user) ?>"></td>
                                    </tr>
                                </table>-->
                                </br>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <table class="table table-striped table-condensed">
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Customer Details', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td> <?= label('State', $this, $user) ?> :</td>
                                                <td>
                                                    <select id="states" name="states" class="form-control">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= label('State Code', $this, $user) ?> :</td>
                                                <td>
                                                    <input readonly name="stcode" type="text" id="stcode" class="form-control  " placeholder="<?= label('State Code', $this, $user) ?>">
                                                </td>
                                            </tr>
                                            <td> <?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?></td>
                                            <td>
                                                <input name="gst" type="text" id="gst" class="form-control  col-lg-2" placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>">
                                            </td>
                                            </tr>
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('E-way Details', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td><?= label('E-Way Bill Number', $this, $user) ?></td>
                                                <td>
                                                    <input name="ewbno" type="text" id="ewbno" class="form-control  col-lg-2" placeholder="<?= label('E-Way Bill Number', $this, $user) ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= label('E-Way Bill Date', $this, $user) ?></td>
                                                <td><input name="ewbdetails" type="text" id="ewbdetails" class="form-control  date col-lg-2" placeholder="<?= label('E-Way Bill Details', $this, $user) ?>"></td>
                                            </tr>
                                            <?php if($Scheme_Discount >0 ){?>
                                                <tr>
                                                    <th style="text-align:center" colspan="12"><?= label('Scheme Details', $this, $user) ?></th>
                                                </tr>
                                                <tr>
                                                         <td><?= label('Scheme Desc', $this, $user) ?></td>
                                                        <td>
                                                        <input name="scheme_desc" type="text" id="scheme_desc" class="form-control  col-lg-2" placeholder="<?= label('Scheme Desc', $this, $user) ?>">
                                                         </td>
                                                </tr>

                                                <tr>
                                                         <td><?= label('Scheme From', $this, $user) ?></td>
                                                        <td>
                                                        <input name="scheme_from" type="text" id="scheme_from" class="form-control date dates col-lg-2" placeholder="<?= label('Scheme From', $this, $user) ?>">
                                                         </td>
                                                </tr>

                                                <tr>
                                                         <td><?= label('Scheme Till', $this, $user) ?></td>
                                                        <td>
                                                        <input name="scheme_till" type="text" id="scheme_till" class="form-control date dates col-lg-2" placeholder="<?= label('Scheme Till', $this, $user) ?>">
                                                         </td>
                                                </tr>


                                            <?php }?>
                                        </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <table class="table table-striped table-condensed">
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('General Details', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td><?= label('Delivery Date', $this, $user) ?></td>
                                                <td><input name="ddate" id="ddate" type="text" data-validation="length" data-validation-length="min2" class="form-control date " placeholder="<?= label('Delivery Date', $this, $user) ?>"></td>
                                            </tr>
											<tr>
                                                <td><?= label('Due Date', $this, $user) ?></td>
                                                <td><input name="due_date" id="due_date" type="text"  class="form-control blankdate date " placeholder="<?= label('Due Date', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Ref No', $this, $user) ?></td>
                                                <td><input name="sales_ref_no" type="text" id="sales_ref_no" class="form-control  col-lg-2" placeholder="<?= label('Ref no', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Credit Days', $this, $user) ?></td>
                                                <td> <input name="cdate" type="text" data-validation="length" data-validation-length="min2" class="form-control date " placeholder="<?= label('Credit Days', $this, $user) ?>"></td>
                                            </tr>
                                            <!-- <tr>
                                                <td><?= label('Agent/Reference', $this, $user) ?></td>
                                                <td><select style="width:100%;" id="reference" name="reference" class="form-control select2">
                                                        <option value="">Select</option>
                                                    </select></td>
                                            </tr> -->
                                            <tr>
                                                <td><?= label('Area', $this, $user) ?></td>
                                                <td>
                                                    <select id="area" name="area" class="form-control">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Route', $this, $user) ?></td>
                                                <td>
                                                    <select id="route" name="route" class="form-control">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <table class="table table-striped table-condensed">
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Transport Details', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td><?= label('Vehicle', $this, $user) ?></td>
                                                <td>
                                                    <select id="vehicle" name="vehicle" class="form-control">
                                                        <option value="">Select</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Vehicle No', $this, $user) ?></td>
                                                <td>
                                                    <input type="text" id="vehicle_txt" name="vehicle_txt" class="form-control" placeholder="Vehicle No">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Driver', $this, $user) ?></td>
                                                <td>
                                                    <input type = "text"  id="driver" name="driver" class="form-control">
                                                       
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><?= label('Mode Of Transport', $this, $user) ?></td>
                                                <td>
                                                    <input name="mode_of_transport" id="mode_of_transport" type="text" class="form-control " value="" placeholder="<?= label('Mode Of Transport', $this, $user) ?>">


                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Place', $this, $user) ?></td>
                                                <td>
                                                    <input name="del_place" id="del_place" type="text" class="form-control " value="" placeholder="<?= label('Place', $this, $user) ?>">


                                                </td>
                                            </tr>

                                            <?php if((int) $is_bata > 0 ){?>
                                                <tr>
                                                    <td><?= label('Bata', $this, $user) ?></td>
                                                    <td>
                                                        <input name="bata" id="bata" type="text" class="form-control  tatalcal" value="0.00" placeholder="<?= label('Bata', $this, $user) ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?= label('Transit Fee', $this, $user) ?></td>
                                                    <td>
                                                        <input name="transit_fee" id="transit_fee" type="text" class="form-control  tatalcal" value="0.00" placeholder="<?= label('Transit Fee', $this, $user) ?>">
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            <tr>
                                                <td><?= label('Coolie', $this, $user) ?></td>
                                                <td>
                                                    <input name="other" id="other" type="text" class="form-control  tatalcal" value="0.00" placeholder="<?= label('Coolie', $this, $user) ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Freight', $this, $user) ?></td>
                                                <td>
                                                    <input name="freight" type="text" id="freight" value="0.00" class="form-control  tatalcal" placeholder="<?= label('Freight', $this, $user) ?>">
                                                </td>
                                            </tr>
											<tr>
                                                <td><?= label('Packing Details', $this, $user) ?></td>
                                                <td>
													<input type ="text" name = "packing_details" id ="packing_details" class = "form-control"/>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <table class="table table-striped table-condensed">
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Terms And Conditions', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td><textarea readonly="readonly" colspan="12" style="width: 100%; height:75px !important;" name="tms_confixed"><?php echo $terms_condition; ?> </textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea colspan="12" style="width: 100%; height:75px !important;" id="tms_con" name="tms_con"> </textarea></td>
                                            </tr>
                                            <?php if($is_export_invoice > 0 ){?>
                                            <tr>
                                                <td><textarea style = "height:80px !important" name="payment_term" type="text" id="payment_term" class="form-control 2" placeholder="<?= label('Payment Terms', $this, $user) ?>"></textarea></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <table class="table table-striped table-condensed">
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Delivery(Shipping) Address', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td><input name="con_name" type="text" id="con_name" class="form-control 2" placeholder="<?= label('Name', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><textarea style = "height:50px" name="con_addr" type="text" id="con_addr" class="form-control 2" placeholder="<?= label('Address', $this, $user) ?>"></textarea></td>
                                            </tr>
                                            <td><input name="con_contact" type="text" id="con_contact" class="form-control 2" placeholder="<?= label('Contact', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input name="con_gst" type="text" id="con_gst" class="form-control 2" placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><select id="con_state" name="con_state" class="form-control">
                                                        <option value="">Select</option>
                                                    </select></td>
                                            </tr>
                                             <?php if($is_export_invoice > 0 ){?>
                                            <tr>
                                                <td><textarea style = "height:80px !important" name="shipping_terms" type="text" id="shipping_terms" class="form-control 2" placeholder="<?= label('Shipping Terms', $this, $user) ?>"></textarea></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </div>

                                    <?php if($is_export_invoice > 0 ){?>

                                    	<div class="col-lg-4">
                                        <table class="table table-striped table-condensed">
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Export Details', $this, $user) ?></th>
                                            </tr>
											<tr>
                                                <td><input name="buyer" type="text" id="buyer" class="form-control 2" placeholder="<?= label('Buyer', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input name="pre_carriage" type="text" id="pre_carriage" class="form-control 2" placeholder="<?= label('Pre – carriage', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text"  name="place_of_receipt" type="text" id="place_of_receipt" class="form-control 2" placeholder="<?= label('Place of Receipt', $this, $user) ?>"></td>
                                            </tr>
                                            <td><input name="flight_no" type="text" id="flight_no" class="form-control 2" placeholder="<?= label('Vessel /Flight No.', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input name="port_of_landing" type="text" id="port_of_landing" class="form-control 2" placeholder=" <?= label('Port of Loading', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input name="port_of_discharge" type="text" id="port_of_discharge" class="form-control 2" placeholder="<?= label('Port of Discharge', $this, $user) ?>"></td>
                                            </tr>
											 <tr>
                                                <td><input name="final_destination" type="text" id="final_destination" class="form-control 2" placeholder="<?= label('Final Destination', $this, $user) ?> "></td>
                                            </tr>
											<tr>
                                                <td><input name="country_final_destination" type="text" id="country_final_destination" class="form-control 2" placeholder="<?= label('Country of Final Destination', $this, $user) ?> "></td>
                                            </tr>
											<tr>
                                                <td><input name="country_origin_of_goods" type="text" id="country_origin_of_goods" class="form-control 2" placeholder="<?= label('Country Origin of goods', $this, $user) ?> "></td>
                                            </tr>
                                                <tr>
                                                    <td><input name="buyer_order_no" type="text" id="buyer_order_no" class="form-control 2" placeholder="<?= label('Buyer Order no', $this, $user) ?> "></td>
                                                </tr>
                                                <tr>
                                                    <td><input name="other_ref" type="text" id="other_ref" class="form-control 2" placeholder="<?= label('Other Ref', $this, $user) ?> "></td>
                                                </tr>

                                                <tr>
                                                    <td><input name="exporter_ref" type="text" id="exporter_ref" class="form-control 2" placeholder="<?= label('Expoters Ref', $this, $user) ?> "></td>
                                                </tr>

                                        </table>
                                    </div>
                                    <?php }?>


                                </div>
                                </br>
                            </div>
                        </div>
                        <?php if ($is_SettngsEnabled == 1) { ?>
                            <div class="tab-pane" id="SettingsTab">
                                <div class="box-body">
                                    <table class="table table-striped table-condensed">
                                        <tr>
                                            <td class="col-lg-4">Key</td>
                                            <td class="col-lg-4">Value</td>
                                            <td></td>
                                        </tr>
                                        <tbody id="rown">
                                            <tr id="add">
                                                <td class="col-lg-4"> <input data-validation="required" type="hidden" name="keyid" id="keyid" />
                                                    <input name="keyname" id="keyname[]" type="text" NoTab="true" data-validation="required,length" data-validation-length="min2" class="form-control" placeholder="Key" disabled>
                                                </td>
                                                <td class="col-lg-4"> <input NoTab="true" id="key_value" name="key_value" type="text" class="form-control" placeholder="Key Value" disabled /></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="tab-pane" id="service">
                            <div class="box-body">
                                <div class="col-lg-12">
                                    <div class="col-lg-7">
                                        <div class="box-body">
                                            <table class="table table-striped table-condensed col-lg-6">
                                                <thead>
                                                    <tr>
                                                        <td colspan="6"><?= label('Additional Ledger', $this, $user) ?> </td>
                                                        <td colspan="1"><?= label($taxtype, $this, $user) ?>%</td>
                                                        <td colspan="2"><?= label('Service Amount', $this, $user) ?></td>
                                                        <td colspan="2"><?= label($taxtype, $this, $user) ?> <?= label('Amount', $this, $user) ?> </td>
                                                        <td colspan="1"><?= label('Action', $this, $user) ?>
                                                        <td>
                                                    </tr>

                                                </thead>
                                                <tbody id="rows">
                                                    <tr id="addservice">
                                                        <td colspan="6"> <input type="hidden" NoTab="true" tabindex="-1" name="ser_ledgerid" id="ser_ledgerid" /><input NoTab="true" id="ser_ledger" class="form-control" type="text" placeholder="<?= label('Ledger', $this, $user) ?>" /></td>
                                                        <td colspan="1"><input type="hidden" NoTab="true" tabindex="-1" name="ser_taxid" id="ser_taxid" /><select tabindex="-1" id="ser_tax" class="form-control">
                                                                <option value="">Select</option>
                                                            </select>
                                                        </td>
                                                        <td colspan="2"> <input style='height:25px' id="ser_amt" type="text" class="form-control text-right  two-digits price " placeholder="<?= label('Service Amount', $this, $user) ?>" /></td>
                                                        <td colspan="2"> <input id="ser_taxamt" type="text" readonly="readonly" class="form-control  text-right two-digits" placeholder="<?= label($taxtype, $this, $user) ?> <?= label('Amount', $this, $user) ?> " /></td>
                                                        <!--                                        hidden-->
                                                        <td colspan="1"> <button data-toggle="tooltip" type="button" title="Add To save" class="btn btn-success" href="#">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-striped table-condensed">
                                                <tr>
                                                    <td></td>
                                                    <td> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?></td>
                                                    <td><?= label('Total', $this, $user) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class='col-lg-4'></td>
                                                    <td class='col-lg-2'></td>
                                                    <td class='col-lg-2'></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><input name="sertaxtotal" id="sertaxtotal" placeholder="Total Tax" value="0" readonly="readonly" type="text" class="text-right  form-control"></td>
                                                    <td><input name="sergtotal" id="sergtotal" placeholder="Grand Total" value="0" readonly="readonly" type="text" class="text-right  form-control"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="box-body">
                                            <table class="table table-striped table-condensed col-lg-6">
                                                <thead>
                                                    <th style="text-align:left" colspan="1"><?= label('Select Coupon', $this, $user) ?></th>
                                                    <td colspan="11"> <input name="Coupon" id="Coupon" type="text" NoTab="true" data-validation-length="min2" class="form-control" placeholder="Coupon" /></td>
                                                    <tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= label('Coupon', $this, $user) ?></td>
                                                        <td><?= label('Amount', $this, $user) ?></td>
                                                        <td><?= label('Action', $this, $user) ?></td>
                                                    </tr>
                                                <tbody id="rowcoupon">
                                                    <tr id="add">
                                                    </tr>
                                                </tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->.
                    <?php if ($is_bkground_print == 1) { ?>
                        <div style="display:none">
                            <?= label('Printers', $this, $user) ?>
                        </div>
                        <div style="display:none">
                            <select style="height: 25px" id="myprinter" name="myprinter[]" class="form-control select2" multiple="multiple" data-placeholder="Select Printers" style="width: 100%;">
                            </select>
                        </div>
                    <?php } ?>
                    <div style="padding-left:30px;<?php if ((int) $print_size < 1) {
                                                        echo 'display:none;';
                                                    } ?>">
                        <?= label('Print Size', $this, $user) ?>
                    </div>
                    <div style="padding-left:30px;<?php if ((int) $print_size < 1) {
                                                        echo 'display:none;';
                                                    } ?>">
                        <select id="paper_size" name="paper_size" class="form-control" data-placeholder="Select Printers" style="padding-left:30px !important;width: 20%;">
                            <option value="full">FULL</option>
                            <option value="half">HALF</option>
                        </select>
                    </div>

                    <?php if(strtolower($this->session->userdata('login_base_comid')) == 'everest' || strtolower($this->session->userdata('login_base_comid')) == 'mrlk' ){?>
                        <div style="padding-left:30px;">
                        <?= label('Auto Print', $this, $user) ?>
                    </div>
                    <div style="padding-left:30px;">
                        <select id="is_auto_print" name="is_auto_print" class="form-control" data-placeholder="Select Printers" style="padding-left:30px !important;width: 20%;">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>
                    </div>
                    <?php } ?>
                    <?php if (ucfirst($viewtype) != 'View') { ?>
                                                <?php if ($is_edit >  0) { ?>

                        <div class="box-footer">
                            <button id="form-button-save" type='button' data-toggle="tooltip" title='Save' class='form-button-save btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>

                        </div>
                        <?php }?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <input name="advance" id="advance" placeholder="Advance" type="hidden" class="tatalcal text-right  form-control">
</form>
<div class="modal fade " tabindex="-1" id="modelextra" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <textarea class="form-control " cols="20" id="txtExtra"></textarea>
            </div>
            <div class="modal-footer">
                <button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtram" class="btn btn-success" href="#">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
                <button type="button" id="btncls" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet"
          type="text/css"
          href="<?php echo base_url(); ?>assets/css/jquery-confirm.css"/>
<script src="<?php echo base_url(); ?>assets/js/jquery-confirm.js"></script>




<script>

    $(document).on('change', '#is_tcs', function() {
        if ($(this).is(':checked')) {
            $('#tcs_percentage').prop('readonly', false).val('').focus();
            calculateGTotal();
        } else {
            $('#tcs_percentage').prop('readonly', true).val(0);
            calculateGTotal();
        }
        
    });


var unit_array = [];
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/get_unitcounts'); ?>",
                    type: 'post',
                    async: false,
                    success: function(result) {
                        unit_array = JSON.parse(result);
                        console.log('unit_array'+unit_array[1])
                    }
                });

    $('.itemsqft').keydown(function(event) {
        $('#sqft_number').val(0);
        $('#sqft_quantity').val('');
        $('#sqft_quantity').trigger('change');
        $('#sqftunit').val('');
        var last_sqftunit = $('#last_sqftunit').val();
        $('#sqftunit').val(last_sqftunit);
        event.preventDefault();  // Prevent typing in the field
        var itemsqft = $('#itemsqft').val();
        $('#sqftrowid').val(0);
        $('#item_SQFT').val(itemsqft);
        // Show the modal
        $('#modal-sqft').modal('show');
        $('#sqft_quantity').focus();
    });
    
    $(document).on("keydown", ".rowitemsqft", function(e) { 
        event.preventDefault(); 
        var attrid = $(this).attr('attrid');
        var itemSQFTNO = $('#itemSQFTNO'+attrid).val();
        var itemItemSQFT = $('#itemItemSQFT'+attrid).val();
        var sqft_quantity = $('#itmqty'+attrid).val();
        var my_itemdescription  = $('#itmdtn'+attrid).val();
        $('#sqftunit').val(my_itemdescription);
        $('#sqftrowid').val(attrid);
        $('#sqft_number').val(itemSQFTNO);
        $('#item_SQFT').val(itemItemSQFT);
        $('#sqft_quantity').val(sqft_quantity);
        $('.clssqftmodal').trigger('change');
        $('#modal-sqft').modal('show');
        $('#sqft_quantity').focus();
    });

</script>
<?php $login_comid = $this->session->userdata('login_base_comid'); ?>
<script src="<?php echo base_url(); ?>asset/plugins/select2/select2.full.min.js"></script>
<script>
</script>
<script type="text/javascript">
    	let isFocused = false;

$(document).on("keydown", ".tditmqty", function(e) {
    if (e.keyCode === 13 || e.keyCode === 9) {
        if (!isFocused) {
            isFocused = true; // Mark that we have focused an element
            
            // You can use a timeout to allow for focus change without blocking
            setTimeout(function() {
                $('#itemname').focus(); // Focus on #itemname after a short delay
                $('#itemcode').focus(); // Focus on #itemcode

                isFocused = false; // Reset the flag for future key presses
            }, 0);
        }
    }
});

		$(document).on("keydown",".adddiscount ",function(e) {
        if(e.keyCode === 68){
            e.preventDefault();
            var attr = $(this).attr('attr');
           

                    $('#modal_discount_rowid').val(attr);

                    var quantity = $('#itmqty'+attr).val();
                    var prate_item = $('#itmrate'+attr).val();
                    var add_dis_per = $('#adddisper'+attr).val();
                    $('#add_dis_per').val(add_dis_per);
                    if(quantity ===''){
                        quantity = 0;
                    }
                    var mrp_item =  $('#itmmrp'+attr).val();
                    if(mrp_item ===''){
                        mrp_item = 0;
                    }
                    var total = parseFloat(quantity) * parseFloat(mrp_item);
                    if(parseFloat(total) > 0  && parseFloat(prate_item) > 0  ){
                        var dis = parseFloat(total) * parseFloat(prate_item)/100;
                        var total = parseFloat(total) - parseFloat(dis);
                        $('#add_dis_to').html(total);
                        $('#add_dis_to_amt').val(total);
                        $('#add_dis_per').trigger('change');
                        $('#add_unit_dis').attr('style','');
                        $('#add_unit_dis_add').attr('style','display:none;');
                        $("#modal-discount").modal();

                    }


        }else{
            if(e.keyCode === 8 ){

            }else{
                var validkeys = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0','.'];
                if (validkeys.indexOf(e.key) < 0)
                    return false;
            }
        }
    });
	
	
	$(document).on("change",".tditmqty",function() {
		var tr = $(this).closest('tr');
		
		var tditmmrp = $(tr).find('.tditmmrp').val();
		var trindex = $(this).attr('attrid');
		var item_id = $(tr).find('.tditmid').val();
		var item_qty = $(this).val();
        <?php if($quantity_price > 0 ){?>
		$.ajax({
					url: "<?php echo site_url('inventory_master/Item/get_item_quantity_price'); ?>/" + item_id,
					success: function(result) {
						$.each(JSON.parse(result), function(i, itemsingle) {
							if(itemsingle.qprice_type === "above"){
								if(parseFloat(item_qty) > parseFloat(itemsingle.qprice_above) ){
									$(tr).find('.tditmmrp').val(itemsingle.qprice_rate);
									calculaterowdis(trindex);
								}
							}
							
							if(itemsingle.qprice_type === "below"){
								if(parseFloat(item_qty) < parseFloat(itemsingle.qprice_below) ){
									$(tr).find('.tditmmrp').val(itemsingle.qprice_rate);
									calculaterowdis(trindex);
								}
							}
							
							if(itemsingle.qprice_type === "between"){
								if(parseFloat(item_qty) <= parseFloat(itemsingle.qprice_max) &&  parseFloat(item_qty) >= parseFloat(itemsingle.qprice_min) ){
									$(tr).find('.tditmmrp').val(itemsingle.qprice_rate);
									calculaterowdis(trindex);
								}
							}
							
							
						});
					}
				});
        <?php }?>
              
	});

	var date2 = '';
    function loadpoints(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/load_points'); ?>/" + id,
            success: function(result) {
                $.each(JSON.parse(result), function(i, itemsingle) {
                    var min_point_to_redeem = itemsingle.min_point_to_redeem;
                    var points = itemsingle.points;
                    var total_points = itemsingle.points;
                    if (parseFloat(points) > parseFloat(min_point_to_redeem)) {
                        points = points / itemsingle.one_currency_equivalent;
                        $('#total_points').val(total_points);
                        $('#one_currency_equivalent').val(itemsingle.one_currency_equivalent);
                        points = points.toFixed(0);
                        $('#reedemable').html('Points :' + total_points + ' , Redeemable Amount :' + points + '');
                        $('#reedemable_amunt').val(points);
                    } else {
                        $('#reedemable').html('Redeemable : 0 ');
                        $('#reedemable_amunt').val(0);
                    }
                });
            }

        });
    }

    function checkstatus(ui) {
        var credit_period_exceed = ui.item.credit_period_exceed;
        var credit_amount = ui.item.credit_amount;
        var credit_amount_exceed = ui.item.credit_amount_exceed;
        var is_ban = 0;
        var text = "";
        var is_exceed = 0;


        $.ajax({
            url: "<?php echo site_url('ajaxcall/checkCustomerstatus'); ?>/" + ui.item.id,
            success: function(results) {
                var result = JSON.parse(results);
                $('#is_warning').val(result.warning);
                $('#is_ban').val(result.ban);
                var ban = result.ban;
                var warning = result.warning;
                var ban_text = result.ban_text;
                $('#btncontinue').attr('style','');
                var warning_text = result.warning_text;
                if(parseFloat(ban) > 0 ){
                    $('#credittxt').html(ban_text);
                    $('#btncontinue').attr('style','display:none');
                    $('#creditmodal').modal('show');
                    var login_comid = $('#login_comid').val();
                    if(login_comid === 'kmtrading'){
                        $('#btncontinue').attr('style','display:none;');
                    }

                }else if(parseFloat(warning) > 0){
                    $('#credittxt').html(warning_text);

                    if(login_comid === 'kmtrading'){
                        $('#btncontinue').attr('style','display:none;');
                    }


                    $('#creditmodal').modal('show');
                    
                }

                var credit_amount = result.credit_amount;
                if(parseFloat(credit_amount) > 0  ){
                    var bal = result.bal;
                    if(parseFloat(bal) >=credit_amount  ){
                        $('#credittxt').html("Customer Ledger Balance Exceed it's limits");
                        $('#creditmodal').modal('show');
                    }
                }

            }
        });



        // $.ajax({
        //     url: "<?php echo site_url('ajaxcall/checkstatus'); ?>/" + ui.item.id,
        //     success: function(results) {
        //         var result = JSON.parse(results)[0];
        //         if (parseFloat(result.is_exceed) > 0) {
        //             is_ban = credit_period_exceed;
        //             is_exceed = 1;
        //         }
        //         if (parseFloat(credit_amount) < parseFloat(result.amount)) {
        //             if (parseFloat(is_ban) < 1) {
        //                 is_ban = credit_amount_exceed;
        //                 is_exceed = 1;
        //             }
        //         }
        //         if (parseFloat(is_exceed) > 0) {
        //             if (parseFloat(is_ban) > 0) {
        //                 calert('This Customer is Banned Due to  Exceeding  Credit Limits');
        //                 text = "This Customer is Banned Due to  Exceeding  Credit Limits Contact Admin for Further Details";
        //             } else {
        //                 text = "This Customer is  Exceeded his Credit Limits";
        //                 calert('This Customer is  Exceeded his Credit Limits');
        //             }
        //             $('#credittxt').html(text);
        //             if (parseFloat(is_ban) < 1) {
        //                 $('#creditmodal').modal('show');
        //             } else {
        //                 $('#btndiscontinue').trigger('click');
        //             }

        //         }

        //     }
        // });
    }
    $(function() {
        $('.select2').select2();
    });
    //messages 
    function calert(msg) {
        toastr["error"](msg);
    }

    function changeinvoice() {
        document.getElementById("b_no").contentEditable = true;

    }
    var inc_inary = 0;
    //class
    function item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate, is_taxincuded, margin, item_discription, barcode, analytics, analyticsname, row_cess, row_cess_amount, size, size_name, itembatch, free_qty, itm_fre_qty, itm_fre_qty_for, item_rate, item_ces_id, item_ces_per, item_ces_name, item_row_ces, actual_quantity, damage_quantity, sales_ref_id, sales_ref_type,emei,emei_pur_id,item_landing_cost,unit_qty,itm_mrp,itm_srate,itm_whrate,itm_spclrate,add_dis_per,add_dis_amt,pindex,SQFTNO,ItemSQFT,salitms_mrp,reorder_point,godown_stock,cig_ces_per,unit_cig_ces_amt,cig_ces_per_amount,cig_ces_amt,item_tax_on_mrp) {

        inc_inary = parseInt(inc_inary) + 1;
        this.reorder_point = reorder_point;
        this.cig_ces_per = cig_ces_per;
        this.item_tax_on_mrp = item_tax_on_mrp;
        this.unit_cig_ces_amt = unit_cig_ces_amt;
		this.cig_ces_per_amount = cig_ces_per_amount;
		this.cig_ces_amt = cig_ces_amt;
        this.godown_stock = godown_stock;
		this.pindex = pindex;
        this.ItemSQFT = ItemSQFT;
        this.SQFTNO = SQFTNO;
		this.itm_mrp = itm_mrp;
		this.itm_srate = itm_srate;
		this.itm_whrate = itm_whrate;
        this.salitms_mrp = salitms_mrp;
		this.itm_spclrate = itm_spclrate;
		
		this.add_dis_per = add_dis_per;
        this.add_dis_amt  = add_dis_amt;
		
		
        this.inc_id = inc_inary;
		this.unit_qty = unit_qty;
        this.item_ces_id = item_ces_id;
        this.sales_ref_id = sales_ref_id;
        this.sales_ref_type = sales_ref_type;
		this.emei = emei;
		this.item_landing_cost = item_landing_cost;
		this.emei_pur_id = emei_pur_id;
        this.item_ces_per = item_ces_per;
        this.damage_quantity = damage_quantity;
        this.actual_quantity = actual_quantity;
        this.item_ces_name = item_ces_name;
        this.item_row_ces = item_row_ces;
        this.item_id = item_id;
        this.item_rate = item_rate;
        this.itembatch = itembatch;
        this.free_qty = free_qty;
        this.itm_fre_qty = itm_fre_qty;
        this.itm_fre_qty_for = itm_fre_qty_for;
        this.item_qty = item_qty;
        this.row_cess = row_cess;
        this.size = size;
        this.size_name = size_name;
        this.row_cess_amount = row_cess_amount;
        this.margin = margin;
        this.analyticsname = analyticsname;
        this.analytics = analytics;
        this.barcode = barcode;
        this.unit_item = unit_item;
        this.godown = godown;
        this.dis_amt = dis_amt;
        this.tax_item = tax_item;
        this.tax_amount = tax_amount;
        this.item_discription = item_discription;
        this.mrp_item = mrp_item;
        this.prate_item = prate_item;
        this.itemname = itemname;
        this.comontax = comontax;
        this.is_taxincuded = is_taxincuded;
        this.rowTotal = rowTotal;
        this.commission = commission;
        this.unit_name = unit_name;
        this.godown_name = godown_name;
        this.tax_name = tax_name;
        this.pur_rate = pur_rate;
    }
    //class array
    var items = new Array();

    function clear() {
        clearValue($("#row_cess_amount"));
        clearValue($("#row_sqft"));
        clearValue($("#row_cess"));
        clearValue($("#item_id"));
        clearValue($("#item_qty"));
        clearValue($("#itemcode"));
        clearValue($("#unit_item"));
        clearValue($("#godown"));
        clearValue($("#dis_amt"));
        clearValue($("#tax_item"));
        clearValue($("#mrp_item"));
        clearValue($("#prate_item"));
        clearValue($("#itemname"));
        $('#free_qty').val(0.00);
        $('#txtExtra').val('');
        $("#prate").html('');
        $("#current_stock").html('');
        clearValue($("#rowTax"));
        clearValue($("#rowTotal"));
        var is_godown = $("#is_godown").val();
        if (is_godown === '1') {
            $('#godown').html('');
        }
    }

    function clearservice() {
        clearValue($("#ser_ledger"));
        clearValue($("#ser_ledgerid"));
        clearValue($("#ser_amt"));
        clearValue($("#ser_taxamt"));
    }

    function additemcode(event, id) {
        var x = event.which || event.keyCode;
        if (x === 13) {
            itemsearchbyid(id);
            $('#myDropdownhide').click();
        }
    }

    function additmcode(id) {
        itemsearchbyid(id);
        $('#myDropdownhide').click();
    }

    function itemsearchbyid(id) {
        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemsearchbyid/' + id,
            function(result) {
                $.each(result, function(i, field) {
                    $("#itemname").val(field.name);
                    $("#item_landing_cost").val(field.landing_cost);
					$("#emei").val('');
					$("#emei_pur_id").val('0');
                    $("#itembatch").html(field.itembatch);
                    $("#item_free_qty").val(field.free_qty);
                    $("#item_free_qty_for").val(field.free_qty_for);
                    var additional_cess = $('#additional_cess').val();
                    var ces_id = 0;
                    var ces_percent = 0;
                    var ces_name = '';
                    if (parseFloat(additional_cess) > 0) {
                        ces_id = field.ces_id;
                        ces_percent = field.ces_percent;
                        ces_name = field.ces_name;
                    }
                    $('#item_ces_per').val(ces_percent);
                    $('#item_ces_id').val(ces_id);
                    $('#item_ces_name').val(ces_name);
                    var is_itemcode = $("#is_itemcode").val();
                    if (is_itemcode === "1") {
                        $("#itemcode").val(field.barcode);
                    }
                    var pindex = 0 ;

                    var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
                    var item_tax_on_mrp = 0 ;
                    if(purchase_tax_on_mrp > 0 ){
                        item_tax_on_mrp = field.tax_on_mrp;
                    }
                    $('#item_tax_on_mrp').val(item_tax_on_mrp);


                    itemSelect(field.MRP, field.dis, field.srate, field.prate, field.wh_rate, field.price_code, field.currentstk, field.tax_id, field.id, field.commission, field.unit_id, field.barcode, field.tax_id, '', field.id,field.itembatch,pindex);
                });

            });

    }

    function addrowtocoupon(cou_id, cou_code, cou_discountp, cou_discount) {
        var amount = cou_discount;
        var singrow = '<td class="col-lg-4"> <input data-validation="required" value=' + cou_id + ' type="hidden" name="copid[]" id="copid[]"/>' +
            ' <input name="couname[]" id="couname[]" type="text" NoTab="true" disabled value=' + cou_code + '    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Key"></td>' +
            ' <td class="col-lg-4"> <input  NoTab="true" disabled  id="cou_value"  value=' + amount + '  name="cou_value"  type="text"    class="form-control" placeholder="Coupon Value"/></td>' +
            '<td><span data-toggle="tooltip"   title="Remove" onclick="removecoupon(this)" couamt=' + amount + ' class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowcoupon").append(newRow);
    }

    function setrequired(type) {
        var customer = $('#supid').val();
        $("#supname").attr('data-validation-length', 'min2');
        $("#supname").attr('data-validation', 'required,length');
        $("#supid").attr('data-validation', 'required');

        if (customer === "") {
            var supname = $("#supname").val();
            if (supname === "") {

            } else {

                var exist = 0;
                $.ajax({
                    url: "<?php echo site_url('transaction/Sales/check_customer'); ?>",
                    method: 'post',
                    async: false,
                    data: {
                        supname: supname
                    },
                    success: function(result) {
                        $.each(JSON.parse(result), function(i, itemsingle) {
                            exist = 1;
                        });
                    }
                });
                if (parseFloat(exist) > 0) {
                    calert('Customer Already Exist');
                    $('#supname').val('');
                } else {
                    $("#supid").removeAttr('data-validation', 'required');
                    $("#supname").removeAttr('data-validation-length', 'min2');
                    $("#supname").removeAttr('data-validation', 'required,length');
                }
            }

        }
    }

    function addrow(id, key, value, page) {
        var singrow = '<td class="col-lg-4"> <input data-validation="required" value=' + id + ' type="hidden" name="keyid" id="keyid"/>' +
            ' <input name="keyname" id="keyname[]" type="text" NoTab="true" value=' + key + '    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Key"></td>' +
            ' <td class="col-lg-4"> <input  NoTab="true"   id="key_value"  value=' + value + '  name="key_value"  type="text"    class="form-control" placeholder="Key Value"/></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rown").append(newRow);
    }

    function setpaytype() {
        $(".bankdiv").attr("style", "display: none;padding:3px;");
		$('input[type=radio][name=bank_pay_method]').trigger('change');
        $("#supid").removeAttr('data-validation', 'required');
        $("#supname").removeAttr('data-validation-length', 'min2');
        $("#supname").removeAttr('data-validation', 'required,length');
        var cash_amount = $('#cash_amount').val();
        var bank_amount = $('#bank_amount').val();
        var total = $('#gtotal').val();
        $('#pending_amount').val('0.00');
        var payed = parseFloat(parseInt(bank_amount) + parseInt(cash_amount)).toFixed(company_roundoff);
        if (payed > total) {
            //            cash_amount = 0.00;
            //            bank_amount = 0.00;
            //            $('#cash_amount').val(0);
            //            $('#bank_amount').val(0);
            //            $('#pending_amount').val(total);
        }
        if (cash_amount !== "" && cash_amount > 0 && bank_amount !== "" && bank_amount > 0) {
            $(".bankdiv").attr("style", "display: block;padding:3px;");
            var payed = parseFloat(parseInt(bank_amount) + parseInt(cash_amount)).toFixed(company_roundoff);
            if (parseFloat(payed).toFixed(company_roundoff) === parseFloat(total).toFixed(company_roundoff)) {
                $('#type').val('COB');
                var ctype = $('#btype').find(':selected').attr('Cash');
                $('#paytype').val(ctype);
            } else {
                $('#type').val('Ba_Ca_Cr');
                var ctype = $('#btype').find(':selected').attr('Cash');
                $('#paytype').val(ctype);
                setrequired('Ba_Ca_Cr');
                var pending_amount = parseFloat(parseInt(total) - parseInt(payed));
                $('#pending_amount').val((pending_amount).toFixed(company_roundoff));

            }
        } else if (cash_amount !== "" && cash_amount > 0) {
            if (parseFloat(cash_amount).toFixed(company_roundoff) === parseFloat(total).toFixed(company_roundoff)) {
                $('#type').val('Cash');
                var ctype = $('#btype').find(':selected').attr('Cash');
                $('#paytype').val(ctype);
                $('#supname').focus();
                var key = jQuery.Event('keypress');
                key.keyCode = $.ui.keyCode.ENTER;
                $('#txtb').trigger(key);
            } else {
                $('#type').val('Ca_Cr');
                setrequired('Ca_Cr');
                var ctype = $('#btype').find(':selected').attr('Cash');
                $('#paytype').val(ctype);
                var pending_amount = parseFloat(parseInt(total) - parseInt(cash_amount));
                $('#pending_amount').val((pending_amount).toFixed(company_roundoff));

            }
        } else if (bank_amount !== "" && bank_amount > 0) {
            $(".bankdiv").attr("style", "display: block;padding:3px;");
            if (parseFloat(bank_amount).toFixed(company_roundoff) === parseFloat(total).toFixed(company_roundoff)) {
                $('#type').val('Bank');
                var btype = $('#bank_account').val();
                $('#paytype').val(btype);
            } else {
                $('#type').val('Ba_Cr');
                setrequired('Ba_Cr');
                var btype = $('#bank_account').val();
                $('#paytype').val(btype);
                var pending_amount = parseFloat(parseInt(total) - parseInt(bank_amount));
                $('#pending_amount').val((pending_amount).toFixed(company_roundoff));

            }
        } else {
            $('#pending_amount').val(total);
            //$('#type').val('Credit');
            var ctype = $('#btype').find(':selected').attr('Cash');
            $('#paytype').val(ctype);
            if (total < 1) {
                //$('#type').val('Cash');
            } else {
                setrequired('Credit');

            }
        }
		
		set_payment_div();
    }
	
	function set_payment_div(){
		var type = $('#type').val();
		if(type !== 'Cash' && type !== 'Credit' && type !== 'Ca_Cr'){
			$('.bankdiv').attr('style','display:block;padding:3px;');
			var value = $("input:radio[name=bank_pay_method]:checked").val()
			if(value === 'gpay'){
					$(".gpaydiv").attr("style", "display: block;padding:3px;");
					$(".carddiv").attr("style", "display: none;padding:3px;");
                    <?php if($gpay_number_required > 0 ){?>
                        $('#gpay_number').attr('data-validation', 'required');
                    <?php }?>
			}
			if(value === 'Card'){
				$(".carddiv").attr("style", "display: block;padding:3px;");
				$(".gpaydiv").attr("style", "display: none;padding:3px;");
                 $('#gpay_number').attr('data-validation', '');
			}
		}else{
			$('.bankdiv').attr('style','display:none;padding:3px;');
			$('.gpaydiv').attr('style','display:none;padding:3px;');
             $('#gpay_number').attr('data-validation', '');
			$('.carddiv').attr('style','display:none;padding:3px;');
		}
	}

    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '') {
            val = 0;
        }
        return val;
    }
    /*
         load customer details here 
         */
    function loadCustByid(id,ctype="new") {
        loadpoints(id);
        $.ajax({
            url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
            success: function(results) {
                var result = JSON.parse(results)[0];
                $('#supname').val(result.name);
                $('#gst').val(result.tin);
                //                $('#states').val(result.cst);
                var bill_dis_per = result.bill_dis_per ?? 0;
                var row_dis_per = result.row_dis_per ?? 0;
                $('#bill_dis_per').val(bill_dis_per);
                $('#row_dis_per').val(row_dis_per);
                var bill_discount = $('#bill_discount').val();
				if(ctype === "new"){
                    if(bill_dis_per > 0  && bill_discount >  0){
                        $('#bill_discount_per').val(bill_dis_per);
                    }
                    var UnitPriceMargin = $('#UnitPriceMargin').val();
                    if(UnitPriceMargin > 0 ){
                        $('#txtglobalitemdis').val(result.PriceMargin);
                    }
					$('#saletype').val('b2c');
                    $('#bname').val(result.name);

					if (result.tin !== "") {
						if (result.tin.length > 10) {
							$('#saletype').val('b2b');
						}else{
							$('#saletype').val('b2c');
						}
					}
				}
				var cus_rate = result.cus_rate;
				$('#cus_rate').val(cus_rate);
				if(cus_rate !== ''){
					$('#set_rate').val(cus_rate);
				}
                $('#area').val(result.area);
                $('#route').val(result.route);
                $('#supid').val(result.id);
                $('#phone').val(result.phone);
				if(ctype === "new"){
                    $('#con_name').val(result.name);
                    $('#con_contact').val(result.phone);
                    $('#con_addr').val(result.address_line1);
                    $('#con_state').val(result.cst);
                    $('#con_gst').val(result.tin);
                }
                $('#address_line1').val(result.address_line1);
                $('#cst').val(result.cst);
                $('#tin').val(result.tin);
                $('#address_line1').val(result.address_line1);
                $('#address_line2').val(result.address_line2);
                $('#details').val(result.details);
                $("#frmcreate").isValid();

            }
        });
    }

    function loadCust(ui) {

        var bill_dis_per = ui.item.bill_dis_per ?? 0;
        var row_dis_per = ui.item.row_dis_per ?? 0;
        $('#bill_dis_per').val(bill_dis_per);
        $('#row_dis_per').val(row_dis_per);
        var bill_discount = $('#bill_discount').val();
        if(bill_dis_per > 0  && bill_discount >  0){
            $('#bill_discount_per').val(bill_dis_per);
            console.log('bill_dis_per'+bill_dis_per);
        }   

        var UnitPriceMargin = $('#UnitPriceMargin').val();
        if(UnitPriceMargin > 0 ){
            $('#txtglobalitemdis').val(ui.item.PriceMargin);
        }

        $('#saletype').val('b2c');
        $('#supname').val(ui.item.name);
        $('#gst').val(ui.item.tin);
        //        $('#states').val(ui.item.cst);
        if (ui.item.tin !== "") {
            if (ui.item.tin.length > 10) {
                $('#saletype').val('b2b');
                calculateGTotal();
            }
        }
		var cus_agent = ui.item.cus_agent;
		var cus_salesman = ui.item.cus_salesman;
		if(cus_salesman !== ''  && parseFloat(is_cashe) < 1 ){
			$('#salesman').val(cus_salesman);
		}
		if(cus_agent !== '' ){
			$('#reference').val(cus_agent);
		}
		var cus_rate = ui.item.cus_rate;
		$('#cus_rate').val(cus_rate);
		if(cus_rate !== ''){
			$('#set_rate').val(cus_rate);
		}
        $('#area').val(ui.item.area);
        $('#route').val(ui.item.route);
        $('#saletype').trigger('change');
        $('#stcode').val(ui.item.code);
        $('#bname').val(ui.item.name);
        $('#con_name').val(ui.item.name);
        $('#con_contact').val(ui.item.phone);
        $('#con_addr').val(ui.item.address_line1);
        $('#con_gst').val(ui.item.tin);
        $('#con_state').val(ui.item.cst);
        $('#supid').val(ui.item.id);
        $('#phone').val(ui.item.phone);
        $('#address_line1').val(ui.item.email);
        $('#cst').val(ui.item.cst);
        $('#tin').val(ui.item.tin);
        $('#address_line1').val(ui.item.address_line1);
        $('#address_line2').val(ui.item.address_line2);
        $('#details').val(ui.item.details);
        $('#itemname').focus().select();
        calculateGTotal();
    }
    /*
     * load items from db
     */
    $.ajax({
        url: "<?php echo site_url('ajaxcall/size'); ?>",
        success: function(result) {
            $('#item_size').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/salesman'); ?>",
        success: function(result) {
            $('#salesman').html(result);
            var user_id = $('#user_id').val();
            $('#salesman').val(user_id);
            <?php if($salesman_required >0 ){?>
                $('#salesman option[value="0"]').val('');
            <?php }?>
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/bank'); ?>",
        success: function(result) {
            $('#bank_account').html(result);
			var def_bank = $('#def_bank').val();
			if(parseFloat(def_bank) > 0 ){
				$('#bank_account').val(def_bank);
			}
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/myprinter'); ?>",
        success: function(result) {
            $('#myprinter').html(result);
            $(".select2").val(["1", "2"]);
        }
    });

    $.ajax({
        url: "<?php echo site_url('ajaxcall/get_saleskey/sales'); ?>",
        success: function(results) {
            $.each(JSON.parse(results), function(i, itemsingle) {
                addrow(itemsingle.id, itemsingle.key, itemsingle.value, itemsingle.page);
            });
        }
    });
    $('.new-invoice').on('DOMFocusOut', function() {
        var newinvoice = $('#b_no').text();
        var oldinvoice = $('#iv_no').text();
        var suffix = $('#btype').find(':selected').attr('suffix');
        var prefix = $('#btype').find(':selected').attr('preffix');
        var seperator = $('#btype').find(':selected').attr('seperator');
        if (newinvoice !== '') {
            var invoice = prefix + seperator + newinvoice + seperator + suffix;
            $.ajax({
                url: "<?php echo site_url('transaction/sales/alreadyexistcheck'); ?>",
                type: 'POST',
                data: {
                    field1: invoice
                },
                success: function(result) {
                    var invoice = result;
                    if (parseFloat(invoice) > 0) {
                        newinvoice = oldinvoice;
                        calert('Invoice Already Exist');
                    }
                    $("#new_invoice").val(newinvoice);
                    $('#b_no').html(newinvoice);
                    $("#new_invoice").val(prefix + seperator + newinvoice + seperator + suffix);
                }
            });
        } else {
            $('#b_no').html(oldinvoice);
        }


    });
	 $("#date").change(function() {
        var type = $("#saletype").val();
        $(".disper").each(function() {
            var ids = $(this).attr('id');
            calculaterowdis(ids.split("itmrate")[1]);
            id = id + 1;
        });
        calculateGTotal();
    });
    $("#saletype").change(function() {
        var type = $("#saletype").val();
        $(".disper").each(function() {
            var ids = $(this).attr('id');
            calculaterowdis(ids.split("itmrate")[1]);
            id = id + 1;
        });
        calculateGTotal();
    });
    $("#txtglobalmrp").change(function() {
        var txtglobalmrp = $("#txtglobalmrp").val();
        $.each(items, function(i) {
            var amount = $("#item_rate" + items[i].inc_id).val();
            if (parseFloat(txtglobalmrp) > 0) {
                var itmmrp = amount / txtglobalmrp;
                $("#itmmrp" + items[i].inc_id).val(itmmrp.toFixed(company_roundoff));
                calculaterow(items[i].inc_id);
            } else {
                $("#itmmrp" + items[i].inc_id).val(amount);
                calculaterow(items[i].inc_id);
            }
        });
    });

    $("#txtglobalitemdis").change(function() {
        var txtglobalitemdis = $("#txtglobalitemdis").val();
        $.each(items, function(i) {
            var amount = $("#item_rate" + items[i].inc_id).val();
            if(txtglobalitemdis == ''){
                txtglobalitemdis = 0;
            }
            if (parseFloat(txtglobalitemdis) != 0) {
                var itmmrp = parseFloat(amount) * parseFloat(txtglobalitemdis) /100 ;
                itmmrp = parseFloat(amount) + parseFloat(itmmrp);
                $("#itmmrp" + items[i].inc_id).val(parseFloat(itmmrp).toFixed(company_roundoff));
                calculaterow(items[i].inc_id);
            } else {
                $("#itmmrp" + items[i].inc_id).val(amount);
                calculaterow(items[i].inc_id);
            }
        });
    });
	
	
	$('input[type=radio][name=bank_pay_method]').change(function() {
        if(this.value === 'gpay'){
			$(".gpaydiv").attr("style", "display: block;padding:3px;");
			$(".carddiv").attr("style", "display: none;padding:3px;");
            <?php if($gpay_number_required > 0 ){?>
                $('#gpay_number').attr('data-validation', 'required');
            <?php }?>
		}
		if(this.value === 'Card'){
			$(".carddiv").attr("style", "display: block;padding:3px;");
			$(".gpaydiv").attr("style", "display: none;padding:3px;");
             $('#gpay_number').attr('data-validation', '');
		}
	});


    $("#txtglobaldiscount").change(function() {
        var dis_per = $("#txtglobaldiscount").val();
        if (dis_per === "") {
            dis_per = 0;
        }
        $(".disper").each(function() {
            $(this).val(dis_per);
            var ids = $(this).attr('id');
            calculaterowdis(ids.split("itmrate")[1]);
            id = id + 1;
        });
        calculateGTotal();
    });
    $("#bank_amount").change(function() {
        var type = $("#type").val();
        var gtotal = $("#gtotal").val();
        setpaytype();
        //        if (type === "COB") {
        //            var bank_amount = $("#bank_amount").val();
        //            var cash_amount = parseInt(gtotal) - parseInt(bank_amount);
        //            $("#cash_amount").val(cash_amount);
        //        }

    });
    $("#cash_amount").change(function() {
        var type = $("#type").val();
        var gtotal = $("#gtotal").val();
        setpaytype();
        //        if (type === "COB") {
        //            var cash_amount = $("#cash_amount").val();
        //            var bank_amount = parseInt(gtotal) - parseInt(cash_amount);
        //            $("#bank_amount").val(bank_amount);
        //        }
        //        if (type === "Ca_Cr") {
        //            var cash_amount = $("#cash_amount").val();
        //            var pending_amount = parseInt(gtotal) - parseInt(cash_amount);
        //            $("#pending_amount").val(pending_amount);
        //        }

    });
    $("#unit_item").change(function() {
        var myTag = $(this).find(':selected').attr('count');
        var mrp = $("#unitvalue").val();
        myTag = myTag * mrp;
        $('#mrp_item').val(myTag);
    });
    $("#godown").change(function() {
        var myTag = $('#godown').find(':selected').attr('stock');
        $("#i_stock").html("Stock: " + myTag);

    });
    $("#states").change(function() {
		var code = $(this).find(':selected').attr('code');
		$('#stcode').val(code);
    });
    $("#discount").click(function() {

    });
    $("#discount").change(function() {
        //      

    });

    function chndis(discount) {
        var total = $('#gtotal').val();
        if (discount === "") {
            discount = 0;
        }
        var dis_per = ((parseFloat(discount) * 100) / parseFloat(total));
        var id = 1;
        $(".disper").each(function() {
            $(this).val(dis_per);
            var ids = $(this).attr('id');
            calculaterowdis(ids.split("itmrate")[1]);
            id = id + 1;
        });
        calculateGTotal();
    }
    $("#unit_item").change(function() {

        var myTag = $(this).find(':selected').attr('count');
        var pur_rate = $('#pur_rate').val();
        pur_rate = pur_rate * myTag;
        var mrp = $("#unitvalue").val();
        myTag = myTag * mrp;
        $('#mrp_item').val(myTag);
        $('#unit_pur_rate').val(pur_rate);
    });
    $("#type").change(function() {
        var total = $('#gtotal').val();
        if ($(this).val() === 'Cash') {
            $('#bank_amount').val(0.00);
            $('#cash_amount').val(total);
            $('#pending_amount').val(0.00);
        } else if ($(this).val() === 'Bank') {
            $('#bank_amount').val(total);
            $('#cash_amount').val(0.00);
            $('#pending_amount').val(0.00);
        } else if ($(this).val() === 'Credit') {
            $('#bank_amount').val(0.00);
            $('#cash_amount').val(0.00);
            $('#pending_amount').val(total);
        }
        setpaytype();
    });
    $("#is_tax").change(function() {
        var is_tax = $("#is_tax").val();
        $("#is_taxincuded").val(is_tax);
        is_taxincuded = is_tax;
    });
    $("#supname").change(function() {
        setpaytype();
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/area'); ?>",
        success: function(result) {
            $('#area').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
        success: function(result) {
            $('#Costcenter').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/analyticscenter'); ?>",
        success: function(result) {
            $('#analyticscenter').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/route'); ?>",
        success: function(result) {
            $('#route').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/vehicle'); ?>",
        success: function(result) {
            $('#vehicle').html(result);
			var is_cashe = $('#is_cashe').val();
			var id = $("#id").val();
			if( parseFloat(is_cashe) > 0  && id === "0" ){
					var result = readCookie('<?php echo $login_comid.$type; ?>createSales');
					if (result != null) {
						results = JSON.parse(result);
						 $.each(results, function (index, value) {
							 $('#btype').val(value.btype);
							 $('#vehicle').val(value.vehicle);
							 $('#salesman').val(value.salesman);
						 });
					}
			}
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/reference'); ?>",
        success: function(result) {
            $('#reference').html(result);
            var copy_id = $('#copy_id').val();
            if ($("#id").val() !== '0') {
                load_items($("#id").val());
            } else if (parseFloat($("#deliver_note_id").val()) > 0) {
                load_items($("#deliver_note_id").val(), $('#estimate_type').val());
            }else if(parseFloat(copy_id) > 0 ){
                load_items(copy_id);
            }
        }
    });
	
	

    function getbtype(btypeid,ptype = 0) {
        $.ajax({
            url: "<?php echo site_url('transaction/sales/getprinttype'); ?>/" + btypeid,
            async: false,
            success: function(results) {
                var result = JSON.parse(results);
				if(ptype < 1 ){
					$('#printtype').val(result.id);
				}
                //$("#item_qty").focus();
            }
        });
    }
    

    function load_items(id, stype = '') {
        var tot = 0;
        var cashamt = 0;
        var bankamt = 0;
        var ser_tax = 0;
        var copy_id = $('#copy_id').val();
        if (id !== '0') {

            var selectedValues = '';
            $.ajax({
                url: "<?php echo site_url('ajaxcall/getprinters'); ?>/" + id,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
                        if (i < 1) {
                            selectedValues = selectedValues + itemsingle.printer_id;
                        } else {
                            selectedValues = selectedValues + ',' + itemsingle.printer_id;
                        }

                    });
                }

            });
        }
        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/service_items'); ?>/" + id,
				async:false,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
                        tot = parseFloat(tot) + parseFloat(itemsingle.amount) + parseFloat(itemsingle.tax);
                        ser_tax = parseFloat(ser_tax) + parseFloat(itemsingle.tax);
                        $('#sertaxtotal').val(ser_tax);
                        $('#sergtotal').val(tot);
                        addrowtoservice(itemsingle.amount, itemsingle.tax_id, itemsingle.GST, itemsingle.tax, itemsingle.name, itemsingle.ledger_id);

                    });
                }
            });
            // $.ajax({
            //     url: "<?php echo site_url('ajaxcall/sale_coupon'); ?>/" + id,
            //     success: function(result) {
            //         $.each(JSON.parse(result), function(i, itemsingle) {
            //             addrowtocoupon(itemsingle.cou_id, itemsingle.cou_code, itemsingle.cou_discountp, itemsingle.amount);
            //         });
            //     }
            // });


            $.ajax({
                url: "<?php echo site_url('ajaxcall/sales_items'); ?>/" + id,
				async:false,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
                        <?php if($is_tcs > 0 ){?>
                            if(itemsingle.tcs_amount > 0 ){
                                $('#tcs_percentage').val(itemsingle.tcs_per);
                                 $('#is_tcs').prop('checked', true);
                            }
                        <?php }?>
                        var est_qty = 0;
						var onsync_discount = $('#onsync_discount').val();
                        var is_mobile = itemsingle.is_mobile;
                        var prate_item = itemsingle.rate;
						var itemdiscount = itemsingle.itemdiscount;
                        var ttype = $("#copy").val();
                        $('#bill_discount').val(itemsingle.is_discount_per);
                        $('#is_auto_print').val(itemsingle.is_auto_print);
                        if(itemsingle.is_discount_per > 0 ){
                            $('#bill_discount_per').val(itemsingle.discount_per);
                        }
                        $('#scheme_desc').val(itemsingle.schemedesc);
                        $('#scheme_from').val(itemsingle.schemefrom);
                        $('#scheme_till').val(itemsingle.schemetill);
                        if (ttype === "copy") {
                            $("#id").val(0);
                        }
                        var estid = $("#id").val();
                        if (estid !== '0') {
                            $('#txtEstimate_id').val(itemsingle.estimate_id);

                        }
                        if ($('#txtEstimate_id').val() !== "0" && parseFloat(itemsingle.quantity) <= parseFloat(itemsingle.estimate_quantity)) {
                            est_qty = 1;
                            if (itemsingle.type === 'delivery_note' && parseFloat(itemsingle.quantity) > parseFloat(itemsingle.estimate_quantity)) {
                                est_qty = 0;
                            }
                        }
                        var ref_check = 0;
                        if (itemsingle.type === 'delivery_note' && parseFloat(itemsingle.quantity) <= parseFloat(itemsingle.estimate_quantity)) {
                            est_qty = 1;
                        }
                        if ($('#txtEstimate_id').val() !== "0") {
                            ref_check = 1;
                        }
                        if (stype === 'delivery_note') {
                            ref_check = 1;
                        }
                        if(parseFloat(ref_check) > 0 &&  parseFloat(onsync_discount) > 0 && parseFloat(is_mobile) > 0  ){
							prate_item = itemdiscount;
						}
                        if (parseFloat($('#id').val()) < 1  && parseFloat(ref_check) > 0 && parseFloat(itemsingle.quantity) > parseFloat(itemsingle.estimate_quantity)) {
                            var mrp_item = itemsingle.mrp;
                            var taxamount = 0;
                            var quantity = parseFloat(itemsingle.quantity) - parseFloat(itemsingle.estimate_quantity);
                            itemsingle.quantity = quantity;
                            var total = parseFloat(mrp_item) * parseFloat(quantity);
                            if (itemsingle.rate !== "0.00") {
                                var discount = (parseFloat(total) * parseFloat(prate_item)) / 100;
                                var total = parseFloat(total) - parseFloat(discount);
                                itemsingle.dis_amt = discount;

                            }
                            if (itemsingle.is_taxincluded === "0") {
                                taxamount = (parseFloat(total) * parseFloat(itemsingle.tname)) / 100;
                                itemsingle.tax = taxamount;
                            }
                            if (itemsingle.is_taxincluded === "1") {
                                taxamount = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(itemsingle.tname) + 100));
                                itemsingle.tax = parseFloat(taxamount).toFixed(company_roundoff);;
                            }


                        }else if(parseFloat($('#id').val()) < 1  && parseFloat(ref_check) > 0 &&  parseFloat(onsync_discount) > 0 && parseFloat(is_mobile) > 0  ){
							//var mrp_item = itemsingle.mrp;
                            var prate_item = itemsingle.rate;
							if(parseFloat(ref_check) > 0 &&  parseFloat(onsync_discount) > 0 && parseFloat(is_mobile) > 0  ){
								 prate_item = itemdiscount;
							}
                            var taxamount = 0;
                            var quantity = parseFloat(itemsingle.quantity) - parseFloat(itemsingle.estimate_quantity);
                            itemsingle.quantity = quantity;
                            var total = parseFloat(mrp_item) * parseFloat(quantity);
                            if (itemsingle.rate !== "0.00") {
                                var discount = (parseFloat(total) * parseFloat(prate_item)) / 100;
                                var total = parseFloat(total) - parseFloat(discount);
                                itemsingle.dis_amt = discount;

                            }
                            if (itemsingle.is_taxincluded === "0") {
                                taxamount = (parseFloat(total) * parseFloat(itemsingle.tname)) / 100;
                                itemsingle.tax = taxamount;
                            }
                            if (itemsingle.is_taxincluded === "1") {
                                taxamount = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(itemsingle.tname) + 100));
                                itemsingle.tax = parseFloat(taxamount).toFixed(company_roundoff);;
                            }

						
						}
						var current_sales_id = $('#id').val();
						if(parseFloat(current_sales_id) > 0 && parseFloat(copy_id) < 1  ){
							      $('#date').val(itemsingle.in_date);
									$("#ddate").val(itemsingle.ddate);
                                      $('#b_no').html(itemsingle.invoice);
									//$('#printtype').val(itemsingle.printtype);
									$('#btype').val(itemsingle.bill_type);
									var set_rate = $('#btype').find(':selected').attr('set_rate');
									$('#set_rate').val(set_rate);

						}
                        if (i < 1 && parseFloat(copy_id) < 1) {


                            $('#buyer_order_no').val(itemsingle.buyer_order_no);
							//$('#kilometers').val(itemsingle.kms);
							$('#other_ref').val(itemsingle.other_ref);
                            $('#exporter_ref').val(itemsingle.exporter_ref);
							$('#dollar_value').val(itemsingle.dollar_value);
							$('#buyer').val(itemsingle.buyer);
							$('#pre_carriage').val(itemsingle.pre_carriage);
							$('#place_of_receipt').val(itemsingle.place_of_receipt);
							$('#flight_no').val(itemsingle.flight_no);
							$('#port_of_landing').val(itemsingle.port_of_landing);
							$('#port_of_discharge').val(itemsingle.port_of_discharge);
							$('#final_destination').val(itemsingle.final_destination);
							$('#country_final_destination').val(itemsingle.country_final_destination);
							$('#country_origin_of_goods').val(itemsingle.country_origin_of_goods);
							$('#payment_term').val(itemsingle.payment_term);
							$('#shipping_terms').val(itemsingle.shipping_terms);


							$('#redeem_points').val(itemsingle.redeemed_points);
                            $('#redeem_amount').val(itemsingle.redeemed_amount);
                            $('#del_place').val(itemsingle.place);
                            $('#vehicle_txt').val(itemsingle.vehicle_no);
                            $('#mode_of_transport').val(itemsingle.transport_mode);
                            $('#sales_ref_no').val(itemsingle.ref_no);
                            $('#receipt_amount').val(itemsingle.receipt_amount);
                            $("#is_taxincuded").val(itemsingle.is_taxincluded);
                            $("#is_tax").val(itemsingle.is_taxincluded);
                            //                            if (itemsingle.cash_type === "COB") {
                            //                                $("#payment_div").attr("style", "display: block;");
                            //                                $("#cash_div").attr("style", "display: block;");
                            //
                            //                            } else if (itemsingle.cash_type === "Bank") {
                            //                                $("#payment_div").attr("style", "display: block;");
                            //                                $("#cash_div").attr("style", "display: none;");
                            //                                $("#bank_amount").attr("readonly", "readonly");
                            //                            }
                            $('#txtglobalmrp').val(itemsingle.global_mrp);
                            $('#card_number').val(itemsingle.card_no);
                            $('#bank_ref_code').val(itemsingle.bank_ref);
                            $('#type').val(itemsingle.cash_type);
							$('#due_date').val(itemsingle.sale_due_date);
                            cashamt = itemsingle.cash_amount;
                            bankamt = itemsingle.bank_amount;
                            if (itemsingle.bank_id !== "0") {
                                $('#bank_account').val(itemsingle.bank_id);
                            }
                            $('#adjustment').val(itemsingle.adjustment_amount);
                            $('#col_amt').val(itemsingle.collected_amount);
                            $('#gpay_number').val(itemsingle.gpay_no);
                            if ($('#txtEstimate_id').val() === "0") {
                                $('#btype').val(itemsingle.bill_type);
                                $('#b_no').html(itemsingle.invoice);
                                console.log('b_no:'+itemsingle.invoice );
								 $("input[name=bank_pay_method][value=" + itemsingle.bank_pay_method + "]").prop('checked', true);


								var set_rate = $('#btype').find(':selected').attr('set_rate');
								$('#set_rate').val(set_rate);
                            }
                            if (itemsingle.customer_id !== "0" && itemsingle.customer_id !== "") {
                                loadCustByid(itemsingle.customer_id,'old');
                            } else {
                                $('#supname').val(itemsingle.cusname);
                                $('#phone').val(itemsingle.cusdetails);
                                $('#address_line1').val(itemsingle.cusemail);
                            }
                            getbtype(itemsingle.bill_type,1);


                        }
                        $('#distance').val(itemsingle.distance);
                        if(parseFloat(copy_id) < 1 ){
                            $('#tms_con').val();
                            $('#tms_con').val(itemsingle.terms_condition);
                            // $('#des_det').val();
                            // $('#des_det').val(itemsingle.despatch_details);
                            $('#states').val(itemsingle.cusstate);
                            $('#packing_details').val(itemsingle.packing_details);
                            $('#gst').val(itemsingle.cusgst);
                            $('#con_name').val(itemsingle.con_name);
                            $('#con_addr').val(itemsingle.con_addr);
                            $('#paper_size').val(itemsingle.paper_size);
                            $('#con_contact').val(itemsingle.con_contact);
                            $('#con_gst').val(itemsingle.con_gst);
                            $('#con_state').val(itemsingle.con_state);
                            $('#freight').val(itemsingle.freight);
                            $('#stcode').val(itemsingle.statecode);
                            $('#advance').val(itemsingle.advance);
                            $('#driver').val(itemsingle.driver);
                            $('#ewbno').val(itemsingle.ewb_no);
                            $('#ewbdetails').val(itemsingle.ewb_details);
                            $('#other').val(itemsingle.other);
                            var is_bata = $('#is_bata').val();
                            if(parseFloat(is_bata) > 0  ){
                                $('#transit_fee').val(itemsingle.transit_fee);
                                $('#bata').val(itemsingle.bata);
                            }
                            $('#exc_ref').val(itemsingle.adjustment_ref);
                            $('#Invoice').val(itemsingle.invoice);
                            $('#discount').val(itemsingle.dis);
                            $('#cash_status').val(itemsingle.cash_status);
                            $('#reference').val(itemsingle.ref_id);
                            $('#area').val(itemsingle.area);
                            $('#salesman').val(itemsingle.salesman);
                            $('#remarks').val(itemsingle.remarks);
                            $('#route').val(itemsingle.route);
                            $('#vehicle').val(itemsingle.vehicle);
                            $('#tax_led_id').val(itemsingle.tax_id);
                            $('#type').val(itemsingle.cash_type);
                            $('#saletype').val(itemsingle.saletype);
                            $('.box-title').html(itemsingle.type);
                            $('#bname').val(itemsingle.cusname);
                            $('#phone').val(itemsingle.cusdetails);
                            $('#address_line1').val(itemsingle.cusemail);
                        }
                       
						
                        var size_id = itemsingle.size_id;
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var dis_amt = itemsingle.dis_amt;
                        var unit_item = itemsingle.unitid;
                        var godown = itemsingle.godown_id;
                        var tax_item = itemsingle.taxid;
                        var mrp_item = itemsingle.mrp;
                        var item_discription = itemsingle.item_discription;
                        var itemname = itemsingle.name + ' ' + itemsingle.barcode;
                        var comontax = $("#comontax").val();
                        var is_discount = $("#is_discount").val();
                        var itembatch = itemsingle.batch;
                        var is_taxincluded = itemsingle.is_taxincluded;
						
						
						var itm_mrp = itemsingle.MRP;
                        $('#sale_mrp').val(itm_mrp);
						var itm_srate = itemsingle.srate;
						var itm_whrate = itemsingle.wh_rate;
						var itm_spclrate = itemsingle.special_rate;
						var item_landing_cost = itemsingle.item_landing_cost;
						
						
                        var tax_amount = itemsingle.tax;
                        var ces = itemsingle.ces;
                        var rowTotal = ((parseFloat(itemsingle.mrp) * parseFloat(itemsingle.quantity)) - itemsingle.dis_amt).toFixed(company_roundoff);
                        if (is_discount === '1') {}
                        if (is_taxincluded === "0") {
                            rowTotal = (parseFloat(rowTotal) + parseFloat(tax_amount)).toFixed(company_roundoff);
                        }

                        itemsingle.total;
                        var commission = itemsingle.item_commission;
                        var barcode = itemsingle.barcode;
                        var unit_name = itemsingle.uname;
                        var godown_name = itemsingle.godown_name;
                        var tax_name = itemsingle.tname;
                        var analytics = itemsingle.analytics;
                        var analyticsname = itemsingle.analyticsname;
                        var free_qty = itemsingle.free_quantity;
						var mar_pur_rate = itemsingle.mar_pur_rate;
                        var pur_rate = itemsingle.item_rate;
                        var amount = parseFloat(rowTotal).toFixed(company_roundoff);
                        if (is_taxincluded === "0") {
                            amount = parseFloat(rowTotal - tax_amount).toFixed(company_roundoff);
                        }
						
						
                        dis_amt = parseFloat(dis_amt).toFixed(company_roundoff);
                        tax_amount = parseFloat(tax_amount).toFixed(company_roundoff);
                        var cess_amount = parseFloat(rowTotal) - parseFloat(tax_amount);
                        var row_cess = 0;
                        var item_rate = itemsingle.item_rate;
                        var size_name = "";
                        var item_ces_id = itemsingle.itm_ces_id;
                        var item_ces_per = itemsingle.itm_ces_per;
                        var item_ces_name = itemsingle.itm_ces_name;
                        var item_row_ces = itemsingle.itm_raw_ces;
                        if (size_id > 0) {
                            var size_name = $("#item_size [value=" + size_id + "]").text();
                        }
                        if (parseFloat(ces) > 0) {
                            row_cess = parseFloat(cess_amount) * parseFloat(ces) / 100;
                        }
                        item_row_ces = 0;
                        if (parseFloat(cess_amount) > 0 && parseFloat(item_ces_per) > 0) {
                            item_row_ces = parseFloat(cess_amount) * parseFloat(item_ces_per) / 100;
                        }

                        var  cig_ces_per =  0;
                        var unit_cig_ces_amt = 0  ;
                        var cig_ces_per_amount =  0;
                        var cig_ces_amt = 0;
                        var is_cigarette_cess = $('#is_cigarette_cess').val();
                        if(is_cigarette_cess > 0 ){
                            var cig_ces_per = itemsingle.unit_cig_ces_per;
                            var unit_cig_ces_amt = itemsingle.unit_cig_ces_amt;
                            var cig_ces_per_amount = 0;
                            var cig_ces_amt = 0;
                            if(parseFloat(unit_cig_ces_amt) > 0  ){
                                            cig_ces_amt = parseFloat(unit_cig_ces_amt) * parseFloat(item_qty);
                            }
                            if(parseFloat(cig_ces_per) > 0  && parseFloat(cess_amount) > 0 ){
                                            cig_ces_per_amount = parseFloat(cess_amount) * parseFloat(cig_ces_per) / 100;
                            }

                        }
                        

                        rowTotal = parseFloat(rowTotal) + parseFloat(item_row_ces);
                        var itm_fre_qty = itemsingle.free_quantity;
                        var itm_fre_qty_for = itemsingle.itm_fre_qty_for;
                        var damage_quantity = itemsingle.damage_quantity;
                        var actual_quantity = itemsingle.actual_quantity;
                        var sales_id = $('#id').val();
                        if (parseFloat(sales_id) < 1) {
                            damage_quantity = 0;
                            actual_quantity = item_qty;
                        }
                        if (stype === '') {
                            sales_ref_type = itemsingle.sales_ref_type;
                            sales_ref_id = itemsingle.sales_ref_id;
                        } else {
                            sales_ref_id = itemsingle.sales_id;
                            sales_ref_type = stype;
                        }
						amount = parseFloat(rowTotal - tax_amount - item_row_ces).toFixed(company_roundoff);
						console.log(amount);
						if( parseFloat(is_taxincluded) > 0  && itemsingle.saletype == 'b2c'){
							console.log('here');
							amount = parseFloat(amount) - parseFloat(row_cess);
						}
						console.log(row_cess);
                        var p_pur_rate = mar_pur_rate * itemsingle.base_unit_count;
                        var margin = parseFloat(p_pur_rate * item_qty).toFixed(company_roundoff);
                        var margin = parseFloat(amount - margin).toFixed(company_roundoff);
						console.log(margin);
						var emei = itemsingle.emei;
						var emei_pur_id = itemsingle.emei_pur_id;
						var item_landing_cost = 0;
						var item_landing_cost = itemsingle.item_landing_cost;
						var unit_qty = itemsingle.unit_qty;
						var pindex = itemsingle.pindex;
                        var SQFTNO = itemsingle.SQFTNO;
                        var ItemSQFT =itemsingle.ItemSQFT;
                        var reorder_point = 0 ;
                        var stock = 0 ;
                        var salitms_mrp = itemsingle.salitmsmrp;
                        $('#pindexid').val(pindex);
						var add_dis_per = itemsingle.add_dis_per ;
                        var add_dis_amt = itemsingle.add_dis_amt;
                        
                        var item_tax_on_mrp = 0 ;
                        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();
                        if(parseFloat(purchase_tax_on_mrp) > 0  ){
                            var item_tax_on_mrp = itemsingle.sales_tax_on_mrp;
                        }  

                        $('#sale_mrp').val(salitms_mrp);
                        if (est_qty === 0 || parseFloat(itemsingle.free_quantity) > 0  ) {
                            var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, mar_pur_rate, is_taxincluded, margin, item_discription, barcode, analytics, analyticsname, ces, row_cess, size_id, size_name, itembatch, free_qty, itm_fre_qty, itm_fre_qty_for, item_rate, item_ces_id, item_ces_per, item_ces_name, item_row_ces, actual_quantity, damage_quantity, sales_ref_id, sales_ref_type,emei,emei_pur_id,item_landing_cost,unit_qty,itm_mrp,itm_srate,itm_whrate,itm_spclrate,add_dis_per,add_dis_amt,pindex,SQFTNO,ItemSQFT,salitms_mrp,reorder_point,stock,cig_ces_per,unit_cig_ces_amt,cig_ces_per_amount,cig_ces_amt,item_tax_on_mrp);
                            addrowtoTable(iteadd);
                            items.push(iteadd);
                            $("#Costcenter").val(itemsingle.cost_center);
                            $("#rowTotal").val(0.0);
                            $('#itmqty' + idinc).trigger('change');
                            calculateGTotal();
                            $("#itemname").focus();
                            ref();
                            $('.myspop').popover();
                        }
                    });
                    $('#bank_amount').val(bankamt);
                    $('#cash_amount').val(cashamt);
                    setpaytype();
					//if(itemsingle.cusstate !== 0 && itemsingle.cusstate !== ''){
						//var code = $('#states').find(':selected').attr('code');
						//$('#stcode').val(code);
					//}
                }
            });

        }

    }

    function calculateGTotal(is_dis_amt =0) {
		var date1 = $('#date').val();
		date1 = formatdates(date1);
		var exceedcessdate = 0 ;
		if(date1 > date2){
			exceedcessdate = 1;
		}
		console.log(exceedcessdate);
        var itmCommission = 0 ;
        var tot_cig_ces_amt = 0;
        var tot_cig_per_ces_amt = 0 ;
        var is_adjustment = $('#is_adjustment').val();
        var cash_amount = $("#cash_amount").val();
        var bank_amount = $("#bank_amount").val();
        var totalpayed = parseFloat(cash_amount + bank_amount);
        var total = 0;
        var tax = 0;
        var commi = 0;
        var totrate = 0;
        var itmno = 0;
        var bmargin = 0;
        var discount = 0;
        var j = 0;
        var cess = 0;
        var itm_net_ces = 0;
        var tax_included = $('#is_tax').val();
        $.each(items, function(i) {
            var is_cigarette_cess = $('#is_cigarette_cess').val();
            j = j + 1;
            itmno = itmno + 1;
            tax_included = items[i].is_taxincuded;
            $("#itmno" + items[i].inc_id).val(itmno.toFixed(0));
            cess = parseFloat(cess) + parseFloat(items[i].row_cess_amount);
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            bmargin = parseFloat(bmargin) + parseFloat(items[i].margin);
            if (items[i].item_row_ces !== undefined) {
                itm_net_ces = parseFloat(itm_net_ces) + parseFloat(items[i].item_row_ces);
            }
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
            totrate = parseFloat(totrate) + parseFloat(items[i].mrp_item);
            discount = parseFloat(discount) + parseFloat(items[i].dis_amt);
            // commi = parseFloat(commi) + parseFloat(total) * parseFloat(items[i].commission) / 100;
            if(is_cigarette_cess > 0 ){
                tot_cig_ces_amt = parseFloat(tot_cig_ces_amt) + parseFloat(items[i].cig_ces_amt);
                tot_cig_per_ces_amt = parseFloat(tot_cig_per_ces_amt) + parseFloat(items[i].cig_ces_per_amount);
            }
            var com = parseFloat(items[i].commission);
            if(com === undefined || com === '' ){
                com = 0;
            }
            if(com > 0 ){
                itmCommission = parseFloat(itmCommission) + (parseFloat(items[i].rowTotal) - parseFloat(items[i].tax_amount) ) * parseFloat(com) / 100;
                // alert(itmCommission);
                commi = parseFloat(commi) + parseFloat(itmCommission);
                $('#sales_commission').val(commi);
            }
        });
        <?php if($is_com > 0) {?>
        $('#span_commission').html('IC : '+itmCommission);
        $('#sales_commission').val(itmCommission);
        <?php } ?>
        var is_round_off = $('#is_round_off').val();
        var roundoffs = company_roundoff;
        if (parseFloat(is_round_off) > 0) {
            roundoffs = 0;
        }
        $('#itm_net_ces').val(itm_net_ces.toFixed(company_roundoff));
        var saletype = $('#saletype').val();
        var ces = 0.00;
        if (saletype === "b2c" && exceedcessdate < 1 ) {
            ces = cess.toFixed(company_roundoff);
        }
        var adjustment = 0;
        if ($('#adjustment').val() !== "" && $('#adjustment').val() !== undefined) {
            adjustment = $('#adjustment').val();
        }

        $("#tot_cig_ces_amt").val(parseFloat(tot_cig_ces_amt).toFixed(2));
        $("#tot_cig_per_ces_amt").val(parseFloat(tot_cig_per_ces_amt).toFixed(2));


        $("#tot_cess").val(parseFloat(ces).toFixed(company_roundoff));
        $("#billmargin").val(bmargin);
        $("#b_mgn").html("B M: " + bmargin.toFixed(company_roundoff));
        $("#totnolist").val(j);
        $("#rowdis").val(discount.toFixed(company_roundoff));
        //        $("#discount").val(discount.toFixed(company_roundoff));
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        $("#total").val(total.toFixed(company_roundoff));
        $("#totsaletax").val(tax.toFixed(company_roundoff));
        tax = parseFloat(tax) + parseFloat(tottax);
        $("#taxtotal").val(tax.toFixed(company_roundoff));
        var freight = getVal("freight");
        var other = getVal("other");
        var bata = 0 ;
        var transit_fee = 0;
        var is_bata = $('#is_bata').val();
        if(parseFloat(is_bata) > 0  ){
           // bata = $('#bata').val();
           // transit_fee = $('#transit_fee').val();
            // if(bata ===''){
            //     bata = 0 ;
            // }
            // if(transit_fee ===''){
            //     transit_fee = 0 ;
            // }
        }

       
      
        var redeem_amount = $('#redeem_amount').val();
        if (redeem_amount === "" || redeem_amount === null || redeem_amount === undefined) {
            redeem_amount = 0;
        }
        //+ parseFloat(tax) tax included in rate
        if (parseFloat(tax_included) > 0) {
            var gtotal = parseFloat(total) + parseFloat(totamt) + parseFloat(freight) + parseFloat(bata) + parseFloat(transit_fee) + parseFloat(other) ;
        } else {
            var gtotal = parseFloat(total) + parseFloat(totamt) + parseFloat(freight) + parseFloat(bata) + parseFloat(transit_fee) + parseFloat(other)  + parseFloat(ces);
        }
        gtotal = parseFloat(gtotal) - parseFloat(redeem_amount);
        
        
        var bill_discount = $('#bill_discount').val();
        if(bill_discount > 0 ){
            var bill_discount_per = 0 ;
            if(is_dis_amt == 1 ){
                var discount = getVal("discount");
                discount = $("#discount").val();
                if (discount === "") {
                    discount = 0;
                }

                if(discount > 0 ){
                    bill_discount_per =  (discount / gtotal) * 100;
                }
                $('#bill_discount_per').val(bill_discount_per);
            }else{
                var discount = 0;
                var bill_discount_amount = 0;
                var  bill_discount_per =  $('#bill_discount_per').val();
                if (bill_discount_per === "") {
                    bill_discount_per = 0;
                }
                if(bill_discount_per > 0 ){
                    discount = gtotal * bill_discount_per / 100;
                }
                $("#discount").val(discount);
            }
        }else{
            var discount = getVal("discount");
            discount = $("#discount").val();
            if (discount === "") {
                discount = 0;
            }
        }

        gtotal = parseFloat(gtotal) -parseFloat(discount);
        
        var totrate = parseFloat(gtotal) -parseFloat(tot_cig_ces_amt) - parseFloat(tot_cig_per_ces_amt) - parseFloat(tax) - parseFloat(itm_net_ces) - parseFloat(ces);
        $("#totrate").val(totrate.toFixed(company_roundoff));
        var tcs_amount = 0;
        var is_tcs = $('#is_tcs').val();
        if(is_tcs > 0 ){
            var tcs_percentage = $('#tcs_percentage').val();
            if(tcs_percentage == ''){
                tcs_percentage = 0;
            }
            if(tcs_percentage > 0 &&  gtotal > 0 ){

                tcs_amount = gtotal * tcs_percentage / 100;
                gtotal = gtotal + tcs_amount; 
            }
            $('#tcs_amount').val(parseFloat(tcs_amount).toFixed(2));
        }
        //gtotal = parseFloat(gtotal) + parseFloat(tot_cig_ces_amt) + parseFloat(tot_cig_per_ces_amt);
        var rount = (parseFloat(gtotal.toFixed(roundoffs)) - parseFloat(gtotal.toFixed(company_roundoff))).toFixed(company_roundoff);
        var adjustment_bal = parseFloat(gtotal - adjustment);
        $('#exc_bal').val(adjustment_bal.toFixed(roundoffs));
        $("#gtotal").val(parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff));


        var receipt_amount = $('#receipt_amount').val();
        var receipt_balance = parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff);
        var receipt_entry = $('#receipt_entry').val();
        if (receipt_amount !== undefined && receipt_amount !== "" && receipt_amount !== null && parseFloat(receipt_entry) > 0) {
            receipt_balance = receipt_balance - receipt_amount;
        }
        if (parseFloat(receipt_entry) > 0) {
            $('#receipt_balance').val(receipt_balance);
        }
        var cash_type = $("#type").val();
        if (cash_type === "Bank") {
            $("#bank_amount").val(parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff));
        }
        if (cash_type === "Cash") {
            $("#cash_amount").val(parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff));
        }
		if (cash_type === "Credit") {
			$("#cash_amount").val(0);
			$("#bank_amount").val(0);
		}

        setpaytype();
        var is_that = $("#is_that").val();
        if (is_that === '1') {
            var bal_amt = parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff);
            var collected = $("#col_amt").val();
            if (collected !== "") {
                var bal_amt = parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff);
                bal_amt = parseFloat(bal_amt) - parseFloat(collected).toFixed(company_roundoff);
                if (parseFloat(is_adjustment) > 0) {
                    bal_amt = parseFloat(adjustment_bal) - parseFloat(collected).toFixed(company_roundoff);
                }
            }
            $("#bal_amt").val(bal_amt);
        }
        $("#rount").val(rount);
        var reference = getVal('reference');
        if (reference !== 0 && reference !== null && reference !== undefined && reference !== "" && reference !== '0') {
           // $("#commi_amt").show();
            $("#commi_amt").val(0.00);
            if (!isNaN(commi)) {
                $("#commi_amt").val(commi.toFixed(company_roundoff));
            }
        } else {
            $("#commi_amt").hide();
            $("#commi_amt").val(0);
        }
        ref();
        $('.myspop').popover();
        showbtn(1);
    }

    function validate(item_id) {
        var validate = 0;
        $.each(items, function(i) {
            if (items[i].item_id === item_id) {
                validate = 1;
                return validate;
            }
        });
        return validate;
    }

    function insertItems() {
        var pindexid = $('#pindexid').val();
        $('#pindexid').val(0);
		var date1 = $('#date').val();
		date1 = formatdates(date1);
		var exceedcessdate = 0 ;
		if(date1 > date2){
			exceedcessdate = 1;
		}
        var item_id = $("#item_id").val();
        if (item_id === '' || item_id === undefined) {
            $("#itemname").focus();
            return;
        }
        var actual_quantity = $('#actual_quantity').val();
        var damage_quantity = $('#damage_quantity').val();
		var emei = $('#emei').val();
		var emei_pur_id = $('#emei_pur_id').val();
        var item_row_ces = $('#itemcesamt').val();
		console.log($('#itemcesamt').val()+'item_row_ces');
        var txtglobalmrp = $("#txtglobalmrp").val();
        var itembatch = $("#itembatch").val();
        var item_qty = $("#item_qty").val();
        var unit_item = $("#unit_item").val();
        var godown = $("#godown").val();

        var is_godown = $("#is_godown").val();

        if(godown == null){
            if (is_godown === '1') {
                    $.ajax({
                        url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + item_id,
                        type:"POST",
                        async:false,
                        data:{batch:itembatch},
                        success: function (result) {
                            $('#godown').html(result);
                                 godown = $("#godown").val();
                                console.log('godown'+godown);

                        }
                    });
                }
                if (is_godown === '0') {
                    $.ajax({
                        url: "<?php echo site_url('ajaxcall/godown'); ?>",
                        async:false,
                        success: function (result) {
                            $('#godown').html(result);
                             godown = $("#godown").val();
                                console.log('godown'+godown);
                        
                        
                        }
                    });
                }
        }
        var tax_item = $("#tax_item").val();
        var mrp_item = $("#mrp_item").val();
        var mrp = mrp_item;
        if (parseFloat(txtglobalmrp) > 0) {
            mrp = parseFloat(mrp) / parseFloat(txtglobalmrp);
            mrp = parseFloat(mrp).toFixed(company_roundoff);
        }
        var prate_item = $("#prate_item").val();
        var dis_amt = $("#dis_amt").val();
        var itemname = $("#itemname").val();
        var is_itemcode = $("#is_itemcode").val();
        var barcode = "";
        if (is_itemcode === "1") {
            barcode = $("#itemcode").val();
        }
        var row_cess_amount = $("#row_cess_amount").val();
        var row_cess = $("#row_cess").val();
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var tax_amount = $("#rowTax").val();
        var commission = $("#commission").val();
        var pur_rate = $("#unit_pur_rate").val();
        var free_qty = 0;
        var freequantity = $('#freequantity').val();
        if (freequantity === "1") {
            var free_qty = $("#free_qty").val();
        }
        var item_discription = $('#txtExtra').val();
        <?php if(strtolower($this->session->userdata('login_base_comid')) == 'pushpa' ){  ?>
            var item_discription = $('#sqftunit').val();
        <?php }?>
        $('#txtExtra').val('');
        var tax_name = $("#tax_item option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
        var godown_name = $("#godown option:selected").text();
        var is_taxincuded = $("#is_taxincuded").val();
        var size = $('#item_size').val();
        var size_name = $("#item_size option:selected").text();
        var is_size = $('#is_size').val();
        if (is_taxincuded === "0") {
            size_name = "size_name";
        }
        var amount = parseFloat(rowTotal).toFixed(company_roundoff);
		console.log('amount2551'+amount);
        if (parseFloat(is_taxincuded)> 0 ) {
            amount = parseFloat(rowTotal - tax_amount).toFixed(company_roundoff);
			console.log('amount2554'+amount);
        }
		amount = parseFloat(rowTotal - tax_amount).toFixed(company_roundoff);
		console.log('amount2557'+amount);
		console.log(item_row_ces);
		amount = parseFloat(rowTotal - tax_amount - item_row_ces).toFixed(company_roundoff);
		console.log('amount2559'+amount);
		var saletype = $('#saletype').val();
		var singleitemrate =  0 ;
		if(parseFloat(amount) > 0 && parseFloat(item_qty) > 0  ){
			singleitemrate = parseFloat(amount) / parseFloat(item_qty);
		}
		if (parseFloat(is_taxincuded)> 0 && saletype === 'b2c' && exceedcessdate < 1) {
			 amount = parseFloat(amount) - parseFloat(row_cess_amount);
			if(parseFloat(amount) > 0 && parseFloat(item_qty) > 0  ){
				singleitemrate = parseFloat(amount) / parseFloat(item_qty);
			}
		}
        var itm_fre_qty = $('#item_free_qty').val();
        var itm_fre_qty_for = $('#item_free_qty_for').val();
        var margin = parseFloat(pur_rate * item_qty).toFixed(company_roundoff);
        var analyticsname = $("#analyticscenter option:selected").text();
        var analytics = $("#analyticscenter").val();
		console.log('margin_old'+margin);
		console.log('amount'+amount);
        var margin = parseFloat(amount - margin).toFixed(company_roundoff);
		var marginper = 0 ;
		if(singleitemrate > 0 && parseFloat(pur_rate) > 0  ){
			marginper = parseFloat(singleitemrate) - parseFloat(pur_rate); 
			marginper = parseFloat(marginper) * 100 / pur_rate;
		}
		console.log('margin'+margin);
        var item_ces_per = $('#item_ces_per').val();
        var item_ces_name = $('#item_ces_name').val();
        var item_ces_id = $('#item_ces_id').val();
		var unit_qty = $('#unit_qty').val();
        var sales_ref_id = 0;
        var sales_ref_type = 'Nil';
		var item_landing_cost = $('#item_landing_cost').val();
		
		var add_dis_per = $('#add_dis_per').val();
        var add_dis_amt = $('#add_dis_amt').val();
		
		
		var itm_mrp = $('#itm_mrp').val();
		var itm_srate = $('#itm_srate').val();
		var itm_whrate = $('#itm_whrate').val();
		var itm_spclrate = $('#itm_spclrate').val();
		var pindex = 0 ;
        var SQFTNO = $('#sqft_number').val();
        var Is_row_Sqft = $('#Is_row_Sqft').val();
        if(Is_row_Sqft > 0 ){
            var SQFTNO = $('#row_sqft').val();
        }
        var salitms_mrp = $('#salitms_mrp').val();
        var ItemSQFT = $('#item_SQFT').val();
        var reorder_point = 0;
        var stock = 0;
        $.ajax({
                url: "<?php echo site_url('ajaxcall/getitemdetails'); ?>",
                type: 'post',
                async: false,
                data: {
                    item_id: item_id,
                    godown_id:godown
                },
                success: function(result) {
                    var result = JSON.parse(result);
                    reorder_point = result.reorder_point;
                    stock = result.stock;
                }
        });

        if (godown !== null && unit_item !== null && tax_item !== null && tax_item !== "") {
            var  cig_ces_per =  0;
            var unit_cig_ces_amt = 0  ;
            var cig_ces_per_amount =  0;
            var cig_ces_amt = 0;
            var is_cigarette_cess = $('#is_cigarette_cess').val();
            if(is_cigarette_cess > 0 ){
                var cig_ces_per = $('#cig_ces_per').val();
                var unit_cig_ces_amt = $('#unit_cig_ces_amt').val();
                var cig_ces_per_amount = $('#cig_ces_per_amount').val();
                var cig_ces_amt = $('#cig_ces_amt').val();
            }
            var item_tax_on_mrp = $('#item_tax_on_mrp').val();
            
            
            var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate, is_taxincuded, margin, item_discription, barcode, analytics, analyticsname, row_cess, row_cess_amount, size, size_name, itembatch, free_qty, itm_fre_qty, itm_fre_qty_for, mrp_item, item_ces_id, item_ces_per, item_ces_name, item_row_ces, actual_quantity, damage_quantity, sales_ref_id, sales_ref_type,emei,emei_pur_id,item_landing_cost,unit_qty,itm_mrp,itm_srate,itm_whrate,itm_spclrate,add_dis_per,add_dis_amt,pindexid,SQFTNO,ItemSQFT,salitms_mrp,reorder_point,stock,cig_ces_per,unit_cig_ces_amt,cig_ces_per_amount,cig_ces_amt,item_tax_on_mrp);
            addrowtoTable(iteadd);
            items.push(iteadd);
            var id = $("#id").val();
            var copy_id = $("#copy_id").val();
            if (id === "0" && parseFloat(copy_id) < 1 ) {
                localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
            }
            $("#rowTotal").val(0.0);
            $('#rowm').tableNav();
        } else {
            if (tax_item === null) {
                calert("Select Item Tax");
            }else if (unit_item === null) {
                calert("Select Item Unit");
            } else if (godown === null) {
                calert("Select Item Godown");
            } else {
                calert('Set Default Company Settings');
            }
            $("#itemname").focus();
        }
    }

    function customer_alert(name, cashtype) {
        //var ctype = cashtype.toLowerCase();
        //var cname = name.toLowerCase();
        //if (cname === "" && ctype === "credit") {
            //clearValue($("#supname"));
            //            $("#supname").focus();
            //            calert('Customer Required');
       // }
    }

    function showbtn(id) {
        var name = $("#supid").val();
        var cashtype = $("#type").val();
        customer_alert(name, cashtype);
        var gtotal = $("#gtotal").val();
        var cash_amount = $("#cash_amount").val() || 0;
        var bank_amount = $("#bank_amount").val() || 0;
        var payed = parseInt(cash_amount) + parseInt(bank_amount);
        if (id === 0) {
            $('#form-button-save').attr('disabled', 'disabled');
        } else {
            if (items.length === 0) {
                $('#form-button-save').attr('disabled', 'disabled');
            } else {
                $('#form-button-save').removeAttr('disabled');
            }
        }
        var type = $("#type").val();
        var name = $("#supid").val();
        if (type === 'credit' && name === '') {
            $('#form-button-save').attr('disabled', 'disabled');
            $("#itemname").focus();
            calert('Customer Required');
        }
        if (cashtype === "COB") {
            if (parseInt(payed).toFixed(company_roundoff) === parseInt(gtotal).toFixed(company_roundoff)) {
                $('#form-button-save').removeAttr('disabled');
            } else {
                $('#form-button-save').attr('disabled', 'disabled');
            }
        }
        var total = $('#gtotal').val();
        if (total === "" || total === null || total === undefined || total === 0) {
            total = 0;
        }
        if (parseFloat(total) > 0) {
            $('#form-button-save').removeAttr('disabled');
        } else {
            $('#form-button-save').attr('disabled', 'disabled');
        }
    }

    function calculaterowdis(id) {
        console.log('workscalculaterowdis');
        var tax = getVal("itmtaxper" + id);
        var additional_cess = $('#additional_cess').val();
        var tax_before = tax;
        var itm_ces_per = $("#itm_ces_per" + id).val();
        if (parseFloat(additional_cess) > 0 && parseFloat(itm_ces_per) > 0) {
                tax_before = parseFloat(tax) + parseFloat(itm_ces_per);
        }
        is_taxincuded = $("#is_taxincuded" + id).val();


        var is_discount = getVal('is_discount');
        var mrp_item = getVal('itmmrp' + id);
        var qty = getVal("itmqty" + id);
		if(qty === ''){
			qty = 0 ;
		}
		qty = parseFloat(qty);
		qty = qty * 1000;
		qty = parseInt(qty);
		qty = qty / 1000;
		$('#itmqty'+id).val(qty);
        var prate_item = getVal('itmrate' + id);
        var dis_amt = 0;
        if (is_discount === '1') {
            if (prate_item !== '' && prate_item !== '' && qty !== ''){
                if (is_taxincuded === "0") {
                    dis_amt = parseFloat((mrp_item * prate_item * qty) / 100);
                }else{
                    <?php if(strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa' ){?>
                        var mrp_item =  ((parseFloat(mrp_item) * 100) / (parseFloat(tax_before) + 100));
                        dis_amt = parseFloat((mrp_item * prate_item * qty) / 100);
                    <?php }else{?>
                        dis_amt = parseFloat((mrp_item * prate_item * qty) / 100);
                    <?php }?>


                }
            }
        }

        $("#itmdis" + id).val(dis_amt.toFixed(company_roundoff));
        calculaterow(id);
        $('#itemcode').focus();
    }
	
    
	

    function calculatefield() {
        //Discount Calculation
        var tax = $("#tax_item option:selected").attr('percent');
        var additional_cess = $('#additional_cess').val();
        var tax_before = tax;
        var item_ces_per = $('#item_ces_per').val();
        if (parseFloat(additional_cess) > 0 && parseFloat(item_ces_per) > 0) {
            tax_before = parseFloat(tax) + parseFloat(item_ces_per);
        }
        var is_taxincuded = $("#is_taxincuded").val();
        //Discount Calculation

        
        var prate = getVal("prate_item");
        var qty = getVal("item_qty");
        var mrp_item = getVal('mrp_item');
        var dis = 0.00;
        if (mrp_item !== '0' && qty !== '0' && prate !== 0) {
            if (is_taxincuded === "0") {
                dis = mrp_item * qty * prate / 100;
            }else{
                <?php if(strtolower($login_comid) == 'test'  || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa'){?>
                    var mrp_items =  ((parseFloat(mrp_item) * 100) / (parseFloat(tax_before) + 100));
                    dis = mrp_items * qty * prate / 100;
                <?php }else{?>
                    dis = mrp_item * qty * prate / 100;
                <?php }?>

            }

        }
        $("#dis_amt").val(dis.toFixed(company_roundoff));
    }
    $('.ItemMatchBarcode').autoComplete({
        minChars: 2,
        cache: false,
        appendTo: '#mainSale',
        source: function(term, response) {
            $('.itemname').attr('data-placement', 'right');
            $('.itemname').popover('toggle');
            $("[wf-popover]").popover({
                html: true,
                content: function() {
                    var content = $(this).attr("wf-content");
                    //                        alert( $("#discription").text());
                    return content;
                },
                title: function() {
                    var title = $(this).attr("wf-title");
                    //return $(title).children(".popover-heading").html();
                    return title;
                },
                placement: function() {
                    var my = this.$element.attr('wf-popover');
                    return my;
                }
            });
            var customer = '';
            customer = $("#supid").val();
            var btype_branch = $("#btype option:selected").attr('branch_id');
            xhr = $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch_new/Txtbarcode/' + customer + '?', {
                term: term,
                branch:btype_branch
            }, function(data) {
                <?php if( strtolower($this->session->userdata('login_base_comid')) != 'msa' ){?>
                    response(data);
                <?php }else{?>
                    var item = data[0];
                    if (data.length === 1) {

                        var is_continue = 1;
                        var barcode_qty_inc = $('#barcode_qty_inc').val();
                        if(barcode_qty_inc > 0 ){
                            let index = items.findIndex(itemx => itemx.item_id === item.id && item.itembatch == itemx.itembatch);
                            if (index !== -1) {
                                is_continue = 0;
                                var itminc_id = items[index].inc_id;
                                var itmqty = $('#itmqty'+itminc_id).val();
                                itmqty = parseInt(itmqty) + 1;
                                $('#itmqty'+itminc_id).val(itmqty);
                                calculaterowdis(itminc_id);
                                clear();
                                $('#itemcode').focus();
                            }
                        }
                        if(is_continue > 0 ){

                       $('#item_qty').val(1);

                        var additional_cess = $('#additional_cess').val();
                        var ces_id = 0;
                        var ces_percent = 0;
                        var ces_name = '';
                        if (parseFloat(additional_cess) > 0) {
                            ces_id = item.ces_id;
                            ces_percent = item.ces_percent;
                            ces_name = item.ces_name;
                        }

                        var is_cigarette_cess  = $('#is_cigarette_cess').val();
                        var  cig_ces_per =  0;
                        var unit_cig_ces_amt = 0  ;
                        var cig_ces_per_amount =  0;
                        var cig_ces_amt = 0;
                        if(is_cigarette_cess > 0 ){
                            unit_cig_ces_amt = item.cigarette_cess_amount;
                            cig_ces_per  = item.cigarette_cess_percentage;
                        }
                        
                        $('#cig_ces_per').val(cig_ces_per);
			            $('#unit_cig_ces_amt').val(unit_cig_ces_amt);
                        $('#item_ces_per').val(ces_percent);
                        $('#item_ces_id').val(ces_id);
                        $('#item_ces_name').val(ces_name);
                        $('#itembatch').val(item.itembatch);
                        $("#item_landing_cost").val(item.landing_cost);
                        $('#item_free_qty_for').val(item.free_qty_for);
                        $('#item_free_qty').val(item.free_qty);
                        
                        var itm_mrp = item.itm_mrp;
                        var itm_srate = item.p_srate;
                        var itm_whrate = item.p_wh_rate;
                        var itm_spclrate = item.special_rate;
                        
                        $('#itm_mrp').val(itm_mrp);
                        $('#itm_srate').val(itm_srate);
                        $('#itm_whrate').val(itm_whrate);
                        $('#itm_spclrate').val(itm_spclrate);
                        
                        var MRP = item.MRP;
                        var price_code = item.price_code;
                        var currentstk = item.currentstk;
                        var tax_id = item.tax_id;
                        var id = item.id;
                        $("#item_qty").focus();
                        var commission = item.commission;
                        var unit_id = item.unit_id;
                        var barcode = item.barcode;
                        var tax_sales_id = item.tax_sales_id;
                        var tax_sales_id = tax_id;
                        $("#emei").val(item.imei);
                        $("#emei_pur_id").val(item.purchase_id);

                        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
                        var item_tax_on_mrp = 0 ;
                        if(purchase_tax_on_mrp > 0 ){
                            item_tax_on_mrp = item.tax_on_mrp;
                        }
                         $('#item_tax_on_mrp').val(item_tax_on_mrp);
                        
                        itemSelect(MRP, item.p_dis, item.p_srate, item.prate, item.wh_rate, price_code, currentstk, tax_id, id, commission, unit_id, barcode, tax_sales_id, '', id, item.itembatch);
                        rowcalc();
                        $("#itemname").val(item.name);
                        
                        var is_itemcode = $("#is_itemcode").val();
                        if (is_itemcode === "1") {
                            $("#itemcode").val(item.barcode);
                        }
                        add();
                        showbtn(1);
                        $("#itemcode").focus();
                    }


                    }else{
                        response(data);
                    }


                <?php }?>

            });
        },
        renderItem: function(item, search) {
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
            var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
            var set_rate = $('#set_rate').val();
            $('#showrack').html('');
            if(item.racks !== ''){
                $('#showrack').html('Rack : '+item.racks);
            }
            var salerate = item.p_srate;
            var pindex = item.pindex;
            var pricelistid = item.pricelistid;
			var price_discount = item.p_dis;
            if (parseFloat(pricelistid) < 1) {
                if (set_rate === 'MRP') {
                    salerate = item.p_MRP;
                } else if (set_rate === 'wh_rate') {
                    salerate = item.p_wh_rate;
                } else if (set_rate === 'special_rate') {
                     salerate = item.special_rate;
                } else if (set_rate === 'base_rate') {
                    salerate = item.p_base_rate;
                }
            }else{
				price_discount = item.price_discount;
			}
			
			var itm_mrp = item.MRP;
			var itm_srate = item.p_srate;
			var itm_whrate = item.p_wh_rate;
			var itm_spclrate = item.special_rate;
			
            var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
            var item_tax_on_mrp = 0 ;
            if(purchase_tax_on_mrp > 0 ){
                item_tax_on_mrp = item.tax_on_mrp;
            }

return `<div class="autocomplete-suggestion" 
       data-val="${item.label || ''}" 
       data-tax_on_mrp="${item_tax_on_mrp || ''}" 
       data-itm_mrp="${itm_mrp || ''}" 
       data-itm_srate="${itm_srate || ''}" 
       data-itm_whrate="${itm_whrate || ''}" 
       data-itm_spclrate="${itm_spclrate || ''}" 
       data-purchase_id="${item.purchase_id || ''}" 
       data-imei="${item.imei || ''}" 
       data-landing_cost="${item.landing_cost || ''}" 
       data-ces_id="${item.ces_id || ''}" 
       data-ces_percent="${item.ces_percent || ''}" 
       data-ces_name="${item.ces_name || ''}" 
       data-free_qty="${item.free_qty || ''}" 
       data-free_qty_for="${item.free_qty_for || ''}" 
       data-itembatch="${item.itembatch || ''}" 
       data-tax_sales_id="${item.tax_id || ''}" 
       data-unit_id="${item.unit_id || ''}" 
       data-name="${item.name || ''}" 
       data-barcode="${item.barcode || ''}" 
       data-commission="${item.commission || ''}" 
       data-val="${search || ''}" 
       data-tax_id="${item.tax_id || ''}" 
       data-id="${item.id || ''}" 
       data-currentstk="${item.currentstk || ''}" 
       data-price_code="${item.price_code || ''}" 
       data-prate="${item.prate || ''}" 
       data-srate="${salerate || ''}" 
       data-mrp="${item.MRP || ''}" 
       data-wh_rate="${item.wh_rate || ''}" 
       data-dis="${price_discount || ''}">
       ${item.label ? item.label.replace(re, "<b>$1</b>") : ''}</div>`;        },
        onSelect: function(e, term, item) {
            var additional_cess = $('#additional_cess').val();
            var ces_id = 0;
            var ces_percent = 0;
            var ces_name = '';
            if (parseFloat(additional_cess) > 0) {
                ces_id = item.data('ces_id');
                ces_percent = item.data('ces_percent');
                ces_name = item.data('ces_name');
            }
            var tax_on_mrp = item.data('tax_on_mrp');
            $('#item_tax_on_mrp').val(tax_on_mrp);
            $('#item_ces_per').val(ces_percent);
            $('#item_ces_id').val(ces_id);
            $('#item_ces_name').val(ces_name);
            $('#itembatch').val(item.data('itembatch'));
			$("#item_landing_cost").val(item.data('landing_cost'));
            $('#item_free_qty_for').val(item.data('free_qty_for'));
            $('#item_free_qty').val(item.data('free_qty'));
			
			var itm_mrp = item.data('itm_mrp');
			var itm_srate = item.data('itm_srate');
			var itm_whrate = item.data('itm_whrate');
			var itm_spclrate = item.data('itm_spclrate');
			
			$('#itm_mrp').val(itm_mrp);
			$('#itm_srate').val(itm_srate);
			$('#itm_whrate').val(itm_whrate);
			$('#itm_spclrate').val(itm_spclrate);
			
			
            var MRP = item.data('mrp');
            var price_code = item.data('price_code');
            var currentstk = item.data('currentstk');
            var tax_id = item.data('tax_id');
            var id = item.data('id');
            $("#item_qty").focus();
            var commission = item.data('commission');
            var unit_id = item.data('unit_id');
            var barcode = item.data('barcode');
            var tax_sales_id = item.data('tax_id');
			$("#emei").val(item.data('imei'));
			$("#emei_pur_id").val(item.data('purchase_id'));
            itemSelect(MRP, item.data('dis'), item.data('srate'), item.data('prate'), item.data('wh_rate'), price_code, currentstk, tax_id, id, commission, unit_id, barcode, tax_sales_id, '', id,item.data('itembatch'));
            $("#itemname").val(item.data('name'));
            var is_itemcode = $("#is_itemcode").val();
            if (is_itemcode === "1") {
                $("#itemcode").val(item.data('barcode'));
            }

        }

    });
    
    
    $(itemname).autoComplete({
        minChars: 2,
        cache: false,
        appendTo: '#mainSale',
        source: function(term, response) {
            $('.itemname').attr('data-placement', 'right');
            $('.itemname').popover('toggle');
            $("[wf-popover]").popover({
                html: true,
                content: function() {
                    var content = $(this).attr("wf-content");
                    //                        alert( $("#discription").text());
                    return content;
                },
                title: function() {
                    var title = $(this).attr("wf-title");
                    //return $(title).children(".popover-heading").html();
                    return title;
                },
                placement: function() {
                    var my = this.$element.attr('wf-popover');
                    return my;
                }
            });
            var customer = '';
            customer = $("#supid").val();
            var is_kitcustomer = $("#is_kitcustomer").val();
            if (is_kitcustomer !== '0') {
                customer = $("#supid").val();
            }
            var btype_branch = $("#btype option:selected").attr('branch_id');
            xhr = $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch_new/name/' + customer + '?', {
                term: term,
                batch:btype_branch
            }, function(data) {
                response(data);
            });
        },
        renderItem: function(item, search) {
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
            var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
            var set_rate = $('#set_rate').val();
            var salerate = item.p_srate;
            var pricelistid = item.pricelistid;
            $('#showrack').html('');
            if(item.racks !== ''){
                $('#showrack').html('Rack : '+item.racks);
            }
            
            if (parseFloat(pricelistid) < 1) {
				var price_discount = item.p_dis;
                if (set_rate === 'MRP') {
                    salerate = item.p_MRP;
                } else if (set_rate === 'wh_rate') {
                    salerate = item.p_wh_rate;
                } else if (set_rate === 'special_rate') {
                     salerate = item.special_rate;
                } else if (set_rate === 'base_rate') {
                    salerate = item.p_base_rate;
                }
            }else{
				if(item.price_discount !== null && item.price_discount !== 'null'){
					var price_discount = item.price_discount;
				}
			}
			
            var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
            var item_tax_on_mrp = 0 ;
            if(purchase_tax_on_mrp > 0 ){
                item_tax_on_mrp = item.tax_on_mrp;
                console.log(item_tax_on_mrp);
            }
            
			var itm_mrp = item.p_MRP;
			var itm_srate = item.p_srate;
			var itm_whrate = item.p_wh_rate;
			var itm_spclrate = item.special_rate;
			
			
            return '<div class="autocomplete-suggestion" data-val="' + item.label + '" data-tax_on_mrp="' +item_tax_on_mrp + '" data-cigarette_cess_amount="' + item.cigarette_cess_amount + '" data-cigarette_cess_percentage="' + item.cigarette_cess_percentage + '" data-itm_mrp="' + itm_mrp + '" data-uqc="' + item.uqc + '"  data-itm_srate="' + itm_srate+ '" data-itm_whrate="' + itm_whrate + '"  data-itm_spclrate="' + itm_spclrate + '"  data-landing_cost="' + item.landing_cost + '" data-ces_id="' + item.ces_id + '" data-ces_percent="' + item.ces_percent + '" data-ces_name="' + item.ces_name + '"  data-free_qty="' + item.free_qty + '" data-free_qty_for="' + item.free_qty_for + '" data-itembatch="' + item.itembatch + '" data-tax_sales_id="' + item.tax_id + '" data-unit_id="' + item.unit_id + '" data-name="' + item.name + '"  data-barcode="' + item.barcode + '"  data-commission="' + item.commission + '"  data-val="' + search + '" data-tax_id="' + item.tax_id + '" data-id="' + item.id + '" data-currentstk="' + item.godown_stock + '" data-price_code="' + item.price_code + '" data-prate="' + item.prate + '"  data-srate="' + salerate + '"  data-mrp="' + item.MRP + '"  data-wh_rate="' + item.wh_rate + '"  data-dis="' + price_discount + '"  data-price_discount="' + price_discount + '"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
        },
        onSelect: function(e, term, item) {
            var tax_on_mrp = item.data('tax_on_mrp');
            $('#item_tax_on_mrp').val(tax_on_mrp);
            var additional_cess = $('#additional_cess').val();
            var ces_id = 0;
            var ces_percent = 0;
            var ces_name = '';
             <?php if(strtolower($login_comid) == 'pushpa' ){?>
                    $('#last_sqftunit').val(item.data('uqc'));
                            $('#sqftunit').val(item.data('uqc'));

            <?php }?>
            if (parseFloat(additional_cess) > 0) {
                ces_id = item.data('ces_id');
                ces_percent = item.data('ces_percent');
                ces_name = item.data('ces_name');
            }
			$("#item_landing_cost").val(item.data('landing_cost'));
            $('#item_ces_per').val(ces_percent);
            $('#item_ces_id').val(ces_id);
            $('#item_ces_name').val(ces_name);
			$("#emei").val('');
			$("#emei_pur_id").val('0');
            var MRP = item.data('mrp');
			

            $('#cig_ces_per').val(item.data('cigarette_cess_percentage'));
			$('#unit_cig_ces_amt').val(item.data('cigarette_cess_amount'));


			var itm_mrp = item.data('itm_mrp');
			var itm_srate = item.data('itm_srate');
			var itm_whrate = item.data('itm_whrate');
			var itm_spclrate = item.data('itm_spclrate');
			$('#itm_mrp').val(itm_mrp);
			$('#itm_srate').val(itm_srate);
			$('#itm_whrate').val(itm_whrate);
			$('#itm_spclrate').val(itm_spclrate);
			
			
            $('#itembatch').val(item.data('itembatch'));
            $('#item_free_qty_for').val(item.data('free_qty_for'));
            $('#item_free_qty').val(item.data('free_qty'));
            var price_code = item.data('price_code');
            var currentstk = item.data('currentstk');
            var tax_id = item.data('tax_id');
            var id = item.data('id');
            $("#item_qty").focus();
            var commission = item.data('commission');
            var unit_id = item.data('unit_id');
            var barcode = item.data('barcode');
            var tax_sales_id = item.data('tax_id');
            itemSelect(MRP, item.data('price_discount'), item.data('srate'), item.data('prate'), item.data('wh_rate'), price_code, currentstk, tax_id, id, commission, unit_id, barcode, tax_sales_id, '', id,item.data('itembatch'));
            $("#itemname").val(item.data('name'));
            var is_itemcode = $("#is_itemcode").val();
            if (is_itemcode === "1") {
                $("#itemcode").val(item.data('barcode'));
            }

        }

    });
    var is_itemcode = $("#is_itemcode").val();

    function itemsearch() {
        var is_weiging = $('#is_weiging').val();
        $('.itemname').attr('data-placement', 'right');
        $('.itemname').popover('toggle');
        $("[wf-popover]").popover({
            html: true,
            content: function() {
                var content = $(this).attr("wf-content");
                //                        alert( $("#discription").text());
                return content;
            },
            title: function() {
                var title = $(this).attr("wf-title");
                //return $(title).children(".popover-heading").html();
                return title;
            },
            placement: function() {
                var my = this.$element.attr('wf-popover');
                return my;
            }
        });

        var text = $("#itemcode").val();
        var customer = '';
        var is_kitcustomer = $('#is_kitcustomer').val();
        customer = $("#supid").val();
        var myquantity = 1;
		if($.isNumeric(text)){
			if (parseFloat(is_weiging) > 0 && text.length >= 4 && text.length <= 12) {
				myquantity = text.substring(4, 15);
				myquantity = parseFloat(myquantity);
				myquantity = myquantity / 1000;
				text = text.substring(0, 4);
			}
		}
		console.log(text);
            var btype_branch = $("#btype option:selected").attr('branch_id');
        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch_new/barcode/' + customer + '?', {
            term: text,
            batch:btype_branch
        }, function(result) {
            $.each(result, function(i, field) {
                var is_continue = 1;
                var barcode_qty_inc = $('#barcode_qty_inc').val();
                if(barcode_qty_inc > 0 ){
                    let index = items.findIndex(item => item.item_id === field.id);
                    if (index !== -1) {
                        is_continue = 0;
                        var itminc_id = items[index].inc_id;
                        var itmqty = $('#itmqty'+itminc_id).val();
                        itmqty = parseInt(itmqty) + 1;
                        $('#itmqty'+itminc_id).val(itmqty);
                        calculaterowdis(itminc_id);
                        clear();
                        $('#itemcode').focus();
                    }
                }
                if(is_continue > 0 ){ 


                    $.ajax({
						url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + field.id,
						async:false,
						success: function (result) {
							$('#godown').html('');
							$('#godown').html(result);
							var billgodown = $("#btype option:selected").attr('godown');
							if (billgodown !== '0') {
								$('#godown').val(billgodown);
                                                console.log('billgodown'+user_default_godown);
							}
							var user_default_godown = $('#user_default_godown').val();
							if (user_default_godown !== "" && parseFloat(user_default_godown) > 0 ) {
								$('#godown').val(user_default_godown);
                                                console.log('user_default_godown'+user_default_godown);

							}
							var qty = $('#godown').find(':selected').attr('qty');
							var myTag = $('#godown').find(':selected').attr('stock');
							$("#i_stock").html("Stock: " + myTag);
							$("#totstock").val(qty);
						}
					});



                    var is_cigarette_cess  = $('#is_cigarette_cess').val();
                        var  cig_ces_per =  0;
                        var unit_cig_ces_amt = 0  ;
                        var cig_ces_per_amount =  0;
                        var cig_ces_amt = 0;
                        if(is_cigarette_cess > 0 ){
                            unit_cig_ces_amt = field.cigarette_cess_amount;
                            cig_ces_per  = field.cigarette_cess_percentage;
                        }
                        
                        $('#cig_ces_per').val(cig_ces_per);
			            $('#unit_cig_ces_amt').val(unit_cig_ces_amt);


                var set_rate = $('#set_rate').val();
                var pindex = field.pindex;
                $('#pindexid').val(pindex);
                var additional_cess = $('#additional_cess').val();
                var ces_id = 0;
                var ces_percent = 0;
                var ces_name = '';
                if (parseFloat(additional_cess) > 0) {
                    ces_id = field.ces_id;
                    ces_percent = field.ces_percent;
                    ces_name = field.ces_name;
                }
				$("#item_landing_cost").val(field.landing_cost);
				$("#emei").val(field.imei);
				$("#emei_pur_id").val(field.purchase_id);
                $('#item_ces_per').val(ces_percent);
                $('#item_ces_id').val(ces_id);
                $('#item_ces_name').val(ces_name);
                $('#itembatch').val(field.itembatch);
                $("#item_free_qty").val(field.free_qty);
                $("#item_free_qty_for").val(field.free_qty_for);
                var pricelistid = field.pricelistid;
                var srate = field.salerate;
                if (srate === '' || srate === undefined) {
                    srate = field.srate;
                }
                if (parseInt(srate) === 0) {
                    srate = field.srate;
                }
				
                var salerate = srate;
                if (parseFloat(pricelistid) < 1) {

                    if (set_rate === 'MRP') {
                        salerate = field.p_MRP;
                    } else if (set_rate === 'wh_rate') {
                        salerate = field.p_wh_rate;
                    } else if (set_rate === 'special_rate') {
                         salerate = field.special_rate;
                    } else if (set_rate === 'base_rate') {
                        salerate = field.p_base_rate;
                    }
                } else {
                    salerate = field.p_srate;
                }
				
				var itm_mrp = field.p_MRP;
				var itm_srate = item.p_srate;
				var itm_whrate = item.p_wh_rate;
				var itm_spclrate = item.special_rate;
				$('#itm_mrp').val(itm_mrp);
				$('#itm_srate').val(itm_srate);
				$('#itm_whrate').val(itm_whrate);
				$('#itm_spclrate').val(itm_spclrate);
				
				
                $("#itemname").val(field.name);
                var is_itemcode = $("#is_itemcode").val();
                $("#item_qty").val(myquantity);
                if (is_itemcode === "1") {
                    $("#itemcode").val(field.item_barcode);
                }
                console.log('xxx')

                var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
                var item_tax_on_mrp = 0 ;
                if(purchase_tax_on_mrp > 0 ){
                    item_tax_on_mrp = field.tax_on_mrp;
                }
                $('#item_tax_on_mrp').val(item_tax_on_mrp);

                itemSelect(field.MRP, field.dis, salerate, field.prate, field.wh_rate, field.price_code, field.currentstk, field.tax_id, field.id, field.commission, field.unit_id, field.item_barcode, field.tax_id, field.uname, field.id,field.itembatch,pindex);
                rowcalc();
				var enable_barcode = $('#enable_barcode').val();
				if(parseFloat(enable_barcode) > 0  ){
					add();
					showbtn(1);
					$("#itemcode").focus();
				}else{
					$("#item_qty").focus().select();
				}

            }


            });

        });



    }

    function kitsearch(event) {
        var cusid = $("#supid").val();
        $("#txtkit").autocomplete({
            source: "<?php echo site_url('kitgroup/kitgroup'); ?>/" + cusid,
            minLength: 2,
            select: function(event, ui) {
                $.ajax({
                    url: "<?php echo site_url('kitgroup/get_kit_items'); ?>/" + ui.item.id,
                    success: function(result) {
                        $.each(JSON.parse(result), function(i, itemsingle) {
                            var item_id = itemsingle.item_id;
                            var item_qty = itemsingle.quantity;
                            var godown = 1;
                            var unit_item = itemsingle.unit_id;
                            var tax_id = itemsingle.tax_id;
                            var mrp_item = itemsingle.rate;
                            var itemname = itemsingle.item;
                            var comontax = $("#comontax").val();
                            var is_taxincluded = $("#is_taxincuded").val();
                            var commission = 0;
                            var unit_name = itemsingle.unit;
                            var barcode = itemsingle.barcode;
                            var tax_name = itemsingle.GST;
                            var pur_rate = itemsingle.prate;
                            var dis_amt = 0;
                            var item_discription = '';
                            var prate_item = 0;
                            var analytics = 0;
                            var analyticsname = '';
                            var godown_name = '';
                            var rowTotal = 0;
                            var tax_amount = 0;
                            var margin = parseFloat(0) - parseFloat(itemsingle.prate).toFixed(company_roundoff);
                            if (item_qty !== '0' && mrp_item !== '0') {
                                rowTotal = (parseFloat(item_qty) * parseFloat(mrp_item)).toFixed(company_roundoff);
                                if (tax_name !== 0) {
                                    var tax_amount = parseFloat(rowTotal) - ((parseFloat(rowTotal) * 100) / (parseFloat(tax_name) + 100));
                                    if (is_taxincluded === "0") {
                                        tax_amount = parseFloat(rowTotal) * parseFloat(tax_name) / 100;
                                        rowTotal = (parseFloat(rowTotal) + parseFloat(tax_amount));
                                    }
                                    var margin = parseFloat(pur_rate * item_qty).toFixed(company_roundoff);
                                    var margin = parseFloat(rowTotal) - parseFloat(margin);

                                }
                            }
                            var pindex = 0 ;
                            var itembatch = '';
                            var iteadd = new item(item_id, item_qty, godown, unit_item, tax_id, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate, is_taxincluded, margin, item_discription, barcode, analytics, analyticsname,pindex);
                            addrowtoTable(iteadd);
                            //kitgroup
                            items.push(iteadd);
                            $("#Costcenter").val('');
                            $("#rowTotal").val(0.0);
                            calculateGTotal();
                            $("#itemname").focus();
                            ref();
                            $('.myspop').popover();
                        });
                    }
                });
            }
        });


    }

    function calculaterow(id) {
        //    itmtax   
		var date1 = $('#date').val();
		date1 = formatdates(date1);
		var exceedcessdate = 0 ;
		if(date1 > date2){
			exceedcessdate = 1;
		}
		console.log(exceedcessdate);
        var qty = getVal("itmqty" + id);
        var freequantity = $('#freequantity').val();
        if (freequantity === '1' || freequantity === 1) {
            var item_free_qty = $('#itm_fre_qty' + id).val();
            var item_free_qty_for = $('#itm_fre_qty_for' + id).val();
            if(parseFloat(item_free_qty_for) > 0 ){
                $('#itmffqty' + id).val(0.00);
            }
            if (parseFloat(item_free_qty) > 0 && parseFloat(item_free_qty_for) > 0 && $("#itmqty" + id).val() > 0) {
                var free = parseFloat($("#itmqty" + id).val()) / parseFloat(item_free_qty_for);
                free = Math.trunc(free);
                free = item_free_qty * free;
                if (parseFloat(free) > 0) {
                    $('#itmffqty' + id).val(free);
                }
            }
        }
        var is_discount = getVal('is_discount');
        var mrp_item = getVal('itmmrp' + id);
        var dis_amt = getVal('itmdis' + id);
        var tax = getVal("itmtaxper" + id);
        var pur_rate = getVal("mar_pur_rate" + id);
        var salitms_mrp = getVal("salemrp" + id);
        var tot = getVal("itmtot" + id);
        var prate_item = 0;
        var total = 0;
        var itm = getIndexOf(items, id);
        var iteadd = items[itm];
        var additional_cess = $('#additional_cess').val();
        iteadd.item_qty = qty;

        var taxes = getVal("itmtaxper" + id);
            var additional_cess = $('#additional_cess').val();
            var tax_befores = taxes;
            var itm_ces_per = $("#itm_ces_per" + id).val();
            if (parseFloat(additional_cess) > 0 && parseFloat(itm_ces_per) > 0) {
                    tax_befores = parseFloat(taxes) + parseFloat(itm_ces_per);
            }

            is_taxincuded = $("#is_taxincuded" + id).val();
            if (is_taxincuded === "0") {

            }else{
                <?php if( strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa'){?>

                    var mrp_item =  ((parseFloat(mrp_item) * 100) / (parseFloat(tax_befores) + 100));
                    mrp_item = parseFloat(mrp_item).toFixed(5);
                <?php }?>
            }


        //        if (is_discount === '1') {
        total = parseFloat(mrp_item) * qty - dis_amt;
        var dis_tot = parseFloat(mrp_item * qty);
        var dis_tot = parseFloat(dis_tot - dis_amt);
        if (dis_tot < 0) {
            total = parseFloat(mrp_item) * qty;
            dis_amt = 0;
            $("#itmdis" + id).val(dis_amt.toFixed(company_roundoff));
        }
        if (dis_amt !== '0' && mrp_item !== '0' && qty !== '0' && dis_amt < mrp_item * qty) {
            prate_item = parseFloat(((dis_amt * 100) / (mrp_item * qty)));
            var taxes = getVal("itmtaxper" + id);
            var additional_cess = $('#additional_cess').val();
            var tax_befores = taxes;
            var itm_ces_per = $("#itm_ces_per" + id).val();
            if (parseFloat(additional_cess) > 0 && parseFloat(itm_ces_per) > 0) {
                    tax_befores = parseFloat(taxes) + parseFloat(itm_ces_per);
            }

            is_taxincuded = $("#is_taxincuded" + id).val();

            if (is_taxincuded === "0") {

            }else{
                var mrp_items = mrp_item;
                <?php if(strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa' ){?>
                    // var mrp_items =  ((parseFloat(mrp_item) * 100) / (parseFloat(tax_befores) + 100));
                <?php }?>
                prate_item = parseFloat(((dis_amt * 100) / (mrp_items * qty)));
            }
        }
        $("#itmrate" + id).val(prate_item.toFixed(company_roundoff));
        // total = rowtotal(qty, mrp_item);
        //        }
        var additional_cess = $('#additional_cess').val();
        var tax_before = tax;
        var itm_ces_per = $("#itm_ces_per" + id).val();
        var item_damage_quantity = $('#item_damage_quantity' + id).val();
        var item_actual_quantity = $('#item_actual_quantity' + id).val();
        if (parseFloat(additional_cess) > 0 && parseFloat(itm_ces_per) > 0) {
            tax_before = parseFloat(tax) + parseFloat(itm_ces_per);
        }
        var ces = $("#ces" + id).val();
        var saletype = $('#saletype').val();
        if (parseFloat(ces) > 0 && saletype === 'b2c' && exceedcessdate < 1 ) {
            tax_before = parseFloat(tax_before) + parseFloat(ces);
        }
		
		 var adddisamt = 0 ;
        var adddisper = $('#adddisper' + id).val();
        $('#adddisamt' + id).val(0);
        if(adddisper === '' || adddisper === undefined ){
            adddisper  = 0;
        }
        if(parseFloat(adddisper) > 0 ){
            adddisamt = parseFloat(total) * parseFloat(adddisper) /100;
            $('#adddisamt' + id).val(adddisamt);
            total = parseFloat(total) - parseFloat(adddisamt);
        }
		var cig_total = total;
		var is_cigarette_cess = $('#is_cigarette_cess').val();
        var unit_cig_ces_amt = 0 ;
        var cig_ces_per = 0 ;
        if(is_cigarette_cess > 0 ){
            var unit_cig_ces_amt = $('#unit_cig_ces_amt'+id).val();
            var cig_ces_per = $('#cig_ces_per'+id).val();
            var cig_ces_per_amount = 0;
            var cig_ces_amt = 0;
            if(parseFloat(unit_cig_ces_amt) > 0  ){
                cig_ces_amt = parseFloat(unit_cig_ces_amt) * parseFloat(qty);
                cig_total = parseFloat(total) - parseFloat(cig_ces_amt);
            }
            if(parseFloat(cig_ces_per) > 0  && parseFloat(cig_total) > 0 ){
                tax_before = parseFloat(tax_before) + parseFloat(cig_ces_per);
                cig_ces_per_amount = parseFloat(cig_total) * parseFloat(cig_ces_per) / 100;
                txamt = ((parseFloat(cig_total) * 100) / (parseFloat(tax_before) + 100));
                cig_ces_per_amount = txamt * cig_ces_per / 100;
            }
            $('#cig_ces_amt'+id).val(cig_ces_amt);
            $('#cig_ces_per_amount'+id).val(cig_ces_per_amount);


        }
        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
        var taxamt = parseFloat(cig_total) - ((parseFloat(cig_total) * 100) / (parseFloat(tax_before) + 100));
        is_taxincuded = $("#is_taxincuded" + id).val();
        var cess_amount = parseFloat(total) - parseFloat(taxamt);
        if (is_taxincuded === "0") {
            taxamt = parseFloat(total) * parseFloat(tax) / 100;
            
            if (purchase_tax_on_mrp > 0 ) {
                var item_tax_on_mrp = $('#itm_tax_on_mrp'+id).val();  
                if (item_tax_on_mrp > 0) {
                    var itmMrp = parseFloat($('#salemrp'+id).val()) || 0;
                    var qty = parseFloat(qty) || 0;
                    var taxRate = parseFloat(tax) || 0;

                    // TAX INCLUSIVE FORMULA: (Total Amount * Tax Rate) / (100 + Tax Rate)
                    var totalInclusiveAmount = itmMrp * qty;
                    taxamt = (totalInclusiveAmount * taxRate) / (100 + taxRate);
                }
            }

            cess_amount = parseFloat(total);
            total = (parseFloat(total) + parseFloat(taxamt)).toFixed(company_roundoff);
        } else {
            <?php if(strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa'){?>
                taxamt = parseFloat(total) * parseFloat(tax) / 100;

                if (purchase_tax_on_mrp > 0 ) {
                var item_tax_on_mrp = $('#itm_tax_on_mrp'+id).val();  
                if (item_tax_on_mrp > 0) {
                    var itmMrp = parseFloat($('#salemrp'+id).val()) || 0;
                    var qty = parseFloat(qty) || 0;
                    var taxRate = parseFloat(tax) || 0;

                    // TAX INCLUSIVE FORMULA: (Total Amount * Tax Rate) / (100 + Tax Rate)
                    var totalInclusiveAmount = itmMrp * qty;
                    taxamt = (totalInclusiveAmount * taxRate) / (100 + taxRate);
                }
            }

            
                cess_amount = parseFloat(total);
                total = (parseFloat(total) + parseFloat(taxamt)).toFixed(company_roundoff);
            <?php }else{?>
                taxamt = ((parseFloat(cig_total) * 100) / (parseFloat(tax_before) + 100));
                taxamt = taxamt * tax / 100;

                if (purchase_tax_on_mrp > 0 ) {
                var item_tax_on_mrp = $('#itm_tax_on_mrp'+id).val();  
                if (item_tax_on_mrp > 0) {
                    var itmMrp = parseFloat($('#salemrp'+id).val()) || 0;
                    var qty = parseFloat(qty) || 0;
                    var taxRate = parseFloat(tax) || 0;

                    // TAX INCLUSIVE FORMULA: (Total Amount * Tax Rate) / (100 + Tax Rate)
                    var totalInclusiveAmount = itmMrp * qty;
                    taxamt = (totalInclusiveAmount * taxRate) / (100 + taxRate);
                }
            }


            <?php }?>


           
        }
        var row_cess = 0;
        var ces = $("#ces" + id).val();
        if (parseFloat(ces) > 0) {
            row_cess = parseFloat(cess_amount) * parseFloat(ces) / 100;
        }
        var rowItemCes = 0;
        if (parseFloat(additional_cess) > 0) {
            var itm_ces_per = $("#itm_ces_per" + id).val();
            if (parseFloat(itm_ces_per) > 0 && parseFloat(cess_amount) > 0) {
                rowItemCes = parseFloat(cess_amount) * parseFloat(itm_ces_per) / 100;
                $("#rowItemCes" + id).val(rowItemCes.toFixed(company_roundoff));
            }
        }


        
        
        if (is_taxincuded === "0") {
            total = (parseFloat(total) + parseFloat(rowItemCes)).toFixed(company_roundoff);
            //total = (parseFloat(total) + parseFloat(row_cess)).toFixed(company_roundoff);
        }
        $("#ces_amt" + id).val(row_cess.toFixed(company_roundoff));
        console.log(taxamt); console.log(total);
        if (!isNaN(taxamt)) {
            $("#itmtax" + id).val(taxamt.toFixed(company_roundoff));
            $("#itmtot" + id).val(total);
        }

        var amount = parseFloat(total).toFixed(company_roundoff);
        if (is_taxincuded === "0") {
            amount = parseFloat(total - taxamt).toFixed(company_roundoff);
        }
        amount = parseFloat(total - taxamt - rowItemCes).toFixed(company_roundoff);
		console.log('amount'+amount);
		if($('#saletype').val() == 'b2c' && parseFloat(is_taxincuded) > 0 && exceedcessdate < 1 ){
			amount = parseFloat(amount) - parseFloat(row_cess);
			console.log('row_cess'+row_cess);
			console.log('amount'+amount);
		}

         <?php if( $this->session->userdata('login_base_comid') == 'moorolil' ){?>
            var item_landing_cost = $('#item_landing_cost').val();
            var margin = parseFloat(item_landing_cost * qty).toFixed(company_roundoff);
            var margin = parseFloat(amount - margin).toFixed(company_roundoff);
            
            $("#margin" + id).val(margin);
            $("#i_mgn").html("I M: " + parseFloat(margin).toFixed(company_roundoff));
        <?php }else{?>
            var margin = parseFloat(pur_rate * qty).toFixed(company_roundoff);
            var margin = parseFloat(amount - margin).toFixed(company_roundoff);
            
            $("#margin" + id).val(margin);
            $("#i_mgn").html("I M: " + parseFloat(margin).toFixed(company_roundoff));
        <?php }?>
		var godown_stock = getVal("godown_stock"+id);
        var qtys = qty;


        $('#tr'+id).attr('class','');
        <?php if( $this->session->userdata('login_base_comid') == 'mcesb' ){?>
            var uitem =  $("#itm_unit_item" + id).val();
            qtys = parseFloat(qty) *  parseFloat(unit_array[uitem]);
        <?php }?>
        if(parseInt(iteadd.reorder_point) > 0 ){
            if(parseFloat(godown_stock) <= parseFloat(iteadd.reorder_point) ){
			$('#tr'+id).attr('class','tryellow');
		    }
        }
		if(parseFloat(godown_stock) < parseFloat(qtys) ){
			$('#tr'+id).attr('class','trorange');
		}
		
		if(parseFloat(total) === 0 ){
			$('#tr'+id).attr('class','trred');
		}


        var itemSQFTNO = $('#itemSQFTNO'+id).val();
        var itemItemSQFT = $('#itemItemSQFT'+id).val();
        iteadd.ItemSQFT = itemItemSQFT;
        iteadd.SQFTNO = itemSQFTNO;
        if(is_cigarette_cess > 0 ){
            iteadd.item_row_ces = rowItemCes;
            iteadd.row_cess_amount = row_cess;
            iteadd.cig_ces_per_amount = cig_ces_per_amount;
            iteadd.cig_ces_amt = cig_ces_amt;
        }
        iteadd.item_row_ces = rowItemCes;
        iteadd.row_cess_amount = row_cess;
        iteadd.actual_quantity = item_actual_quantity;
        iteadd.damage_quantity = item_damage_quantity;
        iteadd.salitms_mrp = salitms_mrp
        iteadd.tax_amount = taxamt;
        iteadd.mrp_item = mrp_item;
        iteadd.prate_item = prate_item.toFixed(company_roundoff);
        iteadd.rowTotal = total;
        iteadd.margin = margin;
        iteadd.dis_amt = dis_amt;
        iteadd.add_dis_amt = adddisamt;
        //this.commission = commission;  
        //items.push(iteadd);
        items[itm] = iteadd;
        localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
        calculateGTotal();
        $('#itemcode').focus();

    }
    var idinc = 0;
	function changedescription(id){
		var my_itemdescription = getVal("my_itemdescription" + id);
		var itm = getIndexOf(items, id);
		var iteadd = items[itm];
		iteadd.item_discription = my_itemdescription;
		items[itm] = iteadd;
		$('#itmdtn'+id).val(my_itemdescription );
		$('#my_itemdescription'+id).val(my_itemdescription );
		localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));



	}

     
    function addrowtoTable(itemsSingle) { // Renamed parameter to itemsSingle to avoid conflict with your global 'items' array
    var AlertDuplicate = parseInt($('#AlertDuplicate').val());
    var AlertExpiry = parseInt($('#AlertExpiry').val());
    
    // 1. Check for Duplicate ItemID
    if (AlertDuplicate > 0) {
        var duplicateFound = items.some(function(el) {
            return el.item_id === itemsSingle.item_id;
        });

        if (duplicateFound) {
            $.confirm({
                title: 'Duplicate Item!',
                content: 'This item is already in the list. Do you want to add it again?',
                type: 'orange',
                buttons: {
                    confirm: function () {
                        // Continue adding the row
                        processAddition(itemsSingle);
                    },
                    cancel: function () {
                         removeByIncId(itemsSingle.inc_id);
                        clear(); // Clear the input fields
                    }
                }
            });
            return; // Stop execution here; processAddition will handle the rest if confirmed
        }
    }

    // 2. Check for Expiry Date
    if (AlertExpiry > 0 && itemsSingle.exp_date) {
        // Convert dd/mm/yyyy to a JS Date object
        var parts = itemsSingle.exp_date.split('/');
        var expDate = new Date(parts[2], parts[1] - 1, parts[0]);
        var today = new Date();
        today.setHours(0, 0, 0, 0); // Reset time to compare only dates

        if (expDate < today) {
            $.confirm({
                title: 'Item Expired!',
                content: 'The item "' + itemsSingle.itemname + '" expired on ' + itemsSingle.exp_date + '. Proceed anyway?',
                type: 'red',
                buttons: {
                    confirm: function () {
                        processAddition(itemsSingle);
                    },
                    cancel: function () {
                         removeByIncId(itemsSingle.inc_id);
                        clear();
                    }
                }
            });
            return;
        }
    }

    // If no alerts triggered, add normally
    processAddition(itemsSingle);
}


 function removeByIncId(inc_id) {
        items = items.filter(function(el) {
            return el.inc_id !== inc_id;
        });
        calculateGTotal();
    }

    function processAddition(items) {
        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();
        var Is_row_Sqft = $('#Is_row_Sqft').val();
        $('#modelextra').modal('hide');
        $('#itemname').focus();
        $("#item_qty").focus().select();
        $('#sqft_number').val(0);
        $('#sqft_quantity').val(0);
        $('#sqft_quantity').trigger('change');
		var txt_sale_rate = $('#txt_sale_rate').val();
        $("#itembatch").val('');
        console.log(items);
        idinc = idinc + 1;
        var sales_ref_type = items.sales_ref_type;
        var bill_mrp = $('#bill_mrp').val();
        var salitms_mrp = items.salitms_mrp;
        var pindex = items.pindex;
        var SQFTNO = items.SQFTNO;

        var cig_ces_per = items.cig_ces_per;
        var unit_cig_ces_amt = items.unit_cig_ces_amt;
        var cig_ces_per_amount = items.cig_ces_per_amount;
        var cig_ces_amt = items.cig_ces_amt;
        var is_cigarette_cess = $('#is_cigarette_cess').val();

        var ItemSQFT = items.ItemSQFT;
        var reorder_point = items.reorder_point;
        var godown_stock = items.godown_stock;
		var unit_qty = items.unit_qty;
		var itm_mrp = items.itm_mrp;
		var itm_srate = items.itm_srate;
		var itm_whrate = items.itm_whrate;
		var itm_spclrate = items.itm_spclrate;
		var add_dis_per = items.add_dis_per;
        var sale_mrp = $('#sale_mrp').val();
        var add_dis_amt = items.add_dis_amt;
		 $('#add_dis_per').val(0);
        var sales_ref_id = items.sales_ref_id;
        var damage_quantity = items.damage_quantity;

        if(purchase_tax_on_mrp > 0 ){
            var row_tax_on_mrp = items.item_tax_on_mrp;
        }


		var emei = items.emei;
		var item_landing_cost = items.item_landing_cost;
		var emei_pur_id = items.emei_pur_id;
        var item_tax_on_mrp = items.item_tax_on_mrp;
        var actual_quantity = items.actual_quantity;
        var item_ces_id = items.item_ces_id;
        var item_ces_per = items.item_ces_per;
        var item_ces_name = items.item_ces_name;
		var item_commission = items.commission;
        var additional_cess = $('#additional_cess').val();
        var item_row_ces = items.item_row_ces;
        var row_cess_amount = items.row_cess_amount;
        var free_qty = items.free_qty;
		console.log('free_qty:'+free_qty);
        var freequantity = $('#freequantity').val();
        var row_cess = items.row_cess;
        var itm_fre_qty = items.itm_fre_qty;
        var itm_fre_qty_for = items.itm_fre_qty_for;
        var itembatch = items.itembatch;
        var item_rate = items.item_rate;
        var is_taxincuded = items.is_taxincuded;
        var item_id = items.item_id;
        var item_qty = items.item_qty;
        var unit_item = items.unit_item;
        var godown = items.godown;
        var tax_item = items.tax_item;
        var dis_amt = items.dis_amt;
        var mrp_item = items.mrp_item;
        var prate_item = items.prate_item;
        var dis_amt = items.dis_amt;
        var itemname = items.itemname;
        var comontax = items.comontax;
        var rowTotal = items.rowTotal;
        var tax_amount = items.tax_amount;
        var margin = items.margin;
		var rowtot = rowTotal;
		if(parseFloat(is_taxincuded) > 0  ){
			rowtot = parseFloat(rowtot) - parseFloat(tax_amount);
		}
		if(parseFloat(rowtot) > 0  ){
			rowtot = parseFloat(rowtot) / parseFloat(item_qty) ;
		}
        var pur_rate = items.pur_rate;
		var marginper = parseFloat(rowtot) - parseFloat(pur_rate);
		marginper = parseFloat(marginper) * 100 / parseFloat(pur_rate);
        var size = items.size;
        var size_name = items.size_name;
        var is_size = $('#is_size').val();
        var barcode = items.barcode;
        var item_discription = items.item_discription;
        var is_composite = $("#is_composite").val();
        var is_extra = $("#is_extra").val();
        var totstock = $("#totstock").val();
        var is_discount = $("#is_discount").val();
        var saletot = parseFloat(rowTotal) + parseFloat(cig_ces_amt) + parseFloat(cig_ces_per_amount);
        $("#i_mgn").html("I M: " + margin);
		//$("#i_mgnper").html(marginper+'__'+rowtot+'__'+pur_rate);
		$("#i_mgnper").html(parseFloat(marginper).toFixed(2)+'%');
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"  index="' + items.inc_id + '"   title="Remove"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        <?php if( strtolower($this->session->userdata('login_base_comid')) == 'palack' ){?>
            var del = '<div class="btn-group" style="width:100%"><button style="width:49%"  type="button" data-toggle="tooltip" onclick="remove(this)"  index="' + items.inc_id + '"   title="Remove"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button> <button class="btn btn-warning " style="width:49%" type="button" onclick="editrowdes(' + items.inc_id + ')"><span class="glyphicon glyphicon-copy"></span></button>  </div>';
        <?php }?>

            var pophtml = 'MRP -' + items.itm_mrp + '<br/> ' + 'PRate -' + items.pur_rate +  '<br/> ' + 'LC -' + items.item_landing_cost;
pophtml = pophtml + '<br/> Wh rate -' + items.itm_whrate + '<br/> ' + 'Special Rate -' + items.itm_spclrate + '<br/> ' + 'Sales Rate -' + items.itm_srate;
pophtml = pophtml + '</br>' + 'Stock  :' + totstock;

if(emei !== '') {
    pophtml = pophtml + '</br>' + 'EMEI  :' + emei;
}

if (is_extra === "1") {
    // Correcting the textarea HTML
    pophtml = pophtml + '</br>' + '<textarea class="poptext" attr="' + items.inc_id + '" onchange="changedescription(' + items.inc_id + ')" id="my_itemdescription' + items.inc_id + '" cols="23" form="usrform">' + item_discription + '</textarea>';
}else{
    <?php if( strtolower($this->session->userdata('login_base_comid')) == 'palack' ){?>
        // pophtml = pophtml + '</br>' + '<textarea class="poptext" attr="' + items.inc_id + '" onchange="changedescription(' + items.inc_id + ')" id="my_itemdescription' + items.inc_id + '" cols="23" form="usrform">' + item_discription + '</textarea>';

    <?php }?>
}

		
        var rowval = rowval + td(1, 'item_no[]', ' text-right', 'id="itmno' + items.inc_id + '"', 'sma') + hidden(is_taxincuded, 'is_taxincuded[]', 'id="is_taxincuded' + items.inc_id + '"');
        var is_itemcode = $("#is_itemcode").val();
        rowval = rowval + hidden(row_cess_amount, 'ces_amt[]', 'id="ces_amt' + items.inc_id + '"') + hidden(row_cess, 'ces[]', 'id="ces' + items.inc_id + '"');
        if (is_itemcode === "1") {
            rowval = rowval + td(barcode, 'item[]', 'data-container="body"', 'data-container="body"', 'col-lg-1', pophtml);
        }
        rowval = rowval + td(itemname, 'itemname[]', '', '', 'col-lg-3', pophtml);
        var is_analytics = $("#is_analytics").val();
        if (is_analytics === "1") {
            var analytics = items.analytics;
            var analyticsname = items.analyticsname;
            rowval = rowval + hidden(analytics, 'analytics_id[]') + td(items.analyticsname, '', '');
        }
        if (is_size === '1') {
            rowval = rowval + td(size_name, '', 'sma');
        }
        <?php if(strtolower($this->session->userdata('login_base_comid')) == 'pushpa' ){  ?>
            
            if(item_discription != ''){
                var optionText = $('#sqftunit option[value="' + item_discription + '"]').text();
            }else{
                var optionText = 'Nil';
            }

            rowval = rowval + td(optionText, '', 'sma','id="pushpaunit'+items.inc_id+'"');
        <?php }?>

         if(purchase_tax_on_mrp > 0 ){
          rowval = rowval+   hidden(row_tax_on_mrp, 'itm_tax_on_mrp[]','id="itm_tax_on_mrp' + items.inc_id + '"');
        }


        rowval = rowval + hidden(pindex, 'pindex[]');
        rowval = rowval + hidden(size, 'item_size_id[]');
		rowval = rowval +  hidden(godown_stock, 'godown_stock[]','id ="godown_stock' + items.inc_id + '" ');
        rowval = rowval + hidden(reorder_point, 'reorder_point[]');
		rowval = rowval +  hidden(add_dis_per, 'adddisper[]','id="adddisper' + items.inc_id + '"');
		rowval = rowval +  hidden(add_dis_amt, 'adddisamt[]','id="adddisamt' + items.inc_id + '"');
		rowval = rowval +  hidden(saletot, 'saletot[]','id="saletot' + items.inc_id + '"');
        if(is_cigarette_cess > 0 ){
            rowval = rowval + hidden(cig_ces_amt, 'cigcesamt[]','id="cig_ces_amt' + items.inc_id + '"') + hidden(cig_ces_per_amount, 'cigcesperamount[]','id="cig_ces_per_amount' + items.inc_id + '"') + hidden(unit_cig_ces_amt, 'unitcigcesamt[]','id="unit_cig_ces_amt' + items.inc_id + '"') + hidden(cig_ces_per, 'cigcesper[]','id="cig_ces_per' + items.inc_id + '"') ;
        }
		rowval = rowval +  hidden(ItemSQFT, 'itemItemSQFT[]','id="itemItemSQFT' + items.inc_id + '"');
		
        var is_godown = $("#is_godown").val();
        var is_multipleunit = $("#is_multipleunit").val();
        if (is_godown === "1") {

            rowval = rowval + td(items.godown_name, '', '');
        }
        rowval = rowval + tde(item_qty, 'item_qty[]', 'form-control tditmqty <?php if($cls_sqft !=''){echo 'row'.$cls_sqft;}?> text-right  two-digits price itemdamage', ' attrid =' + items.inc_id + ' id="itmqty' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
         if(Is_row_Sqft < 1){
		    rowval = rowval +  hidden(SQFTNO, 'itemSQFTNO[]','id="itemSQFTNO' + items.inc_id + '"');
        }else{
            rowval = rowval + tde(SQFTNO, 'itemSQFTNO[]', 'form-control  text-right ', ' attrid =' + items.inc_id + ' id="itemSQFTNO' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
        }
       
        if (freequantity === '1') {
			rowval = rowval + tde(free_qty, 'free_qty[]', 'form-control text-right  two-digits  ', ' attrid =' + items.inc_id + ' id="itmffqty' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
            //rowval = rowval + tde(free_qty, 'free_qty[]', 'form-control text-right  two-digits', 'id="freeqty' + items.inc_id + '" ');
        }
        if (is_multipleunit === "1") {
            rowval = rowval + td(items.unit_name, '', '');
        }
        if (comontax === '0') {
            if (is_composite == '0') {
                rowval = rowval + td(items.tax_name, 'taxper[]', '', 'id="itmtaxper' + items.inc_id + '"');
            } else {
                rowval = rowval + hidden(items.tax_name, 'taxper[]', 'id="itmtaxper' + items.inc_id + '"');
            }
        }
		
        rowval = rowval + hidden(unit_qty, 'unitqty[]', 'id="unitqty' + items.inc_id + '"');
        rowval = rowval + hidden(salitms_mrp, 'salemrps[]', 'id="salemrps' + items.inc_id + '"');

         if(parseFloat(bill_mrp) > 0  ){
            rowval = rowval + tde(salitms_mrp, 'salemrp[]', ' text-right two-digits tditmsalemrp ', 'readonly id="salemrp' + items.inc_id + '" '+txt_sale_rate+' onchange=calculaterowdis(' + items.inc_id + ')');
        }
        rowval = rowval + tde(mrp_item, 'mrp_item[]', ' text-right two-digits frow tditmmrp ', 'id="itmmrp' + items.inc_id + '" '+txt_sale_rate+' onchange=calculaterowdis(' + items.inc_id + ')');
        if (is_discount == '1') {
            rowval = rowval + tde(dis_amt, 'dis_amt[]', 'text-right price  two-digits frow', '<?php echo $txt_sale_dis;?> id="itmdis' + items.inc_id + '" onchange=calculaterow(' + items.inc_id + ')') + tde(prate_item, 'prate_item[]', 'text-right price disper  adddiscount two-digits frow', '<?php echo $txt_sale_dis;?> id="itmrate' + items.inc_id + '" attr ='+items.inc_id+' onchange=calculaterowdis(' + items.inc_id + ')');
        } else {
            rowval = rowval + hidden(dis_amt, 'dis_amt[]', '<?php echo $txt_sale_dis;?> id="itmdis' + items.inc_id + '"','class="disper"') + hidden(prate_item, 'prate_item[]', 'id="itmrate' + items.inc_id + '"');
        }
        if (comontax === '0') {
            if (is_composite == '0') {
                rowval = rowval + td(tax_amount, 'tax_amount[]', ' text-right rtaxtot', 'id="itmtax' + items.inc_id + '"');
            } else {
                rowval = rowval + hidden(tax_amount, 'tax_amount[]', 'id="itmtax' + items.inc_id + '"');
            }
        }
        rowval = rowval+ hidden(emei, 'emei_item[]')+ hidden(emei_pur_id, 'emei_item_pur_id[]')  + hidden(item_landing_cost, 'landing_cost[]') + hidden(item_commission, 'item_commission[]','id="itm_commission' + items.inc_id + '"')+ hidden(sales_ref_type, 'sales_ref_type[]') + hidden(sales_ref_id, 'sales_ref_id[]') + hidden(damage_quantity, 'item_damage_quantity[]', 'id="item_damage_quantity' + items.inc_id + '"') + hidden(actual_quantity, 'item_actual_quantity[]', 'id="item_actual_quantity' + items.inc_id + '"') + hidden(item_rate, 'item_rate[]', 'id="item_rate' + items.inc_id + '"') + hidden(itm_fre_qty, 'itm_fre_qty[]', 'id="itm_fre_qty' + items.inc_id + '"') + hidden(itm_fre_qty_for, 'itm_fre_qty_for[]', 'id="itm_fre_qty_for' + items.inc_id + '"') + hidden(itembatch, 'itembatch_name[]') + hidden(item_id, 'item_id[]','class ="tditmid" ') + hidden(item_discription, 'itmdtn[]', 'id="itmdtn' + items.inc_id + '"') + hidden(pur_rate, 'mar_pur_rate[]', 'id="mar_pur_rate' + items.inc_id + '"') + hidden(margin, 'margin[]', 'id="margin' + items.inc_id + '"') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]');
        if (parseFloat(additional_cess) > 0) {
            rowval = rowval + td(item_row_ces, 'rowItemCes[]', 'text-right itmces ', 'id="rowItemCes' + items.inc_id + '"', '') + hidden(item_ces_id, 'itm_ces_id[]') + hidden(item_ces_name, 'itm_ces_name[]') + hidden(item_ces_per, 'itm_ces_per[]', 'id="itm_ces_per' + items.inc_id + '"');
        }

        rowval = rowval + td(rowTotal, 'rowTotal[]', 'text-right  rtot total', 'id="itmtot' + items.inc_id + '"', '') + tdhtml(del);


        var trtext = 'id="tr' + items.inc_id + '" ';
		
		
		if(parseFloat(item_landing_cost) > parseFloat(rowTotal/item_qty) ){
			trtext = 'id="tr' + items.inc_id + '" class="trMaroon" ';
		}
        
        <?php if( $this->session->userdata('login_base_comid') == 'mcesb' ){?>
            item_qty = parseFloat(item_qty) *  parseFloat(unit_array[unit_item]);
            console.log('item_qty'+item_qty);
        <?php }?>
        if(parseInt(reorder_point) > 0  ){
            if(parseFloat(godown_stock) <= parseFloat(reorder_point) ){
			    trtext = 'id="tr' + items.inc_id + '" class="tryellow" ';
		    }
        }
		if(parseFloat(godown_stock) < parseFloat(item_qty) ){
			trtext = 'id="tr' + items.inc_id + '" class="trorange" ';
		}
		
		if(parseFloat(rowTotal) === 0 ){
			trtext = 'id="tr' + items.inc_id + '" class="trred" ';
		}


        var newRow = tabletr(rowval,trtext);
        $("#rowm").prepend(newRow);
        $('#salesTable').tableNav();
        $('#salesTable input').eq(1).click();
        $('#itemname').focus();
        $("#item_qty").focus().select();
        var txtglobalitemdis = $('#txtglobalitemdis').val();
        if(txtglobalitemdis == ''){
            txtglobalitemdis = 0 ;
        }
        if(txtglobalitemdis > 0 ){
             setTimeout(function() {
                $('#txtglobalitemdis').trigger('change');

                }, 5);
        }else{
            setTimeout(function() {
                    calculaterow(items.inc_id);

                }, 5);
        }


        setTimeout(function() {
                   $('#itemname').focus();
         <?php if ($is_itemcode == 1) { ?>
        $('#itemcode').focus();
         <?php }?>

                }, 5);

       
    }

    function tabletr(val,trtext ='') {
		return "<tr "+trtext+" >" + val + "</tr>";
	}

    function add() {
        var barcode_qty_inc = $('#barcode_qty_inc').val();
        var is_con = 1;
        if(barcode_qty_inc > 0 ){
            var new_mrp_item = $('#mrp_item').val();
            var itemid = $('#item_id').val();
            var quan = $('#item_qty').val();
            var itembatch = $('#itembatch').val();
            let index = items.findIndex(item => item.item_id === itemid  && item.mrp_item == new_mrp_item && itembatch == item.itembatch);
            if (index !== -1) {
                is_continue = 0;
                var itminc_id = items[index].inc_id;
                var itmqty = $('#itmqty'+itminc_id).val();
                itmqty = parseInt(itmqty) + parseInt(quan);
                $('#itmqty'+itminc_id).val(itmqty);
                calculaterowdis(itminc_id);
                clear();
                $('#itemcode').focus();
                is_con=0;
            }
        }
        if(is_con > 0 ){
            insertItems();
            clear();
            calculateGTotal();
            setTimeout(function() {
                    $('#itemname').focus(); // Focus on #itemname after a short delay
                    $('#itemcode').focus(); // Focus on #itemcode

                    isFocused = false; // Reset the flag for future key presses
                }, 0);
        }
        
    }

    function calculatesertot(amt, tax) {
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
		var totamts = parseFloat(amt) + parseFloat(tax);
        totamt = (parseFloat(totamt) - parseFloat(totamts)).toFixed(company_roundoff);
        tottax = (parseFloat(tottax) - parseFloat(tax)).toFixed(company_roundoff);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
    }

    function addservices() {
		var tot_amount = $("#sergtotal").val();
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        var ledger = $("#ser_ledger").val();
        var ledgerid = $("#ser_ledgerid").val();
        var amount = $("#ser_amt").val();
        var taxid = $("#ser_tax").val();
        var tid = 0;
        totamt = (parseFloat(totamt) + parseFloat(amount)).toFixed(company_roundoff);
		tot_amount = parseFloat(tot_amount) +  parseFloat(amount);
        var gst = 0;
        var tax = 0;
        if (amount !== '0' && taxid !== null && taxid !== '0') {
            tax = $("#ser_tax option:selected").attr('percent');
            gst = (parseFloat((amount * tax) / 100)).toFixed(company_roundoff);
            tottax = (parseFloat(tottax) + parseFloat(gst)).toFixed(company_roundoff);
            tid = $("#ser_tax").val();
			tot_amount = parseFloat(tot_amount) +  parseFloat(gst);
        }
        $("#ser_taxamt").val(gst);
        addrowtoservice(amount, tid, tax, gst, ledger, ledgerid);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(parseFloat(tot_amount).toFixed(company_roundoff));
		
        $("#ser_ledger").focus();
        calculateGTotal();
    }

    function addrowtoservice(amount, taxid, tax, gst, ledger, ledgerid) {
        var newrow = '<tr><td  colspan="6"><input type="hidden" name="serv_is_taxincuded[]" value="0" > <input type="hidden" readonly="readonly" NoTab="true" value="' + ledgerid + '" tabindex="-1" name="serv_ledgerid[]" id="serv_ledgerid"/><input  NoTab="true"  readonly="readonly" id="serv_ledger"  class="form-control"  value="' + ledger + '" type="text"     placeholder="service ledger"/></td>' +
            ' <td  colspan="1"> <input type="hidden" NoTab="true" value="' + taxid + ' " tabindex="-1" name="serv_taxid[]" readonly="readonly" id="serv_taxid"/><input  NoTab="true"   id="serv_tax"  class="form-control" readonly="readonly"  value="' + tax + ' " type="text"     placeholder="service ledger"/></td>' +
            ' <td  colspan="2"> <input style="height:25px" id="serv_amt"  name="serv_amt[]" value="' + amount + '" type="text" readonly="readonly" class="form-control text-right  two-digits price " placeholder="service Amt"/></td>' +
            ' <td  colspan="2"> <input id="serv_taxamt" name="serv_taxamt[]" value="' + gst + '"  type="text" readonly="readonly"   class="form-control  text-right two-digits" placeholder="GST"/></td>' +
            '<td  colspan="1"> <span data-toggle="tooltip"   title="Remove" onclick="removeservice(this)" sertax="' + gst + '" seramt="' + amount + '"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span> </td></tr>';
        $("#rows").append(newrow);
        clearservice();
    }

    function remove(btn) {
        console.log(items);
        var id = $(btn).attr('index');
        var index = getIndexOf(items, id);
        items.splice(index, 1);
        calculateGTotal();
        $('.tooltip').remove();
        $(btn).closest('tr').remove();
        var id = $("#id").val();
        if (id === "0") {
            localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
        }


    }

    function removeservice(btn) {
        var amt = $(btn).attr("seramt");
        var tax = $(btn).attr("sertax");
        calculatesertot(amt, tax);
        $('.tooltip').remove();
        $(btn).closest('tr').remove();
        calculateGTotal();
    }

    function removecoupon(btn) {
        var couamt = $(btn).attr("couamt");
        var Discount = $("#discount").val();
        var dis = parseFloat(Discount) - parseFloat(couamt);
        $("#discount").val(dis);
        calculateGTotal();
        $('.tooltip').remove();
        $(btn).closest('tr').remove();
    }

    function getIndexOf(a, v) {
    // First check if the array exists and has length
    if (!a || !a.length) return false;
    
    var l = a.length;
    for (var k = 0; k < l; k++) {
        // Check if the current element exists and has inc_id property
        if (a[k] && a[k].inc_id !== undefined) {
            // Compare the values (using == instead of === to handle type coercion)
            if (a[k].inc_id == v) {
                return k;
            }
        }
    }
    return false;
}
	
	function setgroupdiscount(id){
		var discount_on = $('#discount_on').val();
		if(discount_on !== "item" ){
			$.ajax({
                    url: "<?php echo site_url('transaction/Sales/get_group_discount'); ?>",
                    type: 'post',
                    async: false,
                    data: {
                        discount_on: discount_on,
						item_id:id
                    },
                    success: function(result) {
                        $.each(JSON.parse(result), function(i, itemsingle) {
                           $('#prate_item').val(itemsingle.discount);
                        });
                    }
                });
		}
	}

    function itemSelect(MRP, dis, srate, prate, wh_rate, price_code, currentstk, tax_id, id, commission, unit_id, barcode, tax_sales_id, uname, item_id,batch = '') {
        console.log('yyy')

           
        showbtn(0);
        var Is_SQFT = $('#Is_SQFT').val();
        if(Is_SQFT > 0 ){
            $.ajax({
                url: "<?php echo site_url('ajaxcall/getitemsqft'); ?>",
                type: 'post',
                async: false,
                data: {
                    item_id: item_id,
                },
                success: function(result) {
                    $('#itemsqft').val(result);      
                }
            });
        }
        var is_discount = getVal('is_discount');
        var dis_amt = 0.00;
        $("#mrp_item").val(srate);

        var set_rate =  $("#set_rate").val();
        if(set_rate === "last_srate"){

            var customer_id = $('#supid').val();
            if(customer_id === ''){
                customer_id  = 0;
            }
            if(customer_id > 0 ){

                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/getlastsalesrate'); ?>",
                            type: 'post',
                            async: false,
                            data: {
                                item_id: item_id,
                                customer_id:customer_id
                            },
                            success: function(result) {
                                $.each(JSON.parse(result), function(i, ajaxitemsingle) {
                                    $("#mrp_item").val(parseFloat(ajaxitemsingle.mrp).toFixed(company_roundoff));
                                });
                            }
                        });
            }
        }

        
        $("#item_mrp").val(MRP);
        $('#sale_mrp').val(MRP);
        $('#salitms_mrp').val(MRP);
        $("#pur_rate").val(prate);
        $("#unit_pur_rate").val(prate);
        $("#unitvalue").val(srate);
        $("#i_stock").html("Stock: " + currentstk);
        $("#totstock").val(currentstk);
        if (is_discount === '1') {
            $("#prate_item").val(0);
            if (dis !== undefined && dis !== '' && dis !== '0') {
                $("#prate_item").val(dis);
                dis_amt = parseFloat(srate * dis / 100);
            }
        } else {
            $("#prate_item").val(dis);
        }
		
		setgroupdiscount(id);
        $("#dis_amt").val(dis_amt);
        $("#current_stock").addClass('bg-info');
        $("#tax_sales_id").val(tax_sales_id);
        var is_godown = $("#is_godown").val();
        if (uname !== '') {
            var option = '<option value="' + unit_id + ' ">' + uname + ' </option>';
            $('#unit_item').html('<option value="' + unit_id + '" selected>' + uname + ' </option>');
        } else {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/units'); ?>/" + item_id,
                success: function(result) {
                    $('#unit_item').html(result);
                    $('#unit_item').val(unit_id);
                }
            });
        }
        if (is_godown === '1') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + id,
				type:"POST",
				data:{batch:batch},
                success: function (result) {
                    $('#godown').html('');
                    $('#godown').html(result);
                    var billgodown = $("#btype option:selected").attr('godown');
                    if (billgodown !== '0') {
                        $('#godown').val(billgodown);
                    }
					var user_default_godown = $('#user_default_godown').val();
                    if (user_default_godown !== "" && parseFloat(user_default_godown) > 0 ) {
                        $('#godown').val(user_default_godown);
                    }
                    var qty = $('#godown').find(':selected').attr('qty');
                    var myTag = $('#godown').find(':selected').attr('stock');
                    $("#i_stock").html("Stock: " + myTag);
                    $("#totstock").val(qty);
                }
            });
        }
        if (is_godown === '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/godown'); ?>",
                success: function (result) {
                    $('#godown').html(result);
                   
                    var billgodown = $("#btype option:selected").attr('godown');
                    if (billgodown !== '0') {
                        $('#godown').val(billgodown);
                    }
					var user_default_godown = $('#user_default_godown').val();
                    if (user_default_godown !== "" && parseFloat(user_default_godown) > 0 )  {
                        $('#godown').val(user_default_godown);
                    }
                }
            });
            $("#item_qty").focus().select();
        }

        var is_multipletax = getVal('is_multipletax');
        if (is_multipletax === '1') {
            if (tax_sales_id !== undefined && tax_sales_id !== '' && tax_sales_id !== 0) {
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + tax_sales_id,
                    async: false,
                    success: function(results) {
                        var result = JSON.parse(results);
                       // tax_id = result.ref_id;
                    }
                });
            }

        }
        var is_composite = $('#is_composite').val();
        if (is_composite === "0") {
            $('#tax_item').val(tax_id);

        } else {
            var zeroindex = $('#zeroindex').val();
            $('#tax_item').val(zeroindex);
        }
        $('#item_id').val(id);
        $('#commission').val(commission);
        $('#base_unit').val(unit_id);
		
		$('#item_qty').focus();

        var row_dis_per = $('#row_dis_per').val();
        if(row_dis_per > 0 ){
            $('#prate_item').val(row_dis_per);
        }

    }
	function formatdates(input){
		var text = input;
		console.log('text'+text);
		if(text!== ''){
			var newdate = text.split('/');
			return  newdate[2]+'-'+newdate[1]+'-'+newdate[0];
		}
	}
    function rowcalc() {
		
		var date1 = $('#date').val();
		date1 = formatdates(date1);
		var exceedcessdate = 0 ;
		if(date1 > date2){
			exceedcessdate = 1;
		}
		console.log(exceedcessdate);
        var saletype = $('#saletype').val();
        $('#row_cess_amount').val(0);
        var prate = getVal("prate_item");
        var qty = getVal("item_qty");
        var is_discount = getVal('is_discount');
        var prate_item = getVal('prate_item');
        var mrp_item = getVal('mrp_item');
        var tax = $("#tax_item option:selected").attr('percent');
        var cess = $("#tax_item option:selected").attr('cess');

        //dis tax before
        var tax_before = tax;
        var item_ces_per = $('#item_ces_per').val();
        if (parseFloat(additional_cess) > 0 && parseFloat(item_ces_per) > 0) {
            tax_before = parseFloat(tax) + parseFloat(item_ces_per);
        }
        var is_taxincuded = $("#is_taxincuded").val();


        if (is_taxincuded === "0") {

        }else{
                <?php if(strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa'){?>
                    mrp_item =  ((parseFloat(mrp_item) * 100) / (parseFloat(tax_before) + 100));
                    mrp_item = parseFloat(mrp_item).toFixed(5);
                <?php }?>
        }


        //   var ces_id = $("#tax_item option:ces_id").attr('cess');
        var total = 0;
        var row_cess = 0;
        if (is_discount === '1') {
            var dis = getVal("dis_amt");
            if (mrp_item !== '0' && qty !== '0') {
                total = ((parseFloat(mrp_item) * parseFloat(qty)) - dis);
            }
			
			var add_dis_per  =$('#add_dis_per').val();
            if(add_dis_per ===''){
                add_dis_per = 0;
            }
            $('#add_dis_amt').val(0);
            if(parseFloat(add_dis_per) > 0 ){
                var add_dis_amt  = parseFloat(total) * parseFloat(add_dis_per) /100;
                $('#add_dis_amt').val(add_dis_amt);
                total = parseFloat(total) - parseFloat(add_dis_amt);
            }
			
            // total = rowtotal(qty, mrp_item);
        } else {
            total = rowtotal(qty, mrp_item);
        }
        var additional_cess = $('#additional_cess').val();
        var tax_before = tax;
        var item_ces_per = $('#item_ces_per').val();
        if (parseFloat(additional_cess) > 0 && parseFloat(item_ces_per) > 0) {
            tax_before = parseFloat(tax) + parseFloat(item_ces_per);
        }

        if (cess > 0 && saletype === 'b2c' && exceedcessdate < 1 ) {
            tax_before = parseFloat(tax_before) + parseFloat(cess);
        }

        var cig_total = total;
        var is_cigarette_cess = $('#is_cigarette_cess').val();
        if(is_cigarette_cess > 0 ){
            var cig_ces_per = $('#cig_ces_per').val();
            var unit_cig_ces_amt = $('#unit_cig_ces_amt').val();
            var cig_ces_per_amount = 0;
            var cig_ces_amt = 0;
            if(parseFloat(unit_cig_ces_amt) > 0  ){
                cig_ces_amt = parseFloat(unit_cig_ces_amt) * parseFloat(qty);
                cig_total = parseFloat(total) - parseFloat(cig_ces_amt);
            }
            if(parseFloat(cig_ces_per) > 0  && parseFloat(cig_total) > 0 ){
                tax_before = parseFloat(tax_before) + parseFloat(cig_ces_per);
                cig_ces_per_amount = parseFloat(cig_total) * parseFloat(cig_ces_per) / 100;
                txamt = ((parseFloat(cig_total) * 100) / (parseFloat(tax_before) + 100));
                cig_ces_per_amount = txamt * cig_ces_per / 100;

            }
            $('#cig_ces_amt').val(cig_ces_amt);
            $('#cig_ces_per_amount').val(cig_ces_per_amount);
        }


        var taxamt = parseFloat(cig_total) - ((parseFloat(cig_total) * 100) / (parseFloat(tax_before) + 100));
        var cess_amount = parseFloat(total) - parseFloat(taxamt);
        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();
        
        if (is_taxincuded === "0") {
            taxamt = parseFloat(cig_total) * parseFloat(tax) / 100;
            cess_amount = parseFloat(total);
            if (purchase_tax_on_mrp > 0 ) {
                var item_tax_on_mrp = $('#item_tax_on_mrp').val();  
                if (item_tax_on_mrp > 0) {
                    var itmMrp = parseFloat($('#sale_mrp').val()) || 0;
                    var qty = parseFloat(qty) || 0;
                    var taxRate = parseFloat(tax) || 0;

                    // TAX INCLUSIVE FORMULA: (Total Amount * Tax Rate) / (100 + Tax Rate)
                    var totalInclusiveAmount = itmMrp * qty;
                    taxamt = (totalInclusiveAmount * taxRate) / (100 + taxRate);
                }
            }
            total = (parseFloat(total) + parseFloat(taxamt));
        } else {
            <?php if(strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa'){?>
                taxamt = parseFloat(cig_total) * parseFloat(tax) / 100;
                taxamt = parseFloat(cig_total) * parseFloat(tax) / 100;
            cess_amount = parseFloat(total);
                    if (purchase_tax_on_mrp > 0 ) {
                        var item_tax_on_mrp = $('#item_tax_on_mrp').val();  
                        if (item_tax_on_mrp > 0) {
                            var itmMrp = parseFloat($('#sale_mrp').val()) || 0;
                            var qty = parseFloat(qty) || 0;
                            var taxRate = parseFloat(tax) || 0;

                            // TAX INCLUSIVE FORMULA: (Total Amount * Tax Rate) / (100 + Tax Rate)
                            var totalInclusiveAmount = itmMrp * qty;
                            taxamt = (totalInclusiveAmount * taxRate) / (100 + taxRate);
                        }
                    }

                console.log('total:'+total+'taxamt:'+taxamt);
                cess_amount = parseFloat(total);
                total = (parseFloat(total) + parseFloat(taxamt));
            <?php }else {?>
                taxamt = ((parseFloat(cig_total) * 100) / (parseFloat(tax_before) + 100));
                taxamt = taxamt * tax / 100;
                taxamt = parseFloat(cig_total) * parseFloat(tax) / 100;
            cess_amount = parseFloat(total);
                    if (purchase_tax_on_mrp > 0 ) {
                        var item_tax_on_mrp = $('#item_tax_on_mrp').val();  
                        if (item_tax_on_mrp > 0) {
                            var itmMrp = parseFloat($('#sale_mrp').val()) || 0;
                            var qty = parseFloat(qty) || 0;
                            var taxRate = parseFloat(tax) || 0;

                            // TAX INCLUSIVE FORMULA: (Total Amount * Tax Rate) / (100 + Tax Rate)
                            var totalInclusiveAmount = itmMrp * qty;
                            taxamt = (totalInclusiveAmount * taxRate) / (100 + taxRate);
                        }
                    }
            <?php }?>

        }

        if (cess > 0) {
            console.log(cess_amount);
            row_cess = parseFloat(cess_amount) * parseFloat(cess) / 100;
        }

        
        


        var rowitemces = 0;
        if (parseFloat(additional_cess) > 0) {
            var item_ces_per = $('#item_ces_per').val();
            var item_ces_id = $('#item_ces_id').val();
            if (parseFloat(item_ces_per) > 0 && parseFloat(cess_amount) > 0) {
                rowitemces = parseFloat(cess_amount) * parseFloat(item_ces_per) / 100;
            }
        }
        if (rowitemces === undefined) {
            rowitemces = 0;
        }
        $('#itemcesamt').val(rowitemces.toFixed(company_roundoff));
        if (is_taxincuded === "0") {
            total = (parseFloat(total) + parseFloat(rowitemces));
            //total = (parseFloat(total) + parseFloat(row_cess));
        }
        if (!isNaN(taxamt)) {
            $("#rowTax").val(taxamt.toFixed(company_roundoff));
            $("#rowTotal").val(total.toFixed(company_roundoff));
        }
        $('#row_cess').val(cess);
        if (!isNaN(row_cess)) {
            $('#row_cess_amount').val(row_cess.toFixed(company_roundoff));
        }
    }

    function rowtotal(qty, prate) {
        return (parseFloat(qty) * parseFloat(prate)).toFixed(company_roundoff);
    }

    function callBackAfterSave(id) {
        alert(id.message)
    }

    function setbillno(id) {
		var set_rate = $('#btype').find(':selected').attr('set_rate');
		var cus_rate = $('#cus_rate').val();
		if(cus_rate === '' ){
			$('#set_rate').val(set_rate);
		}
        var sid = $('#id').val();
		var date = $('#date').val();
        if (sid === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/sales/getnewinoviceno'); ?>/" + id,
				type: 'POST',
                data: {
                    date: date
                },
                success: function(result) {
                    $('#b_no').html(result);
                    $('#iv_no').html(result);
                    var suffix = $('#btype').find(':selected').attr('suffix');
                    var prefix = $('#btype').find(':selected').attr('preffix');
                    var seperator = $('#btype').find(':selected').attr('seperator');
                    $('#autoinvoice').val(prefix + seperator + result + seperator + suffix);
                    $("#new_invoice").val(prefix + seperator + result + seperator + suffix);
                    $('#sep_second').html(seperator);
                    $('#sep_first').html(seperator);
                    $('#suffix').html(suffix);
                    $('#prefix').html(prefix);
                    //                    document.getElementById("b_no").contentEditable = true;
                }
            });
        }
    }

    function ref() {
        var reference = getVal('reference');
        if (reference !== 0 && reference !== null && reference !== '0') {
        //    $("#commi_amt").show();
        } else {
            $("#commi_amt").hide();
        }
    }
    $.validate({
        validateHiddenInputs: true,
        modules: 'date, security,file'
    });

    function advance() {
        var adv = $("#type").val();
        if (adv === 'Cash') {
            $("#advance").attr('readonly', 'readonly');
        } else {
            $("#advance").removeAttr('readonly');
        }
    }
    var frmcreate = 0;
    var is_taxincuded;
	
    $(document).on('keyup', '.frow', function(e) {
        var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
				$('#itemname').focus();
                $('#itemcode').focus();
			}
    });
	$(document).on('keydown', '.tditmqty', function() {
		var attrid = $(this).attr('attrid');
		var KeyID = (window.event) ? event.keyCode : e.keyCode;
		switch (KeyID)
		{
        case 18:
            previousKeyCode = 18;
            break;
        case 81:
            if (previousKeyCode == 18) {
				var unit_qty = $('#unitqty'+attrid).val();
                $('#unit_qty').val(unit_qty);
				$('#modal_quantity_rowid').val(attrid);
				$("#modal-quantity").modal();
            }
            previousKeyCode=KeyID;
            break;
		default: previousKeyCode=KeyID;
		}
		
	});
    $(document).on('click', '.itemdamage', function() {
        var attrid = $(this).attr('attrid');
        var item_damage = $('#item_damage').val();
        var ttype = $('#ttype').val();
        $('#actual_quantity').val($(this).val());
        $('#damage_quantity').val(0);
        $('#sales_quantity').val($(this).val());
        if (parseFloat(item_damage) > 0 && ttype === 'sales') {
            $('#rowid').val(attrid);
            $("#modal-damage").modal();
        }
    });

	
	
	
    function nav(key, id) {
        $(document).bind('keydown', key, function(evt) {
            $(id).focus();
            return false;
        });
        $(':input').bind('keydown', key, function(evt) {
            $(id).focus();
            return false;
        });
    }


function editrowdes(attrid){
    var my_itemdescription  = $('#itmdtn'+attrid).val();
    $('#itmdecrowid').val(attrid);
    $('#itmdec').val(my_itemdescription);
    $('#modal-itmdec').modal('show');
}


    $(document).ready(function() {

        $('#tcs_percentage').change(function(){
            calculateGTotal();
        });
        $('.dates').val('');
        $.ajax({
            url: "<?php echo site_url('ajaxcall/uqc'); ?>",
            async:false,
            success: function(result) {
                $('#sqftunit').html(result);
            }
        });

        $('#add_itmdec').click(function(){
            var itmdecrowid = $('#itmdecrowid').val();
            var itmdec = $('#itmdec').val();
            $('#itmdtn'+itmdecrowid).val(itmdec);

            var itm = getIndexOf(items, itmdecrowid);
            var iteadd = items[itm];
            iteadd.item_discription = itmdec;
            items[itm] = iteadd;
            localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));

        });



        $('#add_SQFTquantity').click(function(){
            var sqftrowid = $('#sqftrowid').val();
            if(sqftrowid < 1 ){
                var sqft_quantity = $('#sqft_quantity').val();
                $('#item_qty').val(sqft_quantity);
                $('#modal-sqft').modal('hide');
                $('#mrp_item').focus();
            }else{
                var sqft_quantity = $('#sqft_quantity').val();
                $('#itmqty'+sqftrowid).val(sqft_quantity);
                var sqft_number = $('#sqft_number').val();
                var sqftunit = $('#sqftunit').val();
                var item_SQFT = $('#item_SQFT').val();
                $('#itemSQFTNO'+sqftrowid).val(sqft_number);
                $('#itmdtn'+sqftrowid).val(sqftunit);
                 if(sqftunit != ''){
                    var optionText = $('#sqftunit option[value="' + sqftunit + '"]').text();
                }else{
                    var optionText = 'Nil';
                }
                $('#pushpaunit'+sqftrowid).val(optionText);
                $('#itemItemSQFT'+sqftrowid).val(item_SQFT);
                $('#sqftrowid').val(0);
                $('#modal-sqft').modal('hide');
                calculaterowdis(sqftrowid);
                $('#sqft_number').val(0);
                $('#sqft_quantity').val(0);
                $('#sqft_quantity').trigger('change');
            }
            
        });

        $('.clssqftmodal').change(function(){
            var sqft_number = $('#sqft_number').val();
            var sqft_quantity = $('#sqft_quantity').val();
            if(sqft_quantity == ''){
                sqft_quantity = 0 ;
            }
            if(sqft_number == ''){
                sqft_number = 0 ;
            }
            var Is_SQFT_cal = $('#Is_SQFT_cal').val();
            if(Is_SQFT_cal < 1){
                if(sqft_number > 0 ){
                    $('#sqft_quantity').attr('readonly',true);
                    var item_SQFT = $('#item_SQFT').val();
                    if(item_SQFT ==''){
                        item_SQFT = 0 ;
                    }
                    var quantity = item_SQFT * sqft_number;
                    $('#sqft_quantity').val(parseFloat(quantity).toFixed(2));

                }else{
                    $('#sqft_quantity').removeAttr('readonly');

                }
            }
            

        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/ims_driver'); ?>",
            async:false,
            success: function(result) {
               // $('#driver').html(result);
            }
        });
        
        $('#btncontinued').click(function(){
            formsubmit($("#frmcreate"));
        });
        $('#btndiscontinued').click(function(){
            $('#supid').val(0);
            $('#supname').val('');
            $('#saletype').val('b2c');
            $('#bname').val('');
            $('#phone').val('');
            $('#address_line1').val('');
            $('#gst').val('');
            $('#creditmodals').modal('hide');
        });

        $('#btndiscontinue').click(function(){
            $('#supid').val(0);
            $('#supname').val('');
            $('#saletype').val('b2c');
            $('#bname').val('');
            $('#phone').val('');
            $('#address_line1').val('');
            $('#gst').val('');
            $('#creditmodal').modal('hide');
        });
		$('#modal-discount').on('shown.bs.modal', function() {
			$(this).find('[autofocus]').focus();
		});

        $('#modal-sqft').on('shown.bs.modal', function() {
			$(this).find('[autofocus]').focus().selected();
            
		});
		
		$('#add_unit_dis').click(function(){
            var modal_discount_rowid = $('#modal_discount_rowid').val();
            if(parseFloat(modal_discount_rowid) >  0 ){
                var add_dis_per = $('#add_dis_per').val();
                var id = modal_discount_rowid;
                var itm = getIndexOf(items, id);
                var iteadd = items[itm];
                iteadd.add_dis_per = add_dis_per;
                items[itm] = iteadd;
                $('#adddisper'+id).val(add_dis_per );
                localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
                calculaterow(id);

            }
        });
        $('#add_dis_per').change(function(){
            var modal_discount_rowid = $('#modal_discount_rowid').val();
            var  add_dis_per = $(this).val();
            if(parseFloat(modal_discount_rowid) < 1 ){
                $('#add_dis_balance').val(0);
                $('#add_dis_amt').val(0);
                var add_dis_to_amt  =$('#add_dis_to_amt').val();
                if(parseFloat(add_dis_per)  > 0 ){
                    var add_dis = parseFloat(add_dis_to_amt) * parseFloat(add_dis_per)/100;
                    $('#add_dis_amt').val(parseFloat(add_dis).toFixed(2));
                    var add_dis_balance = parseFloat(add_dis_to_amt)  - parseFloat(add_dis);
                    $('#add_dis_balance').val(parseFloat(add_dis_balance).toFixed(2));

                }
                rowcalc();

            }else{
                $('#add_dis_balance').val(0);
                $('#add_dis_amt').val(0);
                var id  =modal_discount_rowid;
                var mrp_item = getVal('itmmrp' + id);
                var qty = getVal("itmqty" + id);
                if(qty === ''){
                    qty = 0 ;
                }
                var prate_item = getVal('itmrate' + id);

                var tax = getVal("itmtaxper" + id);
                var additional_cess = $('#additional_cess').val();
                var tax_before = tax;
                var itm_ces_per = $("#itm_ces_per" + id).val();
                if (parseFloat(additional_cess) > 0 && parseFloat(itm_ces_per) > 0) {
                    tax_before = parseFloat(tax) + parseFloat(itm_ces_per);
                }
                is_taxincuded = $("#is_taxincuded" + id).val();

                if (is_taxincuded === "0") {

                }else{
                        <?php if(strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa'){?>
                            mrp_item =  ((parseFloat(mrp_item) * 100) / (parseFloat(tax_before) + 100));
                            mrp_item = parseFloat(mrp_item).toFixed(5);
                        <?php }?>
                }
                var dis = getVal("itmrate" + id);
                total = ((parseFloat(mrp_item) * parseFloat(qty)) - dis);

                if(parseFloat(add_dis_per) > 0 ){
                    var add_dis_amt  = parseFloat(total) * parseFloat(add_dis_per) /100;
                    $('#add_dis_amt').val(add_dis_amt);
                    total = parseFloat(total) - parseFloat(add_dis_amt);
                    var add_dis_to_amt  =$('#add_dis_to_amt').val();
                    var add_dis_balance =  add_dis_to_amt * parseFloat(add_dis_per) /100;
                    add_dis_balance = add_dis_to_amt - add_dis_balance ;
                    $('#add_dis_balance').val(parseFloat(add_dis_balance).toFixed(2));
                }

            }
        });
		$('.myspop').tooltip({ container: 'body' }) 

		$('.myspop').popover({
  
        // Set the placement of 
        // the popup to the top
        placement: 'top',
        trigger: 'hover'
      });
	  $('input').on('hide.bs.popover', function (e) {
			e.preventDefault();
		});
	  
		$('#add_unit_qty').click(function(){
			$('#item_qty').focus();
			var modal_quantity_rowid = $('#modal_quantity_rowid').val();
			var unit_qty = $('#unit_qty').val();
			if(parseFloat(modal_quantity_rowid) > 0  ){
				var itm = getIndexOf(items, modal_quantity_rowid);
				var iteadd = items[itm];
				iteadd.unit_qty = unit_qty;
				items[itm] = iteadd;
				localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
				$('#unitqty'+modal_quantity_rowid).val(unit_qty);

			}
		});
		$('#unit_qty').keydown(function(e){
			var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
				$('#add_unit_qty').trigger('click');
				
			}
		});
		$.ajax({
        url: "<?php echo site_url('ajaxcall/printtype'); ?>/" + $('#ttype').val(),
		async:false,
        success: function(result) {
            var terms_condition = $('#terms_condition').val();
            //            $('#tms_con').val();
            //            $('#tms_con').val(terms_condition);
            var user_default_printtype = $('#user_default_printtype').val();
            $('#printtype').html(result);
            if (user_default_printtype !== "") {
                $('#printtype').val(user_default_printtype);
            }
        }
    });
		$('input[type=radio][name=bank_pay_method]').trigger('change');
		$.ajax({
            url: "<?php echo site_url('transaction/Sales/cess_details'); ?>",
			async:false,
            success: function(result) {
                date2 = result;
				date2 = formatdates(date2);
            }
        });
		var  sale_cash_type =$('#sale_cash_type').val();
		var sa_id = $('#id').val();
		if(parseFloat(sa_id) < 1  ){
			$('#type').val(sale_cash_type);
		}
        nav('Alt+i', "#itemname");
        nav('Alt+c', "#supname");
        nav('Alt+d', "#itemcode");
        
        $("#itemname").keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
                var name = $(this).val();
                var id = $('#item_id').val();
                if (id === '') {
                    id = 0;
                }
                if (parseFloat(id) < 1) {
                    e.preventDefault();
                    $("#itemname").focus();
                }
            }
        });
        $("#itemcode").keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 9) {
                <?php if ($barcode_settings === "0") { ?> 
                    itemsearch();
                <?php }?>
            }

        });
		$("#prate_item").bind('keydown', 'Alt+d', function(evt) {
            $('#modal_discount_rowid').val(0);
            var quantity = $('#item_qty').val();
            var prate_item = $('#prate_item').val();

            if(quantity ===''){
                quantity = 0;
            }
            var mrp_item = $('#mrp_item').val();
            if(mrp_item ===''){
                mrp_item = 0;
            }
            var total = parseFloat(quantity) * parseFloat(mrp_item);
            if(parseFloat(total) > 0  && parseFloat(prate_item) > 0  ){
                var dis = parseFloat(total) * parseFloat(prate_item)/100;
                var total = parseFloat(total) - parseFloat(dis);
                $('#add_dis_to').html(total);
                $('#add_dis_to_amt').val(total);
                $('#add_dis_per').trigger('change');
                $('#add_unit_dis').attr('style','display:none;');
                $('#add_unit_dis_add').attr('style','');
			    $("#modal-discount").modal();

            }
		});
		
		
		$("#mrp_item").bind('keydown', 'Alt+n', function(evt) {
				var item_id = $('#item_id').val();
				if(parseFloat(item_id) > 0 ){
					$.ajax({
						url: "<?php echo site_url('item/getsing'); ?>/" + item_id,
						async:false,
						success: function(results) {
							var result = JSON.parse(results);
							var prate = result.prate;
							var landing_cost = result.landing_cost;
							var MRP = result.MRP;
							var srate = result.srate;
							var wholerate = result.wh_rate;
							var special_rate = result.special_rate;
							$('.cls_lcrate').html(landing_cost);
							$('.cls_prate').html(prate);
							$('.margin_mrp').html(MRP);
							$('.margin_srate').html(srate);
							$('.margin_whrate').html(wholerate);
							$('.margin_special_rate').html(special_rate);
		
		
							var prate_margin_salerate = parseFloat(srate) - parseFloat(prate);
							var prate_margin_mrp = parseFloat(MRP) - parseFloat(prate);
							var prate_margin_wharte =  parseFloat(wholerate) - parseFloat(prate);
							var prate_margin_special_rate = parseFloat(special_rate) - parseFloat(prate);
			
							var lc_margin_salerate = parseFloat(srate) - parseFloat(landing_cost);
							var lc_margin_mrp =  parseFloat(MRP) - parseFloat(landing_cost);
							var lc_margin_wharte = parseFloat(wholerate) - parseFloat(landing_cost);
							var lc_margin_special_rate =  parseFloat(special_rate) - parseFloat(landing_cost);
		
							$('#prate_margin_salerate').html(prate_margin_salerate);
							$('#prate_margin_mrp').html(prate_margin_mrp);
							$('#prate_margin_wharte').html(prate_margin_wharte);
							$('#prate_margin_special_rate').html(prate_margin_special_rate);
							
							var percentage_margin_salerate = 0;
							var percentage_margin_mrp = 0;
							var percentage_margin_wharte = 0;
							var percentage_margin_special_rate = 0;
		if(parseFloat(prate_margin_salerate) > 0 && parseFloat(srate) > 0 ){
			percentage_margin_salerate = parseFloat(prate_margin_salerate) * 100 / parseFloat(srate);
			percentage_margin_salerate = (srate - prate ) / (prate );
			percentage_margin_salerate = percentage_margin_salerate * 100;
		}
		
		if(parseFloat(prate_margin_mrp) > 0 && parseFloat(MRP) > 0 ){
			percentage_margin_mrp = parseFloat(prate_margin_mrp) * 100/ parseFloat(MRP);
			percentage_margin_mrp = (MRP - prate ) / (prate );
			percentage_margin_mrp = percentage_margin_mrp * 100;
		}
		
		if(parseFloat(prate_margin_wharte) > 0 && parseFloat(wholerate) > 0 ){
			percentage_margin_wharte = parseFloat(prate_margin_wharte) * 100/ parseFloat(wholerate);
			percentage_margin_wharte = (wholerate - prate ) / (prate );
			percentage_margin_wharte = percentage_margin_wharte * 100;
		}
		
		if(parseFloat(prate_margin_special_rate) > 0 && parseFloat(special_rate) > 0 ){
			percentage_margin_special_rate = parseFloat(prate_margin_special_rate) * 100/ parseFloat(special_rate);
			percentage_margin_special_rate = (special_rate - prate ) / (prate );
			percentage_margin_special_rate = percentage_margin_special_rate * 100;
		}
		
							$('#percentage_margin_salerate').html(percentage_margin_salerate);
							$('#percentage_margin_mrp').html(percentage_margin_mrp);
							$('#percentage_margin_wharte').html(percentage_margin_wharte);
							$('#percentage_margin_special_rate').html(percentage_margin_special_rate);
		
		
							$('#lc_margin_salerate').html(lc_margin_salerate);
							$('#lc_margin_mrp').html(lc_margin_mrp);
							$('#lc_margin_wharte').html(lc_margin_wharte);
							$('#lc_margin_special_rate').html(lc_margin_special_rate);
							
							var lcp_margin_salerate = 0;
							var lcp_margin_mrp = 0;
							var lcp_margin_wharte = 0;
							var lcp_margin_special_rate = 0;
		
		if(parseFloat(lc_margin_salerate) > 0 && parseFloat(srate) > 0 ){
			lcp_margin_salerate = parseFloat(lc_margin_salerate) * 100/ parseFloat(srate);
			lcp_margin_salerate = (srate - landing_cost ) / (landing_cost );
			lcp_margin_salerate = lcp_margin_salerate * 100;
		}
		
		if(parseFloat(lc_margin_mrp) > 0 && parseFloat(MRP) > 0 ){
			lcp_margin_mrp = parseFloat(lc_margin_mrp) * 100/ parseFloat(MRP);
			lcp_margin_mrp = (MRP - landing_cost ) / (landing_cost );
			lcp_margin_mrp = lcp_margin_mrp * 100;
		}
		
		if(parseFloat(lc_margin_wharte) > 0 && parseFloat(wholerate) > 0 ){
			lcp_margin_wharte = parseFloat(lc_margin_wharte) * 100/ parseFloat(wholerate);
			lcp_margin_wharte = (wholerate - landing_cost ) / (landing_cost );
			lcp_margin_wharte = lcp_margin_wharte * 100;
		}
		
		if(parseFloat(lc_margin_special_rate) > 0 && parseFloat(special_rate) > 0 ){
			lcp_margin_special_rate = parseFloat(lc_margin_special_rate) * 100/ parseFloat(special_rate);
			lcp_margin_special_rate = (special_rate - landing_cost ) / (landing_cost );
			lcp_margin_special_rate = lcp_margin_special_rate * 100;
		}
		
							$('#lcp_margin_salerate').html(lcp_margin_salerate);
							$('#lcp_margin_mrp').html(lcp_margin_mrp);
							$('#lcp_margin_wharte').html(lcp_margin_wharte);
							$('#lcp_margin_special_rate').html(lcp_margin_special_rate);
						}
						
					});
					 $("#modal-margin").modal();
				}
		});
		
		
		$("#item_qty").bind('keydown', 'Alt+q', function(evt) {
			$('#unit_qty').val(0);
			$('#modal_quantity_rowid').val(0);
			$("#modal-quantity").modal();
		});
        $("#mrp_item").bind('keydown', 'Alt+r', function(evt) {
            var trtext = '';
            var itemname = '';
            var item_id = $('#item_id').val();
            var supid = $('#supid').val();
            var text = '<tr><td style="text-align:center" colspan="3">Old Rate Not Available</td></tr>';
            $('#bodyrate').html(text);
            if (item_id === '') {
                item_id = 0;
            }
            if (supid === '') {
                supid = 0;
            }
            if (parseFloat(item_id) > 0) {
                itemname = $('#itemname').val();
            }
            if (parseFloat(item_id) > 0 && parseFloat(supid) > 0) {
                $.ajax({
                    url: "<?php echo site_url('transaction/Sales/get_old_rate'); ?>",
                    type: 'post',
                    async: false,
                    data: {
                        item_id: item_id,
                        supid: supid
                    },
                    success: function(result) {
                        $.each(JSON.parse(result), function(i, itemsingle) {
                            itemname = itemsingle.name;
                            trtext = trtext + '<tr><td>' + itemsingle.invoice_date + '</td><td>' + itemsingle.invoice + '</td><td>' + itemsingle.mrp + '</td></tr>';

                        });
                    }
                });
            } else {

            }
            if (trtext !== '') {
                $('#bodyrate').html(trtext);
            }
            $('#item_header').html(itemname);
            $("#modal-old-srate").modal();
        });
        $('#actual_quantity').val(1);
        $('#damage_quantity').val(0);
        $('.clsdamage').change(function() {
            var actual_quantity = $('#actual_quantity').val();
            var damage_quantity = $('#damage_quantity').val();
            if (actual_quantity === "") {
                $('#actual_quantity').val(1);
                actual_quantity = 1;
            }
            if (damage_quantity === "") {
                $('#damage_quantity').val(0);
                damage_quantity = 0;
            }
            var quantity = actual_quantity - damage_quantity;
            $('#sales_quantity').val(quantity);

        });
        $('#add_damage').click(function() {
            var actual_quantity = $('#actual_quantity').val();
            var damage_quantity = $('#damage_quantity').val();
            var quantity = actual_quantity - damage_quantity;
            var rowid = $('#rowid').val();
            if (parseFloat(rowid) > 0) {
                $('#itmqty' + rowid).val(quantity);
                $('#item_damage_quantity' + rowid).val(damage_quantity);
                $('#item_actual_quantity' + rowid).val(actual_quantity);
                calculaterowdis(rowid);
            } else {
                $('#item_qty').val(quantity);
                $('#mrp_item').focus();
            }

        });
        $('#modal-damage').on('shown.bs.modal', function() {
            $('#actual_quantity').focus().select();
        });
		 $('#modal-quantity').on('shown.bs.modal', function() {
            $('#unit_qty').focus().select();
        });
        $('#redeem_points').change(function() {
            $('#redeem_amount').val(0);
            var one_currency_equivalent = $('#one_currency_equivalent').val();
            var redeem_points = $(this).val();
            var total_points = $('#total_points').val();
            if (parseFloat(redeem_points) > parseFloat(total_points)) {
                redeem_points = total_points;
            }
            if (total_points > 0) {
                currency_amount = parseFloat(redeem_points) / parseFloat(one_currency_equivalent);
                //currency_amount = Math.trunc(currency_amount);
                currency_amount = currency_amount;
                $('#redeem_amount').val(currency_amount);
                var amount = parseFloat(currency_amount) * parseFloat(one_currency_equivalent);
                $('#redeem_points').val(amount);
            } else {
                $(this).val(0);
            }
        });
        var btnid = '';
        var id = $("#id").val();
        if (id === "0") {
            var salesitems = localStorage.getItem('salesitems<?php echo $type . $id; ?>');
            var deliver_note_id = $('#deliver_note_id').val();
            if (salesitems !== '' && salesitems !== null && parseFloat(deliver_note_id) < 1) {
                var store = JSON.parse(salesitems);
                var inc = 1;
                $.each(store, function(i, itemsingle) {
                    store[i].inc_id = inc;
                    var iteadd = new item(itemsingle.item_id, itemsingle.item_qty, itemsingle.godown, itemsingle.unit_item, itemsingle.tax_item, itemsingle.mrp_item, itemsingle.prate_item, itemsingle.itemname, itemsingle.comontax, itemsingle.rowTotal, itemsingle.tax_amount, itemsingle.commission, itemsingle.godown_name, itemsingle.unit_name, itemsingle.tax_name, itemsingle.dis_amt, itemsingle.pur_rate, itemsingle.is_taxincuded, itemsingle.margin, itemsingle.item_discription, itemsingle.barcode, itemsingle.analytics, itemsingle.analyticsname, itemsingle.row_cess, itemsingle.row_cess_amount, itemsingle.size, itemsingle.size_name, itemsingle.itembatch, itemsingle.free_qty, itemsingle.itm_fre_qty, itemsingle.itm_fre_qty_for, itemsingle.item_rate, itemsingle.item_ces_id, itemsingle.item_ces_per, itemsingle.item_ces_name, itemsingle.item_row_ces, itemsingle.actual_quantity, itemsingle.damage_quantity, itemsingle.sales_ref_id, itemsingle.sales_ref_type,itemsingle.emei,itemsingle.emei_pur_id,itemsingle.item_landing_cost,itemsingle.unit_qty,itemsingle.itm_mrp,itemsingle.itm_srate,itemsingle.itm_whrate,itemsingle.itm_spclrate,itemsingle.add_dis_per,itemsingle.add_dis_amt,itemsingle.pindex,itemsingle.SQFTNO,itemsingle.ItemSQFT,itemsingle.salitms_mrp,itemsingle.reorder_point,itemsingle.godown_stock,itemsingle.cig_ces_per,itemsingle.unit_cig_ces_amt,itemsingle.cig_ces_per_amount,itemsingle.cig_ces_amt,itemsingle.item_tax_on_mrp);
                    addrowtoTable(iteadd);
                    items.push(iteadd);
                    inc++;
                });

            }
        }
        is_taxincuded = $("#is_taxincuded").val();
        $("#is_tax").val(is_taxincuded);


        $("#mClick").click(function(e) {

            var form = "";
            var opt = $("#newtype").val();
            if (opt === "item") {
                $('#' + btnid).click();
                form = 'frmcreatemodeli';
                var formId = "#" + form + "";
                var formSerilize = $(formId).serialize();
                console.log(formSerilize);
                var isValid = $(formId).isValid();
                if (isValid) {
                    $.ajax({
                        url: $(formId).attr('action'),
                        method: 'post',
                        data: formSerilize,
                        success: function(response) {
                            var json = JSON.parse(response);
                            if (json.valid === true) {
                                itemsearchbyid(json.id);
                                $('#mcb').click();
                            } else {
                                $('#mcb').click();
                            }
                        }
                    });
                }


            }
            if (opt === "customer") {
                //                $('#mcb').click();
                e.preventDefault();
                form = 'frmcreatemodelc';
                var formId = "#" + form + "";
                var formSerilize = $(formId).serialize();
                var isValid = $(formId).isValid();
                if (isValid) {
                    $.ajax({
                        url: $(formId).attr('action'),
                        method: 'post',
                        data: formSerilize,
                        success: function(response) {
                            var json = JSON.parse(response);
                            console.log(json);
                            if (json.valid === true) {
                                loadCustByid(json.id,'old');
                                console.log(json.id);
                                e.preventDefault();
                                $('#mcb').click();
                            } else {
                                $('#mcb').click();
                            }
                        }
                    });
                }
            }


        });
        $("#btnAddExtra").click(function() {
            $('#modelextra').modal();
        });
        showbtn(1);
        advance();
        ref();
        $("#form-button-save").click(function() {
            var i = 0;
            if (!$(this).is(':disabled')) {
                showbtn(0);
                var type = $("#type").val();
                var name = $("#supid").val();
                if (type === 'credit' && name === '') {
                    
                } else {
                    if (frmcreate === 0) {
                        var ms = $("#frmcreate").isValid();
                        if (ms === true) {
                            var show_criterion = $('#show_criterion').val();
                            var trorange = 0;
                            var type = $('#type').val();
                            var supid = $('#supid').val();
                            var login_comid = $('#login_comid').val();
                            if(supid > 0 && login_comid == 'kmtrading' ){
                                $.ajax({
                                    url: "<?php echo site_url('ajaxcall/checkCustomerstatus'); ?>/" + supid,
                                    success: function(results) {
                                        var result = JSON.parse(results);
                                        var gt = $('#gtotal').val();
                                        var ledbalcontinue  = 1;
                                        var credit_amount = result.credit_amount;
                                        if(parseFloat(credit_amount) > 0  ){
                                            var bal = result.bal;
                                            if(parseFloat(bal) + parseFloat(gt)  >=credit_amount  ){
                                                ledbalcontinue = 0 ;
                                            }
                                        }


                                        $('#is_warning').val(result.warning);
                                        $('#is_ban').val(result.ban);
                                        var ban = result.ban;
                                        var warning = result.warning;
                                        var ban_text = result.ban_text;
                                        var warning_text = result.warning_text;
                                        var ban_amt = 0 ;
                                        var warning_amt = 0 ;
                                        var single_inv_cr_limit = result.single_inv_cr_limit;
                                        if(single_inv_cr_limit === ''){
                                            single_inv_cr_limit = 0;
                                        }
                                        var single_inv_cr_limit_action = result.single_inv_cr_limit_action;
                                        if(single_inv_cr_limit_action === ''){
                                            single_inv_cr_limit_action = 0;
                                        }
                                        if(parseFloat(single_inv_cr_limit) > 0 ){
                                            var tot = $('#gtotal').val();
                                            if(parseFloat(tot) > parseFloat(single_inv_cr_limit) ){
                                                if(parseFloat(single_inv_cr_limit_action) > 0 ){
                                                    ban_amt = 1;
                                                }else{
                                                    warning_amt = 1;
                                                }
                                            }
                                        }
                                        $('#btncontinued').attr('style','');
                                        var ttype = $('#ttype').val();
                                        if(ttype === 'sales_return'){
                                            formsubmit($("#frmcreate")); 
                                        }else if(parseFloat(ban) > 0 ){
                                            $('#credittxts').html(ban_text);
                                            $('#creditmodals').modal('show');
                                            $('#btncontinued').attr('style','display:none');
                                            $('#supid').val(0);
                                            $('#supname').val('');
                                            $('#saletype').val('b2c');
                                            $('#bname').val('');
                                            $('#phone').val('');
                                            $('#address_line1').val('');
                                            $('#gst').val('');
                                        }else if(ban_amt > 0 ){
                                            $('#credittxts').html('Customer Banned ! Invoice Credit Limit Exceded For this Customer ('+single_inv_cr_limit+') ');
                                            $('#creditmodals').modal('show');
                                            $('#btncontinued').attr('style','display:none');
                                            $('#supid').val(0);
                                                $('#supname').val('');
                                                $('#saletype').val('b2c');
                                                $('#bname').val('');
                                                $('#phone').val('');
                                                $('#address_line1').val('');
                                                $('#gst').val('');
                                        }else if(parseFloat(warning) > 0){
                                            $('#credittxts').html(warning_text);
                                            $('#creditmodals').modal('show');
                                        }else if(warning_amt > 0 ){
                                            $('#credittxts').html('Invoice Credit Limit Exceded For this Customer ('+single_inv_cr_limit+') ');
                                            $('#creditmodals').modal('show');
                                        }else if(ledbalcontinue < 1 ){
                                            $('#credittxts').html("Customer Ledger Balance  Exceeded it's limits");
                                            $('#creditmodals').modal('show');
                                            $('#btncontinued').attr('style','display:none');
                                            $('#supid').val(0);
                                            $('#supname').val('');
                                            $('#saletype').val('b2c');
                                            $('#bname').val('');
                                            $('#phone').val('');
                                            $('#address_line1').val('');
                                            $('#gst').val('');
                                        }else{
                                            formsubmit($("#frmcreate"));
                                        }

                                    }
                                });
                            }else if(show_criterion > 0 ){
								var cri = 0;
								var trred = 0 ;
								var trorange = 0;
								$( ".trred" ).each(function( index ) {
									cri = cri + 1;
									trred = trred + 1;
								});
                                var negative_stock_billing  = 0 ;
                                
								$( ".trorange" ).each(function( index ) {
									cri = cri + 1;
									trorange = trorange + 1;
                                    negative_stock_billing = 1;
								});
                                <?php if($negative_stock_billing < 1 ){?>
                                    if(negative_stock_billing > 0 ){
                                        calert('Insufficient Stock');
                                        return;
                                    }
                                <?php }?>
								if(cri > 0 ){
                                    console.log('<?php echo $user_type; ?>');
                                    console.log('<?php echo $login_comid; ?>');

                                    console.log('<?php echo $type; ?>');

                                    <?php if( strtolower($type) !='sales') {?>
                                                console.log(1);
                                    <?php }else{?>


                                            console.log(2);
                                                <?php }?>
                                        $.confirm({
										title: 'A secure action',
										content: 'Sales Contaion '+trorange+' Items with out efficient Stock (Marked as orange)  and '+trred+' Items With out quantity/rate (Marked Red) ',
										icon: 'fa fa-question-circle',
										animation: 'scale',
										closeAnimation: 'scale',
										opacity: 0.5,
										buttons: {
										'confirm': {
											text: 'Proceed',
											btnClass: 'btn-blue',
											action: function(){
											$.confirm({
                                            title: 'This maybe critical',
                                            content: 'Critical actions can have multiple confirmations like this one.',
                                            icon: 'fa fa-warning',
                                            animation: 'scale',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                <?php if( strtolower($type) !='sales1' ) {?>

                                                    confirm: {
                                                        text: 'Yes, sure!',
                                                        btnClass: 'btn-orange',
                                                        action: function(){
                                                            //if (frmcreate === 0) {
                                                                formsubmit($("#frmcreate"));
                                                                frmcreate = 1;
                                                                $("#frmcreate").attr('method','');
                                                            //}
                                                        }
                                                    },
                                                    cancel: function(){
                                                        
                                                    }
                                                <?php }else{?>
                                                    cancel: function(){
													
                                                    }
                                                <?php }?>
                                            }
                                        });
											}
										},
										cancel: function(){
										
										},
                                
                            }
                        });
								}else{
                                    if (frmcreate === 0) {
									    formsubmit($("#frmcreate"));
									    frmcreate = 1;
                                        $("#frmcreate").attr('method','');
                                    }
								}
							}else{
                                formsubmit($("#frmcreate"));
                            }
                        } else {
                            showbtn(0);
                            return;
                        }
                    }
                    frmcreate = 1;
                }
            }
        });
        $("#type").change(function() {
            advance();
        });
        $('.dshow').addClass('hidden');
        $('#btshow').click(function() {
            $('.dshow').removeClass('hidden');
        });
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function(event, ui) {
                loadpoints(ui.item.id);
                $.ajax({
                    url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                    success: function(results) {
                        //                        alert(results);
                        $("#balance").html("Closing Balance: " + results);
                    }
                });
                loadCust(ui);
                checkstatus(ui);
                //                alert(JSON.stringify(ui.item));

                $('#itemname').focus();
                $('#itemcode').focus();
            }
        });
        $("#ser_ledger").autocomplete({
            source: "<?php echo site_url('ajaxcall/ledgers/sales'); ?>",
            minLength: 2,
            select: function(event, ui) {
                $('#ser_ledgerid').val(ui.item.id);
                $('#ser_tax').val(ui.item.tax_id);
                $('#ser_ledger').val(ui.item.name);
                $('#ser_amt').focus();
            }
        });
        $(".cashcustomer").autocomplete({
            source: "<?php echo site_url('transaction/Sales/get_cashcustomer'); ?>",
            minLength: 2,
            select: function(event, ui) {
				 event.preventDefault();
                var cusname = ui.item.cusname;
				var cusphone  = ui.item.cusdetails;
				var cusaddress = ui.item.cusemail;
				$('#phone').val(cusphone);
				$('#bname').val(cusname);
				$('#address_line1').val(cusaddress);
				
            }
        });
		
        $('#reference').change(function() {
            calculateGTotal();
            $.ajax({
            url: "<?php echo site_url('ajaxcall/ref/'); ?>"+$(this).val(),
            success: function(result) {
                //$('#redp').html('AUC'+result);
            }
        });
        });
        $('#adjustment').change(function() {
            calculateGTotal();
        });
		$('#date').change(function() {
            var billtype = $('#btype').val();
            setbillno(billtype);
        });
		$('#salesman').change(function () { 
			var arr = [];
			var vehicle = $('#vehicle').val();
			var btypeid = $('#btype').val();
			var is_cashe = $('#is_cashe').val();
			var salesman = $('#salesman').val();
			var id = $("#id").val();
			if( parseFloat(is_cashe) > 0  && id === "0" ){
				arr.push({
					btype: btypeid,
					vehicle: vehicle,
					salesman:salesman,
				});
				createCookie('<?php echo $login_comid.$type; ?>createSales', JSON.stringify(arr), 3);
			}
		});
		$('#vehicle').change(function () { 
            var vh = $(this).val();
            if(vh !== '' && vh !== undefined){
                if(parseFloat(vh) > 0 ){
                    var driver =  $("#vehicle option:selected").attr('driver');
                    var vehicle_num =  $("#vehicle option:selected").attr('vehicle_num');
                    $('#vehicle_txt').val(vehicle_num);
                    $('#driver').val(driver);
                }
            }
			var arr = [];
			var vehicle = $('#vehicle').val();
			var btypeid = $('#btype').val();
			var is_cashe = $('#is_cashe').val();
			var salesman = $('#salesman').val();
			var id = $("#id").val();
			if( parseFloat(is_cashe) > 0  && id === "0" ){
				arr.push({
					btype: btypeid,
					vehicle: vehicle,
					salesman:salesman,
				});
				createCookie('<?php echo $login_comid.$type; ?>createSales', JSON.stringify(arr), 3);
			}
		});
        $('#btype').change(function () {
			var arr = [];
			var vehicle = $('#vehicle').val();
            var btypeid = $('#btype').val();
			var is_cashe = $('#is_cashe').val();
			var salesman = $('#salesman').val();
			var id = $("#id").val();
			if( parseFloat(is_cashe) > 0  && id === "0" ){
				arr.push({
					btype: btypeid,
					vehicle: vehicle,
					salesman:salesman,
				});
				createCookie('<?php echo $login_comid.$type; ?>createSales', JSON.stringify(arr), 3);
			}
            getbtype(btypeid);
            
            var billgodown = $("#btype option:selected").attr('godown');
            if (billgodown !== '0') {
                $('#godown').val(billgodown);
            }
			var user_default_godown = $('#user_default_godown').val();
            if (user_default_godown !== "" && parseFloat(user_default_godown) > 0) {
                $('#godown').val(user_default_godown);
            }
            var ctype = $('#btype').find(':selected').attr('Cash');
            var btype = $('#btype').find(':selected').attr('Bank');
            var ledger = $('#btype').find(':selected').attr('ledger');
            var bank_account = $("#bank_account").val();
            $("#Cash_in_hand").val(ledger);
            if (bank_account !== "") {
                btype = bank_account;
            }
            var type = $("#type").val();
            if (type === 'Bank') {
                $("#bank_account").val(btype);
                $("#paytype").val(btype);
            }
            if (type === 'Cash' || type === 'COB') {
                $("#paytype").val(ctype);
            }

            var btypeid = $('#btype').val();
            getbtype(btypeid);
            setbillno(btypeid)
        });
        //Tax
        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function(result) {
                $('#tax_item').html(result);
                $('#tax_common').html(result);
                $('#ser_tax').html(result);
            }
        });
		
        $.ajax({
            url: "<?php echo site_url('ajaxcall/states'); ?>",
			async:false,
            success: function(result) {
                $('#con_state').html(result);
                //                $('#con_state').val(45);
                $('#states').html(result);
                //                var code = $('#states').find(':selected').attr('code');
                $('#stcode').val(32);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function(result) {
                $('#godown').html(result);
					var user_default_godown = $('#user_default_godown').val();
                    if (user_default_godown !== "" && parseFloat(user_default_godown) > 0 ) {
                        $('#godown').val(user_default_godown);
                    }
            }
        });
        $("#Coupon").autocomplete({
            source: "<?php echo site_url('transaction/sales/getcoupon'); ?>",
            minLength: 2,
            select: function(event, ui) {
                $('#Coupon').val('');
                var dis = 0;
                if (ui.item.cou_discount !== '0' && ui.item.cou_discount !== '' && ui.item.cou_discount !== '0.000') {
                    dis = ui.item.cou_discount;
                } else if (ui.item.cou_discountp !== '0' && ui.item.cou_discountp !== '' && ui.item.cou_discountp !== '0.000') {
                    var total = $('#gtotal').val();
                    dis = (parseFloat(total) * parseFloat(ui.item.cou_discountp)) / 100;
                }
                var dis_amt = $('#discount').val();
                if (dis_amt !== '0' && dis_amt !== '') {
                    amount = parseFloat(dis_amt) + parseFloat(dis);
                } else {
                    amount = dis;
                }
                addrowtocoupon(ui.item.cou_id, ui.item.cou_code, ui.item.cou_discountp, dis);
                $('#discount').val(amount);
                calculateGTotal();
                $('#Coupon').val("");
                $('#Coupon').focus();
            }
        });
        $('.tatalcal').change(function() {
            calculateGTotal();
        });
        $('.tatalcald').change(function() {
            calculateGTotal(1);
        });
        $('.price').change(function() {
            rowcalc();
        });
        $('#addmore').click(function() {
            var row = $("#add").html();
            var newRow = "<tr>" + row + "</tr>";
            $("#rowm").append(newRow);
            $(".remove").removeClass("hidden");
            $(".remove").first().addClass("hidden");
        });
        $("#itemname").keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 27) {
                showbtn(1);
                $("#freight").focus();
            }

        });
        $("#item_qty").change(function(e) {
			var  item_qty = $('#item_qty').val();
			if(item_qty ===''){
				item_qty = 0;
			}
			if(item_qty !== '' ){
				item_qty = parseFloat(item_qty);
				item_qty = item_qty * 1000;
				item_qty = parseInt(item_qty);
				item_qty = item_qty / 1000;
				$('#item_qty').val(item_qty);
			}
		
            var damage_quantity = $('#damage_quantity').val();
            if (parseFloat(damage_quantity) > 0) {
                if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                    $("#item_qty").val(1);
                }
                var item_qty = $("#item_qty").val();
                $('#actual_quantity').val(item_qty);
                var sales_quantity = item_qty - $('#damage_quantity').val();
                $('#sales_quantity').val(sales_quantity);
                var item_damage = $('#item_damage').val();
                var ttype = $('#ttype').val();
                if (parseFloat(item_damage) > 0 && ttype === 'sales') {
                    $('#rowid').val(0);
                    $("#modal-damage").modal();
                }
            } else {
                if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                    $("#item_qty").val(1);
                }
                var item_qty = $("#item_qty").val();
                $('#actual_quantity').val(item_qty);
                $('#sales_quantity').val(sales_quantity);
            }
			
			var quantity_price = $('#quantity_price').val();
			var item_id = $('#item_id').val();
			if(parseFloat(quantity_price) > 0  && parseFloat(item_id) > 0  ){
				var item_qty = $("#item_qty").val();
				$.ajax({
					url: "<?php echo site_url('inventory_master/Item/get_item_quantity_price'); ?>/" + item_id,
					success: function(result) {
						$.each(JSON.parse(result), function(i, itemsingle) {
							if(itemsingle.qprice_type === "above"){
								if(parseFloat(item_qty) > parseFloat(itemsingle.qprice_above) ){
									$('#mrp_item').val(itemsingle.qprice_rate);
								}
							}
							
							if(itemsingle.qprice_type === "below"){
								if(parseFloat(item_qty) < parseFloat(itemsingle.qprice_below) ){
									$('#mrp_item').val(itemsingle.qprice_rate);
								}
							}
							
							if(itemsingle.qprice_type === "between"){
								if(parseFloat(item_qty) <= parseFloat(itemsingle.qprice_max) &&  parseFloat(item_qty) >= parseFloat(itemsingle.qprice_min) ){
									$('#mrp_item').val(itemsingle.qprice_rate);
								}
							}
							
							
						});
					}
				});
			}
			
        });
        $("#item_qty").keydown(function(e) {
            calculatefield();
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13) {
                if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                    $("#item_qty").val(1);
                }
				
                var freequantity = $('#freequantity').val();
                var item_qty = $("#item_qty").val();
                $('#actual_quantity').val(item_qty);
                if (freequantity === '1' || freequantity === 1 ) {
                    var item_free_qty = $('#item_free_qty').val();
                    var item_free_qty_for = $('#item_free_qty_for').val();
                    if(parseFloat(item_free_qty_for) > 0  ){
                        $('#free_qty').val(0.00);
                    }
                    if (parseFloat(item_free_qty) > 0 && parseFloat(item_free_qty_for) > 0 && $("#item_qty").val() > 0) {
                        var free = parseFloat($("#item_qty").val()) / parseFloat(item_free_qty_for);
                        free = Math.trunc(free);
                        free = item_free_qty * free;
                        if (parseFloat(free) > 0) {
                            $('#free_qty').val(free);
                        }
                    }
                }
                e.preventDefault();
                e.stopPropagation();
                $("#mrp_item").focus().select();
            } else if (key === 9) {
                if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                    $("#item_qty").val(1);
                }
				
				var freequantity = $('#freequantity').val();
                var item_qty = $("#item_qty").val();
                $('#actual_quantity').val(item_qty);
                if (freequantity === '1' || freequantity === 1 ) {
                    var item_free_qty = $('#item_free_qty').val();
                    var item_free_qty_for = $('#item_free_qty_for').val();
                    if(parseFloat(item_free_qty_for) > 0 ){
                        $('#free_qty').val(0.00);
                    }
                    if (parseFloat(item_free_qty) > 0 && parseFloat(item_free_qty_for) > 0 && $("#item_qty").val() > 0) {
                        var free = parseFloat($("#item_qty").val()) / parseFloat(item_free_qty_for);
                        free = Math.trunc(free);
                        free = item_free_qty * free;
                        if (parseFloat(free) > 0) {
                            $('#free_qty').val(free);
                        }
                    }
                }
				
				
                var item_qty = $("#item_qty").val();
                $('#actual_quantity').val(item_qty);
                var sales_quantity = item_qty - $('#damage_quantity').val();
                $('#sales_quantity').val(sales_quantity);
                var item_damage = $('#item_damage').val();
                var ttype = $('#ttype').val();
                if (parseFloat(item_damage) > 0 && ttype === 'sales') {
                    $("#modal-damage").modal();
                }
            }
        });
        $("#ser_amt").keydown(function(e) {
            var amount = $("#ser_amt").val();
            if (amount > 0) {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    addservices();
                }
            }

        });
        $("#tax_item").keydown(function(e) {
            var prate = getVal("dis_amt");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            var dis = 0.00;
            if (mrp_item !== '0' && qty !== '0' && prate !== 0 && prate > 0) {
                dis = (prate * 100 / (qty * mrp_item));
            }
           // $("#prate_item").val(parseFloat(dis).toFixed(company_roundoff));
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13) {
                e.preventDefault();
                e.stopPropagation();
                $("#mrp_item").focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#mrp_item").focus().select();
                }
                showbtn(1);
            }
            if (key === 9) {
                e.preventDefault();
                e.stopPropagation();
                $("#mrp_item").focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#itemcode").focus().select();
                }
                showbtn(1);
            }

        });
        $("#dis_amt").keydown(function(e) {
            var prate = getVal("dis_amt");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            var dis = 0.00;

            if (is_taxincuded === "0") {

            }else{
                <?php if(strtolower($login_comid) == 'test' || strtolower($login_comid) == 'jith' || strtolower($login_comid) == 'msa'){?>

                    mrp_item =  ((parseFloat(mrp_item) * 100) / (parseFloat(tax_before) + 100));
                    mrp_item = parseFloat(mrp_item).toFixed(5);
                    console.log('mrp_itemmrp_item'+mrp_item);
                <?php }?>

            }




            if (mrp_item > 0 && qty !== 0 && mrp_item !== '0' && prate !== 0 && mrp_item !== '' && prate !== '') {
                dis = (prate * 100 / (qty * mrp_item));
            }
            $("#prate_item").val(parseFloat(dis).toFixed(company_roundoff));
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13) {
                e.preventDefault();
                e.stopPropagation();
                $("#prate_item").focus().select();
            }
            if (key === 9) {
                e.preventDefault();
                e.stopPropagation();
                $("#prate_item").focus().select();
            }

        });
        $("#btnAddExtram").click(function() {
            add();
            showbtn(1);
            $('#btncls').click();
        });
        $('#txtExtra').keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 9 || key === 27) {
                $('#itemname').focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#itemcode").focus().select();
                }
                add();
                showbtn(1);
                $('#btncls').click();
            }
        });
        $("#itemname").bind('keydown', 'Ctrl+a', function(evt) {
            var list = '<div class="box-body"><table class="table table-striped table-condensed"><tr><th class="col-md-6">Name</th><th>Barcode</th><th>Quantity</th><th>MRP</th><th>SalesRate</th><th></th></tr>';
            var id = $("#item_id").val();
            var item = 0;
            $.ajax({
                url: "<?php echo site_url('ajaxcall/alter_items'); ?>/" + id,
                success: function(results) {
                    $.each(JSON.parse(results), function(i, itemsingle) {
                        if (i < 1) {
                            item = itemsingle.id;
                        }
                        list = list + '<tr>';
                        list = list + '<td><input  type="hidden" name="pop_item_id' + itemsingle.id + '" id="pop_item_id' + itemsingle.id + '" value="' + itemsingle.id + '"/><input class="form-control" style="height:25px"   id="pop_itemname' + itemsingle.id + '" NoTab="true" name="pop_itemname[]" value=' + itemsingle.name + '  /></td><td><input class="form-control"  style="height:25px" id="pop_barcode' + itemsingle.id + '" NoTab="true" name="pop_barcode[]" value=' + itemsingle.barcode + '  /></td><td><input class="form-control" style="height:25px"  id="pop_qty' + itemsingle.id + '" NoTab="true" name="pop_qty[]" value=' + itemsingle.item_qty + '  /></td><td><input class="form-control" style="height:25px"  id="pop_mrp[]" NoTab="true" name="pop_mrp[]" value=' + itemsingle.MRP + '  /><td><input class="form-control" style="height:25px"  id="pop_srate' + itemsingle.id + '" NoTab="true" name="pop_srate[]" onkeydown="additemcode(event,' + itemsingle.id + ')" value=' + itemsingle.srate + '  /></td><td> <button style="height:25px !important;"  onclick="additmcode(' + itemsingle.id + ')" data-toggle="tooltip" type="button"    title="Add To save" id="btnadditem"  class="btn " href="#"><span class="glyphicon glyphicon-plus"></span> </button></td>';
                        // list = list + '<a id="' + itemsingle.name + '" barcode="' + itemsingle.barcode + '" href="#" class="sela">' + itemsingle.name + '- ' + itemsingle.MRP + '</a>';
                        list = list + '</tr>';
                    });
                    list = list + '</table></div>';
                    $('#myDropdown').html(list);
                    $("#modal-alter").modal();
                }
            });
            return false;
        });
        $('#modelextra').on('shown.bs.modal', function() {
            $('#txtExtra').focus();
        });
        $("#prate_item").keydown(function(e) {
            calculatefield();
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {

                var is_extra = $("#is_extra").val();
                if (parseInt(is_extra) === 1) {
                    $('#modelextra').modal();
                    $("#itemname").focus().select();
                    var is_itemcode = $("#is_itemcode").val();
                    if (is_itemcode === "1") {
                        $("#itemcode").focus().select();
                    }

                } else {
                    add();
                    $("#itemname").focus().select();
                    var is_itemcode = $("#is_itemcode").val();
                    if (is_itemcode === "1") {
                        $("#itemcode").focus().select();
                    }
                    showbtn(1);
                }
            }
            if (key === 27) {
                add();
                $("#itemname").focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#itemcode").focus().select();
                }
                showbtn(1);
                $("#freight").focus();
            }
        });
        $("#mrp_item").keydown(function(e) {
            calculatefield();
            rowcalc();
            var discount = $('#is_discount').val();
            var key = e.charCode || e.keyCode || 0;
            if (discount === "0") {
                if (key === 13 || key === 9) {
                    $("#prate_item").val(0.00);
                    $("#dis_amt").val(0.00);
                    var is_extra = $("#is_extra").val();
                    if (parseInt(is_extra) === 1) {
                        $('#modelextra').modal();
                        $("#itemname").focus().select();
                        var is_itemcode = $("#is_itemcode").val();
                        if (is_itemcode === "1") {
                            $("#itemcode").focus().select();
                        }

                    } else {
                        add();
                        $("#itemname").focus().select();
                        var is_itemcode = $("#is_itemcode").val();
                        if (is_itemcode === "1") {
                            $("#itemcode").focus().select();
                        }
                        showbtn(1);
                    }
                }
                if (key === 27) {
                    add();
                    $("#itemname").focus().select();
                    var is_itemcode = $("#is_itemcode").val();
                    if (is_itemcode === "1") {
                        $("#itemcode").focus().select();
                    }
                    showbtn(1);
                    $("#freight").focus();
                }
            } else {
                if (key === 13 || key === 9) {
                    e.preventDefault();
                    e.stopPropagation();
                    $("#dis_amt").focus().select();
                }
                if (key === 27) {

                }
                showbtn(1);
            }
        });
        $("#supname").focus();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
			async:false,
            success: function(result) {
               
                var user_default_billtype = $('#user_default_billtype').val();
                $('#btype').html(result);
                if (user_default_billtype !== "") {
                    $('#btype').val(user_default_billtype);
                }
                var id = $('#id').val();
                if(id  < 1 ){
                    $('#btype option').each(function () {
                        var ia = $(this).attr('is_active');
                        if ($.trim(ia) === "0") {
                            $(this).remove();
                        }
                    });
                }
                
				var is_cashe = $('#is_cashe').val();
				var id = $("#id").val();
				if( parseFloat(is_cashe) > 0  && id === "0" ){
					var result = readCookie('<?php echo $login_comid.$type; ?>createSales');



					if (result != null) {
						results = JSON.parse(result);
						 $.each(results, function (index, value) {
							 $('#btype').val(value.btype);
							 $('#vehicle').val(value.vehicle);
						 });
					}else{
						var arr = [];
						var btype = $('#btype').val();
						var vehicle = $('#vehicle').val();
						arr.push({
							btype: btype,
							vehicle: vehicle,
						});
						createCookie('<?php echo $login_comid.$type; ?>createSales', JSON.stringify(arr), 3);
					}
				}
                var ctype = $('#btype').find(':selected').attr('Cash');
                $("#paytype").val(ctype);
                var id = $('#btype').val();
                setbillno(id);
                var btype = $('#btype').val();
                getbtype(btype);
            }
        });
        // $(document).on('shown.bs.popover', '.myspop', function () {
		// 	var offset = $(this).offset();
		// 	$('.popover').css('left', Math.round(offset.right) + 'px');
		// 	var attr = $('.popover').find(".poptext").attr('attr');
		// 	var itm = getIndexOf(items, attr);
		// 	var iteadd = items[itm];
			
		// 	$('.popover').find(".poptext").focus().select();
		// 	$('.popover').find(".poptext").html(iteadd.item_discription);
			
		// });
        $(document).on('shown.bs.popover', '.myspop', function () {
    var offset = $(this).offset();
    $('.popover').css('left', Math.round(offset.right) + 'px');
    
    var attr = $('.popover').find(".poptext").attr('attr');
    var itm = getIndexOf(items, attr);
    
    // Focus and select the popover text
    var $poptext = $('.popover').find(".poptext").focus().select();
    
    // Only try to set content if the item was found
    if (itm !== false && items[itm] && items[itm].item_discription) {
        $poptext.html(items[itm].item_discription);
    } else {
        $poptext.html(""); // Default message
    }
});
        $('.myspop').popover();
        $("#txtEstimate").autocomplete({
            source: "<?php echo site_url('ajaxcall/estimates/' . $type); ?>",
            minLength: 2,
            select: function(event, ui) {
                $('#txtEstimate_id').val(ui.item.sales_id);
                $('#estid').val(ui.item.sales_id);
                $('#freight').val(ui.item.freight);
                $('#advance').val(ui.item.advance);
                $('#other').val(ui.item.other);
                $('#discount').val(ui.item.discount);
                var stype = ui.item.stype;
                loadCust(ui);
                load_items(ui.item.sales_id, stype);
                $('[data-toggle="popover"]').popover();
            }
        });

        calculateGTotal();
		
    });
</script>