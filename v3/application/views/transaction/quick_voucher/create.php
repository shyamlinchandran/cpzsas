<style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }
</style>
<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/Quick_voucher/listall'); ?>" action="<?php echo site_url('transaction/Quick_voucher/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border no-print">
                        <h3 class="box-title no-print"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right no-print"> <a role="button"
                                                              class="btn  btn-success align-bottom"
                                                              href="<?php echo site_url('transaction\Quick_voucher\listall'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body"> 
                        <div class="col-sm-10">  
                            <div class="col-sm-4 no-print">  
                                <div class="form-group">
                                    <label  class="col-sm-6 control-label no-print"><?= label('Main Ledger', $this, $user) ?> * :</label>
                                    <div class="col-sm-12">
                                        <select tabindex="-1" id="main_ledger" name="main_ledger" class="form-control no-print" >                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 no-print">  
                                <div class="form-group">
                                    <label  class="col-sm-6 control-label no-print"><?= label('From Ledger', $this, $user) ?> * :</label>
                                    <div class="col-sm-12">
                                        <select tabindex="-1" id="ledger" name="ledger" class="form-control no-print" >                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">  
                                <div class="form-group ">
                                    <label  class="col-sm-6 no-print control-label"><?= label('Select Date', $this, $user) ?> * :</label>
                                    <div class="col-sm-12">
                                        <div class="col-sm-10">
                                            <input class="form-control no-print date" id="date" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" />
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="button" class="btn btn-success no-print" value="Print" id="print"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-12">  
                            <table id="quicktable" class="table table-condensed table-striped">
                                <tr>
                                    <th style="width:35%">Ledger</th>
                                    <th style="width:25%">Amount</th>
                                    <th style="width:40%">Narration</th>
                                </tr>
                                <tbody id="addledger">

                                </tbody>
                                <tr>
                                    <th><b>Total Amount</b></th>
                                    <th colspan="2"><input  type="number" readonly="readonly" name="total" id="total"></th>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer">          
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           

                        <div class='small-loading' id='FormLoading'> </div>

                    </div>

                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '.rowcalc', function () {
            var amount = $(this).val();
            if (amount === "") {
                $(this).val(0);
            }
            var total = 0;
            $(".rowcalc").each(function () {
                var amt = parseFloat($(this).val());
                total = parseFloat(total + amt);
                // ...
            });
            $('#total').val(total);
        });
        $(document).on('change', '#main_ledger', function () {
            load($('#main_ledger').val());
        });
        $.ajax({
            url: "<?php echo site_url('transaction/Quick_voucher/ledgers'); ?>",
            success: function (result) {
                $('#ledger').html(result);

            }
        });
        $.ajax({
            url: "<?php echo site_url('transaction/Quick_voucher/main_ledgers'); ?>",
            success: function (result) {
                $('#main_ledger').html(result);
                load($('#main_ledger').val());
            }
        });


        function formatDate(input) {
            if (input !== null) {
                var datePart = input.match(/\d+/g),
                        year = datePart[0].substring(0), // get only two digits
                        month = datePart[1], day = datePart[2];

                return day + '/' + month + '/' + year;
            }
            return 1;
        }
        function load(main_id) {
            var id = $('#id').val();
            $('#addledger').html('');
            $.ajax({
                url: "<?php echo site_url('transaction/Quick_voucher/expense_ledger'); ?>/" + id + '/' + main_id,
                success: function (result) {
                    $('#addledger').html('');
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if (id > 0) {
                            if (itemsingle.date !== null) {
                                $('#ledger').val(itemsingle.ledger_from);
                                $('#date').val(formatDate(itemsingle.date));
                            }
                        }
                        if (i === 0) {
                            $('#total').val(itemsingle.tot);
                        }
                        addtoledger(itemsingle.id, itemsingle.name, itemsingle.amt, itemsingle.pay_narration);
                    });
                }
            });
        }
        function addtoledger(id, name, amt, pay_narration) {
            var text = '<tr><td><input type="hidden" value="' + id + '" id="to_ledger[]" name="to_ledger[]">' + name + '</td><td><input style="width:90%" type="number" class="rowcalc" name="ledger_amount[]" value="' + amt + '" /></td><td><input style="width:90%" value="' + pay_narration + '" type="text" name="paynarration[]"/ ></td></tr>';
            $('#addledger').append(text);
        }
        $("#print").click(function () {
            window.print();
        });

    });
    function printElem(divId) {
        var content = document.getElementById(divId).innerHTML;
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>
