<form method="post" id="frmcreate" enctype="multipart/form-data"  home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/employee/list_all'); ?>" action="<?php echo site_url('hr/employee/save'); ?>"    class="has-validation-callback form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Employee', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/employee/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body"> 
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-5 control-label tax_id">
                                    <?= label('Employee*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-7">
                                    <input class="clsleave" type="hidden" id="emp_id" name="emp_id"/>
                                    <input name="emp_name" type="text" id="emp_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Employee">
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-5 control-label tax_id">
                                    <?= label('Start Date*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-7">
                                    <input name="start_date" type="text" id="start_date" data-validation="length" data-validation-length="min2"   class="form-control date clsleave" placeholder="Employee">
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-5 control-label tax_id">
                                    <?= label('End Date*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-7">
                                    <input name="end_date" type="text" id="end_date" data-validation="length" data-validation-length="min2"   class="form-control date clsleave" placeholder="Employee">
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-5 control-label tax_id">
                                    <?= label('Base Salary*', $this, $user) ?> <span class="required"></span>  
                                </label>
                                <div class="col-sm-7">
                                    <input name="emp_salary" type="text" id="emp_salary" data-validation="length" data-validation-length="min2" id="emp_salary"  class="form-control" placeholder="Salary">
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-5 control-label tax_id">
                                    <?= label('Month Bonus*', $this, $user) ?> <span class="required"></span>  
                                </label>
                                <div class="col-sm-7">
                                    <input type="hidden" name="emploee_bonus" id="emploee_bonus" value="0"/>
                                    <input name="emp_day_bonus" type="text" id="emp_day_bonus" data-validation="length" data-validation-length="min2" id="emp_salary"  class="form-control" placeholder="Bonus">
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-5 control-label tax_id">
                                    <?= label('Months*', $this, $user) ?> <span class="required"></span>  
                                </label>
                                <div class="col-sm-7">
                                    <input name="diffMonths" type="text" id="diffMonths" data-validation="length" data-validation-length="min2" id="emp_salary"  class="form-control" placeholder="Bonus">
                                    <span id="txteligible" style="display:block" class="required"><?= label('Employee is not eligible*', $this, $user) ?></span>  
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-5 control-label tax_id">
                                    <?= label('Bonus*', $this, $user) ?> <span class="required"></span>  
                                </label>
                                <div class="col-sm-7">
                                    <input name="bonus" type="text" id="bonus" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Bonus">
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <table style="margin:10px !important;" class="table table-striped" >
                                    <tr>
                                        <th><?= label('Leave Type', $this, $user) ?></th>
                                        <th><?= label('Allowed Leaves', $this, $user) ?></th>
                                        <th><?= label('Taken Leaves', $this, $user) ?></th>
                                        <th style="display:none"><?= label('Bonus Precentage', $this, $user) ?></th>
                                        <th><?= label('Exceeded Leaves', $this, $user) ?></th>
                                        <th><?= label('Remaining Leaves', $this, $user) ?></th>
                                        <th><?= label('Deduction', $this, $user) ?></th>
                                        <th><?= label('Earnings', $this, $user) ?></th>
                                    </tr>
                                    <tbody id="rown">
                                        <?php foreach ($leave_types as $leave) { ?>
                                            <tr>
                                                <td><input value="<?php echo $leave['max_deduction_precentage']; ?>" type="hidden" id="max_deduction_precentage<?php echo $leave['leave_id']; ?>"><input value="<?php echo $leave['max_earning_percentage']; ?>" type="hidden" id="max_earning_percentage<?php echo $leave['leave_id']; ?>"><input type="hidden" id="leave_id" name="leave_id[]" value="<?php echo $leave['leave_id']; ?>"><?php echo $leave['leave_name']; ?></td>
                                                <td><?php echo $leave['leave_days']; ?><input value="<?php echo $leave['leave_days']; ?>" type="hidden" name="leave_days[]" id="leave_days<?php echo $leave['leave_id']; ?>"></td>
                                                <td ><font id="taken_leaves<?php echo $leave['leave_id']; ?>">0 </font><input value="0" type="hidden" id="txtleaves<?php echo $leave['leave_id']; ?>"/></td>
                                                <td style="display:none;"><font><?php echo $leave['primary_deduction_precentage']; ?></font><input value="<?php echo $leave['primary_deduction_precentage']; ?>" type="hidden" id="primary_deduction_precentage<?php echo $leave['leave_id']; ?>"></td>
                                                <td><font id="exceed<?php echo $leave['leave_id']; ?>" name="exceed[]"><input value="0" type="hidden" id="leave_exceed<?php echo $leave['leave_id']; ?>" name="leave_exceed[]"></td>
                                                <td><font id="remaining<?php echo $leave['leave_id']; ?>" name="remaining[]"><input value="0" type="hidden" id="leave_remaining<?php echo $leave['leave_id']; ?>" name="leave_remaining[]"></td>
                                                <td><font id="Deduction<?php echo $leave['leave_id']; ?>" name="Deduction[]"><input type="hidden" class="txtDeduction" name="txtDeduction[]" id="txtDeduction<?php echo $leave['leave_id']; ?>"></td>
                                                <td><font id="Earnings<?php echo $leave['leave_id']; ?>" name="Earnings"><input class="txtEarnings" type="hidden" name="txtEarnings[]" id="txtEarnings<?php echo $leave['leave_id']; ?>"></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">          
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           

                        <div class='small-loading' id='FormLoading'> </div>

                    </div>
                </div>
                </section>
                </form>


                <script type="text/javascript">
                    function formatDate(input) {
                        if (input !== null && input !== "") {
                            var datePart = input.match(/\d+/g),
                                    year = datePart[0].substring(0), // get only two digits
                                    month = datePart[1], day = datePart[2];

                            return day + '/' + month + '/' + year;
                        }
                    }
                    function format_Date(input) {
                        if (input !== null && input !== "") {
                            var date = input.split('/');
                            return date[1] + '/' + date[0] + '/' + date[2];
                        }
                    }
                    function monthdiffrence() {



                        var start_date = ($('#start_date').val());
                        var end_date = $('#end_date').val();
                        if (start_date !== "" && end_date !== "") {
                            var points = 0;
                            var end = end_date.split('/');
                            var start = start_date.split('/');
                            var check = parseFloat(end[0]) + 15;
                            if (parseFloat(start[0]) > parseFloat(end[0])) {
                                if (parseFloat(start[0]) <= parseFloat(check)) {
                                    points = 0.5;
                                }
                            }
                            if (parseFloat(start[0]) < parseFloat(end[0])) {
                                check = parseFloat(end[0]) - 15;
                                if (check > 0) {
                                    if (parseFloat(start[0]) <= parseFloat(check)) {
                                        points = 0.5;
                                    }
                                }
                            }
                            start_date = format_Date(start_date);
                            end_date = format_Date(end_date);
                            var usrDate = new Date(start_date);
                            var curDate = new Date(end_date);
                            var usrYear, usrMonth = usrDate.getMonth() + 1;
                            var curYear, curMonth = curDate.getMonth() + 1;
                            if ((usrYear = usrDate.getFullYear()) < (curYear = curDate.getFullYear())) {
                                curMonth += (curYear - usrYear) * 12;
                            }
                            var diffMonths = curMonth - usrMonth;
                            if (usrDate.getDate() > curDate.getDate())
                                diffMonths--;
                        }
                        return diffMonths + points;




//                        var start_date = ($('#start_date').val());
//                        var end_date = $('#end_date').val();
//                        if (start_date !== "" && end_date !== "") {
//                            start_date = format_Date(start_date);
//                            end_date = format_Date(end_date);
//                            var usrDate = new Date(start_date);
//                            var curDate = new Date(end_date);
//                            var usrYear, usrMonth = usrDate.getMonth() + 1;
//                            var curYear, curMonth = curDate.getMonth() + 1;
//                            if ((usrYear = usrDate.getFullYear()) < (curYear = curDate.getFullYear())) {
//                                curMonth += (curYear - usrYear) * 12;
//                            }
//                            var diffMonths = curMonth - usrMonth;
//                            
//                            if (usrDate.getDate() > curDate.getDate())
//                                diffMonths--;
//                        }
//                        return diffMonths;
                    }
                    $(document).ready(function () {
                        $('#form-button-save').attr('disabled', 'disabled');

                        $('.clsleave').change(function () {
                            setbonus();
                            var start_date = $('#start_date').val();
                            var end_date = $('#end_date').val();
                            var emp_id = $('#emp_id').val();
                            var grand_earnings = 0;
                            var grand_deduction = 0;
                            var emp_day_bonus = $('#emp_day_bonus').val();
                            var diffMonths = $('#diffMonths').val();
                            if (emp_id !== "" && parseFloat(diffMonths) >= 18) {
                                $.ajax({
                                    url: "<?php echo site_url('hr/Employee/getemployee_leaves'); ?>",
                                    type: 'POST',
                                    async: false,
                                    data: {emp_id: emp_id, start_date: start_date, end_date: end_date},
                                    success: function (result) {
                                        $.each(JSON.parse(result), function (i, itemsingle) {
                                            $('#txtleaves' + itemsingle.leave_id).val(itemsingle.days);
                                            $('#taken_leaves' + itemsingle.leave_id).html(itemsingle.days);
                                            var leave_days = $('#leave_days' + itemsingle.leave_id).val();
                                            leave_days = leave_days.split("-");
                                            var minimum_leave_days = leave_days[0];
                                            if (leave_days.length > 1) {
                                                leave_days = leave_days[1];
                                            } else {
                                                leave_days = leave_days[0];
                                            }
                                            var months = diffMonths - 12;
                                            var month_leaves = Math.round(parseFloat(leave_days) / 12);
                                            var ext_leaves = Math.round(parseFloat(months) * parseFloat(month_leaves));
                                            if (parseFloat(itemsingle.is_fixed) < 1) {
                                                leave_days = parseFloat(leave_days) + parseFloat(ext_leaves);
                                                minimum_leave_days = parseFloat(minimum_leave_days) + parseFloat(ext_leaves);
                                            } else {
                                                var leave_month_days = parseFloat(leave_days) / 22;
                                                var minimum_month_leave_days = parseFloat(minimum_leave_days) / 22;
                                                leave_days = parseFloat(leave_month_days) * diffMonths;
                                                minimum_leave_days = parseFloat(minimum_month_leave_days) * diffMonths;
                                            }
                                            var taken_leaves = itemsingle.days;
                                            var minimum_remaining = 0;
                                            if (parseFloat(taken_leaves) < parseFloat(minimum_leave_days)) {
                                                var minimum_remaining = parseFloat(minimum_leave_days) - parseFloat(taken_leaves).toFixed(0);
                                                if (minimum_remaining < 1) {
                                                    minimum_remaining = 0;
                                                }
                                            }

                                            if (parseFloat(taken_leaves) < parseFloat(leave_days)) {
                                                var remaining = parseFloat(leave_days) - parseFloat(taken_leaves).toFixed(3);
                                                var exceed = 0;
                                            } else if (parseFloat(taken_leaves) > parseFloat(leave_days)) {
                                                var exceed = parseFloat(taken_leaves) - parseFloat(leave_days).toFixed(3);
                                                var remaining = 0;
                                            } else {
                                                var remaining = 0;
                                                var exceed = 0;
                                            }
                                            $('#exceed' + itemsingle.leave_id).html(exceed.toFixed(0));
                                            $('#remaining' + itemsingle.leave_id).html(minimum_remaining.toFixed(0));
                                            $('#leave_exceed' + itemsingle.leave_id).val(exceed.toFixed(0));
                                            $('#leave_remaining' + itemsingle.leave_id).val(minimum_remaining.toFixed(0));
                                            var primary_deduction_precentage = itemsingle.primary_deduction_precentage;
                                            var pri_deduction_period = itemsingle.pri_deduction_period;
                                            if (pri_deduction_period === 0) {
                                                pri_deduction_period = 1;
                                            }
                                            var primary_deduction = 0;
                                            var base_of_deduction = itemsingle.deduction_base;
                                            var deduct_component = $('#emp_salary').val();
                                            if (base_of_deduction === 'Bonus') {
                                                deduct_component = $('#emp_day_bonus').val();
                                            }
                                            var deduction_amount = 0;
                                            var earning_amount = 0;
                                            if (parseFloat(exceed) > 0) {
                                                if (primary_deduction_precentage > 0) {
                                                    var deduction = parseFloat(deduct_component) * parseFloat(primary_deduction_precentage) / 100;
                                                    var day_deduction = parseFloat(deduction) / parseFloat(pri_deduction_period);
                                                    if (pri_deduction_period >= exceed) {
                                                        deduction_amount = parseFloat(deduction_amount) + (parseFloat(exceed) * parseFloat(day_deduction));
                                                    } else if (pri_deduction_period < exceed) {
                                                        deduction_amount = deduction;
                                                        var sec_deduction_percentage = parseFloat(itemsingle.sec_deduction_percentage);
                                                        var exceed_leaves = parseFloat(exceed) - parseFloat(pri_deduction_period);
                                                        var exceed_deduction = parseFloat(deduct_component) * parseFloat(sec_deduction_percentage) / 100;
                                                        var exceed_deduction_amount = parseFloat(exceed_deduction) * parseFloat(exceed_leaves);
                                                        deduction_amount = parseFloat(deduction_amount) + parseFloat(exceed_deduction_amount);
                                                    }
                                                }
                                            } else {
                                                var pri_earning_percentage = itemsingle.pri_earning_percentage;
                                                day_earning = 0;
                                                if (pri_earning_percentage > 0) {
                                                    var day_earning = parseFloat(deduct_component) * parseFloat(pri_earning_percentage) / 100;
                                                }
                                                var minimum_remaining = parseFloat(minimum_leave_days) - parseFloat(taken_leaves).toFixed(3);
                                                var earning = 0;
                                                if (minimum_remaining > 0) {
                                                    earning = parseFloat(day_earning) * parseFloat(minimum_remaining);
                                                }
                                                earning_amount = parseFloat(earning_amount) + parseFloat(earning);
                                            }
                                            var max_deduction_precentage = $('#max_deduction_precentage' + itemsingle.leave_id).val();
                                            var max_earning_percentage = $('#max_earning_percentage' + itemsingle.leave_id).val();
                                            var max_deduction = parseFloat(deduct_component) * parseFloat(max_deduction_precentage) / 100;
                                            var max_earning = parseFloat(deduct_component) * parseFloat(max_earning_percentage) / 100;
                                            if (parseFloat(max_deduction) < parseFloat(deduction_amount)) {
                                                deduction_amount = max_deduction;
                                            }
                                            if (parseFloat(max_earning) < parseFloat(earning_amount)) {
                                                earning_amount = max_earning;
                                            }
                                            grand_earnings = parseFloat(earning_amount) + parseFloat(grand_earnings);
                                            grand_deduction = parseFloat(grand_deduction) + parseFloat(deduction_amount);
                                            var bonus = parseFloat(emp_day_bonus) + parseFloat(grand_earnings) - parseFloat(grand_deduction);
                                            $('#txtDeduction' + itemsingle.leave_id).val(deduction_amount.toFixed(2));
                                            $('#Deduction' + itemsingle.leave_id).html(deduction_amount.toFixed(2));
                                            $('#txtEarnings' + itemsingle.leave_id).val(earning_amount.toFixed(2));
                                            $('#Earnings' + itemsingle.leave_id).html(earning_amount.toFixed(2));
                                            var ticket = 150 / 22;
                                            var ticket_rate = parseFloat(months) * parseFloat(ticket);
                                            bonus = parseFloat(bonus) + parseFloat(ticket_rate);
                                            $('#bonus').val(bonus.toFixed(2));
                                        });
                                    }

                                });
                            }
                            var diffMonths = monthdiffrence();
                            $('#diffMonths').val(diffMonths);

                            if (diffMonths >= 18) {
                                $('#txteligible').removeAttr('style');
                                $('#txteligible').attr('style', 'display:none');
                                $('#form-button-save').removeAttr('disabled');
                            } else {

                                $('#txteligible').removeAttr('style');
                                $('#txteligible').attr('style', 'display:block;color:red');
                                $('#form-button-save').attr('disabled', 'disabled');
                            }
                        });

                        $("#emp_name").autocomplete({
                            source: "<?php echo site_url('hr/Paysettings/getemployee'); ?>",
                            minLength: 2,
                            select: function (event, ui) {
                                $('#emp_id').val(ui.item.emp_id);
                                $('#emp_salary').val(ui.item.amount);
                                var amount = ui.item.amount;
                                var bonus = 0;
                                if (amount > 0) {
                                    bonus = parseFloat(amount) * 70 / 100;
                                }
                                $('#emp_day_bonus').val(bonus);
                                $('#emploee_bonus').val(bonus);
                                $('.clsleave').trigger("change");
                                setbonus();
                            }
                        });
                    });
                    function setbonus() {
                        var diff = monthdiffrence();
                        var emploee_bonus = $('#emploee_bonus').val();
                        var bonus = emploee_bonus;
                        if (parseFloat(emploee_bonus) > 0 && parseFloat(diff) >= 18) {
                            var monthbonus = parseFloat(emploee_bonus) / 22;
                            if (diff < 22 || diff > 22) {
                                bonus = diff * monthbonus;
                            }
                        }
                        $('#emp_day_bonus').val(bonus);
                    }
                </script>

