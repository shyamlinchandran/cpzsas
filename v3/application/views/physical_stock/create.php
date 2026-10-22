<?php
$add_url = site_url('Physical_stock/listall');
$type = 'item';
$is_batch = $settings[0]['is_batch'];
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="<?=$this->box_color?>">
					
                    <div class="box-header">
                        <h3 class="box-title"><?= label('Physical Stock ', $this, $user) ?><?php if((float) $id > 0 ){ echo 'Edit ';}else{ echo 'Create';}?><b><?php echo $voucher_no;?></b></h3>
						 <span class="pull-right">
                        <a role="button" back="<?php echo site_url('Physical_stock\list'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Physical_stock\list'); ?>">
                            <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
							
                        </a>
                    </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <tbody>
                                <tr><td class="col-sm-2">
                                        <?= label('Material Type', $this, $user) ?>
                                        <select id="material_type"  class="form-control" name="material_type">
                                            <option value="">All</option>
                                        </select>      
                                    </td>
									 <td class="col-sm-2">
										<?= label('Category', $this, $user) ?>
										<select id="category_id"  class="form-control" name="category_id">
											<option value="">All</option>
										</select>    										
									</td> 
									<td class="col-sm-2">
										<?= label('Brand', $this, $user) ?> 
										<select id="brand"  class="form-control" name="brand">
											<option value="">All</option>
										</select>    
									</td>

                                    <td>
                                        <br/>
                                        <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                        <br/> 
						<form back="#!" id="formedit" <?php if($id  < 1){ ?> action="<?php echo site_url('Physical_stock/save') ?>" method="post" <?php } ?>>
							<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
							<table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th> <?= label('SNo', $this, $user) ?></th>
                                        <th><?= label('Barcode', $this, $user) ?></th>
                                        <th><?= label('Item', $this, $user) ?></th>
                                        <th><?= label('Godown', $this, $user) ?></th> 
										<?php if((float)$is_batch > 0  ){?>
											 <th> <?= label('Batch', $this, $user) ?></th>
										<?php } ?>
                                        <th> <?= label('Opening Stock', $this, $user) ?></th>
                                        <th> <?= label('Current Stock', $this, $user) ?></th>
                                        <th> <?= label('Actual Stock', $this, $user) ?></th>
                                        <th> <?= label('Update Quantity', $this, $user) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>


                            </table>
							<?php if($id  < 1){ ?>
								<input type="button" id="button" value="Save All"  class="btn btn-primary"/>
							<?php } ?>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

<script type="text/javascript">

	$(document).on('change', '.actualStk', function(){
		var cnt = $(this).attr('cnt');
		var stock = 0 ;
		var cStock = $('#currStk'+cnt).val();
		var aStock = $('#actualStk'+cnt).val();
		if(cStock === ''){
			cStock = 0 ;
		}
		if(aStock === ''){
			aStock = 0 ;
		}
		if(parseFloat(aStock) > parseFloat(cStock) ){
			stock =  parseFloat(aStock) - parseFloat(cStock);
		}
		
		if(parseFloat(aStock) < parseFloat(cStock) ){
			stock =  parseFloat(cStock) - parseFloat(aStock);
			stock = stock * -1;
		}
		$('#uStk'+cnt).val(stock);
	});

    var table;
	$(document).on('change', '.qty', function(){
		if( $(this).val() === ''){
			$(this).val(0)
		}
		
	});
    $(document).ready(function () {
	
		$( "#button" ).click(function( event ) {	
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
			var url = $('#formedit').attr('action');
			var other_data = $('#formedit').serializeArray();
			event.preventDefault();
			 $.ajax({
                type: 'POST',
                url: url,
                data: other_data, // send it here
                success: function(Onj) {
                    toastr["success"]('Updated Successfully');
					 table.ajax.reload(null, false); 
                },
                error: function(data) {}
            });
		});
		 $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/",
            async: false,
            success: function (result) {
                var option = '<option value =""> All </option>';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#category_id").html(option);
            }
        });
		$.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value="">Select</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#brand").html(option);
                
            }
        });
        material_types();
 
        table = $('#table').DataTable({
             "responsive": true,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 50, 100,200,300,400], [10, 25, 50, 200,300,400]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [

            ],
            "order": [], //Initial no order.
            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Physical_stock/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.material_type = $("#material_type").val();
					data.brand = $("#brand").val();
					data.category_id = $("#category_id").val();
					data.id = $("#id").val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        var val = readCookie('search_<?= $type ?>');
        if (val !== null) {
            table.search(val).draw();
        }
        $('.dataTables_filter input').unbind().keyup(function () {
            var value = $(this).val();
            if (value.length > 2) {
                createCookie('search_<?= $type ?>', value, 3);
                table.search(value).draw();
            }
            if (value.length === 0) {
                eraseCookie('search_<?= $type ?>');
                table.search(value).draw();
            }
        });
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });


    });
    function material_types()
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/material_types'); ?>/",
            async: false,
            success: function (result) {
                var all_type = "<option value=''>All</option>";
                $("#material_type").html(all_type + result);

            }
        });
    }

</script>  