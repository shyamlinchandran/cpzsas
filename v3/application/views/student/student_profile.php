<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
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
                            <b style="font-size:20px;color:midnightblue">Personal</b> <a id="gst" class="pull-right"></a>
                            <br>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a id="email" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a id="phone" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>State</b> <a id="state" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>State Code</b> <a id="statecode" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b> <a id="address_line1" class="pull-right"></a>
                            <br><br><br>
                        </li>
                        <li class="list-group-item">
                            <b>Age</b> <a id="age" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Father Name</b> <a id="father" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Mother Name</b> <a id="mother" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <br>
                            <b style="font-size:20px;color:midnightblue">Education</b> <a id="gst" class="pull-right"></a>
                            <br>
                        </li>
                        <li class="list-group-item">
                            <b>Qualification</b> <a id="qual" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Qualification Status</b> <a id="qualy" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Enrollment No</b> <a id="enroll" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Materials Provided</b> <a id="mats" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <br>
                            <b style="font-size:20px;color:midnightblue">Other</b> <a id="gst" class="pull-right"></a>
                            <br>
                        </li>
                        <li class="list-group-item">
                            <b>Student Status</b> <a id="stud_status" class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Remarks</b> <a id="remarks" class="pull-right"></a>
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
                            <a role="button" back="<?php echo site_url('customers/listall/' . $type); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('education/Student/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#voucherstab" data-toggle="tab">Courses</a></li>
                        <li><a href="#sreturn" data-toggle="tab">Fee Details</a></li>
                        <li><a href="#estimate" data-toggle="tab">Transactions</a></li>
                        <li><a href="#follow" data-toggle="tab">Follow Ups</a></li>
                        <li><a href="#bal" data-toggle="tab">Payment & Balance</a></li>
                        <li><a href="#upload" data-toggle="tab">Uploads</a></li>
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
                                    <table id="ctable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Course Name</th>
                                                <th>University Name</th>
                                                <th>Joined on</th>
                                                <th>Batch</th>
                                                <!-- <th>Credit</th>
                                                <th>Debit</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>

                        <div class="tab-pane" id="upload">
                            <!-- Post -->

                            <style>
                                .box-title {
                                    text-transform: capitalize;
                                }
                            </style>
                            <section class="content">


                                <!-- /.box-header -->
                                <div class="box-body pull-left" style="width : 60%">
                                    <form id="doc" name="doc" enctype="multipart/form-data">

                                        <table class="table table-striped table-condensed" style="width: 100%">
                                            <tr>
                                                <td>Document Type</td>
                                                <td>File</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-7">
                                                    <select name="doc_type" id="doc_type" class="form-control">
                                                    </select>
                                                </td>
                                                <td class="col-lg-4">
                                                    <input type="file" name="file" id="file" />
                                                </td>
                                                <td>
                                                    <a data-toggle="tooltip" style="float: left" title="Add Document" id="adddocument" class="btn btn-success" href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tbody id="uploadbody">

                                            </tbody>
                                        </table>
                                    </form>


                                </div>
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
                                                    <h4>Paid</h4>
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
                                                <th>Label</th>
                                                <th>Status</th>
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
                                                <th>Invoice No</th>
                                                <th>Naration</th>
                                                <th>Invoice Date</th>
                                                <th>Credit</th>
                                                <th>Debit</th>
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
                                                <th>Course</th>
                                                <th>University</th>
                                                <th>Fee</th>
                                                <th>Discount</th>
                                                <th>Total</th>
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

    function adddocument(idd = 0, result, doc_type, docs = '') {
        if (docs != '') {
            var doc = docs
        } else {
            var doc = $("#doc_type [value=" + doc_type + "]").text();
        }

        $('#doc_type').val('');
        $('#file').val();
        // alert($('#id').val())
        if (idd > 0) {
            var text = '<tr><td style = "display:none"><input type = "hidden" value = "' + idd + '" id = docid name = docid[] ></td><td class="col-lg-7"><input value="' + doc_type + '" type="hidden" id="document_id" name="document_id[]"><input class="form-control" height=30; value="' + doc + '" type="text" readonly="readonly"> </td><td><input type="hidden" name="doc_img[]" value="' + result + '" />  <a tp="new" target="_blank" href="<?php echo site_url('uploads/images/'); ?>' + result + '" >' + result + ' </a></td><td><a idss = "' + idd + '" class = "btn btn-danger deleterow"><span class="glyphicon glyphicon-remove-circle" ></span></td></td></tr>';
        } else {
            var text = '<tr><td style = "display:none"><input type = "hidden" value = "" id = docid name = docid[] ></td><td class="col-lg-7"><input value="' + doc_type + '" type="hidden" id="document_id" name="document_id[]"><input class="form-control" height=30; value="' + doc + '" type="text" readonly="readonly"> </td><td><input type="hidden" name="doc_img[]" value="' + result + '" />  <a tp="new" target="_blank" href="<?php echo site_url('uploads/images/'); ?>' + result + '" >' + result + ' </a></td><td><a class = "btn btn-danger  "><span class="glyphicon glyphicon-remove-circle" ></span></td></td></tr>';
        }


        $('#uploadbody').append(text);
    }

    $(document).ready(function() {

        $.ajax({

            url: "<?php echo site_url('education/Student/getAlldocuments'); ?>/" + $('#id').val(),
            success: function(results) {
                $.each(JSON.parse(results), function(i, itemsingle) {
                    adddocument(itemsingle.id, itemsingle.document, itemsingle.document_type, itemsingle.dname);
                });

            }

        });

        $('#adddocument').click(function() {
            var doc_type = $('#doc_type').val();
            var file = document.getElementById("file").files[0];
            var data = new FormData();
            if (file !== undefined && doc_type !== "" && doc_type !== '0') {
                data.append("document", file);
                $.ajax({
                    url: "<?php echo site_url('education/Student/savedocument'); ?>",
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false, // send it here
                    success: function(result) {
                        if (result !== "") {
                            adddocument(0, result, doc_type, '');
                            $.ajax({
                                url: "<?php echo site_url('education/Student/savedocumenttotable'); ?>/" + result,
                                type: 'post',
                                data: {
                                    stud_id: $('#id').val(),
                                    doc: doc_type
                                },
                                success: function(result) {

                                }
                            });
                        }
                    }
                });

            }

        });

        //datatables
        var idss = $('#id').val();
        // alert(idss)
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
                "url": "<?php echo site_url('education/Student/fetchFee') ?>",
                "type": "POST",
                "data": function(data) {
                    // data.country = $('#country').val();
                    // data.stype = 'estimate';
                    data.supid = $('#id').val();
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
                "url": "<?php echo site_url('education/Student/fee_balance_list') ?>",
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

        // $(document).ready(function(){
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
                "url": "<?php echo site_url('crm_new/Enquiry_followup/getsing'); ?>",
                "type": "POST",
                "data": function(data) {

                    data.id = '<?php echo $id ?>';
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
                url: "<?php echo site_url('education/Student/getDetails'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    if (result.image != 'noimage') {
                        $('#imgs').attr("src", "<?php echo base_url() ?>assets/images/" + result.image)
                    }

                    $('#custname').html(result.name);
                    $('.suppname').html(result.name + " (Student)");
                    $("#email").html(result.email);
                    $("#phone").html(result.phone);
                    $("#qual").html(result.qualify);
                    $("#qualy").html(result.route);
                    $("#state").html(result.statename);
                    $("#statecode").html(result.pincode);
                    $("#enroll").html(result.enrollment);
                    $("#father").html(result.father);
                    $("#mother").html(result.mother);
                    $("#remarks").html(result.details);
                    $("#address_line1").html(result.address_line1);
                    $("#address_line2").val(result.address_line1);
                    $("#stud_status").html(result.stud_status);
                    $("#remarks").html(result.remarks);
                    $("#mats").html(result.materials);
                    $("#age").html(result.age);
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

    }



    $(document).on("click", ".deleterow", function() {
        var var_id = $(this).attr('idss');
        $(this).closest("tr").remove();
        // $('#var_id').val(var_id);
        table.ajax.reload(null, false);
        // alert(var_id);
        $.ajax({
            url: "<?php echo site_url('education/Student/deleterow'); ?>/" + var_id,
            success: function(result) {

            }
        });


    });

    $.ajax({
        url: "<?php echo site_url('education/Student/doc_type'); ?>",
        success: function(result) {
            $('#doc_type').html(result);
        }
    });
</script>