<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title"><?= label('Profit & Loss A/C', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-6">
<!--                <table   class="table table <?= $this->table_color ?> table table-hover cc" cellspacing="0" width="100%">
                    <tbody>
                        <tr>

                            <td class="col-sm-2">
                                Start Date
                                <input type="text" class="form-control date" id="startdate"/>
                            </td>
                            <td class="col-sm-2">
                                End Date 
                                <input type="text" class="form-control date" id="enddate"/> 
                            </td>


                            <td>
                                <br/>
                                <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                            </td>
                        </tr>
                    </tbody>
                </table>                     -->
                        <br/>
                        <table id="table"  class="table <?= $this->table_color ?> table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-md-3"><?= label('Particulars', $this, $user) ?></th> 
                                    <th  class="col-md-3"><?= label('Amount', $this, $user) ?></th>  
                                    <th  class="col-md-3"><?= label('Particulars', $this, $user) ?></th> 
                                    <th  class="col-md-3"><?= label('Amount', $this, $user) ?></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= label('Opening Stock', $this, $user) ?></td>
                                    <td class="text-right"> <?php print_r(number_format($res['openstk'], 2)) ?></td>
                                    <td><a href = "<?php echo site_url('reports/items/fifo_lifo'); ?>" >Closing Stock</a></td>
                                    <td class="text-right"><?php print_r(number_format($res['currntstk'], 2)) ?></td>
                                </tr>
                                <tr>
                                    <td> <?= label('Direct Expense', $this, $user) ?> </td>
                                    <td class="text-right"> 
                                        <?php
                                        $dir_expence = $res['dir_expence'];
                                        if ($dir_expence < 0) {
                                            $dir_expence = $dir_expence * -1;
                                        }
                                        print_r(number_format($dir_expence, 2));
                                        $dir_expence = $dir_expence + $res['openstk'];
                                       
                                        ?>
                                    </td>
                                    <td> <?= label('Direct Income', $this, $user) ?></td>
                                    <td class="text-right">
                                        <?php
                                        $dir_income = $res['dir_income'];
                                        print_r(number_format($dir_income, 2));
                                        $dir_income = $dir_income + ($res['currntstk']);
                                         
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $gp = $dir_income - $dir_expence;
                                    if ($gp >= 0) {
                                        ?>
                                        <td><?= label('Gross Profit', $this, $user) ?></td>
                                        <td class="text-right"><?php echo number_format($gp, 2) ?></td>
                                        <td></td>
                                        <td></td>
                                        <?php
                                    $tot = $res['openstk'] + $dir_expence + $gp;
                                    ?>
                                    <?php } else { ?>
                                        <?php
                                    $tot = $dir_income+ ($gp*-1);
                                    ?>
                                        <td></td>
                                        <td></td>
                                        <td><?= label('Gross Loss', $this, $user) ?></td>
                                        <td class="text-right"><?php echo number_format($gp * -1, 2) ?></td>
                                    <?php } ?>

                                </tr>
                                <tr>
                                    
                                    <td><?= label('Total', $this, $user) ?></td>
                                    <td class="text-right"><?php echo number_format($tot, 2) ?></td> 
                                    <td><?= label('Total', $this, $user) ?></td>
                                    <td class="text-right"><?php echo number_format($tot, 2) ?></td> 
                                </tr>
                                <tr>
                                    <td><span> </span> </td>
                                    <td> </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> 
                                <?php
                                $indir_expence = $res['indir_expence']*-1 ;
                                $indir_income = $res['indir_income'];
                                $totntoe = $indir_expence;
                                $totnton = $indir_income;
                                ?>

<tr>
                                    <?php 
                                    if ($gp <= 0) {
                                        $totntoe = $totntoe + ($gp * -1);
                                    } else {
                                        $totnton = $totnton + $gp;
                                    }
                                    $tgp = $totnton - $totntoe;
                                    $tot = 0;
                                    
                                    if ($gp <= 0) {
                                        
                                        ?> 
                                        <td>Gross Loss</td>
                                        <td class="text-right"><?php echo number_format($gp * -1, 2) ?></td>
                                        <td></td>
                                        <td></td>
                                    <?php
                                    } else {
                                        
                                        ?> 
                                        <td></td>
                                        <td></td>
                                        <td>Gross Profit</td>
                                        <td class="text-right"><?php echo number_format($gp, 2) ?></td>

                                    <?php } ?>

                                </tr>
                                <tr>
                                    <td>Indirect Expense</td>
                                    <td class="text-right"> 
                                        <?php
                                        print_r(number_format($indir_expence, 2));
                                        ?>
                                    </td>
                                    <td>Indirect Income</td>
                                    <td class="text-right">
                                        <?php
                                        print_r(number_format($res['indir_income'], 2));
                                        ?>
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <?php
                                    if ($tgp >= 0) {
                                        $tot = $tgp+ $totntoe;
                                        ?> 
                                        <td>Net Profit</td>
                                        <td class="text-right"><?php echo number_format($tgp, 2) ?></td>
                                        <td></td>
                                        <td></td> 
                                    <?php } else {
                                        $tot = $tgp*-1 + $totnton;
                                        ?> 
                                        <td></td>
                                        <td></td>
                                        <td>Net Loss</td>
                                        <td class="text-right"><?php echo number_format($tgp*-1, 2) ?></td>
                                    <?php } ?>

                                </tr>
                                <tr>
                                    <?php
                                    //  $tot = $res['openstk'] + $res['dir_expence'] + $gp;
                                    ?>
                                    <td><b>Total</b></td>
                                    <td class="text-right"><b><?php echo number_format($tot, 2) ?></b></td> 
                                    <td><b>Total</b></td>
                                    <td class="text-right"><b><?php echo number_format($tot, 2) ?></b></td> 
                                </tr>
                            </tbody>
                            </tbody>
                            </tbody>


                        </table>
                    </div>
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
    $.validate({
        modules: 'date, security,file'
    });
    var table;
    var id = 0;

    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    $(document).ready(function () {



    });
</script>
