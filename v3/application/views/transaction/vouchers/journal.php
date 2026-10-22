<?php
$cost_centre = $settings[0]['is_costcenter'];
$select_master = $settings[0]['select_master'];
$is_ageing = $settings[0]['is_ageing'];
//$select_master =0;
$type = 'jou';
?>
<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/vouchers/journal'); ?>" action="<?php echo site_url('transaction/vouchers/savejournel'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid" />
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view" />
    <input type="hidden" id="ledid" name="ledid" value="0" />
    <input type="hidden" id="select_master" name="select_master" value="<?php echo $select_master; ?>" />
    <input type="hidden" name="def_accid" id="def_accid" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Journal Voucher', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('transaction\Vouchers\listall\journal'); ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
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
                                <label class="col-sm-4 control-label"><?= label('Narration', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" data-validation="length" data-validation-length="min5" id="address_line1" name="narration"></textarea>
                                </div>
                            </div>
                        </div>
                        <?php if ($is_ageing == '1') { ?>
                            <div class="col-sm-6">
                                <?= label('Auto Aging', $this, $user) ?> <input type="checkbox" name="autoCheck" checked="checked" id="autoCheck" />
                                <table id="table" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?= label('Date', $this, $user) ?></th>
                                            <th><?= label('Voucher No.', $this, $user) ?></th>
                                            <th><?= label('Debit', $this, $user) ?></th>
                                            <th><?= label('Credit', $this, $user) ?></th>
                                            <th><?= label('Balance', $this, $user) ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                        <div class="col-sm-12">

                            <div class="col-sm-7">
                                <table class="table table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th><?= label('Name', $this, $user) ?></th>
                                            <th><?= label('Narration', $this, $user) ?></th>
                                            <th><?= label('Debit', $this, $user) ?></th>
                                            <th><?= label('Credit', $this, $user) ?></th>
                                            <th>
                                                
                                            </th>
                                        </tr>

                                    </thead>
                                    <tr>

                                        <td><input type="hidden" id="ledger_id" name="ledger_id" />
                                            <input style="width:250px;" id="ledger_name" name="ledger_name" type="text" NoTab="true" class="form-control" placeholder="Name" /></td>
                                        <td><input type="text" name="sub_narration" id="sub_narration" placeholder="narration" style="width:300px;"></td>
                                        <td><input style="float:right" type="text" id="ledger_debit" name="ledger_debit" class="form-control per hunpx cal debit two-digits" placeholder="Debit" /></td>
                                        <td><input style="float:right" type="text" id="ledger_credit" name="ledger_credit" class="form-control per hunpx cal credit two-digits" placeholder="Credit" /></td>
                                        <td>
                                            <span data-toggle="tooltip" title="Remove" class="btn btn-danger remove" href="#">
                                                <span class="glyphicon glyphicon-remove-sign"></span>
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
                                            <td><input disabled="disabled" style="float:right" id="totaldiff" type="text" name="total" class="form-control hunpx    two-digits" placeholder="Amount Pending" /></td>
                                            <td><input disabled="disabled" style="float:right" id="totaldebit" type="text" name="total" class="form-control hunpx    two-digits" placeholder="Debit" /></td>
                                            <td><input disabled="disabled" style="float:right" id="totalCredit" type="text" class="form-control hunpx   two-digits" placeholder="Credit" /></td>
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
                        <?php if ($id == $max_id && $id !== 0) { ?>
                            <a tp="confirm" base="<?php echo base_url() . 'transaction/vouchers/listall/journal' ?>" message="Do you want Delete ?" success="Delete  successfuly " id="form-button-delete" style="float:right" type='button' data-toggle="tooltip" val="delete" href="<?php echo  base_url() . 'transaction/vouchers/delete/' ?><?php echo $id ?>" title='Save' class='btn bg-red btn-flat'> Delete </a>
                        <?php } else if ($id !== $max_id && $id !== 0) { ?>
                            <a tp="confirm" base="<?php echo base_url() . 'transaction/vouchers/listall/journal' ?>" message="Do you want Cancel ?" success="Cancel successfuly " id="form-button-cancel" style="float:right" type='button' data-toggle="tooltip" val="cancel" href="<?php echo base_url() . 'transaction/vouchers/cancel/' ?><?php echo $id ?>" title='Save' class='btn bg-orange btn-flat'> Cancel </a>
                        <?php } ?>
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

    $(document.body).on('change', '.credit', function() {

    });
    $("#address_line1").keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        if (key === 27 || key === 13) {
            var nar = $("#address_line1").val();
            $("#sub_narration").val(nar);
            $("#ledger_name").val('').focus();

        }

    });
    var is_load; // this is for is load the datatable initially 
    $(document.body).on('change', '.per', function() {
        var amount = $(this).val();
        if (is_load !== 1) {
            if (amount !== '' && parseInt(amount) !== 0) {
                var deb = $(this).hasClass("debit");
                if (deb === true) {
                    autopay(amount);
                } else {
                    autopayr(amount);
                }
                // is_load = 1;
                addmore();
            }

        }
    });
    $(document.body).on('change', '.credit,.debit', function() {
        setbalance();
    });

    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '') {
            val = 0;
        }
        return val;

    }

    function autopayr(amount) {
        var autoCheck = $('#autoCheck').is(':checked');
        var collection = $(".chkchg");
        var totalamount = amount;
        if (autoCheck === true) {
            if (totalamount !== 0) {
                collection.each(function() {
                    $(this).prop('checked', autoCheck);
                    var id = $(this).attr('id');
                    //debit amount 
                    var hdcrdt = getVal("hddbt" + id);
                    var txtamt = "#txtamtc" + id;
                    var bal = parseFloat(totalamount) - parseFloat(hdcrdt);

                    if (parseFloat(totalamount) < parseFloat(hdcrdt)) {
                        $(txtamt).val(totalamount);
                    } else {
                        totalamount = (parseFloat(totalamount) - parseFloat(hdcrdt)).toFixed(2);
                        $(txtamt).val(hdcrdt);
                    }
                    var txtbal = "#txtbal" + id;
                    if (bal < 0 || bal === 0) {
                        $(txtbal).val((-1 * parseFloat(bal)).toFixed(2));
                        return false;
                    } else {
                        $(txtbal).val(0.00);
                    }
                });
            }
        } else {
            collection.each(function() {
                $(this).prop('checked', autoCheck);
                var id = $(this).attr('id');
                var txtamt = "#txtamt" + id;
                var txtbal = "#txtbal" + id;
                $(txtamt).val(0.00);
                $(txtbal).val(0.00);
            });
        }

    }

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
                    var nar = $("#address_line1").val();
                    $("#sub_narration").val(nar);
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
            $('#sub_narration').focus();
            $('#ledger_id').val(ui.item.id);
            if (ui.item.ref_code === 'fwr' || ui.item.ref_code === 'sup' || ui.item.ref_code === 'con' || ui.item.ref_code === 'cus') {
                $("#def_accid").val(ui.item.id);
                if (is_load !== 1) {
                    ms(ui.item.id, 'n', 0, 0);
                }
            }
            $.ajax({
                url: "<?php echo site_url('transaction/vouchers/getLedegerbalance'); ?>/" + ui.item.id + "/1",
                success: function(results) {
                    $("#balance").html("Clossing Balance: " + results);
                }
            });
            // var inputs = $(this).parents("form").eq(0).find(":input");
            // var idx = inputs.index(this);
            // if (idx === inputs.length - 1) {
            //     inputs[0].select()
            // } else {
            //     inputs[idx + 1].focus(); //  handles submit buttons
            //     //inputs[idx + 1].select();
            // }
        }
    });


    // var row = '<td><input type="hidden"  name="id[]" class="ids"/>' +
    //         '<input  autofocus  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
    //         '<td ><input style="float:right" type="text" name="debit[]"     class=" deb form-control hunpx cal debit two-digits" placeholder="Debit"/></td>' +
    //         '<td ><input style="float:right"  type="text" name="credit[]"     class="cre form-control hunpx cal credit two-digits" placeholder="Credit"/></td>' +
    //         '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';

    function addrow(id, name, debit, credit, narration) {
        var singrow = '<td><input type="hidden" value=' + id + '  name="id[]" />' +
            '<input  readonly="readonly" style="width:250px;" value="' + name + '"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
            '<td><input type="text" name="narration_sub[]" value="' + narration + '" style="width:300px;" readonly="readonly"  ></td>' +
            '<td ><input style="float:right"  value=' + debit + ' type="text" name="debit[]"     class="deb form-control hunpx cal debit two-digits" placeholder="Debit"/></td>' +
            '<td ><input style="float:right" value=' + credit + '  type="text" name="credit[]"     class="cre form-control hunpx cal credit two-digits" placeholder="Credit"/></td>' +
            '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").prepend(newRow);
        $('#ledger_name').focus();
        setbalance();
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

    function addmore() {
        var ledger_id = $('#ledger_id').val();
        var ledger_name = $('#ledger_name').val();
        var credit = $('#ledger_credit').val();
        var debit = $('#ledger_debit').val();
        var sub_narration = $('#sub_narration').val();
        $('#ledger_id').val("").focus();
        $('#ledger_name').val("");
        $('#ledid').val("");
        $('#ledger_credit').val("");
        $('#ledger_debit').val("");
        $('#sub_narration').val("").focus();
        if (ledger_id != "") {
            addrow(ledger_id, ledger_name, debit, credit, sub_narration);
        }
        calculate();
    }
    $(document).ready(function() {
        $('#btype').change(function() {
            var billtype = $('#btype').val();
            setbillno();
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
            success: function(result) {
                var user_default_billtype = $('#user_default_billtype').val();
                $('#btype').html(result);
                load();
            }
        });


        is_load = 0;
        $("#form-button-save").attr("disabled", true);
        $('#addmore').click(function() {
            addmore();
        });
        $(".remove").first().addClass("hidden");

    })
    $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
        calculate();
        setbalance();
    });

    function calculate() {
        var credit = calc('.credit');
        var debit = calc('.debit');
        $("#totalCredit").val(credit);
        $("#totaldebit").val(debit);
        if (credit === debit) {
            $("#form-button-save").removeAttr("disabled");
        } else {
            $("#form-button-save").attr("disabled", true);
        }
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

    function load() {
        setbillno();
        $('#address_line1').focus();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function(result) {
                $('#Costcenter').html(result)
            }
        });
        var vid = $('#vid').val();
        if (vid !== '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/vouchers/getJouVoucher'); ?>/" + vid + "",
                success: function(results) {
                    $("#add").remove();
                    $.each(JSON.parse(results), function(i, itemsingle) {
                        $('#vou_no').html(itemsingle.voucher_no);
                        $('#address_line1').val(itemsingle.naration);
                        $('#date').val(itemsingle.dtp);
                        $('#btype').val(itemsingle.bill_type);
                        addrow(itemsingle.acc_ledgers_id, itemsingle.name, itemsingle.debit_amount, itemsingle.credit_amounnt, itemsingle.sub_narration)
                        if (itemsingle.ref_code === 'fwr' || itemsingle.ref_code === 'sup' || itemsingle.ref_code === 'con' || itemsingle.ref_code === 'cus') {
                            $("#def_accid").val(itemsingle.id);
                            ms(itemsingle.id, 'e', itemsingle.credit_amounnt, itemsingle.debit_amount);
                        }

                    });
                    calculate();
                    var sm = $("#view").val();
                }
            });
        }
    }
    var table;
    var id = 0;

    function ms(toid, edit, c, d) {
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
                    data.type = 'jou';
                    data.enddate = $('#enddate').val();
                    data.id = toid;
                    data.vid = $('#vid').val();
                }
            },
            "fnDrawCallback": function(oSettings) {
                if (edit === 'e') {
                    if (parseInt(c) === 0) {
                        autopay(d);
                    } else {
                        autopayr(c);
                    }
                }

            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });
        $("#narration").focus();
    }

    function autopay(amount) {
        var autoCheck = $('#autoCheck').is(':checked');
        var collection = $(".chkchg");
        var totalamount = amount;
        if (autoCheck === true) {
            if (totalamount !== 0) {
                collection.each(function() {
                    $(this).prop('checked', autoCheck);
                    var id = $(this).attr('id');
                    var hddbt = "hddbt" + id;
                    var hdcrdt = getVal("hdcrdt" + id);
                    var txtamt = "#txtamtd" + id;
                    var bal = parseFloat(totalamount) - parseFloat(hdcrdt);

                    if (parseFloat(totalamount) < parseFloat(hdcrdt)) {
                        $(txtamt).val(totalamount);
                    } else {
                        totalamount = (parseFloat(totalamount) - parseFloat(hdcrdt)).toFixed(2);
                        $(txtamt).val(hdcrdt);
                    }
                    var txtbal = "#txtbal" + id;
                    if (bal < 0 || bal === 0) {
                        $(txtbal).val((-1 * parseFloat(bal)).toFixed(2));
                        return false;
                    } else {
                        $(txtbal).val(0.00);
                    }
                });
            }
        } else {
            collection.each(function() {
                $(this).prop('checked', autoCheck);
                var id = $(this).attr('id');
                var txtamt = "#txtamt" + id;
                var txtbal = "#txtbal" + id;
                $(txtamt).val(0.00);
                $(txtbal).val(0.00);
            });
        }

    }

    function setbillno() {
        var id = $('#btype').val();
        var vid = $('#vid').val();
        if (vid === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/Vouchers/getnewinoviceno'); ?>/" + id,
                success: function(result) {
                    var suffix = $('#btype').find(':selected').attr('suffix');
                    var prefix = $('#btype').find(':selected').attr('preffix');
                    var seperator = $('#btype').find(':selected').attr('seperator');
                    $('#vou_no').html(prefix + seperator + result + seperator + suffix);
                }
            });
        }
    }
</script>