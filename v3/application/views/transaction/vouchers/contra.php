<?php
$cost_centre = $settings[0]['is_costcenter'];
$select_master = $settings[0]['select_master'];
$is_ageing = $settings[0]['is_ageing'];
//$select_master =0;
$type = 'contra';
?> 
<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/vouchers/contra'); ?>" action="<?php echo site_url('transaction/vouchers/savecontra'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid"/> 
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/> 
    <input type="hidden" id="ledid" name="ledid"  value="0"/> 
    <input type="hidden" id="contra_invoice" name="contra_invoice"  value=""/> 
    <input type="hidden" id="select_master" name="select_master"  value="<?php echo $select_master; ?>"/> 
    <input type="hidden"   name="def_accid" id="def_accid"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Contra Voucher', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('transaction\Vouchers\listall\contra'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body"> 

                        <div class="col-sm-6">  
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Date', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input class="form-control date" id="date" autocomplete="false" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Billtype', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select  id="btype" name="btype" class="form-control " >                                            
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Voucher Number', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <p><span class="new-invoice" ><label spellcheck="false" id="contrainvoice"></label></p>
                                    <input type="hidden" name="invoice" type="text" id="invoice" class="form-control" placeholder="Voucher Number">
                                </div>
                            </div>



                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Transaction Type', $this, $user) ?></label>

                                <div class="col-sm-8">   
                                    <select data-validation="required"  id="contra_type" class="form-control" name="contra_type" >
                                        <option value="">Select</option> 
                                        <option value="deposite">Deposit</option> 
                                        <option value="withdraw">Withdrawal</option> 
                                        <option value="cashtocash">Cash To Cash</option> 
                                        <option value="banktobank">Bank To Bank</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('From', $this, $user) ?></label>
                                <div  class="col-sm-8">
                                    <select data-validation="required" id="frm_act" class="form-control" name="frm_act" >
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('To', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select  data-validation="required"   id="to_act" class="form-control" name="to_act" >
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Amount', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <input name="amount" type="text"  id="amount"    data-validation="number" data-validation-allowing="float"    class="form-control  two-digits"  placeholder="Amount"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"><?= label('Narration', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" data-validation="length" data-validation-length="min5"  id="address_line1" name="narration"></textarea>
                                </div>
                            </div>
                        </div> 



                    </div>

                    <div class="box-footer">          
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           

                        <div class='small-loading' id='FormLoading'> </div>

                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
<script type="text/javascript">
    function load() {
        var vid = $('#vid').val();
        if (vid !== '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/vouchers/getcontraVoucher'); ?>/" + vid + "",
                async: false,
                success: function (results) {
                    //alert(JSON.stringify(results));
                    var result = JSON.parse(results);
                    $('#invoice').html(result[0].voucher_no);
                    $('#contrainvoice').html(result[0].voucher_no);
                    $('#amount').val(result[0].amount);
                    $('#address_line1').val(result[0].naration);
                    $('#date').val(result[0].dtp);
                    $('#btype').val(result[0].bill_type);
                    $('#contra_type').val(result[0].contra_type);
                    var amount = result[0].credit_amounnt;
                    if (parseFloat(amount) > 0) {
                        var credit = result[0].acc_ledgers_id;
                        var debit = result[1].acc_ledgers_id;
                    } else {
                        var credit = result[1].acc_ledgers_id;
                        var debit = result[0].acc_ledgers_id;
                    }
                    setledgers(result[0].contra_type, credit, debit);
                }
            });

        } else {
        }
    }

    function setledgers(contra_type = "", credit = "", debit = "") {
        if (contra_type === "") {
            contra_type = $("#contra_type").val();
        }
        $('#frm_act').html('<option value="">Select</option>');
        $('#to_act').html('<option value="">Select</option>');
        if (contra_type !== "") {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/setledgers/4'); ?>",
                success: function (result) {
                    if (contra_type === 'deposite') {
                        $('#frm_act').html(result);
                        if (credit !== "") {
                            $('#frm_act').val(credit);
                        }
                    } else if(contra_type =='withdraw'){
                        $('#to_act').html(result);
                        if (debit !== "") {
                            $('#to_act').val(debit);
                        }
                    }else if(contra_type =='cashtocash'){
                        $('#to_act').html(result);
                        if (debit !== "") {
                            $('#to_act').val(debit);
                        }

                        $('#frm_act').html(result);
                        if (credit !== "") {
                            $('#frm_act').val(credit);
                        }
                    }
                }
            });

            $.ajax({
                url: "<?php echo site_url('ajaxcall/setledgers/1'); ?>",
                success: function (result) {
                    if (contra_type === 'deposite') {
                        $('#to_act').html(result);
                        if (debit !== "") {
                            $('#to_act').val(debit);
                        }

                    }  else if(contra_type =='withdraw'){
                        $('#frm_act').html(result);
                        if (credit !== "") {
                            $('#frm_act').val(credit);
                        }
                    }else if(contra_type =='banktobank'){
                        $('#to_act').html(result);
                        if (debit !== "") {
                            $('#to_act').val(debit);
                        }

                        $('#frm_act').html(result);
                        if (credit !== "") {
                            $('#frm_act').val(credit);
                        }
                    }
                }
            });
    }
    }

    function setbillno(id) {
        var vid = $('#vid').val();
        if (vid === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/Vouchers/getnewinoviceno'); ?>/" + id,
                success: function (result) {
                    var suffix = $('#btype').find(':selected').attr('suffix');
                    var prefix = $('#btype').find(':selected').attr('preffix');
                    var seperator = $('#btype').find(':selected').attr('seperator');
                    $('#contrainvoice').html(prefix + seperator + result + seperator + suffix);
                    $('#invoice').val(prefix + seperator + result + seperator + suffix);
                }
            });
        }
    }
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
            success: function (result) {
                $('#btype').html(result);
                var billtype = $('#btype').val();
                setbillno(billtype);
            }
        });
        $('#btype').change(function () {
            var billtype = $('#btype').val();
            setbillno(billtype);
        });

        $('#contra_type').change(function () {
            setledgers();
        });

        load();
    })
</script>

