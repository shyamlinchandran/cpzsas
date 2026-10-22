<?php
$is_godown = $settings[0]['is_godown'];
$is_rack = $settings[0]['item_rack'];
$is_com = $settings[0]['item_commission'];
$is_rate = $settings[0]['item_min_rate'];
$is_production = $settings[0]['is_production'];
$is_analytics = $settings[0]['is_analytics'];
$isbatch = $settings[0]['is_batch'];
$ismultipletax = $settings[0]['is_multipletax'];
$is_multipleunit = $settings[0]['is_unit'];
$taxtype = $settings[0]['com_tax_type'];
$is_autobarcode = $settings[0]['is_autobarcode'];
$photo_enable = $settings[0]['item_image'];
$video_enable = $settings[0]['item_video'];
$alternate_item_set = $settings[0]['item_alternate'];
if ($taxtype == "GST") {
    $taxnamelbl = "GST";
    $taxldglabel = 'GST Legder';
} else {
    $taxnamelbl = "Tax";
    $taxldglabel = 'Tax Legder';
}
if ($is_godown == 0) {
    $ghidden = 'hidden';
} else {
    $ghidden = '';
}
?>
<?php

function getchild($list, $val) {
    $filter_rules = array(
        'tag_id' => $val
    );
    $filter = function ($player) use ($filter_rules) {
        foreach ($filter_rules as $rulekey => $rulevalue) {
            if ($player[$rulekey] != $rulevalue) {
                return false;
            }
        }
        return true;
    };
    $filtered = array_filter($list, $filter);
    return $filtered;
}
?>
<form method="post" id="frmcreatemodeli" enctype="multipart/form-data" back="<?php echo site_url('inventory/kitgroup/create'); ?>" action="<?php echo site_url('inventory/kitgroup/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?php echo $settings[0]['item_rack']; ?>" id="is_rack" name="is_rack"/>
    <input type="hidden" value="<?php echo $settings[0]['item_commission']; ?>" id="is_com" name="is_com"/>
    <input type="hidden" value="<?php echo $settings[0]['item_min_rate']; ?>" id="is_rate" name="is_rate"/>
    <input id="isgodown" class="form-control hidden" name="isgodown" type="hidden" value=<?php echo $is_godown ?> maxlength="50">
    <input type="hidden" value="<?php echo $settings[0]['is_production']; ?>" id="is_production" name="is_production"/>
    <input type="hidden" value="<?php echo $settings[0]['is_analytics']; ?>" id="is_analytics" name="is_analytics"/>
    <input type="hidden" value="<?php echo $settings[0]['is_multipletax']; ?>" id="is_multipletax" name="is_multipletax"/>
    <input type="hidden" value="<?php echo $is_multipleunit; ?>" id="is_multipleunit" name="is_multipleunit"/> 
    <input type="hidden" value="<?php echo $photo_enable; ?>" id="photo_enable" name="photo_enable"/>
    <input type="hidden" value="<?php echo $is_autobarcode; ?>" id="is_autobarcode" name="is_autobarcode"/>
    <input type="hidden" value="<?php echo $video_enable; ?>" id="video_enable" name="video_enable"/>
    <input type="hidden" value="<?php echo $alternate_item_set; ?>" id="alternate_item_set" name="alternate_item_set"/>
    <input type="hidden"   id="is_model" />  
    <input type="hidden"   id="def_barcode" value=""/>  
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <span class="pull-right popuphide"> 
                    <a role="button" 
                       class="btn  btn-success align-bottom popuphide"
                       href="<?php echo site_url('inventory/kitgroup\listall'); ?>"> <span
                            class="glyphicon glyphicon-arrow-left" title="back"></span>
                    </a>
                </span>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main_Item" data-toggle="tab"><?= label('Item', $this, $user) ?> </a></li>
                        <li><a href="#price_settings" data-toggle="tab"><?= label('Price', $this, $user) ?> </a></li>
                        <li><a href="#ecom_settings" data-toggle="tab"><?= label('E-commerce', $this, $user) ?> </a></li>
                        <?php
                        if ($is_godown != 0) {
                            ?>
                            <li><a href="#godownTab_Item" data-toggle="tab"><?= label('Stock Management', $this, $user) ?></a></li>
                        <?php }
                        ?>
                        <?php
                        if ($photo_enable != 0 || $video_enable != 0) {
                            ?> 
    <!--                            <li><a href="#otherTab_Item" data-toggle="tab"><?= label('Uploads', $this, $user) ?></a></li>-->
                            <?php
                        }
                        if ($alternate_item_set != 0) {
                            ?> 
                            <li><a href="#altTab_Item" data-toggle="tab"><?= label('Kit Items', $this, $user) ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="main_Item">                            
                            <div class="box-body"> 
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Name', $this, $user) ?> *<span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="name" class="form-control" name="name" type="text"
                                                   value="" data-validation="required" maxlength="250" />
                                        </div>
                                    </div>
                                    <?php if ($this->multiple != 0) { ?>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('name_lan', $this, $user) ?>  :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="name_lan" class="form-control" name="name_lan" type="text" value=""   maxlength="50">              
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 form-group odd_cls">

                                        </div>
                                    <?php } ?>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Bar Code', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <?php if ($is_autobarcode == 1) { ?>
                                                <input type="radio"  name="manual" id="manual" value="1" onchange="setbarcode()"><?= label('Auto Barcode', $this, $user) ?>
                                                <input type="radio" name="manual" onchange="setbarcode()" id="manual" value="0"><?= label('Manual', $this, $user) ?>
                                            <?php } ?>
                                            <input id="barcode" class="form-control" name="barcode"
                                                   type="text" value="" maxlength="500" data-validation="required server" data-validation-url="<?php echo site_url('item/check_barcode/') . $id ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Brand', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select name="brand_id" id="brand_id" class="form-control">
                                                    <option value="">Select</option> 
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="button" opt="brand" url="<?php echo site_url('master/amaster/brands_master/add'); ?>" class="btn btn-primary myModalPop_item_samoe">
                                                        <?= label('New', $this, $user) ?>  
                                                    </button>
                                                </span>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('HSN Code', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select name="hsn_id" id="hsn_id" class="form-control">
                                                    <option value="">Select</option> 
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="button" opt="hsn" url="<?php echo site_url('masters/hsncode/add'); ?>" class="btn btn-primary myModalPop_item_samoe">
                                                        <?= label('New', $this, $user) ?>  
                                                    </button>
                                                </span>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Available Online', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="radio"  name="online_item" id="online_item" value="no">No
                                            <input type="radio" name="online_item" id="online_item" value="yes">Yes
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Weight', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="item_size" class="form-control" name="item_size" type="text" value=""   maxlength="50">              
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Category', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select name="item_category_id" id="item_category_id" class="form-control">
                                                    <option value="">Select</option> 
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="button" opt="category" url="<?php echo site_url('items/itemcategory/add'); ?>" class="btn btn-primary myModalPop_item_samoe">
                                                        <?= label('New', $this, $user) ?> 
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">

                                        <label class="col-sm-4 control-label">
                                            <?= label('Discount Group', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select name="item_group_id" id="item_group_id" class="form-control">
                                                    <option value="">Select</option> 
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="button" opt="discount" url="<?php echo site_url('items/itemgroup/add'); ?>" class="btn btn-primary myModalPop_item_samoe">
                                                        <?= label('New', $this, $user) ?> 
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Unit', $this, $user) ?>  *<span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select name="unit_id" id="unit_id" class="form-control" data-validation="required">
                                                    <option value="">Select</option> 
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="button" opt="unit" url="<?php echo site_url('masters/units/add'); ?>" class="btn btn-primary myModalPop_item_samoe">
                                                        <?= label('New', $this, $user) ?>  
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Reorder Point', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="reorder_point" class="form-control two-digits price"
                                                   name="reorder_point" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                </div>



                                <?php
                                if ($is_rack != 0) {
                                    ?>  
                                    <div class="col-sm-12  ">
                                        <div class="col-sm-6 form-group odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Rack', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-sm">
                                                    <select onchange="rows()" name="rack_id" id="rack_id" class="form-control">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <button type="button" url="<?php echo site_url('item/racks/add'); ?>" opt="rack" class="btn btn-primary myModalPop_item_samoe">
                                                            <?= label('New', $this, $user) ?>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Row', $this, $user) ?>  <span></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="rrow" id="rrow" class="form-control">
                                                    <option value="">Select</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                <?php } ?>       

                                <?php
                                if ($isbatch != 0) {
                                    ?>
                                    <div class="col-sm-12" >
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Manufactured Date', $this, $user) ?>   <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input style="width: 100%" name="mfgdate" type="text" id="expdate"
                                                       data-validation="required" class="form-control hunpx date"
                                                       placeholder="Date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Expiry Date', $this, $user) ?>  <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input style="width: 100%" name="expdate" type="text" id="expdate"
                                                       data-validation="required" class="form-control hunpx date"
                                                       placeholder="Date">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="col-sm-12">

                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Minimum Level', $this, $user) ?> <span></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="minimuml" class="form-control two-digits price"
                                                   name="minimuml" type="text" value="" maxlength="50">
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Maximum Level', $this, $user) ?>   <span></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="maxl" class="form-control two-digits price"
                                                   name="maxl" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <?php
                                    if ($is_godown != 1) {
                                        ?>
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label"> <?= label('Open Stock', $this, $user) ?> <span class="required"></span>
                                                :
                                            </label>
                                            <div class="col-sm-8">

                                                <input id="open_stock" class="form-control two-digits price"
                                                       name="open_stock" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    if ($is_production != 0) {
                                        ?>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Material Type', $this, $user) ?> <span></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="material_type" id="material_type" class="form-control">
                                                    <option value="">select</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Type', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="itemtype" data-validation="required" id="itemtype" class="form-control">
                                                <?php foreach ($itemtype as $type) { ?>
                                                    <option
                                                        value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    if ($is_analytics != 0) {
                                        ?>
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Analytics Center', $this, $user) ?> <span></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="analytics_name" class="form-control" name="analytics_name" type="text" value="" maxlength="50"><input type="hidden" name="analytics_id" id="analytics_id"/>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Description', $this, $user) ?>  <span></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea id="description" class="form-control"
                                                      name="description"rows="20" cols="20"></textarea>
                                        </div> 
                                    </div>

                                </div>

                                <div class="col-sm-12">

                                </div>
                                <div class="col-sm-12 form-group">
                                </div>
                                <div class="form-group"></div>   

                            </div>
                        </div>
                        <div class="tab-pane" id="price_settings">    
                            <div class="box-body">
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Stock Rate', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="prate" class="form-control two-digits price"
                                                   name="prate" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('MRP', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="MRP" class="form-control two-digits price" name="MRP"
                                                   type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Sales Rate', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="srate" class="form-control two-digits price"
                                                   name="srate" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group odd_cls" >
                                        <label class="col-sm-4 control-label">
                                            <?= label('Price code', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="price_code" class="form-control" name="price_code"
                                                   type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Opening Stock Rate', $this, $user) ?> <span class="required"></span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="open_stk_rate" class="form-control two-digits price"
                                                   name="open_stk_rate" type="text" value="" maxlength="50">
                                        </div> 
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label($taxnamelbl, $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <select name="tax_id" id="tax_id" class="form-control" data-validation="required">
                                                    <option value="">Select</option> 
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="button" opt="tax" url="<?php echo site_url('masters/gst/add'); ?>" class="btn btn-primary myModalPop_item_samoe">
                                                        <?= label('New', $this, $user) ?>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div   <?php
                                if ($ismultipletax != 1) {
                                    ?> style="display: none;"   <?php } ?>class="col-sm-12 "> 
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label($taxldglabel, $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="tax_ledger" class="form-control" name="tax_ledger" type="text"
                                                   value="" maxlength="50">
                                            <input type="hidden" value="" id="taxldg_id" name="taxldg_id"/>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Sales Ledger', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="sales_tax" class="form-control" name="sales_tax"
                                                   type="text" value="" maxlength="50">
                                            <input type="hidden" value="" id="saletax_id" name="saletax_id"/>
                                        </div>  
                                    </div>
                                </div>
                                <div  <?php
                                if ($ismultipletax != 1) {
                                    ?> style="display: none;"   <?php } ?>class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Purchase Ledger', $this, $user) ?>  <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="purc_ledger" class="form-control" name="purc_ledger" type="text"
                                                   value="" maxlength="50">
                                            <input type="hidden" value="" id="purctax_id" name="purctax_id"/>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($is_com != 0 || $is_rate != 0) {
                                    ?>
                                    <div class="col-sm-12">
                                        <?php
                                        if ($is_com != 0) {
                                            ?>
                                            <div class="col-sm-6 form-group  odd_cls">
                                                <label class="col-sm-4 control-label">
                                                    <?= label('Commission', $this, $user) ?>  <span class="required"></span> :
                                                </label>
                                                <div class="col-sm-8">

                                                    <input id="commission" class="form-control two-digits price"
                                                           name="commission" type="text" value="" maxlength="50">
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        if ($is_rate != 0) {
                                            ?>
                                            <div class="col-sm-6 form-group">
                                                <label class="col-sm-4 control-label">
                                                    <?= label('Wholesale Rate', $this, $user) ?>   <span></span> :
                                                </label>
                                                <div class="col-sm-8">
                                                    <input id="wholerate" class="form-control two-digits price"
                                                           name="wholerate" type="text" value="" maxlength="50">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="ecom_settings">  
                            <div class="box-body">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#main_ecom" data-toggle="tab"><?= label('Item Images', $this, $user) ?> </a></li>
                                        <li><a href="#serv_details" data-toggle="tab"><?= label('Service Details', $this, $user) ?> </a></li>
                                        <?php foreach ($tags as $item) { ?>
                                            <li><a href="#tag<?php echo $item['tag_id']; ?>" data-toggle="tab"><?= label($item['tag_name'], $this, $user) ?> </a></li>
                                        <?php } ?>  
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="main_ecom">
                                            <div class="box-body">
                                                <?php
                                                if ($photo_enable != 0) {
                                                    ?>  
                                                    <div class="col-sm-12 form-group">

                                                        <label class="col-sm-2 control-label">
                                                            <?= label('Image', $this, $user) ?> 1<span class="required"></span> :
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <input type="file" id="file_a" name="file_a" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 form-group">

                                                        <label class="col-sm-2 control-label">
                                                            <?= label('Image', $this, $user) ?> 2<span class="required"></span> :
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <input type="file" id="file_b" name="file_b" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 form-group">

                                                        <label class="col-sm-2 control-label">
                                                            <?= label('Image', $this, $user) ?>3<span class="required"></span> :
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <input type="file" id="file_c" name="file_c" />
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($video_enable != 0) {
                                                    ?>  
                                                    <div class="col-sm-12 form-group">
                                                        <label class="col-sm-2 control-label">
                                                            <?= label('Video', $this, $user) ?> 1<span class="required"></span> :
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <input type="file" id="vidfile_a" name="vidfile_a" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label class="col-sm-2 control-label">
                                                            <?= label('Video', $this, $user) ?> 2<span class="required"></span> :
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <input type="file" id="vidfile_b" name="vidfile_b" />
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="serv_details">
                                            <div class="box-body"> 
                                                <div class="col-sm-12 form-group">
                                                    <label class="col-sm-2 control-label">
                                                        <?= label('Service Time', $this, $user) ?>  <span class="required"></span>:
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="time" id="time" name="time" class="form-control"/>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach ($tags as $item) { ?>
                                            <div class="tab-pane" id="tag<?php echo $item['tag_id']; ?>">  
                                                <?php
                                                $aisl = getchild($tags_items, $item['tag_id']);
                                                if (count($aisl) > 0) {
                                                    ?>
                                                    <?php foreach ($aisl as $chi) { ?>
                                                        <input type="checkbox" <?php
                                                        if ($chi['item_id'] != 0) {
                                                            echo 'checked';
                                                        };
                                                        ?>  name="chk[]" value=" <?php echo $chi['id']; ?>"><?php echo $chi['name']; ?><br />
                                                           <?php } ?>                

                                                    <?php
                                                }
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="otherTab_Item">

                            </div>
                            <?php
                            if ($is_godown != 0) {
                                ?>
                                <div class="tab-pane" id="godownTab_Item">
                                    <div class="box-body"> 
                                        <div class="col-sm-12 form-group">
                                            <label class="col-sm-2 control-label">
                                                <?= label('Godown', $this, $user) ?>  <span class="required"></span>:
                                            </label>
                                            <div class="col-sm-9">
                                                <table class="table no-border">
                                                    <tbody id="rowg">

                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                            ?>
                            <?php
                            if ($alternate_item_set != 0) {
                                ?>  
                                <div class="tab-pane" id="altTab_Item">
                                    <div class="box-body">                                 
                                        <div class="col-sm-12 form-group">
                                            <label class="col-sm-2 control-label">
                                                <?= label('Add Item', $this, $user) ?>  <span class="required"></span>:
                                            </label>
                                            <div class="col-sm-9">
                                                <table class="table no-border">
                                                    <tr id="adda">
                                                        <td style="width:40%">
                                                            <input id="alt_item_name" placeholder="Item" class="form-control" name="alt_item_name" type="text">
                                                            <input id="alt_item_id" class="form-control" name="alt_item_id" type="hidden">
                                                        </td>
                                                        <td style="width:20%">
                                                            <input id="alt_qty" placeholder="Quantity" class="form-control two-digits price" name="alt_qty" type="text">
                                                        </td>
                                                        <td  style="width:20%">
                                                            <input id="alt_rate" placeholder="Rate" class="form-control two-digits price" name="alt_rate" type="text">
                                                        </td>
                                                        <td>
                                                            <a data-toggle="tooltip" style="float: left"
                                                               title="Add More" id="addmore" class="btn btn-success"
                                                               href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tbody id="rowma">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="box-footer popuphide">  

                                <?php if ($view != 'view') { ?>
                                    <button id="btnsaveds" type='button'
                                            data-toggle="tooltip" title='Save'
                                            class='btn bg-orange btn-flat'>
                                        <i class="glyphicon glyphicon-hdd"></i>
                                    </button>   

                                <?php } ?>     

                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div></div></div>
            <!-- /.row -->

    </section>
</form>

<div class="modal fade bd-example-modal-lg" id="myModalPop_item_samoe" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

    $(document).ready(function () {
        $("#m_itemClick").bind("click", function () {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
        });
        $('#name').focus();
        load();
        taxes(0);
        var taxopen = $('select#tax_id option:selected').val();
        gettaxldg(taxopen);
        brands(0);
        material_types();
        hsn_code(0);
        item_category(0);
        item_group(0);
        unit(0);
//        item_size(0);
        $("#online_item").prop("checked", true);
        var israck = $("#is_rack").val();
        if (israck !== 0)
        {
            racks(0);
            rows();
        }
        var id = $("#id").val();
        if (id === '0') {
            getgodownlist();
        }
        $('#myModalPop_item_samoe').on('shown.bs.modal', function () {
            $('#name').focus();
        });
        $('#myModalPop_item_samoe').on('hidden.bs.modal', function () {
            var opt = $("#m_itemClick").attr('opt');
            if (opt === 'brand') {
                brands(1);
            }
            if (opt === 'hsn') {
                hsn_code(1);
            }
            if (opt === 'category') {
                item_category(1);
            }
            if (opt === 'discount') {
                item_group(1);
            }
            if (opt === 'unit') {
                unit(1);
            }
            if (opt === 'tax') {
                taxes(1);
            }
            if (opt === 'rack') {
                if (israck !== 0)
                {
                    racks(1);
                    rows();
                }
            }
            $('#is_model').val(0);
        });
        $(".myModalPop_item_samoe").click(function () {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    $('.box-header').remove();
                    $('.box-p').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop_item_samoe').modal();
                    $('#is_model').val(1);
                    //$('.popuphide').hide();
                }
            });
        });
        var idinc = 0;
        $('#addmore').click(function () {
            loadkitgroup();
        });
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });

        $("#btnsaveds").click(function () {
            $("#btnsaveds").attr('disabled', 'disabled');
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            var is_model = $('#is_model').val();
            var frm = "#frmcreatemodeli";
            var url = $(frm).attr('action');
            var name = $("#name").val();
            if (name === '') {
                $("#btnsaveds").removeAttr('disabled');
                toastr.info("Please add a Product Name");
                return;
            }
            var data = new FormData();
            var img_enabled = $("#photo_enable").val();
            if (img_enabled === '1')
            {
                var file_a = document.getElementById("file_a").files[0];
                var file_b = document.getElementById("file_b").files[0];
                var file_c = document.getElementById("file_c").files[0];
                data.append("file_a", file_a);
                data.append("file_b", file_b);
                data.append("file_c", file_c);
            }
            var vid_enabled = $("#video_enable").val();
            if (vid_enabled === '1')
            {
                var vidfile_a = document.getElementById("vidfile_a").files[0];
                var vidfile_b = document.getElementById("vidfile_b").files[0];
                data.append("vidfile_a", vidfile_a);
                data.append("vidfile_b", vidfile_b);
            }

            var other_data = $(frm).serializeArray();
            $.each(other_data, function (key, input) {
                data.append(input.name, input.value);
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data, // send it here
                contentType: false, // this
                processData: false, // and this should be false in case of uploading files
                beforeSend: function (xhr) {
                },
                success: function (Onj) {
                    var wsQuery = JSON.parse(Onj);

                    if (is_model === '1') {
                        showpage();
                        $('#mcb').click();
                        return;
                    }

                    var back = $(frm).attr('back');
                    $.ajax({
                        url: back,
                        success: function (result) {
                            $("#div1").html(result);
                            issubmited = 0;
                        }
                    });
                    showpage();
                    toastr["success"](wsQuery.message);
                },
                error: function (data) {
                }
            });
        });

    });
    function setbarcode() {
        var is_manual = $('input[name=manual]:checked').val();
        var def_barcode = $("#def_barcode").val();
        if (is_manual === '0') {
            $("#barcode").attr('readonly', false);
            $("#barcode").val('');

        } else {
            $("#barcode").attr('readonly', true);
            $("#barcode").val(def_barcode);
        }
    }
    var inc_inary = 0;
    function godownitem(iid, gid, name, gqty) {
        idinc = idinc + 1;
        if (gqty === null)
        {
            gqty = 0;
        }
        newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
                '<td ><input value="' + gqty + '"  type="text" name="gqty[' + idinc + ']"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
        $("#rowg").append(newrow);
    }
    var other_inc = 0;
    function otheritem(iid, alt_itemid, alt_item, quantity, rate) {
        other_inc = other_inc + 1;
        newrow = '<tr><td style="width:40%"><input  class="form-control"    value="' + alt_item + ' "type="text" disabled><input  value="' + alt_itemid + '"  type="text" name="alt_itemids[]"  class="hidden cre form-control"/></td>' +
                '<td style="width:20%"><input value ="' + quantity + ' "  class="form-control two-digits price" name="alt_quantity[]" type="text" ></td>' +
                '<td style="width:20%"><input value ="' + rate + ' " placeholder="Quantity" class="form-control two-digits price" name="alt_srate[]" type="text" autocomplete="off"></td>' +
                '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
        $("#rowma").append(newrow);
    }
    function godownlist(gid, name, gqty) {
        if (gqty === null)
        {
            gqty = 0;
        }
        if (gid === null)
        {
            gid = 0;
        }
        newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
                '<td ><input value="' + gqty + '"  type="text" name="gqty[' + idinc + ']"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
        $("#rowg").append(newrow);
        idinc = idinc + 1;
    }
    var idinc = 0;
    function getgodownlist()
    {
        $.ajax({
            url: "<?php echo site_url('inventory/kitgroup/allgodown'); ?>",
            success: function (result) {
                $.each(JSON.parse(result), function (i, itemsingle) {
                    var godown_id = itemsingle.id;
                    var godown_name = itemsingle.godown_name;
                    var gqty = 0;
                    godownlist(itemsingle.id, itemsingle.godown_name, gqty);
                });
            }
        });
    }

    $("#alt_item_name").autocomplete({
        source: "<?php echo site_url('ajaxcall/itemssearch/name'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $("#alt_item_name").attr('txt', ui.item.name);
            loadaltItem(ui);
        }
    });
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });
    function loadkitgroup() {
        var id = $("#id").val();
        var alt_item = $('#alt_item_name').attr('txt');
        var alt_itemid = document.getElementById('alt_item_id').value;
        var quantity = $('#alt_qty').val();
        var rate = $('#alt_rate').val();
        if (alt_itemid !== "" && quantity !== "" && rate !== "")
        {
            otheritem(id, alt_itemid, alt_item, quantity, rate);
            $('#alt_item_name').val("");
            $('#alt_item_id').val("");
            $('#alt_qty').val(0);
            $('#alt_rate').val(0);
        }
    }
    $("#alt_rate").keydown(function (e) {
        var key = e.charCode || e.keyCode || 0;
        if (key === 13 || key === 9)
        {
            loadkitgroup();
        }
    });

    function item_size(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_size'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.size_id + '"> ' + itemsingle.size_code + '</option>';
                });
                $("#item_size").html(option);
                if (is_select === 1) {
                    var myVal = $('#item_size option:last').val();
                    $('#item_size').val(myVal);
                }
            }
        });
    }
    function hsn_code(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/hsn_code'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.hsnid + '"> ' + itemsingle.hsncode + '</option>';
                });
                $("#hsn_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#hsn_id option:last').val();
                    $('#hsn_id').val(myVal);
                }
            }
        });
    }
    function item_category(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#item_category_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#item_category_id option:last').val();
                    $('#item_category_id').val(myVal);
                }
            }
        });
    }
    function item_group(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_group'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#item_group_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#item_group_id option:last').val();
                    $('#item_group_id').val(myVal);
                }
            }
        });
    }
    function unit(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/unit'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#unit_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#unit_id option:last').val();
                    $('#unit_id').val(myVal);
                }
            }
        });
    }
    function taxes(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/tax'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.gstid + '"> ' + itemsingle.GST + '</option>';
                });
                $("#tax_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#tax_id option:last').val();
                    $('#tax_id').val(myVal);
                    gettaxldg(myVal);
                }
            }
        });
    }
    function racks(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/racks'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option rows = "' + itemsingle.rows + '" value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#rack_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#rack_id option:last').val();
                    $('#rack_id').val(myVal);
                }
            }
        });
    }
    function rows(is_select)
    {
        var option = '';
        var row = $('#rack_id').find(':selected').attr('rows');
        var i = 0;
        for (i = 1; i <= row; i++) {
            option = option + '<option value ="' + i + '"> ' + i + '</option>';
        }
        $("#rrow").html(option);

    }

    function brands(is_select)
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#brand_id").html(option);
                if (is_select === 1) {
                    var myVal = $('#brand_id option:last').val();
                    $('#brand_id').val(myVal);
                }
            }
        });
    }
    function material_types()
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/material_types'); ?>/",
            async: false,
            success: function (result) {
                $("#material_type").html(result);
            }
        });
    }
    function loadanalyt(ui) {
        $('#analytics_name').val(ui.item.any_name);
        $('#analytics_id').val(ui.item.any_id);
    }
    function loadaltItem(ui) {
        $('#alt_item_name').val(ui.item.name);
        $('#alt_item_id').val(ui.item.id);
        //$('#cat').focus();
    }
    function load() {
        var id = $("#id").val();
        var is_autobarcode = $("#is_autobarcode").val();
        if (is_autobarcode === '1') {
            $("input:radio[name='manual'][value ='1']").prop('checked', true);
//            alert($('input[name=manual]:checked').val());
            $("#barcode").attr('readonly', true);
            if (id === '0') {
                $.ajax({
                    url: "<?php echo site_url('inventory/kitgroup/getbarcode'); ?>/",
                    async: false,
                    success: function (result) {
                        $("#barcode").val(result);
                        $("#def_barcode").val(result);
                    }
                });
            }
        }
        //alert(id);

        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('inventory/kitgroup/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#name").val(result.name);
                    $("#brand_id").val(result.brand_id);
                    $("#name_lan").val(result.name_lan);
                    $("#def_barcode").val(result.barcode);
                    $("#barcode").val(result.barcode);
                    $("#open_stock").val(result.item_stock);
                    $("#current_stock").val(result.current_stock);
                    $("#price_code").val(result.price_code);
                    $("#commission").val(result.commission);
                    $("#reorder_point").val(result.reorder_point);
                    $("#minimuml").val(result.min_level);
                    $("#maxl").val(result.max_level);
                    $("#prate").val(result.prate);
                    $("#srate").val(result.srate);
                    $("#description").val(result.description);
                    $("#MRP").val(result.MRP);
                    $("#wholerate").val(result.wh_rate);
                    $("#open_stk_rate").val(result.open_stk_rate);
                    $("#analytics_id").val(result.any_id);
                    $("#analytics_name").val(result.any_name);
                    $("#taxldg_id").val(result.taxldgid);
                    $("#tax_ledger").val(result.taxldg);
                    $("#saletax_id").val(result.saletxid);
                    $("#sales_tax").val(result.saletxldg);
                    $("#purctax_id").val(result.purctxid);
                    $("#purc_ledger").val(result.purctxldg);
                    $("#tax_id").val(result.tax_id);
                    $("#item_category_id").val(result.item_category_id);
                    $("#unit_id").val(result.unit_id);
                    $("#hsn_id").val(result.hsncode);
                    $("#item_group_id").val(result.item_group_id);
                    $("#rack_id").val(result.rack);
                    $("#itemtype").val(result.item_type_id);
                    $("#material_type").val(result.material_type);
                    $('#online_item').val(result.item_online);
                }
            });

            $.ajax({
                url: "<?php echo site_url('inventory/kitgroup/godownitem'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        godownitem(itemsingle.item_id, itemsingle.godownid, itemsingle.godown_name, itemsingle.open_stock);
                    });
                }
            });
            $.ajax({
                url: "<?php echo site_url('inventory/kitgroup/otheritem'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        otheritem(itemsingle.item_id, itemsingle.otherid, itemsingle.othername,itemsingle.quantity,itemsingle.rate);
                    });
                }
            });
        }
    }
    $("#analytics_name").autocomplete({
        source: "<?php echo site_url('cost_analytics/analytics_centre/analyt_centres'); ?>",
        minLength: 1,
        select: function (event, ui) {
            loadanalyt(ui);

        }
    });
    $("#sales_tax").autocomplete({
        source: "<?php echo site_url('inventory/kitgroup/taxldg_find/saletax'); ?>",
        minLength: 1,
        select: function (event, ui) {
            $('#sales_tax').val(ui.item.name);
            $('#saletax_id').val(ui.item.id);
        }
    });
    $("#purc_ledger").autocomplete({
        source: "<?php echo site_url('inventory/kitgroup/taxldg_find/purtax'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $('#purc_ledger').val(ui.item.name);
            $('#purctax_id').val(ui.item.id);

        }
    });
    $("#tax_ledger").autocomplete({
        source: "<?php echo site_url('inventory/kitgroup/taxldg_find/tax'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $('#tax_ledger').val(ui.item.name);
            $('#taxldg_id').val(ui.item.id);

        }
    });
    function gettaxldg(taxxid, taxtype)
    {
        $.ajax({
            url: "<?php echo site_url('inventory/kitgroup/gettaxldg'); ?>/" + taxxid,
            async: false,
            success: function (results) {
                var result = JSON.parse(results);
                $("#tax_ledger").val(result.tax.name);
                $('#taxldg_id').val(result.tax.id);
                $("#sales_tax").val(result.saletax.name);
                $("#saletax_id").val(result.saletax.id);
                $("#purc_ledger").val(result.purctax.name);
                $("#purctax_id").val(result.purctax.id);
            }
        });
    }
    $("#tax_id").change(function () {
        var taxxid = $(this).val();
        //var tax_type = "tax";
        gettaxldg(taxxid);
    });
</script>
<script>
    $.validate({
        modules: 'security',
        onModulesLoaded: function () {
        }
    });
</script>