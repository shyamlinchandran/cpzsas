<html>
    <style>
        .cnyadd {
            text-align: center;
            color: red;
            font-size:10px;
            width: 100%; 
        }
        .cntainer{
            width: 1024px;
            margin: auto;

        }
        table {
            width: 100% ;
            font-size: 8px;
            line-height: 13px;  
        }
        body{
            font-size: 8px; 
        }
        .hed{
            color: red;
            font-size:10px;
            font-weight: bold; 
            text-align: center;
            background-color: #eee;
            margin: 30px;
        } 
        .right{
            text-align: right;
        }
        .left{
            text-align:left !important;
        }
         td {
            text-align:center;
            margin: 0px;
        }
        tr .head{
            margin-left: 30px;
        }
    </style>
    <?php

    function array_find_deep($array, $matching) {
        foreach ($array as $item) {
            if ($item['txtname'] == $matching)
                return $item['value'];
        }

        return false;
    }

    function getval($oc, $type) {
        $sm = array_find_deep($oc, $type);
        return $sm;
    }

    function Show_Amount_In_Words($number) {

        $no = round($number);
        $point = round($no - $number, 2);
        $hundred = null;
        $no = $number - $point;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else
                $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $result = $result . "Rupees ";
        if ($point * 100 > 0) {
            $result = $result . $point . " Ps";
        }

        return $result;
    }
    ?>
    <body style='padding: 0px; margin: 0px;'>
        <div style="height: 300px">

        </div>
        <div style="height: 300px">

        </div>
        <div class='cntainer'>
            <br/>
            <table>
                <tr>
                    <td class="hed">FLAT NO.CF.6-102,AISHWARYA NAGAR,THAIKATTUKARA.P.O,ALUVA - 683 106</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td colspan='2'>
                        <table border="1">
                            <tr>
                                <td class="left">Consignor:</td>
                                <td colspan='2'><?= $consiner['Name'] ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan='2'><?= $consiner['address_line1'] ?></td>
                            </tr>
                            <tr>
                                <td class="left">PAN</td>
                                <td colspan='2'><?= $consiner['pan'] ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>Ref.Inv.No</td>
                                <td>Invoice .Value	</td>
                                <td>QTY IN BOXES</td>
                            </tr>
                            <tr>
                                <td><?= $salse['refinno'] ?></td>
                                <td><?= $salse['invoicevalue'] ?></td>
                                <td><?= $salse['qtyinbox'] ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td class="left">Consignee:</td>
                                <td colspan='2'><?= $Consignee['Name'] ?></td>
                            </tr>
                            <tr>
                                <td class="left">PAN</td>
                                <td colspan='2'><?= $Consignee['pan'] ?></td>
                            </tr> 
                        </table>
                    </td>
                    <td colspan='2'>
                        <table border="1">
                            <tr>
                                <td>Consignor:</td>
                                <td colspan='2'><?= $consiner['Name'] ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan='2'><?= $consiner['address_line1'] ?></td>
                            </tr> 
                            <tr>
                                <td>PAN</td>
                                <td colspan='2'><?= $consiner['pan'] ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td class="center">Ref.Inv.No</td>
                                <td class="center">Invoice .Value </td>
                                <td class="center">QTY IN BOXES </td>
                            </tr>
                            <tr>
                                <td><?= $salse['refinno'] ?></td>
                                <td><?= $salse['invoicevalue'] ?></td>
                                <td><?= $salse['qtyinbox'] ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td class="center">Consignee:</td>
                                <td colspan='2'><?= $Consignee['Name'] ?></td>
                            </tr>
                            <tr>
                                <td class="center">PAN:</td>
                                <td colspan='2'><?= $Consignee['pan'] ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan='2' class="hed" >
                        <br/>
                        OCEAN INVOICE 
                    </td>
                    <td colspan='2'  class="hed">
                        <br/>
                        ROAD TRANSPORT INVOICE CUM CONSIGMENT NOTE
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <table border="1">
                            <tr>
                                <td>Invoice No </td>
                                <td>SEA	<?= $salse['invoice'] ?></td>
                                <td>Date :</td>
                                <td><?= $salse['s_date'] ?></td>
                            </tr>
                            <tr>
                                <td>Container No </td>
                                <td><?= $salse['container'] ?></td>


                                <td>Serial No</td>
                                <td>Ref.LR.No</td>
                            </tr>

                            <tr>
                                <td>Cargo Wt/MT </td>
                                <td>Commidities</td>
                                <td>Size</td>
                                <td>Delivery</td>
                            </tr>
                            <tr>
                                <td>28</td>
                                <td><?= $salse['commidities'] ?></td>
                                <td>20'</td>
                                <td>PORT</td>
                            </tr>
                            <tr>
                                <td>POL </td>
                                <td>MUNDRU</td>
                                <td>POD</td>
                                <td>KOCHI</td>
                            </tr>
                            <tr>
                                <td>Vessel </td>
                                <td></td>
                                <td>V.Code</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                    <td colspan='2'>

                        <table border="1">
                            <tr>
                                <td>CN.NO. </td>
                                <td>GTA	<?= $salse['invoice'] ?></td>
                                <td>Date :</td>
                                <td><?= $salse['s_date'] ?></td>
                            </tr>
                            <tr>
                                <td>Container No </td>
                                <td><?= $salse['container'] ?></td>


                                <td>Serial No</td>
                                <td>Ref.LR.No</td>
                            </tr>

                            <tr>
                                <td>Cargo Wt/MT </td>
                                <td>Commidities</td>
                                <td>Size</td>
                                <td>Delivery</td>
                            </tr>
                            <tr>
                                <td>28</td>
                                <td>TILES</td>
                                <td>20'</td>
                                <td>PORT</td>
                            </tr>
                            <tr>
                                <td>From </td>
                                <td></td>
                                <td>From</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Truck No </td>
                                <td></td>
                                <td>Truck No</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'  class="hed">
                        <br/>
                        OCEAN FREIGHT DETAILS</td>
                    <td colspan='2'  class="hed">
                        <br/>
                        GTA ROAD FREIGHT </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <table border="1">
                            <tr>
                                <td colspan='2' style="width: 60%">PARTICULARS </td>
                                <td style="width: 20%">Rs</td>
                                <td style="width: 20%">Rs</td>
                            </tr>
                            <tr>
                                <td colspan='2'>Transport of goods in a Coastal Vessel </td>
                                <td class="right"><?= getval($oc, 'schr1') ?></td>
                                <td class="right"><?= getval($oc, 'schr1') ?></td>
                            </tr>
                            <tr>
                                <td colspan='2'>Less :Abatement @ 70% As per Sl No.10 of Notification No.26/2012-ST Net Taxable Value</td>
                                <td class="right"><?= getval($oc, 'schr3') ?></td>
                                <td></td>
                            </tr>	
                            <tr>
                                <td  colspan='2'>IGST</td>
                                <td></td>
                                <td class="right"><?= getval($oc, 'tax22') ?></td>
                            </tr>
                            <tr>
                                <td  colspan='2'>CGST	 </td>
                                <td></td>
                                <td class="right"><?= getval($oc, 'tax12') ?></td>
                            </tr>

                            <tr>
                                <td  colspan='2'>SGST</td>
                                <td></td>
                                <td class="right"><?= getval($oc, 'tax32') ?></td>
                            </tr>
                            <tr>
                                <td  colspan='2'>Total Payable </td>
                                <td></td>
                                <td class="right"><?= getval($oc, 'tot2') ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>RUPEES:<?php
                                    $sm = getval($oc, 'tot2');
                                    echo Show_Amount_In_Words($sm);
                                    ?></td>

                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>PAN </td>
                                <td>BAOPT2648N</td>
                                <td>GSTIN</td>
                                <td>32BAOPT2648N1Z1</td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>CATEGORY </td>
                                <td  colspan='3'>Transport of Coastal Goods & Goods through Inlan</td>
                            </tr>
                        </table>
                    </td>
                    <td colspan='2'>
                        <table border="1">
                            <tr>
                                <td colspan='2' style="width: 60%">PARTICULARS </td>
                                <td style="width: 20%">Rs</td>
                                <td style="width: 20%">Rs</td>
                            </tr>
                            <tr>
                                <td colspan='2'>Transport of goods in a Coastal Vessel </td>

                                <td class="right"><?= getval($oc, 'schr5') ?></td>
                                <td class="right"><?= getval($oc, 'schr5') ?></td>
                            </tr>
                            <tr>
                                <td colspan='2'>Less :Abatement @ 70% As per Sl No.10 of Notification No.26/2012-ST        Net Taxable Value</td>
                                <td class="right"><?= getval($oc, 'schr6') ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td  colspan='2'>IGST</td>

                                <td></td>
                                <td class="right"><?= getval($oc, 'tax24') ?></td>
                            </tr>
                            <tr>
                                <td  colspan='2'>CGST	 </td>

                                <td></td>
                                <td class="right"><?= getval($oc, 'tax14') ?></td>
                            </tr>

                            <tr>
                                <td  colspan='2'>SGST</td>

                                <td></td>
                                <td class="right"><?= getval($oc, 'tax34') ?></td>
                            </tr>
                            <tr>
                                <td  colspan='2'>Total Payable </td>

                                <td></td>
                                <td class="right"><?= getval($oc, 'tot4') ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>RUPEES:<?php
                                    $sm = getval($oc, 'tot4');
                                    echo Show_Amount_In_Words($sm);
                                    ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>PAN </td>
                                <td>BAOPT2648N</td>
                                <td>GSTIN</td>
                                <td>32BAOPT2648N1Z1</td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>CATEGORY </td>
                                <td  colspan='3'>Transport of Coastal Goods & Goods through Inlan</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'  class="hed">
                        <br/>
                        INVOICE FOR OTHER CHARGES
                    </td>
                    <td colspan='2'  class="hed">
                        <br/>TOTAL PAYMENT DETAILS
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <table border="1">
                            <tr>
                                <td>Invoice No </td>
                                <td>BAS	 <?= $salse['invoice'] ?></td>
                                <td>Date :</td>
                                <td><?= $salse['s_date'] ?></td>
                            </tr>
                            <tr>
                                <td>POL </td>
                                <td></td>
                                <td>POD</td>
                                <td></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td >CONSIGNOR </td>
                                <td colspan='3'></td>
                            </tr>	
                            <tr>
                                <td>CONSIGNEE </td>
                                <td colspan='3'></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td colspan='4' style="text-align: center">Other Charges Details</td>
                            </tr>
                        </table>
                        <table border="1">

                            <tr>
                                <td colspan='3'>Particulars </td>

                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='3'>LTHC </td>

                                <td class="right"><?= getval($oc, 'schr8') ?></td>
                            </tr>
                            <tr>
                                <td colspan='3'>DTHC </td>                           
                                <td class="right"><?= getval($oc, 'schr9') ?></td>
                            </tr>
                            <tr>
                                <td colspan='3'>CORC </td>
                                <td  class="right"><?= getval($oc, 'schr10') ?></td>

                            </tr>
                            <tr>
                                <td colspan='3'>BLDC </td>
                                <td  class="right"><?= getval($oc, 'schr11') ?></td>

                            </tr>
                            <tr>
                                <td colspan='3'>ICDOC </td>
                                <td class="right"><?= getval($oc, 'schr12') ?></td>

                            </tr>
                            <tr>
                                <td colspan='3'>Other Charges </td>
                                <td  class="right"><?= getval($oc, 'schr13') ?></td>

                            </tr>
                            <tr>
                                <td colspan='3'>Total Charges   </td>
                                <td  class="right"><?= getval($oc, 'schr7') ?></td>

                            </tr>
                            <tr>
                                <td colspan='3'>IGST  </td>
                                <td  class="right"><?= getval($oc, 'tax27') ?></td>

                            </tr>
                            <tr>
                                <td colspan='3'>CGST </td>
                                <td  class="right"><?= getval($oc, 'tax17') ?></td>

                            </tr>

                            <tr>
                                <td colspan='3'>SGST </td>
                                <td class="right"><?= getval($oc, 'tax37') ?></td>

                            </tr>
                            <tr>
                                <td colspan='3'>TTL Charges (Rs) </td>
                                <td class="right"><?= getval($oc, 'tot7') ?></td>

                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>RUPEES:<?php
                                    $sm = getval($oc, 'tot7');
                                    echo Show_Amount_In_Words($sm);
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>PAN </td>
                                <td>BAOPT2648N</td>
                                <td>GSTIN</td>
                                <td>32BAOPT2648N1Z1</td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>CATEGORY </td>
                                <td  colspan='3'>CATEGORY	Business Auxillary Services</td>
                            </tr>
                        </table>
                    </td>
                    <td colspan='2'>
                        <table border="1">
                            <tr>
                                <td colspan='4'>Dear Sir,		 </td>
                            </tr>
                            <tr>
                                <td colspan='4'>Please acknowlegment this 3 Invoices and pay the amount as per the 				
                                    following details:</td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td>Ocean Invoice </td>
                                <td>Road Trasport </td>
                                <td>Other Charges</td>
                                <td>Total</td>
                            </tr>
                            <tr>
                                <td>Amount </td>
                                <td>Invoice Amt</td>
                                <td>Invoice Amt</td>
                                <td></td>
                            </tr> 
                            <tr style="background-color: #FF7E00">
                                <td class="right"><?= getval($oc, 'tot2') ?></td>
                                <td class="right"><?= getval($oc, 'tot4') ?></td>
                                <td class="right"><?= getval($oc, 'tot7') ?></td>
                                <td class="right"><?php
                                    $tot7 = getval($oc, 'tot7');
                                    $tot2 = getval($oc, 'tot2');
                                    $tot4 = getval($oc, 'tot4');
                                    $gt = $tot4 + $tot7 + $tot2;
                                    echo number_format($gt, 2);
                                    ?>

                                </td>
                            </tr>
                            <tr  style="background-color: #FF7E00">
                                <td colspan='2'>Other Charges </td>
                                <td></td>
                                <td></td>
                                <td class="right"> <?= $salse['aditon'] ?></td>
                            </tr>
                            <tr style="background-color: #FF7E00">
                                <td colspan='2'>Discount </td>
                                <td></td>
                                <td></td>
                                <td class="right"><?= $salse['substration'] ?></td>
                            </tr>

                            <tr style="background-color: #FF7E00">
                                <td colspan='2'>Round off </td>
                                <td></td>
                                <td></td>
                                <td class="right"><?= $salse['round'] ?></td>
                            </tr>
                            <tr style="background-color: #FF7E00">
                                <td colspan='2'>Total Payable </td>
                                <td></td>
                                <td></td>
                                <td class="right"><?= $salse['gtotal'] ?></td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td colspan='4'>RUPEES:<?php
                                    echo Show_Amount_In_Words($salse['gtotal']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='4'>Bank Details </td>
                            </tr>
                            <tr>
                                <td colspan='4'>STATE BANK OF INDIA</td>
                            </tr>
                            <tr>
                                <td colspan='4'>67386949520  </td>
                            </tr>
                            <tr>
                                <td colspan='4'>SBIN0070122</td>
                            </tr>
                            <tr>
                                <td colspan='4' class="left">MTERIAL RECEIPT</td>
                            </tr>

                            <tr>
                                <td colspan='4' class="left">DATE</td>
                            </tr>
                            <tr>
                                <td colspan='4'>Payment should be made in favour of   GOODWILL LOGISTICS</td>
                            </tr>
                            <tr>
                                <td colspan='4'  style="background-color:  red">Any Query please contact us by Tel.9961277000,9961477000</td>
                            </tr>
                            <tr>
                                <td colspan='4' style="background-color:  red">E-Mail : info@goodwilllogistic.com</td>
                            </tr>
                        </table>
                        <table border="1">
                            <tr>
                                <td colspan='4' style="height: 26px">Remarks</td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>

        </div>
    </body>
</html>