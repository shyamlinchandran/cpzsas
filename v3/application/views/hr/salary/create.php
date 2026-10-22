<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/Salary/create'); ?>" action="<?php echo site_url('hr/Salary/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="salary_id" id="salary_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Salary Components', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/Salary/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6  form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Salary Component*', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="component" class="form-control" id="component" data-validation="required">
                                    </div>
                                </div>
                                <div class="col-sm-6  form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Basic Amount', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="basic_amt" class="form-control" id="basic_amt" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6  form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Component Type*', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="component_type" class="form-control" id="component_type" data-validation="required">
                                            <option value="">----Select-----</option>
                                            <option value="allowance">Allowances</option>
                                            <option value="deduction">Deductions</option>
                                        </select>
                                    </div>
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
        var id = $('#salary_id').val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hr/Salary/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#component").val(result.component_name);
                    $("#basic_amt").val(result.basic_amount);
                    $("#component_type").val(result.component_type);
                }
            });
        }
    });
</script>
