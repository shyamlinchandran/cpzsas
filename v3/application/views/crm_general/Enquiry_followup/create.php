<form method="post" id="frmcreate" enctype="multipart/form-data" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('crm_general/Enquiry_register/list_all'); ?>" action="<?php echo site_url('crm_general/Enquiry_followup/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
    <section class="content">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Enquiry Followup</h3>
                </div>
                <div class="box-body">
                    <div class="">
                        <table id="items" class="table table-bordered">

                        </table>
                    </div>
                    <div class="form-group-6">
                        <?= label('Date', $this, $user) ?>
                        <input name="date" id="date" type="text" class="form-control date">
                    </div>
                    <div class="form-group-6">
                        <label for="details">Remarks</label>
                        <textarea class="form-control" data-validation="required" name="remarks" id="remarks"></textarea>
                    </div>
                    <div class="form-group-6">
                        <label for="imageupload">file upload</label>
                        <input type="file" name="file" id="file">
                    </div>
                    <div class="form-group-6">
                        <?= label('Next Follow up Date', $this, $user) ?>
                        <input name="nextdate" id="nextdate" type="text" class="form-control date">
                    </div>
                    <div class=" form-group col-md-6">
                        <?= label('Status', $this, $user) ?>
                        <select name="status" id="status" class="form-control ">

                        </select>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>





        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border" id="appendhead">

                    <h3 class="box-title">Followups</h3>


                    <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('crm_general/Enquiry_register/list_all'); ?>">
                            <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                        </a>
                    </span>

                </div>

                <div class="box-body" id="appendrow">

                    <table id="tablenot" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('Updated on', $this, $user) ?></th>
                                <th><?= label('Next Followup on', $this, $user) ?></th>
                                <th><?= label('Remarks', $this, $user) ?></th>
                                <th><?= label('Files', $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>


                </div>

            </div>
        </div>
    </section>
</form>
<script type="text/javascript">
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    $(document).ready(function() {
        var id = $('#id').val();
        table = $('#tablenot').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Followups' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text(company + " - " + 'Followups');
                        $('c[r=A2] t', sheet).text("");
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Followups' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function(doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Followups";
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
                        doc['header'] = (function() {
                            return {
                                columns: [{
                                    alignment: 'center',
                                    //italics: true,
                                    text: company + " - " + 'Followups',
                                    fontSize: 14,
                                    margin: [10, 0]
                                }],
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
                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [{
                                        alignment: 'left',
                                        text: ['Created on: ', {
                                            text: jsDate.toString()
                                        }]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_general/Enquiry_followup/getsing'); ?>/" + id,
                "type": "POST",
                "data": function(data) {

                    data.type = '<?php echo $type ?>';
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });

    });
    var id = $('#id').val()

    $.ajax({

        url: "<?php echo site_url('crm_general/Enquiry_allocation/getItems'); ?>/" + id,
        success: function(result) {
            var total = 0;
            text = "<tr> <th class = 'text-center' colspan = '3'><b>Enquiry Details</b></th></tr>";
            text = text + "<tr> <th><b>Item Name</b></th> <th><b>Quantity</b></th> <th><b>Price</b></th> <th><b>Total</b></th> </tr>";
            $.each(JSON.parse(result), function(i, items) {
                var temptotal = 0;
                temptotal = items.quantity * items.price;
                total = total + temptotal;
                text = text + '<tr> <td>' + items.itemname + '</td> <td>' + items.quantity + '</td> <td>' + items.price + '</td> <td>' + temptotal + '</td> </tr>'
            });
            text = text + "<tr> <td colspan = '3'><b>Total</b></td> <th><b>" + total + "</b></th> </tr>";

            $('#items').html(text);
        }
    });

    $.ajax({
        url: "<?php echo site_url('crm_general/Enquiry_followup/getStatus'); ?>/",
        async: false,
        success: function(result) {
            var options = '<option>-- Select --</option>';
            $.each(JSON.parse(result), function(i, itemsingle) {
                options = options + '<option value ="' + itemsingle.id + '"> ' + itemsingle.status + '</option>';
            });
            $("#status").html(options);
        }
    });
</script>