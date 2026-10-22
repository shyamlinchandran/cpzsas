<form method="post"  id="frmcreate" back="<?php echo site_url('pos/Main/list_counter'); ?>" action="<?php echo site_url('pos/Main/save_counter'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="0" name="is_godown" id="is_godown" />

    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Pos Counters', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('pos/Main/list_counter'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('pos/Main/list_counter'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                     <?= label('Counter Name', $this, $user) ?> <span class="required"></span> :
                                </label>
								<div class="col-sm-8">
                                    <input id="counter" data-validation="required"  class="form-control" name="counter" type="text" value="" maxlength="50">
								</div>
                            </div>
                            <div class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Bill Type', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                      <select tabindex="-1" id="btype" data-validation="required" name="btype" class="form-control " >   
										<option value="">select</option>
										<?php foreach($billtypes as $item){?>
											<option value="<?php echo $item['id'];?>"><?php echo $item['type'];?></option>
										<?php }?>									  
                                        </select>
                                 </div>
                            </div>
                        </div>   
						 <div class="col-sm-12">
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                     <?= label('Counter Details', $this, $user) ?> <span class="required"></span> :
                                </label>
								<div class="col-sm-8">
                                    <textarea name="counter_details" id="counter_details"  class="form-control"/>
								</div>
                            </div>
                            
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
			var id  = $('#id').val();
			if( id > 0){
				$.ajax({
					url: "<?php echo site_url('pos/Main/getsing'); ?>/" + id,
					success: function(results) {
						var result = JSON.parse(results);
						$("#counter").val(result.name);
						$("#btype").val(result.bill_type);
						$("#counter_details").val(result.details);
					}
				});
			}
		}
        $(document).ready(function () {
			load();
			
        });
                          
    </script> 