<?php
$add_url = "";
?>
<form method="post"  id="frmcreate"  home="<?php echo site_url('myexcel/' . $page); ?>" back="<?php echo site_url('Item/excel'); ?>" action="<?php echo site_url('Item/savefromexcel'); ?>" class="form-horizontal" enctype="multipart/form-data">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Excel Import', $this, $user) ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div class="col-sm-5">
                                        <label  class="col-sm-5 control-label"><?= label('Select Table', $this, $user) ?></label>
                                        <div class="col-sm-7">
                                            <select name="table_name"  data-validation="required" id="table_name" class="form-control"><option value="">  Select Table</option><option value="item">  Item Table</option><option value="suppliers">Supplier Table</option> <option value="customer">Customer Table</option> <option value="estimate">Sales Order</option> </select>
                                        </div>
                                    </div>
                                    <label  class="col-sm-2 control-label"><?= label('Upload', $this, $user) ?></label>
                                    <div class="col-sm-4">
                                        <input class="form-control file"  type ="file" id="file" name="file" data-validation="required"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <button id="upload"  type='button' data-toggle="tooltip"   title='Upload' class='btn bg-red btn-flat'> <i class="glyphicon  glyphicon-open"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div id="msg" style="overflow: scroll;">
                            </div>
                        </div>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form> 
<script>
    $(document).ready(function (e) {
        $('#upload').on('click', function () {
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            var table_name = $('#table_name').val();
            form_data.append('table_name', table_name);
            form_data.append('file', file_data);
            if (table_name != "") {
                $.ajax({
                    url: "<?php echo site_url($page . '/Upload_ExcelData') ?>", // point to server-side controller method
                    dataType: 'text', // what to expect back from the server
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    async: false,
                    type: 'post',
                    success: function (response) {


                        $('#msg').html(response); // display success response from the server
                    },
                    error: function (response) {
                        $('#msg').html(response); // display error response from the server
                    }

                });
            }
        });
    });

</script>