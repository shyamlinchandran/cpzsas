<?php
if ($view != 'create' and $view != 'view') {
    $add_url = site_url('clinic/patients/calendar');
} else {
    $add_url = site_url('clinic/Doctor/listall');
}
$isinventory['value']=0;
?>
<form method="post"  id="frmcreate" back="<?php echo $add_url; ?>" type="submit"  action="<?php echo site_url('clinic/Doctor/save'); ?>" >
    <input type="hidden"  id="name" name="name"/>
    <input type="hidden"  id="isinv" name="isinv" value="<?= $isinventory['value'] ?>"/>
    <input  type="hidden" value="<?php echo $id; ?>" id="id" name="id"/>  
    <section class="content"> 
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Patient</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#activity" data-toggle="tab" id="pat_name" name="pat_name" >Doctor Prescription</a></li>
                            <li><a href="#doctornote" data-toggle="tab">Doctor's Notes</a></li>
                            <li><a href="#observations" data-toggle="tab">Repertorial Analysiss </a></li>
                            <li><a href="#labnote" data-toggle="tab">Lab Notes</a></li>
                            <li><a href="#diagnosis" data-toggle="tab">Medical Diagnosis </a></li>
                            <li><a href="#prescription" data-toggle="tab">Prescription</a></li> 
                            <li><a href="#timeline" data-toggle="tab">Time Line</a></li> 
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- Profile Image -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Details</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="list-group-item">
                                <b>Age</b> <a id="age" name="age" class="pull-right"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b> <a id="gender" name="gender" class="pull-right"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Date Of Birth</b> <a name="dob" id="dob" class="pull-right"></a>
                            </li>

                            <li class="list-group-item">
                                <b>Address</b> <a id="address" name="address" class="pull-right"><br><br></a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a id="phone" name="phone" class="pull-right"></a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box-body -->
                <!-- /.box -->

                <!-- About Me Box -->
                <!--                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Todays Notes</h3>
                                    </div>
                                     /.box-header 
                                    <div class="box-body">
                                        <strong><i class="fa fa-book margin-r-5"></i> Patients Note</strong>
                
                                        <p class="text-muted">
                <?= $obsdate['Bok_Note'] ?>
                                        </p>
                                        <strong><i class="fa fa-book margin-r-5"></i> Reception Note</strong>
                
                                        <p class="text-muted">
                <?= $obsdate['Apr_Note'] ?>
                                        </p>
                                    </div>
                                     /.box-body 
                                </div>-->
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">

                <div class="nav-tabs-custom"> 
                    <div class="tab-content">
                        <div class="box-header with-border">
                            <span class="pull-left">
                                <a role="button" back="<?php echo $add_url ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                                    <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                                </a>
                            </span>
                            <div class="pull-right">
                                <button  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i></button>
                            </div>
                        </div> 
                        <div class="active tab-pane" id="activity"> 

                            <div class="row">
                                <div class="col-xs-12"> 
                                    <div class="box-header with-border mailbox-controls">
                                        <h3 class="box-title">Patient Details</h3>
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" class="btnNext btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                        </div>  
                                    </div>
                                    <div class="box-body">
                                        <div class="col-sm-12 form-group"  id="name_field_box">
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Name*<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="patid" type="hidden" class="form-control" name="patid" type="text" value="" data-validation="required" maxlength="50">              
                                                <input id="patname" class="form-control" name="patname" type="text" value="" data-validation="required" maxlength="50">              
                                            </div> 
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Phone<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="patphone" class="form-control" name="patphone" type="text" value="" maxlength="50"></div> 
                                        </div>
                                        <div class="col-sm-12 form-group" id="name_field_box">
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Email<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="patemail" class="form-control" name="patemail" type="text" value="" maxlength="50"></div> 
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Gender<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <select name="patgender" id="patgender" class="form-control" >
                                                    <option value="">Select</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 form-group" id="name_field_box">
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Date of Birth<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-2" id="name_input_box">
                                                <input name="patdob" type="text" id="patdob"
                                                       data-validation="required" class="form-control date"
                                                       placeholder="Date">
                                            </div> 
                                            <div class="col-sm-2" id="name_input_box">
                                                <input name="patage" type="text" id="patage" data-validation="required" class="form-control" placeholder="Age">
                                            </div> 
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Blood Group<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <select name="patbloodgrp" id="patbloodgrp" class="form-control" >
                                                    <option value="">Select</option>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 form-group" id="name_field_box">
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Occupation<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="patoccupation" class="form-control" name="patoccupation" type="text" value="" maxlength="50">              
                                            </div> 
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Referred by<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="patreference" class="form-control" name="patreference" type="text" value="" maxlength="50"></div> 
                                        </div>
                                        <div class="col-sm-12 form-group" id="name_field_box">
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Address*<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="pataddress_line1" class="form-control" name="pataddress_line1" type="text" value="" maxlength="50">              
                                            </div> 
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Groups<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="pat_grp" class="form-control" name="pat_grp" type="text" maxlength="50">
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 form-group" id="name_field_box">
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Notes<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <textarea rows="4" cols="50" id="notes" name="notes" class="form-control"></textarea>
                                                <!-- <input id="notes" class="form-control" name="notes" type="text" value="" maxlength="50">  --> 
                                            </div> 
                                            <!-- <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Family Member<span class="required"></span>  :
                                            </label>
                                            <div class="col-sm-4" id="name_input_box">
                                                <input id="fmly" class="form-control" name="fmly" type="text" value="" maxlength="50">             
                                            </div>  -->
                                        </div>
                                        <div class="col-sm-12 form-group" id="name_field_box">
                                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                                Add Family Member<span class="required"></span>:
                                            </label>
                                            <div class="col-sm-9" id="name_input_box">
                                                <table class="table">
                                                    <tbody id="rowp">
                                                        <tr id="add">
                                                            <td class="col-sm-3">
                                                                <select name="relation" id="relation" class="form-control">
                                                                    <option value="Child">Child</option>
                                                                    <option value="Parent">Parent</option>
                                                                    <option value="Brother/Sister">Brother/Sister</option>
                                                                    <option value="Husband/Wife">Husband/Wife</option>
                                                                    <option value="Grandchild">Grandchild</option>
                                                                    <option value="GrandParent">GrandParent</option>
                                                                    <option value="Uncle/Aunt">Uncle/Aunt</option>
                                                                    <option value="Nephew/Niece">Nephew/Niece</option>
                                                                    <option value="Cousin">Cousin</option>
                                                                </select>
                                                            </td>
                                                            <td class="col-sm-4">
                                                                <input id="member_name" placeholder="Name" class="form-control" name="member_name" type="text" value="">
                                                            </td>
                                                            <td class="col-sm-4">
                                                                <input id="member_phone" placeholder="phone" class="form-control phone" name="member_phone" type="text" value="">
                                                            </td>
                                                            <td>
                                                                <a data-toggle="tooltip" style="float: left"
                                                                   title="Add More" id="addmore" class="btn btn-success"
                                                                   href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="box-header with-border mailbox-controls">
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" class="btnNext btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="prescription">  
                            <?php if ($isinventory['value'] == 1) { ?>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="box-header with-border mailbox-controls">
                                            <h3 class="box-title">Prescription</h3>
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div> 
                                        </div>
                                        <div class="box-body"> 
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>Medicine</th>
                                                        <th>Potency</th>
                                                        <th>Quantity</th>
                                                        <th>Unit</th>
                                                        <th>Description</th>
                                                        <th>Rate</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="rowi">
                                                    <tr id="add">
                                                        <td class="col-lg-4"><input  type="hidden" name="id_item" id="id_item"/><input  NoTab="true"   id="itemname"    type="text" class="form-control "    placeholder="Medicine"/></td> 
                                                        <td class="col-lg-1">
                                                            <select tabindex="-1"   name="potency" data-validation="required" id="potency"  class="form-control ">
                                                            </select> 
                                                        </td>
                                                        <td class="col-lg-1"><input   id="qty" name="qty" type="text"    class="form-control  text-right  two-digits price" placeholder="Quantity"/></td>  
                                                        <td class="col-lg-1"><select tabindex="-1"   id="unit_item" class="form-control col-lg-1" >
                                                                <option value="">Select</option> 
                                                            </select>
                                                        </td>
                                                        <td class="col-lg-1"> <input id="med_note" class="form-control" name="med_note" type="text" value="" maxlength="500"></td>
                                                        <td class="col-lg-1"><input id="mrp_item"   type="text"    class="form-control   text-right two-digits" placeholder="MRP"/></td>        
                                                        <td class="col-lg-1"><input class='form-control  hunpx two-digits' id="rowTot" readonly="readonly" tabindex="-1"/></td>        
                                                        <td class="col-lg-1">
                                                            <button data-toggle="tooltip" type="button"    title="Add To save"   class="btn btn-success" href="#">
                                                                <span class="glyphicon glyphicon-plus"></span> 
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="box-header with-border mailbox-controls">
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btnNext btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div>  
                                        </div>
                                        <!-- /.box-body -->
                                        <!-- /.box -->

                                    </div>
                                    <!-- /.col (left) -->

                                    <!-- /.col (right) -->
                                </div>
                            <?php } ?>
                            <?php if ($isinventory['value'] == 0) { ?>
                                <div class="box-header with-border mailbox-controls">
                                    <h3 class="box-title">Prescription</h3>
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                        <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                    </div> 
                                </div>
                                <div class="box-body no-padding"> 
                                    <div class="table-responsive mailbox-messages">
                                        <textarea id="editor3" name="pre_note" rows="10" cols="80"> 
                                        </textarea>
                                    </div>
                                    <div class="mailbox-controls"> 

                                        <div class="pull-left">
                                            <input name="label" type="label" id="label"  disabled="disabled"  class="form-control pull-left hunpx" placeholder="Amount :">
                                            <input name="totamt" type="text" id="totamt"    class="form-control hunpx" placeholder="Amount">
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
                                    <!-- /.mail-box-messages -->
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="box-header with-border mailbox-controls">
                                <h3 class="box-title">Time Line</h3>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div> 
                            </div>
                            <ul class="timeline timeline-inverse">

                                <!-- timeline time label -->
                                <?php foreach ($details as $item) { ?>
                                    <li class="time-label">
                                        <span class="bg-red"> <?php echo $item['Bok_Date'] ?>  </span>

                                    </li>       
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">  
                                            <h3 class="timeline-header"><a href="#">Observations & Diagnosis</a> </h3>
                                            <div class="timeline-body">
                                                <b>Observations   :</b>   <?php echo $item['Bok_DocNote'] ?> <br></br> 
                                                <b>Diagnosis      :</b>   <?php echo $item['Bok_DoctDescription'] ?> <br></br>
                                                <b>Lab Notes      :</b>   <?php echo $item['Bok_Labnote'] ?> <br></br>
                                                <b>Doctor's Notes    :</b>   <?php echo $item['Bok_Summery'] ?> <br></br>
                                            </div>
                                            <h3 class="timeline-header"><a href="#">Prescription</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Pre_note'] ?> <br></br>   
                                            </div>  
                                        </div>
                                    </li>
                                <?php } ?>  


                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                            </div> 
                        </div>

                        <div class="tab-pane" id="doctornote">
                            <div class="col-md-6">
                                <!--                                <div class="box-header">
                                                                    <h3 class="box-title">Patients Note</h3>
                                                                </div>
                                                                <div class="box-body"> 
                                                                    <div class="form-group">
                                <?= $obsdate['Bok_Note'] ?>    
                                                                    </div>
                                                                </div>-->
                                <!-- /.box-body -->
                                <!-- /.box -->

                            </div>
                            <!--                            <div class="col-md-6">
                            
                                                            <div class="box-header">
                                                                <h3 class="box-title">Reception Note</h3>
                                                            </div>
                                                            <div class="box-body"> 
                                                                <div class="form-group">
                            <?= $obsdate['Apr_Note'] ?>
                                                                </div>
                                                            </div>
                                                             /.box-body 
                                                             /.box 
                            
                                                        </div>-->
                            <div class="box-header with-border mailbox-controls">
                                <h3 class="box-title">Doctor's Notes</h3>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div> 
                                <br/>

                            </div>
                            <div class="box-body no-padding"> 
                                <div class="table-responsive mailbox-messages">
                                    <textarea id="editor1" name="doc_notes" rows="10" cols="80"> 
                                    </textarea>
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
                                <!-- /.mail-box-messages -->
                            </div>

                        </div>
                        <div class="tab-pane" id="labnote">
                            <div class="box-header with-border mailbox-controls">
                                <h3 class="box-title">Lab Notes</h3>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div> 
                            </div>
                            <div class="box-body no-padding"> 
                                <div class="table-responsive mailbox-messages">
                                    <textarea id="editor2" name="lab_note" rows="10" cols="80"> 
                                    </textarea>
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
                                <!-- /.mail-box-messages -->
                            </div>

                        </div>
                        <div class="tab-pane" id="diagnosis">
                            <div class="box-header with-border mailbox-controls">
                                <h3 class="box-title">Medical diagnosis</h3>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div> 
                            </div>
                            <div class="box-body no-padding"> 
                                <div class="table-responsive mailbox-messages">
                                    <div class="box-header">
                                        <h3 class="box-title"></h3>
                                    </div>
                                    <div class="box-body"> 
                                        <table class="table table-condensed">
                                            <div class="form-group">
                                                <input  type="hidden" name="dgid" id="dgid"/>      
                                                <input name="diagonise" id="diagonise" type="text" NoTab="true"     data-validation-length="min2"   class="form-control" placeholder="Diagnosis">
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th>Diagnosis</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="rowm">
                                                <tr id="add">

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
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
                                <!-- /.mail-box-messages -->
                            </div>

                        </div>
                        <!--                        <div class="tab-pane" id="diagnosis">
                                                    <div class="box-header with-border mailbox-controls">
                                                        <h3 class="box-title">Medical diagnosis</h3>
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                            <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                                        </div> 
                                                    </div>
                        
                                                </div>-->
                        <div class="tab-pane" id="observations">
                            <div class="box-header with-border mailbox-controls">
                                <h3 class="box-title">Repertorial Analysis</h3>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div>  
                            </div>
                            <div class="box-body no-padding"> 
                                <div class="table-responsive mailbox-messages">
                                    <textarea id="editor4" name="observation" rows="10" cols="80"> 
                                    </textarea>
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
                                <!-- /.mail-box-messages -->
                            </div>

                        </div>
                        <!--                    <div class="tab-pane" id="observation">
                                                <div class="box-header with-border mailbox-controls">
                                                    <h3 class="box-title">Medical diagnosis</h3>
                                                    <div class="btn-group pull-right">
                                                        <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                        <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                                    </div> 
                                                </div>
                        
                                            </div>-->

                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
</form>
<script src="<?php echo base_url(); ?>asset/plugins/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script type="text/javascript">

    function addrow(id, diagonise) {
        $('#diagonise').val("");
        var singrow = '<td><input type="hidden" value=' + id + '  name="dig_id[]" class="ids"/>' +
                '<input data-validation="length" name="dig_name[]" value="' + diagonise + '" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
                '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $('#diagonise').val("");
        $("#rowm").append(newRow);
    }
    $("#patdob").keydown(function (e) {
        var today = new Date();
        var birthDate = new Date($('#dob').val());
        alert(birthDate);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        $('#patage').val(age + ' years old');
    });
    function addrowobservation(id, observation) {
        var singrow = '<td><input type="hidden" value=' + id + '  name="ob_id[]" class="ids"/>' +
                '<input data-validation="length" name="obs_name[]"  value="' + observation + '" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
                '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rown").append(newRow);
        $("#observation").val("");
        clearValue($("#observation"));
    }
    function clear() {
        clearValue($("#mrp_item"));
        clearValue($("#qty"));
        clearValue($("#rowTot"));
        clearValue($("#name"));
        clearValue($("#id_item"));
        clearValue($("#itemname"));
        clearValue($("#med_note"));
    }
    $.ajax({
        url: "<?php echo site_url('clinic/patients/bloodgroup'); ?>",
        success: function (result) {
            $('#patbloodgrp').html(result);
        }
    });
    function additem(rate, qty, rowtotal, id, name, note, potencyid, potname, unitid, unitname) {

        if (potencyid === null) {
            return;
        }
        var singrow = '<td class="col-lg-4"><input  type="hidden" value=' + id + '   name="item_id[]" readonly="readonly" />' +
                '<input class="form-control" style="height:25px"  id="itemname1[]" NoTab="true" name="item_name[]" value=' + name + ' readonly="readonly" /></td> ' +
                '<td><input  type="hidden"  value=' + potencyid + '   name="cli_potency[]" readonly="readonly" />' +
                '<input class="form-control hunpx" id="potencyname[]" NoTab="true" name="potencyname[]" value=' + potname + ' readonly="readonly" /></td> ' +
                '<td><input class="form-control" style="height:25px"  id="item_qty[]" name="item_qty[]" value=' + qty + ' readonly="readonly" ></td>' +
                '<td><input  type="hidden" value=' + unitid + '   name="uid[]" readonly="readonly" />' +
                '<input class="form-control hunpx"  id="unitname[]" NoTab="true" name="unitname[]" value=' + unitname + ' readonly="readonly" /></td> ' +
                '<td><input class="form-control" style="height:25px"  id="med_nte[]" NoTab="true" name="med_nte[]" value=' + note + ' readonly="readonly"></td>' +
                '<td><input class="form-control" style="height:25px"  id="mrp_item[]" name="mrpitem[]" value=' + rate + ' placeholder="MRP" readonly="readonly" /></td>' +
                '<td><input class="form-control" style="height:25px" id="rowTotal[]" name="rowTotal[]" value=' + rowtotal + ' readonly="readonly"/></td>' +
                '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span</span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowi").append(newRow);
        clear();
        $('#itemname').focus();
    }
    $(document).ready(function () {
        $('form input').keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/potency'); ?>",
            success: function (result) {
                $('#potency').html(result);
            }
        });


        $("#itemname").autocomplete({
            source: "<?php echo site_url('ajaxcall/items'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $("#mrp_item").val(ui.item.srate);
                $("#id_item").val(ui.item.id);
                $("#name").val(ui.item.name);
                $("#potency").val(ui.item.potency_id);
                $("#potency").focus();
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/cliunits'); ?>/" + ui.item.unit_id,
                    success: function (result) {
                        $('#unit_item').html(result);
                        $('#unit_item').val(id);
                    }
                });
            }
        });

        $("#qty").keydown(function (e) {

            var rate = $("#mrp_item").val();
            var qty = $("#qty").val();
            var rowtotal = parseFloat(rate) * parseFloat(qty);
            $("#rowTot").val(rowtotal);
        });
        $("#diagonise").autocomplete({
            source: "<?php echo site_url('ajaxcall/Diagonise'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#diagonise').val(ui.item.Diagnose);
                $('#dgid').val(ui.item.Dig_id);
                addrow(ui.item.Dig_id, ui.item.Diagnose);
                $('#observation').val("");
                $('#diagonise').focus();
            }
        });
        $("#diagonise").keydown(function (e) {
            var name = $("#diagonise").val();
            var id = $("#dgid").val();
            if (name != "" && id != "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    $('#diagonise').val("");
                }
                $('#observation').focus();
            }
            if (name != "" && id === "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    var id = 0;
                    addrow(id, name);
                    $("#diagonise").focus();
                }
            }
            $('#dgid').val("");
            if (name == "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    $("#observation").focus();
                }
            }
        });
        $("#observation").autocomplete({
            source: "<?php echo site_url('ajaxcall/Observation'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#observation').val(ui.item.Observation);
                $('#obid').val(ui.item.Obs_Id);
                addrowobservation(ui.item.Obs_Id, ui.item.Observation);
                clearValue($("#observation"));
                $('#observation').val("");
            }
        });
        $("#observation").keydown(function (e) {
            var name = $("#observation").val();
            var id = $("#obid").val();
            if (name != "" && id != "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    $('#observation').val("");
                }
                $('#observation').focus();
            }
            if (name != "" && id === "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    var id = 0;
                    addrowobservation(id, name);
                }
                $('#observation').focus();
            }
            $('#obid').val("");
            if (name == "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    $("#itemname").focus();
                }
            }
        });
        $("#mrp_item").keydown(function (e) {
            var id = $("#id_item").val();
            var name = $("#name").val();
            var note = $("#med_note").val();
            var rate = $("#mrp_item").val();
            var qty = $("#qty").val();
            var id = $("#id_item").val();
            var name = $("#name").val();
            var potencyid = $("#potency").val();
            var potname = $("#potency option:selected").text();
            var unitid = $("#unit_item").val();
            var unitname = $("#unit_item option:selected").text();
            var rowtotal = parseFloat(rate) * parseFloat(qty);
            $("#rowTot").val(rowtotal);
            var rowtotal = $("#rowTot").val();
            var unit = $("#unit_item").val();
            if (rowtotal > 0 && name != '' && id != '') {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    additem(rate, qty, rowtotal, id, name, note, potencyid, potname, unitid, unitname);
                }
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
        load();
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
        $('.btnNext').click(function () {
            $('.nav-pills > .active').next('li').find('a').trigger('click');
        });
        $('.btnPrevious').click(function () {
            $('.nav-pills > .active').prev('li').find('a').trigger('click');
        });
    });
    var inc_inary = 0;
    $("#supname").autocomplete({
        source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
        minLength: 2,
        select: function (event, ui) {
            loadCust(ui);
            $.ajax({
                url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                success: function (results) {

                    $("#balance").html("Clossing Balance: " + results);
                }
            });
            $('#itemname').focus();
        }
    });
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

    }
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });
    var idinc = 0;
    $('#addmore').click(function () {
        idinc = idinc + 1;
        var Rel_Id = document.getElementById('relation').value;
        var relativ = document.getElementById('member_name').value;
        var rphone = document.getElementById('member_phone').value;
        var reltype = $('#relation option:selected').text();
        newrow = '<tr><td ><input class="form-control"   value="' + reltype + ' "type="text" disabled><input   value="' + Rel_Id + ' "type="text" name="relatvid[' + idinc + ']" placeholder="' + Rel_Id + ' "   class="hidden deb form-control  cal debit two-digits"/></td>' +
                '<td ><input  class="form-control"    value="' + relativ + ' "type="text" disabled><input  value="' + relativ + '"  type="text" name="relativ[' + idinc + ']"  style="width=100%"    class="hidden cre form-control" placeholder="name"/></td>' +
                '<td ><input  class="form-control"    value="' + rphone + ' "type="text" disabled><input  value="' + rphone + '"  type="text" name="rphone[' + idinc + ']"  style="width=100%"    class="hidden cre form-control" placeholder="phone"/></td>' +
                '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
        $("#rowp").append(newrow);
    });
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];
        return day + '/' + month + '/' + year;
    }
    function DobtoAge(agesaved)
                            {
                                var today = new Date();
                                var bdate=$('#dob').val();
                                array = bdate.split('/');
                                var newDate = array[1] + "/" + array[0] + "/" + array[2];
                                var birthDate = new Date(newDate);
                                var age = today.getFullYear() - birthDate.getFullYear();
                                if(agesaved>age)
                                {
                                    age = agesaved;
                                }
                                var m = today.getMonth() - birthDate.getDay();
//                                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
//                                    age--;
//                                }
                                $('#age').val(age);
                            }
    function load() {
        var id = $("#id").val();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/cli_observation'); ?>/" + id,
            async: false,
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    var id = itemsingle.Obv_id;
                    var name = itemsingle.Observation;
                    addrowobservation(id, name);
                });
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/cli_salesitems'); ?>/" + id,
            async: false,
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    var id = itemsingle.id;
                    var name = itemsingle.name;
                    var qty = itemsingle.qty;
                    var total = itemsingle.Total;
                    var rate = itemsingle.Rate;
                    var Med_note = itemsingle.Med_note;
                    var potencyid = itemsingle.Pot_Id;
                    var potname = itemsingle.Potency;
                    var unitid = itemsingle.Unit_Id;
                    var unitname = itemsingle.uname;
                    $("#mrp_item").val(rate);
                    $("#med_note").val(Med_note);
                    $("#qty").val(qty);
                    $("#rowTot").val(total);
                    $("#id_item").val(id);
                    $("#name").val(name);
                    additem(rate, qty, total, id, name, Med_note, potencyid, potname, unitid, unitname);
                });
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/cli_diagonise'); ?>/" + id,
            async: false,
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    var id = itemsingle.Dig_Id;
                    var name = itemsingle.Diagnose;
                    addrow(itemsingle.Dig_Id, itemsingle.Diagnose);
                });
            }
        });
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('clinic/doctor/getsing'); ?>/" + id,
                async: false,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#pat_name").html(result.Pat_Name);
                    //$("#age").html(result.Pat_Age);
                    DobtoAge(result.Pat_Age);
                    $("#editor3").val(result.Pre_note);
                    $("#totamt").val(result.Bok_Amount);
                    $("#editor4").val(result.Bok_DocNote);
                    if (result.Pat_Dob != '0000-00-00') {
                        $("#dob").html(result.Pat_Dob);
                    }
                    $.ajax({
                        url: "<?php echo site_url('clinic/patients/getrelations'); ?>/" + result.Pat_Id,
                        success: function (result) {
                            $.each(JSON.parse(result), function (i, itemsingle) {
                                var Pat_Id = itemsingle.Pat_Id;
                                var reltype = itemsingle.reltype;
                                var relativ = itemsingle.relativ;
                                var rphone = itemsingle.relphone;
                                newrow = '<tr><td ><input class="form-control"   value="' + reltype + ' "type="text" disabled><input   value="' + reltype + ' "type="text" name="relatvid[' + idinc + ']" placeholder="' + reltype + ' "   class="hidden deb form-control  cal debit two-digits"/></td>' +
                                        '<td ><input  class="form-control"    value="' + relativ + ' "type="text" disabled><input  value="' + relativ + '"  type="text" name="relativ[' + idinc + ']"  style="width=100%"    class="hidden cre form-control" placeholder="name"/></td>' +
                                        '<td ><input  class="form-control"    value="' + rphone + ' "type="text" disabled><input  value="' + rphone + '"  type="text" name="rphone[' + idinc + ']"  style="width=100%"    class="hidden cre form-control" placeholder="phone"/></td>' +
                                        '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                $("#rowp").append(newrow);
                            });
                        }
                    });
                    $("#phone").html(result.Pat_Phone);
                    $("#gender").html(result.Pat_Gender);
                    $("#address").html(result.Pat_Address);
                    $("#doctor").html(result.Doc_Name);
                    $("#editor1").val(result.Bok_Summery);
                    $("#editor2").val(result.Bok_Labnote);
                    $("#patname").val(result.Pat_Name);
                    $("#patid").val(result.Pat_Id);
                    $("#patemail").val(result.Pat_Email);
                    $("#patphone").val(result.Pat_Phone);
                    $("#patgender").val(result.Pat_Gender);
                    $('#patdob').val(formatDate(result.Pat_Dob));
                    $("#patage").val(result.Pat_Age);
                    $("#patoccupation").val(result.Pat_Occupation);
                    $("#patbloodgrp").val(result.Pat_Blood);
                    $("#pataddress_line1").val(result.Pat_Address);
                    $("#patnotes").val(result.Pat_Notes);
                    $("#patreference").val(result.Pat_Refered);
                    $("#pat_grp").val(result.Pat_Groups);
                }
            });
        }
    }
</script>  