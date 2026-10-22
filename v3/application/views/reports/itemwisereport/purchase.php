<?php
$isbatch = 0 ;
if(isset($settings[0]['is_batch'])){
	$isbatch = $settings[0]['is_batch'];
}
$taxtype = $settings[0]['com_tax_type'];
$user = $this->session->userdata('user');
$utype = $user['utype'];
?> 
<section class="content"> 
    <input type="hidden" value="<?php echo $taxtype; ?>" id="taxtype" name="taxtype"/> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <input type="hidden" value="<?php echo $utype; ?>" id="utype" name="utype"/> 
                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                </div>
                <input type="hidden" value="<?php echo $purtype; ?>" id="purtype" name="purtype"/> 
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
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
                                    <?= label('Bill Type', $this, $user) ?>
                                    <select tabindex="-1" id="btype" name="btype" class="form-control " >                                            
                                    </select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Item', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Supplier', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="supid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="supplier"/> 
                                </td>

                                <td class="col-sm-2">
                                    <?= label('Hsn Code', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="hsnid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="hsn"/> 
                                </td>
								 <td class="col-sm-2">
                                    <?= label('Category', $this, $user) ?> 
                                    <input type="hidden" id="category" name="category" class="form-control" />
                                    <input type="text" id="item_category_name" name="item_category_name" class="form-control" />
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-reset"  value="<?= label('Reset', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Inv Date', $this, $user) ?></th>
                                <th><?= label('Inv no', $this, $user) ?></th>
                                <th><?= label('Item', $this, $user) ?></th>
                                <th><?= label('Barcode', $this, $user) ?></th>
                                <?php if($isbatch > 0 ){?>
                                    <th><?= label('Batch', $this, $user) ?> </th>
                                <?php } ?>
                                <th><?= label('Quantity', $this, $user) ?> </th>
                                <th><?= label('F Qty', $this, $user) ?> </th>
                                <th><?= label('Supplier', $this, $user) ?></th> 
                                <th><?= label('Billtype', $this, $user) ?></th> 
                                <th><?= label('U Price', $this, $user) ?></th>
                                <th><?= label('Value', $this, $user) ?></th>
                                <th><?= label('Discount', $this, $user) ?></th>
                                <th><?= label('Taxable', $this, $user) ?></th>
                                <th><?= label('Tax%', $this, $user) ?></th>
                                <?php if ($taxtype == 'GST') { ?>
                                    <th><?= label('cgst', $this, $user) ?></th>
                                    <th><?= label('sgst', $this, $user) ?></th>
                                <?php } ?>
                                <th><?= label('Total Tax', $this, $user) ?></th>
                                <th><?= label('Cess%', $this, $user) ?></th>
                                <th><?= label('Cess', $this, $user) ?></th>
                                <th><?= label('Other Expenses', $this, $user) ?></th>
                                <th><?= label('Total', $this, $user) ?></th>
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
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            //"scrollY": "200px",
//            "scrollCollapse": true,
            "paging": true,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'invoce_report_' + jsDate,
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
                        var itemname = $('#name').val();
                        var supplier = $('#supplier').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Item Wise Purchase Report');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " , Item :" + itemname + " , supplier :" + supplier);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'invoce_report_' + jsDate,
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
                        var itemname = $('#name').val();
                        var supplier = $('#supplier').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " , Item :  " + itemname + " supplier : " + supplier;
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
                                        text: company + " - " + 'Item Wise Purchase Report',
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
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/itemwisereport/purchase_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.toid = $('#toid').val();
                    data.supid = $('#supid').val();
                    data.hsnid = $('#hsnid').val();
                    data.purtype = $('#purtype').val();
                    data.btype = $('#btype').val();
                    data.taxtype = $('#taxtype').val();
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

        $("#supplier").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/suppliers", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#supid").val(ui.item.id);
                // $("#btn-filter").focus();
            }
        });
        $("#hsn").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/hsn", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#hsnid").val(ui.item.hsnid);
                $("#btn-filter").focus();
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $purtype; ?>",
            success: function (result) {
                $('#btype').html(result);
                var utype = $('#utype').val();
                if (utype === "Admin") {
                    $("#btype").prepend('<option value="" selected>' + "All" + '</option>');
                }
            }
        });
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/items", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });

        $('#btn-filter').click(function () { //button filter event click

            ms();
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#name').val("");
            $('#supid').val("");
            $('#toid').val("");
            $('#hsnid').val("");
            $('#supplier').val("");
            ms();
        });

    });
</script>
