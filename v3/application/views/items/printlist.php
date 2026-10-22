<?php
$add_url = site_url('item/listall');
$type = 'item';
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
                <input type="hidden" value="<?php echo $units; ?>" id="unit" name="unit"/> 
                <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 
                <div class="box-header">
                    <h3 class="box-title"> <?= label('Barcode Master', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('item\listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-arrow-left"></span> <!--tp="popup" -->
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Product Name', $this, $user) ?></th>
                                <th><?= label('Units', $this, $user) ?></th>
                                <th> <?= label('Count', $this, $user) ?></th>
                                <th><?= label('Rate', $this, $user) ?></th>
                                <th><?= label('Barcode', $this, $user) ?></th>
                                <th><?= label('Actions', $this, $user) ?></th>
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
        material_types();
        item_category();
        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            //"<'row'<'col-sm-6'><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
            'dom': "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5 align-middle'li><'col-sm-7'p>>",

            "order": [], //Initial no order.
            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('item/barcode_list') ?>",
                "async": "false",
                "type": "POST",
                "data": function (data) {
                    data.unit = $('#unit').val();
                    data.id = $('#id').val();

                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-Search').click(function () {
            table.search(value).draw();
        });
        $('#btn-Clear').click(function () {
            table.search(value).draw();
        });

        $('.dataTables_filter input').unbind().keyup(function () {


        });
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });
    });



</script>  