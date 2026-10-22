<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate" back="<?php echo site_url('dims_main/Main/listAllCustomer'); ?>" action="<?php echo site_url('dims_main/Main/saveCustomer'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Add Services to Customer', $this, $user) ?></h3>
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
                            <br>
                            <table class="table table-striped table-condensed col-sm-12">
                                <tr>
                                    <th style="text-align:center" colspan="12"><?= label('Add Services', $this, $user) ?></th>
                                </tr>
                                <tr>
                                    <td class="col-sm-3"><?= label('Service', $this, $user) ?></td>
                                    <td class="col-sm-1"> <?= label('Service Amount', $this, $user) ?></td>
                                    <td class="col-sm-1"> <?= label('Start Date', $this, $user) ?></td>
                                    <td class="col-sm-1"> <?= label('End Date', $this, $user) ?></td>
                                    <td class="col-sm-1"> <?= label('Validity', $this, $user) ?></td>
                                    <td class="col-sm-1"><?= label('Action', $this, $user) ?></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-1"><select class="form-control" name="service" id="service">

                                        </select></td>
                                    <td class="col-sm-1"> <input type="text" class="form-control two-digits" id="samount" name="samount" /></td>
                                    <td class="col-sm-1"> <input type="text" class="form-control date" id="sdate" name="sdate" /></td>
                                    <td class="col-sm-1"> <input type="text" class="form-control date" id="edate" name="edate" /></td>
                                    <td class="col-sm-1"> <input type="text" class="form-control" id="validity" name="validity" readonly /></td>
                                    <td class="col-sm-1"> <a data-toggle="tooltip" title="Add More" id="addmore" class="btn btn-default" href="#">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </a></td>
                                </tr>
                                <tbody id="rowm">

                                </tbody>

                            </table>

                        </div>
                        <div style="float:right;margin-top:50px" class="col-sm-4">
                            <div class="col-sm-5" >
                                <span style="font-size:16px"><b>Grand Total : </b></span>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="grdtot" id="grdtot" readonly />
                            </div>
                        </div>

                    </div>

                    <br style="height:50px">
                    <div class="box-footer">
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <div class='small-loading' id='FormLoading'> </div>
                    </div>
                </div>

                <div class=" hidden">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>

        </div>
        </div>

    </section>
</form>
<script type="text/javascript">
    function addrow(service, service_name, samount, sdate, edate, validity) {
        var singrow = '<td><input type="hidden" value=' + service + '  name="service_id[]" />' +
            '<input value="' + service_name + '"   type="text"  readonly="readonly"   class="form-control"/></td>' +
            '<td  class="col-sm-1"><input type="text" value=' + samount + '  name="samount[]" class="form-control amounts" readonly/></td>' +
            '<td  class="col-sm-1"><input type="text" value=' + sdate + '  name="sdate[]"    class="form-control " readonly/></td>' +
            '<td class="col-sm-1"><input type="text" value=' + edate + '  name="edate[]"    class="form-control" readonly/></td>' +
            '<td class="col-sm-1"><input type="text" value="' + validity + '"  name="validity[]"    class="form-control" readonly/></td>' +
            '<td class="col-sm-1"><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").append(newRow);
        calcTotal();
        
    }

    $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
        calcTotal();
    });

    $(document).ready(function() {

        var textService = '';
        var textCompany = '';

        $.ajax({
            url: "<?php echo site_url('dims_main/Main/getServices'); ?>",
            async: false,
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
            async: false,
            success: function(results) {
                textCompany = textCompany + '<option value = "">--Select--</option>';
                $.each(JSON.parse(results), function(i, items) {
                    textCompany = textCompany + '<option value = ' + items.com_id + ' email="' + items.email + '">' + items.name + '</option>'
                });
                $('#company').html(textCompany);
                load();
            },
        });


        $('#company').change(function() {
            var email = $('option:selected', this).attr('email');
            $('#email').val(email);
        });

        $('#validity').keydown(function(e) {
            var key = e.keyCode;
            if (key == 9 || key == 13) {

                $('#addmore').trigger('click');
            }
        });


        $('#sdate ,#edate').change(function() {

            var sdate = $('#sdate').val();
            var edate = $('#edate').val();
            if (sdate !== '' && edate !== '') {
                var diff = calc_diff(sdate, edate);
                $('#validity').val(diff);
            }
        });

        $("#addmore").click(function() {
            var service = $("#service").val();
            var service_name = $("#service option:selected").text();
            var samount = $('#samount').val();
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();
            var validity = $('#validity').val();
            if (service !== "" && samount !== "" && sdate !== "" && edate !== "") {
                $("#service").val("");
                $('#samount').val("");
                var currentDate = new Date();
                $('#sdate').datepicker("setDate", currentDate);
                $('#edate').datepicker("setDate", currentDate);
                $('#validity').val("");
                addrow(service, service_name, samount, sdate, edate, validity);
            }
        });

    });

    function calcTotal(){
        var total = 0;
        $('.amounts').each(function(){
            total = parseFloat(total) + parseFloat($(this).val());
        })
        $('#grdtot').val(total);
    }

    function load() {
        var id = $('#id').val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('dims_main/Main/getsing_customer') ?>/" + id,
                async: false,
                success: function(results) {
                    var inc = 0;
                    $.each(JSON.parse(results), function(i, items) {
                        inc++;
                        if (inc == 1) {
                            $('#company').val(items.company);
                            $('#email').val(items.email);
                        }
                        var service_name = $('#service [value = ' + items.service + ']').text();
                        var diff = calc_diff(dateFormat(items.startdate), dateFormat(items.enddate));
                        addrow(items.service, service_name, items.samount, dateFormat(items.startdate), dateFormat(items.enddate), diff);
                    });
                }
            });
        }
    }

    function calc_diff(fdate, ldate) {
        var sdate = dateSplit(fdate);
        var edate = dateSplit(ldate);
        var date1 = new Date(sdate);
        var date2 = new Date(edate);
        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        if (Difference_In_Days < 365) {
            Difference_In_Days = Difference_In_Days + " Days";
        } else {
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