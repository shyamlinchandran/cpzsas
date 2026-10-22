 
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        
        <small></small>
        <?= label('Dashboard', $this, $user) ?>

    </h1> 
</section> 
<section class="content">     
    <div class="row">
        <div class="col-md-12">
            <?php if (count($quickmenu) != 0) {
                ?>
                <!-- Application buttons -->
                <div class="<?=$this->box_color?>">

                    <div class="box-body">
                        <?php
                        $i = 0;
                        foreach ($quickmenu as $ms) {

                            if ($i % 3 == 0 || $i % 3 == 1) {
                                $bg = 'bg-orange';
                            } else {
                                $bg = 'bg-olive';
                            }
                            $i++;
                            if ($ms['Url'] != '') {
                                $icon = "fa-fire";
                                if ($ms['icon'] != '') {
                                    $icon = $ms['icon'];
                                }
                                ?>
                                <a class="btn btn-app <?= $bg ?> " href="<?= base_url() . $ms['Url'] ?>">
                                    <i class="fa <?= $icon ?>"></i> <?= $ms['ListName'] ?>
                                </a>
                                <?php
                            }
                        }
                        ?>

                        <!--                    <a class="btn btn-app">
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
                                            </a>-->
                    </div>
                    <!-- /.box-body -->
                </div> 
            </div>
        <?php } ?>
        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
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
                    <span class="info-box-number">41,410</span>
                </div>

            </div>

        </div>
        -->
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

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-list-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Sales Order", $this, $user) ?></span>
                    <span class="info-box-number" id="sales"><?php echo $estimate; ?></span>
                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= label("Purchase Order", $this, $user) ?></span>
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

</section>
