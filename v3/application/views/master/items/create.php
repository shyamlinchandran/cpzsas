<?php $json = json_encode(array('id' => '0')); 
$isbatch = $settings[0]['is_batch'];
$is_unit = $settings[0]['is_unit'];
?>
<style>
  .sma{
        width: 60px !important;
    }
    .hid{
        display:none;
    }
</style>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('master/Itemtransfer/list_all'); ?>" action="<?php echo site_url('master/items/save_transfer'); ?>"   class="form-horizontal">
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
                        <h3 class="box-title"><?= label('Godown Stock Transfer', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom"href="<?php echo site_url('master/itemtransfer/list_all'); ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('Date', $this, $user) ?> *<span class="required"></span> :
                                    <input type="text" class="form-control  date" id="date" name="date"  />
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('From Godown', $this, $user) ?> *<span class="required"></span> :
                                    <select  id="from_godown"  name="from_godown" class="form-control col-lg-2" >
                                        <option value="">Select</option> 
                                    </select>    
                                    <select style="display: none;" id="stock"  name="stock" class="form-control" >
                                        <option value="">Select</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('To Godown', $this, $user) ?> *<span class="required"></span> :
                                    <select  id="to_godown" name="to_godown" class="form-control ledger" >
                                        <option value="">Select</option> 
                                    </select>                      
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('Reference', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="reference" id="reference"   class="form-control"/>                  
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('Ref Date', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="ref_date" id="ref_date"   class="form-control date"/>                  
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('Transport Mode', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="trans_mode" id="trans_mode"   class="form-control"/>                  
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('Vehicle No', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="veh_no" id="veh_no"   class="form-control"/>                  
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('Purpose', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="purpose" id="purpose"   class="form-control"/>                  
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('Place', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="place" id="place"   class="form-control"/>                  
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('E Way Bill No', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="eway_no" id="eway_no"   class="form-control"/>                  
                                </div>
                            </div>
							<div class="col-sm-3 form-group">
                                <div class="col-sm-12">
                                    <?= label('E Way Bill Date', $this, $user) ?> <span class="required"></span> :
                                   <input type="text" name ="eway_date" id="eway_date"   class="form-control"/>                  
                                </div>
                            </div>
                        </div>
                        </br><span id="i_stock" name="i_stock"></span></br>
                        <div class="col-sm-12">
                            <table class="table table-striped table-condensed col-sm-12">
                                <tr>
                                    <th style="text-align:center" colspan="12"><?= label('Stock Transfer', $this, $user) ?></th>
                                </tr>
                                <tr>
                                    <td class="col-sm-3"><?= label('Barcode', $this, $user) ?></td>
                                    <td class="col-sm-4"><?= label('Name', $this, $user) ?></td>
									<?php if((int) $isbatch > 0){ ?>
										<td class="col-sm-2"><?= label('Batch', $this, $user) ?></td>
									<?php } ?>
									<?php if((int) $is_unit > 0){ ?>
										<td class="col-sm-2"><?= label('Unit', $this, $user) ?></td>
									<?php } ?>
                                    <td class="col-sm-1"> <?= label('Rate', $this, $user) ?></td>
                                    <td class="col-sm-1"> <?= label('Quantity', $this, $user) ?></td>
                                    
                                    <td  class="col-sm-1 hid"> <?= label('Tax %', $this, $user) ?></td>
                                    <td class="col-sm-1 hid"> <?= label('Total', $this, $user) ?></td>
                                    <td class="col-sm-2"><?= label('Action', $this, $user) ?></td>
                                </tr>
                                <tr>
                                 <td class="col-sm-3">
                                        <input onchange="itemsearch()" type="text" data-validation-length="min2"  name="itemcode" id="itemcode" NoTab="true"    class="form-control" placeholder="<?= label('Barcode', $this, $user) ?>"/>
                                    </td>
                                    <td class="col-sm-5"><input type="hidden" id="item_id"  name="item_id"/>
                                        <input type="text" data-validation-length="min2"  name="itemname" id="itemname" NoTab="true"    class="form-control" placeholder="<?= label('Name', $this, $user) ?>"/>
                                    </td>
									<?php if((int) $isbatch > 0){ ?>
										<td class="col-sm-3">
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
                                    <td class="col-sm-2"><input type="text" name="rate"  id="rate"   class="form-control two-digits" placeholder="<?= label('Rate', $this, $user) ?>"/></td>
                                    <td class="col-sm-2"><input type="text" name="quantity"  id="quantity"   class="form-control two-digits" placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                    <td style="width:200px;" class="col-sm-2 hid"><select style="width:80px;" class="form-control" namd = "tax_id"  id ="tax_id" ></select></td>
                                    <td class="col-sm-2 hid"><input readonly style="width:100px;" type="text" name="rowTot"  id="rowTot"   class="form-control two-digits" placeholder="<?= label('Total', $this, $user) ?>"/></td>
                                    <td class="col-sm-2"> <button  type="button" id="addmore"  class="btn btn-default" >
                                            <span class="glyphicon glyphicon-plus"></span> 
                                        </button></td>
                                </tr>
                                <tbody id="rowm">

                                </tbody>


<tr>
    <td class="col-sm-3"></td>
    <td class="col-sm-5"></td>

    <?php if((int) $isbatch > 0){ ?>
        <td class="col-sm-3"></td>
    <?php } ?>

    <?php if((int) $is_unit > 0){ ?>
        <td class="col-sm-2"></td>
    <?php } ?>

    <td class="col-sm-2"></td>
    <td class="col-sm-2"></td>

    <td style="width:200px;" class="col-sm-2 hid">Total</td>

    <td colspan="2" class="col-sm-2 hid"><input type ="text"  readonly class="form-control" id ="gtot" ></td>

</tr>


                                

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
$(document).on('change', '#rate, #quantity, #tax_id', function () {
    calculateRow();
});

$(document).on('change', '.changerow', function () {
       var row = $(this).closest('tr');

    // get values from ONLY this row
    var rate = parseFloat(row.find('input[id=irate]').val()) || 0;
    var qty  = parseFloat(row.find('input[id=iqty]').val()) || 0;
    var taxPercentage = parseFloat(row.find('input[id=percentage]').val()) || 0;

    // calculate
    var amount = rate * qty;
    var total  = amount + (amount * taxPercentage / 100);

    // update this row's total
    row.find('input[id=itot]').val(total.toFixed(2));
    calculateGtotal();
});
function calculateRow(){
    var rate = $('#rate').val();
    var quantity = $('#quantity').val();
    var tax_id = $('#tax_id').val();
    var taxPercentage = $('#tax_id option:selected').text();
    if(tax_id  == "" || tax_id == 0){
        taxPercentage = 0 ;
    }
    var total = parseFloat(rate) *  parseFloat(quantity);
    if(total > 0 && taxPercentage > 0){
        var taxamount = parseFloat(total) * parseFloat(taxPercentage) / 100 ;
        total = parseFloat(total) + parseFloat(taxamount);
    }
    $('#rowTot').val(total);
}
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
        calculateGtotal();
	}
    function addrow(rate,id, name,barcode, quantity,batch="",base_unit_id ="nil" ,unit="nil",unit_name="nil",tax_id = 0 ,taxPercentage = 0) {
		var is_unit = $('#is_unit').val();
		if(base_unit_id ==="nil"){
			var base_unit_id = $('#base_unit_id').val();
		}
		if(unit ==="nil"){
			var unit = $('#unit_id').val();
		}
        var singrow = '<td class="col-sm-2" ><input value="' + barcode + '"   type="text"  readonly="readonly"   class="form-control"/></td> <td class="col-sm-6"><input type="hidden" value=' + id + '  name="id[]" />' +
                '<input value="' + name + '"   type="text"  readonly="readonly"   class="form-control"/></td>';
	var isbatch = $('#isbatch').val();
	if(parseFloat(isbatch) > 0){
		singrow = singrow +  '<td><input value="' + batch + '"   type="text"  readonly="readonly" name="item_batch[]"  class="form-control"/></td>';
	}
	if(parseFloat(is_unit) > 0){
		if(unit_name==="nil"){
			var unit_name = $("#unit_id option:selected").text();
		}
		singrow = singrow +  '<td><input value="'+base_unit_id+'" type="hidden" name="base_unit_item[]" id="base_unit_item" /><input value="'+unit+'" type="hidden" name="unit_item[]" id="unit_item" class="form-control" /><input value="' + unit_name + '"   type="text"  readonly="readonly"   class="form-control"/></td>';
		
	}
        singrow = singrow +   '<td  class="col-sm-4"><input type="text" value=' + rate + '  name="item_rate[]" id ="irate"     class="form-control changerow"/></td>'     +'<td  class="col-sm-4"><input id ="iqty"  type="text" value=' + quantity + '  name="debit[]"    class="form-control changerow"/></td>' +
   '<td><input type ="hidden" name="taxesids[]"  ><input readonly type ="text" class="form-control" id ="percentage"   value ="'+taxPercentage+'" / ></td>'+
 '<td><input type ="text"  readonly class="form-control" id ="itot"   value ="0" / ></td>'+

                '<td class="col-sm-2"><span data-toggle="tooltip"   title="Remove" onclick=remove(this)  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").append(newRow);
        $('#itemcode').focus();
        calculateAll();
    }

    function calculateGtotal(){
        var Gtotal = 0 ;
        $('#rowm tr').each(function () {
 
            var row = $(this);

            var rowTotal = parseFloat(row.find('input[id=itot]').val()) || 0;
            Gtotal = parseFloat(Gtotal) + parseFloat(rowTotal);
            $('#gtot').val(Gtotal);
        });
    }
    function calculateAll(){
          $('#rowm tr').each(function () {
 
            var row = $(this);

            var rate = parseFloat(row.find('input[id=irate]').val()) || 0;
            var qty  = parseFloat(row.find('input[id=iqty]').val()) || 0;
            var taxPercentage = parseFloat(row.find('input[id=percentage]').val()) || 0;

            var amount = rate * qty;
            var total  = amount + (amount * taxPercentage / 100);

            row.find('input[id=itot]').val(total.toFixed(2));
        });
        calculateGtotal();
    }
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function(result) {
                $('#tax_id').html(result);
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
            $("#i_stock").html("Stock: " + stock);
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
                $('#tax_id').val(ui.item.tax_id);
                $('#itemname').val(ui.item.name);
                $('#itemcode').val(ui.item.barcode);
                $('#rate').val(ui.item.srate);
                $('#quantity').val(1);
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
                        $("#i_stock").html("Stock: " + stock);
                    }
                });
                calculateRow();
            }
        });
        $("#quantity").keydown(function (e) {
            var quantity = $("#quantity").val();
            var item_id = $('#item_id').val();
            var name = $('#myitem').val();
            var tax_id = $('#tax_id').val();
            var taxPercentage = $('#tax_id option:selected').text();
            if(tax_id  == "" || tax_id == 0){
                taxPercentage = 0 ;
            }
            var barcode = $('#itemcode').val();
			var batch = $('#batch').val();
			var rate = $('#rate').val();
            if (quantity !== "" && item_id !== "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    $("#quantity").val("");
                    $("#itemname").val("");
                    $('#itemcode').val('');
                    $('#item_id').val("");
                    $('#myitem').val("");
                    $('#rate').val(0);
                    addrow(rate,item_id, name,barcode, quantity,batch,"nil","nil","nil",tax_id,taxPercentage);
                }
            }

        });
        $("#addmore").click(function () {
            var quantity = $("#quantity").val();
            var barcode = $('#itemcode').val();
            var item_id = $('#item_id').val();
              var tax_id = $('#tax_id').val();
            var taxPercentage = $('#tax_id option:selected').text();
            if(tax_id  == "" || tax_id == 0){
                taxPercentage = 0 ;
            }
            var name = $('#myitem').val();
            var rate = $('#rate').val();
			var batch = $('#batch').val();
            if (quantity !== "" && item_id !== "") {
                $("#quantity").val("");
                $("#itemname").val("");
                $('#itemcode').val('');

                $('#item_id').val("");
                $('#myitem').val("");
                addrow(rate,item_id, name, barcode,quantity,batch,"nil","nil","nil",tax_id,taxPercentage);
            }
        });
        

    });
    function load() {
        var vid = $('#vid').val();
        if (vid !== '0') {
            $.ajax({
                url: "<?php echo site_url('master/items/gettransfer'); ?>/" + vid + "",
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
                                    $('#supname').val(item.name);
                                    $('#supid').val(item.item_id);
									$('#eway_date').val(itemsingle.ewaydate);
                                    $('#eway_no').val(itemsingle.eway_no);
									$('#reference').val(itemsingle.reference);
									$('#ref_date').val(itemsingle.ref_date);
                                    $('#trans_mode').val(itemsingle.transport_mode);
                                    $('#veh_no').val(itemsingle.vehicle_no);
                                    $('#purpose').val(itemsingle.purpose);
                                    $('#place').val(itemsingle.place);
                                });
                            }
                        });
                        $('#date').val(itemsingle.dtp);
                        addrow(itemsingle.item_rate,itemsingle.item_id, itemsingle.name, itemsingle.barcode,itemsingle.qty,itemsingle.batch,itemsingle.base_unit_id,itemsingle.unit_id,itemsingle.unitname,itemsingle.tax_id,itemsingle.GST);
                    });
                    var sm = $("#view").val();
                }
            });
        }
    }
</script>
