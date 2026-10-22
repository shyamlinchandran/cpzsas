<?php

$type = 'cus';
?>
<input type="hidden" value="<?= $id ?>" name="id" id="id" />
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/images/Blank_Club_Website_Avatar_Gray.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center" id="name"></h3>
                    <p id="custname" class="text-muted text-center"></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Name : </b> <a id="email" class="text-center"><?php echo $item_details['name'];?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Barcode : </b> <a id="phone" class="text-center"><?php echo $item_details['barcode'];?></a>
                        </li>
                        <li class="list-group-item">
                            <b class="tax_id">Stock in Hand : </b> <a id="tin" class="text-center"><?php echo $item_details['item_stock'];?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Prate :</b> <a id="gst" class=""><?php echo $item_details['prate'];?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Srate :</b> <a id="gst" class=""><?php echo $item_details['srate'];?></a>
                        </li>
                        <li class="list-group-item">
                            <b>MRP :</b> <a id="gst" class=""><?php echo $item_details['MRP'];?></a>
                            <br><br><br>
                        </li>
						<li class="list-group-item">
                            <b>Rack :</b> <a id="gst" class=""><?php echo $item_details['rackname'];?> , row : <?php echo $item_details['row'];?></a>
                            <br><br><br>
                        </li>
						
                        <li class="list-group-item">
                            <a href="<?php echo site_url('inventory_master/Item/create/') . $id ?>" title="Edit" data-toggle="tooltip" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit</a>
                        </li>
                        <li class="list-group-item">
                            <b>Purchased Quantity : <?php echo $item_transaction['purchase']; ?></b> <a id="sales" class="pull-right">
                                <span class="label label-success"></span></a>
                        </li>
						<li class="list-group-item">
                            <b>Sale Return Quantity : <?php echo $item_transaction['sales_return']; ?></b> <a id="sales" class="">
                                <span class="label label-success"></span></a>
                        </li>
						
                        <li class="list-group-item">
                            <b>Received Quantity : <?php echo $item_transaction['received']; ?></b> <a id="sales" class="pull-right">
                                <span class="label label-success"></span></a>
                        </li>
                        <li class="list-group-item">
                            <b>Damaged Quantity : <?php echo $item_transaction['damage']; ?></b> <a id="sales" class="pull-right">
                                <span class="label label-success"></span></a>
                        </li>
                        <li class="list-group-item">
                            <b>sales Quantity : <?php echo $item_transaction['sales']; ?></b> <a id="vouchers" class="pull-right">
                                <span class="label label-success"></span></a>
                            </a>
                        </li>
						 <li class="list-group-item">
                            <b>P Return Quantity : <?php echo $item_transaction['purchase_return']; ?></b> <a id="vouchers" class="pull-right">
                                <span class="label label-success"></span></a>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Issued Quantity : <?php echo $item_transaction['issued']; ?></b> <a id="vouchers" class="pull-right">
                                <span class="label label-success"></span></a>
                            </a>
                        </li>
                    </ul>
                    <!--  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <!-- <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
              </div> -->
            <!-- /.box-header -->
            <!-- <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div> -->
            <!-- /.box-body -->
            <!--  </div> -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title suppname">Item </h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('inventory_master/Item/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('inventory_master/Item/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <ul class="nav nav-tabs">
						<li class="active"><a href="#stocktab" data-toggle="tab">Stock</a></li>
                        <li class=""><a href="#salestab" data-toggle="tab">Sales</a></li>
                        <li><a href="#estimatetab" data-toggle="tab">SOrder</a></li>
                        <li><a href="#sales_returntab" data-toggle="tab">SReturn</a></li>
						<li><a href="#damagetab" data-toggle="tab">Damage</a></li>
                        <li><a href="#purchasetab" data-toggle="tab">Purchase</a></li>
                        <li><a href="#ordertab" data-toggle="tab">POrder</a></li>
                        <li><a href="#purchase_returntab" data-toggle="tab">PReturn</a></li>
						<li><a href="#journaltab" data-toggle="tab">StockJournal</a></li>
						<li><a href="#man_journal" data-toggle="tab">Manf Journal</a></li>
						<li><a href="#phyStk" data-toggle="tab">Physical Stk Update</a></li>
                        <li><a href="#settings" data-toggle="tab">Ledger</a></li>
                    </ul>
                    <div class="tab-content">
					
					<div class=" tab-pane" id="phyStk">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Physical Stock</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="phyStktable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?= label('SNo', $this, $user) ?></th>
												<th><?= label('Item Name', $this, $user) ?></th>
												<th><?= label('Barcode', $this, $user) ?></th>
												<th><?= label('Godown', $this, $user) ?></th>
												<th><?= label('Open Stock', $this, $user) ?></th>
												<th><?= label('Voucher No', $this, $user) ?></th>
												<th><?= label('Date', $this, $user) ?></th>
												<th><?= label('Stock Increase', $this, $user) ?></th>
												<th><?= label('Stock Decrease', $this, $user) ?></th>
												<th><?= label('Closing Stock', $this, $user) ?></th>
                                            </tr>
                                        </thead>
                                        


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
						
						
					<div class=" tab-pane" id="man_journal">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">manufacturing Journal</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="man_journaltable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>Date</th>
												<th>Invoice</th>
                                                <th>Godown</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
					<div class=" tab-pane" id="damagetab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Damage</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="damagetable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>Date</th>
												<th>Invoice</th>
                                                <th>Godown</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
						<div class="active tab-pane" id="stocktab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Stock</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id=""  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Godown</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $i= 0; foreach($stock as $item){  $i++; ?>
												<tr>
													<th><?php echo $i;?></th>
													<th><?php echo $item['godown_name'];?></th>
													<th><?php echo $item['stock'];?></th>
												</tr>
											<?php } ?>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
						<div class=" tab-pane" id="journaltab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Sales Return</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="journaltable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Issued</th>
                                                <th>Received</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
                        <!-- /.tab-pane -->
						 <div class=" tab-pane" id="sales_returntab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Sales Return</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="sales_returntable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Customer</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
												<th>Mrp</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
                        <div class=" tab-pane" id="salestab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Sales</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="salestable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Customer</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
												<th>Mrp</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
						<div class=" tab-pane" id="estimatetab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Sales Order</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="estimatetable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Customer</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
												<th>Mrp</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
						<div class=" tab-pane" id="purchasetab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Purchase</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="purchasetable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Supplier</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
												<th>Mrp</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
                        <!-- /.tab-pane -->
                        <div class=" tab-pane" id="ordertab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Purchase Order</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="ordertable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Supplier</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
												<th>Mrp</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
                        <!-- /.tab-pane -->
                        <div class=" tab-pane" id="purchase_returntab">
                            <!-- The timeline -->
                            <section class="content"> 
                                <div class="box-header">
                                   <h3 class="box-title">Purchase Return</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="purchase_returntable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Supplier</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
												<th>Mrp</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>


                                    </table>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="sreturn">
                            <!-- Post -->
                            <section class="content"> 


                                <!-- /.box-header -->
								<div class="box-header">
                                   <h3 class="box-title"><?php echo $vtype ?> Sales Return</h3> 
                                </div>
                                <div class="box-body">
                                    <table id="srtable"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice No</th>
                                                <th>Invoice Date</th>
                                                <th>Customers</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->

                                <!-- /.row -->
                            </section>


                        </div>

                        <div class="tab-pane" id="settings">
                            <section class="content"> 
                                <div class="box-header">
                                    <h3 class="box-title">Ledger</h3> 
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
								<form id="frmId" >
                                <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <tbody>
                                <tr>

                                    <td class="col-sm-2">
                                        <?= label('Start Date', $this, $user) ?>
                                        <input type="text" class="form-control date" id="startdate"/>
                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('End Date', $this, $user) ?>  
                                        <input type="text" class="form-control date" id="enddate"/> 
                                    </td>

                                    <td class="col-sm-2">
                                        <input type="hidden" class="form-control" id="<?php echo $id;?>"/> 
                                    </td>

                                    <td>
                                        <br/>
                                        <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('search', $this, $user) ?>" data-validation="required"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>          
						<div class="row" style=" background: #4678d5;    padding:5px;    color: #fff;">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><?= label('Total Debit', $this, $user) ?> </h5>

                                        <h5 id="wdb">0.00</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= label('Total Credit', $this, $user) ?> </h5>

                                        <h5 id="wcb">0.00</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= label('Balance', $this, $user) ?> </h5> 
                                        <h5 id="wb">0.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
							</div>
							
						</div>
                        <br/>
                        <table id="ledgertable"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= label('SNo', $this, $user) ?></th>

                                    <th><?= label('Date', $this, $user) ?></th>
                                    <th><?= label('Particulars', $this, $user) ?></th>
                                    <th><?= label('Voucher No', $this, $user) ?></th>
                                    <th><?= label('Credit', $this, $user) ?></th>
                                    <th><?= label('Debit', $this, $user) ?></th>
                                    <th><?= label('Closing', $this, $user) ?></th>
                                    <!--
                                    <th>Voucher No</th>
                                    <th>Narration</th> -->
                            </thead>
                            <tbody>
                            </tbody>


                        </table>
						</form>
                                </div>
                                <!-- /.box-body -->

                            </section>


                        </div> 
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->


</div>
<!-- /.col -->

</div>
<!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
</div>
<script type="text/javascript">
	var ledid = 0;
	var phyStk;
	function loadtables(){
	
		phyStk = $('#phyStktable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/ItemTransaction/physical_stk_update_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.toid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		
		purchase_returntable = $('#purchase_returntable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/purchase_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = 'purchase_return';
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		man_journaltable = $('#man_journaltable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/man_journal_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		ordertable = $('#ordertable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/purchase_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = 'order';
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		purchasetable = $('#purchasetable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/purchase_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = 'purchase';
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        salestable = $('#salestable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = 'sales';
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		estimatetable = $('#estimatetable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = 'estimate';
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		sales_returntable = $('#sales_returntable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = 'sales_return';
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		
		journaltable = $('#journaltable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/stockjournal_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
		
		damagetable = $('#damagetable').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inventory_master/Transactions/damage_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.item_id = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
	}
	function ms(){
		if (ledid === 1) {
            ledgertable.destroy();
        }
        ledid = 1;
		ledgertable = $('#ledgertable').DataTable({
            "language": lan,
            "paging": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
			"bPaginate": true,
            "autoWidth": false,
            "footerCallback": function (row, data, start, end, display) {
				console.log(data[0]);
			//	var opencr  = data[0][4];
			//	var opendt = data[0][5];
				var opencr = 0 ;
				var opendt = 0 ;
				var cr = data[0][7];
				var dt = data[0][8];
				if(cr === undefined){
					cr = 0;
				}
				if(dt === undefined){
					dt = 0;
				}
				var credit = parseFloat(cr) + parseFloat(opencr);
				var debit = parseFloat(dt) + parseFloat (opendt);
				var bal = parseFloat(debit) - parseFloat(credit);
				$('#wcb').html(credit);
				$('#wdb').html(debit);
				$('#wb').html(bal);

                console.log(data[0][4]);     
                console.log(data[0][5]);     
                console.log(data[0][7]);     
                console.log(data[0][8]);             
            },
            "lengthMenu": [[5, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'stock_ledger_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#name').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Stock Ledger');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " Ledger :" + ledgername);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'stock_ledger_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#name').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " Ledger : " + ledgername;
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy

                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!

                        //  doc.pageMargins = [20, 60, 20, 30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 9;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 9;
                        // Create a header object with 3 columns
                        // Left side: Logo
                        // Middle: brandname
                        // Right side: A document title
                        doc['header'] = (function () {
                            return {
                                columns: [
                                    {
                                        alignment: 'center',
                                        //italics: true,
                                        text: company + " - " + 'Stock Ledger',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        /*for (var i = 1; i < doc.content[1].table.body.length; i++) {
                         doc.content[1].table.body[i][4].alignment = 'right';
                         doc.content[1].table.body[i][0].alignment = 'center';
                         doc.content[1].table.body[i][1].alignment = 'center';
                         }*/
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Created on: ', {text: jsDate.toString()}]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    }
                                    ,
                                    {
                                        alignment: 'right',
                                        text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function (i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function (i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/stock/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.toid = $('#id').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
	}
    var salestable;
	var ledgertable;
	var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    $(document).ready(function () {
        //datatables
		loadtables();
        ms();
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
        });
		
		
		
		
        loadpermission();
        $('#btn-filter').click(function () { //button filter event click
            ms();
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table

        });
        
        
        
		
		
        var id = 0;

    });

    function load() {
	}
</script> 
