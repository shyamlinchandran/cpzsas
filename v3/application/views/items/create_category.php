<!-- 
    *********************************************************************************************
    *adddiscount
    *
    *
    *@author Althaf
    *@created on : 12-10-2019
    *
    *******************************************************************************************
 -->
 <form method="post" enctype="multipart/form-data" id="frmcreatemodelc" back="<?php echo site_url('Items/list_category'); ?>" action="<?php echo site_url('Items/save_category'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">

    <section class="content">

        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= label('Create Category', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('Items/list_category'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Items/list_category'); ?>">
                            <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                        </a>
                    </span>
                </div>
                <input type="hidden" name="invoice" id='invoice' />
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 ">

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">

                                    <input tabIndex="1" name="name" id="name" type="text" class="form-control" required>


                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4">
                                    <?= label('Category :', $this, $user) ?>
                                </label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="cate" name="cate" class="form-control" />
                                    <input type="text" id="item_category_name" name="item_category_name" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4">
                                    <?= label('Image', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="file" name="file" id="file" class="form-control" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer">
                        <?php
                        if ($option != 'view') {
                        ?>
                            <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>

<script>
    $("#item_category_name").autocomplete({
        source: "<?php echo site_url('Item/getallCat'); ?>",
        minLength: 2,
        select: function(event, ui) {
            $('#cate').val(ui.item.id);
            $('#item_category_name').val(ui.item.name);
        }
    });
    var logged = $('#loggedid').val();
    setUser(logged);
    setCategory();
    load();

    function load() {
        var source_id = $("#source_id").val();
        if (source_id > 0) {
            $.ajax({
                url: "<?php echo site_url('source_of_enquiry/Source_of_enquiry/getsing'); ?>/" + source_id,
                success: function(results) {
                    var result = JSON.parse(results);
                    $("#source").val(result.source_of_enquiry);
                    $("#Details").val(result.details);
                }
            });
        }

        var id = $('#id').val();
        // var option = $('#option').val()
        // alert(id);

        if (id != 0) {

            $.ajax({
                url: "<?php echo site_url('Items/get_cat_data'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    setCategory(result.item_category_id);
                    $("#name").val(result.name);
                }
            });
        }


    }

    function setUser(logged = 0) {

        var text = "";
        $.ajax({

            url: "<?php echo site_url('crm_general/Enquiry_register/users'); ?>",
            success: function(results) {
                text = '<option value = "">Select</option>';
                $.each(JSON.parse(results), function(i, items) {
                    if (items.Id == logged) {
                        text = text + '<option selected = "selected" value = "' + items.Id + '">' + items.user_name + '</option>';
                    } else {
                        text = text + '<option value = "' + items.Id + '">' + items.user_name + '</option>';
                    }

                    $('#user').html(text);

                });


            }
        });
    }

    function setCategory(cate = 0) {

        var text = "";
        $.ajax({

            url: "<?php echo site_url('Items/get_category'); ?>",
            success: function(results) {
                text = text + '<option>--Select--</option>'
                $.each(JSON.parse(results), function(i, items) {
                    if (items.id == cate) {
                        text = text + '<option selected = "selected" value = "' + items.id + '">' + items.name + '</option>';
                    } else {
                        text = text + '<option value = "' + items.id + '">' + items.name + '</option>';
                    }

                    $('#cate').html(text);

                });


            }
        });
    }

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1],
            day = datePart[2];

        return day + '/' + month + '/' + year;
    }
</script>