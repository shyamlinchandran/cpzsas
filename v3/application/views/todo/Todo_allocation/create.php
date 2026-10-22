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
<form method="post" id="frmcreatemodelc" back="<?php echo site_url('todo/Todo_allocation/list_all'); ?>" action="<?php echo site_url('todo/Todo_allocation/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
    <input type="hidden" value="<?php echo $logged; ?>" name="loggedid" id="loggedid" />
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Create Task', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('todo/Todo_allocation/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('todo/Todo_allocation/list_all'); ?>">
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
                                        <?= label('Date', $this, $user) ?> <span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8">
                                        
                                            <input tabIndex="1" name="date" id="date" type="text" class="form-control date">

                                        
                                    </div>
                                </div>

                                <div class="col-sm-6 form-group">
                                    
                                        <label class="col-sm-4">
                                            <?= label('User: ', $this, $user) ?>
                                        </label>
                                        <div class="col-sm-8">
                                            
                                                <select tabIndex="11" name="user" id="user" class="form-control">
                                                    

                                                </select>
                                 
                                        </div>
                                  
                                </div>
                            </div>
                            <div class="col-sm-12 ">

                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4">
                                        <?= label('Status', $this, $user) ?> <span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8">
                                            <select tabIndex="11" name="stat" id="stat" class="form-control">

                                            </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 form-group">
                                    
                                    <label class="col-sm-4">
                                        <?= label('Task', $this, $user) ?>
                                        </label>
                                        <div class="col-sm-8">
                                        
                                        <textarea class="form-control" name="task" id="task"></textarea>
                                        
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
    var logged = $('#loggedid').val();
    setUser(logged);
    setStatus();
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
                url: "<?php echo site_url('todo/Todo_allocation/getdata'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    
                    $("#date").val(formatDate(result.date));
                    setStatus(result.status);
                    setUser(result.user);
                    $("#task").val(result.task);
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

    function setStatus(statuss = 0) {

    var text = "";
    $.ajax({

        url: "<?php echo site_url('todo/Todo_allocation/getStatus'); ?>",
        success: function(results) {
            $.each(JSON.parse(results), function(i, items) {
                if (items.id == statuss) {
                    text = text + '<option selected = "selected" value = "' + items.id + '">' + items.status + '</option>';
                } else {
                    text = text + '<option value = "' + items.id + '">' + items.status + '</option>';
                }

                $('#stat').html(text);

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