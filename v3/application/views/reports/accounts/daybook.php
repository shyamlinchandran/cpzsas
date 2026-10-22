<section class="content">
    <style>
        .right-aligned-cell {
            text-align: right
        }
    </style>
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label('Daybook', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body  table-responsive">
                    <table class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-1">
                                    <?= label('Start Date', $this, $user) ?>
                                    <input type="text" class="form-control date" id="startdate" />
                                </td>
                                <td class="col-sm-1">
                                    <?= label('End Date', $this, $user) ?>
                                    <input type="text" class="form-control date" id="enddate" />
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Branch', $this, $user) ?>
                                    <select tabindex="-1" id="branch" name="branch" class="form-control ">
                                    </select>
                                </td>
                                <td>
                                    <?= label('Opening Balance(with/without)', $this, $user) ?>
                                    <select tabindex="-1" id="op_balance" name="op_balance" class="form-control ">
                                        <option value="">With Opening Balance</option>
                                        <option value="1">With Out Opening Balance</option>
                                    </select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Voucher Type', $this, $user) ?>
                                    <select tabindex="-1" id="voucher_type" name="voucher_type" class="form-control ">
                                        <option value="">All</option>
                                        <option value="sales">Sales</option>
                                        <option value="sales_return">Sales Return</option>
                                        <option value="purchase">Purchase</option>
                                        <option value="purchase_return">Purchase Return</option>
                                        <option value="payment">Payment Voucher</option>
                                        <option value="receipt">Receipt Voucher</option>
                                        <option value="journal">Journal Voucher</option>
                                        <option value="new_expense">Quick Voucher</option>
                                    </select>
                                </td>
                                <td>
                                    Consolidated <br/>
                                    <input type="checkbox" value="1" id="conChck" checked="checked" />
                                </td>
                                <td>
                                    <br />
                                    <input type="button" class="btn btn-success" id="btn-filter" value="Search" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <table id="tableconsol" class="table <?= $this->table_color ?> table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('Date', $this, $user) ?></th> 
                                <th><?= label('Voucher Type', $this, $user) ?></th>
                                <th><?= label('Voucher Type', $this, $user) ?></th>
                                <th><?= label('Voucher No', $this, $user) ?></th>
                                <th><?= label('Narration', $this, $user) ?></th>
                                <th><?= label('Debit', $this, $user) ?></th>
                                <th class="dt-body-right"><?= label('Credit', $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table id="table" class="hidden table <?= $this->table_color ?> table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('Date', $this, $user) ?></th> 
                                <th><?= label('Ledger Name', $this, $user) ?></th>
                                <th><?= label('Voucher Type', $this, $user) ?></th>
                                <th><?= label('Voucher No', $this, $user) ?></th>
                                <th><?= label('Narration', $this, $user) ?></th>
                                <th><?= label('Debit', $this, $user) ?></th>
                                <th class="dt-body-right"><?= label('Credit', $this, $user) ?></th>
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
    $.validate({
        modules: 'date, security,file'
    });
    var table;
    var id = 0;
    $('#startdate').change(function () {
        var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        var branchh = $('#branch').val();
        var bal = $('#op_balance').val();
        var vou = $('#voucher_type').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            branch: branchh,
            bal: bal,
            vou: vou,
        });
        createCookie('day_book', JSON.stringify(arr), 3);
    });
    $('#enddate').change(function () {
        var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        var branchh = $('#branch').val();
        var bal = $('#op_balance').val();
        var vou = $('#voucher_type').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            branch: branchh,
            bal: bal,
            vou: vou,
        });
        createCookie('day_book', JSON.stringify(arr), 3);
    });
    $('#branch').change(function () {
        var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        var branchh = $('#branch').val();
        var bal = $('#op_balance').val();
        var vou = $('#voucher_type').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            branch: branchh,
            bal: bal,
            vou: vou,
        });
        createCookie('day_book', JSON.stringify(arr), 3);
    });
    $('#op_balance').change(function () {
        var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        var branchh = $('#branch').val();
        var bal = $('#op_balance').val();
        var vou = $('#voucher_type').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            branch: branchh,
            bal: bal,
            vou: vou,
        });
        createCookie('day_book', JSON.stringify(arr), 3);
    });
    $('#voucher_type').change(function () {
        var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        var branchh = $('#branch').val();
        var bal = $('#op_balance').val();
        var vou = $('#voucher_type').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            branch: branchh,
            bal: bal,
            vou: vou,
        });
        createCookie('day_book', JSON.stringify(arr), 3);
    });
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    function buttons() {

        var sm = document.getElementById('conChck').checked;
        if (sm) {
            return  [{
                    extend: 'print',
                    text: '<i class="glyphicon glyphicon-print"></i>',
                    className: 'btn btn-primary',
                    title: getheader("Day Book"),
                    footer: true,
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6],
                        search: 'applied',
                        order: 'applied'
                    },

                    // autoPrint: false,
                    //  messageTop: '<div class="col-12 text-right">This print was produced using the Print button for DataTables</div>',
                    customize: function (win) {
                        $(win.document.body).css('margin', '13px');
                        $(win.document.body).css('font-family', 'Verdana,Geneva,sans-serif');
                        $(win.document.body).find('table').addClass('display').css('font-size', '13px');
                        $(win.document.body).find('table').next("div").html(" <hr /><br/><div class='col-12 col-md-12 text-right' >Printed Date : <?php echo date("d-m-Y") ?></div>");
                    }
                }, {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'daybook_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6],
                        search: 'applied',
                        order: 'applied'
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Daybook');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'daybook_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        doc.content[0].text = "Date from " + fromdate + " to " + todate;
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
                        doc['header'] = (function () {
                            return {
                                columns: [{
                                        alignment: 'center',
                                        //italics: true,
                                        text: company + " - " + 'Daybook',
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
                        doc['footer'] = (function (page, pages) {
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
                        objLayout['hLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function (i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function (i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }
            ];
        } else {
            return  [{
                    extend: 'print',
                    text: '<i class="glyphicon glyphicon-print"></i>',
                    className: 'btn btn-primary',
                    title: getheader("Day Book"),
                    footer: true,
                    // autoPrint: false,
                    //  messageTop: '<div class="col-12 text-right">This print was produced using the Print button for DataTables</div>',
                    customize: function (win) {
                        $(win.document.body).css('margin', '13px');
                        $(win.document.body).css('font-family', 'Verdana,Geneva,sans-serif');
                        $(win.document.body).find('table').addClass('display').css('font-size', '13px');
                        $(win.document.body).find('table').next("div").html(" <hr /><br/><div class='col-12 col-md-12 text-right' >Printed Date : <?php echo date("d-m-Y") ?></div>");
                    }
                }, {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'daybook_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Daybook');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'daybook_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        doc.content[0].text = "Date from " + fromdate + " to " + todate;
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
                        doc['header'] = (function () {
                            return {
                                columns: [{
                                        alignment: 'center',
                                        //italics: true,
                                        text: company + " - " + 'Daybook',
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
                        doc['footer'] = (function (page, pages) {
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
                        objLayout['hLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function (i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function (i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }
            ];
        }
    }
    function ms() {

        var main = $('#table');
        var sm = document.getElementById('conChck').checked;
        if (sm) {
            main = $('#tableconsol');
            $('#table').addClass('hidden');
            $('#tableconsol').removeClass('hidden');
        } else {
            $('#tableconsol').addClass('hidden');
            $('#table').removeClass('hidden');
        }
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = main.DataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": false,
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": true,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],
            "footerCallback": function (row, data, start, end, display) {
                console.log(data);
            },
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": buttons(),
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/accounts/daybook_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.group = $('#voucher_type').val();
                    data.branch = $('#branch').val();
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.op_balance = $('#op_balance').val();
                    data.consol = sm;
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                    targets: [5, 6],
                    className: "right-aligned-cell"
                }]
        });
        if (sm) {
            table.column(1).visible(false);
        } else {
            table.column(1).visible(true);
        }

    }

    function loadcookie() {

    }
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/branch'); ?>",
            success: function (result) {
                $('#branch').html(result);
                loadcookie();
            }
        });
        var result = readCookie('day_book');
        if (result != null) {
            results = JSON.parse(result);
            $.each(results, function (index, value) {
                $('#startdate').val(value.stdate);
                $('#enddate').val(value.enddate);
                $('#branch').val(value.branch);
                $('#op_balance').val(value.bal);
                $('#voucher_type').val(value.vou);
            });
        }

        ms();
        $('#btn-filter').click(function () {
            ms();
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });
    });
</script>