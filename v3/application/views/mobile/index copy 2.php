
<?php
$is_taxincuded = $settings[0]['is_taxincluded'];
$user = $this->session->userdata('user');
$edit_sale_rate = 0;
if (isset($user['edit_sale_rate'])) {
    $edit_sale_rate = $user['edit_sale_rate'];
}
$sale_cash_type = 'Cash';
if (isset($settings[0]['sale_cash_type'])) {
  $sale_cash_type = $settings[0]['sale_cash_type'];
}

?>
  <style>
    .modal {
        padding-right: 0px !important;
    }
    .ui-menu-item {
        font-size: 14px;
    }
    /* Product Card Styling */
    .pdt-list-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        padding: 5px;
    }
    .pdt-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #eef2f7;
        padding: 12px;
        display: flex;
        gap: 15px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
        cursor: pointer;
        position: relative;
    }
    .pdt-card:active {
        background: #f8faff;
        transform: translateY(1px);
    }
    .pdt-card.selected {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    .pdt-image-box {
        width: 70px;
        height: 70px;
        flex-shrink: 0;
        background: #f3f4f6;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .pdt-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .pdt-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .pdt-title {
        font-weight: 700;
        font-size: 15px;
        color: #1f2937;
        margin-bottom: 4px;
    }
    .pdt-meta {
        font-size: 12px;
        color: #6b7280;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .pdt-price-badge {
        font-weight: 700;
        color: #059669;
        font-size: 14px;
    }
    .pdt-stock-badge {
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 100px;
        background: #fef2f2;
        color: #dc2626;
        font-weight: 600;
    }
    .pdt-stock-badge.in-stock {
        background: #ecfdf5;
        color: #059669;
    }
    .pdt-qty-section {
        display: flex;
        gap: 8px;
        margin-top: 8px;
        align-items: center;
    }
    .pdt-qty-input {
        width: 60px !important;
        padding: 4px 8px !important;
        font-size: 12px !important;
        border-radius: 6px !important;
        border: 1px solid #d1d5db !important;
        text-align: center;
    }
    .pdt-qty-label {
        font-size: 11px;
        color: #6b7280;
        font-weight: 500;
    }
    .pdt-card.selected {
        border-color: #3b82f6;
        background: #f0f7ff;
        box-shadow: 0 0 0 2px rgba(59,130,246,0.1);
    }
    .pdt-card-checkbox {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 2px solid #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }
    .pdt-card.selected .pdt-card-checkbox {
        background: #3b82f6;
        border-color: #3b82f6;
    }
    .pdt-card.selected .pdt-card-checkbox::after {
        content: '✓';
        color: #fff;
        font-size: 12px;
        font-weight: bold;
    }
    .filter-card {
        background: #f9fafb;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid #e5e7eb;
    }
    .search-input-group {
        position: relative;
    }
    .search-input-group i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    .search-input-group .form-control {
        padding-left: 35px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
    }
  </style>

  <div class="modal fade " tabindex="-1" id="creditmodal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label id="credittxt" style="padding: 20px;">Customer Has Exceeded his/her Credit Period</label>
                </div>
                <div class="modal-footer">
                    <button data-toggle="tooltip" type="button" title="Add To save" id="btndiscontinue" class="btn btn-danger" href="#">
                        Block Customer
                    </button>
                    <button style= "display:none" type="button" id="btncontinue" class="btn btn-success btncon" data-bs-dismiss="modal"> Continue anyway</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade " tabindex="-1" id="creditmodalss" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label id="credittxtss" style="padding: 20px;">Customer Has Exceeded his/her Credit Period</label>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" id="btnclose" class="btn btn-success" data-bs-dismiss="modal"> Close</button>
                </div>
            </div>
        </div>
    </div>


  <div class="modal fade " tabindex="-1" id="creditmodals" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label id="credittxts" style="padding: 20px;">Customer Has Exceeded his/her Credit Period</label>
                </div>
                <div class="modal-footer">
                    <button data-toggle="tooltip" type="button" title="Add To save" id="btndiscontinued" class="btn btn-danger" href="#">
                        Block Customer
                    </button>
                    <button style= "display:none" type="button" id="btncontinued" class="btn btn-success" data-bs-dismiss="modal"> Continue anyway</button>
                </div>
            </div>
        </div>
    </div>

<form method="post"  id ="formmobilesales"  action="<?php echo site_url('mobile/main/save/'); ?>" class="form-horizontal frmcreate">
  <div class="container-fluid">
    <br />
    <div class="forms-inputs mt-5">


        <div class="row">
          <div class="col-sm-6">
          <input type="hidden" value="<?php echo $sales_id; ?>" id="sales_id" name="sales_id" />
          <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded" />
          </div>
          <div class="col-sm-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cusModel">
              Select Customer
            </button>

            <button type="button" class="btn btn-primary" id ="btnpdtmodal"  data-bs-toggle="modal" data-bs-target="#product_edit">
              Add Products
            </button>
            <button type="button" class="btn btn-primary" id ="btnpdtlistmodal"  data-bs-toggle="modal" data-bs-target="#product">
              <!-- Add products(list view)  -->
                <!-- <i class="glyphicon glyphicon-list"></i> List -->
                 <!-- <i class="material-icons">menu</i> -->
                <span class="material-symbols-outlined">
list_alt
</span>             </button>
          </div>
        </div>
        <table class="table">
          <tr>
              <th style ="width:30%;" >SO.No  :</th>
              <th style ="text-align:left"  class = "" ><?php echo $invoice_no;?></th>

            </tr>
            <tr>
              <th>Name :</th>
              <th class = "td_cusname" ></th>

            </tr>
            <tr>
              <th>Addrres :</th>
              <th class = "td_cusaddress"></th>
            </tr>
            <tr>
              <th>balance :</th>
              <th class = "td_cusbalance"></th>
            </tr>
            <tr>
              <th>Remarks :</th>
              <th class = ""><input type="text" name ="remarks" id ="remarks" class ="form-control" style ="width:350px;"     /></th>
            </tr>
        </table>
        
        <div class="row">
          <div class="col"> <h5>Order Items </h5> </div>
        
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table class="table">
              <thead>
                
              </thead>
              <tbody id ="tblpdts" style="max-height: 200px; overflow: scroll;">
                
              </tbody>
            </table>
          
            <table style ="font-size:12px;font-weight:bold;" class="table">
              <tr>
                <td   >Taxable Amount<input type ="hidden" id ="sales_grand_subtotal" name = "sales_grand_subtotal" value = "0" ></td>
                <td id ="grand_subtotal">0.00</td>
              </tr>
              <tr>
                <td>GST<input type ="hidden" id ="sales_grand_gst"  name = "sales_grand_gst" value = "0" ></td>
                <td id ="grand_gst">0.00</td>
              </tr>
              <tr>
                <td>Cess<input type ="hidden" id ="sales_grand_cess" name = "sales_grand_cess" value = "0" ></td>
                <td  id ="grand_cess">0.00</td>
              </tr>
              <tr>
                <td style ="font-size:14px;font-weight:bold;">Total<input type ="hidden" id ="sales_grand_total" name = "sales_grand_total" value = "0" ></td>
                <td   style ="font-size:14px;font-weight:bold;" id ="grand_total">0.00</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
        <button class="btn btn-primary "  type="button" id = "btnsubmit" >Save</button>
          <button class="btn btn-primary btnsubmit" style = "display:none" type="submit">Save</button>
        </div>

    </div>
  </div>
  <!-- Modal product list-->
  <div class="modal fade modal-fullscreen-md-down" id="product" tabindex="-1" aria-labelledby="productLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-body" id ="divitem" >

                    <div class="box-header with-border">
                        <h3 style= "width:90%" class="box-title"><?= label('Select Item', $this, $user) ?></h3>
                        <span class="pull-right">
                        <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </span>
                    </div>
                    <input type="hidden" name="item_id" id="item_id" />
       
          <div class="filter-card">
            <div class="row g-2">
              <div class="col-6">
                <select name="item_category_id" id="item_category_id"  class="form-control form-select">
                    <option value="">All Categories</option>
                </select>
              </div>
              <div class="col-6">
                <select name="item_brand_id" id="item_brand_id"  class="form-control form-select">
                    <option value="">All Brands</option>
                </select>
              </div>
              <div class="col-12 mt-2">
                <div class="search-input-group">
                  <i class="fa fa-search"></i>
                  <input name="itemname" id="itemname" type="text" placeholder="Search by name or barcode..." class="form-control">
                </div>
              </div>
            </div>
          </div>

          <div id="div_product_list" style="max-height: 500px; overflow-y: auto; display:none; margin-bottom: 5px; border-radius: 8px;">
            <div id="ul_product_list" class="pdt-list-container">
            </div>
          </div>
          <div id="temp_unit_loader" style="display:none;"></div>
          
          <!-- Hidden fields for Edit functionality and legacy fallback -->
          <div style="display:none;">
            <input type ="hidden" id ="idincid" value ="0">  
            <input type ="hidden" name ="item_unit" id ="item_unit">
            <input type ="hidden" name ="ces_id" id ="ces_id">
            <input type ="hidden" name ="itemdiscount" id ="itemdiscount">
            <input type ="hidden" name ="ces_percent" id ="ces_percent">
            <input type ="hidden" name ="ces_name" id ="ces_name">
            <input type ="hidden" name ="itemprate" id ="itemprate">
            <input type ="hidden" name ="itemmrp" id ="itemmrp">
            <input type ="hidden" name ="itemtaxid" id ="itemtaxid">
            <input type ="hidden" name ="itemtax" id ="itemtax">
            <input type ="hidden" id ="itembaserate" name ="itembaserate">
            <input type ="hidden" name ="itemqty" id ="itemqty" value="1">
            <input type ="hidden" name ="itemfqty" id ="itemfqty" value="0">
            <input type ="hidden" name ="itemrate" id ="itemrate">
            <input type ="hidden" name ="disamt" id ="disamt">
            <input type ="hidden" name ="itemsubtotal" id ="itemsubtotal">
            <input type ="hidden" name ="itemtotaltax" id ="itemtotaltax">
            <input type ="hidden" name ="itemcess" id ="itemcess">
            <input type ="hidden" name ="itemtotal" id ="itemtotal">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btnadditm">Add</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal product select-->
  <div class="modal fade modal-fullscreen-md-down" id="product_edit" tabindex="-1" aria-labelledby="productLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-body" id ="divitem" >

        <div class="box-header with-border">
                        <h3 style= "width:90%" class="box-title"><?= label('Select Item', $this, $user) ?></h3>
                        <span class="pull-right">
                        <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </span>
                    </div>
       
          <table class="table">
            <tr>
              <th><input type="hidden" name="item_id" id="item_id" /><input name ="itemname" id = "itemname" type="text" placeholder="Search Product" class="form-control form-control-sm"></th>
              <th>
                <select name="item_category_id" id="item_category_id"  class="form-control form-control-sm">
                    <option value="">Category</option>
                </select>
              </th>
            </tr>
          </table>
          <table class="table">
            <thead>
              <tr>
                <th colspan ="4" style = "font-size:14px;" id ="tdproductname" >Product Name :</th>
              </tr> 
              <tr>
                <th colspan ="4" style = "font-size:11px;" id ="tdstock" > </th>
              </tr> 
              <tr>
                <th style ="width:26%" >Unit</th>
                <th style ="width:22%">Quantity</th>
                <th style ="width:22%">F.Qty</th>
                <th style ="width:30%">Rate</th>
              </tr>
            </thead>
           
           
            <tbody>
              <tr>
                <td style="width:22% !important">
                  <input type ="hidden" id ="idincid" value ="0">  
                  <select name="item_unit"  class="form-control  " id="item_unit">
                    
                  </select>
                  <input type ="hidden" name ="ces_id" id ="ces_id" value =""  >
                  <input type ="hidden" name ="itemdiscount" id ="itemdiscount" value =""  >

                  <input type ="hidden" name ="ces_percent" id ="ces_percent" value =""  >
                  <input type ="hidden" name ="ces_name" id ="ces_name" value =""  >
                  <input type ="hidden" name ="itemprate" id ="itemprate" value =""  >
                  <input type ="hidden" name ="itemmrp" id ="itemmrp" value =""  >
                  <input type ="hidden" name ="itemtaxid" id =  "itemtaxid" class = "form-control"/>
                  <input type ="hidden" name ="itemtax" id =  "itemtax" class = "form-control"/>
                </td> 
                <td style="width:20% !important"><input type="text" name="itemqty" id ="itemqty"  class="form-control clschange" /></td>
                <td style="width:20% !important"><input type="text" name="itemfqty" id ="itemfqty"  class="form-control clschange" /></td>
                <td style="width:25% !important"><input type ="hidden" id ="itembaserate" name ="itembaserate"   >
                <input type="text" <?php if((float) $edit_sale_rate < 1 ) { echo 'readonly' ;} ?> name="itemrate" id ="itemrate"  class="form-control clschange " /></td>
              </tr> 
              <tr>
                  <th style = "margin-right:30%;text-align:right"  colspan = "2" >Discount : </th>
                  <th colspan = "2" id ="" ><input type ="text" readonly name ="disamt"  id = "disamt" class = "form-control" ></th>
              </tr>
              <tr>
                  <th style = "margin-right:30%;text-align:right"  colspan = "2" >Amount : </th>
                  <th  colspan = "2" id ="" ><input type ="text" readonly name ="itemsubtotal"  id = "itemsubtotal" class = "form-control" ></th>
              </tr>
              <tr>
                  <th style = "text-align:right" colspan = "2" >Tax : </th>
                  <th colspan = "2" id =""><input type ="text" readonly name ="itemtotaltax"  id = "itemtotaltax" class = "form-control" ></th>
              </tr>
              <tr>
                  <th style = "text-align:right" colspan = "2" >Cess :</th>
                  <th colspan = "2" id =""><input type ="text" readonly name ="itemcess"  id = "itemcess" class = "form-control" ></th>
              </tr>
              <tr>
                  <th style = "text-align:right" colspan = "2" >Total : </th>
                  <th colspan = "2" id =""><input type ="text" readonly name ="itemtotal"  id = "itemtotal" class = "form-control" ></th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btnadditm">Add</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-fullscreen-md-down" id="cusModel" tabindex="-1" aria-labelledby="cusModelLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-body" id = "mainSale">
          <table class="table">
            <tr>
                <td colspan ="2"> </td>
            </tr>
            <tr>
              <th><button type="button"  class="btn btn-primary btnaddcustomer">New</button><br />Customer Name &nbsp;</th>
              <th>
                <input type="text" id ="supname" name ="supname"  class="form-control form-control-sm">
                <input type="hidden" id ="customer_id" name ="customer_id"  class="">
                </th>
            </tr>
          </table>
          <table class="table">

            <tr>
              <th>Name :</th>
              <th class = "td_cusname" ></th>

            </tr>
            <tr>
              <th>Addrres :</th>
              <th class = "td_cusaddress"></th>
            </tr>
            <tr>
              <th>Balance :</th>
              <th class = "td_cusbalance"></th>
            </tr>
          </table>
          <table class="table">
            <tr>
              <th>Payment Type</th>
              <th><select name="cash_type" id="cash_type">
                  <option <?php if($sale_cash_type == 'Cash'){?> selected <?php }?> value="Cash">Cash</option>
                  <option  <?php if($sale_cash_type == 'Credit'){?> selected <?php }?> value="Credit">Credit</option>
                </select></th>
            </tr>
            
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
    </div>
  </div>
  </form>

</body>

</html>
<script>
    function checkstatus(ui) {
        var credit_period_exceed = ui.item.credit_period_exceed;
        var credit_amount = ui.item.credit_amount;
        var credit_amount_exceed = ui.item.credit_amount_exceed;
        var is_ban = 0;
        var text = "";
        var is_exceed = 0;


        $.ajax({
            url: "<?php echo site_url('ajaxcall/checkCustomerstatus'); ?>/" + ui.item.id,
            success: function(results) {
                var result = JSON.parse(results);
                $('#is_warning').val(result.warning);
                $('#is_ban').val(result.ban);
                var ban = result.ban;
                var warning = result.warning;
                var ban_text = result.ban_text;
                var warning_text = result.warning_text;
                if(parseFloat(ban) > 0 ){
                    $('#cusModel').modal('hide');
                    $('#credittxt').html(ban_text);
                    $('#creditmodal').modal('show');
                    $('.btncon').attr('style','display:none');

                }else if(parseFloat(warning) > 0){
                  $('#cusModel').modal('hide');
                    $('#credittxt').html(warning_text);
                    $('#creditmodal').modal('show');
                    $('.btncon').attr('style','');
                }

                var credit_amount = result.credit_amount;
                if(parseFloat(credit_amount) > 0  ){
                    var bal = result.bal;
                    if(parseFloat(bal) >=credit_amount  ){
                      $('#cusModel').modal('hide');
                        $('#credittxt').html("Customer Ledger Balance Exceed it's limits");
                        $('#creditmodal').modal('show');
                    }
                }

            }
        });



        // $.ajax({
        //     url: "<?php echo site_url('ajaxcall/checkstatus'); ?>/" + ui.item.id,
        //     success: function(results) {
        //         var result = JSON.parse(results)[0];
        //         if (parseFloat(result.is_exceed) > 0) {
        //             is_ban = credit_period_exceed;
        //             is_exceed = 1;
        //         }
        //         if (parseFloat(credit_amount) < parseFloat(result.amount)) {
        //             if (parseFloat(is_ban) < 1) {
        //                 is_ban = credit_amount_exceed;
        //                 is_exceed = 1;
        //             }
        //         }
        //         if (parseFloat(is_exceed) > 0) {
        //             if (parseFloat(is_ban) > 0) {
        //                 calert('This Customer is Banned Due to  Exceeding  Credit Limits');
        //                 text = "This Customer is Banned Due to  Exceeding  Credit Limits Contact Admin for Further Details";
        //             } else {
        //                 text = "This Customer is  Exceeded his Credit Limits";
        //                 calert('This Customer is  Exceeded his Credit Limits');
        //             }
        //             $('#credittxt').html(text);
        //             if (parseFloat(is_ban) < 1) {
        //                 $('#creditmodal').modal('show');
        //             } else {
        //                 $('#btndiscontinue').trigger('click');
        //             }

        //         }

        //     }
        // });
    }
$( document ).ready(function() {

  $('#btncontinue').click(function(){
    $('#creditmodal').modal('hide');
    $('#cusModel').modal('show');
  });
  $('#btnclose').click(function(){
    $('#creditmodalss').modal('hide');

  });
  $('#btndiscontinued').click(function(){
        $('#customer_id').val('');
        $('#supname').val('');
        $('.td_cusname').html('');
        $('.td_cusaddress').html('');
        $('.td_cusbalance').html('');
        $('#creditmodals').modal('hide');
  });

  $('#btndiscontinue').click(function(){
        $('#customer_id').val('');
        $('#supname').val('');
        $('.td_cusname').html('');
        $('.td_cusaddress').html('');
        $('.td_cusbalance').html('');
        $('#creditmodal').modal('hide');
       $('#cusModel').modal('show');
  });


        $('#btncontinued').click(function(){
            $(".btnsubmit").trigger('click');
        });
    var sales_id = $('#sales_id').val();
    if(parseFloat(sales_id) > 0  ){
      $.ajax({
        url: "<?php echo site_url('ajaxcall/sales_items'); ?>/" + sales_id,
        async:false,
        success: function(result) {
          var res = JSON.parse(result);
					var cusid = res[0].customer_id;
          var remarks = res[0].remarks;
          $('#remarks').val(remarks);
          loadCustByid(cusid);
          $.each(JSON.parse(result), function(i, itemsingle) {
            $('#is_taxincuded').val(itemsingle.is_taxincluded);
            var itemsubtotal = parseFloat(itemsingle.total) -  parseFloat(itemsingle.tax) - parseFloat(itemsingle.itm_raw_ces); 
            addrowtocalc(itemsingle.item_id,itemsingle.name,itemsingle.quantity,itemsingle.free_quantity,itemsingle.unitid,itemsingle.uname,itemsingle.srate,itemsingle.mrp,itemsingle.itm_ces_id,itemsingle.rate,itemsingle.itm_ces_per,itemsingle.prate,itemsingle.mrp,itemsingle.tax_id,itemsingle.tname,itemsubtotal,itemsingle.tax,itemsingle.itm_raw_ces,itemsingle.total,itemsingle.rate,itemsingle.dis_amt)
          });


        }
      });
    }
});

$('#btnsubmit').click(function(){
    var type = $('#cash_type').val();
    var supid = $('#customer_id').val();
    if(supid === ''){
      supid = 0 ;
    }
    if(type === 'Credit' || type !== 'Credit' ){
        if(supid < 1 ){
          $('#credittxtss').html('Please Select a Customer ');
          $('#creditmodalss').modal('show');
        }else{ 
               $.ajax({
                                    url: "<?php echo site_url('ajaxcall/checkCustomerstatus'); ?>/" + supid,
                                    success: function(results) {
                                        var result = JSON.parse(results);

                                        var gt = $('#sales_grand_total').val();
                                        var ledbalcontinue  = 1;
                                        var credit_amount = result.credit_amount;
                                        if(parseFloat(credit_amount) > 0  ){
                                            var bal = result.bal;
                                            if(parseFloat(bal) + parseFloat(gt)  >=credit_amount  ){
                                                ledbalcontinue = 0 ;
                                            }
                                        }


                                        $('#is_warning').val(result.warning);
                                        $('#is_ban').val(result.ban);
                                        var ban = result.ban;
                                        var warning = result.warning;
                                        var ban_text = result.ban_text;
                                        var warning_text = result.warning_text;
                                        var ban_amt = 0 ;
                                        var warning_amt = 0 ;
                                        var single_inv_cr_limit = result.single_inv_cr_limit;
                                        if(single_inv_cr_limit === ''){
                                            single_inv_cr_limit = 0;
                                        }
                                        var single_inv_cr_limit_action = result.single_inv_cr_limit_action;
                                        if(single_inv_cr_limit_action === ''){
                                            single_inv_cr_limit_action = 0;
                                        }
                                        if(parseFloat(single_inv_cr_limit) > 0 ){
                                            var tot = $('#sales_grand_total').val();
                                            if(parseFloat(tot) > parseFloat(single_inv_cr_limit) ){
                                                if(parseFloat(single_inv_cr_limit_action) > 0 ){
                                                    ban_amt = 1;
                                                }else{
                                                    warning_amt = 1;
                                                }
                                            }
                                        }
                                       // $('#btncontinued').attr('style','');
                                        if(parseFloat(ban) > 0 ){
                                            $('#credittxts').html(ban_text);
                                            $('#creditmodals').modal('show');
                                            $('#btncontinued').attr('style','display:none');
                                            $('#customer_id').val('');
                                            $('#supname').val('');
                                            $('.td_cusname').html('');
                                            $('.td_cusaddress').html('');
                                            $('.td_cusbalance').html('');
                                        }else if(ban_amt > 0 ){
                                            $('#credittxts').html('Customer Banned ! Invoice Credit Limit Exceded For this Customer ('+single_inv_cr_limit+') ');
                                            $('#creditmodals').modal('show');
                                            $('#btncontinued').attr('style','display:none');
                                            $('#customer_id').val('');
                                            $('.td_cusname').html('');
                                            $('.td_cusaddress').html('');
                                            $('.td_cusbalance').html('');
                                        }else if(parseFloat(warning) > 0){
                                            $('#credittxts').html(warning_text);
                                            $('#creditmodals').modal('show');
                                            $('#btncontinued').attr('style','');
                                        }else if(warning_amt > 0 ){
                                            $('#credittxts').html('Invoice Credit Limit Exceded For this Customer ('+single_inv_cr_limit+') ');
                                            $('#creditmodals').modal('show');
                                        }else if(ledbalcontinue < 1 && type === 'Credit'  ){
                                            $('#credittxts').html("Customer Ledger Balance  Exceeded it's limits");
                                            $('#creditmodals').modal('show');
                                            // $('#btncontinued').attr('style','display:none');
                                            $('#customer_id').val('');
                                            $('#supname').val('');
                                            $('.td_cusname').html('');
                                            $('.td_cusaddress').html('');
                                            $('.td_cusbalance').html('');
                                        }else{
                                            $(".btnsubmit").trigger('click');
                                        }

                                    }
                                });
                              }
                            }else{
                              $(".btnsubmit").trigger('click');
                            }

});

  var idinc = 0 ;
  $('#btnpdtmodal').click(function(){
    clearrows();
    $('#idincid').val(0);

  });
  function loadCustByid(id){
    $.ajax({
      url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
			async:false,
      success: function(results) {
        var result = JSON.parse(results)[0];
        $('#customer_id').val(result.id);
        $('.td_cusname').html(result.name);
        $('.td_cusaddress').html(result.address_line1 +', GSTIN : '+result.tin);
        $(".td_cusbalance").html(0);
        $.ajax({
          url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
          success: function(results) {
            $(".td_cusbalance").html(results);
          }
        });
      }
    });
  }
  $(document).on('click', '#btnsaveSupplierModal', function(){
		var frm = '#frmSuppliermodal';
		var modal_supplierName = $('#modal_supplierName').val();
		var	modal_supplierPhone = $('#modal_supplierPhone').val();
		var	modal_supplierGST = $('#modal_supplierGST').val();
		var	modal_supplierArea = 	$('#modal_supplierArea').val();
		var modal_supplierroute = $('#modal_supplierroute').val();
		var modal_supplierstate = $('#modal_supplierstate').val();
		var modal_supplierEmail = $('#modal_supplierEmail').val();
		var modal_supplierAdd1 = 	$('#modal_supplierAdd1').val();
		var modal_supplierAdd2 = 	$('#modal_supplierAdd2').val();
    var modal_pricelist = $('#modal_pricelist').val();
    var modal_cusrate = $('#modal_cusrate').val();


		var modal_supplierType = 	'cus';
    if(modal_supplierName !== ''){
			$.ajax({
				url: "<?php echo site_url('Modal/save_supplier'); ?>",
				type: 'POST',
				data: {modal_cusrate:modal_cusrate,modal_pricelist:modal_pricelist,modal_supplierType:modal_supplierType,modal_supplierAdd2:modal_supplierAdd2,modal_supplierAdd1:modal_supplierAdd1,modal_supplierEmail:modal_supplierEmail,modal_supplierstate:modal_supplierstate,modal_supplierroute:modal_supplierroute,modal_supplierArea:modal_supplierArea,modal_supplierName:modal_supplierName,modal_supplierPhone:modal_supplierPhone,modal_supplierGST:modal_supplierGST,},
				success: function (result) {
						var attr = $('#btnsaveSupplierModal').attr('hddid');
						$('#btncls').trigger('click');
						$('#myModal_Supplier').modal('hide');
						$('#modal_supplierName').val('');
						$('#modal_supplierPhone').val('');
						$('#modal_supplierGST').val('');
						$('#modal_supplierArea_text').val('');
						$('#modal_supplierArea').val('');
						$('#modal_supplierroute').val('');
						$('#modal_supplierstate').val('');
						$('#modal_supplierEmail').val('');
						$('#modal_supplierAdd1').val('');
						$('#modal_supplierAdd2').val('');
						loadCustByid(result);
            $('#cusModel').modal('show');
            $('#myModal_Supplier').modal('hide');
				}
			 });
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
                $("#modal_supplierstate").html(option);
                $("#modal_supplierstate").val(45);
                
            }
        });
      $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                //$('#modal_supplierArea').html(result);
                
            }
        });

        $("#modal_supplierArea_text").autocomplete({
            source: "<?php echo site_url('ajaxcall/search_area'); ?>",
            minLength: 2,
            appendTo: '#mainArea',
            select: function(event, ui) {
                $('#modal_supplierArea').val(ui.item.id);
                
            }
        });
        
        $("#modal_supplierArea_text").change(function(e){
            var modal_supplierArea = $('#modal_supplierArea').val();
            if(modal_supplierArea === '' ){
              modal_supplierArea = 0 ;
            }
            if(parseFloat(modal_supplierArea) < 1 ){
              $("#modal_supplierArea_text").val('');

            }
        });
        
        $.ajax({
            async: false,
            url: "<?php echo site_url('Customers/price_list'); ?>",
            success: function (result) {
                $('#modal_pricelist').html(result);
                
            }
        });

       
		
		$.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/route'); ?>",
            success: function (result) {
                $('#modal_supplierroute').html(result);
                
            }
        });
  $('.btncls').click(function(){
    $('#myModal_Supplier').modal('hide');
  });

  $('.close').click(function(){
    $('#myModal_Supplier').modal('hide');

  });


  $("#formmobilesales").submit(function(e){
      var sales_grand_total = $('#sales_grand_total').val();
      var cash_type = $('#cash_type').val();
      var customer_id = $('#customer_id').val();
      if(customer_id === ''){
        customer_id = 0;
      }
      var is_continue = 1;
      if(cash_type ==='Credit' ){
        if(customer_id < 1 ){
          is_continue = 0;
        }
      }
      if(parseFloat(sales_grand_total) > 0  && is_continue > 0  ){
        

      }else{
        e.preventDefault();
        $('#credittxts').html('Please Select a Customer ');
        if(parseFloat(sales_grand_total) < 1 ){
          $('#credittxts').html('Please Add Item ');
        }
        $('#creditmodals').modal('show');
      }
  });
  $('.clschange').change(function(){
    rowcalc();
  });

  function edit(btn){
    clearrows();
    var attr = $(btn).attr('attr');
    $('#idincid').val(attr);
    customer = $("#customer_id").val();
    if(customer ===''){
      customer = 0 ;
    }
    var item_id = $('#sal_itemid'+attr).val();
    console.log('item_id'+item_id);
    var salesrate = 0 ;
    $.ajax({
      url: "<?php echo site_url('mobile/Main/getitembyId'); ?>/" + item_id +'/'+customer,
      async:false,
      success: function(result) {
        $.each(JSON.parse(result), function (i, itemsingle) {
          salesrate = itemsingle.rate;
          $('#tdproductname').html('Product Name : '+itemsingle.name);

          $('#itemname').val(itemsingle.name);
        });
                    
      }
    });
    var sal_itemfqty = $('#sal_itemfqty'+attr).val();
    $('#itemfqty').val(sal_itemfqty);
    $('#itembaserate').val(salesrate);
    $('#item_id').val(item_id);
    $('#product').modal('show');
    var itemrate = $('#sal_itemrate'+attr).val();
    $('#itemrate').val(itemrate);
    var itemtax = $('#sal_itemtaxper'+attr).val();
    $('#itemtax').val(itemtax);
    var tax_id = $('#sal_itemtaxid'+attr).val();
    $('#itemtaxid').val(tax_id);
    var sal_itemqty = $('#sal_itemqty'+attr).val();
    $('#itemqty').val(sal_itemqty);
    var ces_id = $('#sal_itemces_id'+attr).val();
    var ces_percent = $('#sal_itemces_percent'+attr).val();
    var ces_name = '';
    $('#ces_id').val(ces_id);
    $('#ces_percent').val(ces_percent);
    $('#ces_name').val(ces_name);
    var discountper = $('#sal_itemdiscount'+attr).val();
    $('#itemdiscount').val(discountper);
    var unit_id = $('#sal_itemunit'+attr).val();
            
  $.ajax({
     url: "<?php echo site_url('ajaxcall/units'); ?>/" + item_id,
    async:false,
    success: function(result) {
             $('#item_unit').html(result);
            $('#item_unit').val(unit_id);
            rowcalc();
                    
     }
    });
  }
  function clearrows(){
    $('#item_id').val(0);
    $('#itemname').val('');
    $('#item_unit').val('');
    $('#itemqty').val(0);
    $('#itemfqty').val(0);
    $('#itembaserate').val(0);
    $('#itemrate').val(0);
    $('#tdproductname').html('');
    $('#itemsubtotal').val('');
    $('#itemtotaltax').val('');
    $('#itemcess').val('');
    $('#itemtotal').val('');
  }

  function calculateGtotal(){
    var amount = 0 ;
    var tax = 0;
    var cess = 0;
    var total = 0 ;
    $(".clstotal").each(function() {
      total = parseFloat(total) + parseFloat($(this).val() );
    });
    $(".clstax").each(function() {
      tax = parseFloat(tax) + parseFloat($(this).val() );
    });
    $(".clscess").each(function() {
      cess = parseFloat(cess) + parseFloat($(this).val() );
    });

    $(".clsamount").each(function() {
      amount = parseFloat(amount) + parseFloat($(this).val() );
    });

    $('#grand_subtotal').html(parseFloat(amount));
    $('#grand_gst').html(parseFloat(tax).toFixed(2));
    $('#grand_cess').html(parseFloat(cess).toFixed(2));
    $('#grand_total').html(parseFloat(total).toFixed(2));

    $('#sales_grand_subtotal').val(parseFloat(amount).toFixed(2));
    $('#sales_grand_gst').val(parseFloat(tax).toFixed(2));
    $('#sales_grand_cess').val(parseFloat(cess).toFixed(2));
    $('#sales_grand_total').val(parseFloat(total).toFixed(2));
  }
  function remove(btn){
    var attr = $(btn).attr('index');
    $(btn).closest('tr').remove();
    $('#tr'+attr).remove();
    calculateGtotal();
  }
  function addrowtocalc(item_id,itemname,itemqty,itemfqty,unit_id,unitname,itembaserate,itemrate,ces_id,itemdiscount,ces_percent,itemprate,itemmrp,itemtaxid,itemtax,itemsubtotal,itemtotaltax,itemcess,itemtotal,itemdiscounts,disamt){
    idinc = idinc + 1;
    var idincid = $('#idincid').val();
    if(parseInt(idincid) > 0  ){
      $('#rem'+idincid).trigger('click');
    }
    var trbody = '<tr id ="tr'+idinc+'" >';
    trbody = trbody + '<td colspan = "2" style ="font-size:14px;" >Item Name : '+itemname+'<input type ="hidden" name ="sal_itemdiscount[]" id ="sal_itemdiscount'+idinc+'"  value ="'+itemdiscount+'"  class = "" ><input type ="hidden" name ="sal_itemsubtotal[]" id ="sal_itemsubtotal'+idinc+'"  value ="'+itemsubtotal+'"  class = "clsamount" > <input type ="hidden" name ="sal_itemid[]" id ="sal_itemid'+idinc+'"  value ="'+item_id+'" ></td>>/tr>';
    trbody = trbody + '<tr><td style ="font-size:14px;" ><br />Quantity : <input  attr = "'+idinc+'" class ="form-control changerate"   style= "display:none; " type ="text" name ="sal_itemqty[]" id ="sal_itemqty'+idinc+'"  value ="'+itemqty+'" >'+itemqty+' ';
    trbody = trbody + '<br />Unit :'+unitname+'<input type ="hidden" name ="sal_itemunit[]" id ="sal_itemunit'+idinc+'"  value ="'+unit_id+'" >';
    trbody = trbody + '<br /> Rate :<input style= "display:none; " type ="text" class ="form-control changerate" attr = "'+idinc+'"  name ="sal_itemrate[]" id ="sal_itemrate'+idinc+'"  value ="'+itemrate+'" >'+itemrate+'';
    trbody = trbody + '<input type ="hidden" name ="sal_itemces_percent[]" id ="sal_itemces_percent'+idinc+'"  value ="'+ces_percent+'"  ><input type ="hidden" name ="sal_itemces_id[]" id ="sal_itemces_id'+idinc+'"  value ="'+ces_id+'"  ><input type ="text" class ="form-control clscess" name ="sal_itemcess[]" id ="sal_itemcess'+idinc+'" style= "display:none;" readonly value ="'+itemcess+'" >';
    trbody = trbody + '<br /> Total :<input style= "display:none; " type ="text" class ="form-control clstotal" name ="sal_itemtotal[]" id ="sal_itemtotal'+idinc+'" readonly value ="'+itemtotal+'" >'+itemtotal+'';
    trbody = trbody + '<br /><button type="button" attr = '+idinc+'  data-toggle="tooltip" onclick="edit(this)" index="'+idinc+'" title="Remove" class="btn btn-success editrow">Edit</button>&nbsp;&nbsp;<button type="button" data-toggle="tooltip" id = "rem'+idinc+'" onclick="remove(this)" index="'+idinc+'" title="Remove" class="btn btn-danger remove">Remove</button></td>';
    trbody =trbody + '<td style ="font-size:14px;">';
    trbody = trbody + '<br />Free Quantity :<input class ="form-control"  style= "display:none; " type ="text" name ="sal_itemfqty[]" id ="sal_itemfqty'+idinc+'"  value ="'+itemfqty+'" >'+itemfqty+'';
    trbody = trbody +'<br /> Discount :<input class ="form-control type ="text" style= "display:none; " readonly name ="sal_itemdis_amt[]" id ="sal_itemdis_amt'+idinc+'"  value ="'+disamt+'"  class = "" >'+disamt+'';
    trbody = trbody + '<br />Tax:<input type ="hidden" name ="sal_itemtaxper[]" id ="sal_itemtaxper'+idinc+'"  value ="'+itemtax+'" ><input type ="hidden" name ="sal_itemtaxid[]" id ="sal_itemtaxid'+idinc+'"  value ="'+itemtaxid+'" ><input type ="text" class ="form-control clstax" name ="sal_itemtax[]" id ="sal_itemtax'+idinc+'" style= "display:none; " readonly value ="'+itemtotaltax+'" >'+itemtotaltax+' <br /> Cess : '+itemcess+' ';
    trbody =trbody + '</td>';
    
    trbody =trbody + '</tr>';

    $('#tblpdts').append(trbody);
    $('#product').modal('hide');
    clearrows();
    calculateGtotal();
  }

  $(document).on("change",".changerate",function() {
     var attr = $(this).attr('attr');
  });

  $(document).on("click",".btnaddcustomer",function() {
    $('#cusModel').modal('hide');
    $('#modal_supplierArea_text').val('');
		$('#modal_supplierArea').val('');
    $('#myModal_Supplier').modal('show');
  });
  $(document).on("click",".btnadditm",function() {
    var item_id = $('#item_id').val();
    var itemname = $('#itemname').val();
    var itemqty = $('#itemqty').val();
    var itemfqty = $('#itemfqty').val();
    var itembaserate = $('#itembaserate').val();
    var itemrate = $('#itemrate').val();
    var ces_id = $('#ces_id').val();
    var itemdiscount = $('#itemdiscount').val();
    var ces_percent = $('#ces_percent').val();
    var itemprate = $('#itemprate').val();
    var itemmrp = $('#itemmrp').val();
    var itemtaxid = $('#itemtaxid').val();
    var itemtax = $('#itemtax').val();
    var itemsubtotal = $('#itemsubtotal').val();
    var itemtotaltax = $('#itemtotaltax').val();
    var itemcess = $('#itemcess').val();
    var itemtotal = $('#itemtotal').val();
    var unitname = $('#item_unit').find(':selected').text();
    var unit_id = $('#item_unit').val();

    var disamt = $('#disamt').val();
    var itemdiscount = $('#itemdiscount').val();
    if(unit_id ==='' || unit_id === undefined){
      unit_id = 0 ;
    }
    if(parseFloat(unit_id) > 0  && parseFloat(itemtotal) > 0  ){
      addrowtocalc(item_id,itemname,itemqty,itemfqty,unit_id,unitname,itembaserate,itemrate,ces_id,itemdiscount,ces_percent,itemprate,itemmrp,itemtaxid,itemtax,itemsubtotal,itemtotaltax,itemcess,itemtotal,itemdiscount,disamt);
    }
  });
  $(document).on("change","#item_unit",function() {
    var itembaserate = $('#itembaserate').val();
    if(parseFloat(itembaserate) > 0  ){
        var myTag = $(this).find(':selected').attr('count');
        var mrp = $('#itembaserate').val();
        myTag = myTag * mrp;
        $('#itemrate').val(parseFloat(myTag).toFixed(2));
        rowcalc();
    }
  });
  function rowcalc(){
    var ces_id = $('#ces_id').val();
    var itemdiscount = $('#itemdiscount').val();
    var ces_percent = $('#ces_percent').val();
    var item_ces_per = ces_percent;
    var ces_name = $('#ces_name').val();
    var itemtax = $('#itemtax').val();
    var tax = itemtax;
    var itemrate = $('#itemrate').val();
    var itembaserate = $('#itembaserate').val();
    var is_taxincuded = $('#is_taxincuded').val();
    var quantity = $('#itemqty').val();
    var total = parseFloat(itemrate)  * parseFloat(quantity);
    var discount_amount = 0 ;
    var rowitemces = 0 ;
    var tax_before = parseFloat(itemtax);
    if(parseFloat(itemdiscount) > 0  ){
      discount_amount = parseFloat(total) * parseFloat(itemdiscount)/100;
      total = parseFloat(total) - parseFloat(discount_amount) ;
    }

    if(parseFloat(ces_percent) > 0  ){
      tax_before = parseFloat(tax) + parseFloat(item_ces_per);
    }
    var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax_before) + 100));
    var cess_amount = parseFloat(total) - parseFloat(taxamt);
    if (is_taxincuded === "0") {
      taxamt = parseFloat(total) * parseFloat(tax) / 100;
      cess_amount = parseFloat(total);
      total = (parseFloat(total) + parseFloat(taxamt));
    } else {
        taxamt = ((parseFloat(total) * 100) / (parseFloat(tax_before) + 100));
        taxamt = taxamt * tax / 100;
    }

    if (parseFloat(item_ces_per) > 0 && parseFloat(cess_amount) > 0) {
        rowitemces = parseFloat(cess_amount) * parseFloat(item_ces_per) / 100;
    }

    if (is_taxincuded === "0") {
      total = (parseFloat(total) + parseFloat(rowitemces));
    }
    $('#disamt').val(parseFloat(discount_amount).toFixed(2));
    $('#itemsubtotal').val(parseFloat(parseFloat(total) - parseFloat(taxamt) - parseFloat(rowitemces)).toFixed(2));
    $('#itemcess').val(parseFloat(rowitemces).toFixed(2));
    $('#itemtotal').val(parseFloat(total).toFixed(2));
    $('#itemtotaltax').val(parseFloat(taxamt).toFixed(2));

  }
    $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            appendTo: '#mainSale',
            select: function(event, ui) {
              checkstatus(ui);
                $('#customer_id').val(ui.item.id);
                $('.td_cusname').html(ui.item.name);
                $('.td_cusaddress').html(ui.item.address_line1 +', GSTIN : '+ui.item.tin);
                $.ajax({
                    url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                    success: function(results) {
                        $(".td_cusbalance").html(results);
                    }
                });
            }
        });

        $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value ="">Category</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#item_category_id").html(option);
                
            }
        });

        $.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value ="">Brand</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#item_brand_id").html(option);
            }
        });

        $('#itemname').autoComplete({
        minChars: 2,
        cache: false,
        appendTo: '#divitem',
        source: function(term, response) {
            if(list_view_mode) {
                response([]); // Don't show autocomplete in list view mode
                return;
            }
            var item_brand_id = $('#item_brand_id').val();
            if(item_brand_id === ''){
                item_brand_id = 0;
            }
            var item_category_id = $('#item_category_id').val();
            if(item_category_id ===''){
                item_category_id = 0 ;
            }
            customer = $("#customer_id").val();
            if(customer ===''){
                customer = 0 ;
            }
            xhr = $.getJSON('<?php echo base_url(); ?>mobile/Main/itemssearch/'+item_category_id +'/' + customer + '?', {
                term: term,
                brand_id: item_brand_id
            }, function(data) {
                response(data);
            });
        },
        renderItem: function(item, search) {
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
            var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
            var GST = item.GST;
            console.log(GST);
            return '<div class="autocomplete-suggestion" data-val="' + item.label + '" data-taxp="' + GST + '" data-item_id="' + item.item_id + '" data-name="' + item.name + '"  data-mrp="' + item.MRP + '" data-ces_id="' + item.ces_id + '" data-ces_percent="' + item.ces_percent + '" data-ces_name="' + item.ces_name + '" data-free_qty="' + item.free_qty + '" data-free_qty_for="' + item.free_qty_for + '"  data-unit_id="' + item.unit_id + '" data-name="' + item.name + '"  data-tax_id="' + item.tax_id + '" data-id="' + item.id + '"  data-prate="' + item.prate + '" data-rate="' + item.rate + '" data-stock="' + item.stock + '"  data-special_rate="' + item.special_rate + '"  data-wh_rate="' + item.wh_rate + '" data-srate="' + item.srate + '"   data-discount="' + item.discount + '"    >' + item.label.replace(re, "<b>$1</b>") + '</div>';
        },
        onSelect: function(e, term, item) {
            selectProduct(item.data());
            $('#div_product_list').hide();
        }
    });

    var list_view_mode = false;
    $('#btnpdtmodal').click(function() {
        clearrows();
        $('#idincid').val(0);
        list_view_mode = false;
        $('#div_product_list').hide();
    });

    $('#btnpdtlistmodal').click(function() {
        clearrows();
        $('#idincid').val(0);
        list_view_mode = true;
        $('#div_product_list').show();
        setTimeout(fetchProducts, 500);
    });

    function fetchProducts() {
        if(!list_view_mode) return;
        var term = $('#itemname').val();
        var item_brand_id = $('#item_brand_id').val() || 0;
        var item_category_id = $('#item_category_id').val() || 0;
        var customer = $("#customer_id").val() || 0;

        $.getJSON('<?php echo base_url(); ?>mobile/Main/itemssearch/' + item_category_id + '/' + customer + '?', {
            term: term,
            brand_id: item_brand_id
        }, function(data) {
            var html = '';
            $.each(data, function(i, item) {
                var imgSrc = item.image ? '<?php echo base_url(); ?>uploads/images/item/' + item.image : '<?php echo base_url(); ?>assets/img/no-image.png';
                var stockClass = parseFloat(item.stock) > 0 ? 'in-stock' : '';
                
                html += '<div class="pdt-card pdt-item-row" data-item=\'' + JSON.stringify(item).replace(/'/g, "&apos;") + '\'>';
                html += '  <div class="pdt-card-checkbox"></div>';
                html += '  <div class="pdt-image-box">';
                html += '    <img src="' + imgSrc + '" onerror="this.src=\'<?php echo base_url(); ?>uploads/images/item/3875172.png\'">';
                html += '  </div>';
                html += '  <div class="pdt-details">';
                html += '    <div class="pdt-title">' + item.name + '</div>';
                html += '    <div class="pdt-meta">';
                html += '      <span class="pdt-price-badge">₹' + item.rate + '</span>';
                html += '      <span class="pdt-stock-badge ' + stockClass + '">Stock: ' + item.stock + '</span>';
                html += '    </div>';
                html += '    <div class="pdt-qty-section">';
                html += '      <div><span class="pdt-qty-label">Qty</span><br/><input type="number" class="pdt-qty-input card-item-qty" value="1" onclick="event.stopPropagation()"></div>';
                html += '      <div><span class="pdt-qty-label">F.Qty</span><br/><input type="number" class="pdt-qty-input card-item-fqty" value="0" onclick="event.stopPropagation()"></div>';
                html += '    </div>';
                html += '    <div style="font-size: 10px; color: #9ca3af; margin-top: 6px;">BC: ' + item.barcode + ' | MRP: ₹' + item.MRP + '</div>';
                html += '  </div>';
                html += '</div>';
            });
            $('#ul_product_list').html(html);
            $('#div_product_list').show();
        });
    }

    $(document).on('change', '#item_category_id, #item_brand_id', function() {
        if(list_view_mode) fetchProducts();
    });

    $('#itemname').on('keyup', function() {
        if(list_view_mode) fetchProducts();
    });

    $(document).on('click', '.pdt-item-row', function(e) {
        if($(e.target).is('input')) return;
        $(this).toggleClass('selected');
    });

    $(document).on("click", ".btnadditm", function() {
        var selectedCards = $('.pdt-card.selected');
        if (selectedCards.length === 0) {
            alert('Please select at least one item');
            return;
        }

        selectedCards.each(function() {
            var card = $(this);
            var itemData = card.data('item');
            var qty = card.find('.card-item-qty').val() || 1;
            var fqty = card.find('.card-item-fqty').val() || 0;
            
            processBatchItem(itemData, qty, fqty);
        });

        $('#product').modal('hide');
        $('.pdt-card').removeClass('selected');
    });

    function processBatchItem(itemData, qty, fqty) {
        var item_id = itemData.item_id;
        var unit_id = itemData.unit_id;
        var tax_id = itemData.tax_id;
        var GST = itemData.GST || itemData.taxp;
        var salesrate = itemData.rate;
        var ces_id = itemData.ces_id;
        var ces_percent = itemData.ces_percent;
        var ces_name = itemData.ces_name;
        var discount = itemData.discount || 0;
        var prate = itemData.prate;
        var mrp = itemData.MRP || itemData.mrp;
        var name = itemData.name;
        var is_taxincuded = $('#is_taxincuded').val();

        // Fetch units and unit name synchronously for batch processing
        var unitName = '';
        $.ajax({
            url: "<?php echo site_url('ajaxcall/units'); ?>/" + item_id,
            async: false,
            success: function(result) {
                $('#temp_unit_loader').html(result);
                unitName = $('#temp_unit_loader select option:selected').text();
                // If the item has a specific unit_id, we should find its name
                if(unit_id) {
                    var selectedOption = $('#temp_unit_loader select option[value="' + unit_id + '"]');
                    if(selectedOption.length > 0) {
                        unitName = selectedOption.text();
                    }
                }
            }
        });

        // Calculation logic (parameterized rowcalc)
        var total = parseFloat(salesrate) * parseFloat(qty);
        var discount_amount = 0;
        var rowitemces = 0;
        var tax_before = parseFloat(GST);

        if (parseFloat(discount) > 0) {
            discount_amount = parseFloat(total) * parseFloat(discount) / 100;
            total = parseFloat(total) - parseFloat(discount_amount);
        }

        if (parseFloat(ces_percent) > 0) {
            tax_before = parseFloat(GST) + parseFloat(ces_percent);
        }

        var taxamt = 0;
        var cess_amount = 0;

        if (is_taxincuded === "0") {
            taxamt = parseFloat(total) * parseFloat(GST) / 100;
            cess_amount = parseFloat(total);
            total = (parseFloat(total) + parseFloat(taxamt));
        } else {
            taxamt = ((parseFloat(total) * 100) / (parseFloat(tax_before) + 100));
            taxamt = taxamt * GST / 100;
            cess_amount = ((parseFloat(total) * 100) / (parseFloat(tax_before) + 100));
        }

        if (parseFloat(ces_percent) > 0 && parseFloat(cess_amount) > 0) {
            rowitemces = parseFloat(cess_amount) * parseFloat(ces_percent) / 100;
        }

        if (is_taxincuded === "0") {
            total = (parseFloat(total) + parseFloat(rowitemces));
        }

        var itemsubtotal = (parseFloat(total) - parseFloat(taxamt) - parseFloat(rowitemces)).toFixed(2);
        var itemtotaltax = parseFloat(taxamt).toFixed(2);
        var itemcess = parseFloat(rowitemces).toFixed(2);
        var itemtotal = parseFloat(total).toFixed(2);
        var disamt = parseFloat(discount_amount).toFixed(2);

        addrowtocalc(item_id, name, qty, fqty, unit_id, unitName, salesrate, salesrate, ces_id, discount, ces_percent, prate, mrp, tax_id, GST, itemsubtotal, itemtotaltax, itemcess, itemtotal, discount, disamt);
    }

    function selectProduct(itemData) {
        // For autocomplete, we just add it immediately with default qty 1
        processBatchItem(itemData, 1, 0);
        $('#product').modal('hide');
    }
    
    function rowcalc() {
        var ces_id = $('#ces_id').val();
        var itemdiscount = $('#itemdiscount').val();
        var ces_percent = $('#ces_percent').val();
        var item_ces_per = ces_percent;
        var ces_name = $('#ces_name').val();
        var itemtax = $('#itemtax').val();
        var tax = itemtax;
        var itemrate = $('#itemrate').val();
        var is_taxincuded = $('#is_taxincuded').val();
        var quantity = $('#itemqty').val();
        var total = parseFloat(itemrate) * parseFloat(quantity);
        var discount_amount = 0;
        var rowitemces = 0;
        var tax_before = parseFloat(itemtax);
        
        if (parseFloat(itemdiscount) > 0) {
            discount_amount = parseFloat(total) * parseFloat(itemdiscount) / 100;
            total = parseFloat(total) - parseFloat(discount_amount);
        }

        if (parseFloat(ces_percent) > 0) {
            tax_before = parseFloat(tax) + parseFloat(item_ces_per);
        }
        
        var taxamt = 0;
        var cess_amount = 0;
        
        if (is_taxincuded === "0") {
            taxamt = parseFloat(total) * parseFloat(tax) / 100;
            cess_amount = parseFloat(total);
            total = (parseFloat(total) + parseFloat(taxamt));
        } else {
            taxamt = ((parseFloat(total) * 100) / (parseFloat(tax_before) + 100));
            taxamt = taxamt * tax / 100;
            cess_amount = ((parseFloat(total) * 100) / (parseFloat(tax_before) + 100));
        }

        if (parseFloat(item_ces_per) > 0 && parseFloat(cess_amount) > 0) {
            rowitemces = parseFloat(cess_amount) * parseFloat(item_ces_per) / 100;
        }

        if (is_taxincuded === "0") {
            total = (parseFloat(total) + parseFloat(rowitemces));
        }
        
        $('#disamt').val(parseFloat(discount_amount).toFixed(2));
        $('#itemsubtotal').val(parseFloat(parseFloat(total) - parseFloat(taxamt) - parseFloat(rowitemces)).toFixed(2));
        $('#itemcess').val(parseFloat(rowitemces).toFixed(2));
        $('#itemtotal').val(parseFloat(total).toFixed(2));
        $('#itemtotaltax').val(parseFloat(taxamt).toFixed(2));
    }
</script>