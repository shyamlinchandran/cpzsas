<?php 
	
$user = $this->session->userdata('user');
$user_id = $user['Id'];	
?>
<form method="post"  id="frmcreate" back="<?php echo site_url('transaction/chque/create'); ?>" action="<?php echo site_url('transaction/chque/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="chq_id" id="id" /> 
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id='user_id' />
    <input type="hidden" value="<?= $type ?>" name="type" id="type" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Cheque Details', $this, $user) ?> </h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('chque/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('transaction/chque/list_all'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>

                    <div class="box-body">
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Branch', $this, $user) ?><span class="required">*</span>  :

                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <select tabindex="-1" id="branch" name="branch" class="form-control " >                                            
                                </select> 
                            </div> 
                        </div>
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Transaction Type', $this, $user) ?><span class="required">*</span>  :

                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <select id="chq_trans"  class="form-control" name="chq_trans"> 
                                    <option value="Clearing">PDC Clearing </option>
                                    <option value="Issue">Issue</option>
                                </select>     
                            </div> 
                        </div>
                        <div class="form-group" id="check_From">
                            <label class="col-sm-2 control-label" id="name_display_as_box" >
                                <?= label('Cheque From', $this, $user) ?> <span class="required">*</span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input type="hidden" class="form-control" id="chq_frm" name="chq_frm"/> 
                                <input  NoTab="true" type="text" class="form-control" id="chqe_frm" data-validation="required"/>         
                            </div> 
                        </div>
                        <div class="form-group" id="check_To">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Cheque To', $this, $user) ?> <span class="required">*</span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input type="hidden" class="form-control" id="chq_to" name="chq_to"/> 
                                <input id="chqe_to" class="form-control"   type="text" value="" maxlength="50" data-validation="required">              
                            </div> 
                        </div>
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Date', $this, $user) ?> <span class="required">*</span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input id="chq_date" class="form-control date" name="chq_date" type="text"   maxlength="50" data-validation="required">              
                            </div> 
                        </div>
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Cheque Number', $this, $user) ?> <span class="required">*</span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input id="chq_no" class="form-control" name="chq_no" type="text" value="" maxlength="50" data-validation="required">              
                            </div> 
                        </div>

                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Cheque Amount', $this, $user) ?> <span class="required">*</span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="chq_amount" class="form-control two-digits price" name="chq_amount" type="number" value="0" maxlength="50" data-validation="required">              
                            </div> 
                        </div>
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Bank', $this, $user) ?> <span class="required">*</span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input id="chq_bank" class="form-control" name="chq_bank" type="text" value="" maxlength="50" data-validation="required">              
                            </div> 
                        </div>
                        <!--                        <div class="form-group" id="name_field_box">
                                                    <label class="col-sm-2 control-label" id="name_display_as_box">
                                                        Status<span class="required">*</span>  :
                                                    </label>
                                                    <div class="col-sm-10" id="name_input_box">
                                                        <select id="chq_status"  class="form-control" name="chq_status">  
                                                            <option value="Submitted">Submitted</option>
                                                            <option value="Cleared">Cleared</option>
                                                            <option value="Rejected">Rejected</option> 
                                                        </select>               
                                                    </div> 
                                                </div> -->
                    </div>

                    <div class="form-group" id="name_field_box">
                        <label class="col-sm-2 control-label" id="name_display_as_box">
                            <?= label('Cheque Details', $this, $user) ?><span class="required">*</span>  :
                        </label>
                        <div class="col-sm-10" id="name_input_box">
                            <input id="chq_details" class="form-control" name="chq_details" type="text" value="" maxlength="500" data-validation="required">              
                        </div> 
                    </div> 
					
					 <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Collected By', $this, $user) ?><span class="required">*</span>  :

                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <select id="collected_by"  class="form-control" name="collected_by"> 
                                    
                                </select>     
                            </div> 
                        </div>
						
						
                    <div class="box-footer">  
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script type="text/javascript">
        $(document).on('submit', 'form', function () {
    var $form = $(this);
    var $button = $form.find('button[type="submit"], input[type="submit"]');
    
    // Check if the form is already submitting
    if ($form.data('submitted') === true) {
        return false; // Prevent the second submission
    }

    // Mark the form as submitting and disable the button
    $form.data('submitted', true);
    $button.prop('disabled', true).addClass('disabled');
    
    // Optional: Add a loading icon or change text so the user knows it's working
    $button.html('<i class="fa fa-spinner fa-spin"></i> Saving...'); 
});
        $(document).ready(function () {

            $('#chqe_to').change(function(){
                var chq_to =$('#chq_to').val();
                if(chq_to ===''){
                    chq_to = 0 ;
                }
                if(chq_to < 1){
                    $('#chqe_to').val('');
                }
            });


            $('#chqe_frm').change(function(){
                var chq_frm =$('#chq_frm').val();
                if(chq_frm ===''){
                    chq_frm = 0 ;
                }
                if(chq_frm < 1){
                    $('#chqe_frm').val('');
                }
            });
			 $.ajax({
				url: "<?php echo site_url('ajaxcall/salesman'); ?>",
				async:false,
				success: function(result) {
					$('#collected_by').html(result);
					var user_id = $('#user_id').val();
					$('#collected_by').val(user_id);
				}
			});
            load();
            smload();
            $("#chq_trans").change(function () {
                smload();
            });
            $("#chqe_frm").autocomplete({
                source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
                minLength: 2,
                select: function (event, ui) {
                    $("#chq_frm").val(ui.item.id);
                }
            });
            $("#chqe_to").autocomplete({
                source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
                minLength: 2,
                select: function (event, ui) {
                    $("#chq_to").val(ui.item.id);
                }
            });
            $.ajax({
                url: "<?php echo site_url('Ajaxcall/branch'); ?>/",
                async: false,
                success: function (result) {
                    $("#branch").html(result);
                    $("#branch option[value='']").remove();
                }
            });

        });
        function  smload() {
            var val = $("#chq_trans").val(); // Clearing  check_From  check_To
            if (val === 'Clearing') {
                $('#check_From').show();
                $('#check_To').hide();
                $("#chq_to").val(0);
            } else {
                $('#check_From').hide();
                $('#check_To').show();
                $("#chq_frm").val(0);
            }
        }
        function load() {
            var type = $('#type').val();
            if (type === 'v') {
                $('#form-button-save').hide();
            } else {
                $('#form-button-save').show();
            }
            var id = $("#id").val();
            $.ajax({
                url: "<?php echo site_url('transaction/chque/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#collected_by").val(result.collected_by);
                    $("#chq_trans").val(result.chq_trans);
                    $("#chq_no").val(result.chq_no);
                    $("#chq_amount").val(result.chq_amount);
                    $("#chq_bank").val(result.chq_bank);
                    //$("#chq_status").val(result.chq_status);
                    $("#chq_details").val(result.chq_details);
                    $("#branch").val(result.branch_id);
                    $("#chq_frm").val(result.chq_frm);
                    $("#chqe_frm").val(result.chqe_frm);
                    $("#chq_to").val(result.chq_to);
                    $("#chqe_to").val(result.chqe_to);
                    smload();
                }

            });
        }
    </script>