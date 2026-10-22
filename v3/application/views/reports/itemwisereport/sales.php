<?php
$isbatch = 0 ;
if(isset($settings[0]['is_batch'])){
	$isbatch = $settings[0]['is_batch'];
}
$taxtype = $settings[0]['com_tax_type'];
$user = $this->session->userdata('user');
$utype = $user['utype'];
?>
<style>
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #000;
    }

    .select2-selection.select2-selection--multiple {
        min-height: 25px;
        max-height: 75px;
    }
</style>
<link href="<?php echo base_url(); ?>asset/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />

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
						
						<td class="col-sm-3">
                            <?= label('Agent/Reference', $this, $user) ?>
                            <select id="reference" name="reference" class="form-control" name="chrq_status">
                            </select>      
                        </td>
                        <td class="col-sm-3">
                            <?= label('Salesman', $this, $user) ?>
                            <select id="salesman" name="salesman" class="form-control" name="chrq_status">
                            </select>      
                        </td>
						 <td class="col-sm-3">
                            <?= label('User', $this, $user) ?>
                            <select id="user" name="user" class="form-control" name="chrq_status">
                            </select>      
                        </td>
						<td class="col-sm-3">
                            <?= label('Area', $this, $user) ?>
                            <select id="area" name="area" class="form-control" name="chrq_status">
                            </select>      
                        </td>
					</tr>
					<tr>
						
						<td class="col-sm-3">
                            <?= label('Route', $this, $user) ?>
                            <select id="route" name="route" class="form-control" name="chrq_status">
                            </select>      
                        </td>
						 <td class="col-sm-3">
                                    <?= label('Bill Type', $this, $user) ?>
                                    <select tabindex="-1" id="btype" name="btype" class="form-control " >                                            
                                    </select>
                           </td>
						<td class="col-sm-3">
                            <?= label('Branch', $this, $user) ?>
                            <select id="branch" name="branch" class="form-control" name="branch">
                            </select>      
                        </td>
						<td class="col-sm-3">
                            <?= label('Batch', $this, $user) ?>
                            <input type ="text" name= "batch" id ="batch" class="form-control"/>
						</td>
                    </tr>
					
					<tr>
						<td colspan="4">
                            <?= label('Brand', $this, $user) ?>
                            <select tabindex="-1" id="brand" name="brand" class="form-control select2"  multiple="multiple" data-placeholder="Select Brands" style="width: 100%;height:60px;" >                                            
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
    <input type="hidden" value="<?php echo $taxtype; ?>" id="taxtype" name="taxtype"/> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
					<input type="hidden" id="report_header" value="<?php echo $title;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
                    <input type="hidden" value="<?php echo $utype; ?>" id="utype" name="utype"/> 
					<span class="pull-right"> 
						<a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>
					</span>
                </div>
                <!-- /.box-header -->
                <input type="hidden" value="<?php echo $saletype; ?>" id="saletype" name="saletype"/> 
                <div class="box-body table-responsive">
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
                                    <?= label('Category', $this, $user) ?> 
                                    <input type="hidden" id="category" name="category" class="form-control" />
                                    <input type="text" id="item_category_name" name="item_category_name" class="form-control" />
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Item', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
					
                                <td class="col-sm-2">
                                    <?= label('Customer', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="cusid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="customer"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Hsn Code', $this, $user) ?>  
                                    <input type="hidden" class="form-control" id="hsnid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="hsn"/> 
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-reset"  value="<?= label('Reset', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?> </th>
                                <th><?= label('Inv Date', $this, $user) ?> </th>
                                <th><?= label('Inv No', $this, $user) ?> </th>
                                <th><?= label('Item', $this, $user) ?> </th>
                                <?php if($isbatch > 0 ){?>
                                    <th><?= label('Batch', $this, $user) ?> </th>
                                    <?php } ?>
                                <th><?= label('Barcode', $this, $user) ?> </th>
                                <th><?= label('Hsncode', $this, $user) ?> </th>
                                <th><?= label('Mrp', $this, $user) ?> </th>
                                <th><?= label('Rate', $this, $user) ?> </th>
                                <th><?= label('Unit', $this, $user) ?> </th>
                                <th><?= label('Quantity', $this, $user) ?> </th>
								<th><?= label('F Qty', $this, $user) ?> </th>
                                <th><?= label('Customer', $this, $user) ?> </th> 
                                <th><?= label('Salesman', $this, $user) ?> </th> 
                                <th><?= label('Bill Type', $this, $user) ?> </th> 
                                <th><?= label('Value', $this, $user) ?> </th> 
                                <th><?= label('Discount', $this, $user) ?> </th>
                                <th><?= label('Add Dis.', $this, $user) ?> </th>
                                <th><?= label('Taxable', $this, $user) ?> </th>
                                <th><?= label('Tax%', $this, $user) ?> </th>
                                <?php if ($taxtype == 'GST') { ?>
                                    <th><?= label('cgst', $this, $user) ?></th>
                                    <th><?= label('sgst', $this, $user) ?></th>
                                <?php } ?>
                                <th><?= label('Total Tax', $this, $user) ?> </th>
                                <th><?= label('Cess %', $this, $user) ?> </th>
                                <th><?= label('Cess', $this, $user) ?></th>
                                <th><?= label('Other Expenses', $this, $user) ?> </th>
                                <th><?= label('Total', $this, $user) ?> </th>
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
<script src="<?php echo base_url(); ?>asset/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
	 $(function() {
        $('.select2').select2();
    });
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
	var start_date = $('#startdate').val();
	var  end_date = $('#enddate').val();
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            //"scrollY": "200px",
            "scrollCollapse": true,
            "paging": true,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, 100,-1], [10, 25, 50, 100,'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    text: '<i class="fa fa-file-excel-o"> Fast Excel</i>',
                    titleAttr: 'Fast Server-Side Export for large datasets',
                    className: 'btn bg-navy',
                    action: function ( e, dt, node, config ) {
                        var params = $.param({
                            startdate: $('#startdate').val(),
                            batch: $('#batch').val(),
                            enddate: $('#enddate').val(),
                            toid: $('#toid').val(),
                            cusid: $('#cusid').val(),
                            hsnid: $('#hsnid').val(),
                            saletype: $('#saletype').val(),
                            btype: $('#btype').val(),
                            taxtype: $('#taxtype').val(),
                            area: $('#area').val(),
                            route: $('#route').val(),
                            category: $("#category").val(),
                            reference: $('#reference').val(),
                            salesman: $('#salesman').val(),
                            user: $('#user').val(),
                            branch: $('#branch').val(),
                            brand: $('#brand').val()
                        });
                        window.location.href = "<?php echo site_url('reports/itemwisereport/export_sales_csv') ?>?" + params;
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: $('#file_header').val()+'_' +jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: ':visible'
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var itemname = $('#name').val();
                        var customer = $('#customer').val();
						var text = '';
						if($('#startdate').val() !== ''){
							text = 'Start Date : ' + start_date + ' ' ;
						}
						if($('#enddate').val() !== ''){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  End Date :'+ end_date + ' ' ;
						}
						if($('#toid').val() !== '' && $('#toid').val() !== 0 && $('#toid').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Item :'+ $('#name').val() + '' ;
						}
						if($('#cusid').val() !== '' && $('#cusid').val() !== 0 && $('#cusid').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Item :'+ $('#customer').val() + '' ;
						}
						if($('#hsnid').val() !== '' && $('#hsnid').val() !== 0 && $('#hsnid').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Item :'+ $('#hsn').val() + ' ' ;
						}
						if($('#area').val() !== '' && $('#area').val() !== 0 && $('#area').val() !== '0' ){
							if(text !== ''){
								text = text + ' , ';
							}
								text = text + ' Area :'+ $("#area option:selected").text() + ' ' ;
						}
						if($('#route').val() !== '' && $('#route').val() !== 0 && $('#route').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Route :'+ $("#route option:selected").text() + ' ' ;
						}
                        $('c[r=A1] t', sheet).text(company + " - " + $('#report_header').val());
                        $('c[r=A2] t', sheet).text(text);
                    }
                },{
				extend: 'csv',
				text: 'Copy all data',
				className: 'btn bg-navy',
				text: '<i class="fa fa-file-csv-o">CSV</i>',
				exportOptions: {
					modifier: {
						search: 'none'
					}
				}
			},
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: $('#file_header').val()+'_' +jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: ':visible',
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = start_date;
                        var todate = end_date;
                        var itemname = $('#name').val();
                        var customer = $('#customer').val();
						var text = '';
						if($('#startdate').val() !== ''){
							text = 'Start Date : ' + $('#startdate').val() + ' ' ;
						}
						if($('#enddate').val() !== ''){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  End Date :'+ $('#startdate').val() + ' ' ;
						}
						if($('#toid').val() !== '' && $('#toid').val() !== 0 && $('#toid').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Item :'+ $('#name').val() + '' ;
						}
						if($('#cusid').val() !== '' && $('#cusid').val() !== 0 && $('#cusid').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Item :'+ $('#customer').val() + '' ;
						}
						if($('#hsnid').val() !== '' && $('#hsnid').val() !== 0 && $('#hsnid').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Item :'+ $('#hsn').val() + ' ' ;
						}
						if($('#area').val() !== '' && $('#area').val() !== 0 && $('#area').val() !== '0' ){
							if(text !== ''){
								text = text + ' , ';
							}
								text = text + ' Area :'+ $("#area option:selected").text() + ' ' ;
						}
						if($('#route').val() !== '' && $('#route').val() !== 0 && $('#route').val() !== '0'){
							if(text !== ''){
								text = text + ' , ';
							}
							text = text + '  Route :'+ $("#route option:selected").text() + ' ' ;
						}
                        doc.content.splice(0, 1);
                        doc.content[0].text = text;
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy

                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!

                        //  doc.pageMargins = [20, 60, 20, 30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 6.5;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 7;
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
                                        text: company + " - " + $('#report_header').val(),
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
                "url": "<?php echo site_url('reports/itemwisereport/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.batch = $('#batch').val();
                    data.enddate = $('#enddate').val();
                    data.toid = $('#toid').val();
                    data.cusid = $('#cusid').val();
                    data.hsnid = $('#hsnid').val();
                    data.saletype = $('#saletype').val();
                    data.btype = $('#btype').val();
					data.taxtype = $('#taxtype').val();
					data.area = $('#area').val();
					data.route = $('#route').val();
					data.category = $("#category").val();
					data.reference = $('#reference').val();
                    data.salesman = $('#salesman').val();
					data.user = $('#user').val();
					data.branch = $('#branch').val();
					data.brand = $('#brand').val();
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
		$.ajax({
            url: "<?php echo site_url('ajaxcall/branch'); ?>",
            success: function (result) {
                $('#branch').html(result);               
            }
        });
		$.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
                
								$('#user').html(result);
               
            }
        });
		
		 $.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value="">Select Brand</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#brand").html(option);
               $('#brand').trigger('change');
            }
        });
		
		
		$.ajax({
            url: "<?php echo site_url('ajaxcall/reference'); ?>",
            success: function (result) {
                $('#reference').html(result.replace('Select', 'All'));

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
		$('#clos_btn').click(function() { //button filter event click
             ms();//just reload table
             $('#myClosureModal').modal('hide');
         });
		$.ajax({
			url: "<?php echo site_url('ajaxcall/area'); ?>",
			success: function (result) {
				$('#area').html(result);
			}
		});
		$.ajax({
			url: "<?php echo site_url('ajaxcall/route'); ?>",
			success: function (result) {
				$('#route').html(result);
			}
		});
        $("#customer").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/suppliers", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#cusid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $saletype; ?>",
            success: function (result) {
                $('#btype').html(result);
                var utype = $('#utype').val();
                if (utype === "Admin") {
                    $("#btype").prepend('<option value="" selected>' + "All" + '</option>');
                }
            }
        });
        $("#hsn").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/hsn", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#hsnid").val(ui.item.hsnid);
                $("#btn-filter").focus();
            }
        });

        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>pricelist/Pricelist/itemsearch", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });

        $('#btn-filter').click(function () { //button filter event click
			start_date = $('#startdate').val();
			end_date = $('#enddate').val();
            ms();
            //  table.ajax.reload(null, false);  //just reload table
        });
        // $('#btn-reset').click(function () { //button reset event click
        //     $('#form-filter')[0].reset();
        //     table.ajax.reload(null, false);  //just reload table
        // });
        $('#btn-reset').click(function () { //button reset event click
            $('#name').val("");
            $('#toid').val("");
            $('#cusid').val("");
            $('#batch').val("");
            $('#hsnid').val("");
            $('#customer').val("");
			$('#area').val("");
            $('#route').val("");
            ms();
        });

    });
</script>
