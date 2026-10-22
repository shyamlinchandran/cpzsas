<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post"  id="frmcreate" back="<?php echo site_url('crm/crm/listall'); ?>" action="<?php echo site_url('crm/crm/save/'); ?>"  class="form-horizontal">    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?= label('Enquiry', $this, $user) ?>
                        </h3>
                        <span class="pull-right">
                            <a role="button" class="btn  btn-info align-bottom" href="<?php echo site_url('crm\crm\listall'); ?>" title="cancel">
                                <span class="glyphicon glyphicon-arrow-left"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Date', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date">             
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Follow-up date', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="fdate" type="text" id="fdate" data-validation="required" class="form-control hunpx date" placeholder="Date">
                                </div>
                            </div>   
                        </div>
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label">
                                    <?= label('In-time', $this, $user) ?>  :
                                </label>
                                <div class="col-sm-8">
                                    <input name="itime" type="text" id="itime" data-validation="required" class="form-control hunpx date" placeholder="Date">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Out-time', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="otime" type="text" id="otime" data-validation="required" class="form-control hunpx date" placeholder="Date">              
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Company name', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input data-validation="required" type="hidden" name="customer_id" id="customer_id"/>
                                    <input name="coname" id="coname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer">                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Location', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="location" data-validation="required" id="location" placeholder="Location"   type="text" class="tatalcal text-left col-lg-1 form-control" >
                                </div>
                            </div>   
                        </div>
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Contact person', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="contact_person" id="contact_person" placeholder="Contact person"   type="text" class="tatalcal text-left col-lg-1 form-control" >    
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Address', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="address" id="address" placeholder="Address"   type="text" class="tatalcal text-left col-lg-1 form-control" >
                                </div>
                            </div>   
                        </div>
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Contact no', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="phone" id="phone" placeholder="phone"   type="phone" class="tatalcal text-left col-lg-1 form-control" >   
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Nature of business', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <select tabindex="-1"   name="business" id="business" class="form-control col-lg-1" >
                                        <?php foreach ($btype as $type) { ?>
                                            <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>   
                        </div>
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Email', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="email" id="email" placeholder="email"   type="email" class="tatalcal text-left col-lg-1 form-control" >  
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Enquiry Source', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <select tabindex="-1"   name="source" id="source" class="form-control col-lg-1">
                                        <?php foreach ($enquiry as $type) { ?>
                                            <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>   
                        </div>
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Remarks', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input name="remarks" id="remarks" placeholder="remarks"   type="text" class="tatalcal text-left col-lg-1 form-control" >  
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Product', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <select tabindex="-1" name="product"  id="product" class="form-control col-lg-1" >
                                        <?php foreach ($product as $type) { ?>
                                            <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>   
                        </div>

                        <div class="form-group" >
                        </div> 
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </section>
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
    </script>
