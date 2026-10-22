<?php
$add_url = site_url('hr/employee/create');
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
                    <h3 class="box-title">Employee</h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('hr/employee/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
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
                    <table   class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <?= label('Filter By', $this, $user) ?>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">----------Select--------</option>
                                        <option value="iqama_end_date">Iqama expiry Date</option>
                                        <option value="pass_end_date">Passport expiry Date</option>
                                        <option value="licence_end_date">Licence expiry Date</option>
                                        <option value="insurence_end_date">Insurene expiry Date</option>
                                    </select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Start Date', $this, $user) ?>
                                    <input type="text" class="form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('End Date', $this, $user) ?> 
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                                <td class="col-sm-2">

                                </td>
                                <td>

                                </td>

                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('First Name', $this, $user) ?></th>
                                <th><?= label('Iqama status', $this, $user) ?></th>
                                <th><?= label('Licence status', $this, $user) ?></th>
                                <th><?= label('Insurence status', $this, $user) ?></th>
                                <th><?= label('Mobile', $this, $user) ?></th>
                                <th><?= label('Iqama Number', $this, $user) ?></th>
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

        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('hr/EmployeeReport/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate= $('#startdate').val();
                    data.enddate =  $('#enddate').val();
                    data.type = $('#type').val();
                }
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


