
<style>
    .report-error{
        display: none;
    }

</style>   
<div class="box-header with-border">
    <h3 class="box-title"><?php echo $subject ?> Create</h3> 
    <span class="pull-right createheader">         <a  role='button' data-toggle="tooltip"   title='<?php echo $this->l('form_cancel'); ?>' class='btn btn-info' id="cancel-button" > <i class="glyphicon glyphicon-arrow-left"></i> </a> 
    </span>
</div>
<div class="box-body">
    <?php echo form_open($insert_url, 'method="post" id="crudForm" curd="curd" class="form-horizontal"  enctype="multipart/form-data"'); ?>
    <div class="box-body" id="outer">
        <?php
        $counter = 0;
        foreach ($fields as $field) {
            $even_odd = $counter % 2 == 0 ? 'odd' : 'even';
            $even_odd_cls = $counter % 2 == 0 ? 'odd_cls' : 'even_cls';
            $counter++;
            ?>
            <div class='form-group col-md-6 <?= $even_odd_cls ?>' id="<?php echo $field->field_name; ?>_field_box">
                <label class='col-sm-4 control-label' id="<?php echo $field->field_name; ?>_display_as_box">
                    <?php echo $input_fields[$field->field_name]->display_as ?><?php echo ($input_fields[$field->field_name]->required) ? "<span class='required'>*</span> " : "" ?> :
                </label>
                <div class="col-sm-8" id="<?php echo $field->field_name; ?>_input_box">
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
        <!--        <div class='line-1px'></div>-->
        <!--        <div id='report-error' class='report-div error col-md-12'></div>
                <div id='report-success' class='report-div success col-md-12'></div>-->
    </div>
    <div class="box-footer" id="cfooter">          
        <button id="form-button-save" type='submit' data-toggle="tooltip"   title='<?php echo $this->l('form_save'); ?>' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
        <!--        <?php if (!$this->unset_back_to_list) { ?>                 
                                                <a role='button' data-toggle="tooltip"   title='<?php echo $this->l('form_save_and_go_back'); ?>' class='btn btn-info' id="save-and-go-back-button"> <i class="glyphicon glyphicon-hdd"></i> </a> 
                                    
                                                <a  role='button' data-toggle="tooltip"   title='<?php echo $this->l('form_cancel'); ?>' class='btn btn-info' id="cancel-button" > <i class="glyphicon glyphicon-repeat"></i> </a> 
                                    
        <?php } ?>     -->
<!--        <div class='small-loading' id='FormLoading'><?php echo $this->l('form_insert_loading'); ?></div>-->

    </div>
    <?php echo form_close(); ?>

    <script>
        var validation_url = '<?php echo $validation_url ?>';
        var list_url = '<?php echo $list_url ?>';
        if (add_back !== '') {
            list_url = add_back;
        }
        var message_alert_add_form = "<?php echo $this->l('alert_add_form') ?>";
        var message_insert_error = "<?php echo $this->l('insert_error') ?>";
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input').attr('autocomplete', 'off');
            $('.form-control').nextTab();
            $(".two-digits").ForceNumericOnly();
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

        });
    </script>
</div>