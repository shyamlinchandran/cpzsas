<section class="content">
    <style>
        .right-aligned-cell{
            text-align:right
        }
    </style> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                    <a style="display: none;" tp="new" target="_blank" id="doc_download" href="<?php echo site_url('uploads/profitloss.xls'); ?>">2345</a>

                <div class="box-header">
                    <h3 class="box-title"><?= label('Profit & Loss', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <form id="frmId" >
                    <div class="box-body table-responsive">
                        <table   class="table <?= $this->table_color ?> table table-hover" cellspacing="0" width="100%">
                            <tbody>
                                <tr>

                                    <td class="col-sm-2">
                                        <?= label('Start Date', $this, $user) ?>
                                        <input type="text" class="form-control date" id="startdate"/>
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('End Date', $this, $user) ?>
                                        <input type="text" class="form-control date" id="enddate"/> 
                                    </td>

                                    <td>
                                        <br/>
                                        <input type="button" class="btn btn-success" id="btn-proft-search"  value="Search"/>
                                        <button type='button' class="cbtn" onclick='printDiv("detaild", "<?= label("Profit & Loss A/C", $this, $user) ?>");'> <i class="glyphicon glyphicon-print"></i> </button>
                                    </td>

                                     <td>
                                        <br>
                                        <button type="button" id="excell_add" name="excell_add" tp="new" target="_blank" class="btn  btn-success align-bottom" href="#">
                                            Get Excel

                                        </button>
                                         </td>
                                </tr>
                            </tbody>
                        </table>                     
                        <br/>
                        <div id="detaild">
                        </div>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<?php $login_comid = $this->session->userdata('login_comid'); ?>
<script type="text/javascript">
    function showledger(toid, ledg) {
        var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            ledg: ledg,
            toid: toid
        });
        createCookie('<?php echo $login_comid?>ledger_cook', JSON.stringify(arr), 3);
        $("#last_click").attr('href', "<?= base_url() ?>reports/accounts/leadger?newpage=new");
        $("#last_click").click();
    }

    function showopenstock() {
        var arr = [];
        var fromdate = $('#startdate').val();
        if (!fromdate) {
            fromdate = '<?php echo date("d/m/Y"); ?>';
        }
        arr.push({
            date: fromdate
        });
        createCookie('<?php echo $login_comid ?>openstockreport_cook', JSON.stringify(arr), 3);
        if ($("#last_click").length > 0) {
            $("#last_click").attr('href', "<?= site_url('reports/OpenStockReport') ?>");
            $("#last_click").click();
        } else {
            window.location.href = "<?= site_url('reports/OpenStockReport') ?>";
        }
    }

    function showclosingstock() {
        var arr = [];
        var todate = $('#enddate').val();
        if (!todate) {
            todate = '<?php echo date("d/m/Y"); ?>';
        }
        arr.push({
            date: todate
        });
        createCookie('<?php echo $login_comid ?>newclosingstockreport_cook', JSON.stringify(arr), 3);
        if ($("#last_click").length > 0) {
            $("#last_click").attr('href', "<?= site_url('reports/NewClosingStockReport') ?>");
            $("#last_click").click();
        } else {
            window.location.href = "<?= site_url('reports/NewClosingStockReport') ?>";
        }
    }
    $(document).ready(function () {
          $('#excell_add').click(function(e) {

            startdate = $("#startdate").val();
            enddate = $("#enddate").val();
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('reports/FinantialReports/export_profit_loss') ?>",
                data: {
                    startdate: startdate,
                    enddate: enddate,
                },
                success: function(str) {
                },
            }).done(function(data) {
              
                jQuery('#doc_download')[0].click();
               
            });

        });

        var result = readCookie('profit_details_cook');
        if (result !== null) {
            results = JSON.parse(result);
            $.each(results, function (index, value) {
                $('#startdate').val(value.stdate);
                $('#enddate').val(value.enddate);
                var fromdate = $('#startdate').val();
                var todate = $('#enddate').val();
                $.ajax({
                    type: "POST",
                    data: {startdate: $('#startdate').val(), enddate: $('#enddate').val()},
                    url: "<?php echo base_url() ?>/reports/FinantialReports/getProfitandLossData",
                    success: function (data) {
                        $("#detaild").html(data);
                        $('#startdate').val(fromdate);
                        $('#enddate').val(todate);
                    }
                }); 
            });
        }
        $('#btn-proft-search').click(function () {
            var arr = [];
            var fromdate = $('#startdate').val();
            var todate = $('#enddate').val();
            arr.push({
                stdate: fromdate,
                enddate: todate,
            });
            createCookie('profit_details_cook', JSON.stringify(arr), 3);
            $.ajax({
                type: "POST",
                data: {startdate: $('#startdate').val(), enddate: $('#enddate').val()},
                url: "<?php echo base_url() ?>/reports/FinantialReports/getProfitandLossData",
                success: function (data) {
                    $("#detaild").html(data);
                    $('#startdate').val(fromdate);
                    $('#enddate').val(todate);
                }
            });
            return;
        });
    });
</script>
