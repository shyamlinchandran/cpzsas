<?php $url = str_replace(base_url(), "", current_url()); ?>
<script type="text/javascript" >  
     function  loadpermission() {
        $.ajax({
            data: {'url': '<?php echo $url; ?>'},
            type: 'POST',
            dataType: 'json',
            url: '<?php echo base_url() . 'dashboard/getpermission'; ?>',
            success: function (result) {

                console.log('hahahahahhahahahahahhah');
                if (result !== 'null' && result !== null) {
                    if (result.is_delete === '0') {
                       // $('.btn-danger').remove(); 
                       $('.table-responsive').find('.glyphicon-remove-circle').closest('a').remove();
                       $('.groceryCrudTable').find('.glyphicon-remove-circle').closest('a').remove();
                    }
                    if (result.is_write === '0') {
                        //$('.btn-success').remove();
                        $('.glyphicon-edit').closest('a').remove();
                        $('.groceryCrudTable').find('.glyphicon-edit').closest('a').remove();

                        $('.table-responsive').find('.glyphicon-edit').closest('a').remove();

                    }
                    if (result.is_read === '0') {
                        //$('.btn-info').remove();
                        $('.glyphicon-eye-open').closest('a').remove();
                        $('.groceryCrudTable').find('.glyphicon-eye-open').closest('a').remove();

                        $('.table-responsive').find('.glyphicon-eye-open').closest('a').remove();

                    }

                    if (result.is_cancel === '0') {
                        //$('.btn-info').remove();
                        $('.glyphicon-ban-circle').closest('a').remove();
                        $('.groceryCrudTable').find('.glyphicon-ban-circle').closest('a').remove();

                        $('.table-responsive').find('.glyphicon-ban-circle').closest('a').remove();

                    }

                    if (result.is_read === '0') {
                        //$('.btn-info').remove();
                        $('.glyphicon-plus').closest('a').remove();

                    }
                }
                $('.hidden').removeClass('hidden');
            }

        })
    }
    $(document).ready(function () {
        $('.table_wrapper').addClass('hidden'); 
    })
</script>

