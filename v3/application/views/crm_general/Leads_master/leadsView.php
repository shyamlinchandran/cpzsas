<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
<input type="hidden" value="" name="eid" id="eid" />
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img id="imgs" class="profile-user-img img-responsive img-circle" style="width : 100px;height : 100px" src="<?php echo base_url(); ?>assets/images/Blank_Club_Website_Avatar_Gray.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center" id="name"></h3>
                    <p id="custname" class="text-muted text-center"></p>

                    <ul class="list-group list-group-unbordered">

                        <a href="<?php echo site_url('education/Student/create/') . $id ?>" title="Edit" data-toggle="tooltip" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit</a>

                        <li class="list-group-item">
                            <br>
                            <b style="font-size:20px;color:midnightblue">Personal</b> <a class="pull-right"></a>
                            <br>
                        </li>
                        <li class="list-group-item">
                            <b>Company Name</b> <a id="company" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Name</b> <a id="namess" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a id="phone" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a id="email" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b> <a id="address_line1" class="pull-right"></a>
                            <br><br><br>
                        </li>
                        <li class="list-group-item">
                            <b>District</b> <a id="district" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>GST</b> <a id="gst" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Remarks</b> <a id="remarks" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <br>
                            <b style="font-size:20px;color:midnightblue">Lead Details</b> <a class="pull-right"></a>
                            <br>
                        </li>
                        <li class="list-group-item">
                            <b>Lead from </b> <a id="fromlead" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Created By</b> <a id="createdby" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Created On</b> <a id="createdon" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Created At</b> <a id="createdat" class="pull-right"></a>
                        </li>

                    </ul>

                    <!--  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title suppname">Customer Profile</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('crm_general/Leads_master/listall/' . $type); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('crm_general/Leads_master/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#voucherstab" data-toggle="tab">Time Line</a></li>
                        <li><a id="alloo" href="#sreturn" data-toggle="tab">Allocations</a></li>
                        <li><a id="folloo" href="#follow" data-toggle="tab">Followups</a></li>
                        <li><a href="#estimate" data-toggle="tab">Leads Products</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="voucherstab">
                            <!-- The timeline -->
                            <section class="content">
                                <div class="box-header">
                                    <!-- <h3 class="box-title"><?php echo $vtype ?> Vouchers</h3> -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <ul id="times" class="timeline">

                                    </ul>

                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>

                        <div class="tab-pane" id="bal">
                            <!-- Post -->

                            <style>
                                .box-title {
                                    text-transform: capitalize;
                                }
                            </style>
                            <section class="content">


                                <!-- /.box-header -->
                                <div class="box-body pull-left" style="width : 60%">
                                    <table id="bals" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <br>
                                            <tr>
                                                <td>
                                                    <h4>Fee</h4>
                                                </td>
                                                <td id="fee" class="text-left" style="padding-top:20px"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>Discount</h4>
                                                </td>
                                                <td id="discount" class="text-left" style="padding-top:20px"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4><b>Total</b></h4>
                                                </td>
                                                <td id="total" class="text-left" style="padding-top:20px;font-size:18px;font-weight:bold"></td>
                                            </tr>
                                        </thead>

                                    </table>


                                </div>

                                <div class="box-body pull-right" style="width : 40%">
                                    <table id="bals" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <br>
                                            <tr>
                                                <td>
                                                    <h4>Payed</h4>
                                                </td>
                                                <td id="payed" class="text-left" style="padding-top:20px"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4><b>Balance</b></h4>
                                                </td>
                                                <td id="balance" class="text-left" style="padding-top:20px;font-size:18px;font-weight:bold"></td>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                                <!-- /.box-body -->

                                <!-- /.row -->
                            </section>


                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="follow">
                            <!-- Post -->

                            <style>
                                .box-title {
                                    text-transform: capitalize;
                                }
                            </style>
                            <section class="content">


                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="futable" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Next Followup on</th>
                                                <th>Updated on</th>
                                                <th>remarks</th>
                                                <th>Files</th>
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
                                <div class="box-body">
                                    <table id="etable" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
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
                                <div class="box-body">
                                    <table id="srtable" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Allocated to</th>
                                                <th>Allocated date</th>
                                                <th>Delivery date</th>
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
                                    <!-- <h3 class="box-title">Ledger</h3> -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>

                                                <td class="col-sm-2">
                                                    Start Date
                                                    <input type="text" class="form-control date" id="startdate" />
                                                </td>
                                                <td class="col-sm-2">
                                                    End Date
                                                    <input type="text" class="form-control date" id="enddate" />
                                                    <input type="hidden" value="<?= $toid ?>" class="form-control" id="toid" />
                                                </td>
                                                <td>
                                                    <br />
                                                    <input type="button" class="btn btn-success" id="btn-filter" value="Search" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br />
                                    <table id="ltable" class="table table-bordered table-striped" cellspacing="0" width="100%">
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
    e_id = 0;
    

    $(document).ready(function() {

        //datatables
        var idss = $('#id').val();
        // 

        $.ajax({
            url: "<?php echo site_url('crm_general/Leads_master/getEnqId/'); ?>",
            async:false,
            type: 'POST',
            data: {
                idd: idss
            },
            success: function(results) {
                var result = JSON.parse(results);
                if (result != null) {
                    // console.log(result);
                    $('#eid').val(result.id);
                }


            } 
        });



        load();
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        });
        table = $('#table').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function() {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('education/Student/feeStructure') ?>",
                "type": "POST",
                "data": function(data) {
                    // data.country = $('#country').val();
                    data.stype = 'sales';
                    data.supid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });
        loadpermission();
        $('#btn-filter').click(function() { //button filter event click
            ms();
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table

        });
        table = $('#etable').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function() {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_general/Leads_master/getProducts') ?>",
                "type": "POST",
                "data": function(data) {

                    data.supid = $("#id").val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });
        table = $('#srtable').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function() {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_general/Leads_master/getAllocation') ?>",
                "type": "POST",
                "data": function(data) {
                    // data.country = $('#country').val();
                    // data.stype = 'sales_return';
                    data.supid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });



        var now = new Date();
        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

        var id = $('#id').val();
        table = $('#futable').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Followups' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text(company + " - " + 'Followups');
                        $('c[r=A2] t', sheet).text("");
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Followups' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function(doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Followups";
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy

                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!

                        //  doc.pageMargins = [20, 60, 20, 30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 9;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 9;
                        // Create a header object with 3 columns
                        // Left side: Logo
                        // Middle: brandname
                        // Right side: A document title
                        doc['header'] = (function() {
                            return {
                                columns: [{
                                    alignment: 'center',
                                    //italics: true,
                                    text: company + " - " + 'Followups',
                                    fontSize: 14,
                                    margin: [10, 0]
                                }],
                                margin: 20
                            }
                        });
                        /*for (var i = 1; i < doc.content[1].table.body.length; i++) {
                         doc.content[1].table.body[i][4].alignment = 'right';
                         doc.content[1].table.body[i][0].alignment = 'center';
                         doc.content[1].table.body[i][1].alignment = 'center';
                         }*/
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [{
                                        alignment: 'left',
                                        text: ['Created on: ', {
                                            text: jsDate.toString()
                                        }]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_general/Enquiry_followup/getsing'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.id = $('#eid').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });

        // });





        table = $('#ctable').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('education/Student/fetchCourse') ?>",
                "type": "POST",
                "data": function(data) {
                    // data.country = $('#country').val();
                    data.supid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });
        var id = 0;

        function ms() {
            if (id === 1) {
                table.destroy();
            }
            id = 1;
            table = $('#ltable').DataTable({
                //"scrollY":  "200px",
                //"scrollCollapse": true,
                //"paging": false,
                "language": lan,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "bPaginate": false,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                'buttons': [],
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('education/Student/fetchCourse') ?>",
                    "type": "POST",
                    "data": function(data) {
                        // data.startdate = $('#startdate').val();
                        // data.enddate = $('#enddate').val();
                        // data.toid = $('#toid').val();
                    }
                },
                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

            });

        }
    });

    function load() {
        var id = $("#id").val();

        if (id > 0) {

            $.ajax({
                url: "<?php echo site_url('crm_general/Leads_master/getAll'); ?>/" + id,
                success: function(results) {

                    var result = JSON.parse(results);
                    $('#company').html(result.companyName);
                    $('#namess').html(result.contactPerson);
                    $('.suppname').html(result.companyName + " (Company)");
                    $("#email").html(result.email);
                    $("#phone").html(result.contactNumber);
                    $("#district").html(result.district);
                    $("#address_line1").html(result.adress);
                    $("#gst").html(result.gst);
                    $("#remarks").html(result.remarks);

                    $('#fromlead').html(result.companyName);
                    $("#createdby").html(result.createdby);
                    $("#createdon").html(result.updateddate.substring(0, 10));
                    $("#createdat").html(result.updateddate.substring(10, 16));
                }
            });
        }


        $.ajax({

            url: "<?php echo site_url('education/Student/getTotals'); ?>/" + id,
            success: function(results) {
                var result = JSON.parse(results);
                $("#fee").html(result.fee);
                $("#discount").html(result.discount);
                $("#total").html(result.total);
                $("#balance").html(result.balance);
                var balance = result.total - result.balance;
                var va = "Not Paid Anything"
                if (balance == 0) {
                    $("#payed").html(va);
                } else {
                    $("#payed").html(balance);
                }

            }

        });





        texts = '';
        idss = $('#id').val();
        $.ajax({
            url: "<?php echo site_url('crm_general/Leads_master/getStatus'); ?>/" + idss,
            success: function(results) {
                var result = JSON.parse(results);
                console.log(result.username)
                texts = texts + '<li class="time-label"><span class="bg-red">' + result.ldate.substring(0, 10) + '</span></li>' +
                    '<li><i class="fa fa-gear fa-spin bg-blue"></i>' +
                    '<div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> ' + result.ldate.substring(10, 16) + '</span><h3 class="timeline-header"><a href="#">Lead Created</a></h3>' +
                    '<div class="timeline-body">The lead was created by ' + result.username + '</div>' +
                    '<div class="timeline-footer"></div></div></li>';

                if (result.estatus >= 1) {
                    texts = texts + '<li class="time-label"><span class="bg-red">' + result.allodate.substring(0, 10) + '</span></li>' +
                        '<li><i class="fa fa-hand-o-right bg-blue"></i>' +
                        '<div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> ' + result.allodate.substring(10, 16) + '</span><h3 class="timeline-header"><a href="#">Allocation</a></h3>' +
                        '<div class="timeline-body">The lead was allocated to ' + result.username + '</div>' +
                        '<div class="timeline-body">Delivery date is on  ' + result.delidate.substring(0, 10) + '</div>' +
                        '<div class="timeline-footer"><a onclick="viewallo()" class="btn btn-primary btn-xs">View Allocation</a></div></div></li>';
                        //Followups
                    texts = texts + '<li class="time-label"><span class="bg-red">' + result.fdate.substring(0, 10) + '</span></li>' +
                        '<li><i class="fa fa-edit bg-blue"></i>' +
                        '<div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> ' + result.fdate.substring(10, 16) + '</span><h3 class="timeline-header"><a href="#">Followups</a></h3>';
                        if(result.nextfollow == '0000-00-00'){
                            texts = texts + '<div class="timeline-body">No follwups for show</div>';
                        }
                        else{
                            texts = texts + '<div class="timeline-body">The next followup date is in ' + result.nextfollow + '</div>';
                        }

                        texts = texts + '<div class="timeline-footer"><a onclick="viewfollow()" class="btn btn-primary btn-xs">View Followups</a></div></div></li>';
                }
                if(result.estatus == 3){
                    texts = texts + '<li class="time-label"><span class="bg-red">' + result.edate.substring(0, 10) + '</span></li>' +
                        '<li><i class="fa fa-refresh fa-spin bg-blue"></i>' +
                        '<div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> ' + result.edate.substring(10, 16) + '</span><h3 class="timeline-header"><a href="#">Varification pending</a></h3>' +
                        '<div class="timeline-body"> Waiting for admin to varify the request... </div>';

                }
                if(result.estatus >= 4){
                    texts = texts + '<li class="time-label"><span class="bg-red">' + result.edate.substring(0, 10) + '</span></li>' +
                        '<li><i class="fa fa-check bg-green"></i>' +
                        '<div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> ' + result.edate.substring(10, 16) + '</span><h3 class="timeline-header"><a href="#">Varified</a></h3>' +
                        '<div class="timeline-body"> Request successfully varified </div>';

                }
                if(result.estatus >= 6){
                    texts = texts + '<li class="time-label"><span class="bg-red">' + result.closedate.substring(0, 10) + '</span></li>' +
                        '<li><i class="fa fa-handshake-o bg-danger"></i>' +
                        '<div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> ' + result.closedate.substring(10, 16) + '</span><h3 class="timeline-header"><a href="#">Closed</a></h3>' +
                        '<div class="timeline-body"> Request successfully varified </div>';

                }
                $('#times').html(texts);
            }
        });


    }

    function viewallo() {
        $('#alloo').trigger('click');

    }
    function viewfollow(){
        $('#folloo').trigger('click');
    }
</script>