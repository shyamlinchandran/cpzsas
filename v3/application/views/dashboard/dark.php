
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <title>Dark Admin by Bootstrapious.com</title> -->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Choices.js-->
    <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <!-- <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet"> -->
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <style>

      .highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 660px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


    </style>

<div class="page-content" style="background-color: #ECF5FA;">
            <!-- Page Header-->
            <!-- <div class="bg-dash-dark-2 py-4" style="background-color: #353333;">
              <div class="container-fluid">
                <h1 style="color:white">Dashboard</h1>
              </div>
            </div> -->

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
<br>
 <!-- <section class="content">
     <div class="row"> 
        <?php  foreach ($quickmenu as $ms) { ?>
            <a  href="<?= base_url() . $ms['Url'] ?>" class="btn btn-app" style="background-color:#2E86C1;color:white;">
              <i class="<?= $ms['icon'] ?>" ></i><?= $ms['ListName'] ?>
            </a>
        <?php }?>
      </div>
       <br> -->
            
        <section>
          <div class="container-fluid" style="background-color: #ECF5FA;">
            <br>
            <div class="row gy-4">
              <div class="col-md-3 col-sm-6" >
                <div class="card mb-0">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                      <div class="me-2">
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                              <use xlink:href="#user-1"> </use>
                            </svg>
                        <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0"><?= label("Today's Sales", $this, $user) ?></p>
                      </div>
                      <p class="text-xxl lh-1 mb-0 text-dash-color-1"><?= label("Cash", $this, $user) ?> : <?php echo $cash; ?><br>
                         <?= label("Credit", $this, $user) ?> : <?php echo $credit; ?></p>
                    </div>
                    <div class="progress" style="height: 3px">
                      <div class="progress-bar bg-dash-color-1" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="card mb-0">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                      <div class="me-2">
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                              <use xlink:href="#stack-1"> </use>
                            </svg>
                        <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0"><?= label("Today's Purchase", $this, $user) ?></p>
                      </div>
                      <p class="text-xxl lh-1 mb-0 text-dash-color-2"><?php echo $purchase; ?></p>
                    </div>
                    <div class="progress" style="height: 3px">
                      <div class="progress-bar bg-dash-color-2" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="card mb-0">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                      <div class="me-2">
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                              <use xlink:href="#survey-1"> </use>
                            </svg>
                        <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0"><?= label("Sales Order", $this, $user) ?></p>
                      </div>
                      <p class="text-xxl lh-1 mb-0 text-dash-color-3" id="sales"><?php echo $estimate; ?></p>
                    </div>
                    <div class="progress" style="height: 3px">
                      <div class="progress-bar bg-dash-color-3" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="card mb-0">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                      <div class="me-2">
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                              <use xlink:href="#paper-stack-1"> </use>
                            </svg>
                        <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0"><?= label("Purchase Order", $this, $user) ?></p>
                      </div>
                      <p class="text-xxl lh-1 mb-0 text-dash-color-4"><?php echo $porder; ?></p>
                    </div>
                    <div class="progress" style="height: 3px">
                      <div class="progress-bar bg-dash-color-4" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <br>
        <br>

        

        <small style="float: right;margin-right: 100px ; width:150px;"><input type="text" id="date" class="form-control form-control-sm date"></small><br />
        
            <div class="col-sm-12" >
                <div class="col-sm-6">
                    <div id="container" style="min-width:150px; height: 300px; margin: 0 auto ">

                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="barchart" style="min-width:150px; height: 300px; margin: 0 auto">

                    </div>
                </div>
            </div>


        <br>
        <br>
        <section class="pt-0">
          <div class="container-fluid">
            <div class="row gy-4">
              
                     
            </div>
          </div>
        </section>
        <!--  -->
        <section class="pt-0">
          <div class="container-fluid">
            <div class="row d-flex align-items-stretch gy-4">
              <div class="col-lg-4">
                <!-- Sales bar chart-->
                <div class="w3-panel w3-round-xxlarge w3-black" style="height:200px; width:340px;">
                  <div class="card-body">
                    <h3 class="h4 mb-0">Sales Difference</h3>
                    <p class="text-sm fw-light">Lorem ipsum dolor sit</p>
                    <div class="row align-items-end">
                      <div class="col-lg-5">
                        <p class="text-xl fw-light mb-0 text-dash-color-3">$740</p><span class="d-block">May 2017</span><small class="d-block"> 320 Sales</small>
                      </div>
                      <div class="col-lg-7">
                        <canvas id="salesBarChart1"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <!-- Sales bar chart-->
                <div class="w3-panel w3-round-xxlarge w3-black" style="height:200px; width:340px;">
                  <div class="card-body">
                    <h3 class="h4 mb-0">Visit Statistics</h3>
                    <p class="text-sm fw-light">Lorem ipsum dolor sit</p>
                    <div class="row align-items-end">
                      <div class="col-lg-5">
                        <p class="text-xl fw-light mb-0 text-dash-color-1">$457</p><span class="d-block">May 2017</span><small class="d-block"> 210 Sales</small>
                      </div>
                      <div class="col-lg-7">
                        <canvas id="visitPieChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <!-- Sales bar chart-->
                <div class="w3-panel w3-round-xxlarge w3-black" style="height:200px; width:340px;">
                  <div class="card-body">
                    <h3 class="h4 mb-0">Sales Activities</h3>
                    <p class="text-sm fw-light">Lorem ipsum dolor sit</p>
                    <div class="row align-items-end">
                      <div class="col-lg-5">
                        <p class="text-xl fw-light mb-0 text-dash-color-4">80%</p><span class="d-block">May 2017</span><small class="d-block"> +35 Sales</small>
                      </div>
                      <div class="col-lg-7">
                        <canvas id="salesBarChart2"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="pt-0">
          <div class="container-fluid">
            <div class="row gy-4">
              <div class="col-lg-6">
                <div class="w3-panel w3-round-xxlarge w3-black" style="height:450px; width:400px;">
                  <div class="card-body">
                    <br>
                    <h3 class="h4 mb-3">To do list</h3>
                    <form id="checkListForm"> 
                      <div class="p-3">
                        <div class="form-check mb-0 py-1">
                          <br>
                          <input class="form-check-input" type="checkbox" name="input-1" id="input-1" checked>
                          <label class="form-check-label text-gray-600 text-sm" for="input-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                        </div>
                      </div>
                      <div class="p-3 bg-dash-dark-3">
                        <div class="form-check mb-0 py-1">
                          <br>
                          <input class="form-check-input" type="checkbox" name="input-2" id="input-2" checked>
                          <label class="form-check-label text-gray-600 text-sm" for="input-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                        </div>
                      </div>
                      <div class="p-3">
                        <div class="form-check mb-0 py-1">
                          <br>
                          <input class="form-check-input" type="checkbox" name="input-3" id="input-3">
                          <label class="form-check-label text-gray-600 text-sm" for="input-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                        </div>
                      </div>
                      <div class="p-3 bg-dash-dark-3">
                        <div class="form-check mb-0 py-1">
                          <br>
                          <input class="form-check-input" type="checkbox" name="input-4" id="input-4">
                          <label class="form-check-label text-gray-600 text-sm" for="input-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                        </div>
                      </div>
                      <div class="p-3">
                        <div class="form-check mb-0 py-1">
                          <br>
                          <input class="form-check-input" type="checkbox" name="input-5" id="input-5">
                          <label class="form-check-label text-gray-600 text-sm" for="input-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                        </div>
                      </div>
                      <div class="p-3 bg-dash-dark-3">
                        <div class="form-check mb-0 py-1">
                          <br>
                          <input class="form-check-input" type="checkbox" name="input-6" id="input-6">
                          <label class="form-check-label text-gray-600 text-sm" for="input-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                        </div>
                      </div>
                      <div class="p-3">
                        <div class="form-check mb-0 py-1">
                          <br>
                          <input class="form-check-input" type="checkbox" name="input-7" id="input-7">
                          <label class="form-check-label text-gray-600 text-sm" for="input-7">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
          </div>
        </section>
        <section class="pt-0">
          <div class="container-fluid">
            <div class="row gy-4">
              <div class="col-lg-4">
               <div class="w3-panel w3-round-xxlarge w3-black" style="height:300px; width:340px;">
                  <div class="card-body">
                    <h3 class="h4 mb-0">Credit Sales</h3>
                    <p class="text-sm fw-light mb-5">Lorem ipsum dolor sit</p>
                    <div class="position-relative text-center">
                      <canvas id="pieChartHome1"></canvas>
                      <div class="position-absolute top-50 start-50 translate-middle"><strong class="text-lg d-block">$2.145</strong><span class="d-block">Sales</span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="w3-panel w3-round-xxlarge w3-black" style="height:300px; width:340px;">
                  <div class="card-body">
                    <h3 class="h4 mb-0">Channel Sales</h3>
                    <p class="text-sm fw-light mb-5">Lorem ipsum dolor sit</p>
                    <div class="position-relative text-center">
                      <canvas id="pieChartHome2"></canvas>
                      <div class="position-absolute top-50 start-50 translate-middle"><strong class="text-lg d-block">$7.784</strong><span class="d-block">Sales</span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="w3-panel w3-round-xxlarge w3-black" style="height:300px; width:340px;">
                  <div class="card-body">
                    <h3 class="h4 mb-0">Direct Sales</h3>
                    <p class="text-sm fw-light mb-5">Lorem ipsum dolor sit</p>
                    <div class="position-relative text-center">
                      <canvas id="pieChartHome3"></canvas>
                      <div class="position-absolute top-50 start-50 translate-middle"><strong class="text-lg d-block">$4.957</strong><span class="d-block">Sales</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
       
      </div>
    </div>

    <script>
        $(document).ready(function () {
                    load();
                    $('#date').change(function () {
                        load();
                    });
                });

                function load() {

                    var date = $('#date').val();
                    if (date !== "") {
                        $.ajax({
                            url: "<?php echo site_url('Dashboard/getMargindash'); ?>",
                            type: 'post',
                            data: {date: date},
                            success: function (results) {
                                if (results !== "" && results !== null) {
                                    $.each(JSON.parse(results), function (i, itemsingle) {
                                        var totalamount = itemsingle.totalamount;

                                        Highcharts.setOptions({
                                        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                                            return {
                                                radialGradient: {
                                                    cx: 0.5,
                                                    cy: 0.3,
                                                    r: 0.7
                                                },
                                                stops: [
                                                    [0, color],
                                                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                                                ]
                                            };
                                        })
                                    });

                                        Highcharts.chart('container', {
                                            chart: {
                                                plotBackgroundColor: null,
                                                plotBorderWidth: null,
                                                plotShadow: false,
                                                type: 'pie'
                                            },
                                            title: {
                                                text: 'Sales Report ' + date
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
                                                         connectorColor: 'silver'
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
                        
                    }
                }
            </script>


    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/just-validate/js/just-validate.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <script>
      // ------------------------------------------------------- //
      //   Inject SVG Sprite - 
      //   see more here 
      //   https://css-tricks.com/ajaxing-svg-sprite/
      // ------------------------------------------------------ //
      function injectSvgSprite(path) {
      
          var ajax = new XMLHttpRequest();
          ajax.open("GET", path, true);
          ajax.send();
          ajax.onload = function(e) {
          var div = document.createElement("div");
          div.className = 'd-none';
          div.innerHTML = ajax.responseText;
          document.body.insertBefore(div, document.body.childNodes[0]);
          }
      }
      // this is set to BootstrapTemple website as you cannot 
      // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
      // while using file:// protocol
      // pls don't forget to change to your domain :)
      injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
      
      
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>