<form method="post" id="frmcreate"  back="<?php echo site_url('transport/transaction/sales'); ?>" action="<?php echo site_url('transport/transaction/sales_save'); ?>"  class="form-horizontal">
    <input type="hidden" name="pid" id="pid" value="<?= $id ?>" />
    <input type="hidden" name="pid_p" id="pid_p"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales</h3>
                        <span class="pull-right createheader">        
                            <a role="button" data-toggle="tooltip" title="" class="btn btn-info" href="<?php echo site_url('transport/sales/listall') ?>" data-original-title=""> <i class="glyphicon glyphicon-arrow-left"></i> </a> 
                        </span>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td class="col col-lg-1">Invoice</td>
                                <td class="col col-lg-1">Date</td>
                                <td class="col col-lg-1">Received Date</td> 

                                <td class="col col-lg-1">Forworder</td>
                                <td class="col col-lg-1">Transporter </td>
                                <td class="col col-lg-1">Line</td>
                                <td class="col col-lg-1">Status</td>
                            </tr>
                            <tr>
                                <td><input type="text"  data-validation="required" name="invoice" id="invoice" class="form-control" > </td>
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
                                            <option <?= $selected ?> value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name']; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td>
                                    <select name="transport" id="transport" class="form-control">
                                        <option value="">Select</option>
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
                                <td>
                                    <select name="status" id="status">
                                        <option value="0"> Pending </option>
                                        <option value="1"> Completed </option>
                                    </select>
                                </td>
                            </tr>
                            <tr> 
                                <td class="col col-lg-1">Container No</td> 
                                <td class="col col-lg-1">POL</td>
                                <td class="col col-lg-1">POD</td> 
                                <td class="col col-lg-1">consignee</td> 
                                <td class="col col-lg-1">consigner</td> 
                                <td class="col col-lg-1">Vehicle(in)</td> 
                                <td class="col col-lg-1">Driver</td> 
                            </tr>
                            <tr>
                                <td><input  data-validation="required" type="text"  name="container" id="container"  class="form-control"></td> 

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
                                            <option  <?= $selected ?> igst="<?php echo $fwd['Is_IGST_Payment']; ?>" value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name'] . $fwd['Phone']; ?></option>
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
                                <td class="col col-lg-1">
                                    <select data-validation="required" name="veh_id" id="veh_id"   class="form-control">
                                        <option value="" class="form-control">Select</option>
                                        <?php
                                        foreach ($tra_vehicle as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['vhno'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>   value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Vehicle_num']; ?></option>
                                        <?php } ?>
                                    </select></td> 
                                <td class="col col-lg-1">
                                    <select data-validation="required" name="dr_id" id="dr_id"   class="form-control">
                                        <option value="" class="form-control">Select</option>
                                        <?php
                                        foreach ($tra_driver as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['drno'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>   value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Driver_name'] . ' ' . $fwd['Mobile']; ?></option>
                                        <?php } ?>
                                    </select></td> 
                            </tr>
                        </table>
                    </div>
                    <div class="box-body" id="dynamic">


                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td>ETA <input type="text" name="eta" id="eta"></td>
                                <td>Ref.Inv.No <input type="text" name="refino"  id="refino"></td>
                                <td>Invoice .Value<input type="text" name="inoval"  id="inoval"></td>
                                <td>Vessel  <select  data-validation="required" name="vessal" id="vessal"  class="form-control">
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
                                    </select> </td>
                                <td>QTY IN BOXES<input type="text" name="qtybox" id="qtybox"></td>
                                <td>Commoidities<input type="text" name="comm" id="comm"></td> 
                            </tr>
                            <tr>
                                <td>ETD <input type="text" name="etd" id="etd"></td>
                                <td>Addition <input type="text" name="aditon" onchange="total()" id="adition"></td>
                                <td>Discount<input type="text" name="substration"onchange="total()"  id="discount"></td>
                                <td>Vehicle <input  name="comment" id="comment"  type="text" class="form-control" ></td>
                                <td>G Total<input type="text" name="gtotal" id="gtotal"></td>
                                <td>Round Off<input type="text" name="round" id="round"></td>  
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
                '<p><span class="col col-lg-6" >' + itemsingle.Name + ' </span> <input  type="text" name="schr' + itemsingle.Id + '" class=" ' + sum + '" id=' + itemsingle.Id + ' onchange="mcharge(this,' + itemsingle.Id + ')" /> </p><br/>' +
                tax(itemsingle.Id) +
                '<p><span class="col col-lg-6" > Total </span> <input  name="tot' + itemsingle.Id + '" type="text" id="comm' + itemsingle.Id + '"/> </p><br/>' +
                '</div> </div> </div>';
        return tmp;
    }
    function load() {
        var pid = $("#pid").val();
        if (pid !== '0') {
            $.ajax({
                url: "<?php echo site_url('transport/transaction/getsales'); ?>/" + pid,
                async: false,
                success: function (result) {
                    var itemsingle = JSON.parse(result)
                    $('#invoice ').val(itemsingle.invoice);
                    $('#sdate').val(itemsingle.s_date);
                    $('#rdate').val(itemsingle.r_date);
                    $('#comment').val(itemsingle.comment);
                    $('#container').val(itemsingle.container);
                    $('#adition').val(itemsingle.aditon);
                    $('#discount').val(itemsingle.substration);
                    $('#refino').val(itemsingle.refinno);
                    $('#inoval').val(itemsingle.invoicevalue);
                    $('#qtybox').val(itemsingle.qtyinbox);
                    $('#comm').val(itemsingle.commidities);
                    $('#pid_p').val(itemsingle.pid_p);
                    $('#transport').val(itemsingle.transport);
                    $('#eta').val(itemsingle.eta);
                    $('#etd').val(itemsingle.etd);
                    $('#status').val(itemsingle.status);
                    $.ajax({
                        url: "<?php echo site_url('transport/transaction/getsalesitem'); ?>/" + pid,
                        async: false,
                        success: function (result) {
                            $.each(JSON.parse(result), function (i, itemsingle) {
                                var name = 'input[name="' + itemsingle.txtname + '"]';
                                $(name).val(itemsingle.value);
                                total();
                            });
                            $.each(JSON.parse(result), function (i, itemsingle) {
                                var name = 'input[name="' + itemsingle.txtname + '"]';
                                $(name).trigger('change');
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
            url: "<?php echo site_url('transport/transaction/tax/'); ?>" + id,
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
        var text = '<p><span class="col col-lg-6" >' + itemsingle.Name + ' </span>  <input  type="text" ' + sub + ' class="' + sum + ' a  schr' + id + '" name="schr' + itemsingle.Id + '"   onchange="schrg(this,' + id + ')" > </p>';
        return  text;
    }
    function text(itemsingle, id, i) {
        var check = '';
        if (i === 0) {
            check = 'checked="checked"';
        }
        // <input type="radio" ' + check + ' name="chr' + id + '" class="rchr' + id + '" value="chr' + id + i + '"/>
        var text = '<p><span class="col ' + itemsingle.name + ' col-lg-6" > Tax   ' + itemsingle.name + '</span>  <input onchange="tchnagesum(' + id + ')" tabindex="-1" name="tax' + itemsingle.id + id + '"  id="chr' + id + i + '"  type="text" class="comm' + id + ' ' + itemsingle.name + '  sum chr' + id + '" per=' + itemsingle.percent + ' > </p>';
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
            var igst = $('#consignee option:selected').attr('igst');
            var tinc = 0;
            if (igst === '1') {
                if ($(item).hasClass('IGST') === true) {
                    tinc = 1;
                    tot = parseFloat(tot) + parseFloat($(item).val());
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
                    tot = parseFloat(tot) + parseFloat($(item).val());
                }
                if ($(item).hasClass('SGST') === true) {
                    tinc = 1;
                    tot = parseFloat(tot) + parseFloat($(item).val());
                }

            }
            var its = $(item).val();
            if (its === '') {
                its = 0;
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
        $('#gtotal').val(amt.toFixed(0));
    }
    $(document).ready(function () {
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
        $("#container").autocomplete({
            source: "<?php echo site_url('transport/transaction/getpurchaseauto'); ?>",
            //minLength: 2,
            select: function (event, ui) {
                var itemsingle = ui.item;
                $('#pid_p').val(itemsingle.pid);
                $('#sdate').val(itemsingle.s_date);
                $('#rdate').val(itemsingle.r_date);
                $('#comment').val(itemsingle.comment);
                $('#container').val(itemsingle.container);
                $('#forworder').val(itemsingle.forworder);
                $('#line').val(itemsingle.line);
                $('#vessal').val(itemsingle.vessal);
                $('#pol').val(itemsingle.pol);
                $('#pod').val(itemsingle.pod);
                $('#consignee').val(itemsingle.consignee);
                $('#consiner').val(itemsingle.consiner);
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
                    url: "<?php echo site_url('transport/transaction/getpurchaseitem'); ?>/" + itemsingle.pid,
                    async: false,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            var name = 'input[name="' + itemsingle.txtname + '"]';
                            $(name).val(itemsingle.value);
                            total();
                            visibletax();
                        });
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            var name = 'input[name="' + itemsingle.txtname + '"]';
                            $(name).trigger('change');
                        });
                    }
                });
            }
        });
        $("#consignee").change(function () {
            visibletax();
        });
        visibletax();
    });
    function visibletax() {
        var igst = $('#consignee option:selected').attr('igst');
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