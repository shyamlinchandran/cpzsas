<form method="post"  id="frmcreate" back="<?php echo site_url('accounts_master/ledger/create'); ?>" action="<?php echo site_url('accounts_master/ledger/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php
                            $title = label($title, $this, $user);
                            echo ucwords(str_replace('_', ' ', $title));
                            ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('accounts_master/ledger/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('accounts_master/ledger/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Name', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                                </div>
                            </div>                              
                            <?php if ($this->multiple != 0) { ?>
                                <div class="col-sm-6 form-group odd_cls">
                                    <label class="col-sm-4 control-label">
                                        <?= label('name_lan', $this, $user) ?>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="name_lan" class="form-control" name="name_lan" type="text" value=""   maxlength="50">              
                                    </div> 
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Opening Balance', $this, $user) ?>  :
                                    </label>
                                    <div class="col-sm-6">
                                        <input id="open_balance" value="0.00" class="form-control two-digits price" name="open_balance" type="text" value=""   maxlength="50">              
                                    </div>                                     
                                    <div class="col-sm-2">
                                        <select name="ledger_type" id="ledger_type" class="form-control">
                                            <option value="Dr">Dr</option>
                                            <option value="Cr">Cr</option>
                                        </select>
                                    </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Ledger Group', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <select class="form-control" name="main_acc" id="main_acc" data-validation="required">
                                        <option></option>
                                    </select>             
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" >                            
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Tax', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <select class="form-control" name="tax_id" id="tax_id">
                                        <option></option>
                                    </select>              
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Code', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input id="ledger_code" class="form-control" name="ledger_code" type="text" value="" maxlength="50">
                                </div>
                            </div> 
                        </div>
                        <div class="form-group" >
                        </div> 
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
            main_ledgers();
            taxes(0);
            $('#mybtn').click(function () {
                var ms = $("#frmcreate").isValid();
                if (ms !== true) {
                    return;
                }
            });
            load();
        });
        var inc_inary = 0;
        function load() {
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('accounts_master/ledger/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#name").val(result.name);
                        $("#name_lan").val(result.name_lan);
                        $("#main_acc").val(result.acc_main_id);
                        $("#tax_id").val(result.tax_id);
                        $("#ledger_type").val(result.type);
                        $("#open_balance").val(result.openning_bal);
                        $("#ledger_code").val(result.acc_ledger_code);
                    }
                });
            }
        }
        function main_ledgers()
        {
            $.ajax({
                url: "<?php echo site_url('accounts_master/ledger/main_ledger'); ?>/",
                async: false,
                success: function (result) {
                    $("#main_acc").html(result);
                }
            });
        }
        function taxes(is_select)
        {
            $.ajax({
                url: "<?php echo site_url('master/amaster/tax'); ?>/",
                async: false,
                success: function (result) {
                    var option = '<option value ="0">select</option>';
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        option = option + '<option value ="' + itemsingle.gstid + '"> ' + itemsingle.GST + '</option>';
                    });
                    $("#tax_id").html(option);
                    if (is_select === 1) {
                        var myVal = $('#tax_id option:last').val();
                        $('#tax_id').val(myVal);
                        gettaxldg(myVal);
                    }
                }
            });
        }
    </script>
