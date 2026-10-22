<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>" action="<?php echo site_url('crm_service/Enquiry_allocation/save'); ?>">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
    <input type="hidden" value="<?php echo $logged; ?>" name="loggedid" id="loggedid" />
    <input type="hidden" value="0" name="leadid" id="leadid" />
    <input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Create Service Call', $this, $user) ?></h3>
                        
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>"> 
                                <span class="glyphicon glyphicon-arrow-left" title="back">
                
                                </span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">

                                <div class="">
                                    <?= label('Date', $this, $user) ?>
                                    <input tabIndex="2" name="date" id="date" type="text" class="form-control date">
                                </div>
                                <br>

                                <div class="">
                                    <?= label('Type', $this, $user) ?>
                                    <select tabIndex="14" name="typess" id="typess" data-validation="required" class="form-control">
                                        <option value="1">Vehicle</option>
                                        <option value="2">Products</option>
                                        <option value="2">Service</option>

                                    </select>
                                </div>

                                <br>

                                <div class="">
                                    <label id="exename">Executive Name</label>
                                    <select tabIndex="11" name="user" id="user" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Amount', $this, $user) ?>
                                    <input tabIndex="2" name="amount_to_pay" id="amount_to_pay" type="text" class="form-control">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Remarks', $this, $user) ?>
                                    <textarea tabIndex="18" name="remarks" id="remarks" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>


                                 <div class="">
                                    <?= label('Reported Problems', $this, $user) ?>
                                    <textarea tabIndex="18" name="problems" id="problems" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>


                                 <div class="">
                                    <?= label('Observation', $this, $user) ?>
                                    <textarea tabIndex="18" name="observation" id="observation" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>


                                 <div class="">
                                    <?= label('Entry Remarks', $this, $user) ?>
                                    <textarea tabIndex="18" name="entryremarks" id="entryremarks" class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>

                            </div>

                            <div class="col-12 col-md-4 col-lg-3">

                                <div class="">
                                    <?= label('Customer Name', $this, $user) ?>
                                    <input type="hidden" id="customerid" name="customerid" data-validation="required">
                                    <input tabIndex="3" type="text" name="customerName" id="customerName" data-validation="required" class="form-control">
                                </div>
                                <br>

                                  <div class="">
                                    <?= label('Customer Phone', $this, $user) ?>
                                    <input tabIndex="3" type="text" name="cusphone" id="cusphone"  class="form-control">
                                </div>
                                <br>


                              

                                <div class="">
                                    <?= label('Customer Address', $this, $user) ?>
                                    <input tabIndex="3" type="text" name="cusaddress" id="cusaddress" class="form-control">
                                </div>
                                <br>


                                <div class="">
                                    <?= label('Item Name/No', $this, $user) ?>
                                    <input type="hidden" id="item_id" name="item_id" data-validation="required">
                                    <input tabIndex="3" type="text" name="item_name" id="item_name" notab="true" data-validation="required" class="form-control">
                                </div>
                                <br>

                                <div class="">
                                    <?= label('Model no', $this, $user) ?>
                                    <input tabIndex="3" type="text" name="model" id="model" notab="true"  class="form-control">
                                </div>
                                <br>


                                <div class="">
                                    <?= label('Serial/IMEI', $this, $user) ?>
                                    <input tabIndex="3" type="text" name="serial" id="serial" notab="true" class="form-control">
                                </div>
                                <br>


                                <div class="">
                                    <label id="exename">Allocated User</label>
                                    <select tabIndex="11" name="alloo_user" id="alloo_user" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Delivery Date', $this, $user) ?>
                                    <input tabIndex="2" name="deli_date" id="deli_date" type="text" class="form-control date">
                                </div>
                                <br>
                                <div class="">
                                    <?= label('Product Details', $this, $user) ?>
                                    <textarea tabIndex="18" name="prod_det" id="prod_det" readonly class="form-control"></textarea>
                                    </select>
                                </div>
                                <br>
                            </div>
                            <div class="col-12 col-md-4 col-lg-6">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">History</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="box-group" id="accordion1">

                                            <div class="panel box box-primary">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                                            Sales History
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne1" class="panel-collapse collapse in">
                                                    <div class="box-body">
                                                        <table class="table table-bordered table-striped" id="sale_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sl no</th>
                                                                    <th>Bill No</th>
                                                                    <th>Product</th>
                                                                    <th>Invoice Date</th>
                                                                    <th>Warranty period(in months)</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--box end  -->

                                     <!-- /.box-header -->
                                     <div class="box-body">
                                        <div class="box-group" id="accordion2">

                                            <div class="panel box box-primary">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2">
                                                            Service History
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne2" class="panel-collapse collapse in">
                                                    <div class="box-body">
                                                        <table class="table table-bordered table-striped" id="service_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sl no</th>
                                                                    <th>Product</th>
                                                                    <th>Service Date</th>
                                                                    <th>Allocated to</th>
                                                                    <th>Bill Date </th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--box end  -->

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




<!-- Modal -->


<script type="text/javascript">
    var table1;
    var tableid1 = 0;
    var table2;
    var tableid2 = 0;

    function service(type = '', itemid = '', customer = 0) {
        $.validate({
            modules: 'date, security,file'
        });
        if (tableid1 === 1) {
            table1.destroy();
        }
        tableid1 = 1;
        table1 = $('#service_table').DataTable({
            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
                // {
                //     extend: 'excel',
                //     text: '<span class="glyphicon glyphicon-download"></span>',
                //     className: 'btn btn-circle btn-primary',
                //     title: 'Dims Reports'
                // }
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_service/Enquiry_allocation/history_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.type = type;
                    data.customerid = customer;
                    data.itemid = itemid;
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });


    }

    function sale(type = '', itemid = '', customer = 0) {
        $.validate({
            modules: 'date, security,file'
        });
        if (tableid2 === 1) {
            table2.destroy();
        }
        tableid2 = 1;
        table2 = $('#sale_table').DataTable({
            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
                // {
                //     extend: 'excel',
                //     text: '<span class="glyphicon glyphicon-download"></span>',
                //     className: 'btn btn-circle btn-primary',
                //     title: 'Dims Reports'
                // }
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_service/Enquiry_allocation/sale_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.type = type;
                    data.customerid = customer;
                    data.itemid = itemid;
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });


    }
    
    $(document).ready(function() {
        service();
        sale();
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });



        var logged = $('#loggedid').val();

        var text = "";
        $.ajax({

            url: "<?php echo site_url('crm_service/Enquiry_register/users'); ?>",
            async: false,
            success: function(results) {
                text = '<option value = "">Select</option>';
                $.each(JSON.parse(results), function(i, items) {
                    text = text + '<option value = "' + items.Id + '">' + items.user_name + '</option>';
                });
                $('#user').html(text);
                $('#alloo_user').html(text);
            }
        });
        $('#user').val(logged);
        $('#alloo_user').val(logged);

        $("#customerName").autocomplete({
            source: "<?php echo base_url(); ?>crm_service/Enquiry_allocation/getcustomerdet/", // path to the get_birds method
            minLength: 1,
            select: function(event, ui) {
                var j = 0;
                $("#customerid").val(ui.item.id);
                $("#cusphone").val(ui.item.phone);
                $("#cusaddress").val(ui.item.address_line1);
                service('', '', ui.item.id);
                sale('', '', ui.item.id);



            }
        });

        $("#item_name").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url(); ?>crm_service/Enquiry_allocation/gettypedet/",
                    dataType: "json",
                    data: {
                        term: request.term,
                        type: $('#typess').val()
                    },
                    success: function(data) {
                        response(data);
                    }
                })
            },
            select: function(event, ui) {
                $("#item_id").val(ui.item.id);
                var cus_id = $("#customerid").val();
                if ($('#typess').val() == 1) {
                    $('#prod_det').val('Vehicle No : ' + ui.item.veh_no + ' \nVehicle Name : ' + ui.item.veh_name + ' \nModel : ' + ui.item.veh_model + ' \nBrand : ' + ui.item.veh_brand);
                    service(1, ui.item.id, cus_id);
                    sale(1, ui.item.id, cus_id);

                    $('#exename').focus();

                } else {
                    $('#prod_det').val('Prate : ' + ui.item.prate + ' \nSrate : ' + ui.item.srate + ' \nMRP : ' + ui.item.MRP + ' \nDescription : ' + ui.item.description);
                    service(2, ui.item.id, cus_id);
                    sale(2, ui.item.id, cus_id);




                }



            },
            minLength: 1,

        });

    });



    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1],
            day = datePart[2];

        return day + '/' + month + '/' + year;
    }


    var id = $("#id").val();
    if (id > 0) {

        $.ajax({
            url: "<?php echo site_url('crm_service/Enquiry_register/getsing'); ?>/" + id,
            success: function(results) {
                var result = JSON.parse(results);

                 $("#item_name").val(result.itemname);
                $("#model").val(result.model);
                $("#serial").val(result.series);
                $("#problems").val(result.problems);
                $("#observation").val(result.observation);
                $("#entryremarks").val(result.eremarks);
                $("#cusaddress").val(result.cusaddress);
              
                $("#cusphone").val(result.cusphone);

                $("#customerName").val(result.cus_name);
                  $("#customerName").val(result.cusname);
                $("#customerid").val(result.cus_id);
                if(result.product !==''  && result.product !== 'null'){
                     $("#item_name").val(result.product);
                }
                $("#item_name").val(result.itemname);
                $("#user").val(result.enq_user);
                $("#date").val(formatDate(result.date));
                $("#deli_date").val(formatDate(result.Ddate));
                $("#item_id").val(result.item_id);
                if(result.ver_type ==2 ){

                    $('#prod_det').val('Prate : ' + result.prate + ' \nSrate : ' + result.srate + ' \nMRP : ' + result.MRP + ' \nDescription : ' + result.description);

                }else{

                    $('#prod_det').val('Vehicle No : ' + result.veh_no + ' \nVehicle Name : ' + result.veh_name + ' \nVehicle Brand : ' + result.veh_brand);

                }
                $("#alloo_user").val(result.user);
                $("#typess").val(result.ver_type);   
                if (result.type == 2) {
                    $('.quan').hide();
                } else {
                    $('.quan').show();
                }
                $("#remarks").val(result.remarks);
                $("#gst").val(result.gst);
                $("#source_id").val(result.source);
                $('#amount_to_pay').val(result.totalAmount);

               var  pro_type = result.ver_type;
               var cust_id = result.cust_id;
               var pro_id = result.product_id;
               service(pro_type, pro_id, cust_id );
                sale(pro_type, pro_id,cust_id );


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

        if (productid !== '' && price !== "" && $("#type option:selected").text() == 'Services') {
            additem(name, productid, 0, price);
        } else if (productid !== '' && price !== "" && quantity !== "") {
            additem(name, productid, quantity, price);
        }
    });

    $('#price').keydown(function(e) {
        var keyCodes = e.keyCode;
        if (keyCodes == 13 || keyCodes == 9) {
            var name = $("#product").val();
            var productid = $("#productid").val();
            var quantity = $("#quantity").val();
            var price = $("#price").val();
            if (productid !== '' && price !== "" && $("#type option:selected").text() == 'Services') {
                additem(name, productid, 0, price);
            } else if (productid !== '' && price !== "" && quantity !== "") {
                additem(name, productid, quantity, price);
            }
        }

    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/states'); ?>",
        success: function(result) {
            $('#location').html(result);
        }
    });

    $.ajax({
        url: "<?php echo site_url('crm_service/Enquiry_register/source'); ?>",
        success: function(result) {
            $('#source_id').html(result);
        }
    });
</script>