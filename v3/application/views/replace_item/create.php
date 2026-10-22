<?php
$add_url = site_url('Replace_items/list');
$type = 'item';
$json = json_encode(array('id' => '0')); 
$isbatch = $settings[0]['is_batch'];
$is_unit = $settings[0]['is_unit'];
$user = $this->session->userdata('user');
$user_id = $user['Id'];
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('Replace_items/list'); ?>" action="<?php echo site_url('Replace_items/save'); ?>"   class="form-horizontal">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="<?=$this->box_color?>">
					
                    <div class="box-header">
                        <h3 class="box-title"><?= label('Replace Item ', $this, $user) ?><?php if((float) $id > 0 ){ echo 'Edit ';}else{ echo 'Create';}?><b><?php echo $voucher_no;?></b></h3>
						 <span class="pull-right">
                        <a role="button" back="<?php echo site_url('Replace_items\list'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Replace_items\list'); ?>">
                            <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
							
                        </a>
                    </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
						    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid"/> 
							<input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/> 
							<input type="hidden" value="<?php echo $isbatch; ?>" id="isbatch" name="isbatch" />
							<input type="hidden" value="<?php echo $is_unit; ?>" id="is_unit" name="is_unit" />
						<div class="col-sm-12">
							<div class="col-sm-4 " style="padding-right:10px;padding-bottom:10px;">
							<input type="hidden" name="myitem" id="myitem" value=""/>
                                 <?= label('Bill Type', $this, $user) ?> *<span class="required"></span> :
                                 <select style="height:20px;" class="form-control" id="btype" name="btype" data-validation="required"    >
								 </select>
                            </div>
							<div class="col-sm-4 " style="padding-right:10px;padding-bottom:10px;">
							<input type="hidden" name="myitem" id="myitem" value=""/>
                                 <?= label('Date', $this, $user) ?> *<span class="required"></span> :
                                 <input style="height:20px;" class="form-control   date" id="date" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />
                            </div>
							<div class="col-sm-4 " style="padding-right:10px;padding-bottom:10px;">
                               <?= label('Salesman', $this, $user) ?>
                               <select id="salesman" name="salesman" class="form-control" data-validation="required"  >
								</select>                   
                            </div>
							<div class="col-sm-4 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('User', $this, $user) ?>
                                <select id="user" name="user" class="form-control" data-validation="required"  >
								</select>                     
                            </div>
							<div class="col-sm-4 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('Customer', $this, $user) ?> <span class="required"></span> :
                               <input  type="hidden" name="customer_id" id="customer_id"/><input name="supname" id="supname" type="text" NoTab="true"       class="form-control" placeholder="Customer"></td>
                     
                            </div>
							<div class="col-sm-4 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('Reference', $this, $user) ?> <span class="required"></span> :
								<textarea name="reference" id="reference" class="form-control"/>
                            </div>
						</div>
						 <div class="col-sm-12">
                            <table class="table table-striped table-condensed col-sm-12">
                                <tr>
                                    <th style="text-align:center" colspan="12"><?= label('Replace Item', $this, $user) ?></th>
                                </tr>
                                <tr>
									<td <?php if((int) $isbatch > 0){ echo 'class="col-sm-2"';}else echo 'class="col-sm-2"';?>><?= label('Barcode', $this, $user) ?></td>
                                    <td <?php if((int) $isbatch > 0){ echo 'class="col-sm-3"';}else echo 'class="col-sm-5"';?>><?= label('Name', $this, $user) ?></td>
									<?php if((int) $isbatch > 0){ ?>
										<td class="col-sm-2"><?= label('Batch', $this, $user) ?></td>
									<?php } ?>
									<?php if((int) $is_unit > 0){ ?>
										<td class="col-sm-2"><?= label('Unit', $this, $user) ?></td>
									<?php } ?>
                                    <td class="col-sm-2"> <?= label('Godown', $this, $user) ?></td>
                                    <td class="col-sm-2"> <?= label('Quantity', $this, $user) ?></td>
                                    <td class="col-sm-1"><?= label('Action', $this, $user) ?></td>
                                </tr>
                                <tr>
									<td class="col-sm-2">
                                        <input onchange="itemsearch()" type="text" data-validation-length="min2"  name="itemcode" id="itemcode" NoTab="true"    class="form-control" placeholder="<?= label('Barcode', $this, $user) ?>"/>
                                    </td>
                                    <td class="col-sm-3"><input type="hidden" id="item_id"  name="item_id"/>
                                        <input type="text" data-validation-length="min2"  name="itemname" id="itemname" NoTab="true"    class="form-control" placeholder="<?= label('Name', $this, $user) ?>"/>
                                    </td>
									<?php if((int) $isbatch > 0){ ?>
										<td class="col-sm-2">
											<input type="text"   name="batch" id="batch" NoTab="true"    class="form-control" placeholder="<?= label('Batch', $this, $user) ?>"/>
										</td>
									<?php } ?>
										<td class="col-sm-2">
											<input type="hidden" name="base_unit_id" id="base_unit_id" class="form-control" />
											<select id="unit_id" name="unit_id" class="form-control" > 
											
											</select>
										</td>
									<td class="col-sm-2">
										<select id="godown_id" name="godown_id" class="form-control" > 
											
										</select>
									</td>
                                    <td class="col-sm-2"><input type="text" name="quantity"  id="quantity"   class="form-control two-digits" placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                    <td class="col-sm-1"> <button  type="button" id="addmore"  class="btn btn-default" >
                                            <span class="glyphicon glyphicon-plus"></span> 
                                        </button></td>
                                </tr>
                                <tbody id="rowm">

                                </tbody>

                            </table>


                        </div>
                    </div>
                    <!-- /.box-body -->
					 <div class="box-footer">
                        <?php if ($view != 'view') { ?>
                            <button  id="btnreplace" type='button' data-toggle="tooltip" title='Save' class='btn btn-warning'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <button style ="display:none;" id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn btn-warning'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php } ?>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
<script type="text/javascript">
	var cnt_sj = 0 ;
   function calert(msg) {
        toastr["error"](msg);
    }
	$(document).on('click', '#btnreplace', function() {
		var cnt = 0 ;
		event.preventDefault();
		
		$( ".itemqty" ).each(function() {
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
function itemsearch(){
		var itemcode = $('#itemcode').val();
		$.ajax({
          url: "<?php echo site_url('master/GodownTransfer/getitem'); ?>",
		  type:"post",
		  data :{itemcode:itemcode},
          success: function (results) {
			$.each(JSON.parse(results), function (i, itemsingle) {
				$('#item_id').val(itemsingle.id);
                $('#itemname').val(itemsingle.name);
                $('#quantity').focus();
                $('#myitem').val(itemsingle.name);
				$('#batch').val(itemsingle.itembatch);
				$('#unit_item').html('<option value="">Select</option>');
				var unit_id = itemsingle.unit_id;
				 $.ajax({
					url: "<?php echo site_url('ajaxcall/units'); ?>/" + itemsingle.id,
					success: function (result) {
						$('#base_unit_id').val(unit_id);
						$('#unit_id').html(result);
						$('#unit_id').val(unit_id);
					}
				});
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + itemsingle.id,
					async:false,
                    success: function (result) {
                        $('#stock').html('');
                        $('#stock').html(result);
                        var stock = 0;
                        var gid = $('#from_godown').val();
                        $('#stock').val(gid);
                        var g_id = $('#stock').val();
                        if (gid === g_id) {
                            stock = $('#stock').find(':selected').attr('stock');
                        }
						var to_godown = $('#to_godown').val();
						var to_stock = $("#stock [value=" + to_godown + "]").attr('stock');
						$("#i_stock").html("Stock From Godown: " + stock + "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock To Godown: " + to_stock);
                    }
                });
			});
		  }
      });
	}
	function remove(btn){
		$(btn).closest('tr').remove();
	}
    function addrow(id, name,barcode, quantity,batch="",base_unit_id ="nil" ,unit="nil",unit_name="nil",godown_id,godown_name="") {
		//var is_unit = $('#is_unit').val();
	//	if(base_unit_id ==="nil"){
			//var base_unit_id = $('#base_unit_id').val();
		//}
		//if(unit ==="nil"){
			//var unit = $('#unit_id').val();
		//}
        var singrow = '<td class="col-sm-2" ><input value="' + barcode + '"   type="text"  readonly="readonly"   class="form-control"/></td>'+
		'<td class="col-sm-5"><input type="hidden" value=' + id + '  name="id[]" />' +
                '<input value="' + name + '"   type="text"  readonly="readonly"   class="form-control"/></td>';
	var isbatch = $('#isbatch').val();
	if(parseFloat(isbatch) > 0){
		singrow = singrow +  '<td class="col-sm-2"><input value="' + batch + '"   type="text"  readonly="readonly" name="item_batch[]"  class="form-control"/></td>';
	}
	//if(parseFloat(is_unit) > 0){
		if(unit_name==="nil"){
			var unit_name = $("#unit_id option:selected").text();
		}
		singrow = singrow +  '<td class="col-sm-2"><input value="'+base_unit_id+'" type="hidden" name="base_unit_item[]" id="base_unit_item" /><input value="'+unit+'" type="hidden" name="unit_item[]" id="unit_item" class="form-control" /><input value="' + unit_name + '"   type="text"  readonly="readonly"   class="form-control"/></td>';
		
	//}
		singrow = singrow +  '<td class="col-sm-2"><input value="'+godown_id+'" type="hidden" name="godown[]" id="godown" /><input value="' + godown_name + '"   type="text"  readonly="readonly"   class="form-control"/></td>';
        singrow = singrow +        '<td  class="col-sm-2"><input type="text" value=' + quantity + '  name="debit[]"    class="form-control itemqty"/></td>' +
                '<td class="col-sm-1"><span data-toggle="tooltip"   title="Remove" onclick=remove(this)  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").append(newRow);
    }
	function loadCust(ui) {
       $('#supname').val(ui.item.name);
       $('#customer_id').val(ui.item.id);
   }
    $(document).ready(function () {
		$.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/replacement') ?>",
            success: function(result) {
                $('#btype').html(result);

            }
        });
		$('#supname').change(function(){
				var customer_id = $('#customer_id').val();
				if(customer_id === 0 || customer_id ===""){
					$('#supname').val('');
				}
		});
		 $.ajax({
                url: "<?php echo site_url('ajaxcall/godown'); ?>",
                success: function (result) {
                    $('#godown_id').html(result);
       
                }
            });
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
                $('#salesman')
                        .prepend($('<option>', {value: ""})
                                .text('All'));
								$('#user').html(result);
                $('#user')
                        .prepend($('<option>', {value: ""})
                                .text('All'));
								$('#user').val('<?php echo $user_id;?>');
            }
        });
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);

            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#from_godown').html(result);
            }
        });
        $("#from_godown").change(function () {
            var gid = $('#from_godown').val();
            $('#stock').val(gid);
            var g_id = $('#stock').val();
            if (gid === g_id) {
                stock = $('#stock').find(':selected').attr('stock');
            }
            var to_godown = $('#to_godown').val();
			var to_stock = $("#stock [value=" + to_godown + "]").attr('stock');
            $("#i_stock").html("Stock From Godown: " + stock + "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock To Godown: " + to_stock);
        });
		$("#to_godown").change(function () {
            var gid = $('#from_godown').val();
            $('#stock').val(gid);
            var g_id = $('#stock').val();
            if (gid === g_id) {
                stock = $('#stock').find(':selected').attr('stock');
            }
            var to_godown = $('#to_godown').val();
			var to_stock = $("#stock [value=" + to_godown + "]").attr('stock');
            $("#i_stock").html("Stock From Godown: " + stock + "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock To Godown: " + to_stock);
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#to_godown').html(result);
            }
        });
        $("#itemname").autocomplete({
            source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#item_id').val(ui.item.id);
				$('#itemcode').val(ui.item.barcode);
                $('#itemname').val(ui.item.name);
                $('#quantity').focus();
                $('#myitem').val(ui.item.name);
				$('#batch').val(ui.item.itembatch);
				$('#unit_item').html('<option value="">Select</option>');
				var unit_id = ui.item.unit_id;
				 $.ajax({
					url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.id,
					success: function (result) {
						$('#base_unit_id').val(unit_id);
						$('#unit_id').html(result);
						$('#unit_id').val(unit_id);
					}
				});
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + ui.item.id,
                    success: function (result) {
                        $('#stock').html('');
                        $('#stock').html(result);
                        var stock = 0;
                        var gid = $('#from_godown').val();
                        $('#stock').val(gid);
                        var g_id = $('#stock').val();
                        if (gid === g_id) {
                            stock = $('#stock').find(':selected').attr('stock');
                        }
                        var to_godown = $('#to_godown').val();
						var to_stock = $("#stock [value=" + to_godown + "]").attr('stock');
						$("#i_stock").html("Stock From Godown: " + stock + "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock To Godown: " + to_stock);
                    }
                });
            }
        });
        $("#quantity").keydown(function (e) {
            var quantity = $("#quantity").val();
            var item_id = $('#item_id').val();
            var name = $('#myitem').val();
			var batch = $('#batch').val();
			var barcode = $('#itemcode').val();
			var godown_id = $('#godown_id').val();
			var godown_name = $("#godown_id option:selected").text();
			var base_unit_id = $('#base_unit_id').val();
			var unit_id = $('#unit_id').val();
			var unit_name = $("#unit_id option:selected").text();
            if (quantity !== "" && item_id !== "" && godown_id !=='' && godown_id !== 0 ) {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    $("#quantity").val("");
                    $("#itemname").val("");
                    $('#item_id').val("");
                    $('#myitem').val("");
                    addrow(item_id, name,barcode, quantity,batch,base_unit_id,unit_id,unit_name,godown_id,godown_name);
                }
            }

        });
        $("#addmore").click(function () {
            var quantity = $("#quantity").val();
            var item_id = $('#item_id').val();
            var name = $('#myitem').val();
			var batch = $('#batch').val();
			var barcode = $('#itemcode').val();
			var godown_id = $('#godown_id').val();
			var godown_name = $("#godown_id option:selected").text();
			var base_unit_id = $('#base_unit_id').val();
			var unit_id = $('#unit_id').val();
			var unit_name = $("#unit_id option:selected").text();
            if (quantity !== "" && item_id !== "" && godown_id !=='' && godown_id !== 0) {
                $("#quantity").val("");
                $("#itemname").val("");
                $('#item_id').val("");
                $('#myitem').val("");
                addrow(item_id, name, barcode,quantity,batch,base_unit_id,unit_id,unit_name,godown_id,godown_name);
            }
        });
        var id = $('#vid').val();
		if(parseFloat(id) > 0 )
		{	
			load();
		}

    });
    function load() {
		 var id = $('#vid').val();
         $.ajax({
                url: "<?php echo site_url('Replace_items/getsing'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
						$('#date').val(itemsingle.dates);
						$('#user').val(itemsingle.rep_user);
						$('#salesman').val(itemsingle.rep_salesman);
						$('#customer_id').val(itemsingle.rep_customer);
						$('#supname').val(itemsingle.customer_name);
						$('#reference').val(itemsingle.rep_reference);
						addrow(itemsingle.rep_itm_item, itemsingle.item, itemsingle.barcode,itemsingle.rep_itm_quantity,'',itemsingle.rep_itm_base_unit,itemsingle.rep_itm_unit,itemsingle.code,itemsingle.rep_itm_godown,itemsingle.godown_name);
                    });

                }
            });
    }
    

</script>  