<?php
if ($type == "create") {
    $add_url = site_url('hr/SalaryDistribution/save');
} else
if ($type == "pay") {
    $add_url = site_url('hr/SalaryDistribution/save_payment');
}
?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/SalaryDistribution/list_all'); ?>" action="<?php echo $add_url; ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="distribution_id" id="distribution_id"/>  
    <input type="hidden" name="type" id='type' value="<?php echo $type; ?>"/>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php if ($type == "pay") { ?>  <?= label('Make Payent', $this, $user) ?><?php } else { ?><?= label('Salary Distribution', $this, $user) ?><?php } ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/SalaryDistribution/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body"> 
                        <div class="col-sm-12">
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Year*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="year" name="year">
                                        <?php
                                        for ($i = 2019; $i <= 2030; $i++) {
                                            print '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Month*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <select data-validation="required" class="form-control" <?php
                                    if ($type == "pay") {
                                        echo 'readonly="readonly"';
                                    }
                                    ?> id="month" name="month" size='1'>
                                        <option value="">-----------Select-----------</option>
                                        <?php
                                        for ($i = 0; $i < 12; $i++) {
                                            $time = strtotime(sprintf('%d months', $i));
                                            $label = date('F', $time);
                                            $value = date('n', $time);
                                            echo "<option  class='clsoption' value='$value'>$label</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php if ($type == "pay") { ?>
                                <div class="col-sm-4 form-group">
                                    <label class="col-sm-6 control-label tax_id">
                                        <?= label('Paying Date*', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="pay_date" id="pay_date" class="form-control date"/> 
                                    </div>
                                </div>
                            <?php } ?>                           
                        </div>
                        <div class="col-sm-12">
                            <?php if ($type == "pay") { ?>
                                <h4>Select Employees To be Paid</h4>
                            <?php } ?>                           
                            <table id="tbldist" class="table table-condensed table-striped" >
                                <tr>
                                    <th <?php
                                    if ($type != 'pay') {
                                        echo 'style="display:none"';
                                    }
                                    ?>><input id="checkall" type="checkbox" class="checkall"/></th>
                                    <th><?= label('Employee', $this, $user) ?></th>
                                    <th><?= label('Ledger Balance', $this, $user) ?></th>
                                    <th <?php
                                    if ($type == "pay") {
                                        echo 'style="display:none"';
                                    }
                                    ?>><?= label('Allowed Leaves', $this, $user) ?></th>
                                    <th <?php
                                    if ($type == "pay") {
                                        echo 'style="display:none"';
                                    }
                                    ?>><?= label('Taken Leaves', $this, $user) ?></th>
                                    <th><?= label('Leaves', $this, $user) ?></th>
                                    <th><?= label('Extra Leaves', $this, $user) ?></th>
                                    <?php foreach ($components as $item) { ?>
                                        <th style="text-align:center" <?php if($item['pay_type'] == 'Earnings'){echo 'style="color:green" '; }else{ echo 'style="color:red" '; } ?> ><?= label($item['pay_name'], $this, $user) ?></th>
                                    <?php } ?>
                                    <th <?php
                                    if ($type == "pay") {
                                        echo 'style="display:none"';
                                    }
                                    ?>><?= label('Total', $this, $user) ?></th>
                                    <th><?= label('Balance', $this, $user) ?></th>
                                    <?php if ($type == "pay") { ?>
                                        <th><?= label('paid', $this, $user) ?></th>
                                        <th><?= label('Paying', $this, $user) ?></th>
                                    <?php } ?>
                                </tr>
                                <tbody id="rowm">
                                    <tr>
                                        <?php $text = ''; ?>
                                        <?php
                                        foreach ($employee as $emp) {
                                            $i = 6;
                                            $text = '';
                                            ?>
                                            <td  <?php
                                            if ($type != 'pay') {
                                                echo 'style="display:none"';
                                            }
                                            ?>><input empid="<?php echo $emp['emp_id']; ?>" ledger_id ="<?php echo $emp['ledger_id']; ?>" name="check<?php echo $emp['emp_id']; ?>" type="checkbox" class="emp_id"> </td>
                                            <td><input type="text" class="form-control"  readonly="readonly" name="employee"  value="<?php echo $emp['pro_fname']; ?>" id="employee"/><input class="" value="<?php echo $emp['emp_id']; ?>" type="hidden" name="emp_id[]"/></td>
                                            <th><input readonly="readonly" class="form-control"readonly="readonly" type="text" name="ledger_balance<?php echo $emp['emp_id']; ?>[]" id="ledger_balance<?php echo $emp['emp_id']; ?>"/></th>
                                            <td <?php
                                            if ($type == "pay") {
                                                echo 'style="display:none"';
                                            }
                                            ?>><input type="text" class="form-control"  readonly="readonly" name="allowed_leaves<?php echo $emp['emp_id']; ?>"  value="<?php echo $emp['allowed_leaves']; ?>" id="allowed_leaves<?php echo $emp['emp_id']; ?>"/></td>
                                            <td <?php
                                            if ($type == "pay") {
                                                echo 'style="display:none"';
                                            }
                                            ?>><input type="text" class="form-control"  readonly="readonly" name="taken_leaves<?php echo $emp['emp_id']; ?>"  value="0" id="taken_leaves<?php echo $emp['emp_id']; ?>"/></td>
                                            <td><input <?php
                                                if ($type == "pay") {
                                                    echo 'readonly="readonly"';
                                                }
                                                ?> class="form-control digits price" type="text" name="leaves<?php echo $emp['emp_id']; ?>" id="leaves<?php echo $emp['emp_id']; ?>"/></td>
                                            <td><input <?php
                                                if ($type == "pay") {
                                                    echo "readonly='readonly'";
                                                }
                                                ?> type="text" class="form-control digits price" name="ext_leave<?php echo $emp['emp_id']; ?>" id="ext_leave<?php echo $emp['emp_id']; ?>"></td>
                                                    <?php
                                                    foreach ($components as $item) {
                                                        // $i++;
                                                        $text = $text . '<td style="font-weight:bold"><input id="clscomponent' . $item['pay_id'] . '" readonly="readonly" class="form-control clscomponents" component="' . $item['pay_id'] . '" type="text" id="idtext"></td>';
                                                        ?>
                                                <td>
                                                <input type="hidden"  id="leavededution<?php echo $emp['emp_id']; ?>" class="form-control"/>
                                                <input  value="<?php echo $item['pay_type']; ?>" type="hidden" name="com_type_<?php echo $emp['emp_id']; ?>_<?php echo $item['pay_id']; ?>"><input value="<?php echo $item['pay_id']; ?>" type="hidden" name="component_id<?php echo $emp['emp_id']; ?>[]"/><input  <?php if($item['pay_type'] == 'Earnings'){echo 'style="color:green" '; }else{ echo 'style="color:red" '; } ?> value="0.00" <?php
                                                    if ($item['is_varying'] == '1') {
                                                        echo 'readonly="readonly"';
                                                    }
                                                    ?> type="text" <?php
                                                                                                                                                                                                                                                                                                                       if ($type == "pay") {
                                                                                                                                                                                                                                                                                                                           echo 'readonly="readonly"';
                                                                                                                                                                                                                                                                                                                       }
                                                                                                                                                                                                                                                                                                                       ?> pay_type="<?php echo $item['pay_type']; ?>" is_varying="<?php echo $item['is_varying']; ?>" name="emp_amount_<?php echo $emp['emp_id']; ?>_<?php echo $item['pay_id']; ?>" id="emp_<?php echo $emp['emp_id']; ?>_<?php echo $item['pay_id']; ?>" class="form-control clscomponent<?php echo $item['pay_id']; ?>  cls<?php echo $emp['emp_id']; ?> text-right three-digits price"></td>
                                                                                                                                                                                                                                                                                                                   <?php } ?>
                                            <td <?php
                                            if ($type == "pay") {
                                                echo 'style="display:none"';
                                            }
                                            ?> > <input  style="display:none;" class="form-control g_tot" readonly="readonly" type="text" id="tot<?php echo $emp['emp_id']; ?>" name="total">
                                            <input  class="form-control b_tot" readonly="readonly" type="text" id="btot<?php echo $emp['emp_id']; ?>" name="btotal">

                                            </td>    
                                          
                                           <td><input class="form-control emp_salary" id="emp_salary<?php echo $emp['emp_id']; ?>" name="emp_salary<?php echo $emp['emp_id']; ?>" type="text" readonly="readonly"/></td>
                                            <?php if ($type == "pay") { ?>
                                                <th><input class="form-control paid"readonly="readonly" type="text" name="paid<?php echo $emp['emp_id']; ?>" id="paid<?php echo $emp['emp_id']; ?>"/></th>
                                                <td><input class="form-control paying three-digits" id="employee_paying<?php echo $emp['emp_id']; ?>" name="employee_paying<?php echo $emp['emp_id']; ?>" type="text" /></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tbody id="rown">

                                </tbody>
                                <tr style="background-color:#E8E8E8">
                                    <th  <?php
                                    if ($type != 'pay') {
                                        echo 'style="display:none"';
                                    }
                                    ?>></th>
                                    <th ><?= label('Employee', $this, $user) ?></th>
                                    <th><?= label('Ledger Balance', $this, $user) ?></th>
                                    <th <?php
                                    if ($type == "pay") {
                                        echo 'style="display:none"';
                                    }
                                    ?>><?= label('Allowed Leaves', $this, $user) ?></th>
                                    <th <?php
                                    if ($type == "pay") {
                                        echo 'style="display:none"';
                                    }
                                    ?>><?= label('Taken Leaves', $this, $user) ?></th>
                                    <th><?= label('Leaves', $this, $user) ?></th>
                                    <th><?= label('Extra Leaves', $this, $user) ?></th>
                                    <?php foreach ($components as $item) { ?>
                                        <th><?= label($item['pay_name'], $this, $user) ?></th>
                                    <?php } ?>
                                    <th <?php
                                    if ($type == "pay") {
                                        echo 'style="display:none"';
                                    }
                                    ?> ><?= label('Total SLR/INC', $this, $user) ?></th>
                                    <th><?= label('Balance', $this, $user) ?></th>
                                    <?php if ($type == "pay") { ?>
                                        <th><?= label('paid', $this, $user) ?></th>
                                        <th><?= label('Paying', $this, $user) ?></th>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td  <?php
                                    if ($type != 'pay') {
                                        echo 'style="display:none"';
                                    }
                                    ?>></td>
                                    <td colspan="<?php
                                    if ($type == "pay") {
                                        echo (int) $i - 2;
                                    } else {
                                        echo $i;
                                    }
                                    ?>"></td>
                                        <?php echo $text; ?>
                                    <td <?php
                                    if ($type == "pay") {
                                        echo 'style="display:none"';
                                    } else {
                                        echo 'style="font-weight:bold"';
                                    };
                                    ?>><input  readonly="readonly"  class="form-control" type="text" name="b_tot" id="b_tot"><input style="display:none;" readonly="readonly"  class="form-control" type="text" name="g_tot" id="g_tot"></td>
                                    <td style="font-weight:bold"><input readonly="readonly"  class="form-control" type="text" name="g_emp_salary" id="g_emp_salary"></td>
                                    <?php if ($type == "pay") { ?>
                                        <td style="font-weight:bold"><input readonly="readonly"  class="form-control" type="text" name="g_paid" id="g_paid"></td>
                                        <td style="font-weight:bold"><input readonly="readonly"  class="form-control" type="text" name="g_paying" id="g_paying"></td>
                                    <?php } ?>
                                </tr>


                            </table>
                        </div>
                        <div>
                            <textarea  style="height:100px !important" placeholder=" Enter Your Notes Here" id="payment_notes" name="payment_notes" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="box-footer">   
                        <?php if ($is_view == '0') { ?>
                            <?php if ($type == "create") { ?>
                                <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
                            <?php } ?>
                            <?php if ($type == "pay") { ?>
                                <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> Save</button>           
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script type="text/javascript">
        $(".digits").ForceNumericOnly();

        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }
        function loadledgerbalance() {
            $(".emp_id").each(function () {
                var salary = $('#emp_salary' + emp_id).val();
                var emp_id = $(this).attr('empid');
                var ledger_id = $(this).attr('ledger_id');
                $.ajax({
                    url: "<?php echo site_url('transaction/vouchers/getLedegerbalance'); ?>/" + ledger_id + "/1", success: function (results) {
                        var salary = $('#emp_salary' + emp_id);
                        $("#ledger_balance" + emp_id).val(results);
                        if (results !== "" && results !== null && results !== 'null') {

                        }
                    }
                });
            });
        }
        function loadleaves(distribution_id) {
            var year = $('#year').val();
            $('.clsoption').prop('disabled', false);
            $('#month').val('');
            $.ajax({
                url: "<?php echo site_url('hr/SalaryDistribution/loadleaves/'); ?>" + distribution_id,
                type: 'POST',
                data: {year: year},
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if (i < 1) {
                            if (itemsingle.months !== "") {
                                var months = itemsingle.months.split(",");
                                var length = months.length;
                                for (var i = 0; i < length; i++) {
                                    $("#month option[value='" + months[i] + "']").prop('disabled', true);
                                }
                            }
                        }
                        var myleaves = parseFloat(itemsingle.leaves);
                        $('#taken_leaves' + itemsingle.emp_id).val(myleaves.toFixed(0));
                    });
                    calculateGtotal();
                }
            });
        }
        function calculaterowTotal(emp_id, earnings, deduction,tot) {
            var allowed_leaves = $('#allowed_leaves' + emp_id).val();
            var taken_leaves = $('#taken_leaves' + emp_id).val();
            var leaves_allowed = parseFloat(allowed_leaves) - parseFloat(taken_leaves);
            var leaves = $('#leaves' + emp_id).val();
            var ext_leave = $('#ext_leave' + emp_id).val();
            if (leaves === "") {
                leaves = 0;
            }
            if (ext_leave === "") {
                ext_leave = 0;
            }
//            var total = $('#tot' + emp_id).val();
            var total = parseFloat(earnings);
            var remainings = 0;
            var emp_leave = 0;
            var salary_total = total;
            var emp_deduction = 0;
            var month = $('#month').val();
            var year = $('#year').val();
            if (total !== "" && total !== null & total > 0 && month !== "" && year !== "") {
                var days = daysInMonth(month, year);
                var daysalary = parseFloat(tot) / parseFloat(days);
                if (leaves_allowed <= 0) {
                    emp_leave = parseFloat(leaves) + parseFloat(ext_leave);
                    emp_deduction = parseFloat(emp_leave) * daysalary;
                    salary_total = parseFloat(salary_total) - parseFloat(emp_deduction) - parseFloat(deduction).toFixed(3);
                } else {
                    emp_leave = parseFloat(leaves_allowed) - parseFloat(leaves);
                    if (emp_leave >= 0) {
                        emp_leave = ext_leave;
                        emp_deduction = parseFloat(emp_leave) * daysalary;
                        salary_total = parseFloat(salary_total) - parseFloat(emp_deduction) - parseFloat(deduction).toFixed(3);
                    } else {
                        emp_leave = emp_leave * -1;
                        emp_leave = parseFloat(emp_leave) + parseFloat(ext_leave);
                        emp_deduction = parseFloat(emp_leave) * daysalary;
                        salary_total = parseFloat(salary_total) - parseFloat(emp_deduction) - parseFloat(deduction).toFixed(3);
                    }
                }
            }
            $('#leavededution'+emp_id).val(parseFloat(emp_deduction).toFixed(3));
            var type = $('#type').val();
            var tot_emp_salary = 0;
            var g_tot = 0;
            var b_tot = 0;
            $(".emp_salary").each(function () {
                var emp_salary = $(this).val();
                if (emp_salary === "" || emp_salary === null || emp_salary === undefined) {
                    emp_salary = 0;
                }
                tot_emp_salary = parseFloat(tot_emp_salary) + parseFloat(emp_salary);
            });
             $(".b_tot").each(function () {
                var amount = $(this).val();
                if (amount === "" || amount === null || amount === undefined) {
                    amount = 0;
                }
                b_tot = parseFloat(b_tot) + parseFloat(amount);
            });
            $(".g_tot").each(function () {
                var amount = $(this).val();
                if (amount === "" || amount === null || amount === undefined) {
                    amount = 0;
                }
                g_tot = parseFloat(g_tot) + parseFloat(amount);
            });
            $('#b_tot').val(b_tot.toFixed(3));
            $('#g_emp_salary').val(tot_emp_salary.toFixed(3));
            $('#g_tot').val(g_tot.toFixed(3));
            if (type !== 'pay') {
                $('#emp_salary' + emp_id).val(salary_total.toFixed(3));
            } else {
                var paid_total = 0;
                var paying_total = 0;
                $(".paid").each(function () {
                    var paid = $(this).val();
                    if (paid === "" || paid === null || paid === undefined) {
                        paid = 0;
                    }
                    paid_total = parseFloat(paid_total) + parseFloat(paid);
                });
                $(".paying").each(function () {
                    var paying = $(this).val();
                    if (paying === "" || paying === null || paying === undefined) {
                        paying = 0;
                    }
                    paying_total = parseFloat(paying_total) + parseFloat(paying);
                });
                $('#g_paying').val(paying_total.toFixed(3));
                $('#g_paid').val(paid_total.toFixed(3));
            }
            $('.clscomponents').each(function () {
                var component = $(this).attr('component');
                var amount = 0;
                $('.clscomponent' + component).each(function () {
                    var value = $(this).val();
                    if (value === "" || value === null || value === undefined) {
                        value = 0;
                    }
                    amount = parseFloat(amount) + parseFloat(value);
                });
                $('#clscomponent' + component).val(amount.toFixed(3));
            });

        }
        function calculateGtotal() {
            $(".emp_id").each(function () {
                var emp_id = $(this).attr('empid');
                var total = 0;
                var tot = 0;
                var deduction = 0;
                var earnings = 0;
                var btot = 0;
                $(".cls" + emp_id).each(function () {
                    var type = $(this).attr('pay_type');
                    var is_varying = $(this).attr('is_varying');
                    var amount = $(this).val();
                    if (amount === "") {
                        amount = 0;
                    }
                    if (type === "Deductions") {
                        total = parseFloat(total) - parseFloat(amount);
                        deduction = parseFloat(deduction) + parseFloat(amount);
                    }
                    if (type === "Earnings") {
                        btot = parseFloat(btot) + parseFloat(amount);
                        total = parseFloat(total) + parseFloat(amount);
                        earnings = parseFloat(earnings) + parseFloat(amount);
                        if (parseFloat(is_varying) > 0) {
                            tot = parseFloat(tot) + parseFloat(amount);
                        }
                    }
                    
                });
                $('#tot' + emp_id).val(total.toFixed(3));
                var leavededution = $('#leavededution'+emp_id).val();
                if(leavededution === "" || leavededution === null || leavededution === undefined){
                    leavededution = 0 ;
                }
                btot = parseFloat(btot) - parseFloat(leavededution);
                $('#btot' + emp_id).val(btot.toFixed(3));
                calculaterowTotal(emp_id, earnings, deduction,tot);
            });
        }
        function load(distribution_id) {
            $("#checkall").trigger("change");
            if (distribution_id < 1) {
                $.ajax({
                    url: "<?php echo site_url('hr/SalaryDistribution/getemployees'); ?>",
                    async: false,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            $('#emp_' + itemsingle.emp_id + '_' + itemsingle.component_id).val(itemsingle.amount);
                        });
                        calculateGtotal();
                    }
                });
                loadledgerbalance();
                loadleaves(distribution_id);

            } else {
                $.ajax({
                    url: "<?php echo site_url('hr/SalaryDistribution/getsing/'); ?>" + distribution_id,
                    async: false,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            if(parseFloat(i) < 1){
                                $('#year').val(itemsingle.year);
                                loadleaves(distribution_id);
                            }
                            $('#payment_notes').val(itemsingle.notes);
                            $('#status' + itemsingle.emp_id).val(itemsingle.stat);
                            var leave_days = parseFloat(itemsingle.leave_days);
                            $('#leaves' + itemsingle.emp_id).val(leave_days.toFixed(0));
                            $('#emp_' + itemsingle.emp_id + '_' + itemsingle.component_id).val(itemsingle.amount);
                            var extra_leaves = parseFloat(itemsingle.extra_leaves);
                            $('#ext_leave' + itemsingle.emp_id).val(extra_leaves.toFixed(0));
                            $('#year').val(itemsingle.year);
                            $('#month').val(itemsingle.month);
                            var type = $('#type').val();
                            if (type === 'pay') {
                                $('#employee_paying' + itemsingle.emp_id).attr('max', itemsingle.balance);
                                $('#paid' + itemsingle.emp_id).val(itemsingle.employee_paid);
                                $('#emp_salary' + itemsingle.emp_id).val(itemsingle.emp_salary);
                                $('#employee_paying' + itemsingle.emp_id).val(itemsingle.balance);
                            }

                        });
                        calculateGtotal();
                    }
                });
                var type = $('#type').val();
                loadledgerbalance();
            }
            $("#checkall").trigger("change");
        }
        $(document).ready(function () {
            $('.checkall').change(function () {
                if (this.checked) {
                    $(".emp_id").prop("checked", true);
                } else {
                    $(".emp_id").prop("checked", false);
                }
            });
            $("#checkall").trigger("change");
            $('#payment_notes').keydown(function (e) {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.value = this.value + "\n";
                    $('#payment_notes').focus();
                }
            });
            $('#tbldist').tableNav();
            $('#rowm').tableNav();
            $('#tbldist input').eq(1).click();
            $('.paying').change(function () {
                paying_total = 0;
                $(".paying").each(function () {
                    var paying = $(this).val();
                    if (paying === "" || paying === null || paying === undefined) {
                        paying = 0;
                    }
                    paying_total = parseFloat(paying_total) + parseFloat(paying);
                });
                $('#g_paying').val(paying_total.toFixed(3));
            });
            var distribution_id = $('#distribution_id').val();
            load(distribution_id);

            $('.paying').change(function () {
                var amount = $(this).val();
                var max = $(this).attr('max');
                if (amount === "") {
                    $(this).val(0);
                } else {
                    if (parseFloat(amount) > parseFloat(max)) {
                        //$(this).val(max);
                    }
                }
            });
            $('.price').change(function () {
                calculateGtotal();
            });

            $('#year').change(function () {
                var distribution_id = $('#distribution_id').val();
                loadleaves(distribution_id);
            });
            $('#month').change(function () {
                calculateGtotal();
            });
            
        });
    </script>