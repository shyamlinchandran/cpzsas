<!-- <?php
$add_url = site_url('blood/doner/doner/add');
?>  -->

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
                    <h3 class="box-title">Total Events</h3>
                    <!-- <span class="pull-right">
                       <a role="button" back="<?php echo site_url('blood\donner\donner');?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span> -->
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
                   <!--  <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Baptism</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table> -->

                    <table id="tttable"  class="table table-bordered table-horizontal table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Baptism</th>
                                <th>Marriages</th>
                                <th>Death</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <kbd  class="view"><label name="baptismc" id="baptismc"><?php //echo $baptisms;?></label></kbd>
                                     <a  class="btn btn-info view"  href="<?php echo base_url();?>church/reports/baptism_report/listall" title="View"  data-toggle="tooltip"><span class="fa fa-child"></span></i></a>
                                </td>
                                <td>
                                    <kbd class="view"><label name="marriagec" id="marriagec"><?php //echo $marriage;?></label></kbd>
                                    <a  class="btn btn-success view"  href="<?php echo base_url();?>church/reports/marriage_reports/listall" title="View"  data-toggle="tooltip"><span class="fa fa-handshake-o"></span></i></a>
                                </td>
                                <td>
                                   <kbd class="view"> <label name="deathc" id="deathc" ><?php //echo $death;?></label></kbd>
                                    <a  class="btn btn-danger view"  href="<?php echo base_url();?>church/reports/deathcer_reports/listall" title="View"  data-toggle="tooltip"><span class="fa fa-user-times"></span></i></a>
                                </td>
                            </tr>
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
        $('.view').hide();
        function load()
        {

            $.post("<?php echo site_url('church/registern/getbaptised'); ?>",
            {
              startdate: $('#startdate').val(),
              enddate: $('#enddate').val(),
            },
            function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
                var result = JSON.parse(data);
                $('#baptismc').html(result.baptised.bapcnt);
                $('#deathc').html(result.death.dthcnt);
                $('#marriagec').html(result.marriage.mrgcnt);
                $('.view').show();
            });

           }
            
            $('#btn-filter').click(function ()
            {

                load();
            });
    });

</script>  