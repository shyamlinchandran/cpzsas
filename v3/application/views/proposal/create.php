<?php

?>
<style>
	.sma {
		width: 50px;
	}

	.small {
		width: 150px;
	}

	.tableBodyScroll {
		max-height: 300px;
		overflow-y: scroll;
	}
</style>
<form method="post" id="frmcreate" back="<?php echo site_url('Proposal/listall'); ?>"
	action="<?php echo site_url('Proposal/save'); ?>" class="form-horizontal">
	<input type="hidden" value="<?= $id ?>" name="id" id="id" />
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">
							<?= label('Proposals', $this, $user) ?> Create
						</h3>
						<span class="pull-right">
							<a role="button" back="<?php echo site_url('Proposal/listall'); ?>"
								class="btn  btn-success align-bottom"
								href="<?php echo site_url('Proposal/listall'); ?>">
								<span class="glyphicon glyphicon-arrow-left" title="back"></span>
							</a>
						</span>
					</div>
					<div class="box-body">
						<div class="col-sm-12">
							<div class="col-sm-2  odd_cls">
								<label>
									<?= label('Customer', $this, $user) ?> *<span class="required"></span> :
								</label>
								<input type="hidden" name="customer_id" id="customer_id" class="form-control" />
								<input id="customer" class="form-control" name="customer" type="text" value=""
									data-validation="required" maxlength="250"><br />
							</div>
							<!-- <div class="col-sm-2 odd_cls">
								<label><?= label('Heading', $this, $user) ?> *<span class="required"></span> :</label>

								<select name="heading1" id="heading1" data-validation="required" class="form-control">
										<option value="">Select</option>
									</select>
								
							</div> -->
							<div class="col-sm-2 odd_cls">
								<label>
									<?= label('Date', $this, $user) ?> *<span class="required"></span> :
								</label>
								<input id="date" class="form-control date" name="date" type="text" value=""
									data-validation="required">
							</div>
							<div class="col-sm-2 odd_cls">
								<label>
									<?= label('Cost Center', $this, $user) ?>
								</label>

								<input type="text" name="Cost_center" id="Cost_center" class="form-control" placeholder="Project"/>
								<input type="hidden" name="Costcenter" id="Costcenter" class="form-control" />
							</div>
							<div class="col-sm-2 odd_cls">
								<label>
									<?= label('Bill No', $this, $user) ?> *<span class="required"></span> :
								</label>
								<input readonly id="bill_no" value="<?php echo $bill_no; ?>" class="form-control"
									name="bill_no" type="text" value="" data-validation="required">
							</div>
							<div class="col-sm-2 odd_cls">
								<label>
									<?= label('Is complete', $this, $user) ?> *<span class="required"></span> :
								</label>
								<select id="is_make" class="form-control" name="is_make" type="text"
									data-validation="required">
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>

						</div>
						<div class="col-sm-12">
							<!-- <textarea id="editor1" name="proposal" rows="10" cols="80"> 
							 
							  </textarea>-->
							<textarea class="editor" style="height:300px;" id="editor2" name="text_preffix" rows="10"
								cols="80"></textarea>
						</div>
						<div class="col-sm-12" style="margin:0px; height:200px;overflow-y:scroll">
							<table style="width:100%;" class="table table-striped table-condensed">
								<tr>
									<td class="col-sm-2">
										<input style="" type="checkbox" class="selectall" name="" value="0"> &nbsp;
										<?= label('SNo', $this, $user) ?>
									</td>
									<td class="col-sm-3">
										<?= label('HEADING', $this, $user) ?>
									</td>
									<td class="col-sm-3">
										<?= label('DESCRIPTION', $this, $user) ?>
									</td>
									<td class="col-sm-2">
										<?= label('ITEM', $this, $user) ?>
									</td>
									<td class="col-sm-1">
										<?= label('QTY', $this, $user) ?>
									</td>
									<td class="col-sm-1">
										<?= label('UNIT', $this, $user) ?>
									</td>
									<td class="col-sm-2">
										<?= label('RATE', $this, $user) ?>
									</td>
									<td class="col-sm-2">
										<?= label('TAX', $this, $user) ?>
									</td>
									<td class="col-sm-2">
										<?= label('AMOUNT', $this, $user) ?>
									</td>
									<td></td>
								</tr>


								<tr>
									<td class="col-sm-2">
										<input type="text" name="col1" id="col1" class="form-control">
									</td>
									<td><select name="heading" id="heading" class="form-control">
											<option value="">Select</option>
										</select>
									</td>
									<td><input type ="text" id="colx" name="col2" class="form-control col2"/></td>
									<td><input type="text" name="col3" id="col3" class="form-control">
										<input type="hidden" name="itemid" id="itemid" class="form-control">
									</td>
									<td><input type="text" name="col4" id="col4" class="calc form-control two-digits">
									</td>
									<td><input type="text" name="col5" id="col5" class="form-control"></td>
									<td><input type="text" name="col6" id="col6" class="calc form-control two-digits">
									</td>
									<td><input type="hidden" name="tax_id" id="tax_id">
									<input type="hidden" name="taxid" id="taxid">
									
										<input  type="text" name="tax_idd" id="tax_idd"
											class="calc small form-control two-digits">
									</td>

									<td><input readonly="readonly" type="text" name="col7" id="col7"
											class="calc small form-control two-digits"></td>
									<td>
										<button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtra"
											class="btn btn-success" href="#">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</td>
								</tr>
								<tbody id="rown">

								</tbody>
							</table>
						</div>
						<div class="col-sm-12">
							<!-- <textarea id="editor1" name="proposal" rows="10" cols="80"> 
							 
							  </textarea>-->
							<textarea class="editor" style="height:300px;" id="editor1" name="proposal" rows="10"
								cols="80"></textarea>
						</div>


						<!-- /.box -->
					</div>
					<div class="box-footer" class="col-sm-12">
						<button id="form-button-save" type='submit' data-toggle="tooltip" title='Save'
							class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col -->

		<!-- /.row -->
	</section>
	<script src="<?php echo base_url(); ?>asset/plugins/ckeditor/ckeditor.js"></script>
	<!-- Bootstrap WYSIHTML5 -->

	<script>

	</script>
	<script type="text/javascript">
		$(document).on("dblclick", ".rowtotal", function (e) {
			$(this).attr('readonly', false);
			var inc = $(this).attr('txtkey');
			$('#textbox4' + inc).removeClass('calcraw');
			$('#textbox6' + inc).removeClass('calcraw');
			$('#textbox4' + inc).val(0);
			$('#textbox6' + inc).val(0);
		});


		$(document).on("change", ".calcraw ", function () {
			var inc = $(this).attr('txtkey');
			var col4 = $('#textbox4' + inc).val();
			var col6 = $('#textbox6' + inc).val();
			var col9 = $('#textbox9' + inc).val();

			
			var check = $.isNumeric(col4);
			if (check === false) {
				$('#textbox4' + inc).val(0);
				col4 = 0;
			}
			var check = $.isNumeric(col6);
			if (check === false) {
				$('#textbox6' + inc).val(0);
				col6 = 0;
			}

			var check = $.isNumeric(col9);
			if (check === false) {
				$('#textbox9' + inc).val(0);
				col9 = 0;
			}
			var total = parseFloat(col6) * parseFloat(col4);
			var tax = parseFloat(total) * parseFloat(col9);
			var taxper = parseFloat(tax )/100 ;
			var textbox7 =  parseFloat(total) + parseFloat(taxper)
			// $('#textbox7' + inc).val(parseFloat(taxper).toFixed(2));
// alert(textbox7);

			$('#textbox7' + inc).val(parseFloat(textbox7).toFixed(2));
		});
		var idinc = 0;
		$.validate({
			modules: 'security'
		});

		function remove(btn) {
			$(btn).closest('tr').remove();
		}

		function addrow(col1, col2, col3, col4, col5, col6, col7, headingid, headings, itemid, tax_id,tax_idd,taxid) {
			if(tax_id ==='' || tax_id === undefined || tax_id === 'null' || tax_id ===null){
				tax_id = 0 ;
			}
			if(tax_idd ==='' || tax_idd === undefined || tax_idd === 'null' || tax_idd ===null){
				tax_idd = 0 ;
			}
			if(taxid ==='' || taxid === undefined || taxid === 'null' || taxid ===null){
				taxid = 0 ;
			}
			idinc = idinc + 1;
			var text = '<td><input class="sma" type="text" name="textbox1[]" value="' + col1 + '" ></td>';
			var text = text + '<td class="col-sm-3"><input class="form-control" type="text" name="textbox21[]" value="' + headings + '" ><input class="form-control" type="hidden" name="textbox22[]" value="' + headingid + '" ></td>';
			var text = text + '<td class="col-sm-3"><input class="form-control" type="text" name="textbox2[]" value="' + col2 + '" ></td>';
			var text = text + '<td class="col-sm-2"><input class="form-control" type="text" name="textbox3[]" value="' + col3 + '" ><input type="hidden" id="textbox31[]" name="textbox31[]"value="' + itemid + '" ></td>';
			var text = text + '<td class="col-sm-1"><input txtkey=' + idinc + '   class="form-control two-digits calcraw" id="textbox4' + idinc + '" type="text" name="textbox4[]" value="' + col4 + '" ></td>';
			var text = text + '<td class="col-sm-1"><input class="form-control"  type="text" name="textbox5[]" value="' + col5 + '" ></td>';
			var text = text + '<td class="col-sm-2"><input txtkey=' + idinc + ' class="form-control calcraw two-digits" id="textbox6' + idinc + '" type="text" name="textbox6[]" value="' + col6 + '" ></td>';
			var text = text + '<td class="col-sm-2"><input txtkey=' + idinc + ' class="form-control calcraw two-digits" id="textbox8' + idinc + '" type="hidden" name="textbox8[]" value="' + tax_id + '" ><input txtkey=' + idinc + ' class="form-control calcraw two-digits" id="textbox9' + idinc + '" type="text" name="textbox8[]" value="' + tax_idd + '" ><input type="hidden" name="taxid[]" id="taxid" value="'+taxid+ '"></td>';
			var text = text + '<td class="col-sm-2"><input  txtkey=' + idinc + ' readonly ="readonly" class="form-control rowtotal small two-digits" id="textbox7' + idinc + '" type="text" name="textbox7[]" value="' + col7 + '" ></td>';

			var text = text + '<td><span  data-toggle="tooltip"   title="Remove" onclick="remove(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
			$('#rown').append('<tr>' + text + '</tr>');
		}

		function addrow_new(col1, headingid, headings, col2, col3, itemid, col4, col5, col6, col7, tax_id,tax_idd,taxid) {
			if(tax_id ==='' || tax_id === undefined || tax_id === 'null' || tax_id ===null){
				tax_id = 0 ;
			}
			if(tax_idd ==='' || tax_idd === undefined || tax_idd === 'null' || tax_idd ===null){
				tax_idd = 0 ;
			}
			if(taxid ==='' || taxid === undefined || taxid === 'null' || taxid ===null){
				taxid = 0 ;
			}
			idinc = idinc + 1;
			var text = '<td><input class="sma" type="text" name="textbox1[]" value="' + col1 + '" ></td>';
			var text = text + '<td class="col-sm-3"><input class="form-control" type="text" name="textbox21[]" value="' + headings + '" ><input class="form-control" type="hidden" name="textbox22[]" value="' + headingid + '" ></td>';
			var text = text + '<td class="col-sm-3"><input class="form-control" type="text" name="textbox2[]" value="' + col2 + '" ></td>';
			var text = text + '<td class="col-sm-2"><input class="form-control" type="text" name="textbox3[]" value="' + col3 + '" ><input type="hidden" id="textbox31[]" name="textbox31[]"value="' + itemid + '" ></td>';
			var text = text + '<td class="col-sm-1"><input txtkey=' + idinc + '   class="form-control two-digits calcraw" id="textbox4' + idinc + '" type="text" name="textbox4[]" value="' + col4 + '" ></td>';
			var text = text + '<td class="col-sm-1"><input class="form-control"  type="text" name="textbox5[]" value="' + col5 + '" ></td>';
			var text = text + '<td class="col-sm-2"><input txtkey=' + idinc + ' class="form-control calcraw two-digits" id="textbox6' + idinc + '" type="text" name="textbox6[]" value="' + col6 + '" ></td>';
			var text = text + '<td class="col-sm-2"><input  txtkey=' + tax_id + ' readonly ="readonly" class="form-control rowtotal small two-digits" id="textbox8' + tax_id + '" type="hidden" name="textbox8[]" value="' + tax_id + '" ><input txtkey=' + idinc + ' class="form-control calcraw two-digits" id="textbox9' + idinc + '" type="text" name="textbox9[]" value="' + tax_idd + '" ><input type="hidden" name="taxid[]" id="taxid" value="'+taxid+ '"></td>';
			var text = text + '<td class="col-sm-2"><input  txtkey=' + idinc + ' readonly ="readonly" class="form-control rowtotal small two-digits" id="textbox7' + idinc + '" type="text" name="textbox8[]" value="' + col7 + '" ></td>';
			var text = text + '<td><span  data-toggle="tooltip"   title="Remove" onclick="remove(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
			$('#rown').append('<tr>' + text + '</tr>');
		}

		$(document).ready(function () {


			// $('.checkbox').click(function () {

			// 	if ($(this).is(':checked')) {
			// 		$('input:checkbox').prop('checked', true);
			// 	} else {
			// 		$('input:checkbox').prop('checked', false);
			// 	}
			// });

			$.ajax({
				async: false,
				url: "<?php echo site_url('Quotation_heading/getHeading'); ?>",
				success: function (result) {
					$('#heading').html(result);

				}
			});


			$("#Cost_center").autocomplete({
				source: "<?php echo site_url('transaction/Vouchers/getCostcenter'); ?>",
				minLength: 2,
				selectFirst: true,
				select: function (event, ui) {
					$('#Cost_center').val(ui.item.cost_name);
					$('#Costcenter').val(ui.item.cost_id);
				}
			});

			$("#col3").autocomplete({
				source: "<?php echo site_url('Proposal/getIttem'); ?>",
				minLength: 2,
				selectFirst: true,
				select: function (event, ui) {
					$('#col3').val(ui.item.name);
					$('#itemid').val(ui.item.id);
					$('#col2').val(ui.item.description)
					$('#taxid').val(ui.item.tax_id);
					$('#tax_idd').val(ui.item.GST)
				}
			});

			$('.calc').change(function () {

				var col4 = $('#col4').val();
				var col6 = $('#col6').val();
				var txid = $('#tax_idd').val();
				if(txid ==='' || txid === undefined || txid === 'null' || txid ===null){
					txid = 0 ;
				}
				
				// var txamnt = parseFloat(col4) * parseFloat(txid);

				// $('#tax_idd').val(txamnt);
				if (col4 === "") {
					col4 = 0;
				}
				if (col6 === "") {
					col6 = 0;
				}

				$('#col4').val(parseFloat(col4).toFixed(2));
				$('#col6').val(parseFloat(col6).toFixed(2));
				var col71 = parseFloat(col4) * parseFloat(col6);
				// $('#col7').val(parseFloat(col71).toFixed(2));
				var col72 = (parseFloat(col71) * parseFloat(txid));
				var taxper = parseFloat(col72)/100 ;
				var col7 = parseFloat(col71) + parseFloat(taxper);

				$('#col7').val(parseFloat(col7).toFixed(2));
			});

			// var total = parseFloat(col6) * parseFloat(col4);
			// var tax = parseFloat(total) * parseFloat(col9);
			// var taxper = parseFloat(tax )/100 ;
			$('#btnAddExtra').click(function () {
				var col1 = $('#col1').val();
				var col2 = $('#colx').val();
				var headingid = $('#heading').val();
				var headings = $("#heading option:selected").text();
				var col3 = $('#col3').val();
				var itemid = $('#itemid').val();
				var col4 = $('#col4').val();
				var col5 = $('#col5').val();
				var col6 = $('#col6').val();
				var col7 = $('#col7').val();
				var tax_id = $('#tax_id').val();
				var tax_idd=$('#tax_idd').val();
				var taxid=$('#taxid').val();
				$('#col1').val('');
				$('#col2').val('');
				$('#col3').val('');
				$('#itemid').val('');
				$('#colx').val('');
				$('#col4').val('');
				$('#col5').val('');
				$('#col6').val('');
				$('#col7').val('');
				$('#tax_id').val('');
				$('#heading').val('');
				$('#headingid').val('');
				$('#itemid').val('');
				$('#tax_idd').val('');
				$('#taxid').val('');
				addrow(col1, col2, col3, col4, col5, col6, col7, headingid, headings, itemid, tax_id,tax_idd,taxid);

			});
			//CKEDITOR.replace('editor1');
			tinymce.remove();
			tinymce.init({
				selector: '.editor',
				width: '100%',
				height: 300,
				plugins: [
					'advlist autolink link image lists charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
					'table emoticons template paste help'
				],
				toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
					'bullist numlist outdent indent | link image | print preview media fullpage | ' +
					'forecolor backcolor emoticons | help',
				menu: {
					favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
				},
				menubar: 'favs file edit view insert format tools table help',
				content_css: 'css/content.css'
			});
			$("#customer").autocomplete({
				source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
				minLength: 2,
				select: function (event, ui) {
					$('#customer_id').val(ui.item.id);

				}
			});

			load();
		});

		function formatDate(input) {
			var datePart = input.match(/\d+/g),
				year = datePart[0].substring(2), // get only two digits
				month = datePart[1], day = datePart[2];
			return day + '/' + month + '/' + year;
		}

		function load() {
			var id = $('#id').val();
			if (parseFloat(id) > 0) {
				$.ajax({
					url: "<?php echo site_url('Proposal/getsing'); ?>/" + id,
					async: false,
					success: function (result) {
						$.each(JSON.parse(result), function (i, itemsingle) {
							$('#bill_no').val(itemsingle.bill_no);
							$('#editor1').val(itemsingle.text);
							$('#editor2').val(itemsingle.text_preffix);
							$('#is_make').val(itemsingle.is_make);
							tinymce.remove();
							tinymce.init({
								selector: '.editor',
								width: '100%',
								height: 300,
								plugins: [
									'advlist autolink link image lists charmap print preview hr anchor pagebreak',
									'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
									'table emoticons template paste help'
								],
								toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
									'bullist numlist outdent indent | link image | print preview media fullpage | ' +
									'forecolor backcolor emoticons | help',
								menu: {
									favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
								},
								menubar: 'favs file edit view insert format tools table help',
								content_css: 'css/content.css'
							});
							$('#customer').val(itemsingle.name);
							$('#customer_id').val(itemsingle.customer_id);
							$('#Cost_center').val(itemsingle.pname);
							$('#Costcenter').val(itemsingle.cost_id)

							$('#date').val(itemsingle.dates);

						});
					}
				});

				$.ajax({
					url: "<?php echo site_url('Proposal/getsing_items'); ?>/" + id,
					async: false,
					success: function (result) {
						$.each(JSON.parse(result), function (i, itemsingle) {
							$('#heading').val(itemsingle.col21);
							var text = $('#heading option:selected').text()
							var col3 = $('#col3').val(itemsingle.name);

							addrow(itemsingle.col1, itemsingle.col2, itemsingle.name, itemsingle.col4, itemsingle.col5, itemsingle.col6, itemsingle.col7, itemsingle.col21, text, itemsingle.id,itemsingle.tax_id,itemsingle.Gst);

						});
					}
				});


			}
		}

	</script>