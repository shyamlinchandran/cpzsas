<?php
$add_url = site_url('transaction/vouchers/' . $type);
$title = $type . " Vouchers";
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
<div class="modal fade" id="LocationModal">


	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-map">





			</div>

		</div>
	</div>

</div>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label(ucfirst($title), $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                                            <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr> 
                                                        <td class="col-sm-2" align="center">
                                                            Bill Type
                                                            <select id="btype" name="btype" class="form-control ">
															</select>
                                                        </td>
                                                        <td class="col-sm-2">
                                                           
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
                                          <br/>

                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
								<?php if($type == 'receipt'){ ?>
									<th><?= label('Created Date', $this, $user) ?></th>
								<?php } ?>
                                <th><?= label('Voucher No', $this, $user) ?></th>
                                <th><?= label('Ledgers', $this, $user) ?></th>
                                <?php if ($type != 'journal') { ?>
                                    <th><?= label('Narration', $this, $user) ?></th>
                                <?php } ?>
                                <th><?= label('Credit', $this, $user) ?></th>
                                <th><?= label('Debit', $this, $user) ?></th>
                                <th><?= label('Action', $this, $user) ?></th> 
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
$(document).on("click", ".location", function() {
		var latitude = $(this).attr('latitude');
		var longitude = $(this).attr('longitude');
		var src = 'https://maps.google.com/maps?q=' + latitude + ',' + longitude + '&hl=es&z=14&amp;output=embed';
		$('.modal-map').html('<iframe  width="550"  height="300"  frameborder="0"  scrolling="no"  marginheight="0"  marginwidth="0"  src="' + src + '" ></iframe>');
		$('#LocationModal').modal('show');
	});




    $(document).ready(function () {
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $btype; ?>",
			async:false,
            success: function(result) {
					results =   '<option value="" >All</option> ' + result;
				<?php 	 $tmp = $this->session->userdata('user');$utype = $tmp['utype'];
					if(isset($settings[0]['branch_billtype'] ) ){
					if((float) $settings[0]['branch_billtype'] > 0 && ucfirst($utype) != "Admin" ){ 
				?>
				results = result;
				<?php }}?>
                $('#btype').html(results);

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
                    filename: 'Receipt' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns:  ':visible'
                    },
                    titleAttr: 'Excel',
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text('company' + " - " + 'Receipt Report');
                        $('c[r=A2] t', sheet).text("Date from " + jsDate + " to " + jsDate);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
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
                                        text: company + " - " + 'Receipt Report',
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
                "url": "<?php echo site_url('transaction/vouchers/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.btype = $('#btype').val();
                    data.type = '<?php echo $type ?>';
                    data.supid = $('#supid').val();
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
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
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
    });

</script> 
</body>
</html>