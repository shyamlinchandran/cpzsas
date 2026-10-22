<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>asset/login/images/fav-icon.png" type="image/png"/>

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/login/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/login/css/fontawesome-all.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/login/css/ozoneERP.css"/>

        <title>Ozone ERP</title>
    </head>
    <body>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="d-flex login-card-wrapper">
                        <div class="w-100 login-card">
                            <div class="d-flex login-card-left">
                                <div class="login-card-header">
                                    <h5>Welcome to</h5>
                                    <img src="<?php echo base_url(); ?>asset/login/images/ozoneERP-logo.png" alt="" />
                                    <p>Log into get in the moment updates on the things that interest you.</p>
                                </div>
                                <div class="login-card-form">
                                    <form action="<?php echo base_url(); ?>login/loginset" method="post" >
                                        <div class="form-group company-id-form-group">
                                            <input type="text"  data-validation="required" class="form-control" name="comid" placeholder="Company ID">
                                        </div>
                                        <div class="form-group user-name-form-group">
                                            <input type="text"  data-validation="required" class="form-control"name="uname" placeholder="User Name">
                                        </div>
                                        <div class="form-group password-form-group">
                                            <input type="password" data-validation="required" name="pswd" class="form-control" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Sign In</button>
                                        <p style="color:red">
                                            <?php  print_r($error); ?>
                                        </p>
                                    </form>
                                </div>
                                <div class="login-card-footer">
                                    <p>
                                        Copyright 2019©All rights reserved <a target="_blank"  href="http://bjsolutions.in/">bjsolutions</a>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex login-card-right">
                                <img  src="<?php echo base_url(); ?>asset/login/images/ozoneERP-logo-white.png" alt="" />
                                <p>
                                    Cloud and Offline ERP solution for Trading and Manufacturing Companies to manage their Inventory and Accounts
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JS -->
        <script src="<?php echo base_url(); ?>asset/login/js/jquery-3.4.0.min.js"></script>
        <script src="<?php echo base_url(); ?>asset/login/js/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>asset/login/js/bootstrap.min.js"></script>

    </body>
</html>