<?php $add_url = site_url('transaction/purchase/create/' . $type); ?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label(ucwords(str_replace('_', ' ', $type)), $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!--                    <form id="form-filter">
                                            <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td class="col-sm-2 text-center">
                                                            <br/>
                                                            <a role="button" class="btn btn-default align-bottom" href="<?php echo $add_url ?>">
                                                                <span class="glyphicon glyphicon-plus"></span> 
                                                            </a>
                                                        </td>
                                                        <td class="col-sm-2" align="center">
                                                            Invoice
                                                            <input type="text" class="form-control" id="invoice"/>
                                                        </td>
                                                        <td class="col-sm-2">
                                                            Supplier
                                                            <input type="text" class="form-control" id="supname"/>
                                                            <input type="hidden" class="form-control" id="supid"/> 
                                                        </td>
                    
                                                        <td>
                                                            <br/>
                                                            <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                                        </td>
                                                        <td>
                                                            <br/>
                                                            <input type="button" class="btn btn-success" id="btn-reset"  value="Reset"/>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>   
                                        </form>-->
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
                                    <?= label('Bill Type', $this, $user) ?> 
                                    <select class="form-control" id="btype" name="btype" value="0"> 
                                        <option value="">Select</option>
                                    </select>

                                </td>
                                <td class="col-sm-2">
								<br />
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                                <td class="col-sm-2">

                                </td>
                                <td class="col-sm-3">

                                </td>

                                <td>

                                </td>
                            </tr>
                        </tbody>
                    </table>                  
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Invoice', $this, $user) ?></th>
                                <th><?= label('Bill No', $this, $user) ?></th>
                                <th><?= label('Supplier', $this, $user) ?></th>
                                <th><?= label('Total', $this, $user) ?></th>
                                <th></th> 
     <!--                                <th>Eligibility</th>-->
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

<?php $login_comid = $this->session->userdata('login_comid'); ?>

<script type="text/javascript">
	var chkid = 0 ;
    var table;
	$(document).on("click",".pur_edit",function() {
		$(this).attr('href','#');
	});
    $(document).ready(function () {
		$('#startdate').val('');
		$('#enddate').val('');
		chkid = chkid + 1;
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/' . $type) ?>",
            async: false,
            success: function (result) {
                $('#btype').html(result);
				var result = readCookie('<?php echo $login_comid ?>list_purchase');
				if (result != null) {
					results = JSON.parse(result);
					 $.each(results, function (index, value) {
						 $('#btype').val(value.btype);
						 $('#startdate').val(value.startdate);
						 $('#enddate').val(value.enddate);
						 $('#btn-filter').trigger('click');
					 });
				}
            }
        });
        //datatables
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('transaction/purchase/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = '<?php echo $type ?>';
                    data.invoice = $('#invoice').val();
                    data.supid = $('#supid').val();
					data.btype = $('#btype').val();
					data.startdate = $('#startdate').val();
					data.enddate = $('#enddate').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
        var val = readCookie('search_<?= $type ?>');  
        if (val !== null) { 
            table.search(val).draw();
        }
        $('.dataTables_filter input').unbind().keyup(function () {
            var value = $(this).val();
            if (value.length > 2) {
                createCookie('search_<?= $type ?>', value, 3);
                table.search(value).draw();
            }
            if (value.length === 0) {
                eraseCookie('search_<?= $type ?>');
                table.search(value).draw();
            }
        });
        // EDIT: Capture enter press as well

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
			var arr = [];
			var btype = $('#btype').val();
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			arr.push({
				btype: btype,
				startdate:startdate,
				enddate:enddate
			});
			createCookie('<?php echo $login_comid ?>list_purchase', JSON.stringify(arr), 3);
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#supid').val(ui.item.id)
            }
        });

    });

</script> 
</body>
</html>