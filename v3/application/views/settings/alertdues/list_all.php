<?php
$add_url = site_url('settings/AlertDues/create');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">

                <div class="box-header">
                    <h3 class="box-title">Alert &amp; Dues Notification</h3>
                    <span class="pull-right">
                        <a role="button" class="btn btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="alertDuesTabs" role="tablist">
                        <li class="active">
                            <a href="#tab-alert" data-toggle="tab" id="tab-alert-link">
                                <i class="glyphicon glyphicon-bell"></i> Alert
                            </a>
                        </li>
                        <li>
                            <a href="#tab-dues" data-toggle="tab" id="tab-dues-link">
                                <i class="glyphicon glyphicon-credit-card"></i> Dues
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" style="padding-top:15px;">

                        <!-- Alert Tab -->
                        <div class="tab-pane active" id="tab-alert">
                            <table id="table-alert" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                        <th>Time Out</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <!-- Dues Tab -->
                        <div class="tab-pane" id="tab-dues">
                            <table id="table-dues" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                        <th>Time Out</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<script type="text/javascript">
    var tableAlert, tableDues;

    function buildDataTable(tableId, typeFilter) {
        return $('#' + tableId).DataTable({
            "language": lan,
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2 text-right'B><'col-sm-4 pull-right'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [{
                extend: 'excel',
                text: '<span class="glyphicon glyphicon-download"></span>',
                className: 'btn btn-circle btn-primary',
                title: 'Alert & Dues Report'
            }],
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('settings/AlertDues/ajax_list') ?>",
                "type": "POST",
                "data": function (d) {
                    d.type = typeFilter;
                }
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }]
        });
    }

    $(document).ready(function () {
        // Build both DataTables on page load
        tableAlert = buildDataTable('table-alert', 'alert');
        tableDues  = buildDataTable('table-dues', 'dues');

        // Adjust columns when tab becomes visible (avoids header misalignment)
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
            if (target === '#tab-alert') {
                tableAlert.columns.adjust().draw(false);
            } else if (target === '#tab-dues') {
                tableDues.columns.adjust().draw(false);
            }
        });
    });

    function deleteRecord(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: "<?php echo site_url('settings/AlertDues/delete') ?>/" + id,
                success: function (result) {
                    var response = JSON.parse(result);
                    alert(response.message);
                    tableAlert.ajax.reload(null, false);
                    tableDues.ajax.reload(null, false);
                }
            });
        }
    }
</script>
</body>
</html>
