<?php
$add_url = site_url('pos/Main/listall');
$titles = 'POS Register';
if ($type == 'estimate') {
	$titles = "Sales Order";
}
		$tmp = $this->session->userdata('user');
        $utype = $tmp['utype'];
        $userid = $tmp['Id'];
?>

<style>
	.box-title {
		text-transform: capitalize;
	}

	@media(max-width:767px) {
		input[type=checkbox] {
			margin-left: 20px;
			display: none;
		}

		.dt-buttons {
			padding-top: 20px;
		}

		.table>tbody>tr>td:first-child {
			padding-right: 8px;
			text-align: right;
		}
	}
</style>
<div class="modal fade" id="LocationModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-map">
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myAssignModal">
	<form id="frmcreate" back="<?php echo site_url('crm_general/Enquiry_register/list_all'); ?>" action="<?php echo site_url('crm_general/Enquiry_register/save_closure'); ?>" home="<?php echo site_url('main/members/index'); ?>">
		<a style="display: none;" tp="new" target="_blank" id="doc_download" href="<?php echo site_url('uploads/SalesHSn.xls'); ?>"></a>

		<input type="hidden" id="invoice_id" name="invoice_id">
		<input type="hidden" value="" name="isbulk" id="isbulk" />
		<input type="hidden" value="<?php echo $titles; ?>" name="titles" id="titles" />
		<input type="hidden" value="<?php echo $type; ?>" id="invoice_type" name="invoice_type">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"> <?= label('Assign Sales Order', $this, $user) ?><span id="spninvoice"></span></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="">
						<table id="items" class="table table-bordered">

						</table>
					</div>
					<div class="">
						<?= label('Sales Man', $this, $user) ?>
						<select id="mdlsalesman" name="mdlsalesman" class="form-control">
							<option value="">Select</option>
						</select>
					</div>

					<div class="modal-footer">
						<button id="close_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" id="assign_btn" class="btn btn-primary">Save
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="<?= $this->box_color ?>">

				<div class="box-header">
					<h3 class="box-title"><?= label(ucwords(str_replace('_', ' ', $titles)), $this, $user) ?></h3>
					<span class="pull-right">
						<a style="display:none" href="#" type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" id="bulk_delete">Delete</a>
						<a style="display:none" href="" id="delete_bulk" data-toggle="tooltip" title="Print" class="btn btn-primary"></a>
						<a style="display:none" tp="pdf" href="" id="print_bulk" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>
						<a role="button" ata-toggle="tooltip" style="float: left" title="Add More" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
							<span class="glyphicon glyphicon-plus"></span>
							<!--tp="popup"  -->
						</a> &nbsp;
						<?php if ($type == 'estimate') { ?><a type="button" data-toggle="tooltip" title="Assign" class="btn btn-warning" id="bulk_assign">Assign</a><?php } ?>
						&nbsp; <a tp="pdf" target="_blank" target="_blank" type="button" data-toggle="tooltip" title="print" class="btn btn-primary" id="bulk_print">Print</a>

					</span>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row border">
						<div class="col-sm-2 col-xs-6">
							<?= label('Start Date', $this, $user) ?>
							<input type="text" class="form-control date" id="startdate" />
						</div>
						<div class="col-sm-2 col-xs-6">
							<?= label('End Date', $this, $user) ?>
							<input type="text" class="form-control date" id="enddate" />
						</div>
						
						<div class="col-sm-2 col-xs-6">
							<?= label('Bill Type', $this, $user) ?>
							<select class="form-control" id="btype" name="btype" value="0">
								<?php foreach($billtypes as $item){?>
									<option value="<?php echo $item['id'];?>"><?php echo $item['type'];?></option>
								<?php }?>
							</select>

						</div>
						<?php if ($type == 'estimate') { ?>
							<div class="col-sm-2 col-xs-6">
								<?= label('Status', $this, $user) ?>
								<select class="form-control" id="order_tatus" name="order_tatus">
									<option value="pending">Pending</option>
									<option value="">All</option>
									<option value="completed">Completed</option>
								</select>
							</div>
						<?php } ?>
						<div class="col-sm-2 col-xs-6">
							<br />
							<input type="button" class="btn" style ="background-color:green;color:white;"  id="btn-filter" value="<?= label('Search', $this, $user) ?>" />
						</div> 
					</div>  
					<div table-responsive>
						<table id="table" class="display table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php if ($type == 'estimate' || $type != 'estimate') { ?><input style="" type="checkbox" class="selectall" name="check" value="0"><?php } ?> &nbsp; <?= label('SNo', $this, $user) ?></th>
									<th><?= label('Invoice No', $this, $user) ?></th>
									<th><?= label('Ref No', $this, $user) ?></th>
									<th><?= label('Invoice Date', $this, $user) ?></th>
									<th><?= label('Created Date', $this, $user) ?></th>
									<th><?= label('Customers', $this, $user) ?></th>
									<!--                                <th>Tax Amount</th>-->
									<th><?= label('Total Amount', $this, $user) ?></th>
									<!--   <th><?= label('Cash Status', $this, $user) ?></th>-->
									<th><?= label('Actions', $this, $user) ?></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
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
	$(document).on('click', '.excell_add', function() {
		sales_id = $(this).attr('sales_id');
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('reports/GST1Report/sales_hsn/') ?>" + sales_id,
			data: {},
			success: function(str) {},
		}).done(function(data) {

			jQuery('#doc_download')[0].click();

		});

	});


	var titles = $('#titles').val();
	$(document).on("click", ".location", function() {
		var latitude = $(this).attr('latitude');
		var longitude = $(this).attr('longitude');
		var src = 'https://maps.google.com/maps?q=' + latitude + ',' + longitude + '&hl=es&z=14&amp;output=embed';
		$('.modal-map').html('<iframe  width="550"  height="300"  frameborder="0"  scrolling="no"  marginheight="0"  marginwidth="0"  src="' + src + '" ></iframe>');
		$('#LocationModal').modal('show');
	});
	$(document).on("click", ".sale_edit", function() {
		$(this).attr('href', '#');
	});

	function showledger(toid, ledg) {
		var arr = [];
		//var fromdate = $('#startdate').val();
		//var todate = $('#enddate').val();
		arr.push({
			stdate: '',
			enddate: '',
			ledg: ledg,
			toid: toid
		});
		createCookie('<?php echo $login_comid ?>ledger_cook', JSON.stringify(arr), 3);
		$("#last_click").attr('href', "<?= base_url() ?>reports/accounts/leadger?newpage=new");
		$("#last_click").click();
	}
	$(document).on("click", ".assign", function() {
		$('#isbulk').val('');
		$('#myAssignModal').modal('show');
		var invoice_id = $(this).attr('assign_id');
		var assign_invoice = $(this).attr('assign_invoice');
		$('#invoice_id').val(invoice_id);
		$('#spninvoice').html(' ' + assign_invoice);
	});
	var table;
	$(document).ready(function() {

		

		titles = $('#titles').val();
		$('#startdate').val('');
		$('#enddate').val('');
	
		$('#bulk_assign').click(function() {
			var Is_valid = 0;
			$('input.enquiry:checkbox:checked').each(function() {
				Is_valid = 1;
			});
			if (Is_valid > 0) {
				$('#isbulk').val(1);
				$('#myAssignModal').modal('show');
			} else {
				toastr["error"]('Select Sales Order first');
			}
		});
		$('.selectall').click(function() {
			if ($(this).is(':checked')) {
				$('input:checkbox').prop('checked', true);
			} else {
				$('input:checkbox').prop('checked', false);
			}
		});
		$('#bulk_delete').click(function() {
			var text = '';
			$('input.enquiry:checkbox:checked').each(function() {
				if (text === "") {
					text = $(this).val();
				} else {
					text = text + '_' + $(this).val();
				}
			});
			if (text !== '') {
				$('#delete_bulk').attr('href', "<?php echo site_url('transaction/sales/delete_multiple/'); ?>" + text);
				$('#delete_bulk').trigger('click');
			}
		});
		$('#bulk_print').click(function() {
			var text = '';
			$('input.enquiry:checkbox:checked').each(function() {
				if (text === "") {
					text = $(this).val();
				} else {
					text = text + '_' + $(this).val();
				}
			});
			if (text !== '') {
				$('#print_bulk').attr('href', "<?php echo site_url('transaction/sales/bill_multiple/'); ?>" + text);
				$('#print_bulk').trigger('click');
			}
		});
		$('#assign_btn').click(function() {
			var mdlsalesman = $('#mdlsalesman').val();
			var isbulk = $('#isbulk').val();
			var text = '';
			if (isbulk !== "") {
				$('input.enquiry:checkbox:checked').each(function() {
					if (text === "") {
						text = $(this).val();
					} else {
						text = text + ',' + $(this).val();
					}
				});
			}
			if (mdlsalesman === "") {
				mdlsalesman = 0;
			}
			if (parseFloat(mdlsalesman) > 0) {
				var invoice_id = $('#invoice_id').val();
				$.ajax({
					url: "<?php echo site_url('transaction/sales/assign'); ?>/",
					type: "POST",
					data: {
						mdlsalesman: mdlsalesman,
						invoice_id: invoice_id,
						isbulk: isbulk,
						text: text
					},
					success: function(response) {
						table.ajax.reload(null, false);
						$('#close_btn').trigger('click');
					}
				});
			} else {
				$('#mdlsalesman').attr('style', 'border: 2px solid red;');
			}
		});
		$.ajax({
			url: "<?php echo site_url('ajaxcall/salesman'); ?>",
			success: function(result) {
				$('#mdlsalesman').html(result);
			}
		});

		var now = new Date();
		var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
		//datatables 
		table = $('#table').DataTable({
			"responsive": true,
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			//"columns": [
				//{ responsivePriority: 6 },
			//	{ responsivePriority: 5 },
			//	{ responsivePriority: 4 },
				//{ responsivePriority: 3 },
				//{ responsivePriority: 2 },
			//	{ responsivePriority: 1 }
		//	],
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, 'All']
			],
			'dom': "<'row'<'dimssearch col-xs-0 col-sm-7'l><'col-xs-5 col-sm-2  text-right 'B><'col-xs-5 col-sm-3 pull-right'f >>" +
				"<'row'<'col-xs-12'tr>>" +
				"<'row'<'col-sm-3  hidden-xs foot'><'col-sm-3 hidden-xs'i><'col-xs-12 col-sm-6 'p>>",
			"fnDrawCallback": function() {
				loadpermission();
			},
			columnDefs: [{
				targets: 1,
				className: 'noVis'
			}],
			"buttons": [{
					extend: 'colvis',
					className: 'btn bg-navy noVis',
					columns: ':not(.noVis)',
					text: '<i class="fa fa-file-excel-o"></i>',
				},
				{
					extend: 'excelHtml5',
					className: 'btn bg-navy',
					filename: titles + '_' + jsDate,
					text: '<i class="fa fa-file-excel-o"></i>',
					messageTop: "Printed Date-  " + jsDate,
					exportOptions: {
						columns: ':visible'
					},
					titleAttr: 'Excel',
					customize: function(xlsx) {
						var sheet = xlsx.xl.worksheets['sheet1.xml'];
						$('c[r=A1] t', sheet).text(company + " - " + titles);
						$('c[r=A2] t', sheet).text("Date from " + jsDate + " to " + jsDate);
					}
				},
				{
					text: '<i class="fa fa-file-pdf-o"></i>',
					extend: 'pdfHtml5',
					title: "dsads",
					className: 'btn bg-olive',
					filename: titles + '_' + jsDate,
					messageTop: "Printed Date-  " + jsDate,
					pageSize: 'A4', //A3 , A5 , A6 , legal , letter
					exportOptions: {
						columns: ':visible'
					},
					customize: function(doc) {
						//Remove the title created by datatTables

						doc.content.splice(0, 1);
						// doc.content[0].text = "Date from " + jsDate + " to " + jsDate;
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
									text: company + " - " + titles,
									fontSize: 14,
									margin: [10, 0]
								}],
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
				"url": "<?php echo site_url('pos/Main/pos_ajax_list') ?>",
				"type": "POST",
				"data": function(data) {
					// data.country = $('#country').val();
					data.type = '<?php echo $type ?>';
					data.supid = $('#supid').val();
					data.btype = $('#btype').val();
					data.status = $('#order_tatus').val();
					data.startdate = $('#startdate').val();
					data.enddate = $('#enddate').val();
				}
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [0], //first column / numbering column
				"orderable": false //set not orderable
			}]

		});
		$.ajax({
			url: "<?php echo site_url('ajaxcall/billtype/' . $type) ?>",
			async: false,
			success: function(result) {
				var data = '<?= label('Bill Type', $this, $user) ?> <select id="btype" name="btype" value="0"> ' +
					result;
				var invoice_type = $('#invoice_type').val();
				if (invoice_type === 'estimate') {
					data = data + ' </select>&nbsp;<?= label('Status', $this, $user) ?>&nbsp;&nbsp;<select id="order_tatus" name="order_tatus"><option value="">All</option><option value="pending">Pending</option><option value="completed">Completed</option></select>';
				}
				data = data + ' <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>';
				//$(".dimssearch").html(data);
				table.ajax.reload(null, false);
			}
		});

		var val = readCookie('search_<?= $type ?>');
		if (val !== null) {
			table.search(val).draw();
		}
		$('.dataTables_filter input').unbind().keyup(function() {
			var value = $(this).val();
			if (value.length > 2) {
				createCookie('search_<?= $type ?>', value, 3);
				table.search(value).draw();
			}
			if (value.length === 0) {
				eraseCookie('search_<?= $type ?>');
				table.search(value).draw();
			}
		});
		// EDIT: Capture enter press as well
		$('.excell_add').click(function(e) {
			var sales_id = $(this).attr('sales_id');
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url('reports/GST1Report/action/') ?>" + sales_id,
				data: {},
				success: function(str) {},
			}).done(function(data) {

				jQuery('#doc_download')[0].click();

			});

		});


		$('#btn-filter').click(function() { //button filter event click
			table.ajax.reload(null, false); //just reload table
			var arr = [];
			var btype = $('#btype').val();
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			arr.push({
				btype: btype,
				startdate: startdate,
				enddate: enddate
			});
			createCookie('<?php echo $login_comid ?>list_sales', JSON.stringify(arr), 3);
		});
		$('#btn-reset').click(function() { //button reset event click
			$('#form-filter')[0].reset();
			table.ajax.reload(null, false); //just reload table

		});
	});
</script>
 