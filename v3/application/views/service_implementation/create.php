<form method="post" id="frmcreatemodels" back="<?php echo site_url('service_implementation/Service_implementation/list'); ?>" action="<?php echo site_url('service_implementation/Service_implementation/save'); ?>" class="form-horizontal">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', 'Implementation Note '.$view)) ?></h3>
                        <input id="id" name="id" type="hidden" value="<?= $id ?>" maxlength="50">
                        <input id="view_id" name="view_id" type="hidden" value="<?= $view ?>" maxlength="50">
                        <input id="edit_id" name="edit_id" type="hidden" value="<?= $view ?>">
                        <input id="edit_db" name="edit_db" type="hidden" value="" maxlength="50">
                        <input id="name_id" name="name_id" type="hidden" value="" maxlength="50">
                        <input id="product_id" name="product_id" type="hidden" value="" maxlength="50">





                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('service_implementation/Service_implementation/list'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('service_implementation/Service_implementation/list'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>

                    <div class="box-body with-border">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Customer Name', $this, $user) ?>*<span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="name" data-validation="required" value="" class="form-control" name="name" type="text" maxlength="50" />
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Contract', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="contract" value="" class="form-control" name="contract" type="text" maxlength="50" />
                                </div>
                            </div>

                        </div>
						<div class="col-sm-12">
							 <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Customer Phone', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="cus_phone"  value="" class="form-control" name="cus_phone" type="text" maxlength="13" />
                                </div>
                            </div>
							<div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Customer Email', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="cus_email"  value="" class="form-control" name="cus_email" type="text"  />
                                </div>
                            </div>
							
						</div>
						<div class="col-sm-12">
							 <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="cus_address"  value="" class="form-control" name="cus_address" type="text" maxlength="13" />
                                </div>
                            </div>
							<div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Location', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="cus_location"  value="" class="form-control" name="cus_location" type="text"  />
                                </div>
                            </div>
							
						</div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Remote', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="remote" value="" class="form-control" name="remote" type="text" maxlength="50" />
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Installation Date', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="install_date" data-validation="required" value="" class="form-control" name="install_date" type="text" />
                                </div>
                            </div>
                            <!-- date <input type="text" id="from-datepicker"/> -->

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Installation Team', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="install_team" value="" class="form-control" name="install_team" type="text" maxlength="50" />
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('warranty till Date ', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="warranty_date" value="" data-validation="required" class="form-control" name="warranty_date" type="text" />
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Transport By', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="transport_by" value="" class="form-control" name="transport_by" type="text" maxlength="50" />
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Transport Charge', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="transport_charge" value="" class="form-control" name="transport_charge" type="text" maxlength="50" />
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Despach By', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="despach_by" value="" class="form-control" name="despach_by" type="text" maxlength="50" />
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Extra Accessories', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="extra_access" value="" class="form-control" name="extra_access" type="text" maxlength="50" />
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Motor', $this, $user) ?><span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="motor" value="" class="form-control" name="motor" type="text" maxlength="50" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <table id="table_products" class="table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">

                                <!-- <thead> -->
                                <tbody>
                                    <tr>
                                        <td>Product Name</td>
                                        <td>Measurement</td>
                                        <td>Quantity</td>
                                        <td>Implementation Type</td>
                                        <?php if ($view == 'view') { ?>

                                            <td style='display:none'>submit</td>

                                        <?php } else { ?>
                                            <td>submit</td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td><input id="product_name" value="" class="form-control" name="product_name" type="text" /></td>

                                        <td><input id="measurement" value="" class="form-control" name="measurement" type="text" maxlength="50" /></td>
                                        <td><input id="quantity" value="" class="form-control" name="quantity" type="text" maxlength="50" /></td>
                                        <td>
											<select id="sub_name" value="" class="form-control" name="sub_name" type="text"  >
											</select>
										</td>
                                        <?php if ($view == 'view') { ?>
                                            <td style='display:none'> <button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtra" class="btn btn-success" href="#">
                                                    <span class="glyphicon glyphicon-plus"></span> </button> </td>
                                        <?php } else { ?>
                                            <td> <button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtra" class="btn btn-success" href="#">

                                                    <span class="glyphicon glyphicon-plus"></span> </button> </td>

                                        <?php } ?>


                                    </tr>
                                </tbody>
                                <!-- </thead> -->
                                <tbody id='addrow' class="table <?= $this->table_color ?> table-responsive">
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <table id="table_products" class="table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>File upload</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Select File Type</td>
                                        <td>Choose File</td>
                                        <td>Submit</td>
                                    </tr>
                                    <tr>
                                        <td><select type="text" class="form-control" id="file_select" name="file_select" value="">
                                                <option value="select">select</option>
                                                <option value="image">Image</option>
                                                <option value="document">Document</option>
                                            </select>
                                        </td>

                                        <td><input class="custom-file-input" id="image_file" name="image_file" type="file" value=""></input></td>
                                        <td><button data-toggle="tooltip" type="button" title="Add To save" id="btnAddFile" class="btn btn-success" href="#">

                                                <span class="glyphicon glyphicon-plus"></span> </button></td>

                                    </tr>
                                </tbody>

                                <tbody id='addFile' class="table <?= $this->table_color ?> table-responsive">
                                </tbody>
                            </table>
                        </div>


                        <div class="box-footer popuphide">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>
</form>
<div id="uploaded_image">




    <script type="text/javascript">
		var imagename = '';
        var id = $("#id").val();
        var view = $("#view_id").val();
        var edit = $("#edit_id").val();

        $("#btnAddExtra").click(function() {
            if ($('#product_name').val() == '' || $('#product_id').val() == '' || $('#measurement').val() == '' || $('#quantity').val() == '' || $("#sub_name").val() == '') {

            } else {
                var product_name = $('#product_name').val();
                var product_id = $('#product_id').val();
                var measurement = $('#measurement').val();
                var quantity = $('#quantity').val();
                var sub_name = $("#sub_name").val();
                var unique_id = '';
				var imp_name = $("#sub_name option:selected").text();
                add_data(product_name, product_id, unique_id, measurement, quantity, sub_name,imp_name);
            }
        });

        function add_data(product_name, product_id, unique_id, measurement, quantity, sub_name,imp_name) {
            $('#product_name').val('');
            $('#product_id').val('');
            $('#measurement').val('');
            $('#quantity').val('');
            $("#sub_name").val('');

            var newrow = " <tr id='myTableRow'><td><input id='product_name' value='" + product_name + "' class='form-control' name='product_name[]' type='text' /></td>";
            newrow = newrow + " <input id='product_id' value='" + product_id + "' name='product_id[]' type='hidden' />";
            newrow = newrow + "<input id='unique_id' value='" + unique_id + "' name='unique_id[]' type='hidden' />";
            newrow = newrow + '<td><input type="text" id="measurement" value="' + measurement + '" class="form-control" name="measurement[]"" /></td>';
            newrow = newrow + "<td><input id='quantity' value='" + quantity + "' class='form-control' name='quantity[]' type='text'/></td>";
            newrow = newrow + "<td><input type='hidden' name='sub_name[]' value = '"+sub_name+"' ><input readonly='readonly' id='sub_name' value='" + imp_name + "' class='form-control' name='' type='text'  /></td>";
            if (view == "view") {
                newrow = newrow + "<td style = 'display:none'><button data-toggle='tooltip' type='button' title='Delete' id='remove' class='btn btn-danger remove' href='#'><span class='glyphicon glyphicon-remove'></span></button></td>";
            }
            // if (edit == "edit") {
            //     newrow = newrow + "<td><button value='" + unique_id + "' data-toggle='tooltip' type='button' title='Delete' id='remove_db' class='btn btn-danger' href='#'><span class='glyphicon glyphicon-remove'></span></button></td>";
            // newrow = newrow + '<td><a  href="' . base_url() . 'service_implementation/Service_implementation/create/' . $item->imp_id . '/edit" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>                  

            // } 
            else {
                newrow = newrow + "<td><button data-toggle='tooltip' type='button' title='Delete' id='remove' class='btn btn-danger remove' href='#'><span class='glyphicon glyphicon-remove'></span></button></td>";
            }


            $('#addrow').append(newrow);

        }
        $(document).on('click', ".remove", function() {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
            //calcrow();
        });
        $(document).ready(function() {
			$.ajax({
				url: "<?php echo site_url('service_implementation/Service_implementation/implementation_type'); ?>/",
				async: false,
				success: function (result) {
					$("#sub_name").html(result);
				}
			});
			$('#name').change(function(){
				var name_id = $('#name_id').val();
				if(name_id ===''){
					name_id = 0;
				}
				if(parseFloat(name_id) < 1 ){
					$('#name').val('');
				}
			});
            $('#btnAddFile').click(function(event) {
               var image_file = $('#image_file').val();
			   imagename = '';
                if ($('#image_file').val() == '' || $('#file_select').val() == '') {

                } else {
                    var data = new FormData();
                    var file = document.getElementById("image_file").files[0];
                    if (file !== undefined) {
                        data.append("document", file);
                        $.ajax({
                            url: "<?php echo site_url('service_implementation/Service_implementation/new_upload'); ?>",
                            type: 'POST',
							async:false,
                            data: data,
							processData: false,
                            contentType: false, // send it here
                            success: function(result) {
								image_file = result;
								imagename = result;
                                if (result !== "") {
									
                                    $('#image_file').val(result);
                                   // var text = '<img style="height:100px;width: 100px;" src="<?php echo site_url('uploads/images/'); ?>' + result + '" alt="Smiley face" height="42" width="42">';
                                    //$('#imagediv').html(text);
                                }
                            }
                        });

                    }

                    var file_select = $('#file_select').val();
                    var primary_id = '';
                    add_file(file_select, primary_id, imagename);
                }
            });
        });

        function add_file(file_select, primary_id, image_file) {
            $('#image_file').val('');
            $('#file_select').val('select');
            if (file_select == 'Image') {
                file_select_id = 1;
            }
            if (file_select == 'Document') {
                file_select_id = 2;
            } else {
                file_select_id = 0;
            }
            var newrow = '<tr><td><input type="text" class="form-control" id="file_select" name="file_select[]" value="' + file_select + '"> </input></td>';
            newrow = newrow + '<input id="file_select_id" name="file_select_id[]" type="hidden" value="' + file_select_id + '" ></input>';
            newrow = newrow + '<input id="primary_id" name="primary_id[]" type="hidden" value="' + primary_id + '" ></input>';
            newrow = newrow + '<td><a tp="new" target="_blank" href="<?php echo site_url('uploads/images/'); ?>' + image_file.replace(" ", "_") + '" >' + image_file + '</a><input class="form-control" id="image_file" name="image_file[]" type="hidden" value="' + image_file + '" ></input></td>';
            newrow = newrow + '<td><button data-toggle="tooltip" type="button" title="Delete" id="remove_row" class="btn btn-danger remove_row" href="#"><span class="glyphicon glyphicon-remove"></span> </button></td></td>'
            $('#addFile').append(newrow);
        }
        $(document).on('click', ".remove_row", function() {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });


        $("#name").autocomplete({
            source: "<?php echo site_url('service_implementation/Service_implementation/get_name'); ?>",
            minLength: 2,
            select: function(event, ui) {
                $('#name').val(ui.item.name);
                $('#name_id').val(ui.item.id);
                $('#cus_phone').val(ui.item.contactNumber);
                $('#cus_email').val(ui.item.email);
                $('#cus_address').val(ui.item.adress);
                $('#cus_location').val(ui.item.location);
            }
        });

        $('#product_name').autocomplete({
            source: "<?php echo site_url('service_implementation/Service_implementation/product_name'); ?>",
            minlength: 2,
            select: function(event, ui) {
                $('#product_name').val(ui.item.name);
                $('#product_id').val(ui.item.id);
            }
        });


        if (id > 0) {

            $.ajax({
                url: "<?php echo site_url('service_implementation/Service_implementation/other_item'); ?>/" + id,
                success: function(results) {
                    $.each(JSON.parse(results), function(i, p) {
                        add_data(p.product_name, p.product_id, p.unique_id, p.measurement, p.quantity, p.imptypeid,p.imptypename);
                    });
                }
            });

            $.ajax({
                url: "<?php echo site_url('service_implementation/Service_implementation/image_docs'); ?>/" + id,
                success: function(results) {
                    $.each(JSON.parse(results), function(a, b) {
                        add_file(b.file_select, b.primary_id, b.image_file);
                    });
                }
            });

            $.ajax({
                url: "<?php echo site_url('service_implementation/Service_implementation/getsing'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    $("#name").val(result.name);
                    $("#motor").val(result.motor);
                    $("#contract").val(result.contract);
					$('#name_id').val(result.lead_id);
                    $("#remote").val(result.remote);
                    $("#install_date").val(result.installation_date);
                    $("#install_team").val(result.installation_team);
                    $('#warranty_date').val(result.warranty_till_date);
                    $('#transport_by').val(result.transport_by);
                    $('#transport_charge').val(result.transport_charge);
                    $('#despach_by').val(result.despach_by);
                    $('#extra_access').val(result.extra_accessories);
					
					$('#cus_phone').val(result.phone);
                    $('#cus_email').val(result.email);
                    $('#cus_address').val(result.address);
                    $('#cus_location').val(result.Location);

                }
            });

        }
        $(document).ready(function() {
            $("#install_date").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#warranty_date").datepicker({
                format: 'yyyy-mm-dd'
            });

        });
    </script>