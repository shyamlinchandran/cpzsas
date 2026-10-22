<?php

?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
					<input type="hidden" id="report_header" value="<?php echo $title;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
					
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
									<?= label('User', $this, $user) ?>
									<select id="user" name="user" class="form-control" name="chrq_status">
									</select>      
								</td>
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
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('USer', $this, $user) ?></th>
                                <th><?= label('Total Sales', $this, $user) ?></th>
                                <th><?= label('Cash Sales', $this, $user) ?></th>
                                <th><?= label('Credit Sales', $this, $user) ?></th>
                                <th><?= label('Sales Order', $this, $user) ?></th>
                                <th><?= label('Sales Return', $this, $user) ?></th>
                                <th><?= label('Payment', $this, $user) ?></th>
                                <th><?= label('Receipt ', $this, $user) ?></th>
                                <th><?= label('Total Collection', $this, $user) ?></th>
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
	
	$(document).on('click', '.showreport', function(e){
		e.preventDefault();
		var attrtype = $(this).attr('attrtype');
		if(attrtype === 'sales' || attrtype === 'cashsales' || attrtype === 'creditsales' || attrtype === 'estimate' || attrtype === 'sales_return'){
			var fromdate = $('#startdate').val();
			var todate = $('#enddate').val();
			var user =  $(this).attr('user');
			var arr = [];
			if(attrtype === 'sales'){
				arr.push({
					stdate: fromdate,
					enddate: todate,
					btype: '',
					user:user
				});
				createCookie('<?php echo $login_comid ?>sales_report_cook', JSON.stringify(arr), 3);
				$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/salesreport?newpage=new");
				$("#last_click").click();
			}
			if(attrtype === 'cashsales'){
				arr.push({
					stdate: fromdate,
					enddate: todate,
					btype: '',
					user:user,
					chrq_status:'cash'
				});
				createCookie('<?php echo $login_comid ?>sales_report_cook', JSON.stringify(arr), 3);
				$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/salesreport?newpage=new");
				$("#last_click").click();
			}
			if(attrtype === 'creditsales'){
				arr.push({
					stdate: fromdate,
					enddate: todate,
					btype: '',
					user:user,
					chrq_status:'credit'
				});
				createCookie('<?php echo $login_comid ?>sales_report_cook', JSON.stringify(arr), 3);
				$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/salesreport?newpage=new");
				$("#last_click").click();
			}
			if(attrtype === 'estimate'){
				arr.push({
					stdate: fromdate,
					enddate: todate,
					btype: '',
					user:user,
				});
				createCookie('<?php echo $login_comid ?>estimate_sale_report_cook', JSON.stringify(arr), 3);
				$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/saleorder?newpage=new");
				$("#last_click").click();
			}
			if(attrtype === 'sales_return'){
				arr.push({
					stdate: fromdate,
					enddate: todate,
					btype: '',
					user:user,
				});
				createCookie('<?php echo $login_comid ?>sales_return_sale_report_cook', JSON.stringify(arr), 3);
				$("#last_click").attr('href', "<?= base_url() ?>reports/Sales/salesreturn?newpage=new");
				$("#last_click").click();
			}
		}else{
			var user =  $(this).attr('user');
			var fromdate = $('#startdate').val();
			var todate = $('#enddate').val();
			var user =  $(this).attr('user');
			var arr = [];
			arr.push({
                stdate: fromdate,
                enddate: todate,
                paytype: attrtype,
				user:user
            });
			createCookie('<?php echo $login_comid; ?>'+attrtype+'report_cook', JSON.stringify(arr), 3);
			$("#last_click").attr('href', "<?= base_url() ?>transaction/vouchers/list_all/"+attrtype+"?newpage=new");
			$("#last_click").click();
		}
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
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": true,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: $('#file_header').val()+'_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8,9]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var itemname = $('#name').val();
                        $('c[r=A1] t', sheet).text(company + " - " + $('#report_header').val());
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " " + itemname);
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8,9],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var itemname = $('#name').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " " + itemname;
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
                "url": "<?php echo site_url('reports/MIS/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.user = $('#user').val();
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
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                
								$('#user').html(result);
               
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
