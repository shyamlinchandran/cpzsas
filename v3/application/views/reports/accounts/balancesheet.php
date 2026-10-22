<section class="content">
    <style>
        .right-aligned-cell{
            text-align:right
        }
    </style> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?= $this->box_color ?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label('Balance Sheet', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <form id="frmId" >
                    <div class="box-body table-responsive">
                        <table   class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
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
	function showprofitandloss(){
		var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
        });
        createCookie('profit_details_cook', JSON.stringify(arr), 3);
		$("#last_click").attr('href', "<?= base_url() ?>reports/accounts/profitandlossdaywise?newpage=new");
        $("#last_click").click();
	}
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
        createCookie('<?php echo $login_comid?>mainledger_cookie', JSON.stringify(arr), 3);
        $("#last_click").attr('href', "<?= base_url() ?>reports/accounts/mainLeadger?newpage=new");
        $("#last_click").click();
    }
    $(document).ready(function () {

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
                    url: "<?php echo base_url() ?>/reports/accounts/balancesheet_ajax_list",
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
                url: "<?php echo base_url() ?>/reports/accounts/balancesheet_ajax_list",
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
