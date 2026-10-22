<?php

$purchase_tax_on_mrp = 0 ;
if(isset($settings[0]['purchase_tax_on_mrp'])){
    $purchase_tax_on_mrp = $settings[0]['purchase_tax_on_mrp'];
}

$category_barcode = 0 ;
if(isset($settings[0]['category_barcode'])){
    $category_barcode = $settings[0]['category_barcode'];
}


$is_cigarette_cess = 0 ;
if(isset($settings[0]['is_cigarette_cess']) ){
    $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
}


$lcode = 0;
if(isset($settings[0]['lcode']) ){
	$lcode = $settings[0]['lcode'];

}

$Is_SQFT = 0 ;
$cls_sqft = '';
if(isset($settings[0]['Is_SQFT']) ){
	$Is_SQFT = $settings[0]['Is_SQFT'];

}
$Is_SQFT_cal = 0 ;
if(strtolower($this->session->userdata('login_base_comid')) == 'swararag' ){
    $Is_SQFT_cal = 1;
}


if($Is_SQFT > 0 ){
    $cls_sqft = 'itemsqft';
}


$is_round_off = 1;
$lc_auto_update = 1;
$purchase_barcode = 0 ;
if (isset($settings[0]['purchase_barcode'])) {
    $purchase_barcode = $settings[0]['purchase_barcode'];
}
if (isset($settings[0]['lc_auto_update'])) {
    $lc_auto_update = $settings[0]['lc_auto_update'];
}
$pur_cash_type = 'Cash';
if (isset($settings[0]['pur_cash_type'])) {
    $pur_cash_type = $settings[0]['pur_cash_type'];
}
$is_IMEI = 0 ;
if(isset($settings[0]['is_IMEI']) ){
	$is_IMEI = $settings[0]['is_IMEI'];
}
$additional_cess = 0;
if(isset($settings[0]['additional_cess']) ){
	$additional_cess = $settings[0]['additional_cess'];
}

if (isset($settings[0]['purchase_round_off'])) {
    $is_round_off = $settings[0]['purchase_round_off'];
}


$freequantity = 0;
if (isset($settings[0]['is_freequantity'])) {
    $freequantity = $settings[0]['is_freequantity'];
}


$rate_update_by = 'landing_cost';


if (isset($settings[0]['auto_rate_against'])) {
    $rate_update_by = $settings[0]['auto_rate_against'];
}


$fixed_prate = 0 ;
if (isset($settings[0]['fixed_prate'])) {
    $fixed_prate = $settings[0]['fixed_prate'];
}


$update_mrp_percentage = '0';
$update_whrate_percentage = '0';
$update_specialrate_percentage = '0';
$update_salerate_percentage = '0';


if (isset($settings[0]['per_against_mrp'])) {
    $update_mrp_percentage = $settings[0]['per_against_mrp'];
}

if (isset($settings[0]['per_against_whrate'])) {
    $update_whrate_percentage = $settings[0]['per_against_whrate'];
}

if (isset($settings[0]['per_against_special_rate'])) {
    $update_specialrate_percentage = $settings[0]['per_against_special_rate'];
}

if (isset($settings[0]['per_against_srate'])) {
    $update_salerate_percentage = $settings[0]['per_against_srate'];
}

$is_autoupdate_rate = 0;


if (isset($settings[0]['auto_rate_calculation'])) {
    $is_autoupdate_rate = $settings[0]['auto_rate_calculation'];
}



$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0;
$is_SettngsEnabled = 1;
$is_batch = $settings[0]['is_batch'];
$is_taxincuded = $settings[0]['is_taxincluded'];
$is_taxincuded = 0;
$barcode_settings = $settings[0]['barcode_settings'];
//tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$json = json_encode(array('id' => '0'));
$cid = $carea = '';
$pid = 0;
$zeroindex = $zeroindex[0]['gstid'];
$is_multipletax = $settings[0]['is_multipletax'];
$is_godown = $settings[0]['is_godown'];
$is_analytics = $settings[0]['is_analytics'];
$is_itemcode = $settings[0]['is_itemcode'];
$cost_centre = $settings[0]['is_costcenter'];
$is_extra = $settings[0]['is_discription'];
$company_currency = $settings[0]['comset_currency'];
$is_billtype = $settings[0]['is_billtype'];
$taxtype = $settings[0]['com_tax_type'];
if ($taxtype == 'VAT') {
    $taxtype = 'VAT';
}
if ($is_batch == 1) {
    $batch = 'hidden';
}
if ($is_billtype == 0) {
    $bill = 'hidden';
} else {
    $bill = '';
}
$user = $this->session->userdata('user');
$user_default_godown = $user['user_default_godown'];
$user_default_billtype = $user['default_purchase_billtype'];
if (ucfirst($type) == 'Order') {
    $user_default_billtype = $user['default_porder_billtype'];
}
if (ucfirst($type) == 'Purchase_return') {
    $user_default_billtype = $user['default_preturn_billtype'];
}
?>
<style>
    .box-title{
        text-transform: capitalize;
    }
    .sma{
        width: 55px !important;
    }
    .cma{
        width: 40px !important;
    }
    .disper{
        width: 40px !important;
    }
    .boo{
        position: absolute;
        bottom: 30px;
        left: 95px;
    }
    .table-condensed>thead>tr>td,.table-condensed>tbody>tr>td, .table-condensed>thead>tr>th {
        padding: 1px !important;
    } 

    .table-condensed .form-control { 
        padding: 1px !important;
    } 
    .span {
        font-size: 15   px;
        font-weight: 600;  
        padding-right: 15px;
        padding-left: 15px;
    }
    .tableBodyScroll   { 
        max-height: 300px;
        overflow-y: scroll;
    }

</style>

<div class="modal fade" id="modal-sqft">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="add_SQFTquantity" class="btn btn-primary" data-dismiss="modal">Add
                    </button>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>

    </div>


<form method="post"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/purchase/create/' . $type); ?>" action="<?php echo site_url('transaction/purchase/save/' . $type); ?>"  class="form-horizontal">
    <input type="hidden" value="0" name="id" /> 
    <input type="hidden" value="<?php echo $Is_SQFT; ?>" id="Is_SQFT" name="Is_SQFT" />
    <input type="hidden" value="<?php echo $Is_SQFT_cal; ?>" id="Is_SQFT_cal" name="Is_SQFT_cal" />
    <input type="hidden" value="<?php echo $is_IMEI; ?>" id="is_IMEI" name="is_IMEI" />
    <input type="hidden" value="<?php echo $additional_cess; ?>" id="additional_cess" name="additional_cess" />
    <input type="hidden" name="bill_no" id="bill_no"/>
    <input type="hidden"  name="newtype"  id="newtype"/> 
    <input type="hidden" value="<?php echo $purchase_barcode; ?>" name="purchase_barcode" id="purchase_barcode"/> 
    <input type="hidden" value="<?php echo $purchase_tax_on_mrp; ?>" name="purchase_tax_on_mrp" id="purchase_tax_on_mrp"/> 
    <input type="hidden" value="<?php echo $is_autoupdate_rate; ?>" name="is_autoupdate_rate" id="is_autoupdate_rate"/> 
    <input type="hidden" value="<?php echo $id; ?>" name="p_id" id="p_id"/> 
    <input type="hidden" value="<?php echo $lc_auto_update; ?>" name="lc_auto_update" id="lc_auto_update"/> 
    <input type="hidden"  id="unitvalue" name="unitvalue"/> 
    <input type="hidden"  id="transaction_type" value="<?php echo $type; ?>"/> 
    <input type="hidden"  id="purchase_mainid" name="purchase_mainid"/> 
    <input type="hidden" value="<?php echo $is_cigarette_cess; ?>" id="is_cigarette_cess" name="is_cigarette_cess" />
    <input type="hidden" value="<?php echo $category_barcode; ?>" id="category_barcode" name="category_barcode" />
    <input type="hidden" value="<?php echo $rate_update_by; ?>" name="rate_update_by" id='rate_update_by'/>
    <input type="hidden" value="<?php echo $zeroindex; ?>" name="zeroindex" id='zeroindex'/>
    <input type="hidden" value="<?php echo $fixed_prate; ?>" name="fixed_prate" id='fixed_prate'/>
    <input type="hidden" value="<?php echo $id; ?>" name="pid" id="pid"/> 
    <input type="hidden" value="<?php echo $pur_cash_type; ?>" name="pur_cash_type" id="pur_cash_type"/> 
	<input type="hidden" value="<?php echo $freequantity; ?>" name="freequantity" id="freequantity"/> 
    <input type="hidden" value="1" id="curr_tax" name="curr_tax"/> 
    <input type="hidden" value="<?php echo $user_default_godown; ?>" name="user_default_godown" id='user_default_godown'/>
    <input type="hidden" value="<?php echo $cost_centre; ?>" name="cost_centre" id='cost_centre'/>
    <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded"/> 
    <input type="hidden" value="<?php echo $is_extra; ?>" name="is_extra" id='is_extra'/>
    <input type="hidden" value="<?php echo $is_godown; ?>" id="is_godown" name="is_godown"/> 
    <input type="hidden" value="<?php echo $company_currency; ?>" id="comset_currency" name="comset_currency"/> 
    <input type="hidden" name="itemname1" id="itemname1"/>
    <input type="hidden" value="<?php echo $user_default_billtype; ?>" name="user_default_billtype" id='user_default_billtype'/>
    <input type="hidden"  id="estid" name="estid" value='<?php echo $txtestimate; ?>' /> 
    <input type="hidden" value="<?php echo $is_itemcode; ?>" name="is_itemcode" id='is_itemcode'/>
    <input type="hidden" value="<?php echo $is_multipletax; ?>" name="is_multipletax" id='is_multipletax'/>
    <input type="hidden" value="<?php echo $is_analytics; ?>" name="is_analytics" id='is_analytics'/>
    <input type="hidden" value="<?php echo $comontax; ?>"  name="comontax" id="comontax"/>
    <input type="hidden" id="txtEstimate_id"  value='<?php echo $txtestimate; ?>' class="form-control" name="txtEstimate_id"/>
    <input type="hidden" value="" name="tax_led_id" id='tax_led_id'/>
    <input type="hidden" value="<?php echo $is_billtype; ?>" id="is_billtype" name="is_billtype"/> 
    <input type="hidden" value="<?php echo $is_batch; ?>" id="is_batch" name="is_batch"/> 
    <input type="hidden" value="<?php echo $is_round_off; ?>" id="is_round_off" name="is_round_off"/> 
	<input type="hidden" name="purchase_item_index" id="purchase_item_index" value="0"/>
    <input type = "hidden" name="cig_ces_per_amount" value="0" id="cig_ces_per_amount" >
                                                    <input type = "hidden" name="item_tax_on_mrp" value="0" id="item_tax_on_mrp" >
                                                    <input type = "hidden" name="cig_ces_amt" value="0" id="cig_ces_amt" >
                                                    <input type = "hidden" name="cig_ces_per" value="0" id="cig_ces_per" >
                                                    <input type = "hidden" value="0" name="unit_cig_ces_amt"  id="unit_cig_ces_amt" >

                                                    
    <style>
        .modal-dialog {
            width: 100%;
            margin: 0;
            padding: 0;
            padding-left: 20%;
            padding-right: 5%;
        }

        .modal-content {
            height: auto;

            border-radius: 0;
        }
		<?php if((float) $is_autoupdate_rate < 1 ){ ?>
			.clsis_autoupdate_rate{
				display:none;
		<?php } ?>
    </style>
    <div class="modal fade lg" id="modal-alter">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="item_header"> </h4>
                </div>
                <div class="modal-body">
				<div class ="col-sm-12">
					<input type ="hidden" name = "itemlc"  id = "itemlc" />
					<input type ="hidden" name = "itemprate"  id = "itemprate" />
					<div  style = "padding-left:30px;" class="col-sm-4">
						<b>landing Cost :
						<label style ="font-weight:bold;" pull ="right" id = "item_lc">0</label></b>
					</div>
					<div  style = "padding-left:30px;" class="col-sm-4">
						<b>Purchase Rate :
						<label style ="font-weight:bold;" pull ="right" id = "item_prate">0</label></b>
					</div>
					<div  style = "padding-left:30px;" class="col-sm-4 clsis_autoupdate_rate">
						<input type="checkbox" id="auto_update_rates" name="auto_update_rates" value="1">Update Rates

					</div>
				</div>
				<div class="col-sm-12">
					   <?php if ($is_batch == 1 || strtolower($this->session->userdata('login_base_comid')) == 'swamees') { ?>
					
						
						<div class="col-sm-2">
							MFG :<br />
							<input style="width:150px;" name="mfg" hidden type="text" id="mfg"  class="form-control col-lg-1 text-right date" placeholder="<?= label('Date', $this, $user) ?>">
						</div>
						
						<div class="col-sm-2">
							EXP : <br />
							<input style="width:150px;" name="exp" type="text" id="exp"  class="form-control col-lg-1 text-right date_expiry" placeholder="<?= label('Date', $this, $user) ?>">
						</div>
				 <?php } ?>
					
					
					<div  style = "padding-left:30px;" class="col-sm-2 clsis_autoupdate_rate ">
						MRP % :
						<input value ="<?php echo $update_mrp_percentage;?>" type = "number" type ="any" class ="form-control autorate clsis_autoupdate_rate" id = "mrp_per" name ="mrp_per"  >
					</div>
					
					<div  style = "padding-left:30px;" class="col-sm-2 clsis_autoupdate_rate">
						Srate % :
						<input value ="<?php echo $update_salerate_percentage;?>" type = "number" type ="any" class ="form-control autorate clsis_autoupdate_rate" id = "srate_per" name ="srate_per"  >
					</div>
					
					<div  style = "padding-left:30px;" class="col-sm-2 clsis_autoupdate_rate">
						Wh Rate % :
						<input value ="<?php echo $update_whrate_percentage;?>" type = "number" type ="any" class ="form-control autorate clsis_autoupdate_rate" id = "whrate_per" name ="whrate_per"  >
					</div>
					
					<div  style = "padding-left:30px;" class="col-sm-2 clsis_autoupdate_rate">
						Spe Rate % :
						<input value ="<?php echo $update_specialrate_percentage;?>" type = "number" type ="any" class ="form-control autorate clsis_autoupdate_rate" id = "special_rate_per" name ="special_rate_per"  >
					</div>
					
					</div>
                <?php if($Is_SQFT >0 ){?>

                    <div style="padding:20px;"  class="row">
                            <input type="hidden" name="sqftrowid" value="0" id="sqftrowid" class="form-control" />
                            <div class ="row">
                                <div class="col-sm-8">
                                    <?= label('Quantity*', $this, $user) ?>
                                    <input  name="sqft_quantity" id="sqft_quantity" class="form-control clssqftmodal" />
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
                            </div>
                     </div>
<?php }?>

<?php if($lcode>0){?>
        <div class ="row">
            <div class="col-sm-4">
                <?= label('Lcode', $this, $user) ?>
                <input type ="text"  name="lcode" id="lcode" class="form-control" />
            </div>
            
        </div>
<?php }?>



<?php if($category_barcode>0){?>
        <div class ="row">
            <div class="col-sm-4">
                <?= label('Des.', $this, $user) ?>
                <input autofocus type ="text"  name="itm_des" id="itm_des" class="form-control" />
            </div>
            
        </div>
<?php }?>

                    <table  class="table table-striped table-condensed" >
                        <thead>
                            <tr>
<!--                                <td>Item Name</td>-->
                                <td style="display:none"><?= label('Size', $this, $user) ?></td>
                                <td><?= label('HSN Code', $this, $user) ?></td>
                                <td><?= label('Qty', $this, $user) ?></td>
                                <td <?php if($freequantity < 1){ echo 'style = "display:none" ';}?> ><?= label('FQty', $this, $user) ?></td>
                                <?php if ($type == 'purchase1') { ?>
                                    <td><?= label('Damage', $this, $user) ?></td>
                                <?php } ?>
                                <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><?= label('Godown', $this, $user) ?></td>
                                <?php if ($is_analytics == 1) { ?>
                                    <td><?= label('Analytics', $this, $user) ?></td>
                                <?php } ?>
                                <td><?= label('Unit', $this, $user) ?></td>
                                <?php if (!$is_batch == 0) { ?>
									 <td><?= label('Batch', $this, $user) ?></td>
                                  <!--  <td style='display:none'><?= label('mfg', $this, $user) ?></td>
                                    <td style='display:none'><?= label('Expiry date', $this, $user) ?></td>-->
                                <?php } ?>
                                <?php if (!$comontax == 1) { ?>
                                    <td><?php echo $taxtype; ?></td>
                                <?php } ?>
                                <td><?= label('Prate', $this, $user) ?></td>
								 <td><?= label('Dis %', $this, $user) ?></td>
                                <td><?= label('Dis Amt', $this, $user) ?></td>
                                <td><?= label('Srate', $this, $user) ?></td>
                                <td><?= label('MRP', $this, $user) ?></td>
								<td><?= label('Wh.Rate', $this, $user) ?></td>
								<td><?= label('Sp.Rate', $this, $user) ?></td>
								<td><?= label('Taxable', $this, $user) ?></td>
								<?php if($additional_cess > 0){?>
									<td><?= label('Ces', $this, $user) ?></td>
								<?php } ?>
                                <td><?= label('Tax Amt', $this, $user) ?></td>
                                <td><?= label('Total', $this, $user) ?></td>
                                <td> <td> 
                            </tr>
                            <tr>
<!--                                <td  class="col-lg-3"> <input  NoTab="true"   id="itemname_pop"  class="form-control" type="text" placeholder="<?= label('Item Name', $this, $user) ?>"/></td>-->
                                <td>
										<select tabindex="-1" id="hsn" name="hsn" class="form-control col-lg-1">
                                            <option value="">Select</option> 
                                        </select>
								</td>
								<td style="display:none"><input type="hidden" id="item_ces_per" name="item_ces_per" value="0" ><input type="hidden" id="item_ces_name" name="item_ces_name" value="" ><input type="hidden" id="item_ces_id" name="item_ces_id" value="0" ><select style="width:60px;" tabindex="-1" id="item_size"   class="form-control">
                                        <option value="">Select</option> 
                                    </select></td>    
                                <td>                                                 <input type ="hidden" name ="itemsqft" id ="itemsqft"  />     
                                <input <?php if($category_barcode<1){?> autofocus <?php }?> id="item_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price <?php echo $cls_sqft;?>" placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                <td <?php if($freequantity < 1){ echo 'style = "display:none" ';}?> > <input   id="free_qty" type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label('FQuantity', $this, $user) ?>"/></td>

							   <?php if ($type == 'purchase1') { ?>
                                    <td> <input  value=0  id="item_damage_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label('Damage', $this, $user) ?>"/></td>
                                <?php } ?>
                                <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><select tabindex="-1"  id="godown"  class="form-control col-lg-1">
                                        <option value="">Select</option> 
                                    </select>
                                </td>
                                <?php if ($is_analytics == 1) { ?>
                                    <td class="sma" ><select tabindex="-1" id="analyticscenter"  class="form-control col-lg-1">
                                            <option value="">Select</option> 
                                        </select>
                                    </td>
                                <?php } ?>
                                <td class="sma" ><select tabindex="-1" id="unit_item" class="form-control col-lg-1" >
                                        <option value="">Select</option> 
                                    </select>
                                </td>
                                <?php if (!$is_batch == 0) { ?>
									<td class="sma" ><input id="itembatch"   type="text"  value=""  class="form-control col-lg-1" placeholder="<?= label('Batch', $this, $user) ?>"/></td>
                                   <!-- <td style='display:none'>  <input name="mfg" hidden type="text" id="mfg" data-validation="required" class="form-control col-lg-1 text-right date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                    <td style='display:none'>  <input name="exp" type="text" id="exp" data-validation="required" class="form-control col-lg-1 text-right date_expiry" placeholder="<?= label('Date', $this, $user) ?>"></td>-->
                                <?php } ?>
                                <?php if (!$comontax == 1) { ?>
                                    <td class="sma" ><select tabindex="-1" id="tax_item"  class="form-control col-lg-1">
                                            <option value="">Select</option> 
                                        </select>
                                    </td>
                                <?php } ?>
                                <td > <input id="prate_item" type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Purchase Rate', $this, $user) ?>"/></td>
								 <td> <input id="dis_item"   type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Discount', $this, $user) ?>"/></td>
                                <td > <input id="dis_amt"   type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Dis Amt', $this, $user) ?>"/></td>
                                <td> <input id="srate_item"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('SRATE', $this, $user) ?>"/></td>
                                <td> <input id="mrp_item"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('MRP', $this, $user) ?>"/></td>
                                <td> <input id="wh_rate"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('Wholesale', $this, $user) ?>"/></td>
                                <td> <input id="special_rate"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('Special', $this, $user) ?>"/></td>
                                <td><input style="height:25px" class='form-control  two-digits' id="item_taxable" readonly="readonly"/></td>
                                <?php if($additional_cess > 0){?>
								   <td><input type="hidden" id="item_ces_per" name="item_ces_per" value="0" ><input type="hidden" id="item_ces_name" name="item_ces_name" value="" ><input type="hidden" id="item_ces_id" name="item_ces_id" value="0" ><input style="height:25px" class='form-control  two-digits' id="itemcesamt" readonly="readonly"/></td>
								<?php } ?>
							   <td><input  class='form-control col-lg-1 two-digits'  id="rowTax" disabled="disabled" /></td>
                                <td><input  class='form-control col-lg-1 two-digits  ' id="rowTotal" disabled="disabled" /></td>

                                <td>
                                    <!--                                        hidden-->
                                    <input type="hidden" name="item_id" id="item_id"/>

                                    <button data-toggle="tooltip" type="button"    title="<?= label('Total', $this, $user) ?>Add To save" id="addpitems"  class="btn btn-success addpitems" href="#">
                                        <span class="glyphicon glyphicon-plus"></span> 
                                    </button>
                                </td>

                            </tr>
                        <button type="button" style="visibility:hidden;" id="btnclsmain"   class="btn btn-secondary" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>

                        </thead>
                    </table>
					<table style="width:100%" class="table">
							<tr>
								<td>Date</td>
								<td>Invoice</td>
                                <td>Mrp</td>
								<td>Purchase Rate</td>
                                <td>DP</td>
							</tr>
							<tbody id="bodyrate">
							</tbody>
					</table>
					<table id="IMEITB" <?php if((float) $is_IMEI < 1  ){echo 'style="display:none;"';}?> style="width:100%" class="table">
							<tr>
								<td>IMEI</td>
								<td>Action</td>
							</tr>
							<tr>
								<td><input  placeholder="IMEI" class="form-control" type="text" name="itemIMEI" id="itemIMEI" /></td>
								<td>
									<button data-toggle="tooltip" type="button"    title="<?= label('Add', $this, $user) ?>Add To save" id="addIMEI"  class="btn btn-success" href="#">
                                        <span class="glyphicon glyphicon-plus"></span> 
                                    </button>
								</td>
							</tr>
							<tbody id="bodyimei">
							</body>
					</table>
                    <button type="button" id="myDropdownhide" class="hidden btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <div id="myDropdown" class="dropdown-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#mainSale" data-toggle="tab"><?= label(ucwords(str_replace('_', ' ', $type)), $this, $user) ?></a></li>
                        <li><a href="#otherTab" data-toggle="tab"><?= label('Other Details', $this, $user) ?></a></li>
                        <li><a href="#service" data-toggle="tab"><?= label('Additional Ledger', $this, $user) ?></a></li>

                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" id="txtEstimate" style="height:30px !important" class="form-control" name="txtEstimate"/>
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <select name="is_tax" data-validation="required" style="height:30px !important" id="is_tax"  class="form-control">
                                    <option value="0"><?= label($taxtype, $this, $user) ?>  <?= label('Excluded', $this, $user) ?></option> 
                                    <option value="1"><?= label($taxtype, $this, $user) ?> <?= label('Included', $this, $user) ?></option> 
                                </select> 
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div  class="cur_div" style="width:150px;padding: 4px">
                                <input value=1 type="text" id="curr_value" style="height:30px !important" class="form-control" name="curr_value" placeholder="Currency Value"/>
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <select  name="com_currency" data-validation="required" style="height:30px !important" id="com_currency"  class="form-control">
                                </select> 
                            </div>
                        </li>
                        <?php if ($cost_centre == '1') { ?>
                            <li class="pull-right"> 
                                <div class="input-group" style="width:150px;padding: 4px">
                                    <select  id="Costcenter"  name="Costcenter" style="height:30px !important"  class="form-control" >
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
                                <table class="table table-striped table-condensed col-sm-12" >
                                    <tr>
                                        <?php if ($type == 'purchase') { ?>
                                            <td class="hunpx"><?= label('Bill No.', $this, $user) ?></td>
                                        <?php } ?>

                                        <td class="hunpx"><?= label('Bill Date', $this, $user) ?></td>

                                        <td class="hunpx"><?= label('Purchase Date', $this, $user) ?></td>
                                        <td class="hunpx"><?= label('Type', $this, $user) ?> </td>
                                        <td class="col col-lg-1 <?php echo $bill; ?>"> <?= label('Bill Type', $this, $user) ?></td> 
                                        <?php if ($comontax == 1) { ?>
                                            <td>Tax</td>
                                        <?php } ?>
                                        <td>
                                            <?= label('Supplier', $this, $user) ?>    <button hddid="sales" data-toggle="tooltip" type="button" title="TotalAdd To save" class="sma btn btn-primary btnaddsupplier" href="#">
                                                        New
                                             </button>
                                        </td>
                                        <td><?= label('Billing Name', $this, $user) ?></td>
                                        <td><?= label('Phone Number', $this, $user) ?></td>
                                        <td><?= label('Address', $this, $user) ?></td>

                                    </tr>
                                    <tr>
                                        <?php if ($type == 'purchase') { ?>
                                            <td class="col-lg-1"><input name="invoice" data-validation-error-msg="*"  type="text" id="invoice" data-validation="required"    class="form-control hunpx" placeholder="<?= label('Invoice', $this, $user) ?>"></td>
                                        <?php } ?>
                                        <td class="col-lg-1">  <input name="date" type="text" id="date" data-validation="required" class="form-control  date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td class="col-lg-1">  <input name="rdate" type="text" id="rdate" data-validation="required"    class="form-control date" placeholder="<?= label('Received Date', $this, $user) ?>"></td>
                                        <td><select tabindex="-1"   name="type" data-validation="required" id="type"  class="form-control hunpx" >
                                                <option value="Cash"><?= label('Cash', $this, $user) ?></option> 
                                                <option value="Credit"><?= label('Credit', $this, $user) ?></option> 
                                                <option value="Bank"><?= label('Bank', $this, $user) ?></option> 
                                            </select> 
                                        </td>
                                        <td <?php echo $bill; ?>>
                                            <select tabindex="-1" data-validation="required" id="btype" name="btype" class="form-control  hunpx" >                                            
                                            </select>
                                        </td>

                                        <?php if ($comontax == 1) { ?>
                                            <td><select  data-validation="required" id="tax_common"  name="tax_common" class="form-control" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                        <?php } ?>
                                        <td class="col-lg-2"><input type="hidden" name="supid" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="length" data-validation-length="min5"   class="form-control" placeholder="<?= label('Supplier', $this, $user) ?>"></td>
                                        <td class="col-lg-2"><input name="billingname" type="text" id="billingname"    class="form-control" placeholder="<?= label('Billin Name', $this, $user) ?>"></td>
                                        <td class="col-lg-2"><input name="phone" type="text" id="phone"  class="form-control"  pattern="[0-9]{0,13}" placeholder="<?= label('Phone', $this, $user) ?>"></td>
                                        <td class="col-lg-2"><input name="address" type="text" id="address"    class="form-control" placeholder="<?= label('Email', $this, $user) ?>"></td>

                                    </tr>
                                </table>
                                <table class="table table-striped table-condensed col-sm-12" style="display: none" >
                                    <tr>

                                        <td><?= label('Phone', $this, $user) ?></td>
                                        <td><?= label('Email', $this, $user) ?></td>
                                        <td><?= label('GST', $this, $user) ?></td>
                                    </tr>
                                    <tr> 
                                        <td><input name="" type="text" id="phone"    class="form-control" placeholder="Phone"></td>
                                        <td><input name="email" type="text" id="email"    class="form-control" placeholder="Email"></td>
                                        <td><input name="cst" type="text" id="cst"    class="form-control" placeholder="CST"></td>
                                    </tr>
                                    <tr>
                                        <td><?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?></td>
                                        <td><?= label('Address', $this, $user) ?></td>
                                        <td><?= label('Address 2', $this, $user) ?></td>
                                        <td><?= label('Details', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td><input name="tin" type="text" id="tin" class="form-control" placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                        <td><input name="address_line1" type="text"  id="address_line1" class="form-control" placeholder="<?= label('address line1', $this, $user) ?>"></td>
                                        <td><input name="address_line2" type="text"  id="address_line2" class="form-control" placeholder="<?= label('address line2', $this, $user) ?>"></td>
                                        <td><input name="details" type="text" id="details" class="form-control" placeholder="<?= label('details', $this, $user) ?>"></td>
                                    </tr>
                                </table>
                                <style>
                                    .span {
                                        font-size: 18px;
                                        font-weight: 600;  
                                        padding-right: 15px;
                                        padding-left: 15px;
                                    }
                                </style>
                                <p><b><span id="purchase_invoice" class="col col-md-2"><?php echo $invoice;?></span><span id="current_stock" class="col col-md-2"></span><span id="prate" class="center"></span></b> <span class="span  pull-right" id="balance" ></span> </p>
                                <div class="col-sm-12" style="padding-right: 0px;padding-left: 0px;">
                                    <div class="tableBodyScroll " style="padding-right: 0px;padding-left: 0px;">
                                        <table id="purchaseTable" class="table table-striped table-condensed" >
                                            <thead>
                                                <tr>
                                                    <td><?= label('SNo', $this, $user) ?></td>
                                                    <?php if ($is_itemcode == 1) { ?>
                                                        <td><?= label('Item Code', $this, $user) ?></td>
                                                    <?php } ?>
                                                    <td>
                                                        <?= label('Item', $this, $user) ?>
                                                        <button hddid="sales"  data-toggle="tooltip" type="button" title="TotalAdd To save" class="sma btn btn-primary btnadditem" href="#" >
                                                           New
                                                        </button>
                                                    </td>
                                                    <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><?= label('Godown', $this, $user) ?></td>
                                                   <?php if($lcode < 1){?>
                                                    <td><?= label('Size', $this, $user) ?></td>
                                                    <?php }else{  ?>
                                                        <td><?= label('L Code', $this, $user) ?></td>
                                                    <?php } ?>
                                                    <td><?= label('Qty', $this, $user) ?></td>
                                                    <?php if ($type == 'purchase1') { ?>
                                                        <td><?= label('Damage', $this, $user) ?></td>
                                                    <?php } ?>
                                                    <td><?= label('Unit', $this, $user) ?></td>
                                                    <?php if (!$comontax == 1) { ?>
                                                        <td><?php echo $taxtype; ?></td>
                                                    <?php } ?>
                                                    <td><?= label('Prate', $this, $user) ?></td>
                                                    <td><?= label('Srate', $this, $user) ?></td>
                                                    <td><?= label('MRP', $this, $user) ?></td>
                                                    <td><?= label('Dis(%)', $this, $user) ?></td>
                                                    <td><?= label('Dis Amt', $this, $user) ?></td>
													 <?php if($additional_cess > 0){?>
                                                    <td><?= label('Cess', $this, $user) ?></td>
													<?php } ?>
                                                    <td><?= label('Amt', $this, $user) ?></td>
                                                    <td><?= label('Total', $this, $user) ?></td>
                                                    <td> </td> 
                                                </tr>
                                                <tr id="add">
                                                    <td class="sma" style="text-align: center;"><input title="1" style="height:25px"   id="totnolist" class="form-control  text-right"  readonly="readonly"/></td>
                                                    <?php if ($is_itemcode == 1) { ?>
                                                        <td class="col-lg-1    "> <input   NoTab="true"   id="itemcode"  <?php if ($barcode_settings === "1") { ?> class="form-control" onchange="itemsearch()"   <?php } else { ?>class="form-control ItemMatchBarcode" <?php } ?> stype="barcode" data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>"    type="text" placeholder="<?= label('Item Code', $this, $user) ?>"/></td>                                                                <?php } else { ?>
                                                    <?php } ?>
                                                    <td  class="col-lg-3"> <input   NoTab="true"   id="itemname"  data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>"class="form-control" type="text" placeholder="<?= label('Item Name', $this, $user) ?>"/></td>
                                                    <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><select tabindex="-1"  id="godown1"  class="form-control sma col-lg-1">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                    <?php if($lcode < 1){?>

                                                    <td class="cma" ><select tabindex="-1" id="itm_size" class="form-control col-lg-1" >
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>      
                                                    <?php }else{  ?>
                                                        <td> <input   id="lcod"  type="text" NoTab="true"   class="form-control" placeholder="<?= label('lcode', $this, $user) ?>"/></td>

                                                    <?php } ?>
                                                    <td> <input   id="1item_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                                    <?php if ($type == 'purchase1') { ?>
                                                        <td> <input   id="damage"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                                    <?php } ?>
                                                    <td class="cma" ><select tabindex="-1" id="1unit_item" class="form-control col-lg-1" >
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                    <?php if (!$comontax == 1) { ?>
                                                        <td class="cma" ><select tabindex="-1" id="1tax_item"  class="form-control col-lg-1">
                                                                <option value="">Select</option> 
                                                            </select>
                                                        </td>
                                                    <?php } ?>
                                                    <td > <input id="1prate_item1" type="text"    class="form-control  text-right price col-lg-1 two-digits" placeholder="<?= label('Purchase Rate', $this, $user) ?>"/></td>
                                                    <td> <input id="1salerate_item1"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('Sales Rate', $this, $user) ?>"/></td>
                                                    <td> <input id="1mrp_item1"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('MRP', $this, $user) ?>"/></td>
                                                    <td> <input id="1dis_item1"   type="text"    class="form-control cma text-right price col-lg-1 two-digits" placeholder="<?= label('Discount', $this, $user) ?>"/></td>
                                                    <td > <input id="1dis_amt1"   type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Dis Amt', $this, $user) ?>"/></td>
													 <?php if($additional_cess > 0){?>
														<td><input type="hidden" id="" name="" value="0" ><input type="hidden" id="item_ces_name" name="item_ces_name" value="" ><input type="hidden" id="item_ces_id" name="item_ces_id" value="0" ><input style="height:25px" class='form-control  two-digits' id="itemcesamt" readonly="readonly"/></td>
													<?php } ?>
                                                    <?php if (!$comontax == 1) { ?>
                                                        <td> 
                                                            <input  class='form-control col-lg-1 two-digits'   disabled="disabled" />
                                                        </td>
                                                    <?php } ?>
                                                    <td><input  class='form-control col-lg-1 two-digits  '  disabled="disabled" /></td>
                                                    <td>
                                                        <!--                                        hidden-->
                                                        <input type="hidden" name="item_id" id="1item_id1"/>

                                                        <button data-toggle="tooltip" type="button"    title="<?= label('Total', $this, $user) ?>Add To save"   class="btn btn-success sma" href="#">
                                                            <span class="glyphicon glyphicon-plus"></span> 
                                                        </button>
                                                    </td>

                                                </tr>
                                            </thead>
                                            <tbody id="rowm">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-sm-5"></div>
									 <div class="col-sm-2 no-padding no-margin">
                                        <div class="col-sm-6"><?= label('Quantity', $this, $user) ?></div>
                                        <div class="col-sm-6 no-padding no-margin">  
                                            <input name="totitmqty" id="totitmqty" placeholder="<?= label(0, $this, $user) ?>  "  readonly="readonly"   type="text" class="text-right form-control" placeholder="<?= label('0', $this, $user) ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin">
                                        <div class="col-sm-6"><?= label('Pur/Tax', $this, $user) ?></div>
                                        <div class="col-sm-6 no-padding no-margin">  
                                            <input name="totpuretax" id="totpuretax" placeholder="<?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?> "  readonly="readonly"   type="text" class="text-right form-control" placeholder="<?= label('Pur/Tax', $this, $user) ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 "  >
                                        <div class="col-sm-6"><?= label('Total Amt', $this, $user) ?></div>
                                        <div class="col-sm-5 no-padding no-margin">                                            
                                            <input type="text"  id="total" name="subtot" readonly="readonly"  class="form-control    text-right" placeholder="<?= label('Total', $this, $user) ?>">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
									
                                </div>
								<div class="row">
                                    <div style="padding:3px;" class="col-sm-4  ">
                                        <?php if(strtolower($this->session->userdata('login_base_comid')) == 'test' ){?>
                                        <div style="padding:3px;" class="col-sm-12 bankdiv">
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
                                        <?php }?>
                                    </div>
									<div class="col-sm-4"></div>
									<div style="padding:3px;" class="col-sm-4  ">
                                    <div class="col-sm-12">
                                        <div style="padding:3px;"  class="col-sm-5">
                                            <?= label('Taxable', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;"  class="col-sm-7">
                                            <input name="txtTaxable" id="txtTaxable" readonly placeholder="<?= label('Taxable', $this, $user) ?>"   type="text" class="text-right  col-lg-1 form-control" >
                                        </div>
                                    </div>


									
									<div class="col-sm-12">
                                        <div style="padding:3px;"  class="col-sm-5">
                                            <?= label('Round Off', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;"  class="col-sm-7">
                                        <input name="rount" id="rount" placeholder="<?= label('Round Off', $this, $user) ?>" readonly="readonly"   type="text" class="text-right  col-lg-1 form-control" >
                                        </div>
                                    </div>
									<div class="col-sm-12">
                                        <div style="padding:3px;"  class="col-sm-5">
                                            <?= label($taxtype, $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;"  class="col-sm-7">
                                        <input name="taxtotal" id="taxtotal" placeholder="<?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?>"  readonly="readonly" type="text" class="text-right col-lg-1  form-control" >
                                        </div>
                                    </div>
									<?php if($additional_cess > 0){?>
										<div class="col-sm-12">
                                        <div style="padding:3px;"  class="col-sm-5">
                                            <?= label('Item Cess', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;"  class="col-sm-7">
                                            <input readonly="readonly" class="form-control two-digits text-right " type="text" name="itm_net_ces" id="itm_net_ces">
                                        </div>
                                    </div>
									<?php } ?>
                                    <div class="col-sm-12">
                                        <div style="padding:3px;"  class="col-sm-5">
                                            <?= label('Discount', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;"  class="col-sm-7">
                                            <input name="discount" id="discount" placeholder="<?= label('Discount', $this, $user) ?>"   type="text" class="text-right  col-lg-1 form-control" >
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
									<div class="col-sm-12">
                                        <div style="padding:3px;"  class="col-sm-5">
                                            <?= label('Grand Total', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;"  class="col-sm-7">
                                            <input name="gtotal" id="gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right col-lg-1  form-control" >
                                        </div>
                                    </div>
									<div class="col-sm-12 style="display:none"">
                                        <div style="padding:3px;"  class="col-sm-5">
                                            <?= label('Grand Total(Currency Incl)', $this, $user) ?><br />
                                        </div>
                                        <div style="padding:3px;"  class="col-sm-7">
                                        <input name="cur_gtotal" id="cur_gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right col-lg-1  form-control" >
                                        </div>
                                    </div>
									</div>
								</div>
                            </div> 
                        </div>
                        <div class="tab-pane" id="otherTab">
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-2"><?= label('State', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('State Code', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?></td> 
                                        <td class="col col-lg-3"><?= label('E-Way Bill Number', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('E-Way Bill Details', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td><select  id="states"  name="states" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="stcode" type="text" id="stcode"  class="form-control  "   placeholder="<?= label('State Code', $this, $user) ?>"></td>
                                        <td>  <input name="gst" type="text" id="gst"  class="form-control  col-lg-2"   placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                        <td>  <input name="ewbno" type="text" id="ewbno"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Number', $this, $user) ?>"></td>
                                        <td>  <input name="ewbdetails" type="text" id="ewbdetails"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Details', $this, $user) ?>"></td>
<!--                                          <td><select  id="printtype"  name="printtype" class="form-control" >
                                            <option value="">Select</option> 
                                        </select>
                                    </td>-->
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Due Date', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Delivery Date', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Credit Days', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label('SalesMan', $this, $user) ?></td> 
                                        <td class="col col-lg-2"><?= label('Area', $this, $user) ?></td> 
                                        <td class="col col-lg-3"><?= label('Supplier Ref no', $this, $user) ?></td> 
                                    </tr>
                                    <tr>
                                        <td><input name="due_date" id="due_date" type="text"  class="form-control blankdate date " placeholder="<?= label('Due Date', $this, $user) ?>"></td>
                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td><select  id="salesman"  name="salesman" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                      
                                        <td><select  id="area"  name="area" class="form-control">
                                                <option value="">select</option> 
                                            </select>
                                        </td>   
										  <td>
											<input type = "text" name= "supplier_ref"  id= "supplier_ref" class = "form-control" placeholder = "Supplier Ref No" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Route', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Vehicle', $this, $user) ?></td>
                                        <td class="col col-lg-1"><?= label('Coolie', $this, $user) ?></td>
                                        <td class="col col-lg-1"><?= label('Freight', $this, $user) ?></td>
                                        <td class="col col-lg-1"><?= label('Other charges', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td><select  id="route"  name="route" class="form-control">
                                                <option value="">route</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="vehicle" name="vehicle" class="form-control">
                                                <option value="">vehicle</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="coolie" type="text"   class="form-control  col-lg-1 tatalcal"   placeholder="<?= label('Coolie', $this, $user) ?>"></td>
                                        <td><input name="freight" id="freight" placeholder="<?= label('Freight', $this, $user) ?>"   type="text" class="tatalcal text-right  col-lg-1 form-control" ></td>
                                        <td><input name="other" id="other" placeholder="<?= label('Other charges', $this, $user) ?>"   type="text" class="tatalcal text-right  col-lg-1 form-control" ></td>
                                    </tr>
									  <tr>
                                        <td class="col col-lg-2"><?= label('PO ref no', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Customer ref no', $this, $user) ?></td>
                                        <td class="col col-lg-1"></td>
                                        <td class="col col-lg-1"></td>
                                        <td class="col col-lg-1"></td>
                                    </tr>
									 <tr>
                                        <td class="col col-lg-2">
											<input type = "text" name= "po_ref_no"  id= "po_ref_no" class = "form-control" placeholder = "PO Ref No" />
										</td>
                                        <td class="col col-lg-2">
											<input type = "text" name= "customer_ref_no"  id= "customer_ref_no" class = "form-control" placeholder = "Customer Ref No" />
										</td>
                                        <td class="col col-lg-1"></td>
                                        <td class="col col-lg-1"></td>
                                        <td class="col col-lg-1"></td>
                                    </tr>
                                </table>
                                </br>
								 <div class="col-lg-12">
									 <div class="col-lg-6">
                                        <table class="table table-striped table-condensed">
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Delivery(Shipping) Address', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td> <?= label('Name', $this, $user) ?> :</td>
                                                <td><input name="con_name" type="text" id="con_name" class="form-control 2" placeholder="<?= label('Name', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Address', $this, $user) ?> :</td>
                                                <td><input name="con_addr" type="text" id="con_addr" class="form-control 2" placeholder="<?= label('Address', $this, $user) ?>"></td>
                                            </tr>
                                            <td> <?= label('Contact', $this, $user) ?> :</td>
                                            <td><input name="con_contact" type="text" id="con_contact" class="form-control 2" placeholder="<?= label('Contact', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td> <?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?> :</td>
                                                <td><input name="con_gst" type="text" id="con_gst" class="form-control 2" placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td> <?= label('State', $this, $user) ?> :</td>
                                                <td><select id="con_state" name="con_state" class="form-control">
                                                        <option value="">Select</option>
                                                    </select></td>
                                            </tr>
                                        </table>
                                    </div>
									 <div class="col-lg-6">
										<textarea name = "notes" id= "notes" class = "form-control" style ="width:100%;height:200px !important;" placeholder = "Notes"></textarea> 
									 </div>
								 </div>
                            </div>
                        </div>
                        <!-- /serviceTab -->
                        <div class="tab-pane" id="service">
                            <div class="box-body">
                                <table class="table table-striped table-condensed"   >
                                    <thead>
                                        <tr>
                                            <td><?= label('Additional Ledger', $this, $user) ?></td>
                                            <td><?= label($taxtype, $this, $user) ?>%</td>
                                            <td><?= label('Service Amount', $this, $user) ?></td>
                                            <td><?= label($taxtype . ' Amount', $this, $user) ?></td>
                                            <td><td> 
                                        </tr>
                                    </thead>
                                    <tbody id="rows">
                                        <tr id="addservice">

                                            <td class="col-lg-4"> <input type="hidden" NoTab="true" tabindex="-1" name="ser_ledgerid" id="ser_ledgerid"/><input  NoTab="true"   id="ser_ledger"  class="form-control"   type="text"     placeholder="<?= label('Ledger', $this, $user) ?>"/></td>
                                            <td class="sma"><input type="hidden" NoTab="true" tabindex="-1" name="ser_taxid" id="ser_taxid"/><select tabindex="-1" id="ser_tax"  class="form-control col-lg-1" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                            <td> <input style='height:25px' id="ser_amt"  type="text"  class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label(' Amount', $this, $user) ?>"/></td>
                                            <td> <input id="ser_taxamt"   type="text" readonly="readonly"   class="form-control col-lg-1 text-right two-digits" placeholder="<?= label($taxtype, $this, $user) ?>"/></td>
                                            <!--                                        hidden-->
                                            <td>  <button data-toggle="tooltip" type="button"    title="Add To save"   class="btn btn-success" href="#">
                                                    <span class="glyphicon glyphicon-plus"></span> 
                                                </button>
                                            </td>
                                        </tr> 
                                    </tbody>      
                                </table>
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td></td>
                                        <td></td>
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
<!--                                        <td><input name="Vehicle" id="Vehicle" placeholder="Vehicle No"   type="text" class="col-lg-1 form-control" ></td>-->
                                        <td></td>
                                        <td></td>
                                        <td><input name="sertaxtotal" id="sertaxtotal" placeholder="<?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?>" value="0" readonly="readonly"   type="text" class="text-right col-lg-1 form-control" ></td>
                                        <td><input name="sergtotal" id="sergtotal" placeholder="<?= label('Grand Total', $this, $user) ?>" value="0" readonly="readonly"  type="text" class="text-right col-lg-1 form-control" ></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">  
                        <?php if ($view != 'view') { ?>
                            <?php if ($is_edit >  0) { ?>
                            <div class="boo">
                                <select   id="printtype"  name="printtype" class="form-control" >
                                    <option value="">Select</option>  </select>
                            </div>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='form-button-save btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   
                            <div class='small-loading' id='FormLoading'> </div>
                        <?php } } ?>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</form> 
<div class="modal fade "  tabindex="-1"  id="modelextra"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-body"  > 
                <textarea class="form-control " cols="20" id="txtExtra"></textarea>
            </div> 
            <div class="modal-footer">
                <button data-toggle="tooltip" type="button"    title="Add To save" id="btnAddExtram"  class="btn btn-success" href="#">
                    <span class="glyphicon glyphicon-plus"></span> 
                </button>
                <button type="button" id="btncls"   class="btn btn-secondary" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
            </div>
        </div> 
    </div>
</div> 
<script type="text/javascript">
    //messages 
	
	function deleteimei(imei){
		 $(".btnimei"+imei).each(function () {
			$(this).trigger('click');					
         });
	}
	var chkid = 0;
    function calert(msg) {
         toastr["error"](msg);
    }
	
	function loadoldrate(id,is_edit = 0){
		var supid = $('#supid').val();
		var text = '<tr><td style="text-align:center" colspan="3">Old Rate Not Available</td></tr>';
		$('#bodyrate').html(text);
		var trtext = '';
		 $.ajax({
                url: "<?php echo site_url('ajaxcall/last_purchaserate'); ?>/" + id,
				method: 'post',
				async:false,
				data:{supid:supid},
                success: function (results) {
                    var  k = 0;
                    $.each(JSON.parse(results), function (i, itemsingle) {
                        if(k < 1 && is_edit == 0){
                            $('#prate_item').val(itemsingle.rate);
                        }
                        var tot_rate =((itemsingle.quantity * itemsingle.rate )  - itemsingle.dis_amt) /itemsingle.quantity ;
                        k++;
                       trtext = trtext +'<tr><td>'+itemsingle.date+'</td><td>'+itemsingle.invoice+'</td><td>'+itemsingle.mrp+'</td><td>'+itemsingle.rate+'</td><td>'+parseFloat(tot_rate).toFixed(2)+'</td></tr>';
                    });
                }
            });
			if(trtext !==''){
				$('#bodyrate').html(trtext);
			}
	}
    var inc_inary = 0;
    //class
    function item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincuded, item_discription, barcode, damage, item_size,srate_item,itembatch,item_ces_id,item_ces_per,item_ces_name,item_row_ces,hsncode,free_qty,wh_rate,special_rate,mrp_per,srate_per,whrate_per,special_rate_per,indexid,SQFTNO,ItemSQFT,lcode,cig_ces_per,unit_cig_ces_amt,cig_ces_per_amount,cig_ces_amt,itm_des,item_tax_on_mrp) {
        inc_inary = inc_inary + 1;
        this.inc_id = inc_inary;
        this.tax_purchase_id = item_discription;
        this.item_tax_on_mrp = item_tax_on_mrp;
        this.indexid = indexid;
		this.hsncode = hsncode;
        this.itm_des = itm_des;
        this.cig_ces_per = cig_ces_per;
        this.unit_cig_ces_amt = unit_cig_ces_amt;
        this.cig_ces_per_amount = cig_ces_per_amount;
        this.cig_ces_amt = cig_ces_amt;
		
        this.ItemSQFT = ItemSQFT;
        this.lcode = lcode;
        this.SQFTNO = SQFTNO;
		this.mrp_per = mrp_per;
		this.srate_per = srate_per;
		this.whrate_per = whrate_per;
		this.special_rate_per = special_rate_per;
		this.item_ces_id = item_ces_id;
		this.item_ces_per = item_ces_per;
		this.free_qty = free_qty;
		this.item_ces_name = item_ces_name;
		this.item_row_ces = item_row_ces;
		this.itembatch = itembatch;
        this.barcode = barcode;
        this.item_size = item_size;
		this.srate_item = srate_item;
        this.damage = damage;
        this.item_discription = item_discription;
        this.dis_item = dis_item;
        this.dis_amt = dis_amt;
        this.is_taxincuded = is_taxincuded;
        this.analyticsname = analyticsname;
        this.analytics = analytics;
        this.item_id = item_id;
        this.item_qty = item_qty;
        this.godown = godown;
        this.unit_item = unit_item;
        this.tax_item = tax_item;
        this.tax_amount = tax_amount;
        this.mrp_item = mrp_item;
		this.wh_rate = wh_rate;
		this.special_rate = special_rate;
        this.prate_item = prate_item;
        this.itemname = itemname;
        this.comontax = comontax;
        this.rowTotal = rowTotal;
        this.commission = commission;
        this.unit_name = unit_name;
        this.godown_name = godown_name;
        this.tax_name = tax_name;
        this.mfg = mfg;
        this.exp = exp;
    }
    //class array
    var items = new Array();

    function clear() {
        $('#item_damage_qty').val(0.00);
        clearValue($("#itm_des"));
        clearValue($("#free_qty"));
        clearValue($("#lcode"));
        clearValue($("#item_id"));
        clearValue($("#item_qty"));
        clearValue($("#godown"));
        clearValue($("#unit_item"));
        clearValue($("#tax_item"));
        clearValue($("#mrp_item"));
        clearValue($("#wh_rate"));
        clearValue($("#special_rate"));
        clearValue($("#prate_item"));
        clearValue($("#itemname"));
        clearValue($("#rowTotal"));
        clearValue($("#rowTax"));
        clearValue($("#dis_item"));
        clearValue($("#dis_amt"));
        clearValue($("#itemcode"));
    }

    function clearservice() {
        clearValue($("#ser_ledger"));
        clearValue($("#ser_ledgerid"));
        clearValue($("#ser_amt"));
        clearValue($("#ser_taxamt"));
    }

    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
            val = 0;
        }
        return val;
    }
	
	function calculatesertot(amt, tax) {
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        totamt = (parseFloat(totamt) - parseFloat(tax) - parseFloat(amt)).toFixed(company_roundoff);
        tottax = (parseFloat(tottax) - parseFloat(tax)).toFixed(company_roundoff);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
    }
	
	function removeimei(btn){
		$(btn).closest('tr').remove();
	}
	function removeservice(btn){
		var amt = $(btn).attr("seramt");
        var tax = $(btn).attr("sertax");
        calculatesertot(amt, tax);
        $('.tooltip').remove();
        $(btn).closest('tr').remove();
        calculateGTotal();
	}
    function addservices() {
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        var ledger = $("#ser_ledger").val();
        var ledgerid = $("#ser_ledgerid").val();
        var amount = $("#ser_amt").val();
        var taxid = $("#ser_tax").val();
        var tid = 0;
        var is_taxincuded = $("#is_tax").val();
        // var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));
        totamt = (parseFloat(totamt) + parseFloat(amount)).toFixed(company_roundoff);
        var gst = 0;
        var tax = 0;
        if (amount !== '0' && taxid !== null && taxid !== '0') {
            tax = $("#ser_tax option:selected").attr('percent');
            gst = (parseFloat(amount) - ((parseFloat(amount) * 100) / (parseFloat(tax) + 100))).toFixed(company_roundoff);
            if (is_taxincuded === "0") {
                gst = (parseFloat(amount) * parseFloat(tax) / 100).toFixed(company_roundoff);
                totamt = (parseFloat(totamt) + parseFloat(gst));
            }
            tottax = (parseFloat(tottax) + parseFloat(gst)).toFixed(company_roundoff);
            tid = $("#ser_tax").val();
        }
        $("#ser_taxamt").val(gst);
        addrowtoservice(amount, tid, tax, gst, ledger, ledgerid, is_taxincuded);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
        $("#ser_ledger").focus();
        calculateGTotal();
    }

    function addrowtoservice(amount, taxid, tax, gst, ledger, ledgerid, is_taxincuded) {
        var newrow = '<tr><td class="col-lg-4"> <input type="hidden" readonly="readonly" NoTab="true" value="' + ledgerid + '" tabindex="-1" name="serv_ledgerid[]" id="serv_ledgerid"/><input  NoTab="true"  readonly="readonly" id="serv_ledger"  class="form-control"  value="' + ledger + '" type="text"     placeholder="service ledger"/></td>' +
                ' <td> <input type="hidden" NoTab="true" value="' + taxid + ' " tabindex="-1" name="serv_taxid[]" readonly="readonly" id="serv_taxid"/><input  NoTab="true"   id="serv_tax"  class="form-control" readonly="readonly"  value="' + tax + ' " type="text"     placeholder="service ledger"/></td>' +
                ' <td> <input style="height:25px" id="serv_amt"  name="serv_amt[]" value="' + amount + '" type="text" readonly="readonly" class="form-control text-right  two-digits price " placeholder="service Amt"/></td>' +
                ' <td> <input type="hidden" readonly="readonly" NoTab="true" value="' + is_taxincuded + '" tabindex="-1" name="serv_is_taxincuded[]" id="serv_is_taxincuded"/><input id="serv_taxamt" name="serv_taxamt[]" value="' + gst + '"  type="text" readonly="readonly"   class="form-control  text-right two-digits" placeholder="GST"/></td>' +
                '<td> <span data-toggle="tooltip"   title="Remove" onclick="removeservice(this)" sertax="' + gst + '" seramt="' + amount + '"   class="btn btn-danger" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span> </td></tr>';
        $("#rows").append(newrow);
        clearservice();
    }
    function calculaterow(id) {
        var rate = getVal('itmrate' + id);
        var qty = getVal("itmqty" + id);
        var discount = getVal('itmdis' + id);

        var disamt = 0;
        if (discount !== '0' && rate !== '0' && qty !== '0') {
            disamt = parseFloat((rate * discount * qty) / 100);
        }
        $("#disamt" + id).val(disamt.toFixed(company_roundoff));
        calculaterowdis(id);
    }
    function calculaterowold(id) {
//        var is_discount = getVal('is_discount');
        var rate = getVal('itmrate' + id);
        var qty = getVal("itmqty" + id);
        var disamt = getVal('disamt' + id);
        var dis = 0;
//        if (is_discount === '1') {
        if (rate !== '' && qty !== '' && disamt !== '' && parseFloat(rate * qty) > parseFloat(disamt)) {
            dis = parseFloat(((disamt * 100) / (rate * qty)));
        }
//        }

        $("#itmdis" + id).val(dis.toFixed(company_roundoff));
        calculaterowdis(id);
    }

    function calculaterowdis(id) {
		var additional_cess = $('#additional_cess').val();
        var rate = getVal('itmrate' + id);
        var qty = getVal("itmqty" + id);
		if(qty === '' ){
			qty = 0 ;
		}
		qty = parseFloat(qty);
		qty = qty * 1000;
		qty = parseInt(qty);
		qty = qty / 1000;
		$('#itmqty'+id).val(qty);
        
        var unit_cig_ces_amt = $('#unit_cig_ces_amt'+id).val();
        var cig_ces_per = $('#cig_ces_per'+id).val();
		var cig_ces_per_amount = 0;
        var cig_ces_amt = 0;
        var tax_name = getVal("itmtaxper" + id);
        var total = parseFloat(qty * rate);
        var itmmrp = getVal("itmmrp" + id);
        var discount = getVal('itmdis' + id);
        var qty = getVal("itmqty" + id);
        // var is_taxincuded=("#is_taxincuded" + id).val();
        is_taxincuded = $("#is_taxincuded" + id).val();
        var itm = getIndexOf(items, id);
        var iteadd = items[itm];
        items.splice(itm, 1);
        iteadd.item_qty = qty;


        var rate = getVal('itmrate' + id);
        var qty = getVal("itmqty" + id);
        var disamt = getVal('disamt' + id);
        var dis = 0;
//        if (is_discount === '1') {
        if (rate !== '' && qty !== '' && disamt !== '' && parseFloat(rate * qty) > parseFloat(disamt)) {
            dis = parseFloat(((disamt * 100) / (rate * qty)));
        }
//        }

        $("#itmdis" + id).val(dis.toFixed(company_roundoff));

        //var disamt = 0;
        //if (discount !== '0' && rate !== '0' && qty !== '0') {
          //  disamt = parseFloat((rate * discount * qty) / 100);
        //}
        //$("#disamt" + id).val(disamt.toFixed(company_roundoff));


      var rowTax = (parseFloat(total || 0) - parseFloat(disamt || 0)) * parseFloat(tax_name || 0) / 100;

        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();

        if (purchase_tax_on_mrp > 0) {
            var item_tax_on_mrp = $('#itm_tax_on_mrp' + id).val();  
            
            if (item_tax_on_mrp > 0) {
                var itmMrp = parseFloat($('#itmmrp' + id).val()) || 0;
                var qty = parseFloat(qty) || 0;
                var taxRate = parseFloat(tax_name) || 0;

                // TAX INCLUSIVE FORMULA: (Total Amount * Tax Rate) / (100 + Tax Rate)
                var totalInclusiveAmount = itmMrp * qty;
                rowTax = (totalInclusiveAmount * taxRate) / (100 + taxRate);
                
                // Optional: Round to 2 decimal places if needed for your UI
                // rowTax = parseFloat(rowTax.toFixed(2));
            }
        }


        var total = parseFloat(total - disamt) + parseFloat(rowTax);
		var item_ces_per = $("#itm_ces_per" + id).val();
		var item_cess = 0 ;
        if (is_taxincuded === "1") {
			var tax_before = tax_name;
			if(parseFloat(additional_cess) > 0 &&  parseFloat(item_ces_per) > 0 ){
				tax_before = parseFloat(tax_before) + parseFloat(item_ces_per);
			}
            var total = parseFloat(qty * rate);
            var total = parseFloat(total - disamt);
			
            var rowtotces = ((parseFloat(total) * 100) / (parseFloat(tax_before) + 100));
            //var rowTax = (parseFloat(tot) - ((parseFloat(tot) * 100) / (parseFloat(tax_name) + 100)));
			var rowTax = rowtotces*tax_name/100;

             var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();

            if (parseFloat(purchase_tax_on_mrp) > 0) {
                var item_tax_on_mrp = $('#itm_tax_on_mrp' + id).val();  
                
                if (parseFloat(item_tax_on_mrp) > 0) {
                    var itmMrp = parseFloat($('#itmmrp' + id).val()) || 0;
                    var qty = parseFloat(qty) || 0;
                    var taxRate = parseFloat(tax_name) || 0;

                    // NEW INCLUSIVE FORMULA
                    // Instead of: (MRP * Qty * Tax) / 100
                    // Use: (MRP * Qty * Tax) / (100 + Tax)
                    
                    var rowTax = (itmMrp * qty * taxRate) / (100 + taxRate);
                    
                    // Optional: Round to 2 decimal places for currency accuracy
                    rowTax = Math.round(rowTax * 100) / 100;
                }
            }


			var item_cess = rowtotces*item_ces_per/100;
			$("#rowItemCes" + id).val(item_cess.toFixed(company_roundoff));
            var is_cigarette_cess = $('#is_cigarette_cess').val();
            if(is_cigarette_cess > 0 ){
                if(parseFloat(unit_cig_ces_amt) > 0  ){
                    cig_ces_amt = parseFloat(unit_cig_ces_amt) * parseFloat(qty);
                }
                if(parseFloat(cig_ces_per) > 0  && parseFloat(rowtotces) > 0 ){
                    cig_ces_per_amount = parseFloat(rowtotces) * parseFloat(cig_ces_per) / 100;
                }
            }
            
        }else{
			if(parseFloat(additional_cess) > 0 &&  parseFloat(item_ces_per) > 0 ){
				var item_cess = parseFloat(qty * rate - disamt) * parseFloat(item_ces_per) / 100;
				$("#rowItemCes" + id).val(item_cess.toFixed(company_roundoff));
				total = parseFloat(total)+parseFloat(item_cess);
			}
            var is_cigarette_cess = $('#is_cigarette_cess').val();
            if(is_cigarette_cess > 0 ){
            	var rowtotces = parseFloat(qty * rate - disamt);
                if(parseFloat(unit_cig_ces_amt) > 0  ){
                    cig_ces_amt = parseFloat(unit_cig_ces_amt) * parseFloat(qty);
                }
                if(parseFloat(cig_ces_per) > 0  && parseFloat(rowtotces) > 0 ){
                    cig_ces_per_amount = parseFloat(rowtotces) * parseFloat(cig_ces_per) / 100;
                }
            }
		}
        
        $("#itmtax" + id).val(rowTax.toFixed(company_roundoff));
        $("#itmtot" + id).val(total.toFixed(company_roundoff));
        $('#cig_ces_amt'+id).val(cig_ces_amt);
        $('#cig_ces_per_amount'+id).val(cig_ces_per_amount);

        iteadd.itmmrp = itmmrp;
        iteadd.cig_ces_per_amount = cig_ces_per_amount;
        iteadd.cig_ces_amt = cig_ces_amt;
		iteadd.item_row_ces = item_cess;
        iteadd.itmrate = rate;
        iteadd.dis_amt = disamt;
        iteadd.tax_amount = rowTax;
        iteadd.dis_item = discount;
        iteadd.tax_name = tax_name;
        iteadd.rowTotal = total;
        items.push(iteadd);
        calculateGTotal();
    }

    function calculaterowtotal() {
		var cig_ces_per = $('#cig_ces_per').val();
        var unit_cig_ces_amt = $('#unit_cig_ces_amt').val();
        var cig_ces_per_amount = 0;
        var cig_ces_amt = 0;
        var item_taxable = 0 ;
        var is_cigarette_cess = $('#is_cigarette_cess').val();
        var cessamt = 0;
		var additional_cess = $('#additional_cess').val();
        var prate = $("#prate_item").val();
        var qty = $("#item_qty").val();
        var dis_item = $("#dis_item").val();
        var dis_amt = $("#dis_amt").val();
        var tax_name = $("#tax_item option:selected").attr('percent');
        var is_taxincuded = $("#is_taxincuded").val();
        var curr_tax = $('#curr_tax').val();
        if (curr_tax === "0") {
            tax_name = 0;
        }
        var prate = parseFloat(prate) * parseFloat(qty);
        if (dis_amt === '') {
            dis_amt = 0;
        }
        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();

        // Default calculation (Tax Exclusive)
        var rowTax = (parseFloat(prate || 0) - parseFloat(dis_amt || 0)) * parseFloat(tax_name || 0) / 100;

        if (parseFloat(purchase_tax_on_mrp) > 0) {
            var item_tax_on_mrp = $('#item_tax_on_mrp').val();  
            
            if (parseFloat(item_tax_on_mrp) > 0) {
                var itmMrp = parseFloat($('#mrp_item').val()) || 0;
                var qty = parseFloat(qty) || 0;
                var taxRate = parseFloat(tax_name) || 0;

                // INCLUSIVE TAX CALCULATION
                // Formula: (Total Price * Tax Rate) / (100 + Tax Rate)
                rowTax = (itmMrp * qty * taxRate) / (100 + taxRate);
            }
        }
        var tot = parseFloat(prate - dis_amt) + parseFloat(rowTax);
		var item_ces_per = $('#item_ces_per').val();
		$('#itemcesamt').val(0);
        if (is_taxincuded === "1") {
			var tax_before = tax_name;
			if(parseFloat(additional_cess) > 0 &&  parseFloat(item_ces_per) > 0 ){
				tax_before = parseFloat(tax_before) + parseFloat(item_ces_per);
			}
            var tot = parseFloat(prate - dis_amt);
			var rowtotces = ((parseFloat(tot) * 100) / (parseFloat(tax_before) + 100));
            //var rowTax = (parseFloat(tot) - ((parseFloat(tot) * 100) / (parseFloat(tax_name) + 100)));
			var rowTax = rowtotces*tax_name/100;

            var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();

            // Default calculation (Tax Exclusive on Rate minus Discount)
            var rowTax = (parseFloat(prate || 0) - parseFloat(dis_amt || 0)) * parseFloat(tax_name || 0) / 100;

            if (parseFloat(purchase_tax_on_mrp) > 0) {
                var item_tax_on_mrp = $('#item_tax_on_mrp').val();  
                
                if (parseFloat(item_tax_on_mrp) > 0) {
                    var itmMrp = parseFloat($('#mrp_item').val()) || 0;
                    var qty = parseFloat(qty) || 0;
                    var taxRate = parseFloat(tax_name) || 0;

                    // INCLUSIVE TAX CALCULATION
                    // Old: (itmMrp * taxRate * qty) / 100
                    // New: (itmMrp * taxRate * qty) / (100 + taxRate)
                    
                    rowTax = (itmMrp * qty * taxRate) / (100 + taxRate);
                }
            }

			var item_cess = rowtotces*item_ces_per/100;
            cessamt = item_cess;
			$('#itemcesamt').val(item_cess.toFixed(company_roundoff));
            if(is_cigarette_cess > 0){
                var cig_ces_per = $('#cig_ces_per').val();
                var unit_cig_ces_amt = $('#unit_cig_ces_amt').val();
                var cig_ces_per_amount = 0;
                var cig_ces_amt = 0;
                if(parseFloat(unit_cig_ces_amt) > 0  ){
                    cig_ces_amt = parseFloat(unit_cig_ces_amt) * parseFloat(qty);
                }
                if(parseFloat(cig_ces_per) > 0  && parseFloat(rowtotces) > 0 ){
                    cig_ces_per_amount = parseFloat(rowtotces) * parseFloat(cig_ces_per) / 100;
                }
            }
        }else{
			if(parseFloat(additional_cess) > 0 &&  parseFloat(item_ces_per) > 0 ){
				var item_cess = parseFloat(prate - dis_amt) * parseFloat(item_ces_per) / 100;
                cessamt = item_cess;
				$('#itemcesamt').val(item_cess.toFixed(company_roundoff));
				tot = parseFloat(tot)+parseFloat(item_cess);
			}
            if(is_cigarette_cess > 0){
                var rowtotces = parseFloat(prate - dis_amt);
                var cig_ces_per = $('#cig_ces_per').val();
                var unit_cig_ces_amt = $('#unit_cig_ces_amt').val();
                var cig_ces_per_amount = 0;
                var cig_ces_amt = 0;
                if(parseFloat(unit_cig_ces_amt) > 0  ){
                    cig_ces_amt = parseFloat(unit_cig_ces_amt) * parseFloat(qty);
                }
                if(parseFloat(cig_ces_per) > 0  && parseFloat(rowtotces) > 0 ){
                    cig_ces_per_amount = parseFloat(rowtotces) * parseFloat(cig_ces_per) / 100;
                }
            }
		}

        $('#cig_ces_amt').val(cig_ces_amt);
        $('#cig_ces_per_amount').val(cig_ces_per_amount);


        if (!isNaN(tot)) {
            item_taxable = parseFloat(item_taxable) + parseFloat(tot);
            $("#rowTotal").val(tot.toFixed(company_roundoff));
			var item_lc = parseFloat(tot.toFixed(company_roundoff)) / parseFloat(qty);
			$('#item_lc').html(item_lc.toFixed(company_roundoff));
			$('#item_prate').html(((tot-rowTax)/parseFloat(qty)).toFixed(company_roundoff));
			
			$('#itemlc').val(item_lc.toFixed(company_roundoff));
			$('#itemprate').val(((tot-rowTax)/parseFloat(qty)).toFixed(company_roundoff));
			console.log(item_lc+'FK'+tot+'QRT'+qty);
        } else {
            $("#rowTotal").val(0);
			$('#item_lc').html(0);
			$('#item_prate').html(0);
			$('#itemlc').html(0);
			$('#itemprate').html(0);
        }
        if (!isNaN(rowTax)) {
            item_taxable = parseFloat(item_taxable) - parseFloat(rowTax);
            $("#rowTax").val(rowTax.toFixed(company_roundoff));
        } else {
            $("#rowTax").val(0);
        }
        item_taxable = parseFloat(item_taxable) - parseFloat(cessamt);
        if (!isNaN(item_taxable)) {
            $("#item_taxable").val(parseFloat(item_taxable).toFixed(3));
        }
		var is_autoupdate_rate = $('#is_autoupdate_rate').val();
		if(parseFloat(is_autoupdate_rate) > 0  ){
			calculate_autorate();
		}
    }
	
	
    $(document).on('keydown', '.nosave', function(e) {
         var key = e.charCode || e.keyCode || 0;
		 if (key === 13) {
            e.preventDefault();
         }
	});

	$(document).on('change', '.autorate', function() {
		calculate_autorate();
	});

    $(document).on('change', '#mrp_item', function() {
		calculaterowtotal();
	});
	
	function calculate_autorate(){
		var is_autoupdate_rate = $('#is_autoupdate_rate').val();
		if(parseFloat(is_autoupdate_rate) > 0  ){
			if($('#auto_update_rates').is(":checked")){
				var itemlc = $('#itemlc').val();
				var itemprate = $('#itemprate').val();
				var rate_update_by = $('#rate_update_by').val();
				if(rate_update_by === 'landing_cost'){
					var amount = itemlc;
				}else{
					var amount = itemprate;
				}
				
				if(parseFloat(amount) >  0   ){
					var mrp_per  = $('#mrp_per').val();
					if(mrp_per ===''){
						mrp_per = 0 ;
					}
					var srate_per  = $('#srate_per').val();
					if(srate_per ===''){
						srate_per = 0 ;
					}
					var whrate_per  = $('#whrate_per').val();
					if(whrate_per ===''){
						whrate_per = 0 ;
					}
					var special_rate_per  = $('#special_rate_per').val();
					if(special_rate_per ===''){
						special_rate_per = 0 ;
					}
					if(parseFloat(mrp_per) > 0  ){
						var mrp = parseFloat(amount) + parseFloat(amount)*mrp_per /100;
						$('#mrp_item').val(mrp.toFixed(2));
					}
					
					if(parseFloat(srate_per) > 0  ){
						var srate = parseFloat(amount) + parseFloat(amount)*srate_per /100;
						$('#srate_item').val(srate.toFixed(2));

					}
					
					if(parseFloat(whrate_per) > 0  ){
						var whrate = parseFloat(amount) + parseFloat(amount)*whrate_per /100;
						$('#wh_rate').val(whrate.toFixed(2));
					}
					
					if(parseFloat(special_rate_per) > 0  ){
						var special = parseFloat(amount) + parseFloat(amount)*special_rate_per /100;
						$('#special_rate').val(special.toFixed(2));
					}
				}
			}
		}
	}

    function  calculateGTotal() {
        var tot_cig_ces_amt = 0;
        var tot_cig_per_ces_amt = 0 ;
		var is_round_off = $('#is_round_off').val();
        var roundoffs = company_roundoff;
        if (parseFloat(is_round_off) > 0) {
            roundoffs = 0;
        }
		var quantity = 0;
        var total = 0;
        var tax = 0;
        var itmno = 0;
        var j = 0;
        var discount = 0;
		var itm_net_ces = 0;
        $.each(items, function (i) {
            j = j + 1;
            itmno = itmno + 1;
			quantity = parseFloat(items[i].item_qty)+ parseFloat(quantity);
            discount = parseFloat(discount) + parseFloat(items[i].dis_amt);
            tot_cig_ces_amt = parseFloat(tot_cig_ces_amt) + parseFloat(items[i].cig_ces_amt);
            tot_cig_per_ces_amt = parseFloat(tot_cig_per_ces_amt) + parseFloat(items[i].cig_ces_per_amount);
            $("#itmno" + items[i].inc_id).val(itmno.toFixed(0));
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
			if(items[i].item_row_ces !== undefined){
				itm_net_ces = parseFloat(itm_net_ces) + parseFloat(items[i].item_row_ces);
			}
        });
		
		$('#totitmqty').val(quantity);
		$('#itm_net_ces').val(itm_net_ces.toFixed(company_roundoff));
        $("#totnolist").val(j);
        var sertax = getVal("sertaxtotal");
        var seramt = getVal("sergtotal");
        sertax = parseFloat(tax) + parseFloat(sertax);
        console.log('cigtax'+tax); 
        //$("#discount").val(discount.toFixed(company_roundoff));
        $("#total").val(total.toFixed(company_roundoff));
        $("#totpuretax").val(tax.toFixed(company_roundoff));
        $("#taxtotal").val(sertax.toFixed(company_roundoff));
        $("#tot_cig_ces_amt").val(parseFloat(tot_cig_ces_amt).toFixed(2));
        $("#tot_cig_per_ces_amt").val(parseFloat(tot_cig_per_ces_amt).toFixed(2));
        var freight = getVal("freight");
        var other = getVal("other");
        var discount = getVal("discount");
        var gtotal = parseFloat(total) +  parseFloat(tot_cig_ces_amt) + parseFloat(tot_cig_per_ces_amt) + parseFloat(seramt) + parseFloat(freight) + parseFloat(other) - parseFloat(discount);
        var txtTaxable = parseFloat(gtotal) + parseFloat(parseFloat(discount)) - parseFloat(sertax);
        $('#txtTaxable').val(parseFloat(txtTaxable).toFixed(2));
        var rount = (parseFloat(gtotal.toFixed(roundoffs)) - parseFloat(gtotal.toFixed(company_roundoff))).toFixed(company_roundoff);
        $("#gtotal").val(parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff));
        var com_currency = $("#com_currency").val();
        var comset_currency = $("#comset_currency").val();
        if (com_currency === comset_currency) {
            $("#cur_gtotal").val(parseFloat(gtotal.toFixed(roundoffs)).toFixed(company_roundoff));
        } else {
            var curr_value = $("#curr_value").val();
            var curr_value = parseFloat(curr_value * gtotal);
            $("#cur_gtotal").val(parseFloat(curr_value.toFixed(roundoffs)).toFixed(company_roundoff));
        }
        $("#rount").val(rount);
    }

    function  validate(item_id) {
        var validate = 0;
        $.each(items, function (i) {
            if (items[i].item_id === item_id) {
                validate = 1;
                return validate;
            }
        });
        return validate;
    }
	
	function setbillno() {
		var id = $('#btype').val();
        var p_id = $('#p_id').val();
        if (p_id === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/Purchase/getinoviceno'); ?>/" + id,
                success: function (result) {
                    $('#purchase_invoice').html(result);
//                    document.getElementById("b_no").contentEditable = true;
                }
            });
        }
    }

    function insertItems() {
		var item_row_ces = $('#itemcesamt').val();
        var item_id = $("#item_id").val();
        if (item_id === '' || item_id === undefined) {
            $("#itemname").focus();
            calert('Please add a valid item');
            return;
        }
        var itm_des = '';
        <?php if($category_barcode>0){?>
            var itm_des = $('#itm_des').val();
        <?php }?>
		var hsncode = $("#hsn").val();
        var dis_item = $("#dis_item").val();
        var dis_amt = $("#dis_amt").val();
        var item_qty = $("#item_qty").val();
        var unit_item = $("#unit_item").val();
        var godown = $("#godown").val();
        var tax_item = $("#tax_item").val();
        var mrp_item = $("#mrp_item").val();
		
        var wh_rate = $("#wh_rate").val();
        var special_rate = $("#special_rate").val();
		
        var prate_item = $("#prate_item").val();
        var is_taxincuded = $("#is_taxincuded").val();
        var itemname = $("#itemname").val();
        itemname = $("#itemname1").val();
        $("#itemname1").val("");
        $("#itemname").val("");
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var tax_amount = $("#rowTax").val();
        var godown_name = $("#godown option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
        var tax_name = $("#tax_item option:selected").text();
        var item_discription = $('#txtExtra').val();
        var barcode = $('#itemcode').val();
        $('#txtExtra').val('');
        var mfg = $("#mfg").val();
        var exp = $("#exp").val();
        var tax_purchase_id = $("#tax_led_id").val();
        var analyticsname = $("#analyticscenter option:selected").text();
        var analytics = $("#analyticscenter").val();
        var zeroindex = $('#zeroindex').val();
        var curr_tax = $('#curr_tax').val();
        var damage = $('#item_damage_qty').val();
        var item_size = $('#item_size').val();
		var srate_item =  $('#srate_item').val();
        if (damage === "" || damage === null || damage === undefined) {
            damage = 0;
        }
        if (curr_tax === "0") {
            tax_amount = 0;
            tax_name = 0;
            tax_item = zeroindex;
        }
		var itembatch =	$("#itembatch").val();
		var item_ces_per = $('#item_ces_per').val();
		var item_ces_name = $('#item_ces_name').val();
		var item_ces_id = $('#item_ces_id').val();
		var free_qty = $('#free_qty').val();
		if(free_qty === ''){
			free_qty = 0 ;
		}
		
		var mrp_per = $('#mrp_per').val();
		var srate_per = $('#srate_per').val();
		var whrate_per = $('#whrate_per').val();
		var special_rate_per = $('#special_rate_per').val();
        var lcode = $('#lcode').val();
        var indexid = 0;
        var SQFTNO = $('#sqft_number').val();
        var ItemSQFT = $('#item_SQFT').val();
        var cig_ces_per = $('#cig_ces_per').val();
        var unit_cig_ces_amt = $('#unit_cig_ces_amt').val();
        var cig_ces_per_amount = $('#cig_ces_per_amount').val();
        var cig_ces_amt = $('#cig_ces_amt').val();
        var item_tax_on_mrp = 0 ;
        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();
        if(parseFloat(purchase_tax_on_mrp) > 0  ){
            var item_tax_on_mrp = $('#item_tax_on_mrp').val();
        }  
        var iteadd = new item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, '', godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincuded, item_discription, barcode, damage, item_size,srate_item,itembatch,item_ces_id,item_ces_per,item_ces_name,item_row_ces,hsncode,free_qty,wh_rate,special_rate,mrp_per,srate_per,whrate_per,special_rate_per,indexid,SQFTNO,ItemSQFT,lcode,cig_ces_per,unit_cig_ces_amt,cig_ces_per_amount,cig_ces_amt,itm_des,item_tax_on_mrp);
        addrowtoTable(iteadd);
        items.push(iteadd);
        $('.myspop').popover();
    }
	
	function editrow(id){
		var itm = getIndexOf(items, id);
		$('#purchase_item_index').val(id);
		var iteadd = items[itm];
		var item_size = iteadd.item_size;
        var itm_des = iteadd.itm_des;
        var ItemSQFT = iteadd.ItemSQFT;
        var SQFTNO = iteadd.SQFTNO;
        var lcode = iteadd.lcode;
		var item_qty = iteadd.item_qty;
		var damage = iteadd.damage;
		var itembatch = iteadd.itembatch;
		var free_qty = iteadd.free_qty;
		var godown = iteadd.godown;
		var unit_item = iteadd.unit_item;
		var tax_item = iteadd.tax_item;
		var mrp_item = iteadd.mrp_item;
		var wh_rate = iteadd.wh_rate;
		var special_rate = iteadd.special_rate;
		var prate_item = iteadd.prate_item;
		var itemname = iteadd.itemname;
		var dis_item = iteadd.dis_item;
		var dis_amt = iteadd.dis_amt;
		var rowTax = iteadd.tax_amount;
		var rowTotal = iteadd.rowTotal;
		var item_id = iteadd.item_id;
		var barcode = iteadd.barcode;
		var mfg = iteadd.mfg;
		var exp =iteadd.exp;
		var analytics = iteadd.analytics;
		var item_ces_id = iteadd.item_ces_id;
		var item_ces_per = iteadd.item_ces_per;
		var item_ces_name = iteadd.item_ces_name;
		var item_row_ces = iteadd.item_row_ces;
		var srate_item = iteadd.srate_item;
		var hsncode = iteadd.hsncode;
			$('#itm_des').val(itm_des);
			$('#free_qty').val(free_qty);
			$('#hsn').val(hsncode);
			$('#itemname1').val(itemname);
			$('#item_ces_id').val(item_ces_id);
			$('#item_ces_per').val(item_ces_per);
			$('#item_ces_name').val(item_ces_name);
			$('#itemcesamt').val(item_row_ces);
		$('#mfg').val(mfg);
        $('#lcode').val(lcode);
		$('#exp').val(exp);
		$('#analyticscenter').val(analytics);
		$('#itemcode').val(barcode);
		$('#item_size').val(item_size);
		$('#item_qty').val(item_qty);
		$('#item_damage_qty').val(damage);
		$('#godown').val(godown);
		
		var mrp_per = iteadd.mrp_per;
		var srate_per = iteadd.srate_per;
		var whrate_per = iteadd.whrate_per;
		var special_rate_per = iteadd.special_rate_per;
		
		$('#mrp_per').val(mrp_per);
		$('#srate_per').val(srate_per);
		$('#whrate_per').val(whrate_per);
		$('#special_rate_per').val(special_rate_per);
		
		
		 $.ajax({
             url: "<?php echo site_url('ajaxcall/units'); ?>/" + item_id,
             success: function (result) {
                $('#unit_item').html(result);
                $('#unit_item').val(unit_item);
              }
        });
		$('#srate_item').val(srate_item);
		$('#unit_item').val(unit_item);
		$('#tax_item').val(tax_item);
		$('#itembatch').val(itembatch);
		$('#mrp_item').val(mrp_item);
		$('#wh_rate').val(wh_rate);
		$('#special_rate').val(special_rate);
		$('#prate_item').val(prate_item);
		$('#dis_item').val(dis_item);
		$('#dis_amt').val(dis_amt);
		$('#rowTax').val(rowTax);
		$('#rowTotal').val(rowTotal);
		$('#item_id').val(item_id);
		var item_lc = parseFloat(rowTotal)/ parseFloat(item_qty);
		$('#item_lc').html(item_lc.toFixed(2));
		$("#item_header").html(itemname);
		$('.clstremei').attr('style','display:none');
		$('.clsimei'+id).attr('style','');
		loadoldrate(item_id,1);

        var ItemSQFT = iteadd.ItemSQFT;
        var SQFTNO = iteadd.SQFTNO;
        $('#itemsqft').val(ItemSQFT);
        $('#sqft_number').val(SQFTNO);
        $('#item_SQFT').val(ItemSQFT);
        $('.clssqftmodal').trigger('change');

		$("#modal-alter").modal();
		$('#item_qty').focus();
        $('#item_qty').trigger('keydown');
	}


    function addrowtoTable(items) {
        var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();
		var purchase_item_index = $('#purchase_item_index').val();
		if(parseFloat(purchase_item_index)>0){
			$('#btnremove'+purchase_item_index).trigger('click');
			$('#purchase_item_index').val(0);
			clear();
		}
		$("#itembatch").val('');
        $('#itemname').val("");        
        $('#btnclsmain').click();
        $('#btncls').click();
		
		var indexid = items.indexid;
		var mrp_per = items.mrp_per;
        var lcode = items.lcode;
        var SQFTNO = items.SQFTNO;
        var row_tax_on_mrp = 0 ;
        if(purchase_tax_on_mrp > 0 ){
            var row_tax_on_mrp = items.item_tax_on_mrp;
        }
        var cig_ces_per = items.cig_ces_per;
        var unit_cig_ces_amt = items.unit_cig_ces_amt;
        var cig_ces_per_amount = items.cig_ces_per_amount;
        var cig_ces_amt = items.cig_ces_amt;
        var tot_cess = parseFloat(cig_ces_per_amount) + parseFloat(cig_ces_amt);
        var ItemSQFT = items.ItemSQFT;
		var srate_per = items.srate_per;
		var whrate_per = items.whrate_per;
		var special_rate_per = items.special_rate_per;
        var batch = $("#is_batch").val();
		var item_ces_id = items.item_ces_id;
		var free_qty = items.free_qty;
		var hsncode = items.hsncode;
		var item_ces_per = items.item_ces_per;
		var item_ces_name = items.item_ces_name;
		var additional_cess = $('#additional_cess').val();
		var item_row_ces = items.item_row_ces;
        var dis_amt = items.dis_amt;
		var srate_item = items.srate_item;
		var itembatch = items.itembatch;
        var dis_item = items.dis_item;
        var item_id = items.item_id;
        var unit_item = items.unit_item;
        var godown = items.godown;
        var item_size = items.item_size;
        var item_size_name = $("#itm_size [value=" + item_size + "]").text();
        var item_qty = items.item_qty;
        var tax_item = items.tax_item;
        var damage = items.damage;
        var mrp_item = items.mrp_item;
        var wh_rate = items.wh_rate;
        var special_rate = items.special_rate;
        var prate_item = items.prate_item;
        var itemname = items.itemname;
        var comontax = items.comontax;
        var rowTotal = items.rowTotal;
        var tax_amount = items.tax_amount;
        var is_taxincuded = items.is_taxincuded;
        var item_discription = items.item_discription;
        var mfg = items.mfg;
        var itm_des = items.itm_des;
        var exp = items.exp;
        var barcode = items.barcode;
        var transaction_type = $('#transaction_type').val();
        var is_extra = $("#is_extra").val();
        var pophtml = 'MRP -' + items.mrp_item + '<br/> ' + 'Purchase Rate -' + items.prate_item;
        if (batch === '1') {
            pophtml = pophtml + '<br/> ' + 'Mfg Date -' + mfg + '<br/> ' + 'Exp Date -' + exp;
        }
        var is_analytics = $("#is_analytics").val();
        if (is_analytics === "1") {
            pophtml = pophtml + '</br> Abalytics Center -' + items.analyticsname;
        }
		var del = '<div class="btn-group" style="width:100%"><button id="btnremove' + items.inc_id + '"  type="button" style="width:49%" data-toggle="tooltip" onclick="remove(this)"  index="' + items.inc_id + '"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button><button  class="btn btn-warning " style="width:49%" type="button" onclick="editrow(' + items.inc_id + ')"  ><span class="glyphicon glyphicon-copy"></span></button></div>';	  var pophtml = 'MRP -' + items.mrp_item + '<br/> ' + 'Purchase Rate -' + items.pur_rate;
        if (is_extra === "1") {
            pophtml = pophtml + '</br>' + '<textarea col=23 form="usrform">' + item_discription + '</textarea>';
        }
        var rowval = td(1, 'item_no[]', ' text-right', 'id="itmno' + items.inc_id + '"', 'sma');
        var is_itemcode = $("#is_itemcode").val();
        if (is_itemcode === "1") {
            rowval = rowval + td(barcode, 'item[]', '', '', 'col-lg-1', pophtml);
        }
        var rowval = rowval + td(itemname, 'itemname[]', '', '', '', pophtml);
        var is_godown = $("#is_godown").val();

        if (is_godown === "1") {
            rowval = rowval + td(items.godown_name, 'mygodown[]', 'sma');
        }

        if(purchase_tax_on_mrp > 0 ){
          rowval = rowval+   hidden(row_tax_on_mrp, 'itm_tax_on_mrp[]','id="itm_tax_on_mrp' + items.inc_id + '"');
        }

        rowval = rowval+ hidden(cig_ces_amt, 'cigcesamt[]','id="cig_ces_amt' + items.inc_id + '"') + hidden(cig_ces_per_amount, 'cigcesperamount[]','id="cig_ces_per_amount' + items.inc_id + '"') + hidden(unit_cig_ces_amt, 'unitcigcesamt[]','id="unit_cig_ces_amt' + items.inc_id + '"') + hidden(cig_ces_per, 'cigcesper[]','id="cig_ces_per' + items.inc_id + '"');
        <?php if($lcode > 0 ){?>
            var rowval = rowval + tde(lcode, 'itm_lcode[]', 'form-control', 'id="itm_lcode' + items.inc_id + '" ');
            rowval = rowval +  hidden(item_size_name, 'item_size_name[]','id="item_size_name' + items.inc_id + '"');

        <?php }else{?>
            var rowval = rowval + td(item_size_name, 'item_size_name[]', 'col-lg-1 cma text-right');
            rowval = rowval +  hidden(lcode, 'itm_lcode[]','id="itm_lcode' + items.inc_id + '"');

        <?php }?>
       


        var rowval = rowval + tde(item_qty, 'item_qty[]', 'form-control text-right col-lg-1 two-digits nosave price', 'id="itmqty' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
        if (transaction_type === 'purchase1') {
            var rowval = rowval + tde(damage, 'damage_qty[]', 'form-control text-right col-lg-1 two-digits price nosave', 'id="damage_qty' + items.inc_id + '" ');
        } else {
            rowval = rowval + hidden(0, 'damage_qty[]');
        }
        var is_analytics = $("#is_analytics").val();
        if (is_analytics === "1") {
            var analytics = items.analytics;
            var analyticsname = items.analyticsname;
            rowval = rowval + hidden(analytics, 'analytics_id[]');
        }
        rowval = rowval + hidden(indexid, 'index_id[]'); ;
        var rowval = rowval + td(items.unit_name, 'uname[]', 'col-lg-1 cma text-right');
        if (batch === '1') {
            rowval = rowval + hidden(mfg, 'mdate[]') + hidden(exp, 'edate[]');
        }
        rowval = rowval + hidden(itm_des, 'itm_desc[]');
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name, 'taxper[]', 'col-lg-1 text-right', 'id="itmtaxper' + items.inc_id + '"');
        }
        rowval = rowval +  hidden(SQFTNO, 'itemSQFTNO[]','id="itemSQFTNO' + items.inc_id + '"');
		rowval = rowval +  hidden(ItemSQFT, 'itemItemSQFT[]','id="itemItemSQFT' + items.inc_id + '"');
        rowval = rowval + hidden(is_taxincuded, 'is_taxincuded[]', 'id="is_taxincuded' + items.inc_id + '"')+ tde(prate_item, 'prate_item[]', ' text-right nosave', 'id="itmrate' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(srate_item, 'sale_rate[]', 'text-right nosave', 'id="itmsrate' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')')+tde(mrp_item, 'mrp_item[]', 'text-right nosave', 'id="itmmrp' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')')  + tde(dis_item, 'dis_item[]', 'disper text-right nosave', 'id="itmdis' + items.inc_id + '" onchange=calculaterow(' + items.inc_id + ')') + tde(dis_amt, 'dis_amt[]', 'text-right nosave', 'id="disamt' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
		rowval = rowval  +  hidden(wh_rate, 'item_wh_rate[]', 'id="item_wh_rate' + items.inc_id + '"');
		rowval = rowval  +  hidden(special_rate, 'item_special_rate[]', 'id="item_special_rate' + items.inc_id + '"');
		if(parseFloat(additional_cess) > 0 ){
		  rowval = rowval +  td(item_row_ces, 'rowItemCes[]', 'text-right itmces ', 'id="rowItemCes' + items.inc_id + '"', '')+hidden(item_ces_id, 'itm_ces_id[]')+hidden(item_ces_name, 'itm_ces_name[]')+hidden(item_ces_per, 'itm_ces_per[]', 'id="itm_ces_per' + items.inc_id + '"');
		}
	  if (comontax === '0') {
            rowval = rowval + td(tax_amount, 'tax_amount[]', 'col-lg-1 text-right', 'id="itmtax' + items.inc_id + '"');
        }
//        rowval = rowval + td(mfg, 'mdate[]', 'hunpx text-right');


		rowval = rowval + hidden(mrp_per,'mrpper[]' , 'id="mrpper' + items.inc_id + '"' ) ;
		rowval = rowval + hidden(srate_per,'srateper[]' , 'id="srateper' + items.inc_id + '"' ) 
		rowval = rowval + hidden(whrate_per,'whrateper[]' , 'id="whrateper' + items.inc_id + '"' ) 
		rowval = rowval + hidden(special_rate_per,'special_rateper[]' , 'id="special_rateper' + items.inc_id + '"' ) 
		var roet = parseFloat(tot_cess) + parseFloat(rowTotal);
		rowval = rowval + hidden(roet,'roet[]' , 'id="roet' + items.inc_id + '"' ) ;
        rowval = rowval + hidden(free_qty,'free_qty[]' , 'id="free_qty' + items.inc_id + '"' ) + hidden(hsncode,'hsncode[]')+hidden(items.inc_id, 'pur_itms_index_id[]') + hidden(itembatch, 'item_batch_name[]') + hidden(item_id, 'item_id[]') + hidden(item_size, 'itmsize[]') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'col-lg1-1 text-right', 'id="itmtot' + items.inc_id + '"') + tdhtml(del);
        rowval = rowval + hidden(item_discription, 'itmdtn[]', 'id="itmdtn' + items.idinc + '"');
        var newRow = tr(rowval);
        $("#rowm").prepend(newRow);
		if(parseFloat(purchase_item_index)<1){
			$('.clsimei0').addClass('clsimei'+items.inc_id);
			$('.clsimei0').removeClass('clsimei0');
			$('.indeximei0').attr('name','indeximei'+items.inc_id+"[]");
			$('.indeximei0').val(items.inc_id);
			$(".indeximei0").addClass("indeximei"+items.inc_id);
			$(".indeximei0").removeClass("indeximei0");
			$('.txtimei0').addClass("txtimei"+items.inc_id);
			$('.txtimei0').attr('name','itemIMEI'+items.inc_id+'[]');
			$('.txtimei0').attr('indeximei',items.inc_id);
			$('.txtimei0').removeClass('txtimei0');
			$('.btnimei0').addClass("btnimei"+items.inc_id);
			$('.btnimei0').removeClass('btnimei0');
		}else{
			$('.clsimei'+purchase_item_index).addClass('clsimei'+items.inc_id);
			$('.clsimei'+purchase_item_index).removeClass('clsimei'+purchase_item_index);
			$('.indeximei'+purchase_item_index).attr('name','indeximei'+items.inc_id+"[]");
			$('.indeximei'+purchase_item_index).val(items.inc_id);
			$(".indeximei"+purchase_item_index).addClass("indeximei"+items.inc_id);
			$(".indeximei"+purchase_item_index).removeClass("indeximei"+purchase_item_index);
			$('.txtimei'+purchase_item_index).addClass("txtimei"+items.inc_id);
			$('.txtimei'+purchase_item_index).attr('name','itemIMEI'+items.inc_id+'[]');
			$('.txtimei'+purchase_item_index).attr('indeximei',items.inc_id);
			$('.txtimei'+purchase_item_index).removeClass('txtimei'+purchase_item_index);
			
			$('.btnimei'+purchase_item_index).addClass('btnimei'+items.inc_id);
			$('.btnimei'+purchase_item_index).removeClass('btnimei'+purchase_item_index);
		}
        $('#purchaseTable').tableNav();
        $("#itemcode").focus();
        setTimeout(function() {
            $("#itemcode").focus();
        }, 1000);
        setTimeout(function() {
            $("#itemcode").focus();
        }, 2000);

    }

    function add() {
		var godown = $('#godown').val();
		if(godown !=='' && godown !== 0 && godown !== '0' && godown !=='null' && godown !==null){
			insertItems();
			clear();
			calculateGTotal();
			$("#itemcode").focus();
            $("#itemname").val("");
		}else{
			calert('Please Select a Godown');
		}

    }

    function rowtotal(qty, prate) {
        return (parseFloat(qty) * parseFloat(prate)).toFixed(company_roundoff);
    }

    function itemsearch() {
        var type = $("#itemcode").attr('stype');
        var text = $("#itemcode").val();
        var customer = '';
        $('.itemname').attr('data-placement', 'right');
        $('.itemname').popover('toggle');
        $("[wf-popover]").popover({
            html: true,
            content: function () {
                var content = $(this).attr("wf-content");
                return content;
            },
            title: function () {
                var title = $(this).attr("wf-title");
                return title;
            },
            placement: function () {
                var my = this.$element.attr('wf-popover');
                return my;
            }
        });
        $('.myspop').popover();

        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch_purchase/barcode/' + customer + '?', {term: text}, function (result) {
            $.each(result, function (i, field) {
                var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
                var item_tax_on_mrp = 0 ;
                if(purchase_tax_on_mrp > 0 ){
                    item_tax_on_mrp = field.tax_on_mrp;
                }
                $('#item_tax_on_mrp').val(item_tax_on_mrp);
				$('#hsn').val(field.hsncode);
				var additional_cess = $('#additional_cess').val();
				var ces_id = 0;
				var ces_percent  = 0;
				var ces_name = '';
				if(parseFloat(additional_cess) > 0 ){
					ces_id = field.ces_id;
					ces_percent = field.ces_percent;
					ces_name = field.ces_name;
				}
				$('#item_ces_per').val(ces_percent);
				$('#item_ces_id').val(ces_id);
				$('#item_ces_name').val(ces_name);
                var list = "";
                $('#myDropdown').html(list);
				$('#purchase_item_index').val(0);
				$('#IMEITBL tr').removeClass("clsimei0");
				$('.clstremei').attr('style','display:none');
				deleteimei(0);
                $('#item_SQFT').val(field.sqft);
                $('#sqft_number').val(0);
                $('#sqft_quantity').val(0);
                $('.clssqftmodal').trigger('change');
                $('#mfg').val('');
		        $('#exp').val('');
                $("#modal-alter").modal();

             


                $("#item_header").html(field.name);
                $("#srate_item").val(field.p_srate);
                $("#itembatch").val(field.itembatch);
                $("#itemname").val(field.name);
                $("#itemname1").val(field.name);
                $("#mrp_item").val(field.MRP);
				
                $('#cig_ces_per').val(field.cigarette_cess_percentage);
                $('#unit_cig_ces_amt').val(field.cigarette_cess_amount);

				$("#wh_rate").val(field.wh_rate);
				$("#special_rate").val(field.special_rate);
				
                $("#prate_item").val(field.prate);
				
				var fixed_prate = $('#fixed_prate').val();
							if(parseFloat(fixed_prate) > 0  ){
								var otherfee = field.otherfee;
								if(otherfee === '' || otherfee === undefined || otherfee === null || otherfee === 'null' ){
									otherfee = 0 ;
								}
								if(parseFloat(otherfee) > 0 ){
									$("#prate_item").val(otherfee);
								}
				}
                $("#unitvalue").val(field.prate);
                $("#tax_led_id").val(field.tax_purchase_id);
                $("#itemcode").val(field.barcode);
                $("#item_qty").focus();
                var is_multipletax = $('#is_multipletax').val();
                if (is_multipletax === '1') {
                    if (field.tax_purchase_id !== undefined && field.tax_purchase_id !== '' && field.tax_purchase_id !== 0) {
                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + field.tax_purchase_id,
                            async: false,
                            success: function (results) {
                                var result = JSON.parse(results);
                                field.tax_id = result.ref_id;
                            }
                        });
                    }
                }

                $('#tax_item').val(field.tax_id);
                var zeroindex = $('#zeroindex').val();
                var curr_tax = $('#curr_tax').val();
                if (curr_tax === "0") {
                    $('#tax_item').val(zeroindex);
                }
                $('#item_id').val(field.id);
                $("#prate").html('Rate :' + field.prate);
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + field.id,
                    success: function (result) {
                        $('#unit_item').html(result);
                        $('#unit_item').val(field.unit_id);
                        $("#item_qty").focus().select();
                    }
                });
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/godown'); ?>",
                    success: function (result) {
                        $('#godown').html(result);
                        var user_default_godown = $('#user_default_godown').val();
                        if (user_default_godown !== "") {
                            $('#godown').val(user_default_godown);
                        }
                        var billgodown = $("#btype option:selected").attr('godown');
                        if (billgodown !== '0') {
                            $('#godown').val(billgodown);
                        }
                    }
                });
                loadoldrate(field.id);

            });
        });
    }

    $.validate({
        modules: 'date, security,file'
    });

    function loadCustByid(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results)[0];
                $('#supname').val(result.name);
                $('#supid').val(result.id);
                $('#phone').val(result.phone);
                $('#email').val(result.email);
                $('#cst').val(result.cst);
                $('#tin').val(result.tin);
                $('#address').val(result.address_line1);
                $('#address_line2').val(result.address_line2);
                $('#details').val(result.details);
            }
        });
    }

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];
        return day + '/' + month + '/' + year;
    }

    function itemsearchbyid(id) {
        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemsearchbyid/' + id,
                function (result) {
                    $.each(result, function (i, field) {

                    var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
                            var item_tax_on_mrp = 0 ;
                            if(purchase_tax_on_mrp > 0 ){
                                item_tax_on_mrp = field.tax_on_mrp;
                            }
                            $('#item_tax_on_mrp').val(item_tax_on_mrp);
						var additional_cess = $('#additional_cess').val();
						var ces_id = 0;
						var ces_percent  = 0;
						var ces_name = '';
						if(parseFloat(additional_cess) > 0 ){
							ces_id = field.ces_id;
							ces_percent = field.ces_percent;
							ces_name = field.ces_name;
						}
						$('#item_ces_per').val(ces_percent);
						$('#item_ces_id').val(ces_id);
						$('#item_ces_name').val(ces_name);
                        var list = "";
                        $('#myDropdown').html(list);
						$('#purchase_item_index').val(0);
						$('#IMEITBL tr').removeClass("clsimei0");
						$('.clstremei').attr('style','display:none');
						deleteimei(0);
                        $("#modal-alter").modal();
                        $('#mfg').val('');
		                $('#exp').val('');
                        $('#item_SQFT').val(field.sqft);
                        $('#sqft_number').val(0);
                $('#sqft_quantity').val(0);
                $('.clssqftmodal').trigger('change');

                        $("#item_header").html(field.name);
						$("#itembatch").val(field.itembatch);
                        $("#itemname").val(field.name);
                        $("#itemname1").val(field.name);
						$('#hsn').val(field.hsncode);
                        $("#srate_item").val(field.srate);
                        $('#cig_ces_per').val(field.cigarette_cess_percentage);
                        $('#unit_cig_ces_amt').val(field.cigarette_cess_amount);
                        $("#mrp_item").val(field.MRP);
						 $("#special_rate").val(field.special_rate);
						  $("#wh_rate").val(field.wh_rate);
                        $("#prate_item").val(field.prate);
                        $("#unitvalue").val(field.prate);
                        $("#tax_led_id").val(field.tax_purchase_id);
                        $("#itemcode").val(field.barcode);
                        $("#item_qty").focus();
                        var is_multipletax = $('#is_multipletax').val();
                        if (is_multipletax === '1') {
                            if (field.tax_purchase_id !== undefined && field.tax_purchase_id !== '' && field.tax_purchase_id !== 0) {
                                $.ajax({
                                    url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + field.tax_purchase_id,
                                    async: false,
                                    success: function (results) {
                                        var result = JSON.parse(results);
                                        field.tax_id = result.ref_id;
                                    }
                                });
                            }
                        }
                        $('#tax_item').val(field.tax_id);
                        var zeroindex = $('#zeroindex').val();
                        var curr_tax = $('#curr_tax').val();
                        if (curr_tax === "0") {
                            $('#tax_item').val(zeroindex);
                        }
                        $('#item_id').val(field.id);
                        $("#prate").html('Rate :' + field.prate);

                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/units'); ?>/" + field.id,
                            success: function (result) {
                                $('#unit_item').html(result);
                                $('#unit_item').val(field.unit_id);
                                $("#item_qty").focus().select();
                            }
                        });

                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/godown'); ?>",
                            success: function (result) {
                                $('#godown').html(result);
                            }
                        });
                        loadoldrate(field.id);

                    });
                });
    }

    function load(id) {

		$("#rowm").empty();
		$('#purchaseTable tbody').empty();
		$("#purchaseTable > tbody").html("");
        $('#is_tax').val($('#is_taxincuded').val());
        var comset_currency = $('#comset_currency').val();
        $('#com_currency').val(comset_currency);
        var is_taxincluded = 0;
        var id = $('#pid').val();
        var tot = ser_tax = 0;
        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/pur_service_items'); ?>/" + id,
				async:false,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        var amount = itemsingle.amount;
                        if (itemsingle.is_taxincluded === "0") {
                            amount = parseFloat(itemsingle.amount) + parseFloat(itemsingle.tax);
                        }
                        tot = parseFloat(tot) + parseFloat(amount);
                        ser_tax = parseFloat(ser_tax) + parseFloat(itemsingle.tax);
                        $('#sertaxtotal').val(ser_tax);
                        $('#sergtotal').val(tot);
                        addrowtoservice(itemsingle.amount, itemsingle.tax_id, itemsingle.GST, itemsingle.tax, itemsingle.name, itemsingle.ledger_id, itemsingle.is_taxincluded);
                    });
					calculateGTotal();
                }
            });
            var txtEstimate_id = $('#txtEstimate_id').val();
            $.ajax({
                url: "<?php echo site_url('ajaxcall/purchase'); ?>/" + id,
				async:false,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
						if(i<1){
                            $("#type").val(itemsingle.cash_type);
							$("#rowm").html('');
							$("#rowm").empty();
							$('#is_tax').val(itemsingle.is_taxincluded);
							$("#is_taxincuded").val(itemsingle.is_taxincluded);
							$('#due_date').val(itemsingle.pur_due_date);
                            if (itemsingle.bank_id !== "0") {
                                $('#bank_account').val(itemsingle.bank_id);
                            }
						    $("input[name=bank_pay_method][value=" + itemsingle.bank_type + "]").prop('checked', true);
							if(itemsingle.bank_type == 'Card'){
                                $('#card_number').val(itemsingle.bank_reference);
                            }
                            if(itemsingle.bank_type == 'gpay'){
                                $('#gpay_number').val(itemsingle.bank_reference);
                            }
                            $('#con_name').val(itemsingle.shipping_name);
							$('#con_addr').val(itemsingle.shipping_address);
							$('#con_contact').val(itemsingle.shipping_contact);
							$('#con_gst').val(itemsingle.shipping_gstin);
							$('#con_state').val(itemsingle.shipping_state);
							$('#po_ref_no').val(itemsingle.po_ref_no);
							$('#supplier_ref').val(itemsingle.supplier_ref);
							$('#customer_ref_no').val(itemsingle.customer_ref_no);
							$('#notes').val(itemsingle.notes);
							
						}

                        if ($("#btype option[value='" + itemsingle.bill_type + "']").length > 0) {
                            $('#btype').val(itemsingle.bill_type);
                        }
                        $('#com_currency').val(itemsingle.currency_id);
                        $('#curr_value').val(itemsingle.cur_exc_amt);
                        loadCustByid(itemsingle.supid);
                        $('#billingname').val(itemsingle.billing_name);
                        var est_qty = 0;
                        var estid = $("#p_id").val();
                        if (estid !== '0') {
                            txtEstimate_id = itemsingle.order_id;
                        }
                        if ($('#txtEstimate_id').val() !== "0" && itemsingle.quantity <= itemsingle.order_quantity) {
                            est_qty = 1;
                        }
                        if ($('#txtEstimate_id').val() !== "0" && itemsingle.quantity > itemsingle.order_quantity) {
                            var rate = itemsingle.rate;
                            var taxamount = 0;
                            var quantity = parseFloat(itemsingle.quantity) - parseFloat(itemsingle.order_quantity);
                            itemsingle.quantity = quantity;
                            var total = parseFloat(rate) * parseFloat(quantity);
                            if (itemsingle.discount !== "0.00") {
                                var discount = (parseFloat(total) * parseFloat(itemsingle.discount)) / 100;
                                var total = parseFloat(total) - parseFloat(discount);
                                itemsingle.dis_amt = discount;
                            }
                            if (itemsingle.is_taxincluded === "0") {
                                taxamount = (parseFloat(total) * parseFloat(itemsingle.tname)) / 100;
                                itemsingle.tax = taxamount;
                            }
                            if (itemsingle.is_taxincluded === "1") {
                                taxamount = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(itemsingle.tname) + 100));
                                itemsingle.tax = taxamount;
                            }
                        }
                        $('#invoice').val(itemsingle.invoice);
                        if ($('#txtEstimate_id').val() !== "0") {
                            if (itemsingle.sales_invoice !== null && itemsingle.sales_invoice !== "") {
                                $('#invoice').val(itemsingle.sales_invoice);
                            }
                        }
                        $('#date').val(formatDate(itemsingle.dates));
                        $('#rdate').val(formatDate(itemsingle.rdate));
                        $('#freight').val(itemsingle.freight);
                        $('#advance').val(itemsingle.advance);
                        $('#bill_no').val(itemsingle.bill_no);
                        $('#other').val(itemsingle.other);
						var is_cigarette_cess = $('#is_cigarette_cess').val();
                        if(is_cigarette_cess > 0 ){
                            var cig_ces_per = itemsingle.unit_cig_ces_per;
                            var unit_cig_ces_amt = itemsingle.unit_cig_ces_amt;
                            var cig_ces_per_amount = itemsingle.cig_ces_per_amount;
                            var cig_ces_amt = itemsingle.cig_ces_amt;
                        }
                        
                        // if($type=='purchase'){
                        //  $('#invoice').val(itemsingle.invoice);
                        // }
                        // if($type=='purchase_order'){
                        //  $('#btype').val(itemsingle.bill_type);
                        // }
                        $('#discount').val(itemsingle.dis);
                        $('#reference').val(itemsingle.ref_id);
                        $('.box-title').html(itemsingle.type);
                        $('#area').val(itemsingle.area);
                        $('#salesman').val(itemsingle.salesman);
                        $('#route').val(itemsingle.route);
                        $('#vehicle').val(itemsingle.vehicle);
                        $('#tax_led_id').val(itemsingle.tax_purchase_id);
                        var is_taxincluded = itemsingle.is_taxincluded;
                        var mfg = itemsingle.mdate;
                        var exp = itemsingle.edate;
                        var dis_amt = itemsingle.dis_amt;
                        var dis_item = itemsingle.discount;
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var unit_item = itemsingle.unitid;
                        var godown = itemsingle.item_godown;
                        var tax_item = itemsingle.txid;
                        var mrp_item = itemsingle.mrp;
						var wh_rate = itemsingle.wh_rate;
						var special_rate = itemsingle.special_rate;
                        var prate_item = itemsingle.rate;
                        var itemname = itemsingle.name + ' ' + itemsingle.barcode;
                        var comontax = $("#comontax").val();
                        var tax_amount = itemsingle.tax;
                        var barcode = itemsingle.barcode;
                        var tax_purchase_id = itemsingle.tax_purchase_id;
                        var rowTotal = (((parseFloat(itemsingle.rate) * parseFloat(itemsingle.quantity)) - parseFloat(itemsingle.dis_amt)) + parseFloat(tax_amount)).toFixed(company_roundoff);
                        if (is_taxincluded === "1") {
                            var rowTotal = (((parseFloat(itemsingle.rate) * parseFloat(itemsingle.quantity)) - parseFloat(itemsingle.dis_amt))).toFixed(company_roundoff);
                        }
                        itemsingle.total;
                        var commission = itemsingle.commission;
                        var unit_name = itemsingle.uname;
                        var item_discription = itemsingle.item_discription;
                        var godown_name = itemsingle.godown_name;
                        var tax_name = itemsingle.tname;
                        var analytics = itemsingle.analytics;
                        var analyticsname = itemsingle.analyticsname;
                        var damage = itemsingle.damage;
                        var item_size = itemsingle.size_id;
						var srate_item = itemsingle.srate;
                        if (damage === "" || damage === null) {
                            damage = 0;
                        }
                        tax_amount = parseFloat(tax_amount).toFixed(company_roundoff);
						var hsncode = itemsingle.hsncode;
						var  item_ces_id = itemsingle.itm_ces_id;
						var item_ces_per = itemsingle.itm_ces_per;
						var item_ces_name = itemsingle.itm_ces_name;
						var item_row_ces = itemsingle.itm_raw_ces;
						var is_IMEI = $('#is_IMEI').val();
						var free_qty = itemsingle.free_quantity ;
						if(parseFloat(is_IMEI) > 0  ){
							$.ajax({
								url: "<?php echo site_url('transaction/Purchase/purchase_emei'); ?>/" + itemsingle.pur_itm_id,
								async:false,
								success: function (result) {
									$.each(JSON.parse(result), function (i, itemsingle) {
										purchase_item_index = 0;
										var txtimei = '<tr class="clstremei clsimei'+purchase_item_index+'"><td><input  class="indeximei'+purchase_item_index+'" type="hidden" name="indeximei'+purchase_item_index+'[]" value="'+purchase_item_index+'"> <input class="txtimei'+purchase_item_index+' form-control" indeximei = "'+purchase_item_index+'" type="text"  value="'+itemsingle.imei+'" name="itemIMEI'+purchase_item_index+'[]" ></td><td><button   type="button"  data-toggle="tooltip" onclick="removeimei(this)"     class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button></td></tr>';
										$('#bodyimei').append(txtimei);
									});
								}
							});
						}
                        if(item_id === undefined || item_id === null || item_id ==="null"){
                            item_id = 0 ;
                        }
                        if (est_qty === 0 && item_id > 0 ) {
                            var indexid = itemsingle.indexid;
							var itembatch =	itemsingle.batch;
							var mrp_per =  itemsingle.mrp_per;
							var srate_per = itemsingle.srate_per; 
							var whrate_per = itemsingle.whrate_per;
							var special_rate_per =  itemsingle.special_rate_per;
                            var SQFTNO = itemsingle.SQFTNO;
                            var lcode = itemsingle.itm_lcode;
                            var ItemSQFT =itemsingle.ItemSQFT;
                            var itm_des = itemsingle.itm_desc;
                            var item_tax_on_mrp = 0 ;
                            var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();
                            if(parseFloat(purchase_tax_on_mrp) > 0  ){
                                var item_tax_on_mrp = itemsingle.purchase_tax_on_mrp;
                            }  

                            var iteadd = new item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincluded, item_discription, barcode, damage, item_size,srate_item,itembatch,item_ces_id,item_ces_per,item_ces_name,item_row_ces,hsncode,free_qty,wh_rate,special_rate,mrp_per,srate_per,whrate_per,special_rate_per,indexid,SQFTNO,ItemSQFT,lcode,cig_ces_per,unit_cig_ces_amt,cig_ces_per_amount,cig_ces_amt,itm_des,item_tax_on_mrp);
                            addrowtoTable(iteadd);
                            items.push(iteadd);
                            $("#type").val(itemsingle.cash_type);
                            $("#Costcenter").val(itemsingle.cost_center);
                            $("#rowTotal").val(0.0);
							$('#itmqty'+inc_inary).trigger('change');
                            $('.myspop').popover();
                            calculaterowtotal();
                            calculateGTotal();
                            $("#itemname").focus();
                        }
                    });
                    $('#txtEstimate_id').val(txtEstimate_id);

                }
            });
            $("#type").trigger('change');
        } else {
            $("#invoice").focus();
            $("#type").trigger('change');
        }
    }

    function set_payment_div(){
		var type = $('#type').val();
		if(type !== 'Cash' && type !== 'Credit' && type !== 'Ca_Cr'){
			$('.bankdiv').attr('style','display:block;padding:3px;');
			var value = $("input:radio[name=bank_pay_method]:checked").val()
			if(value === 'gpay'){
					$(".gpaydiv").attr("style", "display: block;padding:3px;");
					$(".carddiv").attr("style", "display: none;padding:3px;");

			}
			if(value === 'Card'){
				$(".carddiv").attr("style", "display: block;padding:3px;");
				$(".gpaydiv").attr("style", "display: none;padding:3px;");
			}
		}else{
			$('.bankdiv').attr('style','display:none;padding:3px;');
			$('.gpaydiv').attr('style','display:none;padding:3px;');
			$('.carddiv').attr('style','display:none;padding:3px;');
		}
	}


    $(document).ready(function () {

    $.ajax({
        url: "<?php echo site_url('ajaxcall/bank'); ?>",
        async:false,
        success: function(result) {
            $('#bank_account').html(result);
			
        }
    });

        $('input[type=radio][name=bank_pay_method]').change(function() {
        if(this.value === 'gpay'){
			$(".gpaydiv").attr("style", "display: block;padding:3px;");
			$(".carddiv").attr("style", "display: none;padding:3px;");

		}
		if(this.value === 'Card'){
			$(".carddiv").attr("style", "display: block;padding:3px;");
			$(".gpaydiv").attr("style", "display: none;padding:3px;");
		}
	});

        $("#type").change(function() {
             var type = $(this).val();
             if(type == 'Bank'){
                $('.bankdiv').attr('style','');
             }else{
                $('.bankdiv').attr('style','display:none;');
             }
             set_payment_div();
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
            var sqft_quantity = $('#sqft_quantity').val();

            $('#item_qty').val(sqft_quantity);

        });

        $('.itemsqft').keydown(function(event) {
            //$('#sqft_number').val(0);
            //$('#sqft_quantity').val(0);
            $('#sqft_quantity').trigger('change');

            event.preventDefault();  // Prevent typing in the field
            var itemsqft = $('#itemsqft').val();
            $('#sqftrowid').val(0);
            $('#item_SQFT').val(itemsqft);
            $('#sqft_number').focus();
        });

	$('#itemname').keydown(function(e){
				
				if(e.keyCode === 13) {
					e.preventDefault();
					$('#itemname').focus();
				}
		});
		
		$('#free_qty').keydown(function(e){
				
				if(e.keyCode === 13) {
					e.preventDefault();
					$('#godown').focus();
				}
				if(e.keyCode === 9) {
					e.preventDefault();
					$('#prate_item').focus();
				}
		});


		$('#itemcode').keydown(function(e){
				
				if(e.keyCode === 13) {
					e.preventDefault();
					$('#itemcode').focus();
				}
		});
		$('.modal').on('shown.bs.modal', function() {
				$(this).find('[autofocus]').focus();
				var purchase_item_index = $('#purchase_item_index').val();
				if(parseFloat(purchase_item_index) > 0 ){
					$('#auto_update_rates').prop('checked', false);

				}else{
					$('#auto_update_rates').prop('checked', true);
				}
                <?php if($lcode > 0 ){?>
                    $('#lcode').focus();
                <?php } ?>
		});
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/states'); ?>",
			async:false,
            success: function (result) {
                $('#con_state').html(result);
                $('#states').html(result);
                $('#stcode').val(32);
            }
        });
		 $.ajax({
            url: "<?php echo site_url('master/amaster/hsn_code'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value="">Select</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.hsnid + '"> ' + itemsingle.hsncode + '</option>';
                });
                $("#hsn").html(option);
                
            }
        });
		$('.addpitems').click(function(){
			 var dis_amt = $("#dis_amt").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var is_extra = $("#is_extra").val();
                                    var per = 0;
                                    if (dis_amt !== '' && prate !== '' && prate !== 0 && dis_amt > 0) {
                                        per = ((parseFloat(dis_amt) * 100) / (qty * prate));
                                    }
                                    if (!isNaN(per)) {
                                        $("#dis_item").val(per.toFixed(company_roundoff));
                                    } else {
                                        $("#dis_item").val(0);
                                    }
                                    var key = 9;
                                    if (key === 13 || key === 9) {
                                        calculaterowtotal();
                                        if (parseInt(is_extra) === 1) {
                                            $('#modelextra').modal();
                                        } else {
                                          //  $('#myDropdownhide').click();
                                            add();
                                            //$('#btnclsmain').click();
                                        }
                                    }
		});
		$('#addIMEI').click(function(){
			var IMEI = $("#itemIMEI").val();
			var purchase_item_index = $('#purchase_item_index').val();
			if(IMEI !== '' ){
				$("#itemIMEI").val('');
				var txtimei = '<tr class="clstremei clsimei'+purchase_item_index+'"><td><input  class="indeximei'+purchase_item_index+'" type="hidden" name="indeximei'+purchase_item_index+'[]" value="'+purchase_item_index+'"> <input class="txtimei'+purchase_item_index+' form-control" indeximei = "'+purchase_item_index+'" type="text"  value="'+IMEI+'" name="itemIMEI'+purchase_item_index+'[]" ></td><td><button   type="button"  data-toggle="tooltip" onclick="removeimei(this)"     class="btn btn-danger btnimei'+purchase_item_index+' btnimei"><span class="glyphicon glyphicon-remove-sign"></span></button></td></tr>';
				$('#bodyimei').append(txtimei);
			}
		});
		var pur_cash_type = $('#pur_cash_type').val();
		var pu_id = $('#pid').val();
		if(parseFloat(pu_id) < 1  ){
			$('#type').val(pur_cash_type);
		}
		chkid = chkid + 1;
        var btnid = '';
        $('#myModalPop').on('shown.bs.modal', function () {
            $('#name').focus();
        });
        $(".myModalPop").click(function () {
            $('#modal-body').html('');
            var opt = $(this).attr('opt');
            $("#newtype").val(opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    btnid = guid();
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    $('.box-header').remove();
                    $('.box-primary').removeClass();
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop').modal();
                    $('#is_model').val(1);
                    $('#btnsaveds').attr('id', btnid);
                    $('.popuphide').hide();
                }
            });
        });

        $("#mClick").click(function () {
            $('#' + btnid).click();
            var opt = $("#newtype").val();
            $.ajax({
                url: "<?php echo site_url('ajaxcall/getitem'); ?>/" + opt,
                async: false,
                success: function (results) {
                    var result = JSON.parse(results);
                    if (result.id > 0) {
                        if (opt === "supplier") {
                            loadCustByid(result.id);
                        }
                        if (opt === "item") {
                            itemsearchbyid(result.id);
                        }
                    }
                }
            });
        });

        $("#btnAddExtra").click(function () {
            $('#modelextra').modal();
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/size'); ?>",
            success: function (result) {
                $('#item_size').html(result);
                $('#itm_size').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#godown').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/currency'); ?>",
            success: function (result) {
                $('#com_currency').html(result);
                var comset_currency = $('#comset_currency').val();
                $('#com_currency').val(comset_currency);
                var curr_tax = $("#com_currency option:selected").attr('crr_tx');
                if (curr_tax === "yes") {
                    $('#curr_tax').val(1);
                } else {
                    $('#curr_tax').val(0);
                }

            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function (result) {
                $('#Costcenter').html(result);
            }
        });

       

        $.ajax({
            url: "<?php echo site_url('ajaxcall/analyticscenter'); ?>",
            success: function (result) {
                $('#analyticscenter').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/route'); ?>",
            success: function (result) {
                $('#route').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/vehicle'); ?>",
            success: function (result) {
                $('#vehicle').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/reference'); ?>",
            success: function (result) {
                $('#reference').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype'); ?>/<?php echo $type; ?>",
                        success: function (result) {
                            var user_default_billtype = $('#user_default_billtype').val();
                            $('#btype').html(result);
                            if (user_default_billtype !== "") {
                                $('#btype').val(user_default_billtype);
                            }
							setbillno();
                        }
                    });

                    function getbtype(btypeid)
                    {
                        $.ajax({
                            url: "<?php echo site_url('transaction/sales/getprinttype'); ?>/" + btypeid,
                            async: false,
                            success: function (results) {
                                var result = JSON.parse(results);
                                $('#printtype').val(result.id);
                            }
                        });
                    }

                    $.ajax({
                        url: "<?php echo site_url('ajaxcall/printtype'); ?>/" + $('#ttype').val(),
                        success: function (result) {
                            $('#printtype').html(result);
                        }
                    });

                    $("#ser_ledger").autocomplete({
                        source: "<?php echo site_url('ajaxcall/ledgers/purchase'); ?>",
                        minLength: 2,
                        select: function (event, ui) {
                            $('#ser_ledgerid').val(ui.item.id);
                            $('#ser_tax').val(ui.item.tax_id);
                            $('#ser_ledger').val(ui.item.name);
                            $('#ser_amt').focus();
                        }
                    });

                    $("#supname").autocomplete({
                        source: "<?php echo site_url('ajaxcall/suppliers/sup'); ?>",
                        minLength: 2,
                        select: function (event, ui) {
//                                        $('#states').val(ui.item.cst);
                            $('#supid').val(ui.item.id);
                            $('#phone').val(ui.item.phone);
                            $('#stcode').val(ui.item.code);
                            $('#billingname').val(ui.item.name);
                            $('#email').val(ui.item.email);
                            $('#gst').val(ui.item.Tin);
                            $('#tin').val(ui.item.tin);
                            $('#address').val(ui.item.address_line1);
                            $('#address_line2').val(ui.item.address_line2);
                            $('#details').val(ui.item.details);
                            $('#itemname').focus();
                            $('#itemcode').focus();

                            $('#vehicle').val(ui.item.cid);
                            $.ajax({
                                url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                                success: function (results) {
                                    $("#balance").html("Closing Balance: " + results);
                                }
                            });
                        }
                    });

                    //Tax
                    $.ajax({
                        url: "<?php echo site_url('ajaxcall/tax'); ?>",
                        success: function (result) {
                            $('#tax_item').html(result);
                            $('#tax_common').html(result);
                            $('#ser_tax').html(result);
                        }
                    });

                    $('.ItemMatchBarcode').autocomplete({
                        source: "<?php echo site_url('ajaxcall/itemssearch_purchase/Txtbarcode'); ?>",
                        minLength: 2,
                        select: function (event, ui) {
                           var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
                            var item_tax_on_mrp = 0 ;
                            if(purchase_tax_on_mrp > 0 ){
                                item_tax_on_mrp = ui.item.tax_on_mrp;
                            }
                            $('#item_tax_on_mrp').val(item_tax_on_mrp);
							$('#hsn').val(ui.item.hsncode);
                            clear();
                            var list = "";
                            $('#myDropdown').html(list);
							$('#purchase_item_index').val(0);
							$('#IMEITBL tr').removeClass("clsimei0");
							$('.clstremei').attr('style','display:none');
							deleteimei(0);
                            $("#modal-alter").modal();
                            $('#mfg').val('');
		                    $('#exp').val('');
                            $('#item_SQFT').val(ui.item.sqft);
                            $('#sqft_number').val(0);
                $('#sqft_quantity').val(0);
                $('.clssqftmodal').trigger('change');

                            $('.itemname').attr('data-placement', 'right');
                            $('.itemname').popover('toggle');
                            $("[wf-popover]").popover({
                                html: true,
                                content: function () {
                                    var content = $(this).attr("wf-content");
//                        alert( $("#discription").text());
                                    return content;
                                },
                                title: function () {
                                    var title = $(this).attr("wf-title");
                                    //return $(title).children(".popover-heading").html();
                                    return title;
                                },
                                placement: function () {
                                    var my = this.$element.attr('wf-popover');
                                    return my;
                                }
                                //                    trigger: 'keydown'
                            });
							var additional_cess = $('#additional_cess').val();
							var ces_id = 0;
							var ces_percent  = 0;
							var ces_name = '';
							if(parseFloat(additional_cess) > 0 ){
								ces_id = ui.item.ces_id;
								ces_percent = ui.item.ces_percent;
								ces_name = ui.item.ces_name;
							}
							$('#item_ces_per').val(ces_percent);
							$('#item_ces_id').val(ces_id);
							$('#item_ces_name').val(ces_name);
                            $("#item_header").html(ui.item.name);
                            $("#itemname_pop").val(ui.item.name);
                            $("#itemname1").val(ui.item.name);
							$("#itembatch").val(ui.item.itembatch);
                            $('.myspop').popover();
                            $("#srate_item").val(ui.item.srate);
                            $("#mrp_item").val(ui.item.MRP);
							$("#wh_rate").val(ui.item.wh_rate);
							$("#special_rate").val(ui.item.special_rate);
                            $("#itemcode").val(ui.item.barcode);
                            $("#prate_item").val(ui.item.prate);
                            $("#unitvalue").val(ui.item.prate);
                            $("#tax_led_id").val(ui.item.tax_purchase_id);
                            var is_multipletax = $('#is_multipletax').val();
                            if (is_multipletax === '1') {
                                if (ui.item.tax_purchase_id !== undefined && ui.item.tax_purchase_id !== '' && ui.item.tax_purchase_id !== 0) {
                                    $.ajax({
                                        url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + ui.item.tax_purchase_id,
                                        async: false,
                                        success: function (results) {
                                            var result = JSON.parse(results);
                                            ui.item.tax_id = result.ref_id;
                                        }
                                    });
                                }
                            }
                            $('#tax_item').val(ui.item.tax_id);
                            var zeroindex = $('#zeroindex').val();
                            var curr_tax = $('#curr_tax').val();
                            if (curr_tax === "0") {
                                $('#tax_item').val(zeroindex);
                            }
                            $('#item_id').val(ui.item.id);

                            var Is_SQFT = $('#Is_SQFT').val();
                            if(Is_SQFT > 0 ){
                                $.ajax({
                                    url: "<?php echo site_url('ajaxcall/getitemsqft'); ?>",
                                    type: 'post',
                                    async: false,
                                    data: {
                                        item_id: ui.item.id,
                                    },
                                    success: function(result) {
                                        $('#itemsqft').val(result);      
                                    }
                                });
                            }

        
//                                        $("#current_stock").html('Current Stock :' + ui.item.currentstk);
                            $("#prate").html('Rate :' + ui.item.prate);
                            $.ajax({
                                url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.id,
                                success: function (result) {
                                    $('#unit_item').html(result);
                                    $('#unit_item').val(ui.item.unit_id);
                                    $("#item_qty").focus();
                                }
                            });
                            $.ajax({
                                url: "<?php echo site_url('ajaxcall/godown'); ?>",
                                success: function (result) {
                                    $('#godown').html(result);
                                    var user_default_godown = $('#user_default_godown').val();
                                    if (user_default_godown !== "") {
                                        $('#godown').val(user_default_godown);
                                    }
                                    var billgodown = $("#btype option:selected").attr('godown');
                                    if (billgodown !== '0') {
                                        $('#godown').val(billgodown);
                                    }
                                }
                            });
                            loadoldrate(ui.item.id);

                        }
                    });
                    //item select for purchase 
                    $("#itemname").autocomplete({
                        source: "<?php echo site_url('ajaxcall/itemssearch_purchase/name'); ?>",
                        minLength: 2,
                        select: function (event, ui) {
                            var purchase_tax_on_mrp = $('#purchase_tax_on_mrp').val();  
                            var item_tax_on_mrp = 0 ;
                            if(purchase_tax_on_mrp > 0 ){
                                item_tax_on_mrp = ui.item.tax_on_mrp;
                            }
                            $('#item_tax_on_mrp').val(item_tax_on_mrp);
							$('#hsn').val(ui.item.hsncode);
                            clear();
                            var list = "";
                            $("#itemname").val(ui.item.name);
                            
                            $('#myDropdown').html(list);
							$('#purchase_item_index').val(0);
							$('#IMEITBL tr').removeClass("clsimei0");
							$('.clstremei').attr('style','display:none');
							deleteimei(0);
                            $("#modal-alter").modal();
                            $('#mfg').val('');
		                    $('#exp').val('');
                            $('#item_SQFT').val(ui.item.sqft);
                            $('#sqft_number').val(0);
                $('#sqft_quantity').val(0);
                $('.clssqftmodal').trigger('change');

                            $('.itemname').attr('data-placement', 'right');
                            $('.itemname').popover('toggle');
                            $("[wf-popover]").popover({
                                html: true,
                                content: function () {
                                    var content = $(this).attr("wf-content");
                                    return content;
                                },
                                title: function () {
                                    var title = $(this).attr("wf-title");
                                    return title;
                                },
                                placement: function () {
                                    var my = this.$element.attr('wf-popover');
                                    return my;
                                }
                            });
							var additional_cess = $('#additional_cess').val();
							var ces_id = 0;
							var ces_percent  = 0;
							var ces_name = '';
							if(parseFloat(additional_cess) > 0 ){
								ces_id = ui.item.ces_id;
								ces_percent = ui.item.ces_percent;
								ces_name = ui.item.ces_name;
							}
							$('#item_ces_per').val(ces_percent);
							$('#item_ces_id').val(ces_id);
							$('#item_ces_name').val(ces_name);
                            $("#item_header").html(ui.item.name);
							$("#itembatch").val(ui.item.itembatch);
                            $("#itemname_pop").val(ui.item.name);
                             $('#cig_ces_per').val(ui.item.cigarette_cess_percentage);
                             $('#unit_cig_ces_amt').val(ui.item.cigarette_cess_amount);

                            $("#itemname1").val(ui.item.name);
                            $('.myspop').popover();
							$('#srate_item').val(ui.item.srate);
                            $("#mrp_item").val(ui.item.MRP);
							$("#wh_rate").val(ui.item.wh_rate);
							$("#special_rate").val(ui.item.special_rate);
                            $("#itemcode").val(ui.item.barcode);
                            $("#prate_item").val(ui.item.prate);
							var fixed_prate = $('#fixed_prate').val();
							if(parseFloat(fixed_prate) > 0  ){
								var otherfee = ui.item.otherfee;
								if(otherfee === '' || otherfee === undefined || otherfee === null || otherfee === 'null' ){
									otherfee = 0 ;
								}
								if(parseFloat(otherfee) > 0 ){
									$("#prate_item").val(otherfee);
								}
							}
                            $("#unitvalue").val(ui.item.prate);
                            $("#tax_led_id").val(ui.item.tax_purchase_id);
                            var is_multipletax = $('#is_multipletax').val();
                            if (is_multipletax === '1') {
                                if (ui.item.tax_purchase_id !== undefined && ui.item.tax_purchase_id !== '' && ui.item.tax_purchase_id !== 0) {
                                    $.ajax({
                                        url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + ui.item.tax_purchase_id,
                                        async: false,
                                        success: function (results) {
                                            var result = JSON.parse(results);
                                            ui.item.tax_id = result.ref_id;
                                        }
                                    });
                                }
                            }
                            $('#tax_item').val(ui.item.tax_id);
                            var zeroindex = $('#zeroindex').val();
                            var curr_tax = $('#curr_tax').val();
                            if (curr_tax === "0") {
                                $('#tax_item').val(zeroindex);
                            }
                            $('#item_id').val(ui.item.id);
                            var Is_SQFT = $('#Is_SQFT').val();
                            if(Is_SQFT > 0 ){
                                $.ajax({
                                    url: "<?php echo site_url('ajaxcall/getitemsqft'); ?>",
                                    type: 'post',
                                    async: false,
                                    data: {
                                        item_id: ui.item.id,
                                    },
                                    success: function(result) {
                                        $('#itemsqft').val(result);      
                                    }
                                });
                            }
//                                        $("#current_stock").html('Current Stock :' + ui.item.currentstk);
                            $("#prate").html('Rate :' + ui.item.prate);
                            $.ajax({
                                url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.id,
                                success: function (result) {
                                    $('#unit_item').html(result);
                                    $('#unit_item').val(ui.item.unit_id);
                                    $("#item_qty").focus();
                                }
                            });

                            $.ajax({
                                url: "<?php echo site_url('ajaxcall/godown'); ?>",
                                success: function (result) {
                                    $('#godown').html(result);
                                    var user_default_godown = $('#user_default_godown').val();
                                    if (user_default_godown !== "") {
                                        $('#godown').val(user_default_godown);
                                    }
                                    var billgodown = $("#btype option:selected").attr('godown');
                                    if (billgodown !== '0') {
                                        $('#godown').val(billgodown);
                                    }
                                }
                            });
                            loadoldrate(ui.item.id);

                        }
                    });

                    $('#modelextra').on('shown.bs.modal', function () {
                        $('#txtExtra').focus();
                        
                    });


                    $('#modal-alter').on('shown.bs.modal', function () {
                        $('#itemname').val('');
                        
                    });

                    $(document).on('hidden.bs.modal', '#modal-alter', function () {
                        var itemname1 = $('#itemname1').val();
                        var item_id = $('#item_id').val();
                        if(item_id === undefined || item_id === ""){
                            item_id = 0 ;
                        }
                        if(item_id > 0 ){
                            $('#itemname').val(itemname1);
                        }
                    });

                    $('.tatalcal').change(function () {
                        calculateGTotal();
                    });

//                                $("#states").change(function () {
//                                    var code = $(this).find(':selected').attr('code');
//                                    $('#stcode').val(code);
//                                });

                    $("#is_tax").change(function () {
                        var is_tax = $("#is_tax").val();
                        $("#is_taxincuded").val(is_tax);
                        is_taxincuded = is_tax;
                    });

                    $('#btype').change(function () {
                        var user_default_godown = $('#user_default_godown').val();
                        if (user_default_godown !== "") {
                            $('#godown').val(user_default_godown);
                        }
                        var billgodown = $("#btype option:selected").attr('godown');
                        if (billgodown !== '0') {
                            $('#godown').val(billgodown);
                        }
                        var btypeid = $('#btype').val();
                        getbtype(btypeid);
						setbillno();
                    });

                    $('#com_currency').change(function () {
                        var com_currency = $('#com_currency').val();
                        var comset_currency = $('#comset_currency').val();
                        var value = $("#com_currency option:selected").attr('crr_value');
                        $('#curr_value').val(value);
                        var gtotal = $('#gtotal').val();
                        var curr_value = $('#curr_value').val();
                        var curr_tax = $("#com_currency option:selected").attr('crr_tx');
                        if (curr_tax === "yes") {
                            $('#curr_tax').val(1);
                        } else {
                            $('#curr_tax').val(0);
                        }
                        if (comset_currency === com_currency) {
                            gtotal = parseFloat(1 * gtotal);
                            $("#cur_gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(company_roundoff));
                            $('#curr_value').val(1);
//                                        $("#cur_div").attr("style", "display: none;");

                        } else {
                            if (gtotal === "") {

                            } else {
                                curr_value = parseFloat(curr_value * gtotal);
                                $("#cur_gtotal").val(parseFloat(curr_value.toFixed(0)).toFixed(company_roundoff));
                            }
                        }
                    });

                    $("#txtEstimate").autocomplete({
                        source: "<?php echo site_url('ajaxcall/pestimates'); ?>/<?php echo $type; ?>",
                                    minLength: 2,
                                    select: function (event, ui) {
                                        clear();
                                        $('#txtEstimate_id').val(ui.item.pid);
                                        $('#estid').val(ui.item.pid);
                                        $('#pid').val(ui.item.pid);
                                        $('#freight').val(ui.item.freight);
                                        $('#other').val(ui.item.other);
                                        load();
                                    }
                                });

                                $('#curr_value').change(function () {
                                    var com_currency = $('#com_currency').val();
                                    var comset_currency = $('#comset_currency').val();
                                    var gtotal = $('#gtotal').val();
                                    var curr_value = $('#curr_value').val();
                                    if (comset_currency === com_currency) {
                                        $('#curr_value').val(1);
                                        $("#cur_gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(company_roundoff));
//                                        $("#cur_div").attr("style", "display: none;");

                                    } else {
                                        if (gtotal === "") {

                                        } else {
                                            curr_value = parseFloat(curr_value * gtotal);
                                            $("#cur_gtotal").val(parseFloat(curr_value.toFixed(0)).toFixed(company_roundoff));
                                        }
                                    }
                                });


                                $('.price').change(function () {
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    $("#rowTotal").val(rowtotal(qty, prate));
									$('#item_lc').html(prate);
                                });
								
								$('#tax_item').change(function () {
                                    calculaterowtotal();

                                });

                                $('#addmore').click(function () {
                                    var row = $("#add").html();
                                    var newRow = "<tr>" + row + "</tr>";
                                    $("#rowm").append(newRow);
                                    $(".remove").removeClass("hidden");
                                    $(".remove").first().addClass("hidden");
                                });

                                $("#ser_amt").keydown(function (e) {
                                    var amount = $("#ser_amt").val();
                                    if (amount > 0) {
                                        var key = e.charCode || e.keyCode || 0;
                                        if (key === 13 || key === 9) {
                                            addservices();
                                        }
                                    }
                                });
								
								$("#special_rate").keydown(function (e) {
										calculaterowtotal();
                                        var key = e.charCode || e.keyCode || 0;
                                        if (key === 13 || key === 9) {

                                            var is_extra = $("#is_extra").val();
                                            if (parseInt(is_extra) === 1) {
                                                $('#modelextra').modal();
                                            } else {
                                            // $('#myDropdownhide').click();
                                                add();
                                            // $('#btnclsmain').click();
                                            }
                                        }
                                });

                                $("#ser_amt").keydown(function (e) {
                                    var amount = $("#ser_amt").val();
                                    if (amount > 0) {
                                        var key = e.charCode || e.keyCode || 0;
                                        if (key === 13 || key === 9) {
                                            addservices();
                                        }
                                    }
                                });

                                $("#supname").keydown(function (e) {
                                    var id = $("#supid").val();
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        e.preventDefault();
                                        $('#billingname').focus();
                                        if (id == "") {
                                           // $("#supname").val("");
                                        }
                                    }

                                    if (key === 27)
                                    {
                                        if (id == "") {
                                            //$("#supname").val("");
                                        }
                                    }
                                });
							      $("#dis_amt").change(function (e) {
										var dis_amt = $("#dis_amt").val();
										var prate = $("#prate_item").val();
										var qty = $("#item_qty").val();
										var is_extra = $("#is_extra").val();
										var per = 0;
										if (dis_amt !== '' && prate !== '' && prate !== 0 && dis_amt > 0) {
											per = ((parseFloat(dis_amt) * 100) / (qty * prate));
										}	
										if (!isNaN(per)) {
											$("#dis_item").val(per.toFixed(company_roundoff));
											calculaterowtotal();
										} else {
											$("#dis_item").val(0);
											calculaterowtotal();
										}
										});
                                $("#dis_amt").keydown(function (e) {
                                    var dis_amt = $("#dis_amt").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var is_extra = $("#is_extra").val();
                                    var per = 0;
                                    if (dis_amt !== '' && prate !== '' && prate !== 0 && dis_amt > 0) {
                                        per = ((parseFloat(dis_amt) * 100) / (qty * prate));
                                    }
                                    if (!isNaN(per)) {
                                        $("#dis_item").val(per.toFixed(company_roundoff));
                                    } else {
                                        $("#dis_item").val(0);
                                    }
										calculaterowtotal();
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {

										$("#srate_item").focus().select();
                                       
                                    }
                                });

                                $("#mrp_item").keydown(function (e) {
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        $("#wh_rate").focus().select();
                                    }
                                });

                                $('#item_damage_qty').keydown(function (e) {
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        e.preventDefault();
                                        $("#mrp_item").focus().select();
                                    }
                                });

                                $("#item_qty").keydown(function (e) {
                                    var transaction_type = $('#transaction_type').val();
                                    var dis = $("#dis_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var per = 0;
                                    if (dis !== '') {
                                        per = ((parseFloat(qty) * parseFloat(prate) * dis) / 100);
                                    }
                                    if (!isNaN(per)) {
                                        $("#dis_amt").val(per.toFixed(company_roundoff));
                                    } else {
                                        $("#dis_amt").val(0);
                                    }
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                                            $("#item_qty").val(1);
                                        }
										var item_qty =   $("#item_qty").val();
										item_qty = parseFloat(item_qty);
										item_qty = item_qty * 1000;
										item_qty = parseInt(item_qty);
										item_qty = item_qty / 1000;
										 $("#item_qty").val(parseFloat(item_qty).toFixed(3));
                                        e.preventDefault();
                                        e.stopPropagation();
                                        if (transaction_type === 'purchase1') {
                                            $("#item_damage_qty").focus().select();
                                        } else {
                                            $("#prate_item").focus().select();
											var freequantity = $('#freequantity').val();
											if(parseFloat(freequantity) >  0  ){
												$('#free_qty').focus().select();
											}
                                        }
                                    }
                                    calculaterowtotal();
                                });

                                $("#discount").change(function () {
                                    //var total = $('#total').val();
                                    //var discount = $('#discount').val();
                                    //var dis_per = ((parseFloat(discount) * 100) / parseFloat(total)).toFixed(company_roundoff);
                                    //var id = 1;
                                    //$(".disper").each(function () {
                                       // $(this).val(dis_per);
                                        //var ids = $(this).attr('id');
                                        //calculaterowdis(ids.split("itmdis")[1]);
                                        //id = id + 1;
                                    //});
                                    calculateGTotal();
                                });
								
								 $("#dis_item").change(function (e) {
									var dis = $("#dis_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var per = 0;
                                    var key = e.charCode || e.keyCode || 0;
									if (dis !== '') {
                                            per = ((parseFloat(qty) * parseFloat(prate) * dis) / 100);
                                        }
                                        if (!isNaN(per)) {
                                            $("#dis_amt").val(per.toFixed(company_roundoff));
                                        } else {
                                            $("#dis_amt").val(0);
                                        }
                                        $("#dis_amt").focus().select();
									calculaterowtotal();
								  });
                                $("#dis_item").keydown(function (e) {
                                    var dis = $("#dis_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var per = 0;
                                    var key = e.charCode || e.keyCode || 0;
									calculaterowtotal();
                                    if (key === 13 || key === 9) {
										calculaterowtotal();
									 $("#dis_amt").focus();
                                        if (dis !== '') {
                                            per = ((parseFloat(qty) * parseFloat(prate) * dis) / 100);
                                        }
                                        if (!isNaN(per)) {
                                            $("#dis_amt").val(per.toFixed(company_roundoff));
                                        } else {
                                            $("#dis_amt").val(0);
                                        }
                                        $("#dis_amt").focus().select();
                                        
                                    }
                                });

                                $("#unit_item").change(function () {
                                    var myTag = $(this).find(':selected').attr('count');
                                    var mrp = $("#unitvalue").val();
                                    myTag = myTag * mrp;
                                    $('#prate_item').val(myTag);
                                    calculaterowtotal();
                                });

                                $("#btnAddExtram").click(function () {
                                    add();
                                    $('#btncls').click();
                                    //$('#btnclsmain').click();
                                });

                                $('#txtExtra').keydown(function (e) {
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 9)
                                    {
                                        add();
                                        $('#btncls').click();
                                        //$('#btnclsmain').click();
                                    }
                                });

                                $('#modelextra').on('shown.bs.modal', function () {
                                    $('#txtExtra').focus();
                                });
                                $("#prate_item").change(function () {
                                    calculaterowtotal();
                                });
                                $("#prate_item").keydown(function (e) {
                                    var prates = $("#prate_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var dis_item = $("#dis_item").val();
                                    var dis_item = $("#dis_item").val();
                                    if (prates === "") {
                                        $("#prate_item").val(0);
                                        prates = 0;
                                    }
                                    var tax_name = $("#tax_item option:selected").attr('percent');
                                    var prate = parseFloat(prate) * parseFloat(qty);
                                    if (dis_amt === '') {
                                        dis_amt = 0;
                                    }
                                    var rowTax = parseFloat(prate - dis_amt) * parseFloat(tax_name) / 100;
                                    var tot = parseFloat(prate - dis_amt) + parseFloat(rowTax);
                                    calculaterowtotal();
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        $("#prate_item").val(parseFloat(prates).toFixed(company_roundoff));
                                        $("#dis_item").focus().select();
                                    }
                                    if (key === 27)
                                    {
                                        $("#prate_item").val(parseFloat(prates).toFixed(company_roundoff));
                                        // add();
                                        $("#dis_item").focus().select();
                                    }
                                });

                                $('.myspop').popover();
                                var comset_currency = $('#comset_currency').val();
                                $('#com_currency').val(comset_currency);
                                var estid = $('#estid').val();
                                if (estid > 0) {
                                    $('#pid').val(estid);
                                }
								if(chkid <2){
									load();
								}
                            });

                            function remove(btn) {
                                var id = $(btn).attr('index');
                                var index = getIndexOf(items, id);
                                items.splice(index, 1);
                                calculateGTotal();
                                $('.tooltip').remove();
                                $(btn).closest('tr').remove();
                            }

                            function EnterToTab() {
								
                                if (event.keyCode == 13)
                                    event.keyCode = 9;
                            }

                            function getIndexOf(a, v) {
                                var l = a.length;
                                for (var k = 0; k < l; k++) {
                                    if (a[k].inc_id.toString() === v.toString()) {
                                        return k;
                                    }
                                }
                                return false;
                            }

</script>