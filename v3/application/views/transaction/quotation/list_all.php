<?php
$add_url = site_url('transaction/quotation/quotation');
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
                    <h3 class="box-title"><?= label('Quotations', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
       <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                     <?= label('Bill Type', $this, $user) ?> 
                                    <select id="btype" name="btype"> 
                                     <option value="">Select</option>
                                    </select>

                                </td>
                                <td class="col-sm-2">
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                                  <td class="col-sm-2">
                                    
                                </td>
                                <td class="col-sm-3">
                                   
                                </td>

                                <td>
                                  
                                </td>
                            </tr>
                        </tbody>
                    </table>                    
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Invoice No', $this, $user) ?></th>
                                <th><?= label('Invoice Date', $this, $user) ?></th>
                                <th><?= label('Customers', $this, $user) ?></th>
<!--                                <th>Narration</th> -->
<!--                                <th>Tax Amount</th>-->
                                <th><?= label('Total Amount', $this, $user) ?></th>
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

    var table;

    $(document).ready(function () {
         $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/sales') ?>",
            success: function (result) {
                $('#btype').html(result);
            }
        });

        //datatables
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function () {
                  loadpermission();
            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('transaction/quotation/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = '<?php echo $type ?>';
                    data.supid = $('#supid').val();
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
        loadpermission();
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
        // EDIT: Capture enter press as well
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table

        });
    });

</script>  