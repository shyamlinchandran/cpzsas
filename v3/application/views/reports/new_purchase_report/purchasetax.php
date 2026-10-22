<?php
$user = $this->session->userdata('user');
$utype = $user['utype'];
$title = $titles;
?>
<div class="modal fade" id="myFilterModal">
    <input type="hidden" id="closure_id" name="closure_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?= label('Apply Filter', $this, $user) ?></h4>
            </div>
            <div class="modal-body">

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
                                    <input type="text" class="form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('End Date', $this, $user) ?>  
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                               
                                
								
								
                                <td class="col-sm-2">
                                    <?= label('Customer', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="customer_id" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
							  <td class="col-sm-2">
                                    <?= label('Type', $this, $user) ?>  
									<select id="saletype" class="form-control" >
										<option value="purchase">purchase</option>
										<option value="purchase_return">purchase Return</option>
									</select>

							  </td>
							  <td class="col-sm-2">
							   <?= label('Bill Type', $this, $user) ?>  
							   <select tabindex="-1" id="btype" data-validation="required" name="btype" class="form-control ">
                                </select>
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
                                <th><?= label('BILL NO(Invoice No)', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('GSTIN', $this, $user) ?></th>
                                <th><?= label('SUPPLIERNAME', $this, $user) ?></th>
								<?php foreach($tax_array as $item){?> 
									<?php if((float) $item['GST'] > 0 ) { ?>
										<th>Purchase -<?php echo $item['GST'];?>%</th>
										<th>CGST</th>
										<th>SGST</th>
										<th>CESS</th>
										<th>IGST-Purchase -<?php echo $item['GST'];?>%</th>
										<th>IGST</th>
										<th>CESS</th>
									<?php }else{?>
										<th><?= label('GST 0 Rated', $this, $user) ?></th>
									<?php }?>
								<?php }?>
								
                                <th><?= label('Net Amount', $this, $user) ?></th>
                                <th><?= label('Voucher TypeName', $this, $user) ?></th>
                                <th><?= label('State', $this, $user) ?></th>
                                <th><?= label('Reg Type', $this, $user) ?></th>
                                <th><?= label('Tin No', $this, $user) ?></th>
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
	var report_header = '';
	function loadbilltype(){
		var type = $('#saletype').val();
		$.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' ; ?>"+type,
			async:false,
            success: function(result) {
               $('#btype').html(result);
			    $("#btype").prepend('<option value="" selected>' + "All" + '</option>');
				$('#form-filter')[0].reset();
				table.ajax.reload(null, false);  //just reload table
            }
        });
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
		console.log(report_header);
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
            "buttons": [ {
                text: '<i class="">Json</i>',
                action: function ( e, dt, button, config ) {
                    var data = dt.buttons.exportData();
 
                    $.fn.dataTable.fileSave(
                        new Blob( [ JSON.stringify( data ) ] ),
                        report_header
                    );
                }
            },{
                    extend: 'print',
                    text: '<i class="glyphicon glyphicon-print"></i>',
                    className: 'btn btn-primary', 
                    title:  getheader("<?= label($title, $this, $user) ?>"),
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
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: '<?= label($title, $this, $user) ?>' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var btype = $("#btype option:selected").text();
                        var reference = $("#reference option:selected").text();
                        var salesman = $("#salesman option:selected").text();
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var cashtype = $('#chrq_status').val();
                        $('c[r=A1] t', sheet).text(company + " - " + '<?= label($title, $this, $user) ?>');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " "  + " Bill type :" + btype );
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: '<?= label($title, $this, $user) ?>' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    customize: function (doc) {
                        //Remove the title created by datatTables

                        var btype = $("#btype option:selected").text();
                        var reference = $("#reference option:selected").text();
                        var salesman = $("#salesman option:selected").text();
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var cashtype = $('#chrq_status').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " "  + " Bill type :" + btype ;
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
                                        text: company + " - " + '<?= label($title, $this, $user) ?>',
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
                "url": "<?php echo site_url('reports/New_Purchase_report/purchase_ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.supname = $("#supname").val();
                    data.customer_id = $("#supid").val();
                    data.type = $("#chrq_status").val();
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.saletype = $('#saletype').val();
                    data.btype = $('#btype').val();
					data.reference = $('#reference').val();
					data.salesman = $('#salesman').val();
					data.user = $('#user').val();
					data.hsnid = $('#hsnid').val();
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
		loadbilltype();
		 $("#hsn").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/hsn", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#hsnid").val(ui.item.hsnid);
                $("#btn-filter").focus();
            }
        });
		$('#saletype').change(function() { //button filter event click
             loadbilltype();
         });
		 $('#btype').change(function() { //button filter event click
              $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
         });
		$('#clos_btn').click(function() { //button filter event click
             table.ajax.reload(null, false); //just reload table
             $('#myClosureModal').modal('hide');
         });
		$.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            async: false,
            success: function (result) {
                $('#salesman').html(result);
                
								$('#user').html(result);
               
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/reference'); ?>",
            async: false,
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
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			var salestype = $('#salestype').val();
			var  saletype = $('#saletype').val();
			if(salestype !== ''){
				report_header =  salestype+'_';
			}
			report_header = report_header + saletype ;
			if(startdate !== ''){
				report_header = report_header + '_From-' + startdate;
			}
			if(enddate !== ''){
				report_header = report_header + '_To-' + startdate;
			}
			var btype = $('#btype').val();
			if(btype !== ''){
				var types = $("#btype option:selected").text();
				report_header = report_header + '_Btype-' + types;
			}
			report_header = report_header+'.json';
			
			
            ms();
			var arr = [];
            var supname = $('#supname').val();
            var supid = $('#supid').val();
            var chrq_status = $('#chrq_status').val();
            var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
            var saletype = $('#saletype').val();
            var salestype = $('#salestype').val();
            var btype = $('#btype').val();
            var hsnid = $('#hsnid').val();
			var branch = $('#branch').val();
            var reference = $('#reference').val();
            var salesman = $('#salesman').val();
            var user = $('#user').val();
            arr.push({
                supname: supname,
                supid: supid,
                chrq_status: chrq_status,
                startdate: startdate,
				enddate: enddate,
                saletype: saletype,
                salestype: salestype,
                btype: btype,
				hsnid: hsnid,
                branch: branch,
                salesman: salesman,
                reference: reference,
				user: user
            });
            createCookie('<?php echo $login_comid; ?>_Gst_Sales_Taxwise', JSON.stringify(arr), 3);
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
			$('#supname').val('');
             $('#supid').val('');
            $('#chrq_status').val('');
            $('#startdate').val('');
			$('#enddate').val('');
           $('#btype').val('');
            $('#hsnid').val('');
			$('#branch').val('');
             $('#reference').val('');
             $('#salesman').val('');
            $('#user').val('');
			 $('#btn-filter').trigger('click');
        });
		
		var result = readCookie('<?php echo $login_comid; ?>_Gst_Sales_Taxwise');
		if (result != null) {
            results = JSON.parse(result);
            console.log(results);
            $.each(results, function (index, value) {
				if(value.saletype !== undefined){
					var type = value.saletype;
					$.ajax({
						url: "<?php echo site_url('ajaxcall/billtype') . '/' ; ?>"+type,
						async:false,
						success: function(result) {
							$('#btype').html(result);
							$("#btype").prepend('<option value="" selected>' + "All" + '</option>');
							$('#form-filter')[0].reset();
						}
					});
				}
				if(value.supname !== undefined){
					$('#supname').val(value.supname);
				}
				if(value.supid !== undefined){
					$('#supid').val(value.supid);
				}
				if(value.chrq_status !== undefined){
					$('#chrq_status').val(value.chrq_status);
				}
				if(value.startdate !== undefined){
					$('#startdate').val(value.startdate);
				}
				if(value.enddate !== undefined){
					$('#enddate').val(value.enddate);
				}
				if(value.saletype !== undefined){
					$('#saletype').val(value.saletype);
				}
				if(value.salestype !== undefined){
					$('#salestype').val(value.salestype);
				}
				if(value.btype !== undefined){
					$('#btype').val(value.btype);
				}
				if(value.hsnid !== undefined){
					$('#hsnid').val(value.hsnid);
				}
				if(value.branch !== undefined){
					$('#branch').val(value.branch);
				}
				if(value.reference !== undefined){
					$('#reference').val(value.reference);
				}
				if(value.salesman !== undefined){
					$('#salesman').val(value.salesman);
				}
				if(value.user !== undefined){
					$('#user').val(value.user);
				}
                ms();
            });


        }

    });
</script>
