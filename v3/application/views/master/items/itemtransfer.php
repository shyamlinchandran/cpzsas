<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('master/Itemtransfer/list_all'); ?>" action="<?php echo site_url('master/items/save_transfer'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid"/> 
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/> 
    <input type="hidden"   name="def_accid" id="def_accid"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Godown Transfer', $this, $user) ?></h3>
                         <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('master/itemtransfer/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-10">                           
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" >
                                        <thead>
                                            <tr>
                                                <td>  <?= label('Date', $this, $user) ?></td>
                                                <td>  <input class="form-control hunpx  date" id="date" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" /></td>
                                                <td> <?= label('From Godown', $this, $user) ?></td>
                                                <td><select  id="from_godown"  name="from_godown" class="form-control col-lg-2" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <td> <?= label('To Godown', $this, $user) ?></td>
                                                <td><select  id="to_godown" name="to_godown" class="form-control ledger" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td><?= label('Current Stock', $this, $user) ?>:</td><td><label id="cstock"></label></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-condensed" >
                                        <thead>
                                            <tr>
                                                <th><?= label('Name', $this, $user) ?></th>
                                                <th><?= label('Quantity', $this, $user) ?></th>
                                                <th>
                                                    <a data-toggle="tooltip"   title="Add More" id="addmore"  class="btn btn-default" href="#">
                                                        <span class="glyphicon glyphicon-plus"></span> 
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="rowm">
                                            <tr id="add">
                                                <td><input type="hidden"  name="id[]" class="ids"/>
                                                    <input data-validation="length" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/>
                                                </td>
                                               <td ><input type="text" name="debit[]"     class="form-control hunpx cal debit two-digits" placeholder="Debit"/></td>
                                        <span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">
                                            <span class="glyphicon glyphicon-remove-sign"></span> 
                                        </span>
                                        </td>

                                        </tr>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td> 
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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

            </div> 

    </section>
</form>
<script type="text/javascript">
    $.validate({
        modules: 'date, security,file'
    });
    $(document.body).on('change', '.cal', function () {
        calculate();
    });
    var is_load;// this is for is load the datatable initially 
    $(document.body).on('change', '.hunpx', function () {
        if (is_load !== 1) {
            var amount = $(this).val(); 
            if (amount !== '' && parseInt(amount) !== 0) {
                var deb = $(this).hasClass("debit");
                if (deb === true) {
                    autopay(amount);
                } else {
                    autopayr(amount);
                }
                is_load = 1;
            }
        }
    });
    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
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
                collection.each(function () {
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
            collection.each(function () {
                $(this).prop('checked', autoCheck);
                var id = $(this).attr('id');
                var txtamt = "#txtamt" + id;
                var txtbal = "#txtbal" + id;
                $(txtamt).val(0.00);
                $(txtbal).val(0.00);
            });
        }

    }
    $(document.body).on('focus', 'input.ledger', function () {
        $(this).autocomplete({
            source: "<?php echo base_url(); ?>master/items/search/jou", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $(this).siblings('.ids').val(ui.item.id);
                $("#cstock").html(ui.item.current_stock);

                if (ui.item.ref_code === 'fwr' || ui.item.ref_code === 'sup' || ui.item.ref_code === 'con' || ui.item.ref_code === 'cus')
                {
                    $("#def_accid").val(ui.item.id);
                    if (is_load !== 1)
                    {
                        ms(ui.item.id, 'n', 0, 0);
                    }
                }

                $.ajax({
                    url: "<?php echo site_url('transaction/vouchers/getLedegerbalance'); ?>/" + ui.item.id + "",
                    success: function (results) {
                        $("#balance").html("Clossing Balance: " + results);
                    }
                });

                var inputs = $(this).parents("form").eq(0).find(":input");
                var idx = inputs.index(this);
                if (idx === inputs.length - 1) {
                    inputs[0].select()
                } else {
                    inputs[idx + 1].focus(); //  handles submit buttons
                    //inputs[idx + 1].select();
                }
            }
        });
    });
    function loadCust(ui) {
        $('#supname').val(ui.item.name);
    }
    var row = '<td><input type="hidden"  name="id[]" class="ids"/>' +
            '<input data-validation="length" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
            '<td ><input style="float:right" type="text" name="debit[]"     class=" deb form-control hunpx cal debit two-digits" placeholder="Debit"/></td>' +
            '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
    function addrow(id, name, debit) {
        var singrow = '<td><input type="hidden" value=' + id + '  name="id[]" class="ids"/>' +
                '<input data-validation="length" value="' + name + '" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
                '<td ><input style="float:right"  value=' + debit + ' type="text" name="debit[]"     class="deb form-control hunpx cal debit two-digits" placeholder="Debit"/></td>' +
                '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").append(newRow);
    }
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#from_godown').html(result)
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#to_godown').html(result);
            }
        });

        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/getpurchaseitems'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#supid').val(ui.item.id);
                loadCust(ui);
            }
        });
        load();
        is_load = 0;
        $('#addmore').click(function () {
            var newRow = "<tr>" + row + "</tr>";
            $("#rowm").append(newRow);
            $("#cstock").html("")
            $(".remove").removeClass("hidden");
            $(".remove").first().addClass("hidden");
            calculate();
        });
        $(".remove").first().addClass("hidden");

    })
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });
    function calculate() {
        var credit = calc('.credit');
        var debit = calc('.debit');
        $("#totalCredit").val(credit);
        $("#totaldebit").val(debit);
        if (credit === debit) {
            $("#form-button-save").removeAttr("disabled");
        }
    }
    function calc(element) {
        var amount = 0;
        $(element).each(function () {
            var val = $(this).val();
            if (val === '')
            {
                val = 0;
                $(this).val(0);
            }
            amount = parseFloat(amount) + parseFloat(val);
        });
        return amount;
    }
    function load() {
        var vid = $('#vid').val();
        if (vid !== '0') {
            $.ajax({
                url: "<?php echo site_url('master/items/gettransfer'); ?>/" + vid + "",
                success: function (results) {
                    $("#add").remove();
                    $.each(JSON.parse(results), function (i, itemsingle) {
                        $.ajax({
                            url: "<?php echo site_url('master/items/getpitem'); ?>/" + itemsingle.item_id + "",
                            success: function (results) {
                                $.each(JSON.parse(results), function (i, item) {
                                    $('#date').val(itemsingle.dtp);
                                    $('#to_godown').val(itemsingle.to_id);
                                    $('#from_godown').val(itemsingle.from_id);
                                    $('#supname').val(item.name);
                                    $('#supid').val(item.item_id);
                                });
                            }
                        });
                        $('#date').val(itemsingle.dtp);
                        addrow(itemsingle.item_id, itemsingle.name, itemsingle.qty);
                    });
                    var sm = $("#view").val();
                }
            });
        }
    }
    var table;
    var id = 0;
    function ms(toid, edit, c, d)
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
            "searching": false, "bInfo": false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aging/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.type = 'jou';
                    data.enddate = $('#enddate').val();
                    data.id = toid;
                    data.vid = $('#vid').val();
                }
            },
            "fnDrawCallback": function (oSettings) {
                if (edit === 'e') {
                    if (parseInt(c) === 0) {
                        autopay(d);
                    } else {
                        autopayr(c);
                    }
                }

            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
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
                collection.each(function () {
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
            collection.each(function () {
                $(this).prop('checked', autoCheck);
                var id = $(this).attr('id');
                var txtamt = "#txtamt" + id;
                var txtbal = "#txtbal" + id;
                $(txtamt).val(0.00);
                $(txtbal).val(0.00);
            });
        }

    }
</script>
