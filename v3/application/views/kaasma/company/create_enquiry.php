<form method="post"  id="frmcreate" back="<?php echo site_url('kaasma/company/create'); ?>" enctype="multipart/form-data" action="<?php echo site_url('kaasma/company/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $enq_id ?>" name="enq_id" id="enq_id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('kaasma/company/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('kaasma/company/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Company Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                           <label class="col-sm-2 control-label" id="name_display_as_box">
                                Owner Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="owner_name" class="form-control" name="owner_name" type="text" value="" maxlength="50"></div>
                        </div>
                         <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                District<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="district_id" id="district_id" class="form-control" >
                                    <option value="">Select</option>
                                    <!-- <?php foreach ($enq_status as $type) { ?>
                                        <option value="<?php echo $type['est_id']; ?>"><?php echo $type['est_name']; ?></option>
                                    <?php } ?> -->
                                </select>            
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Location<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="location" class="form-control" name="location" type="text" value=""  maxlength="50">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Phone*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="phone" pattern="[0-9]{0,13}" class="form-control" name="phone" type="text" value="" maxlength="13" data-validation="required"></div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Email<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="email" class="form-control" name="email" type="text" value="" maxlength="50"></div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                No of Branches<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="tot_branch" class="form-control" name="tot_branch" type="text" value="" maxlength="50"></div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Rate of Interest%<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="interest_p" class="form-control two-digits price" name="interest_p" type="text" value="" maxlength="6">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Customer Type<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <select name="cus_type" id="cus_type" class="form-control" >
                                    <option value="">Select</option>
                                </select>              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Slab<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="slab_id" id="slab_id" class="form-control" >
                                    <option value="">Select</option>
                                </select>              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Location Photo<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                  <input type="file" id="file" name="file" />           
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                PIN Code<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="pincode" class="form-control" name="pincode" type="text" value="" maxlength="50">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Contact Person <span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="contact_p" class="form-control" name="contact_p" type="text" value="" maxlength="50">             
                            </div> 
                             <label class="col-sm-2 control-label" id="name_display_as_box">
                                Phone<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="contact_phone" class="form-control" name="contact_phone" type="text" value="" maxlength="50">           
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                             <label class="col-sm-2 control-label" id="name_display_as_box">
                                Address<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="address" data-validation="required" class="form-control" name="address" cols="30" rows="50"></textarea>              
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
            $('#mybtn').click(function () {
            var ms = $("#frmcreate").isValid();
            if (ms !== true) {
                return;
            }


        });
            load();
            getdistricts();
            getcusttype();
            getslabs();
        });
        var inc_inary = 0;
       function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function getdistricts()
    {
        $.ajax({
            url: "<?php echo site_url('kaasma/common_call/getdistricts'); ?>/",
            async: false,
             success: function (result) {
                $("#district_id").html(result);
            }
        });
    }
    function getcusttype()
    {
        $.ajax({
            url: "<?php echo site_url('kaasma/common_call/getcusttype'); ?>/",
            async: false,
             success: function (result) {
                $("#cus_type").html(result);
            }
        });
    }
    /*function getcontactp()
    {
        $.ajax({
            url: "<?php echo site_url('kaasma/common_call/getcontactp'); ?>/",
            async: false,
             success: function (result) {
                $("#contact_p").html(result);
            }
        });
    }*/
    function getslabs()
    {
        $.ajax({
            url: "<?php echo site_url('kaasma/common_call/getslabs'); ?>/",
            async: false,
             success: function (result) {
                $("#slab_id").html(result);
            }
        });
    }
        function load() {
            var enq_id = $("#enq_id").val();
            //alert(id);
            if (enq_id > 0) {
                $.ajax({
                    url: "<?php echo site_url('kaasma/enquiry/getsing'); ?>/" + enq_id,
                    success: function (results) {
                        var result = JSON.parse(results);
                         var enq_status = result.enq_status;
                        var routess = result.route;
                        $("#name").val(result.enq_contact_person);
                        $("#email").val(result.enq_email);
                        $("#phone").val(result.enq_phone);
                        $("#contact_p").val(result.enq_company);
                        $("#contact_phone").val(result.enq_co_phone);
                        $("#tot_branch").val(result.enq_total_branches);
                        $("#owner_name").val(result.enq_co_owner);
                        }
                });
            }

            }
    </script>