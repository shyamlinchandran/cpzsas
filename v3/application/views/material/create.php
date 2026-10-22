<?php
	$customer_text = 'To Customer';
	$godown_text = 'Destination  Godown';
	if($type == 'in'){
		$customer_text = 'From Customer';
		$godown_text = 'consumption Godown';
	}
	$placeholder = 'Select Job Card ';
	if((float) $job_card_id > 0 ){
		$placeholder  = $job_voucher_no;
	}
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form id="form_material" action="<?php echo site_url('Material/save') ?>" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
	<input type="hidden" name="job_card_id" id="job_card_id" value="<?php echo $job_card_id;?>"/>
	<input type="hidden" name="type" id="type" value="<?php echo $type;?>"/>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Material Card ', $this, $user) ?><?php echo $type;?></h3>
						<table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
									<td class="col-sm-3">
                                        <?= label('Date', $this, $user) ?>
                                        <input type="text" class="form-control date" name="date" id="date" >
                                    </td>
									 <td class="col-sm-3">
										<?= label($customer_text, $this, $user) ?>
										<input type="hidden" name="customer_id" id="customer_id"/>
                                        <input type="text" noTab="true" class="form-control" name="customer" id="customer" >
									</td> 
									 <td class="col-sm-3">
										<?= label('Reference', $this, $user) ?>
                                        <input type="text" noTab="true" class="form-control" name="ref_no" id="ref_no" >
									</td> 
									
									<td class="col-sm-3">
										<?= label('Stock ', $this, $user) ?> 
										<select id="stock"  class="form-control" name="stock">
											<option value="our_stock">Our Stock</option>
											<option value="third_party">Third Party Stock</option>
										</select>    
									</td>
									
                                </tr>
								<tr>
									<td class="col-sm-3">
                                        <?= label('Eway Bill No', $this, $user) ?>
                                        <input type="text" noTab="true" class="form-control" name="eway_no" id="eway_no" >
                                    </td>
									<td class="col-sm-3">
                                        <?= label('Eway Date', $this, $user) ?>
                                        <input type="text" class="form-control date" name="eway_date" id="eway_date" >
                                    </td>
									<td class="col-sm-3">
                                        <?= label($godown_text, $this, $user) ?>
                                        <select id="godown"  class="form-control" name="godown">
											<option value="">Select</select>
										</select>     
                                    </td>
								</tr>
								
                            </tbody>
                        </table> 
                       <p><b><label style="font-size:18px;" id="voucher_no"><?php echo $invoice;?></label></b></p>
                    <!-- /.box-header -->
                    
                        
                        <br/> 
						<div class="box-body">
							<div class="row">
								<input style="padding:left:40px;height:40px;width:200px" type="text" name="job_card" id="job_card" class="form-control" placeholder="<?php echo $job_voucher_no;?>"/>
								<table  style="padding:left:40px;width:100%;" class="table <?=$this->table_color?>" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td>
												<label>Barcode</label>
											</td>
											<td>
												<label>Name</label>
											</td>
											<td>
												<label>Godown</label>
											</td>
											<td>
												<label>Quantity</label>
											</td>
											<td>
												<label>Rate</label>
											</td>
											<td>
												<label>Value</label>
											</td>
										</tr>
									</thead>
									<tr>
										<td colspan="6" style="text-align:center">Select Job Card From Above</td>
									</tr>
									<tbody id="addrow">
									</tbody>
									<tr>
											<td>
											</td>
											<td>
											</td>
											<td>
											</td>
											<td>
											</td>
											<td>
												<label>Total</label>
											</td>
											<td>
												<label><input type="text" name="total" id="total" readonly value="0" class="form-control"></label>
											</td>
										</tr>
								</table>
							</div>
					</div>
					 <div class="box-footer">
                        <button  id="btnmaterial" type='button' data-toggle="tooltip" title='Save' class='btn btn-warning'> <i class="glyphicon glyphicon-hdd"></i> </button>
						<button  style ="display:none;" id="form-button-save" type="submit" data-toggle="tooltip" title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>

<script type="text/javascript">
	var cnt_sj = 0;
	$(document).on('click', '#btnmaterial', function() {
		var cnt = 0 ;
		event.preventDefault();
		$( ".material_quantity" ).each(function() {
			cnt = cnt + 1;
		});
		if(parseFloat(cnt) >0  && parseFloat(cnt_sj) < 1 ){
			$("#form_material").validate(); 
			isValid = $("#form_material").isValid();
			if (isValid) {
				$('#form-button-save').trigger('click');
				cnt_sj = cnt_sj + 1;
			}
		}else if( parseFloat(cnt_sj) > 0 ){
		
		}else{
			calert('Please Select Job Card');
		}
		
	});
	var idinc = 0;
	function calculateGtotal(){
		var clspdt = $('.material_total');
		var total = 0 ;
		clspdt.each(function(index, item) {
			total = parseFloat(total)+parseFloat($(item).val());
        });
		$('#total').val(total);
	}
	function materiallist(material_id,name,barcode,godown_name,godown_id,quantity,rate,total,material_table_id=0,product_tbl_id){
		idinc = idinc + 1;
		var txt_raw = '<tr>';
		txt_raw = txt_raw + '<td><input type="hidden" value="'+product_tbl_id+'" name="product_tbl_id[]" class="form-control"><input type="hidden" value="'+material_table_id+'" name="material_table_id[]" class="form-control"><input type="hidden" value="'+material_id+'" name="material_id[]" class="form-control"><label>'+barcode+'</label></td><td><label>'+name+'</label></td>';
		txt_raw = txt_raw + '<td><input type="hidden" value="'+godown_id+'" name="material_godown[]"><label>'+godown_name+'</label></td>';
		txt_raw = txt_raw + '<td><input type="text" value="'+quantity+'" name="material_quantity[]" attr-index = '+idinc+' id="material_quantity'+idinc+'" class="material_quantity form-control" ></td>';
		txt_raw = txt_raw + '<td><input type="text" value="'+rate+'" name="material_rate[]" attr-index = '+idinc+' id="material_rate'+idinc+'" class="material_rate form-control" ></td>';
		txt_raw = txt_raw + '<td><input readonly value="'+total+'"  type="text" name="material_total[]" attr-index = '+idinc+' id="material_total'+idinc+'" class="material_total form-control" ></td>';
		txt_raw = txt_raw + '</tr>';
		$('#addrow').append(txt_raw);
		calculateGtotal()
	}
	function loadjob_card(id){
		$('#addrow').empty();
		$.ajax({
			url: "<?php echo site_url('Material/getjobcard_items_material/'); ?>"+id,
			async:false,
			success: function(result) {
				$.each(JSON.parse(result), function(i, items) {
					var total = items.rate * items.quantity;
					materiallist(items.material_id,items.name,items.barcode,items.godown_name,items.godown_id,items.quantity,items.rate,total,0,items.job_work_order_item_id);
				});
			}
		});
	}
	function load(){
		var id = $('#id').val();
		if(parseFloat(id) > 0 ){
			$.ajax({
				url: "<?php echo site_url('Material/getmaterial/'); ?>"+id,
				async:false,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
						$('#date').val(itemsingle.voucher_date);
						$('#customer_id').val(itemsingle.customer_id);
						$('#customer').val(itemsingle.customer_name);
						$('#eway_date').val(itemsingle.voucher_way_date);
						$('#ref_no').val(itemsingle.ref_no);
						$('#godown').val(itemsingle.godown);
						$('#voucher_no').html(itemsingle.voucher_no);
						$('#stock').val(itemsingle.stock_status);
						$('#eway_no').val(itemsingle.eway_no);
                    });
                }
            });
			
			$.ajax({
				url: "<?php echo site_url('Material/getmaterial_items/'); ?>"+id,
				async:false,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, items) {
						materiallist(items.item_id,items.name,items.barcode,items.godown_name,items.godown_id,items.quantity,items.rate,items.material_total,items.id,items.product_tbl_id);

                    });
                }
            });
		}
	}
	$(document).on('click', '.remove', function() {
            $('.tootip').remove();
            var id= $(this).attr("index")
            $(this).closest('tr').remove();
            $('#material_accordion'+id).remove()


        });
        
	$(document).on('change', '.material_quantity,.material_rate', function() {
		var attr = $(this).attr('attr-index');
		var material_quantity = $('#material_quantity'+attr).val();
		var material_rate = $('#material_rate'+attr).val();
		var total = parseFloat(material_quantity) * parseFloat(material_rate);
		$('#material_total'+attr).val(total);
		calculateGtotal();
	});
	$(document).on('change', '.productquantity ', function(e) {
		var attr_product = $(this).attr('attr_product');
		var quantity = $(this).val();
		var clspdt = $('.mat_quantity'+attr_product);
		clspdt.each(function(index, item) {
			var mat_quantity = $(item).val();
			var product_quantity = $(item).attr('attrquantity');
			var unit_mat_quantity = parseFloat(mat_quantity) / parseFloat(product_quantity);
			var new_mat_quantity = parseFloat(quantity) * parseFloat(unit_mat_quantity);
			$(item).attr('attrquantity',quantity);
			$(item).val(new_mat_quantity);
			$(item).trigger('change');
        });
	 });
	 function calert(msg) {
        toastr["error"](msg);
    }	
	var rawmaterial_count = 0 ;
	var idinc = 0 ;
	var txtgodown = '';
    var table;
    var material_table_id=0;
	function addAccordion(product,productid) {
           var accordion='<div id="material_accordion'+productid+'"class="panel box"><div class="box-header with-border">'+
                '<h4 class="box-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne'+productid+'">'+ product +
                '</a></h4> </div><div id="collapseOne'+productid+'" class="panel-collapse collapse in">'+
                '<div class="box-body"><table class=table id="material_table'+productid+'"><thead><th class="col-sm-3">Material</th><th class="col-sm-3">Godown</th> <th class="col-sm-2">Quantity</th>'+ 
                '<th class="col-sm-2">Price</th><th class="col-sm-2">Total</th> </thead><tbody id="tbody_material'+idinc+'"></tbody><tr><td></td><td></td><td></td><td></td><td><input type="text" disabled class="form-control" id="material_total'+idinc+'"></td></tr></table></div></div></div>'
                $('#tab_1').append(accordion)

        }   
	function loadCust(ui) {
       $('#customer').val(ui.item.name);
       $('#customer_id').val(ui.item.id);
    }
	

	
	function product_row(productid,product,quantity,product_id,product_table_id,godown,godown_name,item_id){
		if(product_table_id === undefined){
			product_table_id = 0;
		}
        row = '<tr><td><input  class="form-control" name="products_godown_id[]" type="hidden" value="' + godown + '"><input  class="form-control" name="products_table_id[]" type="hidden" value="' + product_table_id + '">'+
              '<input type="hidden" value='+idinc+' id="product_index" name="product_index[]"><input class="item_ids" name="item_ids[]" value='+item_id+' type="hidden" ><input id="productid" class="form-control product_ids product_id'+idinc+'" name="product_id[]" type="hidden" value="' + productid + '"><input id="product"  class="form-control" name="material" type="text" value="' + product + '" disabled ></td>' +
              '<td> <input disabled  placeholder="'+godown_name+'" class="form-control"  type="text"  value="' + godown_name + '"></td>' +
			  '<td> <input  attr_product = '+idinc+' id="quantity" placeholder="Nos" class="form-control productquantity productquantity'+idinc+'" name="quantity[]" type="text"  value="' + quantity + '"></td>' +
			  '<td><span data-toggle="tooltip"   title="Remove"  index="'+ idinc +'" class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></td></td>'
              + '</tr>';

              $('#add_row').append(row)
    }
    $(document).ready(function () {
		$.ajax({
            url: "<?php echo site_url('ajaxcall/getgodown'); ?>",
			async:false,
            success: function (result) {
                $('#godown').html(result);
                $('#godown').prepend(
                        $('<option selected></option>').val("").html('All')
                        );
				$('#from_godown').html(result);		
				$('#from_godown').prepend(
                        $('<option selected></option>').val("").html('All')
                        );
				$('#to_godown').html(result);		
				$('#to_godown').prepend(
                        $('<option selected></option>').val("").html('All')
                        );
						txtgodown =  '<option value =""></option>'+result;
            }
        });
		
		$.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value="">Select</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#brand").html(option);
                
            }
        });
		
		 $("#customer").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);

            }
        });
		
		$("#job_card").autocomplete({
            source: "<?php echo site_url('Material/getjobcard/'.$type); ?>",
            minLength: 2,
            select: function (event, ui) {
				loadjob_card(ui.item.id);
				$('#job_card_id').val(ui.item.id);
				$("#job_card").attr('placeholder',ui.item.voucher_no);
            },close: function() {
				$("#job_card").val('');
				
			}
        });
		
		 $('#product').autocomplete({
            source: "<?php echo (site_url('Jobcard/productSearch')) ?>",
            select: function(event, ui) {
				var cls = $('.product_ids');
				var is_exist = 0;
				cls.each(function(index, item) {
                    if ( parseFloat($(item).val()) === parseFloat(ui.item.id) ){
						is_exist = is_exist + 1;
					}
                });
				if(parseFloat(is_exist) < 1 ){
					$('#productid').val(ui.item.id);
					$('#item_id').val(ui.item.item_id);
					$('#product_quantity').val(ui.item.quantity)
					$('#quantity').focus();
				}else{
					calert('Item Exist');
					$('#product').val('');
					$('#productid').val(0);
				}
            }
        });
		

		load();

    });


</script>  