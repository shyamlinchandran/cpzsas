<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Item  Stock</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">

                        <tbody>
                            <tr>

                                <td class="col-sm-1">
                                    Item Group
                                    <select id="grp"  class="form-control hunpx" name="grp">

                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    Item 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
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
                                <th>Item Name</th>
                                <th>Stock Category</th>
                                <th>Stock In Hand</th>

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

    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/itemgroup'); ?>",
            success: function (result) {
                $('#grp').html(result);
            }
        });
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/items", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
        function ms()
        {
            if (id === 1) {
                table.destroy();
            }
            id = 1;
            table = $('#table').DataTable({
                "language": lan,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                //"scrollX": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                'buttons': [
                    {
                        extend: 'excel',
                        text: '<span class="glyphicon glyphicon-download"></span>',
                        className: 'btn btn-circle btn-primary',
                        title: 'Dims Reports'
                    }
                ],
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('reports/Stock/get_stock') ?>",
                    "type": "POST",
                    "data": function (data) {
                        data.cid = $('#grp').val();
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
