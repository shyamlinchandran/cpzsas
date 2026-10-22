<form method="post" id="frmcreate" back="<?php echo site_url('dims_main/Main/listAllCustomer'); ?>" action="<?php echo site_url('dims_main/Main/saveCustomer'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Customer</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('dims_main/Main/listAllCustomer'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('dims_main/Main/listAllCustomer'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Company', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="company" id="company" data-validation="required">

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('E-Mail', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Service', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="service" id="service" data-validation="required">

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Service Amount', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control two-digits" id="samount" name="samount" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Start date', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control date" id="sdate" name="sdate" />
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('End date', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control date" id="edate" name="edate" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">

                            <div class="col-sm-6 form-group">
                                
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Validity', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="validity" name="validity" readonly />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                    </div>
                </div>
                <!-- /.box -->

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        </div>
    </section>
</form>
<script>
    $(document).ready(function() {

        var textService = '';
        var textCompany = '';
        $.ajax({
            url: "<?php echo site_url('dims_main/Main/getServices'); ?>",
            success: function(results) {
                textService = textService + '<option value = "">--Select--</option>';
                $.each(JSON.parse(results), function(i, items) {
                    textService = textService + '<option value = ' + items.id + '>' + items.service + '</option>'
                });
                $('#service').html(textService);
            },
        });

        $.ajax({
            url: "<?php echo site_url('dims_main/Main/getCompany'); ?>",
            success: function(results) {
                textCompany = textCompany + '<option value = "">--Select--</option>';
                $.each(JSON.parse(results), function(i, items) {
                    textCompany = textCompany + '<option value = ' + items.com_id + ' email="' + items.email + '">' + items.name + '</option>'
                });
                $('#company').html(textCompany);
            },
        });

        $('#sdate ,#edate').change(function() {
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();
            var diff = calc_diff(sdate, edate);
            $('#validity').val(diff);
        });

        $('#company').change(function() {
            var email = $('option:selected', this).attr('email');
            $('#email').val(email);
        });

        var id = $("#id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('dims_main/Main/getsing_customer'); ?>/" + id,
                async: true,
                success: function(results) {
                    var result = JSON.parse(results);
                    $("#service").val(result.service);
                    $("#company").val(result.company);
                    $("#email").val(result.email);
                    $("#samount").val(result.samount);
                    var sdate = dateFormat(result.startdate);
                    var edate = dateFormat(result.enddate);
                    $("#sdate").val(sdate);
                    $("#edate").val(edate);
                    var diff = calc_diff(sdate, edate);
                    $('#validity').val(diff);
                    // $("#service").val(result.service);
                }
            });
        }

    });

    function calc_diff(fdate, ldate) {
        var sdate = dateSplit(fdate);
        var edate = dateSplit(ldate);
        var date1 = new Date(sdate);
        var date2 = new Date(edate);
        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        if(Difference_In_Days < 365){
            Difference_In_Days = Difference_In_Days + " Days";
        }else{
            var years = Difference_In_Days / 365;
            var days = Difference_In_Days % 365;
            Difference_In_Days = parseInt(years) + " Years " + parseInt(days) + " Days ";
        }
        return Difference_In_Days;
    }

    function dateSplit(date) {
        var arr = date.split('/');
        var date = arr[1] + '/' + arr[0] + '/' + arr[2];
        return date;
    }

    function dateFormat(date) {
        var arr = date.split('-');
        var date = arr[2] + '/' + arr[1] + '/' + arr[0];
        return date;
    }
</script>