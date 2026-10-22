<?php
	$customer_text = 'To Customer';
	if($type == 'in'){
		$customer_text = 'From Customer';
	}
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form id="form_jobcard" action="<?php echo site_url('Jobcard/save') ?>" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
	<input type="hidden" name="type" id="type" value="<?php echo $type;?>"/>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Job Card ', $this, $user) ?><?php echo $type;?></h3>
						<span class="pull-right">
                        <a role="button" back="<?php echo site_url('Jobcard/list_all/'.$type); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Jobcard/list_all/'.$type); ?>">
                            <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                        </a>
						</span>
						<table style="width'100%"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
									<td class="col-sm-3">
                                        <?= label('Date', $this, $user) ?>
                                        <input type="text" class="form-control date" name="date" id="date" >
                                    </td>
									 <td class="col-sm-3">
										<?= label($customer_text, $this, $user) ?>
										<input type="hidden" name="customer_id" id="customer_id"/>
                                        <input data-validation="required" type="text" noTab="true" class="form-control" name="customer" id="customer" >
									</td> 
									<td class="col-sm-3">
                                        <?= label('Due Date', $this, $user) ?>
                                        <input type="text" class="form-control date" name="due_date" id="due_date" >
                                    </td>
									<td class="col-sm-3">
										<?= label('Branch', $this, $user) ?> 
										<select id="branch"  class="form-control" name="branch">
											<option value="">All</option>
										</select>    
									</td>
                                </tr>
								<tr>
									<td class="col-sm-3">
                                        <?= label('Reference', $this, $user) ?>
                                        <input type="text" class="form-control" name="reference" id="reference" >
                                    </td>
									 <td class="col-sm-3">
										<?= label('Despatch through', $this, $user) ?>
                                        <input type="text" noTab="true" class="form-control" name="despatch" id="despatch" >
									</td> 
									<td class="col-sm-3">
                                        <?= label('Location', $this, $user) ?>
                                        <input type="text" noTab="true" class="form-control" name="location" id="location" >
                                    </td>
									<td class="col-sm-3">
                                        <?= label('Vehicle No', $this, $user) ?>
                                        <input type="text" noTab="true" class="form-control" name="vehicle" id="vehicle" >
                                    </td>
                                </tr>
								<tr>
									<td class="col-sm-3">
                                        <?= label('To Godown', $this, $user) ?>
                                        <select data-validation="required" id="godown"  class="form-control" name="godown">
											<option value="">Select</select>
										</select>     
                                    </td>
									 
                                </tr>
                            </tbody>
                        </table> 
                       <p><b><label style="font-size:18px;" id="voucher_no"><?php echo $invoice;?></label></b></p>
				   </div>
                    <!-- /.box-header -->
                    
                        
                        <br/> 
						<div class="box-body">
							<div class="row">
                            <div class="col-sm-6 ">

                                <table class=table id="product_table">
                                    <thead>
                                        <th class="col-sm-7">Product</th>
										<th class="col-sm-2">Godown</th>
                                        <th class="col-sm-2">Qty</th>
                                        <th class="col-sm-1"></th>
                                    </thead>
                                    <tbody id=add_row>
                                        <tr>
                                            <td>
                                            <!-- Toatl quantity of product is taken from  the table bill of material to calculate the material quantity for one product -->
                                                <input id="product_quantity" class="form-control"  type="hidden"> 
                                                <input id="productid" class="form-control"  type="hidden">
												<input id="item_id" class="form-control"  type="hidden">
                                                <input id="product" placeholder="Item" class="form-control" NoTab ="true" type="text">
                                            </td>
											<td>
												<select id="from_godown" class="form-control" >
													
												</select>
											</td>
                                            <td>
                                                <input id="quantity" placeholder="Nos" class="form-control calcrow "  type="text">
                                            </td>
                                          
                                            <td>
                                               <a data-toggle="tooltip" style="float: left" title="Add More" id="addmore" class="addmore btn btn-success"> <span class="glyphicon glyphicon-plus"></span>
                                               </a>
                                             </td>
                                           
                                        </tr>
                                    </tbody>
									
                                </table>
                            </div>

                         <div  class="col-sm-6 ">
                            <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Sub Material</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">

                                        </div>

 

                                        </div>

                             </div>

                        </div>

                     </div>
					</div>
					 <div class="box-footer">
                        <button  id="btnjobcard" type='button' data-toggle="tooltip" title='Save' class='btn btn-warning'> <i class="glyphicon glyphicon-hdd"></i> </button>
						<button style ="display:none;" id="form-button-save" type="submit" data-toggle="tooltip" title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>
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
	$(document).on('click', '#btnjobcard', function() {
		var cnt = 0 ;
		event.preventDefault();
		$( ".product_ids" ).each(function() {
			cnt = cnt + 1;
		});
		if(parseFloat(cnt) >0  && parseFloat(cnt_sj) < 1 ){
			$("#form_jobcard").validate(); 
			isValid = $("#form_jobcard").isValid();
			if (isValid) {
				$('#form-button-save').trigger('click');
				cnt_sj = cnt_sj + 1;
			}
		}else if( parseFloat(cnt_sj) > 0 ){
		
		}else{
			calert('Please Select Products');
		}
		
	});
	function load(){
		var id = $('#id').val();
		if(parseFloat(id) > 0 ){
			$.ajax({
				url: "<?php echo site_url('Jobcard/getjobcard/'); ?>"+id,
				async:false,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
						$('#date').val(itemsingle.voucher_date);
						$('#customer_id').val(itemsingle.customer_id);
						$('#customer').val(itemsingle.customer_name);
						$('#due_date').val(itemsingle.voucher_due_date);
						$('#branch').val(itemsingle.branch_id);
						$('#reference').val(itemsingle.ref_no);
						$('#despatch').val(itemsingle.despatch_through);
						$('#location').val(itemsingle.location);
						$('#vehicle').val(itemsingle.vehicle_no);
						$('#godown').val(itemsingle.to_godown);
						$('#voucher_no').html(itemsingle.voucher_no);
                    });
                }
            });
			
			$.ajax({
				url: "<?php echo site_url('Jobcard/getjobcard_items/'); ?>"+id,
				async:false,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
						idinc=idinc+1;
						product_row(idinc,itemsingle.name,itemsingle.quantity,idinc,itemsingle.id,itemsingle.godown,itemsingle.godown_name,itemsingle.item_id);
						addAccordion(itemsingle.name,idinc)
						$.ajax({
							url: "<?php echo site_url('Jobcard/getjobcard_items_material/'); ?>"+itemsingle.id,
							async:false,
							success: function(result) {
								$.each(JSON.parse(result), function(i, items) {
									var total = items.rate * items.quantity;
									materiallist(items.name,items.material_id,items.quantity,total,idinc,items.rate,idinc,items.id,items.godown_id,items.godown_name,itemsingle.quantity);
								});
							}
						});
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
        
	$(document).on('change', '.mat_price,.mat_quantity', function() {
				var count = $(this).attr("count");
                var mat_quantity = $('#mat_quantity'+count+'').val();
                var mat_price = $('#mat_price'+count+'').val();
                if(mat_quantity !== undefined && mat_quantity !== null){ 
                  var row_total = (parseFloat(mat_quantity) * parseFloat(mat_price)).toFixed(2);
                  $('#mat_total'+count+'').val(row_total);
                }
                var attrprod = $(this).attr('attrprod');
				
				var mat_tbl =  $('.clsmaterial'+attrprod);
				var mat_total = 0;
				mat_tbl.each(function(index, items) {
                    mat_total = (parseFloat(mat_total) + parseFloat($(items).val())).toFixed(2);
					$('#material_total'+attrprod).val(mat_total);
                });
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
	
	function materiallist(material,materialid,quantity,total,k,Price,productid,material_table_id,godown='',godown_name='',product_quantity = 0) {
          rawmaterial_count = rawmaterial_count + 1;
		  var  row = '<tr>'+
                '<td><input  class="form-control" name="material_table_id'+idinc+'[]" type="hidden" value="' + material_table_id + '">'+
                '<input  class="form-control" name="sub_product_id'+idinc+'[]" type="hidden" value="' + productid + '">'+
                '<input  class="form-control" name="material_id'+idinc+'[]" type="hidden"value="' + materialid + '">' +
                ' <input  placeholder="Item" class="form-control" name="material" type="text" value="' + material + '" disabled>  </td>' +
                '<td> <select attrprod='+idinc+' data-validation="required" class="form-control mat_godown" name="material_godown'+idinc+'[]" count="'+rawmaterial_count+'" id="mat_godown'+rawmaterial_count+'" >'+txtgodown+'</select>  </td>' +
				'<td> <input attrprod='+idinc+'  attrquantity= '+product_quantity+' placeholder="Nos" class="form-control mat_quantity'+idinc+' mat_quantity" name="material_quantity'+idinc+'[]" count="'+rawmaterial_count+'" id="mat_quantity'+rawmaterial_count+'"   type="text"value="' + quantity + '"> </td>' +
                '<td> <input attrprod='+idinc+'  placeholder="Nos" class="form-control mat_price" name="material_price'+idinc+'[]" count="'+ rawmaterial_count+'"  id="mat_price'+rawmaterial_count+'"  type="text"value="' + Price + '"> </td>' +
                '<td> <input attrprod='+idinc+'  class="cls_sub'+idinc+' form-control clsmaterial'+idinc+' sum"  name="material_row_total'+idinc+'[]" type="text" id="mat_total'+rawmaterial_count+'" count="'+ rawmaterial_count+'"  value="' + total + '"> </td>' +
                '</tr> ';
            $('#tbody_material'+idinc+'').append(row);
			$('#mat_godown'+rawmaterial_count).val(godown);
			$('.mat_quantity'+idinc).trigger('change');
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
            url: "<?php echo site_url('ajaxcall/branch'); ?>",
            success: function (result) {
                $('#branch').html(result);
                
               
            }
        });
		
		 $("#customer").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);

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
		
		 $('#addmore').click(function() {
		   var item_id = $('#item_id').val();
           var product = $('#product').val();
           var productid = $('#productid').val();
           var quantity = $('#quantity').val();
		   var godown = $('#from_godown').val();
		   var godown_name = $("#from_godown option:selected").text();
            if (product && productid && quantity) {
                idinc=idinc+1;
				product_row(productid,product,quantity,productid,0,godown,godown_name,item_id);
				$('#productid').val("");
				$('#product').val("");
				$('#quantity').val("");
				$('#product').focus();

            $.ajax({
                url: "<?php echo site_url('Jobcard/getMaterialList/') ?>" +  productid,
                async:false,
                success: function(result) {
                    data = JSON.parse(result)
                   
                    addAccordion(product,idinc)
                    $.each(data, function(i, item) {
                            
                            let material_quantity= item.quantity
                            let material_price = item.price
                            let product_quantity = $('#product_quantity').val();
                            let quantity_for_one_product = parseFloat( material_quantity)/parseFloat(product_quantity)
                            let quantity_for_n_products = (parseFloat(quantity_for_one_product)* parseFloat(quantity)).toFixed(2)
                            let total_price = (parseFloat(material_price) * parseFloat( quantity_for_n_products)).toFixed(2)
                            materiallist(item.name,item.materialid , quantity_for_n_products ,total_price,productid, material_price,productid,material_table_id,'',0,quantity)
                      

                    })
                   
                  

                   
                }
            });



            }
        });
		load();

    });


</script>  