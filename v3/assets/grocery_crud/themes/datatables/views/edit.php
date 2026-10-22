<div class="box-header with-border">
    <h3 class="box-title"><?php echo $subject ?> Edit</h3>

    <span class="pull-right">         <a  role='button' data-toggle="tooltip"   title='<?php echo $this->l('form_cancel'); ?>' class='btn btn-info' id="cancel-button" > <i class="glyphicon glyphicon-arrow-left"></i> </a> 
    </span>
</div>
<div class="box-body">
    <?php echo form_open($update_url, 'method="post" curd= "curd"  class="form-horizontal"  id="crudForm" enctype="multipart/form-data"'); ?>
    <div class="box-body">
        <?php
        $counter = 0;
        foreach ($fields as $field) {
            $even_odd = $counter % 2 == 0 ? 'odd' : 'even';
            $even_odd_cls = $counter % 2 == 0 ? 'odd_cls' : 'even_cls';
            $counter++;
            ?>
            <div  class='form-group col-md-6 <?= $even_odd_cls ?>' id="<?php echo $field->field_name; ?>_field_box">
                <label class='col-sm-4 control-label' id="<?php echo $field->field_name; ?>_display_as_box">
                    <?php echo $input_fields[$field->field_name]->display_as ?><?php echo ($input_fields[$field->field_name]->required) ? "<span class='required'>*</span> " : "" ?> :
                </label>
                <div class="col-sm-8"id="<?php echo $field->field_name; ?>_input_box">
                    <?php echo $input_fields[$field->field_name]->input ?>
                </div>

            </div>
        <?php } ?>
        <!-- Start of hidden inputs -->
        <?php
        foreach ($hidden_fields as $hidden_field) {
            echo $hidden_field->input;
        }
        ?>
        <!-- End of hidden inputs -->
        <?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php } ?>
         
    </div>
    <!--<div class="box-footer"> 
        
            <button  data-toggle="tooltip"  id="form-button-save" type='submit' title='<?php echo $this->l('form_update_changes'); ?>' class='btn btn-info' />
         
    <?php if (!$this->unset_back_to_list) { ?>
                                               
                                                    <input type='button' value='<?php echo $this->l('form_update_and_go_back'); ?>' class='btn btn-info' id="save-and-go-back-button"/>
                                                
                                                
                                                    <input type='button' value='<?php echo $this->l('form_cancel'); ?>' class='btn btn-info' id="cancel-button" />
                                                 
    <?php } ?>
     
            <div class='small-loading' id='FormLoading'><?php echo $this->l('form_update_loading'); ?></div>
       
    </div>-->
    <div class="box-footer">          
        <button id="form-button-save" type='submit' data-toggle="tooltip"   title='<?php echo $this->l('form_save'); ?>' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
        <!--        <?php if (!$this->unset_back_to_list) { ?>                 
                                                <a role='button' data-toggle="tooltip"   title='<?php echo $this->l('form_save_and_go_back'); ?>' class='btn btn-info' id="save-and-go-back-button"> <i class="glyphicon glyphicon-hdd"></i> </a> 
                                    
                                                <a  role='button' data-toggle="tooltip"   title='<?php echo $this->l('form_cancel'); ?>' class='btn btn-info' id="cancel-button" > <i class="glyphicon glyphicon-repeat"></i> </a> 
                                    
        <?php } ?>     --> 

    </div>
</form>

<script>
    var validation_url = '<?php echo $validation_url ?>';
    var list_url = '<?php echo $list_url ?>';
    var list = $("#listsm").val();
    if (list !== '') {
        list_url = list
    }
    if (add_back !== '') {
        list_url = add_back;
    }
    var message_alert_edit_form = "<?php echo $this->l('alert_edit_form') ?>";
    var message_update_error = "<?php echo $this->l('update_error') ?>";
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.form-control').nextTab();
        $(".two-digits").ForceNumericOnly();
        $('input').attr('autocomplete', 'off');
        $('.date').datepicker({
            setDate: new Date(),
            format: 'dd/mm/yyyy'
        });
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('.date').datepicker('setDate', today);
        $.validate();
        $('#cancel-button').click(function () {
            //if (confirm(message_alert_add_form))
            {
                if (add_back !== '') {
                    list_url = add_back;
                }
                $.ajax({
                    url: list_url,
                    success: function (result) {
                        $("#div1").html(result);
                    }
                });
            }
            return false;
        });

    })
</script>
</div>