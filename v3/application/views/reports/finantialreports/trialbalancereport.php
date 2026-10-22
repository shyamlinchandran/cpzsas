<section class="content">
    <style>
        .right-aligned-cell{
            text-align:right
        }
    </style> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title"><?= label('Trial Balance', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <form id="frmId" >
                    <a style="display: none;" tp="new" target="_blank" id="doc_download" href="<?php echo site_url('uploads/trailbalance.xls'); ?>">2345</a>
                    <a style="display: none;" tp="new" target="_blank" id="pdf_download" href="<?php echo site_url('uploads/trailbalance.pdf'); ?>">pdf</a>

                    <div class="box-body table-responsive">
                        <table   class="table <?= $this->table_color ?> table table-hover" cellspacing="0" width="100%">
                            <tbody>
                                <tr>

                                    <td class="col-sm-2">
                                        <?= label('End Date', $this, $user) ?>
                                        <input type="text" class="form-control date" id="enddate"/> 
                                    </td>

                                    <td>
                                        <br/>
                                        <input type="button" class="btn btn-success" id="btn-proft-search"  value="Search"/>
                                        <button type='button' class="cbtn" onclick='printDiv("detaild", "<?= label("Profit & Loss A/C", $this, $user) ?>");'> <i class="glyphicon glyphicon-print"></i> </button>
                                        <label style="margin-left:10px;">
                                            <input type="checkbox" id="include_details">  Opening Details
                                        </label>
                                    </td>

                                     <td>
                                        <br>
                                        <button type="button" id="excell_add" name="excell_add" tp="new" target="_blank" class="btn  btn-success align-bottom" href="#">
                                            Get Excel

                                        </button>
                                         </td>

                                         <td>

                                           <button type="button" id="pdf_add" name="pdf_add" class="btn btn-danger align-bottom">
        Get PDF
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
        var fromdate = '';
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
    $(document).ready(function () {


        $('#excell_add').click(function(e) {

            startdate = $("#startdate").val();
            enddate = $("#enddate").val();
            var includeDetails = $('#include_details').is(':checked') ? 1 : 0;
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('reports/FinantialReports/export_transactions') ?>",
                data: {
                    startdate: startdate,
                    enddate: enddate,
                    includeDetails:includeDetails
                },
                success: function(str) {
                },
            }).done(function(data) {
              
                jQuery('#doc_download')[0].click();
               
            });

        });




        var result = readCookie('trail_details_cook');
        if (result !== null) {
            results = JSON.parse(result);
            $.each(results, function (index, value) {
                var includeDetails = $('#include_details').is(':checked') ? 1 : 0;
                $('#startdate').val(value.stdate);
                var fromdate = $('#startdate').val();
                var todate = $('#enddate').val();
                $.ajax({
                    type: "POST",
                    data: {includeDetails:includeDetails, enddate: $('#enddate').val()},
                    url: "<?php echo base_url() ?>/reports/FinantialReports/getTrialBalanceData",
                    success: function (data) {
                        $("#detaild").html(data);
                        $('#enddate').val(todate);
                    }
                }); 
            });
        }
        $('#btn-proft-search').click(function () {
            var arr = [];
            var todate = $('#enddate').val();
            arr.push({
                enddate: todate,
            });
            createCookie('trail_details_cook', JSON.stringify(arr), 3);
            var includeDetails = $('#include_details').is(':checked') ? 1 : 0;
            $.ajax({
                type: "POST",
                data: {includeDetails:includeDetails,enddate: $('#enddate').val()},
                url: "<?php echo base_url() ?>/reports/FinantialReports/getTrialBalanceData",
                success: function (data) {
                    $("#detaild").html(data);
                    $('#enddate').val(todate);
                }
            });
            return;
        });
    });

    $('#pdf_add').click(function(e) {
        enddate = $("#enddate").val();
        var includeDetails = $('#include_details').is(':checked') ? 1 : 0;
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('reports/FinantialReports/export_transactions_pdf') ?>",
            data: {
                enddate: enddate,
                includeDetails: includeDetails
            },
            success: function(response) {
                jQuery('#pdf_download')[0].click();
            },
        });
    });
</script>
