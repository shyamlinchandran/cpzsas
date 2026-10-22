
<?php
$is_taxincuded = $settings[0]['is_taxincluded'];

?>
<style>
  .modal {
    padding-right: 0px !important;
}
  </style>
<form method="post"  id ="formmobilesales"  action="<?php echo site_url('mobile/main/save/'); ?>" class="form-horizontal frmcreate">
  <div class="container-fluid">
    <br />
    <div class="forms-inputs mt-5">


        <div class="row">
          <div class="col-sm-6">
          <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded" />
          </div>
          <div class="col-sm-6">
            <!-- Button trigger modal -->
          
          </div>
        </div>
      
        
        <div class="row">
          <div class="col"> <h5>Vouchers </h5></div>
        
        </div>
        <div class="row">
          <div class="col-sm-12">
          <table   class="table table-condensed table-striped" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                           
							 <td class="col-sm-3">
                                      <?= label('Start Date', $this, $user) ?> 
                                    <input type="date" class="form-control " id="startdate"/> 
                                </td>
                                <td class="col-sm-3">
                                    <?= label('End Date', $this, $user) ?> 
                                    <input type="date" class="form-control " id="enddate"/> 
                                </td>
								
                              
								
                                <td class="col-sm-2">
                                    <br />
                                      <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                   </td>
                                   <td class="col-sm-3">
                                    </td>
                                
                              


                            </tr>
                        </tbody>
                    </table>  
            <table id="tableso"  class="table table-responsive table-condensed " cellspacing="0" width="100%">
              <thead class="bg-table">
                <tr>
                    <th>Sl no</th>
                    <th>Date</th>
                    <th>Created Date</th>
                    <th>Voucher No</th>
                    <th>Ledgers</th>
                    <th>Narration</th>
                    <th>Credit</th>
                    <th>Debit</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">

        </div>

    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade modal-fullscreen-md-down" id="product" tabindex="-1" aria-labelledby="productLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-body" id ="divitem" >
          
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btnadditm">Add</button>
        </div>
      </div>
    </div>
  </div>


  </form>

</body>

</html>
<script>

    

$(document).on("click",".btn-cancel-sales",function() {
    var sales_id = $(this).attr('sales_id');
       $.ajax({
             url: "<?php echo site_url('transaction/sales/cancel/estimate'); ?>/" + sales_id,
             success: function (result) {
                table.ajax.reload(null, false); 
             }
        });
  });
   var table;
   var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    var now = new Date();
        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
        table = $("#tableso").DataTable({
            "processing": true,
            "dom": 'Bfrtip',
             "buttons": [],
            "serverSide": true,
            "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                    "order": []
                }],
            "ajax": {
              "url": "<?php echo site_url('mobile/main/voucher_list') ?>",
                "type": "POST",
                "data": function (data) {
                  data.startdate = $('#startdate').val();
                  data.enddate = $('#enddate').val();
                  data.type = 'receipt';
                }
            }
        });


        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false); 
          });
</script>