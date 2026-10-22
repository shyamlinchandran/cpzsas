<?php

?>
<style>
	.red_color {
		color:red;
	}
</style>
<form method="post" id="frmcreatemodelc" enctype="multipart/form-data"
    back="<?php echo site_url('education/Schedule/listall'); ?>"
    action="<?php echo site_url('education/Schedule/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Create Schedule', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('education/Schedule/listall'); ?>"
                                class="btn  btn-success align-bottom"
                                href="<?php echo site_url('education/Schedule/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
						 <div class="col-sm-12">
                            <div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                 <?= label('Schedule', $this, $user) ?> *<span class="required"></span> :
                                 <input style="height:20px;" class="form-control" id="schedule" name="schedule" data-validation="required"    />
                            </div>
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                 <?= label('Start Date', $this, $user) ?> *<span class="required"></span> :
                                 <input style="height:20px;" class="form-control date" id="schedule_start_date" name="schedule_start_date" data-validation="required"    />
                            </div>
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                 <?= label('End Date', $this, $user) ?> *<span class="required"></span> :
                                 <input style="height:20px;" class="form-control date" id="schedule_end_date" name="schedule_end_date" data-validation="required"    />
                            </div>
							<div class="col-sm-3 " style="padding-right:10px;padding-bottom:10px;">
                                 <?= label('Description', $this, $user) ?> *<span class="required"></span> :
								<textarea id="description"  name="description" class="form-control"></textarea>
							</div>
						</div>
						 <div class="col-sm-12 table-responsive">
							<table style="width:100% " border="1" cellpadding="0" cellspacing="0">
								<tr>
									<td style="width:9%;text-align:center">
									&nbsp;
									</td>
									<td style="width:13%;text-align:center">
										Sunday
									</td>
									<td style="width:13%;text-align:center">
										Monday
									</td>
									<td style="width:13%;text-align:center">
										Tuesday
									</td>
									<td style="width:13%;text-align:center">
										Wednesday
									</td>
									<td style="width:13%;text-align:center">
										Thursday
									</td>
									<td style="width:13%;text-align:center">
										Friday
									</td>
									<td style="width:13%;text-align:center">
										Saturday
									</td>
								</tr>
								<tbody>
									<?php foreach($times as $item){?>
										<tr>
											<td style="width:9%;text-align:center;height:40px;">
												<label><?php echo $item['time'];?></label>
												<input type="hidden" name="schedule_time[]" id="schedule_time" value="<?php echo $item['time_id'];?>"/>
											</td>
											<td style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="7"/>
												<input type="hidden" name="dayname[]" id="dayname" value="sunday"/>
												<select style="height:40px;" id="sunday_<?php echo $item['time_id'];?>" name="sunday_<?php echo $item['time_id'];?>" class="form-control">
													<?php echo $classes;?>
												</select>
											</td>
											<td style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="1"/>
												<input type="hidden" name="dayname[]" id="dayname" value="monday"/>
												<select id="monday_<?php echo $item['time_id'];?>" name="monday_<?php echo $item['time_id'];?>" class="form-control">
													<?php echo $classes;?>
												</select>
											</td>
											<td style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="2"/>
												<input type="hidden" name="dayname[]" id="dayname" value="tuesday"/>
												<select id="tuesday_<?php echo $item['time_id'];?>" name="tuesday_<?php echo $item['time_id'];?>" class="form-control">
													<?php echo $classes;?>
												</select>
											</td>
											<td style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="3"/>
												<input type="hidden" name="dayname[]" id="dayname" value="wednesday"/>
												<select id="wednesday_<?php echo $item['time_id'];?>" name="wednesday_<?php echo $item['time_id'];?>" class="form-control">
													<?php echo $classes;?>
												</select>
											</td>
											<td style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="4"/>
												<input type="hidden" name="dayname[]" id="dayname" value="thursday"/>
												<select id="thursday_<?php echo $item['time_id'];?>" name="thursday_<?php echo $item['time_id'];?>" class="form-control">
													<?php echo $classes;?>
												</select>
											</td>
											<td style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="5"/>
												<input type="hidden" name="dayname[]" id="dayname" value="friday"/>
												<select id="friday_<?php echo $item['time_id'];?>" name="friday_<?php echo $item['time_id'];?>" class="form-control">
													<?php echo $classes;?>
												</select>
											</td>
											<td style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="6"/>
												<input type="hidden" name="dayname[]" id="dayname" value="saturday"/>
												<select id="saturday_<?php echo $item['time_id'];?>" name="saturday_<?php echo $item['time_id'];?>" class="form-control">
													<?php echo $classes;?>
												</select>
											</td>
											
											
										</tr>
									<?php } ?>
								</tbody>
							</table>
						 </div>
                    </div>
                    <div class="box-footer popuphide">
                        <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
					 </div>
                </div>


                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>



<script type="text/javascript">
	function load(){
		var id = $('#id').val();
		if(parseFloat(id) > 0 ){
			$.ajax({
				url: "<?php echo site_url('education/Schedule/getsing'); ?>/"+id,
				async: false,
				success: function (result) {
					$.each(JSON.parse(result), function (i, itemsingle) {
						$('#schedule').val(itemsingle.schedule_name);
						$('#schedule_start_date').val(itemsingle.start_date);
						$('#schedule_end_date').val(itemsingle.end_date);
						$('#description').val(itemsingle.description);
						$('#'+itemsingle.dayname+'_'+itemsingle.time).val(itemsingle.class);
					});
               
				}
			});
		}
	}
    $(document).ready(function () {
		load();
  
    });
</script>