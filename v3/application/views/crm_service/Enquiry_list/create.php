<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('crm_service/Enquiry_list/listall'); ?>" action="<?php echo site_url('crm_service/Enquiry_list/save'); ?>">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
    <input type="hidden" value="<?php echo $logged; ?>" name="loggedid" id="loggedid" />
    <input type="hidden" value="0" name="leadid" id="leadid" />
    <input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Create Service Bill', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('crm_service/Enquiry_list/listall'); ?>">
                                <span class="remove glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-4">
                                <?php if ($serv_no > 0) { ?>
                                    <div class="" style="display: none;">
                                        <?= label('Service No', $this, $user) ?>
                                        <input type="hidden" id="serv_id" name="serv_id" value="<?php echo $serv_no ?>" />
                                        <input tabIndex="3" type="text" name="service_num" id="service_num" data-validation="required" class="form-control">
                                    </div>
                                <?php } else { ?>
                                    <div class="">
                                        <?= label('Service No', $this, $user) ?>
                                        <input type="hidden" id="serv_id" name="serv_id" />
                                        <input tabIndex="3" type="text" name="service_num" id="service_num" data-validation="required" class="form-control">
                                    </div>
                                    <br>
                                <?php } ?>





                                <div class="">
                                    <?= label('Date', $this, $user) ?>
                                    <input tabIndex="2" name="date" id="date" type="text" class="form-control date">
                                </div>
                                <br>

                                <div class="">
                                    <?= label('Type', $this, $user) ?>
                                    <select tabIndex="14" name="typess" id="typess" data-validation="required" class="form-control">
                                        <option value="1">Vehicle</option>
                                        <option value="2">Products</option>
                                    </select>
                                </div>

                                <br>

                                <div class="">
                                    <label id="exename">Executive Name</label>
                                    <select tabIndex="11" name="user" id="user" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>

                                <div class="">
                                    <label id="exename">Completion Status</label>
                                    <select tabIndex="11" name="completionstat" id="completionstat" class="form-control">
                                        <option value="1">Pending</option>
                                        <option value="2">Completed</option>
                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Amount', $this, $user) ?>
                                    <input tabIndex="2" name="amount_to_pay" id="amount_to_pay" type="text" class="form-control">
                                </div>
                                <br>


                            </div>

                            <div class="col-12 col-md-4 col-lg-4">

                                <div class="">
                                    <?= label('Customer Name', $this, $user) ?>
                                    <input type="hidden" id="customerid" name="customerid" >
                                    <input tabIndex="3" type="text" name="customerName" id="customerName"  class="form-control">
                                </div>
                                <br>

                                <div class="">
                                    <?= label('Name', $this, $user) ?>
                                    <input type="hidden" id="item_id" name="item_id" data-validation="required">
                                    <input tabIndex="3" type="text" name="item_name" id="item_name" data-validation="required" class="form-control">
                                </div>
                                <br>

                                <div class="">
                                    <label id="exename">Allocated User</label>
                                    <select tabIndex="11" name="alloo_user" id="alloo_user" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>

                                <div class="">
                                    <label id="exename">Service Engineer</label>
                                    <select tabIndex="11" name="serv_user" id="serv_user" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>

                                  <div class="">
                                    <?= label('Engineer Remarks', $this, $user) ?>
                                    <textarea tabIndex="18" name="engineer_remarks" id="engineer_remarks" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>

                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="">
                                    <?= label('Delivery Date', $this, $user) ?>
                                    <input tabIndex="2" name="deli_date" id="deli_date" type="text" class="form-control date">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Product Details', $this, $user) ?>
                                    <textarea tabIndex="18" name="prod_det" id="prod_det" readonly class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Remarks', $this, $user) ?>
                                    <textarea tabIndex="18" name="remarks" id="remarks" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>

                                 <div class="">
                                    <?= label('Status', $this, $user) ?>
                                    <select class ="form-control" name ="status" id ="status" required>
                                        <option value ="">Select</option> 
                                        <option value ="closed">Closed</option> 
                                        <option value ="returned">Returned</option> 
                                    </select>
                                </div>
                                <br>

                                  <div class="">
                                    <?= label('Closed Remarks', $this, $user) ?>
                                    <textarea tabIndex="18" name="closed_remarks" id="closed_remarks" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>

                            </div>



                        </div>

                        <div class="row">
                            <hr>
                        </div>

                        <div class="row" style="margin: 10px;">
                            <table class="table table-striped table-condensed" id="tblProducts" style="width: 100%">

                                <tr id="value">
                                    <th><?= label('Particulars', $this, $user) ?></th>
                                    <th><?= label('Quantity', $this, $user) ?></th>
                                    <th><?= label('Rate', $this, $user) ?></th>
                                    <th><?= label('Tax', $this, $user) ?></th>
                                    <th><?= label('Tax Amount', $this, $user) ?></th>
                                    <th><?= label('Total', $this, $user) ?></th>
                                </tr>

                                <tr>
                                    <td width="20%">
                                        <input type="hidden" id="productzzid" name="productzzid">
                                        <input tabIndex="15" type="text" name="productzz" id="productzz">
                                    </td>
                                    <td width="10%">
                                        <input tabIndex="16" value="1" type="text" id="quantity" name="quantity" class="form-control" />
                                    </td>
                                    <td width="10%">
                                        <input tabIndex="17" type="text" id="rate" name="rate" class="form-control" />
                                    </td>
                                    <td width="10%">
                                        <input tabIndex="16" type="text" id="taxz" name="taxz" class="form-control" />
                                    </td>
                                    <td width="20%">
                                        <input tabIndex="17" type="text" id="tax_amt" name="tax_amt" class="form-control" />
                                    </td>
                                    <td width="20%">
                                        <input tabIndex="17" type="text" id="tot_amt_price" name="tot_amt_price" class="form-control tot_amt_price" />
                                    </td>
                                    <td width="10%">
                                        <a data-toggle="tooltip" tabindex="17" style="float: left" title="Add More" id="addmore" class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span></a>
                                    </td>
                                </tr>

                                <tbody id='addrow'>
                                </tbody>

                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="text" id="total" name="total" class="grdtot" /></td>
                                </tr>

                            </table>
                        </div>

                        <div class="row">
                            <hr>
                        </div>

                        <div class="row" style="margin: 10px;">
                            <table class="table table-striped table-condensed col-lg-6">
                                <thead>
                                    <tr>
                                        <td colspan="6"><?= label('Additional Ledger', $this, $user) ?> </td>
                                        <td colspan="1"><?= label('Tax', $this, $user) ?>%</td>
                                        <td colspan="2"><?= label('Service Amount', $this, $user) ?></td>
                                        <td colspan="2"><?= label('Tax', $this, $user) ?> <?= label('Amount', $this, $user) ?> </td>
                                        <td colspan="1"><?= label('Action', $this, $user) ?>
                                        <td>
                                    </tr>

                                </thead>
                                <tbody id="rows">
                                    <tr id="addservice">
                                        <td colspan="6"> <input type="hidden" NoTab="true" tabindex="-1" name="ser_ledgerid" id="ser_ledgerid" /><input NoTab="true" id="ser_ledger" class="form-control" type="text" placeholder="<?= label('Ledger', $this, $user) ?>" /></td>
                                        <td colspan="1"><input type="hidden" NoTab="true" tabindex="-1" name="ser_taxid" id="ser_taxid" /><select tabindex="-1" id="ser_tax" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </td>
                                        <td colspan="2"> <input style='height:25px' id="ser_amt" type="text" class="form-control text-right  two-digits price " placeholder="<?= label('Service Amount', $this, $user) ?>" /></td>
                                        <td colspan="2"> <input id="ser_taxamt" type="text" readonly="readonly" class="form-control  text-right two-digits" placeholder="<?= label('Tax', $this, $user) ?> <?= label('Amount', $this, $user) ?> " /></td>
                                        <!--                                        hidden-->
                                        <td colspan="1"> <button data-toggle="tooltip" type="button" title="Add To save" class="btn btn-success">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped table-condensed">
                                <tr>
                                    <td></td>
                                    <td> </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?= label('Total', $this, $user) ?> <?= label('Tax', $this, $user) ?></td>
                                    <td><?= label('Total', $this, $user) ?></td>
                                </tr>
                                <tr>
                                    <td class='col-lg-4'></td>
                                    <td class='col-lg-2'></td>
                                    <td class='col-lg-2'></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input name="sertaxtotal" id="sertaxtotal" placeholder="Total Tax" value="0" readonly="readonly" type="text" class="text-right  form-control"></td>
                                    <td><input name="sergtotal" id="sergtotal" placeholder="Grand Total" value="0" readonly="readonly" type="text" class="text-right  form-control"></td>
                                </tr>
                            </table>

                            <table class="table table-striped table-condensed">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?= label('Grand Total', $this, $user) ?></td>
                                </tr>
                                <tr>
                                    <td class='col-lg-4'></td>
                                    <td class='col-lg-2'></td>
                                    <td class='col-lg-2'></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input name="final_grand_total" id="final_grand_total" placeholder="Grand Total" value="0" readonly="readonly" type="text" class="text-right  form-control"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php if($type != 'view'){?>
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<div class="modal fade bd-example-modal-lg" id="myModalPop_cus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" id="mcb" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="m_itemClick" popup_type="item" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var logged = $('#loggedid').val();

        var text = "";
        $.ajax({

            url: "<?php echo site_url('crm_service/Enquiry_register/users'); ?>",
            async: false,
            success: function(results) {
                text = '<option value = "">Select</option>';
                $.each(JSON.parse(results), function(i, items) {
                    text = text + '<option value = "' + items.Id + '">' + items.user_name + '</option>';
                });
                $('#user').html(text);
                $('#alloo_user').html(text);
                $('#serv_user').html(text);
            }
        });
        $('#user').val(logged);
        $('#alloo_user').val(logged);
        $('#serv_user').val(logged);

        <?php if ($serv_no > 0) { ?>
            $.ajax({
                url: "<?php echo base_url(); ?>crm_service/Enquiry_list/get_services_from_id/" + <?php echo $serv_no ?>,
                async: false,
                success: function(results) {
                    // console.log(results);
                    var res = JSON.parse(results);
                    $('#customerid').val(res.sup_id);
                    $('#customerName').val(res.sup_name);
                    $('#deli_date').val(formatDate(res.Ddate));
                    $('#amount_to_pay').val(res.totalAmount);
                    $('#date').val(formatDate(res.date));
                    $('#typess').val(res.type);
                    $('#alloo_user').val(res.alloc_user);
                    $('#remarks').val(res.remarks);
                      $('#item_name').val(res.itemname);
                    $.ajax({
                        url: "<?php echo base_url(); ?>crm_service/Enquiry_list/get_item_details",
                        type: "POST",
                        data: {
                            'type': res.type,
                            'item_id': res.item_id,
                        },
                        success: function(results) {
                            var result = JSON.parse(results);
                            if (res.type == 1) {

                                $('#prod_det').val('Vehicle No : ' + result.veh_no + ' \nVehicle Name : ' + result.veh_name + ' \nModel  : ' + result.veh_model + ' \nBrand : ' + result.veh_brand);
                                $('#item_name').val(result.veh_no);
                                $('#item_id').val(result.id);
                            } else {
                                $('#prod_det').val('Prate : ' + result.prate + ' \nSrate : ' + result.srate + ' \nMRP : ' + result.MRP + ' \nDescription : ' + result.description);
                                $('#item_name').val(result.name);
                                $('#item_id').val(result.id);
                            }
                            
                        }
                    });

                }

            })
        <?php } ?>

        $("#service_num").autocomplete({

            source: "<?php echo base_url(); ?>crm_service/Enquiry_list/get_services/", // path to the get_birds method
            async: false,
            minLength: 1,
            select: function(event, ui) {
                $("#serv_id").val(ui.item.ver_id);
                $('#customerid').val(ui.item.sup_id);
                $('#customerName').val(ui.item.sup_name);
                $('#deli_date').val(formatDate(ui.item.Ddate));
                $('#date').val(formatDate(ui.item.date));
                $('#typess').val(ui.item.type);   
                $('#amount_to_pay').val(ui.item.totalAmount);
                $('#alloo_user').val(ui.item.alloc_user);
                $('#remarks').val(ui.item.remarks);
                $.ajax({
                    url: "<?php echo base_url(); ?>crm_service/Enquiry_list/get_item_details",
                    type: "POST",
                    data: {
                        'type': ui.item.type,
                        'item_id': ui.item.item_id,
                    },
                    success: function(results) {
                        var result = JSON.parse(results);
                        if (ui.item.type == 1) {

                            $('#prod_det').val('Vehicle No : ' + result.veh_no + ' \nModel : ' + result.veh_model + ' \n Brand : ' + result.veh_brand + ' \nName : ' + result.veh_name);
                            $('#item_name').val(result.veh_no);
                            $('#item_id').val(result.id);
                        } else {
                            $('#prod_det').val('Prate : ' + result.prate + ' \nSrate : ' + result.srate + ' \nMRP : ' + result.MRP + ' \nDescription : ' + result.description);
                            $('#item_name').val(result.name);
                            $('#item_id').val(result.id);
                        }
                        
                    }
                });

            }
        });

        $("#customerName").autocomplete({
            source: "<?php echo base_url(); ?>crm_service/Enquiry_allocation/getcustomerdet/", // path to the get_birds method
            async: false,
            minLength: 1,
            select: function(event, ui) {
                $("#customerid").val(ui.item.id);
            }
        });

        $("#item_name").autocomplete({
            source: "<?php echo base_url(); ?>crm_service/Enquiry_allocation/gettypedet/" + $('#typess').val(), // path to the get_birds method
            async: false,
            minLength: 1,
            select: function(event, ui) {
                $("#item_id").val(ui.item.id);
                if ($('#typess').val() == 1) {
                    $('#prod_det').val('Vehicle No : ' + ui.item.veh_no + ' \nRC No : ' + ui.item.rc_no + ' \nInsurance No : ' + ui.item.ins_no + ' \nMake : ' + ui.item.make + ' \nCompany : ' + ui.item.company);
                } else {
                    $('#prod_det').val('Prate : ' + ui.item.prate + ' \nSrate : ' + ui.item.srate + ' \nMRP : ' + ui.item.MRP + ' \nDescription : ' + ui.item.description);
                }

            }
        });

        $("#productzz").autocomplete({

            source: "<?php echo base_url(); ?>crm_service/Enquiry_allocation/gettypedet/" + 2, // path to the get_birds method
            async: false,
            minLength: 1,
            select: function(event, ui) {
                $("#productzzid").val(ui.item.id);
                $("#rate").val(ui.item.srate);
                $('#taxz').val(ui.item.GST);
                var tax_amt = (parseInt(ui.item.srate) * parseInt(ui.item.GST)) / 100;
                $('#tax_amt').val(tax_amt);
                $('#tot_amt_price').val(tax_amt + parseInt(ui.item.srate));
            }
        });


        $("#ser_ledger").autocomplete({
            source: "<?php echo site_url('ajaxcall/ledgers'); ?>",
            minLength: 2,
            select: function(event, ui) {
                $('#ser_ledgerid').val(ui.item.id);
                $('#ser_tax').val(ui.item.tax_id);
                $('#ser_ledger').val(ui.item.name);
                $('#ser_amt').focus();
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function(result) {
                $('#tax_item').html(result);
                $('#tax_common').html(result);
                $('#ser_tax').html(result);
            }
        });

        $('#tot_amt_price').keydown(function(e) {
            var keyCodes = e.keyCode;
            if (keyCodes == 13 || keyCodes == 9) {
                var name = $("#productzz").val();
                var productid = $("#productzzid").val();
                var quantity = $("#quantity").val();
                var price = $("#rate").val();
                var taxz = $("#taxz").val();
                var tax_amt = $("#tax_amt").val();
                var tot_amt_price = $("#tot_amt_price").val();
                if (productid !== '' && price !== "" && quantity !== "" && taxz !== "" && tax_amt !== "" && tot_amt_price !== "") {
                    additem(name, productid, quantity, price, taxz, tax_amt, tot_amt_price);
                }
                calcGrand();
            }

        });

        $("#ser_amt").keydown(function(e) {
            var amount = $("#ser_amt").val();
            if (amount > 0) {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    addservices();
                }
            }

        });

        $('#addmore').click(function() {
            var name = $("#productzz").val();
            var productid = $("#productzzid").val();
            var quantity = $("#quantity").val();
            var price = $("#rate").val();
            var taxz = $("#taxz").val();
            var tax_amt = $("#tax_amt").val();
            var tot_amt_price = $("#tot_amt_price").val();
            if (productid !== '' && price !== "" && quantity !== "" && taxz !== "" && tax_amt !== "" && tot_amt_price !== "") {
                additem(name, productid, quantity, price, taxz, tax_amt, tot_amt_price);
            }

        });

    });

    function calcGrand() {
        var total = $('#total').val();
        if (total == '') {
            total = 0;
        }
        var sergtotal = $('#sergtotal').val();
        if (sergtotal == '') {
            sergtotal = 0;
        }

        $('#final_grand_total').val(parseInt(total) + parseInt(sergtotal));
    }

    function additem(name, productid, quantity, price, taxz, tax_amt, tot_amt_price) {
        $("#productzz").val('');
        $("#productzzid").val('');
        $("#quantity").val('');
        $("#rate").val('');
        $("#taxz").val('');
        $("#tax_amt").val('');
        $("#tot_amt_price").val('');
        var newrow = "<tr><td><input value=" + productid + " type='hidden' name='product_id[]' ><input readonly class='form-control' name ='product_name[]' type='text' value='" + name + "'></td>";
        newrow = newrow + '<td><input readonly type="text" class="form-control" value=' + quantity + ' name="item_quantity[]">';
        newrow = newrow + '<td><input readonly type="text" class="form-control" value=' + price + ' name="item_price[]">';
        newrow = newrow + '<td><input readonly type="text" class="form-control" value=' + taxz + ' name="item_taxz[]">';
        newrow = newrow + '<td><input readonly type="text" class="form-control" value=' + tax_amt + ' name="item_tax_amt[]">';
        newrow = newrow + '<td><input readonly type="text" class="form-control subtot" value=' + tot_amt_price + ' name="tot_amt_price[]">' +
            '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign remove"></span> </span></td></tr>';
        $('#addrow').append(newrow);
        calcrow();
    }

    function calcrow() {
        var total = 0;
        $(".subtot").each(function() {
            var stval = parseFloat($(this).val());
            total = parseFloat(stval) + parseFloat(total);

        });
        $('#grdtotal').val(total);

        $('.grdtot').val(total.toFixed(2));
    }

    function calculatesertot(amt, tax) {
        if ($("#sertaxtotal").val() == '') {
            $("#sertaxtotal").val(0);
        }
        if ($("#sergtotal").val() == '') {
            $("#sergtotal").val(0);
        }
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        totamt = (parseFloat(totamt) - parseFloat(amt)).toFixed(2);
        tottax = (parseFloat(tottax) - parseFloat(tax)).toFixed(2);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
    }

    function addservices() {
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        var ledger = $("#ser_ledger").val();
        var ledgerid = $("#ser_ledgerid").val();
        var amount = $("#ser_amt").val();
        var taxid = $("#ser_tax").val();
        var tid = 0;
        totamt = (parseFloat(totamt) + parseFloat(amount)).toFixed(2);
        var gst = 0;
        var tax = 0;
        if (amount !== '0' && taxid !== null && taxid !== '0') {
            tax = $("#ser_tax option:selected").attr('percent');
            gst = (parseFloat((amount * tax) / 100)).toFixed(2);
            tottax = (parseFloat(tottax) + parseFloat(gst)).toFixed(2);
            tid = $("#ser_tax").val();
        }
        $("#ser_taxamt").val(gst);
        addrowtoservice(amount, tid, tax, gst, ledger, ledgerid);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
        $("#ser_ledger").focus();
        calcGrand();
    }

    function addrowtoservice(amount, taxid, tax, gst, ledger, ledgerid) {
        var newrow = '<tr><td  colspan="6"> <input type="hidden" readonly="readonly" NoTab="true" value="' + ledgerid + '" tabindex="-1" name="serv_ledgerid[]" id="serv_ledgerid"/><input  NoTab="true"  readonly="readonly" id="serv_ledger"  class="form-control" name = "ledg_name[]"  value="' + ledger + '" type="text"     placeholder="service ledger"/></td>' +
            ' <td  colspan="1"> <input type="hidden" NoTab="true" value="' + taxid + ' " tabindex="-1" name="serv_taxid[]" readonly="readonly" id="serv_taxid"/><input  NoTab="true"   id="serv_tax"  class="form-control" readonly="readonly" name = "tax_name[]"  value="' + tax + ' " type="text"     placeholder="service ledger"/></td>' +
            ' <td  colspan="2"> <input style="height:25px" id="serv_amt"  name="serv_amt[]" value="' + amount + '" type="text" readonly="readonly" class="form-control text-right  two-digits price " placeholder="service Amt"/></td>' +
            ' <td  colspan="2"> <input id="serv_taxamt" name="serv_taxamt[]" value="' + gst + '"  type="text" readonly="readonly"   class="form-control  text-right two-digits" placeholder="GST"/></td>' +
            '<td  colspan="1"> <span data-toggle="tooltip"   title="Remove" onclick="removeservice(this)" sertax="' + gst + '" seramt="' + amount + '"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span> </td></tr>';
        $("#rows").append(newrow);
        clearservice();

    }

    function clearservice() {
        clearValue($("#ser_ledger"));
        clearValue($("#ser_ledgerid"));
        clearValue($("#ser_amt"));
        clearValue($("#ser_taxamt"));
    }

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1],
            day = datePart[2];

        return day + '/' + month + '/' + year;
    }


    var id = $("#id").val();
    if (id > 0) {

        $.ajax({
            url: "<?php echo site_url('crm_service/Enquiry_list/getsing'); ?>/" + id,
            success: function(results) {
                var resultz = JSON.parse(results);
                $("#serv_id").val(resultz.call_id);
                $("#service_num").val(resultz.service_no);
                $("#serv_user").val(resultz.serv_eng);
                $("#completionstat").val(resultz.stat);
                $.ajax({
                    url: "<?php echo site_url('crm_service/Enquiry_register/getsing'); ?>/" + resultz.item_idd,
                    success: function(results) {
                        var result = JSON.parse(results);
                        $("#customerName").val(result.cus_name);
                        $("#customerid").val(result.cus_id);
                        $("#user").val(result.enq_user);
                        $("#date").val(formatDate(result.date));
                        $("#deli_date").val(formatDate(result.Ddate));
                        $('#prod_det').val('Prate : ' + result.prate + ' \nSrate : ' + result.srate + ' \nMRP : ' + result.MRP + ' \nDescription : ' + result.description);
                        $("#alloo_user").val(result.user);
                        $('#amount_to_pay').val(result.totalAmount);
                        $("#type").val(result.ver_type);
                        if (result.type == 2) {
                            $('.quan').hide();
                        } else {
                            $('.quan').show();
                        }
                        $.ajax({
                            url: "<?php echo base_url(); ?>crm_service/Enquiry_list/get_item_details",
                            type: "POST",
                            data: {
                                'type': result.ver_type,
                                'item_id': result.item_id,
                            },
                            success: function(results) {
                                var res = JSON.parse(results);
                                if (result.ver_type == 1) {

                                    $('#prod_det').val('Vehicle No : ' + res.veh_no + ' \nRC No : ' + res.rc_no + ' \nInsurance No : ' + res.ins_no + ' \nMake : ' + res.make + ' \nCompany : ' + res.company);
                                } else {
                                    $('#prod_det').val('Prate : ' + res.prate + ' \nSrate : ' + res.srate + ' \nMRP : ' + res.MRP + ' \nDescription : ' + res.description);
                                }
                                $('#item_name').val(res.name);
                                $('#item_id').val(res.id);
                            }
                        });
                        $("#remarks").val(result.remarks);
                        $("#gst").val(result.gst);
                        $("#source_id").val(result.source);
                    }
                });
            }
        });

        $.ajax({
            url: "<?php echo site_url('crm_service/Enquiry_list/getsing_item'); ?>/" + id,
            success: function(results) {
                $.each(JSON.parse(results), function(i, items) {
                    additem(items.item_name, items.item_id, items.quantity, items.price, items.tax, items.tax_amt, items.total)
                });
                calcGrand();
            }
        });

        $.ajax({
            url: "<?php echo site_url('crm_service/Enquiry_list/getsing_ledgers'); ?>/" + id,
            success: function(results) {
                var tottax = 0;
                var totamt = 0;
                $.each(JSON.parse(results), function(i, items) {
                    gst = (parseFloat((items.serv_amt * items.tax_perc) / 100)).toFixed(2);
                    totamt = (parseFloat(totamt) + parseFloat(items.serv_amt)).toFixed(2);
                    tottax = (parseFloat(tottax) + parseFloat(gst)).toFixed(2);
                    addrowtoservice(items.serv_amt, items.tax_id, items.tax_perc, gst, items.ledg_name, items.ledger_id);
                    // calculatesertot(items.serv_amt, items.tax_perc);
                });
                $("#sertaxtotal").val(tottax);
                $("#sergtotal").val(totamt);
                calcGrand();
            }
        });




    }

    $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
        calcrow();
    });

    $('#price').keydown(function(e) {
        var keyCodes = e.keyCode;
        if (keyCodes == 13 || keyCodes == 9) {
            var name = $("#product").val();
            var productid = $("#productid").val();
            var quantity = $("#quantity").val();
            var price = $("#price").val();
            if (productid !== '' && price !== "" && $("#type option:selected").text() == 'Services') {
                additem(name, productid, 0, price);
            } else if (productid !== '' && price !== "" && quantity !== "") {
                additem(name, productid, quantity, price);
            }
        }

    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/states'); ?>",
        success: function(result) {
            $('#location').html(result);
        }
    });

    $.ajax({
        url: "<?php echo site_url('crm_service/Enquiry_register/source'); ?>",
        success: function(result) {
            $('#source_id').html(result);
        }
    });
</script>