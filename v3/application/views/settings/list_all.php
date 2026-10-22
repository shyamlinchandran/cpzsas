<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $add_url = site_url('settings/MenuToCompany/add'); ?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Menu To Company</h3>
                    <span class="pull-right">
                        <a role="button" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!--                    <form id="form-filter">
                                            <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td class="col-sm-2 text-center">
                                                            <br/>
                                                            <a role="button" class="btn btn-default align-bottom" href="<?php echo $add_url ?>">
                                                                <span class="glyphicon glyphicon-plus"></span> 
                                                            </a>
                                                        </td>
                                                        <td class="col-sm-2" align="center">
                                                            Invoice
                                                            <input type="text" class="form-control" id="invoice"/>
                                                        </td>
                                                        <td class="col-sm-2">
                                                            Supplier
                                                            <input type="text" class="form-control" id="supname"/>
                                                            <input type="hidden" class="form-control" id="supid"/> 
                                                        </td>
                    
                                                        <td>
                                                            <br/>
                                                            <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                                        </td>
                                                        <td>
                                                            <br/>
                                                            <input type="button" class="btn btn-success" id="btn-reset"  value="Reset"/>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>   
                                        </form>-->

                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company</th>
                                <th>Actions</th>
                                

                                
                                
                                
     <!--                                <th>Eligibility</th>-->
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
                "url": "<?php echo site_url('settings/MenuToCompany/ajax_list') ?>",
                "type": "POST",
                "data": function (data) { 
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
</body>
</html>