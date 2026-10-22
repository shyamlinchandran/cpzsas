<?php 
?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
					<input type="hidden" id="report_header" value="<?php echo $title;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
					<span class="pull-right"> 

                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
								 <td class="col-sm-2">
                                     <?= label('Voucher', $this, $user) ?> 
									  <select name="voucher" id="voucher" class="form-control"> 
										<option value="sales">Sales</option>
										<option value="sales_return">Sales Return</option>
										<option value="sales_order">Sales Order</option>
										<option value="purchase">Purchase</option>
										<option value="purchase_return">Purchase Return</option>
										<option value="purchase_order">Purchase Order</option>
										<option value="rec">Receipt</option>
										<option value="pay">Payment</option>
										<option value="cash">Cash</option>
										<option value="customer">Customer</option>
										<option value="supplier">Supplier</option>
									  </select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Year', $this, $user) ?> 
                                    <select name="year_start" id="year_start" class="form-control"> 
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
									</select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Month', $this, $user) ?>
                                    <select id="month_start"  class="form-control" name="month_start">
                                        <option value="01">Jan</option>
										<option value="02">Feb</option>
										<option value="03">Mar</option>
										<option value="04">Apr</option>
										<option value="05">May</option>
										<option value="06">Jun</option>
										<option value="07">Jul</option>
										<option value="08">Aug</option>
										<option value="09">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Year', $this, $user) ?> 
                                    <select name="year_end" id="year_end" class="form-control"> 
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
									</select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Month', $this, $user) ?>
                                    <select id="month_end"  class="form-control" name="month_end">
                                         <option value="01">Jan</option>
										<option value="02">Feb</option>
										<option value="03">Mar</option>
										<option value="04">Apr</option>
										<option value="05">May</option>
										<option value="06">Jun</option>
										<option value="07">Jul</option>
										<option value="08">Aug</option>
										<option value="09">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
                                    </select>      
                                </td>
                               
								<td class="col-sm-2">
                                   
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>  
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th id="th1"><?= label('Month', $this, $user) ?></th>
                                <th id="th2"><?= label('Total', $this, $user) ?></th>
                                <th id="th3"><?= label('Cash', $this, $user) ?></th>
                                <th id="th4" ><?= label('Bank', $this, $user) ?></th>
                                <th id="th5"><?= label('Credit', $this, $user) ?></th>
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
	function loadreport(btn){
		var type = $(btn).attr('tagtype');
		var start_date = $(btn).attr('start_date');
		var end_date = $(btn).attr('end_date');
		if(type === 'payment' || type === 'receipt'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            var toid = '';
            var paytype = '';
            arr.push({
                stdate: fromdate,
                enddate: todate,
                toid: toid,
                paytype: paytype,
            });
            createCookie('<?php echo $login_comid; ?>'+type+'report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>transaction/vouchers/list_all/"+type+"?newpage=new");
			$("#last_click").click();
		}
		if(type === 'purchase'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            var btype = '';
            var chrq_status = '';
            arr.push({
                stdate: fromdate,
                enddate: todate,
                btype: btype,
                chrq_status: chrq_status,
            });
            createCookie('<?php echo $login_comid; ?>purchase_purchase_report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/purchase/purchasereport?newpage=new");
			$("#last_click").click();
		}
		if(type === 'order'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            var btype = '';
            var chrq_status = '';
            arr.push({
                stdate: fromdate,
                enddate: todate,
                btype: btype,
                chrq_status: chrq_status,
            });
            createCookie('<?php echo $login_comid; ?>order_purchase_report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/purchase/purchaseorder?newpage=new");
			$("#last_click").click();
		}
		if(type === 'purchase_return'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            var btype = '';
            var chrq_status = '';
            arr.push({
                stdate: fromdate,
                enddate: todate,
                btype: btype,
                chrq_status: chrq_status,
            });
            createCookie('<?php echo $login_comid; ?>purchase_return_purchase_report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/purchase/purchasereturn?newpage=new");
			$("#last_click").click();
		}
		if(type == 'sales_return'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            var btype = '';
            var chrq_status = '';
            arr.push({
                stdate: fromdate,
                enddate: todate,
                btype: btype,
                chrq_status: chrq_status,
            });
            createCookie('<?php echo $login_comid ?>sales_return_sale_report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/salesreturn?newpage=new");
			$("#last_click").click();
		}
		if(type == 'estimate'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            var btype = '';
            var chrq_status = '';
            arr.push({
                stdate: fromdate,
                enddate: todate,
                btype: btype,
                chrq_status: chrq_status,
            });
            createCookie('<?php echo $login_comid ?>estimate_sale_report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/saleorder?newpage=new");
			$("#last_click").click();
		}
		if(type === 'sales'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            var btype = '';
            var chrq_status = '';
            arr.push({
                stdate: fromdate,
                enddate: todate,
                btype: btype,
                chrq_status: chrq_status,
            });
            createCookie('<?php echo $login_comid ?>sales_report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/salesreport?newpage=new");
			$("#last_click").click();
		}
		if(type == '25' || type == '24'){
			var arr = [];
            var fromdate = start_date;
            var todate = end_date;
            arr.push({
                stdate: fromdate,
                enddate: todate
            });
            createCookie('<?php echo $login_comid ?>_'+type+'_ledger_transaction_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/Ledger_balance/Ledger_transaction/" +type +"/?newpage=new");
			$("#last_click").click();
		}
		
		if(type === "4"){
			var arr = [];
			var fromdate = start_date;
            var todate = end_date;
			arr.push({
				stdate: fromdate,
				enddate: todate,

			});
			createCookie('cash_book', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>reports/accounts/cashbook?newpage=new");
			$("#last_click").click();
		}
	}
	var visible = '[]';
	function showstockledeger(btn){
		var name = $(btn).attr('name');
		var toid = $(btn).attr('id');
		var arr = [];
		var result = readCookie('<?php echo $login_comid ?>stock_ledger_cook');
		var enddate = $('#enddate').val();
		var startdate = '';
		arr.push({
			startdate: startdate,
			enddate: enddate,
			name: name,
			toid: toid,
			});
		createCookie('<?php echo $login_comid ?>stock_ledger_cook', JSON.stringify(arr), 3);
		$("#last_click").attr('href', "<?= base_url() ?>reports/stock/leadger?newpage=new");
        $("#last_click").click();
	}
	var txt = '';
	$(document).on("click", "#set_filter", function() {
		
		var l =0;
		//$('#table > thead > tr > th').each(function(){
			//txt = txt + '<div style="margin-bottom:30px;" class="col-sm-4"><input type="checkbox" id="vis" name="vis[]" value="'+l+'">  '+$(this).text()+'</div>';
			//l++;
			//$('#div_vis').html(txt);
		//});
        $('#myset_FilterModal').modal('show');
    });
	$(document).on("click", "#set_btn", function() {//button filter event click
		var form_data = $('#frmvisible').serialize(); 
		var post_url = $('#frmvisible').attr("action"); //get form action url
		var request_method = $('#frmvisible').attr("method"); //get form GET/POST method
		$.ajax({
			url: post_url,
			type: "POST",
			async:false,
			data: form_data,
			success: function(result) {
				txtt = result;
				txtt= JSON.parse(txtt);
				location.reload(true);
			}
		});
         $('#myset_ClosureModal').modal('hide');
    });
	
	var hr = '';	
	var txtt = [];
    var id = 0;
    var table;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    $(document).ready(function () {
	$('#voucher').change(function(){
			
	});
		var txt_doc = '';
		l = 0 ;
		$('#table > thead > tr > th').each(function(){
			txt = txt + '<div style="margin-bottom:30px;" class="col-sm-4"><input type="checkbox" id="vis" name="vis[]" value="'+l+'">  '+$(this).text()+'</div>';
			l++;
			$('#div_vis').html(txt);
		});
	
		hr = $(location).attr('href');
		hr = hr.replace('?newpage=new', '');
		var url = '<?php echo base_url();?>';
		hr = hr.replace(url, '');
		$('#save_url').val(hr);
		$.ajax({
			url: "<?php echo site_url('ajaxcall/get_visible'); ?>",
			type: "POST",
			async:false,
			data: {
				hr:hr
			},
			success: function(result) {
				txtt = result;
				txtt= JSON.parse(txtt);
				
			}
		});
	
        //datatables
        function ms()
        {
            if (id === 1) {
                table.destroy();
            }
            id = 1;
            table = $('#table').DataTable({
                "paging": true,
                "language": lan, "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "lengthMenu": [[10, 25, 50, 100, 250], [10, 25, 50, 100, 250]],
                'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
						
				columnDefs:visible,
                "buttons": [ {
						extend: 'colvis',
						className: 'btn bg-navy noVis',
						columns: ':not(.noVis)',
						text: '<i class="fa fa-file-excel-o"></i>',
					},
],
                "order": [], //Initial no order.            
                // Load data for the table's content from an Ajax source
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        className: 'btn bg-navy',
                        filename: $('#file_header').val()+'_' +  jsDate,
                        text: '<i class="fa fa-file-excel-o"></i>',
                        messageTop: "Printed Date-  " + jsDate,
                       exportOptions: {
							columns: ':visible'
						},
                        titleAttr: 'Excel',
                        action: newexportaction,
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            var todate = $('#enddate').val();
                            var hsn = $('#hsn').val();
                            var godownr = $("#item_godown option:selected").text();
                            var category = $("#category option:selected").text();
                            var tax = $("#tax option:selected").text();
                            $('c[r=A1] t', sheet).text(company + " - " + $('#report_header').val());
                            $('c[r=A2] t', sheet).text("End date : " + todate + " , Godown :" + godownr + " , hsn :" + hsn + " , Category :" + category + " , Tax :" + tax);
                        }
                    },
                    {
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        extend: 'pdfHtml5',
                        title: "dsads",
                        className: 'btn bg-olive',
                        filename: $('#file_header').val()+'_' + jsDate,
                        messageTop: "Printed Date-  " + jsDate,
                        pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                        action: newexportaction,
                       exportOptions: {
							columns: ':visible'
						},
                        customize: function (doc) {
                            //Remove the title created by datatTables
                            var todate = $('#enddate').val();
                            var hsn = $('#hsn').val();
                            var godownr = $("#item_godown option:selected").text();
                            var category = $("#category option:selected").text();
                            var tax = $("#tax option:selected").text();
                            doc.content.splice(0, 1);
                            doc.content[0].text = "End date  " + todate + " , Godown : " + godownr + " , Hsn : " + hsn + " , Category : " + category + " TAx : " + tax;
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
                                            text: company + " - " + $('#report_header').val(),
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
                "ajax": {
                    "url": "<?php echo site_url('reports/MIS/monthly_list') ?>",
                    "type": "POST",
                    "data": function (data) {
                        data.voucher = $("#voucher").val();
		                data.year_start = $('#year_start').val();
                        data.month_start = $("#month_start").val();
                        data.year_end = $("#year_end").val();
                        data.month_end = $("#month_end").val();
                    }
                },
                //Set column definition initialisation properties.
                
            });
        }
        $('#btn-filter').click(function () { //button filter event click
			if(  $('#voucher').val() === 'sales' || $('#voucher').val() === 'sales_return' || $('#voucher').val() === 'purchase' || $('#voucher').val() === 'purchase_return' ){
				$('#th3').html('Cash');
				$('#th4').html('Bank');
				$('#th5').html('Credit');
				visible = [];
			}
			if( $('#voucher').val() === 'sales_order' || $('#voucher').val() === 'purchase_order' ){
				$('#th3').html('Cash');
				$('#th4').html('Bank');
				$('#th5').html('Credit');
				visible = 	[{"targets": 3 , "visible": false },{"targets": 4 , "visible": false },{"targets": 5 , "visible": false }];
			}
			
			if($('#voucher').val() === 'pay' || $('#voucher').val() === 'rec'){
				$('#th3').html('Cash');
				$('#th4').html('Bank');
				$('#th5').html('Nil');
				visible = 	[{"targets": 5 , "visible": false }];
			}
			
			if($('#voucher').val() === 'cash' || $('#voucher').val() === 'customer' || $('#voucher').val() === 'supplier'){
				$('#th3').html('Credit');
				$('#th4').html('Debit');
				$('#th5').html('Balance');
				visible = 	[{"targets": 2 , "visible": false }];
			}
            ms();
            table.ajax.reload(null, false);  //just reload table
            // clear();
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });
    });
</script>  
