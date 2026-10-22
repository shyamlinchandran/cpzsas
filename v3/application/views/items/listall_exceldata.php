<?php
$add_url = site_url('Item/savefromexcel');
?>

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<input type="hidden" value="<?php echo $file_name; ?>" id="file_name" name="file_name"/> 
<input type="hidden" value="<?php echo $table_name; ?>" id="table_name" name="table_names"/> 
<table id="table"  class="table <?=$this->table_color?> table-responsive"> 
                    </table>
                    <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   
 

<script type="text/javascript">

    var table;

    $(document).ready(function () { 
$.post( "<?php echo site_url('Item/list_excel') ?>/"+ $('#file_name').val() + '/' + $('#table_name').val(), function( data ) {
  
  $("#table").html(data);
  
}); 



    });

</script>  