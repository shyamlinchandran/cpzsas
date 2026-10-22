<form method="post"  id="frmcreate" back="<?php echo site_url('settings/email/create'); ?>" action="<?php echo site_url('settings/email/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Email</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/email/create'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('settings/email/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Type :
                            </label>
                            <div class="col-sm-4">
                                <select id="msgtype" name="msgtype" class="form-control">
                                    <option>select</option>
                                </select>                          
                            </div>    
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Message :
                            </label>
                            <div class="col-sm-4">
                                <textarea  style="height: 80px !important" id="msg"  name="msg" rows="8" cols="50"> </textarea>
                            </div>    
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Select :
                            </label>
                            <div class="col-sm-4">
                                <select style="height: 80px !important; width: 130px !important;" id="tablefields" name="dummy" size="13" multiple="multiple" ondblclick="insertValuetext()"><
                                    <option value="#name#" title="">name</option>
                                    <option value="#invoice no#" title="">Invoice Number</option>
                                    <option value="#amount#" title="">Amount</option>
                                    <option value="#type#" title="">type</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box -->
                        <div class="box-footer">
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
            var id = $("#id").val();
            $.ajax({
                url: "<?php echo site_url('ajaxcall/emailtype'); ?>/" + id,
                success: function (result) {
                    $('#msgtype').html(result);
                }
            });
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('settings/email/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);

                        $("#msg").val(result.message);
                        $("#msgtype").val(result.type_id);
                    }
                });
            }
        });
        $(function () {
            $("option").bind("dblclick", function () {
                var textarea = document.getElementById('msg');
                textarea.value += " " + $(this).val();
                textarea.focus();
            });
        });
    </script>