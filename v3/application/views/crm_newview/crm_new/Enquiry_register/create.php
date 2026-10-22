<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('crm_new/Enquiry_register/list_all'); ?>" action="<?php echo site_url('crm_new/Enquiry_allocation/save'); ?>" >
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/>
    <section class="content"> 
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Enquiry Register', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('crm_new/Enquiry_allocation/list_all'); ?>"> 
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row"> 
                            <div class="col-12 col-md-3 col-lg-4"> 
                                <div class="">
                                    <?= label('Date', $this, $user) ?>
                                    <input name="date" id="date" type="text" class="form-control date">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Company Name', $this, $user) ?>
                                    <input type="hidden" id="companyid" name="companyid"  data-validation="required"> 
                                    <input type="text" name="companyName" id="companyName" data-validation="required" class="form-control">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Address', $this, $user) ?>
                                    <textarea  class="form-control" data-validation="required"  name="adress" id="adress"  ></textarea>
                                </div>
                                <br>
                                <div class="">
                                    <table class="table table-striped table-condensed" style="width: 100%">
                                        <tr>
                                            <td >Product</td>
                                            <td >Price</td>
                                        </tr>
                                        <tr>
                                            <td><input type="hidden" id="productid" name="productid"><input  type="text" name="product"  id="product"  ></td>
                                            <td><input type="text" id="price" name="price" class="form-control"/></td>
                                            <td> <a data-toggle="tooltip" style="float: left"
                                                    title="Add More" id="addmore" class="btn btn-success"
                                                    href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                </a></td>
                                        </tr>
                                        <tbody id='addrow'>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4"> 
                                <div class="">
                                    <?= label('Contact Person', $this, $user) ?>
                                    <input type="text" name="contactPerson" id="contactPerson" data-validation="required" class="form-control">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Contact Number', $this, $user) ?>
                                    <input type="text" name="contactNumber" id="contactNumber" data-validation="required" class="form-control">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Email-Id', $this, $user) ?>
                                    <input type="text" name="email" id="email" style = "text-transform: lowercase" data-validation="required" class="form-control">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Exicutive Name', $this, $user) ?>
                                    <select  name="user" id="user"  class="form-control">
                                        <option value="">Select</option>
                                        <option value="product">Admin</option>
                                        <option value="solution">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4"> 
                                <div class="">
                                    <?= label('Source of Enquiry', $this, $user) ?>
                                    <select  name="source_id" id="source_id"  class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>
                            </div> 
                            <div class="col-12 col-md-4 col-lg-4"> 
                                <div class="">
                                    <?= label('Type Of Enquiry', $this, $user) ?>
                                    <select  name="type" id="type"  data-validation="required" class="form-control">
                                        <option >Select</option>
                                        <option value="Service">Service</option>
                                        <option value="goods">goods</option>

                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Location', $this, $user) ?>
                                    <select  name="location" id="location" data-validation="required" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Remarks', $this, $user) ?>
                                    <textarea  name="remarks" id="remarks" data-validation="required" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <?= label('GST NO:', $this, $user) ?>
                                    <input type="text" name="gst" id="gst" data-validation="required" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-6"> 

                            </div>
                            <div class="col-12 col-md-4 col-lg-6"> 

                            </div>

                        </div>

                    </div> 
                    <div class="box-footer">
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
                </div>
            </div> 
        </div>
    </section>
</form>

<script type="text/javascript">
    
    load();
    function   additem(name, productid, price) {
        $('#productid').val('');
        $('#product').val('');
        $("#price").val('');
        var newrow = "<tr><td><input value=" + productid + " type='hidden' name='product_id[]' ><input disabled class='form-control' type='text' value='" + name + "'></td>" +
                '<td><input type="text" class="form-control" value=' + price + ' name="item_price[]">' +
                '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
        $('#addrow').append(newrow);

    }

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function load() {
       
        $.ajax({
            url: "<?php echo site_url('crm_new/Enquiry_register/user'); ?>",
            success: function (result) {
                $('#user').html(result);
            }
        });
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
        $("#product").autocomplete({
            source: "<?php echo base_url(); ?>crm_new/Enquiry_register/product", // path to the get_birds method
            minLength: 1,
            select: function (event, ui) {
                $("#productid").val(ui.item.id);
//                $.ajax({
//                    url: "<?php echo site_url('crm_new/Enquiry_register/product'); ?>/",
//                    success: function (results) {
//                    }
//                });
            }
        });
        $('#addmore').click(function () {
            var name = $("#product").val();
            var productid = $("#productid").val();
            var price = $("#price").val();
            if (productid !== '' && price !== "") {
                additem(name, productid, price);
            }
        });
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
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
                $("#location").val(result.location);
                $("#remarks").val(result.remarks);
                $("#gst").val(result.gst);
                $("#source_id").val(result.source);

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
            url: "<?php echo site_url('crm_new/Enquiry_register/source'); ?>",
            success: function (result) {
                $('#source_id').html(result);
            }
        });
        var id = $("#id").val();
        $.ajax({
            url: "<?php echo site_url('crm_new/Enquiry_allocation/otheritem'); ?>/" + id,
            success: function (result) {
                $.each(JSON.parse(result), function (i, product) {
                    additem(product.name, product.id, product.price);
                });
            }
        });
</script>



