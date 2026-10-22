<?php
$com_tax_type = $settings[0]['com_tax_type'];
$UnitPriceMargin = 0 ;
if(isset($settings[0]['UnitPriceMargin'])){
    $UnitPriceMargin = $settings[0]['UnitPriceMargin'] ;
}

$is_export_invoice = 0 ;
if(isset($settings[0]['is_export_invoice'])){
    $is_export_invoice = $settings[0]['is_export_invoice'] ;
}
?>
<form method="post"  id="frmcreatemodelc" back="<?php echo site_url('customers/create'); ?>" action="<?php echo site_url('customers/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $is_export_invoice ?>" name="is_export_invoice" id="is_export_invoice" />
    <input type="hidden" value="<?= $UnitPriceMargin ?>" name="UnitPriceMargin" id="UnitPriceMargin" />
    <input type="hidden" value="<?= $type ?>" name="type" id="type" />  
    <input type="hidden" value="<?= $com_tax_type ?>" name="tax_type" id="tax_type" /> 
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Customer Create', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('customers/listall/' . $type); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('customers/listall/' . $type); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Name', $this, $user) ?>*<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                                </div> 
                            </div>
                            <?php if ($this->multiple != 0) { ?>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('name_lan', $this, $user) ?>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="name_lan" class="form-control" name="name_lan" type="text" value=""   maxlength="50">              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">

                                </div>
                            <?php } ?>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Phone', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="phone" data-validation="number" data-validation-optional="true" class="form-control" name="phone" type="text" value="" maxlength="50">
                                </div>  
                            </div> 
                        </div>
                        <div class="col-sm-12 ">
							<div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Contact Person', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="contact_person"  class="form-control" name="contact_person" type="text" maxlength="500">
                                </div>  
                            </div> 
							 <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Contact Number', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="contact_number" data-validation="number" data-validation-optional="true" class="form-control" name="contact_number" type="text" value="" maxlength="50">
                                </div>  
                            </div> 
						</div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Tax', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="gstin" class="form-control" name="gstin" type="text" value="" maxlength="16">   
									<span id="exist" style="color:#a94442">GSTIN Not Valid</span>
                                </div> 
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Pan', $this, $user) ?>   :
                                </label>
                                <div class="col-sm-8">
                                    <input id="pan" class="form-control" name="pan" type="text" value="" maxlength="20">   
                                </div> 
                            </div>
                            


                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Aadhaar', $this, $user) ?>   :
                                </label>
                                <div class="col-sm-8">
                                    <input id="aadhar" class="form-control" name="aadhar" type="text" value="" maxlength="20">   
                                </div> 
                            </div>
                            


                            
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('State', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <select name="states_cus" id="states_cus" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                        <span class="input-group-btn pophide">
                                            <button type="button" opt="states_cus" url="<?php echo site_url('masters/states/add'); ?>" class="btn btn-primary myModalPop_cus">
                                                New
                                            </button>
                                        </span>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('State Code', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="stcode" class="form-control" name="stcode" type="text" value="32" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Email', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="email" class="form-control"  data-validation="email" data-validation-optional="true" name="email" type="text" value="" maxlength="50"></div> 
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address line1', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <textarea id="address_line1" class="form-control" NoTab="NoTab" name="address_line1" type="text"></textarea>           
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address line2', $this, $user) ?>  <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                      <textarea t id="address_line2" class="form-control" NoTab="NoTab" name="address_line2" type="text"></textarea>  
                                </div> 
                            </div> 
                        </div> 
                        <?php if ($this->multiple != 0) { ?>
                            <div class="col-sm-12 ">
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Address line1 lan', $this, $user) ?><span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                         <textarea  id="address_line1_lan" class="form-control" NoTab="NoTab" name="address_line1_lan" type="text"></textarea>                
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Address line2 lan', $this, $user) ?>  <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea  id="address_line2_lan" class="form-control" NoTab="NoTab" name="address_line2_lan" type="text"></textarea>  
                                    </div> 
                                </div> 
                            </div>
                        <?php } ?>
						<div class="col-sm-12 "> 
							<div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('PinCode', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="pincode" class="form-control price" name="pincode" type="text" value="0" maxlength="50">  
                                </div> 
                            </div>
							<div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Remarks', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="remarks" class="form-control" name="remarks" type="text" value="" maxlength="50">
                                </div>
                            </div>
						</div>
                        <div class="col-sm-12 "> 
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Opening Balance', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="opening_bal" class="form-control two-digits price" name="opening_bal" type="text" value="0" maxlength="50">  
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Type', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="credit_type" id="credit_type" class="form-control">
                                        <option value="Dr">Dr</option>
                                        <option value="Cr">Cr</option>
                                    </select>
                                </div>
                            </div>
                        </div>
						 <div class="col-sm-12 "> 
							<div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Customer Type', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="customer_type" id="customer_type" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('District', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="district" id="district" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
							<!-- <div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Branch', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="branch" id="branch" class="form-control">
                                        
                                    </select>
                                </div>
                            </div> -->
							<div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Listed In Supplier', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="listed_in_supplier" id="listed_in_supplier" class="form-control">
                                        <option value = "0"> No </option> 
                                        <option value = "1"> Yes </option> 
                                    </select>
                                </div>
                            </div>
						 </div>
						<div class="col-sm-12 "> 
							<div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Sales Man', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="cus_salesman" id="cus_salesman" class="form-control">
                                       
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Agent', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="cus_agent" id="cus_agent" class="form-control">
                                       
                                    </select>
                                </div>
                            </div>

                            <?php if($is_export_invoice > 0 ){?>
                                <div class="col-sm-6 form-group">   
                                    <label class="col-sm-4 control-label">
                                        <?= label('Currency', $this, $user) ?><span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="currency_id" id="currency_id" class="form-control">
                                       
                                        </select>
                                    </div>
                                </div>
                            <?php }?>
							<div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Customer Rate', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="cus_rate" id="cus_rate" class="form-control">
                                       <option value="">Select</option>
                                       <option value="srate">Srate</option>
                                       <option value="MRP">MRP</option>
                                       <option value="wh_rate">Wholesale Rate</option>
                                       <option value="special_rate">Special Rate</option>
									    <option value ="last_srate" >Last Sales Rate</option>
                                    </select>
                                </div>
                            </div>
						</div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Bank', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="bankname" class="form-control" name="bankname" type="text" value="" maxlength="50">  
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Account No', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="accno" class="form-control number" name="accno" type="text" value="" maxlength="20">             
                                </div> 
                            </div>
                        </div>

                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('IFSC Code', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="ifscc" class="form-control" name="ifscc" type="text" value="" maxlength="11">  
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Area', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <select id="area_cus" name="area_cus" class="form-control">
                                            <option>select</option>
                                        </select> 
                                        <span class="input-group-btn pophide">
                                            <button type="button" opt="area_cus"  url="<?php echo site_url('master/NewMasters/area/add'); ?>" class="btn btn-primary myModalPop_cus">
                                                New
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Route', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <select id="route_cus" name="route_cus" class="form-control">
                                            <option>select</option>
                                        </select> 
                                        <span class="input-group-btn pophide">
                                            <button type="button" opt="route_cuss"  url="<?php echo site_url('master/NewMasters/route/add'); ?>" class="btn btn-primary myModalPop_cus">
                                                New
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Price List', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8"> 
                                    <select id="price_list" name="price_list" class="form-control">
                                        <option>select</option>
                                    </select>  
                                </div>
                            </div>
                        </div>
                        <?php if($UnitPriceMargin > 0 ){?>
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('U/M', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="PriceMargin" class="form-control" name="PriceMargin" type="number" value="0" max="99">
                                </div>
                            </div>
                        <?php }?>

                        <div  <?php if(strtolower($this->session->userdata('login_base_comid')) != 'msa' ){?> style="display:none" <?php }?> class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Row Discount', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="row_dis_per" class="form-control" name="row_dis_per" type="number" value="0" max="90">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Bill Discount', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="bill_dis_per" class="form-control" name="bill_dis_per" type="number" value="0" max="90">
                                </div>
                            </div>
                        </div>


                         <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Credit Period', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="credit" class="form-control" name="credit" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('On Exceed', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="cr_period_exceed" name="cr_period_exceed" class="form-control">
										<option value="0">Warning</option>
										<option value="1">Ban</option>
									</select>
                                </div>
                            </div>
                        </div>
						<div class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Credit Amount', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="credit_amount" class="form-control two-digits" name="credit_amount" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('On Exceed', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="cr_amount_exceed" name="cr_amount_exceed" class="form-control">
										<option value="0">Warning</option>
										<option value="1">Ban</option>
									</select>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('No.of Credit Days', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="inv_cr_days" class="form-control" name="inv_cr_days" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('On Exceed', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="inv_cr_days_action" name="inv_cr_days_action" class="form-control">
										<option value="0">Warning</option>
										<option value="1">Ban</option>
									</select>
                                </div>
                            </div>
                        </div>
						
						
						<div class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Invoiice Credit amt Limit', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="single_inv_cr_limit" class="form-control" name="single_inv_cr_limit" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('On Exceed', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="single_inv_cr_limit_action" name="single_inv_cr_limit_action" class="form-control">
										<option value="0">Warning</option>
										<option value="1">Ban</option>
									</select>
                                </div>
                            </div>
                        </div>
						
						
						<div class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('No.od Credit Bills', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="credit_bills_count" class="form-control" name="credit_bills_count" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('On Exceed', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="credit_bills_count_action" name="credit_bills_count_action" class="form-control">
										<option value="0">Warning</option>
										<option value="1">Ban</option>
									</select>
                                </div>
                            </div>
                        </div>



						<div class="col-sm-12 ">
							<div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Remarks', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="remarks" class="form-control" name="remarks" type="text" value="" maxlength="50">
                                </div>
                            </div>

                             <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Is Active', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="is_active" class="form-control" name="is_active" >
                                        <option value ="1">Active</option> 
                                         <option value ="0">Inactive</option> 
                                    </select>
                                </div>
                            </div>
							
						</div>
                    </div>
                    <div class="box-footer popuphide">
                        <?php if ($view != 'view') { ?>
                            <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                        <?php } ?>
                    </div>
                    <!-- /.col -->
                </div>     
            </div>
            <!-- /.row -->
    </section>
</form>
<div class="modal fade bd-example-modal-lg" id="myModalPop_cus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-body" id="modal-body"> 
            </div> 
            <div class="modal-footer">
                <button type="button" id="mcb" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="m_itemClick" popup_type="item" class="btn btn-primary">Save changes</button>
            </div>
        </div> 
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

    	$.ajax({
			url: "<?php echo site_url('ajaxcall/currency'); ?>",
			async:false,
			success: function(result) {
				$('#currency_id').html('<option value ="">Select</option>'+result);
			}
		});

		$.ajax({
			url: "<?php echo site_url('ajaxcall/salesman'); ?>",
			async:false,
			success: function(result) {
				$('#cus_salesman').html('<option value ="">Select</option>'+result);
			}
		});
		$.ajax({
				url: "<?php echo site_url('ajaxcall/branch'); ?>",
				success: function(result) {
					$('#branch').html(result);
				}
			});
			$.ajax({
				url: "<?php echo site_url('ajaxcall/customer_type'); ?>",
				success: function(result) {
					$('#customer_type').html(result);
				}
			});
		 $.ajax({
				url: "<?php echo site_url('ajaxcall/district'); ?>",
				success: function(result) {
					$('#district').html(result);
				}
			});
			 $.ajax({
				url: "<?php echo site_url('ajaxcall/reference'); ?>",
				success: function(result) {
				$('#cus_agent').html(result);
            
			}
			});
			 $('#exist').hide();
	$('#gstin').change(function() { 
		var gstin = $(this).val();
        $.ajax({
            url: "<?php echo site_url('Customers/check_gst') ?>",
            type: "POST",
            data: {
                "gstin": gstin
            },
            success: function(result) {
				var results = JSON.parse(result);
				if(results.valid ===true){
					$('#exist').hide();
				}else{
					$('#exist').show();
				}
                
            }
        });

    });
        $("#m_itemClick").bind("click", function () {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
        });
        load();
        states_cus(0);
        area_cuss(0);
        price_list(0);
        route_cuss(0);
        $('#name').focus();
        $('#btnsave').click(function () {
            var ms = $("#frmcreate").isValid();
            if (ms !== true) {
                return;
            }
        });
        $('#myModalPop_cus').on('shown.bs.modal', function () {
            $('#name').focus();
        });
        $('#myModalPop_cus').on('hidden.bs.modal', function () {
            var opt = $("#m_itemClick").attr('opt');
            if (opt === 'states_cus') {
                states_cus(1);
            }
            if (opt === 'area_cus') {
                area_cuss(1);
            }
            if (opt === 'pricelst') {
                price_list(1);
            }
            if (opt === 'route_cuss') {
                route_cuss(1);
            }
            $('#is_model').val(0);
        });
        $(".myModalPop_cus").click(function () {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    // $('.box-header').remove();
                    $('.box-p').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop_cus').modal();
                    $('#is_model').val(1);
                    //$('.popuphide').hide();
                }
            });
        });
    });

    var inc_inary = 0;
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });

    function load() {
        var id = $("#id").val();
        var taxtype = $("#tax_type").val();
        if (taxtype === "GST")
        {
            $(".tax_id").html("<?= label('GSTIN :', $this, $user) ?>");
        } else
        {
            $(".tax_id").html("<?= label('Tax ID :', $this, $user) ?>");
        }
        //alert(id);
        $("#states_cus").change(function () {
            var stateid = $(this).val();
            $.ajax({
                url: "<?php echo site_url('customers/getstatecode/'); ?>/" + stateid,
                success: function (results) {
                    var result = JSON.parse(results);
                    $('#states_cus').val(result.StateID);
                    $('#stcode').val(result.code);
                }
            });
        });
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('suppliers/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    var area_cusss = result.area;
                    $("#currency_id").val(result.currency_id);
                    $("#row_dis_per").val(result.row_dis_per);
                    $("#PriceMargin").val(result.PriceMargin);
                    $("#bill_dis_per").val(result.bill_dis_per);
                    $("#aadhar").val(result.aadhar);
                    $("#inv_cr_days").val(result.inv_cr_days);
                    $("#inv_cr_days_action").val(result.inv_cr_days_action);
                    $("#single_inv_cr_limit").val(result.single_inv_cr_limit);
                    $("#single_inv_cr_limit_action").val(result.single_inv_cr_limit_action);
                    $("#credit_bills_count").val(result.credit_bills_count);
                    $("#credit_bills_count_action").val(result.credit_bills_count_action);


					$("#pincode").val(result.pincode);
                    $("#is_active").val(result.is_active);
                    var route_cusss = result.route;
					$("#branch").val(result.branch);
					$("#listed_in_supplier").val(result.listed_in_supplier);
					$("#cus_agent").val(result.cus_agent);
                    $("#cus_salesman").val(result.cus_salesman);
                    $("#cus_rate").val(result.cus_rate);
					
					$("#customer_type").val(result.customer_type);
                    $("#district").val(result.district);
					
					$("#contact_person").val(result.contact_person);
                    $("#contact_number").val(result.contact_number);
                    $("#name").val(result.name);
                    $("#name_lan").val(result.name_lan);
                    $("#email").val(result.email);
                    $("#phone").val(result.phone);
					$('#price_list').val(result.price_list);
					 $("#cr_period_exceed").val(result.credit_period_exceed);
					$("#credit_amount").val(result.credit_amount);
                    $("#cr_amount_exceed").val(result.credit_amount_exceed);
                    $("#gstin").val(result.tin);
                    $("#pan").val(result.pan);
                    $("#states_cus").val(result.cst);
                    $("#stcode").val(result.gst);
                    $("#remarks").val(result.details);
                    $("#address_line1").val(result.address_line1);
                    $("#address_line2").val(result.address_line2);
                    $("#address_line1_lan").val(result.address_line1_lan);
                    $("#address_line2_lan").val(result.address_line1_lan);
                    $("#credit").val(result.credit_period);
                    $("#opening_bal").val(result.openingbal);
                    $("#bankname").val(result.bank);
                    $("#accno").val(result.account_no);
                    $("#ifscc").val(result.ifsc_code);
                    $("#area_cus").val(area_cusss);
                    $('#route_cus').val(route_cusss);
                    $("#credit_type").val(result.crtype);
                    //$('#opening_bal').prop('readonly', true);

                }
            });
        } else
        {
            $('#states_cus option:contains("KERALA")').prop('selected', true);

        }
    }
    function states_cus(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/states'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.StateID + '"> ' + itemsingle.StateName + '</option>';
                });
                $("#states_cus").html(option);
                $("#states_cus").val(45);
                if (is_select === 1) {
                    var myVal = $('#states_cus option:last').val();
                    $('#states_cus').val(myVal);
                }
            }
        });
    }
    function area_cuss(is_select)
    {
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area_cus').html(result);
                if (is_select === 1) {
                    var myVal = $('#area_cus option:last').val();
                    $('#area_cus').val(myVal);
                }
            }
        });
    }
    function price_list(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('Customers/price_list'); ?>",
            success: function (result) {
                $('#price_list').html(result);
                if (is_select === 1) {
                    var myVal = $('#price_list option:last').val();
                    $('#price_list').val(myVal);
                }
            }
        });
    }
    function route_cuss(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/route'); ?>",
            success: function (result) {
                $('#route_cus').html(result);
                if (is_select === 1) {
                    var myVal = $('#route_cus option:last').val();
                    $('#route_cus').val(myVal);
                }
            }
        });
    }
</script>