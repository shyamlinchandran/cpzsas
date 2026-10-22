<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $type)) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php if ($type == 'Sales' || $type == 'Sales_Order' || $type == 'Sales_Return') { ?>
                        <table   class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Customer</th> 
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $i = 0;
                                foreach ($search as $sale) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?> </td>
                                        <td><?php echo $sale['invoice'] ?> </td>
                                        <td><?php echo $sale['invoice_date'] ?> </td>
                                        <td><?php echo $sale['name'] ?> </td>
                                        <td><?php echo $sale['total'] ?> </td>
                                        <td>   <a href="<?php echo base_url().'transaction/sales/sales/view/'.$sale['sid']; ?>" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>  </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } if ($type == 'Purchase' || $type == 'Purchase_Order' || $type == 'Purchase_Return' ) { ?>
                        <table   class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Supplier</th> 
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $i = 0;
                                foreach ($search as $purchase) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?> </td>
                                        <td><?php echo $purchase['invoice'] ?> </td>
                                        <td><?php echo $purchase['date'] ?> </td>
                                        <td><?php echo $purchase['name'] ?> </td>
                                        <td><?php echo $purchase['total'] ?> </td>
                                        <td>   <a href="<?php echo base_url().'transaction/purchase/view/purchase/'.$purchase['pid']; ?>" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>  </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } if ($type == 'Customers') { ?>
                        <table   class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>GSTIN</th>
                                    <th>Phone</th> 
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $i = 0;
                                foreach ($search as $customer) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?> </td>
                                        <td><?php echo $customer['name'] ?> </td>
                                        <td><?php echo $customer['tin'] ?> </td>
                                        <td><?php echo $customer['phone'] ?> </td>
                                        <td><?php echo $customer['email'] ?> </td>
                                        <td>   <a href="<?php echo base_url().'customers/profile/'.$customer['id']; ?>" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>  </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } if ($type == 'Suppliers') { ?>
                        <table   class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>GSTIN</th>
                                    <th>Phone</th> 
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $i = 0;
                                foreach ($search as $supplier) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?> </td>
                                        <td><?php echo $supplier['name'] ?> </td>
                                        <td><?php echo $supplier['tin'] ?> </td>
                                        <td><?php echo $supplier['phone'] ?> </td>
                                        <td><?php echo $supplier['email'] ?> </td>
                                        <td>   <a href="<?php echo base_url().'suppliers/profile/'.$supplier['id']; ?>" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>  </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } if ($type == 'Items') { ?>
                        <table   class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Barcode</th>
                                    <th>Cost</th> 
                                    <th>Sales Rate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                $i = 0;
                                foreach ($search as $item) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?> </td>
                                        <td><?php echo $item['name'] ?> </td>
                                        <td><?php echo $item['barcode'] ?> </td>
                                        <td><?php echo $item['prate'] ?> </td>
                                        <td><?php echo $item['srate'] ?> </td>
                                        <td>   <a href="<?php echo base_url().'item/view/'.$item['id']; ?>" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>  </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>