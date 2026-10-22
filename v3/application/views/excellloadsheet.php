<?php
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
$filename = date('Y-m-d').$title.'.xls';
header("Content-Disposition: attachment; filename=".$filename);
?> 
<table>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Free Quantity</th>
            <th>Total Qty</th>
            <th>Unit</th>
            <th>Boxes</th>
            <th>Pack Details</th>
        </tr>
    </thead>
    <?php
        $sno = 0;
        $tot_boxes = 0;
        $gtot = 0;
        foreach($details as $items){
            $sno++;
            $boxes =0;
            $chk = $items['sub_unit_one'] + $items['sub_unit_two'];
            $i_stock = $items['quantitys'];
			$text = '';
            if((int) $i_stock > 0 ){
				if(isset($unit_data[$items['unit_id']]) ){
					$datas = $unit_data[$items['unit_id']];
					foreach($datas as $ustock){
						if($i_stock >= $ustock['count']){
							if($chk < 1 || (int) $items['sub_unit_one'] == (int)$ustock['id'] || (int) $items['sub_unit_two'] == (int)$ustock['id'] ){
								$calc = $i_stock / $ustock['count'];
								$calc = floor($calc);
								$i_stock = $i_stock % $ustock['count'];
						
								if($text !=''){
									$text = $text .',';
								}
								$text = $text.' ' . $ustock['name'].' : '.$calc;
                                if($ustock['count'] >1 ){
                                     $boxes  = $calc;
                                     $tot_boxes =  (float) $tot_boxes + (float)$calc;
                                }
							}
							if($i_stock < 2){
								 break;
							}
						}
					}
				}
			}

            
            if($text !=''){
                $text = $text .',';
            }
            $text = $text.' ' . $items['code'].' : '.$i_stock;
            $gtot = (float) $gtot +  (float) $items['free_quantity'] + (float) $items['quantitys'];
    ?>
        <tr>
            <th><?php echo $sno;?></th>
            <th><?php echo $items['name'];?></th>
            <th><?php echo $items['quantitys'];?></th>
            <th><?php echo $items['free_quantity'];?></th>
            <th><?php echo (float) $items['free_quantity'] + (float) $items['quantitys'];?></th>
            <th><?php echo $items['code'];?></th>
            <th><?php echo $boxes;?></th>
            <th><?php echo $text;?></th>
        </tr>

           
           

    <?php }?>

        <tr>
            <th></th>
            <th>Total</th>
            <th></th>
            <th></th>
            <th><?php echo $gtot;?></th>
            <th></th>
            <th><?php echo $tot_boxes;?></th>
            <th></th>
        </tr>


           


</table>