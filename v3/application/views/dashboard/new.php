
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
 
  <!--     Fonts and icons     -->
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <!--<link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.0" rel="stylesheet" /> -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

    <!-- End Navbar -->
    <div class="container-fluid py-4" style="background-color:#D6ECFA;">
      <br>

      <section class="content-header" style="margin-top: -23px;">
     <h1>
         <?= label('Dashboard', $this, $user) ?>
         <small>Version 2.0</small>
     </h1>
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
      <div class="row">
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="height:190px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-cyan" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Sales", $this, $user) ?></h3>
                    <p class="font-weight-bolder">
                      <?= label("Total Sales Count", $this, $user) ?> :<span id ="salescount"> <?php echo $salescount; ?></span><br>
                  <?= label("Sales Value", $this, $user) ?> :<span id ="salesvalue"> <?php echo $salesvalue; ?></span><br>
                  <?= label("Cash", $this, $user) ?> :<span id ="cashsales"> <?php echo $cash; ?></span><br>
                  <?= label("Credit", $this, $user) ?> :<span id ="creditsales"> <?php echo $credit; ?></span><br>
                  <?= label("Bank", $this, $user) ?> : <span id ="banksales"> <?php echo $bank; ?></span><br></p>
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="height:160px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-lime" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Purchase", $this, $user) ?></h3>
                    <p class="font-weight-bolder">
                    <?= label("Total Purchase Count", $this, $user) ?> :<span id ="purchasecount"> <?php echo $purchasecount; ?></span><br>
                  <?= label("Purchase Value", $this, $user) ?> : <span id ="purchasevalue"> <?php echo $purchasevalue; ?></span><br>
                  <?= label("Cash", $this, $user) ?> :<span id ="cashpurchase"> <?php echo $purchasecash; ?></span><br>
                  <?= label("Credit", $this, $user) ?> :<span id ="creditpurchase"> <?php echo $purchasecredit; ?></span><br>
                  <?= label("Bank", $this, $user) ?> :<span id ="bankpurchase"> <?php echo $purchasebank; ?></span><br></p>
                   
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <!-- <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="height:160px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-amber" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Sales Order", $this, $user) ?></h3>
                    <p id="sales"><?= label("Total Sales Order Count", $this, $user) ?> :<span id ="estimates"> <?php echo $estimate; ?></span><br>
                <?= label("Sales Order Value", $this, $user) ?> :<span id ="estimatesvalue"> <?php echo $estimatevalue; ?></span><br></p>
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6" style="height:160px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-blue-grey" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Purchase Order", $this, $user) ?></h3>
                    <p class="font-weight-bolder">
                      <?= label("Total Purchase Order Count", $this, $user) ?> :<span id ="purchaseorder"><?php echo $porder; ?></span><br>
                <?= label("Total Order Value", $this, $user) ?> :<span id ="purchaseordervalue"><?php echo $pordervalue; ?></span><br>
                    </p>
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>

      
        
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div id="container" style="min-width:150px; height: 300px; margin: 0 auto">

                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="container2" style="min-width:150px; height: 300px; margin: 0 auto">

                    </div>
                </div>
            </div>
    
    
     
        <br>

        <br>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="height:190px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-cyan" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Sales Return", $this, $user) ?></h3>
                    <p class="font-weight-bolder">
                      <?= label("Total Sales Return Count", $this, $user) ?> :<span id ="salereturn"><?php echo $sreturn; ?></span><br>
                  <?= label("Sales Return Value", $this, $user) ?> :<span id ="salesreturnvalue"><?php echo $salesreturnvalue; ?></span><br>
                  <?= label("Cash", $this, $user) ?> :<span id ="cashreturn"> <?php echo $cashreturn; ?></span><br>
                  <?= label("Credit", $this, $user) ?> :<span id ="creditreturn"> <?php echo $creditreturn; ?></span><br>
                  <?= label("Bank", $this, $user) ?> :<span id ="bankreturn"> <?php echo $bankreturn; ?></span><br></p>
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="height:160px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-lime" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Total Payment", $this, $user) ?></h3>
                    <p class="font-weight-bolder">
                    <p class="mb-0"><?= label("Cash", $this, $user) ?> :<span id ="cashpayment"><?php echo $cashpayment; ?></span><br>
                  <?= label("Bank", $this, $user) ?> : <span id ="bankpayment"><?php echo $bankpayment; ?></span><br></p>
                   
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="height:160px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-amber" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Total Receipt", $this, $user) ?></h3>
                    <p class="font-weight-bolder" ><?= label("Cash", $this, $user) ?> :<span id ="cashcollection"><?php echo $cashcollection; ?></span><br>
                  <?= label("Bank", $this, $user) ?> :<span id ="bankcollection"><?php echo $bankcollection; ?></span><br>
                      
                    </p>
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6" style="height:160px; width:275px;">
          <div class="card">
            <div class="card-body p-3">
              <div class="w3-panel w3-round-xxlarge w3-blue-grey" style="height:210px; width:240px;">
                <div class="col-8">
                  <div class="numbers">
                    <br>
                    <h3 class="text-sm mb-0 text-uppercase font-weight-bold"><?= label("Total Collection", $this, $user) ?></h3>
                    <p class="font-weight-bolder">
                     <?= label("Total Collection Value", $this, $user) ?> :<span id ="collectionvalue"><?php echo $collectionvalue; ?></span><br>
                    </p>
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
</div>
    </main>


 <script>
        $(document).ready(function () {
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
                                                text: 'Purchase ' + start_date + ' to ' + end_date
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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
</body>

</html>