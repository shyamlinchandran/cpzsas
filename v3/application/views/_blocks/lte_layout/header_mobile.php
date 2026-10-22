<!DOCTYPE html>
<html lang="en">

<head>
  <title>CPZSAS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="<?php echo base_url(); ?>assets/css/mobile/common.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/AdminLTE.min.css">
  <link href="<?php echo base_url(); ?>assets/css/jquery.auto-complete-mobile.css" rel="stylesheet" type="text/css" />

  <script src="<?php echo base_url(); ?>asset/plugins/jQueryUI/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/commonfunctions.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jqueryfunctions.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>asset/val/jquery.form-validator.min.js"></script>
    <link href="<?php echo base_url(); ?>asset/plugins/jQueryUI/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/js/jquery.auto-complete.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 

  <style>
    .modal-open {
      padding-right: 0px !important;
    }
    body{
      font-size: 10px !important;
    }
    input, select{
      font-size: 12px !important;
    }
   button{
      font-size: 12px !important;
    }

    .ui-autocomplete {
            max-height: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
  </style>
</head>


<body>
<div class="modal fade" id="myModal_Supplier">
    <form method="post" id="frmSuppliermodal" action="<?php echo site_url('Modalcontroller/save_supplier'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 id="modal_title_Supplier" class="modal-title"></h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div> 
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label">
                                  Name
                                </label>
                                <input type="hidden" value ="cus"  name="modal_supplierType" id="modal_supplierType" class="form-control" />
                                <input autofocus data-validation="required" maxlength="250" type="text" id="modal_supplierName" name="modal_supplierName" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Phone', $this, $user) ?>
                                </label>
                                <input maxlength="250" type="text" id="modal_supplierPhone" name="modal_supplierPhone" class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('GSTIN', $this, $user) ?>
                                </label>
                                <input maxlength="16" type="text" id="modal_supplierGST" name="modal_supplierGST" class="form-control" />

                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Email', $this, $user) ?>
                                </label>
                                <input type="text" id="modal_supplierEmail" name="modal_supplierEmail" class="form-control" />

                            </div>


                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Price List', $this, $user) ?>
                                </label>
                                <select id="modal_pricelist" name="modal_pricelist" class="form-control" >

								                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Customer Rate', $this, $user) ?>
                                </label>
                                <select id="modal_cusrate" name="modal_cusrate" class="form-control" >
                                       <option value="">Select</option>
                                       <option value="srate">Srate</option>
                                       <option value="MRP">MRP</option>
                                       <option value="wh_rate">Wholesale Rate</option>
                                       <option value="special_rate">Special Rate</option>
                              </select>
                            </div>


							
							<div class="col-md-6">
                                <label class="control-label">
                                    <?= label('State', $this, $user) ?>
                                </label>
                                <select id="modal_supplierstate" name="modal_supplierstate" class="form-control" >
								</select>
                            </div>
							
							
							<div class="col-md-6" id = "mainArea" >
                                <label class="control-label">
                                    <?= label('Area', $this, $user) ?>
                                </label>
                                <input type ="hidden"  id="modal_supplierArea" name="modal_supplierArea" class="form-control" >
                                <input type ="text"  id="modal_supplierArea_text" name="modal_supplierArea_text" class="form-control" >
                            </div>
							<div class="col-md-6">
                                <label class="control-label">
                                    <?= label('route', $this, $user) ?>
                                </label>
                                <select id="modal_supplierroute" name="modal_supplierroute" class="form-control" >
								</select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?= label('Addres', $this, $user) ?>
                                <textarea id="modal_supplierAdd1" name="modal_supplierAdd1" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <?= label('Addresline 2', $this, $user) ?>
                                <textarea id="modal_supplierAdd2" name="modal_supplierAdd2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button data-toggle="tooltip" type="button" hddid="" title="Add To save" id="btnsaveSupplierModal" class="btn btn-success" href="#">
                        Save
                    </button>
                    <button type="button" id="btncls" class="btn btn-secondary btncls" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
  <nav class="navbar bg-light fixed-top navbar-light bg-light  shadow">
    <ul class="nav">
      <li class="nav-item active">
        <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar"> <i class="material-icons">menu</i></a>
      </li>
      <li class="nav-item">
        <a style = "font-size:14px;" class="nav-link" href="#"><?php echo $title;?> </a>
      </li>
      
    </ul>
    <ul class="nav">
     
      <li class="nav-item">
        <a style = "font-size:14px;" class="nav-link" href="<?php echo base_url(); ?>settings/loginsett/logout">Logout </a>
      </li>
      
    </ul>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">  <img src="<?php echo base_url(); ?>asset/login/images/ozoneERP-logo.png" alt="" /></h5>
        <button  type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a style  = "font-size:12px; class="nav-link active" aria-current="page" href="<?php echo base_url();?>mobile/main/sales">New Order</a>
          </li>
          <li class="nav-item">
            <a style  = "font-size:12px;" class="nav-link" href="<?php echo base_url();?>mobile/main/orderlist">Order  List</a>
          </li>
          <li class="nav-item">
                  <a style  = "font-size:12px;" class="nav-link " aria-current="page" href="<?php echo base_url();?>mobile/main/receipt"><i class="fa fa-cc-paypal "></i>&nbsp;New Receipt</a>
                </li>
                <li class="nav-item">
                  <a style  = "font-size:12px;" class="nav-link" href="<?php echo base_url();?>mobile/main/voucherlist"><i class="fa fa-list-alt"></i>&nbsp;Receipt  List</a>
                </li> 
                
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <script>
     function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    </script>