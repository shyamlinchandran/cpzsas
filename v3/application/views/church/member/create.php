<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/family_members/create/') . $head_id; ?>" action="<?php echo site_url('church/family_members/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input  type="hidden" value="<?php echo $head_id; ?>" id="head_id" name="head_id"/>  
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/family_members/listall/') . $head_id; ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/family_members/listall/') . $head_id; ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>             
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Relation with head<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="relation" id="relation" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach ($relations as $type) { ?>
                                        <option value="<?php echo $type['rel_id']; ?>"><?php echo $type['rel_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
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
                                Date of birth<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="dob" class="form-control  date" name="dob" type="text" value="" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Age<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="age" class="form-control" name="age" type="text" value="" maxlength="50">              
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
                                Education<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="education" class="form-control" name="education" type="text" value="" maxlength="50">              
                            </div> 

                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Baptised on<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="baptised_on" class="form-control  date" name="baptised_on" type="text" value="" maxlength="50"> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Married on  <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="married_on" class="form-control  date" name="married_on" type="text" value="" maxlength="50"> 
                            </div> 

                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Job <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="job" class="form-control" name="job" type="text" maxlength="50">
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Remarks<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="remarks" class="form-control" name="remarks" type="text" value="" maxlength="50">  
                            </div><!-- 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Village <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="village" class="form-control" name="village" type="text" value="" maxlength="50">             
                            </div>  -->
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
                alert(ms)
                if (ms !== true) {
                    return;
                }
            });
        });
        function formatDate(input) {
            if(input===null){
                return '';
            }
            var datePart = input.match(/\d+/g),
                    year = datePart[0].substring(0), // get only two digits
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
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('church/family_members/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        //var areass = result.area;
                        //var routess = result.route; 
                        $("#name").val(result.mbr_name);
                        $("#relation").val(result.mbr_relation);
                        $("#hed_id").val(result.hed_id);
                        $("#dob").val(formatDate(result.mbr_dob));
                        $("#age").val(result.mbr_age);
                        $("#education").val(result.mbr_education);
                        $("#baptised_on").val(formatDate(result.mbr_baptised_on));
                        $("#married_on").val(formatDate(result.mbr_married_on));
                        $("#job").val(result.mbr_job);
                        $("#remarks").val(result.mbr_remarks);
                        $("#father").val(result.member_father);
                        $("#mother").val(result.member_mother);
                        $("#gender").val(result.member_gender);
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