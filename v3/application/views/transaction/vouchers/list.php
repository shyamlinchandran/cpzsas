<?php
$add_url = site_url('transaction/vouchers/' . $type);
$title = ucfirst($type);
$btype= 'pay';
if($type == 'receipt'){
	$btype= 'rec';
}

if($type == 'journal'){
	$btype= 'jou';
}
if($type == 'contra'){
	$btype= 'contra';
}
?>

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
				<input type="hidden" name="report_header" id="report_header" value="<?php echo $title;?>"/>
				<input type="hidden" name="report_type" id="report_type" value="<?php echo $type;?>"/>
                 <div class="box-header">
                    <h3 class="box-title"><?= label(ucfirst($title), $this, $user) ?> Report</h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
				  <table   class="table table-condensed table-striped" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
							 <td class="col-sm-1">
                                      <?= label('Start Date', $this, $user) ?> 
                                    <input type="text" class="form-control date" id="startdate"/> 
                                </td>
                                <td class="col-sm-1">
                                    <?= label('End Date', $this, $user) ?> 
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                                 <?php if ($type != 'contra') {?>
								 <td class="col-sm-2">
                                   <?= label('Ledger', $this, $user) ?> 
                                        <input type="hidden" class="form-control" id="toid"/> 
                                        <input value="" NoTab="true" type="text" class="form-control" id="name" /> 
                                </td>
                               
                                 <td class="col-sm-2">
                                   <?= label('Ledger Group', $this, $user) ?> 
                                         <select class="form-control" name="main_acc" id="main_acc" data-validation="required">
                                        <option></option>
                                    </select>    
                                </td>
                                <?php } ?>

								<td class="col-sm-1">
								<?= label('Salesman', $this, $user) ?> 
                                    <select id="salesman" name="salesman" class="form-control "></select>
                                </div>
                                </td>
                                <?php if ($type != 'contra') {?>
                                <td class="col-sm-2">
                                   <?= label('Cash/Bank', $this, $user) ?> 
                                         <select  id="paytype" name="paytype" class="form-control " >  
										 <option value=""><?= label('All', $this, $user) ?></option> 
                                        <option value="4"><?= label('Cash', $this, $user) ?></option> 
                                        <option value="1"><?= label('Bank', $this, $user) ?></option>                                         
                                    </select>
                                </td>
                                <?php }else{ ?>
                                     <td class="col-sm-2">
                                            <?= label('Contra Type', $this, $user) ?> 
                                                <select  id="contra_type" name="contra_type" class="form-control " >  
                                                <option value="">All</option> 
                                                <option value="deposite">Deposit</option> 
                                                <option value="withdraw">Withdrawal</option> 
                                                <option value="cashtocash">Cash To Cash</option> 
                                                <option value="banktobank">Bank To Bank</option>                                       
                                            </select>
                                    </td>
                                <?php } ?>
								 <td class="col-sm-2" align="center">
                                                            Bill Type
                                                            <select id="btype" name="btype" class="form-control ">
															</select>
                                                        </td>
								<td class="col-sm-2">
                            <?= label('User', $this, $user) ?>
                            <select id="user" name="user" class="form-control" name="chrq_status">
                            </select>      
                        </td>
                                <td class="col-sm-2">
								 <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
									<input type="button" class="btn btn-success" id="btn-clear"  value="<?= label('Clear', $this, $user) ?>"/>
                                   </td>
                                
                                <td class="col-sm-2">
                                   
                                </td>
                                <td>
                                   
                                </td>


                            </tr>
                        </tbody>
                    </table>  
                    <!--                    <form id="form-filter">
                                            <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr> 
                                                        <td class="col-sm-2" align="center">
                                                            Voucher Number
                                                            <input type="text" class="form-control" id="invoice"/>
                                                        </td>
                                                        <td class="col-sm-2">
                                                            Ledgers
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
                                          <br/> </form>-->

                    <table id="table"  class="table table-striped table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <?php if($type == 'contra'){?>
                                    <th><?= label('Type', $this, $user) ?></th>
                                <?php }?>
                                <th><?= label('Created By', $this, $user) ?></th>
                                <th><?= label('Voucher No', $this, $user) ?></th>
                               
                                <th><?= label('From', $this, $user) ?></th>
                                <th><?= label('To', $this, $user) ?></th>
								 <?php if ($type != 'journal') { ?>
                                    <th><?= label('Narration', $this, $user) ?></th>
                                <?php } ?>
                                <th><?= label('Amount', $this, $user) ?></th>
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

    var table;

    $(document).ready(function () {
        $.ajax({
                url: "<?php echo site_url('accounts_master/ledger/main_ledger'); ?>/",
                async: false,
                success: function (result) {
                    $("#main_acc").html(result);
                }
            });
		$.ajax({
			url: "<?php echo site_url('ajaxcall/salesman'); ?>",
			async:false,
			success: function(result) {
				$('#salesman').html(result);
			}
		});
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $btype; ?>",
			async:false,
            success: function(result) {
				result =   '<option value="" >All</option>' +  result ;
                $('#btype').html(result);

            }
        });
		
		var report_header = $('#report_header').val();
		 $("#name").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
        var now = new Date();
        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100,-1], [10, 25, 50, 100,'All']],
            'dom': "<'row'<'col-sm-4'l><'col-sm-4  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                loadpermission();
            },
            "buttons": [

                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: report_header+'-' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
					action: newexportaction,
                    exportOptions: {
                        columns:  ':visible'
                    },
                    titleAttr: 'Excel',
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text('company' + " - " + report_header + ' Report');
                        $('c[r=A2] t', sheet).text("Date from " + jsDate + " to " + jsDate);
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
				},
				customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text('company' + " - " + report_header+' Report');
                        $('c[r=A2] t', sheet).text("Date from " + jsDate + " to " + jsDate);
                    }
			},
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
					action: newexportaction,
                    className: 'btn bg-olive',
                    filename: 'Receipt' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    exportOptions: {
                        columns: ':visible',
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables

                        doc.content.splice(0, 1);
                        // doc.content[0].text = "Date from " + jsDate + " to " + jsDate;
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
                                        text: company + " - " + report_header+ ' Report',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        for (var i = 1; i < doc.content[1].table.body.length; i++) {
                            doc.content[1].table.body[i][4].alignment = 'right';
                            doc.content[1].table.body[i][0].alignment = 'center';
                            doc.content[1].table.body[i][1].alignment = 'center';
                        }
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
            //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('transaction/vouchers/voucher_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = '<?php echo $type ?>';
                    data.supid = $('#supid').val();
                    data.contra_type = $('#contra_type').val();
                    data.main_acc = $('#main_acc').val();
                    data.salesman = $('#salesman').val();
					data.startdate   = $('#startdate').val();
					data.enddate   = $('#enddate').val();
					data.toid = $('#toid').val();
					data.paytype = $('#paytype').val();
					data.user = $('#user').val();
                    data.btype = $('#btype').val();
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
		$('#btn-clear').click(function () { //button filter event click
			$('#toid').val('');
			$('#name').val('');
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
			var arr = [];
            var fromdate = $('#startdate').val();
            var todate = $('#enddate').val();
            var toid = $('#toid').val();
            var paytype = $('#paytype').val();
			var user =  $('#user').val();
            arr.push({
                stdate: fromdate,
                enddate: todate,
                toid: toid,
                paytype: paytype,
				user:user
            });
            createCookie('<?php echo $login_comid.$type; ?>report_cook', JSON.stringify(arr), 3);
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });
        /*  $("#supname").autocomplete({
         source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
         minLength: 2,
         select: function (event, ui) {
         $('#supid').val(ui.item.id)
         }
         });
         */
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {                
				$('#user').html(result);
               var result = readCookie('<?php echo $login_comid.$type; ?>report_cook');
			console.log(result);
			if (result != null) {
            results = JSON.parse(result);
            console.log(results);
            $.each(results, function (index, value) {
                $('#startdate').val(value.stdate);
                $('#enddate').val(value.enddate);
                $('#toid').val(value.toid);
                $('#paytype').val(value.paytype);
				if(value.user !== undefined){
					$('#user').val(value.user);
				}
				$('#btn-filter').trigger('click');
            });


        }
            }
        });
    });

</script> 
</body>
</html>