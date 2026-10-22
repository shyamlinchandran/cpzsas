<?php $url = str_replace(base_url(), "", current_url()); ?>
<script type="text/javascript" >  
    function  loadpermission() {
        $.ajax({
            data: {'url': '<?php echo $url; ?>'},
            type: 'POST',
            dataType: 'json',
            url: '<?php echo base_url() . 'dashboard/getpermission'; ?>',
            success: function (result) {
                if (result !== 'null' && result !== null) {
                    if (result.is_delete === '0') {
                        $('.btn-danger').remove();
                        $('.btn-warning').remove();
                    }
                    if (result.is_write === '0') {
                        $('.btn-success').remove();
                    }
                    if (result.is_read === '0') {
                        $('.btn-info').remove();
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

