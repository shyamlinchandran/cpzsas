<form method="post" id="frmcreate" back="<?php echo site_url('email/Email/create'); ?>" action="<?php echo site_url('email/Email/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Message</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('email/Email/create'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('email/Email/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">
                                    <?= label('Template Name', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <input class="form-control" name="name" id="name" />
                            </div>
                            <div class="form-group">
                                <div id="template" ></div>  
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="box-footer">
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
</form>


<!-- Initialize Quill editor -->
<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote', 'code-block'], 
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent
        [{
            'direction': 'rtl'
        }], // text direction

        
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        [{
            'font': []
        }],
        [{
            'align': []
        }],
        ['link', 'image'],
        ['clean'] // remove formatting button
       
    ];
    var quill = new Quill('#template', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var id = $("#id").val();
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/email_type'); ?>/",
            success: function(result) {
                $('#emailtype').html(result);
            }
        });

        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('email/Email/getsing'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    $("#msg").val(result.sms);
                    $("#emailtype").val(result.type);
                    var length = $("#msg").val().length;
                    smslength(length);
                }
            });
        }
        $(".sms_text").on("keyup", function(event) {
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
        function smslength(length) {
            var maxLength = 1610;
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
    $(function() {
        $("option").bind("dblclick", function() {
            var textarea = document.getElementById('msg');
            textarea.value += " " + $(this).val();
            textarea.focus();
        });
    });
</script>