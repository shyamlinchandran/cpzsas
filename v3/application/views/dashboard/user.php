 
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1> 
</section> 
<section class="content"> 
    <div class="row">
        <!-- Application buttons -->
        <div class="<?=$this->box_color?>">
            <div class="box-header">
                <h3 class="box-title">Application Buttons</h3>
            </div>
            <div class="box-body">
                <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a&gt;</code> tag to achieve the following:</p>
                <a class="btn btn-app">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a class="btn btn-app">
                    <i class="fa fa-play"></i> Play
                </a>
                <a class="btn btn-app">
                    <i class="fa fa-repeat"></i> Repeat
                </a>
                <a class="btn btn-app">
                    <i class="fa fa-pause"></i> Pause
                </a>
                <a class="btn btn-app">
                    <i class="fa fa-save"></i> Save
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-yellow">3</span>
                    <i class="fa fa-bullhorn"></i> Notifications
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-green">300</span>
                    <i class="fa fa-barcode"></i> Products
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-purple">891</span>
                    <i class="fa fa-users"></i> Users
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-teal">67</span>
                    <i class="fa fa-inbox"></i> Orders
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-aqua">12</span>
                    <i class="fa fa-envelope"></i> Inbox
                </a>
                <a class="btn btn-app">
                    <span class="badge bg-red">531</span>
                    <i class="fa fa-heart-o"></i> Likes
                </a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- Various colors -->
        <div class="<?=$this->box_color?>">
            <div class="box-header">
                <h3 class="box-title">Different colors</h3>
            </div>
            <div class="box-body">
                <p>Mix and match with various background colors. Use base class <code>.btn</code> and add any available
                    <code>.bg-*</code> class</p>
                <!-- You may notice a .margin class added
                here but that's only to make the content
                display correctly without having to use a table-->
                <p>
                    <button type="button" class="btn bg-maroon btn-flat margin">.btn.bg-maroon.btn-flat</button>
                    <button type="button" class="btn bg-purple btn-flat margin">.btn.bg-purple.btn-flat</button>
                    <button type="button" class="btn bg-navy btn-flat margin">.btn.bg-navy.btn-flat</button>
                    <button type="button" class="btn bg-orange btn-flat margin">.btn.bg-orange.btn-flat</button>
                    <button type="button" class="btn bg-olive btn-flat margin">.btn.bg-olive.btn-flat</button>
                </p>

                <p>
                    <button type="button" class="btn bg-maroon margin">.btn.bg-maroon</button>
                    <button type="button" class="btn bg-purple margin">.btn.bg-purple</button>
                    <button type="button" class="btn bg-navy margin">.btn.bg-navy</button>
                    <button type="button" class="btn bg-orange margin">.btn.bg-orange</button>
                    <button type="button" class="btn bg-olive margin">.btn.bg-olive</button>
                </p>
            </div>
        </div>
        <!-- /.box -->

        <!-- Vertical grouping -->
        <div class="<?=$this->box_color?>">
            <div class="box-header">
                <h3 class="box-title">Vertical Button Group</h3>
            </div>
            <div class="box-body table-responsive pad">

                <p>
                    Vertical button groups are easy to create with bootstrap. Just add your buttons
                    inside <code>&lt;div class="btn-group-vertical"&gt;&lt;/div&gt;</code>
                </p>

                <table class="table table-bordered">
                    <tbody><tr>
                            <th>Button</th>
                            <th>Icons</th>
                            <th>Flat</th>
                            <th>Dropdown</th>
                        </tr>
                        <!-- Default -->
                        <tr>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-default">Top</button>
                                    <button type="button" class="btn btn-default">Middle</button>
                                    <button type="button" class="btn btn-default">Bottom</button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-default"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-default btn-flat"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-default btn-flat"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-default btn-flat"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-default">1</button>
                                    <button type="button" class="btn btn-default">2</button>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Dropdown link</a></li>
                                            <li><a href="#">Dropdown link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- ./default -->
                        <!-- Info -->
                        <tr>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-info">Top</button>
                                    <button type="button" class="btn btn-info">Middle</button>
                                    <button type="button" class="btn btn-info">Bottom</button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-info"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-info"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-info"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-info">1</button>
                                    <button type="button" class="btn btn-info">2</button>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Dropdown link</a></li>
                                            <li><a href="#">Dropdown link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- /. info -->
                        <!-- /.danger -->
                        <tr>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-danger">Top</button>
                                    <button type="button" class="btn btn-danger">Middle</button>
                                    <button type="button" class="btn btn-danger">Bottom</button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-danger">1</button>
                                    <button type="button" class="btn btn-danger">2</button>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Dropdown link</a></li>
                                            <li><a href="#">Dropdown link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- /.danger -->
                        <!-- warning -->
                        <tr>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-warning">Top</button>
                                    <button type="button" class="btn btn-warning">Middle</button>
                                    <button type="button" class="btn btn-warning">Bottom</button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-warning"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-warning"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-warning"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-warning btn-flat"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-warning btn-flat"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-warning btn-flat"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-warning">1</button>
                                    <button type="button" class="btn btn-warning">2</button>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Dropdown link</a></li>
                                            <li><a href="#">Dropdown link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- /.warning -->
                        <!-- success -->
                        <tr>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-success">Top</button>
                                    <button type="button" class="btn btn-success">Middle</button>
                                    <button type="button" class="btn btn-success">Bottom</button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-success"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-success"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-success"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-success btn-flat"><i class="fa fa-align-left"></i></button>
                                    <button type="button" class="btn btn-success btn-flat"><i class="fa fa-align-center"></i></button>
                                    <button type="button" class="btn btn-success btn-flat"><i class="fa fa-align-right"></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-success">1</button>
                                    <button type="button" class="btn btn-success">2</button>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Dropdown link</a></li>
                                            <li><a href="#">Dropdown link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- /.success -->
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bar-chart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Cash In Hand</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-grain"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Item to Reorder</span>
                    <span class="info-box-number">111</span>
                </div>

            </div>

        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-list-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Today's Sales", $this, $user) ?></span>
                    <span class="info-box-number"><?= label("Cash", $this, $user) ?> : <?php echo $cash; ?><br>
                        <?= label("Credit", $this, $user) ?> : <?php echo $credit; ?></span>

                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Today's Purchase", $this, $user) ?></span>
                    <span class="info-box-number"><?php echo $purchase; ?></span>
                </div>

            </div>

        </div>
        <br>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-list-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Estimate", $this, $user) ?></span>
                    <span class="info-box-number" id="sales"><?php echo $estimate; ?></span>
                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Purchase Orders", $this, $user) ?></span>
                    <span class="info-box-number"><?php echo $porder; ?></span>
                </div>
                </a>
            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-list-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Sales Return", $this, $user) ?></span>
                    <span class="info-box-number"><?php echo $sreturn; ?></span>
                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Purchase Return", $this, $user) ?></span>
                    <span class="info-box-number"><?php echo $preturn; ?></span>
                </div>
            </div>

        </div>

    </div>  
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title">Items</h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('item\listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label("SNo", $this, $user) ?></th>
                                <th><?= label("Item", $this, $user) ?></th>
                                <th><?= label("Category", $this, $user) ?></th>
                                <th><?= label("Sales Rate", $this, $user) ?></th>
                                <!-- <th>Group Name</th>  
                                <th>Unit</th> 
                                <th>GST</th> -->
                                <th><?= label("Actions", $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label("Items", $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('item\listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th><?= label("SNo", $this, $user) ?></th>
                                <th><?= label("Item", $this, $user) ?></th>
                                <th><?= label("Category", $this, $user) ?></th>
                                <th><?= label("Sales Rate", $this, $user) ?></th>
                                <!-- <th>Group Name</th>  
                                <th>Unit</th> 
                                <th>GST</th> -->
                                <th><?= label("Actions", $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

</section>

<script type="text/javascript">

    $(document).ready(function () {
        load();
    });


    function load() {

//                $.ajax({
//                    url: "<?php echo site_url('dashboard/getsales'); ?>/",
//                    success: function (results) {
//                        var result = JSON.parse(results);
//                        $("#sales").val(result.stotal);
//                       
//                        
//                    }
//                });
    }
</script>
<!-- 
<<<<<<< HEAD
======= -->
<!--<script type="text/javascript">

    var table;
    var tableCHK, tablesup, tablecus;
    $(document).ready(function () {

        $.ajax({
            url: "<?php echo site_url('dashboard/checklistmismatchcnt'); ?>",
            async: false,
            success: function (result) {
                if (result === '0') {
                    $("#chkmis").hide();
                }
            }
        });

        //datatables
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    //data.type = ;
                    //data.supid = $('#supid').val();
                }
            }


        });
        tablesup = $('#tablesup').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aeging/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.typ = 'Sales';
                    //data.supid = $('#supid').val();
                }
            }


        });
        tablecus = $('#tablecus').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aeging/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.typ = 'Purchase';
                    // data.country = $('#country').val();
                    //data.type = ;
                    //data.supid = $('#supid').val();
                }
            }


        });
        tableCHK = $('#tablechk').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "bPaginate": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/checklist') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    //data.type = ;
                    //data.supid = $('#supid').val();
                }
            }


        });

    });

</script> -->
<!-- >>>>>>> 2f22470de6d48df9b8e5c981ff08d88e3578ded5 -->
