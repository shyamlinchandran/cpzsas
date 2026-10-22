<form method="post"  id="frmcreate" back="<?php echo site_url('clinic/Approvel/listall'); ?>" action="<?php echo site_url('clinic/Approvel/save'); ?>"  class="form-horizontal">
    <style type="text/css"></style>
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('clinic/Approvel/create'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('clinic/Approvel/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Patient Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input data-validation="required" type="hidden" name="customer_id" id="supid"/>
                                <input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer">         
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Phone<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="phone" class="form-control" name="phone" type="text" value="" maxlength="50"></div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Email<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="email" class="form-control" name="email" type="text" value="" maxlength="50"></div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Doctor<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="doc" id="doc" class="form-control" >
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Category<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="cat" id="cat" class="form-control hunpx" >
                                </select>              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Refered By<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="ref" class="form-control" name="ref" type="text" value="" maxlength="50"></div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Date<span class="required"></span>  :
                            </label>
                            <div class="col-sm-3" id="name_input_box">
                                <input name="date" type="text" id="date" data-validation="required" class="form-control  date" placeholder="Date">              
                            </div> 

                            <label class="col-sm-1 control-label" id="name_display_as_box">
                                At <span class="required"></span>  :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                <select name="at" id="at" class="form-control hunpx" >
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                For <span class="required"></span>  :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                <select name="from" id="from" class="form-control hunpx" >
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Planned Procedure<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="procedure" id="procedure" name="procedure"  class="form-control">
                                </select>
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Notes <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea rows="4" cols="50" name="notes" id="notes" class="form-control"> </textarea>            
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Approvel Notes <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea rows="10" cols="50" name="ap_note" data-validation="required" id="ap_note" class="form-control"> </textarea>            
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Approve<span class="required"></span>  :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                <select name="approve" id="approve" name="approve" class="form-control">
                                    <option value="Approve">Approve</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Reject">Reject</option>
                                </select>
                            </div> 
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
                </div>
            </div>
        </div> 
    </section>
</form>
<script type="text/javascript">

    $(document).ready(function () {
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/Patient'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Doctor'); ?>",
            success: function (result) {
                $('#doc').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Procedure'); ?>",
            success: function (result) {
                $('#procedure').html(result);
            }
        });
         var id = $("#id").val();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Schedule/'); ?>"+id,
            success: function (result) {
                $('#at').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Intervel'); ?>",
            success: function (result) {
                $('#from').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Cat'); ?>",
            success: function (result) {
                $('#cat').html(result);
            }
        });
        load();
    });
    var inc_inary = 0;
    // (document).on('click', ".remove", function () {
    //     $('.tooltip').remove();
    //     $(this).closest('tr').remove();
    // });
    function loadCustByid(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Patientbyid'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results)[0];
                $('#phone').val(result.Pat_Phone);
                $('#email').val(result.Pat_Email);
                $('#supid').val(result.Pat_Id);
                $('#supname').val(result.Pat_Name);
            }
        });
    }
    function loadCust(ui) {
        $('#phone').val(ui.item.Pat_Phone);
        $('#email').val(ui.item.Pat_Email);
        $('#supid').val(ui.item.Pat_Id);
        $('#cat').focus();
    }
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function load() {
        var id = $("#id").val();
        //alert(id);
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('clinic/Approvel/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#doc").val(result.Doc_Id);
                    $("#cat").val(result.Cat_Id);
                    $("#date").val(formatDate(result.Bok_Date));
                    $("#at").val(result.Shedule_id);
                    $("#from").val(result.Intervell_id);
                    $("#ap_note").val(result.Apr_Note);
//                    $("#approve").val(result.Bok_Approved);
                    $("#procedure").val(result.Bok_Proc_id);
                    $("#ref").val(result.Bok_Ref);
                    $("#notes").val(result.Bok_Note);
                    loadCustByid(result.Cus_Id);
                }
            });
        }



    }
</script>