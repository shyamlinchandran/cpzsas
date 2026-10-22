<?php ?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('transaction/Purchase/listall/order'); ?>" action="<?php echo site_url('Stock_journal/print_barcodes/').$id; ?>"  class="form-horizontal">

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
							<a href="<?php echo site_url('Stock_journal/print_barcodes/').$id; ?>"  id="printall"  data-toggle="tooltip" target= "_blank" tp = "new"   title='Save' class='btn bg-orange btn-print'> Print All </a> 
						</div>
                        <div class="col-sm-12">
                                <div class="box-body no-padding">
								
                                    <table class="table ">
                                        <tr>
                                            <th><?= label('SNo', $this, $user) ?></th>
                                            <th><?= label('Item Name', $this, $user) ?></th>
                                            <th><?= label('Barcode', $this, $user) ?></th>
                                            <th><?= label('Quantity', $this, $user) ?></th>
                                            <th><?= label('Action', $this, $user) ?></th>
                                        </tr>
                                        <tbody id="addrow">
											<?php $j=1;foreach($result as $item){ ?>
												<tr>
													<th><?php echo $j; ?></th>
													<th><?php echo $item['name']; ?></th>
													<th><?php echo $item['barcode']; ?></th>
													<th><?php echo $item['quantity']; ?></th>
													<th><a href="<?php echo site_url('Stock_journal/print_barcodes/').$id.'/'.$item['id']; ?>" data-toggle="tooltip"  target= "_blank" tp = "new" style ="dispaly:none;"   title='Save' class='btn bg-green btn-print'> Print  </a> </th>
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
