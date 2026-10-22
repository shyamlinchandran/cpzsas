<!-- 
    *********************************************************************************************
    *adddiscount
    *
    *
    *@author Althaf
    *@created on : 12-10-2019
    *
    *******************************************************************************************
 -->
 <form method="post"  id="frmcreatemodelc" back="<?php echo site_url('education/Course/university'); ?>" action="<?php echo site_url('education/Course/addUniversity/'); echo $id;?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 id = "head" class="box-title"><?= label('Discount Create', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('education/Course/university'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('education/Course/university'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <input type="hidden" name="invoice" id='invoice'/>
                    <div class="box-body">
                        <div class="row">    
                            <div class="col-12 col-md-3 col-lg-4"> 
                                <div class="">
                                    <?= label('University Name', $this, $user) ?>

                                    <input type="text" placeholder="Eg:- Referals" name="uniname" id="uniname" data-validation="required" class="form-control">
                                </div>

                            </div> 

                            <div class="col-12 col-md-3 col-lg-4"> 
                                <div class="">
                                    <?= label('University Code', $this, $user) ?>
                                    <input type = "text" class="form-control" name="unid" id="unid" >
                                </div>
                            </div> 
                        </div>  
                    </div>
                    <div class="box-footer"> 
                        <?php 
                        if($option != 'view'){
                        ?>
                            <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php 
                        }
                        ?>          
                    </div>
                    <!-- /.col -->
                </div>     
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>

<script>
 load();
    function load() {
        
        var source_id = $("#source_id").val();
        if (source_id > 0) {
            $.ajax({
                url: "<?php echo site_url('source_of_enquiry/Source_of_enquiry/getsing'); ?>/" + source_id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#source").val(result.source_of_enquiry);
                    $("#Details").val(result.details);
                }
            });
        }

        var id = $('#id').val();
        var option = $('#option').val()
        // alert(id);

        if (id > 0 && option != 'view') {
            $('#head').text('Discount Edit');
            $.ajax({
            url: "<?php echo site_url('education/Course/getOneUniversity'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results);
                $("#uniname").val(result.name);
                $("#unid").val(result.code);
            }
        });
        }
        else if (id > 0 && option == 'view') {
            $('#btnsaved').hide();
            $('#head').text('View Discounts');
            $.ajax({
            url: "<?php echo site_url('education/Course/getOneUniversity'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results);
                $("#uniname").val(result.name);
                $("#unid").val(result.code);
            }
        });
        }


    }

</script>
