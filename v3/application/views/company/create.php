<?php
$com_tax_type = $settings[0]['com_tax_type'];
?>
<form method="post"  id="frmcreate" enctype="multipart/form-data" back="<?php echo site_url('company/com_info/listall'); ?>" action="<?php echo site_url('company/com_info/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $com_tax_type ?>" name="tax_type" id="tax_type" /> 
    <section class="content"> 
        <div class="row">
           <!--  data-validation="server" data-validation-url="<?php echo site_url('company/save'); ?>" -->
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Company Info', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('company/com_info/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('company/com_info/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 

                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Company Name', $this, $user) ?>  <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="coname" class="form-control" name="coname" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Address', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <textarea id="address" class="form-control" NoTab="NoTab" name="address" cols="30" rows="50"></textarea>              
                                </div>
                            </div>
                        </div>
                        <?php if ($this->multiple != 0) { ?>
                            <div class="col-sm-12 form-group" id="name_field_box">
                                <div class="col-sm-6">
                                    <label class="col-sm-4 control-label" id="name_display_as_box">
                                        <?= label('Arabic Name', $this, $user) ?>  <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8" id="name_input_box">
                                        <input id="name_lan" class="form-control" name="name_lan" type="text" value="" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-4 control-label" id="name_display_as_box">
                                        <?= label('address_lan', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8" id="name_input_box">
                                        <textarea id="address_lan" class="form-control" NoTab="NoTab" name="address_lan" cols="30" rows="50"></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Phone', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="cophone" class="form-control" name="cophone" type="text" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Email', $this, $user) ?>  <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="email" class="form-control" name="email" type="text" value="" maxlength="50" data-validation="email">
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <input type="hidden" name="hiddlogo" id="hiddlogo" />
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Logo', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input type="file" id="file" name="file" /> 
                                </div>
                            </div>
                        </div>                                               
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label tax_id" id="name_display_as_box">
                                    <?= label('GSTIN', $this, $user) ?> *<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="gstin" class="form-control" name="gstin" type="text" value="" maxlength="50" data-validation="required">
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Pan', $this, $user) ?>   :
                                </label>
                                <div class="col-sm-8">
                                    <input id="pan" class="form-control" name="pan" type="text" value="" maxlength="20">   
                                </div> 
                            </div>



                           <div class="col-sm-6">
                                <label class="col-sm-4 control-label " id="name_display_as_box">
                                    <?= label('FSSAI', $this, $user) ?> *<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="FSSAI" class="form-control" name="FSSAI" type="text" value="" maxlength="50" >
                                </div>
                            </div>

                       

                           
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label " id="name_display_as_box">
                                    <?= label('Location', $this, $user) ?> *<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="location" class="form-control" name="location" type="text" value="" maxlength="50" >
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label " id="name_display_as_box">
                                    <?= label('Pincode', $this, $user) ?> *<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="pincode" class="form-control" name="pincode" type="text" value="" maxlength="50" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                    <label class="col-sm-4 control-label " id="name_display_as_box">
                                        <?= label('API Username', $this, $user) ?> *<span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8" id="name_input_box">
                                        <input id="apiusername" class="form-control" name="apiusername" type="text" value="" maxlength="50" >
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-sm-4 control-label " id="name_display_as_box">
                                        <?= label('Api password', $this, $user) ?> *<span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8" id="name_input_box">
                                        <input id="apipassword" class="form-control" name="apipassword" type="text" value="" maxlength="50" >
                                    </div>
                                </div>
                        </div>
						<div class="col-sm-12 form-group" id="name_field_box">
							 <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Details', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <textarea type="text"  id="details" class="form-control" NoTab="NoTab" name="details" cols="30" rows="50"></textarea>              
                                </div>
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
        });
        function load() {
            var id = $("#id").val();
            //alert(id);
            var taxtype = $("#tax_type").val();
            if (taxtype === "GST")
            {
                $(".tax_id").html("<?= label('GSTIN :', $this, $user) ?>");
            } else
            {
                $(".tax_id").html("<?= label('Tax ID :', $this, $user) ?>");
            }
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('company/com_info/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);  
                        $("#hiddlogo").val(result.logo);
                        $("#FSSAI").val(result.FSSAI);
                        $("#coname").val(result.name);
                        $("#name_lan").val(result.name_lan);
                        $("#email").val(result.email);
                        $("#cophone").val(result.phone);
                        $("#gstin").val(result.tin);
                        $("#pan").val(result.pan);
                        $("#address").val(result.address);
                        $("#address_lan").val(result.address_lan);
                        $("#details").val(result.details);

                        $("#location").val(result.location);
                        $("#pincode").val(result.pincode);
                        $("#apiusername").val(result.apiusername);
                        $("#apipassword").val(result.apipassword);

                    }
                });
            }

        }
    </script>