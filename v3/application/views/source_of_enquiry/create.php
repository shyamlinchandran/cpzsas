<form method="post"  id="frmcreatemodelc" back="<?php echo site_url('source_of_enquiry/Source_of_enquiry/list_all'); ?>" action="<?php echo site_url('source_of_enquiry/Source_of_enquiry/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="source_id" name="source_id">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Source Of Enquiry Create', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('source_of_enquiry/Source_of_enquiry/list_all/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('source_of_enquiry/Source_of_enquiry/list_all/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <input type="hidden" name="invoice" id='invoice'/>
                    <div class="box-body">
                        <div class="row">    
                            <div class="col-12 col-md-3 col-lg-4"> 
                                <div class="">
                                    <?= label('Source of Enquiry', $this, $user) ?>
<!--                                    <input type="hidden" id="source" name="source" value="0"/>-->
                                    <input type="text" name="source" id="source" data-validation="required" class="form-control">
                                </div>

                            </div> 

                            <div class="col-12 col-md-3 col-lg-4"> 
                                <div class="">
                                    <?= label('Details', $this, $user) ?>
                                    <textarea  class="form-control" data-validation="required"  name="Details" id="Details"  ></textarea>
                                </div>
                            </div> 
                        </div>  
                    </div>
                    <div class="box-footer">    
                      <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>       
                    </div>
                    <!-- /.col -->
                </div>     
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>

<script>
 load();
    function load() {
        var source_id = $("#source_id").val();
        if (source_id > 0) {
            $.ajax({
                url: "<?php echo site_url('source_of_enquiry/Source_of_enquiry/getsing'); ?>/" + source_id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#source").val(result.source_of_enquiry);
                    $("#Details").val(result.details);
                }
            });
        }
    }

</script>
