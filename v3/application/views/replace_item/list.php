<?php
$add_url = site_url('Replace_items/create');
$type = "replace";
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
                        <h3 class="box-title"><?= label('Replace Items', $this, $user) ?></h3>
						 <span class="pull-right">
                        <a role="button" back="<?php echo site_url('Replace_items\list'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       
                        <br/> 
							<table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th> <?= label('SNo', $this, $user) ?></th>
                                        <th><?= label('Date', $this, $user) ?></th>
                                        <th><?= label('Voucher No', $this, $user) ?></th>
                                        <th><?= label('Customer', $this, $user) ?></th>
                                        <th><?= label('User', $this, $user) ?></th>
                                        <th> <?= label('Action', $this, $user) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>


                            </table>
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

    var table;

    $(document).ready(function () {
	
	
		
 
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 50, 100,-1], [10, 25, 50, 'All']],
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
                "url": "<?php echo site_url('Replace_items/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
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
    

</script>  