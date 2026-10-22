<?php
$add_url = site_url('hr/SalaryDistribution/list_all');
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
                    <h3 class="box-title">Salary Distribution</h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('hr/SalaryDistribution/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-arrow-left"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <style>
                        .table{
                            margin-bottom: 0px !important;
                        }
                    </style>
                    <input type="hidden" id="distribution_id" name="distribution_id" value="<?php echo $id ?>">
                   
                    <table id="table"  class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Employee', $this, $user) ?></th>
                                <th><?= label('Leaves', $this, $user) ?></th>
                                <th><?= label('Extra Leaves', $this, $user) ?></th>
                                <?php foreach ($components as $item) { ?>
                                    <th><?= label($item['pay_name'], $this, $user) ?></th>
                                <?php } ?>
                                <th><?= label('Total', $this, $user) ?></th>
                                <th><?= label('Leave Deduction', $this, $user) ?></th>
                                <th><?= label('Salary', $this, $user) ?></th>
                                <th><?= label('Paid', $this, $user) ?></th>
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
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    $(document).ready(function () {

        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [[-1], ['All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
            ],
            "buttons": [
                {extend: 'excel', exportOptions: {format: {
                            body: function (data, row, column, node) {
//
//check if type is input using jquery
                                return $(data).is("input") ?
                                        $(data).val() :
                                        data;
                            }
                        }
                    }}
               
            ],

            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('hr/SalaryDistribution/distribution_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.distribution_id = $('#distribution_id').val();
                }
            },
            "initComplete": function (settings, json) {
                var distribution_id = $('#distribution_id').val();
                $.ajax({
                    url: "<?php echo site_url('hr/SalaryDistribution/getsing/'); ?>" + distribution_id,
                    async: false,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
//                            $('#leaves' + itemsingle.emp_id).val(itemsingle.leave_days);
//                            $('#leaves' + itemsingle.emp_id).attr("value", itemsingle.leave_days);
//                            $('#emp_' + itemsingle.emp_id + '_' + itemsingle.component_id).val(itemsingle.amount);
//                            $('#ext_leave' + itemsingle.emp_id).val(itemsingle.extra_leaves);
//                            $('#year').val(itemsingle.year);
//                            $('#month').val(itemsingle.month);
//                            $('#employee_paying' + itemsingle.emp_id).attr('max', itemsingle.balance);
//                            $('#paid' + itemsingle.emp_id).val(itemsingle.employee_paid);
//                            $('#emp_salary' + itemsingle.emp_id).val(itemsingle.emp_salary);
//                            alert(itemsingle.emp_salary);
//                            $('#employee_paying' + itemsingle.emp_id).val(itemsingle.balance);

                        });
                        // calculateGtotal();
                    }
                });
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

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
