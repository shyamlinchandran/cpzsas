<?php
$ageing_adjustment = 0 ;
if (isset($settings[0]['ageing_adjustment'])) {
    $ageing_adjustment = $settings[0]['ageing_adjustment'];
}

$select_salesman = 0 ;
if (isset($settings[0]['select_salesman'])) {
    $select_salesman = $settings[0]['select_salesman'];
}
$cost_centre = $settings[0]['is_costcenter'];
$select_master = $settings[0]['select_master'];
$is_ageing = $settings[0]['is_ageing'];
$type = 'rec';
$user = $this->session->userdata('user');
$user_id = $user['Id'];


$user = $this->session->userdata('user');
$user_default_billtype = '';
if (isset($user['default_rec_billtype'])) {
	$user_default_billtype = $user['default_rec_billtype'];
}
?>
<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate" home="<?php echo site_url('transaction/vouchers/index'); ?>" back="<?php echo site_url('transaction/vouchers/receipt'); ?>" action="<?php echo site_url('transaction/vouchers/save'); ?>" class="form-horizontal">
    <input type="hidden" value="rec" name="type" />
    <input type="hidden" name="paid" id="paid" />
    <input type="hidden" value="<?php echo $ageing_adjustment; ?>" name="ageing_adjustment" id='ageing_adjustment' />
    <input type="hidden" name="is_autocheck" id="is_autocheck" value="0" />
    <input type="hidden" value="<?php echo $user_default_billtype; ?>" name="user_default_billtype" id='user_default_billtype' />
    <input type="hidden" id="ledid" name="ledid" value="0" />
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id='user_id' />
    <input type="hidden" id="select_master" name="select_master" value="<?php echo $select_master; ?>" />
    <input type="hidden" id="vid" name="vid" value="<?php echo $id; ?>" />
    <input type="hidden" id="iv_no" name="iv_no">
    <input type="hidden" id="autoinvoice" name="autoinvoice">
    <input type="hidden" id="new_invoice" name="new_invoice">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Receipt Voucher', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('transaction\Vouchers\listall\receipt'); ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Date', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input class="form-control date" id="date" name="date" data-validation="required,date" data-validation-format="dd/mm/yyyy" placeholder="Date" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Voucher Number', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <p><span class="new-invoice"><label spellcheck="false" id="prefix"></label><label spellcheck="false" id="sep_first"></label><label class="two-digits price" ondblclick="changeinvoice()" NoTab="true" spellcheck="false" id="b_no"></label><label spellcheck="false" id="sep_second"></label><label spellcheck="false" id="suffix"></label></span></p>
                                    <input name="invoice" type="hidden" id="invoice" class="form-control" placeholder="Voucher Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Reference', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="reference" name="reference" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Billtype', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select id="btype" name="btype" class="form-control ">
                                    </select>
                                </div>
                            </div>
                            <?php if ($cost_centre == '1') { ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?= label('Cost Centre', $this, $user) ?></label>

                                    <div class="col-sm-8">
                                        <select id="Costcenter" class="form-control" name="Costcenter">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Cash / Bank', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select data-validation="required" id="paytype" name="paytype" class="form-control " autofocus>
                                        <option value="4"><?= label('Cash', $this, $user) ?></option>
                                        <option value="1"><?= label('Bank', $this, $user) ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Select Account', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select id="frmact" name="frmact" class="form-control ">
                                    </select>
                                </div>
                            </div>

                            <?php if ($select_master == '1') { ?>

                                <div style="display: none" class="form-group">
                                    <label class="col-sm-4 control-label"><?= label('Main Ledger', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="ledgerid" id="ledgerid" />
                                        <input name="ledname" NoTab="true" type="text" id="ledname" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                            <?php } ?>


                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('From Account', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input type="hidden" name="toid" id="toid" />
                                    <input name="name" NoTab="true" type="text" id="name" data-validation="length" data-validation-length="min2" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Amount', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input name="amount" type="text" id="amount" data-validation="number" data-validation-allowing="float" class="form-control  two-digits" placeholder="Amount" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Balance', $this, $user) ?> </label>

                                <div class="col-sm-8">
                                    <span id="balance" class="form-control" placeholder="Balance" disabled="true"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Narration', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <textarea class="form-control" data-validation="length" data-validation-length="min5" id="narration" name="narration">Amount Received</textarea>
                                </div>
                            </div>
							<div class="form-group" style="display:none">
                                <label class="col-sm-4 control-label"><?= label('Selected Invoices', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <textarea readonly class="form-control"  id="invoices" name="invoices">Invoices</textarea>
                                </div>
                            </div>
							<div <?php if( $select_salesman < 1){?> style = "display:none;"  <?php }?> class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Salesman', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select id="salesman" name="salesman" class="form-control ">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if ($is_ageing == '1') { ?>
                            <div class="col-sm-6">
                                <?= label('Auto Aging', $this, $user) ?> <input type="checkbox" name="autoCheck" checked="checked" id="autoCheck" />
                                <table id="table" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?= label('Check', $this, $user) ?></th>
                                            <th><?= label('Voucher Number', $this, $user) ?></th>
                                            <th><?= label('Debit', $this, $user) ?></th>
                                            <th><?= label('Credit', $this, $user) ?></th>
                                            <th><?= label('Balance', $this, $user) ?></th>
                                             <?php if($ageing_adjustment > 0 ){?>
                                                <th><?= label('Adjust', $this, $user) ?></th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($view != 'view' && $is_edit >  0) { ?>
                        <div class="box-footer">
                            <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <?php if ($id == $max_id && $id !== 0) { ?>
                                <a tp="confirm" base="<?php echo base_url() . 'transaction/vouchers/listall/receipt' ?>" message="Do you want Delete ?" success="Delete  successfuly " id="form-button-delete" style="float:right" type='button' data-toggle="tooltip" val="delete" href="<?php echo  base_url() . 'transaction/vouchers/delete/' ?><?php echo $id ?>" title='Save' class='btn bg-red btn-flat'> Delete </a>
                            <?php } else if ($id !== $max_id && $id !== 0) { ?>
                                <a tp="confirm" base="<?php echo base_url() . 'transaction/vouchers/listall/receipt' ?>" message="Do you want Cancel ?" success="Cancel successfuly " id="form-button-cancel" style="float:right" type='button' data-toggle="tooltip" val="cancel" href="<?php echo base_url() . 'transaction/vouchers/cancel/' ?><?php echo $id ?>" title='Save' class='btn bg-orange btn-flat'> Cancel </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
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
    $.validate({
        modules: 'date, security,file'
    });

    function calert(msg) {
        toastr["error"](msg);
    }
    $(document).on('change', '.chkchg', function() {
		var narrations = '';
		console.log('Start');
        $.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function(result) {
                $('#Costcenter').html(result)
            }
        });
        var totalamount = getVal('amount');
        var autoCheck = $(this).is(':checked');
		
        if (autoCheck === true) {
            var id = $(this).attr('id');
            var hddbt = "hddbt" + id;
            var hdcrdt = getVal("hdcrdt" + id);
            var txtamt = "#txtamt" + id;
            var bal = parseFloat(totalamount) - parseFloat(hdcrdt);
            if (parseFloat(totalamount) < parseFloat(hdcrdt)) {
                $(txtamt).val(totalamount);
            } else {
                totalamount = (parseFloat(totalamount) - parseFloat(hdcrdt)).toFixed(2);
                $(txtamt).val(hdcrdt);
            }
			if(narrations !==''){
				narrations = narrations +',';
			}
			narrations = narrations + $('#lblvoucher'+id).html();
			console.log('Start'+narrations);
            var txtbal = "#txtbal" + id;
            if (bal < 0 || bal === 0) {
                $(txtbal).val((-1 * parseFloat(bal)).toFixed(2));
                Update_ageing_adjustment(id);
                return false;
            } else {
                $(txtbal).val(0.00);
                Update_ageing_adjustment(id);
            }
        }
		$('#invoices').val(narrations);
    });

    $('.new-invoice').on('DOMFocusOut', function() {
        $('#paytype').focus();
        var newinvoice = $('#b_no').text();
        var oldinvoice = $('#iv_no').text();
        var suffix = $('#btype').find(':selected').attr('suffix');
        var prefix = $('#btype').find(':selected').attr('preffix');
        var seperator = $('#btype').find(':selected').attr('seperator');
        if (newinvoice !== '') {
            var invoice = prefix + seperator + newinvoice + seperator + suffix;
            $.ajax({
                url: "<?php echo site_url('transaction/Vouchers/alreadyexistcheck'); ?>",
                type: 'POST',
                data: {
                    field1: invoice
                },
                success: function(result) {
                    var invoice = result;
                    if (result === "0") {
                        $("#new_invoice").val(newinvoice);
                        $('#b_no').html(newinvoice);
                        $("#new_invoice").val(prefix + seperator + newinvoice + seperator + suffix);
                    } else {
                        newinvoice = oldinvoice;
                        calert('Invoice Already Exist');
                        $("#new_invoice").val(newinvoice);
                        $('#b_no').html(newinvoice);
                        $("#new_invoice").val(prefix + seperator + newinvoice + seperator + suffix);
                        $('#reference').val(prefix + seperator + newinvoice + seperator + suffix);
                    }

                }
            });
        } else {
            $('#b_no').html(oldinvoice);
        }
    });

    $(document).on('change', '.txtamt', function() {
        var collection = $(".txtamt");
		var narrations ='';
		console.log('newstart');
        collection.each(function() {
            var id = $(this).attr('id');
            var ref = $(this).attr('ref');
            var total = $('#hddbt' + ref).val();
            var paying = $('#txtamt' + ref).val();
            var balance = parseFloat(total) - parseFloat(paying);
            $('#txtbal' + ref).val(balance);
            Update_ageing_adjustment(ref);
			if(narrations !== ''){
				narrations =narrations +',';
			}
			if($('#txtamt' + ref).val() !==''){
				if($('#txtamt' + ref).val() > 0 ){
					narrations = narrations + $('#lblvoucher'+id).html();
				}
			}
			$('#invoices').val(narrations);
        });
        if (autoCheck === false) {
            var amt = 0;
            var tot = 0;
            var collection = $(".txtamt");
            collection.each(function() {
                var id = $(this).attr('id');
                amt = parseFloat(getVal(id));
                tot = parseFloat(tot) + parseFloat(amt);
            });
            $(amount).val(tot);
        }

    });

    $(document).on('change', '#autoCheck', function() {
        autoCheck = $('#autoCheck').is(':checked');
        if (autoCheck === true || autoCheck === false) {
            autopay(0);
        }
    });

    function changeinvoice() {
        var vid = $('#vid').val();
        if (vid === "0") {
            document.getElementById("b_no").contentEditable = true;
        }
    }

    function autopay(vid) {
        if (parseFloat(vid) < 1) {
            $('.txtamt').val(0.00);
            var autoCheck = $('#autoCheck').is(':checked');
            var collection = $(".chkchg");
            var totalamount = getVal('amount');
            if (autoCheck === true) {
				narrations ='';
				console.log('autopay1');
                if (totalamount !== 0) {
                    collection.each(function() {
                        $(this).prop('checked', autoCheck);
                        var id = $(this).attr('id');
                        //debit amount 
                        var hdcrdt = getVal("hddbt" + id);
                        var txtamt = "#txtamt" + id;
                        var bal = parseFloat(totalamount) - parseFloat(hdcrdt);

                        if (parseFloat(totalamount) < parseFloat(hdcrdt)) {
                            $(txtamt).val(totalamount);
							console.log('totalamount'+totalamount);
							if(  parseFloat(totalamount) >  0  ){
								if(narrations !== ''){
									narrations =narrations +',';
								}
								narrations = narrations + $('#lblvoucher'+id).html();
								console.log('narrationsfirst'+narrations);
							}
                        } else {
                            totalamount = (parseFloat(totalamount) - parseFloat(hdcrdt)).toFixed(2);
                            $(txtamt).val(hdcrdt);
							console.log('hdcrdt'+hdcrdt);
							if(  parseFloat(hdcrdt) >  0  ){
								if(narrations !== ''){
									narrations =narrations +',';
								}
								narrations = narrations + $('#lblvoucher'+id).html();
							}
                        }
                        var txtbal = "#txtbal" + id;
                        if (bal < 0 || bal === 0) {
                            $(txtbal).val((-1 * parseFloat(bal)).toFixed(2));
                            Update_ageing_adjustment(id);
                            return false;
                        } else {
                            $(txtbal).val(0.00);
                            Update_ageing_adjustment(id);
                        }
                    });
					console.log('narrations'+narrations);
					$('#invoices').val(narrations);
                }
            } else {
                collection.each(function() {
					console.log('autopay2');
                    $(this).prop('checked', autoCheck);
                    var id = $(this).attr('id');
                    var txtamt = "#txtamt" + id;
                    var txtbal = "#txtbal" + id;
                    $(txtamt).val(0.00);
                    $(txtbal).val(0.00);
                    var amount = $('#hddbt'+id).val();
                    $(txtbal).val(amount);
                    Update_ageing_adjustment(id);
					$('#invoices').val('');
                });
            }
        } else {
            var is_autocheck = $('#is_autocheck').val();
            var collection = $(".chkchg");
			narrations ='';
            collection.each(function() {
				console.log('autopay3');
                var id = $(this).attr('id');
                var last_paid = $('#last_paid' + id).val();
                if (parseFloat(is_autocheck) > 0 && parseFloat(last_paid) > 0) {
                    $(this).prop("checked", true);
                }
                var hddbt = $('#hddbt' + id).val();
                var balance = parseFloat(hddbt) - last_paid;
                $("#txtamt" + id).val(last_paid);
				if(parseFloat(last_paid) > 0  ){
					if(narrations !== ''){
						narrations =narrations +',';
					}
					narrations = narrations + $('#lblvoucher'+id).html();
				}
                $('#txtbal' + id).val(balance);
                Update_ageing_adjustment(id);

            });
			$('#invoices').val(narrations);
        }
    }

    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '') {
            val = 0;
        }
        return val;

    }

    function setledgers(ledger = 0) {
        var paytype = $("#paytype").val();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/setledgers'); ?>/" + paytype + "",
            success: function(result) {
                $('#frmact').html(result);
                if (ledger > 0) {
                    $('#frmact').val(ledger);
                }
            }
        });
    }

    function setpaytype(ledger, acc_main) {
        var exists = false;
        $('#frmact option').each(function() {
            if (this.value == ledger) {
                exists = true;
                return false;
            }
        });
        if (exists == false) {
            $("#paytype").val(acc_main);
            setledgers(ledger);
        } else {
            $('#frmact').val(ledger);

        }
    }

    function Update_ageing_adjustment(attr){
        var ageing_adjustment = $('#ageing_adjustment').val();
        if(ageing_adjustment > 0 ){
            var maxAdjust = $('#txtbal'+attr).val();
            if ($('#chkadjust'+attr).is(':checked')) {
                $('#txtadjust'+attr).val(maxAdjust);
            } else {
                console.log('Unchecked:', this.value);
                $('#txtadjust'+attr).val(0);
            }
        }
    }

    $(document).on('change', '.chkadjust', function () {
        var attr = $(this).attr('attr');
        var maxAdjust = $('#txtbal'+attr).val();
        if ($(this).is(':checked')) {
            $('#txtadjust'+attr).val(maxAdjust);
        } else {
            console.log('Unchecked:', this.value);
            $('#txtadjust'+attr).val(0);
        }
    });


    $(document).ready(function() {
        $('#name').change(function(){
            var toid = $('#toid').val();
            if(toid ==''){
                toid =0;
            }
            if(toid < 1 ){
                $('#name').val('');
            }
        });
		$.ajax({
			url: "<?php echo site_url('ajaxcall/salesman'); ?>",
			async:false,
			success: function(result) {
				$('#salesman').html(result);
				var user_id = $('#user_id').val();
				$('#salesman').val(user_id);
			}
		});
        var vid = $('#vid').val();
        if (vid === '0') {
            setledgers();
        }
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
            success: function(result) {
                var user_default_billtype = $('#user_default_billtype').val();
                $('#btype').html(result);
				if (user_default_billtype !== "") {
					if( parseFloat(user_default_billtype) > 0 ){
						$('#btype').val(user_default_billtype);
					}
                }
                var billtype = $('#btype').val();
                setbillno(billtype);

            }
        });



        $('#btype').change(function() {
            var billtype = $('#btype').val();
            setbillno(billtype);
        });

        $("#ledname").autocomplete({
            source: "<?php echo site_url('ajaxcall/mainledger'); ?>",
            minLength: 2,
            select: function(event, ui) {
                // ui.item.id
                $("#ledgerid").val(ui.item.id);
                $("#ledid").val(ui.item.id);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function(result) {
                $('#Costcenter').html(result)
            }
        });
        $("#name").focus();

        $("#amount").change(function() {
            autopay(0);
        });
        $("#paytype").change(function() {
            setledgers();
        });
        $("#paytype").keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
                $("#frmact").focus();
            }
        });
        $("#name").autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('transaction/vouchers/search/rec'); ?>/" + $('#ledid').val(),
                    dataType: "json",
                    data: {
                        term: request.term,
                        ledid: $("#ledid").val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            cache: false,
            minLength: 2,
            extraParams: { //to pass extra parameter in ajax file.
                "ledid": $('#ledid').val(),
            },
            select: function(event, ui) {
                ms(ui.item.id);
                $("#toid").val(ui.item.id);
                $.ajax({
                    url: "<?php echo site_url('transaction/vouchers/getLedegerbalance'); ?>/" + ui.item.id + "/1",
                    success: function(results) {
                        $("#balance").html("Clossing Balance: " + results);
                    }
                });
                $("#toid").val(ui.item.id);
                $("#amount").focus();
            }
        });
        load();

    });

    function setbillno(id) {
		var paytype = $('#paytype').val();
		if(parseFloat(paytype) === 4 ){
			var frmact = $("#btype [value=" + id + "]").attr('cash');
			$('#frmact').val(frmact);
		}
        var vid = $('#vid').val();
        if (vid === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/Vouchers/getnewinoviceno'); ?>/" + id,
                success: function(result) {
                    $('#b_no').html(result);
                    $('#iv_no').html(result);
                    var suffix = $('#btype').find(':selected').attr('suffix');
                    var prefix = $('#btype').find(':selected').attr('preffix');
                    var seperator = $('#btype').find(':selected').attr('seperator');
                    $('#autoinvoice').val(prefix + seperator + result + seperator + suffix);
                    $("#new_invoice").val(prefix + seperator + result + seperator + suffix);
                    $('#sep_second').html(seperator);
                    $('#sep_first').html(seperator);
                    $('#suffix').html(suffix);
                    $('#prefix').html(prefix);
                    $('#reference').val(prefix + seperator + result + seperator + suffix);
                    //                    document.getElementById("b_no").contentEditable = true;
                }
            });
        }
    }


    function load() {
        var vid = $('#vid').val();
        if (vid !== '0') {

            $.ajax({
                url: "<?php echo site_url('transaction/vouchers/getVoucher'); ?>/" + vid + "",
                success: function(results) {
                    //alert(JSON.stringify(results));

                    var result = JSON.parse(results);
                    if (parseFloat(result[0].is_autoCheck) > 0) {
                        $("#autoCheck").prop("checked", true);
                    } else {
                        $("#autoCheck").prop("checked", false);
                    }
                    $('#is_autocheck').val(result[0].is_autoCheck);
                    $('#name').val(result[0].name + '-' + result[0].code);
                    $('#amount').val(result[0].amount);
                    $('#b_no').html(result[0].voucher_no);
                    $('#salesman').val(result[0].salesman);
                    $('#new_invoice').val(result[0].voucher_no);
                    $('#paid').val(result[0].amount);
                    var ledger = result[0].ledger;
                    setpaytype(ledger, result[0].acc_main);
                    $('#invoice').val(result[0].voucher_invoice);
                    $('#narration').val(result[0].naration);
                    $('#reference').val(result[0].reference);
                    $('#date').val(result[0].dtp);
                    $('#toid').val(result[0].acc_ledgers_id);
                    $('#btype').val(result[0].bill_type);
                    ms(result[0].acc_ledgers_id);
                    $.ajax({
                        url: "<?php echo site_url('transaction/vouchers/getLedegerbalance'); ?>/" + result[0].acc_ledgers_id + "",
                        success: function(results) {
                            $("#balance").html("Clossing Balance: " + results);
                        }
                    });
                }
            });
        }
    }
    var table = '';
    var id = 0;

    function ms(toid) {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
            "searching": false,
            "bInfo": false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aging/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.type = 'rec';
                    data.ageing_adjustment = $('#ageing_adjustment').val();
                    data.enddate = $('#enddate').val();
                    data.id = toid;
                    data.vid = $('#vid').val();
                }
            },
            "fnDrawCallback": function() {
                autopay($('#vid').val());
                $('.txtamt').trigger('change');
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });
        $("#amount").focus();
    }
</script>