<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/SalaryPackage/list_all'); ?>" action="<?php echo site_url('hr/SalaryPackage/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="package_id" id="package_id"/>    
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Salary Package', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/SalaryPackage/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body"> 
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Employee Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="emp_id" name="emp_id"/>
                                    <input name="emp_name" type="text" id="emp_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Employee">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Renewl Date*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input name="rndate" type="text" id="rndate" data-validation="length" data-validation-length="min2"   class="form-control date" placeholder="Employee">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Notes*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <textarea id="note" name="note" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <table class="table table-striped" >
                                    <tr>
                                        <th style="font-size: 18px;font-weight: bold" colspan="2">Earnings Components</th>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 14px;font-weight: bold">Components</th>
                                        <th style="font-size: 14px;font-weight: bold">Amount</th>
                                    </tr>
                                    <tbody id="clsearnings">

                                    </tbody>
                                </table>

                            </div>

                            <div class="col-sm-6">
                                <table class="table table-striped" >
                                    <tr>
                                        <th style="font-size: 18px;font-weight: bold" colspan="2">Deduction Components</th>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 14px;font-weight: bold">Components</th>
                                        <th style="font-size: 14px;font-weight: bold">Amount</th>
                                    </tr>
                                    <tbody id="clsdeduction">

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <table class="table" >
                                    <tr>
                                        <th style="font-size: 14px;font-weight: bold">Total Earnings</th>
                                        <th style="font-size: 14px;font-weight: bold"><input readonly="readonly" type="text" id="tot_earnings" name="tot_earnings" class="form-control"></th>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 14px;font-weight: bold">Total Amount</th>
                                        <th style="font-size: 14px;font-weight: bold"><input readonly="readonly"  type="text" id="tot_amount" name="tot_amount" class="form-control"></th>
                                    </tr>
                                </table>

                            </div>

                            <div class="col-sm-6">
                                <table class="table" >
                                    <tr>
                                        <th style="font-size: 14px;font-weight: bold">Total Deductions</th>
                                        <th style="font-size: 14px;font-weight: bold"><input readonly="readonly"  type="text" id="tot_deduction" name="tot_deduction" class="form-control"></th>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="box-footer">   
                        <?php if ($type != 'view') { ?>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           

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
        function formatDate(input) {
            if(input!==null){
            var datePart = input.match(/\d+/g),
                    year = datePart[0].substring(0), // get only two digits
                    month = datePart[1], day = datePart[2];

            return day + '/' + month + '/' + year;
        }else{
            return input;
        }
        }
        function load() {
            var id = $('#package_id').val();
            var Earningstext = '';
            $.ajax({
                url: "<?php echo site_url('hr/SalaryPackage/getsing'); ?>/" + id,
                type: 'POST',
                data: {component_type: 'Earnings'},
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if(itemsingle.renewal !== null){
                             $('#emp_name').val(itemsingle.employee);
                             $('#emp_id').val(itemsingle.employee_id);
                             $('#note').val(itemsingle.notes);
                             $('#rndate').val(itemsingle.renewal);
                        }
                        Earningstext = Earningstext + '<tr><td><input type="hidden" name="earning_comp[]" id="earning_comp" value="' + itemsingle.pay_id + '"/>' + itemsingle.pay_name + '</td><td><input type="text" value="' + itemsingle.totalamount + '" id="earning_amount" name="earning_amount[]" class="form-control earning text-right  three-digits price"/></td></tr>';
                    });
                    $('#clsearnings').append(Earningstext);
                    calculateGtotal();
                    Earningstext = '';
                }
            });
            var Deductionstext = '';
            $.ajax({
                url: "<?php echo site_url('hr/SalaryPackage/getsing'); ?>/" + id,
                type: 'POST',
                data: {component_type: 'Deductions'},
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if(itemsingle.renewal !== null){
                             $('#emp_name').val(itemsingle.employee);
                              $('#emp_id').val(itemsingle.employee_id);
                              $('#note').val(itemsingle.notes);
                              $('#rndate').val(itemsingle.renewal);
                        }
                        Deductionstext = Deductionstext + '<tr><td><input type="hidden" name="deduction_comp[]" id="deduction_comp" value="' + itemsingle.pay_id + '"/>' + itemsingle.pay_name + '</td><td><input type="text" value="' + itemsingle.totalamount + '" id="deduction_amount" name="deduction_amount[]" class="form-control deduction text-right  three-digits price"/></td></tr>';
                    });
                    $('#clsdeduction').append(Deductionstext);
                    calculateGtotal();
                }
            });
        }
        function loadpackageBycustomer(id) {
            $('#clsearnings').html('');
            $('#clsdeduction').html('');
            var mytext = "";
            $.ajax({
                url: "<?php echo site_url('hr/SalaryPackage/getemployeePackage'); ?>/" + id,
                type: 'POST',
                data: {component_type: 'Earnings'},
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
//                        $('#package_id').val(itemsingle.package);
                        if (i < 1) {
                            mytext = "";
                            mytext = mytext + '<tr><td><input type="hidden" name="earning_comp[]" id="earning_comp" value="' + itemsingle.pay_id + '"/>' + itemsingle.pay_name + '</td><td><input type="text" value="' + itemsingle.totalamount + '" id="earning_amount" name="earning_amount[]" class="form-control earning text-right  three-digits price"/></td></tr>';
                        } else {
                            mytext = mytext + '<tr><td><input type="hidden" name="earning_comp[]" id="earning_comp" value="' + itemsingle.pay_id + '"/>' + itemsingle.pay_name + '</td><td><input type="text" value="' + itemsingle.totalamount + '" id="earning_amount" name="earning_amount[]" class="form-control earning text-right  three-digits price"/></td></tr>';
                        }
                    });
                    $('#clsearnings').html(mytext);
                    calculateGtotal();
                    mytext = '';
                }
            });
            var myDtext = '';
            $('#clsdeduction').html('');
            $.ajax({
                url: "<?php echo site_url('hr/SalaryPackage/getemployeePackage'); ?>/" + id,
                type: 'POST',
                data: {component_type: 'Deductions'},
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if (i < 1) {
                            myDtext = '';
                            myDtext = myDtext + '<tr><td><input type="hidden" name="deduction_comp[]" id="deduction_comp" value="' + itemsingle.pay_id + '"/>' + itemsingle.pay_name + '</td><td><input type="text" value="' + itemsingle.totalamount + '" id="deduction_amount" name="deduction_amount[]" class="form-control deduction text-right  three-digits price"/></td></tr>';
                        } else {
                            myDtext = myDtext + '<tr><td><input type="hidden" name="deduction_comp[]" id="deduction_comp" value="' + itemsingle.pay_id + '"/>' + itemsingle.pay_name + '</td><td><input type="text" value="' + itemsingle.totalamount + '" id="deduction_amount" name="deduction_amount[]" class="form-control deduction text-right  three-digits price"/></td></tr>';
                        }
                    });
                    $('#clsdeduction').html(myDtext);
                    calculateGtotal();
                }
            });
        }
        function calculateGtotal() {
            var earning = 0;
            var deduction = 0;
            $(".earning").each(function () {
                var amount = $(this).val();
                if (amount !== "") {
                    earning = parseFloat(earning) + parseFloat(amount);
                }
            });
            $(".deduction").each(function () {
                var amount = $(this).val();
                if (amount !== "") {
                    deduction = parseFloat(deduction) + parseFloat(amount);
                }
            });
            $('#tot_earnings').val(earning);
            $('#tot_deduction').val(deduction);
            var tot_amount = parseFloat(earning) - parseFloat(deduction);
            $('#tot_amount').val(tot_amount);
        }
        $(document).on('change', '.earning,.deduction', function () {
            var val = $(this).val();
            if (val === "") {
                $(this).val(0.00);
            }
            calculateGtotal();
        });
        $(document).ready(function () {


            $("#emp_name").autocomplete({
                source: "<?php echo site_url('hr/Paysettings/getemployee'); ?>",
                minLength: 2,
                select: function (event, ui) {
                    $('#clsearnings').html('');
                    $('#clsdeduction').html('');
                    $('#emp_id').val(ui.item.emp_id)
                    loadpackageBycustomer(ui.item.emp_id);
                }
            });
            load();
        });
    </script>