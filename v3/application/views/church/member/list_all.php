<?php
$add_url = site_url('church/family_members/create/').$head_id;
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
                    <input  type="hidden" value="<?php echo $head_id; ?>" id="head_id" name="head_id"/>
                    <h3 class="box-title">Family Details - <?php echo $headname['hed_name'];?> &nbsp;<?php echo $headname['hed_housename'];?>&nbsp; No:<?php echo $headname['hed_familyno'];?></h3> 
                    <span class="pull-right">
                        <a role="button" href="<?php echo site_url('church/family_head/listall'); ?>" class="btn  btn-success align-bottom">
                            <span class="glyphicon glyphicon-arrow-left"></span> 
                        </a>
                    </span>
                    <table id="tables"  class="table table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Family Head</th>
                                <th>House Name</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Diocese</th>
                                <th>Prayer Community</th>
                                
                                
                            </tr>
                            <tr>
                                <td><?php echo $headname['hed_name'];?></td>
                                <td><?php echo $headname['hed_housename'];?></td>
                                <td><?php echo $headname['hed_phone'];?></td>
                                <td><?php echo $headname['hed_mobile'];?></td>
                                <td><?php echo $headname['dio_name'];?></td>
                                <td><?php echo $headname['com_name'];?></td>
                                
                            </tr>
                            <tr>
                                <th>Ward</th>
                                <th>Locality</th>
                                <th>Panchayath</th>
                                <th>Village</th>
                                <th>Taluk</th>
                                <th>District</th>
                                
                            </tr>
                            <tr>
                                <td><?php echo $headname['wrd_name'];?></td>
                                <td><?php echo $headname['lnd_name'];?></td>
                                <td><?php echo $headname['panchayath'];?></td>
                                <td><?php echo $headname['vlg_name'];?></td>
                                <td><?php echo $headname['tal_name'];?></td>
                                <td><?php echo $headname['dist_name'];?></td>
                                
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('church/family_members/listall/').$head_id; ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <!-- <th>Head</th> -->
                                <th>DOB</th>
                                <th>Age</th>
                                <th>Education</th>
                                <!-- <th>Baptised</th>
                                <th>Married</th>
                                <th>Job</th>
                                <th>Remarks</th> -->
                                <th>Actions</th>
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

        //datatables
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
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
                "url": "<?php echo site_url('church/family_members/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.head_id = '<?php echo $head_id ?>';
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });


    });

</script>  