<?php
$add_url = site_url('kaasma/enquiry/create/');
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
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('kaasma/enquiry/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table   class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                               <td class="col-sm-2">
                                    Status
                                <select name="enq_status" id="enq_status" class="form-control" >
                                    <option value="">All</option>
                                    <?php foreach ($enq_status as $type) { ?>
                                        <option value="<?php echo $type['est_id']; ?>"><?php echo $type['est_name']; ?></option>
                                    <?php } ?>
                                </select></div>    
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
                                <th>SNo</th>
                                <th>Enquiry No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Actions</th>
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
            "scrollX": false,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
                "url": "<?php echo site_url('kaasma/enquiry/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.type = $("#enq_status").val();
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