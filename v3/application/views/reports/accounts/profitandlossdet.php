<?php

function num($num) {
    if ($num < 0) {
        $num = $num * -1;
    }
    return number_format($num, 2);
}
?>  
<table id="table" class="table <?= $this->table_color ?> table table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="col-md-3"><?= label('Particulars.', $this, $user) ?></th>
            <th class="col-md-3  text-right"><?= label('Amount', $this, $user) ?></th>
            <th class="col-md-3"><?= label('Particulars', $this, $user) ?></th>
            <th class="col-md-3 text-right"><?= label('Amount', $this, $user) ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= label('Opening Stock', $this, $user) ?></td>
            <td class="text-right"> <?php print_r(num($res['openstk'])) ?></td>
			<td><a href = "<?php echo site_url('reports/items/fifo_lifo'); ?>" >Closing Stock</a></td>
            <td class="text-right"><?php print_r(num($res['currntstk'])) ?></td>
        </tr>
        <tr>
            <th colspan="2">Direct Expense</th>
            <th colspan="2">Direct Income</th>
        </tr>

        <?php
        if (isset($result)) {
            $dir_length = sizeof($result['dir_expence']);
            if (sizeof($result['dir_expence']) < sizeof($result['dir_income'])) {
                $dir_length = sizeof($result['dir_income']);
				}
            for ($i = 0; $i < $dir_length; $i++) {
                ?>
                <tr>
                    <td>
                        <?php if (isset($result['dir_expence'][$i]['name'])) { ?> 
                            <a  onclick="showledger(<?= $result['dir_expence'][$i]['id'] ?>, '<?= $result['dir_expence'][$i]['name'] ?>')" > <?= $result['dir_expence'][$i]['name'] ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-right"><?php
                        if (isset($result['dir_expence'][$i]['amt'])) {
                            echo num($result['dir_expence'][$i]['amt']);
                        } else {
                            echo '0.00';
                        }
                        ?>
                    </td>
                    <td> 
                        <?php if (isset($result['dir_income'][$i]['name'])) { ?> 
                            <a  onclick="showledger(<?= $result['dir_income'][$i]['id'] ?>, '<?= $result['dir_income'][$i]['name'] ?>')" > <?= $result['dir_income'][$i]['name'] ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-right"><?php
                        if (isset($result['dir_income'][$i]['amt'])) {
                            echo num($result['dir_income'][$i]['amt']);
                        } else {
                            echo '0.00';
                        }
                        ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td style="text-align: right;  font-weight: bold;"> <?= label('Total', $this, $user) ?> </td>
            <td class="text-right">
                <?php
                $dir_expence = $res['dir_expence'];
                if ($dir_expence < 0) {
                    $dir_expence = $dir_expence * -1;
                }
                print_r(num($dir_expence));
                $dir_expence = $dir_expence + $res['openstk'];
                ?>
            </td>
            <td style="text-align: right;  font-weight: bold;">  <?= label('Total ', $this, $user) ?></td>
            <td class="text-right">
                <?php
                $dir_income = $res['dir_income'];
                print_r(num($dir_income));
                $dir_income = $dir_income + ($res['currntstk']);
                ?>
            </td>
        </tr>
        
        <tr>
            <?php
            $gp = $dir_income - $dir_expence;
            if ($gp >= 0) {
                ?>
                <td style="text-align: right;  font-weight: bold;"><br/><?= label('Gross Profit', $this, $user) ?></td>
                <td class="text-right"><br/><?php echo number_format($gp, 2) ?></td>
                <td></td>
                <td></td>
                <?php
                $tot = $dir_expence + $gp;
                ?>
            <?php } else { ?>
                <?php
                $tot = $dir_income + ($gp * -1);
                ?>
                <td></td>
                <td></td>
                <td style="text-align: right;  font-weight: bold;"><br/><?= label('Gross Loss', $this, $user) ?></td>
                <td class="text-right"><br/><?php echo num($gp) ?></td>
            <?php } ?>

        </tr>

        <tr>

            <td  style="text-align: right;  font-weight: bold;"><?= label('Total', $this, $user) ?></td>
            <td class="text-right"><b><?php echo num($tot) ?></b></td>
            <td  style="text-align: right;  font-weight: bold;"><?= label('Total', $this, $user) ?></td>
            <td class="text-right"><b><?php echo num($tot) ?></b></td>
        </tr>
        <?php
        $indir_expence = $res['indir_expence'] * -1;
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
                <td style="text-align: right;  font-weight: bold;"><br/>Gross Loss</td>
                <td class="text-right"><br/><?php echo num($gp) ?></td>
                <td></td>
                <td></td>
                <?php
            } else {
                ?>
                <td></td>
                <td></td>
                <td style="text-align: right;  font-weight: bold;"><br/>Gross Profit</td>
                <td class="text-right"><br/><?php echo num($gp) ?></td>

            <?php } ?>

        </tr>
        <tr>
            <th colspan="2">Indirect Expense</th>
            <th colspan="2">Indirect Income</th>
        </tr>
        <?php
        if (isset($result)) {
            $indir_length = sizeof($result['indir_expence']);
            if (sizeof($result['indir_expence']) < sizeof($result['indir_income'])) {
                $indir_length = sizeof($result['indir_income']);
            }
            for ($i = 0; $i < $indir_length; $i++) {
                ?>
                <tr>
                    <td>
                        <?php if (isset($result['indir_expence'][$i]['name'])) { ?> 
                            <a  onclick="showledger(<?= $result['indir_expence'][$i]['id'] ?>, '<?= $result['indir_expence'][$i]['name'] ?>')" > <?= $result['indir_expence'][$i]['name'] ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-right"><?php
                        if (isset($result['indir_expence'][$i]['amt'])) {
                            echo num($result['indir_expence'][$i]['amt']);
                        } else {
                           // echo '0.00';
                        }
                        ?>
                    </td>
                    <td> 
                        <?php if (isset($result['indir_income'][$i]['name'])) { ?> 
                            <a  onclick="showledger(<?= $result['indir_income'][$i]['id'] ?>, '<?= $result['indir_income'][$i]['name'] ?>')" > <?= $result['indir_income'][$i]['name'] ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-right"><?php
                        if (isset($result['indir_income'][$i]['amt'])) {
                            echo num($result['indir_income'][$i]['amt']);
                        } else {
                          //  echo '0.00';
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td style="text-align: right;  font-weight: bold;">Total</td>
            <td class="text-right">
                <?php
                print_r(num($indir_expence));
                ?>
            </td>
            <td style="text-align: right;  font-weight: bold;">Total</td>
            <td class="text-right">
                <?php
                print_r(num($res['indir_income']));
                ?>
            </td>
        </tr>

        <tr>
            <?php
            if ($tgp >= 0) {
                $tot = $tgp + $totntoe;
                ?>
                <td style="text-align: right;  font-weight: bold;">Net Profit</td>
                <td class="text-right"><?php echo num($tgp) ?></td>
                <td></td>
                <td></td>
                <?php
            } else {
                $tot = $tgp * -1 + $totnton;
                ?>
                <td></td>
                <td></td>
                <td style="text-align: right;  font-weight: bold;">Net Loss</td>
                <td class="text-right"><?php echo num($tgp) ?></td>
            <?php } ?>

        </tr>
        <tr>
            <?php
            //  $tot = $res['openstk'] + $res['dir_expence'] + $gp;
            ?>
            <td style="text-align: right;  font-weight: bold;"><b>Total</b></td>
            <td class="text-right"><b><?php echo number_format($tot, 2) ?></b></td>
            <td style="text-align: right;  font-weight: bold;"><b>Total</b></td>
            <td class="text-right"><b><?php echo number_format($tot, 2) ?></b></td>
        </tr>
    </tbody>
</table>