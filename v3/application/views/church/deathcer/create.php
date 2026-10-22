<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/deathcer_register/create'); ?>" action="<?php echo site_url('church/deathcer_register/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/deathcer_register/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/deathcer_register/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>           
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                               Deceased Date <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="death_date" class="form-control hunpx date" name="death_date" type="text" value="" maxlength="50"> 
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                               Cremated on <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="cremate_date" class="form-control hunpx date" name="cremate_date" type="text" value="" maxlength="50"> 
                            </div>                            
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                           <label class="col-sm-2 control-label" id="name_display_as_box">
                                Family /  No<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                 <input id="familyno" class="form-control" name="familyno" type="text" value="" maxlength="50" data-validation="required"> 
                                 <input type="hidden" value="" name="familyid" id="familyid" /> 
                                  <input type="hidden" value="" name="ledgerid" id="ledgerid" />          
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Deceased Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                 <select name="dc_name" id="dc_name" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div>  
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                           <label class="col-sm-2 control-label" id="name_display_as_box">
                                Age<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="dc_age" class="form-control" name="dc_age" type="text" value="" maxlength="50"> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Reason/Disease*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                 <input id="dc_reason" class="form-control" name="dc_reason" type="text" value="" maxlength="50"> 
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
                                Charges <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="amount" class="form-control two-digits price" name="amount" type="text" value="" maxlength="50">  
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
                alert(ms)
                if (ms !== true) {
                    return;
                }
            });
        });
         function loadFamily(ui) {
        $('#familyno').val(ui.item.family);
        $('#familyid').val(ui.item.hed_id);
        $('#houseno').val(ui.item.hed_housename);
        $('#diocese').val(ui.item.dio_name);
        $('#locality').val(ui.item.lnd_name);
        getperson(ui.item.hed_id);
        }
        function getperson(head_id)
        {
            $.ajax({
                url: "<?php echo site_url('church/deathcer_register/getperson'); ?>/" + head_id,
                async:false,
                success: function (result) {
                    $('#dc_name').html(result);
                    $("#dc_name").focus();
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
                    url: "<?php echo site_url('church/deathcer_register/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#familyid").val(result.hed_id);
                        var person_id = result.fmm_id; 
                        getperson(result.hed_id);
                        $("#familyno").val(result.familydtl);
                        $("#dc_name").val(person_id);
                        $("#dc_age").val(result.fmm_age);
                        $("#dc_reason").val(result.crr_death_reason);
                        $("#death_date").val(formatDate(result.crr_death_date));
                        $("#cremate_date").val(formatDate(result.crr_date));
                        $("#amount").val(result.crr_charges);
                        $("#father_name").val(result.father_id);
                        $("#father_details").val(result.father_details);
                        $("#remarks").val(result.crr_remarks);
                    }
                });
            }
            $("#familyno").autocomplete({
                source: "<?php echo site_url('church/deathcer_register/family_name/'); ?>",
                async:false,
                minLength: 1,
                select: function (event, ui) {
                    loadFamily(ui);

                   }
            });
            $.ajax({
                url: "<?php echo site_url('church/deathcer_register/getfathers'); ?>" ,
                success: function (result) {
                    $('#father_name').html(result);
                    }
            });
        }
    </script>