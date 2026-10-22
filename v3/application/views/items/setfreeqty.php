<?php
$add_url = site_url('item/create');
$type = 'item';
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form action="<?php echo site_url('Itemedit/save_free') ?>" method="post">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title"><?= label('Set Free Quantity', $this, $user) ?></h3>
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
                        <form id="saveitems">
                            <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th> <?= label('SNo', $this, $user) ?></th>
                                        <th><?= label('Barcode', $this, $user) ?></th>
                                        <th><?= label('Item', $this, $user) ?></th>
                                        <th> <?= label('Free Quantity', $this, $user) ?></th>
                                        <th> <?= label('for', $this, $user) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
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

<script type="text/javascript">

    var table;

    $(document).ready(function () {
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
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
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
                "url": "<?php echo site_url('Itemedit/ajaxlist') ?>",
                "type": "POST",
                "data": function (data) {
                    data.material_type = $("#material_type").val();
					data.brand = $("#brand").val();
					data.category_id = $("#category_id").val();
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