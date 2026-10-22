<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('production/label/label_controller/listall'); ?>" action="<?php echo site_url('production/label/label_controller/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('production/label/label_controller/listall'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" >
                                    <?= label(' Label', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="label" class="form-control" name="label" type="text" value="" data-validation="required" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group"> 
                                <label class="col-sm-4 control-label" >
                                    <?= label('Type', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <select id="type" class="form-control " name="type"  data-validation="required" > 
                                            <option value="" selected>Select</option>
                                            <option value="Dropdown">Dropdown</option>
                                            <option value="Checkbox" >Checkbox</option>
                                            <option value="Textbox" >Textbox</option>
                                            <option value="Textarea" > Textarea</option>
                                            <option value="Radio">Radio</option>



                                
                                </select>         
                                </div>  
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Order', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="order" class="form-control" name="order" type="text" value="" data-validation="required" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group"> 
                                <label class="col-sm-4 control-label" >
                                    <?= label('Value', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <textarea id="values" class="form-control " name="values"  data-validation="required"> </textarea>   

                                </div>
                 
                            </div>
            </div>  
         </div>

            <div class="box-footer">    
                <?php
                if ($view != 'view') {
                    echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                }
                ?>      
             </div>

         </div>
            <div class=" hidden">
                <i class="fa fa-refresh fa-spin"></i>
        </div>   
    </section>
</form>
<script type="text/javascript">
    load();
    function load() {
        var id = $("#id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('production/label/label_controller/getdata'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#label").val(result.label);
                    $("#type").val(result.type);
                    $("#order").val(result.order);
                    $("#values").val(result.values);


                  

                }
            });
        }
    }
 
</script>
