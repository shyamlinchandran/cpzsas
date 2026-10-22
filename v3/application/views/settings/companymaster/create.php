<form method="post"  id="frmcreate" back="<?php echo site_url('settings/CompanyMaster/create'); ?>" action="<?php echo site_url('settings/CompanyMaster/save'); ?>"  class="form-horizontal">
    
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Company Master</h3>
                    </div>

                    <div class="box-body">
					<div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                 Group Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="grpname" class="form-control" name="grpname" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
						<div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                 Number Of Sub Company<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="no_sub_company" class="form-control" name="no_sub_company" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
						<div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                 Contact Person<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="contact_person" class="form-control" name="contact_person" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
						<div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                 Contact Number<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="contact_number" class="form-control" name="contact_number" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
					<div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                  Address<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="address" class="form-control" name="address" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
						 <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                              Created Date<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input id="created_date" class="form-control date" name="created_date" type="text"   maxlength="50">              
                            </div> 
                        </div>
						<div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                 Created By<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="created_by" class="form-control" name="created_by" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
						 <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                              End Date<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input id="end_date" class="form-control date" name="end_date" type="text"   maxlength="50">              
                            </div> 
                        </div>
						<div class="form-group" id="check_From">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                 Subscription<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
							<select name="Subscription" data-validation="required" id="Subscription" data-validation="required"  class="form-control" >
                                        <option value="">Select</option>
                                        <?php foreach ($drs as $type) { ?>
                                            <option value="<?php echo $type['subid']; ?>"><?php echo $type['subcription_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                 
                            </div> 
                        </div>
                    <div class="box-footer">  
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
           
            $("#Subscription").autocomplete({
                source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
                minLength: 2,
                select: function (event, ui) {
                    $("#chq_frm").val(ui.item.id);
                }
            });
           

        });
        
    </script>