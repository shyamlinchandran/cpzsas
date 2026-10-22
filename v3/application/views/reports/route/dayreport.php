<?php
$user = $this->session->userdata('user');
$utype = $user['utype'];
?>
<div class="modal fade" id="myFilterModal">
    <input type="hidden" id="closure_id" name="closure_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?= label('Apply Filter', $this, $user) ?></h4>
            </div>
            <div class="modal-body">
					<input type="hidden" value="" id="head_text" /> 
                <table class="table no-border" cellspacing="0" width="100%">
                    <tr>
						<td class="col-sm-2">
                            <?= label('Agent/Reference', $this, $user) ?>
                            <select id="reference" name="reference" class="form-control" name="chrq_status">
                            </select>      
                        </td>
                        <td class="col-sm-2">
                            <?= label('Salesman', $this, $user) ?>
                            <select id="salesman" name="salesman" class="form-control" name="chrq_status">
                            </select>      
                        </td>
						 <td class="col-sm-2">
                            <?= label('User', $this, $user) ?>
                            <select id="user" name="user" class="form-control" name="chrq_status">
                            </select>      
                        </td>
                    </tr>

                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="clos_btn"  data-dismiss="modal" class="btn btn-primary">Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <input type="hidden" value="<?php echo $utype; ?>" id="utype" name="utype"/> 
                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
					<span class="pull-right"> 

                <!--           <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>
-->                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                    <?= label('Start Date', $this, $user) ?>
                                    <input type="text" class="clsarea form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('End Date', $this, $user) ?>  
                                    <input type="text" class="clsarea form-control date" id="enddate"/> 
                                </td>
                               
                                 <td class="col-sm-2">
                                    <?= label('Area', $this, $user) ?>  
                                    <select  id="area"  name="area" class="clsarea form-control">
										<option value="">Select</option> 
									</select>
                                </td>
                                <td class="col-sm-2">
                                   
							  <td class="col-sm-2">
                                   

							  </td>
							  <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Item', $this, $user) ?></th>
                                <th><?= label('Quantity', $this, $user) ?></th>
                                <th><?= label('Unit', $this, $user) ?></th>
								
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
$(document).on("click", "#filter", function() {
        $('#myFilterModal').modal('show');
    });
    $.validate({
        modules: 'date, security,file'
    });
    var table;
    var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "paging": true,
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                    extend: 'print',
                    text: '<i class="glyphicon glyphicon-print"></i>',
                    className: 'btn btn-primary', 
                    title:  getheader("<?= label($title, $this, $user) ?>",'head_text'),
                    footer: true,
                   // autoPrint: false,
                    //  messageTop: '<div class="col-12 text-right">This print was produced using the Print button for DataTables</div>',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt !important');
                        $(win.document.body).css('margin', '13px');
                        $(win.document.body).find('table').addClass('display').css('font-size', '13px');
                        $(win.document.body).find('table').next("div").html(" <hr /><br/><div class='col-12 col-md-12 text-right' >Printed Date : <?php echo date("d-m-Y")  ?></div>");
                    }
                }],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/Area/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
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

    }
    $(document).ready(function () {
			$('.clsarea').change(function(){
				var text = $("#area option:selected").text();
				var startdate = $('#startdate').val();
				var enddate = $('#enddate').val();
				if(startdate === enddate){
					text  = text + ' &nbsp;&nbsp;&nbsp;' + startdate;
					$('#head_text').val(text);
				}else{
					text  = text + ' &nbsp;&nbsp;&nbsp;' + startdate + ' to ' + enddate;
					$('#head_text').val(text);
				}

			});
		     $.ajax({
				url: "<?php echo site_url('ajaxcall/area'); ?>",
				success: function (result) {
					$('#area').html(result);
				}
			});
		
		$('#clos_btn').click(function() { //button filter event click
             table.ajax.reload(null, false); //just reload table
             $('#myClosureModal').modal('hide');
         });
		$.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
                
								$('#user').html(result);
               
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/reference'); ?>",
            success: function (result) {
                $('#reference').html(result.replace('Select', 'All'));

            }
        });

      
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
        function loadCust(ui) {
            $('#supname').val(ui.item.name);
            $('#supid').val(ui.item.id);
        }
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                loadCust(ui);

            }
        });
        $('#btn-filter').click(function () { //button filter event click

            ms();
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
</script>
