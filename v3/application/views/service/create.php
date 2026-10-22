<?php
$cost_centre = $settings[0]['is_costcenter'];

?> 
<style>
	.sma{
		width:100px;
	}
	</style>
<form method="post"  id="frmcreate" back="<?php echo site_url('Services/listall'); ?>" action="<?php echo site_url('Services/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="" name="invoice_no" id="invoice_no" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Services', $this, $user) ?> Create</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('Services/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Services/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12" style="margin-bottom:30px;">
						    <?php if ($cost_centre == '1') { ?>
								<div class="col-sm-2  odd_cls">
									<label style="text-align:left" class="col-sm-12 control-label" >
										<?= label('Cost Center', $this, $user) ?> *<span class="required"></span> 
									</label>
									<div class="col-sm-12" >
										<select id="Costcenter" class="form-control" name="Costcenter">
                                            <option value="">Select</option>
                                        </select>
									</div>
								</div>
							 <?php } ?>
                            <div class="col-sm-2  odd_cls">
                                <label style="text-align:left" class="col-sm-12 control-label" >
                                    <?= label('Date', $this, $user) ?> *<span class="required"></span> 
                                </label>
                                <div class="col-sm-12" >
                                    <input  id="date" class="form-control date" name="date" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>
                             <div class="col-sm-2  odd_cls">
                                <label style="text-align:left" class="col-sm-12 control-label" >
                                    <?= label('Bill Type', $this, $user) ?> *<span class="required"></span> 
                                </label>
                                <div class="col-sm-12" >
                                     <select id="btype" name="btype" class="form-control ">
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-2  odd_cls">
                                <label style="text-align:left" class="col-sm-12 control-label" >
                                    <?= label('Cash/Credit', $this, $user) ?> *<span class="required"></span> 
                                </label>
                                <div class="col-sm-12" >
                                     <select id="cash_type" name="cash_type" class="form-control ">
										<option value="cash">Cash</option>
										<option value="credit">Credit</option>
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-2  odd_cls">
                                <label style="text-align:left" class="col-sm-12 control-label" >
                                    <?= label('Customer', $this, $user) ?> *<span class="required"></span> 
                                </label>
                                <div class="col-sm-12" >
									 <input name="cusname"   id="cusname" type="text" NoTab="true"    data-validation="required"   class="form-control" placeholder="<?= label('Customer', $this, $user) ?>">
                                </div>
                            </div>
							<div class="col-sm-2  odd_cls">
                                <label style="text-align:left" class="col-sm-12 control-label" >
                                    <?= label('Quataion No', $this, $user) ?> *<span class="required"></span> 
                                </label>
                                <div class="col-sm-12" >
                                    <input data-validation="required" type="hidden" name="customer_id" id="customer_id"/>
									 <select name="quatation_no"   id="quatation_no" type="text" NoTab="true"    data-validation="required"   class="form-control" placeholder="<?= label('Quatation no', $this, $user) ?>">
									 </select>
                                </div>
                            </div>
							<div class="  odd_cls" style="padding:0px;">
                                <label style="text-align:left" class="col-sm-12 control-label" >
                                    <?= label('Cess', $this, $user) ?> <span class="required"></span> 
                                </label>
                                <div class="col-sm-12" >
                                    <input onclick="calculateGtotal()" type="checkbox" name="is_ces"  id="is_ces">
                                </div>
                            </div>
                        </div>
						<p style ="margin-left:30px;font-size:bold;"><span style="display:none;" id="invoice"></span></p>
						   <p>
								<span class="new-invoice" >
								<label spellcheck="false" id="prefix">
								</label><label spellcheck="false" id="sep_first"></label>
								<label class="two-digits price" ondblclick="changeinvoice()" NoTab="true" spellcheck="false" id="b_no">
								</label><label spellcheck="false" id="sep_second"></label><label spellcheck="false" id="suffix"></label></p>
                        <div class="col-sm-12 form-group  odd_cls">
                            <table class="table table-bordered">
                               <tr>
									<th class="col-sm-4">  <?= label('Select Item', $this, $user) ?></th>
									<th class="col-sm-1">  <?= label('Quantity', $this, $user) ?></th>
									<th class="col-sm-2">  <?= label('Sales Rate', $this, $user) ?></th>
									<th class="col-sm-1"><?= label('Tax% ', $this, $user) ?></th>
									<th class="col-sm-1">  <?= label('Tax', $this, $user) ?></th>
									<th class="col-sm-2">  <?= label('Total', $this, $user) ?></th>
									<th class="col-sm-1">  <?= label('Add', $this, $user) ?></th>
							   </tr>
                                <tr>
                                    <td> 
                                        <input value="" id="product_id" class="form-control" name="product_id" type="hidden"> 
                                        <input  NoTab="true" id="product_name" class="form-control" name="product_name" type="text" value=""  placeholder="<?= label('Item Name', $this, $user) ?>" maxlength="250">
                                    </td> 
									<td>
                                        <input id="quantity" class="form-control two-digits" name="quantity" type="text" value=""  placeholder="<?= label('Quantity', $this, $user) ?>" maxlength="250">
									</td>
                                    <td>
                                        <input id="sales_rate" class="form-control two-digits" name="sales_rate" type="text" value=""  placeholder="<?= label('Sales Rate', $this, $user) ?>" maxlength="250">
                                    </td>
                                    <td>
                                       <select tabindex="-1" id="tax_item"  class="form-control " >
                                                    <option value="">Select</option> 
                                                </select>
                                    </td>
									<td>
                                        <input readonly="readonly" id="tax_amount" class="form-control two-digits" name="tax_amount" type="text" value=""  placeholder="<?= label('Tax Amount', $this, $user) ?>" maxlength="250">
                                    </td>
									<td>
                                        <input readonly="readonly" id="total" class="form-control two-digits" name="total" type="text" value=""  placeholder="<?= label('Total', $this, $user) ?>" maxlength="250">
                                    </td>
                                    <td> 
                                        <button data-toggle="tooltip" type="button"  id="addmore"  title="Add To save"   class="addmore btn btn-success" href="#">
                                            Add 
                                        </button>
                                    </td>
                               


                                </tr>
								<tbody id="addrow">
								</tbody>
								 <tr>
									<th class="col-sm-6" colspan="3">  &nbsp;</th>
									<th class="col-sm-2">&nbsp;</th>
									<th class="col-sm-1"> <input value="0" readonly type="text" class="form-control" id="g_tax" name="g_tax"> </th>
									<th class="col-sm-3" colspan="2">  <input value="0" readonly type="text" class="form-control" id="g_total" name="g_total"></th>
							   </tr>
							   <tr>
									<th class="col-sm-6" colspan="3">  &nbsp;</th>
									<th class="col-sm-3" colspan="2" style="text-align:center"> Cess Amount </th>
									<th class="col-sm-3" colspan="2">  <input value="0" readonly type="text" class="form-control" id="g_ces" name="g_ces"></th>
							   </tr>
							    <tr>
									<th class="col-sm-6" colspan="3">  &nbsp;</th>
									<th class="col-sm-3" colspan="2" style="text-align:center"> Grand Total </th>
									<th class="col-sm-3" colspan="2">  <input value="0" readonly type="text" class="form-control" id="net_total" name="net_total"></th>
							   </tr>
                            </table>
								
                        </div>
                        

                        <!-- /.box -->
                    </div>
                    <div class="box-footer" class="col-sm-12">
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- /.row -->
    </section>
    <script type="text/javascript">
	 function changeinvoice() {
        document.getElementById("b_no").contentEditable = true;
    }
	function loadquatationbyid(id,qtn=""){
		$.ajax({
            url: "<?php echo site_url('Proposal/quatation/'); ?>"+id,
            success: function(result) {
                $('#quatation_no').html(result);
				if(qtn!==''){
					$('#quatation_no').val(qtn);
				}
				
            }
			});
	}
	var idinc = 0;
	function remove(btn){
		$(btn).closest('tr').remove();
		calculateGtotal();
	}
	
	function calculateGtotal(){
		var tax=0;
		var total = 0;
		 $( ".clstax" ).each(function() {
			var amount =$( this ).val();
			tax = parseFloat(tax)+parseFloat(amount);
		});
		$( ".clstotal" ).each(function() {
			var amount =$( this ).val();
			total = parseFloat(total)+parseFloat(amount);
		});
		var tot_ces = 0;
		var is_cess = $('#is_ces').prop('checked');
		if(is_cess){
			$( ".clsces" ).each(function() {
				var amount =$( this ).val();
				tot_ces = parseFloat(tot_ces)+parseFloat(amount);
			});
		}
		var net_total = parseFloat(total)+parseFloat(tot_ces);
		$('#g_ces').val(tot_ces.toFixed(2));
		$('#net_total').val(net_total.toFixed(2));
		$('#g_total').val(total);
		$('#g_tax').val(tax);
	}
	
	 function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];
        return day + '/' + month + '/' + year;
    }
	function load(){
		var id  = $('#id').val();
		if(parseFloat(id) > 0 ){
				$.ajax({
                url: "<?php echo site_url('Services/getsing'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
						 $('#invoice').html(itemsingle.invoice);
						 $('#invoice').attr('style','display:block');
						 $('#Costcenter').val(itemsingle.cost_center);
						 $('#invoice_no').val(itemsingle.invoice);
						 $('#btype').val(itemsingle.bill_type);
						 $('#cash_type').val(itemsingle.cash_type);
						 $('#customer_id').val(itemsingle.customer_id);
						 loadquatationbyid(itemsingle.customer_id,itemsingle.quatation_no);
						 if(parseFloat(itemsingle.is_ces) > 0 ){
							 $("#is_ces").attr("checked", true);
						  }
						 $('#cusname').val(itemsingle.supplier);
						 $('#date').val(itemsingle.dates);
						 $('#quatation_no').val(itemsingle.quatation_no);
						 $('#tax_item').val(itemsingle.tax_id);
						  var tax_name = $("#tax_item option:selected").text();
						 addrow(itemsingle.name,itemsingle.description,itemsingle.amount,itemsingle.tax_id,itemsingle.tax,itemsingle.total,tax_name,itemsingle.quantity);
                    });
                }
            });
		}
	}
	function setbillno(id){
	     id = $('#btype').val();
		 $.ajax({
                url: "<?php echo site_url('Services/getinvoiceno'); ?>/" + id,
                success: function (result) {
                   $('#invoice').html(result);
                   $('#invoice_no').val(result);
					var suffix = $('#btype').find(':selected').attr('suffix');
					var prefix = $('#btype').find(':selected').attr('preffix');
					var seperator = $('#btype').find(':selected').attr('seperator');
					var  newinvoice =  prefix + seperator + result+seperator+suffix;
					$('#prefix').html(prefix);
					$('#sep_first').html(seperator);
					$('#b_no').html(result);
					$('#sep_second').html(seperator);
					$('#suffix').html(suffix);
					$('#invoice_no').val(newinvoice);
                }
            });
	}
	function calculaterow(id){
		var sales_rate = $('#item_salerate'+id).val();
		var quantity = $('#item_quantity'+id).val();
		sales_rate = sales_rate * quantity;
		var taxname = $('#item_tax_item'+id).val();
		var tax_amount = 0 ;
		var total = sales_rate;
		if(taxname !== undefined  ){
			if(parseFloat(taxname) >  0 &&  sales_rate > 0 ){
				tax_amount = sales_rate * taxname /100;
			}
		}
		total = parseFloat(total) + parseFloat(tax_amount);
		$('#item_taxamount'+id).val(tax_amount);
		$('#item_total'+id).val(total);
		var cess = 0 ;
		if(total !== "" && total !== undefined){
			if(parseFloat(total) > 0 ){
				cess = parseFloat(sales_rate)*1/100;
			}
		}
		
		cess = cess.toFixed(2);
		$('#cesamt'+id).val(cess);
		calculateGtotal();
	}
	function addrow(item,product_id,sales_rate,tax_item,tax_amount,total,tax_name,quantity){
		var cess = 0 ;
		var tot = sales_rate*quantity;
		if(total !== "" && total !== undefined){
			if(parseFloat(total) > 0 ){
				cess = parseFloat(tot)*1/100;
			}
		}
		cess = cess.toFixed(2);
		idinc = idinc + 1;
		var text = '<td class="col-sm-4"><input value="'+cess+'" class="clsces" type="hidden" name="cesamt[]" id="cesamt'+idinc+'"><input type="hidden" value="'+product_id+'" name="item_ids[]"><input type="text" class="form-control" value="'+item+'"></td>';
		text = text + '<td class="col-sm-1"> <input value="'+quantity+'" onchange="calculaterow('+idinc+')" class="form-control" type="text" name="item_quantity[]" id="item_quantity'+idinc+'" ></td>';
		text = text + '<td class="col-sm-2"> <input value="'+sales_rate+'" onchange="calculaterow('+idinc+')" class="form-control" type="text" name="item_salerate[]" id="item_salerate'+idinc+'" ></td>';
		text = text + '<td class="col-sm-1"><input  readonly="readonly" type="hidden" name="tax_ids[]" value="'+tax_item+'"> <input readonly value="'+tax_name+'"  class="form-control" type="text" name="item_tax_item" id="item_tax_item'+idinc+'" ></td>';
		text = text + '<td class="col-sm-2"> <input readonly="readonly" value="'+tax_amount+'" class="form-control clstax" type="text" name="item_taxamount[]" id="item_taxamount'+idinc+'" ></td>';
		text = text + '<td class="col-sm-2"> <input readonly="readonly" value="'+total+'"  class="form-control clstotal" type="text" name="item_total[]" id="item_total'+idinc+'" ></td>';
		text =text + '<td><span data-toggle="tooltip"   title="Remove" onclick="remove(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
		text = '<tr>'+text+'<tr/>';
		$('#addrow').append(text);
		$('#product_name').focus();
				calculateGtotal();

	}

	
	$(document).on('change', '#sales_rate,#tax_item,#quantity', function(){
					var tax_name = $("#tax_item option:selected").text();
					var srate = $('#sales_rate').val();
					var quantity = $('#quantity').val();
					srate = srate*quantity;
					var tax_amount = 0;
					if(tax_name !== ""  && tax_name!== undefined){
						if(parseFloat(tax_name) > 0 && parseFloat(srate) > 0){
							tax_amount = srate * tax_name/100;
						}
					}
					$('#tax_amount').val(parseFloat(tax_amount).toFixed(2));
					var total =  parseFloat(srate) + parseFloat(tax_amount);
					$('#total').val(parseFloat(total).toFixed(2));
	});
		$(document).ready(function() {
			$.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function(result) {
                $('#Costcenter').html(result);
            }
			});
			 $('.new-invoice').on('DOMFocusOut', function () {
					var result = $('#b_no').text();
					var suffix = $('#btype').find(':selected').attr('suffix');
					var prefix = $('#btype').find(':selected').attr('preffix');
					var seperator = $('#btype').find(':selected').attr('seperator');  
					var  newinvoice =  prefix + seperator + result+seperator+suffix;
					$('#invoice_no').val(newinvoice);

			});
			$('#cusname').change(function(){
				var customer_id = $('#customer_id').val();
				if(customer_id === "" || customer_id === undefined || customer_id === null){
					$('#cusname').val('');
				}else if (parseFloat(customer_id) < 1 ){
					$('#cusname').val('');
				}
			});
			
			$('#tax_item').keydown(function(e){
				 var key = e.charCode || e.keyCode || 0;
				 if(key === 9 || key === 13){
					$('.addmore').trigger('click');
				  }
			});
			$('.addmore').click(function(){
				var item = $('#product_name').val();
				var product_id = $('#product_id').val();
				var sales_rate = $('#sales_rate').val();
				var tax_item = $('#tax_item').val();
				var tax_amount = $('#tax_amount').val();
				var tax_name = $("#tax_item option:selected").text();
				var total = $('#total').val();
				var quantity = $('#quantity').val();
				if(product_id !== "" && product_id !== 0  && total > 0  && parseFloat(quantity) > 0){
					$('#product_id').val(0);
					$('#product_name').val('');
					$('#sales_rate').val(0);
					$('#tax_amount').val(0);
					$('#total').val(0);
					addrow(item,product_id,sales_rate,tax_item,tax_amount,total,tax_name,quantity);
				}
			});
			$.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/service'); ?>",
            success: function(result) {
                $('#btype').html(result);
				var billtype = $('#btype').val();
				var id = $('#id').val();
				if(parseFloat(id) < 1){
					setbillno(billtype);
				}
				load();
            }
			});
			
			$("#cusname").autocomplete({
				source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
				minLength: 2,
				select: function (event, ui) {
				$('#customer_id').val(ui.item.id);
               loadquatationbyid(ui.item.id);
            }
			});
			$.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function (result) {
                $('#tax_item').html(result);
            }
			});
			
			 $("#product_name").autocomplete({
                source: "<?php echo site_url('Services/itemsearch'); ?>",
                minLength: 2,
                select: function (event, ui) {
					$('#product_id').val(ui.item.id);
					$('#sales_rate').val(ui.item.srate);
					$('#tax_item').val(ui.item.tax_id);
					$('#quantity').val(1);
					var tax_name = $("#tax_item option:selected").text();
					var tax_amount = 0;
					if(tax_name !== ""  && tax_name!== undefined){
						if(parseFloat(tax_name) > 0 && parseFloat(ui.item.srate) > 0){
							tax_amount = ui.item.srate * tax_name/100;
						}
					}
					$('#tax_amount').val(tax_amount);
					var total =  parseFloat(ui.item.srate) + parseFloat(tax_amount);
					$('#total').val(total);
					$('#quantity').focus();
                }
            });
		});
	
    </script> 