<?php
$add_url = site_url('settings/AlertDues/alert_create');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">
                <div class="box-header">
                    <h3 class="box-title">Alert Notifications</h3>
                    <span class="pull-right">
                        <a role="button" class="btn btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </span>
                </div>
                <div class="box-body">
                    <table id="table" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company</th>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Task From</th>
                                <th>Task To</th>
                                <th>Action</th>
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
    var table;
    $(document).ready(function() {
        table = $('#table').DataTable({
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
                title: 'Alert Report'
            }],
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('settings/AlertDues/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.type = 'alert';
                }
            },
            "columnDefs": [{"targets": [0, 7], "orderable": false}]
        });
    });

    function deleteRecord(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: "<?php echo site_url('settings/AlertDues/delete') ?>/" + id,
                success: function(result) {
                    var response = JSON.parse(result);
                    alert(response.message);
                    table.ajax.reload(null, false);
                }
            });
        }
    }
</script>
</body>
</html>
