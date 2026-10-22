<?php

?>
<style>
	.red_color {
		color:red;
	}
	td{
		height:50px;
		font-weight:bold;
		
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
                        <h3 class="box-title"><?= label('Schedule', $this, $user) ?></h3>
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
							<h3 style="text-align:center;">Lotus Yoga class schedule </h3>
							<p  style="text-align:center;">
							<span id="schedule"></span><br />
								From :&nbsp;  <span id="from"></span>&nbsp;&nbsp; to :&nbsp;  <span id="to"></span><br />
								
							</p>
							
						</div>
						 <div class="col-sm-12 table-responsive">
							<table class="table table-responsive" style="width:100% " border="1" cellpadding="0" cellspacing="0">
								<tr>
									<td style="width:9%;text-align:center">
									&nbsp;
									</td>
									<td style="width:13%;text-align:center">
										Sunday
										<select style="display:none" id="classes" name="classes">
											<?php echo $classes;?>
										</select>
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
											<td style="width:9%;text-align:center;">
												<label><?php echo $item['time'];?></label>
												<input type="hidden" name="schedule_time[]" id="schedule_time" value="<?php echo $item['time_id'];?>"/>
											</td>
											<td id="sunday_<?php echo $item['time_id'];?>"  style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="7"/>
												<input type="hidden" name="dayname[]" id="dayname" value="sunday"/>
											</td>
											<td id="monday_<?php echo $item['time_id'];?>"  style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="1"/>
												<input type="hidden" name="dayname[]" id="dayname" value="monday"/>
											</td>
											<td id="tuesday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="2"/>
												<input type="hidden" name="dayname[]" id="dayname" value="tuesday"/>
											</td>
											<td id="wednesday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="3"/>
												<input type="hidden" name="dayname[]" id="dayname" value="wednesday"/>
											</td>
											<td  id="thursday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="4"/>
												<input type="hidden" name="dayname[]" id="dayname" value="thursday"/>
											</td>
											<td id="friday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="5"/>
												<input type="hidden" name="dayname[]" id="dayname" value="friday"/>
											</td>
											<td id="saturday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="6"/>
												<input type="hidden" name="dayname[]" id="dayname" value="saturday"/>
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
						$('#schedule').html(itemsingle.schedule_name);
						$('#from').html(itemsingle.start_date);
						$('#to').html(itemsingle.end_date);
						var text = '';
						if(parseFloat(itemsingle.class) > 0  ){
							text = $("#classes [value=" + itemsingle.class + "]").text();
						}
						if(itemsingle.bg_color !== '' ){
							$('#'+itemsingle.dayname+'_'+itemsingle.time).attr('bgcolor',itemsingle.bg_color);
						}
						$('#'+itemsingle.dayname+'_'+itemsingle.time).html(text);
					});
               
				}
			});
		}
	}
    $(document).ready(function () {
		load();
  
    });
</script>