<form method="post" id="frmcreate" back="<?php echo site_url('settings/AlertDues/dues_list'); ?>" action="<?php echo site_url('settings/AlertDues/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="dues" name="type" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/AlertDues/dues_list/'); ?>" class="btn btn-success align-bottom" href="<?php echo site_url('settings/AlertDues/dues_list/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">Company* :</label>
                            <div class="col-sm-4">
                               <select name="company_id" id="company_id" class="form-control" <?php echo ($view == 'edit') ? 'disabled' : ''; ?> data-validation="required">
                                    <option value="">Select</option>
                                </select>              
                            </div>
                            <label class="col-sm-2 control-label">Voucher No* :</label>
                            <div class="col-sm-4">
                                <input id="voucherno" class="form-control" name="voucherno" type="text" value="" data-validation="required">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">Ledger* :</label>
                            <div class="col-sm-4">
                                <input id="ledger" class="form-control" name="ledger" type="text" value="" data-validation="required">              
                            </div>
                            <label class="col-sm-2 control-label">Amount* :</label>
                            <div class="col-sm-4">
                                <input id="amount" class="form-control" name="amount" type="number" step="0.01" value="" data-validation="required">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">Due Date* :</label>
                            <div class="col-sm-4">
                                <input id="duedate" class="form-control" name="duedate" type="date" value="" data-validation="required">              
                            </div>
                            <label class="col-sm-2 control-label">Time* :</label>
                            <div class="col-sm-4">
                                <input id="time" class="form-control" name="time" type="time" value="">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">Remarks :</label>
                            <div class="col-sm-8">
                                <textarea id="remarks" class="form-control" name="remarks" style="height: 100px;"></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
            getcompanies();
            load();
        });
        function getcompanies() {
            $.ajax({
                url: "<?php echo site_url('settings/AlertDues/getcompanies'); ?>/",
                async: false,
                success: function (result) {
                    $("#company_id").html(result);
                }
            });
        }
        function load() {
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('settings/AlertDues/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        if (Array.isArray(result) && result.length > 0) { result = result[0]; }
                        $("#company_id").val(result.company);
                        $("#voucherno").val(result.voucherno);
                        $("#ledger").val(result.ledger);
                        $("#remarks").val(result.remarks);
                        $("#amount").val(result.amount);
                        $("#duedate").val(result.duedate);
                        $("#time").val(result.time);
                    }
                });
            } 
        }
    </script>
</form>
