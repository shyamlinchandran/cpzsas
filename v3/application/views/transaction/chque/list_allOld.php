<?php $add_url = site_url('transaction/chque/create'); ?>

<section class="content"> 
<form method="post" id="frmcreate" home="<?php echo site_url('transaction/vouchers/index'); ?>" back="<?php echo site_url('transaction/chque/list_all'); ?>" action="<?php echo site_url('transaction/Chque/save_cheque'); ?>" class="form-horizontal">
	<div class="modal fade" id="myChequeModal">
            <input type="hidden" id="modal_cheque_id" name="modal_cheque_id">
            <input type="hidden" id="modal_cheque_amount" name="modal_cheque_amount">
            <input type="hidden" id="modal_cheque_status" name="modal_cheque_status">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal_header" class="modal-title"><?= label('Aeging', $this, $user) ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tr>
                            <td><?= label('Cheque Date', $this, $user) ?></td>
                            <td><input readonly id="chq_datess" class="form-control" name="chq_datess" type="text"   maxlength="50">   </td>
                        </tr>
                        <tr>
                            <td><?= label('Cleared Date', $this, $user) ?></td>
                            <td><input id="chq_date" class="form-control date" name="chq_date" type="text"   maxlength="50">   </td>
                        </tr>
                    </table>
					 <input type="checkbox" name="autoCheck"  id="autoCheck" />
						<table id="inc_table" class="table <?= $this->table_color ?>" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?= label('Date', $this, $user) ?></th>
                                    <th><?= label('Voucher Number', $this, $user) ?></th>
                                    <th><?= label('Debit', $this, $user) ?></th>
                                    <th><?= label('Credit', $this, $user) ?></th>
                                    <th><?= label('Balance', $this, $user) ?></th>
                                 </tr>
							</thead>
							<tbody>
							</tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="allo_btn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
										<input type ="hidden" name ="chq_trans" id ="chq_trans" value =""/>

<div class="box-header">
                    <h3 class="box-title"><?= label('Cheque', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tr>
                            <td colspan="4"><?= label('Refresh List', $this, $user) ?></td> 
                            <td colspan="2">
                                <select id="chrq_status"  class="form-control" name="chrq_status">  
                                    <option selected="selected" value="Submitted">Submitted</option>
                                    <option value="Cleared">Cleared</option>
                                    <option value="Rejected">Rejected</option> 
                                    <option value="bounced">Bounced</option> 
                                </select>       
                            </td>
                        </tr>
                        <tr>
                            <td><?= label('Select Bank', $this, $user) ?></td>
                            <td> <input type="hidden" class="form-control" id="chq_to_id" name="chq_to_id"/> 
								<input type="hidden" class="form-control" id="chq_to" name="chq_to"/> 
                                <input id="chqe_to" data-validation ="required" class="form-control"  name="chqe_to"  type="text" value="" maxlength="50">            
                            </td>
                            <td></td>
                            <td> </td>
                            <td><?= label('Status', $this, $user) ?></td>
                            <td>
                                <select id="chq_status"  class="form-control" name="chq_status">  
                                    <option value="Cleared">Cleared</option>
                                    <option value="Rejected">Rejected</option> 
                                </select>       
                            </td>
                        </tr>
                    </table>

                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Ledger', $this, $user) ?></th>                                
                                <th><?= label('Cheque Date', $this, $user) ?></th> 
                                <th><?= label('Cheque no', $this, $user) ?></th> 

                                <th><?= label('Issued Bank', $this, $user) ?></th> 
                                <th><?= label('Amount', $this, $user) ?></th> 
                                <th><?= label('Transaction Type', $this, $user) ?></th>
                                <th><?= label('Collected By', $this, $user) ?></th>
                                <th><?= label('Status', $this, $user) ?></th>
                                <th><?= label('Actions', $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody> 
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</form>
    <!-- /.row -->
</section>


<script type="text/javascript">
$(document).on('click', '.chqbounce', function(e) {
 var chq_id = $(this).attr('chq_id');
 var message =  $(this).attr('message');
 if(confirm(message)) {
     var chq_date = $('#chq_date').val();

                $.ajax({
                    url: "<?php echo site_url('transaction/chque/bounce/'); ?>"+chq_id,
                    method: 'post',
                    async: false,
                    data: {
                        chq_date: chq_date
                    },
                    success: function(result) {
                                   table.ajax.reload(null, false);

                    }
                });


    
  }
});
var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
 function calert(msg) {
        toastr["error"](msg);
    }

    var table;
	var inc_table;
    var inc_id = 0;
	var is_submitted = 0;
	$(document).on('change', '#chqe_to', function() {
		var chq_to = $('#chq_to').val();
		if(chq_to === ''){
			chq_to = 0;
		}
		if(chq_to < 1){
			$('#chqe_to').val('');
		}
	});
	$(document).on('click', '#allo_btn', function() {
		 $("#frmcreate").validate();  
		 isValid = $("#frmcreate").isValid();
		 if (isValid && parseFloat(is_submitted) < 1 ) {
			$('#myChequeModal').modal('hide');
			var url = $('#frmcreate').attr('action');
			var other_data = $('#frmcreate').serializeArray();
			is_submitted = 1;
			 $.ajax({
                type: 'POST',
                url: url,
                data: other_data, // send it here
                success: function(Onj) {
                    toastr["success"]('Updated Successfully');
					$('#chrq_status').trigger('change');
					setTimeout(function () {
                                        
                                    }, 1000);
                                    table.ajax.reload(null, false);
                },
                error: function(data) {}
            });
		 }else{
			$('#myChequeModal').modal('hide');
			$('#chqe_to').focus();
		 }
		
	});
	$(document).on('change', '.txtamt', function() {
		var tot = 0;
        $('.txtamt').each(function() {
			var amt = $(this).val();
			if(amt === ''){
				amt= 0;
			}
			tot = parseFloat(tot) + parseFloat(amt	); 
		});
        var totalamount = $('#modal_cheque_amount').val();
		if(parseFloat(totalamount) < parseFloat(tot) ){
			$('#allo_btn').attr('disabled',true);
			calert('Value Exceeded Check Amount');
		}else{
			$('#allo_btn').removeAttr('disabled');
		}
    });
	$(document).on('change', '#autoCheck', function() {
        autoCheck = $('#autoCheck').is(':checked');
        if (autoCheck === true || autoCheck === false) {
            autopay(0);
        }
    });
	function autopay(vid ){
		$('#allo_btn').removeAttr('disabled');
		var autoCheck = $('#autoCheck').is(':checked');
        var collection = $(".chkchg");
        var totalamount = $('#modal_cheque_amount').val();
		if (autoCheck === true) {
			if (totalamount !== 0) {
				collection.each(function() {
                        $(this).prop('checked', autoCheck);
                        var id = $(this).attr('id');
                        var hddbt = "hddbt" + id;
                        var hdcrdt = $("#hdcrdt" + id).val();
						var modal_cheque_status = $('#modal_cheque_status').val();
						if(modal_cheque_status !== 'Issue'){
							 var hdcrdt = $("#hddbt" + id).val();
						}
                        var txtamt = "#txtamt" + id;
						console.log('txtamt:'+txtamt);
                        var bal = parseFloat(totalamount) - parseFloat(hdcrdt);

                        if (parseFloat(totalamount) < parseFloat(hdcrdt)) {
                            $(txtamt).val(totalamount);
							console.log('totalamount:'+totalamount);
                        } else {
                            totalamount = (parseFloat(totalamount) - parseFloat(hdcrdt)).toFixed(2);
                            $(txtamt).val(hdcrdt);
                        }
                        var txtbal = "#txtbal" + id;
                        if (bal < 0 || bal === 0) {
                            $(txtbal).val((-1 * parseFloat(bal)).toFixed(2));
                            return false;
                        } else {
                            $(txtbal).val(0.00);
                        }
						$(txtamt).attr('readonly','readonly');

                    });
					$('.txtamt').attr('readonly','readonly');
			}
		}else{
			collection.each(function() {
				$(this).prop('checked', autoCheck);
				var id = $(this).attr('id');
                var txtamt = "#txtamt" + id;
                var txtbal = "#txtbal" + id;
                $(txtamt).val(0.00);
                 $(txtbal).val(0.00);
				$(txtamt).removeAttr('readonly');
			});
		}
	}
    $(document).ready(function () { 
        table = $('#table').DataTable({
             "responsive": true,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

              'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Cheque List' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5,6,7,8]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                     
                        $('c[r=A1] t', sheet).text(company + " - " + 'Cheque List');
                        $('c[r=A2] t', sheet).text("");
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Cheque List' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5,6,7,8],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        doc.content[0].text = "";
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy

                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!

                        //  doc.pageMargins = [20, 60, 20, 30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 9;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 9;
                        // Create a header object with 3 columns
                        // Left side: Logo
                        // Middle: brandname
                        // Right side: A document title
                        doc['header'] = (function () {
                            return {
                                columns: [
                                    {
                                        alignment: 'center',
                                        //italics: true,
                                        text: company + " - " + 'Cheque Details',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        /*for (var i = 1; i < doc.content[1].table.body.length; i++) {
                         doc.content[1].table.body[i][4].alignment = 'right';
                         doc.content[1].table.body[i][0].alignment = 'center';
                         doc.content[1].table.body[i][1].alignment = 'center';
                         }*/
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Created on: ', {text: jsDate.toString()}]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    }
                                    ,
                                    {
                                        alignment: 'right',
                                        text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function (i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function (i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }],


            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('transaction/Chque/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.type = $("#chrq_status").val();

                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });
        $("#chqe_to").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led/1", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#chq_to").val(ui.item.id);
				$("#chq_to_id").val(ui.item.id);
            }
        });
        $("#chrq_status").change(function () {
            table.ajax.reload(null, false);
        })


    });
		function theFunction(id, chq_trans,ledger,amount = 0) {

            $.ajax({
                url: "<?php echo site_url('transaction/chque/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#chq_date").val(result.chq_dates);
                    $("#chq_datess").val(result.chq_dates);
                }

            });
		$('#chq_trans').val(chq_trans);
		if (inc_id === 1) {
            inc_table.destroy();
        }
        inc_id = 1;
		var status = 'pay';
		if(chq_trans ==='Clearing'){
			status = 'rec';
		}
		$('#modal_cheque_id').val(id);
		$('#modal_cheque_amount').val(amount);
		$('#modal_cheque_status').val(chq_trans);
		is_submitted = 0;
		inc_table = $('#inc_table').DataTable({
            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
            "searching": false,
            "bInfo": false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aging/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.type = status;
                    data.id = ledger;
					data.cheque_id = id;
                    data.vid = 0;
					data.voucher_type = 'cheque';
                }
            },
            "fnDrawCallback": function(oSettings) {
				$('#myChequeModal').modal('show');
                //autopay($('#vid').val());
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });
	}
    function theFunction_copy(id, chq_trans) {
        var message = "Do you want to confirm this?";
        bootbox.confirm(
                {
                    message: message,
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {

                        if (result === true) {

                            var chq_to = $("#chq_to").val();
                            if (chq_to === '') {
                                var dialog = bootbox.dialog({
                                    message: '<p class="text-center">Select Ledger</p>',
                                    closeButton: false
                                });
                                setTimeout(function () {
                                    dialog.modal('hide');
                                }, 1000);
                                return;
                            }
                            var chq_status = $("#chq_status").val();
                            var chq_date = $("#chq_date").val();
                            if (chq_date === '') {
                                var dialog = bootbox.dialog({
                                    message: '<p class="text-center">Select Date</p>',
                                    closeButton: false
                                });
                                setTimeout(function () {
                                    dialog.modal('hide');
                                }, 1000);
                                return;
                            }

                            $.ajax({
                                url: '<?php echo site_url('transaction/chque/confirm'); ?>',
                                type: 'post', // performing a POST request
                                data: {
                                    'id': id,
                                    'chq_to': chq_to,
                                    'chq_status': chq_status,
                                    'chq_date': chq_date,
                                    'chq_trans': chq_trans
                                },
                                dataType: 'json',
                                success: function (data) {
                                    var dialog = bootbox.dialog({
                                        message: '<p class="text-center">' + data.message + '</p>',
                                        closeButton: false
                                    });
                                    setTimeout(function () {
                                        dialog.modal('hide');
                                    }, 1000);
                                    table.ajax.reload(null, false);
                                }
                            });
                        }
                    }
                });
        table.ajax.reload(null, false);
    }

</script> 
</body>
</html>