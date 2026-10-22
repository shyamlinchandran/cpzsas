<?php
$logged_company_settings = $this->session->userdata('company_settings');
$logged_company_type = $logged_company_settings[0]['com_tax_type'];
$user = $this->session->userdata('user');
$dash = $this->session->userdata('dash');
$fin_database = $this->session->userdata('fin_database');
if (isset($_COOKIE['language'])) {
    $language = $_COOKIE['language'];
} else {
    $language = 'en';
}
$dbcompany = $this->session->userdata('dbcompany');
$product_name = $this->config->item('product_name');
$color = $this->config->item($product_name . '_color');
$allmenus = $this->load->get_var('menus');
$login_url = $this->session->userdata('login_url');
$menus = array_filter($allmenus, "test_odd");
?>
<!DOCTYPE html>
<html>
<style>
	.wrapper {
		height: 100%;
		position: relative;
		overflow-x: hidden !important;
		overflow-y: hidden !important;
	}
	.table>thead>tr>th {
		border: 1px solid;
		border-color: #ddd;
		font-weight: bolder !important;
		font-size: 15px;
		color: #FFF;
		background-color: #0271b9;
	}
</style>
<head>
    <?php $company = $this->load->get_var('company'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php echo $this->config->item($product_name . '_product_name'); ?> | <?php echo $company['name']; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bower_components/font-awesome/css/font-awesome.min.css">

    <!--  <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
		  <link href="<?php echo base_url(); ?>assets/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />-->
    <link href="<?php echo base_url(); ?>assets/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <!--calendar-->
    <link href="<?php echo base_url(); ?>assets/css/print.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/print.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <?php if ($language == 'ac') { ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/skins/_all-skinsr.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/AdminLTEr.css">
        <link href="<?php echo base_url(); ?>assets/css/jquery.auto-completer.css" rel="stylesheet" type="text/css" />

    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/AdminLTE.min.css">
        <link href="<?php echo base_url(); ?>assets/css/jquery.auto-complete.css" rel="stylesheet" type="text/css" />
        <style>
            .form-input-box {
                float: left;
            }

            .dataTables_filter {
                float: right;
            }

            .foot .dataTables_length {
                padding-top: 30px;
            }

            .dataTables_info {
                padding-top: 30px;
            }

            .table {
                margin-bottom: 0px !important;
            }

            .skin-purple .main-header li.user-header {
                background-color: #048f89 !important;
            }

            .cbtn {
                padding: 10px !important;
                height: 30px !important;
                padding-top: 1px !important;
                border-radius: 3px;
                -webkit-box-shadow: none;
                box-shadow: none;
                color: #fff;
                border: 1px solid transparent;
                background-color: #367fa9;
            }
        </style>
    <?php } ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popupwindow.css" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/common.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/chat.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href=" <?php echo base_url(); ?>assets/css/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />


    <link href="<?php echo base_url(); ?>assets/averta/averta.css" rel="stylesheet" type="text/css" />

    <style>
        .breadcrumbs li {
            display: inline-block;
            background-image: linear-gradient(#08d, #06c);
            line-height: 25px;
            color: #fff;
            padding: 0 30px 0 20px;
            position: relative;
        }

        .breadcrumbs li a {
            color: #fff;
        }

        .breadcrumbs {
            font-size: 12px;
            margin: 0;
            padding: 0;
            /*                    border: 1px solid #c2c2c2;
                                        border-radius: 4px;
                                        background-color: #d5d5d5;
                                        box-shadow: 0 0 10px #bbb inset;*/

        }

        .breadcrumbs li:before {
            content: "";
            position: absolute;
            top: 5px;
            left: -11px;
            display: block;
            height: 11px;
            width: 11px;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            transform: rotate(45deg);
            background-image: linear-gradient(140deg, #08d, #06c);
            z-index: 0;
            box-shadow: -1px 1px 0 rgba(0, 0, 0, 0.3);
        }



        .breadcrumbs li:first-child {
            border-radius: 4px 0 0 4px;
        }

        ;

        .breadcrumbs li:last-child {
            padding-right: 10px;
        }

        .breadcrumbs li:first-child:before {
            content: none;
        }

        /* 
        .breadcrumbs li:last-child,
        &:last-child:before {
            background-image: linear-gradient(140deg, #f5f5f5, #f0f0f0);
            color: #333;
        }

        ; */

        th,
        label {
            font-weight: 400 !important;
        }

        .hunpx {
            width: 100px !important;
            height: 30px !important;
        }

        .btn {
            padding: 10px !important;
            height: 30px !important;
            padding-top: 5px !important;
        }

        .dataTable .btn {
            /* padding: 10px !important;
            height: 30px !important;
            padding-top: 5px !important; */
            padding: 4px !important;
            background-color: transparent !important;
            border: none !important;
        }

        .dataTable .btn-primary {
            color: #3c8dbc !important;
        }

        .dataTable .btn-warning {
            color: #f39c12 !important;
        }

        .dataTable .btn-info {
            color: #00c0ef !important;
        }

        .dataTable .btn-success {
            color: #00a65a !important;

        }

        .dataTable .btn-danger {
            color: #dd4b39 !important;
        }

        /* .bg-navy {
            color: #001f3f !important;
            font-weight: bolder;
            font-size: 18px !important;
            padding: 0px !important;
            margin: 0px !important;
        } */

        /* .bg-olive {
            color: #3d9970 !important;
            font-weight: bolder;
            font-size: 18px !important;
            padding: 0px !important;
            margin: 0px !important;
        } */

        .dataTable .btn[class*='bg-']:hover {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }

        .fullscreen {
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

        .dataTable {
            margin-bottom: 0px !important;
            border: 2px solid;
            border-radius: 9px !important;
            border-color: #eeeeee;
            border-collapse: separate !important;
        }

        .box {
            border-radius: 5px;
        }

        .table>thead>tr>th {
            border: 1px solid;
            border-color: #ddd;
        }

        .table>tbody>tr>td {
            padding: 6px !important;
            border: 1px solid;
            border-color: #ddd;
        }

        .box-header {
            border-bottom: 2px solid #bbb;
        }

        input[type=text],
        select,
        .form-control,
        input[disabled] {
            height: 30px !important;
            padding: 3px !important;
        }

        input:read-only {
            height: 30px !important;
            padding: 3px !important;
        }

        textarea {
            height: 55px !important;
        }

        .ui-autocomplete {
            max-height: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .myhide {
            padding-top: 13px !important;
        }

        #loading-img {
            display: none;
        }

        .highcharts-credits {
            display: none;
        }

        .loading-imgs {
            background: url("<?php echo base_url() . "/assets/images/ajax-loading.gif" ?>") center 30vh no-repeat;

            height: 90vh;
            margin-top: 15px;
            /* width: 100%; */
            /* position: absolute; */
            background-color: #fff;
            border: 3px solid #ccc;
            border-radius: 10px;
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
        }

        body {
            background-color: #0271b9;
            height: auto;
            background-position: center top;
        }

        .skin-purple .wrapper,
        .skin-purple .main-sidebar,
        .skin-purple .left-side {
            background-color: transparent !important;
        }

        .content-wrapper {
            background-color: transparent !important;
        }

        .navbar {
            background-color: transparent !important;
        }

        .popupwindow_container {
            z-index: 10000;
        }

        .autocomplete-suggestions {
            z-index: 10001 !important;
        }

        .btn-app {
            border-radius: 3px !important;
            padding: 15px 5px !important;
            height: auto !important;
        }

        .chosen-container {
            min-width: 300px !important;
            max-width: 300px !important;
        }

        .he {
            height: 30px !important;
            min-height: 30px !important;
        }

        .ach {
            margin-left: 4px;
        }

        .content {
            padding-top: 0px !important;
        }

        .menunew {
            padding: 6px !important;
        }

        .box {
            box-shadow: 10px 14px 14px -15px rgba(0, 0, 0, 0.75) !important;
        }

        .nav-tabs-custom {
            box-shadow: 10px 14px 14px -15px rgba(0, 0, 0, 0.75) !important;
        }

        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #000;
        }

        .box.box-primary {
            border-top-color: #000;
        }


        .skin-purple .sidebar-menu>li:hover>a,
        .skin-purple .sidebar-menu>li.active>a,
        .skin-purple .sidebar-menu>li.menu-open>a {
            color: #fff;
            background: #221a64;
        }

        .skin-purple .sidebar-menu>li>.treeview-menu {
            margin: 0 1px;
            background: #100b32;
        }


        .skin-purple .main-header .logo {
            background-color: transparent !important;
        }

        .skin-purple .main-header .navbar .sidebar-toggle:hover {
            background-color: transparent !important;
        }

        .main-header .navbar {
            border-bottom: 1px solid #ccc;
        }

        .form-control {

            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }


        table>tbody>tr:hover {
            background-color: #100b32 !important;
            color: #fff;
        }

        input[type=checkbox],
        input[type=radio] {
            height: 14px !important;
        }

        .bg-orange {
            background-color: #ff851b !important;
            padding: 10px !important;
        }

        .border {
            border-bottom: 2px solid #ccc;
            margin-right: -10px !important;
            margin-left: -10px !important;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }

        <?php if ($this->language == 'ac') { ?>th,
        tr {
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
    <script src="<?php echo base_url(); ?>assets/js/print.min.js"></script>
    <script type="text/javascript">
        function script(url) {
            $.ajax({
                url: url,
                dataType: 'script',
                cache: true, // or get new, fresh copy on every page load
                success: function(data) {
                    // Callback
                }
            });
        }
        var allmenus = <?php echo json_encode($allmenus); ?>;

        function getmenus(id) {
            var newArray = allmenus.filter(function(el) {
                return el.parent === id.toString();
            });
            return newArray;
        }

        function getsubmenuall(id, txt) {
            $("#mnname").text(txt);
            var mns = getmenus(id);
            var anch = '';
            for (i = 0; i < mns.length; i++) {
                var submnu = getmenus(mns[i].id);
                var icon = "fa fa-circle-o";
                if (mns[i].icon.toString() !== "") {
                    icon = "fa " + mns[i].icon.toString();
                }
                console.log(icon);
                var sm = '';
                if (submnu.length > 0) {
                    anch = anch + '<li class="treeview" ><a href="#"><i class="' + icon + '"></i> ' + mns[i].ListName +
                        '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> ' +
                        '<span class="label label-primary pull-right" style="margin-right: 30px;">' + submnu.length + '</span> </a> ';
                    anch = anch + '<ul class="treeview-menu">';

                    for (j = 0; j < submnu.length; j++) {
                        anch = anch + '<li ' + sm + ' ><a class="menunew" href="<?php echo base_url() ?>' + submnu[j].Url + '"><i class="fa fa-circle-o"></i> ' + submnu[j].ListName + '</a></li>';
                    }

                    anch = anch + '</ul>';
                    anch = anch + '</li>';
                } else {
                    anch = anch + '<li ' + sm + '><a  class="menunew" href="<?php echo base_url() ?>' + mns[i].Url + '"><i class="fa fa-circle-o"></i> ' + mns[i].ListName + '</a></li>';

                }
            }
            $("#tree").html(anch);
        }

        /*
         <li >
         <a href="#">
         <i class="fa fa-files-o"></i>
         <span>Layout Options</span>
         <span class="pull-right-container">
         <span class="label label-primary pull-right">4</span>
         </span>
         </a>
         <ul class="treeview-menu">
         <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
         <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
         <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
         <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
         </ul>
         </li>
         
         */
        var last_click = '';
        var company = '<?php echo $company['name']; ?>';
        var ismodel = false;
        var insert_primary_key = 0;
        var popup_type = '';
        var lastUrls = [];
        var base_url_triger = "<?php echo base_url(); ?>";
        var w;

        function startWorker() {
            if (typeof(Worker) !== "undefined") {
                if (typeof(w) == "undefined") {
                    w = new Worker('<?php echo base_url(); ?>assets/js/task.js');
                    w.postMessage('<?php echo base_url() ?>')
                }
                w.onmessage = function(event) {
                    if (parseInt(event.data) !== 1) {
                        window.location = '<?php echo $login_url ?>';

                    }
                };
            } else {
                console.log('Sorry, your browser does not support Web Workers...');
            }
        }

        function stopWorker() {
            w.terminate();
            w = undefined;
        }
        var lan = {};
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/datatables/dataTables.bootstrap.js"></script>

    <script src="<?php echo base_url(); ?>asset/plugins/datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>asset/plugins/datetimepicker/locales/bootstrap-datetimepicker.fr.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>asset/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>asset/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <link href="<?php echo base_url(); ?>asset/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>asset/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url(); ?>asset/plugins/datetime/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>asset/plugins/datetime/daterangepicker.js" type="text/javascript"></script>
    <link href="<?php echo base_url(); ?>asset/plugins/datetime/daterangepicker.css" rel="stylesheet">


    <script src="<?php echo base_url(); ?>asset/plugins/jQueryUI/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/commonfunctions.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jqueryfunctions.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>asset/val/jquery.form-validator.min.js"></script>
    <link href="<?php echo base_url(); ?>asset/plugins/jQueryUI/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/js/jquery.auto-complete.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript">
        script("<?php echo base_url(); ?>assets/js/main.js?v=003");
        script("<?php echo base_url(); ?>assets/js/popper.min.js?v=001");
    </script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    <!-- <script src="https://cdn.tiny.cloud/1/6n69pjv8mp7txwkk97lq0k6981zkm7ipvo8op7353l2l1sqg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

</head>
<!--     oncontextmenu="return false;"skin-blue-->


<?php //$this->load->view('_blocks/modals/supplier'); ?>
<?php //$this->load->view('_blocks/modals/item'); ?>
<?php //$this->load->view('_blocks/modals/modal'); ?>
<?php //$this->load->view('_blocks/modals/dailygoldrate'); ?>


<body class="hold-transition skin-purple  sidebar-mini">
    <input type="hidden" id="exdt31_uvaf32" value="<?= $dbcompany['end_date'] ?>" />
    <input type="hidden" id="exdt31_com32" value="<?= $company['name'] ?>" />
    <input type="hidden" id="txtsls" value="<?= $this->language ?>" />
    <input type="hidden" id="exdt31_delf32" value="<?= label('Do you want to delete', $this, $user) ?>" />
    <!-- Site wrapper -->
    <div class="wrapper" id="wrappermsts">
        <a href="#" id="last_click"> </a>
        <header class="main-header">
            <!-- Logo -->
            <a tp="self" id="Alt_d" href="<?php echo $dash ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><?php echo $this->config->item($product_name . '_product_code'); ?></b></span>
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
                <div class="navbar-collapse pull-left collapse" id="navbar-collapse" aria-expanded="false" style="height: 1px;">

                </div>
                <div class="kdhp-cap col-md-5 hidden-sm hidden-xs">
                    <!--<a href="#" onclick="window.open('<?php echo base_url(); ?>dashboard/calculator', 'targetWindow',
                                           `toolbar=no,
                                    location=no,
                                    status=no,
                                    menubar=no,
                                    scrollbars=yes,
                                    resizable=yes,
                                    width=450,
                                    height=550`);
                                   return false;">Calculator</a>-->
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
                            <li class=" notifications-menu  hidden-sm hidden-xs"> <a href="#" id="clnhis"><i class="glyphicon glyphicon-erase" aria-hidden="true"></i></a></li>
                            <li class=" notifications-menu  hidden-sm hidden-xs"><a id="back_all"><i class="fa  fa-backward"></i></a></li>
                            <!--                            <li class=" notifications-menu"><a onclick="openFullscreen();"  ><i class="fa  fa-arrows-alt"></i></a></li>-->
                            <li class="dropdown notifications-menu  hidden-sm hidden-xs">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-history"></i>
                                    <span class="label label-warning" id="myhistorylen"></span>
                                </a>
                                <ul class="dropdown-menu ">
                                    <li class="header">Quick Menu</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu" id="myhistory">

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
                                        <ul class="menu" id="finacialyear">
                                            <?php foreach ($fin_database as $btype) { ?>
                                                <li><a onclick="switchdatabase(<?php echo $btype['sdb_Id'] ?>)" href="#"><i class="fa fa-bookmark text-aqua"></i><?php echo $btype['year_id']; ?></a></li>
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
                                    <?php if ($this->multiple == 1) { ?>
                                        <li class="user-body">
                                            <div class="row">
                                                <div class="col-xs-3 text-center">
                                                    <a href="#">Language </a>
                                                </div>
                                                <div class="col-xs-9 text-center">
                                                    <div class="col-xs-7 no-padding">
                                                        English <input type="radio" name="rdolan" <?php if ($this->language != 'ac') { ?> checked="checked" <?php } ?>value="en" class="lanch" />
                                                    </div>
                                                    <div class="col-xs-5 no-padding">
                                                        Arabic <input type="radio" name="rdolan" <?php if ($this->language == 'ac') { ?> checked="checked" <?php } ?> value="ac" class="lanch" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
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
                </div>
            </nav>
        </header>


        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar" style="background: #100b32 !important">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <div class="input-group">
                    <input type="text" name="q" class="form-control" id="searchmenu" placeholder="<?= label('Search Menu', $this, $user) ?>...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>

                <ul class="sidebar-menu" style="background-color:#000044" data-widget="tree" id="tree">
                    <?php

                    function test_odd($var)
                    {
                        if ($var['parent'] == 0) {
                            return ($var);
                        }
                    }

                    foreach ($menus as $menu) {
                        $NUM = $menu['id'];
                        $submenu = array_filter($allmenus, function ($elem) use ($NUM) {
                            if ($elem['parent'] == $NUM) {
                                return $elem;
                            }
                        });
                        $cnt = count($submenu);
                        $icon = "fa " . $menu['icon'];
                    ?>
                        <li class="treeview">
                            <a <?php if ($cnt != 0) { ?> href="#" <?php } else { ?>href="<?php echo base_url() . $menu['Url']; ?>" <?php } ?>>
                                <i class="<?= $icon ?>"></i> <span>
                                    <?php $listname = $menu['ListName'];
                                    if ($logged_company_type == 'VAT') {
                                        $listname = str_replace("GSTR 1", "Sales Tax Report", $listname);
                                        $listname = str_replace("GSTR 2 Report", "Purchase Tax Report", $listname);
                                        $listname = str_replace("GST ", "VAT ", $listname);
                                    }
                                    ?>
                                    <?= label($listname, $this, $user) ?>
                                    <?php ///echo  $menu['ListName'];    
                                    ?>

                                </span>
                                <?php if ($cnt != 0) { ?>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                    <!--                                        <span class="label label-primary pull-right" style="margin-right: 30px;"><?= $cnt ?></span>-->
                                <?php } ?>
                                <ul class="treeview-menu">
                                    <?php
                                    foreach ($submenu as $smenu) {
                                        $id = '';
                                        if ($smenu['menu_key'] != '') {
                                            $id = "id ='" . str_replace("+", "_", $smenu['menu_key']) . "'";
                                        }

                                        $NUM = $smenu['id'];

                                        $submenu2 = array_filter($allmenus, function ($elem) use ($NUM) {
                                            if ($elem['parent'] == $NUM) {
                                                return $elem;
                                            }
                                        });
                                        $cnt2 = count($submenu2);
                                        $icon1 = 'fa fa-circle-o';
                                        if ($smenu['icon'] != '') {
                                            $icon1 = "fa " . $smenu['icon'];
                                        }
                                    ?>
                                        <li <?php if ($cnt2 != 0) { ?> class="treeview" <?php } ?>>
                                            <!-- href="<?php echo base_url() . $smenu['Url']; ?>" <?php echo $id; ?>-->
                                            <a <?php if ($cnt2 != 0) { ?> href="#" <?php } else { ?>href="<?php echo base_url() . $smenu['Url']; ?>?newpage=new" <?php } ?> <?php echo $id; ?>>
                                                <i class="<?= $icon1 ?>"></i>
                                                <?php $listname = $smenu['ListName'];
                                                if ($logged_company_type == 'VAT') {
                                                    $listname = str_replace("GSTR 1", "Sales Tax Report", $listname);
                                                    $listname = str_replace("GSTR 2 Report", "Purchase Tax Report", $listname);
                                                    $listname = str_replace("GST ", "VAT ", $listname);
                                                }
                                                ?>
                                                <?= label(trim($listname), $this, $user) ?>
                                                <?php //echo $smenu['ListName'];  
                                                ?>
                                                <?php if ($cnt2 != 0) { ?>
                                                    <span class="pull-right-container">
                                                        <i class="fa fa-angle-left pull-right"></i>
                                                    </span>
                                                    <span class="label label-primary pull-right" style="margin-right: 30px;"><?= $cnt2 ?></span>
                                                <?php } ?>

                                            </a>
                                            <?php if ($cnt2 != 0) { ?>
                                                <ul class="treeview-menu">
                                                    <?php
                                                    foreach ($submenu2 as $smenu2) {
                                                        $listname = $smenu2['ListName'];
                                                        if ($logged_company_type == 'VAT') {
                                                            $listname = str_replace("GSTR 1", "Sales Tax Report", $listname);
                                                            $listname = str_replace("GSTR 2 Report", "Purchase Tax Report", $listname);
                                                            $listname = str_replace("GST ", "VAT ", $listname);
                                                        }
                                                    ?>

                                                        <li><a href="<?php echo base_url() . $smenu2['Url']; ?>?newpage=new" <?php echo $id; ?>><i class="fa fa-circle-o"></i>
                                                                <?= label(trim($listname), $this, $user) ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>

                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </section>
        </aside>
        <div id="myModal_message" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" id="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title_message">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="company_message_comkey" id="company_message_comkey" value="0" />
                        <input type="hidden" name="company_message_comid" id="company_message_comid" value="0" />
                        <textarea style="width:100%" name="company_message" id="company_message">Some text in the modal.</textarea><br />
                        <input type="number" name="company_message_time" id="company_message_time" class="form-control" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="update_company_message()" class="btn btn-default" data-dismiss="modal">Change Message</button>
                    </div>
                </div>

            </div>
        </div>
        <?php $this->load->view('_blocks/modals/mymodal'); ?>
        <!-- <div class="content-wrapper he no-print" style="background: #fff;height: 30px">
            <div class="row his" style="margin-left: 0px;    margin-right: 0px; border-bottom: 1px solid #ccc;">
                <ul class="breadcrumbs  col-sm-11" id="achHis">
                </ul>
                <ul class="box-body no-padding list-inline no-margin pull-right col-sm-1 ">
                    <!--                            <li class="pull-right"> <a href="#" id="chat-open" class="btn btn-primary"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i></a></li>   
                    <li class="pull-right"> <a href="#" id="clnhis" class="btn btn-primary"><i class="glyphicon glyphicon-erase" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div> -->
        <div class="content-wrapper" id="loading-img">
            <section class="content">
                <div class="loading-imgs"></div>
            </section>
        </div>
        <div class="content-wrapper myhide cont" id="div1">