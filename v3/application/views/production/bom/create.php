<form method="post" id="frmcreate" home="<?php echo site_url('production/bom/bom_controller/create'); ?>" back="<?php echo site_url('production/bom/bom_controller/create'); ?>" action="<?php echo site_url('production/bom/bom_controller/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="item_id" id="item_id" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('production/bom/bom_controller/create'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('production/bom/bom_controller/listall   '); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> <?= label(' Product ', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <input NoTab="true" id="product" class="form-control" name="product" type="text" value="" data-validation="required" maxlength="50">
                                        <input id="productid" class="form-control" name="product_id" type="hidden" value="" data-validation="required" maxlength="50">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> <?= label(' Quantity ', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <input id="pro_quantity" class="form-control" name="pro_quantity" type="text" value="" data-validation="required" maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> <?= label(' Price / product ', $this, $user) ?></label>
                                    <div class="col-sm-8">
                                        <input id="price_per_product" class="form-control" name="price_per_product" type="text" value="0.00" maxlength="50" disabled>
                                        <input id="price_per_product1" class="form-control" name="price_per_product1" type="hidden" value="0.00" maxlength="50">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 ">

                                <table class=table id="material_table">
                                    <thead>
                                        <th>Materials</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <?php if (isset($is_export_invoice) && $is_export_invoice > 0) { ?>
                                            <th>Percentage</th>
                                        <?php } ?>
                                    </thead>
                                    <tbody id=add_row>
                                        <tr>
                                            <td>
                                                <input id="materialid" class="form-control" name="materialid" type="hidden">
                                                <input NoTab="true" id="material" placeholder="Item" class="form-control" name="material[0]" type="text">
                                            </td>
                                            <td>
                                                <input id="quantity" placeholder="Nos" class="form-control calcrow " name="quantity" type="text">
                                            </td>
                                            <td>
                                                <input id="price" class="form-control calcrow" name="price" type="text" placeholder="Price Per Unit">
                                            </td>
                                            <td>
                                                <input id="total" class="form-control" name="total" type="text" value="0.00" placeholder="Total">
                                            </td>
                                            <?php if (isset($is_export_invoice) && $is_export_invoice > 0) { ?>
                                                <td>
                                                    <input id="percentage" class="form-control" name="percentage" type="text" value="" placeholder="Percentage">
                                                </td>
                                            <?php } ?>
                                            <?php
                                            if ($view != 'view') {
                                            ?>
                                                <td>
                                                    <a data-toggle="tooltip" style="float: left" title="Add More" id="addmore" class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                </td>
                                                </td>
                                            <?php
                                            }
                                            ?>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>
                        <hr>

                        <div class="row">


                            <div class="col-sm-4">


                            </div>

                            <div class="col-sm-8 ">

                                <table class=table id="ledger_table">
                                    <thead>
                                        <th>Ledger</th>
                                        <th>Amount</th>

                                    </thead>

                                    <tbody id=ledger_body>
                                        <tr>

                                            <td>
                                                <input id="ledger" class="form-control" name="ledger" type="text" value="" placeholder="Ledger" maxlength="50">
                                                <input id="ledgerid" class="form-control" name="ledgerid" type="hidden" value="" data-validation="required" maxlength="50">
                                            </td>

                                            <td>
                                                <input id="ledger_amount" placeholder="Amount" class="form-control " name="ledger_amount" type="text">
                                            </td>
                                            <?php
                                            if ($view != 'view') {
                                            ?>

                                                <td>
                                                    <a data-toggle="tooltip" style="float: left" title="Add More" id="add_ledger" class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>



                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-sm-4">

                                <label class="col-sm-4 control-label"> <?= label(' Material Amount ', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <input id="materialAmount" class="form-control" name="materialamount" type="text" value="0.00" maxlength="50">
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <label class="col-sm-4 control-label"> <?= label('Ledger Amount ', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <input id="ledgerAmount" class="form-control" name="ledgeramount" type="text" value="0.00" maxlength="50">
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <label class="col-sm-4 control-label"> <?= label(' Grand Total ', $this, $user) ?></label>
                                <div class="col-sm-8">
                                    <input id="totalAmount" class="form-control" name="amount" type="text" value="0.00" maxlength="50">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="box-footer">
                        <?php
                        if ($view != 'view') {
                        ?>

                            <button id="form-button-save" type="submit" data-toggle="tooltip" title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <div class="small-loading" id="FormLoading"> </div>

                        <?php  } ?>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
    </section>
</form>
<script type="text/javascript">
	 function calert(msg) {
        toastr["error"](msg);
    }
    $(document).ready(function() {

      var  i = 0;
      var j = 0;

        $('#addmore').click(function() {

            //add material row
            add_materialrow();

        });

        $('#material_table').keypress(function(e) {
            if (e.which == 13) {

                add_materialrow();
            }
        });


        $('#add_ledger').click(function() {

            add_ledger_row(); //add ledger row

        })  
        $('#ledger_table').keypress(function(e) {
            if (e.which == 13) {

                add_ledger_row(); //add ledger row

            }
        });


        $(document).on('click', '.remove_ledger', function() {

            $('.tootip').remove;
            $(this).closest('tr').remove();
            calculate_ledgersum()
        })


        $(document).on('click', '.remove', function() {

            $('.tooltip').remove();
            $(this).closest('tr').remove();
            calculate()

        })

        $('#product').autocomplete({

            source: "<?php echo site_url('production/bom/bom_controller/product_search'); ?>",
            minLength: 1,
            select: function(event, ui) {
                $('#productid').val(ui.item.id);

            }
        })

        $('#material').autocomplete({

            source: "<?php echo site_url('production/bom/bom_controller/search_material'); ?>",
            minLength: 1,
            select: function(event, ui) {
				var cls = $('.materialid');
				var is_exist = 0;
				cls.each(function(index, item) {
                    if ( parseFloat($(item).val()) === parseFloat(ui.item.id) ){
						is_exist = is_exist + 1;
					}
                });
				if(parseFloat(is_exist) < 1 ){
					$('#materialid').val(ui.item.id);
					$('#price').val(ui.item.prate);
				}else{
					calert('Item Exist');
					$('#material').val('');
					$('#materialid').val(0);
				}


            }
        })
        $('#ledger').autocomplete({
            source: "<?php echo site_url('production/bom/bom_controller/search_ledger'); ?>",
            minLength: 1,
            autoFocus: true,
            select: function(event, ui) {
                $('#ledgerid').val(ui.item.id);


            }
        })
        $('#pro_quantity').change(function() {
            grandTotal()

        })
        $(".calcrow").change(function() {
            rowchange();
        })

        function rowchange() {
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            var rowAmount = (parseFloat(price) * parseFloat(quantity))
            $("#total").val(rowAmount)
        }

        function calculate() {
            var total = $('.sum');
            var tot = 0;
            total.each(function(index, item) {
                tot = parseFloat(tot) + parseFloat($(item).val());
            });
            $("#materialAmount").val(tot);
            grandTotal();
        }


        $(document).on("change", ".insidechange", function() {
            var index = $(this).attr("index");
            var price = $('#price' + index).val();
            var quantity = $('#quantity' + index).val();
            var rowAmount = (parseFloat(price) * parseFloat(quantity))
            $("#total" + index).val(rowAmount);
            calculate();

        });
        $('.insidechange').change(function() {
            var index = $(this).attr("index");
            var price = $('#price' + index).val();
            var quantity = $('#quantity' + index).val();
            var rowAmount = (parseFloat(price) * parseFloat(quantity))
            $("#total" + index).val(rowAmount);
            calculate();

        });

        function calculate_ledgersum() {
            var total = $('.ledgersum');
            var tot = 0;
            total.each(function(index, item) {
                tot = parseFloat(tot) + parseFloat($(item).val());
            });
            $("#ledgerAmount").val(tot);
            grandTotal()

        }
        $(document).on("change", ".ledgersum", function() {
            calculate_ledgersum()

        })

        function grandTotal() {
            var ledgertotal = $("#ledgerAmount").val();
            var materialtotal = $("#materialAmount").val();
            var grandtotal = parseFloat(ledgertotal) + parseFloat(materialtotal);
            var quantity = $('#pro_quantity').val();
            var price_per_product = (parseFloat(grandtotal) / parseFloat(quantity));
            $("#totalAmount").val(grandtotal);
            $("#price_per_product,#price_per_product1").val(price_per_product);



        }


        function add_materialrow() {

            let materialid = $('#materialid').val();
            let material = $('#material').val();
            let quantity = $('#quantity').val();
            let price = $('#price').val();
            let total = $('#total').val();
            let percentage = $('#percentage').val() || '';
            let materialtableid=0;


            if (material && materialid && quantity && price) {
                material_row(materialtableid,materialid,material,quantity,price,total,percentage,i)
                $('#materialid').val('')
                $('#material').val('');
                $('#quantity').val('');
                $('#price').val('');
                $('#total').val('');
                $('#percentage').val('');
                i++;

                calculate();
            }

        }
         function material_row(materialtableid,materialid,material,quantity,price,total,percentage,i){
           if (typeof i === 'undefined') {
               i = percentage;
               percentage = '';
           }

           let new_row = '<tr><td><input  class="form-control" name="materialtableid[]" type="hidden" value="' + materialtableid + '">'
           +'<input  class="form-control materialid" name="materialid[]" type="hidden" value="' + materialid + '"><input  class="form-control" type="text" value="' + material + '" disabled></td>' +
                    '<td><input  class="form-control insidechange" index="' + i + '" id="quantity' + i + '" name="quantity[]" type="text" value="' + quantity + '"></td>' +
                    '<td><input  class="form-control insidechange" index="' + i + '" id="price' + i + '"  name="price[]" type="text" value="' + price + '" ></td>' +
                    '<td> <input  class="form-control sum" id="total' + i + '"  name="total[]" type="text" value="' + total + '"></td> ' 
                    <?php if (isset($is_export_invoice) && $is_export_invoice > 0) { ?>
                    + '<td><input class="form-control" index="' + i + '" id="percentage' + i + '" name="percentage[]" type="text" value="' + (percentage || '') + '"></td>'
                    <?php } ?>

                    <?php
                    if($view != 'view'){
                        ?>
                   + '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                    <?php } ?>
                    $('#add_row').append(new_row);


        }

        function new_row(ledgertableid,ledger_name, ledger_id, ledger_amount, j) {
            let new_row = ' <tr><td><input  class="form-control" name="ledgertableid[]" type="hidden" value="' + ledgertableid + '">'+
                '<input class="form-control" type="text" value="' + ledger_name + '" disabled >' +
                '<input  class="form-control" name="ledgerid[]" type="hidden" value="' + ledger_id + '" ></td>' +
                '<td> <input  class="form-control ledgersum" name="ledger_amount[]" type="text" value="' + ledger_amount + '"></td>'
                <?php
                    if($view != 'view'){
                        ?> 
               + '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove_ledger" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></span></td></tr>';
                <?php } ?>
            $('#ledger_body').append(new_row);
        }

        function add_ledger_row() {
           let ledger_name = $('#ledger').val();
           let ledger_id = $('#ledgerid').val();
           let ledger_amount = $('#ledger_amount').val();
           let ledgertableid = 0;
            if (ledger_name && ledger_amount && ledgerid) {

                new_row(ledgertableid,ledger_name, ledger_id, ledger_amount, j);
                $('#ledger').val('')
                $('#ledgerid').val('')
                $('#ledger_amount').val('')
                calculate_ledgersum()
                j++;
            }


        }

        var id = $('#item_id').val();
        if (id) {
            $.ajax({
                url: "<?php echo site_url('production/bom/bom_controller/getData') ?>/" + id,
                success: function(result) {
                    data = JSON.parse(result);

                    $('#product').val(data.product.name);
                    $('#productid').val(data.product.itemid);
                    $('#pro_quantity').val(data.product.quantity),
                    $('#ledgerAmount').val(data.product.ledgertotal)
                    $('#materialAmount').val(data.product.materialtotal)
                    $('#totalAmount').val(data.product.grandtotal)
                    $('#price_per_product1').val(data.product.price_per_quantity)
                    $('#price_per_product').val(data.product.price_per_quantity)


                    $.each(data.ledger, function(k, item) {
                        new_row(item.id,item.name, item.ledgerid, item.amount, k);
                      j=k+1;
                     

                    });

                    $.each(data.result,function(l,item){
                    material_row(item.id,item.materialid,item.name,item.quantity,item.price,item.total,item.percentage, l)

                     i=l+1;
                   
                    });
 

                }





            })



        }



    })
</script>