<?php $add_url = site_url('main/members/create'); ?>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Members</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <br/>
                                    <a role="button" class="btn btn-default" href="<?php echo $add_url ?>">
                                        <span class="glyphicon glyphicon-plus"></span> 
                                    </a>
                                </td>
                                <td class="col-sm-2">
                                    Name
                                    <input type="text" class="form-control" id="FirstName"/>
                                </td>
                                <td class="col-sm-2">
                                    Email
                                    <input type="text" class="form-control" id="LastName"/>
<!--                                    <select class="form-control" name="quali_id">
                                        <option value=''>Select</option>
                                    <?php foreach ($qualifications as $value) { ?>
                                                    <option value='<?php echo $value['id']; ?>'><?php echo $value['name']; ?></option>
                                    <?php } ?>
                                    </select>-->
                                </td>
                                <td class="col-sm-2">
                                    Phone
                                    <select class="form-control" name="district_id">
                                        <option value=''>Select</option>
                                        <?php foreach ($districts as $value) { ?>
                                            <option value='<?php echo $value['id']; ?>'><?php echo $value['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
<!--                                <th>Eligibility</th>-->
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
 
    var table;
 
    $(document).ready(function() {
 
        //datatables
        table = $('#table').DataTable({ 
 
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('main/members/ajax_list') ?>",
                "type": "POST",
                "data": function ( data ) {
                    // data.country = $('#country').val();
                    data.FirstName = $('#FirstName').val();
                    data.LastName = $('#LastName').val();
                    data.address = $('#address').val();
                }
            },
 
            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false //set not orderable
                }]
 
        });
 
        $('#btn-filter').click(function(){ //button filter event click
            table.ajax.reload(null,false);  //just reload table
        });
        $('#btn-reset').click(function(){ //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null,false);  //just reload table
        });
 
    });
 
</script>
<!-- 

<script type="text/javascript">
 
    var table;
 

    $(document).ready(function() {
 
        //datatables
        table = $('#table').DataTable({ 
            //"dom": "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-4'i>><'row'p>",// 'Bfrtip',
            "dom":"<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>R" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
             "language": lan,"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.,
            //"lengthMenu": [[10, 100, -1], [25, 100, "All"]],
            "buttons": [
                //                { "extend":'csv',"text": '<button><span class="fa fa-file-excel-o"></span> Coppy</button>'},
                //                {
                //                    extend: 'pdfHtml5',
                //                    text: 'Save current page',
                //                    exportOptions: {
                //                        modifier: {
                //                            page: 'current'
                //                        }
                //                    }
                //                },
        
                {
                    "extend": 'excel',
                    "text": '<button class="btn"<span class="fa fa-file-excel-o"></span> Excel Export  </button> ',
                    "exportOptions": {
                        'modifier': {
                            'search': 'applied',
                            'order': 'applied'
                        }
                    }
                }
            ],
            "order": [], //Initial no order.
 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('customers/ajax_list') ?>",
                "type": "POST"
            },
 
            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false 
                },
            ] 
        });
 
    }); 
</script>
<script type="text/javascript">
    /*
var table;
 
$(document).ready(function() {
 
   //datatables
   table = $('#table').DataTable({ 
 
        "language": lan,"processing": true, //Feature control the processing indicator.
       "serverSide": true, //Feature control DataTables' server-side processing mode.
       "order": [], //Initial no order.
 
       // Load data for the table's content from an Ajax source
       "ajax": {
           "url": "<?php echo site_url('customers/ajax_list') ?>",
           "type": "POST"
       },
 
       //Set column definition initialisation properties.
       "columnDefs": [
       { 
           "targets": [ 0 ], //first column / numbering column
           "orderable": false //set not orderable
       },
       ] 
 
   });
 
});*/
</script>-->
</body>
</html>