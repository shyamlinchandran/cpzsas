<?php
$add_url = site_url('transaction/Credit_Debit_Vouchers/debit');
$cost_centre = $settings[0]['is_costcenter'];
$select_master = $settings[0]['select_master'];
?>
<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/Credit_Debit_Vouchers/list_all/debit_note'); ?>" action="<?php echo site_url('transaction/Credit_Debit_Vouchers/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid" />
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view" />
    <input type="hidden" value="<?php echo $type; ?>" name="type" id="type" />
    <input type="hidden" id="select_master" name="select_master" value="<?php echo $select_master; ?>" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Debit Note', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('transaction\Credit_Debit_Vouchers\list_all\debit_note'); ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Billtype', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select tabindex="-1" id="btype" name="btype" class="form-control ">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Voucher No', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <label style="text-align:left" class="col-sm-4 control-label" id="vou_no"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Date', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input class="form-control date" id="date" name="date" data-validation="required,date" data-validation-format="dd/mm/yyyy" placeholder="Date" />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('To Ac', $this, $user) ?></label>

                                <div class="col-sm-8">
									<input type="hidden" id="main_ledger_id" name="main_ledger_id" />
                                    <input class="form-control" id="main_ledger" name="main_ledger" data-validation="required"  placeholder="To Account" />
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
                                <label class="col-sm-4 control-label"><?= label('Balance', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <span id="balance" class="form-control" placeholder="Balance" disabled="true"></span>
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Amount', $this, $user) ?></label>

                                <div class="col-sm-8">
                                    <input type = "number" id="amount"  name= "amount" class="form-control" placeholder="Amount" readonly="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Narration', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" data-validation="length" data-validation-length="min5" id="address_line1" name="narration"></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Reference', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control"  id="ref_no" name="ref_no"></textarea>
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-sm-12">

                            <div class="col-sm-7">
                                <table class="table table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th colspan = "2" class = "col-sm-5" ><?= label('Ledger', $this, $user) ?></th>
                                            <th class = "col-sm-3"><?= label('Debit', $this, $user) ?></th>
                                            <th class = "col-sm-3"><?= label('Credit', $this, $user) ?></th>
                                            <th class = "col-sm-1"><?= label('Action', $this, $user) ?></th>
                                        </tr>

                                    </thead>
                                    <tr>

                                        <td colspan = "2"><input type="hidden" id="ledger_id" name="ledger_id" />
                                         <input style="" id="ledger_name" name="ledger_name" type="text" NoTab="true" class="form-control" placeholder="Select Ledger" /></td>
                                        <td><input readonly style="float:right" type="text" id="ledger_debit" name="ledger_debit" class="form-control per  cal debit two-digits" placeholder="Debit" /></td>
                                        <td><input  style="float:right" type="text" id="ledger_credit" name="ledger_credit" class="form-control per  cal credit two-digits" placeholder="Credit" /></td>
                                        <td>
                                            <span data-toggle="tooltip" title="Remove" class="btn btn-success add" href="#">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </span>
                                        </td>

                                    </tr>
                                    <tr id="add">

                                    </tr>
                                    <tbody id="rowm">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><?= label('Total', $this, $user) ?></td>
                                            <td><input disabled="disabled" style="float:right;display:none;" id="totaldiff" type="text" name="total" class="form-control     two-digits" placeholder="Amount Pending" /></td>
                                            <td><input disabled="disabled" style="float:right" id="totaldebit" type="text" name="total" class="form-control     two-digits" placeholder="Debit" /></td>
                                            <td><input disabled="disabled" style="float:right" id="totalCredit" type="text" class="form-control    two-digits" placeholder="Credit" /></td>
                                            <td>
                                            </td>

                                        </tr>
                                    </tfoot>
                                    
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                       
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
    $.validate({
        modules: 'date, security,file'
    });
	 $(document.body).on('change', '.cal', function() {
        calculate();
    });

	 function setbillno() {
        var id = $('#btype').val();
        var vid = $('#vid').val();
        if (vid === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/Credit_Debit_Vouchers/getnewinoviceno'); ?>/" + id,
                success: function(result) {
                    var suffix = $('#btype').find(':selected').attr('suffix');
                    var prefix = $('#btype').find(':selected').attr('preffix');
                    var seperator = $('#btype').find(':selected').attr('seperator');
                    $('#vou_no').html(prefix + seperator + result + seperator + suffix);
                }
            });
        }
	}
	
	function load(){
		setbillno();
		var id = $('#vid').val();
		if(parseFloat(id) > 0  ){
			$.ajax({
                url: "<?php echo site_url('transaction/Credit_Debit_Vouchers/getsing'); ?>/" + id + "",
                success: function(results) {
                    $.each(JSON.parse(results), function(i, itemsingle) {
                        $('#date').val(itemsingle.tran_date);
						$('#vou_no').html(itemsingle.voucher_no);
                        $('#btype').val(itemsingle.bill_type);
                        $('#main_ledger_id').val(itemsingle.main_ledger);
                        $('#main_ledger').val(itemsingle.mainledgername);
                        $('#amount').val(itemsingle.amount);
                        $('#address_line1').val(itemsingle.narration);
                        $('#ref_no').val(itemsingle.ref_no);
						addrow(itemsingle.ledger, itemsingle.ledgername, itemsingle.debit, itemsingle.credit);
						
						
                    });
                    calculate();
                }
            });
		}
	}
     $(document).ready(function() {
		$('#main_ledger').change(function(){
			var main_ledger_id = $('#main_ledger_id').val();
			if(main_ledger_id === '' || main_ledger_id === 0 ){
				$('#main_ledger').val('');
			}
		});
		calculate();
		$("#frmcreate").submit(function(e){
			var credit = calc('.credit');
			if(parseFloat(credit) < 1 ){
				e.preventDefault();
			}
		});


		 $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
            success: function(result) {
                $('#btype').html(result);
				load();
            }
        });
		
		$('#btype').change(function() {
            var billtype = $('#btype').val();
            setbillno();
        });
		
		$("#main_ledger").autocomplete({
				source: function(request, response) {
				$.ajax({
					url: "<?php echo site_url('transaction/vouchers/search/jou'); ?>",
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
            $('#address_line1').focus();
            $('#main_ledger_id').val(ui.item.id);
            
            $.ajax({
                url: "<?php echo site_url('transaction/vouchers/getLedegerbalance'); ?>/" + ui.item.id + "/1",
                success: function(results) {
                    $("#balance").html("Clossing Balance: " + results);
                }
            });
            
        }
    });


		  $("#ledger_name").autocomplete({
				source: function(request, response) {
				$.ajax({
					url: "<?php echo site_url('transaction/vouchers/search/jou'); ?>",
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
            $('#ledger_debit').focus();
            $('#ledger_id').val(ui.item.id);
            
            
            
        }
    });

		

	});
	 $(document.body).on('change', '.per', function() {
			var amount = $(this).val();
            if (amount !== '' && parseInt(amount) !== 0) {
                addmore();
            }

    });
	 $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
        calculate();
        setbalance();
    });
	
	

    function calculate() {
        var credit = calc('.credit');
        var debit = calc('.debit');
		credit = parseFloat(credit) + parseFloat(debit);

		$('#amount').val(credit);
        $("#totalCredit").val(credit);
        $("#totaldebit").val(debit);
        if (parseFloat(credit) > 0 ) {
            $("#form-button-save").removeAttr("disabled");
        } else {
            $("#form-button-save").attr("disabled", true);
        }
    }
	function addmore() {
        var ledger_id = $('#ledger_id').val();
        var ledger_name = $('#ledger_name').val();
        var credit = $('#ledger_credit').val();
        var debit = $('#ledger_debit').val();
        $('#ledger_id').val("").focus();
        $('#ledger_name').val("");
        $('#ledid').val("");
        $('#ledger_credit').val("");
        $('#ledger_debit').val("");
        $('#sub_narration').val("").focus();
        if (ledger_id != "") {
            addrow(ledger_id, ledger_name, debit, credit);
        }
        calculate();
        setbalance();
    }
	
	function calc(element) {
        var amount = 0;
        $(element).each(function() {
            var val = $(this).val();
            if (val === '') {
                val = 0;
                $(this).val(0);
            }
            amount = parseFloat(amount) + parseFloat(val);
        });
        return amount;
    }

	 function setbalance() {
		 var totalCredit = $('#totalCredit').val();
        var totaldebit = $('#totaldebit').val();
        var diff = parseFloat(totalCredit - totaldebit);
        if (diff < 0) {
            diff = diff * -1;
        }
        $('#totaldiff').val(diff);
    }

	function addrow(id, name, debit, credit) {
        var singrow = '<td colspan= "2"><input type="hidden" value=' + id + '  name="id[]" />' +
            '<input  readonly="readonly" style="width:250px;" value="' + name + '"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
            '<td ><input readonly	 style="float:right"  value="' + debit + '" type="text" name="debit[]"     class="deb form-control  cal debit two-digits" placeholder="Debit"/></td>' +
            '<td ><input style="float:right"  value="' + credit + '"  type="text" name="credit[]"     class="cre form-control  cal credit two-digits" placeholder="Credit"/></td>' +
            '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").prepend(newRow);
        $('#ledger_name').focus();
        setbalance();
    }
</script>