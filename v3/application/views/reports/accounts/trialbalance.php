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
                    <h3 class="box-title"><?= label('Trial Balance', $this, $user) ?></h3>
                </div>
                <a style="display: none;" tp="new" target="_blank" id="doc_download" href="<?php echo site_url('uploads/GSTR1.xls'); ?>">2345</a>

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
                                    <td style="text-align:right" class="col-sm-2">
                                    <br />
                                        <input checked type="checkbox" id="console" name="console" value="1">
                                        <label for="console"> Console</label><br>
                                    </td> 
                                    <td>
                                        <br/>
                                        <input type="button" class="btn btn-success" id="btn-proft-search"  value="Search"/>
                                        <button type='button' class="cbtn" onclick='printDiv("detaild", "<?= label("Profit & Loss A/C", $this, $user) ?>");'> <i class="glyphicon glyphicon-print"></i> </button>
                                        <button role="button" id="excell_add" name="excell_add"  class="btn  btn-success align-bottom" href="#!">
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
	function setconsole(){
        if($('#console').is(":checked")){
           $('.table_sub').attr('style','display:none');
           $('.clsmain').attr('style','');
        }else{
            $('.table_sub').attr('style','');
            $('.clsmain').attr('style','display:none');
        }
    }
    
    $(document).ready(function () {
        $('#console').change(function(){
            setconsole();

        });
        var result = readCookie('trial_details_cook');
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
                    url: "<?php echo base_url() ?>/reports/accounts/trail_ajax_list",
                    success: function (data) {
                        $("#detaild").html(data);
                        $('#startdate').val(fromdate);
                        $('#enddate').val(todate);
                        setconsole();
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
            createCookie('trial_details_cook', JSON.stringify(arr), 3);
            $.ajax({
                type: "POST",
                data: {startdate: $('#startdate').val(), enddate: $('#enddate').val()},
                url: "<?php echo base_url() ?>/reports/accounts/trail_ajax_list",
                success: function (data) {
                    $("#detaild").html(data);
                    $('#startdate').val(fromdate);
                    $('#enddate').val(todate);
                    setconsole();
                }
            });
            return;
        });
    });


    $('#excell_add').click(function(e) {
            e.preventDefault();
            startdate = $("#startdate").val();
            enddate = $("#enddate").val();
            if(startdate !== '' && enddate !=='' ){
                startdate = startdate.replace('/', "-");
                startdate = startdate.replace('/', "-");
                

                enddate = enddate.replace('/', "-");
                enddate = enddate.replace('/', "-");
                $('#doc_download').attr('href','<?php echo base_url() ?>reports/accounts/excel/'+startdate+'/'+enddate);
                jQuery('#doc_download')[0].click();
            }
         

            });
</script>
