<?php
$add_url = site_url('accounts_master/ledger/create');
?>

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label('Ledgers', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" class="btn  btn-success align-bottom" back="<?php echo site_url('accounts_master/Ledger/listall');?>" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
					<table   class="table table <?= $this->table_color ?> table table-hover cc" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
								 <td class="col-sm-2">
                                    <?= label('Ledger Group', $this, $user) ?>
                                    <select tabindex="-1" id="main_group" name="main_group" class="form-control " >                                            
                                    </select>
                                </td>
                                <td class="col-sm-1">
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                               
                                </td>

                                <td class="col-sm-2">
                                   
                                </td>
                                <td class="col-sm-2">
                                      
                                </td>
                                <td class="col-sm-2">
                                       
                                </td>
                                <td class="col-sm-2">
                                <td>
                                     </td>
							</tr>
						</tbody>
                    <table id="table"  class="table <?=$this->table_color?> " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <?php if ($this->multiple != 0) { ?>
                                <th><?= label('Arabic Name', $this, $user) ?></th>
                                <?php } ?>
                                <th><?= label('Code', $this, $user) ?></th>
                                <th><?= label('Main Ledger', $this, $user) ?></th>
                                <th><?= label('Tax', $this, $user) ?></th>
                                <th><?= label('Type', $this, $user) ?></th>
                                <th><?= label('Opening Balance', $this, $user) ?></th>
                                <th><?= label('Closing Balance', $this, $user) ?></th>
                                <th><?= label('Actions', $this, $user) ?></th>
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
    $(document).ready(function () {
		$.ajax({
            url: "<?php echo site_url('ajaxcall/acc_main'); ?>",
            success: function (result) {
                $('#main_group').html(result);

            }
        });
        var now = new Date();
        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
        //datatables
        table = $('#table').DataTable({
            "language": lan, 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,

            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-4'l><'col-sm-4  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            "buttons": [{
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'ledger_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: ':visible'
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        
                        $('c[r=A1] t', sheet).text(company + " - " + 'Ledger');
                        $('c[r=A2] t', sheet).text("");
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
                        columns: ':visible',
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        
                        doc.content.splice(0, 1);
                        doc.content[0].text = "";
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
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('accounts_master/Ledger/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.main_group = $('#main_group').val();

                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }
            ]

        });

        // EDIT: Capture enter press as well

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table

        });
    });

</script>  