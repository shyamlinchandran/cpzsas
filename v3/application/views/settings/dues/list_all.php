<?php
$add_url = site_url('settings/AlertDues/dues_create');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list"></i> Dues Report</h3>
                </div>
                <div class="box-body">
                    <!-- Filters Row -->
                    <div class="row" style="margin-bottom: 20px; background: #f9f9f9; padding: 15px; border-radius: 5px; margin-left: 0; margin-right: 0;">
                        <form id="filterForm">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $start_date; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $end_date; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button type="button" id="btnFilter" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                        </form>
                    </div>

                    <table id="table_report" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr style="background: #3c8dbc; color: #fff;">
                                <th>No</th>
                                <th>Ledger Name</th>
                                <th>Voucher No</th>
                                <th>Voucher Type</th>
                                <th>Remarks</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <!-- <th width="100">Action</th> -->
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var table_report;
    $(document).ready(function () {
        table_report = $('#table_report').DataTable({
            "processing": true,
            "serverSide": false, // Using simple AJAX result for better filtering experience
            "scrollX": true,
            "dom": 'Bfrtip',
            "buttons": ['excel', 'pdf', 'print'],
            "ajax": {
                "url": "<?php echo site_url('settings/AlertDues/ajax_dues_report') ?>",
                "type": "POST",
                "data": function(data) {
                    data.start_date = $('#start_date').val();
                    data.end_date = $('#end_date').val();
                }
            },
            "order": [[5, 'asc']], // Order by due date (index 5)
            "columnDefs": [{"targets": [0], "orderable": false}]
        });

        $('#btnFilter').on('click', function() {
            table_report.ajax.reload();
        });
    });
</script>
</body>
</html>
