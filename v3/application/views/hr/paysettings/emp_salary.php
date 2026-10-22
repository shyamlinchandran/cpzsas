<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/paysettings/listall'); ?>" action="<?php echo site_url('hr/paysettings/save_salary'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="sal_id" id="sal_id"/>    
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Employee Salary', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/paysettings/listall'); ?>"> <span
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

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-8">
                                <table class="table table-striped table-condensed" >
                                    <thead>
                                        <tr>
                                            <th><?= label('Type', $this, $user) ?></th>
                                            <th><?= label('Salary Component', $this, $user) ?></th>
                                            <th><?= label('Note', $this, $user) ?></th>
                                            <th><?= label('Amount', $this, $user) ?></th>
                                            <th>

                                            </th>
                                        </tr>

                                    </thead>
                                    <tr>
                                        <td class="col-lg-2">
                                            <select class="form-control" id="com_type">
                                                <option val="Earning">Earnings</option>
                                                <option val="Deductions">Deductions</option>
                                            </select>
                                        </td>
                                        <td class="col-lg-3">
                                            <select class="form-control" id="component">

                                            </select>
                                        </td>
                                        <td class="col-lg-4">
                                            <input type="text"  id="notes" class="form-control"/>
                                        </td>
                                        <td class="col-lg-3">
                                            <input id="amount"  type="text"  class="form-control text-right  two-digits price " placeholder="<?= label('Amount', $this, $user) ?>"/>
                                        </td>
                                        <td>
                                            <button data-toggle="tooltip" type="button"    title="Add To save" id="btnAddExtra"  class="btn btn-success" href="#">
                                                <span class="glyphicon glyphicon-plus"></span> 
                                            </button>
                                        </td>
                                    </tr>
                                    <tbody id="rowm">
                                    </tbody>

                                </table>
                                <div>
                                    <p  style="text-align: right">Total Earnings :  <input readonly="readonly" type="text" style="width:130px" value="0.00"  id="earnings" name="earnings"/>
                                    <p style="text-align: right">Total Deductions :  <input readonly="readonly" type="text" style="width:130px"  value="0.00" id="deductions" name="deductions"/>
                                    <p style="text-align: right">Salary :  <input readonly="readonly" type="text" style="width:130px" id="salary" value="0.00" name="salary"/>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">          
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           

                        <div class='small-loading' id='FormLoading'> </div>

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
        function load(sal_id) {
            if (sal_id > 0) {
                $.ajax({
                    url: "<?php echo site_url('hr/Paysettings/getsing'); ?>/" + sal_id,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            $('#emp_id').val(itemsingle.emp_id);
                            $('#emp_name').val(itemsingle.pro_fname);
                            addrowtoTable(itemsingle.component_type, itemsingle.pay_id, itemsingle.note, itemsingle.amount, itemsingle.pay_name, itemsingle.component_type)
                        });

                    }
                });
            }
        }
        function remove(btn) {
            $(btn).closest('tr').remove();
            calculateGTotal();
        }
        function addrowtoTable(type, component, notes, amount, componentName, typeName) {
            var text = ' <tr> <td class="col-lg-2"><input class="form-control" readonly="readonly" type="text" value="' + typeName + '"><input class="form-control" type="hidden" name="component_type[]" value="' + type + '"></td> <td readonly="readonly" class="col-lg-3"><input readonly="readonly" class="form-control" type="text" value="' + componentName + '"><input type="hidden" name="component[]" value=' + component + '""></td> <td class="col-lg-4"><input name="notes[]" class="form-control" type="text" value="' + notes + '"></td> <td class="col-lg-3"><input class="form-control amount text-right" type="text" comtype="' + type + '" name="amount[]" type="text" value="' + amount + '"></td><td><span data-toggle="tooltip"   title="Remove" onclick="remove(this)" couamt=' + amount + ' class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
            $('#rowm').append(text);
            calculateGTotal();
        }
        function loadcomponent(component_type) {
            $.ajax({
                url: "<?php echo site_url('hr/Paysettings/setcomponent'); ?>",
                type: 'POST',
                data: {component_type: component_type},
                success: function (result) {
                    $('#component').html(result);
                }
            });
        }
        function calculateGTotal() {
            var deduction = 0;
            var earning = 0;
            $(".amount").each(function () {
                var amount = $(this).val();
                var type = $(this).attr('comtype');
                if (type === "Earnings") {
                    earning = parseFloat(earning) + parseFloat(amount);
                } else {
                    deduction = parseFloat(deduction) + parseFloat(amount);
                }
            });
            var balance = parseFloat(earning) - parseFloat(deduction);
            $('#earnings').val(earning);
            $('#deductions').val(deduction);
            $('#salary').val(balance);
        }
        $(document).ready(function () {
            var component_type = $('#com_type').val();
            loadcomponent(component_type);
            $('#com_type').change(function () {
                var component_type = $('#com_type').val();
                loadcomponent(component_type);
            });
            $('#amount').keydown(function (e) {
                var type = $('#com_type').val();
                var component = $('#component').val();
                var notes = $('#notes').val();
                var amount = $('#amount').val();
                var componentName = $("#component option:selected").text();
                var typeName = $("#com_type option:selected").text();
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    if (component !== "" && amount !== "" && amount > 0 && type !== "") {
                        addrowtoTable(type, component, notes, amount, componentName, typeName);
                    }
                }

            });

            $("#emp_name").autocomplete({
                source: "<?php echo site_url('hr/Paysettings/getemployee'); ?>",
                minLength: 2,
                select: function (event, ui) {
                    $('#emp_id').val(ui.item.emp_id)
                }
            });
            var sal_id = $('#sal_id').val();
            load(sal_id);

        });
    </script>