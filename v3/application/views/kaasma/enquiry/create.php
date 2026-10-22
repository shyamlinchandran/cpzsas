<form method="post"  id="frmcreate" enctype="multipart/form-data" back="<?php echo site_url('kaasma/enquiry/create'); ?>" action="<?php echo site_url('kaasma/enquiry/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $enq_no; ?>" name="enq_no_add" id="enq_no_add" />
    <section class="content"> 
        <div class="row">
           <!--  data-validation="server" data-validation-url="<?php echo site_url('kaasma/enquiry/save'); ?>" -->
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('kaasma/enquiry/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('kaasma/enquiry/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 

                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Enquiry No*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="enq_no" class="form-control" name="enq_no" type="text" value="" data-validation="required" maxlength="50" readonly="readonly">              
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Enquiry Date<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="enq_date" class="form-control date" name="enq_date" type="text" value="" data-validation="required" maxlength="50"></div>
                           <!--  <label class="col-sm-2 control-label" id="name_display_as_box">
                                Status<span class="required"></span>  :
                            </label> -->
                            <div class="col-sm-4" id="name_input_box">
                              <!--  <select name="enq_status" id="enq_status" class="form-control" >
                                    <?php foreach ($enq_status as $type) { ?>
                                        <option value="<?php echo $type['est_id']; ?>"><?php echo $type['est_name']; ?></option>
                                    <?php } ?>
                                </select> -->
                                </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                             <label class="col-sm-2 control-label" id="name_display_as_box">
                                Contact Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Company Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="coname" class="form-control" name="coname" type="text" value="" maxlength="50"></div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Phone<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="phone" pattern="[0-9]{0,13}" class="form-control" name="phone" type="text" value="" maxlength="13 ">
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Company Phone<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="cophone" pattern="[0-9]{0,13}" class="form-control" name="cophone" type="text" value="" maxlength="13"></div>
                           </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Email*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="email" class="form-control" name="email" type="text" value="" maxlength="50" data-validation="email"></div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                No of Branches<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="tot_branch" class="form-control" name="tot_branch" type="text" value="" maxlength="50"></div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Owner Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="owner_name" class="form-control" name="owner_name" type="text" value="" maxlength="50"></div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Owner Phone<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="owner_phone" pattern="[0-9]{0,13}" class="form-control" name="owner_phone" type="text" value="" maxlength="13 ">
                            </div>
                            
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <!-- <label class="col-sm-2 control-label" id="name_display_as_box">
                                Employee<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <select name="user_id" id="user_id" class="form-control" >
                                    <option value="">Select</option>
                                </select>              
                            </div> -->
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Location Photo<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input type="file" id="file" name="file" /> 
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Updated Date<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="enq_up_date" class="form-control date" name="enq_up_date" type="text" value="" data-validation="required" maxlength="50"></div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Remarks<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="remarks" class="form-control" name="remarks" cols="30" rows="50"></textarea>              
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
                <!-- /.row -->
            </div>
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
            load();
            getusers();
        });
        var inc_inary = 0;
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });
        function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function getusers()
    {
        $.ajax({
            url: "<?php echo site_url('kaasma/common_call/getusers'); ?>/",
            async: false,
             success: function (result) {
                $("#user_id").html(result);
            }
        });
    }
        function load() {
            var id = $("#id").val();
            //alert(id);
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('kaasma/enquiry/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        //var enq_status = result.enq_status;
                        $("#name").val(result.enq_contact_person);
                        $("#email").val(result.enq_email);
                        $("#phone").val(result.enq_phone);
                        $("#enq_no").val(result.enq_no);
                        $("#enq_date").val(formatDate(result.enq_created_on));
                        $("#enq_up_date").val(formatDate(result.enq_updated));
                        $("#coname").val(result.enq_company);
                        $("#cophone").val(result.enq_co_phone);
                        $("#tot_branch").val(result.enq_total_branches);
                        $("#owner_name").val(result.enq_co_owner);
                        $("#owner_phone").val(result.enq_owner_phone);    
                        //$("#enq_status").val(enq_status);
                        //$("#user_id").val(result.re_user);
                        $("#remarks").val(result.enq_remarks);
                    }
                });
            }
            else
            {
                var newenq = $("#enq_no_add").val();
                $("#enq_no").val(newenq);
            }

            }
    </script>