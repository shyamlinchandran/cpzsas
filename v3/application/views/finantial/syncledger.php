<?php
	
$add_url = site_url('finantial/SyncFinantialYear/Sync/ledger');
?>
<form method="post"  id="frmcreate" back="<?php echo site_url('item/listall'); ?>" action="<?php echo $add_url; ?>"  class="form-horizontal">
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Sync Ledger</h3>
                    <span class="pull-right">

                    </span>
                </div>
                <!-- /.box-header -->
                 <div class="box-body"> 
					<div class="col-sm-12">
					 <div class="col-sm-6">

                        <div class="col-sm-8">                              
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