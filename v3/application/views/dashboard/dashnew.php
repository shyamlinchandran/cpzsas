
<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
 
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <!-- <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" /> -->
<!-- </head> -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


    <!-- End Navbar -->
    <div class="container-fluid py-4" style="background-color:white;">
      <div class="row">

       
        <br>
    <section class="content-header" style="margin-top: -23px;">
     <!-- <h1>
         <?= label('Dashboard', $this, $user) ?>
         <small>Version 2.0</small>
     </h1> -->
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dashboard</li>
     </ol>
 </section>
 <style>
    .products-list .product-info {
    margin-left: 0px;;
}
 </style>
<!-- <br>
 <section class="content">
     <div class="row"> 
        <?php  foreach ($quickmenu as $ms) { ?>
            <a  href="<?= base_url() . $ms['Url'] ?>" class="btn btn-app" style="background-color:#2E86C1;color:white;">
              <i class="<?= $ms['icon'] ?>" ></i><?= $ms['ListName'] ?>
            </a>
        <?php }?>
      </div> -->
      
       <br>
       <br>
       <div class="box box-primary">
                <table style ="width:100%" >    
                    <tr>
                        <td class="col-md-3"> </td>
                        <td class="col-md-3">Start Date</td>
                        <td class="col-md-3">End Date</td>
                        <td class="col-md-3"> </td>
                    </tr>
                    <tr>
                        <td class="col-md-3"> </td>
                        <td class="col-md-3"><input type="text"  class="form-control date loadtable" name="start_date" id= "start_date"/> </td>
                        <td class="col-md-3"><input type="text" class="form-control date loadtable" name="end_date" id= "end_date"/> </td>
                        <td class="col-md-3"> </td>
                    </tr>
                </table>
                <br />
            </div>

         <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:220px; width:240px;background-color:orange;">
                <!-- <div class="box" style="background-color:orange;"> -->



                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                        <!-- <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>            
                        </div> -->

                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Sales", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Total Sales Count", $this, $user) ?> : <span id ="salescount"> <?php echo $salescount; ?></span><br><br>
                         <?= label("Total Sales Value", $this, $user) ?> : <span id ="salesvalue"> <?php echo $salesvalue; ?></span><br><br>
                         <?= label("Cash", $this, $user) ?> :<span id ="cashsales"> <?php echo $cash; ?></span><br><br>
                         <?= label("Credit", $this, $user) ?> :<span id ="creditsales"> <?php echo $credit; ?></span><br><br>
                         <?= label("Bank", $this, $user) ?> : <span id ="banksales"> <?php echo $bank; ?></span><br><br></h5>
                        </div>

                    </div>

                    <hr class="dark horizontal my-0">
                     <!--  <div class="card-footer p-3">
                      <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>
                    </div> -->

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#DBF18B;">
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                        <!-- <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div> -->
                         <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Purchase", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Total Purchase Count", $this, $user) ?> :<span id ="purchasecount"> <?php echo $purchasecount; ?></span><br><br>
                         <?= label("Total Purchase Value", $this, $user) ?> : <span id ="purchasevalue"> <?php echo $purchasevalue; ?></span><br><br>
                         <?= label("Cash", $this, $user) ?> :<span id ="cashpurchase"> <?php echo $purchasecash; ?></span><br><br>
                         <?= label("Credit", $this, $user) ?> :<span id ="creditpurchase"> <?php echo $purchasecredit; ?></span><br><br>
                         <?= label("Bank", $this, $user) ?> :<span id ="bankpurchase"> <?php echo $purchasebank; ?></span><br><br></h5>
                        </div>
                    </div>
                     <hr class="dark horizontal my-0">
                      <!-- <div class="card-footer p-3">
                      <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3" >
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#75F4A7;">
                <div class="overview__inner" >
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                        <!-- <div class="icon">
                            <i class="zmdi zmdi-calendar-note"></i>
                        </div> -->
                        <div class="text-end pt-1">
                        <h4 class="mb-0"><?= label("Sales Order", $this, $user) ?></h4>
                         <h5 class="mb-0" id="sales"><?= label("Total Sales Order", $this, $user) ?> :<span id ="estimates"> <?php echo $estimate; ?></span><br><br><?= label("Total Sales Order Value", $this, $user) ?> : <span id ="estimatesvalue"> <?php echo $estimatevalue; ?></span><br><br></h5>
                        </div>

                    </div>
                    <hr class="dark horizontal my-0">
                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#F495F9;">
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                        <!-- <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div> -->
                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Purchase Order", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Total Purchase Order", $this, $user) ?> :<span id ="purchaseorder"><?php echo $porder; ?></span><br><br><?= label("Total Order Value", $this, $user) ?> :<span id ="purchaseordervalue"><?php echo $pordervalue; ?></span><br><br></h5>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                      
                </div>
            </div>
        </div>
</div>

 <div class="container-fluid py-4" style="background-color:#CACFD2;">
 <div>  
 <br>     
                <div class="col-sm-12" >
                <div class="col-sm-6">
                    <div id="container" style="min-width:150px; height: 300px; margin: 0 auto ">

                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="container2" style="min-width:150px; height: 300px; margin: 0 auto ">

                    </div>
                </div>
            </div>
          </div>
</div>
<!-- </div> -->

<br>
<div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#71AAF7;">
                <!-- <div class="box" style="background-color:orange;"> -->
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                       <!--  <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>            
                        </div> -->

                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Sales Return", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Total Sales Return Count", $this, $user) ?> :<span id ="salereturn"><?php echo $sreturn; ?></span><br><br>
                         <?= label("Sales Return Value", $this, $user) ?> :<span id ="salesreturnvalue"><?php echo $salesreturnvalue; ?></span><br><br>
                         <?= label("Cash", $this, $user) ?> :<span id ="cashreturn"> <?php echo $cashreturn; ?></span><br><br>
                         <?= label("Credit", $this, $user) ?> : <span id ="creditreturn"> <?php echo $creditreturn; ?></span><br><br>
                         <?= label("Bank", $this, $user) ?> :<span id ="bankreturn"> <?php echo $bankreturn; ?></span><br><br></h5>
                        </div>

                    </div>

                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#F7717F;">
                <!-- <div class="box" style="background-color:orange;"> -->
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                       <!--  <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>            
                        </div> -->

                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Total Payment", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Cash", $this, $user) ?> :<span id ="cashpayment"><?php echo $cashpayment; ?></span><br><br>
                         <?= label("Bank", $this, $user) ?> : <span id ="bankpayment"><?php echo $bankpayment; ?></span><br><br></h5>
                        </div>

                    </div>

                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#7DF5E4;">
                <!-- <div class="box" style="background-color:orange;"> -->
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                       <!--  <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>            
                        </div> -->

                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Total Receipt", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Cash", $this, $user) ?> :<span id ="cashcollection"><?php echo $cashcollection; ?></span><br><br>
                         <?= label("Bank", $this, $user) ?> :<span id ="bankcollection"><?php echo $bankcollection; ?></span><br><br></h5>
                        </div>

                    </div>

                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#BE74F5;">
                <!-- <div class="box" style="background-color:orange;"> -->
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
<!--                         <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>            
                        </div>
 -->
                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Total Collection", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Total Collection Value", $this, $user) ?> :<span id ="totalcollection"></span><br><br>
                        </h5>
                        </div>
                    </div>

                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#FE83D9;">
                <!-- <div class="box" style="background-color:orange;"> -->
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                       <!--  <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>            
                        </div> -->

                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Receivables", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Amount", $this, $user) ?> :<span id ="receivable"></span><br><br>
                        </h5>
                        </div>

                    </div>

                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="btn btn-app" style="height:250px; width:240px;background-color:#A3ECF0;">
                <!-- <div class="box" style="background-color:orange;"> -->
                <div class="overview__inner">
                    <div class="overview-box clearfix" style="height:170px; width:240px">
                       <!--  <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>            
                        </div> -->

                        <div class="text-end pt-1">
                         <h4 class="mb-0"><?= label("Payables", $this, $user) ?></h4>
                         <h5 class="mb-0"><?= label("Amount", $this, $user) ?> :<span id ="payable"></span><br><br>
                         </h5>
                        </div>

                    </div>

                    <hr class="dark horizontal my-0">
                </div>
            </div>
        </div>

 </div>


             
                     <!-- </ul>
                 </div> -->
                 <!-- /.box-body -->
                 <!-- <div class="box-footer text-center">
                     <a href="<?= base_url()?>reports/Analytics/CustomerAnalytics/asc" class="uppercase">View More</a>
                 </div> -->
                 <!-- /.box-footer -->
             </div>

         </div>

       </div>
     </div>
</div>
  
    </div>
  </div>
      
      
      

  



  <script>
    $(document).ready(function () {
                   
    $('#start_date').datepicker("setDate", new Date());
    load();
    $('.loadtable').change(function(){

      load();
    });
});
                function load() {

                    var start_date = $('#start_date').val();
                    var end_date = $('#end_date').val();
                    if (start_date !== "") {

                        $.ajax({
                url: "<?php echo site_url('Dashboard/saleslist'); ?>" ,
                type: 'POST',
                data: {
                    start_date: start_date,end_date:end_date
                },
                success: function(result) {
                    result = JSON.parse(result)
                    var salescount = result.salescount;
                    $.each(salescount, function (index, value) {
                        
                        $('#salescount').html(value.salescount);
                    });
                    var salesvalue = result.salesvalue;
                    $.each(salesvalue, function (index, value) {
                        
                        $('#salesvalue').html(value.salesvalue);
                    });
                    var cashsales = result.cashsales;
                    $.each(cashsales, function (index, value) {
                        
                        $('#cashsales').html(value.cashsales);
                    });
                     var creditsales = result.creditsales;
                    $.each(creditsales, function (index, value) {
                        
                        $('#creditsales').html(value.creditsales);
                    });
                     var banksales = result.banksales;
                    $.each(banksales, function (index, value) {
                        
                        $('#banksales').html(value.banksales);
                    });
                     var estimates = result.estimates;
                    $.each(estimates, function (index, value) {
                        
                        $('#estimates').html(value.estimates);
                    });
                    var estimatesvalue = result.estimatesvalue;
                    $.each(estimatesvalue, function (index, value) {
                        
                        $('#estimatesvalue').html(value.estimatesvalue);
                    });

                     var salereturn = result.salereturn;
                    $.each(salereturn, function (index, value) {
                        
                        $('#salereturn').html(value.salereturn);
                    });
                     var salesreturnvalue = result.salesreturnvalue;
                    $.each(salesreturnvalue, function (index, value) {
                        
                        $('#salesreturnvalue').html(value.salesreturnvalue);
                    });
                     var cashreturn = result.cashreturn;
                    $.each(cashreturn, function (index, value) {
                        
                        $('#cashreturn').html(value.cashreturn);
                    });
                     var creditreturn = result.creditreturn;
                    $.each(creditreturn, function (index, value) {
                        
                        $('#creditreturn').html(value.creditreturn);
                    });
                     var bankreturn = result.bankreturn;
                    $.each(bankreturn, function (index, value) {
                        
                        $('#bankreturn').html(value.bankreturn);
                    });


                    


                 }
            });

            $.ajax({
                url: "<?php echo site_url('Dashboard/purchaselist'); ?>" ,
                type: 'POST',
                data: {
                    start_date: start_date,end_date:end_date
                },
                success: function(result) {
                    result = JSON.parse(result)

                     var purchasecount = result.purchasecount;
                    $.each(purchasecount, function (index, value) {
                        
                        $('#purchasecount').html(value.purchasecount);
                    });

                     var purchasevalue = result.purchasevalue;
                    $.each(purchasevalue, function (index, value) {
                        
                        $('#purchasevalue').html(value.purchasevalue);
                    });

                     var cashpurchase = result.cashpurchase;
                    $.each(cashpurchase, function (index, value) {
                        
                        $('#cashpurchase').html(value.cashpurchase);
                    });

                     var creditpurchase = result.creditpurchase;
                    $.each(creditpurchase, function (index, value) {
                        
                        $('#creditpurchase').html(value.creditpurchase);
                    });

                    var bankpurchase = result.bankpurchase;
                    $.each(bankpurchase, function (index, value) {
                        
                        $('#bankpurchase').html(value.bankpurchase);
                    });

                    var purchaseorder = result.purchaseorder;
                    $.each(purchaseorder, function (index, value) {
                        
                        $('#purchaseorder').html(value.purchaseorder);
                    });

                    var purchaseordervalue = result.purchaseordervalue;
                    $.each(purchaseordervalue, function (index, value) {
                        
                        $('#purchaseordervalue').html(value.purchaseordervalue);
                    });


                 }
            });


            $.ajax({
                url: "<?php echo site_url('Dashboard/paymentreceiptlist'); ?>" ,
                type: 'POST',
                data: {
                    start_date: start_date,end_date:end_date
                },
                success: function(result) {
                    result = JSON.parse(result)

                    var cashpayment = result.cashpayment;
                    $.each(cashpayment, function (index, value) {
                        
                        $('#cashpayment').html(value.cashpayment);
                    });

                    var bankpayment = result.bankpayment;
                    $.each(bankpayment, function (index, value) {
                        
                        $('#bankpayment').html(value.bankpayment);
                    });

                    var cashcollection = result.cashcollection;
                    $.each(cashcollection, function (index, value) {
                        
                        $('#cashcollection').html(value.cashcollection);
                    });

                    var bankcollection = result.bankcollection;
                    $.each(bankcollection, function (index, value) {
                        
                        $('#bankcollection').html(value.bankcollection);
                    });



                 }
            });


              $.ajax({
                url: "<?php echo site_url('Dashboard/totalcollectionlist'); ?>" ,
                type: 'POST',
                data: {
                    start_date: start_date,end_date:end_date
                },
                success: function(result) {
                    result = JSON.parse(result)

                     var collectionvalue = result.collectionvalue;
                     // var collectionvalue1 = result.collectionvalue1;
                     // var totalcollection = collectionvalue + collectionvalue1;
                    $.each(collectionvalue, function (index, value) {
                        
                        $('#totalcollection').html(value.collectionvalue);
                    });


                 }
            });

                 $.ajax({
                url: "<?php echo site_url('Dashboard/receivablelist'); ?>" ,
                type: 'POST',
                data: {
                    start_date: start_date,end_date:end_date
                },
                success: function(result) {
                    result = JSON.parse(result)

                     var receivable = result.receivable;
                    $.each(receivable, function (index, value) {                    
                         $('#receivable').html(value.receivable);
                    });

                     var payable = result.payable;
                    $.each(payable, function (index, value) {                    
                         $('#payable').html(value.payable);
                    });


                 }
            });

                        

                        $.ajax({
                            url: "<?php echo site_url('Dashboard/getMargindash'); ?>",
                            type: 'post',
                            data: {start_date: start_date ,end_date:end_date},
                            success: function (results) {
                                if (results !== "" && results !== null) {
                                    $.each(JSON.parse(results), function (i, itemsingle) {
                                        var totalamount = itemsingle.totalamount;
                                        Highcharts.chart('container', {
                                            chart: {
                                                plotBackgroundColor: null,
                                                plotBorderWidth: null,
                                                plotShadow: false,
                                                type: 'pie'
                                            },
                                            title: {
                                                text: 'Sales ' + start_date + ' to ' + end_date
                                            },
                                            tooltip: {
                                                pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
                                            },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: 'pointer',
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: '<b>{point.name}</b>: {point.y:.1f} Rs.',
                                                    }
                                                }
                                            },
                                            series: [{
                                                    name: 'Percentage',
                                                    colorByPoint: true,
                                                    data: [{
                                                            name: 'Cash',
                                                            Profit: 'Total Profit',
                                                            y: parseFloat(itemsingle.cash)
                                                        },{
                                                            name: 'Bank',
                                                            y: parseFloat(itemsingle.bank)
                                                        },
                                                         {
                                                            name: 'Credit',
                                                            y: parseFloat(itemsingle.credit)
                                                        }]
                                                }]
                                        });
                                    });
                                } else {
                                    Highcharts.chart('container', {
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            type: 'pie'
                                        },
                                        title: {
                                            text: 'Browser market shares in January, 2018'
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                        },
                                        plotOptions: {
                                            pie: {
                                                allowPointSelect: true,
                                                cursor: 'pointer',
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                                }
                                            }
                                        },
                                        series: [{
                                                name: 'Cash Type',
                                                colorByPoint: true,
                                                data: [{
                                                        name: 'Total Sales',
                                                        y: 0.00,
                                                        sliced: true,
                                                        selected: true
                                                    }, {
                                                        name: 'Cash',
                                                        y: 0.00
                                                    },
                                                     {
                                                        name: 'Bank',
                                                        y: 0.00
                                                    }, {
                                                        name: 'Credit',
                                                        y: 0.00
                                                    }]
                                            }]
                                    });
                                }
                            }
                        });
                     $.ajax({
                            url: "<?php echo site_url('Dashboard/getMarginpurchase'); ?>",
                            type: 'post',
                            data: {start_date: start_date,end_date:end_date},
                            success: function (results) {
                                if (results !== "" && results !== null) {
                                    $.each(JSON.parse(results), function (i, itemsingle) {
                                        var totalamount = itemsingle.totalamount;
                                        Highcharts.chart('container2', {
                                            chart: {
                                                plotBackgroundColor: null,
                                                plotBorderWidth: null,
                                                plotShadow: false,
                                                type: 'pie'
                                            },
                                            title: {
                                                text: 'Purchase' + start_date + ' to ' + end_date
                                            },
                                            tooltip: {
                                                pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
                                            },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: 'pointer',
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: '<b>{point.name}</b>: {point.y:.1f} Rs.',
                                                    }
                                                }
                                            },
                                            series: [{
                                                    name: 'Percentage',
                                                    colorByPoint: true,
                                                    data: [{
                                                            name: 'Cash',
                                                            Profit: 'Total Profit',
                                                            y: parseFloat(itemsingle.cash)
                                                        },{
                                                            name: 'Bank',
                                                            y: parseFloat(itemsingle.bank)
                                                        },
                                                         {
                                                            name: 'Credit',
                                                            y: parseFloat(itemsingle.credit)
                                                        }]
                                                }]
                                        });
                                    });
                                } else {
                                    Highcharts.chart('container2', {
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            type: 'pie'
                                        },
                                        title: {
                                            text: 'Browser market shares in January, 2018'
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                        },
                                        plotOptions: {
                                            pie: {
                                                allowPointSelect: true,
                                                cursor: 'pointer',
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                                }
                                            }
                                        },
                                        series: [{
                                                name: 'Cash Type',
                                                colorByPoint: true,
                                                data: [{
                                                        name: 'Total Purchase',
                                                        y: 0.00,
                                                        sliced: true,
                                                        selected: true
                                                    }, {
                                                        name: 'Cash',
                                                        y: 0.00
                                                    },
                                                     {
                                                        name: 'Bank',
                                                        y: 0.00
                                                    }, {
                                                        name: 'Credit',
                                                        y: 0.00
                                                    }]
                                            }]
                                    });
                                }
                            }
                        });
                    }
                }
            </script>


 


  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  