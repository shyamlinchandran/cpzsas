$('#videoupload').submit(function(e) {
        e.preventDefault();
        var videos = document.getElementById("videos").files[0];
      
        var data = $('#videoupload').serialize();
        data.push({name: "vids", value: videos});
        $.ajax({
            url: '<?php echo site_url('inventory_master/item/uploadvideo'); ?>',
            type: 'post',
            data: $.param(data),
            success: function() {

            }
        });
    });