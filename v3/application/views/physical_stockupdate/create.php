<?php
$add_url = site_url('Physical_stockupdate/listall');
$type = 'item';
$tmp = $this->session->userdata('user');
$userid = $tmp['Id'];
$username = $tmp['user_name'];
?>

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post" id="frmcreatemodeli" enctype="multipart/form-data"
    back="<?php echo site_url('Physical_stockupdate/listall'); ?>"
    action="<?php echo site_url('Physical_stockupdate/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id ?>" name="ids" id="ids" />
    <input type="hidden" value="<?= $isbatch ?>" name="isbatch" id="isbatch" />
    <input type="hidden" value="<?= $view ?>" name="view" id="view" />
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="<?= $this->box_color ?>">

                    <div class="box-header">
                        <h3 class="box-title">
                            <?= label('Physical Stock Update ', $this, $user) ?>

                        </h3>
                        <span class="pull-right">

                            <a role="button" back="<?php echo site_url('Physical_stockupdate/listall'); ?>"
                                class="btn  btn-success align-bottom"
                                href="<?php echo site_url('Physical_stockupdate/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                            </a>
                        </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td class="col-sm-2">
                                        <?= label('Date', $this, $user) ?>
                                        <input type="date" name="stockdate" id="stockdate" class="form-control" />

                                    </td>
                                    <td class="col-sm-2">
                                        <?= label('User', $this, $user) ?>
                                        <input type="text" value = "<?php echo $username;?>" name="user_name" id="user_name" class="form-control" />
                                        <input type="hidden" name="userId" value = "<?php echo $userid;?>" id="userId" class="form-control" />
                                    </td>
                                    <td>
                                    </td>

                                    <!-- <td>
                                    <br />
                                    <input type="button" class="btn btn-success" id="btn-filter" value="Search" />
                                </td> -->
                                </tr>
                            </tbody>
                        </table>
                        <br />

                        <table id="table" class="table <?= $this->table_color ?> table-responsive" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr class ="trm">
                                    <th>
                                        <?= label('Sl No', $this, $user) ?>
                                    </th>
                                    <th>
                                        <?= label('Barcode', $this, $user) ?>
                                    </th>
                                    <th>
                                        <?= label('Item', $this, $user) ?>
                                    </th>
                                    

                                    <th>
                                        <?= label('Godown', $this, $user) ?>
                                    </th>
                                    <th <?php if($isbatch < 1){?> style = "display:none;" <?php }?>>
                                        <?= label('Batch', $this, $user) ?>
                                    </th>

                                    <th>
                                        <?= label('Current Stock', $this, $user) ?>
                                    </th>
                                    <th>
                                        <?= label('Actual Stock', $this, $user) ?>
                                    </th>
                                    <th>
                                        <?= label('Update Quantity', $this, $user) ?>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php if ($view != 'view') { ?>

                                <tr class ="trm" id="add">
                                    <td><span class ="totrow" ></span></td>
                                      <td > <input style ="width:200px;"  NoTab="true" id="barcode" name="barcode" type="name"
                                            class="form-control" type="text"
                                            placeholder="Barcode" /></td>

                                    <td style ="width:310px !important;" > <input style ="width:310px;" NoTab="true" id="item" name="item[]" type="name"
                                            data-content="</textarea></br>" class="form-control" type="text"
                                            placeholder="Item" /></td>

                                  
                                    <input type="hidden" id="itemid" name="itemid[]" />
                                    <td style ="width:100px;" class="col-lg-4">
                                        <select name="godown" id="godown" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                    <td <?php if($isbatch < 1){?> style = "display:none;" <?php }?> >
                                        <select style ="width:100px;"  name="batch" id="batch" class="form-control">
                                            <option value="">Select</option>
                                        </select>

                                    </td>
                                    <td > <input NoTab="true" id="actualstock" name="actualstock[]"
                                            type="name" data-content="</textarea></br>" class="form-control" type="text"
                                            placeholder="Current Stock" readonly /></td>
                                    <td > <input NoTab="true" id="currentstock" name="currentstock[]"
                                            type="name" data-content="</textarea></br>" class="form-control" type="text"
                                            placeholder="Actual Stock" /></td>
                                    <td > <input NoTab="true" id="updatequantity" name="updatequantity[]"
                                            type="name" data-content="</textarea></br>" class="form-control" type="text"
                                            placeholder="Update Quantity" readonly /></td>
                                    <td><button data-toggle="tooltip" id="butnn" type="button" title="Add To save"
                                            class="btn btn-success  butnn" href="#">
                                            <span class="glyphicon glyphicon-plus">Add</span>
                                        </button></td>

                                </tr>
                            <?php } ?>
                            <tbody id="rowm">

                            </tbody>
                        </table>

                        <div class="box-body">


                            <div class="box-footer">
                                <?php if ($view != 'view') { ?>
                                    <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save All'
                                        class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                                <?php } ?>
                            </div>
                            <!-- /.col -->
                        </div>



                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>

<script type="text/javascript">

    $(document).ready(function() {
    var isSubmitting = false; // Flag to prevent multiple clicks

    $('#frmcreatemodeli').on('submit', function(e) {
        var form = this;

        // 1. Prevent submission if it's already in progress
        if (isSubmitting) {
            e.preventDefault();
            return false;
        }

        // 2. Prevent submission if the "Enter" key was pressed (unless it was from the save button)
        // This relies on your existing logic where you only set a flag on button click
        if (typeof isSaveClicked !== 'undefined' && !isSaveClicked) {
            e.preventDefault();
            return false;
        }

        // 3. Mark as submitting and disable the button visually
        isSubmitting = true;
        var saveBtn = $('#btnsaved');
        saveBtn.prop('disabled', true); 
        saveBtn.html('<i class="glyphicon glyphicon-refresh"></i> Saving...'); 

        // The form will now proceed with the natural submission
        return true;
    });

    // Ensure isSaveClicked is global enough for the submit handler
    var isSaveClicked = false;
    $('#btnsaved').on('click', function() {
        isSaveClicked = true;
    });
});





    $('#frmcreatemodeli').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
        e.preventDefault();
        return false;
    }
    });


    var cntupdate = 1;
    $(document).on("change", ".currentstock", function () {
            var attr = $(this).attr('attr');
            var actualstock = $("#actualstock"+attr).val();
            var currentstock = $("#currentstock"+attr).val();
            var updatestock =  parseFloat(currentstock) - parseFloat(actualstock)  ;
            $("#updatequantity"+attr).val(updatestock);
        });
    $(document).ready(function () {
        var today = new Date();

// Format the date as YYYY-MM-DD (required by the input type="date")
var formattedDate = today.toISOString().split('T')[0];

// Set the value of the input element
document.getElementById("stockdate").value = formattedDate;
        $('#currentstock').keydown(function(e){
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9 ){
                e.preventDefault();
                var currentstock = ($(this).val());
                var actualstock = $('#actualstock').val();

                if (actualstock != null   || actualstock != '') {
                    var updatequantity = currentstock - actualstock;
                    $('#updatequantity').val(updatequantity);
                }
                $('.butnn').trigger('click');
            }
        });
        $("#user_name").autocomplete({

            source: "<?php echo site_url('Physical_stockupdate/getuser'); ?>",
            minLength: 2,
            selectFirst: true,
            select: function (event, ui) {
                $('#user_name').val(ui.item.user_name);
                $('#userId').val(ui.item.Id);

            }
        });

        $("#item").autocomplete({
            source: "<?php echo site_url('Physical_stockupdate/getitem'); ?>",
            minLength: 2,
            selectFirst: true,
            select: function (event, ui) {
                $('#barcode').val(ui.item.barcode);
                $('#itemid').val(ui.item.id);
                $('#item').val(ui.item.name);
                 <?php if($this->session->userdata('login_base_comid') == 'msa') { ?>
                    $("#godown").val('');
                    $("#godown").trigger("change");
                    $("#godown").val(1);
                    $("#godown").trigger("change");
                    $('#batch').focus();
                <?php }?>
            }
        });

        $("#barcode").autocomplete({
            source: "<?php echo site_url('Physical_stockupdate/getitem/barcode'); ?>",
            minLength: 2,
            selectFirst: true,
            select: function (event, ui) {
                $('#item').val(ui.item.name);
                $('#itemid').val(ui.item.id);
                $('#item').val(ui.item.name);
                <?php if($this->session->userdata('login_base_comid') == 'msa') { ?>
                    $("#godown").val('');
                    $("#godown").trigger("change");
                    $("#godown").val(1);
                    $("#godown").trigger("change");
                     $('#batch').focus();
                <?php }?>
            }
        });



        $.ajax({
            async: false,
            url: "<?php echo site_url('Physical_stockupdate/getbatch'); ?>",
            success: function (result) {
                $('#batch').html(result);
                $('#batch1').html(result);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching batch options:', error);
            }
        });

        $.ajax({
            async: false,
            url: "<?php echo site_url('Physical_stockupdate/getgodown'); ?>",
            success: function (result) {
                $('#godown').html(result);
                $('#godown1').html(result);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching gowdown options:', error);
            }
        });

        $('.butnn').click(function () {

            var barcode = $('#item').val();
            var itemid = $('#itemid').val();
            var item = $('#barcode').val();
            var godown = $('#godown').val();
            var batch = $('#batch').val();
            var currentstock = $('#currentstock').val();
            var actualstock = $('#actualstock').val();
            var updatequantity = $('#updatequantity').val();
            var is_continue = 1;
            <?php if($isbatch > 0 ){?>
                if(batch =='select'){
                    is_continue = 0;
                }
            <?php }?>


            if (parseFloat(itemid) > 0 && currentstock !='' && is_continue > 0 ) {
                add1(barcode, itemid, item, godown, batch, currentstock, actualstock, updatequantity);
            }
            else {
                alert("Enter Barcode and item");
            }
        });



        function clear() {
            clearValue($("#itemid"));
            clearValue($("#barcode"));
            clearValue($("#item"));
            clearValue($("#godown"));
            clearValue($("#batch"));
            clearValue($("#currentstock"));
            clearValue($("#actualstock"));
            clearValue($("#updatequantity"));

        }



        function add1(barcode, itemid, item, godown, batch, currentstock, actualstock, updatequantity) {

            var godownName = $('#godown option:selected').text();
            var batchName = $('#batch option:selected').text();
            var isbatch = $('#isbatch').val();
            if(isbatch < 1){
                var batchtext = 'style="display:none"';
            }else{
                var batchtext = "";
            }
            //  alert(selectedGodownName);
            var incntdec = 0;
            incntdec = incntdec + 1;
            var itemidd = $('#itemid').val();
            var text = '<tr><td><span class ="srow" ></span></td><td ><input type="hidden" name="index[]" value=0 /><input style ="width:310px" type="text"  id="barcode1" name="barcode1[]" value="' + item + '" class="form-control barcode1" placeholder="Barcode" readonly="readonly" />' +
                '<input type="hidden"  id="itemid1" name="itemid1[]" value="' + itemid + '" class="itemid1"  /></td> ' +
                '<td  ><input type="text" id="item1" name="item1[]" value="' + barcode + '" class="item1 form-control" readonly="readonly" /></td>' +
                '<td ><input type="hidden" id="godown1" name="godown1[]" value="' + godown + '" class="godown1 form-control" readonly="readonly" /><input type="text" id="godownname1" name="godownname1[]" value=' + godownName + ' class="godownname1 form-control" readonly="readonly" /></td>' +
                '<td  '+batchtext+'><input type="hidden" id="batch1" name="batch1[]" value="' + batch + '" class="batch1 form-control" readonly="readonly" /><input type="text" id="batchname1" name="batchname1[]"  ff value="' + batchName + '" 12 class="batchname1 form-control" readonly="readonly" /></td>' +
                '<td ><input type="text" attr = '+cntupdate+' id="actualstock'+cntupdate+'" name="actualstock1[]" value="' + actualstock + '" class="actualstock form-control" readonly  /></td>' +
                '<td ><input type="text" id="currentstock'+cntupdate+'" attr = '+cntupdate+' name="currentstock1[]" value="' + currentstock + '" class="currentstock form-control"   /></td>' +
                '<td  ><input type="text" id="updatequantity'+cntupdate+'" name="updatequantity1[]" value="' + updatequantity + '" class="updatequantity1 form-control" readonly  /></td>' +

                '<td><span data-toggle="tooltip"  id="button1" title="Remove" onclick="remove(this)" vtype="dec" class="btn btn-danger btn-sm remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span> </span></td></tr>';
            
            $('#rowm').append(text);
            cntupdate++;
            clear();
            saveadd();
            setrow();
            $("#barcode").focus();
        }

        function saveadd() {

            $(".barcode1").each(function () {

                barcode = ($(this).val());

            });
            $(".itemid1").each(function () {

                item = ($(this).val());

            });
            $(".item1").each(function () {

                itemname = ($(this).val());

            });
            $(".godownname1").each(function () {

                godown = ($(this).val());

            });
            $(".batchname1").each(function () {

                batch = ($(this).val());

            });
            $(".actualstock1").each(function () {

                actualstock = ($(this).val());

            });
            $(".currentstock1").each(function () {

                currentstock = ($(this).val());

            });
            $(".updatequantity1").each(function () {

                updatequantity = ($(this).val());

            });
        }
       
        $(document).on("change", "#godown", function () {
            var godownId = $("#godown").val();
            var itemid  = $("#itemid").val();
            var isbatch = $('#isbatch').val();
            $.ajax({
                async: false,
                url: "<?php echo site_url('Physical_stockupdate/getactualstock'); ?>/" + godownId,
                type:"POST",
                data:{itemid:itemid,godownId:godownId,isbatch:isbatch},
                success: function (result) {
                    $("#actualstock").val(0);
                    var actualStock;
                    if(isbatch < 1){
                                if (result) {

                                    if (typeof result === 'string') {
                                        try {
                                            result = JSON.parse(result);
                                        } catch (e) {
                                            console.error('Error parsing JSON:', e);
                                        }
                                    }

                                    var cnt = result.cnt;
                                    if(parseInt(cnt) > 0  ){
                                        $('.trm').attr('style','background:red');
                                    }else{
                                        $('.trm').attr('style','');
                                    }
                                    if (result.actualstk !== undefined) {
                                        actualStock = result.actualstk;
                                       // console.log("Actual Stock:", actualStock);
                                        $("#actualstock").val(actualStock);
                                    } else {
                                        console.log("actualstk property not found in the response");
                                    }
                                } else {
                                    console.log("No data received");
                                }
                    }else{
                        var option = '<option value ="select" > Select</option>';
                        $.each(JSON.parse(result), function (i, itemsingle) { 
                              option = option +  '<option stock = "'+itemsingle.actualstk+'" value ="'+itemsingle.batch+'" > Batch : '+itemsingle.batch+'</option>';
                        });
                        $('#batch').html(option);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching gowdown options:', error);
                }
            });
        });

       $(document).on("change", "#batch", function () {
            // get the selected option
            let selected = $(this).find("option:selected");

            // read custom attribute
            let stock = selected.attr("stock");
            $('#actualstock').val(stock);
            // show it
            console.log("Selected stock:", stock);
        });

        $(document).on("change", "#actualstock", function () {

            var actualstock = ($(this).val());
            var currentstock = $('#currentstock').val();
            console.log('hre');
            if (currentstock != null ||  currentstock != '') {
                var updatequantity = currentstock - actualstock;
                $('#updatequantity').val(updatequantity);

            }

            // calaculate();
        });

        $(document).on("change", "#currentstock", function () {

            var currentstock = ($(this).val());
            var actualstock = $('#actualstock').val();

            if (actualstock != null   || actualstock != '') {
                var updatequantity = currentstock - actualstock;
                $('#updatequantity').val(updatequantity);
            }

            // calaculate();
        });
        load();

      

        
    });
    function setrow(){
        var totrow = 0;
        $(".srow").each(function() {
            totrow = totrow + 1;
            $(this).html(totrow);
            $('.totrow').html(totrow);
        });
    }
    function calculate() {
        var currentstock = 0;
        var actualstock = 0;
        var updatestk = 0;
        currentstock = $('#currentstock').val();
        actualstock = $('#actualstock').val();
        updatestk = actualstock - currentstock;
        $("#updatequantity").val(updatestk);
    }
    function remove(button1) {

        $('.tooltip').remove();
        $(button1).closest('tr').remove();
        setrow();

    }

    function load() {
        var id = $("#ids").val();

        var eid = $("#enq").val();
        var view = $("#view").val();
        var type = $("#type").val();

        if (id > 0) {
            var st = 0;
            var dis = 0;
            $.ajax({

                url: "<?php echo site_url('Physical_stockupdate/getdetails'); ?>/" + id,
                async: false,
                success: function (results) {
                    var result = JSON.parse(results);

                    $("#stockdate").val(result.date);
                    $("#user_name").val(result.user_name);
                    $("#userId").val(result.user);

                }

            });

        }

        $.ajax({

            url: "<?php echo site_url('Physical_stockupdate/getstockupdate'); ?>/" + id,
            async: false,

            success: function (results) {
                var isbatch = $('#isbatch').val();
                if(isbatch < 1){
                    var batchtext = 'style="display:none"';
                }else{
                    var batchtext = "";
                }

                var result = JSON.parse(results);
                var txt = 'remove';
                var tx = '';
                $.each(result, function (i, itemsingle) {

                    var phy_stk_id = itemsingle.phy_stk_id;
                    var item = itemsingle.item;
                    var itemname = itemsingle.itemname;
                    var barcode = itemsingle.barcodes;
                    var godownid = itemsingle.godown;
                    var godownname = itemsingle.godown_name;
                    var batchid = itemsingle.batch;
                    var batchname = itemsingle.batchname
                    var currentstock = itemsingle.currentstock;
                    var actualstock = itemsingle.actualstock;
                    var updatequantity = itemsingle.updatequantity;

                    $('#id').val(itemsingle.phy_stk_id);

                    $("#rowm").append('<tr><td><span class ="srow" ></span></td> <td  ><input type="text" id="item1" readonly name="item1[]" value="' + barcode + '" class="item1 form-control"   /></td>  <td ><input type="hidden" name="index[]" value=' + itemsingle.phy_stk_id + ' /><input type="text"  id="barcode1"  style ="width:310px" name="barcode1[]" value="' + itemsingle.itemname + '" class="form-control barcode1" placeholder="Barcode" readonly />' +
                        '<input type="hidden"  id="itemid1" name="itemid1[]" value=' + itemsingle.item + ' class="itemid1"  /></td> ' +
                        '' +
                        '<td ><input type="hidden" id="godown1" name="godown1[]" value=' + godownid + ' class="godown1 form-control" readonly="readonly" /><input type="text" id="godownname1" name="godownname1[]" value="' + godownname + '" class="godownname1 form-control" readonly="readonly" /></td>' +
                        '<td '+batchtext+'><input type="hidden" id="batch1" name="batch1[]" value="' + batchid + '" class="batch1 form-control" readonly="readonly" /><input type="text" id="batchname1" name="batchname1[]" value="' + batchname + '" class="batchname1 form-control" readonly="readonly" /></td>' +
                        '<td  ><input type="text" id="actualstock1" name="actualstock1[]" value=' + actualstock + ' class="actualstock1 form-control"    /></td>' +
                        '<td ><input type="text" id="currentstock1" name="currentstock1[]" value=' + currentstock + ' class="currentstock1 form-control"    /></td>' +
                        '<td  ><input type="text" id="updatequantity1" name="updatequantity1[]" value=' + updatequantity + ' class="updatequantity1 form-control" readonly /></td>' +
                        '<td><span data-toggle="tooltip"  id="button1" title="Remove" onclick="remove(this)" vtype="dec" class="btn btn-danger btn-sm remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span> </span></td></tr>');


                    setrow();
                });


            }

        });


    }

</script>