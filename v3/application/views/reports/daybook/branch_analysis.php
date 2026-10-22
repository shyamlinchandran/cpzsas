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
                        
                    </div>
                    <div class="box-body" id="printdiv"> 
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
										<?= label('Branch', $this, $user) ?> 
										<select  id="branch" name="branch" class="form-control " >                                            
                                        </select>
									</td>
									<td class="col-sm-2">
									</td>
									<td class="col-sm-2">
									</td>
									<td class="col-sm-2">
										<br />
											<input style="height: 25px;" type="button"  class="btn btn-success" id="loadbalance"  value="<?= label('Search', $this, $user) ?>"/>
									</td>
								</tr>
						</table>
                        <div class="col-sm-12">  
                            <table id="quicktable" class="table table-condensed table-striped">
                                <tr>
                                    <td style="text-align: center;font-weight: bold" colspan="4">Branch Analysis Report</td>
                                </tr>
								
                               <tr>
									<td style="width:30%"> </td>
									<td style="width:20%">Credit Sales</td>
									<td style="width:20%"><label id="credit_sale" style="width: 100%">0.00</label> </td>
									<td style="width:30%"> </td>
							   </tr>
							   <tr>
									<td > </td>
									<td >Bank Sales</td>
									<td ><label id="bank_sale" style="width: 100%">0.00</label> </td>
									<td > </td>
							   </tr>
							    <tr>
									<td > </td>
									<td >Cash Sales</td>
									<td ><label id="cash_sale" style="width: 100%">0.00</label> </td>
									<td > </td>
							   </tr>
							   <tr>
									<td >Total Sales</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_sale" style="width: 100%">0.00</label></td>
							   </tr>
							   
							   <tr>
									<td style="width:30%"> </td>
									<td style="width:20%">Credit Purchase</td>
									<td style="width:20%"><label id="credit_purchase" style="width: 100%">0.00</label> </td>
									<td style="width:30%"> </td>
							   </tr>
							   <tr>
									<td > </td>
									<td >Bank Purchase</td>
									<td ><label id="bank_purchase" style="width: 100%">0.00</label> </td>
									<td > </td>
							   </tr>
							    <tr>
									<td > </td>
									<td >Cash Purchase</td>
									<td ><label id="cash_purchase" style="width: 100%">0.00</label> </td>
									<td > </td>
							   </tr>
							   <tr>
									<td >Total Purchase</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_purchase" style="width: 100%">0.00</label></td>
							   </tr>
							   <tr>
									<td >Total Sales Order</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_sorder" style="width: 100%">0.00</label></td>
							   </tr>
							    <tr>
									<td >Total Purchase Order</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_porder" style="width: 100%">0.00</label></td>
							   </tr>
							   <tr>
									<td >Payment</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_pay" style="width: 100%">0.00</label></td>
							   </tr>
							   <tr>
									<td >Receipt</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_rec" style="width: 100%">0.00</label></td>
							   </tr>
							   <tr>
									<td >Total Sales Return</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_sreturn" style="width: 100%">0.00</label></td>
							   </tr>
							    <tr>
									<td >Total Purchase Return</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_preturn" style="width: 100%">0.00</label></td>
							   </tr>
							   <tr>
									<td >Total Sales Margin</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_margin" style="width: 100%">0.00</label></td>
							   </tr>
							   <tr>
									<td >Total Outstanding</td>
									<td> </td>
									<td > </td>
									<td > <label id="total_outstanding" style="width: 100%">0.00</label></td>
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
<script type="text/javascript">
	function load(){
		var branch = $('#branch').val();
		var startdate = $('#startdate').val();
		var enddate = $('#enddate').val();
		var arr = [];
        arr.push({
            startdate: startdate,
            enddate: enddate,
            branch: branch,
        });
        createCookie('branch_analyze_report_cook', JSON.stringify(arr), 3);
		$.ajax({
            url: "<?php echo site_url('reports/Daybook/getbranchanalysis'); ?>",
            async: false,
            type: 'POST',
            data: {startdate: startdate,enddate:enddate,branch:branch},
            success: function (result) {
				var json = JSON.parse(result);
				$('#total_margin').html(json.total_margin);
				$('#cash_sale').html(json.cash_sale);
				$('#credit_sale').html(json.credit_sale);
				$('#bank_sale').html(json.bank_sale);
				$('#total_sale').html(json.total_sale);
				$('#total_sorder').html(json.total_sorder);
				$('#total_sreturn').html(json.total_sreturn);
				
				$('#cash_purchase').html(json.cash_purchase);
				$('#credit_purchase').html(json.credit_purchase);
				$('#bank_purchase').html(json.bank_purchase);
				$('#total_purchase').html(json.total_purchase);
				$('#total_porder').html(json.total_porder);
				$('#total_preturn').html(json.total_preturn);
				$('#total_pay').html(json.total_pay);
				$('#total_rec').html(json.total_rec);
				var paid = parseFloat(json.total_sale) - parseFloat(json.paid) - parseFloat(json.cash_sale) - parseFloat(json.bank_sale) ;
				$('#total_outstanding').html(paid);
		   }
        });
	}
    $(document).ready(function () {
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/branch'); ?>",
            success: function (result) {
                $('#branch').html(result);
            }
        });
		
		$("#loadbalance").click(function () {
            load();
        });

	});

 


</script>
