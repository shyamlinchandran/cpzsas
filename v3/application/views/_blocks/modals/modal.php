<?php $com = $this->session->userdata('dbcompany') ?>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="commsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Admin Message</h5>
            </div>
            <div class="modal-body" id="msgcomval">

            </div>

        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="closablecommsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Admin Message</h5>
                <!-- Close Button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="closablemsgcomval">

           <p> Dear customer welcome to <b>New Financial Year</b>!!!!!</p>
           <p>Please check the following points regarding <b>YEP</b></p>
           <ul>
                <li>Confirm your  database is new and there is no data from previous year</li>
                <li>Update and confirm the opening stock and opening  ledger balances</li>
                <li>Your current company ID is use for the new year and add 2024(without space) for getting the old year(eg :abc2024)</li>
                <li>Ensure all vouchers and invoices are start with new Starting No 1 with prefix and  FY25-26 .confirm with your auditor also</li>
                <li>If you are using <b>Mobile app</b> for order and billing please clear the app data and confirm with New Year logging.</li>
            </ul>
           
 
<!-- Customer Care: 9847861200<br/>
                           :8590690585<br/> -->

                <!-- Your content goes here -->
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        //('#commsg').modal('show');
        // $.ajax({
        //     url: '<?php echo $this->session->userdata('baseurl'); ?>/company/get/<?php print_r($com['comkey']); ?>',
        //     success: function(data) {
        //         if (data.message != '') {
        //             $("#msgcomval").html(data.message)
        //             $('#commsg').modal('show');
        //             setInterval(function() {
        //                 $('#commsg').modal('hide');
        //             }, 10000);
        //         }

        //     }
        // });


        $.ajax({
            url: "<?php echo site_url('ajaxcall/getmsg'); ?>",
            success: function(result) {
                $.each(JSON.parse(result), function(i, itemsingle) {
					//	$('#closablecommsg').modal('show');
				});

            }
        });

    })
</script>