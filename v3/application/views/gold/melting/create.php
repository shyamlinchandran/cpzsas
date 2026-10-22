<?php
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form id="form_material"  back="<?php echo site_url('gold/Melting/list_all'); ?>"  action="<?php echo site_url('gold/Melting/save') ?>" method="post">
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Melting Voucher ', $this, $user) ?></h3>
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
											<td style = "width:30%">
												<label>Issue Item</label>
											</td>
											<td style = "width:10%">
												<label>Issue No</label>
											</td>
											<td style = "width:10%">
												<label>Issue WT</label>
											</td>
											<td style = "width:25%">
												<label>RECEIVED Item</label>
											</td>
											<td style = "width:15%">
												<label>RECEIVED WT</label>
											</td>
											<td style = "width:15%">
												<label>Balance WT</label>
											</td>
											<td style = "width:10%">
												<label>Action</label>
											</td>
										</tr>
									</thead>
										<tr>
											<td>
												<input type = "hidden" id ="item_id" class = "form-control"  />
												<input style ="height:30px !important;"  noTab ="true" type = "text"  id ="item" class = "form-control"  />
											</td>
											<td>
												<input style ="height:30px;" type = "number"   id ="issue_no" class = "form-control"  />
											</td>
											<td>
												<input style ="height:30px;" type = "number"  id ="issue_wt" class = "form-control"  />
											</td>
											<td style = "width:15%">
											<input type = "hidden" id ="rec_item_id" class = "form-control"  />
												<input style ="height:30px !important;"  noTab ="true" type = "text"  id ="rec_item" class = "form-control"  />
											</td>
											
											<td>
												<input style ="height:30px;" type = "number"  id ="received_wt" class = "issue form-control"  />
											</td>
											<td>
												<input style ="height:30px;" readonly type = "number" id ="balance_wt" class = "issue form-control"  />
											</td>
											<td>
												<label> 
													<button  style ="height:30px !important;" type="button"  class="sma btn btn-success btnadd " href="#">
                                                         <span class="glyphicon glyphicon-plus"></span>
													</button>
											 </label>
											</td>
										</tr>
									<tbody id="addrow">
									</tbody>
									
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
	$(function(){
  $(document).on("keydown.autocomplete",".autoitem",function(e){
		var count = $(this).attr('cnt');
		$(this).autocomplete({
                source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
                minLength: 2,
                select: function (event, ui) {
					$('#rec_item_id'+count).val(ui.item.id);
					$('#received_wt'+count).focus();
					
                }
            });
		});
});


	var cnt_sj = 0;
	function calert(msg) {
        toastr["error"](msg);
    }
	$(document).on('click', '#btnmelting', function() {
		var cnts = 0 ;
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
	
	
	function remove(btn){
		$(btn).closest('tr').remove();
	}
	var cnt = 0;
	function addrowtotable(item_id,item_name,issue_no,issue_wt,received_wt,balance_wt,rec_item_id,rec_item_name){
		cnt++;
		$('#item_id').val('');
		$('#item').val('');
		$('#rec_item_id').val('');
		$('#rec_item').val('');
		$('#issue_no').val('');
		$('#issue_wt').val('');
		$('#received_wt').val('');
		$('#balance_wt').val('');

		var text = '<td ><input type = "hidden" name = "item_id[]" id ="item_id" value = "'+item_id+'" ><input readonly class="form-control" style ="height:30px !important;"  type = "text" value="'+item_name+'"></td>';
		text = text + '<td><input class="form-control"  style ="height:30px !important;"  cnt = '+cnt+' type ="number" value= "'+issue_no+'" name ="issue_no[]" id="issue_no'+cnt+'" ></td>' ;
		text = text + '<td><input  class="form-control clscalc"  style ="height:30px !important;"  cnt = '+cnt+' type ="number" value= "'+issue_wt+'" name ="issue_wt[]" id="issue_wt'+cnt+'" ></td>' ;
		text = text+'<td ><input type = "hidden" name = "rec_item_id[]" id ="rec_item_id'+cnt+'" value = "'+rec_item_id+'" ><input cnt = '+cnt+' class="form-control autoitem" style ="height:30px !important;"  type = "text" value="'+rec_item_name+'"></td>';
		text = text + '<td><input  class="form-control clscalc"  style ="height:30px !important;"  cnt = '+cnt+' type ="number" value= "'+received_wt+'" name ="received_wt[]" id="received_wt'+cnt+'" ></td>' ;
		text = text + '<td><input  class="form-control"  style ="height:30px !important;"  cnt = '+cnt+' type ="number" value= "'+balance_wt+'" readonly name ="balance_wt[]" id="balance_wt'+cnt+'" ></td>' ;
		text = text + '<td><span style ="height:30px !important;"  data-toggle="tooltip"   title="Remove" onclick="remove(this)" class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
		text = '<tr>'+text+'</tr>';
		$('#addrow').append(text);
	}
	$(document).on('click', '.btnadd', function() {
		var item_id = $('#item_id').val();

		if(item_id!== 0  && item_id !== ''){
			var issue_no = $('#issue_no').val();
			if(issue_no === ''){
				issue_no = 0 ;
			}
			var issue_wt = $('#issue_wt').val();
			if(issue_wt === ''){
				issue_wt = 0 ;
			}
			var received_wt = $('#received_wt').val();
			if(received_wt === ''){
				received_wt = 0;
			}
			var balance = parseFloat(issue_wt) - parseFloat(received_wt);
			$('#balance_wt').val(parseFloat(balance).toFixed(4));
			var item_name = $('#item').val();
			var balance_wt = $('#balance_wt').val();
			var rec_item_id = $('#rec_item_id').val();
			if(rec_item_id === ''){
				rec_item_id = 0 ;
			}
			var rec_item_name = $('#rec_item').val();
			if(parseFloat(rec_item_id) < 1  ){
				rec_item_name = '';
			}
			addrowtotable(item_id,item_name,issue_no,issue_wt,received_wt,balance_wt,rec_item_id,rec_item_name);
			
		}
	});
	
	$(document).on('change', '.clscalc', function() {
		var ref = $(this).attr('cnt');
		var issue_wt = $('#issue_wt'+ref).val();
		if(issue_wt === ''){
			issue_wt = 0 ;
		}
		var received_wt = $('#received_wt'+ref).val();
		if(received_wt === ''){
			received_wt = 0;
		}
		var balance = parseFloat(issue_wt) - parseFloat(received_wt);
		$('#balance_wt'+ref).val(parseFloat(balance).toFixed(4));
	});
	
	
	$(document).on('change', '.issue', function() {
		var issue_wt = $('#issue_wt').val();
		if(issue_wt === ''){
			issue_wt = 0 ;
		}
		var received_wt = $('#received_wt').val();
		if(received_wt === ''){
			received_wt = 0;
		}
		var balance = parseFloat(issue_wt) - parseFloat(received_wt);
		$('#balance_wt').val(parseFloat(balance).toFixed(4));
	});
	function loadCust(ui) {
       $('#customer').val(ui.item.name);
       $('#customer_id').val(ui.item.id);
    }
	
	$(document).ready(function () {
			$("#rec_item").autocomplete({
                source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
                minLength: 2,
                select: function (event, ui) {
					$('#rec_item_id').val(ui.item.id);
					$('#received_wt').focus();
					
                }
            });
		 $("#item").autocomplete({
                source: "<?php echo site_url('pricelist/Pricelist/itemsearch'); ?>",
                minLength: 2,
                select: function (event, ui) {
					$('#item_id').val(ui.item.id);
					$('#issue_no').focus();
					
                }
            });
			
			
		$("#customer").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);

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
			$('#addrow').html('');
			$.ajax({
                url: "<?php echo site_url('gold/Melting/getsing'); ?>/" + id,
				async:false,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
						$('#date').val(itemsingle.date);
						$('#customer_id').val(itemsingle.melt_customer);
						$('#customer').val(itemsingle.customer);
						
						$('#user').val(itemsingle.melt_user);
						$('#salesman').val(itemsingle.melt_salesman);
						addrowtotable(itemsingle.melt_itm_product,itemsingle.product,itemsingle.melt_itm_issue_no,itemsingle.melt_itm_issue_wt,itemsingle.melt_itm_received_wt,itemsingle.melt_itm_balance_wt,itemsingle.melt_itm_rec_product,itemsingle.rec_item_name)
						
						
						
                    });

                }
            });
			
		}
	});


</script>  