<?php
$add_url = site_url('hotel/roombooking/create');
$checkin_url = site_url('hotel/roombooking/checkin');
?>

<style>
    .box-title {
        text-transform: capitalize;
    }
    .aa{
        text-align: left;
    }
    .ab{
        text-align: right;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 id="hhead" class="box-title">Room Booking</h3>
                    <span style="font-color:white" class="pull-right">
                        <a style="background-color:green" role="button" back="<?php echo site_url('hotel/roombooking/list_all'); ?>" class="btn  addbutton align-bottom" href="<?php echo $add_url ?>">
							<font style="color:white"> Create Booking</font>
                        </a>
                        <a style="background-color:green" role="button" back="<?php echo site_url('hotel/roombooking/list_all'); ?>" class="btn  addbutton align-bottom" href="<?php echo $checkin_url ?>">
                           <font style="color:white"> Create Checkins</font>
                        </a>
                    </span>
                </div>


                <div class="modal fade" tabindex="-1" id="imgmodal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                        <span class="pull-right">
                        <button type="button" id="btncls" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                        </span>
                        </div>
                            <div class="modal-body">
                                <label id="itname" style="padding: 20px;"></label>
                                <table width=100%>
                                <tr>
                                <td>
                                <h4 class="text-left">Image</h4></td><td> <h4 class="text-right">Id Proof</h4>
                                </td>
                                </tr>
                                </table>
                               
                               
                            </div>
                            <div class="modal-footer" id="img_div">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">

                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                    <?= label('Status', $this, $user) ?>
                                    <select id="status" class="form-control">
                                        <option value="Created">Booked</option>
                                        <option value="Checkin">Chekins</option>
                                        <option value="Checkout">Checkouts</option>
                                    </select>
                                </td>
                                <td class="col-sm-2">

                                </td>
                                <td class="col-sm-2">

                                </td>
                                <td class="col-sm-2">

                                </td>
                                <td class="col-sm-2">

                                </td>

                                <td>
                                    <br />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="table" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Booking No', $this, $user) ?></th>
                                <th><?= label('Start Date', $this, $user) ?></th>
                                <th><?= label('End Date', $this, $user) ?></th>
                                <th><?= label('No.of Days', $this, $user) ?></th>
                                <th><?= label('Rooms',$this,$user)?></th>
								 <th><?= label('Room Category',$this,$user)?></th>
                                <th><?= label('Customer', $this, $user) ?></th>
                                <th><?= label('Amount', $this, $user) ?></th>
                                <th><?= label('Advance', $this, $user) ?></th>
                                <th><?= label('Received Amount', $this, $user) ?></th>
                                <th><?= label('Return Amount', $this, $user) ?></th>
                                <th><?= label('Balance', $this, $user) ?></th>
                                <th><?= label('Action', $this, $user) ?></th>
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
    <!-- /.row -->
</section>
<script type="text/javascript">
    function loadimage(id) {
        var text = '';
        $.ajax({
            url: "<?php echo site_url('hotel/Roombooking/get_images/'); ?>"+id,
            method: 'post',
            async: false,
            data: {
                id: id
            },
            success: function(result) {

                 $.each(JSON.parse(result), function(i, itemsingle) {
                     $('#itname').html(itemsingle.image);
                     console.log(itemsingle);
                     if(itemsingle<1)
                     {
                        text = text + '<div class="col-sm-6"><img  src="<?php echo base_url(); ?>/assets/images/Blank_Club_Website_Avatar_Gray.jpg" height="160px" width="200px" /></div>';

                     }
                     else{
                     text = text + '<div class="col-sm-6"><img  src="<?php echo base_url(); ?>assets/images/' + itemsingle + '" height="160px" width="200px" /></div>';
                     }
                 });
            }
        });
        
        $('#img_div').html(text);
        $('#imgmodal').modal('show');
    }

    // $(document).on('click', '.myModalPop', function() {
    //     $('#imgmodal').modal('show');
    // });

    // $("#myModalPop").click(function() {
    //     var id = $("#imgmodal").attr("id");
    //     alert(id);
    // });

    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [],
			"fnDrawCallback": function () {
                loadpermission();
			},
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('hotel/roombooking/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.status = $('#status').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });

        // $("#show").click(function() {
        //     $('#myModal_id').modal('show');
        // });
        // $("#hide").click(function() {
        //     $('#myModal_id').modal('hide');
        // });



        


        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#status').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
			var status = $('#status').val();
			$('#hhead').html('Room Booking');
			if(status ==='Checkin'){
				$('#hhead').html('Room Checkins');
			}else if(status==='Checkout'){
				$('#hhead').html('Room CheckOut');
			}
			
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });


    });

   
</script>