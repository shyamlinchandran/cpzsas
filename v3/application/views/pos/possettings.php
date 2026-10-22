<form method="post"  id="frmcreate" back="<?php echo site_url('pos/Main/create_pos'); ?>" action="<?php echo site_url('pos/Main/save_counter_trans'); ?>"  class="form-horizontal">
	<style>
	.sma{
        width: 100px !important;
    }
	</style>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Pos User Counter Settings', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('pos/Main/create_pos'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('pos/Main/list_pos'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $userId;?>">
						<input type="hidden" name="settings_id" id="settings_id" value="<?php echo $settings_id;?>">
							<table  id="vtable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
								<tr>
									<th>User</th>
									<th>Counter</th>
									<th class="sma">Opening balance</th>
									<th class="sma">Closing balance</th>
									<th>Notes</th>
								</tr>
								<tr>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $userName;?>"></td>
									<td><select data-validation="required" name="counter" id="counter" class="form-control"></select></td>
									<td class="sma"><input data-validation="required" type="text" class="form-control two-digits" name="op_bal" id="op_bal"></td>
									<td class="sma"><input <?php if((int) $settings_id < 1 ){ echo "readonly='readonly'";}?>type="text" class="form-control two-digits" name="cl_bal" id="cl_bal"></td>
									<td><input type="text" name="notes" id="notes" class="form-control"></td>
								</tr>
							</table>
							<?php if(isset($result['cnt'])){?>
								<table  id="vtable"  style="margin:30px;" class="table <?=$this->table_color?>" cellspacing="0" width="100%">
									<tr>
										<th colspan="4" style="text-align:center">Counter Details</th>
									</tr>
									<tr>
										<th>Total Sales</th>
										<th>Total Cash Amount</th>
										<th>Total Bank Amount</th>
										<th>Total Sales Amount</th>
									</tr>
									<tr>
										<th><?php echo $result['cnt'];?></th>
										<th><?php echo $result['cash'];?></th>
										<th><?php echo $result['bank'];?></th>
										<th><?php echo $result['total'];?></th>
									</tr>
								</table>
							<?php }?>
                        </div>   
						
                    </div>    <!-- /.col -->
					<div class="box-footer">    
						<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                    </div>
				</div> 
			</div>
		</div>               <!-- /.row -->
    </section>
    <script type="text/javascript">
		function load(){
			var id = $('#settings_id').val();
			if( id > 0){
				$.ajax({
					url: "<?php echo site_url('pos/Main/getpending'); ?>/" + id,
					success: function(results) {
						var result = JSON.parse(results);
						$("#counter").val(result.counter_id);
						$("#op_bal").val(result.opening_balance);
						$("#cl_bal").val(result.closing_balance);
						$("#notes").val(result.notes);
					}
				});
			}
		}
        $(document).ready(function () {
			$.ajax({
            url: "<?php echo site_url('ajaxcall/counters'); ?>",
            success: function (result) {
                $('#counter').html(result);
				load();
            }
        });
        });
                          
    </script> 