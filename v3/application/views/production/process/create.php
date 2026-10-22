<form method="post" id="frmcreate" home="<?php echo site_url('production/process/process_controller/listall'); ?>" back="<?php echo site_url('production/process/process_controller/listall'); ?>" action="<?php echo site_url('production/process/process_controller/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('production/process/process_controller/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('production/process/process_controller/listall   '); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                        <table class="table table-condensed table-striped" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
									<td class="col-sm-2">
                                        <?= label('Voucher No', $this, $user) ?>
                                        <input disabled type="text" class="form-control " value="<?php echo $invoice;?>" id="" name="" />
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('Ref No:', $this, $user) ?>
                                        <input type="text" class="form-control " id="billno" name="bill_no" data-validation="required"/>
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('Date', $this, $user) ?>
                                        <input data-validation="required" type="text" class="form-control date" id="date" name="date"/> 
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('Status', $this, $user) ?>
                                        <select data-validation="required" class="form-control" name="status" id="status"  > </select>
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('User', $this, $user) ?>
                                        <select data-validation="required" class="form-control" id="user" name="user" > 
                                        <option value="">Select Country</option>

                                        </select>

                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('Search Bill', $this, $user) ?>
                                        <input value="" NoTab="true" type="text" class="form-control" id="search" name="search" />
                                    </td>
                                    <td class="col-sm-2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-sm-6 ">

                                <table class=table id="product_table">
                                    <thead>
                                        <th class="col-sm-3">Product</th>
										<th class="col-sm-1">Godown</th>
                                        <th class="col-sm-1">Qty</th>
                                        <th class="col-sm-1">Sale Rate</th>
                                        <th class="col-sm-1">MRP</th>
										 <th class="col-sm-2">U Cost</th>
                                        <th class="col-sm-2">Production Cost</th>
										 <?php
                                            if ($view != 'view') {
                                            ?>
                                                <th class="col-sm-1">
                                                    
                                                </th>
                                            <?php
                                            }
                                            ?>
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
												<select id="to_godown" class="form-control" >
													
												</select>
											</td>
                                            <td>
                                                <input id="quantity" placeholder="Nos" class="form-control calcrow "  type="text">
                                            </td>
                                            <td>
                                                <input id="sale_rate" class="form-control calcrow"  type="text" placeholder="Price ">
                                            </td>
                                            <td>
                                                <input id="mrp" class="form-control calcrow"  type="text" placeholder="MRP">
                                            </td>
											<td>
                                                <input id="unit_rate" class="form-control calcrow"  type="text" placeholder="U Cost">
                                            </td>
                                            <td>
                                                <input id="production_rate" class="form-control calcrow"  type="text" placeholder="Cost">
                                            </td>
                                           
                                            <?php
                                            if ($view != 'view') {
                                            ?>
                                                <td>
                                                    <a data-toggle="tooltip" style="float: left" title="Add More" id="addmore" class="addmore btn btn-success"> <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                </td>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
									
                                </table>
                            </div>

                         <div  class="col-sm-6 ">
                            <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li></li>
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Sub Material</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">Ledgers</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">

                                        </div>

                                        <div class="tab-pane" id="tab_2">
                                        </div>
                                        <div class="tab-pane" id="tab_3">
                                          
                                        </div>

                                        </div>

                             </div>

                        </div>

                     </div>
    <br>
                <hr>

                <div class="row">
                            <div style="display:none;" class="col-sm-6 ">

                                <table class=table id="ledger_table">
                                    <thead>
                                        <th>Ledger</th>
                                        <th>Amount</th>
                                    </thead>
                                    <tbody id=add_ledger_row>
                                        <tr>
                                            <td>
                                                <input id="ledgerid" class="form-control" name="ledgerid" type="hidden">
                                                <input id="ledger" placeholder="Item" class="form-control" name="ledger" NoTab="true" type="text">
                                            </td>
                                            <td>
                                                <input id="amount" placeholder="Amount" class="form-control calcrow " name="Amount" type="text">
                                            </td>
                                                <?php
                                                if ($view != 'view') {
                                                ?>
                                                <td>
                                                    <a data-toggle="tooltip" style="float: left" title="Add More" id="addmoreledger" class="btn btn-success addmoreledger"> <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                </td>
                                                <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                    <div class="box-footer">
                        <?php
                        if ($view != 'view') {
                        ?>

                            <button id="form-button-save" type="submit" data-toggle="tooltip" title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <div class="small-loading" id="FormLoading"> </div>

                        <?php  } ?>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
    </section>
</form>
<script>
	 function calert(msg) {
        toastr["error"](msg);
    }	
		var txtgodown = '';
	    var idinc=0;
        var idledger=0;
        var k=0;
        var j=0;
        var a=0;
       var sub_material_cost=0;
       var total_ledger_cost=0;
       var production_cost=0;
       var ledger_table_id =0;
       var product_table_id =0;
       var material_table_id =0;
       var addtnl_ledger_table_id =0;
	   
	  
	 function ledgerlist(ledger,ledgerid,amount,j,productid,ledger_table_id,single_rate = 0) {

            var  row = '<tr><td><input  class="form-control" name="ledger_table_id[]" type="hidden" value="' +ledger_table_id + '">'+
                '<input  class="form-control" name="sub_ledger_product_id[]" type="hidden" value="' + productid + '">'+
                '<input  class="form-control" name="ledger_id[]" type="hidden"value="' + ledgerid + '">' +
                ' <input id="material" placeholder="Item" class="form-control" name="material" type="text" value="' + ledger + '" disabled>  </td>' +
                '<td> <input single_rate = '+single_rate+'  attrprod='+idinc+' class="form-control led cls_sub'+idinc+' ledger_sum'+k+' " name="ledger_amount[]" type="text"value="' + amount + '"> </td>' +
                '</tr> '
            $('#tbodyledger'+j+'').append(row)
			
        }
		
	 $(document).on('keydown', '.autoledger', function() {
			var attr = $(this).attr('attr');
			$('.autoledger').autocomplete({
				source: "<?php echo (site_url('production/process/process_controller/ledgerSearch')) ?>",
				select: function(event, ui) {
					$('#ledgerid'+attr).val(ui.item.id)
					$('#amount'+attr).focus()

				}
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
        var clsledger = $('.cls_sub'+attr_product);
        clsledger.each(function(index, item) {
            var single_rate = $(this).attr('single_rate');
            var amount = quantity * single_rate;
            $(this).val(amount);
            $(item).trigger('change');
        });
	 });
	 $(document).on('keydown', '.amtitemledger ', function(e) {
			var attr = $(this).attr('attr');
			var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key ===9) {
				$('#addled'+attr).trigger('click');
			}
	});
		
	$(document).on('click', '.btnitemledger', function() {
		var attr = $(this).attr('attr');
		var productid = $('.product_id'+attr).val();
		var rowindex = $(this).attr('rowindex');
		var ledgerid = $('#ledgerid'+attr).val();
		var amount = $('#amount'+attr).val();
		var name = $('#ledger'+attr).val();
        var quantity = $('#quantity').val();

		if(ledgerid !== ''){
			if(parseFloat(ledgerid) > 0  ){
				$('#ledgerid'+attr).val(0);
				$('#ledger'+attr).val('');
				$('#amount'+attr).val(0);
                var single_rate = amount/quantity;
				ledgerlist(name,ledgerid,amount,rowindex,productid,0,single_rate);
				$('.led').trigger("change");
			}
		}
	});
    $(document).ready(function() {
		
		
		$.ajax({
            url: "<?php echo site_url('ajaxcall/getgodown'); ?>",
            success: function (result) {
                $('#to_godown').html(result);
                $('#to_godown').append(
                        $('<option></option>').val("").html('all')
                        );
				txtgodown =  '<option value =""></option>'+result;
            }
        });

        $.ajax({
            url: "<?php echo (site_url('production/process/process_controller/statusSearch')) ?>",
            success: function(result) {
                $('#status').html(result)

            }

        });
        $.ajax({
            url: "<?php echo (site_url('production/process/process_controller/userSearch')) ?>",
            success: function(result) {
                $('#user').html(result)

            }

        });
        $('#product').autocomplete({
            source: "<?php echo (site_url('production/process/process_controller/productSearch')) ?>",
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
					$('#sale_rate').val(ui.item.srate);
					$('#mrp').val(ui.item.MRP);
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
        $('#ledger').autocomplete({
            source: "<?php echo (site_url('production/process/process_controller/ledgerSearch')) ?>",
            select: function(event, ui) {
                $('#ledgerid').val(ui.item.id)
                $('#amount').focus()

            }
        });
		
       
        $('#addmore').click(function() {
		   var item_id = $('#item_id').val();
           var product = $('#product').val();
           var productid = $('#productid').val();
           var quantity = $('#quantity').val();
           var sale_rate = $('#sale_rate').val();
           var production_rate = $('#production_rate').val();
		   var godown = $('#to_godown').val();
		   var godown_name = $("#to_godown option:selected").text();
           var mrp = $('#mrp').val();
            if (product && productid && quantity && sale_rate) {
                idinc=idinc+1;
                 product_row(productid,product,quantity,sale_rate,mrp, production_rate,k,0,godown,godown_name,item_id);
            $('#productid').val("");
            $('#product').val("");
            $('#quantity').val("");
            $('#sale_rate').val("");
            $('#production_rate').val('');
            $('#mrp').val("");
            $('#product').focus();

            $.ajax({
                url: "<?php echo site_url('production/process/process_controller/getMaterialList/') ?>" +  productid,
                async:false,
                success: function(result) {
                    data = JSON.parse(result)
                   
                    addAccordion(product,k)
                    $.each(data, function(i, item) {
                            
                            let material_quantity= item.quantity
                            let material_price = item.price
                            let product_quantity = $('#product_quantity').val();
                            let quantity_for_one_product = parseFloat( material_quantity)/parseFloat(product_quantity)
                            let quantity_for_n_products = (parseFloat(quantity_for_one_product)* parseFloat(quantity)).toFixed(2)
                            let total_price = (parseFloat(material_price) * parseFloat( quantity_for_n_products)).toFixed(2)
                            materiallist(item.name,item.materialid , quantity_for_n_products ,total_price,k, material_price,productid,material_table_id,'',0,quantity)
                      

                    })
                   
                  
                    k++

                   
                }
            })

            $.ajax({
                    
                    url : "<?php echo site_url('production/process/process_controller/getLedgerList/')?>"+productid,
                    async:false,
                    success:function(result){
                          
                            data = JSON.parse(result)
                            addLedgerAccordion(product,j)
                            $.each(data,function(i,item){
                                let product_quantity = $('#product_quantity').val();
                                let single_rate = item.amount / product_quantity;
                                var amount = quantity * single_rate;
                                ledgerlist(item.name,item.ledgerid,amount,j,productid,material_table_id,single_rate)

                                
                            })
                            j++

                    }
                    
                })
                $('.mat_price').trigger('change');

            }
        });
       
        $('#production_rate').keydown(function (e){
                 if(e.keyCode == 13 || e.keyCode == 9){
                    $('.addmore').trigger("click");
                 }
            })
            $('#amount').keydown(function (e){
                 if(e.keyCode == 13 || e.keyCode == 9){
                    $('.addmoreledger').trigger("click");
             }
            })
        $(document).on('click', '.remove', function() {
            $('.tootip').remove();
            $(this).closest('tr').remove();
            var id= $(this).attr("index")
            $('#material_accordion'+id+'').remove()
            $('#ledger_accordion'+id+'').remove()


        });
        
        function addLedger_row(ledgerid ,ledger,amount,addtnl_ledger_table_id){
           var ledger_row=' <tr><td>'+
                            '<input id="ledgerid" class="form-control" name="addtnl_ledger_table_id[]" type="hidden"value="' + addtnl_ledger_table_id + '">'+
                             '<input id="ledgerid" class="form-control" name="adtnl_ledger_id[]" type="hidden"value="' + ledgerid + '">'+
                            '<input id="ledger" placeholder="Item" class="form-control" name="adtnl_ledger[]" type="text" value="' + ledger + '" disabled></td>'+
                            '<td><input id="amount" placeholder="Amount" class="form-control calcrow " name="adtnl_ledger_amount[]" type="text" value="' + amount + '"></td>'+
                        <?php
                        if ($view != 'view') {
                        ?>'<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove_ledger" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></td></td>' +                 
                            '</td>'+
                        <?php }?>+'</tr>'

                        $('#add_ledger_row').append(ledger_row)
                        $('#ledger').val("");
                        $('#ledgerid').val("");
                        $('#amount').val("");
                }
        
        function product_row(productid,product,quantity,sale_rate,mrp,production_rate,k,product_table_id,godown,godown_name,item_id){
					if(product_table_id === undefined){
						product_table_id = 0;
					}
					var unit_rate = parseFloat(production_rate) / parseFloat(quantity);
					unit_rate = parseFloat(unit_rate).toFixed(2);
                    row = '<tr><td><input  class="form-control" name="products_godown_id[]" type="hidden" value="' + godown + '"><input  class="form-control" name="products_table_id[]" type="hidden" value="' + product_table_id + '">'+
                        '<input class="item_ids" name="item_ids[]" value='+item_id+' type="hidden" ><input id="productid" class="form-control product_ids product_id'+idinc+'" name="product_id[]" type="hidden" value="' + productid + '"><input id="product"  class="form-control" name="material" type="text" value="' + product + '" disabled ></td>' +
                        '<td> <input disabled  placeholder="'+godown_name+'" class="form-control"  type="text"  value="' + godown_name + '"></td>' +
						'<td> <input  attr_product = '+idinc+' id="quantity" placeholder="Nos" class="form-control productquantity productquantity'+idinc+'" name="quantity[]" type="text"  value="' + quantity + '"></td>' +
                        '<td><input id="sale_rate" class="form-control calcrow" name="sale_rate[]" type="text"  value="' + sale_rate + '"></td>' +
                        '<td><input id="mrp" class="form-control calcrow" name="mrp[]" type="text" placeholder="MRP"  value="' + mrp + '"></td>'+
                        '<td><input readonly id="production_unit_rate'+ k+ '" class="form-control calcrow cls_unit_product'+idinc+'" name="production_unit_rate[]" type="text" placeholder="Production Cost"  value="' + unit_rate + '"></td>'+
					   '<td><input readonly id="production_rate'+ k+ '" class="form-control calcrow cls_product'+idinc+'" name="production_rate[]" type="text" placeholder="Production Cost"  value="' + production_rate + '"></td>'+
                        
                        <?php
                        if ($view != 'view') {
                        ?> '<td><span data-toggle="tooltip"   title="Remove"  index="'+ k +'" class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></td></td>'
                        <?php
                        }
                        ?> + '</tr>'

                    $('#add_row').append(row)
                    }

        $('#addmoreledger').click(function(){
            var ledger = $('#ledger').val();
           var ledgerid = $('#ledgerid').val();
           var amount = $('#amount').val();

           if(ledgerid && ledger && amount)   {
            addLedger_row(ledgerid ,ledger,amount);

           }
        })

        $(document).on('click', '.remove_ledger', function() {

                $('.tootip').remove;
                $(this).closest('tr').remove();

                });


        function addAccordion(product,k) {
           var accordion='<div id="material_accordion'+k+'"class="panel box"><div class="box-header with-border">'+
                '<h4 class="box-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne'+k+'">'+ product +
                '</a></h4> </div><div id="collapseOne'+k+'" class="panel-collapse collapse in">'+
                '<div class="box-body"><table class=table id="material_table'+k+'"><thead><th class="col-sm-3">Material</th><th class="col-sm-3">Godown</th> <th class="col-sm-2">Quantity</th>'+ 
                '<th class="col-sm-2">Price</th><th class="col-sm-2">Total</th> </thead><tbody id="tbody_material'+k+'"></tbody><tr><td></td><td></td><td></td><td></td><td><input type="text" disabled class="form-control" id="material_total'+idinc+'"></td></tr></table></div></div></div>'
                $('#tab_1').append(accordion)

        }   
        function addLedgerAccordion(product,j) {
           var accordion='<div id="ledger_accordion'+j+'" class="panel box"><div class="box-header with-border">'+
                '<h4 class="box-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOneledger'+j+'">'+ product +
                '</a></h4> </div><div id="collapseOneledger'+j+'" class="panel-collapse collapse in">'+
                '<div class="box-body"><table class=table id="add_ledger_list'+j+'"><thead><th >ledger</th> <th>Amount</th> <th></th></thead>'+
				'<tr><td><input id="ledgerid'+idinc+'" class="form-control" name="ledgerid'+idinc+'" type="hidden">'+
				'<input id="ledger'+idinc+'" attr="'+idinc+'" placeholder="Item" class="form-control autoledger" name="ledger'+idinc+'" autocomplete="on" NoTab="true" type="text"></td>'+
				'<td><input  rowindex= "'+j+'" id="amount'+idinc+'" attr="'+idinc+'" placeholder="Amount" class="form-control amtitemledger " name="Amount'+idinc+'" type="text"></td><td><button rowindex= "'+j+'"  attr="'+idinc+'" class="btn btn-success btnitemledger" type="button" id="addled'+idinc+'"><span class="glyphicon glyphicon-plus"></button></td><tbody id="tbodyledger'+j+'"></tbody><tr><td></td><td><input type="text" disabled name="led_total" id="led_total'+idinc+'" class="form-control"></td><td></td></tr></table></div></div></div>';
                $('#tab_2').append(accordion)

        }   

        function materiallist(material,materialid,quantity,total,k,Price,productid,material_table_id,godown='',godown_name='',product_quantity = 0) {
                a=a+1;
          var  row = '<tr>'+
                '<td><input  class="form-control" name="material_table_id[]" type="hidden" value="' + material_table_id + '">'+
                '<input  class="form-control" name="sub_product_id[]" type="hidden" value="' + productid + '">'+
                '<input  class="form-control" name="material_id[]" type="hidden"value="' + materialid + '">' +
                ' <input  placeholder="Item" class="form-control" name="material" type="text" value="' + material + '" disabled>  </td>' +
                '<td> <select attrprod='+idinc+' data-validation="required" class="form-control mat_godown" name="material_godown[]" count="'+a+'" id="mat_godown'+a+'" >'+txtgodown+'</select>  </td>' +
				'<td> <input attrprod='+idinc+'  attrquantity= '+product_quantity+' placeholder="Nos" class="form-control mat_quantity'+idinc+' mat_quantity" name="material_quantity[]" count="'+a+'" id="mat_quantity'+a+'"   type="text"value="' + quantity + '"> </td>' +
                '<td> <input attrprod='+idinc+'  placeholder="Nos" class="form-control mat_price" name="material_price[]" count="'+ a+'"  id="mat_price'+a+'"  type="text"value="' + Price + '"> </td>' +
                '<td> <input attrprod='+idinc+'  class="cls_sub'+idinc+' form-control clsmaterial'+idinc+' sum"  name="material_row_total[]" type="text" id="mat_total'+a+'" count="'+ a+'"  value="' + total + '"> </td>' +
                '</tr> '
            $('#tbody_material'+k+'').append(row)
			$('#mat_godown'+a).val(godown)
			$('.mat_quantity'+idinc).trigger('change');
        }
        

      
      
      
        $(document).on('change', '.mat_price,.mat_quantity,.led,.sum', function() {
                var count = $(this).attr("count");
                var mat_quantity = $('#mat_quantity'+count+'').val();
                var mat_price = $('#mat_price'+count+'').val();
                if(mat_quantity !== undefined && mat_quantity !== null){ 
                  var row_total = (parseFloat(mat_quantity) * parseFloat(mat_price)).toFixed(2);
                  $('#mat_total'+count+'').val(row_total);
                }
                var attrprod = $(this).attr('attrprod');
                var total = $('.cls_sub'+attrprod);
                var product_total  = 0;
                total.each(function(index, item) {
                    product_total = (parseFloat(product_total) + parseFloat($(item).val())).toFixed(2);
                });
                $('.cls_product'+attrprod).val(product_total);
               var productquantity =  $('.productquantity'+attrprod).val();
				var urate = parseFloat(product_total) /parseFloat(productquantity);
				$('.cls_unit_product'+attrprod).val(parseFloat(urate).toFixed(2));
				
				var mat_tbl =  $('.clsmaterial'+attrprod);
				var mat_total = 0;
				mat_tbl.each(function(index, items) {
                    mat_total = (parseFloat(mat_total) + parseFloat($(items).val())).toFixed(2);
					$('#material_total'+attrprod).val(mat_total);
                });
				var led_tbl =  $('.ledger_sum'+attrprod);
				var led_total = 0;
				led_tbl.each(function(index, items) {
                    led_total = (parseFloat(led_total) + parseFloat($(items).val())).toFixed(2);
					$('#led_total'+attrprod).val(led_total);
                });
        });     
        
        var id = $('#id').val();
        if (id) {
            $.ajax({
                url: "<?php echo site_url('production/process/process_controller/getData') ?>/" + id,
                success: function(result) {
                    data = JSON.parse(result);

                    var dateAr = data.result.date.split('-');
                    var newDate = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0]
                    $('#billno').val(data.result.bill_no);
                    $('#date').val(newDate);
                    $('#user').val(data.result.user),
                    $('#status').val(data.result.status)
                    var main_qty = 0 ;
                    $.each(data.product, function(x, item) {
                        idinc=idinc+1;
                        main_qty = item.quantity;
                        product_row(item.product_id,item.name,item.quantity,item.sales_rate,item.mrp,item.production_cost,k,item.id,item.godown_id,item.godown_name,item.item_id)
                        addAccordion(item.name,k)

                        $.each(data.materialData,function(i,items){

                            if(item.product_id ==items.product_table_id ){

                             materiallist(items.name,items.material_id,items.material_quantity,items.material_row_total,k,items.material_price,items.product_table_id,items.id,items.godown_id,items.godown_name,items.product_quantity) 
                            }
                            
                        })
                        addLedgerAccordion(item.name,k)

                        $.each(data.ledgerData,function(i,ledgeritem){
                            if(item.product_id == ledgeritem.product_table_id ){
                                var single_rate = ledgeritem.ledger_amount/main_qty;
                                ledgerlist(ledgeritem.name,ledgeritem.ledger_id,ledgeritem.ledger_amount,k,ledgeritem.product_table_id,ledgeritem.id,single_rate)


                            }


                        })
                        j=j+1;
                        k=k+1;



                     });
                    $.each(data.Addtnlledger,function(l,item){
                     addLedger_row(item.ledger_id ,item.name,item.ledger_amount,item.id)

                    //  i=l+1;
                   
                    });
 

                 }





            })



        }


    });
</script>