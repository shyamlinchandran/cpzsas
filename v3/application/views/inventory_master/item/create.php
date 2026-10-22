<?php

$purchase_tax_on_mrp = 0 ;
if(isset($settings[0]['purchase_tax_on_mrp'])){
    $purchase_tax_on_mrp = $settings[0]['purchase_tax_on_mrp'];
}


$is_cigarette_cess = 0 ;
if(isset($settings[0]['is_cigarette_cess']) ){
    $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
}
$lcode = 0;
if(isset($settings[0]['lcode']) ){
	$lcode = $settings[0]['lcode'];

}
$batch_barcode = 0;
if(isset($settings[0]['batch_barcode']) ){
	$batch_barcode = $settings[0]['batch_barcode'];
}

$Is_SQFT = 0 ;
$cls_sqft = '';
if(isset($settings[0]['Is_SQFT']) ){
	$Is_SQFT = $settings[0]['Is_SQFT'];

}


$price_margin = 0 ;
if(isset($settings[0]['price_margin']) ){
	$price_margin = $settings[0]['price_margin'];

}


$category_barcode = 0 ;
if(isset($settings[0]['category_barcode'])){
    $category_barcode = $settings[0]['category_barcode'];
}


$is_supplier = 0;
if(isset($settings[0]['is_supplier']) ){
	$is_supplier = $settings[0]['is_supplier'];

}


$quantity_price = 0 ;
if(isset($settings[0]['quantity_price']) ){
	$quantity_price = $settings[0]['quantity_price'];

}


$additional_cess = 1;
if(isset($settings[0]['additional_cess']) ){
	$additional_cess = $settings[0]['additional_cess'];
}
$is_part_no = 0;
if(isset($settings[0]['is_part_no']) ){
	$is_part_no = $settings[0]['is_part_no'];

}

$is_feature =0;
$item_brand = 1;
if(isset($settings[0]['item_brand'])){
	$item_brand = $settings[0]['item_brand'];
}
if(isset($settings[0]['is_feature'])){
	$is_feature = $settings[0]['is_feature'];
}
$item_category = 1;
if(isset($settings[0]['item_category'])){
	$item_category = $settings[0]['item_category'];
}
$item_discount = 1;
if(isset($settings[0]['item_discount'])){
	$item_discount = $settings[0]['item_discount'];
}
$ecommerce = 0;
if(isset($settings[0]['e-commerce'])){
	$ecommerce = $settings[0]['e-commerce'];
}
$warranty_period = 0;
if(isset($settings[0]['warranty_period'])){
	$warranty_period = $settings[0]['warranty_period'];
}
$is_size = $settings[0]['is_size'];
$is_godown = $settings[0]['is_godown'];
$is_rack = $settings[0]['item_rack'];
$is_com = $settings[0]['item_commission'];
$is_rate = $settings[0]['item_min_rate'];
$is_production = $settings[0]['is_production'];
$is_analytics = $settings[0]['is_analytics'];
$isbatch = $settings[0]['is_batch'];
$ismultipletax = $settings[0]['is_multipletax'];
$show_tax_ledger = 1;
if(isset($settings[0]['show_tax_ledger'])){
	$show_tax_ledger = $settings[0]['show_tax_ledger'];
}
$is_multipleunit = $settings[0]['is_unit'];
$taxtype = $settings[0]['com_tax_type'];
$is_autobarcode = $settings[0]['is_autobarcode'];
$photo_enable = $settings[0]['item_image'];
$video_enable = $settings[0]['item_video'];
$alternate_item_set = $settings[0]['item_alternate'];
$item_advanced = $settings[0]['item_advanced'];
$is_item_type = $settings[0]['is_item_type'];
$user = $this->session->userdata('user');
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
	.sma{
        width: 80px !important;
    }
	.smag{
        min-width: 120px !important;
    }
</style>

    

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/slim/slim.min.css">
<script src="<?php echo base_url(); ?>assets/slim/slim.kickstart.min.js"></script>
<section class="content">
<div class="row">
    <div class="col-xs-12">
        <div class="<?=$this->box_color?>">
            <div class="box-header with-border">
                <h3 class="box-title"><?= label('Create Item', $this, $user) ?></h3>
                <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('inventory_master/Item/listall'); ?>">
                        <span class="remove glyphicon glyphicon-arrow-left" title="back"></span>
                    </a>
                </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" id="frmcreatemodeli" enctype="multipart/form-data" back="<?php echo site_url('inventory_master/item/create'); ?>" action="<?php echo site_url('inventory_master/item/save'); ?>" class="form-horizontal frmcreate">
					<input type="hidden" name="user_type" id="user_type" value="<?php echo $user['user_type'];?>" >
				   <input type="hidden" value="<?php echo $additional_cess; ?>" id="additional_cess" name="additional_cess" />
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
                    <input type="hidden" value="<?php echo $is_cigarette_cess; ?>" id="is_cigarette_cess" name="is_cigarette_cess" />
                    <input type="hidden" value="<?php echo $purchase_tax_on_mrp; ?>" id="purchase_tax_on_mrp" name="purchase_tax_on_mrp" />
                    <input type="hidden" value="<?php echo $isbatch; ?>" id="isbatch" name="isbatch" />
                    <input type="hidden" value="<?php echo $is_autobarcode; ?>" id="is_autobarcode" name="is_autobarcode" />
                    <input type="hidden" value="<?php echo $video_enable; ?>" id="video_enable" name="video_enable" />
                    <input type="hidden" value="<?php echo $alternate_item_set; ?>" id="alternate_item_set" name="alternate_item_set" />
                    <input type="hidden" id="is_model" />
                    <input type="hidden" id="def_barcode" value="" />
                    <input type="hidden" value="<?= $id ?>" id="ins_id" name="ins_id" />
                    <input type="hidden" value="<?= $id ?>" id="insert_id" name="insert_id" />
                    <div class="">
                        <div class="">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li id="main" class="active">
                                    <a class="tablinks active" data-toggle="tab" title="welcome">
                                        Item Details
                                    </a></li>
								<?php
                                if ($is_godown != 0 || $isbatch !=0) {
                                ?>
									<li id="godown"><a class="tablinks" style="text-decoration: none" data-toggle="tab" title="bootsnipp goodies">
											Item Stock </a>
									</li>
								 <?php } ?>
								 
									<?php
										if ($price_margin != 0) {
										?>
											<li id="price_margin"><a class="tablinks" data-toggle="tab" title="profile">
												Price Margin
											</a>
										</li>
									<?php } ?>
									
									<?php
										if ($quantity_price != 0) {
										?>
											<li id="quantity_price"><a class="tablinks" data-toggle="tab" title="profile">
												Quantity Wise Price
											</a>
										</li>
									<?php } ?>

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
								<?php
                                if ($is_feature != 0) {
                                ?>
                                    <li id="feature"><a class="tablinks" data-toggle="tab" title="profile">
                                            Features
                                        </a>
                                    </li>
                                <?php } ?>
								<?php
                                if ($alternate_item_set != 0) {
                                ?>
									<li id="alt"><a data-toggle="tab" title="blah blah" class="tablinks">
                                        Alternate Item
                                    </a></li>
								<?php } ?>
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

                                <?php if($category_barcode < 1  ){?>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Bar Code', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <?php if ($is_autobarcode == 1) { ?>
                                                <input type="radio" name="manual" id="manual" value="1" onchange="setbarcode()"><?= label('Auto Barcode', $this, $user) ?>
                                                <input type="radio" name="manual" onchange="setbarcode()" id="manual" value="0"><?= label('Manual', $this, $user) ?>
                                            <?php } ?>
                                            <input id="barcode" class="form-control" name="barcode" type="text" value="" maxlength="500" data-validation="required server" data-validation-url="<?php echo site_url('inventory_master/Item/check_barcode/') . $id ?>">
                                        </div>
                                    </div>
                                <?php }else{?>
                                    <input type = "hidden" name ="barcode" id ="barcode" > 
                                    <input type = "hidden" name ="catbarcode" id ="catbarcode" > 

                                <?php }?>

                                </div>
                                

                                <?php if((int) $Is_SQFT > 0 ){?>
								 <div  class="col-sm-12">
										<div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Dimensions', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-4">
                                                <input id="sqft_ht" class="form-control sqft" name="sqft_ht" type="number" value="" step="any">
                                            </div>
                                            <div class="col-sm-4">
                                                <input id="sqft_wt" class="form-control sqft" name="sqft_wt" type="number" value="" step="any">
                                            </div>
                                        </div>
										<div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('SQFT', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="sqft" class="form-control " name="sqft" type="text" value="" readonly>
                                            </div>
                                        </div>
								 </div>
								<?php } ?>

                                
                                
								<?php if((int) $is_part_no > 0 ){?>
								 <div  class="col-sm-12">
										<div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Part No 1', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="pno1" class="form-control " name="pno1" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
										<div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Part No 2', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="pno2" class="form-control " name="pno2" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
								 </div>
								<?php } ?>
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
                                    <div <?php if((int) $item_brand < 1 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group odd_cls">
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
											 <input type="hidden" id="hsn_id" name="hsn_id" class="form-control" />
                                            <input noTab = "true" type="text" id="hsn_name" name="hsn_name" class="form-control" />
                                           


                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                   <!-- <div class="col-sm-6 form-group odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Price code', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="price_code" class="form-control" name="price_code" type="text" value="" maxlength="50">
                                        </div>
                                    </div>-->
                                    <div <?php if((int) $ecommerce < 1 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">

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
                                    <div <?php if((int) $item_category < 1 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Item Category', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <input type="hidden" id="item_category_id" name="item_category_id" class="form-control" />
                                            <input noTab = "true" type="text" id="item_category_name" name="item_category_name" class="form-control" />


                                        </div>
                                    </div>
                                    <div <?php if((int) $item_discount < 1 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">

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
									<?php if ($is_multipleunit == 1) { ?>
										 <div class="col-sm-6 form-group  odd_cls">
											<label class="col-sm-4 control-label">
												<?= label('Sub Unit 1', $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">

												<select name="sub_unit_one" id="sub_unit_one" class="form-control" >
													<option value="">Select</option>
												</select>
											</div>
										</div>
										 <div class="col-sm-6 form-group  odd_cls">
											<label class="col-sm-4 control-label">
												<?= label('Sub Unit 2', $this, $user) ?> *<span class="required"></span> :
											</label>
											<div class="col-sm-8">

												<select name="sub_unit_two" id="sub_unit_two" class="form-control" >
													<option value="">Select</option>
												</select>
											</div>
										</div>
									<?php } ?>
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
                                      <?php if($is_cigarette_cess > 0 ){?>
                                            <div class="col-sm-12" >
										        <div class="col-sm-6 form-group  odd_cls">
                                                    <label class="col-sm-4 control-label">
                                                        <?= label('CigaretteCess Amount', $this, $user) ?> *<span class="required"></span> :
                                                    </label>
                                                    <div class="col-sm-8">

                                                        <input type="text" class="form-control two-digits" id="cigarette_cess_amount" name="cigarette_cess_amount"/>


                                                    </div>
                                                </div>
										        <div class="col-sm-6 form-group  odd_cls">
                                                    <label class="col-sm-4 control-label">
                                                        <?= label('CigaretteCess Percent', $this, $user) ?> *<span class="required"></span> :
                                                    </label>
                                                    <div class="col-sm-8">

                                                        <input type="text" class="form-control two-digits" id="cigarette_cess_percentage" name="cigarette_cess_percentage"/>


                                                    </div>
                                                </div>
									        </div>

                                    <?php }?>

									<?php if( $additional_cess >0){?>
										 <div class="col-sm-6 form-group ">
											<label class="col-sm-4 control-label">
												<?= label('Cess', $this, $user) ?> <span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<select name="item_cess" id="item_cess" class="form-control" data-validation="required">
													<option value="">Select</option>
												</select>
											</div>
										</div>
									<?php }?>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('GST', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">

                                            <select name="tax_id" id="tax_id" class="form-control" data-validation="required">
                                                <option value="">Select</option>
                                            </select>


                                        </div>
                                    </div>


                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Pak.Date', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input name="package_date" id="package_date" class="form-control date" >
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Net Weight', $this, $user) ?><span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input name="net_weight" id="net_weight" class="form-control " >
                                        </div>
                                    </div>

                                </div>

                                <div <?php
                                        if ($show_tax_ledger != 1) {
                                        ?> style="display: none;" <?php } ?>class="col-sm-12 ">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('GST Ledger', $this, $user) ?><span class="required"></span> :
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
                                        if ($show_tax_ledger != 1) {
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
                                   

                                </div>

								<?php if($isbatch !=1 && (float) $price_margin < 1 ){?>
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
								<?php }?>
								<?php if( $price_margin < 1 ){?>
                               <div class="col-sm-12">
                                <?php
                                if ($is_com != 0 || $is_rate != 0) {
                                ?>
                                        <?php
                                        if ($is_com != 0) {
                                        ?>
                                            
                                        <?php } ?>
                                        <?php
                                        if ($is_rate != 0 && $isbatch !=1) {
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
										
                                <?php } ?>
								
								 <div class="col-sm-6 form-group">
                                      <label class="col-sm-4 control-label">
                                          <?= label('Special Rate', $this, $user) ?> <span></span> :
                                      </label>
                                      <div class="col-sm-8">
                                          <input id="special_rate" class="form-control two-digits price" name="special_rate" type="text" value="" maxlength="50">
                                     </div>
                                 </div>
								 <div class="col-sm-6 form-group">
                                      <label class="col-sm-4 control-label">
                                          <?= label('Landing Cost', $this, $user) ?> <span></span> :
                                      </label>
                                      <div class="col-sm-8">
                                          <input id="landing_cost" class="form-control two-digits price" name="landing_cost" type="text" value="" maxlength="50">
                                     </div>
                                 </div>
                                  <?php if($lcode > 0 ){?>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('L Code', $this, $user) ?> <span></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="lcode" class="form-control  " name="lcode" type="text" value="" maxlength="50">
                                            </div>
                                        </div>
                                    <?php }?>
                                  </div>
								  <?php }?>
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
                                if ($isbatch != 0 || $login_comid == 'bakenjoy' || $login_comid == 'aditi' || $login_comid == 'mjs' || $login_comid == 'svt' || $login_comid == 'SVT'  || strtolower($login_comid) == 'asrfoods' || strtolower($login_comid) == 'krtraders'  || strtolower($login_comid) == 'everest' || strtolower($login_comid) === 'msa' || strtolower($this->session->userdata('login_base_comid')) =='mrlk'    ) {
                                ?>
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Man. Date', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input name="mfgdate" type="text" id="mfgdate"   class="form-control  date" placeholder="Date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Expiry Date', $this, $user) ?> <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input name="expdate" type="text" id="expdate"   class="form-control  date_expiry" placeholder="Date">
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
									 <?php
										 if ($is_supplier != 0) {
                                    ?>
									
										<div class="col-sm-6 form-group  odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Supplier', $this, $user) ?> <span></span> :
                                            </label>
                                            <div class="col-sm-8">
													<input type="hidden" name="supid" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"      class="form-control" placeholder="<?= label('Supplier', $this, $user) ?>">                                            </div>
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
                                        <?php if(strtolower($login_comid) == 'omgold' ){?>
                                            <div class="col-sm-6 form-group  odd_cls">
                                                <label class="col-sm-4 control-label"> <?= label('Open Stock Wt', $this, $user) ?> <span class="required"></span>
                                                    :
                                                </label>
                                                <div class="col-sm-8">

                                                    <input id="open_stock_wt" class="form-control two-digits price" name="open_stock_wt" type="text" value="" maxlength="50">
                                                </div>
                                            </div>
                                        <?php }?>


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

                                        <?php if($purchase_tax_on_mrp == 1){?>
                                            <div class="col-sm-6 form-group  odd_cls">
                                                <label class="col-sm-4 control-label">
                                                    <?= label('Tax on Mrp', $this, $user) ?> <span class="required"></span> :
                                                </label>
                                                <div class="col-sm-8">

                                                    <select id="tax_on_mrp" class="form-control" name="tax_on_mrp"  >
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    <select>
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

                                      <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('IS Active', $this, $user) ?> <span></span> :
                                        </label>
                                        <div class="col-sm-8">
                                           <select name ="is_active" id = "is_active"  class ="form-control">
                                                <option value = "1">Active</option>
                                                <option value = "0">Inactive</option>
                                           </select> 
                                        </div>
                                    </div>

                                    <div <?php if((int) $warranty_period < 1 ){ echo 'style="display:none"';}?> class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Warranty Period(in Months)', $this, $user) ?> <span></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="war_period" type="text" class="form-control" name="war_period"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 form-group">
                                </div>
                                <div class="form-group"></div>

                            </div>
                            <div class="box-footer popuphide">
                                 <!-- Next Tab<?php if ($settings[0]['is_confirm'] == 1 && $view != 'view') { ?> -->
                                    <span style="margin-left: 20px;float:left" id="conf_set">
                                       <!--   <input type="checkbox" id="confirm" name="confirm" value="1"> I Confirm to save<br><br>-->
                                        
                                    </span>
                                <!--  <?php } ?> -->
								<span style="margin-left: 20px">
                                            <button id="btnsavv" type='button' data-toggle="tooltip" title='Save' class='form-button-save btn bg-orange btn-flat btnsaveds '>
                                                <i class="glyphicon glyphicon-hdd"></i>
                                            </button>
                                </span>
                                <?php if ($is_godown !=0 || $photo_enable !=0 ||  $video_enable !=0 || $alternate_item_set !=0 || $settings[0]['is_makemodel'] !=0 || $price_margin !=0 || $quantity_price !=0 ) { ?>
									<?php $next3 ='';if($is_godown !=0 || $isbatch !=0){$next3 = "'godownTab_Item'";}else if($price_margin !=0){$next3 = "'Tab_Price_margin'";}else if($quantity_price !=0){$next3 = "'Tab_Quantity_price'";}else if($photo_enable !=0){$next3 = "'otherTab_Item'";}else if($video_enable!=0){$next3 = "'othervideoTab_Item'";}else if($is_feature !=0){$next3 ="'featureTab_Item'";}else if($alternate_item_set!=0){$next3 = "'altTab_Item'";} else if($settings[0]['is_makemodel']!=0){$next3 ="'otherFieldTab_Item'";}?>
									<span style="float: right;margin-right:50px;margin-top:10px;">
										<a class="btn btn-primary"   id="" onclick="openTabs(event, <?php echo $next3;?>)">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
									</span>
								 <?php } ?>
                            </div>
                        </div>

                        <?php
                        if ($is_godown != 0 || $isbatch !=0) {
                        ?>
                            <!-- Next Tab -->
                            <div class="tab-pane tab-content" id="godownTab_Item">
                                <div class="box-body">
                                    <div class="col-sm-12 form-group">
                                        <label class="col-sm-1 control-label">
                                            <?= label('Godown', $this, $user) ?> <span class="required"></span>:
                                        </label>
                                        <div class="col-sm-11">
                                            <table class="table no-border">
                                                <tbody id="rowg">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer popuphide">
									<?php $next3 ='';if($price_margin !=0){$next3 = "'Tab_Price_margin'";}else if($quantity_price !=0){$next3 = "'Tab_Quantity_price'";}else if($photo_enable !=0){$next3 = "'otherTab_Item'";}else if($video_enable!=0){$next3 = "'othervideoTab_Item'";}else if($is_feature !=0){$next3 ="'featureTab_Item'";}else if($alternate_item_set!=0){$next3 = "'altTab_Item'";} else if($settings[0]['is_makemodel']!=0){$next3 ="'otherFieldTab_Item'";}?>
                                   <span style="float: right;margin-right:50px;margin-top:10px;">
                                            <a class="btn btn-primary" id="prev2" onclick="openTabs(event, 'main_Item')"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
											<?php if($next3!=''){?>
												<a class="btn btn-primary" id="next3" onclick="openTabs(event, <?php echo $next3; ?>)">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
											<?php }else{ ?>
											<?php if ($view != 'view') { ?>
                                                <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                    <i class="glyphicon glyphicon-hdd"></i>
                                                </button>
                                            <?php } ?>
										<?php } ?>
									</span>
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
                                                            <button type="button" data-toggle="tooltip" style="float: left" title="Add More" id="addmore" class="btn btn-success alternate"> <span class=" glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer popuphide">

									<?php $pre = "'main_Item'";  if($is_feature !=0){$pre ="'featureTab_Item'";}else if($video_enable !=0){$pre ="'othervideoTab_Item'";} else if($photo_enable !=0){$pre = "'otherTab_Item'";}else if($quantity_price !=0){$pre = "'Tab_Quantity_price'";}else if($price_margin !=0){$pre = "'Tab_Price_margin'";} else if($is_godown !=0){$pre ="'godownTab_Item'";} $next ='';  if($settings[0]['is_makemodel']!=0){$next ="'otherFieldTab_Item'";}?>
									<span style="float: right;margin-right:50px;margin-top:10px;">
                                        <a class="btn btn-primary" id="prev3" onclick="openTabs(event, <?php echo $pre; ?> )"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
                                       <?php if($next !=''){ ?>
											<a class="btn btn-primary" id="prev3" onclick="openTabs(event, 'otherFieldTab_Item')">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
										<?php }else{ ?>
											<?php if ($view != 'view') { ?>
                                                <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                    <i class="glyphicon glyphicon-hdd"></i>
                                                </button>
                                            <?php } ?>
										<?php } ?>
								   </span>


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
									<?php $pre = "'main_Item'"; if($alternate_item_set !=0){$pre ="'altTab_Item'";}else if($is_feature !=0){$pre ="'featureTab_Item'";} else if($video_enable !=0){$pre ="'othervideoTab_Item'";} else if($photo_enable !=0){$pre = "'otherTab_Item'";}else if($quantity_price !=0){$pre = "'Tab_Quantity_price'";}else if($price_margin !=0){$pre = "'Tab_Price_margin'";} else if($is_godown !=0 || $isbatch !=0){$pre ="'godownTab_Item'";} $next ='';  if($settings[0]['is_makemodel']!=0){$next ="'otherFieldTab_Item'";}?>
                                    <span style="float: right;margin-right:50px;margin-top:10px;">
                                        <a class="btn btn-primary" id="prev3" onclick="openTabs(event,<?php echo $pre; ?>)"><i class="glyphicon glyphicon-chevron-left"></i> Prev</a>
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
						
						
						 <?php
                        if ($price_margin != 0) {
                        ?>
                            <div class="tab-pane tab-content" id="Tab_Price_margin">
                                <div class="box-body">
                                   <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Stock Rate', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="prate" class="form-control two-digits price marginrates" name="prate" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('MRP', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="MRP" class="form-control two-digits price marginrates" name="MRP" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 form-group  odd_cls">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Sales Rate', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="srate" class="form-control two-digits price marginrates" name="srate" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label">
                                            <?= label('Opening Stock Rate', $this, $user) ?> <span class="required"></span> :
                                        </label>
                                        <div class="col-sm-8">
                                            <input id="open_stk_rate" class="form-control two-digits price " name="open_stk_rate" type="text" value="" maxlength="50">
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-sm-12">
                                <?php
                                if ($is_com != 0 || $is_rate != 0) {
                                ?>
                                        <?php
                                        if ($is_com != 0) {
                                        ?>
                                            
                                        <?php } ?>
                                        <?php
                                        if ($is_rate != 0 && $isbatch !=1) {
                                        ?>
                                            <div class="col-sm-6 form-group">
                                                <label class="col-sm-4 control-label">
                                                    <?= label('Wh Rate', $this, $user) ?> <span></span> :
                                                </label>
                                                <div class="col-sm-8">
                                                    <input id="wholerate" class="form-control two-digits price marginrates" name="wholerate" type="text" value="" maxlength="50">
                                                </div>
                                            </div>
                                        <?php } ?>
										
                                <?php } ?>
								
								 <div class="col-sm-6 form-group">
                                      <label class="col-sm-4 control-label">
                                          <?= label('Special Rate', $this, $user) ?> <span></span> :
                                      </label>
                                      <div class="col-sm-8">
                                          <input id="special_rate" class="form-control two-digits price marginrates" name="special_rate" type="text" value="" maxlength="50">
                                     </div>
                                 </div>
								 <div class="col-sm-6 form-group">
                                      <label class="col-sm-4 control-label">
                                          <?= label('Landing Cost', $this, $user) ?> <span></span> :
                                      </label>
                                      <div class="col-sm-8">
                                          <input id="landing_cost" class="form-control two-digits price marginrates" name="landing_cost" type="text" value="" maxlength="50">
                                     </div>
                                 </div>


                                 
                                  </div>
								  <div class="col-sm-12">
									<table class="table table-responsive" style ="width:100%" border="2" cellpadding="0" cellspacing="0">
										<tr>
											<th colspan="5" style="text-align:center" >Prate Margin</th>
										</tr>
										<tr>
											<td style ="width:20%;"></td>
											<td style ="width:20%;" >Rate </td>
											<td style ="width:20%;" >Prate</td>
											<td style ="width:20%;">Margin</td>
											<td style ="width:20%;">Margin %</td>
										</tr>
										<tr>
											<td>Srate</td>
											<td class ="margin_srate" > </td>
											<td  class="cls_prate"></td>
											<td id ="prate_margin_salerate"></td>
											<td id ="percentage_margin_salerate"></td>
										</tr>
										<tr>
											<td >MRP</td>
											<td class ="margin_mrp"> </td>
											<td class="cls_prate"></td>
											<td id ="prate_margin_mrp"></td>
											<td id ="percentage_margin_mrp"></td>
										</tr>
										<tr>
											<td >Whrate</td>
											<td class ="margin_whrate"> </td>
											<td class="cls_prate"></td>
											<td id ="prate_margin_wharte"></td>
											<td id ="percentage_margin_wharte"></td>
										</tr>
										<tr>
											<td >Special Rate</td>
											<td class ="margin_special_rate"> </td>
											<td class="cls_prate"></td>
											<td id ="prate_margin_special_rate"></td>
											<td id ="percentage_margin_special_rate"></td>
										</tr>
										<tr>
											<th  colspan="5" style="text-align:center" >Landing Cost Margin</th>
										</tr>
										<tr>
											<td></td>
											<td>Rate </td>
											<td>Landing Cost</td>
											<td>Margin</td>
											<td>Margin %</td>
										</tr>
										<tr>
											<td>Srate</td>
											<td class ="margin_srate" > </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_salerate"></td>
											<td id ="lcp_margin_salerate"></td>
										</tr>
										<tr>
											<td >MRP</td>
											<td class ="margin_mrp"> </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_mrp"></td>
											<td id ="lcp_margin_mrp"></td>
										</tr>
										<tr>
											<td >Whrate</td>
											<td class ="margin_whrate"> </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_wharte"></td>
											<td id ="lcp_margin_wharte"></td>
										</tr>
										<tr>
											<td >Special Rate</td>
											<td class ="margin_special_rate"> </td>
											<td  class="cls_lcrate"></td>
											<td id ="lc_margin_special_rate"></td>
											<td id ="lcp_margin_special_rate"></td>
										</tr>
									</table>
								  </div>

                                </div>
                                <div class="box-footer popuphide">
									<?php
										
									$pre = "'main_Item'"; if($is_godown !=0 || $isbatch !=0){$pre ="'godownTab_Item'";}	
									$next3 ='';if($quantity_price !=0){$next3 = "'Tab_Quantity_price'";}else if($photo_enable !=0){$next3 = "'otherTab_Item'";}else if($video_enable!=0){$next3 = "'othervideoTab_Item'";}else if($is_feature !=0){$next3 ="'featureTab_Item'";}else if($alternate_item_set!=0){$next3 = "'altTab_Item'";} else if($settings[0]['is_makemodel']!=0){$next3 ="'otherFieldTab_Item'";}?>
                                   <span style="float: right;margin-right:50px;margin-top:10px;">
                                            <a class="btn btn-primary" id="prev2" onclick="openTabs(event, <?php echo $pre; ?>)"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
											<?php if($next3!=''){?>
												<a class="btn btn-primary" id="next3" onclick="openTabs(event, <?php echo $next3; ?>)">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
											<?php }else{ ?>
											<?php if ($view != 'view') { ?>
                                                <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                    <i class="glyphicon glyphicon-hdd"></i>
                                                </button>
                                            <?php } ?>
										<?php } ?>
									</span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
						
						 <?php
                        if ($quantity_price != 0) {
                        ?>
                            <div class="tab-pane tab-content" id="Tab_Quantity_price">
                                <div class="box-body">
                                   <div class = "col-sm-12">
										<div class = "col-sm-3">
											<div class = "col-sm-12">
												Select Type <br />
												<select id = "sel_quantity_price" name = "sel_quantity_price" class = "form-control">
													<option value="">Select Type</option>
													<option value="above">Above</option>
													<option value="below">Below</option>
													<option value="between">Between</option>
												</select>
											</div>
										</div>
										<div style ="display:none" id="div_above"  class = "clsqtyprice col-sm-8">
											<div class = "col-sm-4">
												Above <br />
												<input type ="number" name ="quantity_price_above" id="quantity_price_above"/>
												
											</div>
											<div class = "col-sm-4">
												Rate <br />
												<input type ="number" name ="quantity_price_above_value" id="quantity_price_above_value"/>
												
											</div>
										</div>
										<div style ="display:none" id="div_below" class = " clsqtyprice col-sm-8">
										
											<div class = "col-sm-4">
												Below <br />
												<input type ="number" name ="quantity_price_below" id="quantity_price_below"/>
											</div>
											<div class = "col-sm-4">
												Rate <br />
												<input type ="number" name ="quantity_price_below_value" id="quantity_price_below_value"/>
											</div>
										</div>
										<div style ="display:none" id="div_between" class = " clsqtyprice col-sm-8">
											<div class = "col-sm-4">
												From <br />
												<input type ="number" name ="quantity_price_min" id="quantity_price_min"/>
											</div>
											<div class = "col-sm-4">
											To <br/>
												<input type ="number" name ="quantity_price_max" id="quantity_price_max"/>
											</div>
											<div class = "col-sm-4">
											Rate <br/>
												<input type ="number" name ="quantity_price_rate" id="quantity_price_rate"/>
											</div>
										</div>
								   </div>

                                </div>
                                <div class="box-footer popuphide">
									<?php 
										$pre = "'main_Item'"; if($price_margin !=0){$pre = "'Tab_Price_margin'";} else if($is_godown !=0 || $isbatch !=0){$pre ="'godownTab_Item'";}	
										$next3 =''; if($photo_enable !=0){$next3 = "'otherTab_Item'";}else if($video_enable!=0){$next3 = "'othervideoTab_Item'";}else if($is_feature !=0){$next3 ="'featureTab_Item'";}else if($alternate_item_set!=0){$next3 = "'altTab_Item'";} else if($settings[0]['is_makemodel']!=0){$next3 ="'otherFieldTab_Item'";}?>
                                   <span style="float: right;margin-right:50px;margin-top:10px;">
                                            <a class="btn btn-primary" id="prev2" onclick="openTabs(event, <?php echo $pre; ?>)"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
											<?php if($next3!=''){?>
												<a class="btn btn-primary" id="next3" onclick="openTabs(event, <?php echo $next3; ?>)">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
											<?php }else{ ?>
											<?php if ($view != 'view') { ?>
                                                <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                    <i class="glyphicon glyphicon-hdd"></i>
                                                </button>
                                            <?php } ?>
										<?php } ?>
									</span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
						
						<?php
                        if ($is_feature != 0) {
                        ?>
                            <div class="tab-pane tab-content" id="featureTab_Item">
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
										<?php if(isset($itemtypemaster[0]['name'])){
												foreach($itemtypemaster as $item){?>
											<div  class="panel box box-primary divcollapse divcollapse<?php echo $item['id'];?>">
												<div class="box-header with-border">
													<h4 class="box-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $item['id'];?>" aria-expanded="false" class="collapsed">
															<?php echo $item['name'];?>
														</a>
													</h4>
												</div>
												<div id="collapse<?php echo $item['id'];?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
													<div id="collapsefeature<?php echo $item['id'];?>" class="box-body collapsefeature">
													</div>
												</div>
											</div>
										<?php }}?>
									</div>
                                </div>
                                <div class="box-footer popuphide">
                                    <span style="float: right;margin-right:50px;margin-top:10px;">
								<?php $pre = "'main_Item'"; if($video_enable !=0){$pre ="'othervideoTab_Item'";}else if($photo_enable !=0){$pre = "'otherTab_Item'";}else if($quantity_price !=0){$pre = "'Tab_Quantity_price'";}else if($price_margin !=0){$pre = "'Tab_Price_margin'";} else if($is_godown !=0 || $isbatch !=0){$pre ="'godownTab_Item'";} $next =''; if($alternate_item_set!=0){$next = "'altTab_Item'";} else if($settings[0]['is_makemodel']!=0){$next ="'otherFieldTab_Item'";}?>
                                <a class="btn btn-primary" id="prev1" onclick="openTabs(event, <?php echo $pre;?>)"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                <?php if($next!=''){?>
									<a class="btn btn-primary" id="next2" onclick="openTabs(event, <?php echo $next; ?>)">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
								<?php }else{ ?>
											<?php if ($view != 'view') { ?>
                                                <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                                    <i class="glyphicon glyphicon-hdd"></i>
                                                </button>
                                            <?php } ?>
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
							<?php $pre = "'main_Item'"; if($quantity_price !=0){$pre = "'Tab_Quantity_price'";}else if($price_margin !=0){$pre = "'Tab_Price_margin'";}  else if($is_godown !=0 || $isbatch !=0){$pre ="'godownTab_Item'";} $next =''; if($video_enable!=0){$next = "'othervideoTab_Item'";}else if($is_feature !=0){$next ="'featureTab_Item'";}else if($alternate_item_set!=0){$next = "'altTab_Item'";} else if($settings[0]['is_makemodel']!=0){$next ="'otherFieldTab_Item'";}?>

                            <span style="float: right;margin-right:50px;margin-top:10px;">
                                <a class="btn btn-primary" onclick="openTabs(event, <?php echo $pre;?>)"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                <?php if($next!=''){ ?>
									<a class="btn btn-primary" onclick="openTabs(event,<?php echo $next;?>)">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
								<?php }else{ ?>
									<?php if ($view != 'view') { ?>
                                       <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat btnsaveds'>
                                         <i class="glyphicon glyphicon-hdd"></i>
											</button>
                                    <?php } ?>
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
								<?php $pre = "'main_Item'"; if($photo_enable !=0){$pre = "'otherTab_Item'";}else if($quantity_price !=0){$pre = "'Tab_Quantity_price'";}else if($price_margin !=0){$pre = "'Tab_Price_margin'";} else if($is_godown !=0 || $isbatch !=0){$pre ="'godownTab_Item'";} $next ='';  if($is_feature !=0){$next ="'featureTab_Item'";}else if($alternate_item_set!=0){$next = "'altTab_Item'";} else if($settings[0]['is_makemodel']!=0){$next ="'otherFieldTab_Item'";}?>
                                <a class="btn btn-primary" id="prev1" onclick="openTabs(event, <?php echo $pre;?>)"><i class="glyphicon glyphicon-chevron-left"> Prev</i></a>
                                <?php if($next!=''){?>
									<a class="btn btn-primary" id="next2" onclick="openTabs(event, <?php echo $next; ?>)">Next <i class="glyphicon glyphicon-chevron-right"></i></a>
								<?php }else{ ?>
											<?php if ($view != 'view') { ?>
                                                <button id="btnsav" type='button' data-toggle="tooltip" title='Save' class='form-button-save btn bg-orange btn-flat btnsaveds'>
                                                    <i class="glyphicon glyphicon-hdd"></i>
                                                </button>
                                            <?php } ?>
										<?php } ?>
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
	
	$(document).on("change","#sel_quantity_price",function() {
		$('.clsqtyprice').attr('style','display:none');
		var sel_quantity_price = $('#sel_quantity_price').val();
		if(sel_quantity_price === "above" ){
			$('#div_above').removeAttr('style');
		}
		if(sel_quantity_price === "below" ){
			$('#div_below').removeAttr('style');
		}
		
		if(sel_quantity_price === "between"){
			$('#div_between').removeAttr('style');
		}
		
	});
	
	
	$(document).on("change",".marginrates",function() {
		var prate = $('#prate').val();
		var landing_cost = $('#landing_cost').val();
		$('.cls_lcrate').html(landing_cost);
		$('.cls_prate').html(prate);
		var MRP = $('#MRP').val();
		var srate = $('#srate').val();
		var wholerate = $('#wholerate').val();
		var special_rate = $('#special_rate').val();
		$('.margin_mrp').html(MRP);
		$('.margin_srate').html(srate);
		$('.margin_whrate').html(wholerate);
		$('.margin_special_rate').html(special_rate);
		
		var prate_margin_salerate = parseFloat(srate) - parseFloat(prate);
		var prate_margin_mrp = parseFloat(MRP) - parseFloat(prate);
		var prate_margin_wharte =  parseFloat(wholerate) - parseFloat(prate);
		var prate_margin_special_rate = parseFloat(special_rate) - parseFloat(prate);
		
		var lc_margin_salerate = parseFloat(srate) - parseFloat(landing_cost);
		var lc_margin_mrp =  parseFloat(MRP) - parseFloat(landing_cost);
		var lc_margin_wharte = parseFloat(wholerate) - parseFloat(landing_cost);
		var lc_margin_special_rate =  parseFloat(special_rate) - parseFloat(landing_cost);
		
		$('#prate_margin_salerate').html(prate_margin_salerate);
		$('#prate_margin_mrp').html(prate_margin_mrp);
		$('#prate_margin_wharte').html(prate_margin_wharte);
		$('#prate_margin_special_rate').html(prate_margin_special_rate);
		
		var percentage_margin_salerate = 0;
		var percentage_margin_mrp = 0;
		var percentage_margin_wharte = 0;
		var percentage_margin_special_rate = 0;
		if(parseFloat(prate_margin_salerate) > 0 && parseFloat(srate) > 0 ){
			percentage_margin_salerate = parseFloat(prate_margin_salerate) * 100 / parseFloat(srate);
			percentage_margin_salerate = (srate - prate ) / (prate );
			percentage_margin_salerate = percentage_margin_salerate * 100;
		}
		
		if(parseFloat(prate_margin_mrp) > 0 && parseFloat(MRP) > 0 ){
			percentage_margin_mrp = parseFloat(prate_margin_mrp) * 100/ parseFloat(MRP);
			percentage_margin_mrp = (MRP - prate ) / (prate );
			percentage_margin_mrp = percentage_margin_mrp * 100;
		}
		
		if(parseFloat(prate_margin_wharte) > 0 && parseFloat(wholerate) > 0 ){
			percentage_margin_wharte = parseFloat(prate_margin_wharte) * 100/ parseFloat(wholerate);
			percentage_margin_wharte = (wholerate - prate ) / (prate );
			percentage_margin_wharte = percentage_margin_wharte * 100;
		}
		
		if(parseFloat(prate_margin_special_rate) > 0 && parseFloat(special_rate) > 0 ){
			percentage_margin_special_rate = parseFloat(prate_margin_special_rate) * 100/ parseFloat(special_rate);
			percentage_margin_special_rate = (special_rate - prate ) / (prate );
			percentage_margin_special_rate = percentage_margin_special_rate * 100;
		}
		
		$('#percentage_margin_salerate').html(percentage_margin_salerate);
		$('#percentage_margin_mrp').html(percentage_margin_mrp);
		$('#percentage_margin_wharte').html(percentage_margin_wharte);
		$('#percentage_margin_special_rate').html(percentage_margin_special_rate);
		
		
		
		$('#lc_margin_salerate').html(lc_margin_salerate);
		$('#lc_margin_mrp').html(lc_margin_mrp);
		$('#lc_margin_wharte').html(lc_margin_wharte);
		$('#lc_margin_special_rate').html(lc_margin_special_rate);
		
		var lcp_margin_salerate = 0;
		var lcp_margin_mrp = 0;
		var lcp_margin_wharte = 0;
		var lcp_margin_special_rate = 0;
		
		if(parseFloat(lc_margin_salerate) > 0 && parseFloat(srate) > 0 ){
			lcp_margin_salerate = parseFloat(lc_margin_salerate) * 100/ parseFloat(srate);
			lcp_margin_salerate = (srate - landing_cost ) / (landing_cost );
			lcp_margin_salerate = lcp_margin_salerate * 100;
		}
		
		if(parseFloat(lc_margin_mrp) > 0 && parseFloat(MRP) > 0 ){
			lcp_margin_mrp = parseFloat(lc_margin_mrp) * 100/ parseFloat(MRP);
			lcp_margin_mrp = (MRP - landing_cost ) / (landing_cost );
			lcp_margin_mrp = lcp_margin_mrp * 100;
		}
		
		if(parseFloat(lc_margin_wharte) > 0 && parseFloat(wholerate) > 0 ){
			lcp_margin_wharte = parseFloat(lc_margin_wharte) * 100/ parseFloat(wholerate);
			lcp_margin_wharte = (wholerate - landing_cost ) / (landing_cost );
			lcp_margin_wharte = lcp_margin_wharte * 100;
		}
		
		if(parseFloat(lc_margin_special_rate) > 0 && parseFloat(special_rate) > 0 ){
			lcp_margin_special_rate = parseFloat(lc_margin_special_rate) * 100/ parseFloat(special_rate);
			lcp_margin_special_rate = (special_rate - landing_cost ) / (landing_cost );
			lcp_margin_special_rate = lcp_margin_special_rate * 100;
		}
		
		
		$('#lcp_margin_salerate').html(lcp_margin_salerate);
		$('#lcp_margin_mrp').html(lcp_margin_mrp);
		$('#lcp_margin_wharte').html(lcp_margin_wharte);
		$('#lcp_margin_special_rate').html(lcp_margin_special_rate);
	});
	function loadmarginrates(landing_cost = 0 ,prate = 0){
		$('.cls_lcrate').html(landing_cost);
		$('.cls_prate').html(prate);
		
	}
	var triggered  = 0 ;
	function loadsubunits(unit_id,sub_unit_one=0,sub_unit_two=0){
		$.ajax({
             url: "<?php echo site_url('ajaxcall/subunits'); ?>/" + unit_id,
             success: function (result) {
                    $('#sub_unit_one').html(result);
                    $('#sub_unit_two').html(result);
                    $('#sub_unit_one').val(sub_unit_one);
                    $('#sub_unit_two').val(sub_unit_two);
             }
        });
	}

	function loadfeature(categoryid){
		var item_id = $('#ins_id').val();
		$('.divcollapse').attr('style','display:none');
		$('.collapsefeature').html('');
		$.ajax({
            url: '<?php echo site_url('inventory_master/item/getfeature'); ?>',
            type: 'post',
            data: {categoryid:categoryid,item_id:item_id},
            success: function(result) {
                $.each(JSON.parse(result), function(i, itemsingle) {
					var checked = '';
					if(parseFloat(itemsingle.status) > 0){
						checked = 'checked';
					}
                    $('.divcollapse'+itemsingle.itemtypeid).attr('style','display:block');
					var text = '<div class="col-sm-4"><input '+checked+' style="margin:1px !important;" type="checkbox" id="feature" name="feature[]" value="'+itemsingle.id+'"></div>'+itemsingle.name;
					$('#collapsefeature'+itemsingle.itemtypeid).append(text);
					
                });
            }
        });
		
	}
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
        $('#item_category_name').change(function(){
            var item_category_id = $('#item_category_id').val();
            if(item_category_id === '' || item_category_id == 0){
                $('#item_category_name').val('');
            }
        });


        $('#hsn_name').change(function(){
            var hsn_id = $('#hsn_id').val();
            if(hsn_id === '' || hsn_id == 0){
                $('#hsn_name').val('');
            }
        });


        $('#mfgdate').val('');
        $('#expdate').val('');
        $('.sqft').change(function(){
            var sqft_ht = $('#sqft_ht').val();
            if(sqft_ht ==''){
                sqft_ht = 0 ;
            }

            var sqft_wt = $('#sqft_wt').val();
            if(sqft_wt ==''){
                sqft_wt = 0 ;
            }
            var sqft = sqft_wt * sqft_ht;
            $('#sqft').val(parseFloat(sqft).toFixed(4));
        });
		$("#supname").autocomplete({
                        source: "<?php echo site_url('ajaxcall/suppliers/sup'); ?>",
                        minLength: 2,
                        select: function (event, ui) {
                            $('#supid').val(ui.item.id);
                            
                        }
                    });
					
					
	//$('#name').change(function(){
		//var name = $(this).val();
		//if(name !== ''){
			// $.ajax({
			//	url: "<?php echo site_url('inventory_master/Item/arabic_name') ?>",
			//	type: "POST",
				//data: {
					//"text": name
				//},
				//success: function(result) {
					//$('#name_lan').val(result);
				//}
			//});
		//}
	//});
	$( "#frmcreatemodeli" ).submit(function( event ) {
		event.preventDefault();
		var name = $("#name").val();
        if (name === '') {
			issubmited = 0 ;
            $(".btnsaveds").removeAttr('disabled');
             toastr.info("Please add a Product Name");
             return;
        }
		else{
			issubmited = 1 ;
			if(parseFloat(triggered) < 1 ){
				$('#btnsavv').click();
				triggered = 1;
			}
		}
	});
	$("#unit_id").change(function () {
		var unit_id = $(this).val();
		$.ajax({
             url: "<?php echo site_url('ajaxcall/subunits'); ?>/" + unit_id,
             success: function (result) {
                    $('#sub_unit_one').html(result);
                    $('#sub_unit_two').html(result);
             }
        });
    });
	$.ajax({
            url: "<?php echo site_url('ajaxcall/item_cess'); ?>",
            success: function(result) {
                $('#item_cess').html(result);

            }
    });
	$("#item_category_name").autocomplete({
        source: "<?php echo site_url('Item/getallCat'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#item_category_id').val(ui.item.id);
            $('#item_category_name').val(ui.item.name);
			loadfeature(ui.item.id);
        }
    });
	$("#hsn_name").autocomplete({
        source: "<?php echo site_url('Item/getallhsn'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#hsn_id').val(ui.item.hsnid);
            $('#hsn_name').val(ui.item.hsncode);
        }
    });
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

        //$('#btnsavv').attr('disabled', true);
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
        $('.alternate').click(function() {
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
			var barcode = $('#barcode').val();
			data.append('new_barocdes',barcode);
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
		var user_type = $('#user_type').val();
		var txt = '';
		if(parseFloat(user_type) > 0 ){
			txt = '';
		}
        newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[]" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
            '<td ><input value="' + gqty + '"  type="text" name="gqty[]"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
        $("#rowg").append(newrow);
    }
    var other_inc = 0;

    function otheritem(iid, alt_itemid, alt_item) {
        other_inc = other_inc + 1;
        newrow = '<tr><td><input  class="form-control"    value="' + alt_item + ' "type="text" disabled><input  value="' + alt_itemid + '"  type="text" name="alt_itemids[]"  class="hidden cre form-control"/></td>' +
            '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
        $("#rowma").append(newrow);
    }
	function addbatch(godown_id,godownname,batch,quantity,item_stkrate,item_srate,item_Prate,item_MRP,WHRATE,expiry =''){
		if(item_stkrate === ""){
			item_stkrate = 0;
		}
		if(item_srate === ""){
			item_srate = 0;
		}
		if(item_Prate === ""){
			item_Prate = 0;
		}
		if(item_MRP === ""){
			item_MRP = 0;
		}
		if(WHRATE === ""){
			WHRATE = 0;
		}

        var txtbatch_barcode = '';
                            <?php if($batch_barcode > 0 ){ ?>
                                var ins_id = $('#ins_id').val();
                                txtbatch_barcode = '&nbsp;<a  target="_blank" class="btn btn-info clsitembatchcode" tp="new" href="<?php echo base_url();?>inventory_master/Item/bill/'+ins_id+'/0/'+batch+'/'+item_MRP+'" title="Print Barcode" data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></a>';
                            <?php }?>


		var row = '<tr><td class="smag"><input class="item_godown" type="hidden" value="'+godown_id+'" name="gid[]"><input type="text" class="form-control" readonly="readonly" value="'+godownname+'"></td>'+
				'<td><input type="text" name="itm_batch[]" placeholder="Batch" id="itm_batch" value="'+batch+'" class="form-control rowbatch itmbatch"/></td>'+
				'<td><input type="text" name="itm_expiry[]" placeholder="Expiry" id="itm_expiry" value="'+expiry+'" class="form-control dates"/></td>'+
                '<td class="sma"><input type="text" name="gqty[]" placeholder="Quantity" id="itm_quantity" value="'+quantity+'" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text" value="'+item_stkrate+'"  placeholder="STK RATE" name="item_stkrate[]" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text" value="'+item_srate+'"  placeholder="SRATE" name="item_srate[]" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text" value="'+item_Prate+'"  placeholder="PRATE" name="itmprate[]" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text" value="'+item_MRP+'"  placeholder="MRP" name="item_MRP[]" class="form-control two-digits bamrp"/></td>'+
				'<td class="sma" ><input type="text" value="'+WHRATE+'"  placeholder="WHRATE" name="item_WHRATE[]" class="form-control two-digits"/></td>'+
				'<td class="col-sm-1"><button type="button"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>'+txtbatch_barcode+'</td></tr>';
			$("#rowg").append(row);
            $('.dates').datepicker({  
                format: 'dd/mm/yyyy', 
                autoclose: true,
                constrainInput: false
            });
	}

    function godownlist(gid, name, gqty) {
		$isbatch = $('#isbatch').val();
		if($isbatch === '0'){
			newrow = '<tr><td ><input  class="form-control"  value="' + name + ' "type="text"><input   value="' + gid + ' "type="hidden" name="gid[]" placeholder="' + gid + ' "   class="hidden deb form-control  cal debit two-digits" placeholder="Godown"/></td>' +
            '<td ><input value="' + gqty + '"  type="text" name="gqty[]"  style="width=100%"    class="cre form-control two-digits price cal credit" placeholder="Quantity"/></td>';
			$("#rowg").append(newrow);
			idinc = idinc + 1;
		}else{
			newrow
		}
        if (gqty === null) {
            gqty = 0;
        }
        if (gid === null) {
            gid = 0;
        }
        
    }
    var idinc = 0;

    function getgodownlist() {
		$isbatch = $('#isbatch').val();
		if($isbatch === '0'){
			$.ajax({
				url: "<?php echo site_url('item/allgodown'); ?>",
				success: function(result) {
					$('#rowg').html('');
					$.each(JSON.parse(result), function(i, itemsingle) {
						var godown_id = itemsingle.id;
						var godown_name = itemsingle.godown_name;
						var gqty = 0;
						godownlist(itemsingle.id, itemsingle.godown_name, gqty);
					});
				}
			});
		}else{
			var option ='';
			$.ajax({
				url: "<?php echo site_url('ajaxcall/godown'); ?>",
				async:false,
				success: function (result) {
					option = result;
				}
			});
            var txtbatch_barcode = '';
            <?php if($batch_barcode > 0 ){ ?>
                var ins_id = $('#ins_id').val();
                txtbatch_barcode = '&nbsp;<a  target="_blank" class="btn btn-info clsitembatchcode" tp="new" href="<?php echo base_url();?>inventory_master/Item/bill/'+ins_id+'" title="Print Barcode" data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></a>';
            <?php }?>
			var row = '<tr><td class="smag"><select  name="item_godown" id="item_godown" class="form-control">'+option+'</select></td>'+
				'<td ><input type="text" placeholder="Batch" id="item_batch" class="form-control rowbatch"/></td>'+
                '<td ><input type="text"    placeholder="Expiry Date" id="item_expiry" class="form-control dates" value =""/></td>'+
				'<td class="sma" ><input type="text"  placeholder="Quantity" id="item_quantity" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text"  placeholder="STK RATE" id="item_stkrate" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text"  placeholder="SRATE" id="item_srate" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text"  placeholder="PRATE" id="item_Prate" class="form-control two-digits"/></td>'+
				'<td class="sma"><input type="text"  placeholder="MRP" id="item_MRP" class="form-control two-digits bamrp"/></td>'+
				'<td class="sma" ><input type="text"  placeholder="WHRATE" id="item_WHRATE" class="form-control two-digits"/></td>'+
				'<td ><button type="button" id="addbatch"  class="addbatch btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>'+txtbatch_barcode+'</td></tr>';
			$("#rowg").append(row);
            $('.dates').datepicker({  
                format: 'dd/mm/yyyy', 
                autoclose: true,
                constrainInput: false
            });
		}
        
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
        source: "<?php echo site_url('ajaxcall/itemssearch_new/name'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $("#alt_item_name").attr('txt', ui.item.name);
            loadaltItem(ui);
        }
    });
	function calert(msg) {
        toastr["error"](msg);
    }
    $(document).on('change', ".rowbatch", function() {
        var $tr = $(this).closest('tr');
        var $batch =  $tr.find('.rowbatch');
        var batch = $batch.val(); // if it's an input/select element

        var $img = $tr.find('.clsitembatchcode');
        var $mrp =  $tr.find('.bamrp');
        var ins_id = $('#ins_id').val();
        var mrpValue = $mrp.val(); // if it's an input/select element
        var src = "<?php echo base_url();?>inventory_master/Item/bill/"+ins_id+"/0/"+batch+"/"+mrpValue;
        $img.attr('href', src);
        $img.attr('tp', "new");
    });
    $(document).on('change', ".bamrp", function() {
        var $tr = $(this).closest('tr');
        var $batch =  $tr.find('.rowbatch');
        var batch = $batch.val(); // if it's an input/select element

        var $img = $tr.find('.clsitembatchcode');
        var $mrp =  $tr.find('.bamrp');
        var ins_id = $('#ins_id').val();
        var mrpValue = $mrp.val(); // if it's an input/select element
        var src = "<?php echo base_url();?>inventory_master/Item/bill/"+ins_id+"/0/"+batch+"/"+mrpValue;
        $img.attr('href', src);
        $img.attr('tp', "new");
    });
	$(document).on('click', ".addbatch", function() {
       var godown_id = $('#item_godown').val();
	   var godownname =  $("#item_godown option:selected").text();
	   var batch = $('#item_batch').val();
	   var quantity = $('#item_quantity').val();
	   var item_stkrate = $('#item_stkrate').val();
	   var item_srate = $('#item_srate').val();
	   var item_Prate = $('#item_Prate').val();
	   var item_MRP = $('#item_MRP').val();
	   var WHRATE = $('#item_WHRATE').val();
       var expiry = $('#item_expiry').val();
	   var is_exist = 0;
	   $(".itmbatch").each(function() {
			var item_batch = $(this).val();
			if(item_batch === batch){
				$(".item_godown").each(function() {
					var item_godown = $(this).val();
					if(item_godown === godown_id){
						is_exist = 1;
					}
				});
			}
		});
		if(parseFloat(is_exist) < 1){
			if(godown_id !=="" && batch!=="" && quantity!==""){
			$('#item_stkrate').val('');
			$('#item_WHRATE').val('');
			$('#item_MRP').val('');
			$('#item_Prate').val('');
			$('#item_srate').val('');
			$('#item_batch').val('');
			$('#item_quantity').val('');
				addbatch(godown_id,godownname,batch,quantity,item_stkrate,item_srate,item_Prate,item_MRP,WHRATE,expiry);
			}
		}else{
			calert('Batch Already Exist');
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
				loadsubunits($('#unit_id').val());
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
            $('#feature').attr('class', '');
            $('#otherfield').attr('class', '');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');

        }
        if (tabName == 'otherTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', 'active');
            $('#otherfield').attr('class', '');
            $('#video').attr('class', '');
            $('#feature').attr('class', '');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');
        }
        if (tabName == 'otherFieldTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', '');
            $('#otherfield').attr('class', 'active');
            $('#video').attr('class', '');
            $('#feature').attr('class', '');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');
        }
        if (tabName == 'othervideoTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', '');
            $('#otherfield').attr('class', '');
            $('#video').attr('class', 'active');
            $('#feature').attr('class', '');
            $('#godown').attr('class', '');
            $('#alt').attr('class', '');
        }
		if (tabName == 'featureTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', '');
            $('#otherfield').attr('class', '');
            $('#video').attr('class', '');
            $('#feature').attr('class', 'active');
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
				$('#feature').attr('class', '');
                $('#godown').attr('class', 'active');
                $('#alt').attr('class', '');
                $('#otherfield').attr('class', '');
            }
        }
        if (tabName == 'altTab_Item') {
            $('#main').attr('class', '');
            $('#other').attr('class', '');
            $('#video').attr('class', '');
            $('#feature').attr('class', '');
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
                    $("#sqft_ht").val(result.sq_hgt);
					$("#sqft_wt").val(result.sq_wt);
					$("#tax_on_mrp").val(result.tax_on_mrp);
                    $('#sqft').val(result.sqft);

                    $("#cigarette_cess_amount").val(result.cigarette_cess_amount);
                    $("#cigarette_cess_percentage").val(result.cigarette_cess_percentage);
					$("#supname").val(result.supname);
					$("#package_date").val(result.packagedate);
					$("#lcode").val(result.lcode);
                    $('#catbarcode').val(result.barcode);
					$("#net_weight").val(result.net_weight);
                    	$("#is_active").val(result.is_active);
                    $("#supid").val(result.supplier);
                    $("#name").val(result.name);
                    $("#landing_cost").val(result.landing_cost);
					loadmarginrates(result.landing_cost,result.prate);
                    $("#brand_id").val(result.brand_id);
                    $("#item_category_name").val(result.catname);
					$('#special_rate').val(result.special_rate);
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
                    $("#open_stock_wt").val(result.open_stock_wt);
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
					loadfeature(result.item_category_id);
                    $("#unit_id").val(result.unit_id);
					loadsubunits(result.unit_id,result.sub_unit_one,result.sub_unit_two);
					$('#hsn_name').val(result.hsnname);
                    $("#hsn_id").val(result.hsncode);
                    $("#item_group_id").val(result.item_group_id);
                    $("#item_cess").val(result.cess_id);
                    $("#rack_id").val(result.rack);
                    $("#itemtype").val(result.item_type_id);
                    $("#material_type").val(result.material_type);
                    $('#online_item').val(result.item_online);
                    $("#pno").val(result.part_no);
					$("#pno1").val(result.part_no1);
                    $("#pno2").val(result.part_no2);
					$('#mfgdate').val(result.mfg);
					if(result.part_no2 === '0'){
						$("input:radio[name='manual'][value ='0']").prop('checked', true);
					}else{
						$("input:radio[name='manual'][value ='1']").prop('checked', true);
					}
                    $('#expdate').val(result.exp);					
                    $('#mmodel').val(result.make_model);
                    $('#war_period').val(result.war_period);
					$("#landing_cost").trigger('change');
                    var i = 1
                    for (var i = 1; i <= 10; i++) {
                        $('#otherField' + i).val(result['field_' + i]);
                    }
                    $('#rrow').val(result.row);
                }
               
            });

				$.ajax({
					url: "<?php echo site_url('item/godownitem'); ?>/" + id,
					type: 'post',
					data: {isbatch:$('#isbatch').val()},
					async:false,
					success: function(result) {
						$('#rowg').html('');
						var isbatch = $('#isbatch').val();
						if(isbatch ==='1'){
							var option ='';
							$.ajax({
									url: "<?php echo site_url('ajaxcall/godown'); ?>",
									async:false,
									success: function (result) {
									option = result;
								}
							});
                            var txtbatch_barcode = '';
                            <?php if($batch_barcode > 0 ){ ?>
                                var ins_id = $('#ins_id').val();
                                txtbatch_barcode = '&nbsp;<a target="_blank" class="btn btn-info clsitembatchcode" tp="new" href="<?php echo base_url();?>inventory_master/Item/bill/'+ins_id+'/0/" title="Print Barcode" data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></a>';
                            <?php }?>
							var row = '<tr><td class="smag"><select  name="item_godown" id="item_godown" class="form-control">'+option+'</select></td>'+
									'<td ><input type="text" placeholder="Batch" id="item_batch" class="form-control rowbatch"/></td>'+
                                    '<td ><input  type="text" placeholder="Expiry Date" id="item_expiry" class="form-control dates" value =""/></td>'+
                                    '<td class="sma" ><input type="text"  placeholder="Quantity" id="item_quantity" class="form-control two-digits"/></td>'+
									'<td class="sma"><input type="text"  placeholder="STK RATE" id="item_stkrate" class="form-control two-digits"/></td>'+
									'<td class="sma"><input type="text"  placeholder="SRATE" id="item_srate" class="form-control two-digits"/></td>'+
									'<td class="sma"><input type="text"  placeholder="PRATE" id="item_Prate" class="form-control two-digits"/></td>'+
									'<td class="sma"><input type="text"  placeholder="MRP" id="item_MRP" class="form-control two-digits bamrp"/></td>'+
									'<td class="sma" ><input type="text"  placeholder="WHRATE" id="item_WHRATE" class="form-control two-digits"/></td>'+
									'<td ><button type="button" id="addbatch"  class="btn btn-success"><span class="addbatch glyphicon glyphicon-plus"></span></button>'+txtbatch_barcode+'</td></tr>';
							$("#rowg").append(row);
                            $('.dates').datepicker({  
                                format: 'dd/mm/yyyy', 
                                autoclose: true,
                                constrainInput: false
                            });
							
						}
						$.each(JSON.parse(result), function(i, itemsingle) {
							var isbatch = $('#isbatch').val();
							if(isbatch === '0'){
								godownitem(itemsingle.item_id, itemsingle.godownid, itemsingle.godown_name, itemsingle.open_stock);
							}else{
								if(i<1){
									
									
								}
                                var expiry_date = '';
                                if(itemsingle.expirydate !== 'null' &&  itemsingle.expirydate !== null && itemsingle.expirydate !== undefined ){
                                    expiry_date = itemsingle.expirydate;
                                }
								addbatch(itemsingle.godownid,itemsingle.godown_name,itemsingle.batch,itemsingle.open_stock,itemsingle.item_opnstkrate,itemsingle.item_srate,itemsingle.item_prate,itemsingle.item_mrp,itemsingle.item_whrate,expiry_date)
							}
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
			
			$.ajax({
                url: "<?php echo site_url('inventory_master/Item/get_item_quantity_price'); ?>/" + id,
                success: function(result) {
                    $.each(JSON.parse(result), function(i, itemsingle) {
                        $('#sel_quantity_price').val(itemsingle.qprice_type);
						$('#quantity_price_above').val(itemsingle.qprice_above);
						$('#quantity_price_below').val(itemsingle.qprice_below);
						$('#quantity_price_min').val(itemsingle.qprice_min);
						$('#quantity_price_max').val(itemsingle.qprice_max);
						$('#sel_quantity_price').trigger('change');
						if(itemsingle.qprice_type === "above"){
							$('#quantity_price_above_value').val(itemsingle.qprice_rate);
						}
						
						if(itemsingle.qprice_type === "below"){
							$('#quantity_price_below_value').val(itemsingle.qprice_rate);
						}
						
						if(itemsingle.qprice_type === "between"){
							$('#quantity_price_rate').val(itemsingle.qprice_rate);
						}
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