<style>
    .new-invoice {
        font-size: 15px;
        font-weight: 600;
        padding-right: 15px;
        padding-left: 15px;
    }
</style>
<form method="post" id="frmcreate" home="<?php echo site_url('transaction/vouchers/index'); ?>"
    back="<?php echo site_url('education/Student/feeSchedule'); ?>"
    action="<?php echo site_url('education/student/save_fee'); ?>" class="form-horizontal">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Payment Voucher', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom"
                                href="<?php echo site_url('education/Student/feeSchedule'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">

                        <div class="col-sm-4">
                            <input type="hidden" name="new_invoice" id="new_invoice" />
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Date', $this, $user) ?></label>

                                <div class="col-sm-7">
                                    <input class="form-control date" id="date" type="text" autocomplete="false" name="date" data-validation="required,date" data-validation-format="dd/mm/yyyy" placeholder="Date" />
                                </div> 
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Billtype', $this, $user) ?></label>
                                <div class="col-sm-7">
                                    <select id="btype" name="btype" class="form-control ">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Voucher Number', $this, $user) ?></label>
                                <div class="col-sm-7">
                                    <p><span class="new-invoice"><label spellcheck="false" id="prefix"></label><label spellcheck="false" id="sep_first"></label><label class="two-digits price" ondblclick="changeinvoice()" NoTab="true" spellcheck="false" id="b_no"></label><label spellcheck="false" id="sep_second"></label><label spellcheck="false" id="suffix"></label></span></p>
                                    <input type="hidden" name="invoice" type="text" id="invoice" class="form-control" placeholder="Voucher Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Cash / Bank', $this, $user) ?></label>
                                <div class="col-sm-7">
                                    <select data-validation="required" id="paytype" name="paytype" class="form-control " autofocus>
                                        <option value="4"><?= label('Cash', $this, $user) ?></option>
                                        <option value="1"><?= label('Bank', $this, $user) ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Select Account', $this, $user) ?></label>
                                <div class="col-sm-7">
                                    <select id="frmact" name="frmact" class="form-control ">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Student', $this, $user) ?> </label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="student" name="student" />
                                    <input type="hidden" class="form-control" id="student_id" name="student_id" />
                                    <input type="hidden" class="form-control" id="ledger_id" name="ledger_id" />

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Course', $this, $user) ?></label>
                                <div class="col-sm-7">
                                    <select id="course" name="course" class="form-control ">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Amount', $this, $user) ?></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control calc"  id="amount" name="amount"/>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?= label('Narration', $this, $user) ?></label>

                                <div class="col-sm-7">
                                    <textarea class="form-control" data-validation="length" data-validation-length="min3" id="narration" name="narration">Amount Paid</textarea>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Cost Center', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select id="Costcenter" class="form-control" name="Costcenter">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div> -->
                            <!--                                 
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?= label('Cash / Bank', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <select data-validation="required" id="paytype" name="paytype" class="form-control " autofocus>
                                        <option value="4"><?= label('Cash', $this, $user) ?></option>
                                        <option value="1"><?= label('Bank', $this, $user) ?></option>
                                    </select>
                                </div>
                            </div> -->
                        </div>

                        <div class="col-sm-8">
                            <?= label('Auto Aging', $this, $user) ?> <input type="checkbox" class="" name="autoCheck"
                                 id="autoCheck" />
                            <table id="table" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?= label('Sl No', $this, $user) ?></th>
                                        <th><?= label('Course', $this, $user) ?></th>
                                        <th><?= label('date of payment', $this, $user) ?></th>
                                        <th><?= label('Amount', $this, $user) ?></th>
                                        <th><?= label('Paid', $this, $user) ?></th>                                        
                                        <th><?= label('Paying', $this, $user) ?></th>
                                        <th><?= label('Balance', $this, $user) ?></th>


                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save'
                            class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
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
</form>
<script>
  function setledgers(ledger = 0) {
        var paytype = $("#paytype").val();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/setledgers'); ?>/" + paytype + "",
            success: function(result) {
                $('#frmact').html(result);
                if (ledger > 0) {
                    $('#frmact').val(ledger);
                }
            }
        });
    }
function setbillno(id) {
        var vid = 0;
        if (vid ===0) {
            $.ajax({
                url: "<?php echo site_url('transaction/Vouchers/getnewinoviceno'); ?>/" + id,
                success: function(result) {
                    $('#b_no').html(result);
                    $('#iv_no').html(result);
                    var suffix = $('#btype').find(':selected').attr('suffix');
                    var prefix = $('#btype').find(':selected').attr('preffix');
                    var seperator = $('#btype').find(':selected').attr('seperator');
                    $('#autoinvoice').val(prefix + seperator + result + seperator + suffix);
                    $("#new_invoice").val(prefix + seperator + result + seperator + suffix);
                    $('#sep_second').html(seperator);
                    $('#sep_first').html(seperator);
                    $('#suffix').html(suffix);
                    $('#prefix').html(prefix);
                    $('#reference').val(prefix + seperator + result + seperator + suffix);
                    //                    document.getElementById("b_no").contentEditable = true;
                }
            });
        }
    }
    $(document).ready(function () {

        var amounts=0;
        $("#autoCheck").prop("checked", false);
        $('.calc').change(function(){
           var amount = $('#amount').val();
           $(".paying_amount").val(0.00);
           $(".paying_amount").each(function() {
                $(this).val(0);
                var payid = $(this).attr('payid');
                var balance  = $('#balance'+payid).val();
                if ($('#chk'+payid).is(':checked')) {
                    if(parseFloat(amount) >= parseFloat(balance) ){
                         $(this).val(balance);
                       }else if(amount>0){
                     $(this).val(amount);
                     }
                    amount = amount -balance;
                }
            });


        });
        $(document).on('click','.chk',function() {
            var amt =0;
            $('#amount').val(0);
            $(".paying_amount").each(function() {
                    var payid = $(this).attr('payid');
                    $(this).val(0);
                    var balance  = $('#balance'+payid).val();
                    if ($('#chk'+payid).is(':checked')) {
                        amt = parseFloat(balance) + parseFloat(amt);
                        $('#amount').val(amt);
                        $(this).val(balance);
                    }
             });
        });
        $('#autoCheck').click(function() {
            if (!$(this).is(':checked')) {
                $(".chk").prop("checked", false);
                $(".paying_amount").each(function() {
                   
                     $(this).val(0);
                 });
            }
            else{
                $(".chk").prop("checked", true);
                var amt = 0;
                $(".paying_amount").each(function() {
                    var payid = $(this).attr('payid');
                     var balance  = $('#balance'+payid).val();
                     amt = parseFloat(balance) + parseFloat(amt);
                     $('#amount').val(amt);
                     $(this).val(balance);
                 });

            }
        });
        setledgers();
        $("#paytype").change(function() {
            setledgers();

        });
        $("#paytype").keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
                $("#frmact").focus();
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/course')?>",
            success: function(result) {
                var user_default_billtype = $('#user_default_billtype').val();
                $('#btype').html(result);
                // var id = $('#vid').val();
                var billtype = $('#btype').val();
                setbillno(billtype);

            }
        });

        



        $('#course').change(function () {

            var student_id = $('#student_id').val();
            var course_id = $('#course').val();

            reload(course_id, student_id);
        })

        $("#student").autocomplete({

            source: "<?php echo base_url(); ?>education/Student/getAll", // path to the get_birds method
            minLength: 1,
            select: function (event, ui) {
                $("#ledger_id").val(ui.item.ledger_id);
                $("#student_id").val(ui.item.id);
                stud_id = ui.item.id;

                $.ajax({
                    url: "<?php echo site_url('education/Student/getStudentCourse'); ?>/" +
                        stud_id,
                    success: function (results) {

                        var result = JSON.parse(results);
                        var option = '<option value="">Select</option>';
                        $.each(result, function (i, item) {

                            option = option + '<option value="' + item
                                .course_id + '">' + item.course + '</option>';

                        })
                        $('#course').html(option);
                    }
                });
            }

        });
    })

    function reload(course_id, stud_id) {

        table = $('#table').DataTable({

            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "searching": false,
            "paging": false,
            "destroy": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('education/Student/getPaymentData') ?>",
                "type": "POST",
                "data": function (data) {
                    data.course_id = course_id,
                        data.stud_id = stud_id

                }
            },
            "fnDrawCallback": function(oSettings) {
                if (!$('#autoCheck').is(':checked')) {
                     $(".chk").prop("checked", false);
                 }
                else{
                 $(".chk").prop("checked", true);

             }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });

    };
</script>