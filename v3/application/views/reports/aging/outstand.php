<div class="modal fade" id="myFilterModal">
    <input type="hidden" id="closure_id" name="closure_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?= label('Apply Filter', $this, $user) ?></h4>
            </div>
            <div class="modal-body">
					<input type="hidden" value="" id="head_text" /> 
                <table class="table no-border" cellspacing="0" width="100%">
                    <tr>
						
						<td class="col-sm-4">
                            Reference <br />
                            <select  id="reference"  name="reference" class="form-control" >
                                <option value="">Select</option> 
							</select>    
                        </td>
                        <td class="col-sm-4">
                            Sales man<br />
                            <select  id="salesman"  name="SalesMan" class="form-control">
                                <option value="">Select</option> 
                            </select>
                        </td>
						 <td class="col-sm-4">
                            <?= label('User', $this, $user) ?>
							<select id="user" name="user" class="form-control" name="chrq_status">
							</select>     
                        </td>
                        </tr>
                        <tr>
                        <td   class="col-sm-4">
                            <?= label('Area', $this, $user) ?>
                            <select id="area" name="area" class="form-control" name="chrq_status">
                            </select>      
                        </td>
						<td  class="col-sm-4">
                            <?= label('Route', $this, $user) ?>
                            <select id="route" name="route" class="form-control" name="chrq_status">
                            </select>      
                        </td>
						
					</tr>
			
					

                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="clos_btn"  data-dismiss="modal" class="btn btn-primary">Filter
                    </button>
                </div>
				</div>
        </div>
    </div>
</div>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
					<span class="pull-right"> 
						<a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>
					</span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
								<td class="col-sm-2">
                                    <?= label('Date Filter By', $this, $user) ?> 
                                    <select  class="form-control " id="filter_by">
										<option value = "invoice_date">Invoice Date</option>
										<option value = "date">Due Date</option>
									</select>
                                </td>
								<td class="col-sm-1">
                                    <?= label('Start Date', $this, $user) ?> 
                                    <input type="text" class="form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-1">
                                    <?= label('End Date', $this, $user) ?>  
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                                <td class="col-sm-1">
                                    Type
                                    <select id="ledtype"  class="form-control" name="ledtype">
                                        <option value=""><?= label('Select', $this, $user) ?></option>
                                        <option value="cus"><?= label('Customer', $this, $user) ?></option>
                                        <option value="sup"><?= label('Supplier', $this, $user) ?></option>
                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Ledger', $this, $user) ?>
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
								
                            
								 <td class="col-sm-2">
                                    <?= label('Bill Type', $this, $user) ?>
                                    <select tabindex="-1" id="btype" name="btype" class="form-control " >                                            
                                    </select>
                                </td>
								
								<td class="col-sm-2">
									<?= label('Branch', $this, $user) ?>
									<select id="branch" name="branch" class="form-control" >
									</select>      
								</td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('Ledger', $this, $user) ?></th> 
                                <th><?= label('Invoice', $this, $user) ?></th> 
                                <th> <?= label('Date', $this, $user) ?></th>      
                                  <th> <?= label('Route', $this, $user) ?></th>             
                                                  <th> <?= label('Area', $this, $user) ?></th>                           
                                <th><?= label('Debit', $this, $user) ?></th>   
                                <th><?= label('Return Amount', $this, $user) ?></th>                                    
                                <th><?= label('Credit', $this, $user) ?></th>  
                                <th><?= label('Balance', $this, $user) ?></th>  
                                <th><?= label('Outstanding Days', $this, $user) ?> </th>   
								<th><?= label('Due Date', $this, $user) ?></th>  
                                <th><?= label('Due  Days', $this, $user) ?> </th>  
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
	$(document).on("click", "#filter", function() {
        $('#myFilterModal').modal('show');
    });
	
    $.validate({
        modules: 'date, security,file'
    });
    var table;
    var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    function clear() {
        $('#toid').val('');

    }
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
            "lengthMenu": [[ 100, -1], [ 100, 'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'aging_report_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10,11]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#name').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Aging Report');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " Ledger :" + ledgername);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'aging_report_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10,11],
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
                                        text: company + " - " + 'Aging Report',
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
                "url": "<?php echo site_url('reports/aeging/outstanding_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.toid = $('#toid').val();
                    data.ledtype = $('#ledtype').val();
					data.salesman = $('#salesman').val();
                    data.reference = $('#reference').val();
					data.user = $('#user').val();
                    data.btype = $('#btype').val();
					data.branch = $('#branch').val();
					data.filter_by = $('#filter_by').val();
                    data.area = $('#area').val();
					data.route = $('#route').val();
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
        $.ajax({
			url: "<?php echo site_url('ajaxcall/area'); ?>",
			success: function (result) {
				$('#area').html(result);
			}
		});
        $.ajax({
			url: "<?php echo site_url('ajaxcall/route'); ?>",
			success: function (result) {
				$('#route').html(result);
			}
		});
		$('#clos_btn').click(function() { //button filter event click
             ms();//just reload table
             $('#myClosureModal').modal('hide');
         });
		$.ajax({
			url: "<?php echo site_url('ajaxcall/reference'); ?>",
			success: function (result) {
				$('#reference').html(result);

			}
		});
		$.ajax({
			url: "<?php echo site_url('ajaxcall/salesman'); ?>",
			success: function (result) {
				$('#salesman').html(result);
				$('#user').html(result);
			}
		});
		$.ajax({
			url: "<?php echo site_url('ajaxcall/branch'); ?>",
			success: function (result) {
				$('#branch').html(result);
			}
		});
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
		$.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/sales'); ?>",
            success: function (result) {
                $('#btype').html(result);
				$.ajax({
					url: "<?php echo site_url('ajaxcall/billtype/purchase'); ?>",
					success: function (result) {
						$('#btype').prepend(result);
						$("#btype").prepend('<option value="" selected>' + "All" + '</option>');
					}
				});
            }
        });
        $('#btn-filter').click(function () {
            ms();
            table.ajax.reload(null, false);  //just reload table
            clear();
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
</script>
