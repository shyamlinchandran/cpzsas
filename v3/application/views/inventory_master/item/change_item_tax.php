<form method="post"  id="frmcreate" back="<?php echo site_url('inventory_master/item/change_item_tax'); ?>" action="<?php echo site_url('inventory_master/item/update_item_tax'); ?>"  class="form-horizontal">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Change Item Tax', $this, $user) ?> </h3>
                        <span class="pull-right">
                           
                        </span>
                    </div> 
                    <div class="box-body">
                        
                        <div class="col-sm-12 form-group  odd_cls">
                            <table class="table table-bordered">
                               <tr>
									<th>
										Tax
									</th>
									<th>
										Category
									</th>
									<th>
										Brand
									</th>
									<th>
										Hsncode
									</th>
									<th>
										To Tax
									</th>
									<th>
										Action
									</th>
							   </tr>
                                <tr>
									<td>
										<select name="tax_id" id="tax_id" class="form-control" >
                                            <option value="">Select</option>
                                        </select>
									</td>
									<td>
										<select name="category" id="category" class="form-control" >
                                            <option value="">Select</option>
                                        </select>
									</td>
									<td>
										<select name="brand_id" id="brand_id" class="form-control" >
                                            <option value="">Select</option>
                                        </select>
									</td>
									
									
									<td>
										<select name="hsn_id" id="hsn_id" class="form-control" >
                                            <option value="">Select</option>
                                        </select>
									</td>
									
									<td>
										<select name="to_tax_id" id="to_tax_id" class="form-control" >
                                            <option value="">Select</option>
                                        </select>
									</td>
									
									<td> 
                                        <button data-toggle="tooltip" type="button"  id="addmore"  title="Add To save"   class="addmore btn btn-success" href="#">
											Change 
										</button>
									</td>
                                </tr>
                            </table>
							
                        </div>
                   

                        <!-- /.box -->
                    </div>
                    <div class="box-footer" class="col-sm-12">
                        <button style="display:none" id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- /.row -->
    </section>
	<link rel="stylesheet"
          type="text/css"
          href="<?php echo base_url(); ?>assets/css/jquery-confirm.css"/>
		  <script src="<?php echo base_url(); ?>assets/js/jquery-confirm.js"></script>

    <script type="text/javascript">
	
	 function calert(msg) {
        toastr["error"](msg);
    }
        $(document).ready(function () {
			$('#addmore').click(function(){
				var tax_id = $('#tax_id').val();
				var brand_id = $('#brand_id').val();
				var hsn_id = $('#hsn_id').val();
				var category = $('#category').val();
				var is_continue = 1; 
				if(tax_id === '' && brand_id === '' && hsn_id === '' && category === ''){
					is_continue = 0 ;
					calert('Please Select Atleast One Condition');

				}
				var to_tax_id = $('#to_tax_id').val();
				if(to_tax_id!== '' && is_continue > 0 ){
					var text = '';
					var tax_id = $('#tax_id').val();
					if(tax_id !== ''){
						if(text != ''){
							text = text + ' , ';
						}
						text = text + $("#tax_id option:selected").text() + ' Tax Percetage ' ;
					}
					var category = $('#category').val();
				
					if(category !== ''){
						if(text != ''){
							text = text + ' , ';
						}
						text = text + $("#category option:selected").text() + ' Category ' ;
					}
				
					var brand_id = $('#brand_id').val();
				
					if(brand_id !== ''){
						if(text != ''){
							text = text + ' , ';
						}
						text = text + $("#brand_id option:selected").text() + ' Brand ' ;
					}
				
					var hsn_id = $('#hsn_id').val();
				
					if(hsn_id !== ''){
						if(text != ''){
							text = text + ' , ';
						}
						text = text + $("#hsn_id option:selected").text() + ' Hsncode ' ;
					}
				
					var to_tax_id = $('#to_tax_id').val();
				
					text = text + ' Will be changed to ' + $("#to_tax_id option:selected").text() + ' Tax Percentage ' ;
					text = 'Item with '+ text;
					$.confirm({
										title: 'A secure action',
										content: text,
										icon: 'fa fa-question-circle',
										animation: 'scale',
										closeAnimation: 'scale',
										opacity: 0.5,
										buttons: {
										'confirm': {
											text: 'Proceed',
											btnClass: 'btn-blue',
											action: function(){
											$.confirm({
                                            title: 'This maybe critical',
                                            content: "Once Converted can't be restored." ,
                                            icon: 'fa fa-warning',
                                            animation: 'scale',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                confirm: {
                                                    text: 'Yes, sure!',
                                                    btnClass: 'btn-orange',
                                                    action: function(){
                                                        $.ajax({
															url: '<?php echo site_url('inventory_master/item/update_item_tax'); ?>',
															type: 'post',
															data: {text:text,tax_id:tax_id,category:category,brand_id:brand_id,hsn_id:hsn_id,to_tax_id:to_tax_id},
															success: function(result) {
																$.confirm({
																	title: 'Success',
																	content: 'Tax Updated Successfully.',
																	autoClose: 'logoutUser|5000',
																	buttons: {
																		logoutUser: {
																			text: 'Tax Updated Successfully',
																				action: function () {
																					$('#tax_id').val('');
																					$('#brand_id').val('');
																					$('#hsn_id').val('');
																					$('#category').val('');
																					$('#to_tax_id').val('');
																				}
																		},
																		cancel: function () {
																		
																		}
																	}
																});
						
															}
														});
                                                    }
                                                },
                                                cancel: function(){
													
                                                }
                                            }
                                        });
											}
										},
										cancel: function(){
										
										},
                                
                            }
                        });
				}else{
					calert('Please Select Atleast One Condition and Tax');
				}
			});
			$.ajax({
				url: "<?php echo site_url('master/amaster/item_category'); ?>/1",
				async: false,
				success: function (result) {
					var option = '<option value="">Select </option>';
					$.each(JSON.parse(result), function (i, itemsingle) {
						option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
					});
					$("#category").html(option);
				}
			});
			
			$.ajax({
				url: "<?php echo site_url('master/amaster/tax'); ?>/",
				async: false,
				success: function(result) {
					var option = '<option value="">Select </option>';
					$.each(JSON.parse(result), function(i, itemsingle) {
						option = option + '<option value ="' + itemsingle.gstid + '"> ' + itemsingle.GST + '</option>';
					});
					$("#tax_id").html(option);
					$("#to_tax_id").html(option);
				}
			});
			
			
			$.ajax({
				url: "<?php echo site_url('master/amaster/brands'); ?>/",
				async: false,
				success: function(result) {
					var option = '<option value="">Select </option>';
					$.each(JSON.parse(result), function(i, itemsingle) {
						option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
					});
					$("#brand_id").html(option);
				}
			});
			
			
			$.ajax({
				url: "<?php echo site_url('master/amaster/hsn_code'); ?>/",
				async: false,
				success: function(result) {
					var option = '<option value="">Select </option>';
					$.each(JSON.parse(result), function(i, itemsingle) {
						option = option + '<option value ="' + itemsingle.hsnid + '"> ' + itemsingle.hsncode + '</option>';
					});
					$("#hsn_id").html(option);
                
				}
			});
				
        });
       
        
  
    </script> 