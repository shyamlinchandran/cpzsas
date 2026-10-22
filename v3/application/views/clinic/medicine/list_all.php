<?php
$add_url = site_url('clinic/medicine/add');
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
                    <h3 class="box-title">Medicine</h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('clinic/medicine/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
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
                                    Body Part
                                    <select  data-validation="required" id="bodypart"  name="bodypart" class="form-control" >
                                    <option value="">Select</option> 
                                     </select>
                                </td>

                                <td class="col-sm-2">
                                 <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                                </td>

                                <td class="col-sm-2">
                               
                                </td>

                                <td class="col-sm-2">
                                    
                                </td>
                          
                            </tr>
                        </tbody>
                    </table>          

                    <table id="table"  class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Medicine</th>
                                <th>Book Name</th>
                                <th>Body Part</th>
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
    $.ajax({
        url: "<?php echo site_url('ajaxcall/bodypart'); ?>",
        success: function (result) {
            $('#bodypart').html(result);
        }
    });

    $(document).ready(function () {

        //datatables
        table = $('#table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
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
                "url": "<?php echo site_url('clinic/medicine/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                      data.bodypart = $('#bodypart').val();

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