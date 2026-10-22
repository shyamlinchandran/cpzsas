



<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">

                <div class="box-header">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $titles)) ?></h3>
                    <span class="pull-right">
                        <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('education/qualifications/Qualifications/create'); ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </span>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">


                    <div class="table-responsive">
                        <table id="table" class="table <?= $this->table_color ?> " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= label('No', $this, $user) ?></th>
                                    <th><?= label('Qualification', $this, $user) ?></th>
                                    <th><?= label('Details', $this, $user) ?></th>
                                    <th><?= label('Actions', $this, $user) ?></th>


                                </tr>
                            </thead>
                            <tbody>
                            </tbody>


                        </table>
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



    //datatables
    table = $('#table').DataTable({
        "language": lan,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        //"scrollX": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "fnDrawCallback": function() {
            loadpermission();
        },
        'buttons': [],
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('education/qualifications/Qualifications/ajax_list') ?>",
            "type": "POST",
            "data": function(data) {
                // data.country = $('#country').val();

                // data.supid = $('#supid').val();
                // data.btype = $('#btype').val();
            }
        },
        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false //set not orderable
        }]

    });
    loadpermission();
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(null, false); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(null, false); //just reload table

    });
</script>