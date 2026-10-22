<section class="content">
    <style>
        .right-aligned-cell{
            text-align:right
        }
        h5{
            width: 100%;
            text-align: right;
            padding: 0px;
            margin: 0px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

       .col-md-6  h3{
            width: 100%;
            text-align: center; 
            font-size: 14px; 
            padding: 0px;
            margin: 0px;
            font-weight: bold;
            margin-bottom: 7px;
            padding-bottom: 5px;
            border-bottom: 2px solid;
        }
    </style> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
				<input type ="hidden" value="<?php echo  $this->session->userdata('login_comid');?>" id="login_comid"/>
                <input type="hidden" id="main" value="<?php echo $main; ?>"/>
                <input type="hidden" id="ledger_name" name="ledger_name"  value="<?php echo $ledger_name ?>"/>
                <input type="hidden" name="id" id="id" value="<?php
                if (isset($details)) {
                    echo $details['id'];
                }
                ?>"/>
                <input type="hidden" name="ledgername" id="ledgername" value="<?php
                if (isset($details)) {
                    echo $details['name'];
                }
                ?>"/>
                <div class="box-header">
                    <h3 class="box-title"><?= label('Ledger Report', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <form id="frmId" >
                    <div class="box-body table-responsive">
                        <table   class="table table-condensed table-stripped" cellspacing="0" width="100%">
                            <tbody>
                                <tr>

                                    <td class="col-sm-2">
                                        <?= label('Start Date', $this, $user) ?>
                                        <input type="text" class="form-control date" id="startdate"/>
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('End Date', $this, $user) ?>
                                        <input type="text" class="form-control date" id="enddate"/> 
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('Ledger', $this, $user) ?> 
                                        <input type="hidden" class="form-control" id="toid"/> 
                                        <input value="<?php
                                        if (isset($details)) {
                                            echo $details['name'];
                                        }
                                        ?>" NoTab="true" type="text" class="form-control" id="name" data-validation="required"/> 
                                    </td>

                                    <td>
                                        <br/>
                                        <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                        <button type="button" class="btn btn-danger" id="btn-pdf">
                                        <i class="fa fa-file-pdf-o"></i> PDF
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                        <div class="row" style=" background: #4678d5;    padding:5px;    color: #fff;">
                            <div class="col-md-6">

                                <h3 class="box-title"><?= label('With Opening Balance', $this, $user) ?></h3> 

                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><?= label('Total Debit', $this, $user) ?> </h5>

                                        <h5 id="wdb">0.00</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= label('Total Credit', $this, $user) ?> </h5>

                                        <h5 id="wcb">0.00</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= label('Balance', $this, $user) ?> </h5> 
                                        <h5 id="wb">0.00</h5>
                                    </div>
                                </div>



                            </div>
                            <div class="col-md-6 ">

                                <h3 class="box-title" style="    text-align: center;"><?= label('Without Opening Balance', $this, $user) ?></h3>

                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><?= label('Total Debit', $this, $user) ?> </h5>

                                        <h5 id="wodb">0.00</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= label('Total Credit', $this, $user) ?> </h5>

                                        <h5 id="wocb">0.00</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= label('Balance', $this, $user) ?> </h5>

                                        <h5 id="wob">0.00</h5>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <br/>
                        <table id="table"  class="table table-condensed table-stripped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-1"><?= label('Date', $this, $user) ?></th> 
                                    <th class="col-2"><?= label('V Type', $this, $user) ?></th> 
                                    <th class="col-2"><?= label('V Number', $this, $user) ?></th> 
                                    <th class="col-2"><?= label('Ref No', $this, $user) ?></th> 
                                    <th class="col-2"><?= label('Particulars', $this, $user) ?></th> 
                                    <th class="col-2"><?= label('Debit', $this, $user) ?></th>
                                    <th class="col-2"><?= label('Credit', $this, $user) ?></th>
                                    <th class="col-1"><?= label('Balance', $this, $user) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            
                        </table>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<?php $login_comid = $this->session->userdata('login_comid'); ?>
<script type="text/javascript">
    $.validate({
        modules: 'date, security,file'
    });

    // $('#name').change(function() {
    //     var arr = [];
    //     var fromdate = $('#startdate').val();
    //     var todate = $('#enddate').val();
    //     var ledg = $('#name').val();
    //     arr.push({
    //         stdate: fromdate,
    //         enddate: todate,
    //         ledg: ledg,

    //     });
    //     createCookie('<?php echo $login_comid ?>ledger_cook', JSON.stringify(arr), 3);
    // });
    var table;
    var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    function ms()
    {
        $.validate({
            modules: 'date, security,file'
        });
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "scrollCollapse": true,
            "paging": true,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": true,
            "autoWidth": false,
            "footerCallback": function (row, data, start, end, display) {
                console.log(data[0]);
                $("#wocb").html(data[0][8]);
                $("#wodb").html(data[0][9]);
                var balance = parseFloat(data[0][8]) - parseFloat(data[0][9]);
                if (balance < 0)
                {
                    $("#wob").html(parseFloat(balance * -1).toFixed(2) + " DR");
                } else {
                    $("#wob").html(balance + " CR");
                }

                var wcb = (parseFloat(data[0][8]) + parseFloat(data[0][6])).toFixed(2);
                var wdb = (parseFloat(data[0][9]) + parseFloat(data[0][5])).toFixed(2);
                $("#wcb").html(wcb);
                $("#wdb").html(wdb);
                var wb = (wcb - wdb).toFixed(2);
                if ((wcb - wdb) < 0)
                {
                    $("#wb").html(parseFloat(wb * -1).toFixed(2) + " DR");
                } else {
                    $("#wb").html(wb + " CR");
                }



            },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            'dom': "<'row'<'col-sm-4'l><'col-sm-4  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
    extend: 'print',
    footer: true,
    text: '<i class="glyphicon glyphicon-print"></i>',
    className: 'btn btn-primary',
    title: getheader("<?= label('Ledger Report', $this, $user) ?>"),
    customize: function (win) {
        // Basic styling

        var startDate = $('#startdate').val() || 'N/A';
        var endDate = $('#enddate').val() || 'N/A';
        var ledgerName = $('#name').val() || 'All';


        $(win.document.body)
            .css('font-size', '10pt !important')
            .css('margin', '13px');
        
        // Style the main table
        $(win.document.body).find('table')
            .addClass('display')
            .css('font-size', '13px');
        


            // <div style="margin-bottom: 10px; font-weight: bold;">
            //     Ledger: ${ledgerName} <br>
            //     Period: ${startDate} to ${endDate}
            // </div>
            // <table class="summary-table" style="
            //     width: 100%;
            //     margin: 20px 0;
            //     border: 1px solid #ddd;
            //     border-collapse: collapse;
            //     background: #f9f9f9;
            // ">
            //     <thead>
            //         <tr>
            //             <td colspan="3" style="
            //                 color: white;
            //                 padding: 8px;
            //                 text-align: center;
            //                 border: 1px solid #2a5ab5;
            //             ">
            //                 <?= label('Without Opening Balance', $this, $user) ?>
            //             </td>
            //         </tr>
            //         <tr>
            //             <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
            //                 <?= label('Total Debit', $this, $user) ?>
            //             </td>
            //             <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
            //                 <?= label('Total Credit', $this, $user) ?>
            //             </td>
            //             <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
            //                 <?= label('Balance', $this, $user) ?>
            //             </td>
            //         </tr>
            //     </thead>
            //     <tbody>
            //         <tr>
            //             <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">
            //                 ${$('#wodb').text()}
            //             </td>
            //             <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">
            //                 ${$('#wocb').text()}
            //             </td>
            //             <td style="padding: 8px; border: 1px solid #ddd; text-align: right;">
            //                 ${$('#wob').text()}
            //             </td>
            //         </tr>
            //     </tbody>
            // </table>
        // Create summary TABLE with current values
        var summaryTable = `
            <div style="text-align: right; margin-top: 10px;">
                Printed Date: <?php echo date('d-m-Y') ?>
            </div>
        `;

        
        // Append the summary table after all content
        $(win.document.body).append(summaryTable);
        
        // Ensure proper printing of tables
        $(win.document.head).append(`
            <style type="text/css">
                @media print {
                    .summary-table {
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .summary-table th {
                        background: #4678d5 !important;
                        color: white !important;
                    }
                }
            </style>
        `);
    }
},
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'ledger_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#name').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Ledger');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " Ledger :" + ledgername);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'ledger_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#name').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " Ledger : " + ledgername;
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
                                        text: company + " - " + 'Ledger',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        for (var i = 1; i < doc.content[1].table.body.length; i++) {
                            doc.content[1].table.body[i][4].alignment = 'left';
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
                {targets: [ 5, 6,7], className: "right-aligned-cell"}]

        });

    }
    $(document).ready(function () {

          $('#btn-pdf').click(function () {
    var toid = $('#toid').val();
    if (toid === "") {
        toastr["error"]("Please select a ledger first");
        return;
    }

    var startdate = $('#startdate').val();
    var enddate = $('#enddate').val();

    // Construct the URL
    var baseUrl = "<?php echo site_url('reports/accounts/ledger_pdf') ?>";
    var finalUrl = baseUrl + "?startdate=" + encodeURIComponent(startdate) + 
                             "&enddate=" + encodeURIComponent(enddate) + 
                             "&toid=" + encodeURIComponent(toid);

    // Create a temporary link that matches your global AJAX script's requirements
    var $tempLink = $('<a target="_blank"></a>');
    $tempLink.attr('href', finalUrl);
    $tempLink.attr('target', '_blank'); // This tells your script to use pdfpage()
    $tempLink.attr('tp', 'pdf'); // This tells your script to use pdfpage()
    $tempLink.text('Generating...');
    $tempLink.hide();
    
    $('body').append($tempLink);
    
    // This will now be caught by your $(document).on('click', "a", ...) handler
    // and correctly call pdfpage(href) instead of a standard AJAX load.
    $tempLink.click();
    
    $tempLink.remove();
});
        var main = $('#main').val();
        var result = readCookie('<?php echo $login_comid ?>ledger_cook');
        console.log(result);
        if (result != null) {
            results = JSON.parse(result);
            console.log(results);
            $.each(results, function (index, value) {
                $('#startdate').val(value.stdate);
                $('#enddate').val(value.enddate);
                $('#name').val(value.ledg);
                $('#toid').val(value.toid);
                if (value.toid !== "") {
                    ms();
                }
            });


        }
        if (main > 0) {
            var ledger_name = $('#ledger_name').val();
            var result = readCookie('main<?php echo $login_comid ?>ledger_cookie');

            if (result != null) {
                results = JSON.parse(result);
                $.each(results, function (index, value) {
                    $('#startdate').val(value.stdate);
                    $('#enddate').val(value.enddate);
                    $('#name').val(ledger_name);
                    $('#toid').val(main);
                });
            }
        }

        $('#btn-filter').click(function () {
            var arr = [];
            var fromdate = $('#startdate').val();
            var todate = $('#enddate').val();
            var ledg = $('#name').val();
            var toid = $('#toid').val();
            arr.push({
                stdate: fromdate,
                enddate: todate,
                ledg: ledg,
                toid: toid,
            });
            createCookie('<?php echo $login_comid ?>ledger_cook', JSON.stringify(arr), 3);
        });

        $('#startdate').change(function () {
            var arr = [];
            var fromdate = $('#startdate').val();
            var todate = $('#enddate').val();
            var ledg = $('#name').val();
            arr.push({
                stdate: fromdate,
                enddate: todate,
                ledg: ledg,
            });
            createCookie('<?php echo $login_comid ?>ledger_cook', JSON.stringify(arr), 3);

        });
        $('#enddate').change(function () {
            var arr = [];
            var fromdate = $('#startdate').val();
            var todate = $('#enddate').val();
            var ledg = $('#name').val();
            arr.push({
                stdate: fromdate,
                enddate: todate,
                ledg: ledg,
            });
            createCookie('<?php echo $login_comid ?>ledger_cook', JSON.stringify(arr), 3);
        });
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
        var id = $('#id').val();
        if (id !== "") {
            $('#toid').val(id);
            ms();
        }
        $('#btn-filter').click(function () {
            $('#frmId').isValid();
            var id = $('#toid').val();
            if (id !== "") {
                ms();
            } else {
                $('#name').val('');
            }
//            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
</script>
