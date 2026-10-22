<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">
                <div class="box-header">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $titles)) ?></h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-strippped table-condensed" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    Start Date
                                    <input type="text" class="form-control date" id="startdate" />
                                </td>
                                <td class="col-sm-2">
                                    End Date
                                    <input type="text" class="form-control date" id="enddate" />
                                </td>
                                <td>
                                    Type
                                    <select class="form-control" id ="type" name ="type">
                                        <option value ="purchase">Purchase</option>
                                        <option value ="purchase_return">Purchase Return</option>
                                    </select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Customer', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="customer_id" id="customer_id" />
                                    <input name="supname" id="supname" type="text" NoTab="true" data-validation="required,length" data-validation-length="min2" class="form-control" placeholder="customer">
                                </td>
                                <td>
                                    <br />
                                    <input type="button" class="btn btn-success" id="btn-filter" value="<?= label('Search', $this, $user) ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-body table-responsive">
                    <div class="table-responsive">
                        <table id="table" class="table <?= $this->table_color ?> " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= label('Voucher no', $this, $user) ?></th>
                                    <th><?= label('Voucher Date', $this, $user) ?></th>
                                    <th><?= label('Invoice no',$this,$user) ?></th>
                                    <th><?= label('Invoice Date',$this,$user) ?></th>
                                    <th><?= label('Party Name', $this, $user) ?></th>
                                    <th><?= label('Item', $this, $user) ?></th>
                              <!--  <th><?= label('Part No', $this, $user) ?></th>-->
                                    <th><?= label('HSN code', $this, $user) ?></th>
                                    <th><?= label('Quantity', $this, $user) ?></th>
                                    <th><?= label('Unit Price', $this, $user) ?></th>
                               <!-- <th><?= label('Disc%', $this, $user) ?></th>-->
                                    <th><?= label('Sub Total', $this, $user) ?></th>
                                    <th><?= label('Transportation Charges', $this, $user) ?></th>
                                    <th><?= label('Postage Charges', $this, $user) ?></th>
                                    <th><?= label('Loading Charges', $this, $user) ?></th>
                                    <th><?= label('CGST', $this, $user) ?></th>
                                    <th><?= label('SGST', $this, $user) ?></th>
                                    <th><?= label('IGST', $this, $user) ?></th>
                                    <th><?= label('Total', $this, $user) ?></th>
                                    <th><?= label('IGST RATE', $this, $user) ?></th>
                                    <th><?= label('Purchase Account', $this, $user) ?></th>
									<th><?= label('CGST LEDGER', $this, $user) ?></th>
                                    <th><?= label('SGST LEDGER', $this, $user) ?></th>
                                    <th><?= label('IGST LEDGER', $this, $user) ?></th>
                                    <!--<th><?= label('Round off', $this, $user) ?></th>
                                    <th><?= label('Address 1', $this, $user) ?></th>
                                    <th><?= label('address 2', $this, $user) ?></th>-->
                                    <th><?= label('Country', $this, $user) ?></th>
                                    <th><?= label('State', $this, $user) ?></th>
									<th><?= label('Voucher Type', $this, $user) ?></th>
                                    <th><?= label('unit', $this, $user) ?></th>
                                    <th><?= label('GSTIN', $this, $user) ?></th>
                                   <!-- <th><?= label('Discount Amt', $this, $user) ?></th>-->
								   <th><?= label('Tin no', $this, $user) ?></th>
                                    <th><?= label('Cess Amount', $this, $user) ?></th>
                                    <th><?= label('Cess Ledger', $this, $user) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    function ms() {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        //datatables
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
                  "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Inventory Purchase Report' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: ':visible'
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Inventory Purchase Report');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Inventory Purchase Report' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: ':visible',
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate ;
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
                                        text: company + " - " + 'Inventory Purchase Report',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
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
            "order": [],


            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/New_Purchase_report/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.supname = $("#supname").val();
                    data.customer_id = $("#customer_id").val();
                    data.startdate = $("#startdate").val();
                    data.enddate = $("#enddate").val();
                    data.type = $("#type").val();
                }
            },

            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]



        });
        loadpermission();
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table

        });
      }
   
    $("#supname").autocomplete({
        source: "<?php echo site_url('reports/New_Purchase_report/suppliers'); ?>",
        minLength: 2,
        select: function(event, ui) {
            loadCust(ui);

        }
    });

    function loadCust(ui) {
        $('#supname').val(ui.item.name);
        $('#customer_id').val(ui.item.id);
    }
    $('#btn-filter').click(function() { //button filter event click

        ms();
        //  table.ajax.reload(null, false);  //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(null, false); //just reload table
    });
</script>