<!-- 
    *********************************************************************************************
    *adddiscount
    *
    *
    *@author Althaf
    *@created on : 12-10-2019
    *
    *******************************************************************************************
 -->
 <?php  
	 
		$is_calendar = 0;	
		if(isset($settings[0]['is_calendar'])){
			$is_calendar = $settings[0]['is_calendar'];
		}
?>
<form method="post" id="frmcreatemodelc" back="<?php echo site_url('education/Student/batch'); ?>"
    action="<?php echo site_url('education/Student/saveBatch'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Create Branch', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('education/Student/batch'); ?>"
                                class="btn  btn-success align-bottom"
                                href="<?php echo site_url('education/Student/batch'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <input type="hidden" name="invoice" id='invoice' />
                    <div class="box-body">


						
						
                        <div class="row">
                            <div   class="col-sm-6 form-group">
                                <label class="col-sm-3">
                                    <?= label('Batch Name ', $this, $user) ?> <span class="required"></span> :</label>
                                <div class="col-sm-8">

                                    <input type ="text"  class="form-control" name="batchname" id="batchname">
                                </div>
                            </div>
						<?php if($is_calendar > 0  ){ ?>
                            
							<div   class="col-sm-6 form-group">
								<label class="col-sm-3">
                                    <?= label('Start Time', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-4">
                                    <select name="start_hours" id="start_hours" class="form-control">
                                        <option value='01'>01</option>
                                        <option value='02'>02</option>
                                        <option value='03'>03</option>
                                        <option value='04'>04</option>
                                        <option value='05'>05</option>
                                        <option value='06'>06</option>
                                        <option value='07'>07</option>
                                        <option value='08'>08</option>
                                        <option value='09'>09</option>
                                        <option value='10'>10</option>
                                        <option value='11'>11</option>
                                        <option value='12'>12</option>
										<option value='13'>13</option>
                                        <option value='14'>14</option>
                                        <option value='15'>15</option>
                                        <option value='16'>16</option>
                                        <option value='17'>17</option>
                                        <option value='18'>18</option>
                                        <option value='19'>19</option>
                                        <option value='20'>20</option>
                                        <option value='21'>21</option>
                                        <option value='22'>22</option>
                                        <option value='23'>23</option>
                                        <option value='00'>00</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
									 <select name="start_min" id="start_min" class="form-control">
											<option value='00:00'>00</option>
											<option value='30:00'>30</option>
									 </select>
                                    
                                </div>
							</div>
							<div  <?php if($is_calendar < 1 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">
								<label class="col-sm-3">
                                    <?= label('End Time', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-4">
                                    <select name="end_hours" id="end_hours" class="form-control">
                                        <option value='01'>01</option>
                                        <option value='02'>02</option>
                                        <option value='03'>03</option>
                                        <option value='04'>04</option>
                                        <option value='05'>05</option>
                                        <option value='06'>06</option>
                                        <option value='07'>07</option>
                                        <option value='08'>08</option>
                                        <option value='09'>09</option>
                                        <option value='10'>10</option>
                                        <option value='11'>11</option>
                                        <option value='12'>12</option>
										<option value='13'>13</option>
                                        <option value='14'>14</option>
                                        <option value='15'>15</option>
                                        <option value='16'>16</option>
                                        <option value='17'>17</option>
                                        <option value='18'>18</option>
                                        <option value='19'>19</option>
                                        <option value='20'>20</option>
                                        <option value='21'>21</option>
                                        <option value='22'>22</option>
                                        <option value='23'>23</option>
                                        <option value='00'>00</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
									 <select name="end_min" id="end_min" class="form-control">
											<option value='00:00'>00</option>
											<option value='30:00'>30</option>
									 </select>
                                    
                                </div>
							</div>
						<?php }?>
                            <div  <?php if($is_calendar >0 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">
                                <label class="col-sm-3">
                                    <?= label('Batch', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-4">
                                    <select name="selMonth" id="selMonth" class="form-control">
                                        <option value='JAN'>Janaury</option>
                                        <option value='FEB'>February</option>
                                        <option value='MAR'>March</option>
                                        <option value='APR'>April</option>
                                        <option value='MAY'>May</option>
                                        <option value='JUN'>June</option>
                                        <option value='JUL'>July</option>
                                        <option value='AUG'>August</option>
                                        <option value='SEP'>September</option>
                                        <option value='OCT'>October</option>
                                        <option value='NOV'>November</option>
                                        <option value='DEC'>December</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">

                                    <select name="selYear" id="selYear" class="form-control">
                                        <?php 
                for($year=2000; $year<=2030; $year++){
                    $sel = '';
                    if((int) $year == (int) date('Y') ){
                        $sel  ='selected';
                    }
                    echo '<option '.$sel.' value="'.$year.'">'.$year.'</option>';
                    }
                ?>
                                    </select>
                                </div>
                            </div>
                           


                        </div>

                        <div class="row">
                         <div <?php if($is_calendar >0 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">
                                <label class="col-sm-3">
                                    <?= label('Start Date ', $this, $user) ?> <span class="required"></span> :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control date" name="start_date" id="start_date" />
                                </div>
                            </div>
                            <div <?php if($is_calendar >0 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">
                                <label class="col-sm-3">
                                    <?= label('End Date ', $this, $user) ?> <span class="required"></span> :</label>

                                <div class="col-sm-8">

                                    <input type="text" class="form-control date" name="end_date" id="end_date" />
                                </div>
                            </div>


                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3">
                                    <?= label('Note ', $this, $user) ?> <span class="required"></span> :</label>
                                <div class="col-sm-8">

                                    <textarea class="form-control" name="note" id="note"></textarea>
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="box-footer">
                        <?php 
                        if($option != 'view'){
                        ?>
                        <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save'
                            class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php 
                        }
                        ?>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>

<script>
    load();

    function load() {
        var source_id = $("#source_id").val();
        if (source_id > 0) {
            $.ajax({
                url: "<?php echo site_url('source_of_enquiry/Source_of_enquiry/getsing'); ?>/" + source_id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#source").val(result.source_of_enquiry);
                    $("#Details").val(result.details);
                }
            });
        }

        var id = $('#id').val();
        // var option = $('#option').val()
        // alert(id);

        if (id != 0) {

            $.ajax({
                url: "<?php echo site_url('education/Student/getbatch'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#note").val(result.note);
                    $("#batchname").val(result.batchname);
                    $("#selMonth").val(result.month);
                    $("#selYear").val(result.year);
                    $("#start_date").val(result.start_dates);
                    $("#end_date").val(result.end_dates);
					
					$("#start_hours").val(result.start_hours);
                    $("#start_min").val(result.start_min);
                    $("#end_hours").val(result.end_hours);
                    $("#end_min").val(result.end_min);

                }
            });
        }


    }
</script>