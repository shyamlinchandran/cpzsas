<?php 
	if($led_type=='cus'){
		$report_header  = 'Ledger Balance Report Customer';
		$file_header=  'Ledger_Balance_Report_Customer';
	}else{
		$report_header  = 'Ledger Balance Report Supplier';
		$file_header = 'Ledger_Balance_Report_Supplier';
	}
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">

                <div class="box-header">
                    <h3 class="box-title"><?php echo $title;?></h3>
                </div>
				<input type="hidden" name="report_header" id="report_header" value="<?php echo $report_header;?>"/>
				<input type="hidden" name="file_header" id="file_header" value="<?php echo $file_header;?>"/>
				<input type="hidden" name="led_type" id="led_type" value="<?php echo $led_type;?>"/>
				<input type="hidden" name="type" id="type" value="<?php echo $led_type;?>"/>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    End Date
                                    <input type="text" class="form-control date" id="date" />
                                </td>
                                
                                <td class="col-sm-2">
                                    <?= label('Area', $this, $user) ?>  
                                    <select  id="area"  name="area" class="clsarea form-control">
										<option value="">Select</option> 
									</select>
                                </td>

                                <td class="col-sm-2">
									<?= label('Balance Type', $this, $user) ?>  
                                    <select  id="bal_type"  name="bal_type" class="clsarea form-control">
										<option value="">All</option> 
										<option value="with">With Balance</option> 
									</select>
                                </td>
                                <td class="col-sm-2">
									<?= label('Route', $this, $user) ?>
									<select id="route" name="route" class="form-control" name="chrq_status">
									</select>     
                                </td>
                                <td class="">
                                  <?= label('Customer Type', $this, $user) ?>
                                    <select name="customer_type" id="customer_type" class="form-control">
                                        
                                        </select>   
									
                                </td>
                                <td class="col-sm-2">
									<br />
                                    <input type="button" class="btn btn-success" id="btn-filter" value="Search" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <table id="table" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Route</th>
                                <th>Area</th>
                                <th>Phone/Code</th>
                                <th>Opening Balance</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Closing Balance</th>
                                <th>Submitted Check</th>                                
                        </thead>
                        <tbody>
                        </tbody>

                        <!-- <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:right">
                                    <h5><b>Total:</b></h5>
                                </th>
                                <th></th>
                            </tr>
                        </tfoot> -->


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
<?php $login_comid = $this->session->userdata('login_comid'); ?>
<script type="text/javascript">
	function showledger(toid, ledg) {
        var arr = [];
        var fromdate ='';
        var todate = $('#date').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            ledg: ledg,
            toid: toid
        });
        createCookie('<?php echo $login_comid?>ledger_cook', JSON.stringify(arr), 3);
        $("#last_click").attr('href', "<?= base_url() ?>reports/accounts/leadger?newpage=new");
        $("#last_click").click();
    }
    $.validate({
        modules: 'date, security,file'
    });
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    var table;
    var id = 0;
    var result = readCookie('supply_cook');
    console.log(JSON.parse(result));
    if (result != null) {
        results = JSON.parse(result);
        $.each(results, function(index, value) {
            $('#date').val(value.stdate);
            $('#type').val(value.type);
        });
    }

    $('#date').change(function() {
        var arr = [];
        var fromdate = $('#date').val();
        var type = $('#type').val();
        arr.push({
            stdate: fromdate,
            type: type,
        });
        createCookie('supply_cook', JSON.stringify(arr), 3);

    });

    $('#type').change(function() {
        var arr = [];
        var fromdate = $('#date').val();
        var type = $('#type').val();
        arr.push({
            stdate: fromdate,
            type: type,

        });
        createCookie('supply_cook', JSON.stringify(arr), 3);
    });


    $(document).ready(function() {
        $.ajax({
				url: "<?php echo site_url('ajaxcall/customer_type'); ?>",
				success: function(result) {
					$('#customer_type').html(result);
				}
			});
		var file_header =$('#file_header').val();
		var report_header=$('#report_header').val();
		$.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area').html(result);
               
            }
        });
		$.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/route'); ?>",
            success: function (result) {
                $('#route').html(result);
               
            }
        });
        function ms() {
            if (id === 1) {
                table.destroy();
            }
            id = 1;
            table = $('#table').DataTable({
                "language": lan,
                "paging": true,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "scrollX": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "buttons": [{
                        extend: 'excelHtml5',
                        className: 'btn bg-navy',
                        filename: file_header+'-' + jsDate,
                        text: '<i class="fa fa-file-excel-o"></i>',
                        messageTop: "Printed Date-  " + jsDate,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,7,8]
                        },
                        titleAttr: 'Excel',
                        action: newexportaction,
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            var godownr = $("#item_godown option:selected").text();
                            var reportdate = $("#date").val();
                            var type = $("#type option:selected").text();
                            var categoryr = $("#category option:selected").text();
                            $('c[r=A1] t', sheet).text(company + " - " + report_header);
                            $('c[r=A2] t', sheet).text("Date: " + reportdate + " Type: " + type);
                        }
                    },
                    {
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        extend: 'pdfHtml5',
                        title: "dsads",
                        className: 'btn bg-olive',
                        filename: file_header + '-' + jsDate,
                        messageTop: "Printed Date-  " + jsDate,
                        pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                        action: newexportaction,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,7,8],
                            search: 'applied',
                            order: 'applied'
                        },
                        customize: function(doc) {
                            //Remove the title created by datatTables

                            doc.content.splice(0, 1);
                            var reportdate = $("#date").val();
                            var godownr = $("#item_godown option:selected").text();
                            var categoryr = $("#category option:selected").text();
                            var type = $("#type option:selected").text();
                            doc.content[0].text = "Date: " + reportdate + " Type: " + type;
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
                                        text: company + " - " + report_header,
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
                    "url": "<?php echo site_url('reports/Ledger_balance/ajax_list') ?>",
                    "async" : false,
                    "type": "POST",
                    "data": function(data) {
                        data.date = $("#date").val();
                        data.type = $("#led_type").val();
                        data.customer_type = $("#customer_type").val();
						data.area = $('#area').val();
						data.route = $('#route').val();
						data.bal_type = $('#bal_type').val();
                    },
                    "dataSrc": function(data) {
                        recordsTotal = data.recordsTotal;
                        totalAmount = data.total
                        return data.data;
                    }
                },
                // drawCallback: function(settings) {
                //     var api = this.api();

                //     $(api.column(1).footer()).html(
                //         'Total Amount: ' + totalAmount
                //     );
                // },

                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

            });

        }
        ms();
        $('#btn-filter').click(function() { //button filter event click

            ms();
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });

    });
</script>