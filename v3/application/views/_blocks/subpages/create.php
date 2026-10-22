<style>

</style> 
<?php 
    $backdate_entry = 1;
    if(isset($user['backdate_entry'])){
        $backdate_entry  = $user['backdate_entry'];
    }
    
    ?>    
<script type="text/javascript">
	
    $(document).ready(function () {
      // loads();
        $('input').attr('autocomplete', 'off');
        $('.form-control').nextTab();
        $(".two-digits").ForceNumericOnly();
		
        var dateexlnsh = $('#exdt31_uvaf32').val();
        var enddtshsll = new Date(dateexlnsh);
        var dateexlnsh= $('#exdt31_uvaf32').val(); 
        var enddtshsll=new Date(dateexlnsh); 
        $('.date').datepicker({  
            format: 'dd/mm/yyyy', 
            autoclose: true,
            constrainInput: false
        });
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('.date').datepicker('setDate', today);
        $('.date').datepicker('setEndDate', enddtshsll);
		$('.blankdate').val('');


         $('.date_expiry').datepicker({  
            format: 'dd/mm/yyyy', 
            autoclose: true,
            constrainInput: false
        });
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('.date_expiry').datepicker('setDate', today);


        $.validate();

        
    });
    var  currLoc = $(location).prop('href');

    <?php if( $backdate_entry < 1){?>
        if (currLoc.indexOf('v3/transaction') !== -1) {
            var datesxlnsh = '<?php echo date("Y-m-d", strtotime("-0 days"));?>';
            var startdtshsll=new Date(datesxlnsh); 
            $('.date').datepicker('setStartDate', startdtshsll);
        }
    <?php }?>
</script>