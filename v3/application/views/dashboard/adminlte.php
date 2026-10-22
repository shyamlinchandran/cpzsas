
<style>
  /* unvisited link */
  a:link {
    color: black;
  }

  /* visited link */
  a:visited {
    color: #095484;
  }

  /* mouse over link */
  a:hover {
    color: white;
  }

  /* selected link */
  a:active {
    color: #800000;
  }

  .inner:hover a {
    color: white;
  }

  .products-list .product-info {
    margin-left: 0px; 
  }
</style>

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->

    <div class="row">
      <div class=" col-sm-12">
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
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info" style="background-color:#5DADE2;">
          <div class="inner">

            <b>
              <h4><?= label("Sales", $this, $user) ?></h4><br>
              <p><?= label("Total Sales Count", $this, $user) ?> :<span id="salescount"> <?php echo $salescount; ?></span><br>
                <a class="clssales" type="" href="<?php echo base_url(); ?>reports/Sales/salesreport"> <?= label("Sales Value", $this, $user) ?> :<span id="salesvalue"> <?php echo $salesvalue; ?></span></a><br>
                <a class="clssales" type="cash" href="<?php echo base_url(); ?>reports/Sales/salesreport"> <?= label("Cash", $this, $user) ?> :<span id="cashsales"> <?php echo $cash; ?></span></a><br>
                <a class="clssales" type="credit" href="<?php echo base_url(); ?>reports/Sales/salesreport"> <?= label("Credit", $this, $user) ?> :<span id="creditsales"> <?php echo $credit; ?></span></a><br>
                <a class="clssales" type="Bank" href="<?php echo base_url(); ?>reports/Sales/salesreport"> <?= label("Bank", $this, $user) ?> : <span id="banksales"> <?php echo $bank; ?></span></a><br>
              </p>
            </b>

          </div>
          <div class="icon">
            <i class="ion ion-social-usd-outline"></i>
          </div>
          <a class="clssalescollection small-box-footer" type="" href="<?php echo base_url(); ?>reports/Collection/sales_collection">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success" style="background-color:#52BE80;">
          <div class="inner">

            <b>
              <h4><?= label("Purchase", $this, $user) ?></h4><br>
              <p><?= label("Total Purchase Count", $this, $user) ?> :<span id="purchasecount"> <?php echo $purchasecount; ?></span><br>
                <a class="clspurchase" type="" href="<?php echo base_url(); ?>reports/purchase/purchasereport"> <?= label("Purchase Value", $this, $user) ?> : <span id="purchasevalue"> <?php echo $purchasevalue; ?></span></a><br>
                <a class="clspurchase" type="cash" href="<?php echo base_url(); ?>reports/purchase/purchasereport"> <?= label("Cash", $this, $user) ?> :<span id="cashpurchase"> <?php echo $purchasecash; ?></span></a><br>
                <a class="clspurchase" type="" href="<?php echo base_url(); ?>reports/purchase/purchasereport"> <?= label("Credit", $this, $user) ?> :<span id="creditpurchase"> <?php echo $purchasecredit; ?></span></a><br>
                <br>
              </p>
            </b>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url(); ?>reports/purchase/purchasereport" class="clspurchase small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning" style="background-color:#F1C40F;">
          <div class="inner" style="height:197px; width:240px">
            <b>
              <h4><?= label("Sales Order", $this, $user) ?></h4><br>
              <a class="clsestimate" type="" href="<?php echo base_url(); ?>reports/Sales/saleorder">
                <p id="sales"><?= label("Total Sales Order Count", $this, $user) ?> :<span id="estimates"> <?php echo $estimate; ?></span>
              </a><br>
              <a class="clsestimate" type="" href="<?php echo base_url(); ?>reports/Sales/saleorder"><?= label("Sales Order Value", $this, $user) ?> :<span id="estimatesvalue"> <?php echo $estimatevalue; ?></span></a><br></p>
            </b>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a type="" href="<?php echo base_url(); ?>reports/Sales/saleorder" class="clsestimate small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger" style="background-color:#E74C3C;">
          <div class="inner" style="height:197px; width:240px">

            <b>
              <h4><?= label("Purchase Order", $this, $user) ?></h4><br>
              <p><?= label("Total Purchase Order Count", $this, $user) ?> :<span id="purchaseorder"><?php echo $porder; ?></span><br>
                <?= label("Total Order Value", $this, $user) ?> :<span id="purchaseordervalue"><?php echo $pordervalue; ?></span><br></p>
            </b>

          </div>
          <div class="icon">
            <i class="ion ion-social-buffer"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="row">

      <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
        <div id="container" style="min-width:100%; height: 300px; margin: 0 auto ">

        </div>
      </div>
      <div class="col-md-6  col-xs-12" style="margin-top: 10px;">
        <div id="container2" style="min-width:100%; height: 300px; margin: 0 auto ">

        </div>
      </div>
    </div>
    <br /> 
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info" style="background-color:#5DADE2;">
          <div class="inner">

            <b>
              <h4><?= label("Sales Return", $this, $user) ?></h4><br>
              <p><?= label("Total Sales Return Count", $this, $user) ?> :<span id="salereturn"><?php echo $sreturn; ?></span><br>
                <a class="clssalesreturn" type="" href="<?php echo base_url(); ?>reports/Sales/salesreturn"> <?= label("Sales Return Value", $this, $user) ?> :<span id="salesreturnvalue"><?php echo $salesreturnvalue; ?></span></a><br>
                <a class="clssalesreturn" type="cash" href="<?php echo base_url(); ?>reports/Sales/salesreturn"> <?= label("Cash", $this, $user) ?> :<span id="cashreturn"> <?php echo $cashreturn; ?></span></a><br>
                <a class="clssalesreturn" type="credit" href="<?php echo base_url(); ?>reports/Sales/salesreturn"> <?= label("Credit", $this, $user) ?> :<span id="creditreturn"> <?php echo $creditreturn; ?></span></a><br>
                <a class="clssalesreturn" type="Bank" href="<?php echo base_url(); ?>reports/Sales/salesreturn"> <?= label("Bank", $this, $user) ?> :<span id="bankreturn"> <?php echo $bankreturn; ?></span></a><br>
              </p>
            </b>

          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a type="" href="<?php echo base_url(); ?>reports/Sales/salesreturn" class="clssalesreturn small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success" style="background-color:darkgrey;">
          <div class="inner" style="height:197px; width:240px">

            <b>
              <h4><?= label("Payment", $this, $user) ?></h4><br>
              <a type="" class="clspayment" type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/payment"> <?= label("Total Payment", $this, $user) ?> :<span id="totpayment"></span></a><br></p>
            </b>
            <a type="4" class="clspayment" type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/payment"> <?= label("Cash", $this, $user) ?> : <span id="bankpayment"><?php echo $bankpayment; ?></span></a><br></p></b>
            <a type="1" class="clspayment" type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/payment">
              <p><?= label("Bank", $this, $user) ?> :<span id="cashpayment"><?php echo $cashpayment; ?></span><br>
            </a>
          </div>
          <div class="icon">
            <i class="ion ion-help-buoy"></i>
          </div>
          <a type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/payment" class="clspayment small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning" style="background-color:#E298CD;">
          <div class="inner" style="height:197px; width:240px">
            <b>
              <h4><?= label("Receipt", $this, $user) ?></h4><br>
              <a type="" class="clsreceipt" type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/receipt"> <?= label("Total Receipt", $this, $user) ?> :<span id="totcollection"></span></a><br></p>
            </b>
            <a type="4" class="clsreceipt" type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/receipt"> <?= label("Cash", $this, $user) ?> :<span id="bankcollection"></span></a><br></p></b>
            <p> <a type="1" class="clsreceipt" type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/receipt"> <?= label("Bank", $this, $user) ?> :<span id="cashcollection"></span></a><br>
          </div>
          <div class="icon">
            <i class="ion ion-briefcase"></i>
          </div>
          <a type="" href="<?php echo base_url(); ?>transaction/vouchers/list_all/receipt" class="clsreceipt small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger" style="background-color:#52BE80;">
          <div class="inner" style="height:197px; width:240px">

            <b>
              <h4><?= label("Total Collection", $this, $user) ?></h4><br>
              <a class="clscollection" type="" href="<?php echo base_url(); ?>reports/Collection/period_collection">
                <p><?= label("Collection Value", $this, $user) ?> :<span id="totalcollection"> </span>
              </a><br></p>
            </b>

          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?>reports/Collection/period_collection" class="clscollection small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning" style="background-color:#0EB99F;">
          <div class="inner" style="height:197px; width:240px">
            <b>
              <h4><?= label("Receivables", $this, $user) ?></h4><br>
              <a class="" type="" href="<?php echo base_url(); ?>reports/Ledger_balance/ledger_balance/cus">
                <p><?= label("Amount", $this, $user) ?> :<span id="receivable"></span><br>
              </a>
              </p>
            </b>
          </div>
          <div class="icon">
            <i class="ion ion-archive"></i>
          </div>
          <a href="<?php echo base_url(); ?>reports/Ledger_balance/ledger_balance/cus" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning" style="background-color:#D79FF4;">
          <div class="inner" style="height:197px; width:240px">
            <b>
              <h4><?= label("Payables", $this, $user) ?></h4><br>
              <a class="" type="" href="<?php echo base_url(); ?>reports/Ledger_balance/ledger_balance/sup">
                <p><?= label("Amount", $this, $user) ?> :<span id="payable"></span>
              </a><br>
              </p>
            </b>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="<?php echo base_url(); ?>reports/Ledger_balance/ledger_balance/sup" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success" style="background-color:darkgrey;">
          <div class="inner" style="height:197px; width:240px">

            <b>
              <h4><?= label("Stock Value", $this, $user) ?></h4><br>
              <a class="" type="" href="<?php echo base_url(); ?>reports/Items/listall"> <span id="stockvalue"></span><br></p>
            </b></a>

          </div>
          <div class="icon">
            <i class="ion ion-help-buoy"></i>
          </div>
          <a href="<?php echo base_url(); ?>reports/Items/listall" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success" style="background-color:#5DADE2;">
          <div class="inner" style="height:197px; width:240px">

            <b>
              <h4><?= label("Cash / BANK", $this, $user) ?></h4><br>
              <p><?= label("Cash", $this, $user) ?> :<span id="cashbalance"> </span><br></p>
              <p><?= label("Bank", $this, $user) ?> :<span id="bankbalance"> </span><br></p>
            </b>

          </div>
          <div class="icon">
            <i class="ion ion-help-buoy"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>


    <!-- /.box-footer -->
  </div>

  </div>

  </div>
  </div>
  </div>

  </div>
</section>
<?php $login_comid = $this->session->userdata('login_comid'); ?>

<script>
  $(document).ready(function() {
    $('.clscollection').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      arr.push({
        stdate: fromdate,
        enddate: todate
      });
      createCookie('<?php echo $login_comid; ?>_period_collection', JSON.stringify(arr), 3);
    });
    $('.clsreceipt').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      var paytype = $(this).attr('type');
      arr.push({
        stdate: fromdate,
        enddate: todate,
        paytype: paytype
      });
      createCookie('<?php echo $login_comid; ?>receiptreport_cook', JSON.stringify(arr), 3);
    });
    $('.clspayment').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      var paytype = $(this).attr('type');
      arr.push({
        stdate: fromdate,
        enddate: todate,
        paytype: paytype
      });
      createCookie('<?php echo $login_comid; ?>paymentreport_cook', JSON.stringify(arr), 3);
    });
    $('.clssalesreturn').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      var chrq_status = $(this).attr('type');
      arr.push({
        stdate: fromdate,
        enddate: todate,
        chrq_status: chrq_status,
      });
      createCookie('<?php echo $login_comid ?>sales_return_sale_report_cook', JSON.stringify(arr), 3);
    });
    $('.clsestimate').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      var chrq_status = $(this).attr('type');
      arr.push({
        stdate: fromdate,
        enddate: todate,
      });
      createCookie('<?php echo $login_comid; ?>estimate_sale_report_cook', JSON.stringify(arr), 3);
    });
    $('.clssalescollection').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      var chrq_status = $(this).attr('type');
      arr.push({
        stdate: fromdate,
        enddate: todate,
      });
      createCookie('<?php echo $login_comid ?>_sales_collection', JSON.stringify(arr), 3);
    });


    $('.clssales').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      var chrq_status = $(this).attr('type');
      arr.push({
        stdate: fromdate,
        enddate: todate,
        chrq_status: chrq_status,
      });
      createCookie('<?php echo $login_comid ?>sales_report_cook', JSON.stringify(arr), 3);
    });
    $('.clspurchase').click(function() {
      var arr = [];
      var fromdate = $('#start_date').val();
      var todate = $('#end_date').val();
      var chrq_status = $(this).attr('type');
      arr.push({
        stdate: fromdate,
        enddate: todate,
        chrq_status: chrq_status,
      });
      createCookie('<?php echo $login_comid; ?>purchase_purchase_report_cook', JSON.stringify(arr), 3);
    });

    $.ajax({
      url: "<?php echo site_url('Dashboard/stockvalue'); ?>",
      type: 'POST',
      data: {
        end_date: $('#end_date').val()
      },
      success: function(result) {
        $('#stockvalue').html(parseFloat(result).toFixed(2));


      }
    });

    // var currentDate = new Date();
    // var dd = currentDate.getDate();
    // var today = currentDate;
    // var mm = today.getMonth();
    // var yyyy = today.getFullYear();
    //     if (parseFloat(mm) < 1) {
    //         mm = 12;
    //         yyyy = yyyy - 1;
    //     }
    //     var sdate = (mm + '/' + dd + '/' + yyyy);

    $('#start_date').datepicker("setDate", new Date());
    load();
    $('.loadtable').change(function() {

      load();
    });
  });


  function load() {


    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    // var date = $('#date').val();
    if (start_date !== "") {

      $.ajax({
        url: "<?php echo site_url('Dashboard/saleslist'); ?>",
        type: 'POST',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(result) {
          result = JSON.parse(result)
          var salescount = result.salescount;
          $.each(salescount, function(index, value) {

            $('#salescount').html(value.salescount);
          });
          var salesvalue = result.salesvalue;
          $.each(salesvalue, function(index, value) {

            $('#salesvalue').html(value.salesvalue);
          });
          var cashsales = result.cashsales;
          $.each(cashsales, function(index, value) {

            $('#cashsales').html(value.cashsales);
          });
          var creditsales = result.creditsales;
          $.each(creditsales, function(index, value) {

            $('#creditsales').html(value.creditsales);
          });
          var banksales = result.banksales;
          $.each(banksales, function(index, value) {

            $('#banksales').html(value.banksales);
          });
          var estimates = result.estimates;
          $.each(estimates, function(index, value) {

            $('#estimates').html(value.estimates);
          });
          var estimatesvalue = result.estimatesvalue;
          $.each(estimatesvalue, function(index, value) {

            $('#estimatesvalue').html(value.estimatesvalue);
          });

          var salereturn = result.salereturn;
          $.each(salereturn, function(index, value) {

            $('#salereturn').html(value.salereturn);
          });
          var salesreturnvalue = result.salesreturnvalue;
          $.each(salesreturnvalue, function(index, value) {

            $('#salesreturnvalue').html(value.salesreturnvalue);
          });
          var cashreturn = result.cashreturn;
          $.each(cashreturn, function(index, value) {

            $('#cashreturn').html(value.cashreturn);
          });
          var creditreturn = result.creditreturn;
          $.each(creditreturn, function(index, value) {

            $('#creditreturn').html(value.creditreturn);
          });
          var bankreturn = result.bankreturn;
          $.each(bankreturn, function(index, value) {

            $('#bankreturn').html(value.bankreturn);
          });





        }
      });

      $.ajax({
        url: "<?php echo site_url('Dashboard/purchaselist'); ?>",
        type: 'POST',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(result) {
          result = JSON.parse(result)

          var purchasecount = result.purchasecount;
          $.each(purchasecount, function(index, value) {

            $('#purchasecount').html(value.purchasecount);
          });

          var purchasevalue = result.purchasevalue;
          $.each(purchasevalue, function(index, value) {

            $('#purchasevalue').html(value.purchasevalue);
          });

          var cashpurchase = result.cashpurchase;
          $.each(cashpurchase, function(index, value) {

            $('#cashpurchase').html(value.cashpurchase);
          });

          var creditpurchase = result.creditpurchase;
          $.each(creditpurchase, function(index, value) {

            $('#creditpurchase').html(value.creditpurchase);
          });

          var bankpurchase = result.bankpurchase;
          $.each(bankpurchase, function(index, value) {

            $('#bankpurchase').html(value.bankpurchase);
          });

          var purchaseorder = result.purchaseorder;
          $.each(purchaseorder, function(index, value) {

            $('#purchaseorder').html(value.purchaseorder);
          });

          var purchaseordervalue = result.purchaseordervalue;
          $.each(purchaseordervalue, function(index, value) {

            $('#purchaseordervalue').html(value.purchaseordervalue);
          });


        }
      });


      $.ajax({
        url: "<?php echo site_url('Dashboard/paymentreceiptlist'); ?>",
        type: 'POST',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(result) {
          result = JSON.parse(result)
          var totpayment = 0;
          var cashpayment = result.cashpayment;
          $.each(cashpayment, function(index, value) {
            totpayment = parseFloat(totpayment) + parseFloat(value.cashpayment);
            $('#cashpayment').html(value.cashpayment);
          });

          var bankpayment = result.bankpayment;
          $.each(bankpayment, function(index, value) {
            totpayment = parseFloat(totpayment) + parseFloat(value.bankpayment);
            $('#bankpayment').html(value.bankpayment);
          });
          $('#totpayment').html(totpayment);
          var totcollection = 0;
          var cashcollection = result.cashcollection;
          $.each(cashcollection, function(index, value) {
            totcollection = parseFloat(totcollection) + parseFloat(value.cashcollection);
            $('#cashcollection').html(value.cashcollection);
          });

          var bankcollection = result.bankcollection;
          $.each(bankcollection, function(index, value) {
            totcollection = parseFloat(totcollection) + parseFloat(value.bankcollection);
            $('#bankcollection').html(value.bankcollection);
          });

          $('#totcollection').html(totcollection);

        }
      });


      $.ajax({
        url: "<?php echo site_url('Dashboard/totalcollectionlist'); ?>",
        type: 'POST',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(result) {
          result = JSON.parse(result);

          $('#totalcollection').html(result.total);


        }
      });


      $.ajax({
        url: "<?php echo site_url('Dashboard/stockvalue'); ?>",
        type: 'POST',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(result) {
          $('#stockvalue').html(parseFloat(result).toFixed(2));


        }
      });

      $.ajax({
        url: "<?php echo site_url('Dashboard/cashbankcollection'); ?>",
        type: 'POST',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(result) {
          result = JSON.parse(result);
          $.each(result, function(index, value) {
            if (parseFloat(value.acc_main_id) === 1) {
              $('#bankbalance').html(parseFloat(value.balance).toFixed(2));
            }
            if (parseFloat(value.acc_main_id) === 4) {
              $('#cashbalance').html(parseFloat(value.balance).toFixed(2));
            }
          });


        }
      });



      $.ajax({
        url: "<?php echo site_url('Dashboard/receivablelist'); ?>",
        type: 'POST',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(result) {
          result = JSON.parse(result)

          var receivable = result.receivable;
          $.each(receivable, function(index, value) {
            $('#receivable').html(value.receivable);
          });

          var payable = result.payable;
          $.each(payable, function(index, value) {
            $('#payable').html(parseFloat(value.payable));
            if (parseFloat(value.payable) < 0) {
              $('#payable').html(parseFloat(value.payable) * -1);
            }
          });


        }
      });



      $.ajax({
        url: "<?php echo site_url('Dashboard/getMargindash'); ?>",
        type: 'post',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(results) {
          if (results !== "" && results !== null) {
            $.each(JSON.parse(results), function(i, itemsingle) {
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
                    }, {
                      name: 'Bank',
                      y: parseFloat(itemsingle.bank)
                    },
                    {
                      name: 'Credit',
                      y: parseFloat(itemsingle.credit)
                    }
                  ]
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
                  }
                ]
              }]
            });
          }
        }
      });
      $.ajax({
        url: "<?php echo site_url('Dashboard/getMarginpurchase'); ?>",
        type: 'post',
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(results) {
          if (results !== "" && results !== null) {
            $.each(JSON.parse(results), function(i, itemsingle) {
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
                    }, {
                      name: 'Bank',
                      y: parseFloat(itemsingle.bank)
                    },
                    {
                      name: 'Credit',
                      y: parseFloat(itemsingle.credit)
                    }
                  ]
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
                  }
                ]
              }]
            });
          }
        }
      });
    }
  }
</script>