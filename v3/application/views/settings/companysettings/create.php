<?php 
	$sale_cash_type = 'Cash';
	if(isset($settings[0]['sale_cash_type'] ) ){
		$sale_cash_type = $settings[0]['sale_cash_type'];
	}
	
	$pur_cash_type = 'Cash';
	if(isset($settings[0]['pur_cash_type'] ) ){
		$pur_cash_type = $settings[0]['pur_cash_type'];
	}
	$discount_on = 'item';
	if(isset($settings[0]['discount_on'] ) ){
		$discount_on = $settings[0]['discount_on'];
	}
	$def_bank = 0 ;
	if(isset($settings[0]['default_bank'] ) ){
		$def_bank = $settings[0]['default_bank'];
	}
?>
<form method="post"  id="frmcreate" back="<?php echo site_url('settings/CompanySettings/listall'); ?>" action="<?php echo site_url('settings/CompanySettings/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $sale_cash_type ?>" name="s_cash_type" id="s_cash_type" />
    <input type="hidden" value="<?= $def_bank ?>" name="def_bank" id="def_bank" />
    <input type="hidden" value="<?= $pur_cash_type ?>" name="p_cash_type" id="p_cash_type" />
    <input type="hidden" value="<?= $discount_on ?>" name="hid_discount_on" id="hid_discount_on" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12">    
			<div class="<?=$this->box_color?>">
			<div class="box-body">
				<span class="pull-right popuphide">
                    <a role="button" class="btn  btn-success align-bottom popuphide" href="<?php echo site_url('inventory_item\Item\listall'); ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                    </a>
                </span>
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#Company_tab" data-toggle="tab"><?= label('Company Info', $this, $user) ?> </a></li>
						<li class=""><a href="#General_tab" data-toggle="tab"><?= label('General ', $this, $user) ?> </a></li>
						<li class=""><a href="#Item_tab" data-toggle="tab"><?= label('Item ', $this, $user) ?> </a></li>
						<li class=""><a href="#Sales_tab" data-toggle="tab"><?= label('Sales ', $this, $user) ?> </a></li>
						<li class=""><a href="#Purchase_tab" data-toggle="tab"><?= label('Purchase ', $this, $user) ?> </a></li>
						<li class=""><a href="#Voucher_tab" data-toggle="tab"><?= label('Vouchers ', $this, $user) ?> </a></li>
						<li class=""><a href="#Enquiry_tab" data-toggle="tab"><?= label('CRM LMS ', $this, $user) ?> </a></li>
						<li class=""><a href="#Lead_tab" data-toggle="tab"><?= label('Lead Master', $this, $user) ?> </a></li>


					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="Company_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $company_details = $company_settings['value'];$company_details =json_decode($company_details,true); foreach($company_details  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>" id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select  name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="General_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $general = $general_settings['value'];$general =json_decode($general,true); foreach($general  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select xxy attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<?php if($details['key'] == 'auto_rate_against'){?>
															<option  <?php if($details['value'] =='landing_cost' ){echo 'selected';}?> value= "landing_cost" >Landing Cost</option>
															<option  <?php if($details['value'] =='prate' ){echo 'selected';}?> value= "prate" >Purchase Rate</option>
														<?php } ?>
														
														
														
														
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text" L="<?php echo $details['value'];?>" autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
								</div>
							</div>
							
						</div>
						<div class="tab-pane" id="Item_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $item = $item_settings['value'];$item =json_decode($item,true); foreach($item  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<?php if($details['key'] == 'commission_type'){?>
															<option  <?php if($details['value'] =='flat' ){echo 'selected';}?> value= "flat" >Flat</option>
															<option  <?php if($details['value'] =='percentage' ){echo 'selected';}?> value= "percentage" >Percentage</option>
														<?php } ?>
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="Sales_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $sales = $sales_settings['value'];$sales =json_decode($sales,true); foreach($sales  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="Purchase_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $purchase = $purchase_settings['value'];$purchase =json_decode($purchase,true); foreach($purchase  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select xxx attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<?php if($details['key'] == 'auto_rate_against'){?>
															<option  <?php if($details['value'] =='landing_cost' ){echo 'selected';}?> value= "landing_cost" >Landing Cost</option>
															<option  <?php if($details['value'] =='prate' ){echo 'selected';}?> value= "prate" >Purchase Rate</option>
														<?php } ?>
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="Voucher_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $voucher = $voucher_settings['value'];$voucher =json_decode($voucher,true); foreach($voucher  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text" autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
									
								</div>
							</div>
						</div>
						<div class="tab-pane" id="Enquiry_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $enquiry = $enquiry_settings['value'];$enquiry =json_decode($enquiry,true); foreach($enquiry  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text" autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
									
								</div>
							</div>
						</div>

						<div class="tab-pane" id="Lead_tab">
							<div class="box-body">
								<div class="col-sm-12">
									<?php $lead = $lead_settings['value'];$lead =json_decode($lead,true); foreach($lead  as $details){?>
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($details['key'], $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<?php if($details['type'] == 'select'){?>
													<select attrvalue="<?php echo $details['value'];?>" name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
													</select>
												<?php } else if($details['type'] == 'text'){ ?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control" name="<?php echo $details['key'];?>" type="text" autocomplete="off" data-validation="required" maxlength="250" />
												<?php }else if($details['type'] == 'int'){?>
													<select name="<?php echo $details['key'];?>" id="<?php echo $details['key'];?>" class="form-control">
														<option value="0">Select</option>
														<option <?php if((int)$details['value']<1){echo 'selected';}?> value="0">NO</option>
														<option <?php if((int)$details['value']>0){echo 'selected';}?> value="1">YES</option>
													</select>
												<?php }else if($details['type'] == 'decimal'){?>
													<input value="<?php echo $details['value'];?>"  id="<?php echo $details['key'];?>" class="form-control two-digits" name="<?php echo $details['key'];?>" type="text"  autocomplete="off" data-validation="required" maxlength="250" />
												<?php }?>
											</div>
										</div>
									<?php }?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
               
                <!-- /.row -->
				</div>
					<div class="box-footer popuphide">
                        <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
				</div>   
            </div>
		</div>	
    </section>
</form>
    <script type="text/javascript">
       function load(){

	   }
	   $(document).ready(function () {
			$.ajax({
				url: "<?php echo site_url('ajaxcall/bank'); ?>",
				async:false,
				success: function(result) {
					$('#default_bank').html(result);
					var def_bank = $('#def_bank').val();
					$('#default_bank').val(def_bank);
				}
			});
			
			
			var s_cash_type = $('#s_cash_type').val();
			var p_cash_type = $('#p_cash_type').val();
			$('#discount_on').html('<option value="item">Item</option><option value="category">Category</option><option value="brand">Brand</option>');
		   $('#pur_cash_type').html('<option value="Cash">Cash</option><option value="Credit">Credit</option>');
		   $('#sale_cash_type').html('<option value="Cash">Cash</option><option value="Credit">Credit</option>');
		   $('#com_tax_type').html('<option value="GST">GST</option><option value="VAT">VAT</option>');
		   var tax_type = $('#com_tax_type').attr('attrvalue');
		   $('#discount_on').val($('#hid_discount_on').val());
		    $('#com_tax_type').val(tax_type);
		    $('#sale_cash_type').val(s_cash_type);
		    $('#pur_cash_type').val(p_cash_type);
		    $.ajax({
            url: "<?php echo site_url('ajaxcall/currency'); ?>",
            success: function (result) {
				var currency = $('#comset_currency').attr('attrvalue');
                $('#comset_currency').html(result);
				 $('#comset_currency').val(currency);
            }
			});
		    $.ajax({
				url: "<?php echo site_url('ajaxcall/states'); ?>",
				success: function (result) {
					var comset_statecode = $('#comset_statecode').attr('attrvalue');
					$('#comset_statecode').html(result);
					$('#comset_statecode').val(comset_statecode);
            }
        });
		load();
	   });
    </script>                                                                                                                                                                                                                                                                         