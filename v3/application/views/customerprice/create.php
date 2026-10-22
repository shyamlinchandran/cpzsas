
<form method="post"  id="frmcreate" back="<?php echo site_url('settings/customerprice/create'); ?>" action="<?php echo site_url('settings/customerprice/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $id ?>" name="custid" id="custid" />
    <input type="hidden" value="<?= $id ?>" name="pid" id="pid" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer Price</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/customerprice/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('settings/customerprice/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Customer Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-6" id="name_input_box">

                                <input id="custname" class="form-control" name="custname" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                        </div>



                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Price Group<span class="required"></span>  :
                            </label>
                            <div class="col-sm-6" id="name_input_box">

                                <select name="price" data-validation="required" id="price" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($price as $type) { ?>
                                        <option value="<?php echo $type['id']; ?>"><?php echo $type['label']; ?></option>
                                    <?php } ?>
                                </select>          
                            </div> 
                        </div>
<!-- 
                         <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Sales Rate<span></span>  :
                            </label>
                            <div class="col-sm-6" id="name_input_box">

                                <input id="srate" class="form-control" name="srate" type="text" value="" maxlength="50" disabled>              
                            </div> 
                        </div> -->
                    </div> 
                </div>
    <?php if ($view != 'view') { ?>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   
     <?php } ?>
 </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <script type="text/javascript">

          function loadCust(ui) {
        $('#custid').val(ui.item.id);
        $('#custname').val(ui.item.name);
        }

        $(document).ready(function () {
            load(); 
        });
        var inc_inary = 0; 
        
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });

        function load() {
            var id = $("#id").val();
            //alert(id);
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('settings/customerprice/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#custname").val(result.customer);
                        var priceid = result.pid;
                        $("#price").val(priceid);
                       }
                });
            }

            $("#price").change(function () {
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
            $('#pid').val(selectedValue);
        });

         $("#custname").autocomplete({
                source: "<?php echo site_url('settings/customerprice/getcustomer'); ?>",
                minLength: 1,
                select: function (event, ui) {
                    loadCust(ui);

                   }
            });
            }
    </script>