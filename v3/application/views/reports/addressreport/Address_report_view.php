<?php
//$add_url = site_url('transaction/vouchers/' . $type);
$type="Address";
$title = $type;
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

                <div class="box-header">
                    <h3 class="box-title"><?= label(ucfirst($title), $this, $user) ?> Book</h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
				  <table   class="table table-condensed table-striped" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
							 <td class="col-sm-2">
                                      <?= label('Type', $this, $user) ?> 
                                    <select class="form-control " id="type"> 
                                   
                                         <option value="sup" >Supplier</option>
                                         <option value="cus" selected> Customer</option>

                                    </select>
                                </td>
                                <td class="col-sm-2">
                                   <?= label('State', $this, $user) ?> 
                                        <input type="hidden" class="form-control" id="stateid"/> 
                                        <input value="" NoTab="true" type="text" class="form-control" id="state" /> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Area ', $this, $user) ?> 
                                        <input type="hidden" class="form-control" id="areaid"/> 
                                        <input value="" NoTab="true" type="text" class="form-control" id="area" >
                                </td>
								
                               
                                <td class="col-sm-2">
								 <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
									<input type="button" class="btn btn-success" id="btn-clear"  value="<?= label('Clear', $this, $user) ?>"/>
                                   </td>
                                <td class="col-sm-2">
                                  
                                </td>
                                <td class="col-sm-2">
                                   
                                </td>
                                <td>
                                   
                                </td>


                            </tr>
                        </tbody>
                    </table>  
                   
                                          <br/> </form>

                    <table id="table"  class="table table-striped table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <th><?= label('GSTIN', $this, $user) ?></th>                          
                                <th><?= label('Phone', $this, $user) ?></th>
                                <th><?= label('Email', $this, $user) ?></th>  
								 <th><?= label('Contact Person', $this, $user) ?></th>
                                <th><?= label('Contact Number', $this, $user) ?></th> 
                                <th><?= label('Address', $this, $user) ?></th>
								
								
								 <th><?= label('Bank', $this, $user) ?></th>  
                                <th><?= label('account Number', $this, $user) ?></th> 
                                <th><?= label('IFSC CODE', $this, $user) ?></th>
								
                                <th><?= label('Area', $this, $user) ?></th>
								<th><?= label('Route', $this, $user) ?></th>
								<th><?= label('State', $this, $user) ?></th>
								 <th><?= label('Credit Period', $this, $user) ?></th>
                                <th><?= label('Credit Amount', $this, $user) ?></th>
                                <th><?= label('Details', $this, $user) ?></th>


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
        $("#area").autocomplete({
            source: "<?php echo base_url(); ?>reports/Address_report/searcharea/", // path to the get_birds method
            minLength: 1,
            select: function (event, ui) {
                $("#areaid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
        $("#state").autocomplete({
            source: "<?php echo base_url(); ?>reports/Address_report/searchstate/", // path to the get_birds method
            minLength: 1,
            select: function (event, ui) {
                $("#stateid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
    });

        $('#btn-filter').click(function () {
		 
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
                    filename: 'Address_Report-' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
					action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5,6,7]
                    },
                    titleAttr: 'Excel',
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text('company' + " - " + 'Address Report');
                        $('c[r=A2] t', sheet).text("Date from " + jsDate + " to " + jsDate);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Receipt' + jsDate,
					action: newexportaction,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5,6,7,8,9,10,11,12,13,14,15,16],
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
                        doc.defaultStyle.fontSize = 5;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 6;
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
                                        text: company + " - " + 'Address Report',
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
                "url": "<?php echo site_url('reports/Address_report/reportfetch') ?>",
                "type": "POST",
                "data": function (data) {
                     data.type = $('#type').val();
                     data.areaid = $('#areaid').val();
                     data.stateid = $('#stateid').val();

                   
                    //data.supid = $('#supid').val();
					//data.startdate   = $('#startdate').val();
					//data.enddate   = $('#enddate').val();
					//data.name = $('#name').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }],

               "destroy": true ,
              
              
        });
        
        var val = readCookie('search_<?= $type ?>');
        if (val !== null) {
            table.search(val).draw();
        }
        $('.dataTables_filter input').unbind().keyup(function () {
            var value = $(this).val();
            if (value.length > 1) {
                createCookie('search_<?= $type ?>', value, 3);
                table.search(value).draw();
            }
            if (value.length === 0) {
                eraseCookie('search_<?= $type ?>');
                table.search(value).draw();
            }
        });

		$('#btn-clear').click(function () { //button filter event click
			$('#areaid').val('');
			$('#area').val('');
            $('#stateid').val('');
			$('#state').val('');
            table.ajax.reload(null, false);  //just reload table
        });
      
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });
       
    });

</script> 
</body>
</html>