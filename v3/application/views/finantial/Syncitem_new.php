<?php
$add_url = site_url('finantial/FinantialYear/Syncitem_new');
?>
<form method="post"  id="frmcreate" back="<?php echo site_url('item/listall'); ?>" action="<?php echo $add_url; ?>"  class="form-horizontal">
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Sync Item</h3>
                    <span class="pull-right">

                    </span>
                </div>
                <!-- /.box-header -->
                 <div class="box-body"> 
					<div class="col-sm-12">
					 <div class="col-sm-6">
                        <label  class="col-sm-2 control-label"><?= label('Database', $this, $user) ?></label>

                        <div class="col-sm-8">                              
                           <input data-validation="required" type="text" name="database_name" id="database_name" class="form-control"/>
                        </div>
                    </div>
					</div>
					<br/>	
                   
                      
                </div>
				 <div class="box-footer">    
						<button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
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