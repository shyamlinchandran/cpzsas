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
<form method="post"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('ItemstockEntry/create'); ?>" action="<?php echo site_url('ItemstockEntry/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="0" name="id" /> 
    <input type="hidden"  name="newtype"  id="newtype"/> 
    <input type="hidden" value="<?php echo $id; ?>" name="p_id" id="p_id"/> 
    <input type="hidden" name="invoice" id="invoice"/>
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
                    <table  class="table table-striped table-condensed" >
                        <thead>
                            <tr>
<!--                                <td>Item Name</td>-->
                                <td><?= label('Qty', $this, $user) ?></td>
                                <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><?= label('Godown', $this, $user) ?></td>
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
                                <td><?= label('Tax Amt', $this, $user) ?></td>
                                <td><?= label('Total', $this, $user) ?></td>
                                <td> <td> 
                            </tr>
                            <tr>
<!--                                <td  class="col-lg-3"> <input  NoTab="true"   id="itemname_pop"  class="form-control" type="text" placeholder="<?= label('Item Name', $this, $user) ?>"/></td>-->

                                <td> <input   id="item_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/></td>

                                <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><select tabindex="-1"  id="godown"  class="form-control col-lg-1">
                                        <option value="">Select</option> 
                                    </select>
                                </td>
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

                                    <td>  <input name="mfg" hidden type="text" id="mfg" data-validation="required" class="form-control col-lg-1 text-right date" placeholder="<?= label('Date', $this, $user) ?>"></td>
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
                                <td><input  class='form-control col-lg-1 two-digits'  id="rowTax" disabled="disabled" /></td>
                                <td><input  class='form-control col-lg-1 two-digits  ' id="rowTotal" disabled="disabled" /></td>

                                <td>
                                    <!--                                        hidden-->
                                    <input type="hidden" name="item_id" id="item_id"/>

                                    <button data-toggle="tooltip" type="button"    title="<?= label('Total', $this, $user) ?>Add To save"   class="btn btn-success" href="#">
                                        <span class="glyphicon glyphicon-plus"></span> 
                                    </button>
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
                                        <td class="col col-lg-2"><?= label('Date', $this, $user) ?></td>
                                        <td class="col col-lg-2 <?php echo $bill; ?>"> <?= label('Bill Type', $this, $user) ?></td> 
                                        <td class="col col-lg-2"> <?= label('Print Type', $this, $user) ?></td> 
                                        <td class="col col-lg-2"><?= label('SalesMan', $this, $user) ?></td> 


                                    </tr>
                                    <tr>
                                        <td>  <input name="date" type="text" id="date" data-validation="required" class="form-control  date" placeholder="<?= label('Date', $this, $user) ?>"></td>
                                        <td <?php echo $bill; ?>>
                                            <select tabindex="-1" id="btype" name="btype" class="form-control" >                                            
                                            </select>
                                        </td>
                                        <td>
                                            <select   id="printtype"  name="printtype" class="form-control" >
                                                <option value="">Select</option>  </select>
                                        </td>
                                        <td><select  id="salesman"  name="salesman" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 

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
                                                    <td <?php if ($is_godown == 1) { ?>  <?php } else { ?> hidden <?php } ?>><select tabindex="-1"  id="godown1"  class="form-control sma col-lg-1">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                    <td> <input   id="1item_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                                    <td class="cma" ><select tabindex="-1" id="1unit_item" class="form-control col-lg-1" >
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                    <?php if (!$comontax == 1) { ?>
                                                        <td class="cma" ><select tabindex="-1" id="1tax_item"  class="form-control col-lg-1">
                                                                <option value="">Select</option> 
                                                            </select>
                                                        </td>
                                                    <?php } ?>
                                                    <td> <input id="1mrp_item1"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="<?= label('MRP', $this, $user) ?>"/></td>
                                                    <td > <input id="1prate_item1" type="text"    class="form-control  text-right price col-lg-1 two-digits" placeholder="<?= label('Purchase Rate', $this, $user) ?>"/></td>
                                                    <td> <input id="1dis_item1"   type="text"    class="form-control cma text-right price col-lg-1 two-digits" placeholder="<?= label('Discount', $this, $user) ?>"/></td>
                                                    <td > <input id="1dis_amt1"   type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?= label('Dis Amt', $this, $user) ?>"/></td>

                                                    <?php if (!$comontax == 1) { ?>
                                                        <td> 
                                                            <input  class='form-control col-lg-1 two-digits'   disabled="disabled" />
                                                        </td>
                                                    <?php } ?>
                                                    <td><input  class='form-control col-lg-1 two-digits  '  disabled="disabled" /></td>
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
                                        <div class="col-sm-6"><?= label('Tax', $this, $user) ?></div>
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
                                <br />  
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-2 no-padding no-margin"> 
                                        <?= label('Discount', $this, $user) ?>
                                    </div>
                                    <div  class="col-sm-2 no-padding no-margin"  >
                                        <div class="col-sm-11">
                                            <?= label('Round Off', $this, $user) ?>
                                        </div>
                                    </div>
                                    <div style="display:none" class="col-sm-2 no-padding no-margin"> 
                                        <?= label($taxtype, $this, $user) ?>
                                    </div>
                                    <div style="display:none" class="col-sm-2 no-padding no-margin">
                                        <div class="col-sm-12 no-padding no-margin"  >
                                            <?= label('Grand  Total', $this, $user) ?> 
                                        </div>
                                        <!--                                        <div class="col-sm-1"></div>-->
                                    </div>
                                    <div class="col-sm-2"><?= label('Total', $this, $user) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-2 no-padding no-margin">
                                        <input name="discount" id="discount" placeholder="<?= label('Discount', $this, $user) ?>"   type="text" class="text-right  col-lg-1 form-control" >
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin"  > 
                                        <div class="col-sm-11">
                                            <input name="rount" id="rount" placeholder="<?= label('Round Off', $this, $user) ?>" readonly="readonly"   type="text" class="text-right  col-lg-1 form-control" >
                                        </div>
                                    </div>
                                    <div style="display:none"  class="col-sm-2 no-padding no-margin">  
                                        <div class="col-sm-11">
                                            <input name="taxtotal" id="taxtotal" placeholder="<?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?>"  readonly="readonly" type="text" class="text-right col-lg-1  form-control" >
                                        </div>
                                    </div>
                                    <div  style="display:none" class="col-sm-2 no-padding no-margin"  > 
                                        <div class="col-sm-12 no-padding no-margin"  >
                                            <input name="gtotal" id="gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right col-lg-1  form-control" >
                                        </div>
                                        <!--                                        <div class="col-sm-1"></div>-->
                                    </div>
                                    <div class="col-sm-2 no-padding no-margin">
                                        <div class="col-sm-11">
                                            <input name="cur_gtotal" id="cur_gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right col-lg-1  form-control" >
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        </div>

                    </div>
                    <div class="box-footer">  
                        <?php if ($view != 'view') { ?>

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

    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
            val = 0;
        }
        return val;

    }




    function calculaterow(id) {
        var rate = getVal('itmrate' + id);
        var qty = getVal("itmqty" + id);
        var disamt = getVal('disamt' + id);
        var dis = 0;
        if (rate !== '' && qty !== '' && disamt !== '' && parseFloat(rate * qty) > parseFloat(disamt)) {
            dis = parseFloat(((disamt * 100) / (rate * qty)));
        }
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
        iteadd.tax_amount = rowTax;
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
        $("#discount").val(discount.toFixed(2));
        $("#total").val(total.toFixed(2));
        $("#totpuretax").val(tax.toFixed(2));
        $("#taxtotal").val(tax.toFixed(2));
        var freight = 0;
        var other = 0;
        var discount = getVal("discount");
//+ parseFloat(tax)
        var gtotal = parseFloat(total) + parseFloat(freight) + parseFloat(other);
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
        var tax_name = $("#tax_item option:selected").text();
        var tax_item = $("#tax_item").val();
        var mrp_item = $("#mrp_item").val();
        var prate_item = $("#prate_item").val();
        var is_taxincuded = $("#is_taxincuded").val();
        var itemname = $("#itemname").val();
        itemname = $("#itemname1").val();
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var rowTax = parseFloat((prate_item * item_qty) - dis_amt) * parseFloat(tax_name) / 100;
        var tot = parseFloat((prate_item * item_qty) - dis_amt) + parseFloat(rowTax);
        if (is_taxincuded === "1") {
            var tot = parseFloat(prate_item - dis_amt);
            var rowTax = (parseFloat(tot) - ((parseFloat(tot) * 100) / (parseFloat(tax_name) + 100)));

        }
        rowTotal = tot;
        var tax_amount = $("#rowTax").val();
        var godown_name = $("#godown option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
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
        var sub_id = 0 ;
        var iteadd = new item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, '', godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincuded, item_discription, barcode,sub_id);
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
        var rowval = rowval + tde(item_qty, 'item_qty[]', 'form-control text-right col-lg-1 two-digits price', 'id="itmqty' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
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


        rowval = rowval + hidden(item_discription, 'itmdtn[]', 'id="itmdtn' + items.inc_id + '"');

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
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + field.id,
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
                            url: "<?php echo site_url('ajaxcall/units'); ?>/" + field.id,
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
        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('ItemstockEntry/getsing'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if (i < 1) {
                            $('#invoice').val(itemsingle.invoice);
                            $('#date').val(formatDate(itemsingle.date));
                            $('#btype').val(itemsingle.bill_type);
                            $('#printtype').val(itemsingle.printtype);
                            $('#salesman').val(itemsingle.salesman);
                            $('#com_currency').val(itemsingle.currency_id);
                            $('#curr_value').val(itemsingle.cur_exc_amt);
                        }
                        $('#date').val(formatDate(itemsingle.date));
                        var is_taxincluded = itemsingle.is_taxincluded;
                        //var mfg = itemsingle.date;
                        // var exp = itemsingle.date;
                        var dis_amt = itemsingle.discount_amount;
                        var dis_item = itemsingle.discount;
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var unit_item = itemsingle.unit_id;
                        var godown = itemsingle.godown_id;
                        var tax_item = itemsingle.tax_id;
                        var mrp_item = itemsingle.mrp;
                        var prate_item = itemsingle.rate;
                        var itemname = itemsingle.name;
                        var comontax = $("#comontax").val();
                        var tax_amount = itemsingle.tax;
                        var mfg = '';
                        var exp = '';
                        var barcode = itemsingle.barcode;
                        var rowTotal = (((parseFloat(itemsingle.rate) * parseFloat(itemsingle.quantity)) - parseFloat(itemsingle.discount_amount)) + parseFloat(tax_amount)).toFixed(2);
                        if (is_taxincluded === "1") {
                            var rowTotal = (((parseFloat(itemsingle.rate) * parseFloat(itemsingle.quantity)) - parseFloat(itemsingle.dis_amt))).toFixed(2);
                        }
                        itemsingle.total;
                        var commission = itemsingle.commission;
                        var unit_name = itemsingle.uname;
                        var item_discription = itemsingle.item_discription;
                        var godown_name = itemsingle.godown_name;
                        var tax_name = itemsingle.GST;
                        var analytics = itemsingle.analytics;
                        var analyticsname = itemsingle.analyticsname;
                        var sub_id = itemsingle.sub_id;
                        tax_amount = parseFloat(tax_amount).toFixed(2);
                        var tax_purchase_id = itemsingle.tax_id;
                        var iteadd = new item(dis_item, item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, mfg, exp, analytics, analyticsname, tax_purchase_id, is_taxincluded, item_discription, barcode,sub_id);
                        addrowtoTable(iteadd);
                        items.push(iteadd);
                        $("#type").val(itemsingle.cash_type);
                        $("#Costcenter").val(itemsingle.cost_center);
                        $("#rowTotal").val(0.0);
                        $('.myspop').popover();
                        calculateGTotal();
                        $("#itemname").focus();
                    });

                }
            });
        }

    }


    $(document).ready(function () {
        var btnid = '';
        $('#myModalPop').on('shown.bs.modal', function () {
            $('#name').focus();
        });
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
            url: "<?php echo site_url('ajaxcall/analyticscenter'); ?>",
            success: function (result) {
                $('#analyticscenter').html(result);
            }
        });


        $.ajax({
            url: "<?php echo site_url('ajaxcall/printtype'); ?>/" + $('#ttype').val(),
            success: function (result) {
                $('#printtype').html(result);
            }
        });
        //supplier 



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
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.id,
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
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.id,
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
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/') . $type; ?>",
            success: function (result) {
                $('#btype').html(result);
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
        $("#dis_amt").keydown(function (e) {
            var dis_amt = $("#dis_amt").val();
            var prate = $("#prate_item").val();
            var qty = $("#item_qty").val();
            var is_extra = $("#is_extra").val();
            calculaterowtotal();
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