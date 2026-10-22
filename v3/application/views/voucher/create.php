<?php

$is_calendar = 0;
$txt_name = '';
$type = 'quickreceipt';




if (isset($settings[0]['is_calendar'])) {
    $is_calendar = $settings[0]['is_calendar'];
    $state = 'State';
    $txt_name = 'First ';

}
$cost_centre = $settings[0]['is_costcenter'];

?>
<form method="post" id="frmcreatemodeli" enctype="multipart/form-data" back="<?php echo site_url('Voucher/listall'); ?>"
    action="<?php echo site_url('Voucher/save'); ?>" class="form-horizontal">

    <input type="hidden" value="<?php echo $id ?>" name="id_msm" id="id" />
    <input type="hidden" value="<?php echo $id ?>" name="id" id="ids" />
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <input type="hidden" value="<?= $view ?>" name="view" id="view" />
    <input type="hidden" id="vid" name="vid" value="<?php echo $id; ?>" />
    <input type="hidden" id="iv_no" name="iv_no">
    <input type="hidden" id="is_model" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?= label('Quick Reciept Voucher ', $this, $user) ?>
                        </h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('Voucher/listall'); ?>"
                                class="btn  btn-success align-bottom" href="<?php echo site_url('Voucher/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>

                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Date', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="date" name="dates" id="dates" class="form-control"
                                        data-validation="required" />


                                </div>

                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Salesman', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="salesman" id="salesman" class="form-control salesman"
                                        data-validation="required">
                                        <option value="">Select</option>
                                    </select>


                                </div>

                            </div>


                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('User', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="user" id="user" class="form-control user" data-validation="required">
                                        <option value="">Select</option>
                                    </select>



                                </div>

                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Cash/Bank', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="acc_main_id" id="acc_main_id" class="form-control cashbank"
                                        data-validation="required">
                                        <option value="">Select</option>
                                        <option value="4">Cash</option>
                                        <option value="1">Bank</option>
                                    </select>



                                </div>

                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Ledger', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select name="ledger" id="ledger" class="form-control ledger"
                                        data-validation="required">
                                        <option value="">Select</option>
                                    </select>

                                </div>

                            </div>
                            <div class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Voucher Number', $this, $user) ?>
                                </label>
                                <div class="col-sm-8">
                                    <p><span class="new-invoice"><label spellcheck="false" id="prefix"></label><label
                                                spellcheck="false" id="sep_first"></label><label
                                                class="two-digits price" ondblclick="changeinvoice()" NoTab="true"
                                                spellcheck="false" id="b_no"></label><label spellcheck="false"
                                                id="sep_second"></label><label spellcheck="false"
                                                id="suffix"></label></span></p>
                                    <input name="invoice" type="hidden" id="invoice" class="form-control"
                                        placeholder="Voucher Number">


                                </div>

                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Bill Type', $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="btype" name="btype" class="form-control ">
                                    </select>

                                </div>

                            </div>

                            <?php if ($cost_centre == '1') { ?>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label"><?= label('Cost Centre', $this, $user) ?></label>

                                    <div class="col-sm-8">
                                        <select id="Costcenter" class="form-control" name="Costcenter">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>


                        </div>

                        <div class="box-body">
                        Selected  Ledger Balance : <label id = "labelbalance"></label>

                            <table class="table table-striped table-condensed">

                                <thead>
                                    <tr>

                                        <th class="text-right"><label for="nosem"
                                                class="col-sm-6 control-label">Ledger</label></th>
                                        

                                        <th class="text-right"><label for="nosem"
                                                class="col-sm-6 control-label">Narration</label></th>

                                                <th class="text-right"><label for="nosem"
                                                class="col-sm-6 control-label">Amount</label></th>
                                        <th></th>
                                    </tr>

                                </thead>
                                <?php if ($view != 'view') { ?>

                                    <tr id="add">

                                        <td class="col-lg-8">

                                            <input type="text" id="ledgername" name="ledgername"
                                                data-content="</textarea></br>" class="form-control" />
                                            <input type="hidden" id="ledgid" name="ledgid" data-content="</textarea></br>"
                                                class="form-control" />
                                        </td>
                                       
                                        <td class="col-lg-6">
                                            <input type="text" id="narration" name="narration"
                                                data-content="</textarea></br>" class="form-control" />
                                        </td>
                                        <td class="col-lg-6">
                                            <input type="text" id="amount" name="amount" data-content="</textarea></br>"
                                                class="form-control" />
                                        </td>

                                        <td><button data-toggle="tooltip" id="butnn" type="button" title="Add To save"
                                                id="btnAddExtra" class="btn btn-success  butnn" href="#">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button></td>

                                    </tr>

                                <?php } ?>

                                <tbody id="rowm">

                                </tbody>

                                <tr>
                                    <td colspan="2" align="right"> Grand Total</td>
                                    <td colspan="2" align="right">
                                        ₹ <strong id="orderTotal">
                                            <input type="text" id="grndtot" name="grndtot" readonly="readonly"
                                                class="form-control  text-right" placeholder="GRAND TOTAL">
                                        </strong>
                                    </td>

                                </tr>



                            </table>

                        </div>


                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save'
                                    class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <?php } ?>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.row -->
    </section>
</form>




<script type="text/javascript">
    var total = 0;
    $(document).on("change", "#acc_main_id", function () {

        var acc_main_id = ($(this).val());
        //alert(acc_main_id);

        $.ajax({
            async: false,
            url: "<?php echo site_url('Voucher/getledgername'); ?>/" + acc_main_id,
            success: function (result) {
                $('#ledger').html(result);


            }
        });


    });
    $(document).on("change", "#amount1", function () {

        $(".amount1").each(function () {

            amount = ($(this).val());
            //alert(amount);

        });
        calaculate();



    });

    $(document).on("keydown", "#amount", function (event) {

        if (event.which == 9 || event.which == 13) {
            var ledgid = $('#ledgid').val();
            var amount = $('#amount').val();
            var narration = $('#narration').val();


            if (ledgid > 0 && amount > 0) {

                $('.butnn').trigger('click');
            }
            else {
                //alert("Enter amount");
            }

        }
    });

    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            async:false,
            success: function(result) {
                $('#Costcenter').html(result);
            }
        });


        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
            async: false,
            success: function (result) {
                var user_default_billtype = $('#user_default_billtype').val();
                $('#btype').html(result);
                if (user_default_billtype !== "") {
                    if (parseFloat(user_default_billtype) > 0) {
                        $('#btype').val(user_default_billtype);
                    }
                }
                var billtype = $('#btype').val();
                setbillno(billtype);

            }
        });

        $('#btype').change(function () {
            var billtype = $('#btype').val();
            setbillno(billtype);
        });

        $('.new-invoice').on('DOMFocusOut', function () {
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
                    success: function (result) {
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
                            // $('#reference').val(prefix + seperator + newinvoice + seperator + suffix);
                        }

                    }
                });
            } else {
                $('#b_no').html(oldinvoice);
            }
        });

        $("#ledgername").autocomplete({
            source: "<?php echo site_url('Voucher/getledger/25'); ?>",
            minLength: 2,
            selectFirst: true,
            select: function (event, ui) {
                $('#ledgername').val(ui.item.name);
                $('#ledgid').val(ui.item.id);
                $('#labelbalance').html(parseFloat(ui.item.balance).toFixed(company_roundoff));

            }
        });
        $('.butnn').click(function () {

            var ledgername = $('#ledgername').val();
            var ledgid = $('#ledgid').val();
            var amount = $('#amount').val();
            var narration = $('#narration').val();
            if (parseFloat(ledgid) > 0 && parseFloat(amount) > 0 && narration != '') {
                add(ledgername, ledgid, amount, narration);
            }
            else {
               // alert("Enter ledgername,amount and narration");
            }
        });

        $.ajax({
            async: false,
            url: "<?php echo site_url('Voucher/getuser'); ?>",
            success: function (result) {
                $('#user').html(result);


            }
        });

        $.ajax({
            async: false,
            url: "<?php echo site_url('Voucher/getsalesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);


            }
        });

        load();

    });

    function changeinvoice() {
        var vid = $('#vid').val();
        if (vid === "0") {
            document.getElementById("b_no").contentEditable = true;
        }
    }

    function setbillno(id) {
        var paytype = $('#paytype').val();
        if (parseFloat(paytype) === 4) {
            var frmact = $("#btype [value=" + id + "]").attr('cash');
            $('#frmact').val(frmact);
        }
        var vid = $('#vid').val();
        if (vid === '0') {
            var cost_center = $('#btype').find(':selected').attr('cost_center');
            if(cost_center!=='' && cost_center !== undefined){
                $('#Costcenter').val(cost_center);
            }
            $.ajax({
                url: "<?php echo site_url('transaction/Vouchers/getnewinoviceno'); ?>/" + id,
                success: function (result) {
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
                    // $('#reference').val(prefix + seperator + result + seperator + suffix);
                    //                    document.getElementById("b_no").contentEditable = true;
                }
            });
        }
    }


    function add(ledgername, ledgid, amount, narration) {


        var incntdec = 0;
        incntdec = incntdec + 1;
        var ledgid = $('#ledgid').val();
        var text = '<tr><td style="width:35%"><input type="hidden" name="index[]" value=0 /><input type="text"  id="ledgername1" name="ledgername1[]" value=' + ledgername + ' class="form-control ledgername" placeholder="Ledger Name" readonly="readonly" />' +
            '<input type="hidden"  id="ledgid1" name="ledgerid1[]" value=' + ledgid + ' class="ledgid"  /></td> ' +
            '<td  style="width:30%"><input type="text" id="narration1" name="narration1[]" value=' + narration + ' class="narration form-control" readonly="readonly" /></td>' +
            '<td  style="width:20%"><input type="text" id="amount1" name="amount1[]" value=' + amount + ' class="amount1 form-control" readonly="readonly" /></td>' +
            '<td><span data-toggle="tooltip"  id="button1" title="Remove" onclick="remove(this)" vtype="dec" class="btn btn-danger btn-sm remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span> </span></td></tr>';
        $('#rowm').append(text);
        clear();
        calaculate();


    }


    function calaculate() {
        // alert("vghjj");
        var amounts = 0;
        var total = 0;
        $(".amount1").each(function () {
            amounts = ($(this).val());
            // alert(amount);
            total = (parseFloat(amounts) + parseFloat(total)).toFixed(2);
            // alert(total);
            $("#grndtot").val(total);
        });

    }
    function clear() {
        clearValue($("#ledgername"));
        clearValue($("#amount"));
        clearValue($("#narration"));
    }


    function remove(button1) {

        $('.tooltip').remove();
        $(button1).closest('tr').remove();
        calaculate();

    }

    function load() {

        var id = $("#id").val();

        if (id > 0) {

            $.ajax({

                url: "<?php echo site_url('Voucher/getdetails'); ?>/" + id,
                async: false,
                success: function (results) {
                    var result = JSON.parse(results);
                    //alert(results);
                    $("#dates").val(result.date);
                    $('#Costcenter').val(result.cost_center);
                    $("#salesman").val(result.salesman);
                    $('#user').val(result.user);
                    $('#acc_main_id').val(result.acc_main_id);
                    $('#acc_main_id').trigger('change');
                    $('#ledger').val(result.ledger_id);
                    $('#invoice').val(result.voucherno);
                    $('#btype').val(result.billtype);
                    $('#grndtot').val(result.totalamount);



                }

            });

            $.ajax({

                url: "<?php echo site_url('Voucher/getvoucheritems'); ?>/" + id,
                async: false,

                success: function (results) {

                    var result = JSON.parse(results);
                    var txt = 'remove';
                    var tx = '';
                    $.each(result, function (i, itemsingle) {

                        var ledgername = itemsingle.name;
                        var ledgid = itemsingle.ledgerid;
                        var amount = itemsingle.amount;
                        var narration = itemsingle.narration;


                        $("#rowm").append('<tr><td style="width:50%"><input type="hidden" name="index[]" value=' + itemsingle.qid + ' /><input type="text"  id="name" name="name[]" value=' + itemsingle.name + ' class="form-control feetype1" placeholder="Ledger" readonly />' +
                            '<input type="hidden"  id="ledgerid1" name="ledgerid1[]" value=' + itemsingle.ledgerid + ' class="ledgerid"  /></td> ' +
                            '<td  style="width:50%"><input type="text" id="amount1" name="amount1[]" value=' + amount + ' class="amount1 form-control" readonly /></td>' +
                            '<td  style="width:50%"><input type="text" id="narration1" name="narration1[]" value=' + narration + ' class="narration1 form-control" readonly /></td>' +


                            '<td><span data-toggle="tooltip"  id="button1" title="Remove" onclick="remove(this)" vtype="dec" class="btn btn-danger btn-sm remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span> </span></td></tr>');

                    });






                }

            });






        }
    }

</script>