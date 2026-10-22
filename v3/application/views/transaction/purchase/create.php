<?php
$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0;
$is_SettngsEnabled = 1;
$is_batch = $settings[0]['is_batch'];
$is_taxincuded = $settings[0]['is_taxincluded'];
//tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$json = json_encode(array('id' => '0'));
$cid = $carea = '';
$pid = 0;
$is_multipletax = $settings[0]['is_multipletax'];
$is_godown = $settings[0]['is_godown'];
$is_analytics = $settings[0]['is_analytics'];
$is_itemcode = $settings[0]['is_itemcode'];
$cost_centre = $settings[0]['is_costcenter'];
$is_extra = $settings[0]['is_discription'];
$is_billtype = $settings[0]['is_billtype'];
$taxtype = $settings[0]['com_tax_type'];
if ($is_batch == 1) {
    $batch = 'hidden';
}
if ($is_billtype == 0) {
    $bill = 'hidden';
} else {
    $bill = '';
}
?>
<style>
    .box-title{
        text-transform: capitalize;
    }
    .sma{
        width: 60px !important;
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
        padding: 2px !important;
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
    <input type="hidden" value="<?php echo $id; ?>" name="p_id" id="p_id"/> 
    <input type="hidden"  id="unitvalue" name="unitvalue"/> 
    <input type="hidden" value="<?php echo $id; ?>" name="pid" id="pid"/> 
    <input type="hidden" value="<?php echo $cost_centre; ?>" name="cost_centre" id='cost_centre'/>
    <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded"/> 
    <input type="hidden" value="<?php echo $is_extra; ?>" name="is_extra" id='is_extra'/>
    <input type="hidden" value="<?php echo $is_godown; ?>" id="is_godown" name="is_godown"/> 
    <input type="hidden"  id="estid" name="estid" value='0' /> 
    <input type="hidden" value="<?php echo $taxtype; ?>" name="taxtype" id='taxtype'/>
    <input type="hidden" value="<?php echo $is_itemcode; ?>" name="is_itemcode" id='is_itemcode'/>
    <input type="hidden" value="<?php echo $is_multipletax; ?>" name="is_multipletax" id='is_multipletax'/>
    <input type="hidden" value="<?php echo $is_analytics; ?>" name="is_analytics" id='is_analytics'/>
    <input type="hidden" value="<?php echo $comontax; ?>"  name="comontax" id="comontax"/>
    <input type="hidden" id="txtEstimate_id"  value='0' class="form-control" name="txtEstimate_id"/>
    <input type="hidden" value="" name="tax_led_id" id='tax_led_id'/>
    <input type="hidden" value="<?php echo $is_billtype; ?>" id="is_billtype" name="is_billtype"/> 
    <input type="hidden" value="<?php echo $is_batch; ?>" id="is_batch" name="is_batch"/> 
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
                                    <option value="1"><?= label('Tax Included', $this, $user) ?></option> 
                                    <option value="0"><?= label('Tax Excluded', $this, $user) ?></option> 
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
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <?php if ($type == 'purchase') { ?>
                                            <td class="hunpx"><?= label('Bill No.', $this, $user) ?></td>
                                        <?php } ?>

                                        <td class="hunpx"><?= label('Bill Date', $this, $user) ?></td>

                                        <td class="hunpx"><?= label('Purchase Date', $this, $user) ?></td>
                                        <td class="hunpx"><?= label('Type', $this, $user) ?> </td>
                                        <td class="col col-lg-1 <?php echo $bill; ?>"> <?= label('Bill Type', $this, $user) ?></td> 
                                        <?php if ($comontax == 1) { ?>
                                            <td><?= label($taxtype, $this, $user) ?></td>
                                        <?php } ?>
                                        <td>
                                            <?= label('Supplier', $this, $user) ?>  <button type="button" url="<?php echo base_url(); ?>suppliers/create/"  class="btn btn-primary myModalPop">
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
                                <table class="table table-striped table-condensed" style="display: none" >
                                    <tr>

                                        <td><?= label('Phone', $this, $user) ?></td>
                                        <td><?= label('Email', $this, $user) ?></td>
                                        <td><?= label('GST', $this, $user) ?></td>
                                    </tr>
                                    <tr> 
                                        <td><input name="phone" type="text" id="phone"    class="form-control" placeholder="Phone"></td>
                                        <td><input name="email" type="text" id="email"    class="form-control" placeholder="Email"></td>
                                        <td><input name="cst" type="text" id="cst"    class="form-control" placeholder="CST"></td>
                                    </tr>
                                    <tr>
                                        <td><?= label('GST Number ', $this, $user) ?></td>
                                        <td><?= label('Address', $this, $user) ?></td>
                                        <td><?= label('Address 2', $this, $user) ?></td>
                                        <td><?= label('Details', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td><input name="tin" type="text" id="tin" class="form-control" placeholder="<?= label('GSTIN', $this, $user) ?>"></td>
                                        <td><input name="address_line1" type="text"  id="address_line1" class="form-control" placeholder="<?= label('address line1', $this, $user) ?>"></td>
                                        <td><input name="address_line2" type="text"  id="address_line2" class="form-control" placeholder="<?= label('address line2', $this, $user) ?>"></td>
                                        <td><input name="details" type="text" id="details" class="form-control" placeholder="<?= label('details', $this, $user) ?>"></td>
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
                                <div class="tableBodyScroll">
                                    <table id="purchaseTable" class="table table-striped table-condensed" >
                                        <thead>
                                            <tr>
                                                <td><?= label('SNo', $this, $user) ?></td>
                                                <?php if ($is_itemcode == 1) { ?>
                                                    <td><?= label('Item Code', $this, $user) ?></td>
                                                <?php } ?>
                                                <td>
                                                    <?= label('Item', $this, $user) ?>
                                                    <button type="button" url="<?php echo base_url(); ?>item/create"  class="btn btn-primary myModalPop">
                                                        <?= label('New', $this, $user) ?> 
                                                    </button>
                                                </td>
                                                <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><?= label('Godown', $this, $user) ?></td>
                                                <td><?= label('Qty', $this, $user) ?></td>
                                                <?php if ($is_analytics == 1) { ?>
                                                    <td><?= label('Analytics', $this, $user) ?></td>
                                                <?php } ?>
                                                <td><?= label('Unit', $this, $user) ?></td>
                                                <?php if (!$is_batch == 0) { ?>

                                                    <td><?= label('mfg', $this, $user) ?></td>
                                                    <td><?= label('Expiry date', $this, $user) ?></td>
                                                <?php } ?>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td><?= label($taxtype, $this, $user) ?></td>
                                                <?php } ?>
                                                <td><?= label('MRP', $this, $user) ?></td>
                                                <td><?= label('Prate', $this, $user) ?></td>
                                                <td><?= label('Discount %', $this, $user) ?></td>
                                                <td><?= label('Dis Amt', $this, $user) ?></td>
                                                <?php if (!$is_batch == 1) { ?>

                                                    <?php if (!$comontax == 1) { ?>
                                                        <td><?= label($taxtype, $this, $user) ?> <?= label(' Amount', $this, $user) ?></td>
                                                    <?php } ?>
                                                    <td><?= label('Total', $this, $user) ?><td>
                                                    <?php } ?>

                                                <td> <td> 
                                            </tr>
                                            <tr id="add">
                                                <td class="sma" style="text-align: center;"><input title="1" style="height:25px"   id="totnolist" class="form-control  text-right"  readonly="readonly"/></td>
                                                <?php if ($is_itemcode == 1) { ?>
                                                    <td class="col-lg-1"> <input     id="itemcode" onchange="itemsearch()" stype="barcode" data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>" class="form-control"   type="text" placeholder="<?= label('Item Code', $this, $user) ?>"/></td>                                                                <?php } else { ?>
                                                <?php } ?>
                                                <td  class="col-lg-3"> <input  NoTab="true"   id="itemname"  data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>"class="form-control" type="text" placeholder="<?= label('Item Name', $this, $user) ?>"/></td>
                                                <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><select tabindex="-1"  id="godown"  class="form-control col-lg-1">
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <td> <input   id="item_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                                <?php if ($is_analytics == 1) { ?>
                                                    <td class="sma" ><select tabindex="-1" id="analyticscenter"  class="form-control col-lg-1">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <td class="sma" ><select tabindex="-1" id="unit_item" class="form-control col-lg-1" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <?php if (!$is_batch == 0) { ?>

                                                    <td>  <input name="mfg" type="text" id="mfg" data-validation="required" class="form-control col-lg-1 text-right date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                                    <td>  <input name="exp" type="text" id="exp" data-validation="required" class="form-control col-lg-1 text-right date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                                <?php } ?>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td class="sma" ><select tabindex="-1" id="tax_item"  class="form-control col-lg-1">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <td> <input id="mrp_item"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('MRP', $this, $user) ?>"/></td>
                                                <td > <input id="prate_item" type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Purchase Rate', $this, $user) ?>"/></td>
                                                <td> <input id="dis_item"   type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Discount', $this, $user) ?>"/></td>
                                                <td > <input id="dis_amt"   type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Dis Amt', $this, $user) ?>"/></td>

                                                <?php if (!$comontax == 1) { ?>
                                                    <?php if (!$is_batch == 1) { ?>
                                                        <td> 
                                                        <?php } ?><input  class='form-control col-lg-1 two-digits <?php echo $batch; ?>'  id="rowTax" disabled="disabled" />
                                                        <?php if (!$is_batch == 1) { ?>
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                                if (!$is_batch == 1) {
                                                    ?>
                                                    <td> 
<?php } ?>
                                                    <input  class='form-control col-lg-1 two-digits <?php echo $batch; ?>' id="rowTotal" disabled="disabled" /><?php if (!$is_batch == 1) { ?>
                                                    </td> 
<?php } ?>
                                                <td>
                                                    <!--                                        hidden-->
                                                    <input type="hidden" name="item_id" id="item_id"/>

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
                                <table class="table table-striped table-condensed" >
                                    <tr> 
                                        <td class="text-right text-center FontDouble" colspan="5"></td>
                                        <td><input name="totpuretax" id="totpuretax" placeholder="Total Tax"  readonly="readonly"   type="text" class="text-right col-lg-1 form-control" placeholder="<?= label('Total Tax', $this, $user) ?>"></td>
                                        <td><input type="text"  id="total" name="subtot" readonly="readonly"  class="form-control  col-lg-1  text-right" placeholder="<?= label('Total', $this, $user) ?>"></td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td> </td>
                                        <td></td>
                                        <td><?= label('Discount', $this, $user) ?></td>
                                        <td><?= label('Round Off', $this, $user) ?></td>
                                        <td><?= label($taxtype, $this, $user) ?></td>                               
                                        <td><?= label('Grand Total', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input name="discount" id="discount" placeholder="<?= label('Discount', $this, $user) ?>"   type="text" class="tatalcal text-right  col-lg-1 form-control" ></td>
                                        <td><input name="rount" id="rount" placeholder="<?= label('Round Off', $this, $user) ?>" readonly="readonly"   type="text" class="text-right  col-lg-1 form-control" ></td>
                                        <td><input name="taxtotal" id="taxtotal" placeholder="<?= label('Total Tax', $this, $user) ?>"  readonly="readonly" type="text" class="text-right col-lg-1  form-control" ></td>
                                        <td><input name="gtotal" id="gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right col-lg-1  form-control" ></td>
                                    </tr>
                                </table>

                            </div> 
                        </div>
                        <div class="tab-pane" id="otherTab">
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-2"><?= label('State', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('State Code', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label('Gst Number', $this, $user) ?></td> 
                                        <td class="col col-lg-3"><?= label('E-Way Bill Number', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('E-Way Bill Details', $this, $user) ?></td>
                                    </tr>
                                    <tr>

                                        <td><select  id="states"  name="states" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="stcode" type="text" id="stcode"  class="form-control  "   placeholder="<?= label('State Code', $this, $user) ?>"></td>
                                        <td>  <input name="gst" type="text" id="gst"  class="form-control  col-lg-2"   placeholder="<?= label('GSTIN', $this, $user) ?>"></td>
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
                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="<?= label('Date', $this, $user) ?>"></td>
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
                                        <td class="col col-lg-1"><?= label('Coolie', $this, $user) ?></td>
                                        <td class="col col-lg-1"><?= label('Freight', $this, $user) ?></td>
                                        <td class="col col-lg-1"><?= label('Other charges', $this, $user) ?></td>
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
                                        <td>  <input name="coolie" type="text"   class="form-control  col-lg-1"   placeholder="<?= label('Coolie', $this, $user) ?>"></td>
                                        <td><input name="freight" id="freight" placeholder="<?= label('Freight', $this, $user) ?>"   type="text" class="tatalcal text-right  col-lg-1 form-control" ></td>
                                        <td><input name="other" id="other" placeholder="<?= label('Other charges', $this, $user) ?>"   type="text" class="tatalcal text-right  col-lg-1 form-control" ></td>
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
                                            <td class="sma"><input type="hidden" NoTab="true" tabindex="-1" name="ser_taxid" id="ser_taxid"/><select tabindex="-1" id="ser_tax"  class="form-control col-lg-1" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                            <td> <input style='height:25px' id="ser_amt"  type="text"  class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label(' Amount', $this, $user) ?>"/></td>
                                            <td> <input id="ser_taxamt"   type="text" readonly="readonly"   class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('GST', $this, $user) ?>"/></td>
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
                                        <td><?= label('Total  Tax', $this, $user) ?></td>                               
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
                                        <td><input name="sertaxtotal" id="sertaxtotal" placeholder="<?= label('Total Tax', $this, $user) ?>" value="0" readonly="readonly"   type="text" class="text-right col-lg-1 form-control" ></td>
                                        <td><input name="sergtotal" id="sergtotal" placeholder="<?= label('Grand Total', $this, $user) ?>" value="0" readonly="readonly"  type="text" class="text-right col-lg-1 form-control" ></td>
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
        if (rate !== '' && qty !== '' && disamt !== '') {
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
        $("#rowTotal").val(tot.toFixed(2));
        $("#rowTax").val(rowTax.toFixed(2));
    }

    function  calculateGTotal() {
        var total = 0;
        var tax = 0;
        var itmno = 0;
        var j = 0;
        $.each(items, function (i) {
            j = j + 1;
            itmno = itmno + 1;
            $("#itmno" + items[i].inc_id).val(itmno.toFixed(0));
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
        });
        $("#totnolist").val(j);
        var sertax = getVal("sertaxtotal");
        var seramt = getVal("sergtotal");
        sertax = parseFloat(tax) + parseFloat(sertax);
        $("#total").val(total.toFixed(2));
        $("#totpuretax").val(tax.toFixed(2));
        $("#taxtotal").val(sertax.toFixed(2));
        var freight = getVal("freight");
        var other = getVal("other");
        var discount = getVal("discount");
//+ parseFloat(tax)
        var gtotal = parseFloat(total) + parseFloat(seramt) + parseFloat(freight) + parseFloat(other) - parseFloat(discount);
        var rount = (parseFloat(gtotal.toFixed(0)) - parseFloat(gtotal.toFixed(2))).toFixed(2);

        $("#gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
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
        var iteadd = new item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, '', godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincuded, item_discription, barcode);
        addrowtoTable(iteadd);
        items.push(iteadd);
        $('.myspop').popover();
    }
    function addrowtoTable(items) {
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

            rowval = rowval + td(items.godown_name);
        }
        var rowval = rowval + tde(item_qty, 'item_qty[]', 'form-control text-right col-lg-1 two-digits price', 'id="itmqty' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
        var is_analytics = $("#is_analytics").val();
        if (is_analytics === "1") {
            var analytics = items.analytics;
            var analyticsname = items.analyticsname;
            rowval = rowval + hidden(analytics, 'analytics_id[]') + td(items.analyticsname, '', '');
        }
        var rowval = rowval + td(items.unit_name);
        if (batch === '1') {
            rowval = rowval + td(mfg, 'mdate[]', ' text-right') + td(exp, 'edate[]', ' text-right');
        }
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name, 'taxper[]', 'col-lg-1 text-right', 'id="itmtaxper' + items.inc_id + '"');
        }
        rowval = rowval + hidden(is_taxincuded, 'is_taxincuded[]', 'id="is_taxincuded' + items.inc_id + '"') + tde(mrp_item, 'mrp_item[]', 'text-right', 'id="itmmrp' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(prate_item, 'prate_item[]', 'hunpx text-right', 'id="itmrate' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(dis_item, 'dis_item[]', 'text-right', 'id="itmdis' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(dis_amt, 'dis_amt[]', 'text-right', 'id="disamt' + items.inc_id + '" onchange=calculaterow(' + items.inc_id + ')');
        //alert(batch);
        if (batch === '0') {
            if (comontax === '0') {
                rowval = rowval + td(tax_amount, 'tax_amount[]', 'col-lg-1 text-right', 'id="itmtax' + items.inc_id + '"');
            }
//        rowval = rowval + td(mfg, 'mdate[]', 'hunpx text-right');

            rowval = rowval + hidden(item_id, 'item_id[]') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'col-lg1-1 text-right', 'id="itmtot' + items.inc_id + '"') + tdhtml(del);

        }
        if (batch === '1') {
            if (comontax === '0') {
                rowval = rowval + hidden(tax_amount, 'tax_amount[]', 'id="itmtax' + items.inc_id + '"');
            }

            rowval = rowval + hidden(item_id, 'item_id[]') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + hidden(rowTotal, 'rowTotal[]', 'id="itmtot' + items.inc_id + '"') + tdhtml(del);
        }
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
        $type = $("#itemcode").attr('stype');
        $text = $("#itemcode").val();
        $customer = '';
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

        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch/barcode/' + $customer + '?', {term: $text}, function (result) {
            $.each(result, function (i, field) {
                $("#itemname").val(field.name);
                $("#mrp_item").val(field.MRP);
                $("#prate_item").val(field.prate);
                $("#unitvalue").val(field.prate);
                $("#tax_led_id").val(field.tax_purchase_id);
                $("#itemcode").val(field.barcode);
                var is_multipletax = $('#is_multipletax').val();
                if (is_multipletax === '1') {
                    if (field.tax_purchase_id !== undefined && field.tax_purchase_id !== '' && field.tax_purchase_id !== 0) {
                        $.ajax({
                            url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + field.tax_purchase_id,
                            async: false,
                            success: function (results) {
                                var result = JSON.parse(results);
                                ui.item.tax_id = result.ref_id;
                            }
                        });
                    }
                }
                $('#tax_item').val(field.tax_id);
                $('#item_id').val(field.id);
//                $("#current_stock").html('Current Stock :' + field.currentstk);
                $("#prate").html('Rate :' + field.prate);
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + field.unit_id,
                    success: function (result) {
                        $('#unit_item').html(result);
                        $('#unit_item').val(field.unit_id);
                        $("#item_qty").focus();
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
    function load(id) {
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
                            if (itemsingle.is_taxincluded === "1") {
                                taxamount = (parseFloat(total) * parseFloat(itemsingle.tname)) / 100;
                                itemsingle.tax = taxamount;
                            }
                            if (itemsingle.is_taxincluded === "0") {
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
        $(".myModalPop").click(function () {
            $('#modal-body').html('');
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
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function (result) {
                $('#Costcenter').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/states'); ?>",
            success: function (result) {
                $('#states').html(result);
                $('#states').val(45);
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
                            $('#btype').html(result);
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
                                        $('#states').val(ui.item.cst);
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
                                //item select for purchase 
                                $("#itemname").autocomplete({
                                    source: "<?php echo site_url('ajaxcall/itemssearch'); ?>",
                                    minLength: 2,
                                    select: function (event, ui) {
                                        clear();

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
                                            }
                                        });

                                    }
                                });

                                $('.tatalcal').change(function () {
                                    calculateGTotal();
                                });
                                $("#states").change(function () {
                                    var code = $(this).find(':selected').attr('code');
                                    $('#stcode').val(code);
                                });
                                $("#is_tax").change(function () {
                                    var is_tax = $("#is_tax").val();
                                    $("#is_taxincuded").val(is_tax);
                                    is_taxincuded = is_tax;
                                });
                                $('#btype').change(function () {
                                    var btypeid = $(this).val();
                                    getbtype(btypeid);
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
                                $("#itemname").keydown(function (e) {
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13) {
                                        return false;
                                    }
                                    if (key === 27)
                                    {
                                        $("#freight").focus();
                                    }


                                });
                                $("#dis_amt").keydown(function (e) {
                                    var dis_amt = $("#dis_amt").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    var per = 0;
                                    if (dis_amt !== '' && prate !== '' && prate !== 0 && dis_amt > 0 ) {
                                        per = ((parseFloat(dis_amt) * 100) / (qty * prate));
                                    }
                                    $("#dis_item").val(per.toFixed(2));
                                    calculaterowtotal();
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        if (parseInt(is_extra) === 1) {
                                            $('#modelextra').modal();
                                        } else {
                                            add();
                                        }
                                    }

                                });
                                $("#item_qty").keydown(function (e) {

                                    var dis = $("#dis_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    per = 0;
                                    if (dis !== '') {
                                        per = ((parseFloat(qty) * parseFloat(prate) * dis) / 100);
                                    }
                                    $("#dis_amt").val(per.toFixed(2));
                                    var key = e.charCode || e.keyCode || 0;
                                    if (key === 13 || key === 9) {
                                        if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                                            $("#item_qty").val(1);
                                        }
                                        e.preventDefault();
                                        e.stopPropagation();
                                        $("#mrp_item").focus();
                                    }
                                    calculaterowtotal();

                                });
                                $("#dis_item").keydown(function (e) {
                                    var dis = $("#dis_item").val();
                                    var prate = $("#prate_item").val();
                                    var qty = $("#item_qty").val();
                                    per = 0;
                                    if (dis !== '') {
                                        per = ((parseFloat(qty) * parseFloat(prate) * dis) / 100);
                                    }
                                    $("#dis_amt").val(per.toFixed(2));
                                    calculaterowtotal();

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
                                    showbtn(1);
                                    $('#btncls').click();
                                });
                                $('#txtExtra').keydown(function (e) {
                                    if (key === 9)
                                    {
                                        add();
                                        showbtn(1);
                                        $('#btncls').click();
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
                                        $("#dis_item").focus();

                                    }
                                    if (key === 27)
                                    {
                                        $("#prate_item").val(parseFloat(prates).toFixed(2));
                                        // add();
                                        $("#dis_item").focus();
                                    }

                                });
                                $('.myspop').popover();

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