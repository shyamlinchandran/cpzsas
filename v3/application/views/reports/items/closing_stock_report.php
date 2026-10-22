<?php
$user = $this->session->userdata('user');
?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                    <input type="hidden" id="report_header" value="<?php echo $title;?>"/>
                    <input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-3">
                                    <?= label('Start Date', $this, $user) ?>  
                                    <input type="text" class="form-control date" id="startdate" value="<?php echo date('01-m-Y'); ?>"/> 
                                </td>
                                <td class="col-sm-3">
                                    <?= label('End Date', $this, $user) ?>  
                                    <input type="text" class="form-control date" id="enddate" value="<?php echo date('d-m-Y'); ?>"/> 
                                </td>
                                <td class="col-sm-3">
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter" value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Item', $this, $user) ?></th>
                                <th><?= label('Barcode', $this, $user) ?></th>
                                <!-- <th><?= label('open stock', $this, $user) ?></th> -->
                                <!-- <th><?= label('open stock rate', $this, $user) ?></th> -->
                                <!-- <th><?= label('opening stock value', $this, $user) ?></th> -->
                                <th><?= label('Running Stock', $this, $user) ?></th>
                                <th><?= label('Running Stock Rate', $this, $user) ?></th>
                                <!-- <th><?= label('Running Stock Value', $this, $user) ?></th> -->
                                <th><?= label('closing Stockvalue', $this, $user) ?></th>
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
    var isInitialized = false;

    function initDataTable() {
        if (isInitialized) {
            table.destroy();
        }
        isInitialized = true;
        table = $('#table').DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [], 
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-3 text-right'B><'col-sm-3 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'print',
                    text: '<i class="glyphicon glyphicon-print"></i> Print',
                    className: 'btn btn-primary', 
                    title: 'Closing Stock Report',
                    footer: true,
                    customize: function(win) {
                        $(win.document.body).css('font-size', '10pt !important');
                        $(win.document.body).css('margin', '13px');
                        $(win.document.body).find('table').addClass('display').css('font-size', '13px');
                        $(win.document.body).find('table').next("div").html("<hr /><br/><div class='col-12 text-right'>Printed Date : <?php echo date("d-m-Y") ?></div>");
                    }
                },
                {
                    extend: 'excel',
                    action: newexportaction,
                    text: '<i class="glyphicon glyphicon-download"></i> Excel',
                    className: 'btn btn-success',
                    title: 'Closing Stock Report',
                    footer: true,
                    exportOptions: {
                        columns:':visible'
                    }
                },
                {
                    extend: 'pdf',
                    action: newexportaction,
                    text: '<i class="glyphicon glyphicon-cloud-download"></i> PDF',
                    className: 'btn btn-danger',
                    title: 'Closing Stock Report',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    action: newexportaction,
                    text: '<i class="glyphicon glyphicon-download-alt"></i> CSV',
                    className: 'btn btn-warning',
                    title: 'Closing Stock Report',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
            "ajax": {
                "url": "<?php echo site_url('reports/Closing_stock_report/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                }
            },
            "columnDefs": [{
               
            }]
        });
    }

    $(document).ready(function () {
        initDataTable();

        $('#btn-filter').click(function () {
            initDataTable();
        });
    });
</script>
