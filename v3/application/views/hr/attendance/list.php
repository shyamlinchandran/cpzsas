<?php
?> 

<style>
    .box-title {
        text-transform: capitalize;
    }
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/Attendance/list_all'); ?>" action="<?php echo site_url('hr/Attendance/save') ?>">
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Attendance</h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
					 <table   class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                               <td class="col-sm-2">
                                    <?= label('Date', $this, $user) ?>
                                    <input type="text" class="form-control date" name = "date" id="date"/>
                                </td>

                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>  
					<br />
                    <table id="table"  class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Image', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <th><?= label('Mobile', $this, $user) ?></th>
								<th><?= label('Status', $this, $user) ?></th>
                                <th><?= label('In Time', $this, $user) ?></th>
                                <th><?= label('Out Time', $this, $user) ?></th>
                                <th><?= label('Leave Type', $this, $user) ?></th>
                                <th><?= label('Shift', $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
					<input type="submit" value="Save All"  class="btn btn-primary"/>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
</form>
<script type="text/javascript">

    var table;

    $(document).ready(function () {
		$('#date').change(function(){
			table.ajax.reload(null, false);  //just reload table
		});

        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('hr/Attendance/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
					data.date = $('#date').val();
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


    });

</script>  
