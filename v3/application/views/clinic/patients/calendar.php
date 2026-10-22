<?php
$add_url = site_url('clinic/Booking/calendar');
$pat_url = site_url('clinic/patients/create');
?>
<style>
    .ui-autocomplete {
        position: absolute;
        top: 0;
        left: 0;
        cursor: default;
        background-color:#fff;
        border: 1px solid #aaaaaa;
        max-height: 200px; 
        overflow-y: auto;   /* prevent horizontal scrollbar */
        overflow-x: hidden; /* add padding to account for vertical scrollbar */
        z-index:1000 !important;
    }
</style>
<input type="hidden"  id="url" value="<?php echo $add_url ?>"/>
<a  id="urlbtn" back="<?php echo site_url('clinic/listall'); ?>" class="btn  hidden btn-success align-bottom" href="<?php echo $add_url ?>">

</a>
<section class="content">
    <div class="row"> 
        <input type="hidden"  id="cus_id" name="cus_id"/> 
        <input type="hidden"  id="aid" name="aid"/>  
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', 'Bookings')) ?></h3>

                    <span class="pull-right">

                    </span>
                </div> 
                <div class="box-body">

                    <div  class="col-sm-12 form-group">
                        <label class="col-sm-2 control-label" id="name_display_as_box">
                            Name*<span class="required"></span>  :
                        </label>
                        <div class="col-sm-4" id="name_input_box">
                            <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                        </div>  
                         <a role="button" id="btnadd" back="<?php echo site_url('clinic/listall'); ?>" class="btn  btn-success align-bottom" title="book">
                                <span class="glyphicon glyphicon-plus"></span> 
                            </a>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('clinic/patients/calendar'); ?>" class="btn  btn-info align-bottom" href="<?php echo $pat_url ?>" title="patient">
                                <span class="glyphicon glyphicon-user"></span> 
                            </a>
                           
                        </span>
                    </div>
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section> 
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Approve <span id="show_name"></span> </h4>
            </div>
            <div class="modal-body">
                <table clas>
                    <tr>
                        <td> Approve  </td>
                        <td><textarea rows="4" cols="50" name="notes" id="note" class="form-control"> </textarea>            
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_close" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="btn_save" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<a href=""  id="navigatetodestination"/>
<button type="button" id="loanch" class="hidden btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>


<!-- /.form-group -->
</form>
</div>
<!-- /.tab-pane -->
</div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div> 
<script src="<?php echo base_url(); ?>assets/fullcalendar/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script type='text/javascript'>
    function createul() {
        var url = $('#url').val();
        var cus_id = $('#cus_id').val();
        if (cus_id != '') {
            url = url + '?cus_id=' + cus_id;
        }
        return  url;
    }
    $(document).ready(function () {
        $("#name").autocomplete({
            source: "<?php echo site_url('ajaxcall/Patient'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#cus_id').val(ui.item.Pat_Id)
            }
        });
        $('#btnadd').click(function () {
            var url = createul();
            $('#urlbtn').attr('href', url);
            $('#urlbtn').click();
        });
        $("#btn_save").on("click", function (e) {
            e.preventDefault();
            $.ajax({type: "POST",
                url: "<?php echo site_url('clinic/Patients/updatestatus') ?>",
                data: {id: $("#aid").val(), note: $("#note").val()},
                success: function (result) {
                    $("#btn_close").click();
                    $('#calendar').fullCalendar('refetchEvents');
                    $("#note").val('');
                    $("#aid").val(0);
                },
                error: function (result) {
                    alert('error');
                }
            });
        });
    });
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
                var url = $('#url').val();
                url = url + '?date=' + res[0];
                if (res[1] !== '') {
                    url = url + '&time=' + res[1];
                }
                var cus_id = $('#cus_id').val();
                if (cus_id !== '') {
                    url = url + '&cus_id=' + cus_id;
                }
                $('#urlbtn').attr('href', url);
                $('#urlbtn').click();

            },
            minTime: "16:00:00",
            maxTime: "24:00:00",
            slotDuration: '00:10:00',
            // snapDuration: '00:05:00',
            events: '<?php echo base_url(); ?>/clinic/api/getallrequstbyMonth',
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventClick: function (calEvent, jsEvent, view) {
                //  var urls = '<?php echo base_url(); ?>/clinic/Booking/edit/' + calEvent.id;

                if (calEvent.type === 'Pending') {
                    $('#aid').val(calEvent.id);
                    $('#show_name').text(calEvent.title);
                    $("#loanch").click();
                    $(this).css('border-color', 'red');
                }
                if (calEvent.type === 'Approve') {
                    var urls = '<?php echo base_url(); ?>/clinic/Doctor/calendar/' + calEvent.id;
                    $("#navigatetodestination").attr('href', urls);
                    $("#navigatetodestination").click();
                }
                if (calEvent.type === 'Checked') {
                }
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
    })
</script>
</body>
</html>
