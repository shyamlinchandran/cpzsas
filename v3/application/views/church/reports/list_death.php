<?php
$add_url = site_url('church/registern/listall');
?>

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <input  type="hidden" value="<?php echo $head_id; ?>" id="head_id" name="head_id"/>
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3> 
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('church/registern/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-arrow-left"></span> 
                        </a>
                    </span>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                    Start Date
                                    <input type="text" class="form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-2">
                                    End Date 
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>  
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Deceased Name</th>
                                <th>House Name</th>
                                <th>Deceased on</th>
                                <th>Cremated on</th>
                                <!-- <th>Actions</th> -->
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
        var now = new Date();
        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
        $("#startdate").val("<?php echo $_COOKIE['startdate']?>");
        $("#enddate").val("<?php echo $_COOKIE['enddate']?>");
        //datatables
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [

                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'death_report_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0,1, 2, 3, 4]
                    },
                    titleAttr: 'Excel',
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        $('c[r=A1] t', sheet).text( company + " - " + 'Death Report');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'death_report_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    exportOptions: {
                        columns: [0,1, 2, 3, 4],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate;
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
                                        text: company + " - " + 'Death Report',
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
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('church/reports/deathcer_reports/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });


    });

</script>  