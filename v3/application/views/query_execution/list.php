<style>
    .box-title {
        text-transform: capitalize;
    }

    input.largerCheckbox {
        width: 20px;
        height: 20px;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">

                <div class="box-header">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $titles)) ?></h3>

                </div>
                <form class="frmexecute" id="frmexecute" name="frmexecute">

                    <div class="box-body table-responsive">

                        <?= label('Type Your Query', $this, $user) ?>

                        <textarea class="form-control" id="new_textarea" name="new_textarea" rows="5"></textarea>

                        <div class="box-body table-responsive">
                            <input type="button" class="btn btn-success" id="btn-filter"  name="btn-filter" value="<?= label('Execute', $this, $user) ?>" />
                        </div>
                    </div>

                    <div class="box-body table-responsive">

                        <div class="table-responsive">
                            <table id="table" class="table <?= $this->table_color ?> " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="largerCheckbox" name="checkBox2" id="checkAll" name="checkAll"></th>
                                        <th><?= label('Sl No', $this, $user) ?></th>
                                        <th><?= label('Name', $this, $user) ?></th>
                                        <th><?= label('Comkey', $this, $user) ?></th>
                                        <th><?= label('Database Name', $this, $user) ?></th>
                                        <th><?= label('Execute', $this, $user) ?></th>

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
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>

<script type="text/javascript">

    $(document).on('click', '#btn-filter', function() {
        var frm = '#frmexecute';
        var data = $(frm).serializeArray();
        $.ajax({
            url: "<?php echo site_url('query_execution/Query_execution/execute_query'); ?>",
            type: 'POST',
            data: data,
            success: function(result) {
                
            }
        });
    });


    $.validate({
        modules: 'date, security,file'
    });
    var table;
    var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

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
        "order": [],


        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('query_execution/Query_execution/ajax_list') ?>",
            "type": "POST",
            "data": function(data) {
                data.new_textarea = $("#new_textarea").val();
            }
        },

        "columnDefs": [{
            "autoWidth": true,
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable

            // "render": function(data, type, full, meta) {
            //     return ' &nbsp <input type="checkbox">';
            // }
        }]

    });

    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>