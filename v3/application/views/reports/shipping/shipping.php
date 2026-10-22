<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Ledger Statement</h3>
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
                                <td class="col-sm-2">
                                    Consignee 
                                    <select data-validation="required" name="consignee"  id="consignee" class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($consignee as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['consignee'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?> 
                                            <option  <?= $selected ?> value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name'] . $fwd['Phone']; ?></option>
                                        <?php } ?>
                                    </select>
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
                                <th>INVOICE DATE</th> 
                                <th>CONSIGNMENT NOTE NO</th>
                                <th>VESSEL</th>                                
                                <th>CUSTOMER</th>
                                <th>FACTORY</th>
                                <th>CONTAINER NO</th> 
                                <th>ETA</th> 
                                <th>DELIVERED DATE</th>                                
                                <th>DESTINATION</th> 
                                <th>INVOICE</th> 
                                <th>LORRY NO</th>
                                <th>INVOICE AMOUNT</th>
                                <th>OTHER EXPENSES</th>
                                <th>TOTAL</th>
                                <th>CEQUE AMOUNT</th>
                                <th>BALANCE AMOUNT</th> 
                                <th>PAYMENT DETAILS</th> 


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
            "language": lan,
            "paging": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,'All']],
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
            "bPaginate": true,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/shipping/list_ledger') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.toid = $('#consignee').val();
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
        $('#btn-filter').click(function () { //button filter event click 
            ms();
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
</script>
