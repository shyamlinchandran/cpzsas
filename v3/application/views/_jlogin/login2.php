<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>DIMS | Login</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>asset/login/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>asset/login/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>asset/login/css/style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="wrapper">

            <div class="left-wrapper">
                <div class="col-lg-8 col-md-10 col-sm-11">
                    <div class="left-table">
                        <div class="left-table-cell">
                            <h3></h3>
                            <h2></h2>
                            <p></p>
                            <!--                            <div class="left-btn-grp">
                                                            <button type="submit" class="btn btn-default sr-btn">Service</button>
                                                            <button type="submit" class="btn btn-default ss-btn">Sales</button>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-wrapper">
                <div class="col-sm-12">
                    <div class="right-table">
                        <div class="right-table-cell">
                            <div class="maintab">
                                <!--                                <h6>Sign In</h6>
                                                                <p>Login </p>-->
                                 <img src="<?php echo base_url(); ?>/asset/login/images/logo.png">
                                <div class="tab-wrapper">
                                    <!-- Nav tabs -->
                                   
                                    <ul class="nav nav-tabs" role="tablist"> 

                                        <li role="presentation" class="active"><a href="#signin" aria-controls="signin" role="tab" data-toggle="tab">Sign In</a></li>

                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane active" id="signin">
                                            <form action="<?php echo base_url(); ?>login/loginset" method="post">                                             
                                                <div class="form-group has-feedback">
                                                    <label>Company ID</label>
                                                    <input type="text" class="form-control"name="comid" placeholder="Company ID">
                                                    <span class="glyphicon glyphicon-comment form-control-feedback"></span> 
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label>User Name</label>
                                                    <input type="text" class="form-control"name="uname" placeholder="User Name">
                                                    <span class="glyphicon glyphicon-user form-control-feedback"></span> 
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label>Password</label>
                                                    <input type="password" name="pswd" class="form-control" placeholder="Password">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                </div>
                                                <div class="form-group">
                                                    <text class="text-danger"><?php echo $error;?> </text>
                                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                                </div>
                                            </form>
                                            <p class="copyright">©2018 Dims Team</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url(); ?>asset/login/js/jquery.min.1.12.4.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>asset/login/js/bootstrap.min.js"></script>

    </body>
</html>
