<form method="post"  id="frmcreate" back="<?php echo site_url('settings/CompanySettings/listall'); ?>" action="<?php echo site_url('settings/CompanySettings/save_key'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
				<div class="box box-primary">
					<div class="box-body">
						<div class="col-sm-12">
							<table class="table table-bordered">
                               <tr>
									<th>  <?= label('Key', $this, $user) ?></th>
									<th>  <?= label('Value', $this, $user) ?></th>
									<th>  <?= label('type', $this, $user) ?></th>
									<th>  <?= label('After', $this, $user) ?></th>
							   </tr>
							   <tr>
									<td><input data-validation="required" type="text" class="form-control" name="comset_key" id="comset_key"/></td>
									<td><input  data-validation="required"type="text" class="form-control" name="comset_value" id="comset_value"/></td>
									<td>
										<select data-validation="required" class="form-control" type="text" name="comset_type" id="comset_type">
											<option value="">Select</option>
											<option value="int">Int</option>
											<option value="select">Select</option>
											<option value="text">Text</option>
											<option value="decimal">Decimal</option>
										</select>
									</td>
									<td>
										<select class="form-control" type="text" name="comset_after" id="comset_after">
											<option value="">At the begining</option>
											<?php $company_details = $settings['value'];$company_details =json_decode($company_details,true); foreach($company_details  as $details){?>
													<option value="<?php echo $details['key']; ?>"><?php echo $details['key']; ?></option>
											<?php }?>
											
										</select>
									</td>

							   </tr>
							</table>  
							
						</div>
               
                <!-- /.row -->
					</div>
					<div class="box-footer popuphide">
                        <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
				</div>   
            </div>
		</div>	
    </section>
</form>
    <script type="text/javascript">
      
	   $(document).ready(function () {
		  var myVal =$('#comset_after option:last').val();
		  $('#comset_after').val(myVal);
	   });
    </script>                                                                                                                                                                                                                                                                         