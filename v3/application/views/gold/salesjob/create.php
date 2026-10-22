<?php
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form id="form_material" action="<?php echo site_url('gold/SalesJob/save') ?>" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('SALES AND JOB WORK ', $this, $user) ?></h3>
						<table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
									<td class="col-sm-3">
                                        <?= label('Date', $this, $user) ?>
                                        <input type="text" class="form-control date" name="date" id="date" >
                                    </td>
									 <td class="col-sm-3">
										<?= label('Customer', $this, $user) ?>
										<input type="hidden" name="customer_id" id="customer_id"/>
                                        <input type="text" noTab="true" class="form-control" name="customer" id="customer" >
									</td> 
									 <td class="col-sm-3">
										<?= label('User', $this, $user) ?>
                                        <select  class="form-control" name="user" id="user" >
										</select>
									</td> 
									
									 <td class="col-sm-3">
										<?= label('Salesman', $this, $user) ?>
                                        <select   class="form-control" name="salesman" id="salesman" >
										</select>
									</td> 
									
                                </tr>
								
								
                            </tbody>
                        </table> 
                       <p><b><label style="font-size:18px;" id="voucher_no"><?php// echo $invoice;?></label></b></p>
                    <!-- /.box-header -->
                    
                        
                        <br/> 
						<div class="box-body">
							<div class="row">
								<table  style="padding:left:40px;width:100%;" class="table <?=$this->table_color?>" cellspacing="0" width="100%">
									
									<thead>
										<tr>
											<td style = "width:12%">
												<label>Item</label>
											</td>
											<td style = "width:7%">
												<label>RECEIVED WT</label>
											</td>
											
											<td style = "width:7%">
												<label>Issue WT</label>
											</td>
											<td style = "width:7%">
												<label>Touch</label>
											</td>
											
											<td style = "width:7%">
												<label>RECEIVED Pure Weight</label>
											</td>
											
											<td style = "width:7%">
												<label>Issued Pure Weight</label>
											</td>
											
											<td style = "width:7%">
												<label>Balance Weight</label>
											</td>
											
											<td style = "width:7%">
												<label>MC RATE</label>
											</td>
											
											<td style = "width:7%">
												<label>MC Amount</label>
											</td>
											
											
											<td style = "width:7%">
												<label>MC REC</label>
											</td>
											
											<td style = "width:7%">
												<label>MC Balance</label>
											</td>
											
											<td style = "width:7%">
												<label>RATE</label>
											</td>
											
											<td style = "width:7%">
												<label>Amount</label>
											</td>
											
											
										</tr>
									</thead>
									<tr>
										<td style = "width:12%">
												<input type = "hidden" name="item_id" id ="item_id" class = "form-control"  />
												<input style ="height:30px !important;"  noTab ="true" type = "text"  id ="item" class = "form-control"  />
										</td>
										
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number" name="received_wt"  id ="received_wt" class = "issue form-control"  />
										</td>
											
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"  name="issue_wt"  id ="issue_wt" class = "form-control clsissue"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"  name="touch"  id ="touch" class = "form-control clsissue"  />
										</td>
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"  name="received_pure"  id ="received_pure" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"  name="issued_pure"  id ="issued_pure" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"  name="balance_pure"  id ="balance_pure" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"   name="mc_rate"  id ="mc_rate" class = "clsissue form-control"  />
										</td>
										<td style = "width:7%">
												<input  readonly style ="height:30px;" type = "number"  name="mc_amount"  id ="mc_amount" class = "issue form-control"  />
										</td>
										
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"   name="mc_rec" id ="mc_rec" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"  name="mc_bal"  id ="mc_bal" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"  name="rate"  id ="rate" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number" name="amount"   id ="amount" class = "issue form-control"  />
										</td>
										
										
										
									</tr>
									<tr>
										<td style = "width:12%">
												<input type = "hidden"  name="rec_item_id" id ="rec_item_id" class = "form-control"  />
												<input style ="height:30px !important;"  noTab ="true" type = "text"  id ="rec_item" class = "form-control"  />
										</td>
										
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"   name="rec_received_wt" id ="rec_received_wt" class = "clsrec form-control"  />
										</td>
											
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"  name="rec_issue_wt" id ="rec_issue_wt" class = "form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"   name="rec_touch" id ="rec_touch" class = "form-control clsrec"  />
										</td>
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number" name="rec_received_pure"   id ="rec_received_pure" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"  name="rec_issued_pure"  id ="rec_issued_pure" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input  readonly style ="height:30px;" type = "number"  name="rec_balance_pure"  id ="rec_balance_pure" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"   name="rec_mc_rate" id ="rec_mc_rate" class = "clsrec form-control"  />
										</td>
										<td style = "width:7%">
												<input readonly style ="height:30px;" type = "number"   name="rec_mc_amount" id ="rec_mc_amount" class = "issue form-control"  />
										</td>
										
										<td style = "width:7%">
												<input   style ="height:30px;" type = "number"   name="rec_mc_rec" id ="rec_mc_rec" class = "clsrec form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"    name="rec_mc_bal"  id ="rec_mc_bal" class = "clsrec form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"  name="rec_rate"  id ="rec_rate" class = "issue form-control"  />
										</td>
										<td style = "width:7%">
												<input style ="height:30px;" type = "number"  name="rec_amount"  id ="rec_amount" class = "issue form-control"  />
										</td>
										
										
										
									</tr>
									
								</table>
							</div>
					</div>
					 <div class="box-footer">
                        <button  id="btnmelting" type='button' data-toggle="tooltip" title='Save' class='btn btn-warning'> <i class="glyphicon glyphicon-hdd"></i> </button>
						<button  style ="display:none;" id="form-button-save" type="submit" data-toggle="tooltip" title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>

<script type="text/javascript">
	var cnt_sj = 0;
	function calert(msg) {
        toastr["error"](msg);
    }
	$(document).on('click', '#btnmelting', function() {
		var cnts = 1 ;
		event.preventDefault();
		$( ".clscalc" ).each(function() {
			cnts = cnts + 1;
			console.log($( this ).val());
		});
		
		if(parseFloat(cnts) >0  && parseFloat(cnt_sj) < 1 ){
			$('#form-button-save').trigger('click');
			cnt_sj = cnt_sj + 1;
		}else if( parseFloat(cnt_sj) > 0 ){
		
		}else{
			calert('Please Select atleast One Item');
		}
		
	});
	
	$(document).on('change', '.clsissue', function() {
		var issue_wt = $('#issue_wt').val();
		var touch = $('#touch').val();
		if(issue_wt === ''){
			issue_wt = 0;
		}
		if(touch === ''){
			touch = 0;
		}
		var issued_pure = 0
		if(parseFloat(issue_wt) > 0 && parseFloat(touch) > 0  ){
			issued_pure = parseFloat(issue_wt)*parseFloat(touch) /100;
		}
		$('#issued_pure').val(issued_pure);
		$('#balance_pure').val(issued_pure);
		var mc_rate = $('#mc_rate').val();
		if(mc_rate === ''){
			mc_rate = 0;
		}
		var mc_amount = parseFloat(mc_rate) * parseFloat(issue_wt);
		$('#mc_amount').val(mc_amount);
		$('#mc_bal').val(mc_amount);
		$('#rec_received_wt').trigger('change');
	});
	
	$(document).on('change', '.clsrec', function() {
		var rec_received_wt = $('#rec_received_wt').val();
		var rec_touch = $('#rec_touch').val();
		if(rec_received_wt === ''){
			rec_received_wt = 0;
		}
		if(rec_touch === ''){
			rec_touch = 0;
		}
		var rec_received_pure = 0
		if(parseFloat(rec_received_wt) > 0 && parseFloat(rec_touch) > 0  ){
			rec_received_pure = parseFloat(rec_received_wt)*parseFloat(rec_touch) /100;
		}
		$('#rec_received_pure').val(rec_received_pure);
		var rec_balance_pure = 0;
		var balance_pure = $('#balance_pure').val();
		if(balance_pure ===''){
			balance_pure = 0;
		}
		var rec_balance_pure = parseFloat(balance_pure)  - parseFloat(rec_received_pure);
		$('#rec_balance_pure').val(rec_balance_pure);
		var rec_mc_rate  =$('#rec_mc_rate').val();
		if(rec_mc_rate ===''){
			rec_mc_rate = 0;
		}
		var rec_mc_amount = 0;
		rec_mc_amount = parseFloat(rec_mc_rate)*rec_received_wt;
		$('#rec_mc_amount').val(rec_mc_amount);
		var mc_bal = $('#mc_bal').val();
		if(mc_bal ===''){
			mc_bal = 0;
		}
		var rec_mc_rec = $('#rec_mc_rec').val();
		if(rec_mc_rec ===''){
			rec_mc_rec = 0;
		}
		var rec_mc_bal = parseFloat(mc_bal) - parseFloat(rec_mc_rec);
		$('#rec_mc_bal').val(rec_mc_bal);
	});
	
	
	
	
	
	function loadCust(ui) {
       $('#customer').val(ui.item.name);
       $('#customer_id').val(ui.item.id);
    }
	
	$(document).ready(function () {
		$("#customer").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);

            }
        });
		
		 $("#item").autocomplete({
                source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
                minLength: 2,
                select: function (event, ui) {
					$('#issue_wt').val(ui.item.id);
					$('#received_wt').focus();
					
                }
            });
			
			 $("#rec_item").autocomplete({
                source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
                minLength: 2,
                select: function (event, ui) {
					$('#rec_item_id').val(ui.item.id);
					$('#rec_received_wt').focus();
					
                }
            });
			
			 
		
		$.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
			async:false,
            success: function (result) {
                $('#salesman').html(result);
				$('#user').html(result);
               
            }
        });
		
		var id = $('#id').val();
		if(parseFloat(id) > 0  ){
			$.ajax({
                url: "<?php echo site_url('gold/SalesJob/getsing'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
						$('#date').val(itemsingle.dates);
						$('#customer_id').val(itemsingle.customer);
						$('#customer').val(itemsingle.customername);
						$('#user').val(itemsingle.user);
						$('#salesman').val(itemsingle.salesman);
						if(itemsingle.type === 'issue'){
							 $('#item_id').val(itemsingle.product) ;
							 $('#item').val(itemsingle.itemname) ;
							 $('#received_wt').val(itemsingle.rec_wt) ;
							 $('#issue_wt').val(itemsingle.issue_wt) ;
							 $('#touch').val(itemsingle.touch) ;
							 $('#received_pure').val(itemsingle.rec_pure_wt) ;
							 $('#issued_pure').val(itemsingle.issue_pure_wt) ;
		
		
							 $('#balance_pure').val(itemsingle.balance_wt) ;
							 $('#mc_rate').val(itemsingle.mc_rate) ;
							 $('#mc_amount').val(itemsingle.mc_amount) ;
							 $('#mc_rec').val(itemsingle.mc_rec ) ;
							 $('#mc_bal').val(itemsingle.mc_balance) ;
							 $('#rate').val(itemsingle.rate) ;
							 $('#amount').val(itemsingle.amount) ;
						}
						
						
						if(itemsingle.type === 'receive'){
							$('#rec_item_id').val(itemsingle.product) ;
							 $('#rec_item').val(itemsingle.itemname) ;
							 $('#rec_received_wt').val(itemsingle.rec_wt) ;
							 $('#rec_issue_wt').val(itemsingle.issue_wt) ;
							 $('#rec_touch').val(itemsingle.touch) ;
							 $('#rec_received_pure').val(itemsingle.rec_pure_wt) ;
							 $('#rec_issued_pure').val(itemsingle.issue_pure_wt) ;
		
		
							 $('#rec_balance_pure').val(itemsingle.balance_wt) ;
							 $('#rec_mc_rate').val(itemsingle.mc_rate) ;
							 $('#rec_mc_amount').val(itemsingle.mc_amount) ;
							 $('#rec_mc_rec').val(itemsingle.mc_rec ) ;
							 $('#rec_mc_bal').val(itemsingle.mc_balance) ;
							 $('#rec_rate').val(itemsingle.rate) ;
							 $('#rec_amount').val(itemsingle.amount) ;
						}
						
						
                    });

                }
            });
			
		}
		
		
	});


</script>  