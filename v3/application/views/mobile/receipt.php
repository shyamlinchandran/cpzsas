<?php
$cost_centre = $settings[0]['is_costcenter'];
$select_master = $settings[0]['select_master'];
$is_ageing = $settings[0]['is_ageing'];
$type = 'rec';
$user = $this->session->userdata('user');
$user_id = $user['Id'];
$opening_aeging = 0;
if(isset($settings[0]['opening_aeging'])){
	$opening_aeging = $settings[0]['opening_aeging'];
}

$user = $this->session->userdata('user');
$user_default_billtype = '';
if (isset($user['default_rec_billtype'])) {
	$user_default_billtype = $user['default_rec_billtype'];
}


?>
<style>
  .modal {
    padding-right: 0px !important;
}
.ui-menu-item{
  font-size :14px;  
}
  </style>
<form method="post"  id ="formmobilereceipt"  action="<?php echo site_url('mobile/main/savereceipt/'); ?>" class="form-horizontal frmcreate">
  <div class="container-fluid">
    <br />
    <div class="forms-inputs mt-5">

    <input type="hidden" value="rec" name="type" />
    <input type="hidden" value="<?php echo $user_default_billtype; ?>" name="btype" id='btype' />
    <input type="hidden" name="paid" id="paid" />
    <input type="hidden" name="opening_aeging" id="opening_aeging" value="<?php echo $opening_aeging;?>" />
    <input type="hidden" name="is_autocheck" id="is_autocheck" value="0" />
    <input type="hidden" id="ledid" name="ledid" value="0" />
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id='user_id' />
    <input type="hidden" id="select_master" name="select_master" value="<?php echo $select_master; ?>" />
    <input type="hidden" id="vid" name="vid" value="<?php echo $id; ?>" />
    <input type="hidden" id="iv_no" name="iv_no">
    <input type="hidden" id="autoinvoice" name="autoinvoice">
    <input type="hidden" id="new_invoice" name="new_invoice">

        <div class="row table-responsive">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cusModel">
              Tag Invoice
            </button>

          
          </div>
        </div>
        <table class="table">
          <tr>
              <th style ="width:30%;" >Voucher.No  :</th>
              <th style ="text-align:left"  class = "" ><?php echo $invoice_no;?></th>

            </tr>
            <tr>
              <th>Date :</th>
              <th class = "" ><input data-validation = "required" type ="date"  class="form-control" id="date" name="date"  /></th>

            </tr>
           <!-- <tr>
              <th>Reference :</th>
              <th class = ""><input type="text" class="form-control" id="reference" name="reference" /></th>
            </tr>-->
            <tr>
              <th>Cash/Bank :</th>
              <th class = "">
                <select data-validation="required" id="paytype" name="paytype" class="form-control " autofocus>
                   <option value="4"><?= label('Cash', $this, $user) ?></option>
                    <option value="1"><?= label('Bank', $this, $user) ?></option>
                </select>
                </th>
            </tr>

            <tr>
              <th>Select Account :</th>
              <th class = "">
                <select id="frmact" name="frmact" class="form-control ">
                </select>
                </th>
            </tr>

            <tr>
              <th>From Account :</th>
              <th class = "">
                <input type="hidden" name="toid" id="toid" />
                <input name="name" NoTab="true" type="text" id="name" data-validation="length" data-validation-length="min2" class="form-control" placeholder="Name">
               
              </th>
            </tr>

            <tr>
              <th>Amount</th>
              <th class = "">
               <input name="amount" type="number" step = "any" min ="1"  id="amount" data-validation="number" data-validation-allowing="float" class="form-control  two-digits" placeholder="Amount" />
              </th>
            </tr>

         <tr>
              <th>Balance</th>
              <th class = "">
              <span id="balance" class="form-control" placeholder="Balance" readonly>0.00</span>
              </th>
            </tr>

            <tr>
              <th>Narration</th>
              <th class = "">
              <textarea class="form-control" data-validation="length" data-validation-length="min5" id="narration" name="narration">Amount Received</textarea>
              </th>
            </tr>

          <!--  <tr>
              <th>Selected Invoices</th>
              <th class = "">
              <textarea readonly class="form-control"  id="invoices" name="invoices">Invoices</textarea>
              </th>
            </tr>-->

            <tr style ="display:none;" >
              <th>Salesman</th>
              <th class = "">
                <select id="salesman" name="salesman" class="form-control ">
                </select>
              </th>
            </tr>



        </table>
        
       
      
        <div class="row">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </div>
  </div>
  <!-- Modal -->


  <div class="modal fade modal-fullscreen-md-down" id="cusModel" tabindex="-1" aria-labelledby="cusModelLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-body" id = "mainSale">
        <br />
                Is Autocheck &nbsp<input type="checkbox" name="autoCheck" checked="checked" id="autoCheck" />
          <table id="table" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><?= label('Check', $this, $user) ?></th>
                  <th><?= label('Voucher Number', $this, $user) ?></th>
                  <th><?= label('Debit', $this, $user) ?></th>
                  <th><?= label('Credit', $this, $user) ?></th>
                  <th><?= label('Balance', $this, $user) ?></th>
                </tr>
              </thead>
              <tbody>
               </tbody>
            </table>
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
    </div>
  </div>
  </form>

</body>

</html>

<script type="text/javascript">
	function loadledgeropen(id,voucher_id = 0 ){
		var opening_aeging  = $('#opening_aeging').val();
		if(parseFloat(opening_aeging) > 0 ){
			$.ajax({
				url: "<?php echo site_url('transaction/Vouchers/ledgeropen'); ?>",
				type:"POST",
				data:{id:id,voucher_id:voucher_id},
				async:false,
				success: function(result) {
					var result = JSON.parse(result);
					$('#open_bal').val(result.openning_bal +' '+result.type);
					$('#open_paid').val(result.opening_balance_paid);
					$('#open_remain').val( parseFloat(result.openning_bal) - parseFloat(result.opening_balance_paid) );
					var type = result.type;
					if(type === 'Cr'){
						$('#open_pay').val(0);
						$('#open_pay').attr('readonly',true);
					}else{
						$('#open_pay').val(result.voucher_amt);
						$('#open_pay').removeAttr('readonly');
						$('#open_pay').attr('max',parseFloat(result.openning_bal) - parseFloat(result.opening_balance_paid));
					}
					if (autoCheck === false) {
						 
					}else{
						$('#open_pay').val(0);
						$('#open_pay').attr('readonly',true);
					}
				}
			});
		}
	}
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
                return false;
            } else {
                $(txtbal).val(0.00);
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
	$(document).on('change', '#open_pay', function() {
		if (autoCheck === false) {
            var amt = 0;
            var tot = 0;
            var collection = $(".txtamt");
            collection.each(function() {
                var id = $(this).attr('id');
                amt = parseFloat(getVal(id));
                tot = parseFloat(tot) + parseFloat(amt);
            });
			var open_pay = $('#open_pay').val();
			if(open_pay === undefined || open_pay === null || open_pay === '' ){
				open_pay = 0 ;
			}
			tot = parseFloat(tot) + parseFloat(open_pay);
            $(amount).val(tot);
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
			var open_pay = $('#open_pay').val();
			if(open_pay === undefined || open_pay === null || open_pay === '' ){
				open_pay = 0 ;
			}
			tot = parseFloat(tot) + parseFloat(open_pay);
            $(amount).val(tot);
        }

    });

    $(document).on('change', '#autoCheck', function() {
        autoCheck = $('#autoCheck').is(':checked');
		if(autoCheck  === true ){
			$('#open_pay').val(0);
			$('#open_pay').attr('readonly',true);
		}else{
			$('#open_pay').removeAttr('readonly');
		}
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
				$('#open_pay').val(0);
				narrations ='';
				console.log('autopay1');
                if (totalamount !== 0) {
					var bal = 0;
                    collection.each(function() {
                        $(this).prop('checked', autoCheck);
                        var id = $(this).attr('id');
                        //debit amount 
                        var hdcrdt = getVal("hddbt" + id);
                        var txtamt = "#txtamt" + id;
                        bal = parseFloat(totalamount) - parseFloat(hdcrdt);
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
                            return false;
                        } else {
                            $(txtbal).val(0.00);
                        }
                    });
					if(bal > 0 ){
						//$('#open_pay').val(bal);
					}
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
    $(document).ready(function() {

      $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
			async:false,
            success: function(result) {
                var user_default_billtype = $('#user_default_billtype').val();
                $('#btype').html(result);
	

            }
        });
		$('#name').change(function(){
			var id = $('#toid').val();
			if(id === '' ){
				id = 0;
			}
			if(parseFloat(id) < 1  ){
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
			async:false,
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
          $('#cusModel').modal('show');
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
				loadledgeropen(ui.item.id);
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
                    $('#date').val(result[0].trans_date);
                    $('#toid').val(result[0].acc_ledgers_id);
                    $('#btype').val(result[0].bill_type);
					loadledgeropen(result[0].acc_ledgers_id,vid)
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
            "responsive": true,
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
                   // data.enddate = $('#enddate').val();
                    data.id = toid;
                    data.vid = $('#vid').val();
                }
            },
            "fnDrawCallback": function() {
                autopay($('#vid').val());
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