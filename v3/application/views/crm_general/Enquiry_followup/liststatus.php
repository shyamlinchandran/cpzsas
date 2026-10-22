<!-- 
 *************************************************************************************************
    *listdiscount
    *
    *
    *@author Althaf
    *created on : 12-10-2019
    *
 ***************************************************************************************************
-->

<?php
$add_url = site_url('crm_general/Enquiry_followup/addStatus');
$type = 'course';
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

                <div class="box-header with-border">
                    <h3 class="box-title"> <?= label('Label Master', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('crm_general/Enquiry_followup/listStatus'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> <!--tp="popup" -->
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
             <div style= "position:relative; left:890px;top:8px">
             <input style = "" type="button" class="btn btn-success" id="btn-Clear"  value="Clear"/>
            </div>
                
                
                <div class="box-body">
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Status', $this, $user) ?></th>
                                <th><?= label('Note', $this, $user) ?></th>
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
            "buttons": [],
            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_general/Enquiry_followup/status_list') ?>",
                "async": "false",
                "type": "POST",
                "data": function () {

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



    

</script>  