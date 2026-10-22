<?php
$is_discount = 0;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '180px'; //if discont is 0
?>

<style>
    .ex{
        margin: 100px 100px 100px 100px;
    }
</style>

<div style="width:595px; font-size: 13px;  height:842px; text-align:justify; ">
    <span style="font-size:12px; line-height: .7;  "><p style="text-align:left;"><i><b>AROGYA MEDICAL CLINIC</b> </i></p><p style="text-align:left; line-height: .7;  font-size:10px;">Phone:9387819525</p></span>
    <span style="font-size:12px; "><p style="text-align:right;"> </p></span>

    <?php if ($type == "medical") { ?> <span style="font-size:27px; font-weight:bold"><p style="text-align:center;">MEDICAL CERTIFICATE </p></span><?php } ?>
    <?php if ($type == "carry") { ?> <span style="font-size:20px; font-weight:bold"><p style="text-align:center;">TO WHOM SO EVER IT MAY CONCERN:</p></span><?php } ?>
    <?php if ($type == "fitness") { ?>
        <span style="font-size:27px; font-weight:bold"><p style="text-align:center;">FITNESS CERTIFICATE </p></span><?php } ?>
    <br><br>
    <?php if ($type != "carry") { ?>
        <span style="font-size:15px"><i>Signature of Applicant.........</i></span>
    <?php } ?>
    <br>
    <br>
    <?php if ($type == "fitness") { ?>
        <p style="line-height: 1.5">&nbsp; &nbsp;&nbsp;I, Dr.Muhammad Sayid  do hereby certify that I had carefully examined Mr./Ms.<?php echo $pat['Pat_Name']; ?> of your institution  <?php  $new = str_replace('%20', ' ', $institution); echo $new; ?>  whose signature is given above,  and find that he/she has recovered from his/her
            illness and is now fit to resume duties.</p>
        <p style="line-height: 1.5">&nbsp;&nbsp;&nbsp;&nbsp; I also certify that before arriving at this decision, I have examined the original
            medical certificate and statement of the case (or certified copies there of) on which
            leave was granted or extended and have taken these into consideration in arriving at
            my decision.</p>
    <?php } ?>  

    <?php if ($type == "medical") { ?>
        <p style="line-height: 1.5">&nbsp;&nbsp;&nbsp;&nbsp; I, Dr.Muhammad Sayid after careful personal examination of the case hereby certify that Mr./Ms.<?php echo $pat['Pat_Name']; ?> of your institution  <?php  $new = str_replace('%20', ' ', $institution); echo $new; ?> whose signature is given above, is suffering from.<?php if ($boknote[0]['Bok_Note'] != "") { echo $boknote[0]['Bok_Note']; ?>  <?php } else { ?>............................................<?php } ?>.and therefore, I consider that a period of absence from duty from (<?php echo $startdate; ?>) to (<?php echo $enddate; ?>) with effect from (<?php echo $startdate; ?>) , <?php echo $diff; ?>  is absolutely necessary for the restoration of his/her health.

        </p>
    <?php } ?>   
    <?php if ($type == "carry") { ?>
        <p style="line-height: 1.5">&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that Mr./Ms.<?php echo $pat['Pat_Name']; ?> now residing in <?php echo $reside; ?> is under my treatment.</p>
        <p style="line-height: 1.5">&nbsp;&nbsp;&nbsp;&nbsp;The following medicines are to be taken by the patient for <?php echo $diff; ?> . They are genuine Homoeopathic medicines dispensed under my supervision. These medicines do not contain any narcotics or sedatives.These Medicines being carried by Mr./Ms.<?php echo $pat['Pat_Name']; ?> .     </p>
        <style>

            .td,.th{
                border :1px solid black;
                border-collapse: collapse;
                padding: 5px;
                text-align: center;
            }

        </style>
        <table class="intro">
            <tr><th class="td"   colspan="2"><b>Name Of Medicine</b></th><th class="td"><b>Quantity</b></th><th class="td"><b>Dosage</b></th></tr>
            <?php foreach ($sales_items as $item) { ?>
                <tr> <td  class="td" colspan="2"><?php echo $item['name']; ?></td><td class="td"><?php echo $item['Quantity']; ?></td><td class="td"></td></tr>

            <?php } ?>
            <tr> <td  class="td" colspan="2"></td><td class="td"></td><td class="td"></td></tr>
        </table>
    <?php } ?>   




    <table >
        <tr><td></td><td></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td></td><td></td></tr>

        <tr><td style="width:60%;"></td>
            <td style="text-align: left;width:40%;">Signature of medical officer</td></tr>
        <tr><td style="width:60%;"></td><td style="text-align: left;width:40%;">Dr.Muhammad Sayid</td></tr>
        <tr><td style="width:60%;"></td><td style="text-align: left;width:40%;">Registration Number: 8239</td></tr>
        <tr><td style="width:60%;">Place : <?php echo $place; ?></td><td style="text-align: left; width:40%;">Part of Registration: TCMC</td></tr>
        <tr><td style="width:60%;">Date  &nbsp;: <?php $dt = new DateTime();echo $dt->format('d-m-Y'); ?></td><td style="text-align: left; width:50%;">System of Medicine:Homoeopathy</td></tr>
    </table>

</div>
