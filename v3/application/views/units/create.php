<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('BasicUnits/listall'); ?>" action="<?php echo site_url('BasicUnits/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Units', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('BasicUnits/listall'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Unit', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="unit" type="text" id="unit" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Parent', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
									<select name="parent" id="parent" class="form-control">
									
									</select>
                                </div> 
                            </div>
							<div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('UQC', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
									<select data-validation="required" name="uqc" id="uqc" class="form-control">
									
									</select>
                                </div> 
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Code', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="code" type="text" id="code" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Code">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Count', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="count" value="1" class="form-control two-digits " name="count" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                        </div>
                    </div>  

                  


                    <div class="box-footer">    
                        <?php
                        if ($type != 'view') {
                            echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                        }
                        ?>      
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</form>


<script type="text/javascript">
	$(document).ready(function () {
		$.ajax({
            url: "<?php echo site_url('Ajaxcall/uqc'); ?>",
			async:false,
            success: function (result) {
               $('#uqc').html(result);
            }
        });
		var id = $('#id').val();
		 $.ajax({
            url: "<?php echo site_url('BasicUnits/parent') . '/' . $id; ?>",
			async:false,
            success: function (result) {
               $('#parent').html(result);
				load();
            }
        });
	});
    function load() {
        var id = $("#id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('BasicUnits/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
					$('#unit').val(result.name);
					$('#uqc').val(result.uqc);
					$('#parent').val(result.unit_id);
					$('#code').val(result.code);
					$('#count').val(result.unit_count);
                }
            });
        }
    }
</script>
