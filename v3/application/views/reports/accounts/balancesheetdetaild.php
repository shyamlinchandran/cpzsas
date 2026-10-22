<?php

function num($num) {
    if ($num < 0) {
        $num = $num * -1;
    }
    return number_format($num, 2);
}

$totalAssets = $res['currntstk'];
$totalLiability = 0.00;
$companyAssets = 0;
$companyLiability = 0;
?>  
<table id="table" class="table table-hover table-condensed table-striped" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="col-md-3"><?= label('Particulars', $this, $user) ?></th>
            <th class="col-md-3  text-right"><?= label('Amount', $this, $user) ?></th>
            <th class="col-md-3"><?= label('Particulars', $this, $user) ?></th>
            <th class="col-md-3 text-right"><?= label('Amount', $this, $user) ?></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <th style="text-align:center;" colspan="2">Liability</th>
            <th style="text-align:center;" colspan="2">Assets</th>
        </tr>
        <tr> 
            
            <td></td>
            <td class="text-right"></td>
			<td><?= label('Closing Stock', $this, $user) ?></td>
            <td class="text-right"><?php print_r(num($res['currntstk'])) ?></td>
        </tr>
        <?php if ($profit >= 0) { 
             $totalLiability = $totalLiability + $profit;
			 
            ?>
            <tr> 
                <td><a onclick="showprofitandloss()"> <?= label('Net Profit', $this, $user) ?></a></td>
                <td class="text-right"><?php print_r(num($profit)) ?></td>
                <td></td>
                <td class="text-right"></td>
            </tr>
        <?php } else {
            $totalAssets = $totalAssets + ($profit*-1);?>
            <tr> 
                <td></td>
                <td class="text-right"></td>
                <td><a onclick="showprofitandloss()"> <?= label('Net Loss', $this, $user) ?></td>
                <td class="text-right"><?php print_r(num($profit)) ?></td>
            </tr>

        <?php } ?>
        <?php
        if (isset($result)) {
            $dir_length = sizeof($result['asset']);
            if (sizeof($result['asset']) < sizeof($result['liability'])) {
                $dir_length = sizeof($result['liability']);
            }
            for ($i = 0; $i < $dir_length; $i++) {
                ?>
                <tr>
				        <td> 
                        <?php if (isset($result['liability'][$i]['name'])) { ?> 
                            <a  onclick="showledger(<?= $result['liability'][$i]['id'] ?>, '<?= $result['liability'][$i]['name'] ?>')" > <?= $result['liability'][$i]['name'] ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-right"><?php
                        if (isset($result['liability'][$i]['amt'])) {
                            echo num($result['liability'][$i]['amt']);
                            $totalLiability = $totalLiability + abs($result['liability'][$i]['amt']);
                        } else {
                            // echo '0.00';
                        }
                        ?></td>
                    <td>
                        <?php if (isset($result['asset'][$i]['name'])) { ?> 
                            <a  onclick="showledger(<?= $result['asset'][$i]['id'] ?>, '<?= $result['asset'][$i]['name'] ?>')" > <?= $result['asset'][$i]['name'] ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-right"><?php
                        if (isset($result['asset'][$i]['amt'])) {
                            echo num($result['asset'][$i]['amt']);
								$totalAssets = $totalAssets + abs($result['asset'][$i]['amt']);
								
                        } else {
                            // echo '0.00';
                        }
                        ?>
                    </td>
            
                </tr>
                <?php
            }
        }
        ?>


        <tr>
            <?php
            $gp = $totalAssets - $totalLiability;
            if ($gp <= 0) {
                ?>
               <td></td>
                <td></td>
                <td><br/><?= label('Diff  Opening Balance', $this, $user) ?></td>
                <td class="text-right"><br/><?php echo num($gp) ?></td>
                <?php
                $totalAssets = $totalAssets + $gp;
                ?>
            <?php } else { ?>
                <?php
                $totalLiability = $totalLiability + ($gp);
                ?>
              
				 <td><br/><?= label('Diff  Opening Balance', $this, $user) ?></td>
                <td class="text-right"><br/><?php echo number_format($gp, 2) ?></td>
                <td></td>
                <td></td>
            <?php } ?>

        </tr>

        <tr>

          
            <td><?= label('Total', $this, $user) ?></td>
            <td class="text-right"><b><?php echo num($totalLiability) ?></b></td>
			  <td><?= label('Total', $this, $user) ?></td>
            <td class="text-right"><b><?php echo num($totalAssets) ?></b></td>
        </tr>

    </tbody>
</table>