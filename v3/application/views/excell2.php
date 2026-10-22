<?php
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
$filename = date('Y-m-d').'_Trial_balance.xls';
header("Content-Disposition: attachment; filename=".$filename);
?> 
<?php


function num($num) {
    if ($num < 0) {
        $num = $num * -1;
    }
    return number_format($num, 2);
}
?>  


    <table cellpadding="0" cellspacing="0" border="1" class="table table-bordered">
    <thead>
        <tr>
            <th colspan ="6">Trial Balance</td>
        </tr>
        <tr>
            <th style ="font-weight:bold;text-align:left;" class ="col-sm-3"  colspan  = "2" ><?= label('Particulars', $this, $user) ?></th>
            <th style ="font-weight:bold;text-align:left;" ><?= label('Opening', $this, $user) ?></th>
            <th style ="font-weight:bold;text-align:left;" ><?= label('Debit', $this, $user) ?></th>
            <th style ="font-weight:bold;text-align:left;" ><?= label('Credit', $this, $user) ?></th>
            <th style ="font-weight:bold;text-align:left;" ><?= label('Closing', $this, $user) ?></th>
        </tr>
    </thead>
    <tbody>

    <?php
           $data = $details['ledger_data'];
           if(sizeof($data) > 0 ){
                $acc_main_id = $data[0]['acc_main_id'];
           }
           $tbody = array();
          
            foreach($data as $item){
                $g_credit = 0 ;
                $g_debit = 0;
               
                $cretot = $item['cretot'];
                $debtot = $item['debtot'];
                $g_credit = (float)  $g_credit + (float) $cretot ;
                $g_debit = (float)  $g_debit + (float) $debtot ;
                if((float) $debtot < (float) $cretot  ){
                    $open = (float) $cretot - (float) $debtot ; 
                    $open = $open.'CR';
                }else{
                    $open = (float) $debtot - (float) $cretot ; 
                    $open = $open.'DR';

                }

                $credit = $item['credit'];
                $debit = $item['debit'];
                if((float) $debit < (float) $credit  ){
                    $transaction = (float) $credit - (float) $debit ; 
                    $transaction = $transaction.'CR';
                }else{
                    $transaction = (float) $debit - (float) $credit ; 
                    $transaction = $transaction.'DR';

                }

                $g_credit = (float)  $g_credit + (float) $credit ;
                $g_debit = (float)  $g_debit + (float) $debit ;

                if((float) $g_debit < (float) $g_credit  ){
                    $closing = (float) $g_credit - (float) $g_debit ; 
                    $closing = $closing.'CR';
                }else{
                    $closing = (float) $g_debit - (float) $g_credit ; 
                    $closing = $closing.'DR';

                }
        ?>

<?php if(isset( $tbody[$item['acc_main_id']] ) ){
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .  '<tr class ="table_sub" >';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="width:100px;" ></th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th >'. $item['name'].'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $open.'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $item['debit'].'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $item['credit'].'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $closing.'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .' </tr>';

        }else{
            $tbody[$item['acc_main_id']] =   '<tr class ="table_sub" >';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th ></th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th >'. $item['name'].'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $open.'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $item['debit'].'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $item['credit'].'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .'<th style ="text-align:right;">'. $closing.'</th>';
            $tbody[$item['acc_main_id']] = $tbody[$item['acc_main_id']] .' </tr>';

        } } ?>

<?php
           $data = $details['acc_main_data'];
           if(sizeof($data) > 0 ){
                $acc_main_id = $data[0]['acc_main_id'];
           }
           $grand_debit = $grand_credit = 0;
            foreach($data as $item){
                $g_credit = 0 ;
                $g_debit = 0;
               
                $cretot = $item['cretot'];
                $debtot = $item['debtot'];
                $g_credit = (float)  $g_credit + (float) $cretot ;
                $g_debit = (float)  $g_debit + (float) $debtot ;
                if((float) $debtot < (float) $cretot  ){
                    $open = (float) $cretot - (float) $debtot ; 
                    $open = $open.'CR';
                }else{
                    $open = (float) $debtot - (float) $cretot ; 
                    $open = $open.'DR';

                }

                $credit = $item['credit'];
                $debit = $item['debit'];
                if((float) $debit < (float) $credit  ){
                    $transaction = (float) $credit - (float) $debit ; 
                    $transaction = $transaction.'CR';
                }else{
                    $transaction = (float) $debit - (float) $credit ; 
                    $transaction = $transaction.'DR';

                }

                $g_credit = (float)  $g_credit + (float) $credit ;
                $g_debit = (float)  $g_debit + (float) $debit ;

                if((float) $g_debit < (float) $g_credit  ){
                    $closing = (float) $g_credit - (float) $g_debit ; 
                    $closing = $closing.'CR';
                }else{
                    $closing = (float) $g_debit - (float) $g_credit ; 
                    $closing = $closing.'DR';

                }
                $grand_debit = (float) $grand_debit + (float) $item['debit'] ;
                $grand_credit = (float) $grand_credit + (float) $item['credit'] ;
        ?>
            
            <tr>
                <th  style ="font-weight:bold;text-align:left;" colspan  = "2" ><b><?php echo $item['main'];?></b></th>
                <th style ="font-weight:bold;text-align:right;"><b class ="clsmain" ><?php echo $open;?></th>
                <th style ="font-weight:bold;text-align:right;"><b class ="clsmain"><?php echo $item['debit'];?></th>
                <th style ="font-weight:bold;text-align:right;"><b class ="clsmain"><?php echo $item['credit'];?></th>
                <th style ="font-weight:bold;text-align:right;"><b class ="clsmain"><?php echo $closing;?></th>
             </tr>
             
        <thead>
               
    </thead>
        <?php echo  $tbody[$item['acc_main_id']];  ?>

             <tr class ="table_sub" >
                <th  style ="font-weight:bold;text-align:left;" colspan  = "2" ><b><?php  echo 'Total ';//echo $item['main'];?></b></th>
                <th style ="font-weight:bold;text-align:right;"><b><?php echo $open;?></th>
                <th style ="font-weight:bold;text-align:right;"><b><?php echo $item['debit'];?></th>
                <th style ="font-weight:bold;text-align:right;"><b><?php echo $item['credit'];?></th>
                <th style ="font-weight:bold;text-align:right;"><b><?php echo $closing;?></th>
             </tr>
             <?php } ?>

             <tr class ="" >
                <th  style ="font-weight:bold;" colspan  = "2" ><b><?php  echo 'Total ';//echo $item['main'];?></b></th>
                <th style ="font-weight:bold;text-align:right;"><b></th>
                <th style ="font-weight:bold;text-align:right;"><b><?php echo   $grand_debit;?></th>
                <th style ="font-weight:bold;text-align:right;"><b><?php echo  $grand_credit;?></th>
                <th style ="font-weight:bold;text-align:right;"><b></th>
             </tr>

    </tbody>
</table>