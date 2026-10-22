<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/paysettings/list_all'); ?>" action="<?php echo site_url('hr/paysettings/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="pay_id" id="pay_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Pay Settings', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/paysettings/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input name="pay_name" type="text" id="pay_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Enable*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input type="radio" name="pay_enable" data-validation="required" value="1"> Enable
                                    <input type="radio" name="pay_enable" value="0"> Disable
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Type', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select  name="pay_type" id="pay_type"  data-validation="required" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Earnings">Earnings</option>
                                        <option value="Deductions">Deductions</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Varying*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input type="radio" name="is_varying" data-validation="required" value="1"> Enable
                                    <input type="radio"  name="is_varying" value="0"> Disable
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
    load();
    function load() {
        var id = $("#pay_id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hr/paysettings/getpaysettings'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#pay_name").val(result.pay_name);
                    $("#pay_type").val(result.pay_type);
                    $("input[name=pay_enable][value='" + result.pay_enable + "']").prop("checked", true);
                    $("input[name=is_varying][value='" + result.is_varying + "']").prop("checked", true);
                }
            });
        }
    }
</script>
