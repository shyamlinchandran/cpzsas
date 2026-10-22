<?php
$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0;
$is_SettngsEnabled = 1;
$is_batch = $settings[0]['is_batch'];
$is_taxincuded = $settings[0]['is_taxincluded'];
$barcode_settings = $settings[0]['barcode_settings'];
//tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$json = json_encode(array('id' => '0'));
$cid = $carea = '';
$pid = 0;
$zeroindex = $zeroindex[0]['gstid'];
$is_multipletax = $settings[0]['is_multipletax'];
$is_godown = $settings[0]['is_godown'];
$is_analytics = $settings[0]['is_analytics'];
$is_itemcode = $settings[0]['is_itemcode'];
$cost_centre = $settings[0]['is_costcenter'];
$is_extra = $settings[0]['is_discription'];
$company_currency = $settings[0]['comset_currency'];
$is_billtype = $settings[0]['is_billtype'];
$taxtype = $settings[0]['com_tax_type'];
if ($taxtype == 'VAT') {
    $taxtype = 'VAT';
}
if ($is_batch == 1) {
    $batch = 'hidden';
}
if ($is_billtype == 0) {
    $bill = 'hidden';
} else {
    $bill = '';
}
$user = $this->session->userdata('user');
$user_default_godown = $user['user_default_godown'];
$user_default_billtype = $user['default_purchase_billtype'];
if (ucfirst($type) == 'Order') {
    $user_default_billtype = $user['default_porder_billtype'];
}
if (ucfirst($type) == 'Purchase_return') {
    $user_default_billtype = $user['default_preturn_billtype'];
}
?>
<style>
    .box-title{
        text-transform: capitalize;
    }
    .sma{
        width: 55px !important;
    }
    .cma{
        width: 40px !important;
    }
    .disper{
        width: 40px !important;
    }
    .boo{
        position: absolute;
        bottom: 30px;
        left: 95px;
    }
    .table-condensed>thead>tr>td,.table-condensed>tbody>tr>td, .table-condensed>thead>tr>th {
        padding: 1px !important;
    } 

    .table-condensed .form-control { 
        padding: 1px !important;
    } 
    .span {
        font-size: 15   px;
        font-weight: 600;  
        padding-right: 15px;
        padding-left: 15px;
    }
    .tableBodyScroll   { 
        max-height: 300px;
        overflow-y: scroll;
    }


</style>
<form method="post"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/purchase/create/' . $type); ?>" action="<?php echo site_url('transaction/purchase/save/' . $type); ?>"  class="form-horizontal">
    <input type="hidden" value="0" name="id" /> 
    <input type="hidden"  name="newtype"  id="newtype"/> 
    <input type="hidden" value="<?php echo $id; ?>" name="p_id" id="p_id"/> 
    <input type="hidden"  id="unitvalue" name="unitvalue"/> 
    <input type="hidden"  id="purchase_mainid" name="purchase_mainid"/> 
    <input type="hidden" value="<?php echo $zeroindex; ?>" name="zeroindex" id='zeroindex'/>
    <input type="hidden" value="<?php echo $id; ?>" name="pid" id="pid"/> 
    <input type="hidden" value="1" id="curr_tax" name="curr_tax"/> 
    <input type="hidden" value="<?php echo $user_default_godown; ?>" name="user_default_godown" id='user_default_godown'/>
    <input type="hidden" value="<?php echo $cost_centre; ?>" name="cost_centre" id='cost_centre'/>
    <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded"/> 
    <input type="hidden" value="<?php echo $is_extra; ?>" name="is_extra" id='is_extra'/>
    <input type="hidden" value="<?php echo $is_godown; ?>" id="is_godown" name="is_godown"/> 
    <input type="hidden" value="<?php echo $company_currency; ?>" id="comset_currency" name="comset_currency"/> 
    <input type="hidden" name="itemname1" id="itemname1"/>
    <input type="hidden" value="<?php echo $user_default_billtype; ?>" name="user_default_billtype" id='user_default_billtype'/>
    <input type="hidden"  id="estid" name="estid" value='0' /> 
    <input type="hidden" value="<?php echo $is_itemcode; ?>" name="is_itemcode" id='is_itemcode'/>
    <input type="hidden" value="<?php echo $is_multipletax; ?>" name="is_multipletax" id='is_multipletax'/>
    <input type="hidden" value="<?php echo $is_analytics; ?>" name="is_analytics" id='is_analytics'/>
    <input type="hidden" value="<?php echo $comontax; ?>"  name="comontax" id="comontax"/>
    <input type="hidden" id="txtEstimate_id"  value='0' class="form-control" name="txtEstimate_id"/>
    <input type="hidden" value="" name="tax_led_id" id='tax_led_id'/>
    <input type="hidden" value="<?php echo $is_billtype; ?>" id="is_billtype" name="is_billtype"/> 
    <input type="hidden" value="<?php echo $is_batch; ?>" id="is_batch" name="is_batch"/> 

    <div class="modal fade" id="modal-alter">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="item_header"> </h4>
                </div>
                <div class="modal-body">
                     <div class="container col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?= label('Quantity', $this, $user) ?></label>
                                    <input   id="item_qty"  type="text" NoTab="true"   class="form-control text-right two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/>
                                </div> 
                                <div class="form-group">
                                    <label><?= label('MRP', $this, $user) ?></label>
                                    <input id="mrp_item"   type="text"    class="form-control text-right two-digits" placeholder="<?= label('MRP', $this, $user) ?>"/>     
                                </div>
                                <div class="form-group">
                                    <label><?= label('Purchase Rate', $this, $user) ?></label>
                                    <input id="prate_item" type="text"    class="form-control text-right price two-digits" placeholder="<?= label('Purchase Rate', $this, $user) ?>"/>
                                </div>
                                <div class="form-group">
                                    <label><?= label('Discount %', $this, $user) ?></label>
                                    <input id="dis_item"   type="text"    class="form-control text-right price two-digits" placeholder="<?= label('Discount', $this, $user) ?>"/>
                                </div>
                                <div class="form-group">
                                    <label><?= label('Discount %', $this, $user) ?></label>
                                    <input id="dis_amt"   type="text"    class="form-control text-right price two-digits" placeholder="<?= label('Dis Amt', $this, $user) ?>"/> 
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <?php if ($is_godown == 1) { ?> 
                                    <div class="form-group">
                                        <label><?= label('Godown', $this, $user) ?></label>
                                        <select tabindex="-1"  id="godown"  class="form-control">
                                            <option value="">Select</option> 
                                        </select>
                                    </div> 
                                <?php } ?>
                                <?php if ($is_analytics == 1) { ?>
                                    <div class="form-group">
                                        <label><?= label('Analytics', $this, $user) ?></label>
                                        <select tabindex="-1" id="analyticscenter"  class="form-control">
                                            <option value="">Select</option> 
                                        </select>
                                    </div> 
                                <?php } ?>

                                <div class="form-group">
                                    <label><?= label('Unit', $this, $user) ?></label>
                                    <select tabindex="-1" id="unit_item" class="form-control" >
                                        <option value="">Select</option> 
                                    </select>
                                </div> 

                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= label('Select File', $this, $user) ?></label>
                                    <input class="form-control" type="file"/>
                                </div> 
                                <div class="form-group">
                                    <img style="width:80%" src="data:image/png;base64,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">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <div class="form-group">
                                        <label><?= label('labek %' . $i, $this, $user) ?></label>
                                        <input id="dis_amt_t"   type="text"    class="form-control text-right price two-digits" placeholder="<?= label('Dis Amt', $this, $user) ?>"/> 
                                    </div>
                                <?php } ?>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-2 text-right">
                                <?= label('Tax Amt', $this, $user) ?>
                            </div>
                            <div class="col-md-2"> 
                                <input  class='form-control-md col-md-06 two-digits text-right'  id="rowTax" disabled="disabled" />
                            </div>
                            <div class="col-md-2 text-right">
                                <?= label('Total', $this, $user) ?> 
                            </div>
                            <div class="col-md-2"> 
                                <input  class='form-control-md two-digits text-right' id="rowTotal" disabled="disabled" />
                            </div>
                            <div class="col-md-2"> 
                                <input type="hidden" name="item_id" id="item_id"/>

                                <button data-toggle="tooltip" type="button"    title="<?= label('Total', $this, $user) ?>Add To save"   class="btn btn-success" href="#">
                                    <span class="glyphicon glyphicon-plus"></span> 
                                </button>
                            </div>
                        </div>
                    </div>

                    <table  class="table table-striped table-condensed" >
                        <thead>
                            <tr>
<!--                                <td>Item Name</td>-->
                                <td><?= label('Qty', $this, $user) ?></td>
                                <td ></td>
                                <?php if ($is_analytics == 1) { ?>
                                    <td><?= label('Analytics', $this, $user) ?></td>
                                <?php } ?>
                                <td><?= label('Unit', $this, $user) ?></td>
                                <?php if (!$is_batch == 0) { ?>

                                    <td><?= label('mfg', $this, $user) ?></td>
                                    <td><?= label('Expiry date', $this, $user) ?></td>
                                <?php } ?>
                                <?php if (!$comontax == 1) { ?>
                                    <td><?php echo $taxtype; ?></td>
                                <?php } ?>
                                <td><?= label('MRP', $this, $user) ?></td>
                                <td><?= label('Prate', $this, $user) ?></td>
                                <td><?= label('Dis %', $this, $user) ?></td>
                                <td><?= label('Dis Amt', $this, $user) ?></td>
                                <td></td>
                                <td><?= label('Total', $this, $user) ?></td>
                                <td> <td> 
                            </tr>
                            <tr>
<!--                                <td  class="col-lg-3"> <input  NoTab="true"   id="itemname_pop"  class="form-control" type="text" placeholder="<?= label('Item Name', $this, $user) ?>"/></td>-->

                                <td> </td>

                                <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>>
                                </td>
                                <?php if ($is_analytics == 1) { ?>
                                    <td class="sma" >
                                    </td>
                                <?php } ?>
                                <td class="sma" >
                                </td>
                                <?php if (!$is_batch == 0) { ?>

                                    <td>  <input name="mfg" hidden type="text" id="mfg" data-validation="required" class="form-control text-right date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                    <td>  <input name="exp" type="text" id="exp" data-validation="required" class="form-control text-right date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                <?php } ?>
                                <?php if (!$comontax == 1) { ?>
                                    <td class="sma" ><select tabindex="-1" id="tax_item"  class="form-control">
                                            <option value="">Select</option> 
                                        </select>
                                    </td>
                                <?php } ?>
                                <td> </td>
                                <td > </td>
                                <td> </td>
                                <td > </td>
                                <td></td>
                                <td></td>

                                <td>
                                    <!--                                        hidden-->

                                </td>

                            </tr>
                        <button type="button" style="visibility:hidden;" id="btnclsmain"   class="btn btn-secondary" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>

                        </thead>
                    </table>
                    <button type="button" id="myDropdownhide" class="hidden btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <div id="myDropdown" class="dropdown-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#mainSale" data-toggle="tab"><?= label(ucwords(str_replace('_', ' ', $type)), $this, $user) ?></a></li>
                        <li><a href="#otherTab" data-toggle="tab"><?= label('Other Details', $this, $user) ?></a></li>
                        <li><a href="#service" data-toggle="tab"><?= label('Additional Ledger', $this, $user) ?></a></li>

                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" id="txtEstimate" style="height:30px !important" class="form-control" name="txtEstimate"/>
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <select name="is_tax" data-validation="required" style="height:30px !important" id="is_tax"  class="form-control">
                                    <option value="0"><?= label($taxtype, $this, $user) ?>  <?= label('Excluded', $this, $user) ?></option> 
                                    <option value="1"><?= label($taxtype, $this, $user) ?> <?= label('Included', $this, $user) ?></option> 
                                </select> 
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div  class="cur_div" style="width:150px;padding: 4px">
                                <input value=1 type="text" id="curr_value" style="height:30px !important" class="form-control" name="curr_value" placeholder="Currency Value"/>
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <select  name="com_currency" data-validation="required" style="height:30px !important" id="com_currency"  class="form-control">
                                </select> 
                            </div>
                        </li>
                        <?php if ($cost_centre == '1') { ?>
                            <li class="pull-right"> 
                                <div class="input-group" style="width:150px;padding: 4px">
                                    <select  id="Costcenter"  name="Costcenter" style="height:30px !important"  class="form-control" >
                                        <option value="">Select</option> 
                                    </select>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="mainSale"> 
                            <div class="box-body">
                                <table class="table table-striped table-condensed col-sm-12" >
                                    <tr>
                                        <?php if ($type == 'purchase') { ?>
                                            <td class="hunpx"><?= label('Bill No.', $this, $user) ?></td>
                                        <?php } ?>

                                        <td class="hunpx"><?= label('Bill Date', $this, $user) ?></td>

                                        <td class="hunpx"><?= label('Purchase Date', $this, $user) ?></td>
                                        <td class="hunpx"><?= label('Type', $this, $user) ?> </td>
                                        <td class="col <?php echo $bill; ?>"> <?= label('Bill Type', $this, $user) ?></td> 
                                        <?php if ($comontax == 1) { ?>
                                            <td>Tax</td>
                                        <?php } ?>
                                        <td>
                                            <?= label('Supplier', $this, $user) ?>  <button type="button" opt="supplier" url="<?php echo base_url(); ?>suppliers/create/"  class="btn btn-primary myModalPop">
                                            <?= label('New', $this, $user) ?>
                                            </button>
                                        </td>
                                        <td><?= label('Billing Name', $this, $user) ?></td>
                                        <td><?= label('Phone Number', $this, $user) ?></td>
                                        <td><?= label('Address', $this, $user) ?></td>

                                    </tr>
                                    <tr>
                                        <?php if ($type == 'purchase') { ?>
                                            <td class="col-lg-1"><input name="invoice" data-validation-error-msg="*"  type="text" id="invoice" data-validation="required"    class="form-control hunpx" placeholder="<?= label('Invoice', $this, $user) ?>"></td>
                                        <?php } ?>
                                        <td class="col-lg-1">  <input name="date" type="text" id="date" data-validation="required" class="form-control  date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td class="col-lg-1">  <input name="rdate" type="text" id="rdate" data-validation="required"    class="form-control date" placeholder="<?= label('Received Date', $this, $user) ?>"></td>
                                        <td><select tabindex="-1"   name="type" data-validation="required" id="type"  class="form-control hunpx" >
                                                <option value="Cash"><?= label('Cash', $this, $user) ?></option> 
                                                <option value="Credit"><?= label('Credit', $this, $user) ?></option> 
                                            </select> 
                                        </td>
                                        <td <?php echo $bill; ?>>
                                            <select tabindex="-1" id="btype" name="btype" class="form-control  hunpx" >                                            
                                            </select>
                                        </td>

                                        <?php if ($comontax == 1) { ?>
                                            <td><select  data-validation="required" id="tax_common"  name="tax_common" class="form-control" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                        <?php } ?>
                                        <td class="col-lg-2"><input type="hidden" name="supid" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="length" data-validation-length="min2"   class="form-control" placeholder="<?= label('Supplier', $this, $user) ?>"></td>
                                        <td class="col-lg-2"><input name="billingname" type="text" id="billingname"    class="form-control" placeholder="<?= label('Billin Name', $this, $user) ?>"></td>
                                        <td class="col-lg-2"><input name="phone" type="text" id="phone"  class="form-control"  pattern="[0-9]{0,13}" placeholder="<?= label('Phone', $this, $user) ?>"></td>
                                        <td class="col-lg-2"><input name="address" type="text" id="address"    class="form-control" placeholder="<?= label('Email', $this, $user) ?>"></td>

                                    </tr>
                                </table>

                                <style>
                                    .span {
                                        font-size: 18px;
                                        font-weight: 600;  
                                        padding-right: 15px;
                                        padding-left: 15px;
                                    }
                                </style>
                                <p><b><span id="current_stock" class="col col-md-2"></span><span id="prate" class="center"></span></b> <span class="span  pull-right" id="balance" ></span> </p>
                                <div class="col-sm-12" style="padding-right: 0px;padding-left: 0px;">
                                    <div class="tableBodyScroll " style="padding-right: 0px;padding-left: 0px;">
                                        <table id="purchaseTable" class="table table-striped table-condensed" >
                                            <thead>
                                                <tr>
                                                    <td><?= label('SNo', $this, $user) ?></td>
                                                    <?php if ($is_itemcode == 1) { ?>
                                                        <td><?= label('Item Code', $this, $user) ?></td>
                                                    <?php } ?>
                                                    <td>
                                                        <?= label('Item', $this, $user) ?>
                                                        <button type="button" url="<?php echo base_url(); ?>item/create" opt="item" class="btn btn-primary myModalPop">
                                                            <?= label('New', $this, $user) ?> 
                                                        </button>
                                                    </td>
                                                    <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><?= label('Godown', $this, $user) ?></td>
                                                    <td><?= label('Qty', $this, $user) ?></td>
                                                    <td><?= label('Unit', $this, $user) ?></td>
                                                    <?php if (!$comontax == 1) { ?>
                                                        <td><?php echo $taxtype; ?></td>
                                                    <?php } ?>
                                                    <td><?= label('MRP', $this, $user) ?></td>
                                                    <td><?= label('Prate', $this, $user) ?></td>
                                                    <td><?= label('Dis(%)', $this, $user) ?></td>
                                                    <td><?= label('Dis Amt', $this, $user) ?></td>
                                                    <td><?= label('Amt', $this, $user) ?></td>
                                                    <td><?= label('Total', $this, $user) ?></td>
                                                    <td> </td> 
                                                </tr>
                                                <tr id="add">
                                                    <td class="sma" style="text-align: center;"><input title="1" style="height:25px"   id="totnolist" class="form-control  text-right"  readonly="readonly"/></td>
                                                    <?php if ($is_itemcode == 1) { ?>
                                                        <td class="col-lg-1    "> <input  onkeydown="EnterToTab()"   id="itemcode"  <?php if ($barcode_settings === "1") { ?> class="form-control" onchange="itemsearch()"   <?php } else { ?>class="form-control ItemMatchBarcode" <?php } ?> stype="barcode" data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>"    type="text" placeholder="<?= label('Item Code', $this, $user) ?>"/></td>                                                                <?php } else { ?>
                                                    <?php } ?>
                                                    <td  class="col-lg-3"> <input  NoTab="true"   id="itemname"  data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>"class="form-control" type="text" placeholder="<?= label('Item Name', $this, $user) ?>"/></td>
                                                    <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><select tabindex="-1"  id="godown1"  class="form-control sma">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                    <td> <input   id="1item_qty"  type="text" NoTab="true"   class="form-control text-right two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                                    <td class="cma" ><select tabindex="-1" id="1unit_item" class="form-control" >
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                    <?php if (!$comontax == 1) { ?>
                                                        <td class="cma" ><select tabindex="-1" id="1tax_item"  class="form-control">
                                                                <option value="">Select</option> 
                                                            </select>
                                                        </td>
                                                    <?php } ?>
                                                    <td> <input id="1mrp_item1"   type="text"    class="form-control text-right two-digits" placeholder="<?= label('MRP', $this, $user) ?>"/></td>
                                                    <td > <input id="1prate_item1" type="text"    class="form-control  text-right price two-digits" placeholder="<?= label('Purchase Rate', $this, $user) ?>"/></td>
                                                    <td> <input id="1dis_item1"   type="text"    class="form-control cma text-right price two-digits" placeholder="<?= label('Discount', $this, $user) ?>"/></td>
                                                    <td > <input id="1dis_amt1"   type="text"    class="form-control text-right price two-digits" placeholder="<?= label('Dis Amt', $this, $user) ?>"/></td>

                                                    <?php if (!$comontax == 1) { ?>
                                                        <td> 
                                                            <input  class='form-control two-digits'   disabled="disabled" />
                                                        </td>
                                                    <?php } ?>
                                                    <td><input  class='form-control two-digits  '  disabled="disabled" /></td>
                                                    <td>
                                                        <!--                                        hidden-->
                                                        <input type="hidden" name="item_id" id="1item_id1"/>

                                                        <button data-toggle="tooltip" type="button"    title="<?= label('Total', $this, $user) ?>Add To save"   class="btn btn-success" href="#">
                                                            <span class="glyphicon glyphicon-plus"></span> 
                                                        </button>
                                                    </td>

                                                </tr>
                                            </thead>
                                            <tbody id="rowm">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-7"></div>
                                    <div class="col-sm-2 no-padding no-margin">
                                        <div class="col-sm-6"><?= label('Pur/Tax', $this, $user) ?></div>
                                        <div class="col-sm-6 no-padding no-margin">  
                                            <input name="totpuretax" id="totpuretax" placeholder="<?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?> "  readonly="readonly"   type="text" class="text-right form-control" placeholder="<?= label('Pur/Tax', $this, $user) ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 "  >
                                        <div class="col-sm-6"><?= label('Total Amt', $this, $user) ?></div>
                                        <div class="col-sm-5 no-padding no-margin">                                            
                                            <input type="text"  id="total" name="subtot" readonly="readonly"  class="form-control    text-right" placeholder="<?= label('Total', $this, $user) ?>">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2 no-padding no-margin"> 
                                        <?= label('Discount', $this, $user) ?>
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin"  >
                                        <?= label('Round Off', $this, $user) ?>
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin"> 
                                        <?= label($taxtype, $this, $user) ?>
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin">
                                        <div class="col-sm-12 no-padding no-margin"  >
                                            <?= label('Grand Total', $this, $user) ?> 
                                        </div>
                                        <!--                                        <div class="col-sm-1"></div>-->
                                    </div>
                                    <div class="col-sm-2"><?= label('Grand Total', $this, $user) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2 no-padding no-margin">
                                        <input name="discount" id="discount" placeholder="<?= label('Discount', $this, $user) ?>"   type="text" class="text-right  form-control" >
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin"  > 
                                        <input name="rount" id="rount" placeholder="<?= label('Round Off', $this, $user) ?>" readonly="readonly"   type="text" class="text-right  form-control" >
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin">  
                                        <input name="taxtotal" id="taxtotal" placeholder="<?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?>"  readonly="readonly" type="text" class="text-right  form-control" >
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin"  > 
                                        <div class="col-sm-12 no-padding no-margin"  >
                                            <input name="gtotal" id="gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right  form-control" >
                                        </div>
                                        <!--                                        <div class="col-sm-1"></div>-->
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin">
                                        <input name="cur_gtotal" id="cur_gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right  form-control" >
                                    </div>
                                </div> 
                            </div> 
                        </div>
                        <div class="tab-pane" id="otherTab">
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-2"><?= label('State', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('State Code', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?></td> 
                                        <td class="col col-lg-3"><?= label('E-Way Bill Number', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('E-Way Bill Details', $this, $user) ?></td>
                                    </tr>
                                    <tr>

                                        <td><select  id="states"  name="states" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="stcode" type="text" id="stcode"  class="form-control  "   placeholder="<?= label('State Code', $this, $user) ?>"></td>
                                        <td>  <input name="gst" type="text" id="gst"  class="form-control  col-lg-2"   placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                        <td>  <input name="ewbno" type="text" id="ewbno"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Number', $this, $user) ?>"></td>
                                        <td>  <input name="ewbdetails" type="text" id="ewbdetails"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Details', $this, $user) ?>"></td>
<!--                                          <td><select  id="printtype"  name="printtype" class="form-control" >
                                            <option value="">Select</option> 
                                        </select>
                                    </td>-->
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Delivery Date', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Credit Days', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label('SalesMan', $this, $user) ?></td> 
                                        <td class="col col-lg-2"><?= label('Area', $this, $user) ?></td> 
                                        <td class="col col-lg-3"></td> 
                                    </tr>
                                    <tr>
                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td><select  id="salesman"  name="salesman" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <!-- <td><select  id="reference"  name="reference" class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td> -->
                                        <td><select  id="area"  name="area" class="form-control">
                                                <option value="">select</option> 
                                            </select>
                                        </td>                                          
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Route', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Vehicle', $this, $user) ?></td>
                                        <td class="col"><?= label('Coolie', $this, $user) ?></td>
                                        <td class="col"><?= label('Freight', $this, $user) ?></td>
                                        <td class="col"><?= label('Other charges', $this, $user) ?></td>
                                    </tr>
                                    <tr>

                                        <td><select  id="route"  name="route" class="form-control">
                                                <option value="">route</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="vehicle" name="vehicle" class="form-control">

                                                <option value="">vehicle</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="coolie" type="text"   class="form-control  tatalcal"   placeholder="<?= label('Coolie', $this, $user) ?>"></td>
                                        <td><input name="freight" id="freight" placeholder="<?= label('Freight', $this, $user) ?>"   type="text" class="tatalcal text-right  form-control" ></td>
                                        <td><input name="other" id="other" placeholder="<?= label('Other charges', $this, $user) ?>"   type="text" class="tatalcal text-right  form-control" ></td>
                                    </tr>
                                </table>
                                </br>

                                   <!--  <table class="table table-striped table-condensed" >
                                        <tr>
                                            <td class="col col-lg-8">Terms And Conditions</td>
                                            <td class="col col-lg-8">Despatch Details</td>
                                        </tr>
                                        <tr>
                                            <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">
                                                 Enter </textarea></td>
                                            <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">
                                                     Enter text here...</textarea></td>
                                        </tr>
                                    </table> -->
                            </div>

                        </div>
                        <!-- /otherTab -->

                        <div class="tab-pane" id="service">
                            <div class="box-body">
                                <table class="table table-striped table-condensed"   >
                                    <thead>
                                        <tr>

                                            <td><?= label('Additional Ledger', $this, $user) ?></td>
                                            <td><?= label($taxtype, $this, $user) ?>%</td>
                                            <td><?= label('Service Amount', $this, $user) ?></td>
                                            <td><?= label($taxtype . ' Amount', $this, $user) ?></td>
                                            <td><td> 
                                        </tr>

                                    </thead>
                                    <tbody id="rows">
                                        <tr id="addservice">

                                            <td class="col-lg-4"> <input type="hidden" NoTab="true" tabindex="-1" name="ser_ledgerid" id="ser_ledgerid"/><input  NoTab="true"   id="ser_ledger"  class="form-control"   type="text"     placeholder="<?= label('Ledger', $this, $user) ?>"/></td>
                                            <td class="sma"><input type="hidden" NoTab="true" tabindex="-1" name="ser_taxid" id="ser_taxid"/><select tabindex="-1" id="ser_tax"  class="form-control" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                            <td> <input style='height:25px' id="ser_amt"  type="text"  class="form-control text-right two-digits price " placeholder="<?= label(' Amount', $this, $user) ?>"/></td>
                                            <td> <input id="ser_taxamt"   type="text" readonly="readonly"   class="form-control text-right two-digits" placeholder="<?= label($taxtype, $this, $user) ?>"/></td>
                                            <!--                                        hidden-->

                                            <td>  <button data-toggle="tooltip" type="button"    title="Add To save"   class="btn btn-success" href="#">
                                                    <span class="glyphicon glyphicon-plus"></span> 
                                                </button>
                                            </td>
                                        </tr> 
                                    </tbody>      
                                </table>
                                <table class="table table-striped table-condensed" >


                                    <tr>
                                        <td></td>
                                        <td></td>
 <!--                                <td>Advance </td>-->
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?></td>                               
                                        <td><?= label('Total', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td class='col-lg-4'></td>
                                        <td class='col-lg-2'></td>
                                        <td class='col-lg-2'></td>
                                        <td></td>
<!--                                        <td><input name="Vehicle" id="Vehicle" placeholder="Vehicle No"   type="text" class="col-lg-1 form-control" ></td>-->
                                        <td></td>
                                        <td></td>
                                        <td><input name="sertaxtotal" id="sertaxtotal" placeholder="<?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?>" value="0" readonly="readonly"   type="text" class="text-right form-control" ></td>
                                        <td><input name="sergtotal" id="sergtotal" placeholder="<?= label('Grand Total', $this, $user) ?>" value="0" readonly="readonly"  type="text" class="text-right form-control" ></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer">  
                        <?php if ($view != 'view') { ?>
                            <div class="boo">
                                <select   id="printtype"  name="printtype" class="form-control" >
                                    <option value="">Select</option>  </select>
                            </div>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   

                            <div class='small-loading' id='FormLoading'> </div>
                        <?php } ?>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</form> 
<div class="modal fade "  tabindex="-1"  id="modelextra"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-body"  > 
                <textarea class="form-control " cols="20" id="txtExtra"></textarea>
            </div> 
            <div class="modal-footer">
                <button data-toggle="tooltip" type="button"    title="Add To save" id="btnAddExtram"  class="btn btn-success" href="#">
                    <span class="glyphicon glyphicon-plus"></span> 
                </button>
                <button type="button" id="btncls"   class="btn btn-secondary" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>

            </div>
        </div> 
    </div>
</div> 
<script type="text/javascript">
    //messages 
    function calert(msg) {
        alert(msg);
    }
    var inc_inary = 0;
    //class
    function item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincuded, item_discription, barcode) {
        inc_inary = inc_inary + 1;
        this.inc_id = inc_inary;
        this.tax_purchase_id = item_discription;
        this.barcode = barcode;
        this.item_discription = item_discription;
        this.dis_item = dis_item;
        this.dis_amt = dis_amt;
        this.is_taxincuded = is_taxincuded;
        this.analyticsname = analyticsname;
        this.analytics = analytics;
        this.item_id = item_id;
        this.item_qty = item_qty;
        this.godown = godown;
        this.unit_item = unit_item;
        this.tax_item = tax_item;
        this.tax_amount = tax_amount;
        this.mrp_item = mrp_item;
        this.prate_item = prate_item;
        this.itemname = itemname;
        this.comontax = comontax;
        this.rowTotal = rowTotal;
        this.commission = commission;
        this.unit_name = unit_name;
        this.godown_name = godown_name;
        this.tax_name = tax_name;
        this.mfg = mfg;
        this.exp = exp;
    }
    //class array
    var items = new Array();


    function clear() {
        clearValue($("#item_id"));
        clearValue($("#item_qty"));
        clearValue($("#godown"));
        clearValue($("#unit_item"));
        clearValue($("#tax_item"));
        clearValue($("#mrp_item"));
        clearValue($("#prate_item"));
        clearValue($("#itemname"));
        clearValue($("#rowTotal"));
        clearValue($("#rowTax"));
        clearValue($("#dis_item"));
        clearValue($("#dis_amt"));
        clearValue($("#itemcode"));
    }
    function clearservice() {
        clearValue($("#ser_ledger"));
        clearValue($("#ser_ledgerid"));
        clearValue($("#ser_amt"));
        clearValue($("#ser_taxamt"));
    }
    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
            val = 0;
        }
        return val;

    }
    function addservices() {
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        var ledger = $("#ser_ledger").val();
        var ledgerid = $("#ser_ledgerid").val();
        var amount = $("#ser_amt").val();
        var taxid = $("#ser_tax").val();
        var tid = 0;
        var is_taxincuded = $("#is_tax").val();
        // var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));

        totamt = (parseFloat(totamt) + parseFloat(amount)).toFixed(2);
        var gst = 0;
        var tax = 0;
        if (amount !== '0' && taxid !== null && taxid !== '0') {
            tax = $("#ser_tax option:selected").attr('percent');
            gst = (parseFloat(amount) - ((parseFloat(amount) * 100) / (parseFloat(tax) + 100))).toFixed(2);
            if (is_taxincuded === "0") {
                gst = (parseFloat(amount) * parseFloat(tax) / 100).toFixed(2);
                totamt = (parseFloat(totamt) + parseFloat(gst));
            }
            tottax = (parseFloat(tottax) + parseFloat(gst)).toFixed(2);
            tid = $("#ser_tax").val();

        }
        $("#ser_taxamt").val(gst);
        addrowtoservice(amount, tid, tax, gst, ledger, ledgerid, is_taxincuded);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
        $("#ser_ledger").focus();
        calculateGTotal();
    }
    function addrowtoservice(amount, taxid, tax, gst, ledger, ledgerid, is_taxincuded) {
        var newrow = '<tr><td class="col-lg-4"> <input type="hidden" readonly="readonly" NoTab="true" value="' + ledgerid + '" tabindex="-1" name="serv_ledgerid[]" id="serv_ledgerid"/><input  NoTab="true"  readonly="readonly" id="serv_ledger"  class="form-control"  value="' + ledger + '" type="text"     placeholder="service ledger"/></td>' +
                ' <td> <input type="hidden" NoTab="true" value="' + taxid + ' " tabindex="-1" name="serv_taxid[]" readonly="readonly" id="serv_taxid"/><input  NoTab="true"   id="serv_tax"  class="form-control" readonly="readonly"  value="' + tax + ' " type="text"     placeholder="service ledger"/></td>' +
                ' <td> <input style="height:25px" id="serv_amt"  name="serv_amt[]" value="' + amount + '" type="text" readonly="readonly" class="form-control text-right  two-digits price " placeholder="service Amt"/></td>' +
                ' <td> <input type="hidden" readonly="readonly" NoTab="true" value="' + is_taxincuded + '" tabindex="-1" name="serv_is_taxincuded[]" id="serv_is_taxincuded"/><input id="serv_taxamt" name="serv_taxamt[]" value="' + gst + '"  type="text" readonly="readonly"   class="form-control  text-right two-digits" placeholder="GST"/></td>' +
                '<td> <span data-toggle="tooltip"   title="Remove" onclick="removeservice(this)" sertax="' + gst + '" seramt="' + amount + '"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span> </td></tr>';
        $("#rows").append(newrow);
        clearservice();
    }


    function calculaterow(id) {
        //        var is_discount = getVal('is_discount');
        var rate = getVal('itmrate' + id);
        var qty = getVal("itmqty" + id);
        var disamt = getVal('disamt' + id);
        var dis = 0;
        //        if (is_discount === '1') {
        if (rate !== '' && qty !== '' && disamt !== '' && parseFloat(rate * qty) > parseFloat(disamt)) {
            dis = parseFloat(((disamt * 100) / (rate * qty)));
        }
        //        }

        $("#itmdis" + id).val(dis.toFixed(2));
        calculaterowdis(id);
    }

    function calculaterowdis(id) {
        var rate = getVal('itmrate' + id);
        var qty = getVal("itmqty" + id);
        var tax_name = getVal("itmtaxper" + id);
        var disamt = 0;
        var total = parseFloat(qty * rate);
        var itmmrp = getVal("itmmrp" + id);
        var discount = getVal('itmdis' + id);
        var qty = getVal("itmqty" + id);
        // var is_taxincuded=("#is_taxincuded" + id).val();
        is_taxincuded = $("#is_taxincuded" + id).val();
        var itm = getIndexOf(items, id);
        var iteadd = items[itm];
        items.splice(itm, 1);
        iteadd.item_qty = qty;
        if (discount !== '0' && rate !== '0' && qty !== '0') {
            disamt = parseFloat((rate * discount * qty) / 100);
        }
        $("#disamt" + id).val(disamt.toFixed(2));

        var rowTax = parseFloat(total - disamt) * parseFloat(tax_name) / 100;
        var total = parseFloat(total - disamt) + parseFloat(rowTax);
        if (is_taxincuded === "1") {
            var total = parseFloat(qty * rate);
            var total = parseFloat(total - disamt);
            var rowTax = (parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax_name) + 100)));
        }
        $("#itmtax" + id).val(rowTax.toFixed(2));
        $("#itmtot" + id).val(total.toFixed(2));
        iteadd.itmmrp = itmmrp;
        iteadd.itmrate = rate;
        iteadd.dis_amt = disamt;
        iteadd.dis_item = discount;
        iteadd.tax_name = tax_name;
        iteadd.rowTotal = total;
        items.push(iteadd);
        calculateGTotal();
    }
    function calculaterowtotal() {
        var prate = $("#prate_item").val();
        var qty = $("#item_qty").val();
        var dis_item = $("#dis_item").val();
        var dis_amt = $("#dis_amt").val();
        var tax_name = $("#tax_item option:selected").attr('percent');
        var is_taxincuded = $("#is_taxincuded").val();
        var curr_tax = $('#curr_tax').val();
        if (curr_tax === "0") {
            tax_name = 0;
        }
        var prate = parseFloat(prate) * parseFloat(qty);

        if (dis_amt === '') {
            dis_amt = 0;
        }
        var rowTax = parseFloat(prate - dis_amt) * parseFloat(tax_name) / 100;
        var tot = parseFloat(prate - dis_amt) + parseFloat(rowTax);
        if (is_taxincuded === "1") {
            var tot = parseFloat(prate - dis_amt);
            var rowTax = (parseFloat(tot) - ((parseFloat(tot) * 100) / (parseFloat(tax_name) + 100)));

        }
        if (!isNaN(tot)) {
            $("#rowTotal").val(tot.toFixed(2));
        } else {
            $("#rowTotal").val(0);
        }
        if (!isNaN(rowTax)) {
            $("#rowTax").val(rowTax.toFixed(2));
        } else {
            $("#rowTax").val(0);
        }
    }

    function  calculateGTotal() {
        var total = 0;
        var tax = 0;
        var itmno = 0;
        var j = 0;
        var discount = 0;
        $.each(items, function (i) {
            j = j + 1;
            itmno = itmno + 1;
            discount = parseFloat(discount) + parseFloat(items[i].dis_amt);
            $("#itmno" + items[i].inc_id).val(itmno.toFixed(0));
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
        });
        $("#totnolist").val(j);
        var sertax = getVal("sertaxtotal");
        var seramt = getVal("sergtotal");
        sertax = parseFloat(tax) + parseFloat(sertax);
        $("#discount").val(discount.toFixed(2));
        $("#total").val(total.toFixed(2));
        $("#totpuretax").val(tax.toFixed(2));
        $("#taxtotal").val(sertax.toFixed(2));
        var freight = getVal("freight");
        var other = getVal("other");
        var discount = getVal("discount");
        //+ parseFloat(tax)
        var gtotal = parseFloat(total) + parseFloat(seramt) + parseFloat(freight) + parseFloat(other);
        var rount = (parseFloat(gtotal.toFixed(0)) - parseFloat(gtotal.toFixed(2))).toFixed(2);

        $("#gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
        var com_currency = $("#com_currency").val();
        var comset_currency = $("#comset_currency").val();
        if (com_currency === comset_currency) {
            $("#cur_gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
        } else {
            var curr_value = $("#curr_value").val();
            var curr_value = parseFloat(curr_value * gtotal);
            $("#cur_gtotal").val(parseFloat(curr_value.toFixed(0)).toFixed(2));
        }
        $("#rount").val(rount);
    }

    function  validate(item_id) {
        var validate = 0;
        $.each(items, function (i) {
            if (items[i].item_id === item_id)
            {
                validate = 1;
                return validate;
            }
        });
        return validate;
    }
    function insertItems()
    {
        var item_id = $("#item_id").val();
        if (item_id === '' || item_id === undefined)
        {
            $("#itemname").focus();
            calert('Please add a valid item');
            return;
        }
        var dis_item = $("#dis_item").val();
        var dis_amt = $("#dis_amt").val();
        var item_qty = $("#item_qty").val();
        var unit_item = $("#unit_item").val();
        var godown = $("#godown").val();
        var tax_item = $("#tax_item").val();
        var mrp_item = $("#mrp_item").val();
        var prate_item = $("#prate_item").val();
        var is_taxincuded = $("#is_taxincuded").val();
        var itemname = $("#itemname").val();
        itemname = $("#itemname1").val();
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var tax_amount = $("#rowTax").val();
        var godown_name = $("#godown option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
        var tax_name = $("#tax_item option:selected").text();
        var item_discription = $('#txtExtra').val();
        var barcode = $('#itemcode').val();
        $('#txtExtra').val('');
        var mfg = $("#mfg").val();
        var exp = $("#exp").val();
        var tax_purchase_id = $("#tax_led_id").val();
        var analyticsname = $("#analyticscenter option:selected").text();
        var analytics = $("#analyticscenter").val();
        var zeroindex = $('#zeroindex').val();
        var curr_tax = $('#curr_tax').val();
        if (curr_tax === "0") {
            tax_amount = 0;
            tax_name = 0;
            tax_item = zeroindex;
        }
        var iteadd = new item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, '', godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincuded, item_discription, barcode);
        addrowtoTable(iteadd);
        items.push(iteadd);
        $('.myspop').popover();
    }
    function addrowtoTable(items) {
        $('#btnclsmain').click();
        $('#btncls').click();
        var batch = $("#is_batch").val();
        var dis_amt = items.dis_amt;
        var dis_item = items.dis_item;
        var item_id = items.item_id;
        var unit_item = items.unit_item;
        var godown = items.godown;
        var item_qty = items.item_qty;
        var tax_item = items.tax_item;
        var mrp_item = items.mrp_item;
        var prate_item = items.prate_item;
        var itemname = items.itemname;
        var comontax = items.comontax;
        var rowTotal = items.rowTotal;
        var tax_amount = items.tax_amount;
        var is_taxincuded = items.is_taxincuded;
        var item_discription = items.item_discription;
        var mfg = items.mfg;
        var exp = items.exp;
        var barcode = items.barcode;
        var is_extra = $("#is_extra").val();
        var pophtml = 'MRP -' + items.mrp_item + '<br/> ' + 'Purchase Rate -' + items.mrp_item;
        if (batch === '1') {
            pophtml = pophtml + '<br/> ' + 'Mfg Date -' + mfg + '<br/> ' + 'Exp Date -' + exp;
        }
        var is_analytics = $("#is_analytics").val();
        if (is_analytics === "1") {
            pophtml = pophtml + '</br> Abalytics Center -' + items.analyticsname;
        }
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"  index="' + items.inc_id + '"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        if (is_extra === "1") {
            pophtml = pophtml + '</br>' + '<textarea col=23 form="usrform">' + item_discription + '</textarea>';
        }

        var rowval = td(1, 'item_no[]', ' text-right', 'id="itmno' + items.inc_id + '"', 'sma');
        var is_itemcode = $("#is_itemcode").val();
        if (is_itemcode === "1") {
            rowval = rowval + td(barcode, 'item[]', '', '', 'col-lg-1', pophtml);
        }
        var rowval = rowval + td(itemname, 'itemname[]', '', '', '', pophtml);
        var is_godown = $("#is_godown").val();

        if (is_godown === "1") {

            rowval = rowval + td(items.godown_name, 'mygodown[]', 'sma');
        }
        var rowval = rowval + tde(item_qty, 'item_qty[]', 'form-control text-right two-digits price', 'id="itmqty' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
        var is_analytics = $("#is_analytics").val();
        if (is_analytics === "1") {
            var analytics = items.analytics;
            var analyticsname = items.analyticsname;
            rowval = rowval + hidden(analytics, 'analytics_id[]');
        }
        var rowval = rowval + td(items.unit_name, 'uname[]', 'col-lg-1 cma text-right');
        if (batch === '1') {
            rowval = rowval + hidden(mfg, 'mdate[]') + hidden(exp, 'edate[]');
        }
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name, 'taxper[]', 'col-lg-1 text-right', 'id="itmtaxper' + items.inc_id + '"');
        }
        rowval = rowval + hidden(is_taxincuded, 'is_taxincuded[]', 'id="is_taxincuded' + items.inc_id + '"') + tde(mrp_item, 'mrp_item[]', 'text-right', 'id="itmmrp' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(prate_item, 'prate_item[]', ' text-right', 'id="itmrate' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(dis_item, 'dis_item[]', 'disper text-right', 'id="itmdis' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(dis_amt, 'dis_amt[]', 'text-right', 'id="disamt' + items.inc_id + '" onchange=calculaterow(' + items.inc_id + ')');
        //alert(batch);
        if (comontax === '0') {
            rowval = rowval + td(tax_amount, 'tax_amount[]', 'col-lg-1 text-right', 'id="itmtax' + items.inc_id + '"');
        }
        //        rowval = rowval + td(mfg, 'mdate[]', 'hunpx text-right');

        rowval = rowval + hidden(item_id, 'item_id[]') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'col-lg1-1 text-right', 'id="itmtot' + items.inc_id + '"') + tdhtml(del);


        rowval = rowval + hidden(item_discription, 'itmdtn[]', 'id="itmdtn' + items.idinc + '"');

        var newRow = tr(rowval);
        $("#rowm").prepend(newRow);
        $('#purchaseTable').tableNav();
    }

    function add() {
        insertItems();
        clear();
        calculateGTotal();
        $("#itemname").focus();

    }
    function rowtotal(qty, prate) {
        return (parseFloat(qty) * parseFloat(prate)).toFixed(2);
    }
    function itemsearch() {
        var type = $("#itemcode").attr('stype');
        var text = $("#itemcode").val();
        var customer = '';
        $('.itemname').attr('data-placement', 'right');
        $('.itemname').popover('toggle');
        $("[wf-popover]").popover({
            html: true,
            content: function () {
                var content = $(this).attr("wf-content");
                //                        alert( $("#discription").text());
                return content;
            },
            title: function () {
                var title = $(this).attr("wf-title");
                //return $(title).children(".popover-heading").html();
                return title;
            },
            placement: function () {
                var my = this.$element.attr('wf-popover');
                return my;
            }
            //                    trigger: 'keydown'
        });
        $('.myspop').popover();

        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch/barcode/' + customer + '?', {term: text}, function (result) {
            $.each(result, function (i, field) {
                var list = "";
                $('#myDropdown').html(list);
                $("#modal-alter").modal();
                $("#item_header").html(field.name);
                $("#itemname").val(field.name);
                $("#itemname1").val(field.name);
                $("#mrp_item").val(field.MRP);
                $("#prate_item").val(field.prate);
                $("#unitvalue").val(field.prate);
                $("#tax_led_id").val(field.tax_purchase_id);
                $("#itemcode").val(field.barcode);
                $("#item_qty").focus();
                var is_multipletax = $('#is_multipletax').val();
                if (is_multipletax === '1') {
                    if (field.tax_purchase_id !== undefined && field.tax_purchase_id !== '' && field.tax_purchase_id !== 0) {
                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + field.tax_purchase_id,
                            async: false,
                            success: function (results) {
                                var result = JSON.parse(results);
                                field.tax_id = result.ref_id;
                            }
                        });
                    }
                }
                $('#tax_item').val(field.tax_id);
                var zeroindex = $('#zeroindex').val();
                var curr_tax = $('#curr_tax').val();
                if (curr_tax === "0") {
                    $('#tax_item').val(zeroindex);
                }
                $('#item_id').val(field.id);
                //                $("#current_stock").html('Current Stock :' + field.currentstk);
                $("#prate").html('Rate :' + field.prate);
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + field.unit_id,
                    success: function (result) {
                        $('#unit_item').html(result);
                        $('#unit_item').val(field.unit_id);
                        $("#item_qty").focus().select();
                    }
                });
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/godown'); ?>",
                    success: function (result) {
                        $('#godown').html(result);
                        var user_default_godown = $('#user_default_godown').val();
                        if (user_default_godown !== "") {
                            $('#godown').val(user_default_godown);
                        }
                        var billgodown = $("#btype option:selected").attr('godown');
                        if (billgodown !== '0') {
                            $('#godown').val(billgodown);
                        }

                    }
                });

            });

        });

    }

    $.validate({
        modules: 'date, security,file'
    });
    function loadCustByid(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results)[0];
                $('#supname').val(result.name);
                $('#supid').val(result.id);
                $('#phone').val(result.phone);
                $('#email').val(result.email);
                $('#cst').val(result.cst);
                $('#tin').val(result.tin);
                $('#address_line1').val(result.address_line1);
                $('#address_line2').val(result.address_line2);
                $('#details').val(result.details);
            }
        });
    }
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function itemsearchbyid(id) {
        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemsearchbyid/' + id,
                function (result) {
                    $.each(result, function (i, field) {
                        var list = "";
                        $('#myDropdown').html(list);
                        $("#modal-alter").modal();
                        $("#item_header").html(field.name);
                        $("#itemname").val(field.name);
                        $("#itemname1").val(field.name);
                        $("#mrp_item").val(field.MRP);
                        $("#prate_item").val(field.prate);
                        $("#unitvalue").val(field.prate);
                        $("#tax_led_id").val(field.tax_purchase_id);
                        $("#itemcode").val(field.barcode);
                        $("#item_qty").focus();
                        var is_multipletax = $('#is_multipletax').val();
                        if (is_multipletax === '1') {
                            if (field.tax_purchase_id !== undefined && field.tax_purchase_id !== '' && field.tax_purchase_id !== 0) {
                                $.ajax({
                                    url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + field.tax_purchase_id,
                                    async: false,
                                    success: function (results) {
                                        var result = JSON.parse(results);
                                        field.tax_id = result.ref_id;
                                    }
                                });
                            }
                        }
                        $('#tax_item').val(field.tax_id);
                        var zeroindex = $('#zeroindex').val();
                        var curr_tax = $('#curr_tax').val();
                        if (curr_tax === "0") {
                            $('#tax_item').val(zeroindex);
                        }
                        $('#item_id').val(field.id);
                        //                $("#current_stock").html('Current Stock :' + field.currentstk);
                        $("#prate").html('Rate :' + field.prate);
                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/units'); ?>/" + field.unit_id,
                            success: function (result) {
                                $('#unit_item').html(result);
                                $('#unit_item').val(field.unit_id);
                                $("#item_qty").focus().select();
                            }
                        });
                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/godown'); ?>",
                            success: function (result) {
                                $('#godown').html(result);
                            }
                        });
                    });

                });

    }
    function load(id) {
        $('#is_tax').val($('#is_taxincuded').val());
        var comset_currency = $('#comset_currency').val();
        $('#com_currency').val(comset_currency);

        var is_taxincluded = 0;
        var id = $('#pid').val();
        var tot = ser_tax = 0;
        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/pur_service_items'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        var amount = itemsingle.amount;
                        if (itemsingle.is_taxincluded === "0") {
                            amount = parseFloat(itemsingle.amount) + parseFloat(itemsingle.tax);
                        }

                        tot = parseFloat(tot) + parseFloat(amount);
                        ser_tax = parseFloat(ser_tax) + parseFloat(itemsingle.tax);
                        $('#sertaxtotal').val(ser_tax);
                        $('#sergtotal').val(tot);
                        addrowtoservice(itemsingle.amount, itemsingle.tax_id, itemsingle.tax, itemsingle.tax, itemsingle.name, itemsingle.ledger_id, itemsingle.is_taxincluded);

                    });
                }
            });

            $.ajax({
                url: "<?php echo site_url('ajaxcall/purchase'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        $('#com_currency').val(itemsingle.currency_id);
                        $('#curr_value').val(itemsingle.cur_exc_amt);
                        loadCustByid(itemsingle.supplier_id);
                        $('#billingname').val(itemsingle.billing_name);
                        var est_qty = 0;
                        var estid = $("#p_id").val();
                        if (estid !== '0') {
                            $('#txtEstimate_id').val(itemsingle.order_id);

                        }
                        if ($('#txtEstimate_id').val() !== "0" && itemsingle.quantity <= itemsingle.order_quantity) {
                            est_qty = 1;

                        }
                        if ($('#txtEstimate_id').val() !== "0" && itemsingle.quantity > itemsingle.order_quantity) {
                            var rate = itemsingle.rate;
                            var taxamount = 0;
                            var quantity = parseFloat(itemsingle.quantity) - parseFloat(itemsingle.order_quantity);
                            itemsingle.quantity = quantity;
                            var total = parseFloat(rate) * parseFloat(quantity);
                            if (itemsingle.discount !== "0.00") {
                                var discount = (parseFloat(total) * parseFloat(itemsingle.discount)) / 100;
                                var total = parseFloat(total) - parseFloat(discount);
                                itemsingle.dis_amt = discount;

                            }
                            if (itemsingle.is_taxincluded === "0") {
                                taxamount = (parseFloat(total) * parseFloat(itemsingle.tname)) / 100;
                                itemsingle.tax = taxamount;
                            }
                            if (itemsingle.is_taxincluded === "1") {
                                taxamount = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(itemsingle.tname) + 100));
                                itemsingle.tax = taxamount;
                            }


                        }
                        if ($('#txtEstimate_id').val() === "0") {
                            $('#invoice').val(itemsingle.invoice);

                        }
                        $('#date').val(formatDate(itemsingle.date));
                        $('#rdate').val(formatDate(itemsingle.rdate));
                        $('#freight').val(itemsingle.freight);
                        $('#advance').val(itemsingle.advance);
                        $('#other').val(itemsingle.other);
                        // if($type=='purchase'){
                        //  $('#invoice').val(itemsingle.invoice);
                        // }
                        // if($type=='purchase_order'){
                        //  $('#btype').val(itemsingle.bill_type);
                        // }
                        $('#discount').val(itemsingle.dis);
                        $('#reference').val(itemsingle.ref_id);
                        $('.box-title').html(itemsingle.type);
                        $('#area').val(itemsingle.area);
                        $('#salesman').val(itemsingle.salesman);
                        $('#route').val(itemsingle.route);
                        $('#vehicle').val(itemsingle.vehicle);
                        $('#tax_led_id').val(itemsingle.tax_purchase_id);
                        var is_taxincluded = itemsingle.is_taxincluded;
                        var mfg = itemsingle.date;
                        var exp = itemsingle.date;
                        var dis_amt = itemsingle.dis_amt;
                        var dis_item = itemsingle.discount;
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var unit_item = itemsingle.unitid;
                        var godown = itemsingle.item_godown;
                        var tax_item = itemsingle.txid;
                        var mrp_item = itemsingle.mrp;
                        var prate_item = itemsingle.rate;
                        var itemname = itemsingle.name + ' ' + itemsingle.barcode;
                        var comontax = $("#comontax").val();
                        var tax_amount = itemsingle.tax;
                        var barcode = itemsingle.barcode;
                        var tax_purchase_id = itemsingle.tax_purchase_id;
                        var rowTotal = (((parseFloat(itemsingle.rate) * parseFloat(itemsingle.quantity)) - parseFloat(itemsingle.dis_amt)) + parseFloat(tax_amount)).toFixed(2);
                        if (is_taxincluded === "1") {
                            var rowTotal = (((parseFloat(itemsingle.rate) * parseFloat(itemsingle.quantity)) - parseFloat(itemsingle.dis_amt))).toFixed(2);
                        }
                        itemsingle.total;
                        var commission = itemsingle.commission;
                        var unit_name = itemsingle.uname;
                        var item_discription = itemsingle.item_discription;
                        var godown_name = itemsingle.godown_name;
                        var tax_name = itemsingle.tname;
                        var analytics = itemsingle.analytics;
                        var analyticsname = itemsingle.analyticsname;
                        tax_amount = parseFloat(tax_amount).toFixed(2);
                        if (est_qty === 0) {
                            var iteadd = new item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincluded, item_discription, barcode);
                            addrowtoTable(iteadd);
                            items.push(iteadd);
                            $("#type").val(itemsingle.cash_type);
                            $("#Costcenter").val(itemsingle.cost_center);
                            $("#rowTotal").val(0.0);
                            $('.myspop').popover();
                            calculaterowtotal();
                            calculateGTotal();
                            $("#itemname").focus();
                        }

                    });

                }
            });
        } else {
            $("#invoice").focus();
        }

    }


    $(document).ready(function () {
        var btnid = '';
        $('#myModalPop').on('shown.bs.modal', function () {
            $('#name').focus();
        });
        $('#modal-alter').on('shown.bs.modal', function () {
            $('#item_qty').focus();
        })
        $(".myModalPop").click(function () {
            $('#modal-body').html('');
            var opt = $(this).attr('opt');
            $("#newtype").val(opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    btnid = guid();
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    $('.box-header').remove();
                    $('.box-primary').removeClass();
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop').modal();
                    $('#is_model').val(1);
                    $('#btnsaveds').attr('id', btnid);
                    $('.popuphide').hide();
                }
            });
        });
        $("#mClick").click(function () {
            $('#' + btnid).click();
            var opt = $("#newtype").val();
            $.ajax({
                url: "<?php echo site_url('ajaxcall/getitem'); ?>/" + opt,
                async: false,
                success: function (results) {
                    var result = JSON.parse(results);
                    if (result.id > 0) {
                        if (opt === "supplier") {
                            loadCustByid(result.id);
                        }
                        if (opt === "item") {
                            itemsearchbyid(result.id);
                        }
                    }

                    //$("#item_qty").focus();
                }
            });
        });

        $("#btnAddExtra").click(function () {

            $('#modelextra').modal();
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#godown').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/currency'); ?>",
            success: function (result) {
                $('#com_currency').html(result);
                var comset_currency = $('#comset_currency').val();
                $('#com_currency').val(comset_currency);
                var curr_tax = $("#com_currency option:selected").attr('crr_tx');
                if (curr_tax === "yes") {
                    $('#curr_tax').val(1);
                } else {
                    $('#curr_tax').val(0);
                }

            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function (result) {
                $('#Costcenter').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/states'); ?>",
            success: function (result) {
                $('#states').html(result);
                //                $('#states').val(45);
                $('#stcode').val(32);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/analyticscenter'); ?>",
            success: function (result) {
                $('#analyticscenter').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/route'); ?>",
            success: function (result) {
                $('#route').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/vehicle'); ?>",
            success: function (result) {
                $('#vehicle').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/reference'); ?>",
            success: function (result) {
                $('#reference').html(result);
                /*if ($("#id").val() !== '0') {
                 load_items($("#id").val());
                 }*/
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype'); ?>/<?php echo $type; ?>",
                        success: function (result) {
                            var user_default_billtype = $('#user_default_billtype').val();
                            $('#btype').html(result);
                            if (user_default_billtype !== "") {
                                $('#btype').val(user_default_billtype);
                            }
                        }
                    });
                    function getbtype(btypeid)
                    {
                        $.ajax({
                            url: "<?php echo site_url('transaction/sales/getprinttype'); ?>/" + btypeid,
                            async: false,
                            success: function (results) {
                                var result = JSON.parse(results);
                                $('#printtype').val(result.id);
                                //$("#item_qty").focus();
                            }
                        });
                    }
                    $.ajax({
                        url: "<?php echo site_url('ajaxcall/printtype'); ?>/" + $('#ttype').val(),
                        success: function (result) {
                            $('#printtype').html(result);
                        }
                    });
                    //supplier 
                    $("#ser_ledger").autocomplete({
                        source: "<?php echo site_url('ajaxcall/ledgers'); ?>",
                        minLength: 2,
                        select: function (event, ui) {
                            $('#ser_ledgerid').val(ui.item.id);
                            $('#ser_tax').val(ui.item.tax_id);
                            $('#ser_ledger').val(ui.item.name);
                            $('#ser_amt').focus();
                        }
                    });
                    $("#txtEstimate").autocomplete({
                        source: "<?php echo site_url('ajaxcall/pestimates'); ?>/<?php echo $type; ?>",
                                    minLength: 2,
                                    select: function (event, ui) {
                                        clear();
                                        $('#txtEstimate_id').val(ui.item.pid);
                                        $('#estid').val(ui.item.pid);
                                        $('#pid').val(ui.item.pid);
                                        $('#freight').val(ui.item.freight);
                                        $('#other').val(ui.item.other);
                                        load();
                                    }
                                });
                                $("#supname").autocomplete({
                                    source: "<?php echo site_url('ajaxcall/suppliers/sup'); ?>",
                                    minLength: 2,
                                    select: function (event, ui) {
                                        //                                        $('#states').val(ui.item.cst);
                                        $('#supid').val(ui.item.id);
                                        $('#phone').val(ui.item.phone);
                                        $('#stcode').val(ui.item.code);
                                        $('#billingname').val(ui.item.name);
                                        $('#email').val(ui.item.email);
                                        $('#gst').val(ui.item.Tin);
                                        $('#tin').val(ui.item.tin);
                                        $('#address').val(ui.item.address_line1);
                                        $('#address_line2').val(ui.item.address_line2);
                                        $('#details').val(ui.item.details);
                                        $('#itemname').focus();
                                        $('#vehicle').val(ui.item.cid);
                                        $.ajax({
                                            url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                                            success: function (results) {
                                                $("#balance").html("Closing Balance: " + results);
                                            }
                                        });
                                    }
                                });
                                //Tax
                                $.ajax({
                                    url: "<?php echo site_url('ajaxcall/tax'); ?>",
                                    success: function (result) {
                                        $('#tax_item').html(result);
                                        $('#tax_common').html(result);
                                        $('#ser_tax').html(result);
                                    }
                                });

                                $('.ItemMatchBarcode').autocomplete({
                                    source: "<?php echo site_url('ajaxcall/itemssearch/Txtbarcode'); ?>",
                                    minLength: 2,
                                    select: function (event, ui) {
                                        clear();
                                        var list = "";
                                        $('#myDropdown').html(list);
                                        $("#modal-alter").modal();
                                        $('.itemname').attr('data-placement', 'right');
                                        $('.itemname').popover('toggle');
                                        $("[wf-popover]").popover({
                                            html: true,
                                            content: function () {
                                                var content = $(this).attr("wf-content");
                                                //                        alert( $("#discription").text());
                                                return content;
                                            },
                                            title: function () {
                                                var title = $(this).attr("wf-title");
                                                //return $(title).children(".popover-heading").html();
                                                return title;
                                            },
                                            placement: function () {
                                                var my = this.$element.attr('wf-popover');
                                                return my;
                                            }
                                            //                    trigger: 'keydown'
                                        });
                                        $("#item_header").html(ui.item.name);
                                        $("#itemname_pop").val(ui.item.name);
                                        $("#itemname1").val(ui.item.name);
                                        $('.myspop').popover();
                                        $("#mrp_item").val(ui.item.MRP);
                                        $("#itemcode").val(ui.item.barcode);
                                        $("#prate_item").val(ui.item.prate);
                                        $("#unitvalue").val(ui.item.prate);
                                        $("#tax_led_id").val(ui.item.tax_purchase_id);
                                        var is_multipletax = $('#is_multipletax').val();
                                        if (is_multipletax === '1') {
                                            if (ui.item.tax_purchase_id !== undefined && ui.item.tax_purchase_id !== '' && ui.item.tax_purchase_id !== 0) {
                                                $.ajax({
                                                    url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + ui.item.tax_purchase_id,
                                                    async: false,
                                                    success: function (results) {
                                                        var result = JSON.parse(results);
                                                        ui.item.tax_id = result.ref_id;
                                                    }
                                                });
                                            }
                                        }
                                        $('#tax_item').val(ui.item.tax_id);
                                        var zeroindex = $('#zeroindex').val();
                                        var curr_tax = $('#curr_tax').val();
                                        if (curr_tax === "0") {
                                            $('#tax_item').val(zeroindex);
                                        }
                                        $('#item_id').val(ui.item.id);
                                        //                                        $("#current_stock").html('Current Stock :' + ui.item.currentstk);
                                        $("#prate").html('Rate :' + ui.item.prate);
                                        $.ajax({
                                            url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.unit_id,
                                            success: function (result) {
                                                $('#unit_item').html(result);
                                                $('#unit_item').val(ui.item.unit_id);
                                                $("#item_qty").focus();
                                            }
                                        });
                                        $.ajax({
                                            url: "<?php echo site_url('ajaxcall/godown'); ?>",
                                            success: function (result) {
                                                $('#godown').html(result);
                                                var user_default_godown = $('#user_default_godown').val();
                                                if (user_default_godown !== "") {
                                                    $('#godown').val(user_default_godown);
                                                }
                                                var billgodown = $("#btype option:selected").attr('godown');
                                                if (billgodown !== '0') {
                                                    $('#godown').val(billgodown);
                                                }
                                            }
                                        });

                                    }
                                });
                                //item select for purchase 
                                $("#itemname").autocomplete({
                                    source: "<?php echo site_url('ajaxcall/itemssearch/name'); ?>",
                                    minLength: 2,
                                    select: function (event, ui) {
                                        clear();
                                        var list = "";
                                        $('#myDropdown').html(list);
                                        $("#modal-alter").modal();
                                        $('.itemname').attr('data-placement', 'right');
                                        $('.itemname').popover('toggle');
                                        $("[wf-popover]").popover({
                                            html: true,
                                            content: function () {
                                                var content = $(this).attr("wf-content");
                                                //                        alert( $("#discription").text());
                                                return content;
                                            },
                                            title: function () {
                                                var title = $(this).attr("wf-title");
                                                //return $(title).children(".popover-heading").html();
                                                return title;
                                            },
                                            placement: function () {
                                                var my = this.$element.attr('wf-popover');
                                                return my;
                                            }
                                            //                    trigger: 'keydown'
                                        });
                                        $("#item_header").html(ui.item.name);
                                        $("#itemname_pop").val(ui.item.name);
                                        $("#itemname1").val(ui.item.name);
                                        $('.myspop').popover();
                                        $("#mrp_item").val(ui.item.MRP);
                                        $("#itemcode").val(ui.item.barcode);
                                        $("#prate_item").val(ui.item.prate);
                                        $("#unitvalue").val(ui.item.prate);
                                        $("#tax_led_id").val(ui.item.tax_purchase_id);
                                        var is_multipletax = $('#is_multipletax').val();
                                        if (is_multipletax === '1') {
                                            if (ui.item.tax_purchase_id !== undefined && ui.item.tax_purchase_id !== '' && ui.item.tax_purchase_id !== 0) {
                                                $.ajax({
                                                    url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + ui.item.tax_purchase_id,
                                                    async: false,
                                                    success: function (results) {
                                                        var result = JSON.parse(results);
                                                        ui.item.tax_id = result.ref_id;
                                                    }
                                                });
                                            }
                                        }
                                        $('#tax_item').val(ui.item.tax_id);
                                        var zeroindex = $('#zeroindex').val();
                                        var curr_tax = $('#curr_tax').val();
                                        if (curr_tax === "0") {
                                            $('#tax_item').val(zeroindex);
                                        }
                                        $('#item_id').val(ui.item.id);
                                        //                                        $("#current_stock").html('Current Stock :' + ui.item.currentstk);
                                        $("#prate").html('Rate :' + ui.item.prate);
                                        $.ajax({
                                            url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.unit_id,
                                            success: function (result) {
                                                $('#unit_item').html(result);
                                                $('#unit_item').val(ui.item.unit_id);
                                                $("#item_qty").focus();
                                            }
                                        });
                                        $.ajax({
                                            url: "<?php echo site_url('ajaxcall/godown'); ?>",
                                            success: function (result) {
                                                $('#godown').html(result);
                                                var user_default_godown = $('#user_default_godown').val();
                                                if (user_default_godown !== "") {
                                                    $('#godown').val(user_default_godown);
                                                }
                                                var billgodown = $("#btype option:selected").attr('godown');
                                                if (billgodown !== '0') {
                                                    $('#godown').val(billgodown);
                                                }
                                            }
                                        });

                                    }
                                });
                                $('#modelextra').on('shown.bs.modal', function () {
                                    $('#txtExtra').focus();
                                });

                                $('.tatalcal').change(function () {
                                    calculateGTotal();
                                });
//                                $("#states").change(function () {
//                                    var code = $(this).find(':selected').attr('code');
//                                    $('#stcode').val(code);
//                                });
                                $("#is_tax").change(function () {
                                    var is_tax = $("#is_tax").val();
                                    $("#is_taxincuded").val(is_tax);
                                    is_taxincuded = is_tax;
                                });
                                $('#btype').change(function () {
                                    var user_default_godown = $('#user_default_godown').val();
                                    if (user_default_godown !== "") {
                                        $('#godown').val(user_default_godown);
                                    }
                                    var billgodown = $("#btype option:selected").attr('godown');
                                    if (billgodown !== '0') {
                                        $('#godown').val(billgodown);
                                    }
                                    var btypeid = $('#btype').val();
                                    getbtype(btypeid);

                                });
                                $('#curr_value').change(function () {
                                    var com_currency = $('#com_currency').val();
                                    var comset_currency = $('#comset_currency').val();
                                    var gtotal = $('#gtotal').val();
                                    var curr_value = $('#curr_value').val();
                                    if (comset_currency === com_currency) {
                                        $('#curr_value').val(1);
                                        $("#cur_gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
//                                        $("#cur_div").attr("style", "display: none;");

                                    } else {
                                        if (gtotal === "") {

                                        } else {
                                            curr_value = parseFloat(curr_value * gtotal);
                                            $("#cur_gtotal").val(parseFloat(curr_value.toFixed(0)).toFixed(2));
                                        }

                                    }

                                });
                                $('#com_currency').change(function () {
                                    var com_currency = $('#com_currency').val();
                                    var comset_currency = $('#comset_currency').val();
                                    var value = $("#com_currency option:selected").attr('crr_value');
                                    $('#curr_value').val(value);
                                    var gtotal = $('#gtotal').val();
                                    var curr_value = $('#curr_value').val();
                                    var curr_tax = $("#com_currency option:selected").attr('crr_tx');
                                    if (curr_tax === "yes") {
                                        $('#curr_tax').val(1);
                                    } else {
                                        $('#curr_tax').val(0);
                                    }
                                    if (comset_currency === com_currency) {
                                        gtotal = parseFloat(1 * gtotal);
                                        $("#cur_gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
                                        $('#curr_value').val(1);
//                                        $("#cur_div").attr("style", "display: none;");

                                    } else {
                                        if (gtotal === "") {

                                        } else {
                                            curr_value = parseFloat(curr_value * gtotal);
                                            $("#cur_gtotal").val(parseFloat(curr_value.toFixed(0)).toFixed(2));
                                        }

                                    }

                                });

                                $('.price').change(function () {
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    $("#rowTotal").val(rowtotal(qty, prate));
                                });
                                $('#addmore').click(function () {
                                    var row = $("#add").html();
                                    var newRow = "<tr>" + row + "</tr>";
                                    $("#rowm").append(newRow);
                                    $(".remove").removeClass("hidden");
                                    $(".remove").first().addClass("hidden");
                                });
                                $("#ser_amt").keydown(function (e) {
                                    var amount = $("#ser_amt").val();
                                    if (amount > 0) {
                                        var key = e.charCode || e.keyCode || 0;
                                        if (key === 13 || key === 9) {
                                            addservices();
                                        }
                                    }

                                });
                                $("#ser_amt").keydown(function (e) {
                                    var amount = $("#ser_amt").val();
                                    if (amount > 0) {
                                        var key = e.charCode || e.keyCode || 0;
                                        if (key === 13 || key === 9) {
                                            addservices();
                                        }
                                    }

                                });
                                $("#supname").keydown(function (e) {
                                    var id = $("#supid").val();
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        if (id == "") {
                                            $("#supname").val("");
                                        }
                                    }

                                    if (key === 27)
                                    {
                                        if (id == "") {
                                            $("#supname").val("");
                                        }
                                    }


                                });
                                $("#dis_amt").keydown(function (e) {
                                    var dis_amt = $("#dis_amt").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var is_extra = $("#is_extra").val();
                                    var per = 0;
                                    if (dis_amt !== '' && prate !== '' && prate !== 0 && dis_amt > 0) {
                                        per = ((parseFloat(dis_amt) * 100) / (qty * prate));
                                    }
                                    if (!isNaN(per)) {
                                        $("#dis_item").val(per.toFixed(2));
                                    } else {
                                        $("#dis_item").val(0);
                                    }
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        calculaterowtotal();
                                        if (parseInt(is_extra) === 1) {
                                            $('#modelextra').modal();
                                        } else {
                                            $('#myDropdownhide').click();
                                            add();
                                            $('#btnclsmain').click();
                                        }
                                    }

                                });
                                $("#mrp_item").keydown(function (e) {
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        $("#prate_item").focus().select();
                                    }
                                });
                                $("#item_qty").keydown(function (e) {

                                    var dis = $("#dis_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var per = 0;
                                    if (dis !== '') {
                                        per = ((parseFloat(qty) * parseFloat(prate) * dis) / 100);
                                    }
                                    if (!isNaN(per)) {
                                        $("#dis_amt").val(per.toFixed(2));
                                    } else {
                                        $("#dis_amt").val(0);
                                    }
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                                            $("#item_qty").val(1);
                                        }
                                        e.preventDefault();
                                        e.stopPropagation();
                                        $("#mrp_item").focus().select();
                                    }
                                    calculaterowtotal();

                                });
                                $("#discount").change(function () {
                                    var total = $('#total').val();
                                    var discount = $('#discount').val();
                                    var dis_per = ((parseFloat(discount) * 100) / parseFloat(total)).toFixed(2);
                                    var id = 1;
                                    $(".disper").each(function () {
                                        $(this).val(dis_per);
                                        var ids = $(this).attr('id');
                                        calculaterowdis(ids.split("itmdis")[1]);
                                        id = id + 1;
                                    });
                                    calculateGTotal();
                                });
                                $("#dis_item").keydown(function (e) {
                                    var dis = $("#dis_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var per = 0;
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        if (dis !== '') {
                                            per = ((parseFloat(qty) * parseFloat(prate) * dis) / 100);
                                        }
                                        if (!isNaN(per)) {
                                            $("#dis_amt").val(per.toFixed(2));
                                        } else {
                                            $("#dis_amt").val(0);
                                        }
                                        $("#dis_amt").focus().select();
                                        calculaterowtotal();
                                    }

                                });
                                $("#unit_item").change(function () {
                                    var myTag = $(this).find(':selected').attr('count');
                                    var mrp = $("#unitvalue").val();
                                    myTag = myTag * mrp;
                                    $('#prate_item').val(myTag);
                                    calculaterowtotal();
                                });
                                $("#btnAddExtram").click(function () {
                                    add();
//                                    showbtn(1);
                                    $('#btncls').click();
                                    $('#btnclsmain').click();
                                });
                                $('#txtExtra').keydown(function (e) {
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 9)
                                    {
                                        add();
//                                        showbtn(1);
                                        $('#btncls').click();
                                        $('#btnclsmain').click();
                                    }
                                });
                                $('#modelextra').on('shown.bs.modal', function () {
                                    $('#txtExtra').focus();
                                });
                                $("#prate_item").keydown(function (e) {
                                    var prates = $("#prate_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var dis_item = $("#dis_item").val();
                                    var dis_item = $("#dis_item").val();
                                    if (prates === "") {
                                        $("#prate_item").val(0);
                                        prates = 0;
                                    }
                                    // var is_taxincuded = $("#is_taxincuded").val();
                                    var tax_name = $("#tax_item option:selected").attr('percent');
                                    var prate = parseFloat(prate) * parseFloat(qty);
                                    if (dis_amt === '') {
                                        dis_amt = 0;
                                    }
                                    var rowTax = parseFloat(prate - dis_amt) * parseFloat(tax_name) / 100;
                                    var tot = parseFloat(prate - dis_amt) + parseFloat(rowTax);
                                    calculaterowtotal();
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        $("#prate_item").val(parseFloat(prates).toFixed(2));
                                        $("#dis_item").focus().select();

                                    }
                                    if (key === 27)
                                    {
                                        $("#prate_item").val(parseFloat(prates).toFixed(2));
                                        // add();
                                        $("#dis_item").focus().select();
                                    }

                                });
                                $('.myspop').popover();
                                var comset_currency = $('#comset_currency').val();
                                $('#com_currency').val(comset_currency);
                                load();
                            });

                            function remove(btn) {
                                var id = $(btn).attr('index');
                                var index = getIndexOf(items, id);
                                items.splice(index, 1);
                                calculateGTotal();
                                $('.tooltip').remove();
                                $(btn).closest('tr').remove();

                            }
                            function EnterToTab() {
                                if (event.keyCode == 13)
                                    event.keyCode = 9;
                            }
                            function getIndexOf(a, v) {
                                var l = a.length;
                                for (var k = 0; k < l; k++) {
                                    if (a[k].inc_id.toString() === v.toString()) {
                                        return k;
                                    }
                                }
                                return false;

                            }

</script>