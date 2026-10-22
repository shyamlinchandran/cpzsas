<style type="text/css">
    .form-inline .form-control {
    display: inline-block;
    width: 150px;
    vertical-align: middle;
} 
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1> 
</section> 
<section class="content"> 
   <!-- <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-bar-chart"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Appointments</span>
                        <span class="info-box-number"><?php echo $appointments; ?></span>
                    </div>
    
                </div>
    
            </div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-grain"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Approved</span>
                        <span class="info-box-number"><?php echo $approvals; ?></span>
                    </div>
    
                </div>
    
            </div>
    
            <div class="clearfix visible-sm-block"></div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-list-alt"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Checked</span>
                        <span class="info-box-number"><?php echo $checkedp; ?></span>
                        
                    </div>
    
                </div>
    
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-list"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Completed</span>
                        <span class="info-box-number"><?php echo $paidp; ?></span>
                        
                    </div>
    
                </div>
            </div>
    
            
        </div>   -->
     <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="<?=$this->box_color?>">

                <div class="box-header bg-aqua">
                    <h3 class="box-title">Booked</h3>
                    <span class="pull-right">
                       
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="bktable"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Booking ID</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="<?=$this->box_color?>">

                <div class="box-header  bg-red">
                    <h3 class="box-title">Approved</h3>
                    <span class="pull-right">
                         
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="aptable"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Booking ID</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="<?=$this->box_color?>">

                <div class="box-header bg-yellow">
                    <h3 class="box-title">Checked</h3>
                    <span class="pull-right">
                       
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="chktable"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Booking ID</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="<?=$this->box_color?>">

                <div class="box-header bg-green">
                    <h3 class="box-title">Completed</h3>
                    <span class="pull-right">
                         
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="cotable"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Booking ID</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
</section>

   <script type="text/javascript">

    var table;
    var id = 0;
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#bktable').DataTable({
            "scrollY":  "200px",
            "scrollCollapse": true,
            "paging": false,
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/clinic_list/Pending') ?>",
                "type": "POST",
                "data": function (data) {
                    //data.toid = $('#toid').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        table = $('#aptable').DataTable({
            "scrollY":  "200px",
            "scrollCollapse": true,
            "paging": false,
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/clinic_list/Approve') ?>",
                "type": "POST",
                "data": function (data) {
                    //data.toid = $('#toid').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        table = $('#chktable').DataTable({
            "scrollY":  "200px",
            "scrollCollapse": true,
            "paging": false,
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/clinic_list/Checked') ?>",
                "type": "POST",
                "data": function (data) {
                    //data.toid = $('#toid').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        table = $('#cotable').DataTable({
            "scrollY":  "200px",
            "scrollCollapse": true,
            "paging": false,
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/clinic_list/Payed') ?>",
                "type": "POST",
                "data": function (data) {
                    //data.toid = $('#toid').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

    }
    $(document).ready(function () {
        ms();

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
    </script>