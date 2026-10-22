<?php
$add_url = site_url('suppliers/create/');
$com_tax_type = $settings[0]['com_tax_type'];
?>

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<input type="hidden" value="<?= $com_tax_type ?>" name="tax_type" id="tax_type" />  
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('item\listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
					<table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <?= label('Area', $this, $user) ?>  
                                    <select  id="area"  name="area" class="clsarea form-control">
										<option value="">Select</option> 
									</select>
								</td>
                               <td class="col-sm-2">
									<br />
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
								</td>
								<td class="col-sm-2">
									  
								</td>
								 <td class="col-sm-2">
                                   
                                </td>
								<td class="col-sm-2">
                                   
                                </td>
                                <td>
                                    <br/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table <?=$this->table_color?> " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <th class="tax_id"><?= label('Tax', $this, $user) ?></th>
                                <th><?= label('Phone', $this, $user) ?></th>
                                <th><?= label('Email', $this, $user) ?></th>
                                <th><?= label('Address', $this, $user) ?></th>
                                <th><?= label('Area', $this, $user) ?></th>
                                <th><?= label('Actions', $this, $user) ?></th>
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


<script type="text/javascript">

    var table;

    $(document).ready(function () {
	$.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area').html(result);
               
            }
        });
var taxtype = $("#tax_type").val();
            if(taxtype==="GST")
            {
                $(".tax_id").html("<?= label('GSTIN', $this, $user) ?>");
            }
            else
            {
                $(".tax_id").html("<?= label('Tax', $this, $user) ?>");
            }
        //datatables
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
           "lengthMenu": [[10, 25, 50, 100,-1], [10, 25, 50, 100,'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
               
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('suppliers/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.type = '<?php echo $type ?>';
					data.area = $('#area').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });


    });

</script>  