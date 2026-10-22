<?php
	$is_calendar = 0;	
	$title = 'Add Course';
	$filed1= 'Course Name';
	$filed2= 'Course Code';
	$placeholder = 'in Months';
	$duration = 'Duration';
	$Tution = 'Tution Fee';
	if(isset($settings[0]['is_calendar'])){
		$is_calendar = $settings[0]['is_calendar'];

	}
	if((float) $is_calendar > 0 ){
		$title = 'Add Package';
		$filed1= 'Package Name';
		$filed2= 'Package Code';
		$placeholder = 'in Days';
		$duration = 'No of Classes';
		$Tution = 'Amount';
	}
?>
<form method="post" id="frmcreatemodeli" enctype="multipart/form-data" back="<?php echo site_url('education/Course/listall'); ?>" action="<?php echo site_url('education/Course/save'); ?>" class="form-horizontal">
<input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/>
    <input type="hidden"   id="is_model" />  
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/>
    <input type="hidden"   id="def_barcode" value=""/>  
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                
                <div class = "box">
                <div class="nav-tabs-custom box-header with-border">
                    <h3 class="box-title"> <?= label($title, $this, $user) ?></h3>
                    <span class="pull-right popuphide"> 
                    <a role="button" 
                       class="btn  btn-success align-bottom popuphide"
                       href="<?php echo site_url('education/Course/listall'); ?>"> <span
                            class="glyphicon glyphicon-arrow-left" title="back"></span>
                    </a>
                </span>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="main_Item">                            
                            <div class="box-body">


                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label($filed1, $this, $user) ?> *<span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="name" class="form-control" name="name" type="text"
                                                   value="" data-validation="required" maxlength="250" />
                                        </div>
                                    </div>

                                    <div <?php if((float) $is_calendar > 0 ){  echo 'style="display:none;"';}?>class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label($filed2, $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="ccode" class="form-control" name="ccode" type="text"
                                                   value="" maxlength="250" />
                                        </div>  
                                    </div>
									<?php if((float) $is_calendar > 0   ){?>
										<div class="col-sm-6 form-group  odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($duration, $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<input id="duration" class="form-control" attrfuck placeholder =" <?php echo $placeholder;?>" name="duration" type="text" value="" maxlength="50">
											</div>
										</div>
									<?php } ?>

                                </div>
								<?php if((float) $is_calendar > 0 ){?>
									<div style="display:none" class="col-sm-12">
										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label('Start Date', $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<input id="start_date" class="form-control date" name="start_date" type="text"
                                                   value="" data-validation="required"  />
											</div>
										</div>

										<div class="col-sm-6 form-group odd_cls">
											<label class="col-sm-4 control-label">
												<?= label('End Date', $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<input id="end_date" class="form-control date" name="end_date" type="text"
                                                   value="" data-validation="required"  />
											</div>
										</div>

									</div>
                                <?php }?>
                                <div class="col-sm-12">
									<?php if((float) $is_calendar < 1  ){?>
										<div class="col-sm-6 form-group  odd_cls">
											<label class="col-sm-4 control-label">
												<?= label($duration, $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<input id="duration" class="form-control" attrfuck placeholder =" <?php echo $placeholder;?>" name="duration" type="text" value="" maxlength="50">
											</div>
										</div>
									<?php } ?>
									<?php if((float) $is_calendar > 0 ){?>
										<div class="col-sm-6 form-group  odd_cls">
											<label class="col-sm-4 control-label">
												<?= label('Validity Days', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<input id="validity_days" class="form-control" placeholder ="Validity" name="validity_days" type="number" value="" maxlength="">
											</div>
										</div>
										<div class="col-sm-6 form-group  odd_cls">
											<label class="col-sm-4 control-label">
												<?= label('Validity', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<input id="validity" class="form-control date" placeholder ="Validity" name="validity" type="text" value="" maxlength="">
											</div>
										</div>
									<?php } ?>
                                <div <?php if((float) $is_calendar > 0 ){echo 'style="display:none"';}else{}?> class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label("University", $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm" style = "width:100%">
                                                <select name="univ" id="univ" class="form-control">
                                                    <option value="">Select</option> 
                                                </select>
                                                <span class="input-group-btn pophide">
                                            <button type="button" opt="states_cus" url="<?php echo site_url('masters/states/add'); ?>" class="btn btn-primary myModalPop_university">
                                                New
                                            </button>
                                        </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>    
                                        
                                        
                                <div class="col-sm-12">

                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                        <?= label($Tution, $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm" style = "width:100%">
                                            <input id="tutfee" class="form-control two-digits price calcfees" name="tutfee" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
									<?php if((float) $is_calendar > 0 ){ ?>
										 <div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Discount %', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="discount_per" class="form-control two-digits price calcfees" name="discount_per" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Discount Amount', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="discount_amount" class="form-control two-digits price calcfee" name="discount_amount" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Total Amount', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input readonly id="fees" class="form-control two-digits price" name="fees" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
									<?php } ?>
                                    <div <?php if((float) $is_calendar > 0 ){echo 'style="display:none"';}else{}?> class="col-sm-6 form-group odd_cls" >
                                        <label class="col-sm-4 control-label">
                                            <?= label('Exam Fee', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="examfee" class="form-control two-digits price" name="examfee"
                                                   type="text" value="" maxlength="50">
                                        </div>
                                    </div>

                                    </div>

                                   <div <?php if((float) $is_calendar > 0 ){echo 'style="display:none"';}else{}?> class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Certification Fee', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="certifee" class="form-control two-digits price" name="certifee"
                                                   type="text" value="" maxlength="50">
                                        </div>
                                    </div>


                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Other Fee', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="otherfee" class="form-control two-digits price" name="otherfee"
                                                   type="text" value="" maxlength="50">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <div <?php if((float) $is_calendar > 0 ){echo 'style="display:none"';}else{}?>  class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Description', $this, $user) ?>  <span></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea id="description" class="form-control"
                                                      name="description"rows="20" cols="20"></textarea>
                                        </div> 
                                    </div>

                                    <div  <?php if((float) $is_calendar > 0 ){echo 'style="display:none"';}else{}?>  class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Registration Fee', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="reg_fee" class="form-control two-digits price" name="reg_fee"
                                                   type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    
                                </div>

                                    
                                <div id = "hide" class="box-footer">
                                <input type = "hidden" name = "typeid" id = "typeid"/>
                                        <button type="submit" class='btn bg-orange btn-flat'><i class="glyphicon glyphicon-hdd"></i></button> 
                                    </div>

                                

                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div></div></div></div></div>
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
                <input type="text" id = "changess" value = "Nothing to change" style="border:none;width:100%"/>
                </div>          
                <div class="modal-footer no-border">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                    </button>
                </div>
            </div>
        </div>
</div>

<!-- Modal  -->
<div class="modal fade bd-example-modal-lg" id="myModalPop_university" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<form method="post" id="university" back="<?php echo site_url('education/Course/create'); ?>" action="<?php echo site_url('education/Course/addUniversity'); ?>" class="form-horizontal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class = "modal-header">
                <h3>Add University</h3>
            </div>
            <div class="modal-body" id="modal-body"> 
                
            

            <div class="col-sm-12">

                <div class="col-sm-6 form-group">
                <label class="col-sm-4 control-label">
                <?= label('University Name', $this, $user) ?><span class="required"></span> :
                </label>
                <div class="col-sm-8">
                    <div class="input-group input-group-sm" style = "width:100%">
                    <input id="uniname" class="form-control" name="uniname" type="text" value="" maxlength="50">
                </div>
                </div>
                </div>

                <div class="col-sm-6 form-group odd_cls" >
                <label class="col-sm-4 control-label">
                <?= label('University Code', $this, $user) ?><span class="required"></span> :
                </label>
                <div class="col-sm-8">
                <input id="unid" class="form-control" name="unid" type="text" value="" maxlength="50">
                </div>
                </div>

            </div>                                    

            </div> 
            <div class="modal-footer">
                <button type="button" id="mcb" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="saveuni" data-dismiss="modal" popup_type="item" class="btn btn-primary">Save changes</button>
            </div>
        </div> 
    </div>
 </form>
</div>

<script type="text/javascript">
	function formatDate(input) {
		if(input!== null && input!== undefined ){
				var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0), // get only two digits
                month = datePart[1], day = datePart[2];
				return day + '/' + month + '/' + year;
		}else{
			return '';
		}
    }
    $(document).ready(function () {
		$('#validity_days').change(function(){
			var validity_days = $(this).val();
			if(validity_days === ''){
				validity_days = 0;
			}
			var start_date = $('#start_date').val();
			var dmy = start_date.split("/");        // "24/06/2011" should be pulled from $("#DatePicker").val() instead
			var joindate = new Date(
					parseInt(dmy[2], 10),
					parseInt(dmy[1], 10) - 1,
				parseInt(dmy[0], 10)
			);
			//alert(joindate);                          // Fri Jun 24 2011 00:00:00 GMT+0500 (West Asia Standard Time) 
			//alert(validity_days);
			joindate.setDate(joindate.getDate() + parseInt(validity_days)); // substitute 1 with actual number of days to add
			//alert(joindate);                          // Sat Jun 25 2011 00:00:00 GMT+0500 (West Asia Standard Time)
			//alert(
				//("0" + joindate.getDate()).slice(-2) + "/" +
				//("0" + (joindate.getMonth() + 1)).slice(-2) + "/" +
				//joindate.getFullYear()
			//);
			var new_date = ("0" + joindate.getDate()).slice(-2) + "/" +
				("0" + (joindate.getMonth() + 1)).slice(-2) + "/" +
				joindate.getFullYear();
			$('#validity').datepicker('setDate',new_date);
		});
		$('.calcfees').change(function(){
			var tutfee = $('#tutfee').val();
			var discount_per = $('#discount_per').val();
			var discount_amount = 0;
			if(parseFloat(tutfee) > 0 &&  parseFloat(discount_per) > 0 ){
				discount_amount = parseFloat(tutfee) * parseFloat(discount_per) /100;
				discount_amount = parseFloat(discount_amount).toFixed(2);
			}
			var fees = parseFloat(tutfee) - parseFloat(discount_amount);
			$('#fees').val(parseFloat(fees).toFixed(2));
			$('#discount_amount').val(discount_amount);
		});
		$('.calcfee').change(function(){
			var tutfee = $('#tutfee').val();
			var discount_amount = $('#discount_amount').val();
			dis = parseFloat(((discount_amount * 100) / (tutfee)));
			$('#discount_per').val(dis);
			$('#discount_per').trigger('change');
		});
        $("#m_itemClick").bind("click", function () {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
        });
        $('#name').focus();
        taxes(0);
        var taxopen = $('select#tax_id option:selected').val();
        gettaxldg(taxopen);
        brands(0);
        size();
        material_types();
        hsn_code(0);
        item_category(0);
        item_group(0);
        unit(0);
        load();

        $(document).ready(function(){
            $(".myModalPop_university").click(function () {
            $('#myModalPop_university').modal('show');
            $('#saveuni').click(function() {
            $('#myModalPop_university').modal('hide');
            });   
        });
        })

        
        $('#saveuni').click(function() {
        $('#myModalPop_university').modal('hide');
        });
        


        var idinc = 0;
        $('#addmore').click(function () {
            var id = $("#id").val();
            var alt_item = $('#alt_item_name').attr('txt');
            var alt_itemid = document.getElementById('alt_item_id').value;
            if (alt_itemid !== "")
            {
                otheritem(id, alt_itemid, alt_item);
                $('#alt_item_name').val("");
                $('#alt_item_id').val("");
            }
        });
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
			});

        $("#btnsaveds").click(function () {
            $("#btnsaveds").attr('disabled', 'disabled');
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            var is_model = $('#is_model').val();
            var frm = "#frmcreatemodeli";
            var url = $(frm).attr('action');
            var name = $("#name").val();
            if (name === '') {
                $("#btnsaveds").removeAttr('disabled');
                toastr.info("Please add a Product Name");
                return;
            }
            var data = new FormData();
            var img_enabled = $("#photo_enable").val();
            if (img_enabled === '1')
            {
                var file_a = document.getElementById("file_a").files[0];
                var file_b = document.getElementById("file_b").files[0];
                var file_c = document.getElementById("file_c").files[0];
                data.append("file_a", file_a);
                data.append("file_b", file_b);
                data.append("file_c", file_c);
            }
            var vid_enabled = $("#video_enable").val();
            if (vid_enabled === '1')
            {
                var vidfile_a = document.getElementById("vidfile_a").files[0];
                var vidfile_b = document.getElementById("vidfile_b").files[0];
                data.append("vidfile_a", vidfile_a);
                data.append("vidfile_b", vidfile_b);
            }

            var other_data = $(frm).serializeArray();
            $.each(other_data, function (key, input) {
                data.append(input.name, input.value);
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data, // send it here
                contentType: false, // this
                processData: false, // and this should be false in case of uploading files
                beforeSend: function (xhr) {
                },
                success: function (Onj) {
                    var wsQuery = JSON.parse(Onj);

                    if (is_model === '1') {
                        showpage();
                        $('#mcb').click();
                        return;
                    }

                    var back = $(frm).attr('back');
                    $.ajax({
                        url: back,
                        success: function (result) {
                            $("#div1").html(result);
                            issubmited = 0;
                        }
                    });
                    showpage();
                    toastr["success"](wsQuery.message);
                },
                error: function (data) {
                }
            });
        });

    });
    function setbarcode() {
        var is_manual = $('input[name=manual]:checked').val();
        var def_barcode = $("#def_barcode").val();
        if (is_manual === '0') {
            $("#barcode").attr('readonly', false);
            $("#barcode").val('');

        } else {
            $("#barcode").attr('readonly', true);
            $("#barcode").val(def_barcode);
        }
    }
    var inc_inary = 0;
    function godownitem(iid, gid, name, gqty) {
        idinc = idinc + 1;
        if (gqty === null)
        {
            gqty = 0;
        }
        newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
                '<td ><input value="' + gqty + '"  type="text" name="gqty[' + idinc + ']"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
        $("#rowg").append(newrow);
    }
    var other_inc = 0;
    function otheritem(iid, alt_itemid, alt_item) {
        other_inc = other_inc + 1;
        newrow = '<tr><td><input  class="form-control"    value="' + alt_item + ' "type="text" disabled><input  value="' + alt_itemid + '"  type="text" name="alt_itemids[]"  class="hidden cre form-control"/></td>' +
                '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
        $("#rowma").append(newrow);
    }
    function godownlist(gid, name, gqty) {
        if (gqty === null)
        {
            gqty = 0;
        }
        if (gid === null)
        {
            gid = 0;
        }
        newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
                '<td ><input value="' + gqty + '"  type="text" name="gqty[' + idinc + ']"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
        $("#rowg").append(newrow);
        idinc = idinc + 1;
    }
    var idinc = 0;
    function getgodownlist()
    {
        $.ajax({
            url: "<?php echo site_url('item/allgodown'); ?>",
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    var godown_id = itemsingle.id;
                    var godown_name = itemsingle.godown_name;
                    var gqty = 0;
                    godownlist(itemsingle.id, itemsingle.godown_name, gqty);
                });
            }
        });
    }

    $("#alt_item_name").autocomplete({
        source: "<?php echo site_url('ajaxcall/itemssearch'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $("#alt_item_name").attr('txt', ui.item.name);
            loadaltItem(ui);
        }
    });
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });
    $("#alt_item_name").keydown(function (e) {
        var key = e.charCode || e.keyCode || 0;
        if (key === 13 || key === 9)
        {
            var id = $("#id").val();
            var alt_item = document.getElementById('alt_item_name').value;
            var alt_itemid = document.getElementById('alt_item_id').value;
            if (alt_itemid !== "")
            {
                otheritem(id, alt_itemid, alt_item);
                $('#alt_item_name').val("");
                $('#alt_item_id').val("");
            }
        }
    });
    function hsn_code(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/hsn_code'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.hsnid + '"> ' + itemsingle.hsncode + '</option>';
                });
                $("#hsn_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#hsn_id option:last').val();
                    $('#hsn_id').val(myVal);
                }
            }
        });
    }
    function item_category(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#item_category_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#item_category_id option:last').val();
                    $('#item_category_id').val(myVal);
                }
            }
        });
    }
    function item_group(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_group'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#item_group_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#item_group_id option:last').val();
                    $('#item_group_id').val(myVal);
                }
            }
        });
    }
    function unit(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/unit'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#unit_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#unit_id option:last').val();
                    $('#unit_id').val(myVal);
                }
            }
        });
    }
    function taxes(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/tax'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.gstid + '"> ' + itemsingle.GST + '</option>';
                });
                $("#tax_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#tax_id option:last').val();
                    $('#tax_id').val(myVal);
                    gettaxldg(myVal);
                }
            }
        });
    }
    function racks(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/racks'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option rows = "' + itemsingle.rows + '" value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#rack_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#rack_id option:last').val();
                    $('#rack_id').val(myVal);
                }
            }
        });
    }
    function rows(is_select)
    {
        var option = '';
        var row = $('#rack_id').find(':selected').attr('rows');
        var i = 0;
        for (i = 1; i <= row; i++) {
            option = option + '<option value ="' + i + '"> ' + i + '</option>';
        }
        $("#rrow").html(option);

    }

    function size(is_select) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/size'); ?>",
            success: function (result) {
                $('#item_size').html(result);

            }
        });
        if (is_select === 1) {
            var myVal = $('#brand_id option:last').val();
            $('#brand_id').val(myVal);
        }
    }
    function brands(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#brand_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#brand_id option:last').val();
                    $('#brand_id').val(myVal);
                }
            }
        });
    }
    function material_types()
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/material_types'); ?>/",
            async: false,
            success: function (result) {
                $("#material_type").html(result);
            }
        });
    }
    function loadanalyt(ui) {
        $('#analytics_name').val(ui.item.any_name);
        $('#analytics_id').val(ui.item.any_id);
    }
    function loadaltItem(ui) {
        $('#alt_item_name').val(ui.item.name);
        $('#alt_item_id').val(ui.item.id);
        //$('#cat').focus();
    }
    function load() {
        var id = $("#id").val();
        var is_autobarcode = $("#is_autobarcode").val();
        if (is_autobarcode === '1') {
            $("input:radio[name='manual'][value ='1']").prop('checked', true);
//            alert($('input[name=manual]:checked').val());
            $("#barcode").attr('readonly', true);
            if (id === '0') {
                $.ajax({
                    url: "<?php echo site_url('item/getbarcode'); ?>/",
                    async: false,
                    success: function (result) {
                        $("#barcode").val(result);
                        $("#def_barcode").val(result);
                    }
                });
            }
        }
        //alert(id);

        if (id > 0) {
            text = "";
            $('#hideme').hide();
            $.ajax({
				async:false,
                url: "<?php echo site_url('item/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#name").val(result.name);
					$('#discount_per').val(result.discount_per);
					$('#discount_amount').val(result.discount_amount);
					$('#fees').val(result.fees);
                    $("#validity").val(result.validity);
                    $("#tutfee").val(result.tutionfee);
                    $("#ccode").val(result.barcode);
                    $("#description").val(result.description);
                    setUniv(result.university);
                    // $('#univ').html(text);
                    $("#duration").val(result.open_stock);
                    $("#examfee").val(result.examfee);
                    $("#certifee").val(result.certificatefee);
                    $("#otherfee").val(result.otherfee);
                    $("#reg_fee").val(result.reg_fee);
                    $("#validity_days").val(result.validity_days);
					if(result.validity !== undefined){
						$('#validity').val(formatDate(result.validity));
					}
					if(result.course_start_date !== undefined){
						$('#validity').val(formatDate(result.validity));
						$('#start_date').val(formatDate(result.course_start_date));
						$('#end_date').val(formatDate(result.course_end_date));
					}
         
                }
            });
			$('#discount_per').trigger('change');

            $.ajax({
                url: "<?php echo site_url('item/godownitem'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        godownitem(itemsingle.item_id, itemsingle.godownid, itemsingle.godown_name, itemsingle.open_stock);
                    });
                }
            });
            $.ajax({
                url: "<?php echo site_url('item/otheritem'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        otheritem(itemsingle.item_id, itemsingle.otherid, itemsingle.othername);
                    });
                }
            });
        }
    }
    $("#analytics_name").autocomplete({
        source: "<?php echo site_url('cost_analytics/analytics_centre/analyt_centres'); ?>",
        minLength: 1,
        select: function (event, ui) {
            loadanalyt(ui);

        }
    });
    $("#sales_tax").autocomplete({
        source: "<?php echo site_url('item/taxldg_find/saletax'); ?>",
        minLength: 1,
        select: function (event, ui) {
            $('#sales_tax').val(ui.item.name);
            $('#saletax_id').val(ui.item.id);
        }
    });
    $("#purc_ledger").autocomplete({
        source: "<?php echo site_url('item/taxldg_find/purtax'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $('#purc_ledger').val(ui.item.name);
            $('#purctax_id').val(ui.item.id);

        }
    });
    $("#tax_ledger").autocomplete({
        source: "<?php echo site_url('item/taxldg_find/tax'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $('#tax_ledger').val(ui.item.name);
            $('#taxldg_id').val(ui.item.id);

        }
    });
    function gettaxldg(taxxid, taxtype)
    {
        $.ajax({
            url: "<?php echo site_url('item/gettaxldg'); ?>/" + taxxid,
            async: false,
            success: function (results) {
                var result = JSON.parse(results);
                $("#tax_ledger").val(result.tax.name);
                $('#taxldg_id').val(result.tax.id);
                $("#sales_tax").val(result.saletax.name);
                $("#saletax_id").val(result.saletax.id);
                $("#purc_ledger").val(result.purctax.name);
                $("#purctax_id").val(result.purctax.id);
            }
        });
    }
    $("#tax_id").change(function () {
        
    });
</script>
<script>
    $.validate({
        modules: 'security',
        onModulesLoaded: function () {
        }
    });
    $(document).ready(function(){
        var typeid = 2;
        // alert(typeid);
        $('#typeid').val(typeid);
        var view = $("#view").val();
        var id = $("#id").val();
        if(view == "view"){
            // alert(id);
            $('#hide').hide();
        }
    });

    setUniv(0)

    function setUniv(univ){
        var text = "";
        $.ajax({
                
                url: "<?php echo site_url('education/Course/getUniversity'); ?>",
                success: function (results) {
                    console.log(results);
                    
                    $.each(JSON.parse(results), function(i, items){
                        if(items.id == univ){
                            text = text +  '<option selected = "selected" value = "'+items.id+'">'+items.name+'</option>';
                        }
                        else{
                            text = text +  '<option value = "'+items.id+'">'+items.name+'</option>';
                        }
                        
                        $('#univ').html(text);
                        // var selected = '<input type="hidden" value="'+items.id+'" name="typeid" id="typeid"/>';
                        // alert(selected);
                    });
                    
                    
                }
            });
    }
    
            
            
</script>