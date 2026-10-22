<?php
$is_field = 0;
if(isset($settings[0]['is_student'])){
	
	$is_field = $settings[0]['is_student'];
}
?>
<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('crm_general/Leads_master/listall'); ?>" action="<?php echo site_url('crm_general/Enquiry_allocation/save'); ?>">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
    <input type="hidden" value="<?php echo $logged; ?>" name="loggedid" id="loggedid" />
    <input type="hidden" value="<?php echo $leads; ?>" name="isLead" id="isLead" />

    <input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Leads Creation', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('crm_general/Leads_master/listall'); ?>">
                                <span class="remove glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-4">

                                <div class="">
                                    <?= label('Date', $this, $user) ?>
                                    <input tabIndex="2" name="date" id="date" type="text" class="form-control date">
                                </div>
                                <br>

                                <div class="">
                                    <?php if ($is_field < 1) { ?>
                                        <?= label('Company Name', $this, $user) ?>
                                    <?php } else { ?>
                                        <?= label('Student Qualification', $this, $user) ?>

                                    <?php } ?>
                                    <input type="hidden" id="companyid" name="companyid" data-validation="required">
                                    <input tabIndex="3" type="text" name="companyName" id="companyName" data-validation="required" class="form-control">
                                </div>
                                <br>

                                <div class="">
                                    <?= label('Address', $this, $user) ?>
                                    <textarea tabIndex="4" class="form-control" name="adress" id="adress"></textarea>
                                </div>
                                <br>
                                <div id="gstno" class="">
                                    <?= label('GST NO:', $this, $user) ?>
                                    <input tabIndex="5" type="text" name="gst" value="" id="gst" class="form-control">
                                </div>
                                <br>

                            </div>

                            <div class="col-12 col-md-4 col-lg-4">

                            <div class="">
                                    <?php if ($is_field < 1) { ?>
                                        <?= label('Contact Person', $this, $user) ?>
                                    <?php } else { ?>
                                        <?= label('Student Name', $this, $user) ?>
                                    <?php } ?>

                                    <input tabIndex="5" type="text" name="contactPerson" id="contactPerson" data-validation="required" class="form-control">
                                </div>
                                <br>

                                <div class="">
                                    <?= label('Contact Number', $this, $user) ?>
                                    <input tabIndex="6" type="text" name="contactNumber" id="contactNumber" data-validation="required number" maxlength="10" minlength="10" class="form-control">
                                </div>
                                <br>

                                 <div class="">
                                  <?= label('E-mail', $this, $user) ?>
                                    <input tabIndex="10" type="text" style="text-transform: lowercase" name="email" id="email" data-validation="email" data-validation-optional="true" class="form-control">
                                </div>
                                <br>
                                <div class="">
                                    <label id="exename">Executive Name</label>
                                    <select tabIndex="11" name="user" id="user" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>
                                <?php if($settings[0]['State']) {?>  

                                 <div class="col-12">
                                    <label class="">
                                        <?= label('State', $this, $user) ?> <span class="required"></span> :
                                    </label>
                                    <div class="">
                                        <div class="input-group input-group-sm">
                                            <select tabindex="7" name="states_cus" id="states_cus" class="form-control">
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
                                 <?php }  ?> 
                            </div>


                            <div class="col-12 col-md-4 col-lg-4">
                            <?php if($settings[0]['Source_Of_Enquiry']) {?>  

                                <div class="">
                                    <?= label('Source of Enquiry', $this, $user) ?>
                                    <select tabIndex="9" name="source_id" id="source_id" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>
                            </div>
                            <?php }  ?> 

                            <div class="col-12 col-md-4 col-lg-4">

                            <?php if($settings[0]['Area']) {?>  

                            <div class="">
                                    <div class="">
                                        <?= label('Area', $this, $user) ?>
                                        <select tabIndex="9" name="area" id="area" class="form-control">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                    <br>
                            <?php }  ?> 
                               <?php if($settings[0]['Nature_of_bussiness']) {?>  

                                    <div class="">
                                        <?= label('Nature of Bussiness', $this, $user) ?>
                                        <select tabIndex="9" name="unbuss" id="unbuss" class="form-control">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                    <br>
                                    <?php }  ?> 

                                </div>
                                <br> 
                                <?php if($settings[0]['Type_of_Bussiness']) {?>  

                                <div class="">
                                    <?= label('Type of Bussiness', $this, $user) ?>
                                    <select tabIndex="12" name="typebuss" id="typebuss" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>
                                <?php }  ?> 

                                <div class="">
                                    <?= label('Remarks', $this, $user) ?>
                                    <textarea tabIndex="13" name="remarks" id="remarks" class="form-control"></textarea>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12 col-md-4 col-lg-6">
                            </div>
                            <div class="col-12 col-md-4 col-lg-6">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                    </div>
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
    $(document).ready(function() {

        setarea();
        setnatureof();
        setstate();
        settypeof();

        var logged = $('#loggedid').val();
        setUser(logged);

        var master = $('#master').val();
        masters(master);
        $('#master').change(function() {
            master = $('#master').val();
            $('#companyName').val('');
            $("#adress").val('');
            $("#contactPerson").val('');
            $("#contactNumber").val('');
            masters(master);
        });

    });

    function masters(masters) {
        $("#companyName").autocomplete({
            source: "<?php echo base_url(); ?>crm_general/Enquiry_allocation/getcompanydet/" + masters, // path to the get_birds method
            minLength: 1,
            select: function(event, ui) {
                $("#companyName").val(ui.item.id);
                $("#adress").val(ui.item.adress);
                $("#contactPerson").val(ui.item.contactPerson);
                $("#contactNumber").val(ui.item.contactNumber);
            }
        });
    }

    var crmtype = $("#crmtype").val();

    // load();
    function additem(name, productid, quantity, price) {

        $('#productid').val('');
        $('#product').val('');
        $('#quantity').val('');
        $("#price").val('');
        var newrow = "<tr><td><input value=" + productid + " type='hidden' name='product_id[]' ><input disabled class='form-control' type='text' value='" + name + "'></td>" +
            '<td><input type="text" class="form-control" value=' + quantity + ' name="item_quantity[]">' +
            '<td><input type="text" class="form-control subtot" value=' + price + ' name="item_price[]">' +
            '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign remove"></span> </span></td></tr>';
        $('#addrow').append(newrow);
        calcrow();

    }

    function calcrow() {
        var total = 0;
        $(".subtot").each(function() {
            var stval = parseFloat($(this).val());
            total = parseFloat(stval) + parseFloat(total);

        });

        $('.grdtot').val(total.toFixed(2));
    }




    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1],
            day = datePart[2];

        return day + '/' + month + '/' + year;
    }




    $(document).ready(function() {


        if (crmtype == "COURSE_CRM") {
            $("#qualify").text("Qualification");
            $("#name").text("Full Name");
            $("#phone").text("Phone");
            $('#univ').text('University');
            $('#gstno').hide();
            $('#serv').hide();
        } else {
            $('#cour').hide();
            $('#qualy').hide();
        }

        typeFind(2);
    });
    $("#type").change(function() {
        $('#product').val('');
        var type = $("#type option:selected").text();
        var typeid = $("#type option:selected").val();
        $("#changed").text(type);
        typeFind(typeid);

    });

    function typeFind(typeid = 2) {

        $("#product").autocomplete({

            source: "<?php echo base_url(); ?>crm_general/Enquiry_register/product/" + typeid, // path to the get_birds method
            minLength: 1,
            select: function(event, ui) {
                $("#productid").val(ui.item.id);
                $("#price").val(ui.item.rate);
            }
        });
    }

    var id = $("#id").val();
    if (id > 0) {
        $.ajax({
            url: "<?php echo site_url('crm_general/Enquiry_allocation/otheritem'); ?>/" + id,
            success: function(result) {
                $.each(JSON.parse(result), function(i, product) {
                    additem(product.name, product.id, product.quantity, product.price);
                });
            }
        });


        $.ajax({
            url: "<?php echo site_url('crm_general/Enquiry_register/getsing'); ?>/" + id,
            type: 'POST',
            data: {
                isLead: $('#isLead').val(),
            },
            success: function(results) {
                var result = JSON.parse(results);
                $("#companyName").val(result.companyName);
                $("#contactPerson").val(result.contactPerson);
                $("#contactNumber").val(result.contactNumber);
                $("#user").val(result.user);
                $("#date").val(formatDate(result.date));
                $("#email").val(result.email);
                $("#adress").val(result.adress);
                $("#location").val(result.location);
                $("#remarks").val(result.remarks);
                $("#gst").val(result.gst);
                $("#source_id").val(result.source);
                setstate(result.location);
                settypeof(result.typebuss);
                setnatureof(result.unbuss);
                setarea(result.area);
            }
        });


    }

    $(document).on('click', ".remove", function() {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
        calcrow();
    });

    $('#addmore').click(function() {
        var name = $("#product").val();
        var productid = $("#productid").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        if (productid !== '' && price !== "" && quantity !== "") {
            additem(name, productid, quantity, price);
        }
    });


    // }
    $.ajax({
        url: "<?php echo site_url('ajaxcall/states'); ?>",
        success: function(result) {
            $('#location').html(result);
        }
    });

    $.ajax({
        url: "<?php echo site_url('crm_general/Enquiry_register/source'); ?>",
        success: function(result) {
            $('#source_id').html(result);
        }
    });

    $(document).ready(function() {
        var crmtype = $("#crmtype").val();

        $(document).ready(function() {
            $("#m_itemClick").bind("click", function() {
                ismodel = true;
                popup_type = $(this).attr('popup_type');
                $('#crudForm').trigger('submit');
            });
        })

        $(".myModalPop_cus").click(function() {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function(result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    $('.box-p').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop_cus').modal();
                    $('#is_model').val(1);
                }
            });
        });

        $("#m_itemClick").click(function() {
            $("#myModalPop_cus").modal('hide');
        });

        if (crmtype == 'CRM') {
            $('#r').remove();
            var text = "";
            $.ajax({
                url: "<?php echo site_url('crm_general/Enquiry_allocation/getItemTypes'); ?>",
                success: function(results) {
                    text = textForUniv + '<option value = "0">--Select--</option>';
                    $.each(JSON.parse(results), function(i, items) {
                        text = text + '<option value = "' + items.id + '">' + items.name + '</option>';
                    });
                    $('#type').append(text);

                }
            });


        }

        if (crmtype == 'COURSE_CRM') {

            var textForUniv = "";
            $.ajax({
                url: "<?php echo site_url('education/Course/getUniversity'); ?>",
                success: function(results) {
                    textForUniv = textForUniv + '<option value = "0">--Select--</option>';
                    $.each(JSON.parse(results), function(i, items) {
                        textForUniv = textForUniv + '<option value = "' + items.id + '">' + items.name + '</option>';
                    });
                    $('#type').append(textForUniv);
                }
            });


            var course = "";

            $(document).ready(function() {

                $("#m_itemClick").bind("click", function() {
                    ismodel = true;
                    popup_type = $(this).attr('popup_type');
                    $('#crudForm').trigger('submit');
                });
            })
            $('#type').change(function() {

                var univ = $("#type option:selected").val();
                getcources(univ);
            });

            $(".myModalPop_cus").click(function() {
                var opt = $(this).attr('opt');
                $("#m_itemClick").attr('opt', opt);
                $.ajax({
                    url: $(this).attr('url'),
                    success: function(result) {
                        $('#modal-body').html(result);
                        $('.crmc').removeClass();
                        $('.box-p').removeClass('box');
                        $('#cfooter').hide();
                        $('.createheader').hide();
                        $('#myModalPop_cus').modal();
                        $('#is_model').val(1);
                    }
                });
            });

            $("#m_itemClick").click(function() {
                $("#myModalPop_cus").modal('hide');
            });



            function getcources(unid) {

                $.ajax({
                    url: "<?php echo site_url('education/Student/getcourse'); ?>/" + unid,
                    success: function(result) {
                        var course = '<option>--Select--</option>';
                        $.each(JSON.parse(result), function(i, items) {
                            course = course + '<option value = "' + items.id + '">' + items.name + '</option>'
                        });
                        $('#course').html(course);

                    }
                });

            }

        }

    });

    function setstate(state = 0){
        $.ajax({
        url: "<?php echo site_url('master/amaster/states'); ?>/",
        async: false,
        success: function(result) {
            var option = '';
            $.each(JSON.parse(result), function(i, itemsingle) {
                if (itemsingle.StateID == state) {
                        option = option + '<option selected = "selected" value ="' + itemsingle.StateID + '"> ' + itemsingle.StateName + '</option>';
                    } else {
                        option = option + '<option value ="' + itemsingle.StateID + '"> ' + itemsingle.StateName + '</option>';
                    }
            });
            $("#states_cus").html(option);
        }
    });
    }

    $.ajax({
        url: "<?php echo site_url('crm_general/Leads_master/getArea'); ?>",
        async: false,
        success: function(result) {
            var option = '<option>--Select--</option>';
            $.each(JSON.parse(result), function(i, itemsingle) {
                option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.area + '</option>';
            });
            $("#area").html(option);
        }
    });

    function setUser(logged) {

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

    $.ajax({
        url: "<?php echo site_url('crm_general/Leads_master/getAllBussType'); ?>",
        async: false,
        success: function(result) {
            var option = '<option>--Select--</option>';
            $.each(JSON.parse(result), function(i, itemsingle) {
                option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.type + '</option>';
            });
            $("#typebuss").html(option);
        }
    });
    $.ajax({
        url: "<?php echo site_url('crm_general/Enquiry_allocation/getAllBussOther'); ?>",
        async: false,
        success: function(result) {
            var option = '<option>--Select--</option>';
            $.each(JSON.parse(result), function(i, itemsingle) {
                option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.type + '</option>';
            });
            $("#unbuss").html(option);
        }
    });

    function settypeof(type = 0 ) {
        $.ajax({
            url: "<?php echo site_url('crm_general/Leads_master/getAllBussType'); ?>",
            async: false,
            success: function(result) {
                var option = '<option>--Select--</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    if (itemsingle.id == type) {
                        option = option + '<option selected = "selected" value ="' + itemsingle.id + '"> ' + itemsingle.type + '</option>';
                    } else {
                        option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.type + '</option>';
                    }
                    
                });
                $("#typebuss").html(option);
            }
        });
    }


    function setnatureof(nature = 0) {

        $.ajax({
            url: "<?php echo site_url('crm_general/Enquiry_allocation/getAllBussOther'); ?>",
            async: false,
            success: function(result) {
                var option = '<option>--Select--</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {

                    if (itemsingle.id == nature) {
                        option = option + '<option selected = "selected" value ="' + itemsingle.id + '"> ' + itemsingle.type + '</option>';
                    } else {
                        option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.type + '</option>';
                    }
                });
                $("#unbuss").html(option);
            }
        });
    }

    function setarea(area = 0) {
        $.ajax({
            url: "<?php echo site_url('crm_general/Leads_master/getArea'); ?>",
            async: false,
            success: function(result) {
                var option = '<option>--Select--</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    if (itemsingle.id == area) {
                        option = option + '<option selected = "selected" value ="' + itemsingle.id + '"> ' + itemsingle.area + '</option>';
                    } else {
                        option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.area + '</option>';
                    }
                    
                });
                $("#area").html(option);
            }
        });
    }
</script>