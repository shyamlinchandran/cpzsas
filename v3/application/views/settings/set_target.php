<form method="post"  id="frmcreate" back="<?php echo site_url('settings/NewMaster/set_target'); ?>" action="<?php echo site_url('settings/NewMaster/save_target'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Set Target For <b> <?php echo $user['user_name'] ;?></b></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/NewMaster/set_target'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('settings/NewMaster/set_target/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
						 <div class="col-sm-12" style="margin-bottom:20px;" >
							 <div class="col-sm-6">
								<label class="col-sm-4 control-label">
									<?= label('Daily Target', $this, $user) ?> <span class="required"></span> :
                                </label>
								<div class="col-sm-8">
									<input id="daily"  value="<?php echo $user['daily'] ;?>" class="form-control two-digits"  name="daily" type="text"  autocomplete="off"  maxlength="250" />
								</div>
							 </div>
						 </div>
						 <div class="col-sm-12" style="margin-bottom:20px;">
							 <div class="col-sm-6">
								<label class="col-sm-4 control-label">
									<?= label('Weekly Target', $this, $user) ?> <span class="required"></span> :
                                </label>
								<div class="col-sm-8">
									<input id="weekly" value="<?php echo $user['weekly'] ;?>"  class="form-control two-digits"  name="weekly" type="text"  autocomplete="off"  maxlength="250" />
								</div>
							 </div>
						 </div>
						 <div class="col-sm-12" style="margin-bottom:20px;">
							 <div class="col-sm-6">
								<label class="col-sm-4 control-label">
									<?= label('Yearly Target', $this, $user) ?> <span class="required"></span> :
                                </label>
								<div class="col-sm-8">
									<input id="yearly"  value="<?php echo $user['yearly'] ;?>" class="form-control two-digits"  name="yearly" type="text"  autocomplete="off"  maxlength="250" />
								</div>
							 </div>
						 </div>
						 <div class="col-sm-12" style="margin-bottom:20px;">
							<table style="width:100%" class="table table-stripped table-condensed">
								<tr>
									<th colspan="6" style="text-align:center">Monthly Target</th>
								</tr>
								<tr>
									<td><label>JAN</label></td>
									<td><input type="text" id="jan" name="jan"  value="<?php echo $user['jan'] ;?>" class="form-control two-digits" ></td>
									<td><label>FEB</label></td>
									<td><input type="text" id="feb" name="feb"  value="<?php echo $user['feb'] ;?>" class="form-control two-digits" ></td>
									<td><label>MAR</label></td>
									<td><input type="text" id="mar" name="mar"  value="<?php echo $user['mar'] ;?>" class="form-control two-digits" ></td>
								</tr>
								<tr>
									<td><label>APR</label></td>
									<td><input type="text" id="apr" name="apr"  value="<?php echo $user['apr'] ;?>" class="form-control two-digits" ></td>
									<td><label>MAY</label></td>
									<td><input type="text" id="may" name="may"  value="<?php echo $user['may'] ;?>" class="form-control two-digits" ></td>
									<td><label>JUN</label></td>
									<td><input type="text" id="jun" name="jun"  value="<?php echo $user['jun'] ;?>" class="form-control two-digits" ></td>
								</tr>
								<tr>
									<td><label>JUL</label></td>
									<td><input type="text" id="jul" name="jul"  value="<?php echo $user['jul'] ;?>" class="form-control two-digits" ></td>
									<td><label>AUG</label></td>
									<td><input type="text" id="aug" name="aug"  value="<?php echo $user['aug'] ;?>" class="form-control two-digits" ></td>
									<td><label>SEP</label></td>
									<td><input type="text" id="sep" name="sep"  value="<?php echo $user['sep'] ;?>" class="form-control two-digits" ></td>
								</tr>
								<tr>
									<td><label>OCT</label></td>
									<td><input type="text" id="oct" name="oct"  value="<?php echo $user['oct'] ;?>" class="form-control two-digits" ></td>
									<td><label>NOV</label></td>
									<td><input type="text" id="nov" name="nov"  value="<?php echo $user['nov'] ;?>" class="form-control two-digits" ></td>
									<td><label>DEC</label></td>
									<td><input type="text" id="dec" name="dec"  value="<?php echo $user['december'] ;?>" class="form-control two-digits" ></td>
								</tr>
							</table>
						 </div>
						 <div class="col-sm-12">
							
						 </div>
                        
                        <!-- /.box -->
                    </div>
					<div class="box-footer">
                          <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                     </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
     
        });

    </script>
