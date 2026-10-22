<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transport/transaction/purchase_create'); ?>" action="<?php echo site_url('transport/transaction/save'); ?>"  class="form-horizontal">
    <input type="hidden" name="pid" id="pid" value="<?= $id ?>" />

    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Purchase</h3>
                        <span class="pull-right createheader">        
                            <a role="button" data-toggle="tooltip" title="" class="btn btn-info" href="<?php echo site_url('transport/transaction/listall') ?>"> <i class="glyphicon glyphicon-arrow-left"></i> </a> 
                        </span>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td class="col col-lg-1">Invoice</td>                    
                                <td class="col col-lg-1">Date</td>
                                <td class="col col-lg-1">Received Date</td> 
                                <td class="col col-lg-1">Forwarder</td>
                                <td class="col col-lg-1">Transporter </td>
                                <td class="col col-lg-1">Transporter Invoice No</td>
                                <td class="col col-lg-1">Vehicle No</td>
                            </tr>
                            <tr>
                                <td><input type="text"  data-validation="required" name="invoice" id="invoice" class="form-control" ></td>
                                <td><input type="text"  data-validation="required"  name="sdate"  id="sdate"  class="form-control date col-lg-1" ></td>
                                <td><input type="text" data-validation="required" name="rdate"  id="rdate"  class="form-control date col-lg-1"></td>  
                                <td>
                                    <select data-validation="required" name="forworder" id="forworder" class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($fwdr as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['forworder'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option <?= $selected ?> value="<?php echo $fwd['Id']; ?>" igst="<?php echo $fwd['Is_IGST_Payment']; ?>"> <?php echo $fwd['Name']; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td>
                                    <select  name="transport" id="transport" class="form-control">
                                        <?php
                                        if ($pall['transport'] == 0) {
                                            $selected = 'selected="selected"';
                                        }
                                        ?>
                                        <option  <?php echo $selected; ?>   value="0">Select  </option>
                                        <?php
                                        foreach ($tra_transport as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['transport'] == $fwd['id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option <?= $selected ?> value="<?php echo $fwd['id']; ?>"> <?php echo $fwd['name']; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td><input  name="inv" id="inv"  type="text" class="form-control" ></td>

                                <td><input  name="comment" id="comment"  type="text" class="form-control" ></td>
                            </tr>
                            <tr> 
                                <td class="col col-lg-1">Order</td>
                                <td class="col col-lg-1">Container No</td>
                                <td class="col col-lg-1">Line</td>

                                <td class="col col-lg-1">POL</td>
                                <td class="col col-lg-1">POD</td> 
                                <td class="col col-lg-1">consignee</td> 
                                <td class="col col-lg-1">consigner</td> 
                            </tr>
                            <tr>
                                <td><select  name="order"  id="order"    class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($order as $fwd) {
                                            ?>
                                            <option consinee_id="<?php echo $fwd['consinee_id']; ?>" vhicle="<?php echo $fwd['vhicle']; ?>" consignr_id="<?php echo $fwd['consignr_id']; ?>" forwrd_id="<?php echo $fwd['forwrd_id']; ?>" line_id="<?php echo $fwd['line_id']; ?>" trspt_id="<?php echo $fwd['trspt_id']; ?>" pol_id="<?php echo $fwd['pol_id']; ?>" pod_id="<?php echo $fwd['pod_id']; ?>" contner_no="<?php echo $fwd['contner_no']; ?>" delvery_date="<?php echo $fwd['delvery_date']; ?>" value="<?php echo $fwd['ord_id']; ?>"   value="<?php echo $fwd['ord_id']; ?>"> <?php echo $fwd['contner_no']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td ><input  data-validation="required" type="text"  name="container" id="container"  class="form-control"></td> 
                                <td><select  data-validation="required" name="line"  id="line"    class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($line as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['line'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>  value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <td><select data-validation="required" name="pol" id="pol" class="form-control" id="pol">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($pickup as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['pol'] == $fwd['id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>  value="<?php echo $fwd['id']; ?>"> <?php echo $fwd['Name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><select data-validation="required" name="pod" id="pod"  class="form-control">
                                        <option value="" class="form-control">Select</option>
                                        <?php
                                        foreach ($delivery as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['pod'] == $fwd['id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>  value="<?php echo $fwd['id']; ?>"> <?php echo $fwd['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><select data-validation="required" name="consignee"  id="consignee" class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($consignee as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['consignee'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?> 
                                            <option  <?= $selected ?> value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name'] . $fwd['Phone']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><select data-validation="required" name="consiner" id="consiner"   class="form-control">
                                        <option value="" class="form-control">Select</option>
                                        <?php
                                        foreach ($consigner as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['consiner'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>   value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name'] . $fwd['Phone']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="box-body" id="dynamic">


                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td>ETA <input type="text" name="eta" id="eta"></td>
                                <td class="col col-lg-1">
                                    Vessel 
                                    <select  data-validation="required" name="vessal" id="vessal"  class="form-control">
                                        <option value="" >Select</option>
                                        <?php
                                        foreach ($tra_vessal as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['vessal'] == $fwd['id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>  value="<?php echo $fwd['id']; ?>"> <?php echo $fwd['name']; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td>Ref.Inv.No <input type="text" name="refino"  id="refino"></td>
                                <td>Invoice .Value<input type="text" name="inoval"  id="inoval"></td>

                                <td>QTY IN BOXES<input type="text" name="qtybox" id="qtybox"></td>
                                <td>Commoidities<input type="text" name="comm" id="comm"></td> 
                            </tr>
                            <tr>
                                <td>ETD <input type="text" name="etd" id="etd"></td>
                                <td>Addition <input type="text" name="aditon" onchange="total()" id="adition"></td>
                                <td>Discount<input type="text" name="substration"onchange="total()"  id="discount"></td>
                                <td>Transport Total<input type="text" name="tptotal" id="tptotal"></td>
                                <td>Grand Total<input type="text" name="gtotal" id="gtotal"></td>
                                <td>Round Off <input type="text" name="round" id="round"></td>

                            </tr>
                        </table>
                        <input type="submit"/>
                    </div>
                </div> 
            </div>
        </div> 
    </section>
</form>
<script type="text/javascript">
    function template(itemsingle) {
        var sum = '';
        if (itemsingle.is_groupsum === '1') {
            sum = 'sum comm' + itemsingle.Id;
        }
        var tmp = '<div class="col-md-4"> <div class="box-body"> ' + subharges(itemsingle.Id) +
                '<p><span class="col col-lg-6" >' + itemsingle.Name + ' </span> <input  type="text" name="schr' + itemsingle.Id + '" class="' + sum + '" id=' + itemsingle.Id + ' onchange="mcharge(this,' + itemsingle.Id + ')" /> </p><br/>' +
                tax(itemsingle.Id) +
                '<p><span class="col col-lg-6" > Total </span> <input  type="text" name="tot' + itemsingle.Id + '"  id="comm' + itemsingle.Id + '"/> </p><br/>' +
                '</div> </div> </div>';
        return tmp;
    }
    function load() {
        var pid = $("#pid").val();
        if (pid !== '0') {
            $.ajax({
                url: "<?php echo site_url('transport/transaction/getpurchase'); ?>/" + pid,
                async: false,
                success: function (result) {
                    var itemsingle = JSON.parse(result)
                    $('#invoice ').val(itemsingle.invoice);
                    $('#sdate').val(itemsingle.s_date);
                    $('#rdate').val(itemsingle.r_date);
                    $('#comment').val(itemsingle.comment);
                    $('#inv').val(itemsingle.invoice_nmbr);
                    $('#container').val(itemsingle.container);
                    $('#adition').val(itemsingle.aditon);
                    $('#discount').val(itemsingle.substration);
                    $('#refino').val(itemsingle.refinno);
                    $('#inoval').val(itemsingle.invoicevalue);
                    $('#qtybox').val(itemsingle.qtyinbox);
                    $('#comm').val(itemsingle.commidities);
                    $('#transport').val(itemsingle.transport);
                    $('#eta').val(itemsingle.eta);
                    $('#etd').val(itemsingle.etd);
                    $.ajax({
                        url: "<?php echo site_url('transport/transaction/getpurchaseitem'); ?>/" + pid,
                        async: false,
                        success: function (result) {
                            $.each(JSON.parse(result), function (i, itemsingle) {
                                var name = 'input[name="' + itemsingle.txtname + '"]';
                                $(name).val(itemsingle.value);
                                total();
                            });
                        }
                    });
                }
            });
        }
    }
    function subharges(id) {
        var outhtml = '';
        $.ajax({
            url: "<?php echo site_url('transport/transaction/charges'); ?>/" + id,
            async: false,
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    outhtml = outhtml + stext(itemsingle, id, i);
                });
            }
        });
        return outhtml;
    }
    function tax(id) { 
        var outhtml = '';
        $.ajax({
            url: "<?php echo site_url('transport/transaction/tax/'); ?>"+id,
            async: false,
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    outhtml = outhtml + text(itemsingle, id, i);
                });
            }
        });
        return outhtml;
    }
    function stext(itemsingle, id, i) {
        var sub = 'sub=""', sum = '';
        if (itemsingle.is_substraction === '1') {
            sub = 'sub="sub"';
        }
        if (itemsingle.is_groupsum === '1') {
            sum = 'sum comm' + id;
        }
        var text = '<p><span class="col col-lg-6" >' + itemsingle.Name + ' </span>  <input  type="text" ' + sub + ' class="' + sum + '  schr' + id + '" name="schr' + itemsingle.Id + '"   onchange="schrg(this,' + id + ')" > </p>';
        return  text;
    }
    function text(itemsingle, id, i) {
        var check = '';
        if (i === 0) {
            check = 'checked="checked"';
        }
        // <input type="radio" ' + check + ' name="chr' + id + '" class="rchr' + id + '" value="chr' + id + i + '"/>
        var text = '<p><span class="col ' + itemsingle.name + ' col-lg-6" > Tax   ' + itemsingle.name + '</span>  <input tabindex="-1" onchange="tchnagesum(' + id + ')" name="tax' + itemsingle.id + id + '"  id="chr' + id + i + '"  type="text" class="comm' + id + ' '+ itemsingle.name +'  sum chr' + id + '" per=' + itemsingle.percent + ' > </p>';
        return  text;
    }
    function schrg(me, id) {
        var vd = '.schr' + id;
        var collection = $(vd);
        var amt = 0;
        collection.each(function (itm, item) {
            var samt = $(item).val();
            if ($(item).attr('sub') === 'sub')
            {
                if (samt !== undefined && samt !== '') {
                    amt = parseFloat(amt) - parseFloat(samt);
                }
            }
            else {
                if (samt !== undefined && samt !== '') {
                    amt = parseFloat(amt) + parseFloat(samt);
                }
            }

        });
        var pid = '#' + id;
        $(pid).val(amt);
        mcharge($(pid), id);
    }
    function mcharge(me, id) {
        var vd = '.chr' + id;
        //var amt = $(me).val();
        var collection = $(vd);
        // var name = 'input[name="chr' + id + '"]:checked';
        //var mid = $(name).val(); 

        collection.each(function (itm, item) {
            var per = $(item).attr('per');
            var tot = parseFloat($("#" + id).val()) * parseFloat(per) / 100;
            $(item).val(tot.toFixed(2));
        });
        tsum(id);
        total();
    }
    function tchnagesum(id) {
        tsum(id);
        total();
    }
    function tsum(id) {
        var vd = '.comm' + id;
        var toid = '#comm' + id;
        var collection = $(vd);
        var tot = 0;
        collection.each(function (itm, item) {
            var its = $(item).val();
            if (its === '') {
                its = 0;
            }

            var igst = $('#forworder option:selected').attr('igst');
            var tinc = 0;
            if (igst === '1') {
                if ($(item).hasClass('IGST') === true) {
                    tinc = 1;
                    tot = parseFloat(tot) + parseFloat(its);
                }
                if ($(item).hasClass('CGST') === true) {
                    tinc = 1;
                    $(item).val(0);
                }
                if ($(item).hasClass('SGST') === true) {
                    tinc = 1;
                    $(item).val(0);
                }

            }
            else {
                if ($(item).hasClass('IGST') === true) {
                    tinc = 1;
                    $(item).val(0);
                }
                if ($(item).hasClass('CGST') === true) {
                    tinc = 1;
                    tot = parseFloat(tot) + parseFloat(its);
                }
                if ($(item).hasClass('SGST') === true) {
                    tinc = 1;
                    tot = parseFloat(tot) + parseFloat(its);
                }

            }
            if (tinc === 0) {
                tot = parseFloat(tot) + parseFloat(its);
            }
        });
        $(toid).val(tot.toFixed(2));
    }
    function total() {
        var vd = '.sum';
        var amt = 0;
        var collection = $(vd);
        collection.each(function (itm, item) {
            var per = $(item).val();
            if (per === '') {
                per = 0;
            }
            amt = parseFloat(amt) + parseFloat(per);
        });
        var ad = $('#adition').val();
        if (ad === '') {
            ad = 0;
        }
        var dis = $('#discount').val();
        if (dis === '') {
            dis = 0;
        }
        amt = parseFloat(amt) + parseFloat(ad) - parseFloat(dis);
        var rount = amt.toFixed(0) - amt.toFixed(2);
        $('#round').val(rount.toFixed(2));

        var comm4 = $("#comm4").val();
        if (comm4 === '') {
            comm4 = 0;
        }
        var trnd = parseFloat(comm4).toFixed(0) - parseFloat(comm4).toFixed(2);
        if ($("#transport").val() === '0') {
            comm4 = 0;
        }
        amt = parseFloat(amt) - parseFloat(comm4)
        $('#gtotal').val(amt.toFixed(0));
        $('#tptotal').val(parseFloat(comm4).toFixed(0));


    }
    $(document).ready(function () {
        $("#transport").change(function () {
            total();
        });
        var outhtml = '';
        $.ajax({
            async: 'false',
            url: "<?php echo site_url('transport/transaction/charges'); ?>",
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    outhtml = outhtml + template(itemsingle);
                    $('#dynamic').html(outhtml);
                });
                load();
                visibletax();
            }
        });
        $("#order").change(function () {
            var ctainer = $('#order option:selected').text();
            $("#container").val(ctainer);
            var consinee_id = $('#order option:selected').attr('consinee_id');
            $("#consignee").val(consinee_id);
            var consignr_id = $('#order option:selected').attr('consignr_id');
            $("#consiner").val(consignr_id);
            var forwrd_id = $('#order option:selected').attr('forwrd_id');
            $("#forworder").val(forwrd_id);
            var line_id = $('#order option:selected').attr('line_id');
            $("#line").val(line_id);
            var trspt_id = $('#order option:selected').attr('trspt_id');
            $("#transport").val(trspt_id);
            var pol_id = $('#order option:selected').attr('pol_id');
            $("#pol").val(pol_id);
            var pod_id = $('#order option:selected').attr('pod_id');
            $("#pod").val(pod_id);
            var vhicle = $('#order option:selected').attr('vhicle');
            $("#comment").val(vhicle);
            visibletax();
            /*$('#eta').val(itemsingle.eta);
             $('#etd').val(itemsingle.etd);*/
            //  vhicle

        });
        $("#forworder").change(function () {
            visibletax();
        });
        visibletax();


    });
    function visibletax() {
        var igst = $('#forworder option:selected').attr('igst');
        if (igst === '1') {
            $('.IGST').show();
            $('.SGST').hide();
            $('.CGST').hide();
        }
        else {
            $('.SGST').show();
            $('.CGST').show();
            $('.IGST').hide();
        }

    }

</script>