<!-- <div class="box-body"> -->
<form method="post" id="frmcreatemodels" back="<?php echo site_url('reports/Financial_stock_report/list'); ?>" action="<?php echo site_url('reports/Financial_stock_report/save'); ?>" class="form-horizontal">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $view)) ?></h3>
                        <input id="no_use" name="no_use" type="hidden" value="" maxlength="50">
                        <input id="id" name="id" type="hidden" value="<?= $id ?>" maxlength="50">
                        <input id='view_id' name="view_id" type="hidden" value="<?= $view ?>">
                        <input type="hidden" name="abc" id="abc" value="">

                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('reports/Financial_stock_report/list'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('reports/Financial_stock_report/list'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>

                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Invoice Number', $this, $user) ?>*<span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="invoice" data-validation="required" value="" class="form-control" name="invoice" type="text" maxlength="50" />
                                </div>
                            </div>
                            <!-- <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    ?= label('Date', $this, $user) ?>*<span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="date" data-validation="required" value="" class="form-control date" name="date" type="text" maxlength="50" />
                                </div>
                            </div>                            -->
                        </div>

                        <div class="col-sm-12" style="margin:0px; height:300px;overflow-y:scroll">

                            <table id="table_products" class="table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>Add Item</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Item Code</td>
                                        <td>Name</td>
                                        <td>HSN</td>
                                        <td>Category</td>
                                        <td>Prate</td>
                                        <td>Srate</td>
                                        <td>Cgst</td>
                                        <td>Sgst</td>
                                        <td>Igst</td>
                                        <td>GST</td>
                                        <td>Qty</td>
                                    </tr>
                                    <tr>

                                        <td><input class="form-control" id="item_code" name="item_code" type="text" value="" placeholder="item_code"></input></td>
                                        <td> <input class="form-control" id="item_code_id" name="item_code_id" type="hidden" value=""></input>
                                            <input class="form-control" id="name" name="name" type="text" value="" placeholder="name"></input>
                                        </td>
                                        <td><input class="form-control" id="hsn_code" name="hsn_code" type="text" value="" placeholder="hsn"></input></td>
                                        <td><input class="form-control" id="vendor" name="vendor" type="text" value="" placeholder=""></input></td>
                                        <td><input class="form-control" id="prate" name="prate" type="text" value="" placeholder=""></input></td>
                                        <td><input class="form-control" id="srate" name="srate" type="text" value="" placeholder=""></input></td>
                                        <td><input class="form-control" id="cgst" name="cgst" type="text" value="" placeholder=""></input></td>
                                        <td><input class="form-control" id="sgst" name="sgst" type="text" value="" placeholder=""></input></td>
                                        <td><input class="form-control" id="igst" name="igst" type="text" value="" placeholder=""></input></td>
                                        <td><input class="form-control" id="gst" name="gst" type="text" value="" placeholder=""></input></td>
                                        <td><input class="form-control" id="qty" name="qty" type="text" value="" placeholder=""></input></td>
                                        <td><button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtra" class="btnAddExtra btn btn-success" href="#">
                                                <span class="glyphicon glyphicon-plus"></span> </button></td>

                                    </tr>
                                </tbody>

                                <tbody id='addrow' class="table <?= $this->table_color ?> table-responsive">
                                </tbody>
                            </table>
                        </div>


                        <div class="box-footer popuphide">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</form>

<?php if ($view == 'edit') { ?>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="<?= $this->box_color ?>">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="table" class="table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th> <?= label('Sl No', $this, $user) ?></th>
                                    <th> <?= label('Item Code', $this, $user) ?></th>
                                    <th><?= label('Name', $this, $user) ?></th>
                                    <th><?= label('Hsn', $this, $user) ?></th>
                                    <th> <?= label('Category', $this, $user) ?></th>
                                    <th> <?= label('Prate', $this, $user) ?></th>
                                    <th><?= label('Srate', $this, $user) ?></th>
                                    <th><?= label('Sgst', $this, $user) ?></th>
                                    <th> <?= label('Cgst', $this, $user) ?></th>
                                    <th> <?= label('Igst', $this, $user) ?></th>
                                    <th><?= label('GST', $this, $user) ?></th>
                                    <th><?= label('Qty', $this, $user) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- </div> -->

<?php } ?>



<script type="text/javascript">
    var id = $("#id").val();
    var view = $('#view_id').val();

    $("#btnAddExtra").click(function() {
        if ($('#item_code').val() == '' || $('#name').val() == ''  || $('#prate').val() == '' || $("#srate").val() == '' || $('#sgst').val() == '' || $('#cgst').val() == '' || $('#igst').val() == '' || $('#gst').val() == '' || $('#qty').val() == '') {
            //alert('Please Select Data');
        } else {
            var item_code_id = $('#item_code_id').val();
            var item_code = $('#item_code').val();
            var name = $('#name').val();
            var hsn_code = $('#hsn_code').val();
            var vendor = $('#vendor').val();
            var prate = $('#prate').val();
            var srate = $("#srate").val();
            var cgst = $('#cgst').val();
            var sgst = $('#sgst').val();
            var igst = $("#igst").val();
            var gst = $('#gst').val();
            var qty = $('#qty').val();
            // var unique_id = '';
            add_data(item_code_id, item_code, name, hsn_code, vendor, prate, srate, cgst, sgst, igst, gst, qty);
        }
    });

    function add_data(item_code_id, item_code, name, hsn_code, vendor, prate, srate, cgst, sgst, igst, gst, qty) {
        $('#item_code_id').val('');
        $('#item_code').val('');
        $('#name').val('');
        $('#hsn_code').val('');
        $('#vendor').val('');
        $("#prate").val('');
        $('#srate').val('');
        $('#cgst').val('');
        $('#sgst').val('');
        $("#igst").val('');
        $('#gst').val('');
        var newrow = "<tr>";
        newrow = newrow + "<td><input id='item_code_id' value='" + item_code_id + "' class='form-control' name='item_code_id[]' type='hidden' /><input readonly id='item_code' value='" + item_code + "' class='form-control' name='item_code[]' type='text' /></td>";
        newrow = newrow + "<td><input readonly id='name' value='" + name + "' name='name[]' type='text' class='form-control' /></td>";
        newrow = newrow + "<td><input readonly id='hsn_code' value='" + hsn_code + "' name='hsn_code[]' type='text' class='form-control'/></td>";
        newrow = newrow + '<td><input readonly type="text" id="vendor" value="' + vendor + '" class="form-control" name="vendor[]"" /></td>';
        newrow = newrow + "<td><input readonly id='prate' value='" + prate + "' class='form-control' name='prate[]' type='text'/></td>";
        newrow = newrow + "<td><input  readonly id='srate' value='" + srate + "' class='form-control' name='srate[]' type='text'  /></td>";
        newrow = newrow + "<td><input  readonly id='cgst' value='" + cgst + "' class='form-control' name='cgst[]' type='text'/></td>";
        newrow = newrow + "<td><input  readonly id='sgst' value='" + sgst + "' class='form-control' name='sgst[]' type='text'  /></td>";
        newrow = newrow + "<td><input  readonly id='igst' value='" + igst + "' class='form-control' name='igst[]' type='text'  /></td>";
        newrow = newrow + "<td><input readonly id='gst' value='" + gst + "' class='form-control' name='gst[]' type='text'  /></td>";
        newrow = newrow + "<td><input readonly id='qty' value='" + qty + "' class='form-control' name='qty[]' type='text'  /></td>";


        if (view == "view") {
            newrow = newrow + "<td style = 'display:none'><button data-toggle='tooltip' type='button' title='Delete' id='remove' class='btn btn-danger remove' href='#'><span class='glyphicon glyphicon-remove'></span></button></td> </tr>";
        }
        // if (edit == "edit") {
        //     newrow = newrow + "<td><button value='" + unique_id + "' data-toggle='tooltip' type='button' title='Delete' id='remove_db' class='btn btn-danger' href='#'><span class='glyphicon glyphicon-remove'></span></button></td>";
        // newrow = newrow + '<td><a  href="' . base_url() . 'service_implementation/Service_implementation/create/' . $item->imp_id . '/edit" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>                  

        // } 
        else {
            newrow = newrow + "<td><button data-toggle='tooltip' type='button' title='Delete' id='remove' class='btn btn-danger remove' href='#'><span class='glyphicon glyphicon-remove'></span></button></td> </tr>";
        }
        $('#addrow').append(newrow);
		$('#item_code').focus();
    }

    $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
        //calcrow();
    });

    if (id > 0) {
        $.ajax({
            url: "<?php echo site_url('reports/Financial_stock_report/getsing'); ?>/" + id,
            success: function(results) {

                var result = JSON.parse(results);
                $("#invoice").val(result.invoice);
                $("#date").val(result.created_date);
            }
        });
    }

    $("#name").autocomplete({
        source: "<?php echo site_url('reports/Financial_stock_report/auto_item'); ?>",
        minLength: 2,
        select: function(event, ui) {
            loadCust(ui);
        }
    });

    function loadCust(ui) {
        $('#name').val(ui.item.name);
        $('#item_code_id').val(ui.item.item_id);
        $('#item_code').val(ui.item.barcode);
        $('#hsn_code').val(ui.item.hsncode);
        $('#vendor').val(ui.item.vendor);
        $('#srate').val(ui.item.srate);
        $('#prate').val(ui.item.prate);
        $('#cgst').val(ui.item.cgst);
        $('#sgst').val(ui.item.cgst);
        $('#gst').val(ui.item.GST);
        $('#igst').val(ui.item.igst);
        $('#qty').val(ui.item.quantity);
    }

    var table;

    table = $('#table').DataTable({
        "language": lan,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "scrollX": true,
        "scrollY": 200,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        'buttons': [ {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Current Stock Position',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: " ",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10,11]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                      
                        $('c[r=A1] t', sheet).text(company);
                        $('c[r=A2] t', sheet).text("Current Stock Position");
                    }
                }],
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('reports/financial_stock_report/ajax_list_create') ?>",
            "type": "POST",
            "data": function(data) {
				

                data.id = $('#id').val();
                // data.btype = $('#btype').val();
            }
        },

        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false //set not orderable
        }]

    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(null, false); //just reload table
    });

    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(null, false); //just reload table

    });
    $("#item_code").keyup(function() {
        var item_code = $("#item_code").val();
        if (item_code !== '') {
            $.ajax({
                url: "<?php echo site_url('reports/Financial_stock_report/auto_barcode'); ?>",
                type: 'POST',
                async:false,
                data: {
                    item_code: item_code
                },
                success: function(results) {
					if(results.length > 10){
						var result = JSON.parse(results);
						$('#name').val(result.name);
						$('#item_code_id').val(result.item_id);
						$('#item_code').val(result.label);
						$('#hsn_code').val(result.hsncode);
						$('#vendor').val(result.vendor);
						$('#srate').val(result.srate);
						$('#prate').val(result.prate);
						$('#cgst').val(result.cgst);
						$('#sgst').val(result.cgst);
						$('#gst').val(result.GST);
						$('#igst').val(result.igst);
						$('#qty').val(result.quantity);
						setTimeout(function(){
							 $('.btnAddExtra').trigger('click');}, 100);
 
						
					}
                }
				
            });
        }
    });

    function loadauto(ui) {
        $('#name').val(ui.item.name);
        $('#item_code_id').val(ui.item.item_id);
        $('#item_code').val(ui.item.label);
        $('#hsn_code').val(ui.item.hsncode);
        $('#vendor').val(ui.item.vendor);
        $('#srate').val(ui.item.srate);
        $('#prate').val(ui.item.prate);
        $('#cgst').val(ui.item.cgst);
        $('#sgst').val(ui.item.cgst);
        $('#gst').val(ui.item.GST);
        $('#igst').val(ui.item.igst);
        $('#qty').val(ui.item.quantity);
    }



    // $('#qty').click(function() {
    //     $('#btnAddExtra').click();
    // });

    // $("#qty").on('keydown', '#textbox', function(e) {
    //     alert('ok');
    //     var keyCode = e.keyCode || e.which;

    //     if (keyCode == 9) {
    //         e.preventDefault();
    //          JQuery('#btnAddExtra')[0].click();
    //     }
    // });

    // $("#gst").keyup(function() {
    //     alert("Handler for called.");
    // });
    // $("#gst").on("change", function() {
    //         alert('Text content changed!');
    //     });
    // $("#gst").on("change", function(){
    //     // Print entered value in a div box
    //    // $("#result").text($(this).val());
    //    alert('ss');
    // });

    $('#gst').each(function() {
        var elem = $(this);
        // Save current value of element
        elem.data('oldVal', elem.val());
        // Look for changes in the value
        elem.bind("propertychange change click keyup input paste", function(event) {
            // If value has changed...
            if (elem.data('oldVal') != elem.val()) {
                // Updated stored value
                elem.data('oldVal', elem.val());
                // Do action
               // alert('success');
            }
        });
    });
</script>