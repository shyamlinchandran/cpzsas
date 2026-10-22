<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/baptism_register/create'); ?>" action="<?php echo site_url('church/baptism_register/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/baptism_register/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/baptism_register/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>             
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Date <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="baptised_on" class="form-control  date" name="baptised_on" type="text" value="" maxlength="50"> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Family /  No<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="familyno" class="form-control" name="familyno" type="text" value="" maxlength="50" data-validation="required"> 
                                <input type="hidden" value="" name="familyid" id="familyid" /> 
                                <input type="hidden" value="" name="ledgerid" id="ledgerid" />          
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Diocese<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="diocese" class="form-control text" name="diocese" type="text" value="" maxlength="50" readonly="readonly"> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Locality<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="locality" class="form-control text" name="locality" type="text" value="" maxlength="50" readonly="readonly"> 
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Father's Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="dad_name" id="dad_name" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Mother's Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="mom_name" id="mom_name" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Child Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="child_name" id="child_name" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Date of Birth<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="dateofb" class="form-control hunpx date" name="dateofb" type="text" value="" maxlength="50"> 
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Gender<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select id="gender" name="gender" class="form-control" data-validation="required">
                                    <option style="text-align: center" value="">--Select Gender--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>    
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                               Child  Details<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="child_details" class="form-control" name="child_details" rows="10" cols="20"></textarea>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Blessed by Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="bless_name" class="form-control text" name="bless_name" type="text" value="" maxlength="50"> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Blessed by Details<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="bless_details" class="form-control" name="bless_details" rows="10" cols="20"></textarea>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Priest Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="father_name" id="father_name" class="form-control">
                                    <option value="">Select</option>
                                </select> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Priest Details<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="father_details" class="form-control" name="father_details" rows="10" cols="20"></textarea>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Place of Birth<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="place" class="form-control text" name="place" type="text" value="" maxlength="50"> 

                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Address<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="address" class="form-control" name="address" rows="10" cols="20"></textarea>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Charges <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="amount" class="form-control  two-digits price" name="amount" type="text" value="" maxlength="50">  
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Remarks <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="remarks" class="form-control" name="remarks" rows="10" cols="20"></textarea>            
                            </div> 
                        </div>


                        <div class="form-group" id="name_field_box">
                        </div> 
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>     
            </div>
            <!-- /.row -->
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
            load();
            $('#btnsave').click(function () {
                var ms = $("#frmcreate").isValid();
                alert(ms);
                if (ms !== true) {
                    return;
                }
            });
        });
        function loadFamily(ui) {
            var text = "";
            if (ui.item.hed_housename !== "") {
                text = text + ui.item.hed_housename + ' ,';
            }
            if (ui.item.post_office !== "") {
                text = text + ui.item.post_office + ' P.O ,';
            }
            if (ui.item.pincode !== "") {
                text = text + ui.item.pincode + ' P.O ,';
            }
            $('#address').html(text.slice(0, -1));
            $('#familyno').val(ui.item.family);
            $('#familyid').val(ui.item.hed_id);
            $('#houseno').val(ui.item.hed_housename);
            $('#diocese').val(ui.item.dio_name);
            $('#locality').val(ui.item.lnd_name);
            getparents(ui.item.hed_id);
        }
        function getparents(head_id)
        {
            $.ajax({
                url: "<?php echo site_url('church/baptism_register/getparents'); ?>/" + head_id,
                async: false,
                success: function (result) {
                    $('#dad_name').html(result);
                    $('#mom_name').html(result);
                    $('#child_name').html(result);
                    //$('#unit_item').val(unit_id);
                    //$("#item_qty").focus();
                }
            });
        }
        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                    year = datePart[0].substring(2), // get only two digits
                    month = datePart[1], day = datePart[2];

            return day + '/' + month + '/' + year;
        }
        var inc_inary = 0;
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });

        function load() {
            var id = $("#id").val();
            //alert(id);
            if (id > 0) {
                $.ajax({

                    url: "<?php echo site_url('church/baptism_register/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        getparents(result.hed_id);//load family details
                        var dad_id = result.dadid;
                        var momid = result.momid;
                        var kidid = result.kidid;
                        var father = result.father_id;
                        $("#place").val(result.place_of_birth);
                        $("#address").val(result.address);
                        $("#gender").val(result.child_gender);
                        $("#child_details").val(result.child_details);
                        $("#familyid").val(result.hed_id);
                        $("#familyno").val(result.familydtl);
                        $("#dad_name").val(dad_id);
                        $("#mom_name").val(momid);
                        $("#child_name").val(kidid);
                        $("#diocese").val(result.dio);
                        $("#locality").val(result.land);
                        $("#dateofb").val(formatDate(result.date_of_birth));
                        $("#baptised_on").val(formatDate(result.bap_date));
                        $("#bless_name").val(result.blessed_name);
                        $("#bless_details").val(result.blessed_details);
                        $("#father_name").val(father);
                        $("#father_details").val(result.father_details);
                        $("#amount").val(result.bap_amount);
                        $("#remarks").val(result.bap_remarks);
                    }
                });
            }
            $("#familyno").autocomplete({
                source: "<?php echo site_url('church/baptism_register/family_name/'); ?>",
                minLength: 1,
                select: function (event, ui) {
                    loadFamily(ui);

                }
            });
            $.ajax({
                url: "<?php echo site_url('church/baptism_register/getfathers'); ?>",
                async: false,
                success: function (result) {
                    $('#father_name').html(result);
                }
            });
        }
    </script>