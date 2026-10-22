<?php
$add_url = site_url('hr/SalaryPackage/create');
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
                    <h3 class="box-title">Employee Salary Package</h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('hr/SalaryPackage/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table   class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <tbody>
                        <td class="col-sm-2">
                            <?= label('Status', $this, $user) ?>
                            <select id="status" class="form-control">
                                <option id="active">Active</option>
                                <option id="inactive">Inactive</option>
                                <option value="">All</option>
                            </select>
                        </td>
                        <td class="col-sm-2">
                            <?= label('Start Date', $this, $user) ?>
                            <input type="text" class="form-control date" id="startdate"/>
                        </td>
                        <td class="col-sm-2">
                            <?= label('End Date', $this, $user) ?> 
                            <input type="text" class="form-control date" id="enddate"/> 
                        </td>
                        <td class="col-sm-2">

                        </td>
                        <td class="col-sm-2">

                        </td>
                        </tbody>
                    </table>
                    <table id="table"  class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <style>
                            .table{
                                margin-bottom: 0px !important;
                            }
                        </style>
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Employee', $this, $user) ?></th>
                                <th><?= label('Status', $this, $user) ?></th>
                                <th><?= label('Renewel Date', $this, $user) ?></th>
                                <th><?= label('notes', $this, $user) ?></th>
                                <th><?= label('Total', $this, $user) ?></th>
                                <th><?= label('Action', $this, $user) ?></th>
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
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    $(document).ready(function () {
        $('#startdate').val('');
        $('#enddate').val('');
        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Package Report' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var status = $('#status').val();
                        var startdate = $('#startdate').val();
                        var enddate = $('#enddate').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Total Salary Report');
                        $('c[r=A2] t', sheet).text("From  " + startdate + " to:  " + enddate + " status :" + status);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Package Report' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var status = $('#status').val();
                        var startdate = $('#startdate').val();
                        var enddate = $('#enddate').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "From  " + startdate + " to:  " + enddate + " status : " + status;
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
                                columns: [
                                    {
                                        alignment: 'center',
                                        //italics: true,
                                        text: company + " - " + 'Salary  Report',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        for (var i = 1; i < doc.content[1].table.body.length; i++) {
                            doc.content[1].table.body[i][4].alignment = 'right';
                            doc.content[1].table.body[i][0].alignment = 'center';
                            doc.content[1].table.body[i][1].alignment = 'center';
                        }
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Created on: ', {text: jsDate.toString()}]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    }
                                    ,
                                    {
                                        alignment: 'right',
                                        text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
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
                }],
            "initComplete": function (settings, json) {
//                $('#name').html('11111111111111');
            },
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('hr/SalaryPackage/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.status = $('#status').val();
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        var val = readCookie('search_<?= $type ?>');
        var active = readCookie('active<?= $type ?>');
        if (val !== null) {
            table.search(val).draw();
        }
        $('.dataTables_filter input').unbind().keyup(function () {
            var value = $(this).val();
            if (value.length > 0) {
                createCookie('search_<?= $type ?>', value, 3);
                table.search(value).draw();
            }
            if (value.length === 0) {
                eraseCookie('search_<?= $type ?>');
                table.search(value).draw();
            }
        });
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });
        $('#status').change(function () {
            table.ajax.reload(null, false); //just reload table
        });
        $('#startdate').change(function () {
            table.ajax.reload(null, false); //just reload table
        });
        $('#enddate').change(function () {
            table.ajax.reload(null, false); //just reload table
        });
    });

</script>  
