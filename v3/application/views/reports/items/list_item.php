<?php 
	$title = 'Item List Report';
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
                    <h3 class="box-title"><?= label('Item List Report', $this, $user) ?></h3>
					<input type="hidden" id="report_header" value="<?php echo $title;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
					<span class="pull-right"> 

                        <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="set_filter">Set InVisible</a></a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                              
                                <td class="col-sm-2">
                                    <?= label('HSN', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="hsnid" id="hsnid"/><input name="hsn" id="hsn" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="<?= label('Hsn', $this, $user) ?>">
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Category', $this, $user) ?> 
									<input type="hidden" id="category" name="category" class="form-control" />
                                    <input type="text" id="item_category_name" name="item_category_name" class="form-control" />
                                    
                                </td>
                                <td class="2">
                                    <?= label('Tax', $this, $user) ?>
                                    <select id="tax"  class="form-control" name="tax">
                                        <option value=""><?= label('All', $this, $user) ?></select>
                                    </select> 
                                </td>
								<td class="2">
                                    <?= label('Item', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
								<td class="2">
                                    <?= label('Material Type', $this, $user) ?>
                                    <select id="material_type"  class="form-control" name="material_type">
                                        <option value=""><?= label('Select', $this, $user) ?></select>
                                    </select> 
                                </td>
								 <td class="2">
                                    <?= label('Brand', $this, $user) ?>
                                    <select id="brand"  class="form-control" name="brand">
                                        <option value=""><?= label('Select', $this, $user) ?></select>
                                    </select> 
                                </td>
                                <td class="2">
                                    <?= label('U/M Type', $this, $user) ?>
                                    <select id="umt"  class="form-control" name="umt">
                                        <option value=""><?= label('All', $this, $user) ?></option>
                                        <option value=" and srate > prate"><?= label('With Margin', $this, $user) ?></option>
                                        <option value=" and srate < prate "><?= label('Negative Margin', $this, $user) ?></option>
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
                                <th><?= label('Barcode', $this, $user) ?></th>
                                <th><?= label('HSN', $this, $user) ?></th>
                                <th><?= label('Part no', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <th><?= label('Unit', $this, $user) ?></th>
                                <th><?= label('Tax', $this, $user) ?></th>
                                <th><?= label('Cess', $this, $user) ?></th>
                                <th><?= label('Discount', $this, $user) ?></th>
                                <th><?= label('Category', $this, $user) ?></th>
                                <th><?= label('Brand', $this, $user) ?></th>
                                <th><?= label('Supplier', $this, $user) ?></th>
                                <th><?= label('Prate', $this, $user) ?></th>
                                <th><?= label('Sale rate', $this, $user) ?></th>
                                <th><?= label('Unit/margin', $this, $user) ?></th>
                                <th><?= label('MRP', $this, $user) ?></th>
                                <th><?= label('Special Rate', $this, $user) ?></th>
                                <th><?= label('Wholsale Rate', $this, $user) ?></th>
                                <th><?= label('Landing Cost', $this, $user) ?></th>
                                <th><?= label('Material Type', $this, $user) ?></th>
                                <th><?= label('Stock', $this, $user) ?></th>
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
	var newcnt = 0;
	function showstockledeger(btn){
		var name = $(btn).attr('name');
		var toid = $(btn).attr('id');
		var arr = [];
		var result = readCookie('<?php echo $login_comid ?>Item_List_Report_cook');
		var enddate = $('#enddate').val();
		var startdate = '';
		arr.push({
			startdate: startdate,
			enddate: enddate,
			name: name,
			toid: toid,
			});
		createCookie('<?php echo $login_comid ?>Item_List_Report_cook', JSON.stringify(arr), 3);
		$("#last_click").attr('href', "<?= base_url() ?>reports/stock/leadger?newpage=new");
        $("#last_click").click();
	}
	var txt = '';
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
			txt = txt + '<div style="margin-bottom:30px;" class="col-sm-4"><input type="checkbox" id="vis'+newcnt+'" name="vis[]" value="'+l+'">  '+$(this).text()+'</div>';
			l++;
			$('#div_vis').html(txt);
			newcnt = newcnt + 1;
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
				$.each(JSON.parse(result), function(i, itemsingle) {
					$('#vis'+itemsingle.targets).attr('checked',true)
					 console.log(itemsingle.targets);
				});
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
				ms();
            }
        });
        //datatables
        function ms()
        {
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
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        className: 'btn bg-navy',
                        filename: $('#file_header').val()+'_' +  jsDate,
                        text: '<i class="fa fa-file-excel-o"></i>',
                        messageTop: "Printed Date-  " + jsDate,
                       exportOptions: {
							columns: ':visible'
						},
                        titleAttr: 'Excel',
                        action: newexportaction,
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
							var txt_h = '';
							if( $('#hsnid').val() !== '' && $('#hsnid').val()  !== 0 ){
								var hsn = $('#hsn').val();
								txt_h = txt_h + 'Hsncode : ' + hsn + ' ';
							}
							
							if( $('#tax').val() !== '' && $('#tax').val()  !== 0 ){
								var tax = $("#tax option:selected").text();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'tax : ' + tax + ' ';
							}
							
							if( $('#category').val() !== '' && $('#category').val()  !== 0 ){
								var item_category_name = $("#item_category_name").val();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'Category : ' + item_category_name + ' ';
							}
							
							
							if( $('#material_type').val() !== '' && $('#material_type').val()  !== 0 ){
								var material_type = $("#material_type option:selected").text();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'Material type : ' + material_type + ' ';
							}
							
							if( $('#brand').val() !== '' && $('#brand').val()  !== 0 ){
								var brand = $("#brand option:selected").text();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'Brand : ' + brand + ' ';
							}
							
							
                            $('c[r=A1] t', sheet).text(company + " - " + $('#report_header').val());
                            $('c[r=A2] t', sheet).text(txt_h);
                        }
                    },
                    {
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        extend: 'pdfHtml5',
                        title: "dsads",
                        className: 'btn bg-olive',
                        filename: $('#file_header').val()+'_' + jsDate,
                        messageTop: "Printed Date-  " + jsDate,
                        pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                        action: newexportaction,
                       exportOptions: {
							columns: ':visible'
						},
                        customize: function (doc) {
                            //Remove the title created by datatTables
                            	var txt_h = '';
							if( $('#hsnid').val() !== '' && $('#hsnid').val()  !== 0 ){
								var hsn = $('#hsn').val();
								txt_h = txt_h + 'Hsncode : ' + hsn + ' ';
							}
							
							if( $('#tax').val() !== '' && $('#tax').val()  !== 0 ){
								var tax = $("#tax option:selected").text();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'tax : ' + tax + ' ';
							}
							
							if( $('#category').val() !== '' && $('#category').val()  !== 0 ){
								var item_category_name = $("#item_category_name").val();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'Category : ' + item_category_name + ' ';
							}
							
							
							if( $('#material_type').val() !== '' && $('#material_type').val()  !== 0 ){
								var material_type = $("#material_type option:selected").text();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'Material type : ' + material_type + ' ';
							}
							
							if( $('#brand').val() !== '' && $('#brand').val()  !== 0 ){
								var brand = $("#brand option:selected").text();
								if(txt_h !== '' ){
									txt_h  = txt_h + ','; 
								}
								txt_h = txt_h + 'Brand : ' + brand + ' ';
							}
                            doc.content.splice(0, 1);
                            doc.content[0].text = txt_h;
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
                "ajax": {
                    "url": "<?php echo site_url('reports/item/item_list') ?>",
                    "type": "POST",
                    "data": function (data) {
                        data.tax = $("#tax").val();
                        data.umt = $('#umt').val();
		                data.toid = $('#toid').val();
                        data.godown = $("#item_godown").val();
                        data.hsn = $("#hsnid").val();
                        data.category = $("#category").val();
						data.item_status = $("#cl_stk").val();
                        data.date = $("#enddate").val();
                        data.material_type = $("#material_type").val();
                        $("#hsnid").val('');
						data.brand = $("#brand").val();
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
