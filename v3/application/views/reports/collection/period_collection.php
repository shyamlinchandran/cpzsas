<style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }
</style>
<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/Quick_voucher/listall'); ?>" action="<?php echo site_url('transaction/Quick_voucher/save'); ?>"  class="form-horizontal">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border no-print">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        
                    <div class="box-body" id="printdiv"> 
                        <div class="col-sm-12 no-print">  

                            <div class="col-sm-2">  
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label  class=" control-label"><?= label('Start Date', $this, $user) ?> * :</label><br />
                                        <input class="form-control date" id="start_date" name="start_date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />

                                    </div>
                                    
                                </div>
                            </div>
							<div class="col-sm-2">  
                                <div class="form-group">
                                    <div class="col-sm-12">
										<label  class="control-label"><?= label('End Date', $this, $user) ?> * :</label><br />
                                        <input class="form-control date" id="end_date" name="end_date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />

                                    </div>
                                    
                                </div>
                            </div>
							<div class="col-sm-3">  
                                <div class="form-group">
                                    <div class="col-sm-12">
										<label  class="control-label"><?= label('Salesman', $this, $user) ?> * :</label><br />
										<select id = "salesman" class = " form-control"  >
										</select>
                                    </div>
                                    
                                </div>
                            </div>
							
							<div class="col-sm-3">  
                                <div class="form-group">
                                    <div class="col-sm-12">
										<label  class="control-label"><?= label('User', $this, $user) ?> * :</label><br />
										<select id = "user" class = " form-control"  >
										</select>

                                    </div>
                                    
                                </div>
                            </div>
							
							<div class="col-sm-1">  
                                <div class="form-group">
                                    <div class="col-sm-12">
										<br />
										<input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>

                                    </div>
                                    
                                </div>
                            </div>
							
							<div class="col-sm-1">
									<br />
                                       <input type="button" class="btn btn-success" value="Print" id="print"/>
                                    </div>
                           
                        </div> 
                        <div style = "width:100% !important;" id = "pdiv" class="col-sm-12">  
						<style>
							th, td {
								border-style:solid;
								border-color: #96D4D4;
							}
							.maintd{
								border-right: none;
							}
							
						</style>
                            <table style = "border: 1px solid black; border-collapse: collapse;width:100% !important;" id="quicktable" class="table">
								<tr>
									<th colspan = "8" style = "text-align:center" id = "cheader"  ><b>Collection</b></th>
								</tr>
								<tr>
									<th colspan = "8" ><b>Sales</b></th>
								</tr>
								<tr>
									<td class = "maintd"  style = "text-align:center" colspan = "2" style = "width:20%" ><button style = "padding:0px;padding-right:5px;" transaction = "#cashsales_body"  status="inactive" type="button" class="btncashsales btnshowdetails no-print btn btn-box-tool"><i class="fa fa-plus"></i></button>Cash : </td>
									<td style = "width:15%"></td>
									<td style = "width:20%"></td>
									<td style = "width:15%"></td>
									<td style = "width:15%"><span class = "pull-right" style = "text-align:right" id = "cashsales" >0.00</span></td>
									<td style = "width:10%" ></td>
								</tr>
								<tbody id = "cashsales_body" style = "display:none">
								</tbody>
								<tr>
									<td class = "maintd" style = "text-align:center" colspan = "2" style = "width:15%"><button style = "padding:0px;padding-right:5px;" transaction = "#banksales_body"  status="inactive" type="button" class="btnbanksales btnshowdetails no-print btn btn-box-tool"><i class="fa fa-plus"></i></button>Bank : </td>
									<td></td>
									<td></td>
									<td></td>
									<td><span class = "pull-right" style = "text-align:right"id = "banksales" >0.00</span></td>
									<td></td>

								</tr>
								<tbody  style = "display:none" id = "banksales_body">
								</tbody>
								<tr>
									<th colspan = "8" ><b>Receipt</b></th>
								</tr>
								<tr>
									<td class = "maintd" style = "text-align:center" colspan = "2" style = "width:15%"><button style = "padding:0px;padding-right:5px;" transaction = "#reccash_body"  status="inactive" type="button" class="btncashrec btnshowdetails no-print btn btn-box-tool"><i class="fa fa-plus"></i></button>Cash : </td>
									<td></td>
									<td></td>
									<td></td>
									<td><span class = "pull-right" style = "text-align:right" id = "cashrec" >0.00</span></td>
									<td></td>
								</tr>
								<tbody  style = "display:none"id = "reccash_body">
								</tbody>
								<tr>
									<td class = "maintd" style = "text-align:center" colspan = "2" style = "width:15%"><button style = "padding:0px;padding-right:5px;" transaction = "#recbank_body"  status="inactive" type="button" class="btnbankrec btnshowdetails no-print btn btn-box-tool"><i class="fa fa-plus"></i></button>Bank : </td>
									<td></td>
									<td></td>
									<td></td>
									<td><span class = "pull-right" style = "text-align:right" id = "bankrec" >0.00</span></td>
									<td></td>
								</tr>
								<tbody style = "display:none" id = "recbank_body">
								</tbody>
								<tr>
									<th colspan = "8" ><b>Cheque</b></th>
								</tr>
								<tr>
									<td class = "maintd" style = "text-align:center" colspan = "2" style = "width:15%"><button style = "padding:0px;padding-right:5px;" transaction = "#cheque_body"  status="inactive" type="button" class="btncleared  btnshowdetails no-print btn btn-box-tool"><i class="fa fa-plus"></i></button>Cleared : </td>
									<td></td>
									<td></td>
									<td></td>
									<td><span class = "pull-right" style = "text-align:right" id = "cleared" >0.00</span></td>
									<td></td>
								</tr>
								<tbody style = "display:none" id = "cheque_body">
								</tbody>
								<tr>
									<td colspan = "4" ><b>Total Collection</b></td>
									<td colspan = "4" ><b> <span class = "pull-right" style = "text-align:right"  id = "totalcollection" ></span></b></td>
								</tr>
                            </table>
							
							
                        </div>
                    </div>



                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
<?php $login_comid = $this->session->userdata('login_comid'); ?>
<script type="text/javascript">
	$('table.responsive display table table-bordered').css('border','1');

	$("#print").click(function () {
			var result = readCookie('<?php echo $login_comid; ?>_period_collection');
			var report_header = 'Collection Report ';
			var filters = '';
			if (result != null) {
				results = JSON.parse(result);
				$.each(results, function (index, value) {
					var start_date = value.stdate;
					var end_date = value.enddate;
					var salesman = value.salesman;
					var user = value.user;
					
					if(start_date !== undefined && start_date !== '' ){
						filters = filters + ' - Start Date :  ' + start_date;
					}
					if(end_date !== undefined && end_date !== '' ){
						filters = filters + ' - End Date :  ' + end_date;
					}
					if(salesman !== undefined && salesman !== '' ){
						var salesmanname = $("#salesman [value=" + salesman + "]").text();
						filters = filters + ' -  Salesman :  ' + salesmanname;
					}
					if(user !== undefined && user !== '' ){
						var username = $("#user [value=" + user + "]").text();
						filters = filters + ' - User :  ' + username;
					}
				});
			}
			var divName = 'pdiv';
			var printContents = document.getElementById(divName).innerHTML;
			
			var mywindow = window.open('', 'PRINT');
			mywindow.document.write('<html><head><title></title>');
			mywindow.document.write('</head><body >');
			mywindow.document.write('<h1 style ="text-align:center" >'+report_header+'</h1>'+filters);
			mywindow.document.write( '<br />' +printContents);
			mywindow.document.write('</body></html>');

			mywindow.document.close(); // necessary for IE >= 10
			mywindow.focus(); // necessary for IE >= 10*/

			mywindow.print();
			mywindow.close();

			return true;
	});
				
				
	$(document).on("click",".btnshowdetails",function() {
		var status = $(this).attr('status');
		if(status === 'inactive'){
			$(this).attr('status','active');
			var transaction = $(this).attr('transaction');
			$(transaction).removeAttr('style');
			$(this).html('<i class="clscredit fa fa-minus"></i>');
		}else{
			$(this).attr('status','inactive');
			var transaction = $(this).attr('transaction');
			$(transaction).attr('style','display:none');
			$(this).html('<i class="clscredit fa fa-plus"></i>');
		}
		
		
	});
	function loaddata(start_date,end_date,salesman,user){
		$('#cashsales_body').html('<tr><th colspan = "8" style = "text-align:center" ><b>No Transactions</b></th></tr>');
		$('#banksales_body').html('<tr><th colspan = "8" style = "text-align:center" ><b>No Transactions</b></th></tr>');
		$('#reccash_body').html('<tr><th colspan = "8" style = "text-align:center" ><b>No Transactions</b></th></tr>');
		$('#recbank_body').html('<tr><th colspan = "8" style = "text-align:center" ><b>No Transactions</b></th></tr>');
		$('#cheque_body').html('<tr><th colspan = "8"  style = "text-align:center"><b>No Transactions</b></th></tr>');
		$.ajax({
            url: "<?php echo site_url('reports/Collection/collection_data'); ?>" ,
			async:false,
            type: 'POST',
            data: {
                 start_date: start_date,end_date:end_date,salesman:salesman,user:user
            },
            success: function(result) {
				
                result = JSON.parse(result);
				var sales_data = result.sales_data;
				var receipt_data = result.receipt_data;
				var cheque_data = result.cheque_data;
				var cashsales_body = '';
				var banksales_body = '';
				var reccash_body = '';
				var recbank_body = '';
				var cheque_body = '';
				$.each(sales_data, function (index, value) {
					var cash_type = value.cash_type;
					if(cash_type === 'Cash'){
						cashsales_body = cashsales_body + '<tr>	<td style = "text-align:center" colspan = "2" style = "width:15%">'+value.date+'</td>   <td><a href = "<?php echo base_url();?>transaction/sales/sales/sales/'+value.sales_id+'" >'+value.invoice+'</a></td>  <td>'+value.customer+'</td>  <td style = "text-align:right" >'+value.cash+'</td>  <td></td><td></td>  </tr>';
					}
					if(cash_type === 'Bank'){
						banksales_body = banksales_body + '<tr>	<td style = "text-align:center" colspan = "2" style = "width:15%">'+value.date+'</td>   <td><a href = "<?php echo base_url();?>transaction/sales/sales/sales/'+value.sales_id+'">'+value.invoice+'</a></td>  <td>'+value.customer+'</td>  <td style = "text-align:right">'+value.bank+'</td>  <td></td><td></td>  </tr>';
					}
					$('#cashsales_body').html(cashsales_body);
					$('#banksales_body').html(banksales_body);
				});
				
				$.each(receipt_data, function (index, value) {
					var acc_main_id = value.acc_main_id;
					if(parseFloat(acc_main_id) > 1  ){
						reccash_body = reccash_body + '<tr>	<td style = "text-align:center" colspan = "2" style = "width:15%">'+value.date+'</td>   <td><a href = "<?php echo base_url();?>transaction/vouchers/receipt/'+value.id+'/edit" >'+value.voucher_no+'</a></td>  <td>'+value.ledgername+'</td>  <td style = "text-align:right">'+value.amount+'</td>  <td></td><td></td>  </tr>';
					}
					else{
						recbank_body = recbank_body + '<tr>	<td style = "text-align:center" colspan = "2" style = "width:15%">'+value.date+'</td>   <td><a href = "<?php echo base_url();?>transaction/vouchers/receipt/'+value.id+'/edit">'+value.voucher_no+'</a></td>  <td>'+value.ledgername+'</td>  <td style = "text-align:right">'+value.amount+'</td>  <td></td><td></td>  </tr>';
					}
					$('#recbank_body').html(recbank_body);
					$('#reccash_body').html(reccash_body);
				});
				
				$.each(cheque_data, function (index, value) {
					cheque_body = cheque_body + '<tr>		<td style = "text-align:center" colspan = "2" style = "width:15%">'+value.date+'</td>   <td><a href = "<?php echo base_url();?>transaction/chque/create/'+value.chq_id+'/v" >'+value.chq_no+'</a></td>  <td>'+value.ledgername+'</td>  <td style = "text-align:right">'+value.chq_amount+'</td>  <td></td><td></td>  </tr>';
					$('#cheque_body').html(cheque_body);
				});
            }
        });
	}
	function ms(){
		var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
		var salesman  = $('#salesman').val();
		var user  = $('#user').val();
		 $.ajax({
            url: "<?php echo site_url('reports/Collection/totalcollectionlist'); ?>" ,
			async:false,
            type: 'POST',
            data: {
                 start_date: start_date,end_date:end_date,salesman:salesman,user:user
            },
            success: function(result) {
                result = JSON.parse(result);
				$('#cashsales').html(result.salescash);
				$('#banksales').html(result.salesbank);
				$('#cashrec').html(result.reccash);
				$('#bankrec').html(result.recbank);
				$('#cleared').html(result.chequecleared);
				$('#totalcollection').html(result.total);
            }
        });
		loaddata(start_date,end_date,salesman,user);
	}
	$(document).ready(function () { 
		$.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
				$('#user').html(result);
            }
        });
		var result = readCookie('<?php echo $login_comid; ?>_period_collection');
		if (result != null) {
            results = JSON.parse(result);
            console.log(results);
            $.each(results, function (index, value) {
                $('#start_date').val(value.stdate);
                $('#end_date').val(value.enddate);
				if(value.user !== undefined){
					$('#user').val(value.user);
				}
				if(value.salesman !== undefined){
					$('#salesman').val(value.salesman);
				}
                $('#btn-filter').trigger('click');
            });
        }else{
            $('#btn-filter').trigger('click');
		}
		ms();
		
	});
	
	$(document).on("click","#btn-filter",function() {
		var arr = [];
        var fromdate = $('#start_date').val();
        var todate = $('#end_date').val();
		var user = $('#user').val();
		var salesman = $('#salesman').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
			user:user,
			salesman:salesman
        });
        createCookie('<?php echo $login_comid; ?>_period_collection', JSON.stringify(arr), 3);
		ms();
	});
</script>
