
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
                    <h3 class="box-title"><?= label('Damage Stock', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('master\items\list_all'); ?>"  href="<?php echo site_url('master\Itemdamage\itemdamage'); ?>" class="btn  btn-success align-bottom" >
                            <span class="glyphicon glyphicon-plus" href="<?php echo site_url('master\items\itemtransfer'); ?>"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">

                    <table id="table"  class="table <?=$this->table_color?> " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('Invoice', $this, $user) ?></th>
                                <th><?= label('Item', $this, $user) ?></th>  
                                <th><?= label('Quantity', $this, $user) ?></th> 
                                <th><?= label('Actions', $this, $user) ?></th>
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
               
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('master/Itemdamage/ajax_list') ?>",
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