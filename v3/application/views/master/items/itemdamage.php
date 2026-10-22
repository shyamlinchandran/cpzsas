<?php $json = json_encode(array('id' => '0')); ?>
<?php
$is_multipleunit = $settings[0]['is_unit'];
$is_godown = $settings[0]['is_godown'];
$isbatch = $settings[0]['is_batch'];

?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('master/itemdamage/list_all'); ?>" action="<?php echo site_url('master/Itemdamage/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $is_godown; ?>" id="is_godown" name="is_godown"/> 
    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid"/> 
    <input type="hidden" value="<?php echo $isbatch; ?>" id="isbatch" name="isbatch" />
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/> 
    <input type="hidden" value="<?php echo $is_multipleunit; ?>" id="is_multipleunit" name="is_multipleunit"/> 
    <input type="hidden"   name="def_accid" id="def_accid"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Damage Stock', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('master/itemdamage/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('master/itemdamage/list_all'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-10">                           
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" >
                                        <thead>
                                            <tr>
                                                <td> <?= label('Date', $this, $user) ?> </td>
                                                <td>  <input class="form-control hunpx  date" id="date" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" /></td>
                                               <!--  <td>From Godown</td>
                                                <td><select  id="from_godown"  name="from_godown" class="form-control col-lg-2" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <td>To Godown</td>
                                                <td><select  id="to_godown" name="to_godown" class="form-control ledger" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr><td>Current Stock:</td><td><label id="cstock"></label></td>
                                                </tr> -->
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-condensed" >
                                        <thead>
                                            <tr>
                                                <th><?= label('Name', $this, $user) ?></th>
												<?php if((int) $isbatch > 0){ ?>
													<th><?= label('Batch', $this, $user) ?></th>
												<?php } ?>
                                                <th><?= label('Godown', $this, $user) ?></th>
                                                <th><?= label('Unit', $this, $user) ?></th>
                                                <th><?= label('Quantity', $this, $user) ?></th>
                                                <th><?= label('Details', $this, $user) ?></th>
                                                <th>
                                                    <?= label('Action', $this, $user) ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td><input type="hidden"  name="item_id" id="item_id" class="ids"/>
                                                <input  type="text" autofocus NoTab="true" name="item_name" id="item_name"    class="form-control ledger" placeholder="Name"/>
                                            </td>
											<?php if((int) $isbatch > 0){ ?>
												<td><input type="text" readonly name="batch" id="batch" class="form-control" placeholder="Batch"/></td>
											<?php }else{ ?>
												<input  value="" type="hidden"  name="batch" id="batch" class="form-control" placeholder=""/>
											<?php } ?>
                                            <td ><select tabindex="-1" id="godown" name="godown"  class="form-control">
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                            <td class="sma"><select tabindex="-1"   id="unit_item" class="form-control " >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                            <td ><input type="text" name="qty" id="qty"    class="form-control  cal debit two-digits" placeholder="Quantity"/></td>
                                            <td ><input type="text"  name="details" id="details" class="form-control " placeholder="Details"/></td>
                                     <!-- <span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">
                                         <span class="glyphicon glyphicon-remove-sign"></span> 
                                     </span> -->
                                            <td><button type="button" data-toggle="tooltip"   title="Add More" id=""  class="addmore btn btn-default" >
                                                    <span class="glyphicon glyphicon-plus"></span> 
                                                </button>
                                            </td>

                                        </tr>
                                        <tbody id="rowm">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td> 
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div> 
                        </div>
                    </div>  
                    <div class="box-footer">   
                        <?php if ($view != 'view') { ?>       
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php } ?>           
                        <div class='small-loading' id='FormLoading'> </div>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>

            </div> 

    </section>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        load();
        $("#item_name").autocomplete({
            source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#batch').val(ui.item.itembatch);
                loaditem(ui);
                $("#qty").focus();
                var is_godown = $("#is_godown").val();
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.id,
                    success: function (result) {
                        $('#unit_item').html(result);
                        $('#unit_item').val(ui.item.unit_id);
                        $("#item_qty").focus().select();
                    }
                });
				var godown_id = ui.item.godown_id;
                if (is_godown === '1') {
                    $.ajax({
                        url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + ui.item.id,
                        success: function (result) {
                            $('#godown').html('');
                            $('#godown').html(result);
                            $('#godown').val(godown_id);
                            var myTag = $('#godown').find(':selected').attr('stock');
                            $("#i_stock").html("Stock: " + myTag);
                            $("#godown").focus();
                        }
                    });
                }
                if (is_godown === '0') {
                    $.ajax({
                        url: "<?php echo site_url('ajaxcall/godown'); ?>",
                        success: function (result) {
                            $('#godown').html(result);
                            $('#godown').val(godown_id);
                        }
                    });

                    $("#item_qty").focus().select();
                }
            }
        });
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });
    });
    function loaditem(ui) {
        $('#item_name').val(ui.item.label);
        $('#item_id').val(ui.item.id);
    }
    $(".addmore").click(function () {
        var qty = $("#qty").val();
        var item_id = $("#item_id").val();
        var name = $("#item_name").val();
        var details = $("#details").val();
        var unit_id = $("#unit_item").val();
        var godown_id = $("#godown").val();
		var batch = $("#batch").val();
        var unit_name = $("#unit_item option:selected").text();
        var godown_name = $("#godown option:selected").text();
        if (item_id != '' && qty != '0' && qty != '' && details != '') {
			$("#batch").val('');
            $("#qty").val(0);
            $("#item_id").val('');
            $("#item_name").val('');
            $("#details").val('');
            addrow(item_id, name, qty, details, godown_id, godown_name, unit_id, unit_name,batch);
        }
        $("#item_name").focus();

    });
    $("#details").keydown(function (e) {
        var qty = $("#qty").val();
        var item_id = $("#item_id").val();
        var name = $("#item_name").val();
        var details = $("#details").val();
		var batch = $("#batch").val();
        var unit_id = $("#unit_item").val();
        var godown_id = $("#godown").val();
        var unit_name = $("#unit_item option:selected").text();
        var godown_name = $("#godown option:selected").text();
        if (item_id != '' && qty != '0' && qty != '' && details != '') {

            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9)
            {
				 $("#batch").val('');
                $("#qty").val(0);
                $("#item_id").val('');
                $("#item_name").val('');
                $("#details").val('');
                addrow(item_id, name, qty, details, godown_id, godown_name, unit_id, unit_name,batch);
            }
            

        }

    });
    function addrow(item_id, name, qty, details, godown_id, godown_name, unit_id, unit_name,batch="") {
        var singrow = '<td><input type="hidden" value=' + item_id + '  name="id[]" class="ids"/>' +
                '<input data-validation="length" value="' + name + '" data-validation-length="min2"  type="text" readonly="readonly" NoTab="true" name="item[]"   class="form-control ledger" placeholder="Name"/></td>' ;
       var isbatch = $('#isbatch').val();
	   if(parseFloat(isbatch) > 0 ){
		   singrow = singrow + '<td><input name="item_batch[]" value="'+batch+'" class="form-control" type="text" readonly="readonly"></td>';
	   }
	   singrow = singrow +       '<td><input type="hidden" value=' + godown_id + '  name="godown_id[]" class="ids"/>' + '<input data-validation="length" value="' + godown_name + '" data-validation-length="min2"  type="text" readonly="readonly" NoTab="true" name="godown_name[]"   class="form-control ledger" placeholder="Name"/></td>' +
                '<td><input type="hidden" value=' + unit_id + '  name="unit_id[]" class="ids"/>' + '<input data-validation="length" value="' + unit_name + '" data-validation-length="min2"  type="text" readonly="readonly" NoTab="true" name="unit_name[]"   class="form-control ledger" placeholder="Name"/></td>' +
                '<td ><input style="float:right"  value=' + qty + ' type="text" name="quantty[]"     class="deb form-control  cal debit two-digits" placeholder="Debit"/></td>' +
                '<td ><input style="float:right"  value=' + details + ' type="text" name="det[]"     class="deb form-control  cal debit two-digits" placeholder="Debit"/></td>' +
                '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").append(newRow);
    }
    function load() {
        var vid = $('#vid').val();
        if (vid !== '0') {
            $.ajax({
                url: "<?php echo site_url('master/Itemdamage/getdamage'); ?>/" + vid + "",
                success: function (results) {
                    $.each(JSON.parse(results), function (i, itemsingle) {
                        addrow(itemsingle.item_id, itemsingle.item, itemsingle.quantity, itemsingle.details, itemsingle.godown_id, itemsingle.godown_name, itemsingle.unit_id, itemsingle.unitname,itemsingle.batch);
                    });
                }
            });
            // $("#item_name").focus();
        }
    }

</script>
