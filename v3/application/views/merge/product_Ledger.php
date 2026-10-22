<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label('Product Merge', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form id="srchFrom">
                        <div class="row">
                            <div class="col-sm-4">
                                <?= label('From Product', $this, $user) ?> 
                                <input type="hidden" class="form-control" data-validation="required" name="fromid" id="fromid"/> 
                                <input  NoTab="true" type="text" class="form-control" data-validation="required" id="name"/> 
                            </div>
                            <div class="col-sm-4">
                                <?= label('Merge to this Product', $this, $user) ?> 
                                <input type="hidden" class="form-control" data-validation="required"  name="toid" id="toid"/> 
                                <input  NoTab="true" type="text" class="form-control" data-validation="required" id="nameto"/> 
                            </div>
                            <div>
                                <br/>
                                <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    $.validate({
        validateHiddenInputs: true,
        validateOnBlur: true,
        showHelpOnFocus: false,
        addSuggestions: false

    });
    function calert(msg) {
        toastr["error"](msg);
    }

    $(document).ready(function () {
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/items", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#fromid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });
        $("#nameto").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/items", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#toid").val(ui.item.id);
                $("#btn-filter").focus();
            }
        });

        $('#btn-filter').click(function () {

            var id = $('#toid').val();
            var fromid = $('#fromid').val();

            if ($('#srchFrom').isValid()) {
                if (id === '') {
                    return;
                }
                if (fromid === '') {
                    return;
                }
                var saveData = $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>merge/Product",
                    data: $('#srchFrom').serialize(),
                    success: function (resultData) {
                        calert('Merged Succesfully');
                    }
                });

            }
//          
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
        });

    });
</script>
