</div>
<!-- /.content-wrapper -->
<div class="modal fade bd-example-modal-lg" id="myModalPop" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-body" id="modal-body"> 
            </div> 
            <div class="modal-footer">
                <button type="button" id="mcb" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="mClick" popup_type="item" class="btn btn-primary">Save changes</button>
            </div>
        </div> 
    </div>
</div>



<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
 
<footer class="main-footer no-print" style="margin-left: 0px !important">
    <div class="pull-right hidden-xs">
        <?php $comid = $this->session->userdata('login_comid'); ?>
        <b>Current DB-<?= $comid ?>  Version- 1</b>  
    </div>
    <strong>Copyright &copy; 2016-<?= date('Y') ?><!--  <a target="_blank" href="https://dimindinnovations.co.in/">Dimind Innovations</a>. --></strong> All rights
    reserved.
</footer !-->
<script type="text/javascript">
var company_roundoff = '<?php echo $this->company_roundoff; ?>';
if(company_roundoff ==''){
    company_roundoff =2;
}
function loads() { 
<?php
$allmenus = $this->load->get_var('menus');
foreach ($allmenus as $menu) {
    if ($menu['menu_key'] != '') {
        echo "$(document).bind('keydown','" . $menu['menu_key'] . "',function (evt){ $('#" . str_replace("+", "_", $menu['menu_key']) . "').click();  return false; }); \n";
        echo "$(':input').bind('keydown','" . $menu['menu_key'] . "',function (evt){ $('#" . str_replace("+", "_", $menu['menu_key']) . "').click();  return false; }); \n";
    }
}
?>

    }
    loads();
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    function printDiv(id,hedding ='') { 
        var text ='';
        if(id = 'detaild'){
            var  startdate = $('#startdate').val();
            var enddate = $('#enddate').val();
           // alert(enddate);
           text = 'From '+ startdate +' To ' + enddate;
        }
        var divToPrint = document.getElementById(id); 
        var newWin = window.open('', 'Print-Window'); 
        newWin.document.open(); 
        newWin.document.write('<html  moznomarginboxes mozdisallowselectionprint>'); 
        newWin.document.write('<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bower_components/bootstrap/dist/css/bootstrap.min.css">');
        newWin.document.write('<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css">'); 
        newWin.document.write('<body onload="window.print()">'); 
        var company = $("#exdt31_com32").val();
        var header ="<div class='row'>";
        header =header+"<div class='col-12 text-center' ><h2>"+company+" </h2></div>";
        header =header+"</div>";
        header =header+"<div class='row'>";
        if (hedding!==''){
            header =header+"<div class='col-12 col-md-12 text-center ' ><h4>"+hedding+"</h4><b>"+text+"</b></div>";
        } 
        header =header+"<div class='col-4 col-md-4 text-left' ></div>";
       // header =header+"<div class='col-12 col-md-12 text-right' ><?php echo date("d-m-Y")  ?></div>";
        header =header+"</div>";
        newWin.document.write(header);
        newWin.document.write(divToPrint.innerHTML);
        newWin.document.write('<hr />');
        newWin.document.write('<br />');
        newWin.document.write("<div class='col-12 col-md-12 text-right' >Printed Date : <?php echo date("d-m-Y")  ?></div>");
        newWin.document.write('</body></html>');
        newWin.document.close(); 
        setTimeout(function() {
          newWin.close();
        }, 0); 
    }
	function modalsetbarcode(){
		var is_manual = $('input[name=modal_isautoBarcode]:checked').val();
		if (is_manual === '0') {
			 $("#modal_itemBarcode").attr('readonly', false);
			 $("#modal_itemBarcode").val('');
		}
		else{
				$.ajax({
                    url: "<?php echo site_url('item/getbarcode'); ?>" ,
                    success: function (result) {
                        $("#modal_itemBarcode").val(result);
                    }
                });
		}
	}
	$(document).on('click', '.btnadditem', function(){
		var attr = $(this).attr('hddid');
		modalsetbarcode();
		$('#btnsaveitemModal').attr('hddid',attr);
		$('#myModal_item').modal();
	});
	
	function switchdatabase(id){
		$.ajax({
				url: "<?php echo site_url('Billformat/switchdatabase/'); ?>"+id,
				type: 'POST',
				success: function (result) {
					location.reload();
				}
			 });
	}
	
	$(document).on('click', '.btnaddcustomer', function(){
		var attr = $(this).attr('hddid');
		$('#btnsaveSupplierModal').attr('hddid',attr);
		$('#modal_supplierType').val('cus');
		$('#modal_title_Supplier').html('Customer ');
		$('#modal_field_Supplier').html('Customer ');
		$('#myModal_Supplier').modal();
	});
	
	$(document).on('click', '.btnaddsupplier', function(){
		var attr = $(this).attr('hddid');
		$('#modal_supplierType').val('sup');
		$('#btnsaveSupplierModal').attr('hddid',attr);
		$('#modal_title_Supplier').html('Supplier ');
		$('#modal_field_Supplier').html('Supplier ');
		$('#myModal_Supplier').modal();
	});
	
	$(document).on('click', '#btnsaveSupplierModal', function(){
		var frm = '#frmSuppliermodal';
		var data = $(frm).serializeArray();
		 $("#frmSuppliermodal").validate();            // <- INITIALIZES PLUGIN
         isValid = $("#frmSuppliermodal").isValid();
         if (isValid) {
			$.ajax({
				url: "<?php echo site_url('Modal/save_supplier'); ?>",
				type: 'POST',
				data: data,
				success: function (result) {
						var attr = $('#btnsaveSupplierModal').attr('hddid');
						$('#btncls').trigger('click');
						$('#myModal_Supplier').modal('hide');
						$('#modal_supplierName').val('');
						$('#modal_supplierPhone').val('');
                        $('#modal_supplierName').val('');
						$('#modal_supplierPhone').val('');
						$('#modal_aadhar').val('');
						$('#modal_pan').val('');
						$('#modal_supplierGST').val('');
						$('#modal_supplierArea').val('');
						$('#modal_supplierstate').val('');
						$('#modal_supplierEmail').val('');
						$('#modal_supplierAdd1').val('');
						$('#modal_supplierAdd2').val('');
						loadCustByid(result);
				}
			 });
		 }
	});
	
	
	$(document).on('click', '#btnsaveitemModal', function(){
		var frm = '#frmItemmodal';
		var data = $(frm).serializeArray();
		 $("#frmItemmodal").validate();            // <- INITIALIZES PLUGIN
         isValid = $("#frmItemmodal").isValid();
         if (isValid) {
			$.ajax({
				url: "<?php echo site_url('Modal/save_item'); ?>",
				type: 'POST',
				data: data,
				success: function (result) {
						var attr = $('#btnsaveitemModal').attr('hddid');
						$('#btncls').trigger('click');
						$('#myModal_item').modal('hide');
						$('#modal_itemName').val('');
						$('#modal_itemCategory').val('');
						$('#modal_itemhsn').val('');
						$('#modal_itemBarcode').val('');
						$('#modal_itemUnit').val('');
						$('#modal_itemTax').val('');
						$('#modal_itemPrate').val(0);
						$('#modal_itemMrp').val(0);
						$('#modal_itemSrate').val(0);
						if(attr === 'sales'){
							itemsearchbyid(result);
						}else{
							itemsearchbyid(result,'inc');
						}
				}
			 });
		 }
	});
	function update_company_message(){
		var company_message_comid = $('#company_message_comid').val();
		var company_message = $('#company_message').val();
		var company_message_comkey = $('#company_message_comkey').val();
		var company_message_time =  $('#company_message_time').val();
		$.ajax({
				url: "<?php echo site_url('Modal/update_company_message'); ?>",
				type: 'POST',
				data: {company_message_time:company_message_time,company_message_comid:company_message_comid,company_message:company_message,company_message_comkey:company_message_comkey},
				success: function (result) {
						
				}
			 });
	}
	function load_sms_modal(btn){
		var id = $(btn).attr('comkey');
		var comid = $(btn).attr('comid');
		$('#company_message_comkey').val(id);
		$('#company_message_comid').val(comid);
		$('#company_message_time').val(1000);
        $('#company_message').val('');
		$.ajax({
            url: '<?php echo $this->session->userdata('baseurl'); ?>company/get/'+id,
			async:false,
            success: function(data) {
                if (data.message != '') {
                    $('#company_message').val(data.message);
					$('#company_message_time').val(data.time);
                }

            }
        });
		$('#myModal_message').modal();

	}
    function getheader(title,name='name'){
        var company = $("#exdt31_com32").val();
        var header = "<style>td{font-size:16px !important;}</style><div class='row'>";
        header = header + "<div class='col-12 text-center' ><h2 style='font-size:16px;'>" + company + " </h2></div>";
        header = header + "</div>";
        header = header + "<div class='row'>";
        header = header + "<div class='col-12 col-md-12 text-center ' ><h4>"+title+"</h4></div>";
		if($('#'+name).val() !== undefined){
			header = header + "<div class='col-12 col-md-12 text-center ' ><h4>"+$('#'+name).val()+"</h4></div>";
		}
		
        header = header + "<div class='col-4 col-md-4 text-left' ></div>";
        return header;
    }
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/1",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#modal_itemCategory").html(option);
				$("#modal_gold_category").html('<option value ="">Select</option>'+option);
            }
        });
    $(document).on('click', '#btnaddgoldrate', function(){
		var frm = '#frmGoldmodal';
		var data = $(frm).serializeArray();
		 $("#frmGoldmodal").validate();            // <- INITIALIZES PLUGIN
         isValid = $("#frmGoldmodal").isValid();
         if (isValid) {
			$.ajax({
				url: "<?php echo site_url('Categor_price/save'); ?>",
				type: 'POST',
				data: data,
				success: function (result) {
                    $('#myModalGold').modal('hide');
                    table.ajax.reload(null, false); //just reload table

				}
			 });
		 }
	});


	$.ajax({
            url: "<?php echo site_url('master/amaster/tax'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.gstid + '"> ' + itemsingle.GST + '</option>';
                });
                $("#modal_itemTax").html(option);
                $("#modal_ledger_Tax").html(option);
            }
        });
		 $.ajax({
            url: "<?php echo site_url('master/amaster/unit'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#modal_itemUnit").html(option);
                
            }
        });
		
		$.ajax({
            url: "<?php echo site_url('master/amaster/hsn_code'); ?>/",
            async: false,
            success: function(result) {
                var option = '';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.hsnid + '"> ' + itemsingle.hsncode + '</option>';
                });
                $("#modal_itemhsn").html(option);
                
            }
        });
		
		$.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#modal_supplierArea').html(result);
                
            }
        });
		
		
		$.ajax({
            url: "<?php echo site_url('master/amaster/states'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.StateID + '"> ' + itemsingle.StateName + '</option>';
                });
                $("#modal_supplierstate").html(option);
                $("#modal_supplierstate").val(45);
                
            }
        });
		
		
		
		
		$.ajax({
            url: "<?php echo site_url('master/amaster/brands'); ?>/",
            async: false,
            success: function(result) {
                var option = '<option value = "" >Select</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.ibr_id + '"> ' + itemsingle.ibr_name + '</option>';
                });
                $("#modal_itemBrand").html(option);
                
            }
        });
		
		
		
		 $.ajax({
            url: "<?php echo site_url('master/amaster/item_category'); ?>/1",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#modal_itemCategory").html(option);
				
            }
        });
        startWorker();
        $('.form-control').change(function () {
            /*var nocap = $(this).attr('nocap');
            alert(nocap);
            if (nocap !=='true') {
               // var sm = capitalizeFirstLetter($(this).val());
                $(this).val(sm)
            }*/
        });
        $('#btn_home_search').click(function () {
            var txt_home_search = $('#txt_home_search').val();
            var sel_home_search = $('#sel_home_search').val();
            if (txt_home_search !== '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>dashboard/search/" + sel_home_search + "/" + txt_home_search,
                    success: function (result) {
                        $("#div1").html(result);
                    }
                });
            }
        });
        $('.sidebar-menu').tree();
        $("#chat-open").click(function () {
            $('.chat-wrapper').removeAttr('style');
        });
        $("#clnhis").click(function () {
            lastUrls = [];
            localStorage.clear();
            genbreds();
            location.reload();
            localStorage.setItem('addHistoryBred', JSON.stringify(lastUrls));
        });
        var his_back = '';
        $.ajax({
            url: "<?php echo site_url('dashboard/quickmenu'); ?>",
            success: function (result) {
                $("#myhistorylen").html(JSON.parse(result).length);
                var li = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    li = li + "<li><a href='<?php echo base_url(); ?>" + itemsingle.Url + "'><i class='fa fa-bookmark text-aqua'></i>" + itemsingle.ListName + "</a><li>";
                });
                $('#myhistory').html(li);
            }
        });
        $('.lanch').change(function () {
            var val = $(this).val();
            createCookie('language', val, 365);
            lastUrls = [];
            localStorage.setItem('addHistoryBred', JSON.stringify(lastUrls));
            location.reload();
        });
        if ($("#txtsls").val() !== 'en') {
            lan = {
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر _MENU_ مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            };
        }
    });
    var elem = document.getElementById("wrappermsts");
    /* Function to open fullscreen mode */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }
</script> 
</body>
</html>
