<?php
$add_url = site_url('sync/main/getallclinic');
?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Sync Local Data</h3>
                    <span class="pull-right">

                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body"> 
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        
                        <tbody>
                        <td> 
                            <a role="button"  class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                                <span class="glyphicon glyphicon-plus"></span> Sync
                            </a>
                        </td> 
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
