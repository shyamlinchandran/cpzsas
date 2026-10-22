<?php
$title = 'Enquiry Report';
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
                    <h3 class="box-title"><?= label(ucfirst($title), $this, $user) ?> </h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                <input style ="display:none;" type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>

				  <table style = "display:none;"   class="table table-condensed table-striped" cellspacing="0" width="100%">
                        <tbody>
                         
                        </tbody>
                    </table>  
                   
                                          <br/> 

                    <table id="table"  class="table table-striped table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('Job Number', $this, $user) ?></th>                          
                                <th><?= label('Customer Name', $this, $user) ?></th>
                                <th><?= label('Customer Phone', $this, $user) ?></th>  
								 <th><?= label('Address', $this, $user) ?></th>
                                <th><?= label('Product', $this, $user) ?></th> 
                                <th><?= label('Model', $this, $user) ?></th>								 <th><?= label('Serial/IMEI', $this, $user) ?></th>  
                                <th><?= label('Observation', $this, $user) ?></th> 
                                <th><?= label('Engineer remarks', $this, $user) ?></th>
                                <th><?= label('Status', $this, $user) ?></th>
								<th><?= label('Closed remarks', $this, $user) ?></th>
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
        $('#btn-filter').trigger('click');
        var now = new Date();
        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
        //datatables
        table = $('#table').DataTable({
            
             "processing": true, //Feature control the processing indicator.
            "serverSide": true,
           
            "lengthMenu": [[10, 25, 50, 100,-1], [10, 25, 50, 100,'All']],
            'dom': "<'row'<'col-sm-4'l><'col-sm-4  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
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
                        columns: ':visible'
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
                "url": "<?php echo site_url('crm_service/Enquiry_allocation/list_report') ?>",
                "type": "POST",
                "data": function (data) {
                    
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
    });

        $('#btn-filter').click(function () {
		 
      
        
       

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