<?php
$user = $this->session->userdata('user');
$dash = $this->session->userdata('dash');
$fin_database = $this->session->userdata('fin_database');
if (isset($_COOKIE['language'])) {
    $language = $_COOKIE['language'];
} else {
    $language = 'en';
}
$dbcompany = $this->session->userdata('dbcompany');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php $company = $this->load->get_var('company'); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FazPro Online |  <?php echo $company['name']; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fullcalendar/dist/fullcalendar.print.min.css" media="print">
        <!--calendar--> 
        <?php if ($language == 'ac') { ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/skins/_all-skinsr.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/AdminLTEr.css">
            <link href="<?php echo base_url(); ?>assets/css/jquery.auto-completer.css" rel="stylesheet" type="text/css"/>

        <?php } else { ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/skins/_all-skins.min.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/AdminLTE.min.css">
            <link href="<?php echo base_url(); ?>assets/css/jquery.auto-complete.css" rel="stylesheet" type="text/css"/>
            <style>
                .form-input-box
                {
                    float: left;
                }
            </style>       
        <?php } ?> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popupwindow.css" />
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/common.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/chat.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/toastr.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>assets/averta/averta.css" rel="stylesheet" type="text/css"/>
        <style>
            body {
                padding: 0px !important;
                font-family: 'Averta','Helvetica Neue',Helvetica,Arial,sans-serif !important;
               
                overflow-x: hidden;
                overflow-y: auto;
            }
             th, label{
                  font-weight: 400 !important;
             }
            .hunpx{
                width: 100px !important;
                height: 25px !important;
            }
            .btn{
                padding: 10px !important;
                height: 25px !important;
                padding-top: 1px !important;
            } 
            .fullscreen{
                position: fixed; 
                top: 0px;
                left: 0px;
                margin: 0px;
                padding: 0px;
                width: 100%;
                height: 100%; 
                background: black;
                z-index: 2147483647;
            }
            .table>tbody>tr>td
            {
                padding: 3px !important;
            }
            input[type=text],select,input[disabled] {
                height: 25px !important;
                padding: 3px !important;
            }

            textarea{
                height: 55px !important;
            } 
            .ui-autocomplete { max-height: 200px; overflow-y: scroll; overflow-x: hidden;}
            .myhide{ 
                padding-top: 23px !important;
            }
            #loading-img {
                background: url("<?php echo base_url() . "/assets/images/ajax-loading.gif" ?>") center 30vh  no-repeat;
                display: none;
                height: 100%;
                width: 100%;
                position: absolute;
                top: 0%; 
                background-color:#fff;
            } 
            .group {
                position: relative;
                width: 100%;
            }
            .kdhp-cap {
                display: inline-block;
                top: 15px;
                position: absolute;
                color: #fff;
                left: auto;
                right: auto;
                margin: auto;
                text-align: center;
                width: 87%;
                text-transform: capitalize;
            }

            .popupwindow_container{ 
                z-index: 10000;
            }
            .autocomplete-suggestions{
                z-index: 10001 !important;
            }
            .btn-app {
                border-radius: 3px !important; 
                padding: 15px 5px !important; 
                height: auto !important; 
            }
            .chosen-container{
                min-width: 300px !important; 
                max-width: 300px !important;
            }
            .he{
                height: 20px !important;
                min-height: 20px !important;
            }
            .ach{
                margin-left: 4px;
            }
            ul#achHis li {
                display: inline-block;
            } 
            .content {
                padding-top:0px !important;
            }
            input {
                text-transform:capitalize;
            }
            <?php if ($this->language == 'ac') { ?>
                th,tr{
                    text-align: right !important;   
                }
            <?php } ?>
        </style>
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url(); ?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url(); ?>assets/lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url(); ?>assets/lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url(); ?>assets/lte/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>assets/lte/dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
<!--        <script src="<?php echo base_url(); ?>assets/lte/dist/js/demo.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/js/popupwindow.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.tablenav.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>
        <script type="text/javascript">

            function script(url) {
                $.ajax({
                    url: url,
                    dataType: 'script',
                    cache: true, // or get new, fresh copy on every page load
                    success: function () {
                        // Callback
                    }
                });
            }
            var last_click = '';
            var company = '<?php echo $company['name']; ?>';
            var ismodel = false;
            var insert_primary_key = 0;
            var popup_type = '';
            var lastUrls = [];
            var base_url_triger = "<?php echo base_url(); ?>";
            var w;
            function startWorker()
            {
                if (typeof (Worker) !== "undefined") {
                    if (typeof (w) == "undefined") {
                        w = new Worker('<?php echo base_url(); ?>assets/js/task.js');
                        w.postMessage('<?php echo base_url() ?>')
                    }
                    w.onmessage = function (event) {
                        console.log(event.data);
                        if (event.data !== '1') {
                            window.location = '<?php echo base_url() ?>';
                        }
                    };
                } else {
                    console.log('Sorry, your browser does not support Web Workers...');
                }
            }

            function stopWorker()
            {
                w.terminate();
                w = undefined;
            }
            var lan = {};
        </script>  
        <script type="text/javascript" src="<?php echo base_url(); ?>asset/datatables/datatables.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>asset/datatables/dataTables.bootstrap.js" ></script>
        <script src="<?php echo base_url(); ?>asset/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>asset/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>asset/plugins/jQueryUI/jquery-ui.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/commonfunctions.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/jqueryfunctions.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>asset/val/jquery.form-validator.min.js"></script> 
        <link href="<?php echo base_url(); ?>asset/plugins/jQueryUI/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>assets/js/jquery.auto-complete.js"></script>  
        <script type="text/javascript" >
            script("<?php echo base_url(); ?>assets/js/main.js");
            script("<?php echo base_url(); ?>assets/js/popper.min.js");
        </script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->  

    </head>  
    <!--     oncontextmenu="return false;"skin-blue-->
    <body class="hold-transition skin-yellow sidebar-mini">
        <input type="hidden" id="exdt31_uvaf32" value="<?= $dbcompany['end_date'] ?>" />
        <input type="hidden" id="txtsls" value="<?= $this->language ?>"/>
        <input type="hidden"  id="exdt31_delf32" value="<?= label('Do you want to delete', $this, $user) ?>"/>
        <!-- Site wrapper -->
        <div class="wrapper" id="wrappermsts">
            <a href="#" id="last_click" >  </a>
            <header class="main-header">
                <!-- Logo -->
                <a tp="self" id="Alt_d" href="<?php echo $dash ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>F</b>P</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><?php echo $company['name']; ?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a> 
                    <div class="kdhp-cap col-md-5 hidden-sm hidden-xs"> 
                        <div class="col-md-2 hidden-sm hidden-xs no-padding">
                            <select id="sel_home_search" class="form-control">
                                <option value="Sales"><?= label('Sales', $this, $user) ?></option>
                                <option value="Purchase"><?= label('Purchase', $this, $user) ?></option>
                                <option value="Customers"><?= label('Customers', $this, $user) ?></option>
                                <option value="Suppliers"><?= label('Suppliers', $this, $user) ?></option>
                                <option value="Items"><?= label('Item', $this, $user) ?></option>
                                <option value="Sales_Order"><?= label('Sales Order', $this, $user) ?></option>
                                <option value="Sales_Return"><?= label('Sales Return', $this, $user) ?></option>
                                <option value="Purchase_Order"><?= label('Purchase Order', $this, $user) ?></option>
                                <option value="Purchase_Return"><?= label('Purchase Return', $this, $user) ?></option>
                            </select>
                        </div>
                        <div class="col-md-6 no-padding">
                            <div class="input-group"> 
                                <input type="text" id="txt_home_search" class="form-control">
                                <span class="input-group-btn">
                                    <button type="button" id="btn_home_search" class="btn btn-info btn-flat">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-custom-menu"> 
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav"> 
                                <li class=" notifications-menu  hidden-sm hidden-xs"><a id="back_all"><i class="fa  fa-backward"></i></a></li>
<!--                            <li class=" notifications-menu"><a onclick="openFullscreen();"  ><i class="fa  fa-arrows-alt"></i></a></li>-->
                                <li class="dropdown notifications-menu  hidden-sm hidden-xs">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-history"></i>
                                        <span class="label label-warning" id="myhistorylen"></span>
                                    </a>
                                    <ul class="dropdown-menu " >
                                        <li class="header">Quick Menu</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu" id="myhistory" >

                                            </ul>
                                        </li>
                                        <!--                                        <li class="footer"><a href="#">View all</a></li>-->
                                    </ul>
                                </li>
                                <li class="dropdown notifications-menu  hidden-sm hidden-xs">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="glyphicon glyphicon-transfer"></i> 
                                    </a>
                                    <ul class="dropdown-menu ">
                                        <li class="header">Change Financial Year </li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu"  id="finacialyear" >
                                                <?php foreach ($fin_database as $btype) { ?>
                                                    <li><a href="<?php echo base_url(); ?>Billformat/switchdatabase/<?php echo $btype['sdb_Id'] ?>"><i class="fa fa-bookmark text-aqua"></i><?php echo $btype['year_id']; ?></a></li>
                                                <?php } ?>


                                            </ul>
                                        </li>

                                    </ul>
                                </li> 
                                <li class="dropdown user user-menu ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo base_url(); ?>asset/dist/img/avatar.png" class="user-image" alt="User Image">
                                        <span class="hidden-xs"><?php echo $user['user_name']; ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="<?php echo base_url(); ?>asset/dist/img/avatar.png" class="img-circle" alt="User Image">

                                            <p>
                                                <?php echo $user['user_name']; ?>
                                                <small> <?php echo $user['utype']; ?></small> 
                                            </p>
                                        </li> 
                                        <li class="user-body">
                                            <div class="row">
                                                <div class="col-xs-3 text-center">
                                                    <a href="#">Language </a>
                                                </div>
                                                <div class="col-xs-9 text-center">
                                                    <div class="col-xs-7 no-padding">
                                                        English <input type="radio" name="rdolan" <?php if ($this->language != 'ac') { ?> checked="checked" <?php } ?>value="en" class="lanch"/>
                                                    </div>  
                                                    <div  class="col-xs-5 no-padding">
                                                        Arabic <input type="radio"  name="rdolan" <?php if ($this->language == 'ac') { ?> checked="checked" <?php } ?> value="ac" class="lanch" /> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </li>
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo base_url(); ?>settings/loginsett/change_password" class="btn btn-default btn-flat">Change Password</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo base_url(); ?>settings/loginsett/logout" id="Ctrl_l" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>

                </nav>
            </header>


            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar"> 

                    <div class="input-group">
                        <input type="text" name="q" class="form-control" id="searchmenu" placeholder="<?= label('Search Menu', $this, $user) ?>...">
                        <span class="input-group-btn">
                            <button type="submit" name="search"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>

                    <ul class="sidebar-menu" data-widget="tree"> 
                        <?php

                        function test_odd($var) {
                            if ($var['parent'] == 0) {
                                return($var);
                            }
                        }

                        $allmenus = $this->load->get_var('menus');
                        $menus = array_filter($allmenus, "test_odd");
                        foreach ($menus as $menu) {
                            $NUM = $menu['id'];
                            $submenu = array_filter($allmenus, function($elem) use($NUM) {
                                if ($elem['parent'] == $NUM) {
                                    return $elem;
                                }
                            });
                            $cnt = count($submenu);
                            $icon = "fa " . $menu['icon'];
                            ?>
                            <li class="treeview">
                                <a   <?php if ($cnt != 0) { ?>  href="#" <?php } else { ?>href="<?php echo base_url() . $menu['Url']; ?>"  <?php } ?> >
                                    <i class="<?= $icon ?>"></i> <span>
                                        <?= label($menu['ListName'], $this, $user) ?>
                                        <?php ///echo  $menu['ListName']; ?>

                                    </span>
                                    <?php if ($cnt != 0) { ?>                                    
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    <?php } ?>
                                    <ul class="treeview-menu">
                                        <?php
                                        foreach ($submenu as $smenu) {
                                            $id = '';
                                            if ($smenu['menu_key'] != '') {
                                                $id = "id ='" . str_replace("+", "_", $smenu['menu_key']) . "'";
                                            }
                                            ?>
                                            <li><a href="<?php echo base_url() . $smenu['Url']; ?>" <?php echo $id; ?>  ><i class="fa fa-circle-o"></i> 
                                                    <?= label(trim($smenu['ListName']), $this, $user) ?>
                                                    <?php //echo $smenu['ListName']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                    </span>
                                </a>
                            </li>
                        <?php } ?> 
                    </ul>
                </section> 
            </aside> 
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" id="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <div id="loading-img"></div>
            <style>
                .his > .sch {
                    overflow-x: auto;
                    white-space: nowrap;
                }
                .his > .sch > .li {
                    display: inline-block;
                    float: none;
                }
            </style>

            <div class="content-wrapper he"> 
                <div class="box"> 
                    <div class="row his" style="margin-left: 0px;    margin-right: 0px;">
                        <ul class="box-body sch no-padding no-margin hidden-xs col-sm-10" id="achHis"> 
                        </ul>
                        <ul  class="box-body no-padding list-inline no-margin pull-right col-sm-2 " >
                            <li class="pull-right"> <a href="#" id="chat-open" class="btn btn-primary"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i></a></li>
                            <li class="pull-right"> <a href="#" id="clnhis" class="btn btn-primary"><i class="glyphicon glyphicon-erase" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="content-wrapper myhide cont" id="div1">  
