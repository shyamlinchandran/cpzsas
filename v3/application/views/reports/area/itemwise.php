<?php
$user = $this->session->userdata('user');
$utype = $user['utype'];
?>
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
						<td class="col-sm-12">
                            <?= label('Area', $this, $user) ?><br />
                            <select style = "width:100%" id="salesarea" name="salesarea[]" class="form-control select2" multiple name="chrq_status">
                            </select>      
                        </td>
                       
                    </tr>
					 <tr>
						 <td class="col-sm-12">
                            <?= label('Salesman', $this, $user) ?>
							<br />
                            <select style = "width:100%" id="salesman" name="salesman[]" class="form-control select2"  multiple name="chrq_status">
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
					<input type="hidden" id="report_header" value="<?php echo $title;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
					<span class="pull-right"> 

                        <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>
                  </span>
                </div>
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <td class="col-sm-1">
                                    <?= label('Start Date', $this, $user) ?>
                                    <input type="text" class="clsarea form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-1">
                                    <?= label('End Date', $this, $user) ?>  
                                    <input type="text" class="clsarea form-control date" id="enddate"/> 
                                </td>
                               
                                 <td class="col-sm-1">
                                    <?= label('Area', $this, $user) ?>  
                                    <select  id="area"  name="area" class="clsarea form-control">
										<option value="">Select</option> 
									</select>
                                </td>
                                <td class="col-sm-1">
									 <?= label('User', $this, $user) ?>
									<select id="user" name="user" class="form-control" name="chrq_status">
									</select>  
								</td>
							  <td class="col-sm-1">
                                   <?= label('Vehicle', $this, $user) ?>
                                    <select id="vehicle" name="vehicle" class="form-control">
                                          <option value="">Select</option>
                                    </select>

							  </td>
							  <td class="col-sm-1">
                                   <?= label('Branch', $this, $user) ?>
                                    <select id="branch" name="branch" class="form-control">
                                          <option value="">Select</option>
                                    </select>

							  </td>
							   <td class="col-sm-2">
                                    Item 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
							  <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                    <input type="button" class="btn btn-success" id="btn-reset"  value="<?= label('Reset', $this, $user) ?>"/>
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
                                <th><?= label('Free Quantity', $this, $user) ?></th>
                                <th><?= label('Total Quantity', $this, $user) ?></th>
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
<script src="<?php echo base_url(); ?>asset/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
	$(function() {
        $('.select2').select2();
    });
 function getreportheader(title,name='name'){
        var company = $("#exdt31_com32").val();
        var header = "<style>td{font-size:16px !important;}</style><div class='row'>";
        header = header + "<div class='col-12 text-center' ><h2 style='font-size:16px;'>" + company + " </h2></div>";
        header = header + "</div>";
        header = header + "<div class='row'>";
        header = header + "<div class='col-12 col-md-12 text-center ' ><h4>"+title+"</h4></div>";
		header = header + "<div class='col-12 col-md-12 text-center ' ><p style = 'font-size:12px'>";
		if($('#startdate').val() !== ''){
			header = header +$('#enddate').val() ;
		}
		header = header + 'To  ' + $('#startdate').val();
		if($('#area').val() !== '' && $("#area option:selected").text() !== 'Select' && $('#area').val() !== '0'){
			header = header +  ' Area :' + $("#area option:selected").text();
		}
		if($('#user').val() !== '0' && $("#user option:selected").text() !== 'Select' && $('#user').val() !== '0'){
			header = header +  ' User :' + $("#user option:selected").text();
		}
		if($('#vehicle').val() !== '' && $("#vehicle option:selected").text() !== 'Select' && $('#vehicle').val() !=='0'){
			header = header +  ' Vehicle : ' + $("#vehicle option:selected").text();
		}
		header = header + "</p></div>";
		
        header = header + "<div class='col-4 col-md-4 text-left' ></div>";
        return header;
    }
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
                    title:  getreportheader("<?= label($title, $this, $user) ?>",'head_text'),
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
                },{
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename:  $('#file_header').val()+'_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        if($('#startdate').val() !== ''){
							header = $('#enddate').val() ;
						}
						header = header + 'To  ' + $('#startdate').val();
						if($('#area').val() !== '' && $("#area option:selected").text() !== 'Select' && $('#area').val() !== '0'){
								header = header +  ' Area :' + $("#area option:selected").text();
						}
						if($('#user').val() !== '0' && $("#user option:selected").text() !== 'Select' && $('#user').val() !== '0'){
								header = header +  ' User :' + $("#user option:selected").text();
						}
						if($('#vehicle').val() !== '' && $("#vehicle option:selected").text() !== 'Select' && $('#vehicle').val() !=='0'){
							header = header +  ' Vehicle : ' + $("#vehicle option:selected").text();
						}
                        $('c[r=A1] t', sheet).text(company + " - " +  $('#report_header').val());
                        $('c[r=A2] t', sheet).text(header);
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
                        columns: [0, 1, 2, 3, 4, 5],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables

                        if($('#startdate').val() !== ''){
							header =  $('#enddate').val() ;
						}
						header = header + 'To  ' + $('#startdate').val();
						if($('#area').val() !== '' && $("#area option:selected").text() !== 'Select' && $('#area').val() !== '0'){
								header = header +  ' Area :' + $("#area option:selected").text();
						}
						if($('#user').val() !== '0' && $("#user option:selected").text() !== 'Select' && $('#user').val() !== '0'){
								header = header +  ' User :' + $("#user option:selected").text();
						}
						if($('#vehicle').val() !== '' && $("#vehicle option:selected").text() !== 'Select' && $('#vehicle').val() !=='0'){
							header = header +  ' Vehicle : ' + $("#vehicle option:selected").text();
						}
                        doc.content.splice(0, 1);
                        doc.content[0].text = header;
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
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/Area/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.area = $('#area').val();
					data.user = $('#user').val();
					data.toid = $("#toid").val();
					data.vehicle = $('#vehicle').val();
					data.branch = $('#branch').val();
					data.salesarea = $('#salesarea').val();
					data.salesman = $('#salesman').val();
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
        success: function(result) {
            $('#branch').html(result);
        }
    });
		$.ajax({
        url: "<?php echo site_url('ajaxcall/vehicle'); ?>",
        success: function(result) {
            $('#vehicle').html(result);
        }
    });
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
					$('#salesarea').html(result);
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
            source: "<?php echo base_url(); ?>ajaxcall/items", // path to the get_birds method
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
			$("#toid").val('');
			$("#name").val('');
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });
		
		$(function() {
        $('.select2').select2();
    });

    });
</script>
