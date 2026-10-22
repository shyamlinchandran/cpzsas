<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('crm_new/Enquiry_allocation/list_all'); ?>" action="<?php echo site_url('crm_new/Enquiry_allocation/save'); ?>" >
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/>
    <input type="hidden" value="<?php echo $type; ?>" name="modess" id="modess"/>
    
    <input type = "hidden" value = "<?php echo $settings[0]['crm_type'];?>" name="crmtype" id="crmtype"/>
    <section class="content"> 
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Enquiry Register', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                class="btn  btn-success align-bottom"
                                href="<?php echo site_url('crm_new/Enquiry_allocation/list_all'); ?>"> 
                                <span class="remove glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row"> 
                            <div  class="col-12 col-md-3 col-lg-4"> 
                                <div class="">
                                    <?= label('Date', $this, $user) ?>
                                    <input tabIndex="1" name="date" id="date" type="text" class="form-control date">
                                </div>
                                <br>
                                <div class="">
                                    <label id = "qualify">Company Name</label>
                                    <input type="hidden" id="companyid" name="companyid"  data-validation="required"> 
                                    <input tabIndex="2" type="text" name="companyName" id="companyName" data-validation="required" class="form-control">
                                </div>
                                <br>
                                <div class="" id = "qualy">
                                <label >Qualification Status</label><br>
                                <input type="radio" name="qual" value="passed" checked="checked"> Passed &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="qual" value="failed"> failed &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="qual" value="other"> other
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Address', $this, $user) ?>
                                    <textarea tabIndex="3"  class="form-control"  name="adress" id="adress"  ></textarea>
                                </div>
                                <br>
                                <div id = "cour" class="">
                                <label >Course</label>
                                    <select tabIndex="9"  name="course" id="course" class="form-control">


                                    </select>
                                </div>
                                <br>

                                <div class="" id = "serv">
                                    <table class="table table-striped table-condensed" id="tblProducts" style="width: 100%">
                                        <tr id = "value">
                                            <td >
                                            <label id = "changed">Services</label>
                                            </td>
                                            <td ><?= label('Price', $this, $user) ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <input type="hidden" id="productid" name="productid">
                                            <input tabIndex="13"  type="text" name="product"  id="product"  >
                                        </td>
                                            <td><input tabIndex="14" type="text" id="price" name="price"  class="form-control"/></td>
                                            <td> <a data-toggle="tooltip" style="float: left"
                                                    title="Add More" id="addmore" class="btn btn-success"
                                                    href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                </a></td>
                                        </tr>
                                        <tbody id='addrow'>
                                        </tbody>
                                        <tr> 
                                            <td>Total</td>
                                            <td><input tabIndex="15" type="text" id="total" name="total" class="grdtot" /></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4"> 

                                <div class="">
                                    <label id = "name">Contact Person</label>
                                    <input tabIndex="4" type="text" name="contactPerson" id="contactPerson" data-validation="required" class="form-control">
                                </div>
                                <br>
                                <div class="">
                                    <label id = "phone">Contact Number</label>
                                    <input tabIndex="5" type="text" data-validation="number" name="contactNumber" id="contactNumber" data-validation="required" class="form-control">
                                </div>
                                <br>
                                
                                <div class="col-12">
                                <label class="">
                                    <?= label('District', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="">
                                    <div class="input-group input-group-sm">
                                        <select name="states_cus" id="states_cus" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                        <span class="input-group-btn pophide">
                                            <button type="button" opt="states_cus" url="<?php echo site_url('masters/states/add'); ?>" class="btn btn-primary myModalPop_cus">
                                                New
                                            </button>
                                        </span>
                                    </div>
                                </div>               
                                </div>
                   
                                <br>
                                <div class="">
                                    <label id = "exename">Executive Name</label>
                                    <select tabIndex="7"  name="user" id="user"  class="form-control"> 
                                        <option value="">Select</option>
                                        <option value="product">Admin</option>
                                        <option value="solution">User</option>
                                    </select>
                                </div>
                                <br>

                            </div>
                            <div class="col-12 col-md-4 col-lg-4"> 
                                <div class="">
                                    <?= label('Source of Enquiry', $this, $user) ?>
                                    <select tabIndex="8"  name="source_id" id="source_id"  class="form-control">

                                    </select>
                                </div>
                                <br>
                            </div>            
                            <div class="col-12 col-md-4 col-lg-4"> 
                            <div class="">
                                    
                                    <?= label('E-mail', $this, $user) ?>
                                        <input tabIndex="6" type="text" style = "text-transform: lowercase" name="email" id="email" class="form-control">
                                    </div>
                                
                                <br>
                                <div class="">
                                <label id = "univ">Type Of Enquiry</label>
                                    <select tabIndex="9"  name="type" id="type" class="form-control">


                                    </select>
                                </div>
                                
                                <br>
                                <div class="">
                                    <?= label('Remarks', $this, $user) ?>
                                    <textarea tabIndex="11"  name="remarks" id="remarks" class="form-control"></textarea>
                                    </select>
                                </div>  
                                <div id = "gstno" class="">
                                    <?= label('GST NO:', $this, $user) ?>
                                    <input tabIndex="12" type="text" name="gst" value = "" id="gst" data-validation="required" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-6"> 
                            </div>
                            <div class="col-12 col-md-4 col-lg-6"> 
                            </div>
                        </div>
                    </div> 
                    <?php
                    if($type != 'view'){ 
                    ?>
                    <div class="box-footer">
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div> 
        </div>
    </section>
</form>

<div class="modal fade bd-example-modal-lg" id="myModalPop_cus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-body" id="modal-body"> 
            </div> 
            <div class="modal-footer">
                <button type="button" id="mcb" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="m_itemClick" popup_type="item" class="btn btn-primary">Save changes</button>
            </div>
        </div> 
    </div>
</div>

<script type="text/javascript">

    load();
    function   additem(name, productid, price) {
        
        $('#productid').val('');
        $('#product').val('');
        $("#price").val('');
        var newrow = "<tr><td><input value=" + productid + " type='hidden' name='product_id[]' ><input disabled class='form-control' type='text' value='" + name + "'></td>" +
                '<td><input type="text" class="form-control subtot" value=' + price + ' name="item_price[]">' +
                '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign remove"></span>     </span></td></tr>';
        $('#addrow').append(newrow);
        calcrow();
        
    }
    function calcrow() {
        var total = 0;
        $(".subtot").each(function () {
            var stval = parseFloat($(this).val());
            total = parseFloat(stval) + parseFloat(total);

        });

        $('.grdtot').val(total.toFixed(2));
    }


        
    
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }


    $("#companyName").autocomplete({
                source: "<?php echo base_url(); ?>crm_new/Enquiry_register/company", // path to the get_birds method
                minLength: 2,
                select: function (event, ui) {
                    $.ajax({
                        url: "<?php echo site_url('crm_new/Enquiry_register/companyName'); ?>/",
                        success: function (results) {
                            $("#user").html("type: " + results);
                        }
                    });
                }
            });

            $(document).ready(function() {
                var crmtype = $("#crmtype").val();

                if(crmtype == "COURSE_CRM"){
                    $("#qualify").text("Qualification");    
                    $("#name").text("Full Name");
                    $("#phone").text("Phone");
                    $('#univ').text('University');
                    $('#gstno').hide();
                    $('#serv').hide();
                }
                else{
                    $('#cour').hide();
                    $('#qualy').hide();
                }
 
                typeFind(2);
            }); 
                $("#type").change(function(){
                var type = $("#type option:selected").text();
                var typeid = $("#type option:selected").val();
                $("#changed").text(type);
                typeFind(typeid);
                
            });
            function typeFind(typeid = 2){

                $("#product").autocomplete({
                    
                    source: "<?php echo base_url(); ?>crm_new/Enquiry_register/product/" + typeid, // path to the get_birds method
                    minLength: 1,
                    select: function (event, ui) {5
                    $("#productid").val(ui.item.id);
                    }
                });
            }


    function load() {

        
        

        var id = $("#id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('crm_new/Enquiry_allocation/otheritem'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, product) {
                        additem(product.name, product.id, product.price);
                    });
                }
            });

            

            $(document).on('click', ".remove", function () {
                $('.tooltip').remove();
                $(this).closest('tr').remove();
                calcrow();
            }); 
            $.ajax({
                url: "<?php echo site_url('crm_new/Enquiry_register/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#companyName").val(result.companyName);
                    $("#contactPerson").val(result.contactPerson);
                    $("#contactNumber").val(result.contactNumber);
                    $("#user").val(result.user);
                    $("#date").val(formatDate(result.date));
                    $("#email").val(result.email);
                    $("#adress").val(result.adress);
                    $("#type").val(result.type);
                    setCourse(result.course, result.type);
                    $("#location").val(result.location);
                    $("#remarks").val(result.remarks);
                    $("#gst").val(result.gst);
                    $("#source_id").val(result.source);
                    $('input:radio[name="qual"]').filter('[value="'+result.route+'"]').attr('checked', true);
                }
            });

           
        }
        $('#addmore').click(function () {
            var name = $("#product").val();
            var productid = $("#productid").val();
            var price = $("#price").val();
            if (productid !== '' && price !== "") {
                additem(name, productid, price);
            }
        });
        
        
    }
    $.ajax({
        url: "<?php echo site_url('ajaxcall/states'); ?>",
        success: function (result) {
            $('#location').html(result);
            load();
        }
    });
    $.ajax({
        url: "<?php echo site_url('crm_new/Enquiry_register/user'); ?>",
        success: function (result) {
            $('#user').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('crm_new/Enquiry_register/source'); ?>",
        success: function (result) {
            $('#source_id').html(result);
            
        }
    });

$(document).ready(function(){
    var crmtype = $("#crmtype").val();

        $(document).ready(function(){
            $("#m_itemClick").bind("click", function () {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
            });
        })

        $(".myModalPop_cus").click(function () {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    // $('.box-header').remove();
                    $('.box-p').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop_cus').modal();
                    $('#is_model').val(1);
                    //$('.popuphide').hide();
                }
            });
        });

        $("#m_itemClick").click(function(){
        $("#myModalPop_cus").modal('hide');
        });
    
    if(crmtype == 'CRM'){
        $('#r').remove();
        var text = "";
        $.ajax({ 
            url: "<?php echo site_url('crm_new/Enquiry_allocation/getItemTypes'); ?>",
            success: function (results) {
                text = textForUniv + '<option value = "0">--Select--</option>';
                $.each(JSON.parse(results), function(i, items){
                    text = text + '<option value = "'+items.id+'">'+items.name+'</option>';             
                });
                $('#type').append(text);
                    
            }
        });
        

    }

    if(crmtype == 'COURSE_CRM'){

    var textForUniv = "";
    $.ajax({
        url: "<?php echo site_url('education/Course/getUniversity'); ?>",
        success: function (results) {
            textForUniv = textForUniv + '<option value = "0">--Select--</option>';
            $.each(JSON.parse(results), function(i, items){
                textForUniv = textForUniv + '<option value = "'+items.id+'">'+items.name+'</option>';   
            });
            $('#type').append(textForUniv);   
        }
    });


        var course = "";

        // var univ = 1;
        $(document).ready(function(){

            $("#m_itemClick").bind("click", function () {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
        });
        // getcources(1);

        })
        $('#type').change(function(){
        var univ = $("#type option:selected").val();
        getcources(univ);
        });

        $(".myModalPop_cus").click(function () {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    // $('.box-header').remove();
                    $('.box-p').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop_cus').modal();
                    $('#is_model').val(1);
                    //$('.popuphide').hide();
                }
            });
        });

        $("#m_itemClick").click(function(){
        $("#myModalPop_cus").modal('hide');
    });



        function getcources(unid){

        $.ajax({
        url: "<?php echo site_url('education/Student/getcourse'); ?>/" + unid,
        success: function(result){
            var  course ='<option>--Select--</option>';
            $.each(JSON.parse(result), function(i, items){
                course = course +  '<option value = "'+items.id+'">'+items.name+'</option>'
            });
            $('#course').html(course);

        }
        });

        }

        }

});

$.ajax({
            url: "<?php echo site_url('master/amaster/states'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.StateID + '"> ' + itemsingle.StateName + '</option>';
                });
                $("#states_cus").html(option);
                // if (is_select === 1) {
                //     var myVal = $('#states_cus option:last').val();
                //     $('#states_cus').val(myVal);
                // }
            }
        });
    
function setCourse(cid = 0, unid = 0){

$.ajax({
url: "<?php echo site_url('education/Student/getcourse'); ?>/" + unid,
success: function(result){
    var course ='<option value = "">Select</option>';
    $.each(JSON.parse(result), function(i, items){
        if(items.id == cid){
                    course = course + '<option selected = "selected" value = "'+items.id+'">'+items.name+'</option>';
                }
                else{
                    course = course + '<option value = "'+items.id+'">'+items.name+'</option>';
                }
    });
    $('#course').html(course);

}
});

}
    
    

    
    
</script>



