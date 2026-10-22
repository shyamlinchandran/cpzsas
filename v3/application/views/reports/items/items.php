<?php 
	$title = 'Stock Report';
?>
<div class="modal fade" id="myset_FilterModal">
	<form  id="frmvisible"  action="<?php echo site_url('settings/menus/save_visible'); ?>" home="<?php echo site_url('main/members/index'); ?>">    
    <div class="modal-dialog">
	<input type="hidden" name="save_url" id="save_url"/>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?= label('Set Invisible Fields', $this, $user) ?></h4>
            </div>
            <div class="modal-body">
				<div class="col-sm-12" id="div_vis">
				</div>
                <table class="table no-border" cellspacing="0" width="100%">
                   

                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="set_btn"  data-dismiss="modal" class="btn btn-primary">Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
	</form>
</div>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label('Stock Report', $this, $user) ?></h3>
					<input type="hidden" id="report_header" value="<?php echo $title;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
					<span class="pull-right"> 
                         <?php if( $this->session->userdata('login_comid') != 'boyszone'){?>
                        <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="req_export">Request Export</a></a>
                        <?php }?>
                        <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="set_filter">Set InVisible</a></a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-1">
                                    <?= label('End Date', $this, $user) ?> 
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                                <td class="col-sm-1">
                                    <?= label('Godown', $this, $user) ?>
                                    <select id="item_godown"  class="form-control" name="item_godown">
                                        <option value="">Select</select>
                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    <?= label('HSN', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="hsnid" id="hsnid"/><input name="hsn" id="hsn" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="<?= label('Hsn', $this, $user) ?>"></td>
                                <td class="col-sm-2">
                                    <?= label('Category', $this, $user) ?> 
									<input type="hidden" id="category" name="category" class="form-control" />
                                    <input type="text" id="item_category_name" name="item_category_name" class="form-control" />
                                    
                                </td>
								<td class="">
                                    <?= label('Brand', $this, $user) ?>
                                    <select id="brand"  class="form-control" name="brand">
                                        <option value=""><?= label('Select', $this, $user) ?></select>
                                    </select> 
                                </td>
                                <td class="">
                                    <?= label('Tax', $this, $user) ?>
                                    <select id="tax"  class="form-control" name="tax">
                                        <option value=""><?= label('All', $this, $user) ?></select>
                                    </select> 
                                </td>
								<td class="">
                                    <?= label('Item', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
								<td class="">
                                    <?= label('Material Type', $this, $user) ?>
                                    <select id="material_type"  class="form-control" name="material_type">
                                        <option value=""><?= label('Select', $this, $user) ?></select>
                                    </select> 
                                </td>
								 <td class="col-sm-1">
                                    <?= label('Closing Stk', $this, $user) ?>
                                    <select id="cl_stk"  class="form-control" name="cl_stk">
                                        <option value=""><?= label('All', $this, $user) ?></option>
										<option value="zero_stock"><?= label('Zero Stock', $this, $user) ?></option>
										<option value="minus_stock"><?= label('Negative Stock', $this, $user) ?></option>
										<option value="with_stock"><?= label(' With Stock', $this, $user) ?></option>
										</select>
                                    </select> 
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>  
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <th><?= label('Barcode', $this, $user) ?></th>
                                <?php if($is_batch > 0 ){?>
                                    <th><?= label('Batch', $this, $user) ?></th>
                                <?php }?>
                                <!--<th><?= label('Unit', $this, $user) ?></th>-->
                                <th><?= label('Godown', $this, $user) ?></th>
                               <!-- <th><?= label('Opening Stock', $this, $user) ?></th>
                                <th><?= label('Opening Stock Rate', $this, $user) ?></th>
                                <th><?= label('Opening Stock Value', $this, $user) ?></th>
                                <th><?= label('Stock Transaction', $this, $user) ?></th>-->
                                <th><?= label('Closing Stock', $this, $user) ?></th>
                                <th><?= label('Closing Stock Rate', $this, $user) ?></th>
                                <th><?= label('Closing Stock Value', $this, $user) ?></th>
                                <!--<th><?= label('Sale Rate', $this, $user) ?></th>-->
                                <!--<th><?= label('MRP', $this, $user) ?></th>-->
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
	function showstockledeger(btn){
		var name = $(btn).attr('name');
		var toid = $(btn).attr('id');
		var arr = [];
		var result = readCookie('<?php echo $login_comid ?>stock_ledger_cook');
		var enddate = $('#enddate').val();
		var startdate = '';
		arr.push({
			startdate: startdate,
			enddate: enddate,
			name: name,
			toid: toid,
			});
		createCookie('<?php echo $login_comid ?>stock_ledger_cook', JSON.stringify(arr), 3);
		$("#last_click").attr('href', "<?= base_url() ?>reports/stock/leadger?newpage=new");
        $("#last_click").click();
	}
	var txt = '';
    $(document).on("click", "#req_export", function() {
		$.ajax({
			url: "<?php echo site_url('ajaxcall/ReportRequest/stock_report'); ?>",
			type: "POST",
			async:false,
			data: {
                filters: JSON.stringify({
                    tax: $("#tax").val(),
                    toid: $('#toid').val(),
                    godown: $("#item_godown").val(),
                    hsn: $("#hsnid").val(),
                    category: $("#category").val(),
                    item_status: $("#cl_stk").val(),
                    date: $("#enddate").val(),
                    material_type: $("#material_type").val(),
                    brand: $("#brand").val()
                })
			},
			success: function(result) {
				
				
			}
		});
		
    });

	$(document).on("click", "#set_filter", function() {
		
		var l =0;
		//$('#table > thead > tr > th').each(function(){
			//txt = txt + '<div style="margin-bottom:30px;" class="col-sm-4"><input type="checkbox" id="vis" name="vis[]" value="'+l+'">  '+$(this).text()+'</div>';
			//l++;
			//$('#div_vis').html(txt);
		//});
        $('#myset_FilterModal').modal('show');
    });
	$(document).on("click", "#set_btn", function() {//button filter event click
		var form_data = $('#frmvisible').serialize(); 
		var post_url = $('#frmvisible').attr("action"); //get form action url
		var request_method = $('#frmvisible').attr("method"); //get form GET/POST method
		$.ajax({
			url: post_url,
			type: "POST",
			async:false,
			data: form_data,
			success: function(result) {
				txtt = result;
				txtt= JSON.parse(txtt);
				location.reload(true);
			}
		});
         $('#myset_ClosureModal').modal('hide');
    });
	
	var hr = '';	
	var txtt = [];
    var id = 0;
    var table;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    $(document).ready(function () {
		$.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value = "">Select</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#brand").html(option);
               
            }
        });
		
		
		
		 		var txt_doc = '';
		l = 0 ;
		$('#table > thead > tr > th').each(function(){
			txt = txt + '<div style="margin-bottom:30px;" class="col-sm-4"><input type="checkbox" id="vis" name="vis[]" value="'+l+'">  '+$(this).text()+'</div>';
			l++;
			$('#div_vis').html(txt);
		});
	
		hr = $(location).attr('href');
		hr = hr.replace('?newpage=new', '');
		var url = '<?php echo base_url();?>';
		hr = hr.replace(url, '');
		$('#save_url').val(hr);
		$.ajax({
			url: "<?php echo site_url('ajaxcall/get_visible'); ?>",
			type: "POST",
			async:false,
			data: {
				hr:hr
			},
			success: function(result) {
				txtt = result;
				txtt= JSON.parse(txtt);
				
			}
		});
		$("#name").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/itemssearch/name", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
		 $.ajax({
            url: "<?php echo site_url('master/amaster/material_types'); ?>/",
            async: false,
            success: function(result) {
                $("#material_type").html('<option value="">All</option>'+result);
            }
        });
		$("#item_category_name").autocomplete({
        source: "<?php echo site_url('Item/getallCat'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#category').val(ui.item.id);
            $('#item_category_name').val(ui.item.name);
        }
    });
        $("#hsn").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/category", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#hsnid").val(ui.item.hsnid);
                $("#btn-filter").focus();
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/getgodown'); ?>",
            success: function (result) {
                $('#item_godown').html(result);
                $('#item_godown').prepend(
                        $('<option selected></option>').val("").html('All')
                        );
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/itemgroup'); ?>",
            success: function (result) {
                $('#category').html(result);

            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function (result) {
                $('#tax').html(result.replace("Select", "All"));
			//	ms();
            }
        });
        //datatables
        function ms()
        {
            var customButtons = [];
            <?php if( $this->session->userdata('login_comid') == 'boyszone' ||  $this->session->userdata('login_comid') == 'msa2025'){?>
                customButtons = [
                    {
                        extend: 'excelHtml5',
                        className: 'btn bg-navy',
                        filename: $('#file_header').val() + '_' + jsDate,
                        text: '<i class="fa fa-file-excel-o"></i>',
                        messageTop: "Printed Date- " + jsDate,
                        exportOptions: { columns: ':visible' },
                        action: newexportaction,
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            var todate = $('#enddate').val();
                            var hsn = $('#hsnid').val();
                            var godownr = $("#item_godown option:selected").text();
                            var category = $("#category option:selected").text();
                            var tax = $("#tax option:selected").text();

                            // Update Title and Sub-header in Excel
                            $('c[r=A1] t', sheet).text(company + " - " + $('#report_header').val());
                            $('c[r=A2] t', sheet).text("End date : " + todate + " , Godown :" + godownr + " , hsn :" + hsn + " , Category :" + category + " , Tax :" + tax);
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        className: 'btn bg-olive',
                        filename: $('#file_header').val() + '_' + jsDate,
                        orientation: 'portrait', 
                        pageSize: 'A4',
                        exportOptions: { columns: ':visible' },
                        action: newexportaction,
                        customize: function (doc) {
                            var todate = $('#enddate').val();
                            var hsn = $('#hsnid').val();
                            var godownr = $("#item_godown option:selected").text();
                            var category = $("#category option:selected").text();
                            var tax = $("#tax option:selected").text();

                            // 1. Remove the default title
                            doc.content.splice(0, 1);

                            // 2. Set custom sub-header text
                            doc.content[0].text = "End date: " + todate + " | Godown: " + godownr + " | Hsn: " + hsn + " | Category: " + category + " | Tax: " + tax;
                            doc.content[0].margin = [0, 10, 0, 10]; // Top/Bottom spacing

                            // 3. Document Styling
                            doc.defaultStyle.fontSize = 9;
                            doc.styles.tableHeader.fontSize = 10;
                            doc.styles.tableHeader.fillColor = '#2d4154'; // Navy blue header
                            doc.styles.tableHeader.color = 'white';

                            // 4. Custom Header (Company Name & Report Title)
                            doc['header'] = function() {
                                return {
                                    columns: [
                                        {
                                            alignment: 'center',
                                            text: company + " - " + $('#report_header').val(),
                                            fontSize: 14,
                                            bold: true,
                                            margin: [0, 10]
                                        }
                                    ]
                                };
                            };

                            // 5. Custom Footer (Created Date, Signature, Page Numbers)
                            doc['footer'] = function(page, pages) {
                                return {
                                    columns: [
                                        {
                                            alignment: 'left',
                                            text: 'Created on: ' + jsDate,
                                            margin: [20, 0]
                                        },
                                        {
                                            alignment: 'center',
                                            text: 'Authorized Signature: __________________',
                                        },
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                            margin: [0, 0, 20, 0]
                                        }
                                    ],
                                    margin: [10, 0]
                                };
                            };

                            // 6. Table Layout/Borders
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) { return 0.5; };
                            objLayout['vLineWidth'] = function(i) { return 0.5; };
                            objLayout['hLineColor'] = function(i) { return '#aaa'; };
                            objLayout['vLineColor'] = function(i) { return '#aaa'; };
                            objLayout['paddingLeft'] = function(i) { return 4; };
                            objLayout['paddingRight'] = function(i) { return 4; };
                            doc.content[0].layout = objLayout;
                        }
                    }
                ];
            <?php }?>
            if (id === 1) {
                table.destroy();
            }
            id = 1;
            table = $('#table').DataTable({
                "paging": true,
                "language": lan, "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
						
				columnDefs:txtt,
                "buttons": [ {
						extend: 'colvis',
						className: 'btn bg-navy noVis',
						columns: ':not(.noVis)',
						text: '<i class="fa fa-file-excel-o"></i>',
					},
                ],
                "order": [], //Initial no order.            
                // Load data for the table's content from an Ajax source
                "buttons": customButtons,
                "ajax": {
                    "url": "<?php echo site_url('reports/items/ajax_list') ?>",
                    "type": "POST",
                    "data": function (data) {
                        data.tax = $("#tax").val();
		                data.toid = $('#toid').val();
                        data.godown = $("#item_godown").val();
                        data.hsn = $("#hsnid").val();
                        data.category = $("#category").val();
						data.item_status = $("#cl_stk").val();
                        data.date = $("#enddate").val();
                        data.material_type = $("#material_type").val();
                        data.brand = $("#brand").val();
                        $("#hsnid").val('');
                    }
                },
                //Set column definition initialisation properties.
                
            });
        }
        $('#btn-filter').click(function () { //button filter event click
            ms();
            table.ajax.reload(null, false);  //just reload table
            // clear();
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });
    });
</script>  
