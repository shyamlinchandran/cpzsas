<?php $json = json_encode(array('id' => '0')); 
$isbatch = $settings[0]['is_batch'];
$is_unit = $settings[0]['is_unit'];
?>
<style>
  .sma{
        width: 60px !important;
    }
</style>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('master/GodownTransfer/list_all'); ?>" action="<?php echo site_url('master/GodownTransfer/save_transfer'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid"/> 
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/> 
    <input type="hidden" value="<?php echo $isbatch; ?>" id="isbatch" name="isbatch" />
    <input type="hidden" value="<?php echo $is_unit; ?>" id="is_unit" name="is_unit" />
    <input type="hidden"   name="def_accid" id="def_accid"/> 
    <input type="hidden"   name="myitem" id="myitem"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Godown Stock Transfer Glide', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom"href="<?php echo site_url('master/GodownTransfer/list_all'); ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                 <?= label('Date', $this, $user) ?> *<span class="required"></span> :
                                 <input style="height:20px;" class="form-control   date" id="date" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />
                            </div>
                            
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                               <?= label('Salesman', $this, $user) ?>
                               <select id="salesman" name="salesman" class="form-control" name="chrq_status">
								</select>                   
                            </div>
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('User', $this, $user) ?>
                                <select id="user" name="user" class="form-control" name="chrq_status">
								</select>                     
                            </div>
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('Customer', $this, $user) ?> <span class="required"></span> :
                               <input  type="hidden" name="customer_id" id="customer_id"/><input name="supname" id="supname" type="text" NoTab="true"       class="form-control" placeholder="Customer"></td>
                     
                            </div>
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('From Godown', $this, $user) ?> *<span class="required"></span> :
                                <select  style="height:20px;" id="from_godown"  name="from_godown" class="form-control col-lg-2" >
                                <option value="">Select</option> 
                                 </select>    
                                <select style="display: none;" id="stock"  name="stock" class="form-control" >
                                <option value="">Select</option> 
                                </select>
                            </div>
                            <div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('To Godown', $this, $user) ?> *<span class="required"></span> :
                                <select  style="height:20px;" id="to_godown" name="to_godown" class="form-control ledger" >
                                    <option value="">Select</option> 
                                </select>                      
                            </div>
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                <?= label('Purpose Of Transfer', $this, $user) ?> <span class="required"></span> :
								<select  id="purpose_of_transfer"  name="purpose_of_transfer" class="form-control" >
                                </select> 
                
                            </div>
                        </div>
                        </br><span id="i_stock" name="i_stock"></span></br>
                        <div class="col-sm-12">
                            <table class="table table-striped table-condensed col-sm-12">
                                <tr>
                                    <th style="text-align:center" colspan="12"><?= label('Stock Transfer', $this, $user) ?></th>
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
									<?php if((int) $is_unit > 0){ ?>
										<td class="col-sm-2">
											<input type="hidden" name="base_unit_id" id="base_unit_id" class="form-control" />
											<select id="unit_id" name="unit_id" class="form-control" > 
											
											</select>
										</td>
									<?php } ?>
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
                    <div class="box-footer">          
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class='small-loading' id='FormLoading'> </div>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>

            </div> 
        </div>

    </section>
</form>
<script type="text/javascript">
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
    function addrow(id, name,barcode, quantity,batch="",base_unit_id ="nil" ,unit="nil",unit_name="nil") {
		var is_unit = $('#is_unit').val();
		if(base_unit_id ==="nil"){
			var base_unit_id = $('#base_unit_id').val();
		}
		if(unit ==="nil"){
			var unit = $('#unit_id').val();
		}
        var singrow = '<td class="col-sm-2" ><input value="' + barcode + '"   type="text"  readonly="readonly"   class="form-control"/></td>'+
		'<td class="col-sm-5"><input type="hidden" value=' + id + '  name="id[]" />' +
                '<input value="' + name + '"   type="text"  readonly="readonly"   class="form-control"/></td>';
	var isbatch = $('#isbatch').val();
	if(parseFloat(isbatch) > 0){
		singrow = singrow +  '<td class="col-sm-2"><input value="' + batch + '"   type="text"  readonly="readonly" name="item_batch[]"  class="form-control"/></td>';
	}
	if(parseFloat(is_unit) > 0){
		if(unit_name==="nil"){
			var unit_name = $("#unit_id option:selected").text();
		}
		singrow = singrow +  '<td class="col-sm-2"><input value="'+base_unit_id+'" type="hidden" name="base_unit_item[]" id="base_unit_item" /><input value="'+unit+'" type="hidden" name="unit_item[]" id="unit_item" class="form-control" /><input value="' + unit_name + '"   type="text"  readonly="readonly"   class="form-control"/></td>';
		
	}
        singrow = singrow +        '<td  class="col-sm-2"><input type="text" value=' + quantity + '  name="debit[]"    class="form-control"/></td>' +
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
            url: "<?php echo site_url('master/GodownTransfer/get_purpose'); ?>",
            success: function (result) {
                $('#purpose_of_transfer').html(result);
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
				load();
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
            if (quantity !== "" && item_id !== "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    $("#quantity").val("");
                    $("#itemname").val("");
                    $('#item_id').val("");
                    $('#myitem').val("");
                    addrow(item_id, name,barcode, quantity,batch);
                }
            }

        });
        $("#addmore").click(function () {
            var quantity = $("#quantity").val();
            var item_id = $('#item_id').val();
            var name = $('#myitem').val();
			var batch = $('#batch').val();
			var barcode = $('#itemcode').val();
            if (quantity !== "" && item_id !== "") {
                $("#quantity").val("");
                $("#itemname").val("");
                $('#item_id').val("");
                $('#myitem').val("");
                addrow(item_id, name, barcode,quantity,batch);
            }
        });
        

    });
    function load() {
        var vid = $('#vid').val();
        if (vid !== '0') {
            $.ajax({
                url: "<?php echo site_url('master/GodownTransfer/gettransfer'); ?>/" + vid + "",
                success: function (results) {
                    $("#add").remove();
                    $.each(JSON.parse(results), function (i, itemsingle) {
                        $.ajax({
                            url: "<?php echo site_url('master/items/getpitem'); ?>/" + itemsingle.item_id + "",
                            success: function (results) {
                                $.each(JSON.parse(results), function (i, item) {
                                    $('#date').val(itemsingle.dtp);
                                    $('#to_godown').val(itemsingle.to_id);
                                    $('#from_godown').val(itemsingle.from_id);
									
									
                                    $('#supname').val(itemsingle.supname);
									
									$('#user').val(itemsingle.user);
                                    $('#customer_id').val(itemsingle.customer_id);
                                    $('#salesman').val(itemsingle.salesman);
                                    $('#purpose_of_transfer').val(itemsingle.purpose_of_transfer);
									
                                });
                            }
                        });
                        $('#date').val(itemsingle.dtp);
                        addrow(itemsingle.item_id, itemsingle.name,itemsingle.barcode, itemsingle.qty,itemsingle.batch,itemsingle.base_unit_id,itemsingle.unit_id,itemsingle.unitname);
                    });
                    var sm = $("#view").val();
                }
            });
        }
    }
</script>
