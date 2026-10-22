<?php
$add_url = site_url('item/create');
$type = 'item';
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #000;
    }

    .select2-selection.select2-selection--multiple {
        min-height: 25px;
        max-height: 25px;
    }

</style>
<link href="<?php echo base_url(); ?>asset/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('Itemsedit/listall'); ?>" action="<?php echo site_url('Itemsedit/save') ?>">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="<?=$this->box_color?>">

                    <div class="box-header">
                        <h3 class="box-title">Modify Item Rates</h3>
                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table   class="table table-bordered" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
									  <td class="col-sm-1 col-md-1"></td>
									<td class="col-sm-3 col-md-2">
										Category
									</td>
									<td class="col-sm-3 col-md-2">
										Brand
									</td>
                                    	<td class="col-sm-3 col-md-2">
										Status
									</td>
                                    <td class="col-sm-3 col-md-2"></td>
                                    <td> 
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-1 col-md-1"></td>
									<td class="col-sm-3 col-md-2">
									<input type="hidden" id="category_id" name="category_id" class="form-control" />
									<input type="text" id="item_category_name" name="item_category_name" class="form-control" />
									</td>
									<td class="col-sm-3 col-md-2">
										<select id="brand"  class="form-control" name="brand">
											<option value="">All</option>
									<select>  
									</td>
                                    	<td class="col-sm-3 col-md-2">
										<select id="it_stat"  class="form-control" name="it_stat">
											<option value="1">Active</option>
											<option value="0">InActive</option>
									<select>  
									</td>
                                    <td class="col-sm-3 col-md-2"><input type="text" id="txtSearch"  class=" form-control" placeholder="Barcode/Name/Any Part" /></td>
                                    <td> 
                                        <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
										<input type="button" class="btn btn-success" id="btn-clear"  value="Clear"/>
                                    </td>
                                </tr>

                            </tbody>
                        </table>  

                        <br/> 
                        <form id="saveitems">
                            <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Barcode</th>
                                        <th>WhRate</th> 
                                        <th>PRate</th> 
                                        <th>MRP</th>
                                        <th>SRate</th>
                                        <th>Landing Cost</th>
                                        <th>Special Rate</th>
                                        <th>Hsncode</th>
                                        <th>Godown</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Cess</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="rowm">
                                </tbody>


                            </table>
                            <input type="submit" value="Save All"  class="btn btn-primary"/>
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
</form>
<script src="<?php echo base_url(); ?>asset/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">

    var table;

    $(document).ready(function () {

		$("#item_category_name").autocomplete({
        source: "<?php echo site_url('Item/getallCat'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#category_id').val(ui.item.id);
            $('#item_category_name').val(ui.item.name);
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
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "paging": false,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
//            "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
            'dom': "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [

            ],
            "order": [], //Initial no order.
            "fnDrawCallback": function () {
                loadpermission();
                $('.select2').select2();
					        $('#table').tableNav();
        $('#table input').eq(1).click();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Itemsedit/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.srh_text = $('#txtSearch').val();
					data.brand = $('#brand').val();
					data.category_id = $('#category_id').val();
					data.it_stat = $('#it_stat').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
		$('#btn-clear').click(function () { //button filter event click
            $('#category_id').val('');
			 $('#item_category_name').val('');
			 table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });


    });

</script>  