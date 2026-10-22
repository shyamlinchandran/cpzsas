<?php
$is_size = $settings[0]['is_size'];
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
$item_advanced = $settings[0]['item_advanced'];
$is_item_type = $settings[0]['is_item_type'];
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
<section style="background:#efefe9;">

</section>
<style>
    .dot {
        height: 20px;
        width: 25px;
        background-color: #fff;
        border-radius: 50%;
        display: inline-block;
    }

    #main,
    #other,
    #video,
    #godown,
    #alt,
    #otherfield {
        pointer-events: none;
        /* width: 16%; */
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        color: #555;
        cursor: default;


        background-color: #fff;
        border: 1px solid #ddd;
        border-top: 3px solid #3c8dbc;
        border-bottom-color: transparent;
        border-radius: 0px;


        /* border-top: 0px solid #ddd;
        border-left: 0px solid #ddd;
        border-right: 0px solid #ddd;
        border-bottom: 3px solid #ddd;
        border-bottom-color: #007bff;
        border-top-color: transparent; */
    }

    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 18px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default radio button */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .tablinks {
        color: black;
        /* font-size: 18px; */
    }

    /* Show the indicator (dot/circle) when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after {
        top: 7px;
        left: 7px;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: white;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/slim/slim.min.css">
<script src="<?php echo base_url(); ?>assets/slim/slim.kickstart.min.js"></script>
<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= label('Create Item', $this, $user) ?></h3>
                <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('inventory_master/Item/listall'); ?>">
                        <span class="remove glyphicon glyphicon-arrow-left" title="back"></span>
                    </a>
                </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" id="frmcreatemodeli" enctype="multipart/form-data" back="<?php echo site_url('inventory_master/item/create'); ?>" action="<?php echo site_url('inventory_master/item/save'); ?>" class="form-horizontal">
                    <input type="hidden" value="<?php echo $settings[0]['item_rack']; ?>" id="is_rack" name="is_rack" />
                    <input type="hidden" value="<?php echo $settings[0]['item_commission']; ?>" id="is_com" name="is_com" />
                    <input type="hidden" value="<?php echo $settings[0]['item_advanced']; ?>" id="item_advanced" name="item_advanced" />
                    <input type="hidden" value="<?php echo $settings[0]['item_min_rate']; ?>" id="is_rate" name="is_rate" />
                    <input id="isgodown" class="form-control hidden" name="isgodown" type="hidden" value=<?php echo $is_godown ?> maxlength="50">
                    <input type="hidden" value="<?php echo $settings[0]['is_production']; ?>" id="is_production" name="is_production" />
                    <input type="hidden" value="<?php echo $settings[0]['is_analytics']; ?>" id="is_analytics" name="is_analytics" />
                    <input type="hidden" value="<?php echo $settings[0]['is_multipletax']; ?>" id="is_multipletax" name="is_multipletax" />
                    <input type="hidden" value="<?php echo $is_multipleunit; ?>" id="is_multipleunit" name="is_multipleunit" />
                    <input type="hidden" value="<?php echo $photo_enable; ?>" id="photo_enable" name="photo_enable" />
                    <input type="hidden" value="<?php echo $is_autobarcode; ?>" id="is_autobarcode" name="is_autobarcode" />
                    <input type="hidden" value="<?php echo $video_enable; ?>" id="video_enable" name="video_enable" />
                    <input type="hidden" value="<?php echo $alternate_item_set; ?>" id="alternate_item_set" name="alternate_item_set" />
                    <input type="hidden" id="is_model" />
                    <input type="hidden" id="def_barcode" value="" />
                    <input type="hidden" value="<?= $id ?>" id="ins_id" name="ins_id" />
                    <div class="">
                        <div class="">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li id="main" class="active">
                                    <a class="tablinks active" data-toggle="tab" title="welcome">
                                        Item Details
                                    </a></li>
                                <li id="godown"><a class="tablinks" style="text-decoration: none" data-toggle="tab" title="bootsnipp goodies">
                                        Godowns </a>
                                </li>
                                <?php
                                if ($photo_enable != 0) {
                                ?>
                                    <li id="other"><a class="tablinks" data-toggle="tab" title="profile">
                                            Images
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                if ($video_enable != 0) {
                                ?>
                                    <li id="video"><a class="tablinks" data-toggle="tab" title="profile">
                                            Videos
                                        </a>
                                    </li>
                                <?php } ?>
                                <li id="alt"><a data-toggle="tab" title="blah blah" class="tablinks">
                                        Alternate Item
                                    </a></li>
                                <?php
                                if ($settings[0]['is_makemodel'] != 0) {
                                ?>
                                    <li id="otherfield"><a data-toggle="tab" title="blah blah" class="tablinks">
                                            Other Fields
                                        </a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>

                        <!-- <div class="tab-content"> -->
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active tab-content" id="main_Item">
                            <div class="box-body">
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Name', $this, $user) ?> *<span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="250" />
                                            <span id="exist" style="color:#a94442">This item already exist</span>
                                        </div>
                                    </div>
                                    <?php if ($this->multiple != 0) { ?>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('name_lan', $this, $user) ?> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="name_lan" class="form-control" name="name_lan" type="text" value="" maxlength="50">

                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group odd_cls">

                                        </div>
                                    <?php } ?>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Bar Code', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <?php if ($is_autobarcode == 1) { ?>
                                                <input type="radio" name="manual" id="manual" value="1" onchange="setbarcode()"><?= label('Auto Barcode', $this, $user) ?>
                                                <input type="radio" name="manual" onchange="setbarcode()" id="manual" value="0"><?= label('Manual', $this, $user) ?>
                                            <?php } ?>
                                            <input id="barcode" class="form-control" name="barcode" type="text" value="" maxlength="500" data-validation="required server" data-validation-url="<?php echo site_url('item/check_barcode/') . $id ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php if ($settings[0]['is_makemodel'] != 0) { ?>
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Part No', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="pno" class="form-control " name="pno" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group ">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Make Model', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="mmodel" class="form-control " name="mmodel" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Brand', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Select</option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('HSN Code', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <select name="hsn_id" id="hsn_id" class="form-control">
                                                <option value="">Select</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Price code', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="price_code" class="form-control" name="price_code" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">

                                        <label class="col-sm-4 control-label">
                                            <?= label('Available Online', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="radio" name="online_item" id="online_item" value="no">No
                                            <input type="radio" name="online_item" id="online_item" value="yes">Yes
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Category', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <input type="hidden" id="item_category_id" name="item_category_id" class="form-control" />
                                            <input type="text" id="item_category_name" name="item_category_name" class="form-control" />


                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">

                                        <label class="col-sm-4 control-label">
                                            <?= label('Discount Group', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <select name="item_group_id" id="item_group_id" class="form-control">
                                                <option value="">Select</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Unit', $this, $user) ?> *<span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <select name="unit_id" id="unit_id" class="form-control" data-validation="required">
                                                <option value="">Select</option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label($taxnamelbl, $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <select name="tax_id" id="tax_id" class="form-control" data-validation="required">
                                                <option value="">Select</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>

                                <div <?php
                                        if ($ismultipletax != 1) {
                                        ?> style="display: none;" <?php } ?>class="col-sm-12 ">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label($taxldglabel, $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="tax_ledger" class="form-control" name="tax_ledger" type="text" value="" maxlength="50">
                                            <input type="hidden" value="" id="taxldg_id" name="taxldg_id" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Sales Ledger', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="sales_tax" class="form-control" name="sales_tax" type="text" value="" maxlength="50">
                                            <input type="hidden" value="" id="saletax_id" name="saletax_id" />
                                        </div>
                                    </div>
                                </div>
                                <div <?php
                                        if ($ismultipletax != 1) {
                                        ?> style="display: none;" <?php } ?>class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Purchase Ledger', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="purc_ledger" class="form-control" name="purc_ledger" type="text" value="" maxlength="50">
                                            <input type="hidden" value="" id="purctax_id" name="purctax_id" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item size', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <select name="item_size" id="item_size" class="form-control" data-validation="required">
                                                <option value="">Select</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Stock Rate', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="prate" class="form-control two-digits price" name="prate" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('MRP', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="MRP" class="form-control two-digits price" name="MRP" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Sales Rate', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="srate" class="form-control two-digits price" name="srate" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Opening Stock Rate', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="open_stk_rate" class="form-control two-digits price" name="open_stk_rate" type="text" value="" maxlength="50">
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

                                                <select onchange="rows()" name="rack_id" id="rack_id" class="form-control">
                                                    <option value="">Select</option>
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Row', $this, $user) ?> <span></span> :
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
                                if ($is_com != 0 || $is_rate != 0) {
                                ?>
                                    <div class="col-sm-12">
                                        <?php
                                        if ($is_com != 0) {
                                        ?>
                                            <div class="col-sm-6 form-group  odd_cls">
                                                <label class="col-sm-4 control-label">
                                                    <?= label('Commission', $this, $user) ?> <span class="required"></span> :
                                                </label>
                                                <div class="col-sm-8">

                                                    <input id="commission" class="form-control two-digits price" name="commission" type="text" value="" maxlength="50">
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        if ($is_rate != 0) {
                                        ?>
                                            <div class="col-sm-6 form-group">
                                                <label class="col-sm-4 control-label">
                                                    <?= label('Wholesale Rate', $this, $user) ?> <span></span> :
                                                </label>
                                                <div class="col-sm-8">
                                                    <input id="wholerate" class="form-control two-digits price" name="wholerate" type="text" value="" maxlength="50">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php
                                if ($isbatch != 0) {
                                ?>
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Manufactured Date', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input name="mfgdate" type="text" id="expdate" data-validation="required" class="form-control hunpx date" placeholder="Date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Expiry Date', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input name="expdate" type="text" id="expdate" data-validation="required" class="form-control hunpx date" placeholder="Date">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-sm-12">
                                    <div <?php if ($is_item_type == 0) {
                                                echo 'style="display:none;"';
                                            } ?> class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Type', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="itemtype" data-validation="required" id="itemtype" class="form-control">
                                                <?php foreach ($itemtype as $type) { ?>
                                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    if ($item_advanced != 0) {
                                    ?>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Reorder Point', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="reorder_point" class="form-control two-digits price" name="reorder_point" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-12">

                                    <?php
                                    if ($item_advanced != 0) {
                                    ?>
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Minimum Level', $this, $user) ?> <span></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="minimuml" class="form-control two-digits price" name="minimuml" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Maximum Level', $this, $user) ?> <span></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="maxl" class="form-control two-digits price" name="maxl" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                    <?php } ?>
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

                                                <input id="open_stock" class="form-control two-digits price" name="open_stock" type="text" value="" maxlength="50">
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
                                    <?php
                                    if ($is_analytics != 0) {
                                    ?>
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Analytics Center', $this, $user) ?> <span></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="analytics_name" class="form-control" name="analytics_name" type="text" value="" maxlength="50"><input type="hidden" name="analytics_id" id="analytics_id" />
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Description', $this, $user) ?> <span></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea id="description" class="form-control" name="description" rows="20" cols="20"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 form-group">
                                </div>
                                <div class="form-group"></div>

                            </div>
                            <div class="box-footer popuphide">
                                <?php if ($settings[0]['is_confirm'] == 1 && $view != 'view') { ?>
                                    <span style="margin-left: 20px;float:left" id="conf_set">
                                        <input type="checkbox" id="confirm" name="confirm" value="1"> I Confirm to save<br><br>
                                        <span style="margin-left: 20px">
                                            <button id="btnsavv" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds disab'>
                                                <i class="glyphicon glyphicon-hdd"></i>
                                            </button>
                                        </span>
                                    </span>
                                <?php } ?>
                                <span style="float: right;margin-right:50px;margin-top:10px;">
                                    <a class="btn btn-primary" id="next1" onclick="openTabs(event, 'godownTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                </span>
                            </div>
                        </div>

                        <?php
                        if ($is_godown != 0) {
                        ?>
                            <!-- Next Tab -->
                            <div class="tab-pane tab-content" id="godownTab_Item">
                                <div class="box-body">
                                    <div class="col-sm-12 form-group">
                                        <label class="col-sm-2 control-label">
                                            <?= label('Godown', $this, $user) ?> <span class="required"></span>:
                                        </label>
                                        <div class="col-sm-9">
                                            <table class="table no-border">
                                                <tbody id="rowg">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer popuphide">
                                    <?php
                                    if ($photo_enable != 0) {
                                    ?>
                                        <span style="float: right;margin-right:50px;margin-top:10px;">
                                            <a class="btn btn-primary" id="prev2" onclick="openTabs(event, 'main_Item')"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                            <a class="btn btn-primary" id="next3" onclick="openTabs(event, 'otherTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                        </span>
                                        <?php } else {
                                        if ($video_enable != 0) {
                                        ?>
                                            <span style="float: right;margin-right:50px;margin-top:10px;">
                                                <a class="btn btn-primary" id="prev2" onclick="openTabs(event, 'main_Item')"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                                <a class="btn btn-primary" id="next3" onclick="openTabs(event, 'othervideoTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                            </span>
                                        <?php } else { ?>
                                            <span style="float: right;margin-right:50px;margin-top:10px;">
                                                <a class="btn btn-primary" id="prev2" onclick="openTabs(event, 'main_Item')"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                                <a class="btn btn-primary" id="next3" onclick="openTabs(event, 'altTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                            </span>
                                    <?php }
                                    } ?>
                                </div>
                            </div>

                        <?php }
                        ?>
                        <?php
                        if ($alternate_item_set != 0) {
                        ?>
                            <div class="tab-pane tab-content" id="altTab_Item">
                                <div class="box-body">
                                    <div class="col-sm-12 form-group">
                                        <label class="col-sm-2 control-label">
                                            <?= label('Add Item', $this, $user) ?> <span class="required"></span>:
                                        </label>
                                        <div class="col-sm-9">
                                            <table class="table no-border">
                                                <tbody id="rowma">
                                                    <tr id="adda">
                                                        <td class="col-sm-9">
                                                            <input id="alt_item_name" placeholder="Name" class="form-control" name="alt_item_name" type="text">
                                                            <input id="alt_item_id" class="form-control" name="alt_item_id" type="hidden">
                                                        </td>
                                                        <td>
                                                            <a data-toggle="tooltip" style="float: left" title="Add More" id="addmore" class="btn btn-success" href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer popuphide">



                                    <?php if ($video_enable == 0) {
                                        if ($photo_enable == 0) {
                                    ?>
                                            <?php if ($settings[0]['is_makemodel'] != 0) { ?>
                                                <span style="float: right;margin-right:50px;margin-top:10px;">
                                                    <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'godownTab_Item')"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                                    <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'otherFieldTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                                </span>
                                            <?php } else { ?>
                                                <span style="float: right;margin-right:50px;margin-top:10px;">
                                                    <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'godownTab_Item')"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                                    <?php if ($view != 'view') { ?>
                                                        <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                            <i class="glyphicon glyphicon-hdd"></i>
                                                        </button>
                                                    <?php } ?>
                                                </span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if ($settings[0]['is_makemodel'] != 0) { ?>
                                                <span style="float: right;margin-right:50px;margin-top:10px;">
                                                    <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'otherTab_Item')"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                                    <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'otherFieldTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                                </span>
                                            <?php } else { ?>
                                                <span style="float: right;margin-right:50px;margin-top:10px;">
                                                    <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'otherTab_Item')"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                                    <?php if ($view != 'view') { ?>
                                                        <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                            <i class="glyphicon glyphicon-hdd"></i>
                                                        </button>
                                                    <?php } ?>
                                                </span>
                                            <?php } ?>

                                        <?php }
                                    } else if ($settings[0]['is_makemodel'] != 0) { ?>
                                        <span style="float: right;margin-right:50px;margin-top:10px;">
                                            <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'othervideoTab_Item')"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                            <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'otherFieldTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                        </span>
                                    <?php } else if ($settings[0]['is_makemodel'] == 0) { ?>
                                        <span style="float: right;margin-right:50px;margin-top:10px;">
                                            <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'othervideoTab_Item')"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                            <?php if ($view != 'view') { ?>
                                                <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                    <i class="glyphicon glyphicon-hdd"></i>
                                                </button>
                                            <?php } ?>
                                        </span>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if ($settings[0]['is_makemodel'] != 0) {
                        ?>
                            <div class="tab-pane tab-content" id="otherFieldTab_Item">
                                <div class="box-body">
                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 1', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField1" placeholder="Field 1" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 2', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField2" placeholder="Field 2" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 3', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField3" placeholder="Field 3" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 4', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField4" placeholder="Field 4" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 5', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField5" placeholder="Field 5" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 6', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField6" placeholder="Field 6" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 7', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField7" placeholder="Field 7" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 8', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField8" placeholder="Field 8" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 9', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField9" placeholder="Field 9" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-3 control-label">
                                            <?= label('Field 10', $this, $user) ?> <span class="required"></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="otherField10" placeholder="Field 10" class="form-control" name="otherField[]" type="text"><br>
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer popuphide">



                                    <span style="float: right;margin-right:50px;margin-top:10px;">
                                        <a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'altTab_Item')"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                        <?php if ($view != 'view') { ?>
                                            <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                <i class="glyphicon glyphicon-hdd"></i>
                                            </button>
                                        <?php } ?>
                                    </span>



                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- </div> -->
                    </div>


                </form>
                <!-- Next Tab -->
                <?php
                if ($photo_enable != 0) {
                ?>
                    <div class="tab-pane tab-content" id="otherTab_Item">
                        <form method="post" id="uploadss" enctype="multipart/form-data" class="form-horizontal">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="slim" data-label="Photo" data-post="actions,output">
                                                <input type="file" id="slims" name="slim[]" data-error="Please select a file" required />
                                            </div>
                                        </div>
                                        <!-- <span style="float : right">
                                            <a  id="upload_img" class="btn btn-primary">Upload <i class="fa fa-upload"></i></a>
                                        </span> -->
                                        <span style="float : right">
                                            <button type="button" id="upload_img" class="btn btn-primary">Upload <i class="fa fa-upload"></i></button>
                                        </span>

                                    </div>
                                    <div class="col-md-8 " style="height:250px;overflow-y:scroll">
                                        <h5 style="font-weight:bold">Uploaded Images</h5>
                                        <table class="table table-responsive table-condensed">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            <tbody class="listall">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>




                            </div>
                        </form>
                        <div class="box-footer popuphide">
                            <span style="float: right;margin-right:50px;margin-top:10px;">
                                <a class="btn btn-primary" onclick="openTabs(event, 'godownTab_Item')"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                <?php if ($video_enable != 0) { ?>
                                    <a class="btn btn-primary" onclick="openTabs(event, 'othervideoTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                <?php } else { ?>
                                    <a class="btn btn-primary" onclick="openTabs(event, 'altTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                                <?php } ?>
                            </span>
                        </div>

                    </div>
                <?php
                }
                ?>


                <!-- Next Tab -->
                <?php
                if ($video_enable != 0) {
                ?>
                    <div class="tab-pane tab-content" id="othervideoTab_Item">
                        <div class="box-body">
                            <form method="post" id="videoupload" enctype='multipart/form-data' class="form-horizontal">

                                <div class="col-sm-12 form-group">
                                    <div class="col-sm-6 form-group ">
                                        <label class="container">Browse from local
                                            <input type="radio" id="vid" checked="checked" name="radio" value="vid">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="container">Add a URL
                                            <input type="radio" id="url" name="radio" value="url">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-12 form-group browse">
                                    <label class="col-sm-2 control-label">
                                        <?= label('Video', $this, $user) ?><span class="required"></span> :
                                    </label>
                                    <div class="col-sm-6">
                                        <!-- <input type = "hidden" id="vide" name="vide" /> -->
                                        <input type="file" id="videos" name="videos" class="form-control">
                                    </div>
                                    <span class="text-center">
                                        <a class="btn btn-success addvideo" id="addvideo"><i class="fa fa-plus"></i></a>
                                    </span>
                                    <div class="text-center col-sm-8 responsive" style="margin-top: 20px;margin-left:9%">
                                        <table class=" table table-striped table-condensed ">
                                            <tr>
                                                <th style="text-align: center">S.NO</th>
                                                <th style="text-align: center">Video name</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                            <tbody class="listallvideos">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-sm-12 form-group url">
                                    <label class="col-sm-2 control-label">
                                        <?= label('Video URL', $this, $user) ?> <span class="required"></span> :
                                    </label>
                                    <div class="col-sm-6">
                                        <input style="text-transform:none" type="text" id="vid_url" name="vid_url" class="form-control" />

                                        <table class="table">
                                            <tr>
                                                <th> </th>
                                                <th> </th>
                                                <th> </th>
                                            </tr>
                                            <tbody class="url_more">

                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- <div class="" id="vidpreview">

                                    </div> -->
                                    <span class="text-center">
                                        <a class="btn btn-success addurl"><i class="fa fa-plus"></i></a>
                                        <button type="submit" id="upload_vid" class="btn btn-primary">Upload <i class="fa fa-upload"></i></button>
                                    </span>
                                </div>
                            </form>
                            <span style="float: right;margin-right:50px;margin-top:10px;">
                                <?php if ($photo_enable != 0) { ?>
                                    <a class="btn btn-primary" id="prev1" onclick="openTabs(event, 'otherTab_Item')"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                <?php } else { ?>
                                    <a class="btn btn-primary" id="prev1" onclick="openTabs(event, 'godownTab_Item')"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                <?php } ?>
                                <a class="btn btn-primary" id="next2" onclick="openTabs(event, 'altTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
                            </span>

                        </div>
                        <div class="box-footer popuphide">

                        </div>

                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</section>

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
    $("#item_category_name").autocomplete({
        source: "<?php echo site_url('Item/getallCat'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#item_category_id').val(ui.item.id);
            $('#item_category_name').val(ui.item.name);
        }
    });

    $(document).on('click', '.addurl', function() {

        var text = '';
        var urlss = $('#vid_url').val();
        $('#vid_url').val('');
        if (urlss != '') {
            // if ($("#ur").val() === undefined || $("#ur").val() === 'undefined') {
            //     text = text + '<tr><th> Preview </th><th> URL </th><th> Action </th></tr>';
            // }
            if (urlss.includes("https://youtu.be/")) {
                urlss = urlss.replace("https://youtu.be/", "https://www.youtube.com/embed/")
            } else {
                urlss = "https://www.youtube.com/embed/" + urlss;
            }
            text = text + '<tr><td><iframe id = "iframe" width="200" height="100" src="' + urlss + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td><td><input type = "hidden" name = "urls[]" id = "ur" value="' + urlss + '" /><span>' + urlss + '</span></td><td><span style = "color:red;float:right"><button class = "btn del" urlname = "' + urlss + '" ><span style = "margin-left:-4px"><i class = "fa fa-trash"></span></i></button></span></td></tr>';
            $('.url_more').append(text);
        }
    });


    $(document).on('click', '.del', function() {
        var url = $(this).attr('urlname');
        $(this).closest('tr').remove();
    });

    $('input[name=radio]').change(function() {
        var value = $('input[name=radio]:checked').val();
        if (value == 'vid') {
            $('.browse').show();
            $('.url').hide();
        } else {
            $('.url').show();
            $('.browse').hide();
        }
    });

    $(document).on('change', '#confirm', function() {
        if ($(this).prop('checked') == true) {
            $('#btnsavv').attr('disabled', false);
        } else {
            $('#btnsavv').attr('disabled', true);

        }
    });

    // $(document).on('click', '#upload_img', function(e){
    //     e.preventDefault();
    // });

    $(document).on('click', '#upload_vid', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('inventory_master/item/uploadvideo'); ?>',
            type: 'post',
            data: $('#videoupload').serialize() + '&ins_id=' + $('#ins_id').val(),
            success: function() {

            }
        });
    });

    $('#upload_img').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('inventory_master/item/upload'); ?>',
            type: 'post',
            data: $('#uploadss').serialize() + "&ins_id=" + $('#ins_id').val(),
            success: function() {
                listAllItems();
            }
        });
    });

    $('#name').keyup(function() {
        if ($('#name').val() != '') {
            $('#next1').attr("onclick", "openTabs(event, 'godownTab_Item')");
        } else {
            $('#next1').removeAttr('onclick');
        }
    });

    $(document).on('click', '#next1', function() {
        if ($('#name').val() == '') {
            toastr.info("Please add a Product Name");
        }
    });

    $(document).ready(function() {
        $('#exist').hide();

        $('#addvideo').click(function() {
            var videos = document.getElementById("videos").files[0];
            var ins_id = $('#ins_id').val();
            var form = document.getElementById('videoupload')
            var fd = new FormData(form);
            // fd = $('#videoupload').serialize();
            fd.append('videos', videos);
            fd.append('ins_id', ins_id);
            // console.log(videos);
            $.ajax({
                url: "<?php echo site_url('inventory_master/Item/uploadvideo') ?>",
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: fd,
                success: function(result) {
                    if (result == 1) {
                        listVideoItems();
                    }
                }
            })
        });

        if ($('#name').val() == '' && $('#ins_id').val() <= 0) {
            $('#next1').removeAttr('onclick');
        }
        // $('#next1').attr('disabled', 'disabled');
        $('.browse').show();
        $('.url').hide();
        openTabs(event, 'main_Item')
        var val = readCookie('filenames');
        if (val !== null && val !== '') {
            listAllItems();
        }

        $('#btnsavv').attr('disabled', true);
        var theText = "Goods";
        $("#itemtype option:contains(" + theText + ")").attr('selected', 'selected');
        $("#m_itemClick").bind("click", function() {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
        });
        $('#name').focus();
        taxes(0);
        var taxopen = $('select#tax_id option:selected').val();
        gettaxldg(taxopen);
        brands(0);
        size();
        material_types();
        hsn_code(0);
        item_category(0);
        item_group(0);
        unit(0);
        load();
        $("#online_item").prop("checked", true);
        var israck = $("#is_rack").val();
        if (israck !== 0) {
            racks(0);
            rows();
        }
        var id = $("#ins_id").val();
        if (id === '0') {
            getgodownlist();
        }
        $('#myModalPop_item_samoe').on('shown.bs.modal', function() {
            $('#name').focus();
        });
        $('#myModalPop_item_samoe').on('hidden.bs.modal', function() {
            var opt = $("#m_itemClick").attr('opt');
            if (opt === 'size') {
                size(1);
            }
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
                if (israck !== 0) {
                    racks(1);
                    rows();
                }
            }
            $('#is_model').val(0);
        });
        $(".myModalPop_item_samoe").click(function() {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function(result) {
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
        $('#addmore').click(function() {
            var id = $("#ins_id").val();
            var alt_item = $('#alt_item_name').attr('txt');
            var alt_itemid = document.getElementById('alt_item_id').value;
            if (alt_itemid !== "") {
                otheritem(id, alt_itemid, alt_item);
                $('#alt_item_name').val("");
                $('#alt_item_id').val("");
            }
        });
        $(document).on('click', ".remove", function() {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });

        $(".btnsaveds").click(function() {
            $(".btnsaveds").attr('disabled', 'disabled');
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
                $(".btnsaveds").removeAttr('disabled');
                toastr.info("Please add a Product Name");
                return;
            }
            var data = new FormData();
            var other_data = $(frm).serializeArray();
            $.each(other_data, function(key, input) {
                data.append(input.name, input.value);
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data, // send it here
                contentType: false, // this
                processData: false, // and this should be false in case of uploading files
                beforeSend: function(xhr) {},
                success: function(Onj) {
                    hidepage();
                    var wsQuery = JSON.parse(Onj);

                    if (is_model === '1') {
                        showpage();
                        $('#mcb').click();
                        return;
                    }

                    var back = $(frm).attr('back');
                    $.ajax({
                        url: back,
                        success: function(result) {
                            $("#div1").html(result);
                            issubmited = 0;
                        }
                    });
                    showpage();
                    toastr["success"](wsQuery.message);
                },
                error: function(data) {}
            });
        });

    });

    $(document).on('click', '#filez', function() {
        var file_name = $(this).attr('filename');
        preview(file_name);
    });
    $(document).on('click', '.delete_images', function() {
        var file = $(this).attr('img_id');
        deletes(file);
        $(this).closest('tr').remove();
    });

    function showpage() {
        setTimeout(function() {
            $(".cont").css("opacity", 1);
            $("#loading-img").css({
                "display": "none"
            });
        }, 1000);
    }

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
        if (gqty === null) {
            gqty = 0;
        }
        newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
            '<td ><input value="' + gqty + '"  type="text" name="gqty[' + idinc + ']"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
        $("#rowg").append(newrow);
    }
    var other_inc = 0;

    function otheritem(iid, alt_itemid, alt_item) {
        other_inc = other_inc + 1;
        newrow = '<tr><td><input  class="form-control"    value="' + alt_item + ' "type="text" disabled><input  value="' + alt_itemid + '"  type="text" name="alt_itemids[]"  class="hidden cre form-control"/></td>' +
            '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
        $("#rowma").append(newrow);
    }

    function godownlist(gid, name, gqty) {
        if (gqty === null) {
            gqty = 0;
        }
        if (gid === null) {
            gid = 0;
        }
        newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[' + idinc + ']" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
            '<td ><input value="' + gqty + '"  type="text" name="gqty[' + idinc + ']"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
        $("#rowg").append(newrow);
        idinc = idinc + 1;
    }
    var idinc = 0;

    function getgodownlist() {
        $.ajax({
            url: "<?php echo site_url('item/allgodown'); ?>",
            success: function(result) {
                $.each(JSON.parse(result), function(i, itemsingle) {
                    var godown_id = itemsingle.id;
                    var godown_name = itemsingle.godown_name;
                    var gqty = 0;
                    godownlist(itemsingle.id, itemsingle.godown_name, gqty);
                });
            }
        });
    }

    $('#name').keyup(function() {
        $('#exist').hide();
        $('#next1').removeClass('disabled');
        var typed = $('#name').val();
        var ins_id = $('#ins_id').val();

        $.ajax({
            url: "<?php echo site_url('Item/checkItemName') ?>",
            type: "POST",
            data: {
                "typed": typed,
                "itemorbar": "item"
            },
            success: function(result) {

                if (result !== null && result !== '' && result !== 'null') {
                    res = JSON.parse(result);
                    if (res.id != null) {
                        if (ins_id <= 0) {
                            $('#exist').show();
                            $('#next1').addClass('disabled');
                        }

                    } else {
                        $('#exist').hide();
                    }
                }
            }
        });

    });

    $("#alt_item_name").autocomplete({
        source: "<?php echo site_url('ajaxcall/itemssearch'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $("#alt_item_name").attr('txt', ui.item.name);
            loadaltItem(ui);
        }
    });
    $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });
    $("#alt_item_name").keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        if (key === 13 || key === 9) {
            var id = $("#ins_id").val();
            var alt_item = document.getElementById('alt_item_name').value;
            var alt_itemid = document.getElementById('alt_item_id').value;
            if (alt_itemid !== "") {
                otheritem(id, alt_itemid, alt_item);
                $('#alt_item_name').val("");
                $('#alt_item_id').val("");
            }
        }
    });

    function hsn_code(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/hsn_code'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
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

    function item_category(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
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

    function item_group(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_group'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
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

    function unit(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/unit'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
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

    function taxes(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/tax'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
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

    function racks(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/racks'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
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

    function rows(is_select) {
        var option = '';
        var row = $('#rack_id').find(':selected').attr('rows');
        var i = 0;
        for (i = 1; i <= row; i++) {
            option = option + '<option value ="' + i + '"> ' + i + '</option>';
        }
        $("#rrow").html(option);

    }

    function size(is_select) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/size'); ?>",
            success: function(result) {
                $('#item_size').html(result);

            }
        });
        if (is_select === 1) {
            var myVal = $('#brand_id option:last').val();
            $('#brand_id').val(myVal);
        }
    }

    function brands(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
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

    function openTabs(evt, tabName) {
        if (tabName == 'main_Item') {
            $('#main').attr('class', 'active');
            $('#other').attr('class', '');
            $('#video').attr('class', '');
            $('#otherfield').attr('class', '');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');

        }
        if (tabName == 'otherTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', 'active');
            $('#otherfield').attr('class', '');
            $('#video').attr('class', '');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');
        }
        if (tabName == 'otherFieldTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', '');
            $('#otherfield').attr('class', 'active');
            $('#video').attr('class', '');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');
        }
        if (tabName == 'othervideoTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', '');
            $('#otherfield').attr('class', '');
            $('#video').attr('class', 'active');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');
        }
        if (tabName == 'godownTab_Item') {
            var ins_id = $('#ins_id').val();
            if ($('#name').val() == '') {
                toastr.info("Please add a Product Name");
            } else {
                if (ins_id === "0" || ins_id === 0) {
                    $.ajax({
                        url: "<?php echo site_url('inventory_master/item/save') ?>",
                        type: "POST",
                        data: $("#frmcreatemodeli").serialize(),
                        success: function(results) {
                            var result = JSON.parse(results)
                            $('#ins_id').val(result.id)
                        }
                    });
                }
                $('#main').attr('class', '');
                $('#other').attr('class', '');
                $('#video').attr('class', '');
                $('#godown').attr('class', 'active');
                $('#alt').attr('class', '');
                $('#otherfield').attr('class', '');
            }
        }
        if (tabName == 'altTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', '');
            $('#video').attr('class', '');
            $('#godown').attr('class', '');
            $('#otherfield').attr('class', '');
            $('#alt').attr('class', 'active');
        }
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");

        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function listVideoItems() {
        textvideo = '';
        var item_id = $('#ins_id').val();
        var inc = 0;
        $.ajax({
            url: "<?php echo site_url('inventory_master/Item/allVideos/') ?>" + item_id,
            success: function(results) {
                if (results !== null) {
                    $.each(JSON.parse(results), function(i, items) {
                        inc++;
                        textvideo = textvideo + '<tr><td width = "20%">' + inc + '</td><td width = "25%"><video width="200" height="100" controls><source src="<?php echo site_url('uploads/video/item/') ?>' + items.iim_name + '" type="video/mp4"></video></td><td width = "20%"><button type = "button" style = "margin-top:20px" class = "btn delete_video" video_id = "' + items.iim_id + '"  filename = "' + items.iim_name + '" ><i class = "fa fa-trash"></i></button></span></td></tr>';
                    });
                    $('.listallvideos').html(textvideo);
                }
            }
        });
    }

    $(document).on('click', '.delete_video', function() {
        var file = $(this).attr('video_id');
        deletes(file);
        $(this).closest('tr').remove();
    });

    function listAllItems() {
        text = '';
        var item_id = $('#ins_id').val();
        var inc = 0;
        $.ajax({
            url: "<?php echo base_url() ?>inventory_master/Item/allImages/" + item_id,
            success: function(results) {
                if (results !== null) {
                    $.each(JSON.parse(results), function(i, items) {
                        inc++;
                        text = text + '<tr><td>' + inc + '</td><td><img src = "<?php echo base_url() ?>uploads/images/item/' + items.iim_name + '" alt = "" width = "100px" height = "70px" /></td><td><button type = "button" style = "margin-top:20px" class = "btn delete_images" img_id = "' + items.iim_id + '"  filename = "' + items.iim_name + '" ><i class = "fa fa-trash"></i></button></spa></td></tr>';
                    });
                    $('.listall').html(text);
                }
            }
        });
    }

    function listAllUrls() {
        texturl = '';
        var item_id = $('#ins_id').val();
        var inc = 0;
        $.ajax({
            url: "<?php echo base_url() ?>inventory_master/Item/allUrl/" + item_id,
            success: function(results) {
                if (results !== null) {
                    $.each(JSON.parse(results), function(i, items) {
                        inc++;
                        urlss = "https://www.youtube.com/embed/" + items.iim_name;
                        texturl = texturl + '<tr><td><iframe id = "iframe" width="200" height="100" src="' + urlss + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td><td><input type = "hidden" name = "urls[]" id = "ur" value="' + urlss + '" /><span>' + urlss + '</span></td><td><span style = "color:red;float:right"><button class = "btn del" urlname = "' + urlss + '" ><span style = "margin-left:-4px"><i class = "fa fa-trash"></span></i></button></span></td></tr>';
                    });
                    $('.url_more').html(texturl);
                }
            }
        });
    }

    function deletes(file) {

        $.ajax({
            url: "<?php echo site_url('inventory_master/Item/deleteImage') ?>/" + file,
            success: function(result) {

            }
        });
        listAllItems();
    }

    function material_types() {
        $.ajax({
            url: "<?php echo site_url('master/amaster/material_types'); ?>/",
            async: false,
            success: function(result) {
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
        var id = $("#ins_id").val();
        var is_autobarcode = $("#is_autobarcode").val();
        if (is_autobarcode === '1') {
            $("input:radio[name='manual'][value ='1']").prop('checked', true);
            $("#barcode").attr('readonly', true);
            if (id === '0') {
                $.ajax({
                    url: "<?php echo site_url('item/getbarcode'); ?>/",
                    async: false,
                    success: function(result) {
                        $("#barcode").val(result);
                        $("#def_barcode").val(result);
                    }
                });
            }
        }

        if (id > 0) {
            listAllItems();
            listVideoItems();
            listAllUrls();
            $.ajax({
                url: "<?php echo site_url('item/getsing'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    $("#name").val(result.name);
                    $("#brand_id").val(result.brand_id);
                    $("#name_lan").val(result.name_lan);
                    $("#def_barcode").val(result.barcode);
                    $("#barcode").val(result.barcode);
                    $('#item_size').val(result.item_size_id);
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
                    $("#pno").val(result.part_no);
                    $('#mmodel').val(result.make_model);
                    var i = 1
                    for (var i = 1; i <= 10; i++) {
                        $('#otherField' + i).val(result['field_' + i]);
                    }
                }
            });

            $.ajax({
                url: "<?php echo site_url('item/godownitem'); ?>/" + id,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
                        godownitem(itemsingle.item_id, itemsingle.godownid, itemsingle.godown_name, itemsingle.open_stock);
                    });
                }
            });
            $.ajax({
                url: "<?php echo site_url('item/otheritem'); ?>/" + id,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
                        otheritem(itemsingle.item_id, itemsingle.otherid, itemsingle.othername);
                    });
                }
            });
        }
    }

    $("#analytics_name").autocomplete({
        source: "<?php echo site_url('cost_analytics/analytics_centre/analyt_centres'); ?>",
        minLength: 1,
        select: function(event, ui) {
            loadanalyt(ui);

        }
    });
    $("#sales_tax").autocomplete({
        source: "<?php echo site_url('item/taxldg_find/saletax'); ?>",
        minLength: 1,
        select: function(event, ui) {
            $('#sales_tax').val(ui.item.name);
            $('#saletax_id').val(ui.item.id);
        }
    });
    $("#purc_ledger").autocomplete({
        source: "<?php echo site_url('item/taxldg_find/purtax'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#purc_ledger').val(ui.item.name);
            $('#purctax_id').val(ui.item.id);

        }
    });
    $("#tax_ledger").autocomplete({
        source: "<?php echo site_url('item/taxldg_find/tax'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#tax_ledger').val(ui.item.name);
            $('#taxldg_id').val(ui.item.id);

        }
    });



    function gettaxldg(taxxid, taxtype) {
        $.ajax({
            url: "<?php echo site_url('item/gettaxldg'); ?>/" + taxxid,
            async: false,
            success: function(results) {
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
    $("#tax_id").change(function() {
        var taxxid = $(this).val();
        //var tax_type = "tax";
        gettaxldg(taxxid);
    });
</script>
<script>
    $.validate({
        modules: 'security',
        onModulesLoaded: function() {}
    });
    $('#next1').click(function(e) {
        e.preventDefault();
        $('#myTab a[href="#otherTab_Item"]').tab('show');
    });
    $('#next2').click(function(e) {
        e.preventDefault();
        $('#myTab a[href="#godownTab_Item"]').tab('show');
    });
    $('#next3').click(function(e) {
        e.preventDefault();

        $('#myTab a[href="#altTab_Item"]').tab('show');
    });
    $('#prev1').click(function(e) {
        e.preventDefault();
        $('#myTab a[href="#main_Item"]').tab('show');
    });
    $('#prev2').click(function(e) {
        e.preventDefault();
        $('#myTab a[href="#otherTab_Item"]').tab('show');
    });
    $('#prev3').click(function(e) {
        e.preventDefault();

        $('#myTab a[href="#godownTab_Item"]').tab('show');
    });
</script>