<?php
$add_url = site_url('dims_main/Main/createService');
?>
<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= label('Email Type', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('dims_main/Main/listAllService'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </span>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= label('S.No', $this, $user) ?></th>
                                    <th><?= label('Service', $this, $user) ?></th>
                                    <th><?= label('Action', $this, $user) ?></th>
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
        </div>
    </section>


<script>
    table = $('#table').DataTable({
        "language": lan,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "scrollX": true,
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        'buttons': [],
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('dims_main/Main/service_list') ?>",
            "type": "POST",
            "data": function() {

            }
        },
        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false //set not orderable
        }]
    });
</script>