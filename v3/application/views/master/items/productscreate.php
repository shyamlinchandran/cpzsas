<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/vouchers/journal'); ?>" action="<?php echo site_url('master/items/save_sitem'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="vid" id="vid"/> 
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/> 
    <input type="hidden"   name="def_accid" id="def_accid"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Journal Voucher  Create</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-5">                           
                            <div class="form-group">
                             

                                <div class="col-sm-10">
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                

                                <div class="col-sm-10">                              
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                

                                   
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-12">
                             
                            <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>Date  </td>
                                        <td>  <input class="form-control date" id="date" name="date" data-validation="required,date"   data-validation-format="dd/mm/yyyy" placeholder="Date" /></td>
                                        
                                        <td>Product Name: </td>
                                        <td><input type="hidden" name="supid" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Name"></td>
                                        <td>From Godown</td>
										 <td><select  id="from_godown"  name="from_godown" class="form-control col-lg-2" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
									     <td>To Godown</td>
										 <td><select  id="to_godown" name="to_godown" class="form-control ledger" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
	
									</tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-striped table-condensed" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Debit</th>
									<th>Credit</th>
                                    

                                    <th>
                                        <a data-toggle="tooltip"   title="Add More" id="addmore"  class="btn btn-default" href="#">
                                            <span class="glyphicon glyphicon-plus"></span> 
                                        </a>
                                    </th>
                                </tr>

                            </thead>
                            <tbody id="rowm">
                                <tr id="add">
                                    <td><input type="hidden"  name="id[]" class="ids"/>
                                        <input data-validation="length" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>
                                    <td ><input style="float:right" type="text" name="debit[]"     class="form-control hunpx cal debit two-digits" placeholder="Debit"/></td>
                                    <td ><input style="float:right"  type="text" name="credit[]"     class="form-control hunpx cal credit two-digits" placeholder="Credit"/></td>

                                    <td>
                                        <span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">
                                            <span class="glyphicon glyphicon-remove-sign"></span> 
                                        </span>
                                    </td>

                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td ><input disabled="disabled" style="float:right" id="totaldebit" type="text"  name="total"   class="form-control hunpx    two-digits" placeholder="Debit"/></td>
                                    <td ><input disabled="disabled" style="float:right" id="totalCredit" type="text" class="form-control hunpx   two-digits" placeholder="Credit"/></td>

                                    <td> 
                                    </td>

                                </tr>
                            </tfoot>
                        </table>

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
</form>
<script type="text/javascript">
    $.validate({
        modules: 'date, security,file'
    });
    $(document.body).on('change', '.cal', function () {
        calculate();
    });
    var is_load;// this is for is load the datatable initially 
    $(document.body).on('change', '.hunpx', function () {
        if (is_load !== 1) {
            var amount = $(this).val();
            alert(amount)
            if (amount !== '' && parseInt(amount) !== 0) {
                var deb = $(this).hasClass("debit");
                if (deb === true) {
                    autopay(amount);
                }
                else {
                    autopayr(amount);
                }
                is_load = 1;
            }

        }
    });
    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
            val = 0;
        }
        return val;

    }
    function autopayr(amount) {
        var autoCheck = $('#autoCheck').is(':checked');
        var collection = $(".chkchg");
        var totalamount = amount;
        if (autoCheck === true) {
            if (totalamount !== 0) {
                collection.each(function () {
                    $(this).prop('checked', autoCheck);
                    var id = $(this).attr('id');
                    //debit amount 
                    var hdcrdt = getVal("hddbt" + id);
                    var txtamt = "#txtamtc" + id; 
                    var bal = parseFloat(totalamount) - parseFloat(hdcrdt);

                    if (parseFloat(totalamount) < parseFloat(hdcrdt)) {
                        $(txtamt).val(totalamount);
                    }
                    else {
                        totalamount = (parseFloat(totalamount) - parseFloat(hdcrdt)).toFixed(2);
                        $(txtamt).val(hdcrdt);
                    }
                    var txtbal = "#txtbal" + id;
                    if (bal < 0 || bal === 0) {
                        $(txtbal).val((-1 * parseFloat(bal)).toFixed(2));
                        return false;
                    }
                    else {
                        $(txtbal).val(0.00);
                    }
                });
            }
        }
        else {
            collection.each(function () {
                $(this).prop('checked', autoCheck);
                var id = $(this).attr('id');
                var txtamt = "#txtamt" + id;
                var txtbal = "#txtbal" + id;
                $(txtamt).val(0.00);
                $(txtbal).val(0.00);
            });
        }

    }
    $(document.body).on('focus', 'input.ledger', function () {
        $(this).autocomplete({
            source: "<?php echo base_url(); ?>master/items/search/jou", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $(this).siblings('.ids').val(ui.item.id)
				
                if (ui.item.ref_code === 'fwr' || ui.item.ref_code === 'sup' || ui.item.ref_code === 'con' || ui.item.ref_code === 'cus')
                {
                    $("#def_accid").val(ui.item.id);
                    if (is_load !== 1)
                    {
                        ms(ui.item.id, 'n',0,0);
                    }
                }
				
				 $.ajax({
                    url: "<?php echo site_url('transaction/vouchers/getLedegerbalance'); ?>/" + ui.item.id + "",
                    success: function (results) {
                        $("#balance").html("Clossing Balance: " + results);
                    }
                });
               
                var inputs = $(this).parents("form").eq(0).find(":input");
                var idx = inputs.index(this);
                if (idx === inputs.length - 1) {
                    inputs[0].select()
                } else {
                    inputs[idx + 1].focus(); //  handles submit buttons
                    //inputs[idx + 1].select();
                }
            }
        });
    });




     function loadCust(ui) {
        $('#supname').val(ui.item.name);
       

    }

    var row = '<td><input type="hidden"  name="id[]" class="ids"/>' +
            '<input data-validation="length" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
            '<td ><input style="float:right" type="text" name="debit[]"     class=" deb form-control hunpx cal debit two-digits" placeholder="Debit"/></td>' +
            '<td ><input style="float:right"  type="text" name="credit[]"     class="cre form-control hunpx cal credit two-digits" placeholder="Credit"/></td>' +
            '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';

    function addrow(id, name, debit, credit) {
        var singrow = '<td><input type="hidden" value=' + id + '  name="id[]" class="ids"/>' +
                '<input data-validation="length" value="' + name + '" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
                '<td ><input style="float:right"  value=' + debit + ' type="text" name="debit[]"     class="deb form-control hunpx cal debit two-digits" placeholder="Debit"/></td>' +
                '<td ><input style="float:right" value=' + credit + '  type="text" name="credit[]"     class="cre form-control hunpx cal credit two-digits" placeholder="Credit"/></td>' +
                '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").append(newRow);
    }
    $(document).ready(function () {
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#from_godown').html(result)
            }
        });
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#to_godown').html(result);
            }
        });

         $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/getpurchaseitems'); ?>",
            minLength: 2,
            select: function (event, ui) {
                 $('#supid').val(ui.item.id);
                loadCust(ui);
              
            }
        });
        load();
        is_load = 0;



        
        $('#addmore').click(function () {
            var newRow = "<tr>" + row + "</tr>";
            $("#rowm").append(newRow);
            $(".remove").removeClass("hidden");
            $(".remove").first().addClass("hidden");
            calculate();
        });
        $(".remove").first().addClass("hidden");

    })
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });
    function calculate() {
        var credit = calc('.credit');
        var debit = calc('.debit');
        $("#totalCredit").val(credit);
        $("#totaldebit").val(debit);
        if (credit === debit) {
            $("#form-button-save").removeAttr("disabled");
        }
    }
    function calc(element) {
        var amount = 0;
        $(element).each(function () {
            var val = $(this).val();
            if (val === '')
            {
                val = 0;
                $(this).val(0);
            }
            amount = parseFloat(amount) + parseFloat(val);
        });
        return amount;
    }
    function load() {
        var vid = $('#vid').val();
        if (vid !== '0') {
            $.ajax({
                url: "<?php echo site_url('master/items/getproducts'); ?>/" + vid + "",
                success: function (results) {

                      



                    $("#add").remove();
                    $.each(JSON.parse(results), function (i, itemsingle) {
                          $.ajax({
                url: "<?php echo site_url('master/items/getpitem'); ?>/" + itemsingle.pid + "",
                success: function (results) {

                
                
                
                        $.each(JSON.parse(results), function (i, item) {
                        $('#date').val(itemsingle.dtp);
						 $('#to_godown').val(itemsingle.to_godown);
						 $('#from_godown').val(itemsingle.from_godown);                     
                               $('#supname').val(item.name);
                                $('#supid').val(item.id);
                      

                    });
                }
            });                 

                        $('#date').val(itemsingle.dtp);
                       
                        addrow(itemsingle.sid, itemsingle.sname, itemsingle.total, itemsingle.quantity)
                      

                    });
                    calculate();
                    var sm = $("#view").val();
                }
            });
        }
    }
    var table;
    var id = 0;
    function ms(toid, edit, c, d)
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
            "searching": false, "bInfo": false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aging/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.type = 'jou';
                    data.enddate = $('#enddate').val();
                    data.id = toid;
                    data.vid = $('#vid').val();
                }
            },
            "fnDrawCallback": function (oSettings) {
                if (edit === 'e') {
                    if (parseInt(c) === 0) { 
                        autopay(d);
                    }
                    else { 
                        autopayr(c);
                    }
                }

            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        $("#narration").focus();
    }
    function autopay(amount) {
        var autoCheck = $('#autoCheck').is(':checked');
        var collection = $(".chkchg");
        var totalamount = amount;
        if (autoCheck === true) {
            if (totalamount !== 0) {
                collection.each(function () {
                    $(this).prop('checked', autoCheck);
                    var id = $(this).attr('id');
                    var hddbt = "hddbt" + id;
                    var hdcrdt = getVal("hdcrdt" + id);
                    var txtamt = "#txtamtd" + id;
                    var bal = parseFloat(totalamount) - parseFloat(hdcrdt);

                    if (parseFloat(totalamount) < parseFloat(hdcrdt)) {
                        $(txtamt).val(totalamount);
                    }
                    else {
                        totalamount = (parseFloat(totalamount) - parseFloat(hdcrdt)).toFixed(2);
                        $(txtamt).val(hdcrdt);
                    }
                    var txtbal = "#txtbal" + id;
                    if (bal < 0 || bal === 0) {
                        $(txtbal).val((-1 * parseFloat(bal)).toFixed(2));
                        return false;
                    }
                    else {
                        $(txtbal).val(0.00);
                    }
                });
            }
        }
        else {
            collection.each(function () {
                $(this).prop('checked', autoCheck);
                var id = $(this).attr('id');
                var txtamt = "#txtamt" + id;
                var txtbal = "#txtbal" + id;
                $(txtamt).val(0.00);
                $(txtbal).val(0.00);
            });
        }

    }
</script>
