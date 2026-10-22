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
<!--                                <td class="col-sm-2">
                                    Ledger 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>-->

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
                                <th>INVOICE NO</th>
                                <th>FACTORY</th>
                                <th>CONTAINER NO</th> 
                                <th>DEIVERED DATE</th>
                                <th>INVOICE</th> 
                                 <th>OTHER CHARGES</th>
                                <th>Total</th> 

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
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('master/Newmasters/list_ledger') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    //data.toid = $('#toid').val();
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

//        $("#name").autocomplete({
//            source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
//            minLength: 2,
//            select: function (event, ui) {
//                $("#toid").val(ui.item.id);
//                $("#btn-filter").focus();
//            }
//        });
 

        $('#btn-filter').click(function () { //button filter event click

           ms();
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });

    });
</script>
