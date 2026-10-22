<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Sales Report</h3>
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
                                </td><td class="col-sm-2">
                                    Type
                                    <select id="chrq_status"  class="form-control" name="chrq_status">
                                        <option value="cash">cash</option>
                                        <option value="credit">credit</option>
                                        <option value="">all</option>
                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    Customer
                                    <input data-validation="required" type="hidden" name="customer_id" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total Gst</th>
                                <th>Round Off</th>
                                <th>Total Amount</th>  
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
        modules: 'date, security,file'
    });
    var table;
    var id = 0;
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
                {
                    extend: 'excel',
                    action: newexportaction,
                    text: ' <span class="glyphicon glyphicon-download" title="xlsx excel"></span> ',
                    className: 'btn btn-circle btn-primary',
                    title: 'Sales Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdf',
                    action: newexportaction,
                    text: ' <span class="glyphicon glyphicon-cloud-download" title="pdf"></span> ',
                    className: 'btn btn-circle bg-purple',
                    title: 'Sales Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'csv',
                    action: newexportaction,
                    text: ' <span class="glyphicon glyphicon-download-alt" title="csv excel"></span> ',
                    className: 'btn btn-circle bg-orange',
                    title: 'Sales Report',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                }
            ],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/sales/get_tyrsalesreport') ?>",
                "type": "POST",
                "data": function (data) {
                    data.supname = $("#supname").val();
                    data.customer_id = $("#supid").val();
                    data.type = $("#chrq_status").val();
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
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
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
</script>
