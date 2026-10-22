<?php
$add_url = site_url('settings/setting/download');
?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Download</h3>
                    <span class="pull-right">

                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body"> 
                    <table id="table"  class="table table-stripped table-condensed table-responsive" cellspacing="0" width="100%">
                        
                        <tbody>
                        <td> 
                            <a role="button" tp="new" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                                <span class="glyphicon glyphicon-plus"></span> Download
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
