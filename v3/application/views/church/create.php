<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/family_head/create'); ?>" action="<?php echo site_url('church/family_head/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $type ?>" name="type" id="type" />  
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/family_head/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/family_head/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Family No*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="fno" class="form-control" name="fno" type="text" value="" data-validation="required" maxlength="50">              
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Parish<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="parish" id="parish" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($parish as $type) { ?>
                                        <option value="<?php echo $type['par_id']; ?>"><?php echo $type['par_name']; ?></option>
                                    <?php } ?>
                                </select>              
                            </div>  
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                House name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="housename" class="form-control addr" name="housename" type="text" value="" maxlength="50"></div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Father Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="father" class="form-control" name="father" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Mother Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="mother" class="form-control" name="mother" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Phone<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="phone" class="form-control" name="phone" type="text" value="" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Mobile<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="mobile" class="form-control" name="mobile" type="text" value="" maxlength="50">              
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
                                    <option value="Other">Other</option>
                                </select>       
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Diocese<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="diocese" id="diocese" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($diocese as $type) { ?>
                                        <option value="<?php echo $type['dio_id']; ?>"><?php echo $type['dio_name']; ?></option>
                                    <?php } ?>
                                </select>              
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">

                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Community<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="community" id="community" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($communities as $type) { ?>
                                        <option value="<?php echo $type['com_id']; ?>"><?php echo $type['com_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Ward<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="ward" id="ward" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($wards as $type) { ?>
                                        <option value="<?php echo $type['wrd_id']; ?>"><?php echo $type['wrd_name']; ?></option>
                                    <?php } ?> 
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">

                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Locality <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="locality" id="locality" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($land as $type) { ?>
                                        <option value="<?php echo $type['lnd_id']; ?>"><?php echo $type['lnd_name']; ?></option>
                                    <?php } ?> 
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Panchayath<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="panchayath" class="form-control" name="panchayath" type="text" value="" maxlength="50">  
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">

                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Village <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="village" id="village" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($village as $type) { ?>
                                        <option value="<?php echo $type['vlg_id']; ?>"><?php echo $type['vlg_name']; ?></option>
                                    <?php } ?>
                                </select>             
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Taluk<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="taluk" id="taluk" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($taluk as $type) { ?>
                                        <option value="<?php echo $type['tal_id']; ?>"><?php echo $type['tal_name']; ?></option>
                                    <?php } ?>
                                </select> 
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">

                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                District <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="district" id="district" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($district as $type) { ?>
                                        <option value="<?php echo $type['dist_id']; ?>"><?php echo $type['dist_name']; ?></option>
                                    <?php } ?>
                                </select>            
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Post Office<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="post_office" class="form-control addr" name="post_office" type="text" value=""  maxlength="50">              
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group " id="name_field_box">

                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Pin Code<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="pincode" class="form-control addr" name="pincode" type="text" value="" maxlength="50"></div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Address<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea readonly="readonly" name="address" id="address" class="form-control" >
                                    
                                </textarea> 
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">

                            <label class="col-sm-2 control-label" id="name_display_as_box">
                            </label>
                            <div class="col-sm-4" id="name_input_box">

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
            $(document).on('change', '#housename,#pincode,#post_office', function () {
                var text = '';
                var housename = $('#housename').val();
                var post_office = $('#post_office').val();
                var pincode = $('#pincode').val();
                if (housename !== "") {
                    text = text + housename + ' ,';
                }
                if (post_office !== "") {
                    text = text + post_office + ' P.O ,';
                }
                if (pincode !== "") {
                    text = text + pincode + ' ,';
                }
                $('#address').html(text.slice(0, -1));
            });

            load();
            $('#btnsave').click(function () {
                var ms = $("#frmcreate").isValid();
                alert(ms)
                if (ms !== true) {
                    return;
                }
            });
        });
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
                    url: "<?php echo site_url('church/family_head/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        //var areass = result.area;
                        // var routess = result.route; 
                        $("#gender").val(result.hed_gender);
                        $("#name").val(result.hed_name);
                        $("#fno").val(result.hed_familyno);
                        $("#housename").val(result.hed_housename);
                        $("#phone").val(result.hed_phone);
                        $("#mobile").val(result.hed_mobile);
                        $("#parish").val(result.parish_id);
                        $("#diocese").val(result.diocese_id);
                        $("#panchayath").val(result.panchayath);
                        $("#community").val(result.community_id);
                        $("#ward").val(result.ward_id);
                        $("#locality").val(result.land_id);
                        $("#father").val(result.hed_father);
                        $("#mother").val(result.hed_mother);
                        $("#village").val(result.vlg_id);
                        $("#taluk").val(result.tal_id);
                        $("#district").val(result.dist_id);
                        $("#post_office").val(result.post_office);
                        $("#pincode").val(result.pincode);
                        $('#pincode').trigger("change");
                    }
                });
            }
            /*
             $.ajax({
             url: "<?php echo site_url('ajaxcall/area'); ?>",
             success: function (result) {
             $('#area').html(result);
             }
             });
             $.ajax({
             url: "<?php echo site_url('ajaxcall/route'); ?>",
             success: function (result) {
             $('#route').html(result);
             }
             });*/

        }
    </script>