<?php
$com_tax_type = $settings[0]['com_tax_type'];
$category_barcode = 0 ;
        if(isset($settings[0]['category_barcode'])){
            $category_barcode = $settings[0]['category_barcode'];
        }

?> 
<form method="post"  id="frmcreatemodels" back="<?php echo site_url('suppliers/create'); ?>" action="<?php echo site_url('suppliers/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $type ?>" name="type" id="type" /> 
    <input type="hidden" value="<?= $category_barcode ?>" name="category_barcode" id="category_barcode" /> 

    <input type="hidden"   id="is_model" /> 
    <input type="hidden" value="<?= $com_tax_type ?>" name="tax_type" id="tax_type" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('suppliers/listall/' . $type); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('suppliers/listall/' . $type); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Name', $this, $user) ?>*<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                                </div>  
                            </div>
                            <?php if ($this->multiple != 0) { ?>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('name_lan', $this, $user) ?>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="name_lan" class="form-control" name="name_lan" type="text" value=""   maxlength="50">              
                                    </div> 
                                </div>
                            <?php } ?>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Phone', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="phone"  data-validation="number" data-validation-optional="true" class="form-control" name="phone" type="text">
                                </div>  
                            </div> 
                        </div>
						<div class="col-sm-12 ">
							<div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Contact Person', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="contact_person"  class="form-control" name="contact_person" type="text" maxlength="500">
                                </div>  
                            </div> 
							 <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Contact Number', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="contact_number" data-validation="number" data-validation-optional="true" class="form-control" name="contact_number" type="text" value="" maxlength="50">
                                </div>  
                            </div> 
						</div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Tax', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="gstin" class="form-control" name="gstin" type="text" value="" maxlength="16">   
									<span id="exist" style="color:#a94442">GSTIN Not Valid</span>
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

                            <?php if($category_barcode > 0 ){?>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Code', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="">
                                            <input type ="text" name="code" id="code" class="form-control"/>
                                              
                                           
                                        </div>
                                    </div> 
                                </div> 
                            <?php } ?>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('State', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <select name="states_cus" id="states_cus" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                        <span class="input-group-btn pophide">
                                            <button type="button" opt="states_cus" url="<?php echo site_url('masters/states/add'); ?>" class="btn btn-primary myModalPop_cus">
                                                New
                                            </button>
                                        </span>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('PinCode', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="pincode" class="form-control price" name="pincode" type="text" value="0" maxlength="50">  
                                </div> 
                            </div>
                            
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('State Code', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="stcode" class="form-control" name="stcode" type="text" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Email', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="email" data-validation="email" nocap="true" data-validation-optional="true" class="form-control" name="email" type="text" value="" maxlength="50"></div> 
                            </div>
                        </div>

                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address line1', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <textarea id="address_line1" class="form-control" name="address_line1" type="text" value="" ></textarea>            
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address line2', $this, $user) ?>  <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <textarea  id="address_line2" class="form-control" name="address_line2" type="text"></textarea>
                                </div> 
                            </div> 
                        </div>
                        <?php if ($this->multiple != 0) { ?>
                            <div class="col-sm-12 ">
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Address line1 lan', $this, $user) ?><span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="address_line1_lan" class="form-control" name="address_line1_lan" type="text" value="" maxlength="50">              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Address line2 lan', $this, $user) ?>  <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="address_line2_lan" class="form-control" name="address_line2_lan" type="text" maxlength="50">
                                    </div> 
                                </div> 
                            </div>
                        <?php } ?>
                        <div class="col-sm-12 "> 
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Opening Balance', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="opening_bal" class="form-control two-digits price" name="opening_bal" type="text" value="0" maxlength="50">  
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">   
                                <label class="col-sm-4 control-label">
                                    <?= label('Type', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select name="credit_type" id="credit_type" class="form-control">
                                        <option value="Cr">Cr</option>
                                        <option value="Dr">Dr</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Bank', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="bankname" class="form-control" name="bankname" type="text" value="" maxlength="50">  
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Account No', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="accno" class="form-control number" name="accno" type="text" value="" maxlength="20">             
                                </div> 
                            </div>
                        </div>

                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('IFSC Code', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="ifscc" class="form-control" name="ifscc" type="text" value="" maxlength="11">  
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Area', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <select id="area_cus" name="area_cus" class="form-control">
                                            <option>select</option>
                                        </select> 
                                        <span class="input-group-btn pophide">
                                            <button type="button" opt="area_cus"  url="<?php echo site_url('master/NewMasters/area/add'); ?>" class="btn btn-primary myModalPop_cus">
                                                New
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Route', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <select id="route_cus" name="route_cus" class="form-control">
                                            <option>select</option>
                                        </select> 
                                        <span class="input-group-btn pophide">
                                            <button type="button" opt="route_cuss"  url="<?php echo site_url('master/NewMasters/route/add'); ?>" class="btn btn-primary myModalPop_cus">
                                                New
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Price List', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8"> 
                                    <select id="price_list" name="price_list" class="form-control">
                                        <option>select</option>
                                    </select>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Credit Period', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="credit" class="form-control" name="credit" type="text" value="" maxlength="50">             
                                </div> 
                            </div>
                           <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('On Exceed', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="cr_period_exceed" name="cr_period_exceed" class="form-control">
										<option value="0">Warning</option>
										<option value="1">Ban</option>
									</select>
                                </div>
                            </div>
                        </div> 
						<div class="col-sm-12 ">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('Credit Amount', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="credit_amount" class="form-control two-digits" name="credit_amount" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group ">
                                <label class="col-sm-4 control-label">
                                    <?= label('On Exceed', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="cr_amount_exceed" name="cr_amount_exceed" class="form-control">
										<option value="0">Warning</option>
										<option value="1">Ban</option>
									</select>
                                </div>
                            </div>
                        </div>
						 <div class="col-sm-12 ">
							<div class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Remarks', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="remarks" class="form-control" name="remarks" type="text" value="" maxlength="50">  
                                </div> 
                            </div>
						 </div>
                    </div>
                    <!-- /.col -->
                    <div class="box-footer popuphide">
                        <?php if ($view != 'view') { ?>
                            <button id="btnsaveds"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                        <?php } ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
    </section>
</form>
<div class="modal fade bd-example-modal-lg" id="myModalPop_cus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
<script type="text/javascript">
    $(document).ready(function () {
			 $('#exist').hide();
	$('#gstin').change(function() { 
		var gstin = $(this).val();
        $.ajax({
            url: "<?php echo site_url('Customers/check_gst') ?>",
            type: "POST",
            data: {
                "gstin": gstin
            },
            success: function(result) {
				var results = JSON.parse(result);
				if(results.valid ===true){
					$('#exist').hide();
				}else{
					$('#exist').show();
				}
                
            }
        });

    });
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

    var inc_inary = 0;
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });

    function load() {
        var id = $("#id").val();
        var taxtype = $("#tax_type").val();
        if (taxtype === "GST")
        {
            $(".tax_id").html("<?= label('GSTIN :', $this, $user) ?>");
        } else
        {
            $(".tax_id").html("<?= label('Tax ID:', $this, $user) ?>");
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
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('suppliers/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    var area_cusss = result.area;
                    var route_cusss = result.route;
                    $("#code").val(result.code);
                    $("#pincode").val(result.pincode);
					$("#contact_person").val(result.contact_person);
                    $("#contact_number").val(result.contact_number);
                    $("#name").val(result.name);
                    $("#name_lan").val(result.name_lan);
                    $("#email").val(result.email);
                    $("#phone").val(result.phone);
                    $("#gstin").val(result.tin);
                    $("#pan").val(result.pan);
                    $("#states_cus").val(result.cst);
					 $("#cr_period_exceed").val(result.credit_period_exceed);
					$("#credit_amount").val(result.credit_amount);
                    $("#cr_amount_exceed").val(result.credit_amount_exceed);
                    $("#stcode").val(result.gst);
                    $("#remarks").val(result.details);
                    $("#address_line1").val(result.address_line1);
                    $("#address_line2").val(result.address_line2);
                    $("#address_line1_lan").val(result.address_line1_lan);
                    $("#address_line2_lan").val(result.address_line1_lan);
                    $("#credit").val(result.credit_period);
                    $("#opening_bal").val(result.openingbal);
                    $("#bankname").val(result.bank);
                    $("#accno").val(result.account_no);
                    $("#ifscc").val(result.ifsc_code);
                    $("#area_cus").val(area_cusss);
                    $('#route_cus').val(route_cusss);
                    $("#credit_type").val(result.crtype);
                    //$('#opening_bal').prop('readonly', true);

                }
            });
        } else
        {
            $('#states_cus option:contains("KERALA")').prop('selected', true);
        }
    }
    function states_cus(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/states'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.StateID + '"> ' + itemsingle.StateName + '</option>';
                });
                $("#states_cus").html(option);
                $("#states_cus").val(45);
                if (is_select === 1) {
                    var myVal = $('#states_cus option:last').val();
                    $('#states_cus').val(myVal);
                }
            }
        });
    }
    function area_cuss(is_select)
    {
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
</script>