<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label('Login Logs', $this, $user) ?></h3>
                    <span class="pull-right">
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tr>
                            <td colspan="2"><?= label('Select User', $this, $user) ?></td>
                                 <td colspan="2"> 
                                    <select id="user"  class="form-control" name="user">
                                    <option value="0"><?= label('all', $this, $user) ?></option> 
                                        <?php foreach ($users as $sing){?>
                                            <option value="<?php echo $sing['Id']; ?>" > <?php echo $sing['user_name']; ?>   </option>
                                        <?php } ?> 
                                    </select>
                                </td>
                            <td colspan="2">
                                <select id="chrq_status"  class="form-control" name="chrq_status">
                                    <option value="1"><?= label('Online', $this, $user) ?></option>
                                    <option value="0"><?= label('Offline', $this, $user) ?></option>
                                </select>      
                            </td>
                             <td>
                                  <input type="submit" class="btn btn-success" id="btn-filter"  value="Search" name="searchbtn" />
                                </td>
                        </tr>
                    </table>

                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('User', $this, $user) ?></th>
                                <th><?= label('IP Address', $this, $user) ?></th>
                                <th><?= label('Status', $this, $user) ?></th>
                                <th><?= label('Login Time', $this, $user) ?></th>
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
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
                {
                    extend: 'excel',
                    text: '<span class="glyphicon glyphicon-download"></span>',
                    className: 'btn btn-circle btn-primary',
                    title: 'Dims Reports'
                }
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('settings/loginsett/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.type = $("#chrq_status").val();
                    data.user = $('#user').val();
                    data.searchbtn = $('#searchbtn').val();
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