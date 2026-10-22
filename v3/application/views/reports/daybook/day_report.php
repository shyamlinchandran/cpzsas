<style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }
</style>
<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/Quick_voucher/listall'); ?>" action="<?php echo site_url('transaction/Quick_voucher/save'); ?>"  class="form-horizontal">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border no-print">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right no-print"> <a role="button"
                                                              class="btn no-print btn-success align-bottom"
                                                              href="<?php echo site_url('transaction\Quick_voucher\listall'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body" id="printdiv"> 
                        <div class="col-sm-10 no-print">  

                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('Select Date', $this, $user) ?> * :</label>
                                    <div class="col-sm-6">
                                        <input class="form-control date" id="date" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="button" class="btn btn-success" value="Print" id="print"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('Select Branch', $this, $user) ?> * :</label>
                                    <div class="col-sm-6">
                                        <select  id="branch" name="branch" class="form-control " >                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input style="height: 25px;" type="button"  class="btn btn-success" id="loadbalance"  value="<?= label('Search', $this, $user) ?>"/>



                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-12">  
                            <table id="quicktable" class="table table-condensed table-striped">
                                <tr>
                                    <td style="text-align: center;font-weight: bold" colspan="4">Day Report</td>
                                </tr>
								<tr>
                                    <td style="text-align: left;font-weight: bold" >Opening Balance</td>
                                    <td style="text-align: left;font-weight: bold" ><label id="opendebit"  name="opendebit"></td>
                                    <td style="text-align: left;font-weight: bold" ></td>
                                    <td style="text-align: left;font-weight: bold" > <label id="opencredit"  name="opencredit"></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"> Sales Cash : </td>
                                    <td style="width: 30%"><label id="sale_cash_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%;margin-right: 2px;"> Purchase Cash: </td>
                                    <td style="width: 30%"><label id="purchase_cash_amount" style="width: 100%">0.00</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"> Sales Credit: </td>
                                    <td style="width: 30%"><label id="sale_credit_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%;margin-right: 2px;"> Purchase Credit: </td>
                                    <td style="width: 30%"><label id="purchase_credit_amount" style="width: 100%">0.00</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"> Sales Bank : </td>
                                    <td style="width: 30%"><label id="sale_bank_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%;margin-right: 2px;"></td>
                                    <td style="width: 30%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"><b>Total Sales :</b> </td>
                                    <td style="width: 30%"><label id="sale_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%;margin-right: 2px;"><b>Total Purchase:</b> </td>
                                    <td style="width: 30%"><label id="purchase_amount" style="width: 100%">0.00</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;margin-right: 2px;"> Purchase Return Cash: </td>
                                    <td style="width: 30%"><label id="pur_rtn_cash_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%"> Sales Return Cash : </td>
                                    <td style="width: 30%"><label id="sale_rtn_cash_amount" style="width: 100%">0.00</label></td>

                                </tr>
                                <tr>

                                    <td style="width: 20%;margin-right: 2px;"> Purchase Return Credit: </td>
                                    <td style="width: 30%"><label id="purchase_rtn_credit_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%"> Sales Return Credit: </td>
                                    <td style="width: 30%"><label id="sale_rtn_credit_amount" style="width: 100%">0.00</label></td>
                                </tr>
                                <tr>

                                    <td style="width: 20%;margin-right: 2px;"></td>
                                    <td style="width: 30%"></td>
                                    <td style="width: 20%"> Sales Return Bank : </td>
                                    <td style="width: 30%"><label id="sale_rtn_bank_amount" style="width: 100%">0.00</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"><b>Total Purchase Return :</b></td>
                                    <td style="width: 30%"><label id="pur_rtn_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%"><b>Total Sales Return:</b></td>
                                    <td style="width: 30%"><label id="sale_rtn_amount" style="width: 100%">0.00</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"><b>Receipt :</b></td>
                                    <td style="width: 30%"><label id="receipt_amount" style="width: 100%">0.00</label></td>
                                    <td style="width: 20%"><b>Payment :</b></td>
                                    <td style="width: 30%"><label id="payment_amount" style="width: 100%">0.00</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"><b> :</b></td>
                                    <td style="width: 30%"></td>
                                    <td style="width: 20%"><b>Quick Voucher :</b></td>
                                    <td style="width: 30%"><label id="quick_amount" style="width: 100%">0.00</label></td>
                                </tr>


                                <tr>
                                    <td ><b>Day Total</b></td>
                                    <td><label style="font-weight: bold" id="crt_tot" style="width: 100%">0.00</label></td>
                                    <td></td>
                                    <td><label style="font-weight: bold" id="dbt_tot" style="width: 100%">0.00</label></td>
                                </tr>

                            </table>
                        </div>
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


 
$('#date').change(function() {
        var arr = [];
        var fromdate = $('#date').val();
        var branchh = $('#branch').val();
        arr.push({
            stdate: fromdate,
            branch: branchh,
        });
        createCookie('day_report_cook', JSON.stringify(arr), 3);

    });

    $('#branch').change(function(){
        var arr = [];
        var fromdate = $('#date').val();
        var branchh = $('#branch').val();
        arr.push({
            stdate: fromdate,
            branch: branchh,

        });
        createCookie('day_report_cook', JSON.stringify(arr), 3);
    });

    function loadcook(){
        var result = readCookie('day_report_cook');
        console.log(JSON.parse(result));
        if (result != null) {
        results = JSON.parse(result);
        $.each(results, function (index, value) {
          $('#date').val(value.stdate);
          $('#branch').val(value.branch);
        });
    }
    }


    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/branch'); ?>",
            success: function (result) {
                $('#branch').html(result);
                load(0);
                loadcook();
            }
        });

        $('#branch').change(function () {
            var id = $('#branch').val();
            if (id === "") {
                id = 0;
            }
            load(id);
        });
        $("#loadbalance").click(function () {
            var id = $('#branch').val();
            if (id === "") {
                id = 0;
            }
            load(id);
        });
        // load();
        $("#print").click(function () {
            window.print();
        });

    });
    function printElem(divId) {
        var content = document.getElementById(divId).innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        mywindow.close();
        return true;
    }
    function load(id) {
        var date = $("#date").val();
        var total = 0;
        var crdttot = 0.00;
        var dbttot = 0.00;
        $("#sale_amount").html(0.00);
        $("#purchase_amount").html(0.00);
        $("#sale_rtn_amount").html(0.00);
        $("#pur_rtn_amount").html(0.00);
        $("#payment_amount").html(0.00);
        $("#receipt_amount").html(0.00);

        $("#sale_cash_amount").html(0.00);
        $("#sale_credit_amount").html(0.00);
        $("#sale_bank_amount").html(0.00);

        $("#sale_rtn_cash_amount").html(0.00);
        $("#sale_rtn_credit_amount").html(0.00);
        $("#sale_rtn_bank_amount").html(0.00);

        $("#purchase_cash_amount").html(0.00);
        $("#purchase_credit_amount").html(0.00);
        $("#quick_amount").html(0.00);


        $("#pur_rtn_cash_amount").html(0.00);
        $("#purchase_rtn_credit_amount").html(0.00);
        var sale_total = 0;
        var salereturn_total = 0;
        $.ajax({
            url: "<?php echo site_url('reports/Daybook/getdaybalance/'); ?>" + id,
            async: false,
            type: 'POST',
            data: {date: date},
            success: function (result) {
                $.each(JSON.parse(result), function (i, item) {
//                    if (item.trn_tp === "sales") {
//                        total = total + parseFloat(item.total);
//                        $("#sale_amount").html('<b>' + item.total + '</b>');
//                        sale_total = item.total;
//                        crdttot = crdttot + parseFloat(item.total);
//                    }
                    if (item.trn_tp === "purchase") {
                        total = total - parseFloat(item.total);
                        $("#purchase_amount").html('<b>' + item.total + '</b>');
                        dbttot = dbttot + parseFloat(item.total);
                    }
//                    if (item.trn_tp === "sales_return") {
//                        total = total - parseFloat(item.total);
//                        $("#sale_rtn_amount").html('<b>' + item.total + '<b>');
//                        salereturn_total = item.total;
//                        dbttot = dbttot + parseFloat(item.total);
//                    }
                    if (item.trn_tp === "purchase_return") {
                        total = total + parseFloat(item.total);
                        $("#pur_rtn_amount").html('<b>' + item.total + '<b>');
                        crdttot = crdttot + parseFloat(item.total);
                    }
                    if (item.trn_tp === "payment") {
                        total = total - parseFloat(item.total);
                        $("#payment_amount").html('<b>' + item.total + '</b>');
                        dbttot = dbttot + parseFloat(item.total);
                    }
                    if (item.trn_tp === "receipt") {
                        total = total + parseFloat(item.total);
                        $("#receipt_amount").html('<b>' + item.total + '</b>');
                        crdttot = crdttot + parseFloat(item.total);

                    }
                    if (item.trn_tp === "new_expense") {
                        total = total - parseFloat(item.total);
                        $('#quick_amount').html('<b>' + item.total + '</b>');
                        dbttot = dbttot + parseFloat(item.total);
                    }
                });


            }
        });
        $.ajax({
            url: "<?php echo site_url('reports/Daybook/getsales/'); ?>" + id,
            async: false,
            type: 'POST',
            data: {date: date},
            success: function (result) {
                $.each(JSON.parse(result), function (i, item) {
                    if (item.saletype === "sales") {
                        total = total + parseFloat(item.total);
                        var cash = item.cash;
                        var bank = item.bank;
                        var total = parseFloat(item.cash) + parseFloat(item.bank);
                        var credit = parseFloat(sale_total) - parseFloat(total);
                        sale_total = item.total;
                        crdttot = crdttot + parseFloat(item.total);
                        $("#sale_amount").html('<b>' + item.total + '</b>');
                        $("#sale_cash_amount").html(item.cash);
                        $("#sale_credit_amount").html(item.credit);
                        $("#sale_bank_amount").html(item.bank);
                    }
                    if (item.saletype === "sales_return") {
                        total = total - parseFloat(item.total);
                        var cash = item.cash;
                        var bank = item.bank;
                        var total = parseFloat(item.cash) + parseFloat(item.bank);
                        var credit = parseFloat(salereturn_total) - parseFloat(total);
                        $("#sale_rtn_amount").html('<b>' + item.total + '<b>');
                        salereturn_total = item.total;
                        dbttot = dbttot + parseFloat(item.total);
                        $("#sale_rtn_cash_amount").html(item.cash);
                        $("#sale_rtn_credit_amount").html(item.credit);
                        $("#sale_rtn_bank_amount").html(item.bank);

                    }


                });

                $("#crt_tot").html('<b>' + crdttot + '</b>');
                $("#dbt_tot").html('<b>' + dbttot + '</b>');
            }
        });
        $.ajax({
            url: "<?php echo site_url('reports/Daybook/getpurchase/'); ?>" + id,
            async: false,
            type: 'POST',
            data: {date: date},
            success: function (result) {
                $.each(JSON.parse(result), function (i, item) {
                    if (item.type === "purchase") {
                        $("#purchase_cash_amount").html(item.cash);
                        $("#purchase_credit_amount").html(item.credit);
                    }
                    if (item.type === "purchase_return") {
                        $("#pur_rtn_cash_amount").html(item.cash);
                        $("#purchase_rtn_credit_amount").html(item.credit);
                    }
                });


            }
        });
		$.ajax({
            url: "<?php echo site_url('reports/Daybook/getopening/'); ?>" + id,
            async: false,
            type: 'POST',
            data: {date: date},
            success: function (result) {
                $.each(JSON.parse(result), function (i, item) {
                    $('#opencredit').html(item.credit);
                    $('#opendebit').html(item.debit);
                });


            }
        });
    }

</script>
