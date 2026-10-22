<?php
$com_tax_type = $settings[0]['com_tax_type'];
if($ledgbal<0)
{
    $ledgbal = $ledgbal*-1;
}
?>
<input type="hidden" value="<?= $id ?>" name="id" id="id" />
<input type="hidden" value="<?= $com_tax_type ?>" name="tax_type" id="tax_type" />  
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/images/Blank_Club_Website_Avatar_Gray.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center" id="name"></h3>
                    <p id="custname" class="text-muted text-center"></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Email</b> <a id="email" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a id="phone" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b class="tax_id">GSTIN</b> <a id="tin" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>State</b> <a id="gst" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>State Code</b> <a id="cst" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b> <a id="address_line1" class="pull-right"></a>
                            <br><br><br>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo site_url('customers/edit/') . $id ?>" title="Edit" data-toggle="tooltip" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit</a>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-map-marker margin-r-5"></i>
                            <b>Total Sales</b> <a id="sales" class="pull-right">
                                <span class="label label-success"><?php echo $sales; ?></span></a>
                        </li>
						<li class="list-group-item">
                            <i class="fa fa-map-marker margin-r-5"></i>
                            <b>Total Sales Amount</b> <a id="sales" class="pull-right">
                                <span class="label label-success"><?php echo $totalsalesamount; ?></span></a>
                        </li>
						
                        <li class="list-group-item">
                            <i class="fa fa-map-marker margin-r-5"></i>
                            <b>Total Sales Orders</b> <a id="sales" class="pull-right">
                                <span class="label label-success"><?php echo $estimate; ?></span></a>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-map-marker margin-r-5"></i>
                            <b>Total Sales Return</b> <a id="sales" class="pull-right">
                                <span class="label label-success"><?php echo $salesreturn; ?></span></a>
                        </li>
                        <li class="list-group-item">
                            <b>Vouchers</b> <a id="vouchers" class="pull-right">
                                <span class="label label-info"><?php echo $vouchers; ?></span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Ledger balance</b> <a id="vouchers" class="pull-right">
                                <span class="label label-success"><?php echo $ledgbal; ?></span>
                            </a>
                        </li>
                    </ul>
                    <!--  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <!-- <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
              </div> -->
            <!-- /.box-header -->
            <!-- <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div> -->
            <!-- /.box-body -->
            <!--  </div> -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title suppname">Customer Profile</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('customers/listall/' . $type); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('customers/listall/' . $type); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#voucherstab" data-toggle="tab">Receipt</a></li>
                        <li><a href="#joutab" data-toggle="tab">Journal</a></li>
                        <li><a href="#paytab" data-toggle="tab">Payments</a></li>
                        <li><a href="#salestab" data-toggle="tab">Sales</a></li>
                        <li><a href="#estimate" data-toggle="tab">Sales Orders</a></li>
                        <li><a href="#sreturn" data-toggle="tab">Sales Returns</a></li>
                        <li><a href="#settings" data-toggle="tab">Ledger Report</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="voucherstab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title"><?php echo $vtype ?>Receipt Vouchers</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="vtable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Voucher No</th>
                                                <th>Date</th>
                                                <th>Ledgers</th>
                                                <th>Credit</th>
                                                <th>Debit</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
						<div class=" tab-pane" id="joutab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title"><?php echo $vtype ?>Journal Vouchers</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="joutable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Voucher No</th>
                                                <th>Date</th>
                                                <th>Ledgers</th>
                                                <th>Credit</th>
                                                <th>Debit</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
						<div class=" tab-pane" id="paytab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title"><?php echo $vtype ?>Payment Vouchers</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="paytable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Voucher No</th>
                                                <th>Date</th>
                                                <th>Ledgers</th>
                                                <th>Credit</th>
                                                <th>Debit</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="salestab">
                            <!-- Post -->

                            <style>
                                .box-title {
                                    text-transform: capitalize;
                                }
                            </style>
                            <section class="content"> 
			

                                <!-- /.box-header -->
								<div class="box-header">
                                   <h3 class="box-title"><?php echo $vtype ?> Sales</h3> 
                                </div>
                                <div class="box-body">
                                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice No</th>
                                                <th>Invoice Date</th>
                                                <th>Customers</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->

                                <!-- /.row -->
                            </section>



                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="estimate">
                            <!-- Post -->

                            <style>
                                .box-title {
                                    text-transform: capitalize;
                                }
                            </style>
                            <section class="content"> 


                                <!-- /.box-header -->
								<div class="box-header">
                                   <h3 class="box-title"><?php echo $vtype ?> Sales Order</h3> 
                                </div>
                                <div class="box-body">
                                    <table id="etable"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice No</th>
                                                <th>Invoice Date</th>
                                                <th>Customers</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->

                                <!-- /.row -->
                            </section>


                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="sreturn">
                            <!-- Post -->
                            <section class="content"> 


                                <!-- /.box-header -->
								<div class="box-header">
                                   <h3 class="box-title"><?php echo $vtype ?> Sales Return</h3> 
                                </div>
                                <div class="box-body">
                                    <table id="srtable"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice No</th>
                                                <th>Invoice Date</th>
                                                <th>Customers</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->

                                <!-- /.row -->
                            </section>


                        </div>

                        <div class="tab-pane" id="settings">
                            <section class="content"> 
                                <div class="box-header">
                                    <h3 class="box-title">Ledger</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>

                                                <td class="col-sm-2">
                                                    Start Date
                                                    <input type="text" class="form-control date" id="startdate"/>
                                                </td>
                                                <td class="col-sm-2">
                                                    End Date 
                                                    <input type="text" class="form-control date" id="enddate"/>
                                                    <input type="hidden" value= "<?= $toid ?>" class="form-control" id="toid"/>  
                                                </td>
                                                <td>
                                                    <br/>
                                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                     
                                    <br/>
                                    <table id="ltable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th> 
                                                <th>Voucher Type</th> 
                                                <th>Voucher Number</th> 
                                                <th>Particulars</th> 
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div> 
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->


</div>
<!-- /.col -->

</div>
<!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
</div>
<script type="text/javascript">

    var table;

    $(document).ready(function () {
        //datatables
        load();
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
        });
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customer/sales/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.stype = 'sales';
                    data.supid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        loadpermission();
        $('#btn-filter').click(function () { //button filter event click
            ms();
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table

        });
        table = $('#etable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customer/sales/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.stype = 'estimate';
                    data.supid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        table = $('#srtable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customer/sales/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.stype = 'sales_return';
                    data.supid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        table = $('#vtable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customer/vouchers/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = '<?php echo $vtype ?>';
                    data.supid = $('#id').val();
					data.vourcher_type = 'receipt';
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		table = $('#paytable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customer/vouchers/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = '<?php echo $vtype ?>';
                    data.supid = $('#id').val();
					data.vourcher_type = 'payment';
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		table = $('#joutable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customer/vouchers/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = '<?php echo $vtype ?>';
                    data.supid = $('#id').val();
					data.vourcher_type = 'journal';
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        var id = 0;
        function ms()
        {
            if (id === 1) {
                table.destroy();
            }
            id = 1;
            table = $('#ltable').DataTable({
                //"scrollY":  "200px",
                //"scrollCollapse": true,
                //"paging": false,
                 "language": lan,"processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "bPaginate": false,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                'buttons': [],
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('reports/accounts/ajax_list') ?>",
                    "type": "POST",
                    "data": function (data) {
                        data.startdate = $('#startdate').val();
                        data.enddate = $('#enddate').val();
                        data.toid = $('#toid').val();
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
    });

    function load() {
        var id = $("#id").val();
        var taxtype = $("#tax_type").val();
        if (taxtype === "GST")
        {
            $(".tax_id").html("GSTIN");
        } else
        {
            $(".tax_id").html("Tax ID");
        }
        //alert(id);
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('customers/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $('#custname').html(result.name);
                    $('.suppname').html(result.name +" (Sundry Debtor)");
                    $("#email").html(result.email);
                    $("#phone").html(result.phone);
                    $("#tin").html(result.tin);
                    $("#cst").html(result.gst);
                    $("#gst").html(result.StateName);
                    $("#remarks").html(result.details);
                    $("#address_line1").html(result.address_line1);
                    $("#address_line2").val(result.address_line1);
                    $("#credit").val(result.credit_period);
                }
            });
        }
    }
</script> 
