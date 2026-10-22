<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hotel/room/list_all'); ?>" action="<?php echo site_url('hotel/room/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="room_id" id="room_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Room', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hotel/room/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="room_name" type="text" id="room_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Description', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="room_description" class="form-control" name="room_description" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Floor', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <select id="room_floor" name="room_floor" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Maximum No:', $this, $user) ?> <span class="required"></span> 
                                </label>
                                <div class="col-sm-9">
                                    <input id="room_max_num" class="form-control" name="room_max_num" type="number" value="" maxlength="15">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Room Category', $this, $user) ?> <span class="required"></span> 
                                </label>
                                <div class="col-sm-9">
                                    <select id="room_category" name="room_category" class="form-control"></select>
                                </div> 
                            </div>
                        </div>

                        <div class="col-sm-12 ">
                            <table class="table table-striped table-condensed" style="width: 100%">
                                <tr>
                                    <td ><?= label('Room Type', $this, $user) ?></td>
                                    <td ><?= label('Tax', $this, $user) ?></td>
                                    <td ><?= label('Amount', $this, $user) ?></td>
                                    <td ><?= label('Extra Bed Cost', $this, $user) ?></td>
                                    <td ><?= label('Action', $this, $user) ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select  name="room_roomtype" id="room_roomtype"  class="form-control" ></select>

                                    </td>
                                    <td>
                                        <select  name="room_tax" id="room_tax"  class="form-control" ></select>
                                    <td>
                                        <input id="room_amount" class="form-control text-right two-digits"  name="room_amount" type="text">              

                                    </td>
                                    <td>
                                        <input id="room_bedcost" type="text" class="form-control text-right two-digits" name="room_bedcost">              

                                    </td>

                                    <td>
                                        <a data-toggle="tooltip" style="float: left"
                                           title="Add More" id="addmore" class="btn btn-success"
                                           href="#"> <span class="glyphicon glyphicon-plus"></span>
                                        </a>
                                    </td>
                                </tr>
                                <tbody id='addrow'>
                                </tbody>
                            </table>
                        </div>


                    </div>  
                    <div class="box-footer">    
                        <?php
                        if ($type != 'view') {
                            echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                        }
                        ?>      
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</form>


<script type="text/javascript">
    function   additem(room__roomtype, room_tax, room_amount, room_bedcost, type, tax_id) {
        $('#room__roomtype').val('');
        $('#room_tax').val('');
        $('#room_amount').val('');
        $('#room_bedcost').val('');
        var newrow = "<tr><td><input type ='hidden' value =" + type + " name='room[]'><input disabled class='form-control'  type ='text' value = " + room__roomtype + "> </td><td><input class='form-control' disabled type ='text' value = " + room_tax + " ><input type='hidden' name='room_tax[]'  value='" + tax_id + "'></td><td><input  class='form-control'  type ='text' value = " + room_amount + " name='room_amount[]'></td><td> <input class='form-control'  type ='text' value =" + room_bedcost + " name='room_bedcost[]'></td><td><span onclick='remove(this)' data-toggle='tooltip'  title='Remove'   class='btn btn-danger remove'   href='#'>  <span class='remove glyphicon glyphicon-remove-sign'></span>     </span></td></tr>"
        $('#addrow').append(newrow);
    }

    function remove(btn) {
        $(btn).closest('tr').remove();
    }
    $.ajax({
        url: "<?php echo site_url('hotel/room/tax'); ?>",
        success: function (result) {
            $('#room_tax').html(result);
        }
    });

    $.ajax({
        url: "<?php echo site_url('hotel/room/room_floor'); ?>",
        success: function (result) {
            $('#room_floor').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('hotel/room/room_category'); ?>",
        success: function (result) {
            $('#room_category').html(result);
            load();
        }
    });
    $.ajax({
        url: "<?php echo site_url('hotel/room/roomtype'); ?>",
        success: function (result) {
            $('#room_roomtype').html(result);
        }
    });
    $('#addmore').click(function () {
        var type = $('#room_roomtype').val();
        var tax_id = $('#room_tax').val();
        var room__roomtype = $('#room_roomtype option:selected').text();
        var room_tax = $('#room_tax option:selected').text();
        var room_amount = $('#room_amount').val();
        var room_bedcost = $('#room_bedcost').val();
        additem(room__roomtype, room_tax, room_amount, room_bedcost, type, tax_id);
    });

    function load() {
        var room_id = $("#room_id").val();
        if (room_id > 0) {
            $.ajax({
                url: "<?php echo site_url('hotel/room/getsing'); ?>/" + room_id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#room_name").val(result.room_name);
                    $("#room_description").val(result.room_description);
                    $("#room_floor").val(result.flr_id);
                    $("#room_max_num").val(result.room_max_num);
                    $("#room_category").val(result.room_category);
                }
            });
            $.ajax({
                url: "<?php echo site_url('hotel/room/hotel_room_rate'); ?>/" + room_id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        var tax_name = $("#room_tax [value=" + itemsingle.tax_id + "]").text();
                        var roomtype_name = $("#room_roomtype [value=" + itemsingle.room_type + "]").text();
                        additem(roomtype_name, tax_name, itemsingle.room_amount, itemsingle.room_bedcost, itemsingle.room_type, itemsingle.tax_id);
                    });
                }

            });
        }
    }
</script>