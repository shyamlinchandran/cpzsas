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
$add_url = site_url('Categor_price/addBatch');
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title"> <?= label('Daily Gold Rate', $this, $user) ?></h3>
                    <span class="pull-right">
                        <button attr = 0  id ="addrate" role="button" back="<?php echo site_url('categor_price/listall'); ?>" class="btn  btn-success align-bottom addrate" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> <!--tp="popup" -->
                        </button>
                    </span>
                </div>
                <!-- /.box-header -->
             <div style= "position:relative; left:890px;top:8px">
            </div>
                
                
                <div class="box-body">
                <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <?= label('Category', $this, $user) ?>  
                                    <select  id="category_id"  name="category_id" class=" form-control">
										<option value="">Select</option> 
									</select>
								</td>
                               <td class="col-sm-2">
									<br />
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
								</td>
								<td class="col-sm-2">
									  
								</td>
								 <td class="col-sm-2">
                                   
                                </td>
								<td class="col-sm-2">
                                   
                                </td>
                                <td>
                                    <br/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="table"  class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('Category', $this, $user) ?></th>
                                <th><?= label('Gold Rate', $this, $user) ?></th>
                                <th><?= label('Old Gold Rate', $this, $user) ?></th>
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
        $(document).on('click', '.addrate', function() {
            var attr = $(this).attr('attr');
            if(parseFloat(attr) > 0 ){
                $.ajax({
                    url: "<?php echo site_url('Categor_price/getsing'); ?>/"+attr,
                    async: false,
                    success: function (result) {
                        var result = JSON.parse(result);
                        $('#modal_gold_id').val(result.id);
                        $('#modal_gold_date').val(result.dates);
                        $('#modal_gold_category').val(result.category_id);
                        $('#modal_gold_rate').val(result.gold_rate);
                        $('#modal_old_gold_rate').val(result.old_gold_rate);


                    }
                });
            }else{
                $('#modal_gold_category').val('');
                $('#modal_gold_rate').val('');
                $('#modal_old_gold_rate').val('');
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                $('#modal_gold_date').datepicker('setDate', today);
            }
            $('#myModalGold').modal('show');
        });
        item_category();
        //datatables

        table = $('#table').DataTable({
            "responsive": true, "processing": true, //Feature control the processing indicator.
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

            ],
            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Categor_price/ajax_list') ?>",
                "async": "false",
                "type": "POST",
                "data": function (data) {
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
        

       
        $('#btn-Search').click(function () {
            var value = $('#txtSearch').val();
        });
    
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });
    });
   
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