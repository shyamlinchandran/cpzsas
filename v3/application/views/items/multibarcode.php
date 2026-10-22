<?php $company = $this->load->get_var('company');
?>
<style>
    .suvdiv {
        width:6.9cm;
        float:left; 
        height: 3.5cm; 
        text-align: center;
        color: #000044;
        margin-bottom: 5px;
        /* border: 2px solid;*/
    }
    /*    .barcode {
            padding: 3mm;
            margin: 0;
            vertical-align: top;
            color: #000044;
            height: 20px;
        }
        .barcodecell {
            text-align: center;
            vertical-align: middle;
        }*/
</style>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $j = 0;
        $t = 0;
        for ($i = 0; $i < $quantity; $i++) {
            ?>
            <div> 
                <?php
                for ($k = 0; $k < 3; $k++) {
                    if ($j < $barcode[$t]['quantity']) {
                        
                    } else {
                        if ($t + 1 < $size) {
                            $t = $t + 1;
                        }
                        else{
                            break;
                        }
                        $j = 0;
                    }
                    ?>
                    <div  class="suvdiv">
                        <div><b style="font-size: 12"><?php print_r($company['name']); ?></b></div>
                        <div  style="font-size: 12"><?php print_r($barcode[$t]['item_name'] . '-' . $barcode[$t]['barcode']); ?></div>
                        <div><b  style="font-size: 13">Sales Rate-<?php print_r($barcode[$t]['rate']); ?></b> </div>
                        <div><barcode code="<?php print_r($barcode[$t]['barcode']); ?>" type="C128A" height="0.6" text="1" /></div>
                        <div><b style="font-size: 12"><?php print_r($barcode[$t]['barcode']); ?></b></div>
                    </div>
                    <?php
                    $j = $j + 1;
                }
                ?>
            </div>
            <?php
            if ($barcode[0]['total'] <= $i * 3) {
                break;
            }
        }
        ?>
    </body>
</html>
