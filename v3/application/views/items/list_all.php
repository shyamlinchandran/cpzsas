<?php
$add_url = site_url('item/create');
$type = 'item';
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
                    <h3 class="box-title"> <?= label('Products Master', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('item\listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> <!--tp="popup" -->
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <?= label('Material Type', $this, $user) ?> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Category', $this, $user) ?> 
                                </td> 
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <select id="material_type"  class="form-control" name="material_type">
                                        <option value="">All</option>
                                    </select>  
                                </td>
                                <td>
                                    <select id="category_id"  class="form-control" name="category_id">
                                        <option value="">All</option>
                                    </select>      
                                </td>
                                <td> 
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                                <td class="col-sm-3 col-md-2"><input type="text" id="txtSearch"  class=" form-control" placeholder="Barcode/Name/Any Part" /></td>
                                <td> 
                                    <input type="button" class="btn btn-success" id="btn-Search"  value="Search"/> 
                                    <input type="button" class="btn btn-success" id="btn-Clear"  value="Clear"/>
                                </td>
                                <td id="buttons"></td>
                            </tr>
                        </tbody>
                    </table>  
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Barcode', $this, $user) ?></th>
                                <th><?= label('Product Name', $this, $user) ?></th>
                                <th><?= label('Category', $this, $user) ?></th>
                                <th> <?= label('Cost', $this, $user) ?></th>
                                <th> <?= label('Sales Rate', $this, $user) ?></th>
                                <th> <?= label('Stock In Hand', $this, $user) ?></th>


<!-- <th>Group Name</th>  
<th>Unit</th> 
<th>GST</th> -->
                                <th><?= label('Actions', $this, $user) ?></th>
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
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    var table;
    $(document).ready(function () {
        material_types();
        item_category();
        //datatables

        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [[10, 25, 50, 100,-1], [10, 25, 50, 100,'all']],
            //"<'row'<'col-sm-6'><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
            'dom': "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5 align-middle'li><'col-sm-7'p>>",

            "order": [], //Initial no order.
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Items' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text(company + " - " + 'Items');
                        $('c[r=A2] t', sheet).text("");
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Items' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Items";
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
                                        text: company + " - " + 'Items',
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
            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('item/ajax_list') ?>",
                "async": "false",
                "type": "POST",
                "data": function (data) {
                    data.material_type = $("#material_type").val();
                    data.category_id = $("#category_id").val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false//set not orderable

                }

            ]



        });
        var val = readCookie('search_<?= $type ?>');
        if (val !== null) {
            table.search(val).draw();
            $('#txtSearch').val(val);
        }

        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [

            ],
        }).container().appendTo($('#buttons'));
        $('#btn-Search').click(function () {
            var value = $('#txtSearch').val();
            createCookie('search_<?= $type ?>', value, 3);
            table.search(value).draw();
        });
        $('#btn-Clear').click(function () {
            $('#txtSearch').val('');
            var value = '';
            eraseCookie('search_<?= $type ?>');
            table.search(value).draw();
        });

        $('.dataTables_filter input').unbind().keyup(function () {
            var value = $(this).val();
            if (value.length > 2) {
                createCookie('search_<?= $type ?>', value, 3);
                table.search(value).draw();
            }
            if (value.length === 0) {

            }
        });
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });
    });
    function material_types()
    {
        $.ajax({
            url: "<?php echo site_url('master/amaster/material_types'); ?>/",
            async: false,
            success: function (result) {
                var all_type = "<option value=''>All</option>";
                $("#material_type").html(all_type + result);
            }
        });
    }
    function item_category()
    {

        $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/",
            async: false,
            success: function (result) {
                var option = '<option value =""> All </option>';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#category_id").html(option);
            }
        });
    }

</script>  