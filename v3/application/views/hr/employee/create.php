<form method="post" id="frmcreate" enctype="multipart/form-data"  home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/employee/list_all'); ?>" action="<?php echo site_url('hr/employee/save'); ?>"    class="has-validation-callback form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="emp_id" id="emp_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Employee', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/employee/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs nav-pills">
                            <li class="active"><a id="tabbasic" href="#Basic" data-toggle="tab"><?= label('Profile', $this, $user) ?></a></li>
                            <li><a  id="education" href="#Education_details" data-toggle="tab"><?= label('Education Details', $this, $user) ?></a></li>
                            <li><a id="visa" href="#Visa_Details" data-toggle="tab"><?= label('Visa & Passport Details', $this, $user) ?></a></li>
                            <li><a id="job" href="#Job_details" data-toggle="tab"><?= label('Job Details', $this, $user) ?></a></li>
<!--                            <li><a id="ulogin" href="#User_login" data-toggle="tab"><?= label('Login', $this, $user) ?></a></li>-->
                            <li><a id="job" href="#uploads" data-toggle="tab"><?= label('Upload Documents', $this, $user) ?></a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="Basic">  
                                <div class="box-body">
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('First Name*', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input name="pro_fname" type="text" id="pro_fname" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Last Name', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input id="pro_lname" class="form-control" name="pro_lname" type="text" value="" maxlength="15">              
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Mobile*', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input id="pro_mobile" data-validation="required" class="form-control" name="pro_mobile" type="text" value="" maxlength="15">              
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Email', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input id="pro_email" class="form-control" name="pro_email" type="text" value="">              
                                            </div> 
                                        </div>
                                    </div>
                                </div>  
                                <div class="box-body">
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Permanent Address*', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input name="pro_permt_address" type="text" id="pro_permt_address" data-validation="length" data-validation-length="min2"   class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Current Address', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input id="pro_cur_address" class="form-control" name="pro_cur_address" type="text" value="" maxlength="15">              
                                            </div> 
                                        </div>
                                    </div>
                                </div>  
                                <div class="box-body">
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Allowed Leaves(In an Year)', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input  value="6" id="no_of_leaves" class="form-control text-left two-digits price" name="no_of_leaves" type="text" value="" maxlength="15">              
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Photo', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input type="file" name="pro_image" id="pro_image" />
                                                <input type="hidden" name="pro_image_id" id="pro_image_id"  value=""/><br />
                                                <div id="imagediv">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-sm-12 ">
										<div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Is Active', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
												<select name="pro_status" id="pro_status" class="form-control">
													<option value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
                                            </div> 
                                        </div>
									</div>
                                    <div class="mailbox-controls"> 
                                        <div class="pull-right"> 
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div> 
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>

                                </div>  

                            </div>

                            <div class="tab-pane" id="Education_details">  
                                <div class="box-body">
                                    <table class="table table-striped table-condensed" style="width: 100%">
                                        <tr>
                                            <td ><?= label('Course Type', $this, $user) ?></td>
                                            <td ><?= label('Start Date', $this, $user) ?></td>
                                            <td ><?= label('End  Date', $this, $user) ?></td>
                                            <td ><?= label('Type', $this, $user) ?></td>
                                            <td ><?= label('Aggregate Mark in %', $this, $user) ?></td>
                                            <td ><?= label('Action', $this, $user) ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select  name="edu_course" id="edu_course"  class="form-control">

                                                </select>
                                            </td>
                                            <td>
                                                <input id="edu_start_date" class="form-control date" name="edu_start_date" type="text">              
                                            </td>
                                            <td>
                                                <input id="edu_end_date" class="form-control date" name="edu_end_date" type="text" >              
                                            </td>
                                            <td>
                                                <select  name="edu_type" id="edu_type"  class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Part Time">Part Time</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input id="edu_percent" class="form-control two-digits" name="edu_percent" type="text"  step="any" class="form-control">              
                                            </td>
                                            <td>
                                                <button type = "button" data-toggle="tooltip" style="float: left"
                                                   title="Add More" id="addmore" class="addmore btn btn-success"
                                                   > <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tbody id='addrow'>
                                        </tbody>
                                    </table>
                                    <div class="mailbox-controls"> 
                                        <div class="pull-right"> 
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div> 
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                    <!--                                    <div class="col-sm-12 ">
                                                                            <div class="col-sm-6 form-group">
                                                                                <label class="col-sm-3 control-label">
                                    <?= label('Course Type', $this, $user) ?> <span class="required"></span>  :
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <select  name="edu_course" id="edu_course"  class="form-control">
                                                                                        <option value="">Select</option>
                                                                                        <option value="SSLC">SSLC</option>
                                                                                        <option value="Plus Two">Plus Two</option>
                                                                                        <option value="Degree">Bachelors Degree</option>
                                                                                        <option value="Post Graduate">Post Graduate</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6 form-group">
                                                                                <label class="col-sm-3 control-label" >
                                    <?= label('Start Date', $this, $user) ?><span class="required"></span>  :
                                                                                </label>
                                                                                <div class="col-sm-9" id="name_input_box">
                                                                                    <input id="edu_start_date" class="form-control" name="edu_start_date" type="text" class="form-control" data-provide="datepicker">              
                                                                                </div> 
                                                                            </div>
                                                                        </div>-->
                                </div> 
                                <!--                                <div class="box-body">
                                                                    <div class="col-sm-12 ">
                                                                        <div class="col-sm-6 form-group">
                                                                            <label class="col-sm-3 control-label" >
                                <?= label('End Date', $this, $user) ?><span class="required"></span>  :
                                                                            </label>
                                                                            <div class="col-sm-9" id="name_input_box">
                                                                                <input id="edu_end_date" class="form-control" name="edu_end_date" type="text" class="form-control" data-provide="datepicker">              
                                                                            </div> 
                                                                        </div>
                                                                        <div class="col-sm-6 form-group">
                                                                            <label class="col-sm-3 control-label">
                                <?= label('Type', $this, $user) ?> <span class="required"></span>  :
                                                                            </label>
                                                                            <div class="col-sm-9">
                                                                                <select  name="edu_type" id="edu_type"  class="form-control">
                                                                                    <option value="">Select</option>
                                                                                    <option value="commerce">Commerce</option>
                                                                                    <option value="science">Science</option>
                                                                                    <option value="Information Tehnology">IT</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mailbox-controls"> 
                                                                        <div class="pull-right"> 
                                                                            <div class="btn-group pull-right">
                                                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                                                            </div> 
                                                                             /.btn-group 
                                                                        </div>
                                                                         /.pull-right 
                                                                    </div>
                                
                                                                </div>-->
                            </div>


                            <div class="tab-pane" id="Visa_Details"> 
                                <div class="box-body">
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label ">
                                                <?= label('Visa Type', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-8">
                                                <select id="visa_type" name="visa_type" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <label class="col-sm-12 control-label ">
                                                <?= label('Issue Date', $this, $user) ?> <span class="required"></span>  
                                            </label>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <label style="text-align: left" class="col-sm-12 control-label ">
                                                <?= label('End Date', $this, $user) ?> <span class="required"></span>  
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label ">
                                                <?= label('Iqama No', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="iqama_number" class="form-control" name="iqama_number" type="text" value="" maxlength="15">                                             </div>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="iqama_issue_date" class="form-control date" name="iqama_issue_date" type="text" >              
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="iqama_end_date" class="form-control date" name="iqama_end_date" type="text" > 
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label ">
                                                <?= label('PassPort No', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="visa_number" class="form-control" name="visa_number" type="text" value="" maxlength="15">                                             </div>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="visa_issue_date" class="form-control date" name="visa_issue_date" type="text" >              
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="visa_end_date" class="form-control date" name="visa_end_date" type="text" > 
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label ">
                                                <?= label('Driving  Licence', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="license_number" class="form-control" name="license_number" type="text" value="" maxlength="15">                                             </div>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="license_issue_date" class="form-control date" name="license_issue_date" type="text" >              
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="license_end_date" class="form-control date" name="license_end_date" type="text" > 
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label ">
                                                <?= label('Insurence', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="insurence_number" class="form-control" name="insurence_number" type="text" value="" maxlength="15">                                             </div>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="insurence_issue_date" class="form-control date" name="insurence_issue_date" type="text" >              
                                        </div>
                                        <div class="col-sm-3 ">
                                            <input id="insurence_end_date" class="form-control date" name="insurence_end_date" type="text" > 
                                        </div>
                                    </div>
                                    <div class="mailbox-controls"> 
                                        <div class="pull-right"> 
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div> 
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="Job_details">  
                                <div class="box-body">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Department', $this, $user) ?> <span class="required"></span>  :
                                            </label> 
                                            <div class="col-sm-7">
                                                <select  name="job_department" id="job_department" data-validation="required"  class="form-control">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Role', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <select  name="job_role" id="job_role"  class="form-control" data-validation="required">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="box-body">
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label">
                                                <?= label('Email id', $this, $user) ?> <span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7">
                                                <input id="job_email" class="form-control"  name="job_email" type="text" value="">              
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-5 control-label" >
                                                <?= label('Date of Joining', $this, $user) ?><span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-7" id="name_input_box">
                                                <input id="job_date_joining" class="form-control date" name="job_date_joining" type="text" >              
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">

                                    <div class="mailbox-controls"> 
                                        <div class="pull-right"> 
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div> 
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="uploads">  
                                <div class="box-body">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 form-group">
                                            <table class="table table-striped table-condensed" style="width: 100%">
                                                <tr>
                                                    <td>Document Type</td>
                                                    <td>File</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-lg-7">
                                                        <select  name="doc_type" id="doc_type"  class="form-control">
                                                        </select>
                                                    </td>
                                                    <td class="col-lg-4">
                                                        <input  type="file" name="file" id="file"/>
                                                    </td>
                                                    <td>
                                                        <button data-toggle="tooltip" style="float: left"
                                                           title="Add Document" id="adddocument" class="adddocument btn btn-success"
                                                           type="button"> <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tbody id="uploadbody">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php
                                    if ($type != 'view') {
                                        echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"><div class="float-right"></div> </div>';
                                    }
                                    ?>   
                                </div>
                            </div>
                            <div class="tab-pane" id="User_login">  
                                <div class="box-body">
                                    <div style="display:none" class="col-sm-6 ">
                                        <div class="checkbox">
                                            <label><input  id="is_login" type="checkbox" value="">Login?</label>
                                        </div>
                                        <div class="col-sm-12" id="logdiv" style="display: none">
                                            <div class="form-group-3">
                                                <label for="username">Username:</label>
                                                <input type="user" class="form-control" name="user" id="user">
                                            </div>
                                            <div class="form-group-3">
                                                <label for="pwd">Password:</label>
                                                <input type="password" class="form-control" id="pwd" name="pwd">
                                            </div>
                                            <div class="form-group-3">
                                                <label for="pwd">Conform Password:</label>
                                                <input type="password" class="form-control" name="conpwd" id="conpwd">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mailbox-controls"> 
                                        <div class="pull-right"> 
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                            </div> 
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>

                                </div> 

                            </div>
                        </div>
                    </div> 
                </div>
                </section>
                </form>


                <script type="text/javascript">
                    function  adddocument(result, doc_type) {
                        var doc = $("#doc_type [value=" + doc_type + "]").text();
                        $('#doc_type').val('');
                        $('#file').val();
                        var text = '<tr><td class="col-lg-7"><input value="' + doc_type + '" type="hidden" id="document_id" name="document_id[]"><input class="form-control" height=30; value="' + doc + '" type="text" readonly="readonly"> </td><td><input type="hidden" name="doc_img[]" value="' + result + '" />  <a tp="new" target="_blank" href="<?php echo site_url('uploads/images/'); ?>' + result + '" >' + result + ' </a></td></tr>';
                        $('#uploadbody').append(text);
                    }
                    $.validate({
                        modules: 'security'
                    });
                    $(document).on('change', '#is_login', function () {
                        if (this.checked) {
                            $('#logdiv').attr('style', 'display:block');
                            $("#user").attr('data-validation', 'required length');
                            $("#user").attr('data-validation-length', 'min5');
                            $("#pwd").attr('data-validation', 'required length');
                            $("#pwd").attr('data-validation-length', 'min5');
                            $("#conpwd").attr('data-validation', 'required length');
                            $("#conpwd").attr('data-validation-length', 'min5');
                            $.validate({
                                modules: 'security'
                            });

                        } else {
                            $('#logdiv').attr('style', 'display:none');
                            $("#user").removeAttr('data-validation', 'required length');
                            $("#user").removeAttr('data-validation-length', 'min5');
                            $("#pwd").removeAttr('data-validation', 'required length');
                            $("#pwd").removeAttr('data-validation-length', 'min5');
                            $("#conpwd").removeAttr('data-validation', 'required length');
                            $("#conpwd").removeAttr('data-validation-length', 'min5');
                        }
                    });
                    $(document).ready(function () {
                        $('#pro_image').change(function () {
                            var data = new FormData();
                            var file = document.getElementById("pro_image").files[0];
                            if (file !== undefined) {
                                data.append("document", file);
                                $.ajax({
                                    url: "<?php echo site_url('hr/Employee/saveprofile'); ?>",
                                    type: 'POST',
                                    data: data,
                                    processData: false,
                                    contentType: false, // send it here
                                    success: function (result) {
                                        if (result !== "") {
                                            $('#pro_image_id').val(result);
                                            var text = '<img style="height:100px;width: 100px;" src="<?php echo site_url('uploads/images/'); ?>' + result + '" alt="Smiley face" height="42" width="42">';
                                            $('#imagediv').html(text);
                                        }
                                    }
                                });

                            }
                        });
                        $('.adddocument').click(function () {
                            var doc_type = $('#doc_type').val();
                            var file = document.getElementById("file").files[0];
                            var data = new FormData();
                            if (file !== undefined && doc_type !== "" && doc_type !== '0') {
                                data.append("document", file);
                                $.ajax({
                                    url: "<?php echo site_url('hr/Employee/savedocument'); ?>",
                                    type: 'POST',
                                    data: data,
                                    processData: false,
                                    contentType: false, // send it here
                                    success: function (result) {
                                        if (result !== "") {
                                            adddocument(result, doc_type);
                                        }
                                    }
                                });

                            }

                        });
                        $.ajax({
                            url: "<?php echo site_url('hr/Employee/visa_type'); ?>",
                            success: function (result) {
                                $('#visa_type').html(result);
                            }
                        });
                        $.ajax({
                            url: "<?php echo site_url('hr/Employee/department'); ?>",
                            success: function (result) {
                                $('#job_department').html(result);
                            }
                        });
                        $.ajax({
                            url: "<?php echo site_url('hr/Employee/role'); ?>",
                            success: function (result) {
                                $('#job_role').html(result);
                            }
                        });
                        $.ajax({
                            url: "<?php echo site_url('hr/Employee/course'); ?>",
                            success: function (result) {
                                $('#edu_course').html(result);
                            }
                        });
                        $.ajax({
                            url: "<?php echo site_url('hr/Employee/doc_type'); ?>",
                            success: function (result) {
                                $('#doc_type').html(result);
                            }
                        });
                        $('#form-button-save').click(function () {
                            $('#tabbasic').click();
                            $("#frmcreate").validate();            // <- INITIALIZES PLUGIN
                            isValid = $("#frmcreate").isValid();
                            if (isValid) {
                                $('#education').click();
                                $("#frmcreate").validate();
                                isValid = $("#frmcreate").isValid();
                                if (isValid) {
                                    $('#visa').click();
                                    $("#frmcreate").validate();
                                    isValid = $("#frmcreate").isValid();
                                    if (isValid) {
                                        $('#job').click();
                                        $("#frmcreate").validate();
                                        isValid = $("#frmcreate").isValid();

                                    }
                                    if (isValid) {
                                        $('#ulogin').click();
                                        $("#frmcreate").validate();
                                        isValid = $("#frmcreate").isValid();


                                    }
                                }
                            }
                        });

                    });
                    load();
                    var idinc = 1;
                    function   additem(edu_course, edu_start_date, edu_end_date, edu_type, edu_percent, type, course) {
                        $('#edu_course').val('');
                        $('#edu_start_date').val('');
                        $('#edu_end_date').val('');
                        $('#edu_type').val('');
                        $('#edu_percent').val('');
                        var newrow = "<tr><td><input type='hidden' name='imagevalue' id='" + idinc + "'><input type ='hidden' value =" + edu_course + " name='course[]'><input class='form-control'  type ='text' value = " + course + "> </td><td><input class='form-control'  type ='text' value = " + edu_start_date + " name='start_date[]'></td><td><input class='form-control'  type ='text' value = " + edu_end_date + " name='end_date[]'></td><td> <input  type ='hidden' value =" + edu_type + " name='type[]'><input class='form-control'  type ='text' value = " + type + "></td><td><input class='form-control'  type ='text' value = " + edu_percent + " name='percent[]'></td><td><span onclick='remove(this)' data-toggle='tooltip'  title='Remove'   class='btn btn-danger remove'   href='#'>  <span class='remove glyphicon glyphicon-remove-sign'></span>     </span></td></tr>"
                        idinc = idinc + 1;
                        $('#addrow').append(newrow);
                    }

                    function remove(btn) {
                        $(btn).closest('tr').remove();
                    }


                    function load() {
                        var id = $("#emp_id").val();
                        if (id > 0) {
                            $.ajax({
                                url: "<?php echo site_url('hr/Employee/getdocuments'); ?>/" + id,
                                success: function (result) {
                                    $.each(JSON.parse(result), function (i, itemsingle) {
                                        adddocument(itemsingle.document, itemsingle.document_type)
                                    });
                                }
                            });
                            $.ajax({
                                url: "<?php echo site_url('hr/employee/getsing'); ?>/" + id,
                                success: function (results) {
                                    var result = JSON.parse(results);
                                    $('#no_of_leaves').val(result.allowed_leaves);
                                    $('#pro_fname').val(result.pro_fname);
                                    $('#pro_lname').val(result.pro_lname);
                                    $('#pro_permt_address').val(result.pro_permt_address);
                                    $('#pro_cur_address').val(result.pro_cur_address);
                                    $('#pro_status').val(result.pro_status);
									
                                    $('#pro_email').val(result.pro_email);
                                    $('#pro_mobile').val(result.pro_mobile);
                                    var text = '<img style="height:100px;width: 100px;" src="<?php echo site_url('uploads/images/'); ?>' + result.pro_image + '" alt="Smiley face" height="42" width="42">';
                                    $('#imagediv').html(text);
                                }
                            });
                            $.ajax({
                                url: "<?php echo site_url('hr/Employee/education'); ?>/" + id,
                                success: function (result) {
                                    $.each(JSON.parse(result), function (i, itemsingle) {
                                        additem(itemsingle.edu_course, formatDate(itemsingle.edu_start_date), formatDate(itemsingle.edu_end_date), itemsingle.edu_type, itemsingle.edu_percent, itemsingle.edu_type, itemsingle.course_name);
                                    });
                                }
                            });
                            $.ajax({
                                url: "<?php echo site_url('hr/employee/visadetails'); ?>/" + id,
                                success: function (results) {
                                    if (results !== "null") {
                                        var result = JSON.parse(results);
                                        $('#visa_type').val(result.visa_type);
                                        $('#iqama_number').val(result.iqama_no);
                                        $('#iqama_issue_date').val(formatDate(result.iqama_issue_date));
                                        $('#iqama_end_date').val(formatDate(result.iqama_end_date));

                                        $('#visa_number').val(result.passport_no);
                                        $('#visa_issue_date').val(formatDate(result.pass_issue_date));
                                        $('#visa_end_date').val(formatDate(result.pass_end_date));

                                        $('#license_number').val(result.licence);
                                        $('#license_issue_date').val(formatDate(result.licence_issue_date));
                                        $('#license_end_date').val(formatDate(result.licence_end_date));

                                        $('#insurence_number').val(result.insurence);
                                        $('#insurence_issue_date').val(formatDate(result.insurence_issue_date));
                                        $('#insurence_end_date').val(formatDate(result.insurence_end_date));
                                    }

                                }
                            });
                            $.ajax({
                                url: "<?php echo site_url('hr/employee/jobdetails'); ?>/" + id,
                                success: function (results) {
                                    var result = JSON.parse(results);
                                    $('#Job_date').val(formatDate(result.Job_date));
                                    $('#job_department').val(result.job_department);
                                    $('#job_role').val(result.job_role);
                                    $('#job_email').val(result.job_email);
                                    $('#job_date_joining').val(formatDate(result.job_date_joining));
                                    $('#job_date_leaving').val(formatDate(result.job_date_leaving));
                                }
                            });

                        }
                    }

                    $('.btnNext').click(function () {

                        $('.nav-pills > .active').next('li').find('a').trigger('click');
                    });
                    $('.btnPrevious').click(function () {
                        $('.nav-pills > .active').prev('li').find('a').trigger('click');
                    });
                    $('.addmore').click(function () {
                        var edu_course = $('#edu_course').val();
                        var edu_start_date = $('#edu_start_date').val();
                        var edu_end_date = $('#edu_end_date').val();
                        var edu_type = $('#edu_type').val();
                        var edu_percent = $('#edu_percent').val();
                        var type = $("#edu_type option:selected").text();
                        var course = $("#edu_course option:selected").text();
                        if (edu_course !== "" && edu_start_date !== "" && edu_end_date != "" && edu_type !== "" && edu_percent !== "" && course !== "") {
                            additem(edu_course, edu_start_date, edu_end_date, edu_type, edu_percent, type, course);
                        }
                    });

                    function formatDate(input) {
                        var datePart = input.match(/\d+/g),
                                year = datePart[0].substring(0), // get only two digits
                                month = datePart[1], day = datePart[2];

                        return day + '/' + month + '/' + year;
                    }

                </script>

