<div class="<?=$this->box_color?>">

    <div class="box-header">
        <h3 class="box-title">Enquiry</h3>
        <span class="pull-right">
            <a role="button" class="btn  btn-info align-bottom" href="<?php echo site_url('crm\crm\listall'); ?>" title="cancel">
                <span class="glyphicon glyphicon-arrow-left"></span> 
            </a>
        </span>
    </div>
</div>
<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post"  id="frmcreate" back="<?php echo site_url('crm/crm/listall'); ?>" action="<?php echo site_url('crm/crm/save/'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 

    <section class="content"> 
        <div class="row"> 
            <div class="col-xs-12">
                <div class="nav-tabs-custom">

                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="mainSale"> 
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-1">Date :</td>
                                        <td><input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date"></td>
                                        <td >Next follow-up date :</td>
                                        <td><input name="fdate" type="text" id="fdate" data-validation="required" class="form-control hunpx date" placeholder="Date"></td>
                                        <td >In-time:</td>
                                        <td><input name="itime" type="text" id="itime" data-validation="required" class="form-control hunpx date" placeholder="Date"></td>
                                        <td >Out-time :</td>
                                        <td><input name="otime" type="text" id="otime" data-validation="required" class="form-control hunpx date" placeholder="Date"></td>


                                        <td>Customer   <button type="button" url="<?php echo base_url(); ?>masters/customers/add"  class="btn btn-primary myModalPop">
                                                New
                                            </button>
                                        </td>

                                    </tr>

                                </table>

                                <style>
                                    .span {
                                        font-size: 18px;
                                        font-weight: 600;  
                                        padding-right: 15px;
                                        padding-left: 15px;
                                    }
                                </style>
                                <table class="table table-striped table-condensed" >
                                    <!--  <tr> 
                                        <td class="text-right text-center FontDouble" colspan="7">Total</td>
                                        <td><input type="text"  id="total" name="subtot" readonly="readonly" class="form-control col-lg-1 text-right" placeholder="Total"></td>
                                        <td></td>
                                    </tr> -->
                                    <tr>
                                        <td></td>
                                        <td>Company name *</td>
                                        <td>Location</td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <!-- <td><input name="coname"  id="coname"   type="text" NoTab="true" data-validation="required,length" data-validation-length="min2" class="tatalcal text-left col-lg-1 form-control" placeholder="Company name"  ></td> -->
                                        <td><input data-validation="required" type="hidden" name="customer_id" id="customer_id"/>
                                            <input name="coname" id="coname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
                                        <td><input name="location" data-validation="required" id="location" placeholder="Location"   type="text" class="tatalcal text-left col-lg-1 form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Contact person</td>
                                        <td>Address</td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input name="contact_person" id="contact_person" placeholder="Contact person"   type="text" class="tatalcal text-left col-lg-1 form-control" ></td>
                                        <td><input name="address" id="address" placeholder="Address"   type="text" class="tatalcal text-left col-lg-1 form-control" ></td>

                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Contact no</td>
                                        <td>Nature of business</td>

                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><input name="phone" id="phone" placeholder="phone"   type="phone" class="tatalcal text-left col-lg-1 form-control" ></td>
                                        <td><select tabindex="-1"   name="business" id="business" class="form-control col-lg-1" >
                                                <?php foreach ($btype as $type) { ?>
                                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                                <?php } ?>
                                            </select></td>
                                    </tr>


                                    <tr>
                                        <td></td>
                                        <td>Email</td>
                                        <td>Source of enquiry</td>

                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><input name="email" id="email" placeholder="email"   type="email" class="tatalcal text-left col-lg-1 form-control" ></td>
                                        <td>
                                            <select tabindex="-1"   name="source" id="source" class="form-control col-lg-1">
                                                <?php foreach ($enquiry as $type) { ?>
                                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                                <?php } ?>
                                            </select></td>

                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Remarks</td>
                                        <td>Product</td>

                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><input name="remarks" id="remarks" placeholder="remarks"   type="text" class="tatalcal text-left col-lg-1 form-control" ></td>
                                        <td><select tabindex="-1" name="product"  id="product" class="form-control col-lg-1" >
                                                <?php foreach ($product as $type) { ?>
                                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                                <?php } ?>
                                            </select></td>

                                    </tr>


                                </table>

                            </div>
                            <?php if ($view != "view") {
                                ?>

                                <div class="box-footer"> 

                                    <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button> 

                                    <div class='small-loading' id='FormLoading'> </div>  



                                </div>
                            <?php } ?>

                            <div class=" hidden">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                        </div>
                        <!-- /#fa-icons -->


                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <input name="advance" id="advance" placeholder="Advance"   type="hidden"class="tatalcal text-right col-lg-1 form-control" > 

    <script type="text/javascript">
        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                    year = datePart[0].substring(2), // get only two digits
                    month = datePart[1], day = datePart[2];

            return day + '/' + month + '/' + year;
        }


        $(document).ready(function () {
            load();
            var frmcreate = 1;
        });


        /*
         * this is for edit
         * 
         */
        function loadCust(ui) {
            $('#coname').val(ui.item.name);
            $('#customer_id').val(ui.item.id);
            $('#contact_person').val(ui.item.contact_person);
            $('#phone').val(ui.item.phone);
            $('#email').val(ui.item.email);
            $('#remarks').val(ui.item.details);
            $('#address').val(ui.item.address);
        }


        function load() {
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('crm/crm/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $('#customer_id').val(result.coid);
                        $("#coname").val(result.co_name);
                        $("#date").val(formatDate(result.date));
                        $("#location").val(result.location);
                        $("#contact_person").val(result.contact);
                        $("#address").val(result.address);
                        $("#email").val(result.email);
                        $("#phone").val(result.phone);
                        var prdid = result.productid;
                        var product = result.product;
                        var srcid = result.sourceid;
                        var source = result.source;
                        var busnsid = result.busnsid;
                        var business = result.business;
                        $("#product").val(prdid);
                        $("#source").val(srcid);
                        $("#business").val(busnsid);
                        $("#remarks").val(result.remarks);
                        $("#fdate").val(formatDate(result.follow_date));
                        $("#itime").val(formatDate(result.in_time));
                        $("#otime").val(formatDate(result.out_time));

                    }
                });
            }
        }

        $("#coname").autocomplete({
            source: "<?php echo site_url('crm/crm/crm_customer'); ?>",
            minLength: 1,
            select: function (event, ui) {
                loadCust(ui);

            }
        });



        /*  $("#coname").autoComplete({
      
         minChars:2,
      
         source: function(term, response){
      
         try { xhr.abort(); } catch(e){}
         xhr =  $.getJSON('http://localhost/dims/crm/crm/crm_customer?', { term: term }, function(data){ response(data); });
         },
         renderItem: function (item, search){
      
         search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
         var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
         return '<div class="autocomplete-suggestion" data-val="'+item.label+'"  data-id="'+item.id+'"    data-contact="'+item.contact_person+'"  data-val="'+search+'" data-phone="'+item.phone+'" data-email="'+item.email+'" data-address="'+item.address+'"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
         },
         onSelect: function(e, term, item){
         var  id=item.data('id');
         var  contact=item.data('contact');
         var  email=item.data('email');
      
         CustomerSelect(contact,email);
      
      
         }
         });*/

        /* function showbtn(id) {
         if (id === 0) {
         $('#form-button-save').attr('disabled', 'disabled');
         } else
         {
         if (items.length === 0) {
         $('#form-button-save').attr('disabled', 'disabled');
         } else {
         $('#form-button-save').removeAttr('disabled');
         }
         }
         }
      
         showbtn(1);
      
         $("#form-button-save").click(function () {
         showbtn(0);
         if (frmcreate === 0) {
         var ms = $("#frmcreate").isValid();
         if (ms === true) {
      
         formsubmit($("#frmcreate"))
         } else
         {
         showbtn(0);
         return;
         }
         }
         frmcreate = 1;
         })*/


        /* function CustomerSelect(Contact,email)
         {
         console.log(contact+"  -- "+email);
      
         //showbtn(0);
      
         $("#contact_person").val(contact);
         $('#email').val(email);
         //$('#name').val(name);
      
         }*/
    </script> 