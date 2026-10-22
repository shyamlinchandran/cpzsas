 <section class="content-header" style="margin-top: -23px;">
     <h1>
         <?= label('Dashboard', $this, $user) ?>
         <small>Version 2.0</small>
     </h1>

 </section>
 <style>
     .products-list .product-info {
         margin-left: 0px;
         font-size: 12px !important;
         overflow: hidden !important;
     }


     .min-520 {
         min-height: 450px;

     }
 </style>
 <section class="content">
     <?php if($dahsboard_analytics < 1 ){?>
 <div class="row">
     <?php foreach ($quickmenu as $ms) { ?>
             <a href="<?= base_url() . $ms['Url'] ?>" class="btn btn-app">
                 <i class="<?= $ms['icon'] ?>"></i><?= $ms['ListName'] ?>
             </a>
         <?php } ?>
        </div>
        <?php }?>
 <?php if($dahsboard_analytics > 0 ){?>

     <div class="row">
     <?php foreach ($quickmenu as $ms) { ?>
             <a href="<?= base_url() . $ms['Url'] ?>" class="btn btn-app">
                 <i class="<?= $ms['icon'] ?>"></i><?= $ms['ListName'] ?>
             </a>
         <?php } ?>
       <!--    <?php //foreach ($quickmenu as $ms) { ?>
             <a href="<?= base_url() . $ms['Url'] ?>" class="btn btn-app">
                 <i class="<?= $ms['icon'] ?>"></i><?= $ms['ListName'] ?>
             </a>
         <?php //} ?>

          <a  href="<?= base_url() ?>transaction/sales/listall/sales" class="btn btn-app">
                     <i class="fa fa-inbox"></i>Sales
                 </a>
                 <a  href="<?= base_url() ?>transaction/sales/sales/sales" class="btn btn-app">
                     <i class="fa fa-send"></i>Sales New
                 </a>
                 <a  href="<?= base_url() ?>transaction/vouchers/listall/receipt"  class="btn btn-app">
                     <i class="fa fa-money"></i> Receipt
                 </a>
                 <a class="btn btn-app" href="<?= base_url() ?>transaction/vouchers/receipt">
                     <i class="fa fa-money"></i> Receipt New
                 </a> 
                 <a class="btn btn-app" href="<?= base_url() ?>inventory_master/Item/listall">
                     <i class="fa fa-barcode"></i> Products
                 </a>
                 <a class="btn btn-app" href="<?= base_url() ?>inventory_master/Item/create">
                     <i class="fa fa-barcode"></i> Products New
                 </a>
                 <a class="btn btn-app" href="<?= base_url() ?>transaction/purchase/listall/purchase">
                     <i class="fa fa-inbox"></i> Purchase
                 </a>
                 <a class="btn btn-app" href="<?= base_url() ?>transaction/purchase/create/purchase">
                     <i class="fa fa-send"></i> Purchase New
                 </a>
                 <a class="btn btn-app">
                     <i class="fa fa-envelope"></i> Inbox
                 </a>
                 <a class="btn btn-app">
                     <i class="fa fa-heart-o"></i> Likes
                 </a>

                 <a class="btn btn-app">
                     <i class="fa fa-save"></i> Save
                 </a>
                 <a class="btn btn-app">
                     <i class="fa fa-bullhorn"></i> Notifications
                 </a>-->


     </div>

     <div class="row">
         <div class="clearfix visible-sm-block"></div>
         <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                 <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-list-alt"></i></span>

                 <div class="info-box-content">
                     <span class="info-box-text"><?= label("Today's Sales", $this, $user) ?></span>
                     <span style="font-size:14px;" class="info-box-number"><?= label("Cash", $this, $user) ?> : <?php echo $cash; ?><br>
                     <?= label("Bank", $this, $user) ?> : <?php echo $bank; ?>  <br>
                     <?= label("Credit", $this, $user) ?> : <?php echo $credit; ?></span>
                         

                 </div>

             </div>

         </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                 <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-list"></i></span>

                 <div class="info-box-content">
                     <span class="info-box-text"><?= label("Today's Purchase", $this, $user) ?></span>
                     <span class="info-box-number"><?php echo $purchase; ?></span>
                 </div>

             </div>

         </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                 <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-list-alt"></i></span>

                 <div class="info-box-content">
                     <span class="info-box-text"><?= label("Sales Order", $this, $user) ?></span>
                     <span class="info-box-number" id="sales"><?php echo $estimate; ?></span>
                 </div>

             </div>

         </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                 <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-list"></i></span>

                 <div class="info-box-content">
                     <span class="info-box-text"><?= label("Purchase Order", $this, $user) ?></span>
                     <span class="info-box-number"><?php echo $porder; ?></span>
                 </div>
                 </a>
             </div>

         </div>

     </div>
     <?php }?>
     <?php if($dahsboard_analytics > 0 ){?>

     <div class="row">
         <div class="col-sm-12">
             <div class="box box-primary">
                 <table style="width:100%">
                     <tr>
                         <td class="col-md-3"> </td>
                         <td class="col-md-3">Start Date</td>
                         <td class="col-md-3">End Date</td>
                         <td class="col-md-3"> </td>
                     </tr>
                     <tr>
                         <td class="col-md-3"> </td>
                         <td class="col-md-3"><input type="text" class="form-control date loadtable" name="start_date" id="start_date" /> </td>
                         <td class="col-md-3"><input type="text" class="form-control date loadtable" name="end_date" id="end_date" /> </td>
                         <td class="col-md-3"> </td>
                     </tr>
                 </table>
                 <br />
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-md-3">
             <div class="box box-primary">
                 <div class="box-header with-border">
                     <h3 class="box-title">Most Selling Products</h3>

                     <!-- <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div> -->
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body min-520">
                     <ul id="ul_top_product" class="products-list product-list-in-box">

                     </ul>
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer text-center">
                     <a href="<?= base_url() ?>reports/Analytics/ItemAnalytics/desc" class="uppercase">View More</a>
                 </div>
                 <!-- /.box-footer -->
             </div>
         </div>
         <div class="col-md-3">
             <div class="box box-primary">
                 <div class="box-header with-border">
                     <h3 class="box-title">Least Selling Products</h3>

                     <!-- <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div> -->
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body min-520">
                     <ul id="ul_least_product" class="products-list product-list-in-box">

                     </ul>
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer text-center">
                     <a href="<?= base_url() ?>reports/Analytics/ItemAnalytics" class="uppercase">View More</a>
                 </div>
                 <!-- /.box-footer -->
             </div>
         </div>
         <div class="col-md-3">
             <div class="box box-primary">
                 <div class="box-header with-border">
                     <h3 class="box-title">Top Customer</h3>

                     <!-- <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div> -->
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body min-520">
                     <ul id="ul_top_customer" class="products-list product-list-in-box">

                     </ul>
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer text-center">
                     <a href="<?= base_url() ?>reports/Analytics/CustomerAnalytics/desc" class="uppercase">View More</a>
                 </div>
                 <!-- /.box-footer -->
             </div>

         </div>
         <div class="col-md-3">
             <div class="box box-primary">
                 <div class="box-header with-border">
                     <h3 class="box-title">Least Purchase Customer </h3>

                     <!-- <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div> -->
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body min-520">
                     <ul id="ul_least_customer" class="products-list product-list-in-box">
                     </ul>
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer text-center">
                     <a href="<?= base_url() ?>reports/Analytics/CustomerAnalytics/asc" class="uppercase">View More</a>
                 </div>
                 <!-- /.box-footer -->
             </div>

         </div>
     </div>
<?php }?>
 </section>
 <script>
         <?php if($dahsboard_analytics > 0 ){?>

     function load() {
         var txt_ul_top_product = '';
         var txt_ul_least_product = ''
         var ul_top_customer = '';
         var ul_least_customer = '';
         var start_date = $('#start_date').val();
         var end_date = $('#end_date').val();
         $.ajax({
             url: "<?php echo site_url('Dashboard/Toplist'); ?>",
             type: 'POST',
             data: {
                 start_date: start_date,
                 end_date: end_date
             },
             success: function(result) {
                 result = JSON.parse(result)
                 var top_customer = result.top_customer;
                 $.each(top_customer, function(index, value) {
                     ul_top_customer = ul_top_customer + '<li class="item"><div class="product-info"><a href="<?= base_url() ?>reports/Analytics/CustomerAnalytics/desc" class="product-title">' + value.name + '</a>' +
                         '<span style = "padding-left:15px;" class="product-description">No of Sales :' + value.count + ' <br />Sales Amount : ' + value.total + '</span></div></li>';
                     $('#ul_top_customer').html(ul_top_customer);
                 });

                 var least_customer = result.least_customer;
                 $.each(least_customer, function(index, value) {
                     ul_least_customer = ul_least_customer + '<li class="item"><div class="product-info"><a href="<?= base_url() ?>reports/Analytics/CustomerAnalytics" class="product-title">' + value.name + '</a>' +
                         '<span style = "padding-left:15px;" class="product-description">No of Sales :' + value.count + ' <br />Sales Amount : ' + value.total + '</span></div></li>';
                     $('#ul_least_customer').html(ul_least_customer);
                 });


                 var top_product = result.top_product;
                 $.each(top_product, function(index, value) {

                     txt_ul_top_product = txt_ul_top_product + '<li class="item"><div class="product-info"><a href="<?= base_url() ?>reports/Analytics/ItemAnalytics/desc" class="product-title">' + value.name + ' </a>';
                     txt_ul_top_product = txt_ul_top_product + '<span class="product-description">Total Quantity : ' + value.quantity + '<br />Total Amount : ' + value.total + '</span> </div></li>';
                     $('#ul_top_product').html(txt_ul_top_product);
                 });

                 var least_product = result.least_product;
                 $.each(least_product, function(index, value) {
                     var txt_label = 'warning';
                     if (value.quantity < 1) {
                         txt_label = 'danger';
                     }
                     txt_ul_least_product = txt_ul_least_product + '<li class="item"><div class="product-info"><a href="<?= base_url() ?>reports/Analytics/ItemAnalytics" class="product-title">' + value.name + '</a>';
                     txt_ul_least_product = txt_ul_least_product + '<span class="product-description">Total Quantity : ' + value.quantity + '<br />Total Amount : ' + value.total + '</span> </div></li>';
                     $('#ul_least_product').html(txt_ul_least_product);
                 });
             }
         });
     }
     $(document).ready(function() {
         var currentDate = new Date();
         var dd = currentDate.getDate();
         var today = currentDate;
         var mm = today.getMonth();
         var yyyy = today.getFullYear();
         if (parseFloat(mm) < 1) {
             mm = 12;
             yyyy = yyyy - 1;
         }
         var sdate = (mm + '/' + dd + '/' + yyyy);
         $('#start_date').datepicker("setDate", new Date(sdate));
         $('#end_date').datepicker("setDate", new Date(sdate));
         load();
         $('.loadtable').change(function() { 
             load();
         });
     });
     <?php }?>
 </script>