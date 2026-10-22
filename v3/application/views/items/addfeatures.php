 <?php
    
    function getchild($list, $val) {
        $filter_rules = array(
            'itemtypeid' => $val
        );
        $filter = function ($player) use ($filter_rules) {
            foreach ($filter_rules as $rulekey => $rulevalue) {
                if ($player[$rulekey] != $rulevalue) {
                    return false;
                }
            }
            return true;
        };
        $filtered = array_filter($list, $filter);
        return $filtered;
    }
    ?> 
<style>

</style>
<form method="post" id="frmcreatemodeli" enctype="multipart/form-data" back="<?php echo site_url('items/features/').$id; ?>" action="<?php echo site_url('items/savefeature'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
       <section class="content">
			<div class="row">
				<div class="col-xs-12"> 
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><?= label('Add Feature', $this, $user) ?></h3>
							<span class="pull-right">
								<a role="button" back="<?php echo site_url('items/features/').$id; ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('items/features/').$id; ?>">
									<span class="glyphicon glyphicon-arrow-left" title="back"></span> 
								</a>
							</span>
						</div> 
						<div class="box-body">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-md-12">
										<div class="box box-solid">
											<div class="box-header with-border">
												<h3 class="box-title"><?php echo $category['name']?></h3>
											</div>
											<div class="box-body">
												<div class="box-group" id="accordion">
													<?php if(isset($itemtypemaster[0]['name'])){
														foreach($itemtypemaster as $item){?>
															<div class="panel box box-primary">
																<div class="box-header with-border">
																	<h4 class="box-title">
																		<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $item['id'] ?>" aria-expanded="false" class="collapsed">
																		<?php echo $item['name'] ?>
																		</a>
																	</h4>
																</div>
																<div id="collapse<?php echo $item['id'] ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																	<div class="box-body">
																		<?php 
																		$features = getchild($categoryfeature, $item['id']);
																		 if (count($features) > 0) {
																			 foreach ($features as $fea) {
																		?>
																			<div class="col-sm-4">
																				<input <?php if((float)$fea['category']>0){ echo 'checked';}?> style="margin:10px !important;" type="checkbox" id="feature" name="feature[]" value="<?php echo $fea['id']?>"><?php echo $fea['name']?>
																			</div>
																		<?php }}?>
																	</div>
																</div>
															</div>
														<?php }}?>
											
												</div>
											</div>
											<div class="box-footer popuphide">
													<button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
    </section>
</form>

<script type="text/javascript">
   
</script>