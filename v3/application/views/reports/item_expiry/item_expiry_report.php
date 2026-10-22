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
                    <table class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <?= label('Expiry Status Filter', $this, $user) ?>
                                    <select class="form-control" id="expiry_filter">
                                        <option value=""><?= label('All Items', $this, $user) ?></option>
                                        <option value="expired"><?= label('Expired', $this, $user) ?></option>
                                        <option value="1week"><?= label('Expires within 1 Week (7 Days)', $this, $user) ?></option>
                                        <option value="2weeks"><?= label('Expires within 2 Weeks (14 Days)', $this, $user) ?></option>
                                        <option value="1month"><?= label('Expires within 1 Month (30 Days)', $this, $user) ?></option>
                                    </select>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Start Date', $this, $user) ?>
                                    <input type="text" class="form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('End Date', $this, $user) ?> 
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                                <td class="col-sm-3">
                                    <?= label('Item', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter" value="<?= label('Search', $this, $user) ?>"/>
                                    <input type="button" class="btn btn-default" id="btn-reset" value="<?= label('Reset', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table" class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Item Name', $this, $user) ?></th>
                                <th><?= label('Barcode', $this, $user) ?></th>
                                <th><?= label('Batch', $this, $user) ?></th>
                                <th><?= label('Expiry Date', $this, $user) ?></th>
                                <th><?= label('Remaining Days to Expiry', $this, $user) ?></th>
                                <th><?= label('Godown', $this, $user) ?></th>
                                <th><?= label('Stock', $this, $user) ?></th>
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
    $.validate({
        modules: 'date, security, file'
    });
    var table;
    var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    function ms() {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": true,
            "language": lan,
            "processing": true,
            "serverSide": true,
            "order": [[4, "asc"]], // Default order by Expiry Date ascending
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2 text-right'B><'col-sm-4 pull-right'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: $('#file_header').val() + '_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date- " + jsDate,
                    exportOptions: {
                        columns: ':visible'
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var filterText = $('#expiry_filter option:selected').text();
                        var itemname = $('#name').val();
                        $('c[r=A1] t', sheet).text(company + " - " + $('#report_header').val());
                        $('c[r=A2] t', sheet).text("Filter: " + filterText + " " + itemname);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: $('#report_header').val(),
                    className: 'btn bg-olive',
                    filename: $('#file_header').val() + '_' + jsDate,
                    messageTop: "Printed Date- " + jsDate,
                    pageSize: 'A4',
                    action: newexportaction,
                    exportOptions: {
                        columns: ':visible',
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        var filterText = $('#expiry_filter option:selected').text();
                        var itemname = $('#name').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Filter: " + filterText + " " + itemname;

                        doc.defaultStyle.fontSize = 9;
                        doc.styles.tableHeader.fontSize = 9;

                        doc['header'] = (function () {
                            return {
                                columns: [
                                    {
                                        alignment: 'center',
                                        text: company + " - " + $('#report_header').val(),
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
                                margin: 20
                            }
                        });

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
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                    }
                                ],
                                margin: 20
                            }
                        });

                        var objLayout = {};
                        objLayout['hLineWidth'] = function (i) { return .5; };
                        objLayout['vLineWidth'] = function (i) { return .5; };
                        objLayout['hLineColor'] = function (i) { return '#aaa'; };
                        objLayout['vLineColor'] = function (i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function (i) { return 4; };
                        objLayout['paddingRight'] = function (i) { return 4; };
                        doc.content[0].layout = objLayout;
                    }
                }
            ],
            "ajax": {
                "url": "<?php echo site_url('reports/Item_expiry_report/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.expiry_filter = $('#expiry_filter').val();
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.toid = $('#toid').val();
                }
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false
                }
            ]
        });
    }

    $(document).ready(function () {
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/itemssearch/name",
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });

        $('#btn-filter').click(function () {
            ms();
        });

        $('#btn-reset').click(function () {
            $('#expiry_filter').val('');
            $('#startdate').val('');
            $('#enddate').val('');
            $('#toid').val('');
            $('#name').val('');
            ms();
        });

        // Initialize datatable on page load
        ms();
    });
</script>
