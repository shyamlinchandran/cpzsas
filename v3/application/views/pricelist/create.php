<?php
$customer = '';
$isbatch = $settings[0]['is_batch'];
?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('pricelist/Pricelist/listall'); ?>" action="<?php echo site_url('pricelist/Pricelist/save_pricelist'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?php echo $isbatch; ?>" id="isbatch" name="isbatch" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Price List', $this, $user) ?> Create</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('pricelist/Pricelist/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('pricelist/Pricelist/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-4  odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Price List', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8" >
                                    <input <?php  if(isset($details['price_list'])){ echo "value='".$details['price_list']."'";}?> id="price_list_name" class="form-control" name="price_list_name" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>
                             <div class="col-sm-4  odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Notes', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8" >
                                    <input <?php  if(isset($details['note'])){ echo "value='".$details['note']."'";}?> id="price_list_notes" class="form-control" name="price_list_notes" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 form-group  odd_cls">
                            <table class="table table-bordered">
                               <tr>
									<th>  <?= label('Select Item', $this, $user) ?></th>
									<?php if((int) $isbatch >  0){?>
										<th>  <?= label('Batch', $this, $user) ?></th>
									<?php }?>
									
									<th>  <?= label('Sales Rate', $this, $user) ?></th>
									<th><?= label('Discount % ', $this, $user) ?></th>
									<th>  <?= label('Discount Amount', $this, $user) ?></th>
									<th>  <?= label('Rate', $this, $user) ?></th>
									<th>  <?= label('Add', $this, $user) ?></th>
							   </tr>
                                <tr>
                                    <td> 
                                        <input value="" id="product_id" class="form-control" name="product_id" type="hidden"> 
                                        <input value="0" id="product_godown_id" class="form-control" name="product_godown_id" type="hidden"> 
                                        <input value="" id="product_batch_id" class="form-control" name="product_batch_id" type="hidden"> 
                                        <input noTab = "true" id="product_name" class="form-control" name="product_name" type="text" value=""  placeholder="<?= label('Item Name', $this, $user) ?>" maxlength="250">
                                    </td> 
									<?php if((int) $isbatch >  0){?>
									<td> 
                                        <input  readonly="readonly" id="batch" class="form-control" name="batch" type="text" value=""  placeholder="<?= label('batch', $this, $user) ?>" maxlength="250">
                                    </td> 
									.<?php }?>
                                    <td>
                                        <input id="sales_rate" class="form-control two-digits" name="sales_rate" type="text" value=""  placeholder="<?= label('Sales Rate', $this, $user) ?>" maxlength="250">
										</td>
                                    <td>
                                        <input id="discount" class="form-control two-digits" name="discount" type="text" value=""  placeholder="<?= label('Discount %', $this, $user) ?>" maxlength="250">
                                    </td>
									<td>
                                        <input id="discount_amount" class="form-control two-digits" name="discount_amount" type="text" value=""  placeholder="<?= label('Discount Amount', $this, $user) ?>" maxlength="250">
                                    </td>
									<td>
                                        <input readonly="readonly" id="item_rate" class="form-control two-digits" name="item_rate" type="text" value=""  placeholder="<?= label('Item Rate', $this, $user) ?>" maxlength="250">
                                    </td>
                                    <td> 
                                        <button data-toggle="tooltip" type="button"  id="addmore"  title="Add To save"   class="addmore btn btn-success" href="#">
                                            Add 
                                        </button>
                                    </td>
                               


                                </tr>
                            </table>
							
                        </div>
                        <div  style="padding-top :50px;" class="col-sm-12 form-group  odd_cls">
						  <table  id="vtable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
									<th>Item</th>
									<th>Sales Rate</th>
									<th>Discount%</th>
									<th>Discount Amt</th>
									<th>Rate</th>
									<th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
						
						</div>

                        <!-- /.box -->
                    </div>
                    <div class="box-footer" class="col-sm-12">
                        <button style="display:none" id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- /.row -->
    </section>
    <script type="text/javascript">

        function deleterow(id){
                    $.ajax({
						url: '<?php echo site_url('pricelist/Pricelist/deleteitem'); ?>',
						type: 'post',
						data: {id:id},
						success: function(res) {
							table.ajax.reload(null, false);
						}
					});
        }
		 $.validate({
            modules: 'security'
         });
		var table;
		var table_id = 0;
		var now = new Date();
		var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
		$(document).on('change', '#sales_rate,#discount', function(){
			var sales_rate = $('#sales_rate').val();
			var discount = $('#discount').val();
			var discount_amount = 0;
			var rate = sales_rate;
			if(sales_rate === ""){
				sales_rate = 0;
			}
			if(discount === ""){
				discount = 0;
			}
			if(parseFloat(sales_rate) >0 && parseFloat(discount) > 0 ){
				discount_amount = parseFloat(sales_rate) * parseFloat(discount) / 100;
				rate = parseFloat(rate) - parseFloat(discount_amount);
			}
			$('#discount_amount').val(discount_amount);
			$('#item_rate').val(rate);
		});
		$(document).on('change', '#discount_amount', function(){
			var sales_rate = $('#sales_rate').val();
			var discount_amount = $('#discount_amount').val();
			if(sales_rate === "" ){
				sales_rate = 0;
			}
			if(discount_amount ===""){
				discount_amount = 0;
			}
			var rate = sales_rate;
			var discount = 0;
			if(parseFloat(discount_amount)>0 && parseFloat(sales_rate)>0){
				discount = parseFloat(((discount_amount * 100) / (sales_rate)));
				rate = parseFloat(sales_rate)-parseFloat(discount_amount);
			}
			$('#item_rate').val(rate);
			$('#discount').val(discount.toFixed(2));

		});
		
		$(document).on('keydown', '#discount_amount', function(e){
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9){
				$('#addmore').trigger('click');
			}
		});
		
		$(document).on('keydown', '#product_name', function(e){
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9){
				e.preventDefault();
				$('#sales_rate').focus();
			}
		});
		
        $(document).ready(function () {
			table = $('#vtable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('pricelist/Pricelist/item_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.id = $('#id').val();
                    
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
            $("#cusname").autocomplete({
                source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
                minLength: 2,
                select: function (event, ui) {
                    $('#customer_id').val(ui.item.id);

                }
            });
            $("#product_name").autocomplete({
                source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
                minLength: 2,
                select: function (event, ui) {
					$('#product_id').val(ui.item.id);
					$('#product_godown_id').val(ui.item.godown_id);
					$('#product_batch_id').val(ui.item.itembatch);
                    $('#batch').val(ui.item.itembatch);
                    var sales_rate = ui.item.srate;
					var discount = ui.item.dis;
					var discount_amount = 0 ;
					var rate = sales_rate;
					if(parseFloat(sales_rate) > 0 && parseFloat(discount) > 0){
						discount_amount = parseFloat(sales_rate) *  parseFloat(discount)/100;
						rate = parseFloat(sales_rate) - parseFloat(discount_amount);
					}
					$('#sales_rate').val(sales_rate);
					$('#discount').val(discount);
					$('#discount_amount').val(discount_amount);
					$('#item_rate').val(rate);
					
                }
            });
            load();
        });
       
        $(".addmore").click(function () {
            var sales_rate = $('#sales_rate').val();
			var discount = $('#discount').val();
			var discount_amount = $('#discount_amount').val();
			var product_id = $('#product_id').val();
			var price_list_notes = $('#price_list_notes').val();
			var id = $('#id').val();
			var price_list_name = $('#price_list_name').val();
			var product_godown_id = $('#product_godown_id').val();
			var product_batch_id =		$('#product_batch_id').val();
			var form = 'frmcreate';
			$("#frmcreate").validate();            // <- INITIALIZES PLUGIN
            isValid = $("#frmcreate").isValid();
			if (isValid) {
				$('#sales_rate').val('');
				$('#discount').val('');
		        $('#discount_amount').val('');
				$('#product_godown_id').val('0');
				$('#product_batch_id').val('');
			    $('#product_id').val('');
				$('#item_rate').val('');
				$('#product_name').val('');
				if(product_id !==""){
					$.ajax({
						url: '<?php echo site_url('pricelist/Pricelist/save'); ?>',
						type: 'post',
						data: {product_batch_id:product_batch_id,product_godown_id:product_godown_id,sales_rate:sales_rate,discount:discount,discount_amount:discount_amount,product_id:product_id,id:id,price_list_name:price_list_name,price_list_notes:price_list_notes},
						success: function(res) {
							$('#id').val(res);
							table.ajax.reload(null, false);
							$('#product_name').focus();
						}
					});
				
				}
			}
        });

       
        function removekit(btn) {
            $(btn).closest('tr').remove();
        }
        function clearservice() {

        }
        
        function load() {
            var id = $("#id").val();
            if (id !== '0') {
               
            }
			
        }
		
		function editrow(id){
			$.ajax({
                url: "<?php echo site_url('pricelist/Pricelist/editrow'); ?>/",
				type: 'post',
				data:{id:id},
                success: function (results) {
                    var result = JSON.parse(results)[0];
                    $('#product_name').val(result.name);
                    $('#product_batch_id').val(result.batch);
                    $('#batch').val(result.batch);
                    $('#product_id').val(result.item_id)
					$('#sales_rate').val(result.sales_rate);
					$('#discount').val(result.price_discount);
					$('#discount_amount').val(result.price_discount_amount);
					var rate = parseFloat(result.sales_rate) - parseFloat(result.price_discount_amount);
					$('#item_rate').val(rate);
                }
            });
		}

  
    </script> 