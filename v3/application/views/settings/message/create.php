<form method="post"  id="frmcreate" back="<?php echo site_url('settings/message/create'); ?>" action="<?php echo site_url('settings/message/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Message</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/message/create'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('settings/message/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12" >                            
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Type', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <select class="form-control" name="msgtype" id="msgtype">
                                        <option></option>
                                    </select>              
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" >                            
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Message', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <textarea class="form-control sms_text"  style="height: 80px !important" id="msg"  name="msg" rows="8" cols="50"> </textarea>
                                    <h4><span id="char-count">160</span> chars remaining</h4>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Select', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <select style="height: 80px !important; width: 130px !important;" id="tablefields" name="dummy" size="13" multiple="multiple" ondblclick="insertValuetext()"><
                                        <option value="#name#" title="">Name</option>
                                        <option value="#ledgerno#" title="">Ledger No.</option>
                                        <option value="#billno#" title="">Bill No.</option>
                                        <option value="#amount#" title="">Amount</option>                                        
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="box-footer">
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
</form>
<script type="text/javascript">

    $(document).ready(function () {
        var id = $("#id").val();
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/messagetype'); ?>/",
            success: function (result) {
                $('#msgtype').html(result);
            }
        });
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('settings/Message/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#msg").val(result.sms);
                    $("#msgtype").val(result.type);
                    var length = $("#msg").val().length;
                    smslength(length);
                }
            });
        }
        $(".sms_text").on("keyup", function (event) {
            var length = $(this).val().length;
            smslength(length);
            //$(".char-count").html();
            //checkTextAreaMaxLength(this, event);
        });
        /*
         Checks the MaxLength of the Textarea
         -----------------------------------------------------
         @prerequisite:	textBox = textarea dom element
         e = textarea event
         length = Max length of characters
         */
         function smslength(length)
         {            
            var maxLength = 161;
            var length = maxLength - length;
            $('#char-count').text(length);
            
         }
        function checkTextAreaMaxLength(textBox, e) {
            var maxLength = parseInt($(textBox).data("length"));
            if (!checkSpecialKeys(e)) {
                if (textBox.value.length > maxLength - 1)
                    textBox.value = textBox.value.substring(0, maxLength);
            }
            $("#char-count").html(maxLength - textBox.value.length);

            return true;
        }
        /*
         Checks if the keyCode pressed is inside special chars
         -------------------------------------------------------
         @prerequisite:	e = e.keyCode object for the key pressed
         */
        function checkSpecialKeys(e) {
            if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40)
                return false;
            else
                return true;
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