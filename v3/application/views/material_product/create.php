<form method="post"  id="frmcreate" back="<?php echo site_url('material/material_product/create'); ?>" action="<?php echo site_url('material/material_product/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="0" name="is_godown" id="is_godown" />

    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Finished Goods', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('material/material_product/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('material/material_product/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                   <?= label('Date', $this, $user) ?> <span class="required"></span> :
                            </label>
                            <div class="col-sm-1" id="name_input_box">
                                    <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date">
                                </div>
                            <label class="col-sm-1 control-label" id="name_display_as_box">
                                   <?= label('User', $this, $user) ?> <span class="required"></span> :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                <select name="username" data-validation="required" id="username" data-validation="required" style="width:200px" class="form-control" >
                                        <option value="">Select</option>
                                        <?php foreach ($user as $type) { ?>
                                            <option value="<?php echo $type['Id']; ?>"><?php echo $type['username']; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                   <?= label('From Godown', $this, $user) ?> *<span class="required"></span> :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                 <select name="r_godow" id="r_godow" class="form-control" data-validation="required">
                                    <!--<option value="">Select</option> -->                                    
                                    <?php foreach ($godown as $type) { ?>
                                        <option value="<?php echo $type['id']; ?>"><?php echo $type['godown_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>                        
                      <!--  <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Product*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                <input id="product_name" class="form-control" name="product_name" type="text" value="" data-validation="required" placeholder="Start typing.." maxlength="250">
                                <input id="product_id" class="form-control" name="product_id" type="hidden">        
                            </div>
                        <div class="col-sm-1" id="name_input_box">
                                <input id="p_quantity" class="form-control two-digits price" name="p_quantity" type="text" value="" maxlength="50" placeholder="Quantity" data-validation="required">
                            </div>  -->
                            <!-- <div class="col-sm-1" id="name_input_box">
                                <select name="p_unit_id" id="p_unit_id" class="form-control" data-validation="required">
                                    <?php foreach ($unit as $type) { ?>
                                        <option
                                            value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                        <?php } ?>
                                </select>
                            </div> 
                            <label class="col-sm-1 control-label" id="name_display_as_box">
                                Godown<span class="required"></span>  :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                <select name="godow" id="godow" class="form-control">
                            <option value="">Select</option>                                   
                            <?php foreach ($godown as $type) { ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo $type['godown_name']; ?></option>
                            <?php } ?>
                        </select>
                            </div> 
                        </div> -->
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                               <?= label('Product Name', $this, $user) ?> *<span class="required"></span>:
                            </label>
                            <div class="col-sm-9" id="name_input_box">
                                <table class="table">
                                    <tbody id="rowm">
                                        <tr id="add">
                                           <td class="col-sm-4">
                                                <input id="product_name" placeholder="Product Name" class="form-control" name="product_name" type="text">
                                                <input id="product_id" class="form-control phone" name="product_id" type="hidden" value="">
                                            </td>
                                             <td class="col-sm-2">
                                                <input id="p_quantity" placeholder="quantity" class="form-control two-digits price" name="p_quantity " type="text">
                                            </td>
                                            <td class="col-sm-2">
                                  <select name="p_unit_id" id="p_unit_id" class="form-control" data-validation="required">
                                                <?php foreach ($unit as $type) { ?>
                                        <option
                                            value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                        <?php } ?>
                                </select>
                                            </td>
                                            <td class="col-sm-2">
                                  <select name="p_godow" id="p_godow" class="form-control">
                            <!--<option value="">Select</option> -->                                    
                            <?php foreach ($godown as $type) { ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo $type['godown_name']; ?></option>
                            <?php } ?>
                        </select>
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" style="float: left"
                                                   title="Add More" id="addmore" class="btn btn-success"
                                                   href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                            </td>
                                        </tr>
                                </table>
                            </div>
                            <div class="form-group" id="name_field_box">
                            </div> 
                            <div class="box-footer">
                                <?php if ($view != 'view') { ?>
                                    <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                                <?php } ?>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->

                        <!-- /.row -->
                        </section>
                        <script type="text/javascript">

                            $(document).ready(function () {
                                /*$('#p_quantity').on('input',function(e){
                                    var pr_quantity = $(this).val();
                                    alert(pr_quantity);
                                });*/
                               var id = $("#id").val();
                                var idinc = 0;
                                $('#addmore').click(function () {
                                    var pmain_id = document.getElementById('product_id').value;
                                    var pmain_name = document.getElementById('product_name').value;
                                    var p_quantity = document.getElementById('p_quantity').value;
                                    var p_unit_id = document.getElementById('p_unit_id').value;
                                    var nameunit = $('#p_unit_id option:selected').text();
                                    var gid = document.getElementById('p_godow').value;
                                    var namegwn = $('#p_godow option:selected').text();
                                    newrow = '<tr><td ><input  class="form-control"    value="' + pmain_name + ' "type="text" disabled><input  value="' + pmain_id + '"  type="text" name="pmainid[' + idinc + ']"  class="hidden cre form-control"/></td>' +'<td ><input  class="form-control"  name="pqty[' + idinc + ']"  value="' + p_quantity + ' "type="text"></td>'+ '<td ><input  class="form-control"    value="' + nameunit + ' "type="text" disabled><input  value="' + p_unit_id + '"  type="text" name="p_unitid[' + idinc + ']"  class="hidden cre form-control"/></td>'+ 
                                    '<td ><input class="form-control" data-validation="required"  value="' + namegwn + ' "type="text" disabled ><input   value="' + gid + ' "type="text" name="mgid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits"/></td>' +
                                    /*'<td ><select class="form-control" data-validation="required"  value="' + namegwn + ' name="rgdwn[' + idinc + ']" ></select><input   value="' + gid + ' "type="text" name="rgdwn[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits"/></td>' +*/   
                                    '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                            if(pmain_id!=''  && p_quantity!='')
                                            {
                                    $("#rowm").append(newrow);
                                    idinc = idinc + 1;
                                    
                                    $('#product_name').val('');
                                 $('#p_quantity').val('');
                                 gid = "";
                                // addgodown(raw_id);

                             }
                                
                                });
                                $(document).on('click', ".remove", function () {
                                    $('.tooltip').remove();
                                    $(this).closest('tr').remove();
                                });
                            });
                            var id = $("#id").val();
                                                        //bmm_id  main_item_id    bmm_quantity    updatedate  mainitemid  mainitemname    subqty  subitemid   subitemname 
                            function formatDate(input) {
                                var datePart = input.match(/\d+/g),
                                year = datePart[0].substring(2), // get only two digits
                                month = datePart[1], day = datePart[2];
                                return day + '/' + month + '/' + year;
                            }
                            if(id!=0)
                            {
                                var idinc =0;
                            $.ajax({
                                url: "<?php echo site_url('material/material_product/getsing'); ?>/" + id,
                                success: function (result) {
                                    $.each(JSON.parse(result), function (i, itemsingle) {
                                        $('#username').val('');
                                        $('#r_godow').val('');
                                        $('#username').val(itemsingle.user_id);
                                        $('#r_godow').val(itemsingle.from_godown);
                                        $("#date").val(formatDate(itemsingle.created_on));
                                        var pmain_id = itemsingle.main_item_id;
                                        var pmain_name = itemsingle.itemname;
                                        var p_quantity = itemsingle.fga_quantity;
                                        var nameunit = itemsingle.unit;
                                        var p_unit_id = itemsingle.unitid;
                                        var namegwn = itemsingle.godown;
                                        var gid = itemsingle.godownid;
                                        newrow = '<tr><td ><input  class="form-control"    value="' + pmain_name + ' "type="text" disabled><input  value="' + pmain_id + '"  type="text" name="pmainid[' + idinc + ']"  class="hidden cre form-control"/></td>' +'<td ><input  class="form-control"  name="pqty[' + idinc + ']"  value="' + p_quantity + ' "type="text"></td>'+ '<td ><input  class="form-control"    value="' + nameunit + ' "type="text" disabled><input  value="' + p_unit_id + '"  type="text" name="p_unitid[' + idinc + ']"  class="hidden cre form-control"/></td>'+ 
                                    '<td ><input class="form-control" data-validation="required"  value="' + namegwn + ' "type="text" disabled ><input   value="' + gid + ' "type="text" name="mgid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits"/></td>' +
                                    '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                            $("#rowm").append(newrow);                                         idinc = idinc + 1;
                                        
                                            //addgodown(rawm_id,idinc);
                                    });

                                }
                            });
                        }
                        function addgodown(raw_id,idinc)
                        {
                            var is_godown = $("#is_godown").val();
                                if (is_godown === '1') {
                                    $.ajax({
                                        url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + raw_id,
                                        success: function (result) {
                                            $('#rgdwn'+idinc).html('');
                                            $('#rgdwn'+idinc).html(result);
                                            //var myTag = $('#godown').find(':selected').attr('stock');
                                         // $("#i_stock").html("Stock: " + myTag);
                                            //$("#rgdwn").focus();
                                        }
                                    });
                                }
                                if (is_godown === '0') {
                                    $.ajax({
                                        url: "<?php echo site_url('ajaxcall/godown'); ?>",
                                        success: function (result) {
                                            $('#rgdwn'+idinc).html(result);
                                        }
                                    });
                                    //$("#item_qty").focus().select();
                                }
                        }
                            $("#product_name").autocomplete({
                                source: "<?php echo site_url('material/material_product/mainitem'); ?>",
                                minLength: 2,
                                select: function (event, ui) {
                                    loaditema(ui);
                                }
                            });
                             $("#rawm_name").autocomplete({
                                source: "<?php echo site_url('material/material_product/subitems'); ?>",
                                minLength: 2,
                                select: function (event, ui) {
                                    loaditemb(ui);
                                }
                            });
                            var inc_inary = 0;
                            $(document).on('click', ".remove", function () {
                                $('.tooltip').remove();
                                $(this).closest('tr').remove();
                            });
                            var idinc = 0;
                            function loaditema(ui) {
                                $('#product_name').val(ui.item.label);
                                $('#product_id').val(ui.item.id);
                                $('#p_quantity').focus();
                             /*   var mainid = ui.item.id;
                                var idinc = 0;
                             $.ajax({
                                url: "<?php echo site_url('material/material_product/getproductsing'); ?>/" + mainid,
                                success: function (result) {
                                    $.each(JSON.parse(result), function (i, itemsingle) {
                                        idinc = idinc + 1;
                                         $('#product_name').val('');
                                         $('#product_name').val(itemsingle.mainitemname);
                                         $('#product_id').val(itemsingle.main_item_id);
                                         $('#p_quantity').val(itemsingle.bmm_quantity);
                                         $('#p_unit_id').val(itemsingle.mainunitid);
                                        var rawm_id = itemsingle.subitemid;
                                        var rawm_name = itemsingle.subitemname;
                                        var r_quantity = itemsingle.subqty;
                                        var nameunit = itemsingle.subunit;
                                        var r_unit_id = itemsingle.subunitid;
                                         var newrow = '<tr><td ><input  class="form-control"    value="' + rawm_name + ' "type="text" disabled><input  value="' + rawm_id + '"  type="text" name="rawmid[' + idinc + ']"  class="hidden cre form-control"/></td>' +'<td ><input  class="form-control"  name="rqty[' + idinc + ']"  value="' + r_quantity + ' "type="text"></td>'+
                                            '<td ><input  class="form-control"    value="' + nameunit + ' "type="text" disabled><input  value="' + r_unit_id + '"  type="text" name="r_unitid[' + idinc + ']"  class="hidden cre form-control"/></td>'+'<td><select class="form-control" id="rgdwn'+idinc+'" data-validation="required"  value="" name="rgdwn[' + idinc + ']" ></select></td>'+
                                            '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                            $("#rowm").append(newrow);
                                            addgodown(rawm_id,idinc);


                                    });

                                }
                            });*/
                            }
                            function loaditemb(ui) {
                                $('#rawm_name').val(ui.item.label);
                                $('#rawm_id').val(ui.item.id);
                                $('#r_quantity').focus();
                            }

                        </script> 