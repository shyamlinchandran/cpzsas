

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post"  id="frmcreate" back="<?php echo site_url('Billformat/billformat'); ?>" action="<?php echo site_url('Billformat/save'); ?>"  class="form-horizontal">
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
				<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
                <div class="box-header">
                    <h3 class="box-title">Customise Bill Format</h3>
					<span class="pull-right">
                            <a role="button" back="<?php echo site_url('billformat/billformat'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('billformat/billformat'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
					<div class="col-sm-12">
						<div class="col-sm-7">
							<table class="table table-stripped table-condensed">
								<tr>
									<th colspan="5" style="text-align:center">Item List Details</th>
							
								</tr>
								<tr>
									<td class="col-sm-1">Sno</td>
									<td class="col-sm-3">Field</td>
									<td  class="col-sm-2">Visibility</td>
									<td class="col-sm-3">Header</td>
									<td class="col-sm-3">Width</td>
								</tr>
				
							<?php $i =0;foreach($print_settings as $item){ $i++; ?>
								<tr>
									<td><?php echo $i;?></td>
									<td><input type="hidden" name="field_type[]" value="<?php echo $item->Field;?>"><?php echo str_replace("_"," ",$item->Field);?></td>
									<td><select class="form-control" name="Isvisible[]"> <option value="YES">YES</option><option <?php if($item->Isvisible =='NO'){echo 'selected';}?> value="NO">NO</option></select></td>
									<td><input type="text" name="display_as[]" class="form-control" value="<?php echo $item->display_as;?>"></td>
									<td><input type="text"  name="width[]"  class="form-control two-digits" value="<?php echo $item->width;?>"></td>
								</tr>
							<?php } ?>
					
							</table>
						</div>
						<div class="col-sm-5">
							<table class="table table-stripped table-condensed">
								<tr>
									<th colspan="5" style="text-align:center">Footer Details</th>
							
								</tr>
								<tr>
									<td class="col-sm-1">Sno</td>
									<td class="col-sm-4">Details</td>
									<td  class="col-sm-3">Visibility</td>
									<td class="col-sm-4">Header</td>
								</tr>
				
							<?php $i =0;foreach($footer_settings as $item){ $i++; ?>
								<tr>
									<td><?php echo $i;?></td>
									<td><input type="hidden" name="footer_field_type[]" value="<?php echo $item->Field;?>"><?php $field = str_replace("Footer_","",$item->Field); echo str_replace("_"," ",$field);?></td>
									<td><select class="form-control" name="footer_Isvisible[]"> <option value="YES">YES</option><option <?php if($item->Isvisible =='NO'){echo 'selected';}?> value="NO">NO</option></select></td>
									<td><input type="text" name="footer_display_as[]" class="form-control" value="<?php echo $item->display_as;?>"></td>
								</tr>
							<?php } ?>
					
							</table>
						</div>
					</div>
				</div>
				
                <!-- /.box-body -->
				 <div class="box-footer" class="col-sm-12">
                        <button  id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
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

    $(document).ready(function () {
 
     
    });

</script>  