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
        <?php for ($i = 0; $i < 8; $i++) { ?>
            <div> 
                <?php for ($k = 0; $k < 3; $k++) { ?>
                    <div  class="suvdiv">
                        <div><b style="font-size: 12"><?php print_r($company['name']); ?></b></div>
                        <div  style="font-size: 12"><?php print_r($name . '-' . $barcode); ?></div>
                        <div><b  style="font-size: 13">Sales Rate-<?php print_r($MRP); ?></b> </div>
                        <div><barcode code="<?php print_r($barcode); ?>" type="C128A" height="0.6" text="1" /></div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </body>
</html>
