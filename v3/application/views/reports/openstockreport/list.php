<section class="content">
    <style>
        .right-aligned-cell {
            text-align: right;
        }
        .center-aligned-cell {
            text-align: center;
        }
        h5 {
            width: 100%;
            text-align: right;
            padding: 0px;
            margin: 0px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <input type="hidden" value="<?php echo $this->session->userdata('login_comid'); ?>" id="login_comid"/>
                <div class="box-header">
                    <h3 class="box-title"><?= label('Opening Stock Report', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <form id="frmId">
                    <div class="box-body table-responsive">
                        <table class="table table-condensed table-stripped" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td class="col-sm-3">
                                        <?= label('As On Date', $this, $user) ?>
                                        <input type="text" class="form-control date" id="date" value="<?php echo date('d/m/Y'); ?>"/>
                                    </td>
                                    <td class="col-sm-3">
                                        <br/>
                                        <input type="button" class="btn btn-success" id="btn-filter" value="Search"/>
                                        <input type="button" class="btn btn-default" id="btn-reset" value="Reset"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 

                        <div class="row" style="background: #4678d5; padding: 10px; color: #fff; margin-bottom: 15px;">
                            <div class="col-md-6">
                                <h5><?= label('Total Opening Stock Qty', $this, $user) ?>: <span id="tot_qty">0.00</span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><?= label('Total Opening Balance Amount', $this, $user) ?>: <span id="tot_val">0.00</span></h5>
                            </div>
                        </div>

                        <table id="table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="center-aligned-cell" style="width: 5%;"><?= label('Sl No', $this, $user) ?></th> 
                                    <th class="center-aligned-cell" style="width: 15%;"><?= label('Barcode', $this, $user) ?></th> 
                                    <th style="width: 30%;"><?= label('Name', $this, $user) ?></th> 
                                    <th style="width: 15%;"><?= label('Godown', $this, $user) ?></th> 
                                    <th class="right-aligned-cell" style="width: 10%;"><?= label('Opening Stock', $this, $user) ?></th>
                                    <th class="right-aligned-cell" style="width: 10%;"><?= label('Opening Stock Rate', $this, $user) ?></th>
                                    <th class="right-aligned-cell" style="width: 15%;"><?= label('Opening Balance', $this, $user) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr style="font-weight: bold; background-color: #f4f4f4;">
                                    <th colspan="4" class="right-aligned-cell"><?= label('Total', $this, $user) ?>:</th>
                                    <th class="right-aligned-cell" id="foot_qty">0.00</th>
                                    <th></th>
                                    <th class="right-aligned-cell" id="foot_val">0.00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<?php $login_comid = $this->session->userdata('login_comid'); ?>
<script type="text/javascript">
    var table;
    var is_init = 0;

    function load_report() {
        if (is_init === 1) {
            table.destroy();
        }
        is_init = 1;

        table = $('#table').DataTable({
            "scrollCollapse": true,
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "bPaginate": true,
            "autoWidth": false,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-right'B><'col-sm-4 pull-right'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'print',
                    text: '<i class="glyphicon glyphicon-print"></i> Print',
                    className: 'btn btn-primary'
                }
            ],
            "ajax": {
                "url": "<?php echo site_url('reports/OpenStockReport/ajax_list') ?>",
                "type": "POST",
                "data": function (d) {
                    d.date = $('#date').val();
                },
                "dataSrc": function (json) {
                    $('#tot_qty').html(json.total_qty);
                    $('#tot_val').html(json.total_val);
                    $('#foot_qty').html(json.total_qty);
                    $('#foot_val').html(json.total_val);
                    return json.data;
                }
            },
            "columnDefs": [
                { targets: [0], className: "center-aligned-cell" },
                { targets: [1], className: "center-aligned-cell" },
                { targets: [4, 5, 6], className: "right-aligned-cell" }
            ]
        });
    }

    $(document).ready(function () {
        // Read Cookie on load
        var cookie_name = '<?php echo $login_comid ?>openstockreport_cook';
        var result = readCookie(cookie_name);

        if (result != null) {
            try {
                var results = JSON.parse(result);
                $.each(results, function (index, value) {
                    if (value.date) {
                        $('#date').val(value.date);
                    }
                });
            } catch (e) {
                console.log(e);
            }
        }

        // Initialize DataTable
        load_report();

        // Save Cookie & reload report on Filter click
        $('#btn-filter').click(function () {
            var arr = [];
            var filter_date = $('#date').val();
            arr.push({
                date: filter_date
            });
            createCookie(cookie_name, JSON.stringify(arr), 3);
            load_report();
        });

        // Save Cookie on date change
        $('#date').change(function () {
            var arr = [];
            var filter_date = $('#date').val();
            arr.push({
                date: filter_date
            });
            createCookie(cookie_name, JSON.stringify(arr), 3);
        });

        // Reset button event
        $('#btn-reset').click(function () {
            $('#date').val('<?php echo date("d/m/Y"); ?>');
            var arr = [{ date: $('#date').val() }];
            createCookie(cookie_name, JSON.stringify(arr), 3);
            load_report();
        });
    });
</script>
