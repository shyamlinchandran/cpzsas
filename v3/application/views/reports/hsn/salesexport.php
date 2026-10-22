<?php
$user = $this->session->userdata('user');
$utype = $user['utype'];
?>
<div class="modal fade" id="myFilterModal">
    <input type="hidden" id="closure_id" name="closure_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?= label('Apply Filter', $this, $user) ?></h4>
            </div>
            <div class="modal-body">

                <table class="table no-border" cellspacing="0" width="100%">
                    <tr>
						<td class="col-sm-2">
                            <?= label('Type', $this, $user) ?>  
									<select id="saletype" class="form-control" >
										<option value="sales">Sales</option>
										<option value="estimate">Sales Order</option>
										<option value="sales_return">Sales Return</option>
										<option value="delivery_note">Delivery Note</option>
									</select>
                        </td>
                        <td class="col-sm-2">
								<?= label('Sale Type', $this, $user) ?>
								<select id="salestype" name="salestype" class="form-control" >
								<option value="" >all</Option>
								<option value="b2c" >B2C</Option>
								<option value="b2b" >B2B</Option>
								</select>      
                        </td>
						 <td class="col-sm-2">
                             
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
                <input type="hidden" value="<?php echo $utype; ?>" id="utype" name="utype"/> 
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

                                <td class="col-sm-1">
                                    <?= label('Start Date', $this, $user) ?>
                                    <input type="text" class="form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-1">
                                    <?= label('End Date', $this, $user) ?>  
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                               
                                 <td class="col-sm-2">
                                    <?= label('Hsn Code', $this, $user) ?>  
                                    <input type="hidden" class="form-control" id="hsnid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="hsn"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Customer', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="customer_id" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
							  <td class="col-sm-1">
									<?= label('Invoice', $this, $user) ?>
									<input type = "hidden" value =""  name = "sales_id" id ="sales_id"/>
									<input type ="text" name ="invoice" id= "invoice" noTab = true />    
                                    

							  </td>
							 
						 <td class="col-sm-2">
									
                                    <?= label('Bill Type', $this, $user) ?> 
                                    <select class="form-control" id="btype" name="btype" value="0"> 
                                        <option value="">Select</option>
                                    </select>

                                </td>
							  <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                    <input type="button" class="btn btn-success" id="btn-reset"  value="<?= label('Clear', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Invoice', $this, $user) ?></th>
                                <th><?= label('Invoice Date', $this, $user) ?></th>
                                <th><?= label('Voucher Type Name', $this, $user) ?></th>
                                <th><?= label('Customer Name', $this, $user) ?></th>
                                <th><?= label('Gstin', $this, $user) ?></th>
                                <th><?= label('Item Name', $this, $user) ?></th>
                                <th><?= label('Hsncode', $this, $user) ?></th>
                                <th><?= label('Sales Ledger', $this, $user) ?></th>
                                <th><?= label('Total Quantity', $this, $user) ?></th>
                                <th><?= label('Rate', $this, $user) ?></th>
                                <th><?= label('Amount', $this, $user) ?></th>
								<th><?= label('CGST', $this, $user) ?></th>
                                <th><?= label('SGST', $this, $user) ?></th>
                                <th><?= label('IGST', $this, $user) ?></th>
                                <th><?= label('1% Kerala Flood Cess', $this, $user) ?></th>
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
<?php $login_comid = $this->session->userdata('login_comid'); ?>

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
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "paging": true,
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                    extend: 'print',
                    text: '<i class="glyphicon glyphicon-print"></i>',
                    className: 'btn btn-primary', 
                    title:  getheader("<?= label($title, $this, $user) ?>"),
                    footer: true,
                   // autoPrint: false,
                    //  messageTop: '<div class="col-12 text-right">This print was produced using the Print button for DataTables</div>',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt !important');
                        $(win.document.body).css('margin', '13px');
                        $(win.document.body).find('table').addClass('display').css('font-size', '13px');
                        $(win.document.body).find('table').next("div").html(" <hr /><br/><div class='col-12 col-md-12 text-right' >Printed Date : <?php echo date("d-m-Y")  ?></div>");
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'sales_report_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: ':visible'
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var btype = $("#btype option:selected").text();
                        var reference = $("#reference option:selected").text();
                        var salesman = $("#salesman option:selected").text();
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var cashtype = $('#chrq_status').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Sales HSN Report');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " " + cashtype + " Bill type :" + btype + " Ledger :" + ledgername);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'sales_HSN_report_' + jsDate,
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

                        var btype = $("#btype option:selected").text();
                        var reference = $("#reference option:selected").text();
                        var salesman = $("#salesman option:selected").text();
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var cashtype = $('#chrq_status').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " " + cashtype + " Bill type :" + btype + " Ledger :" + ledgername;
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
                                        text: company + " - " + 'Sales HSN Report',
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
                "url": "<?php echo site_url('reports/Hsn/sales_export_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.supname = $("#supname").val();
                    data.customer_id = $("#supid").val();
                    data.type = $("#chrq_status").val();
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.saletype = $('#saletype').val();
                    data.salestype = $('#salestype').val();
                    data.btype = $('#btype').val();
                    data.branch = $('#branch').val();
					data.reference = $('#reference').val();
					data.salesman = $('#salesman').val();
					data.user = $('#user').val();
					data.hsnid = $('#hsnid').val();
					data.sales_id = $('#sales_id').val();
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
            url: "<?php echo site_url('ajaxcall/branch') ?>",
            async: false,
            success: function (result) {
                $('#branch').html(result);
			
            }
        });
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/sales') ?>",
            async: false,
            success: function (result) {
                $('#btype').html('<option value="">All</option>'+result);
			
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
		
		$('#clos_btn').click(function() { //button filter event click
             table.ajax.reload(null, false); //just reload table
             $('#myClosureModal').modal('hide');
         });
		$.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
                
								$('#user').html(result);
               
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/reference'); ?>",
            success: function (result) {
                $('#reference').html(result.replace('Select', 'All'));

            }
        });

      $("#invoice").autocomplete({
            source: "<?php echo base_url(); ?>reports/Hsn/getinvoice", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#sales_id").val(ui.item.sales_id);
                $("#btn-filter").focus();
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
        function loadCust(ui) {
            $('#supname').val(ui.item.name);
            $('#supid').val(ui.item.id);
        }
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);

            }
        });
        $('#btn-filter').click(function () { //button filter event click

            ms();
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
			$('#invoice').val('');
			$('#sales_id').val('');
			$('#supid').val('');
			$('#supname').val('');
			$('#hsnid').val('');
			$('#hsn').val('');
           ms();
        });

    });
</script>
