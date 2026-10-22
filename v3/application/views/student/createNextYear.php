<?php
$com_tax_type = $settings[0]['com_tax_type'];
$is_calendar = 0;	
$field = 'Course';
if(isset($settings[0]['is_calendar'])){
	$is_calendar = $settings[0]['is_calendar'];
}
$title = 'Add Course';
if((float) $is_calendar > 0 ){
	$title = 'Buy Packages';
	$field = 'Package';
}
?>
<form method="post" id="frmcreatemodelc" enctype="multipart/form-data"
    back="<?php echo site_url('education/Student/feeStructure'); ?>"
    action="<?php echo site_url('education/Student/saveNextYear'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $is_calendar ?>" name="is_calendar" id="is_calendar" />

    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $type ?>" name="type" id="type" />
    <input type="hidden" value="" name="myid" id="myid" />
    <input type="hidden" value="" name="totalfees" id="totalfees" />
    <input type="hidden" value="" name="discountpercs" id="discountpercs" />
    <input type="hidden" value="<?= $view ?>" name="view" id="view" />
    <input type="hidden" value="<?= $com_tax_type ?>" name="tax_type" id="tax_type" />
    <input type="hidden" id="is_model" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('education/Student/feeStructure'); ?>"
                                class="btn  btn-success align-bottom"
                                href="<?php echo site_url('education/Student/feeStructure/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">


                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Name', $this, $user) ?>*<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
								<?php if((float)$is_calendar > 0  ){?>
								<input type ="hidden" value="0" name="txtabsent" id="txtabsent"/>
								<?php } ?>
                                    <input id="name" class="form-control" name="name" type="text" value=""
                                        data-validation="required" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Phone', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="phone" data-validation="number" data-validation-optional="true"
                                        class="form-control" name="phone" type="text" value="" maxlength="50">
                                </div>
                            </div>
                        </div>




                        <div class="col-sm-12 ">

							<?php if((float) $is_calendar < 1) {?> 
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Category', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select <?php if((float) $is_calendar < 1) {echo "required";} ?>  name="universe" id="universe" class="form-control required"
                                        required="required">

                                    </select>
                                </div>
                            </div>
							<?php } ?>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label($field, $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm" style="width:100%">
                                        <select required name="course" id="course" class="form-control required"
                                            required="required">


                                        </select>
                                    </div>
                                </div>
                            </div>
									<?php if((float) $is_calendar > 0 ){ ?>
										<div  style ="display:none" class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Fee Start Date', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="fee_start_date" class="form-control date" name="fee_start_date" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Validity', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="fee_end_date" class="form-control date" name="fee_end_date" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										<div class="col-sm-6 form-group  odd_cls">
											<label class="col-sm-4 control-label">
												<?= label('No of Classes ', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<input id="duration" class="form-control" attrfuck placeholder ="No of Classes " name="duration" type="text" value="" maxlength="50">
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Amount', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="tutfee" class="form-control two-digits price calcfees" name="tutfee" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										 <div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Amount', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="tutfee" class="form-control two-digits price calcfees" name="tutfee" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										 <div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Discount %', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="discount_per" class="form-control two-digits price calcfees" name="discount_per" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Discount Amount', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input id="discount_amount" class="form-control two-digits price calcfee" name="discount_amount" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<label class="col-sm-4 control-label">
											<?= label('Total Amount', $this, $user) ?><span class="required"></span> :
											</label>
											<div class="col-sm-8">
												<div class="input-group input-group-sm" style = "width:100%">
												<input readonly id="fees" class="form-control two-digits price" name="fees" type="text" value="" maxlength="50">
												</div>
											</div>
										</div>
									<?php } ?>

                        </div>


                        <div class="col-sm-12 ">

							<?php if((float) $is_calendar < 1 ) {?> 
                            <div class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Batch ', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select required id="batch" class="form-control required" name="batch" type="text"
                                        value="" maxlength="50">


                                    </select>
                                </div>
                            </div>

							<?php } ?>

                            <div <?php if((float) $is_calendar >0  ) { echo "style='display:none'";}?>   class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Discount ', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="ref" class="form-control" name="ref">


                                    </select>
                                </div>
                            </div>

                            <!-- <div id="hid">
                                <div class="col-sm-6 form-group">

                                    <label class="col-sm-4 control-label">
                                        <?= label('Refered By ', $this, $user) ?><span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="refby" class="form-control" name="refby" type="text" value="" maxlength="50"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-6 form-group">

                                    <label class="col-sm-4 control-label">
                                        <?= label('Refered person Mob ', $this, $user) ?><span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="refmob" class="form-control" name="refmob" type="number" value="" maxlength="50"></textarea>
                                    </div>
                                </div>

                            </div> -->




                            <div <?php if((float) $is_calendar >0  ) { echo "style='display:none'";}?>  class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Total Fee', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="cost" class="form-control " name="cost" type="text" value=""
                                        maxlength="50">
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">

                                <label class="col-sm-4 control-label">
                                    <?= label('Payment Type ', $this, $user) ?><span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <select id="payment_type" class="form-control" name="payment_type">
                                        <option value="full" class="form-control" selected>Full Payment</option>
                                       <!-- <option value="part" class="form-control">Part Payment</option>-->

                                    </select>
                                </div>
                            </div>
							<?php  if((float) $is_calendar >0  ) { ?>
								<div class="col-sm-6 form-group">

									<label class="col-sm-4 control-label">
										<?= label('Payment Method ', $this, $user) ?><span class="required"></span> :
									</label>
									<div class="col-sm-8">
										<select id="payment_method" class="form-control" name="payment_method">
											<option value="cash" class="form-control" >Cash</option>
											<option value="bank" class="form-control" >Bank</option>
											<option value="check" class="form-control" >Check</option>
											<option value="other" class="form-control" >Other</option>
										</select>
									</div>
								</div>
								<div id="div_payment_note" style="display:none" class="col-sm-6 form-group">

									<label class="col-sm-4 control-label">
										<?= label('Payment Note ', $this, $user) ?><span class="required"></span> :
									</label>
									<div class="col-sm-8">
										<textarea id="payment_note" name="payment_note" class="form-control"></textarea>
									</div>
								</div>
							<?php } ?>
                            <div class="col-sm-6 form-group" id="mnths_div">
                                <label class="col-sm-4 control-label">
                                    <?= label(' Payment Duration', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="mnths" class="form-control " placeholder="Number of months" name="mnths"
                                        data-validation="number" type="text" value="1" maxlength="50">
                                </div>
                            </div><br><br>
                            <hr style="margin-top: 50; margin-bottom:50px;">
                            <div class="col-sm-8 form-group">
                                <table class="table table-borderd table-stripped" id="payment_table" margin=>
                                    <thead>
                                        <th>Sl no</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <!-- <th>Voucher</th> -->

                                    </thead>
                                    <tbody id="tbody">

                                    </tbody>
                                    <hr style="margin-top: 50; margin-bottom:50px;">

                                </table>

                            </div><br><br><br>

                        </div>
						<?php if((float)$is_calendar > 0  ){?>
						<!-- <div  id="calendardiv" class="col-sm-12 ">
							 <div id="calendar"></div>
						 </div>-->
						<?php } ?>

                        <?php if ($view != 'view') { ?>
                        <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save'
                            class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                        <?php } ?>
                    </div>




                </div>


                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>

<script>

</script>

<script src="<?php echo base_url(); ?>assets/fullcalendar/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/fullcalendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript">
	function getDate(dates){
		if(dates!== null && dates!== '' ){
			dates = dates.split('/');
			dates = dates[2] + '-' +  dates[1] + '-' + dates[0];
		}
		return dates;
	}
	function formatDate(input) {
		if(input!== null){
				var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0), // get only two digits
                month = datePart[1], day = datePart[2];
				return day + '/' + month + '/' + year;
		}else{
			return '';
		}
    }
	var date_array  = ['0']; 
	function loadcalendar(course_id,batch = ''){
	var is_calendar = $('#is_calendar').val();
	if(parseFloat(is_calendar)  > 0 ){
	var  fee_start_date = $('#fee_start_date').val();
	var  fee_end_date = $('#fee_end_date').val();
	fee_start_date =  getDate(fee_start_date);
	fee_end_date =  getDate(fee_end_date);
	console.log(fee_end_date);
	console.log(fee_start_date);
	if(batch === ''){
		var batch = $('#batch').val();
		if(batch ==='' ){
			batch = 1;
		}
	}
	if($('#fee_start_date').val() !== '' &&   $('#fee_end_date').val() !== '' ){
		$('#calendardiv').html('');
		//$('#calendardiv').html('<div id="calendar"></div>');
		var fee_id = $('#id').val();
		    $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function () {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        init_events($('#external-events div.external-event'))


        $('#calendar').fullCalendar({
            defaultView: 'agendaDay',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'Today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            dayClick: function (date, allDay, jsEvent, view) {
                var str = date.format();
                var res = str.split("T");

            },
            minTime: "16:00:00",
            maxTime: "24:00:00",
            slotDuration: '00:10:00',
            // snapDuration: '00:05:00',
            events: '<?php echo base_url(); ?>/education/student/getalldatebyMonth/'+fee_id+'/'+course_id+'/'+fee_start_date+'/'+fee_end_date,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventClick: function (calEvent, jsEvent, view) {
                //  var urls = '<?php echo base_url(); ?>/clinic/Booking/edit/' + calEvent.id;
				 
                if (calEvent.type === 'Working') {
                    var id = calEvent.id;
                    $(this).css('border-color', 'green');
					date_array.push(id); 
					
					console.log(date_array);
					calEvent.id  =id;
					calEvent.type = "Absent";
					calEvent.backgroundColor = "Red";
                }else if (calEvent.type === 'Absent') {
                    var id = calEvent.id;
                    $(this).css('border-color', 'red');
					calEvent.type = "Working";
					calEvent.id  =id;
					calEvent.backgroundColor = "green";
					for( var i = 0; i < date_array.length; i++){ 
    
						if ( parseFloat(date_array[i]) === parseFloat(id) ) { 
							date_array.splice(i, 1); 
						}
    
					}
					console.log(date_array);

                }
                var text = '0';
				for( var i = 0; i < date_array.length; i++){ 
					if(parseFloat(date_array[i]) > 0 ){
						var text = text + ','+date_array[i];
					}
    
				}
				$('#txtabsent').val(text);
				$('#calendar').fullCalendar('updateEvent', calEvent);
            },
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject')

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject)

                // assign it the date that was reported
                copiedEventObject.start = date
                copiedEventObject.allDay = allDay
                copiedEventObject.backgroundColor = $(this).css('background-color')
                copiedEventObject.borderColor = $(this).css('border-color')

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                }

            }
        })

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({'background-color': currColor, 'border-color': currColor})
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)

            //Add draggable funtionality
            init_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })
    });
	}else{
        toastr["error"]('Select Batch To Load Calendar');
	}
	}
	}
	function setpaymentnote(payment_method){
		if(payment_method === 'other'){
			$('#div_payment_note').attr('style','display:block');
		}else{
			$('#div_payment_note').attr('style','display:none');
		}
	}
    $(document).ready(function () {
		$('#payment_method').change(function(){
			var payment_method = $('#payment_method').val();
			 setpaymentnote(payment_method);
		});
		$('#fee_end_date').change(function(){
			var course_id  = $("#course").val();
			if(course_id !== ''){
				if(parseFloat(course_id) > 0  ){
					//loadcalendar(course_id);
				}
			}
		});
		$('.calcfees').change(function(){
			var tutfee = $('#tutfee').val();
			var discount_per = $('#discount_per').val();
			var discount_amount = 0;
			if(parseFloat(tutfee) > 0 &&  parseFloat(discount_per) > 0 ){
				discount_amount = parseFloat(tutfee) * parseFloat(discount_per) /100;
				discount_amount = parseFloat(discount_amount).toFixed(2);
			}
			var fees = parseFloat(tutfee) - parseFloat(discount_amount);
			$('#fees').val(parseFloat(fees).toFixed(2));
			$('#discount_amount').val(discount_amount);
		});
		$('.calcfee').change(function(){
			var tutfee = $('#tutfee').val();
			var discount_amount = $('#discount_amount').val();
			dis = parseFloat(((discount_amount * 100) / (tutfee)));
			$('#discount_per').val(dis);
			$('#discount_per').trigger('change');
		});

        $('#mnths_div').hide();
        $('#payment_table').hide();

        $('#payment_type').change(function () {

            payment_type = $('#payment_type').val();

            if (payment_type == "part") {

                $('#mnths_div').show();

            } else {

                $('#mnths_div').hide();

            }

        })

        $('#cost').change(function () {

            $('#payment_table').show();
            $('#tbody').empty();

            total = $('#cost').val();
            payment_duration = $('#mnths').val();

            payment_amount = (parseFloat(total) / parseFloat(payment_duration)).toFixed(2);
            var today = new Date();

            for (i = 1; i <= payment_duration; i++) {
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                date = yyyy + '-' + mm + '-' + dd;

                addpayment(i, date, payment_amount);

                today.setMonth(today.getMonth() + 1);

            }

        })





        $('#mnths').keyup(function () {
            if ($('#cost').val()) {
                $('#cost').trigger('change');

            }

        })




        refMode = $('#ref').val();
        $("#ref").change(function () {

            refMode = $('#ref').val();
            //  alert(refMode)
            $('#course').trigger("change");
        });


        setUniv();
        setBatch();

        $("#m_itemClick").bind("click", function () {
            ismodel = true;
            popup_type = $(this).attr('popup_type');
            $('#crudForm').trigger('submit');
        });

        function addpayment(i, date, payment_amount) {

            var new_row =
                '<tr><td> <input  class="form-control"  value="' + i +
                '"  type="text"  maxlength="50"></td>' +
                '<td> <input  class="form-control " name="fee_date[]" value="' + date +
                '"  type="date" style="height:25px ; padding: 3px;"  maxlength="50"></td>' +
                '<td> <input  class="form-control"   type="text" name ="payment_amount[]" value="' +
                payment_amount +
                '"  maxlength="50"></td>';
            $('#payment_table').append(new_row);


        }
        load();
        states_cus(0);
        area_cuss(0);
        price_list(0);
        route_cuss(0);
        $('#name').focus();
        $('#btnsave').click(function () {
            var ms = $("#frmcreate").isValid();
            if (ms !== true) {
                return;
            }
        });
        $('#myModalPop_cus').on('shown.bs.modal', function () {
            $('#name').focus();
        });
        $('#myModalPop_cus').on('hidden.bs.modal', function () {
            var opt = $("#m_itemClick").attr('opt');
            if (opt === 'states_cus') {
                states_cus(1);
            }
            if (opt === 'area_cus') {
                area_cuss(1);
            }
            if (opt === 'pricelst') {
                price_list(1);
            }
            if (opt === 'route_cuss') {
                route_cuss(1);
            }
            $('#is_model').val(0);
        });
        $(".myModalPop_cus").click(function () {
            var opt = $(this).attr('opt');
            $("#m_itemClick").attr('opt', opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    // $('.box-header').remove();
                    $('.box-p').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop_cus').modal();
                    $('#is_model').val(1);
                    //$('.popuphide').hide();
                }
            });
        });
    });



    $(".myModalPop_admType").click(function () {
        $("#myModalPop_admType").modal('show');
        $("#saveit").click(function () {
            $("#myModalPop_admType").modal('hide');
        });
    });
    $("#saveit").click(function () {
        $("#myModalPop_admType").modal('hide');
    });

    var inc_inary = 0;
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });

    function load() {
        var id = $("#id").val();
        var view = $("#view").val();
        var type = $("#type").val();

        var taxtype = $("#tax_type").val();
        if (taxtype === "GST") {
            $(".tax_id").html("<?= label('GSTIN :', $this, $user) ?>");
        } else {
            $(".tax_id").html("<?= label('Tax ID :', $this, $user) ?>");
        }

        $("#states_cus").change(function () {

            var stateid = $(this).val();
            $.ajax({
                url: "<?php echo site_url('customers/getstatecode/'); ?>/" + stateid,
                success: function (results) {
                    var result = JSON.parse(results);
                    $('#states_cus').val(result.StateID);
                    $('#stcode').val(result.code);
                }
            });
        });


        var textForRef = "";
        $.ajax({

            async: false,
            url: "<?php echo site_url('education/Course/getAllMode'); ?>",
            success: function (results) {
                textForRef = textForRef + '<option value = "0">--Select--</option>';
                $.each(JSON.parse(results), function (i, items) {
                    textForRef = textForRef + '<option value = "' + items.percent + '">' + items
                        .name + '</option>';

                    // var selected = '<input type="hidden" value="'+items.id+'" name="typeid" id="typeid"/>';
                });
                $('#ref').html(textForRef);


            }
        });





        if (id > 0) {
			

			
            function addpayment(i, date, payment_amount) {

                var new_row =
                    '<tr><td> <input  class="form-control"  value="' + i +
                    '"  type="text"  maxlength="50"></td>' +
                    '<td> <input  class="form-control " name="fee_date[]" value="' + date +
                    '"  type="date" style="height:25px ; padding: 3px;"  maxlength="50"></td>' +
                    '<td> <input  class="form-control"   type="text" name ="payment_amount[]" value="' +
                    payment_amount +
                    '"  maxlength="50"></td>';
                $('#payment_table').append(new_row);
            }

            $("#hid").remove();
            $.ajax({
                async: false,
                url: "<?php echo site_url('education/Student/getFeeDetails'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    setBatch(result.batch);
					$('#discount_per').val(result.fee_discount_per);
					$('#discount_amount').val(result.fee_discount_amount);
					$('#duration').val(result.no_of_classes);
					$('#payment_method').val(result.payment_method);
					$('#payment_note').val(result.payment_note);
					setpaymentnote(result.payment_method)
					$('#fees').val(result.fees_amount);
                    $("#tutfee").val(result.fee_tutfee);
                    $("#name").val(result.studname);
                    $("#phone").val(result.mob);
                    $("#myid").val(result.stud_id);
					$('#fee_start_date').val(formatDate(result.fee_start_date));
					$('#fee_end_date').val(formatDate(result.fee_end_date));
                    $("#ref").val(result.discountpercent);
                    $("#discountpercs").val(result.discountpercent);
                    $("#totalfees").val(result.discountedfee);

                    setUniv(result.universe);
                    getcources(result.universe, result.courses);
					//loadcalendar(result.courses,result.batch);
					$.ajax({

						async: false,
						url: "<?php echo site_url('education/student/getalldatebyMonth/'); ?>"+id+'/'+result.courses,
						success: function (results) {
						$.each(JSON.parse(results), function (i, items) {
							if(items.type === 'Absent' && items.id !== undefined){
								date_array.push(items.id);
							}
						});
						text = '0';
						for( var i = 0; i < date_array.length; i++){ 
								if(parseFloat(date_array[i]) > 0 ){
									var text = text + ','+date_array[i];
									$('#txtabsent').val(text);
								}
    
							}

						}		
					});
                    $('#cost').val(result.discountedfee);

                    //$("#ref").trigger('change');

                    $.ajax({
                        async: false,
                        url: "<?php echo site_url('education/Student/getFeeSchedules'); ?>/" + id,
                        success: function (results) {
                            var result = JSON.parse(results);
                            $('#payment_table').show();
                            $.each(result, function (i, item) {

                                addpayment(i + 1, item.date, item.amount);

                            })
                        }
                    });


                }
            });






        } else {
            $('#states_cus option:contains("KERALA")').prop('selected', true);
			getcources();

        }
    }

    function states_cus(is_select) {
        $.ajax({
            url: "<?php echo site_url('master/amaster/states'); ?>/",
            async: false,
            success: function (result) {
                var option = '';
                $.each(JSON.parse(result), function (i, itemsingle) {
                    option = option + '<option value ="' + itemsingle.StateID + '"> ' +
                        itemsingle
                        .StateName + '</option>';
                });
                $("#states_cus").html(option);
                if (is_select === 1) {
                    var myVal = $('#states_cus option:last').val();
                    $('#states_cus').val(myVal);
                }
            }
        });
    }

    function area_cuss(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area_cus').html(result);
                if (is_select === 1) {
                    var myVal = $('#area_cus option:last').val();
                    $('#area_cus').val(myVal);
                }
            }
        });
    }

    function price_list(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('Customers/price_list'); ?>",
            success: function (result) {
                $('#price_list').html(result);
                if (is_select === 1) {
                    var myVal = $('#price_list option:last').val();
                    $('#price_list').val(myVal);
                }
            }
        });
    }

    function route_cuss(is_select) {
        $.ajax({
            async: false,
            url: "<?php echo site_url('ajaxcall/route'); ?>",
            success: function (result) {
                $('#route_cus').html(result);
                if (is_select === 1) {
                    var myVal = $('#route_cus option:last').val();
                    $('#route_cus').val(myVal);
                }
            }
        });
    }
    $(document).ready(function () {

    });

    // var discounted = 0;
    // var refMode = $('#ref').val();

    var refMode = $('#ref').val();

	 $("#batch").change(function () {
			var batch = $("#batch").val();
			var course_id  = $("#course").val();
			if(course_id !== ''){
				if(parseFloat(course_id) > 0 && parseFloat(batch) > 0  ){
					//loadcalendar(course_id);
				}
			}
	});
    $("#course").change(function () {

        if ($('#course option:selected').text() == 'Select') {
            $('#cost').val('');
        }
        var idss = $('#course option:selected').val();
        var discounted = 0;
        $.ajax({
            url: "<?php echo site_url('education/Student/getfee'); ?>/" + idss,
			async:false,
            success: function (result) {
                $.each(JSON.parse(result), function (i, items) {
					$('#fee_end_date').val(formatDate(items.validity));
					$('#tutfee').val(items.tutionfee);
					$('#discount_per').val(items.discount_per);
					$("#duration").val(items.open_stock);
					$('#discount_amount').val(items.discount_amount);
					$('#fees').val(items.fees);
                    total = parseInt(items.tutionfee) + parseInt(items.examfee) +
                        parseInt(
                            items.certificatefee) + parseInt(items.otherfee);
                    $('#totalfees').val(total);
                    $('#discountpercs').val(refMode);

                    if (refMode != 0) {
                        discounted = total - refMode;
                        // discounted = total - discounted;
                        $('#cost').val(discounted);
                        $('#cost').trigger("change");

                    } else {
                        $('#cost').val(total);
                        $('#cost').trigger("change");

                    }


                });

            }
        });
		var course_id  = $("#course").val();
		if(course_id !== ''){
			if(parseFloat(course_id) > 0  ){
				//loadcalendar(course_id);
			}
		}
    });



    var course = "";

    // var univ = 1;
    $(document).ready(function () {
        if (id < 1) {

        }




    })
    $('#universe').change(function () {
        var univ = $("#universe option:selected").val();
        getcources(univ);
    });



    function getcources(unid = 0, cid = 0) {

        $.ajax({
            url: "<?php echo site_url('education/Student/getcourse'); ?>/" + unid,
            success: function (result) {
                var course = '<option value = "">Select</option>';
                $.each(JSON.parse(result), function (i, items) {
                    if (items.id == cid) {
                        course = course + '<option selected = "selected" value = "' + items.id +
                            '">' + items.name + '</option>';
                    } else {
                        course = course + '<option value = "' + items.id + '">' + items.name +
                            '</option>';
                    }
                });
                $('#course').html(course);

            }
        });

    }


    var textForAdm = "";
    $.ajax({

        url: "<?php echo site_url('education/Student/getAdmType'); ?>",
        success: function (results) {
            console.log(results);

            $.each(JSON.parse(results), function (i, items) {
                textForAdm = '<option value = "' + items.id + '">' + items.name + '</option>';
                $('#adm_type').append(textForAdm);
                // var selected = '<input type="hidden" value="'+items.id+'" name="typeid" id="typeid"/>';

            });


        }
    });



    function setUniv(univ = 0) {
        var text = "";
        $.ajax({

            url: "<?php echo site_url('education/Course/getUniversity'); ?>",
            success: function (results) {
                text = '<option value = "">Select</option>';
                $.each(JSON.parse(results), function (i, items) {
                    //  alert(univ)
                    if (items.id == univ) {
                        text = text + '<option selected = "selected" value = "' + items.id +
                            '">' +
                            items.name + '</option>';
                    } else {
                        text = text + '<option value = "' + items.id + '">' + items.name +
                            '</option>';
                    }

                    $('#universe').html(text);
                    // var selected = '<input type="hidden" value="'+items.id+'" name="typeid" id="typeid"/>';
                });


            }
        });
    }



    function setBatch(batch = 0) {
        var textForBatch = "";
        $.ajax({

            url: "<?php echo site_url('education/Student/getAllBatch'); ?>",
            success: function (results) {
                textForBatch = textForBatch + '<option value = "" >--Select--</option>';
                $.each(JSON.parse(results), function (i, items) {
					var start = items.start_date;
					var end = items.end_date;
					var ba =items.batch;
					var is_calendar = $('#is_calendar').val();
					if(parseFloat(is_calendar) > 0  ){
						start = items.start_time;
						end = items.end_time;
						ba= '';
					}
                    if (items.id == batch) {
                        textForBatch = textForBatch +
                            '<option selected = "selected" value = "' +
                            items.id + '">' + ba + '   [' + start+' &nbsp;&nbsp; to &nbsp;&nbsp;   '+ end+']</option>';
                    } else {
                        textForBatch = textForBatch + '<option value = "' + items.id + '">' +
                            ba + '   [' + start+' &nbsp;&nbsp; to &nbsp;&nbsp;   '+ end+']</option>';
                    }
                });
                $('#batch').html(textForBatch);


            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#frmcreatemodelc').validate();
    })
    $(document).ready(function () {
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>education/Student/getAll", // path to the get_birds method
            minLength: 1,
            select: function (event, ui) {
                $("#name").val(ui.item.id);
                stud_id = ui.item.id;
                $("#myid").val(stud_id);
                $.ajax({
                    url: "<?php echo site_url('education/Student/getDetails'); ?>/" +
                        stud_id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#phone").val(result.phone);
                    }
                });
            }
        });
    })
</script>