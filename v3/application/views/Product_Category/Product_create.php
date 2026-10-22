<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('Product_Category/list_all'); ?>" action="<?php echo site_url('Product_Category/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Product Category', $this, $user) ?></h3>
                         <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('Product_Category/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">                           
                           
                               



                             <div class="col-sm-12 ">
                               <div class="col-sm-6 form-group">
                                 <label class="col-sm-4 control-label tax_id">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                 </label>
                                 <div class="col-sm-8">
                                    <input name="name" type="text" id="name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Description', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="discription" class="form-control" name="discription" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('field1', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="field1" class="form-control" name="field1" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('field2', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="field2" class="form-control" name="field2" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                                </div>
 
                        </div>
                    </div>  
                    <div class="box-footer">          
                         <?php if($type!='view'){
                        echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                    } ?>      
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>

            </div> 

    </section>
</form>
<script type="text/javascript">
load();
function load(){
    var id = $("#id").val();
    if(id>0){
        $.ajax({
                url: "<?php echo site_url('Product_Category/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#name").val(result.name);
                    $("#discription").val(result.discription);
                    $("#field1").val(result.field1);
                    $("#field2").val(result.field2);
                }
            });
    }
}
</script>