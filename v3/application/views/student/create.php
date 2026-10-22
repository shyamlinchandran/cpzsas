<?php
$com_tax_type = $settings[0]['com_tax_type'];
$state = 'District';
$is_calendar = 0;	
$txt_name = '';
if(isset($settings[0]['is_calendar'])){
	$is_calendar = $settings[0]['is_calendar'];
	$state = 'State';
	$txt_name ='First ';
}
?>
<form method="post" id="frmcreatemodelc" enctype="multipart/form-data"
    back="<?php echo site_url('education/Student/listall'); ?>"
    action="<?php echo site_url('education/Student/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $type ?>" name="type" id="type" />
    <input type="hidden" value="<?= $enq_id ?>" name="enq" id="enq" />
    <input type="hidden" value="<?= $option ?>" name="option" id="option" />
    <input type="hidden" value="" name="totalfees" id="totalfees" />
    <input type="hidden" value="" name="discountpercs" id="discountpercs" />
    <input type="hidden" value="<?= $view ?>" name="view" id="view" />
    <input type="hidden" value="<?= $com_tax_type ?>" name="tax_type" id="tax_type" />
    <input type="hidden" value="<?= $eid ?>" name="eid" id="eid" />
    <input type="hidden" id="is_model" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Student Create', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('customers/listall/' . $type); ?>"
                                class="btn  btn-success align-bottom"
                                href="<?php echo site_url('education/Student/listall/' . $type); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">


                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label($txt_name.'Name', $this, $user) ?>*<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="name" class="form-control" name="name" type="text" value=""
                                        data-validation="required" maxlength="50">
                                </div>
                            </div>
							<?php if((float) $is_calendar > 0 ){?>
								<div class="col-sm-6 form-group">
									<label class="col-sm-4 control-label">
										<?= label('Last Name', $this, $user) ?>*<span class="required"></span> :
									</label>
									<div class="col-sm-8">
										<input id="last_name"  class="form-control" name="last_name" type="text" value=""
											 <?php if((float) $is_calendar < 1 ){?>data-validation="required"<?php } ?> maxlength="50">
									</div>
								</div>
							<?php } ?>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Phone', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="phone" data-validation="required" class="form-control required"
                                        name="phone" type="text" value="" maxlength="50">

                                </div>
                            </div>
								<?php if((float) $is_calendar > 0 ){?>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Contact Person', $this, $user) ?>*<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="contact_name" class="form-control" name="contact_name" type="text" value=""
                                         <?php if((float) $is_calendar < 1 ){?>data-validation="required"<?php } ?> maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Contact No', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="contact_no"  <?php if((float) $is_calendar < 1 ){?>data-validation="required"<?php } ?> class="form-control required"
                                        name="contact_no" type="text" value="" maxlength="50">

                                </div>
                            </div>
							<div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Emergency Contact', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="emergency_contact" <?php if((float) $is_calendar < 1 ){?>data-validation="required"<?php } ?> class="form-control required"
                                        name="emergency_contact" type="text" value="" maxlength="50">

                                </div>
                            </div>
							<div class="col-sm-6 form-group">
							&nbsp;
							</div>
							
						
						<?php } ?>
                        </div>
					
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Email', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="email" style="text-transform: lowercase" class="form-control"
                                        <?php if((float) $is_calendar < 1 ){?>data-validation="email" data-validation-optional="true"<?php } ?>  name="email" type="text"
                                        value="" maxlength="50"></div>
                            </div>


                            <div  <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label($state, $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="states_cus" id="states_cus" class="form-control">
                                        <option value="">Select</option>
                                    </select>

                                </div>

                            </div>
                        </div>


                        <div <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?> class="col-sm-12 ">
                            <div  class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Pin Code', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input <?php if((float) $is_calendar > 0 ){ echo 'value="0"';}?> id="stcode" class="form-control" 
                                        <?php if((float) $is_calendar < 1 ){?>data-validation="required number"<?php } ?>  name="stcode" type="text" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Lan Number', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="lan" class="form-control" name="lan" type="text" data-validation=""
                                        value="" maxlength="50"></div>
                            </div>
                        </div>


                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address line1', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <textarea id="addr1" class="form-control" NoTab="NoTab" <?php if((float) $is_calendar < 1 ){?>data-validation="required"<?php } ?> 
                                        name="addr1" type="text"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address line2', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <textarea t id="addr2" class="form-control" NoTab="NoTab" name="addr2"
                                        type="text"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 ">
                            <div <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Aadhar', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="aadhar" class="form-control" NoTab="NoTab" name="aadhar"
                                        type="text"></textarea>
                                </div>
                            </div>
							<div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Gender', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8" style="display:inline;padding-top:5px">
                                    <input type="radio" name="gender" value="female" checked="checked"> Female
                                    &nbsp;&nbsp;
                                    <input type="radio" name="gender" value="male"> Male &nbsp;&nbsp;
                                    <input type="radio" name="gender" value="other"> Other
                                </div>
                            </div>
                           
                        </div>


                        <div class="col-sm-12 ">
                             <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('Date Of Birth', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="dob" class="form-control " style="height:25px ; padding: 3px;"
                                        NoTab="NoTab" name="dob" type="date"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Age', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input t id="age" class="form-control" <?php if((float) $is_calendar < 1 ){?>data-validation="required number"<?php } ?> 
                                        NoTab="NoTab" name="age" type="text"></textarea>
                                </div>
                            </div>
                        </div>


                        <div <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?> class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Father Name', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="father" class="form-control" NoTab="NoTab" <?php if((float) $is_calendar < 1 ){?>data-validation="required"<?php } ?> 
                                        name="father" type="text"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Mother Name', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input t id="mother" class="form-control" NoTab="NoTab" name="mother"
                                        type="text"></textarea>
                                </div>
                            </div>
                        </div>


                        <div <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?> class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Qualification', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="qualify" name="qualify" class="form-control" data-validation="required">
                                        <option value="">Select</option>
                                    </select>

                                </div>
                            </div>
                            <!--                             
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('select', $this, $user) ?> <span class="required"></span> 
                                </label>
                                <div class="col-sm-8">
                                    <select id="q_id" name="q_id" class="form-control">
                                        <option>select</option>
                                    </select>
                                </div>
                            </div> -->


                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Qualified Status', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8" style="display:inline;padding-top:5px">
                                    <input type="radio" name="qual" value="passed" checked="checked"> Passed &nbsp;
                                    <input type="radio" name="qual" value="failed"> failed &nbsp;
                                    <input type="radio" name="qual" value="other"> other
                                </div>
                            </div>
                        </div>


                        <div  <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?> class="col-sm-12 hidd">


                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label("Admission Type", $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="adm_type" id="adm_type" class="form-control">
                                    </select>

                                </div>

                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Materials Provided', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8" style="display:inline;padding-top:5px">
                                    <input type="radio" name="mat" value="yes"> Yes &nbsp;
                                    <input type="radio" name="mat" value="no" checked="checked"> No
                                </div>
                            </div>

                            <!-- <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('University', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="universe" id="universe" class="form-control required" required="required">

                                    </select>
                                </div>
                            </div> -->

                        </div>


                        <!-- <div class="col-sm-12 "> -->
                        <!-- <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Enrollment Number', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="enroll" class="form-control" NoTab="NoTab" name="enroll" type="number"></textarea>
                                </div>
                            </div> -->
                        <!-- <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Materials Provided', $this, $user) ?><span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8" style="display:inline;padding-top:5px">
                                        <input type="radio" name="mat" value="yes"> Yes &nbsp;
                                        <input type="radio" name="mat" value="no" checked="checked"> No
                                    </div>
                                </div> -->
                        <!-- </div> -->


                        <div class="col-sm-12 hidd">

                            <!-- <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Select Course', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="course" id="course" class="form-control required" required="required">

                                    </select>
                                </div>
                            </div> -->

                            <!-- <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Total Fee', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="cost" class="form-control " name="cost" type="text" value="" maxlength="50">
                                </div>
                            </div> -->

                            <!-- <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Batch', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="batch" class="form-control required" id="batch" class="form-control" required="required">

                                    </select>
                                </div>
                            </div> -->

                            <!-- <div class="col-sm-6 form-group hidd">

                                <label class="col-sm-4 control-label">
                                    <?= label('Reference mode ', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="ref" class="form-control" name="ref" type="text" value="" maxlength="50">


                                    </select>
                                </div>
                            </div> -->

                            <div <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?>  class="col-sm-6 form-group hidd">

                                <label class="col-sm-4 control-label">
                                    <?= label('Refered By ', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="refby" class="form-control" name="refby" type="text" value=""
                                        maxlength="50"></textarea>
                                </div>
                            </div>

                            <div <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?>  class="col-sm-6 form-group hidd">

                                <label class="col-sm-4 control-label">
                                    <?= label('Refered person Mob ', $this, $user) ?><span class="required"></span>
                                    :
                                </label>
                                <div class="col-sm-8">
                                    <input id="refmob" class="form-control" name="refmob" type="text" data-validation=""
                                        value="" maxlength="50"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">

                            <div <?php if((float) $is_calendar > 0 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Student Status', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <textarea id="status" class="form-control" name="status" type="text" value=""
                                        maxlength="50"></textarea>
                                </div>
                            </div>


                            <div class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Remarks', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <textarea id="remarks" class="form-control" name="remarks" type="text" value=""
                                        maxlength="50"></textarea>
                                </div>
                            </div>
							<?php if((float) $is_calendar > 0 ){ ?> 
							<div class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Medical Illness', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <textarea id="medical_condition" class="form-control" name="medical_condition" type="text" value=""
                                        maxlength="50"></textarea>
                                </div>
                            </div>
							<?php } ?>
                            <div class="col-sm-6 form-group">


                                <label class="col-sm-4 control-label">
                                    <?= label('Image Upload', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class=" col-sm-8 form-group-6" style="padding-top:4px">
                                    <!-- <label for="imageupload">Image Upload</label> -->
                                    <input type="file" name="file" id="file">
                                </div>



                            </div>

                        </div>

                        <?php if ($option != 'view') { ?>
                        <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save'
                            class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php } ?>
                    </div>

                </div>


                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>

<div class="modal fade" id="myWarning">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= label('Warning', $this, $user) ?></h4>
            </div>
            <div class="modal-body no-border">
                <input type="number" id="changess" value="Phone number already exist. Please change"
                    style="border:none;width:100%" />
            </div>
            <div class="modal-footer no-border">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?= label('Change Number', $this, $user) ?></button>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="myModalPop_cus" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" id="mcb" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="m_itemClick" popup_type="item" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="myModalPop_admType" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="admission" back="<?php echo site_url('education/Student/create'); ?>"
        action="<?php echo site_url('education/Student/addAdmode'); ?>" class="form-horizontal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add Admission Mode</h3>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="col-sm-12">

                        <div class="col-sm-6 form-group">
                            <label class="col-sm-4 control-label">
                                <?= label('Mode Name', $this, $user) ?><span class="required"></span> :
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm" style="width:100%">
                                    <input id="adname" class="form-control" name="adname" type="text" value=""
                                        maxlength="50">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group odd_cls">
                            <label class="col-sm-4 control-label">
                                <?= label('Mode Id', $this, $user) ?><span class="required"></span> :
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm" style="width:100%">
                                    <input id="adid" class="form-control" name="adid" type="text" value=""
                                        maxlength="50">
                                </div>
                            </div>
                        </div>

                    </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" id="mcb" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" id="saveit" popup_type="item" class="btn btn-primary">Save changes</button>
</div>

</div>
</div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#frmcreatemodelc').validate();
    });
    $(document).ready(function () {

        $.ajax({
            url: "<?php echo site_url('education/qualifications/Qualifications/getElement'); ?>",
            success: function (result) {

                $('#qualify').html(result);

                // $('#q_id').append(
                //     $('<option></option>').val("").html('all')
                // );
            }
        });

        $('#dob').change(function () {
            dob = $('#dob').val();
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').val(age);

        })
        // alert($('#eid').val());

        $("#m_itemClick").bind("click", function () {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
        });
        load();
        states_cus(0);
        area_cuss(0);
        price_list(0);
        route_cuss(0);
        $('#name').focus();
        $('#btnsave').click(function () {
            var ms = $("#frmcreate").isValid();
            if (ms !== true) {
                return;
            }
        });
        $('#myModalPop_cus').on('shown.bs.modal', function () {
            $('#name').focus();
        });
        $('#myModalPop_cus').on('hidden.bs.modal', function () {
            var opt = $("#m_itemClick").attr('opt');
            if (opt === 'states_cus') {
                states_cus(1);
            }
            if (opt === 'area_cus') {
                area_cuss(1);
            }
            if (opt === 'pricelst') {
                price_list(1);
            }
            if (opt === 'route_cuss') {
                route_cuss(1);
            }
            $('#is_model').val(0);
        });
        $(".myModalPop_cus").click(function () {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    // $('.box-header').remove();
                    $('.box-p').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop_cus').modal();
                    $('#is_model').val(1);
                    //$('.popuphide').hide();
                }
            });
        });
    });



    $(".myModalPop_admType").click(function () {
        $("#myModalPop_admType").modal('show');
        $("#saveit").click(function () {
            $("#myModalPop_admType").modal('hide');
        });
    });
    $("#saveit").click(function () {
        $("#myModalPop_admType").modal('hide');
    });

    var inc_inary = 0;
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });

    function load() {
        var id = $("#id").val();
        var eid = $("#enq").val();
        var view = $("#view").val();
        var type = $("#type").val();
        // alert(view)
        // alert(id)
        var taxtype = $("#tax_type").val();
        if (taxtype === "GST") {
            $(".tax_id").html("<?= label('GSTIN :', $this, $user) ?>");
        } else {
            $(".tax_id").html("<?= label('Tax ID :', $this, $user) ?>");
        }
        //alert(id);

        $("#states_cus").change(function () {

            var stateid = $(this).val();
            $.ajax({
                url: "<?php echo site_url('customers/getstatecode/'); ?>/" + stateid,
                success: function (results) {
                    var result = JSON.parse(results);
                    $('#states_cus').val(result.StateID);
                    $('#stcode').val(result.code);
                }
            });
        });


        if (eid > 0) {

            $.ajax({
                url: "<?php echo site_url('crm_new/Enquiry_register/getsing'); ?>/" + eid,
                success: function (results) {
                    console.log(results)
                    var result = JSON.parse(results);
                    $("#name").val(result.contactPerson);
                    $("#phone").val(result.contactNumber);
                    $("#emergency_contact").val(result.emergency_contact);
                    $("#email").val(result.email);
                    $("#qualify").val(result.CompanyName);
                    $("#addr1").val(result.adress);
                    $("#remarks").val(result.remarks);
                }
            });
        }


        if (id > 0 && view == "create") {
            $('.hidd').remove()
            $.ajax({
                url: "<?php echo site_url('education/Student/getDetails'); ?>/" + id,
                success: function (results) {
                    console.log(results)
                    var result = JSON.parse(results);
					$("#contact_name").val(result.contact_person);
                    $("#contact_no").val(result.contact_number);
                    $("#name").val(result.name);
                    $("#last_name").val(result.last_name);
                    $("#medical_condition").val(result.medical_condition);
                    $("#emergency_contact").val(result.emergency_contact);
                    $("#phone").val(result.phone);
                    $("#email").val(result.email);
                    $("#qualify").val(result.qualify);
                    $("#lan").val(result.lan);
                    $('#states_cus').val(result.cst);
                    $('#stcode').val(result.pincode);
                    $("#addr1").val(result.address_line1);
                    $("#addr2").val(result.address_line2);
                    $("#aadhar").val(result.adhar);
                    $("#age").val(result.age);
                    $("#father").val(result.father);
                    $("#mother").val(result.mother);
                    $("#enroll").val(result.enrollment);
                    $('input:radio[name="gender"]').filter('[value="' + result.gender + '"]').attr(
                        'checked', true);
                    $('input:radio[name="qual"]').filter('[value="' + result.route + '"]').attr('checked',
                        true);
                    $('input:radio[name="mat"]').filter('[value="' + result.materials + '"]').attr(
                        'checked', true);
                    $("#status").val(result.stud_status);
                    $("#remarks").val(result.remarks);
                }
            });
        } else if (id > 0 && view == "view") {
            $.ajax({
                url: "<?php echo site_url('education/Student/getDetails'); ?>/" + id,
                success: function (results) {
                    console.log(results)
                    var result = JSON.parse(results);
                    $("#name").val(result.name);
                    $("#phone").val(result.phone);
                    $("#email").val(result.email);
                    $("#qualify").val(result.qualify);
                    $("#lan").val(result.lan);
                    $("#addr1").val(result.address_line1);
                    $('input:radio[name="qual"]').filter('[value="' + result.route + '"]').attr('checked',
                        true);
                    $("#remarks").val(result.remarks);
                }
            });
        } else {
            $('#states_cus option:contains("KERALA")').prop('selected', true);

        }
    }

    function states_cus(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/states'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.StateID + '"> ' + itemsingle
                        .StateName + '</option>';
                });
                $("#states_cus").html(option);
                if (is_select === 1) {
                    var myVal = $('#states_cus option:last').val();
                    $('#states_cus').val(myVal);
                }
            }
        });
    }

    function area_cuss(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area_cus').html(result);
                if (is_select === 1) {
                    var myVal = $('#area_cus option:last').val();
                    $('#area_cus').val(myVal);
                }
            }
        });
    }

    function price_list(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('Customers/price_list'); ?>",
            success: function (result) {
                $('#price_list').html(result);
                if (is_select === 1) {
                    var myVal = $('#price_list option:last').val();
                    $('#price_list').val(myVal);
                }
            }
        });
    }

    function route_cuss(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/route'); ?>",
            success: function (result) {
                $('#route_cus').html(result);
                if (is_select === 1) {
                    var myVal = $('#route_cus option:last').val();
                    $('#route_cus').val(myVal);
                }
            }
        });
    }
    $(document).ready(function () {


    });

    var refMode = $('#ref').val();
    $("#ref").change(function () {
        refMode = $('#ref').val();
        $('#course').trigger("change");
    });


    //phone existance
    var phn = "";
    $('#phone').change(function () {

        isValid = $('#frmcreatemodelc').isValid();

        phn = $('#phone').val();
        $.ajax({
            url: "<?php echo site_url('education/Student/checkPhone') ?>/" + phn,
            success: function (results) {
                var result = JSON.parse(results);
                if (result.status) {
                    $('#myWarning').modal('show');
                    $('#phone').val('');
                }
            }
        });
    })


    $("#course").change(function () {



        if ($('#course option:selected').val() == 0) {
            $('#cost').val('');
        }
        var idss = $('#course option:selected').val();
        var discounted = 0;
        $.ajax({
            url: "<?php echo site_url('education/Student/getfee'); ?>/" + idss,
            success: function (result) {
                $.each(JSON.parse(result), function (i, items) {
                    total = parseInt(items.tutionfee) + parseInt(items.examfee) + parseInt(
                        items.certificatefee) + parseInt(items.otherfee);
                    $('#totalfees').val(total);
                    $('#discountpercs').val(refMode);

                    if (refMode != 0) {
                        discounted = total - refMode;
                        // discounted = total - discounted;
                        $('#cost').val(discounted);
                    } else {
                        $('#cost').val(total);
                    }


                });

            }
        });
    });



    var course = "";

    // var univ = 1;
    $(document).ready(function () {
        // var univ = $("#universe option:selected").val();
        // alert(univ)
        // getcources(1);

    })
    $('#universe').change(function () {

        if ($('#universe option:selected').val() == 0) {
            $('#cost').val('');
        }

        var univ = $("#universe option:selected").val();
        getcources(univ);
    });


    function getcources(unid) {
        $.ajax({

            url: "<?php echo site_url('education/Student/getcourse'); ?>/" + unid,
            success: function (result) {
                course = '<option value = "">--select--</option>';
                $.each(JSON.parse(result), function (i, items) {
                    course = course + '<option value = "' + items.id + '">' + items.name +
                        '</option>'
                });
                $('#course').html(course);
            }

        });

    }


    var textForAdm = "";
    $.ajax({

        url: "<?php echo site_url('education/Student/getAdmType'); ?>",
        success: function (results) {
            console.log(results);

            $.each(JSON.parse(results), function (i, items) {
                textForAdm = '<option value = "' + items.id + '">' + items.name + '</option>';
                $('#adm_type').append(textForAdm);
                // var selected = '<input type="hidden" value="'+items.id+'" name="typeid" id="typeid"/>';
                // alert(selected);
            });


        }
    });

    var textForUniv = "";
    $.ajax({

        url: "<?php echo site_url('education/Course/getUniversity'); ?>",
        success: function (results) {
            console.log(results);
            textForUniv = '<option value = "">--Select--</option>';
            $.each(JSON.parse(results), function (i, items) {
                textForUniv = textForUniv + '<option value = "' + items.id + '">' + items.name +
                    '</option>';
            });
            $('#universe').html(textForUniv);


        }
    });

    var textForRef = "";
    $.ajax({

        url: "<?php echo site_url('education/Course/getAllMode'); ?>",
        success: function (results) {
            textForRef = textForRef + '<option value = "">--Select--</option>';
            $.each(JSON.parse(results), function (i, items) {
                textForRef = textForRef + '<option value = "' + items.percent + '">' + items.name +
                    '</option>';

                // var selected = '<input type="hidden" value="'+items.id+'" name="typeid" id="typeid"/>';
                // alert(selected);
            });
            $('#ref').html(textForRef);


        }
    });

    var textForBatch = "";
    $.ajax({

        url: "<?php echo site_url('education/Student/getAllBatch'); ?>",
        success: function (results) {
            textForBatch = textForBatch + '<option value = "">--Select--</option>';
            $.each(JSON.parse(results), function (i, items) {
                textForBatch = textForBatch + '<option value = "' + items.id + '">' + items.batch +
                    '</option>';
            });
            $('#batch').html(textForBatch);


        }
    });
</script>