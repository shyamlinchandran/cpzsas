<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">
                <div class="box-body table-responsive">
                    <div class="row" style="height: 75vh;">
                        <div class="col-md-4">

                            <table id="table" class="display table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th><?= label('Invoice No', $this, $user) ?></th>
                                        <th><?= label('Invoice Date', $this, $user) ?></th>
                                        <th><?= label('Customers', $this, $user) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>


                            </table>
                        </div>
                        <div class="col-md-8">
                            <iframe id="ifrm" src="<?php echo  base_url() . 'transaction/sales/bill/' . $id . '/' . $size;  ?>" style="width:100%;  height:75vh;" frameborder="0"></iframe>

                        </div>

                    </div>

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
    function view(id) {
        document.getElementById('ifrm').src = "<?php echo  base_url() . 'transaction/sales/bill/'  ?>" + id + "<?php echo '/' . $size;  ?>";
    }

    var table;
    $(document).ready(function() {
        table = $('#table').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,

            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'dimssearch col-sm-7'><'col-sm-2  text-right'  ><'col-sm-3 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12'p>>",
            "fnDrawCallback": function() {
                loadpermission();
            },
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('transaction/sales/ajax_list_view') ?>",
                "type": "POST",
                "data": function(data) {
                    // // data.country = $('#country').val();
                    data.type = '<?php echo $type ?>';
                    // data.supid = $('#supid').val();
                    // data.btype = $('#btype').val();
                    // data.status = $('#order_tatus').val();
                    // data.startdate = $('#startdate').val();
                    // data.enddate = $('#enddate').val();
                }
            }

        });
    });
</script>