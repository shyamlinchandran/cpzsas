<style>
  .sma{
        width: 60px !important;
    }
	 
	.cma{
		width: 40px !important;
	}
	
	.small{
		 width: 130px !important;
	}
	.barcode{
		width: 150px !important;
	}
</style>
<?php
$isdate = 0 ;
$isbatch = 0 ;
if(isset($settings[0]['is_batch'])){
	$isbatch = $settings[0]['is_batch'];
	$isdate = 1;
}
if(strtolower($this->session->userdata('login_comid')) == 'test'){
	//$isbatch = 0 ;
}

$sj_unit_cost = 0 ;
if(isset($settings[0]['sj_unit_cost']) ){
	$sj_unit_cost = $settings[0]['sj_unit_cost'];

}

$is_wt = 0;
if(strtolower($this->session->userdata('login_comid')) == 'omgold'){
	$is_wt = 1;
}
	
?>
<form method="post" id="frmstockjournal" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('Stock_journal/listall'); ?>" action="<?php echo site_url('Stock_journal/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo  $id;?>" name="id" id="id" />
	<input type="hidden" value="<?php echo  $isdate;?>" name="isdate" id="isdate" />
	<input type="hidden" value="<?php echo  $isbatch;?>" name="isbatch" id="isbatch" />
    <input type="hidden" value="<?php echo  $is_wt;?>" name="is_wt" id="is_wt" />
    <input type="hidden" value="<?php echo  $sj_unit_cost;?>" name="sj_unit_cost" id="sj_unit_cost" />

    <section class="content">
        <div class="row">
            <div class="box">
					 <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', 'Stock Journal')) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('Stock_journal/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Stock_journal/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
					<div class="box-body">
						<div class="col-sm-6">
							<div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Date', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input class="form-control date" id="date" autocomplete="false" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Voucher Number', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <p><label spellcheck="false" id="voucher_no"><?php if($id<1 ){echo $invoice;}?></label>
                                    <input value="<?php if($id<1 ){echo $invoice;}?>" type="hidden" name="invoice" type="text" id="invoice" class="form-control" placeholder="Voucher Number">
                                </div>
                            </div>
							 <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Ref. no', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="reference" type="text" id="reference" class="form-control" placeholder="Reference Number">
                                </div>
                            </div>

						</div>
						<div class="col-sm-6">
							<label  class="col-sm-4 control-label"><?= label('Remarks', $this, $user) ?></label>
							 <div class="col-sm-8">
								<textarea name="remarks" id ="remarks" class="form-control"></textarea>
							 </div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-12" style="margin:0px; height:300px;overflow-y:scroll" >
								<table id="table"  class="table table-bordered table-striped" cellspacing="0" width="100%">
									<tr>
										<th colspan="9" style="text-align:center">Issue(consumption)</th>
									</tr>
									<tr>
                                        <th class="cma"><?= label('Sno', $this, $user) ?></th>  
                                        <th class="barcode"><?= label('Barcode', $this, $user) ?></th>  
                                        <th><?= label('Item', $this, $user) ?></th>  
                                        <th class="small"><?= label('Godown', $this, $user) ?></th>  
                                        <th class="sma"><?= label('Quantity', $this, $user) ?></th>
										<?php if($isbatch > 0 ){?>
											<th class="sma"><?= label('Batch', $this, $user) ?></th>
											<?php if($isdate > 0 ){?>
												<th class="sma"><?= label('Expiry', $this, $user) ?></th>
											<?php } ?>
										<?php } ?>
										<?php if($is_wt > 0 ){?>
											<th class="sma"><?= label('Weight', $this, $user) ?></th>
										<?php } ?>
                                        <th class="sma"><?= label('Landing Cost', $this, $user) ?></th> 
                                        <th class="sma"><?= label('StkRate', $this, $user) ?></th> 
                                        <th class="sma"><?= label('Value', $this, $user) ?></th>
                                        <th class="sma"><?= label('SaleRate', $this, $user) ?></th>
										<th class="sma"><?= label('Mrp', $this, $user) ?></th>
										<th class="cma"><?= label('Action', $this, $user) ?></th>  
                                    </tr>
									<tr>
										<td class="cma" style="text-align: center;"><input title="1" style="height:20px"   id="totnolistdec" class="form-control  text-right"  readonly="readonly"/></td> 
                                        <td class="barcode"><input type="text" class="form-control" name="itembarcode_dec" id="itembarcode_dec" placeholder="barcode" /></td>  
										<td><input type="text" class="form-control" name="itemname_dec" id="itemname_dec" placeholder="Itemname" /><input type="hidden" id="itemid_dec" name="itemid_dec"></td>  
                                        <td class="small"><select name="godown_dec" id="godown_dec" class="form-control"><option value="">Select Godown</option></select></td>
									   <td class="sma"><input type="text" class="form-control two-digits" name="itemquantity_dec" id="itemquantity_dec" placeholder="Quantity" /></td>
									   <?php if($isbatch > 0 ){?>
											<td class="sma">
											<input type="text" readonly class="form-control" name="batch_dec" id="batch_dec" placeholder="Batch" />
											</td>
											<?php if($isdate > 0 ){?>
												<td class="sma">	

												<input type="text" class="form-control date daten" name="date_dec" id="date_dec" placeholder="date" />
										</td>	
											<?php } ?>

										<?php } ?>	
									 
									   <td <?php if($is_wt < 1 ){?> style ="display:none;" <?php }?> class="sma"><input type="text" class="form-control two-digits" name="itemwt_dec" id="itemwt_dec" placeholder="Item Wt" /></td>
                                        <td class="sma"><input type="text" class="form-control two-digits" name="landing_cost_dec" id="landing_cost_dec" placeholder="Landing Cost" /></td> 
										<td class="sma"><input type="text" class="form-control two-digits" name="stockrate_dec" id="stockrate_dec" placeholder="Stk Rate" /></td> 
									   <td class="sma"><input type="text" class="form-control two-digits" name="stockvalue_dec" id="stockvalue_dec" placeholder="Stk Value" /></td>
                                        <td class="sma"><input type="text" class="form-control two-digits" name="stocksrate_dec" id="stocksrate_dec" placeholder="SRate" /></td>
										<td class="sma"><input type="text" class="form-control two-digits" name="stockmrp_dec" id="stockmrp_dec" placeholder="MRP" /></td>
										<td><button data-toggle="tooltip" type="button"  id="adddec"   title="Add To save"   class="btn btn-success" >
                                                                <span class="glyphicon glyphicon-plus"></span> 
                                                            </button></td>
									</tr>
									<tbody id="dec">
									</tbody>
									
								</table>
							</div>
							
							
						
							<div class="col-sm-12"  >
								<table id="table"  class="table table-bordered table-stripped" style="padding:0px;margin:0px;" cellspacing="0" width="100%">
									<tr>
										<th class="cma"></th>  
                                        <th class="barcode"></th>  
                                        <th></th>  
                                        <th class="small">Total Quantity</th>  
                                        <th class="sma"><input type="text" readonly="readonly" id="totalqtydec"></th>
                                        <th class="sma">Stock Value</th> 
                                        <th class="sma"><input type="text" readonly="readonly" id="totalstockvaldec"></th>
                                        <th class="sma"></th>
                                        <th class="cma"></th>
									</tr>
								</table>
							</div>
							<div style="<?php if((int) $sj_unit_cost < 1 ){ echo 'display:none;';}?>margin:0px; height:300px;overflow-y:scroll" class ="col-sm-12">
								<table   id="table"  class="table table-bordered table-stripped" style="padding:0px;margin:0px;" cellspacing="0" width="100%" >
										
											<tr>
												<th>Ledger</th>
												<th>Amount</th>
											</tr>

											<tr>

												<td>
													<input id="ledger" class="form-control" name="ledger" type="text" value="" placeholder="Ledger" maxlength="50">
													<input id="ledgerid" class="form-control" name="ledgerid" type="hidden" value="" data-validation="required" maxlength="50">
												</td>

												<td>
													<input id="ledger_amount" placeholder="Amount" class="form-control " name="ledger_amount" type="text">
												</td>
												<td>
													<a data-toggle="tooltip" style="float: left" title="Add More" id="add_ledger" class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span>
													</a>
												</td>
											</tr>
											  <tbody id="ledger_body">
											  </tbody>
											  <tr>
												<th></th>
												<th><input class ="form-control"  type ="text" readonly name = "ledgerAmount" id ="ledgerAmount" ></th>
											</tr>
                                </table>
							</div>
							
							
							<div class="col-sm-12 "  style="margin:0px; height:300px;overflow-y:scroll">
								<table id="table"  class="table table-bordered table-stripped" style="padding:0px;margin:0px;" cellspacing="0" width="100%">
									<tr>
										<th colspan="9" style="text-align:center">Received(production)</th>
									</tr>
									<tr>
                                        <th class="cma"><?= label('Sno', $this, $user) ?></th>  
                                        <th class="barcode"><?= label('Barcode', $this, $user) ?></th>  
                                        <th><?= label('Item', $this, $user) ?></th>  
                                        <th class="sma"><?= label('Godown', $this, $user) ?></th>  
                                        <th class="sma"><?= label('Quantity', $this, $user) ?></th>

										<?php if($isbatch > 0 ){?>
											<th class="sma"><?= label('Batch', $this, $user) ?></th>
											<?php if($isdate > 0 ){?>
												<th class="small"><?= label('Expiry', $this, $user) ?></th>
											<?php } ?>
										<?php } ?>	


										<?php if($is_wt > 0 ){?>
											<th class="sma"><?= label('Weight', $this, $user) ?></th>
										<?php } ?>   
                                        <th class="sma"><?= label('Landing Cost', $this, $user) ?></th> 
										<?php if((int) $sj_unit_cost > 0 ){?>
											<th class="sma"><?= label('Unit Cost', $this, $user) ?></th> 
										<?php }?>
											
                                        <th class="sma"><?= label('StkRate', $this, $user) ?></th> 
                                        <th class="sma"><?= label('StkValue', $this, $user) ?></th>
                                        <th class="sma"><?= label('SaleRate', $this, $user) ?></th>
										<th class="sma"><?= label('Mrp', $this, $user) ?></th>
                                        <th class="cma"><?= label('Action', $this, $user) ?></th>
                                    </tr>
									<tr>
										<td class="cma" style="text-align: center;"><input title="1" style="height:20px"   id="totnolistinc" class="form-control  text-right"  readonly="readonly"/></td> 
                                        <td class="barcode"><input type="text" class="form-control" name="itembarcode_inc" id="itembarcode_inc" placeholder="barcode" /></td>  
									   <td><input type="text" class="form-control" name="itemname_inc" id="itemname_inc" placeholder="Itemname / barcode" /><input type="hidden" id="itemid_inc" name="itemid_inc"></td>  
                                        <td class="small"><select name="godown_inc" id="godown_inc" class="form-control"><option value="">Select Godown</option></select></td>
									   <td class="sma"><input type="text" class="form-control two-digits" name="itemquantity_inc" id="itemquantity_inc" placeholder="Quantity" /></td>
									   <?php if($isbatch > 0 ){?>
											<td class="sma">
												<input type="text" class="form-control" name="batch_inc" id="batch_inc" placeholder="Batch" />
											</td>
											<?php if($isdate > 0 ){?>
												<td class="small">
												<input type="text" class="form-control date daten" name="date_inc" id="date_inc" placeholder="Date" />
												</td>
											<?php } ?>
										<?php } ?>	
										<td  <?php if($is_wt < 1 ){?> style ="display:none;" <?php }?> class="sma"><input type="text" class="form-control two-digits" name="itemwt_inc" id="itemwt_inc" placeholder="Item Wt" /></td>
									   <td class="sma"><input type="text" class="form-control two-digits" name="landing_cost_inc" id="landing_cost_inc" placeholder="Landing Cost" /></td> 
										<?php if((int) $sj_unit_cost > 0 ){?>
											<td class="sma"><input type="text" class="form-control two-digits" name="unit_cost_inc" id="unit_cost_inc" placeholder="Unit Cost" /></td> 
										<?php }?>
                                        <td class="sma"><input type="text" class="form-control two-digits" name="stockrate_inc" id="stockrate_inc" placeholder="Stk Rate" /></td> 
									   <td class="sma"><input type="text" class="form-control two-digits" name="stockvalue_inc" id="stockvalue_inc" placeholder="Stk Value" /></td>
                                        <td class="sma"><input type="text" class="form-control two-digits" name="stocksrate_inc" id="stocksrate_inc" placeholder="SRate" /></td>
                                        <td class="sma"><input type="text" class="form-control two-digits" name="stockmrp_inc" id="stockmrp_inc" placeholder="Mrp" /></td>
										<td><button data-toggle="tooltip" type="button"  id="addinc"   title="Add To save"   class="btn btn-success" >
                                                                <span class="glyphicon glyphicon-plus"></span> 
                                                            </button></td>
									</tr>
									<tbody id="inc">
									</tbody>
									
								</table>
							</div>
							<table id="table"  class="table table-bordered table-stripped" style="padding:0px;margin:0px;" cellspacing="0" width="100%">
									<tr>
										<th class="cma"></th>  
                                        <th class="barcode"></th>  
                                        <th></th>  
                                        <th class="small">Total Quantity</th>  
                                        <th class="sma"><input type="text" readonly="readonly" id="totalqtyinc"></th>
                                        <th class="sma">Stock Value</th> 
                                        <th class="sma"><input type="text" readonly="readonly" id="totalstockvalinc"></th>
                                        <th class="sma"></th>
                                        <th class="cma"></th>
									</tr>
							</table>
						</div>
						
					</div>
                    <div class="box-footer">
                        <?php if ($view != 'view') { ?>
                            <button  id="btnjournal" type='button' data-toggle="tooltip" title='Save' class='btn btn-warning'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <button style ="display:none;" id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn btn-warning'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php } ?>
                    </div>
                  
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
    </section>
</form>

<script type="text/javascript">
	 $(document).on("change", ".ledgersum", function() {
            calculate_ledgersum();
			calculate_unit_cost();

     });
	 
	 $(document).on("change", ".qtyinc", function() {
			calculate_unit_cost();
     });
	var cnt_sj = 0 ;
	function calert(msg) {
        toastr["error"](msg);
    }
	$(document).on('click', '#btnjournal', function() {
		var cnt = 0 ;
		event.preventDefault();
		$( ".qtydec" ).each(function() {
			cnt = cnt + 1;
			console.log($( this ).val());
		});
		$( ".qtyinc" ).each(function() {
			cnt = cnt + 1;
			console.log($( this ).val());
		});
		if(parseFloat(cnt) >0  && parseFloat(cnt_sj) < 1 ){
			$('#form-button-save').trigger('click');
			cnt_sj = cnt_sj + 1;
		}else if( parseFloat(cnt_sj) > 0 ){
		
		}else{
			calert('Please Select atleast One Item');
		}
		
	});
	function calculateinctotal(){
		var stockvalue = 0 ;
		var qty = 0 ;
		$(".stkvalueinc").each(function() {
			stockvalue = parseFloat(stockvalue)+ parseFloat( $(this).val() );
		});
		
		$(".qtyinc").each(function() {
			qty = parseFloat(qty)+ parseFloat( $(this).val() );
		});
		$('#totalqtyinc').val(qty);
		$('#totalstockvalinc').val(stockvalue);

		var desc = 0;
		$(".cmadesc").each(function() {
			desc = desc +1;
			$(this).val(desc);
			$('#totnolistdec').val(desc);
		});
		var asc = 0;
		$(".cmaasc").each(function() {
			asc = asc +1;
			$(this).val(asc);
			$('#totnolistinc').val(asc);
		});
	}
	
	function calculatedectotal(){
		var stockvalue = 0 ;
		var qty = 0 ;
		$(".stkvaluedec").each(function() {
			stockvalue = parseFloat(stockvalue)+ parseFloat( $(this).val() );
		});
		
		$(".qtydec").each(function() {
			qty = parseFloat(qty)+ parseFloat( $(this).val() );
		});
		$('#totalqtydec').val(qty);
		$('#totalstockvaldec').val(stockvalue);
		var desc = 0;
		$(".cmadesc").each(function() {
			desc = desc +1;
			$(this).val(desc);
			$('#totnolistdec').val(desc);

		});
		var asc = 0;
		$(".cmaasc").each(function() {
			asc = asc +1;
			$(this).val(asc);
			$('#totnolistinc').val(asc);

		});
	}
  function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0), // get only two digits
                month = datePart[1], day = datePart[2];
        return day + '/' + month + '/' + year;
    }
function load(){
	var id = $('#id').val();
	if(id > 0){
		  $.ajax({
                url: "<?php echo site_url('Stock_journal/getsing'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
						if(i<1){
							$('#date').val(formatDate(itemsingle.date));
							$('#voucher_no').html(itemsingle.voucher_no);
							$('#invoice').val(itemsingle.voucher_no);
							$('#reference').val(itemsingle.reference);
							$('#remarks').val(itemsingle.remarks);
						}
						var landing_cost = itemsingle.landing_cost;
						var type = itemsingle.type;
						var item_id = itemsingle.item_id;
						var godown_id = itemsingle.godown_id;
						var quantity = itemsingle.quantity;
						var srate = itemsingle.srate;
						var prate = itemsingle.prate;
						var stock_value = itemsingle.stock_value;
						var net_wt = itemsingle.net_wt;
						var name = itemsingle.name;
						var barcode =itemsingle.barcode;
						var godown_name = itemsingle.godown_name;
						var batch =itemsingle.batch;
						var sdate = itemsingle.sdate;
						var mrp = itemsingle.mrp;
						if(sdate =='' || sdate == null || sdate == 'null'){
							sdate = '';
						}
						if(type ==='decrease'){
							addrowdec(item_id,name,barcode,godown_id,quantity,net_wt,prate,stock_value,srate,godown_name,landing_cost,batch,sdate,itemsingle.Mrp)
						}else{
							addrowinc(item_id,name,barcode,godown_id,quantity,net_wt,prate,stock_value,srate,godown_name,landing_cost,batch,sdate,itemsingle.Mrp)
						}
                    });

                }
            });
			
			$.ajax({
                url: "<?php echo site_url('Stock_journal/journal_ledgers'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
						new_row(0,itemsingle.name, itemsingle.ledger_id, itemsingle.amount)
                    });

                }
            });
	}
}
var incntdec = 0;
var incntinc = 0 ;
function remove(btn){
    $(btn).closest('tr').remove();
	calculatedectotal();
	calculateinctotal();
}
function calculatedec(id){
	var quantity_dec = $('#quantity_dec'+id).val();
	var stkrate_dec = $('#stkrate_dec'+id).val();
	var stkvalue_dec = parseFloat(quantity_dec)*parseFloat(stkrate_dec);
	$('#stkvalue_dec'+id).val(stkvalue_dec);
	calculatedectotal();
	calculate_unit_cost();
}

function calculateinc(id){
	var quantity_inc = $('#quantity_inc'+id).val();
	var stkrate_inc = $('#stkrate_inc'+id).val();
	var stkvalue_inc = parseFloat(quantity_inc)*parseFloat(stkrate_inc);
	$('#stkvalue_inc'+id).val(stkvalue_inc);
	calculateinctotal();
}

function calculate_unit_cost(){
	var totalstockvaldec = $('#totalstockvaldec').val();
	var ledgerAmount = $('#ledgerAmount').val();
	if(totalstockvaldec === ''){
		totalstockvaldec = 0;
	}
	if(ledgerAmount ===''){
		ledgerAmount = 0;
	}
	var total_stock_value = parseFloat(totalstockvaldec) + parseFloat(ledgerAmount);
	var qtyinc = $('.qtyinc');
    qtyinc.each(function(index, item) {
        quantity =  parseFloat($(item).val());
		if(quantity === ''){
			quantity = 0;
		}
		var tr = $(this).closest('tr');
		var ucost = 0;
		if(parseFloat(total_stock_value) > 0 && parseFloat(quantity) > 0   ){
			ucost = parseFloat(total_stock_value)/parseFloat(quantity);
		}
		$(tr).find('.unit_cost').val(ucost);
    });
	
}
function addrowdec(itemid_dec,itemname_dec,itembarcode_dec,godown_dec,itemquantity_dec,itemwt_dec,stockrate_dec,stockvalue_dec,stocksrate_dec,godownname_dec,landing=0,batch,date,stockmrp_dec){
	var is_wt = $('#is_wt').val();
	var txtwt = ' ';
	var isdate = $('#isdate').val();
	var datetext = '';
	var isbatch = $('#isbatch').val();
	var batch_text = '';
	if(isbatch > 0 ){
		batch_text ='<td class="sma"><input readonly  value="'+batch+'" type="text" class="form-control two-digits" name="itmbatch_dec[]" id="itmbatch_dec'+incntinc+'" placeholder="Batch" /></td>';
		if(isdate > 0 ){
			datetext ='<td class="sma"><input  value="'+date+'" type="text" class="form-control date" name="itmdate_dec[]" id="itmdate_dec'+incntinc+'" placeholder="Date" /></td>';
		}
	}



	if(parseFloat(is_wt) < 1 ){
		txtwt = ' style ="display:none" ';
	}
	incntdec = incntdec + 1 ;
	var text = '<tr><td class="cma " style="text-align: center;"><input title="1" style="height:20px"   id="deccnt" class="form-control  text-right cmadesc"  readonly="readonly"/></td>'+ 
'<td class="barcode"><input value="'+itembarcode_dec+'" type="text" class="form-control" name="barcode_dec[]" readonly="readonly" id="barcode_dec" placeholder="barcode" /></td> '+ 
'<td><input type="text" class="form-control" value="'+itemname_dec+'" readonly="readonly" name="name_dec[]" id="name_dec" placeholder="Itemname" /><input value="'+itemid_dec+'" type="hidden" id="id_dec" name="id_dec[]"></td> '+ 
'<td class="small"><input type="hidden" name="godown_id_dec[]" value="'+godown_dec+'"><input value="'+godownname_dec+'" readonly="readonly" type="text" class="form-control"></td>'+ 
'<td class="sma"><input onchange="calculatedec('+incntdec+')" value="'+itemquantity_dec+'" type="text" class="form-control two-digits qtydec" name="quantity_dec[]" id="quantity_dec'+incntdec+'" placeholder="Quantity" /></td>'+ 
batch_text+datetext+
'<td class="sma" '+txtwt+'><input onchange="calculatedec('+incntdec+')" value="'+itemwt_dec+'" type="text" class="form-control two-digits wtdec" name="wt_dec[]" id="wt_dec'+incntdec+'" placeholder="Quantity" /></td>'+ 
'<td class="sma"><input  value="'+landing+'" type="text" class="form-control two-digits" name="landing_dec[]" id="landing_dec'+incntinc+'" placeholder="Landing Cost" /></td>'+ 
'<td class="sma"><input onchange="calculatedec('+incntdec+')" value="'+stockrate_dec+'"  type="text" class="form-control two-digits" name="stkrate_dec[]" id="stkrate_dec'+incntdec+'" placeholder="Stk Rate" /></td> '+ 
'<td class="sma"><input value="'+stockvalue_dec+'" type="text" readonly="readonly" class="form-control two-digits stkvaluedec" name="stkvalue_dec[]" id="stkvalue_dec'+incntdec+'" placeholder="Stk Value" /></td>'+ 
'<td class="sma"><input value="'+stocksrate_dec+'" type="text" class="form-control two-digits" name="srate_dec[]" id="srate_dec'+incntdec+'" placeholder="SRate" /></td>'+
'<td class="sma"><input value="'+stockmrp_dec+'" type="text" class="form-control two-digits" name="mrp_dec[]" id="mrp_dec'+incntdec+'" placeholder="SRate" /></td>'+
'<td><span data-toggle="tooltip"   title="Remove" onclick="remove(this)" vtype="dec" class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
$('#dec').append(text);
calculatedectotal();
calculate_unit_cost();
}
function addrowinc(itemid_inc,itemname_inc,itembarcode_inc,godown_inc,itemquantity_inc,itemwt_inc,stockrate_inc,stockvalue_inc,stocksrate_inc,godownname_inc,landing=0,batch,date,stockmrp_inc){
	var is_wt = $('#is_wt').val();
	var isdate = $('#isdate').val();
	var datetext = '';
	var txtwt = ' ';
	if(parseFloat(is_wt) < 1 ){
		txtwt = ' style ="display:none" ';
	}
	incntinc = incntinc + 1 ;

	var isbatch = $('#isbatch').val();
	var batch_text = '';
	if(isbatch > 0 ){
		batch_text ='<td class="sma"><input  value="'+batch+'" type="text" class="form-control two-digits" name="itmbatch_inc[]" id="itmbatch_inc'+incntinc+'" placeholder="Batch" /></td>';
		if(isdate > 0 ){
			datetext ='<td class="sma"><input  value="'+date+'" type="text" class="form-control date" name="itmdate_inc[]" id="itmdate_inc'+incntinc+'" placeholder="Date" /></td>';
		}
	}

	var text = '<tr><td class="cma " style="text-align: center;"><input title="1" style="height:20px"   id="inccnt" class="form-control cmaasc text-right"  readonly="readonly"/></td>'+ 
'<td class="barcode"><input value="'+itembarcode_inc+'" type="text" class="form-control" name="barcode_inc[]" readonly="readonly" id="barcode_inc" placeholder="barcode" /></td> '+ 
'<td><input type="text" class="form-control" value="'+itemname_inc+'" readonly="readonly" name="name_inc[]" id="name_inc" placeholder="Itemname" /><input value="'+itemid_inc+'" type="hidden" id="id_inc" name="id_inc[]"></td> '+ 
'<td class="small"><input type="hidden" name="godown_id_inc[]" value="'+godown_inc+'"><input value="'+godownname_inc+'" readonly="readonly" type="text" class="form-control"></td>'+ 
'<td class="sma"><input  onchange="calculateinc('+incntinc+')" value="'+itemquantity_inc+'" type="text" class="form-control two-digits qtyinc" name="quantity_inc[]" id="quantity_inc'+incntinc+'" placeholder="Quantity" /></td>'+ 
batch_text+datetext+
'<td '+txtwt+' class="sma"><input  onchange="calculateinc('+incntinc+')" value="'+itemwt_inc+'" type="text" class="form-control two-digits wtinc" name="wt_inc[]" id="wt_inc'+incntinc+'" placeholder="Quantity" /></td>'+ 
'<td class="sma"><input  value="'+landing+'" type="text" class="form-control two-digits" name="landing_inc[]" id="landing_inc'+incntinc+'" placeholder="Landing Cost" /></td>'+ 
<?php if((int) $sj_unit_cost > 0 ){ ?>
	'<td class="sma"><input  value="'+0+'" type="text" class="form-control two-digits unit_cost" name="ucost_inc[]" id="ucost_inc'+incntinc+'" placeholder="Unit Cost" /></td>'+ 
<?php } ?>
'<td class="sma"><input onchange="calculateinc('+incntinc+')" value="'+stockrate_inc+'"  type="text" class="form-control two-digits" name="stkrate_inc[]" id="stkrate_inc'+incntinc+'" placeholder="Stk Rate" /></td> '+ 
'<td class="sma"><input value="'+stockvalue_inc+'" type="text" class="form-control two-digits stkvalueinc" name="stkvalue_inc[]" id="stkvalue_inc'+incntinc+'" placeholder="Stk Value" /></td>'+ 
'<td class="sma"><input value="'+stocksrate_inc+'" type="text" class="form-control two-digits" name="srate_inc[]" id="srate_inc'+incntinc+'" placeholder="SRate" /></td>'+
'<td class="sma"><input value="'+stockmrp_inc+'" type="text" class="form-control two-digits" name="mrp_inc[]" id="mrp_inc'+incntinc+'" placeholder="Mrp" /></td>'+
'<td><span data-toggle="tooltip"   title="Remove" onclick="remove(this)" vtype="inc" class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
$('#inc').append(text);
calculateinctotal();
calculate_unit_cost();

}

$(document).on('change', '#itemquantity_dec,#stockrate_dec', function() {
	var itemquantity_dec =  $('#itemquantity_dec').val();
	var stockrate_dec = $('#stockrate_dec').val();
	if(itemquantity_dec ===""){
		itemquantity_dec=0;
	}
	if(stockrate_dec ===""){
		stockrate_dec=0;
	}
	var stockvalue_dec = parseFloat(stockrate_dec) * parseFloat(itemquantity_dec);
	$('#stockvalue_dec').val(stockvalue_dec);
});

$(document).on('change', '#itemquantity_inc,#stockrate_inc', function() {
	var itemquantity_inc =  $('#itemquantity_inc').val();
	var stockrate_inc = $('#stockrate_inc').val();
	if(itemquantity_inc ===""){
		itemquantity_inc=0;
	}
	if(stockrate_inc ===""){
		stockrate_inc=0;
	}
	var stockvalue_inc = parseFloat(stockrate_inc) * parseFloat(itemquantity_inc);
	$('#stockvalue_inc').val(stockvalue_inc);
	var itemid_inc  = $('#itemid_inc').val();
	if(itemid_inc === undefined || itemid_inc === '' ){
		itemid_inc = 0;
	}
	if(parseFloat(itemid_inc) > 0 ){
			var itemquantity_inc = $('#itemquantity_inc').val();
			if(itemquantity_inc === ''){
				itemquantity_inc = 0;
			}
			if(parseFloat(itemquantity_inc) < 1  ){
				itemquantity_inc = 1;
				$('#itemquantity_inc').val(1);
			}
			var totalstockvaldec = $('#totalstockvaldec').val();
			var ledgerAmount = $('#ledgerAmount').val();
			var tot_inc_qty = calculate_inc_quantity();
			tot_inc_qty = parseFloat(tot_inc_qty) + parseFloat(itemquantity_inc);
			if(totalstockvaldec === ''){
				totalstockvaldec = 0;
			}
			if(ledgerAmount ===''){
				ledgerAmount = 0;
			}
			var total_stock_value = parseFloat(totalstockvaldec) + parseFloat(ledgerAmount);
			var single_unit_cost = 0;
			unit_cost = 0;
			if(parseFloat(total_stock_value) > 0  ){
				//var single_unit_cost = parseFloat(total_stock_value) / parseFloat(tot_inc_qty);
				unit_cost = total_stock_value/itemquantity_inc;
			}
			$('#unit_cost_inc').val(unit_cost);
	}
});

	function calculate_ledgersum() {
            var total = $('.ledgersum');
            var tot = 0;
            total.each(function(index, item) {
			});
			tot = parseFloat(tot) + parseFloat($(item).val());
            $("#ledgerAmount").val(tot);

     }

	function new_row(ledgertableid,ledger_name, ledger_id, ledger_amount) {
            let new_row = ' <tr><td><input  class="form-control" name="ledgertableid[]" type="hidden" value="' + ledgertableid + '">'+
                '<input class="form-control" type="text" value="' + ledger_name + '" disabled >' +
                '<input  class="form-control" name="ledgerid[]" type="hidden" value="' + ledger_id + '" ></td>' +
                '<td> <input  class="form-control ledgersum" name="ledger_amount[]" type="text" value="' + ledger_amount + '"></td>'
               + '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove_ledger" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></span></td></tr>';
            $('#ledger_body').append(new_row);
			calculate_ledgersum();
			calculate_unit_cost();
     }

	function add_ledger_row() {
		let ledger_name = $('#ledger').val();
		let ledger_id = $('#ledgerid').val();
		let ledger_amount = $('#ledger_amount').val();
		let ledgertableid = 0;
        if (ledger_name && ledger_amount && ledgerid) {
			new_row(ledgertableid,ledger_name, ledger_id, ledger_amount);
            $('#ledger').val('')
            $('#ledgerid').val('')
            $('#ledger_amount').val('')
            
		}


	}
	
	function calculate_inc_quantity(){
			var qtyinc = $('.qtyinc');
            var quantity = 0;
            qtyinc.each(function(index, item) {
                quantity = parseFloat(quantity) + parseFloat($(item).val());
            });
			return quantity;
	}
$(document).ready(function () {
	$('.daten').val('');
	$('#add_ledger').click(function() {

            add_ledger_row(); //add ledger row

        })  
        $('#ledger_table').keypress(function(e) {
            if (e.which == 13) {

                add_ledger_row(); //add ledger row

            }
        });


        $(document).on('click', '.remove_ledger', function() {

            $('.tootip').remove;
            $(this).closest('tr').remove();
            calculate_ledgersum();
			calculate_unit_cost();
        })

	 $('#ledger').autocomplete({
            source: "<?php echo site_url('production/bom/bom_controller/search_ledger'); ?>",
            minLength: 1,
            autoFocus: true,
            select: function(event, ui) {
                $('#ledgerid').val(ui.item.id);


            }
        })
	$('#adddec').click(function(){
			var isdate = $('#isdate').val();
			var date = '';
			if(isdate > 0 ){
				date =  $('#date_dec').val();
			}
			var stockmrp_dec = $('#stockmrp_dec').val();
			var stockrate_dec = $('#stockrate_dec').val();
            var stockvalue_dec = $('#stockvalue_dec').val();
			var itemwt_dec = $('#itemwt_dec').val();
            var stocksrate_dec = $('#stocksrate_dec').val();
            var itemquantity_dec = $('#itemquantity_dec').val();
			var itembarcode_dec = $('#itembarcode_dec').val();
			var itemname_dec = $('#itemname_dec').val();
			var itemid_dec = $('#itemid_dec').val();
			var godown_dec = $('#godown_dec').val();
			var godownname_dec = $("#godown_dec option:selected").text();
			var landing_cost_dec = $('#landing_cost_dec').val();
			if(landing_cost_dec === ''){
				landing_cost_dec = 0;
			}
			if(itemid_dec !== "" && godown_dec !=="" && parseFloat(itemquantity_dec) > 0 && godown_dec !== null && godown_dec !== 'null' ){
				$('#stockrate_dec').val(0);
				$('#stockvalue_dec').val(0);
				$('#stockmrp_dec').val(0);
				if(isdate > 0 ){
					$('#date_dec').val('');
				}
				$('#stocksrate_dec').val(0);
				$('#itemquantity_dec').val(1);
				$('#itembarcode_dec').val('');
				$('#itemname_dec').val('');
				$('#itemid_dec').val('');
				$('#godown_dec').val('');
				$('#itemwt_dec').val(0);
				var batch = '';
				var isbatch = $('#isbatch').val();
				if(isbatch > 0 ){
					batch = $('#batch_dec').val();
				}
				$('#batch_dec').val('');

				addrowdec(itemid_dec,itemname_dec,itembarcode_dec,godown_dec,itemquantity_dec,itemwt_dec,stockrate_dec,stockvalue_dec,stocksrate_dec,godownname_dec,landing_cost_dec,batch,date,stockmrp_dec);
			}
	});
	$('#addinc').click(function(){
		var isdate = $('#isdate').val();
			var date = '';
			if(isdate > 0 ){
				date =  $('#date_inc').val();
			}
			var stockmrp_inc = $('#stockmrp_inc').val();

		var stockrate_inc = $('#stockrate_inc').val();
            var stockvalue_inc = $('#stockvalue_inc').val();
            var stocksrate_inc = $('#stocksrate_inc').val();
            var itemquantity_inc = $('#itemquantity_inc').val();
			var itembarcode_inc = $('#itembarcode_inc').val();
			var itemname_inc = $('#itemname_inc').val();
			var itemwt_inc = $('#itemwt_inc').val();
			var itemid_inc = $('#itemid_inc').val();
			var godown_inc = $('#godown_inc').val();
			var godownname_inc = $("#godown_inc option:selected").text();
			var landing_cost_inc = $('#landing_cost_inc').val();
			if(landing_cost_inc === ''){
				landing_cost_inc = 0;
			}
			var batch = '';
			var isbatch = $('#isbatch').val();
			if(isbatch > 0 ){
				batch = $('#batch_inc').val();
			}

			if(itemid_inc !== "" && godown_inc !=="" && parseFloat(itemquantity_inc) > 0  && godown_inc !== null && godown_inc !== 'null' ){
				$('#stockrate_inc').val(0);
				$('#itemwt_inc').val(0);
				$('#stockvalue_inc').val(0);
				$('#stockmrp_inc').val(0);
				if(isdate > 0 ){
					$('#date_inc').val('');
				}
				$('#stocksrate_inc').val(0);
				$('#itemquantity_inc').val(1);
				$('#batch_inc').val('');
				$('#itembarcode_inc').val('');
				$('#itemname_inc').val('');
				$('#itemid_inc').val('');
				$('#godown_inc').val('');
				addrowinc(itemid_inc,itemname_inc,itembarcode_inc,godown_inc,itemquantity_inc,itemwt_inc,stockrate_inc,stockvalue_inc,stocksrate_inc,godownname_inc,landing_cost_inc,batch,date,stockmrp_inc);
			}
	});
	
	$('#stockmrp_dec').keydown(function(e){
		var key = e.charCode || e.keyCode || 0;
        if (key === 13 || key === 9){
			var isdate = $('#isdate').val();
			var date = '';
			if(isdate > 0 ){
				date =  $('#date_dec').val();
			}
			var stockmrp_dec = $('#stockmrp_dec').val();
			var stockrate_dec = $('#stockrate_dec').val();
            var stockvalue_dec = $('#stockvalue_dec').val();
            var stocksrate_dec = $('#stocksrate_dec').val();
            var itemquantity_dec = $('#itemquantity_dec').val();
			var itembarcode_dec = $('#itembarcode_dec').val();
			var itemwt_dec = $('#itemwt_dec').val();
			var itemname_dec = $('#itemname_dec').val();
			var itemid_dec = $('#itemid_dec').val();
			var godown_dec = $('#godown_dec').val();
			var landing_cost_dec = $('#landing_cost_dec').val();
			if(landing_cost_dec === ''){
				landing_cost_dec = 0;
			}
			var godownname_dec = $("#godown_dec option:selected").text();
			if(itemid_dec !== "" && godown_dec !=="" && parseFloat(itemquantity_dec) > 0 && godown_dec !=="null" && godown_dec !== null){
				$('#stockrate_dec').val(0);
				$('#itemwt_dec').val(0);
				$('#date_dec').val('');
				$('#stockvalue_dec').val(0);
				$('#stockmrp_dec').val(0);
				$('#stocksrate_dec').val(0);
				$('#itemquantity_dec').val(1);
				$('#itembarcode_dec').val('');
				$('#itemname_dec').val('');
				$('#itemid_dec').val('');
				$('#godown_dec').val('');
				var batch = '';
				var isbatch = $('#isbatch').val();
				if(isbatch > 0 ){
					batch = $('#batch_dec').val();
				}
				$('#batch_dec').val('');
				addrowdec(itemid_dec,itemname_dec,itembarcode_dec,godown_dec,itemquantity_dec,itemwt_dec,stockrate_dec,stockvalue_dec,stocksrate_dec,godownname_dec,landing_cost_dec,batch,date,stockmrp_dec);
			}
		}
	});
	
	$('#stockmrp_inc').keydown(function(e){
		var key = e.charCode || e.keyCode || 0;
        if (key === 13 || key === 9){
			var isdate = $('#isdate').val();
			var date = '';
			if(isdate > 0 ){
				date =  $('#date_inc').val();
			}
			var stockmrp_inc = $('#stockmrp_inc').val();
			var stockrate_inc = $('#stockrate_inc').val();
            var stockvalue_inc = $('#stockvalue_inc').val();
            var stocksrate_inc = $('#stocksrate_inc').val();
            var itemquantity_inc = $('#itemquantity_inc').val();
			var itembarcode_inc = $('#itembarcode_inc').val();
			var itemname_inc = $('#itemname_inc').val();
			var itemid_inc = $('#itemid_inc').val();
			var godown_inc = $('#godown_inc').val();
			var itemwt_inc = $('#itemwt_inc').val();
			var godownname_inc = $("#godown_inc option:selected").text();
			var landing_cost_inc = $('#landing_cost_inc').val();
			if(landing_cost_inc === ''){
				landing_cost_inc = 0;
			}
			if(itemid_inc !== "" && godown_inc !=="" && parseFloat(itemquantity_inc) > 0  && godown_inc !=="null" && godown_inc !==null){
				$('#stockrate_inc').val(0);
				$('#itemwt_inc').val(0);
				$('#stockmrp_inc').val(0);
				$('#stockvalue_inc').val(0);
				$('#date_inc').val('');
				$('#stocksrate_inc').val(0);
				$('#itemquantity_inc').val(1);
				$('#itembarcode_inc').val('');
				$('#itemname_inc').val('');
				$('#itemid_inc').val('');
				$('#godown_inc').val('');
				var batch = '';
				var isbatch = $('#isbatch').val();
				if(isbatch > 0 ){
					batch = $('#batch_inc').val();
				}
				$('#batch_inc').val('');
				addrowinc(itemid_inc,itemname_inc,itembarcode_inc,godown_inc,itemquantity_inc,itemwt_inc,stockrate_inc,stockvalue_inc,stocksrate_inc,godownname_inc,landing_cost_inc,batch,date,stockmrp_inc);
			}
		}
	});
	
	$.ajax({
        url: "<?php echo site_url('ajaxcall/godown'); ?>",
        success: function (result) {
            $('#godown_inc').html(result);
            $('#godown_dec').html(result);
        }
    });
	
	$("#itemname_dec").autocomplete({
        source: "<?php echo site_url('Stock_journal/itemssearch/name'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $('#stockrate_dec').val(ui.item.prate);
			$('#batch_dec').val(ui.item.batch);
            $('#landing_cost_dec').val(ui.item.landing_cost);
            $('#stockvalue_dec').val(ui.item.prate);
            $('#stocksrate_dec').val(ui.item.srate);
			$('#stockmrp_dec').val(ui.item.MRP);
            $('#itemquantity_dec').val(1);
			$('#itembarcode_dec').val(ui.item.barcode);
			$('#itemname_dec').val(ui.item.name);
			$('#itemid_dec').val(ui.item.id);
        }
      });
	  
	  $("#itemname_inc").autocomplete({
        source: "<?php echo site_url('Stock_journal/itemssearch/name'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $('#stockrate_inc').val(ui.item.prate);
			$('#batch_inc').val(ui.item.batch);
            $('#landing_cost_inc').val(ui.item.landing_cost);
            $('#stockvalue_inc').val(ui.item.prate);
			$('#stockmrp_inc').val(ui.item.MRP);
            $('#stocksrate_inc').val(ui.item.srate);
            $('#itemquantity_inc').val(1);
			$('#itembarcode_inc').val(ui.item.barcode);
			$('#itemname_inc').val(ui.item.name);
			$('#itemid_inc').val(ui.item.id);
			var totalstockvaldec = $('#totalstockvaldec').val();
			var ledgerAmount = $('#ledgerAmount').val();
			var tot_inc_qty = calculate_inc_quantity();
			tot_inc_qty = tot_inc_qty + 1;
			if(totalstockvaldec === ''){
				totalstockvaldec = 0;
			}
			if(ledgerAmount ===''){
				ledgerAmount = 0;
			}
			var total_stock_value = parseFloat(totalstockvaldec) + parseFloat(ledgerAmount);
			var single_unit_cost = 0;
			unit_cost = 0;
			if(parseFloat(total_stock_value) > 0  ){
				//var single_unit_cost = parseFloat(total_stock_value) / parseFloat(tot_inc_qty);
				unit_cost = total_stock_value;
			}
			$('#unit_cost_inc').val(unit_cost);
        }
      });
	  
	   $("#itembarcode_dec").autocomplete({
        source: "<?php echo site_url('Stock_journal/itemssearch/barcode'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $('#stockrate_dec').val(ui.item.prate);
			$('#batch_dec').val(ui.item.batch);
            $('#landing_cost_dec').val(ui.item.landing_cost);
            $('#stockvalue_dec').val(ui.item.prate);
            $('#stocksrate_dec').val(ui.item.srate);
            $('#itemquantity_dec').val(1);
			$('#itembarcode_dec').val(ui.item.barcode);
			$('#itemname_dec').val(ui.item.name);
			$('#itemid_dec').val(ui.item.id);
        }
      });
	  
	   $("#itembarcode_inc").autocomplete({
        source: "<?php echo site_url('Stock_journal/itemssearch/barcode'); ?>",
        minLength: 2,
        select: function (event, ui) {
			$('#stockrate_inc').val(ui.item.prate);
            $('#landing_cost_inc').val(ui.item.landing_cost);
            $('#stockvalue_inc').val(ui.item.prate);
			$('#batch_inc').val(ui.item.batch);
            $('#stocksrate_inc').val(ui.item.srate);
            $('#itemquantity_inc').val(1);
			$('#itembarcode_inc').val(ui.item.barcode);
			$('#itemname_inc').val(ui.item.name);
			$('#itemid_inc').val(ui.item.id);
            
        }
      });
	  load();
});

  

</script>