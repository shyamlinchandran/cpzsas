<?php  $pd = 0;?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('transaction/Purchase/listall/order'); ?>" action="<?php echo site_url('transaction/Purchase/print_barcodes/').$id; ?>"  class="form-horizontal">

    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Print barcodes', $this, $user) ?> </h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('transaction/Purchase/listall/order'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('transaction/Purchase/listall/order'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
					
                    <div class="box-body tableBodyScroll">
						<div class="col-sm-12">
							<a href="<?php echo site_url('transaction/Purchase/print_barcodes/').$id; ?>"  id="printall"  data-toggle="tooltip" target= "_blank" tp = "new"   title='Save' class='btn bg-orange btn-print'> Print All </a>
							<a style ="display:none;" href="<?php echo site_url('transaction/Purchase/print_barcodes/').$id.'/'.$pd.'/checked'; ?>"  id="printallchecked"  data-toggle="tooltip" target= "_blank" tp = "new"   title='Save' class='btn bg-orange btn-print'> Print All </a>
                            <button type="button"  id="print_checked"  title='Save' class='btn bg-orange btn-success'> Print Checked </button> 
                            &nbsp;
                        </div>
                        <div class="col-sm-12">
                                <div class="box-body no-padding">
								
                                    <table class="table ">
                                        <tr>
                                            <th><?= label('SNo', $this, $user) ?></th>
                                            <th><?= label('Item Name', $this, $user) ?></th>
                                            <th><?= label('Barcode', $this, $user) ?></th>
                                            <th><?= label('Quantity', $this, $user) ?></th>
                                            <th><?= label('Print Quantity', $this, $user) ?></th>
                                            <th><?= label('Action', $this, $user) ?></th>
                                        </tr>
                                        <tbody id="addrow">
											<?php $j=1;foreach($result as $item){ ?>
												<tr>
													<th>
                                                        <input type="checkbox" class="chk-print" data-row="<?php echo $item['id']; ?>" data-qty="<?php echo $item['quantity']; ?>">
                                                    <?php echo $j; ?></th>
													<th><?php echo $item['name']; ?></th>
													<th><?php echo $item['barcode']; ?></th>
													<th><?php echo $item['quantity']; ?></th>
                                                      <td>
                                                            <input type="number" name="print_quantity[]" class="form-control print-quantity" id="print_qty_<?php echo $item['id']; ?>" value="0" min="0" max="<?php echo $item['quantity']; ?>" >
                                                        </td>
													<th><a href="<?php echo site_url('transaction/Purchase/print_barcodes/').$id.'/'.$item['id']; ?>" data-toggle="tooltip"  target= "_blank" tp = "new" style ="dispaly:none;"   title='Save' class='btn bg-green btn-print'> Print  </a> </th>
												</tr>
											<?php $j++; }?>
                                        </tbody>  

                                    </table>
                                </div>
                        </div>

                        <!-- /.box -->
                    </div>
                    <div class="box-footer" class="col-sm-12">
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- /.row -->
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
          
        });
    </script> 

    <script>
    $(document).ready(function () {
        $('.chk-print').on('change', function () {
            var row = $(this).data('row');
            var qty = parseFloat($(this).data('qty'));
            var $printQtyInput = $('#print_qty_' + row);

            if ($(this).is(':checked')) {
                $printQtyInput.val(qty);
            } else {
                $printQtyInput.val(0);
            }
        });
    });

   $('#print_checked').on('click', function () {
        var rows = [];
        var quantities = {};
        var k = 0 ;
        $('.chk-print:checked').each(function () {
            var row = $(this).data('row');               // e.g., 3506
            var qty = $('#print_qty_' + row).val();      // e.g., 10
            k = k + 1;
            rows.push(row);                              // add to row list
            quantities[row] = qty;                       // key-value quantity
        });

        // For testing
        console.log("Rows:", rows);
        console.log("Quantities:", quantities);
        if(k > 0 ){
            // Send to PHP (via AJAX)
            $.ajax({
                url: "<?php echo site_url('transaction/purchase/print_selected'); ?>",
                method: "POST",
                data: {
                    rows: rows,
                    quantities: quantities
                },
                success: function (response) {
                    //$('#printallchecked').trigger('click');
                    var hre = $('#printallchecked').attr('href');
                        window.open(hre , '_blank');

                },
                error: function () {
                    alert("Error in sending data.");
                }
            });
        }
        
    });



  
</script>
