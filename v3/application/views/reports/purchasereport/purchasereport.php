<?php
$user = $this->session->userdata('user');
$utype = $user['utype'];
$is_cigarette_cess = 0 ;
if(isset($settings[0]['is_cigarette_cess'])){
    $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
}
?>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <input type="hidden" value="<?php echo $utype; ?>" id="utype" name="utype"/> 
                <div class="box-header">
                    <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
					<input type="hidden" id="report_header" value="<?php echo $title;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$title);?>"/>
                </div>
                <input type="hidden" value="<?php echo $purtype; ?>" id="purtype" name="purtype"/> 

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
                                    <?= label('Bill Type', $this, $user) ?>
                                    <select tabindex="-1" id="btype" name="btype" class="form-control " >                                            
                                    </select>
                                </td>
                                <td class="col-sm-1">
                                    <?= label('Type', $this, $user) ?>
                                    <select id="chrq_status"  class="form-control" name="chrq_status">
                                        <option value=""><?= label('All', $this, $user) ?></option>
                                        <option value="cash"><?= label('cash', $this, $user) ?></option>
                                        <option value="credit"><?= label('credit', $this, $user) ?></option>
                                    </select>      
                                </td>
                                <td class="col-sm-1">
                                    <?= label('GST Type', $this, $user) ?>
                                    <select id="gst_type"  class="form-control" name="gst_type">
                                        <option value=""><?= label('All', $this, $user) ?></option>
                                        <option value="Inter State"><?= label('Intra State', $this, $user) ?></option>
                                        <option value="Intra State"><?= label('Inter State', $this, $user) ?></option>
                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Supplier', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="supid" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td> 
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
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('Created by', $this, $user) ?></th>
                                <th><?= label('Invoice', $this, $user) ?></th>
                                <th><?= label('Supplier', $this, $user) ?></th>
                                <th><?= label('GSTIN', $this, $user) ?></th>
                                <th><?= label('Total Before Tax', $this, $user) ?></th>
                               <!-- <th><?= label('Total Tax', $this, $user) ?></th>-->
							    <th><?= label('CGST', $this, $user) ?></th>
                                <th><?= label('SGST', $this, $user) ?></th>
                                <th><?= label('IGST', $this, $user) ?></th>
                                <?php if($is_cigarette_cess >0){?>
                                    <th><?= label('Cigarette Cess Amount', $this, $user) ?></th>
                                <?php }?>
                                <th><?= label('Discount', $this, $user) ?></th>
                                <th><?= label('Round Off', $this, $user) ?></th>
                                <th><?= label('Total Amount', $this, $user) ?></th>  
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
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename:  $('#file_header').val()+'_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7,8,9]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var cashtype = $('#chrq_status').val();
                        $('c[r=A1] t', sheet).text(company + " - " +  $('#report_header').val() );
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " " + cashtype + " Ledger :" + ledgername);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename:  $('#file_header').val()+'_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7,8,9],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var cashtype = $('#chrq_status').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " " + cashtype + " Ledger : " + ledgername;
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
                                        text: company + " - " +  $('#report_header').val(),
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
                "url": "<?php echo site_url('reports/purchase/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.supname = $("#supname").val();
                    data.gst_type = $("#gst_type").val();
                    data.supid = $("#supid").val();
                    data.type = $("#chrq_status").val();
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.is_cigarette_cess = '<?php echo $is_cigarette_cess;?>';
                    data.purtype = $('#purtype').val();
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

    }
    $(document).ready(function () {
		var result = readCookie('<?php echo $login_comid.$purtype; ?>_purchase_report_cook');
        console.log(result);
        if (result != null) {
            results = JSON.parse(result);
            console.log(results);
            $.each(results, function (index, value) {
                $('#startdate').val(value.stdate);
                $('#enddate').val(value.enddate);
                $('#btype').val(value.btype);
                $('#chrq_status').val(value.chrq_status);
                ms();
            });


        }
		
		
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $purtype; ?>",
            success: function (result) {
                $('#btype').html(result);
                var utype = $('#utype').val();
                if (utype === "Admin") {
                    $("#btype").prepend('<option value="" selected>' + "All" + '</option>');
                }
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
            ms();
			var arr = [];
            var fromdate = $('#startdate').val();
            var todate = $('#enddate').val();
            var btype = $('#btype').val();
            var chrq_status = $('#chrq_status').val();
            arr.push({
                stdate: fromdate,
                enddate: todate,
                btype: btype,
                chrq_status: chrq_status,
            });
            createCookie('<?php echo $login_comid.$purtype; ?>_purchase_report_cook', JSON.stringify(arr), 3);
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
</script>
