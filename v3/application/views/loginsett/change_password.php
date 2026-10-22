  
<form method="post"  id="frmcreate" back="<?php echo site_url('settings/loginsett/change_password'); ?>" action="<?php echo site_url('settings/loginsett/new_password'); ?>"  class="form-horizontal">
   <!--  <input type="hidden" value="<?= $id ?>" name="id" id="id" />  -->
<section class="content">
 <div class="row">
        <div class="col-md-12">
          <div class="tab-pane active" id="tab_1">
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Change Password</h3>
                        <!-- <span class="pull-right">
                            <a role="button" back="" class="btn  btn-success align-bottom" href="<?php echo site_url('item\listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span> -->
                    </div>
              <div class="box-body"> 
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Current Password<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="pass" class="form-control" name="pass" type="password" value="" data-validation="required" maxlength="50">              
                            </div> 
                        </div>

                          <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                New Password<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">

                                <input id="npass" class="form-control" name="npass" type="password" value="" maxlength="50" data-validation="required">   
                                <!-- data-validation="strength" data-validation-strength="2"    -->        
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Repeat Password<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">

                                <input id="rpass" class="form-control" name="rpass" type="password" value="" maxlength="50" data-validation="confirmation" data-validation-confirm="npass" >
                                <label id="pswdmatch"></label>              
                            </div> 
                        </div>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
              </div>
 
            </div>
            <!-- /.tab-content -->
          </div>
      </div>
  </div>
</section>
</form>
<script>
$.validate({
  modules : 'security',
  onModulesLoaded : function() {
    }
});
</script>
<!--  <script type="text/javascript">

        $(document).ready(function () {
           
        });
        $(function() {
    $("#rpass").keyup(function() {
        var password = $("#npass").val();
        $("#pswdmatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
    });

});
</script> -->