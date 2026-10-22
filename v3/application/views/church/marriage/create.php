<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/marriage_register/create'); ?>" action="<?php echo site_url('church/marriage_register/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/marriage_register/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/marriage_register/listall'); ?>">
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
                               <input id="married_on" class="form-control hunpx date" name="married_on" type="text" value="" maxlength="50"> 
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Parish<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="parish_main" id="parish_main" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($parish as $type) { ?>
                                        <option value="<?php echo $type['par_id']; ?>"><?php echo $type['par_name']; ?></option>
                                    <?php } ?>
                                </select>              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Diocese<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="diocese_main" id="diocese_main" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($diocese as $type) { ?>
                                        <option value="<?php echo $type['dio_id']; ?>"><?php echo $type['dio_name']; ?></option>
                                    <?php } ?>
                                </select>              
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                           <h4 class="col-sm-4">Bridegroom Details</h4>
                           <div class="col-sm-4">
                           </div>
                           <h4 class="col-sm-4">Bride Details</h4>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Family /  No<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                 <input id="familynoa" class="form-control" name="familynoa" type="text" value="" maxlength="50" data-validation="required"> 
                                 <input type="hidden" value="" name="familyida" id="familyida" /> 
                                  <input type="hidden" value="" name="ledgerida" id="ledgerida" />          
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Family /  No<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                 <input id="familynob" class="form-control" name="familynob" type="text" value="" maxlength="50" data-validation="required"> 
                                 <input type="hidden" value="" name="familyidb" id="familyidb" /> 
                                  <input type="hidden" value="" name="ledgeridb" id="ledgeridb" />          
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                           <label class="col-sm-2 control-label" id="name_display_as_box">
                                Diocese<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="diocesea" class="form-control text" name="diocesea" type="text" value="" maxlength="50" readonly="readonly"> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Diocese<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="dioceseb" class="form-control text" name="dioceseb" type="text" value="" maxlength="50" readonly="readonly"> 
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Locality<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="localitya" class="form-control text" name="localitya" type="text" value="" maxlength="50" readonly="readonly"> 
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Locality<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="localityb" class="form-control text" name="localityb" type="text" value="" maxlength="50" readonly="readonly"> 
                            </div>    
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Father's Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="dad_namea" id="dad_namea" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Father's Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="dad_nameb" id="dad_nameb" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div>
                         </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Mother's Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="mom_namea" id="mom_namea" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Mother's Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="mom_nameb" id="mom_nameb" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Bridegroom Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="bridegr_name" id="bridegr_name" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Bride Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="bride_name" id="bride_name" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Witness 1<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="witnessa" class="form-control text" name="witnessa" type="text" value="" maxlength="50"> 
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Witness 2<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="witnessb" class="form-control text" name="witnessb" type="text" value="" maxlength="50"> 
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
                alert(ms)
                if (ms !== true) {
                    return;
                }
            });
        });
         function loadFamilya(ui) {
        $('#familynoa').val(ui.item.family);
        $('#familyida').val(ui.item.hed_id);
        $('#diocesea').val(ui.item.dio_name);
        $('#localitya').val(ui.item.lnd_name);
        getparentsa(ui.item.hed_id);
        }
         function loadFamilyb(ui) {
        $('#familynob').val(ui.item.family);
        $('#familyidb').val(ui.item.hed_id);
        $('#dioceseb').val(ui.item.dio_name);
        $('#localityb').val(ui.item.lnd_name);
        getparentsb(ui.item.hed_id);
        }
        function getparentsa(head_id)
        {
            $.ajax({
                url: "<?php echo site_url('church/marriage_register/getparents'); ?>/" + head_id,
                async:false,
                success: function (result) {
                    $('#dad_namea').html(result);
                    $('#mom_namea').html(result);
                    $('#bridegr_name').html(result);
                }
            });
        } 
        function getparentsb(head_id)
        {
            $.ajax({
                url: "<?php echo site_url('church/marriage_register/getparents'); ?>/" + head_id,
                async:false,
                success: function (result) {
                    $('#dad_nameb').html(result);
                    $('#mom_nameb').html(result);
                    $('#bride_name').html(result);
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
                    url: "<?php echo site_url('church/marriage_register/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        var parish_main = result.parish_id;
                        var diocese_main = result.dio_id;
                        var dadaid = result.dada_id;
                        var dadbid = result.dadb_id;
                        var momaid = result.moma_id;
                        var mombid = result.momb_id;
                        var bridegr_id = result.bride_groom_id;
                        var bride_id = result.bride_id;
                        var father = result.father_id;
                        $("#familyida").val(result.hed_id_a);
                        getparentsa(result.hed_id_a); //load bridegroom family
                        $("#familyidb").val(result.hed_id_b);
                        getparentsb(result.hed_id_b); //load bride family
                        $("#parish_main").val(parish_main);
                        $("#diocese_main").val(diocese_main);
                        $("#dad_namea").val(dadaid);
                        $("#dad_nameb").val(dadbid);
                        $("#mom_namea").val(momaid);
                        $("#mom_nameb").val(mombid);
                        $("#bridegr_name").val(bridegr_id);
                        $("#bride_name").val(bride_id);
                        $("#married_on").val(formatDate(result.wedding_date));
                        $("#diocesea").val(result.dioa);
                        $("#dioceseb").val(result.diob);
                        $("#localitya").val(result.landa);
                        $("#localityb").val(result.landb);
                        $("#familynoa").val(result.familyadtl);
                        $("#familynob").val(result.familybdtl);
                        $("#witnessa").val(result.witnessa);
                        $("#witnessb").val(result.witnessb);
                        $("#father_name").val(father);
                        $("#father_details").val(result.father_details);
                        $("#amount").val(result.mrg_amount);
                        $("#remarks").val(result.mrg_details);
                    }
                });
            }
            $("#familynoa").autocomplete({
                source: "<?php echo site_url('church/marriage_register/family_name/'); ?>",
                minLength: 1,
                select: function (event, ui) {
                    loadFamilya(ui);

                   }
            });
            $("#familynob").autocomplete({
                source: "<?php echo site_url('church/marriage_register/family_name/'); ?>",
                minLength: 1,
                select: function (event, ui) {
                    loadFamilyb(ui);

                   }
            });
            $.ajax({
                url: "<?php echo site_url('church/baptism_register/getfathers'); ?>" ,
                async:false,
                success: function (result) {
                    $('#father_name').html(result);
                    $("#father_details").focus();
                }
            });
        }
    </script>