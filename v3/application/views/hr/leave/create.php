<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/EmployeeLeave/list_all'); ?>" action="<?php echo site_url('hr/EmployeeLeave/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Employee Leave', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/EmployeeLeave/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">

                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('Employee Name * :', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="emp_id" name="emp_id"/>
                                        <input name="emp_name" type="text" id="emp_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Employee">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('Leave Type * :', $this, $user) ?></label>

                                    <div class="col-sm-8">
                                        <select data-validation="required" class="form-control" name="leave_type" id="leave_type">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('From Date', $this, $user) ?></label>
                                    <div class="col-sm-8">                              
                                        <input name="from_date" type="text" id="from_date" data-validation="required" class="form-control  date" placeholder="Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('To Date', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <input name="to_date" type="text" id="to_date" data-validation="required" class="form-control  date" placeholder="Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('No.of Days', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <input readonly="readonly" name="days" type="text" id="days" data-validation="required" class="form-control" placeholder="No Of Days">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"><?= label('Notes', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <textarea id="notes" name="notes" class="form-control"></textarea> 
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>  
                    <div class="box-footer">    
                        <?php
                        if ($type != 'view') {
                            echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                        }
                        ?>      
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
    function setdateformat(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function load(id) {
        $.ajax({
            url: "<?php echo site_url('hr/EmployeeLeave/getsing'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results);
                $("#emp_id").val(result.emp_id);
                $("#emp_name").val(result.pro_fname);
                $("#leave_type").val(result.leave_type);
                $("#from_date").val(setdateformat(result.from_date));
                $("#to_date").val(setdateformat(result.to_date));
                $("#days").val(result.no_of_days);
                $('#notes').val(result.notes);
            }
        });
    }
    function formatDate(input) {
        var array = input.split('/');
        return array[1] + '/' + array[0] + '/' + array[2];
    }
    $(document).ready(function () {
        $('.date').change(function () {
            var start = new Date(formatDate($('#from_date').val()));
            var end = new Date(formatDate($('#to_date').val()));
// end - start returns difference in milliseconds 
            var diff = new Date(end - start);

// get days
            var days = diff / 1000 / 60 / 60 / 24;
            days = days + 1;
            $('#days').val(days);
        });
        $.ajax({
            url: "<?php echo site_url('hr/EmployeeLeave/leavetype'); ?>",
            success: function (result) {
                $('#leave_type').html(result);

            }
        });

        $("#emp_name").autocomplete({
            source: "<?php echo site_url('hr/Paysettings/getemployee'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#emp_id').val(ui.item.emp_id)
            }
        });
        var id = $('#id').val();
        load(id);
    });
</script>