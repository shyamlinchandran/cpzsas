<script src="<?php echo base_url(); ?>assets/js/vue.js"></script>  
<style> 
    .tab-pane{
        height: 100vh;
    }
    .ui-autocomplete { z-index:2147483647; }
</style>

<div id="myvideo">  
    <section class="content"> 
        <div class="row">  
            <div class="col-xs-12">
                <div class="nav-tabs-custom" id="tab-list">
                    <ul class="nav nav-tabs" id="nav-tabs"> 
                        <li class="pull-right">  <button class="btn btn-primary" id="add" ><i class="fa fa-plus"></i></button> </li>
                    </ul>
                    <div class="tab-content" id="tab-content"  >
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane hidden"  id="mainSalecs">  
                            <div class="col-md-12" @keyup.alt.67="SelectCustomer" > 
                                <div class="row no-padding" >
                                    <div class="col-md-3  no-padding">
                                        <div class="form-group col-xs-4 no-padding">
                                            <label>Bill Date</label>
                                            <input type="text" class="form-control  input-sm" v-bind:id="dateID" placeholder="Bill Date">
                                        </div>
                                        <div class="form-group col-xs-4 no-padding">
                                            <label>Bill Type</label>
                                            <select class="form-control  input-sm " v-model="billType" >
                                                <option v-for="bt in billTypeList" v-bind:value="bt"> {{ bt.type}}</option>
                                            </select>                
                                        </div>
                                        <div class="form-group col-xs-4 no-padding">
                                            <label>Cash/Credit</label>
                                            <select class="form-control  input-sm " v-model="cashType">
                                                <option v-for="ct in cashTypeList"> {{ ct.name}}</option>
                                            </select>                
                                        </div>
                                    </div>
                                    <div class="col-md-3  no-padding ">
                                        <div class="form-group col-xs-6 no-padding">
                                            <label>Select Customer</label>
                                            <input type="text"  v-bind:id="cusmodelTxtId" v-on:focus="SelectCustomer"  readonly="readonly" v-bind:value="cutomerDetails.name" class="form-control  input-sm" placeholder="Select Customer">
                                        </div>
                                        <div class="form-group col-xs-6 no-padding">
                                            <label>Item Select</label>
                                            <input type="text"  v-on:focus="SelectItem"   v-bind:id="itemModelTxtId" v-bind:value="itemsList.length + ' Selected'"  readonly="readonly" class="form-control  input-sm" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3  no-padding">
                                        <div class="form-group col-xs-6 no-padding">
                                            <label>Other Details</label>
                                            <input type="text" v-on:focus="OtherDetails"   v-bind:id="otherTxtId" class="form-control  input-sm" placeholder="">
                                        </div>
                                        <div class="form-group col-xs-6 no-padding">
                                            <label>Additional Ledgers</label>
                                            <input type="text" class="form-control  input-sm" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3  no-padding">
                                        <div class="form-group col-xs-6 no-padding">
                                            <label>Text Disabled</label>
                                            <input type="text" class="form-control  input-sm" placeholder="">
                                        </div>
                                        <div class="form-group col-xs-6 no-padding">
                                            <br/>
                                            <label> </label>
                                            <input type="button" class="btn btn-primary " value="Submit" placeholder="">  </input>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{ billType.godown_id }}
                            <div @keyup.alt.67="SelectCustomer" >
                                <div class="col-md-10"> 
                                      
                                    <table class="table table-condensed table-striped"   >
                                        <thead>
                                            <tr>
                                                <td>No</td> 
                                                <td>Item Name</td> 
                                                <td>Qty</td>
                                                <td>Unit</td> 
                                                <td>Rate</td>
                                                <td>Dis(AMT) </td> 
                                                <td>Dis(%)</td>
                                                <td>Tax(AMT)</td>
                                                <td>Total</td> 
                                                <td> </td> 
                                            </tr> 
                                        </thead>
                                        <tbody> 
                                            <tr   v-for=" (objItem, index) in itemsList">
                                                <td> {{ index+1 }}  </td> 
                                                <td><input readonly="readonly" type="text" v-model="objItem.name" class="form-control  input-sm " /></td> 
                                                <td><input type="text"  v-model="objItem.srate"  class="form-control  input-sm " /></td>
                                                <td><input type="text" v-model="objItem.qty"  class="form-control  input-sm " /></td> 
                                                <td><input type="text" class="form-control  input-sm " /></td>
                                                <td><input type="text" class="form-control  input-sm " /> </td> 
                                                <td><input type="text" class="form-control  input-sm " /></td>
                                                <td><input type="text" class="form-control  input-sm " /></td>
                                                <td><input readonly="readonly" type="text" v-model="subtotalRow[index]"    class="form-control  input-sm " /></td> 
                                                <td> <button @click="RemoveRow(index)">-</button></td> 
                                            </tr> 
                                        </tbody>
                                    </table>   
                                </div>
                                <div class="col-md-2">

                                </div>

                            </div>
                            {{ Total }} 
                            <!--Customer Model-->
                            <div class="modal fade" v-bind:id="cusmodelId" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>-->
                                            <div class="col-xs-12 col-md-6">
                                                <input type="text"  v-bind:id="customerAuotoComplete" placeholder="Select Customer Details" class="form-control  input-sm " />
                                                Balance {{ cutomerDetails.clossingBalance }}
                                            </div>
                                            <div class="col-xs-12 col-md-6">  
                                                <select class="form-control  input-sm">
                                                    <option>BTOC</option>
                                                    <option>BTOB</option>
                                                </select>  
                                            </div>
                                        </div>
                                        <div class="modal-body no-padding">

                                            <div class="col-md-12"> 
                                                <div class="col-md-12 no-padding">
                                                    <div class="form-group col-xs-4 no-padding">
                                                        <label>Billing Name</label>
                                                        <input type="text" class="form-control   input-sm"  v-model="cutomerDetails.name"   placeholder="Billing Name">
                                                    </div>
                                                    <div class="form-group col-xs-4 no-padding">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control  input-sm"  v-model="cutomerDetails.phone"   placeholder="Phone Number">           
                                                    </div>
                                                    <div class="form-group col-xs-4 no-padding">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control  input-sm"  v-model="cutomerDetails.address_line1"   placeholder="Phone Number">           
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!--Items  Model-->
                            <div class="modal fade" v-bind:id="modelId" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="form-group col-xs-4 no-padding">
                                                <input type="text"  placeholder="Item Details"  v-bind:value="itemsSelected.name"  v-bind:id="itemAuotoComplete"  class="form-control  input-sm " />  
                                            </div>
                                            <div class="form-group col-xs-4 no-padding">
                                                <input type="text" placeholder="Enter Barcode Only" v-model="itemBarcode" v-on:keyup.enter="BarcodeRead" class="form-control  input-sm " />  
                                            </div>
                                            <div class="form-group col-xs-4 no-padding"> 
                                                <select class="form-control  input-sm " >
                                                    <option > Tax Included </option>
                                                    <option > Tax Excluded </option>
                                                </select>                
                                            </div> 
                                        </div>
                                        <div class="modal-body no-padding">
                                            <table class="table table-striped no-padding">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            Name
                                                            <input type="text" v-model="itemsSelected.name" class="form-control  input-sm " /> 
                                                        </td>
                                                        <td>
                                                            MRP
                                                            <input type="text" v-model="itemsSelected.mrp" class="form-control  input-sm " /> 
                                                        </td>
                                                        <td>
                                                            Sales Rate
                                                            <input type="text" v-model="itemsSelected.srate" class="form-control  input-sm " /> 
                                                        </td>
                                                        <td>
                                                            Qty
                                                            <input type="text" v-model="itemsSelected.qty" class="form-control  input-sm qty input-sm" /> 
                                                        </td>
                                                        <td   v-if="isGodown">
                                                            Godown<br/> 
                                                            <select class="form-control  input-sm " v-model="selectedGodown">
                                                                <option v-for="objgodown in godownList" v-bind:value="objgodown"> {{ objgodown.godown_name }}</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            Unit<br/>
                                                            <select class="form-control  input-sm " v-model="itemsSelected.unit_id">
                                                                <option v-for="objunit in unitList" v-bind:value="objunit.id"> {{ objunit.name }}</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" v-on:click="AddItem" class="btn btn-primary pull-left">Save changes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!--Other Details  Model-->
                            <div class="modal fade" v-bind:id="otherId" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content"> 
                                        <div class="modal-body no-padding">
                                            <table class="table table-striped table-condensed" >
                                                <tr>
                                                    <td class="col col-lg-2">State</td>
                                                    <td class="col col-lg-2">State Code</td>
                                                    <td class="col col-lg-3">Gst Number</td> 
                                                    <td class="col col-lg-3">E-Way Bill Number</td>
                                                    <td class="col col-lg-2">E-Way Bill Details</td>
                                                </tr>
                                                <tr>

                                                    <td><select  name="states" class="form-control">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td> 
                                                    <td>  <input name="stcode" type="text" id="stcode"  class="form-control  "   placeholder="State Code"></td>
                                                    <td>  <input name="gst" type="text" id="gst"  class="form-control  col-lg-2"   placeholder="Gst Number"></td>
                                                    <td>  <input name="ewbno" type="text" id="ewbno"  class="form-control  col-lg-2"   placeholder="E-Way Bill Number"></td>
                                                    <td>  <input name="ewbdetails" type="text" id="ewbdetails"  class="form-control  col-lg-2"   placeholder="E-Way Bill Details"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col col-lg-2">Delivery Date</td>
                                                    <td class="col col-lg-2">Credit Days</td>
                                                    <td class="col col-lg-3">SalesMan</td> 
                                                    <td class="col col-lg-3">Agent/Reference</td> 
                                                    <td class="col col-lg-2"> </td> 
                                                </tr>
                                                <tr>
                                                    <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="Date"></td>
                                                    <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="Date"></td>
                                                    <td><select  id="salesman"  name="salesman" class="form-control">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td> 
                                                    <td><select  id="reference"  name="reference" class="form-control" >
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>     
                                                    <td> </td> 
                                                </tr>
                                                <tr>
                                                    <td class="col col-lg-2">Area</td>
                                                    <td class="col col-lg-2">Route</td>
                                                    <td class="col col-lg-2">Vehicle</td>
                                                    <td class="col ">Coolie</td>
                                                    <td class="col ">Frieght</td>
                                                </tr>
                                                <tr>
                                                    <td><select  id="area"  name="area" class="form-control">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td> 
                                                    <td><select  id="route"  name="route" class="form-control">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td> 
                                                    <td><select  id="vehicle"  name="vehicle" class="form-control">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td> 
                                                    <td>  <input name="other" type="text"   class="form-control  "   placeholder="Coolie"></td>
                                                    <td>  <input name="freight" type="text" id="freight"  class="form-control  "  placeholder="Frieght"></td>
                                                </tr>
                                            </table>
                                            </br>

                                            <table class="table table-striped table-condensed" >
                                                <tr>
                                                    <td class="col col-lg-8">Terms And Conditions</td>
                                                    <td class="col col-lg-8">Despatch Details</td>
                                                </tr>
                                                <tr>
                                                    <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">Enter </textarea></td>
                                                    <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">Enter text here...</textarea></td>
                                                </tr>
                                            </table>

                                        </div>
                                        <!--                                        <div class="modal-footer">
                                                                                    <button type="button" v-on:click="AddItem" class="btn btn-primary pull-left">Save changes</button>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                                                                </div>-->
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>  
                    </div>  
                </div> 
            </div> 
        </div> 

    </section>  
</div>

<script type = "text/javascript">
var id = 1;
$(document).ready(function () {
    $('#add').click(function () {
        id = id + 1;
        if (id <= 10) {
            sm();
        }

    });
    $('#tab-list').on('click', '.close', function () {
        var tabID = $(this).parents('a').attr('href');
        $(this).parents('li').remove();
        $(tabID).remove();

        //display first tab
        var tabFirst = $('#tab-list a:first');
        resetTab();
        tabFirst.tab('show');
    });
    sm();
});

var button = '<button class="close" type="button" title="Remove this page">×</button>';
var tabID = 1;
function resetTab() {
    var tabs = $("#tab-list li:not(:first)");
    var len = 1
    $(tabs).each(function (k, v) {
        len++;
        //$(this).find('a').html('Tab ' + len + button);
    })
    tabID--;
}
function sm() {
    var str = ' <li><a href="#mainSale' + id + '" data-toggle="tab"> Estimate</a></li>';
    if (id > 1) {
        str = ' <li><a href="#mainSale' + id + '" data-toggle="tab"> Estimate ' + id + ' <button class="close" type="button" title="Remove this page">×</button> </a></li>';
    }
    $('#nav-tabs').append(str);
    var mainhtml = $('#mainSalecs').html();
    mainhtml = '<div class="tab-pane active" id="mainSale' + id + '">' + mainhtml + '</div>';
    $('#tab-content').append(mainhtml);
    this[id + '_count'] = new Vue({
        el: "#mainSale" + id,
        data: {
            modelId: 'mod' + id,
            billId: 'bill' + id,
            cusmodelId: 'cusmod' + id,
            cusmodelTxtId: 'cusmodTxt' + id,
            itemModelTxtId: 'itemModelTxt' + id,
            otherTxtId: 'otherTxt' + id,
            otherId: 'other' + id,
            dateID: 'dateID' + id,
            customerAuotoComplete: 'customerAuotoComplete' + id,
            itemAuotoComplete: 'itemAuotoComplete' + id,
            itemBarcode: '',
            billTypeList: [],
            billType: '',
            itemsSelected: {},
            itemsList: [],
            unitList: [],
            godownList: [],
            isGodown: false,
            customerId: 0,
            cutomerDetails: {},
            cashType: 'Cash',
            selectedGodown: {},
            cashTypeList: [{name: 'Credit'}, {name: 'Cash'}],
            billNo: '',
            billDate: new Date(),
            totalAmount: 0.00,
            totalItems: 0,
            totalTax: 0.00,
            discount: 0.00

        },
        mounted: function () {
            var self = this;
            var cutomerDetailsDB = localStorage.getItem('cutomerDetails' + id);
            if (cutomerDetailsDB) {
                try {
                    self.cutomerDetails = JSON.parse(cutomerDetailsDB);
                } catch (ex) {

                }

            }
            $.ajax({
                url: "<?php echo site_url('json/ajaxcall/billtype') . '/sales' ?>",
                success: function (result) {
                    console.log('billtype -' + result);
                    self.billTypeList = JSON.parse(result);
                }
            });
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            $('#' + self.dateID).datepicker({
                setDate: new Date(),
                format: 'dd/mm/yyyy'
            });
            $('#' + self.dateID).datepicker('setDate', today);
            $("#" + self.customerAuotoComplete).autocomplete({
                source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
                minLength: 2,
                renderItem: function (item, search) {
                    search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                    var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                    return '<div class="autocomplete-suggestion" data-val="' + item.label + '"  data-unit_id="' + item.unit_id + '" data-name="' + item.name + '"  data-barcode="' + item.barcode + '"  data-commission="' + item.commission + '"  data-val="' + search + '" data-tax_id="' + item.tax_id + '" data-id="' + item.id + '" data-currentstk="' + item.currentstk + '" data-price_code="' + item.price_code + '" data-prate="' + item.prate + '"  data-srate="' + item.srate + '"    data-wh_rate="' + item.wh_rate + '"  data-dis="' + item.dis + '"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
                },
                select: function (event, ui) {
                    $.ajax({
                        url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                        success: function (results) {
                            ui.item.clossingBalance = results;
                            self.cutomerDetails = ui.item;
                            localStorage.setItem('cutomerDetails' + id, JSON.stringify(self.cutomerDetails));
                        }
                    });
                }
            });
            $("#" + self.itemAuotoComplete).autoComplete({
                minChars: 2,
                cache: false,
                source: function (term, response) {
                    try {
                        xhr.abort();
                    } catch (e) {
                    }
                    xhr = $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch/name?', {term: term}, function (data) {
                        response(data);
                    });
                },
                renderItem: function (item, search) {
                    search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                    var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                    return '<div class="autocomplete-suggestion" data-val="' + item.label + '"  data-unit_id="' + item.unit_id + '" data-name="' + item.name + '"  data-barcode="' + item.barcode + '"  data-commission="' + item.commission + '"  data-val="' + search + '" data-tax_id="' + item.tax_id + '" data-id="' + item.id + '" data-currentstk="' + item.currentstk + '" data-price_code="' + item.price_code + '" data-prate="' + item.prate + '"  data-srate="' + item.srate + '"  data-mrp="' + item.srate + '"  data-wh_rate="' + item.wh_rate + '"  data-dis="' + item.dis + '"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
                },
                onSelect: function (e, term, item) {
                    console.log(JSON.stringify(item.data()));
                    self.itemsSelected = item.data();
                    $.ajax({
                        url: "<?php echo site_url('json/ajaxcall/units'); ?>/" + item.data().unit_id,
                        success: function (result) {
                            self.unitList = JSON.parse(result);
                        }
                    });
                    $.ajax({
                        url: "<?php echo site_url('json/ajaxcall/godownstock'); ?>/" + id,
                        success: function (result) {
                            self.itemsSelected.godownList = JSON.parse(result);
                            self.godownList = JSON.parse(result);
                            self.itemsSelected.selectedGodown = '';

                        }
                    });
                }

            });

            $.ajax({
                url: "<?php echo site_url('ajaxcall/godownjson'); ?>",
                success: function (result) {
                    self.itemsSelected.godownList = JSON.parse(result);
                    console.log(JSON.stringify(self.itemsSelected.godownList))
                }
            });

            $('#' + self.cusmodelId).on('shown.bs.modal', function () {
                $("#" + self.customerAuotoComplete).focus();
            });
            $('#' + self.modelId).on('shown.bs.modal', function () {
                $("#" + self.itemAuotoComplete).focus();
            });
            $('#' + self.cusmodelId).on("hidden.bs.modal", function () {
                $("#" + self.itemModelTxtId).focus();
            });

            $('#' + self.modelId).on("hidden.bs.modal", function () {
                $("#" + self.otherTxtId).focus();
            });

            $('#' + self.dateID).focus();
        },
        computed: {
            subtotalRow() {
                var self = this;
                return self.itemsList.map((item) => {
                    return Number(item.qty * item.srate)
                });
            },
            Total() {
                var self = this;
                return self.itemsList.reduce((total, item) => {
                    return total + item.qty * item.srate;
                }, 0);
            }
        },
        methods: {
            RemoveRow(index) {
                var self = this;
                self.itemsList.splice(index, 1);
            },
            SelectCustomer: function () {
                var self = this;
                $('#' + self.cusmodelId).modal('show');

            },
            SelectItem: function () {
                var self = this;
                $('#' + self.modelId).modal('show');

            },
            OtherDetails: function () {
                var self = this;
                $('#' + self.otherId).modal('show');

            },
            SelectBill: function () {
                var self = this;
                $('#' + self.billId).modal('show');

            },
            AddItem: function () {
                var self = this;
                self.itemsSelected.rowTotal = self.itemsSelected.qty * self.itemsSelected.srate;
                self.itemsList.push(self.itemsSelected);
                self.itemsSelected = {};
                $("#" + self.itemAuotoComplete).focus();

            },
            BarcodeRead: function () {
                var self = this;
                $.getJSON('<?php echo base_url(); ?>json/ajaxcall/itemssearch/barcode?', {term: self.itemBarcode}, function (data) {

                    if (JSON.stringify(data) === '[]') {
                        self.itemsSelected = {};
                    } else {
                        self.itemsSelected = data[0];
                        $.ajax({
                            url: "<?php echo site_url('json/ajaxcall/units'); ?>/" + self.itemsSelected.unit_id,
                            success: function (result) {
                                self.unitList = JSON.parse(result);
                            }
                        });
                    }

                });

            }
        }
    });
    $('.nav-tabs a[href="#mainSale' + id + '"]').tab('show');
}
function catsale() {
    var str = ' <li><a href="#catsale' + id + '" data-toggle="tab"> Estimate</a></li>';
}
</script>