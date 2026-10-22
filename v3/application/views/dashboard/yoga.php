 
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <small></small>
    </h1> 
</section> 
<style>
	td{
		height:35px;
	}
</style>
<section class="content"> 
   <div class="box">
        <div class="box-header">
			<h3 class="box-title"></h3>
		 </div>
				<input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
					<div class="col-sm-12">
							<h3 style="text-align:center;">Lotus Yoga class schedule </h3>
							<p  style="text-align:center;">
							<span id="schedule"></span><br />
								From :&nbsp;  <span id="from"></span>&nbsp;&nbsp; to :&nbsp;  <span id="to"></span><br />
								
							</p>
							
						</div>
						<div class="box-body table-responsive">
							<table class="table table-responsive" style="width:100% " border="2" cellpadding="0" cellspacing="0">
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
											<td  style="width:9%;text-align:center;">
												<label><?php echo $item['time'];?></label>
												<input type="hidden" name="schedule_time[]" id="schedule_time" value="<?php echo $item['time_id'];?>"/>
											</td>
											<td onclick="loadattendence(this)" cls_id ="" time="<?php echo $item['time_id'];?>" id="sunday_<?php echo $item['time_id'];?>"  style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="7"/>
												<input type="hidden" name="dayname[]" id="dayname" value="sunday"/>
											</td>
											<td onclick="loadattendence(this)"  cls_id ="" time="<?php echo $item['time_id'];?>" id="monday_<?php echo $item['time_id'];?>"  style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="1"/>
												<input type="hidden" name="dayname[]" id="dayname" value="monday"/>
											</td>
											<td onclick="loadattendence(this)"  cls_id ="" time="<?php echo $item['time_id'];?>" id="tuesday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="2"/>
												<input type="hidden" name="dayname[]" id="dayname" value="tuesday"/>
											</td>
											<td onclick="loadattendence(this)"  cls_id ="" time="<?php echo $item['time_id'];?>" id="wednesday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="3"/>
												<input type="hidden" name="dayname[]" id="dayname" value="wednesday"/>
											</td>
											<td  onclick="loadattendence(this)"  cls_id ="" time="<?php echo $item['time_id'];?>"  id="thursday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="4"/>
												<input type="hidden" name="dayname[]" id="dayname" value="thursday"/>
											</td>
											<td onclick="loadattendence(this)"  cls_id ="" time="<?php echo $item['time_id'];?>" id="friday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="5"/>
												<input type="hidden" name="dayname[]" id="dayname" value="friday"/>
											</td>
											<td onclick="loadattendence(this)"  cls_id ="" time="<?php echo $item['time_id'];?>" id="saturday_<?php echo $item['time_id'];?>" style="width:13%;text-align:center">
												<input type="hidden" name="day[]" id="day" value="6"/>
												<input type="hidden" name="dayname[]" id="dayname" value="saturday"/>
											</td>
											
											
										</tr>
									<?php } ?>
								</tbody>
							</table>
						 </div>
         
    
  </div>  
     
</section>

   <script type="text/javascript">
   
   function loadattendence(btn){
		var cls_id = $(btn).attr('cls_id');
		if(cls_id !== '' ){
			var time = $(btn).attr('time');
			var arr = [];
			arr.push({
				cls_id: cls_id,
				time: time
			});
			createCookie('attendance', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>education/Attendance/listall?newpage=new");
			$("#last_click").click();
		}
	}
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
							//$('#'+itemsingle.dayname+'_'+itemsingle.time).attr('bgcolor',itemsingle.bg_color);
							$('#'+itemsingle.dayname+'_'+itemsingle.time).attr('cls_id',itemsingle.cls_id);
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
 