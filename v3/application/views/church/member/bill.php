<html>
    <style>
        .double-border {
            border-style: double;
            display: block;
            clear: both;
            background: red;
            border: 5px solid brown;
            outline: 5px solid blue;
            transition: 0.7s all ease-in;
            height: 50px;
            width: 50px;
        }
        p{
            font-style: italic;
            font-family:fantasy;
        }
        td{
            font-style: italic;
            font-family:fantasy;
        }

    </style>
        <div  class="double-border" style="padding: 4px;margin: 5;height: 750px !important;">
    <body>
            <p style="margin: 0; padding: 5px;text-align: center;"><font style="padding: 12px;text-align:right"> <?php echo $company['phone'].'&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      .'; ?></font><br /><font style="font-size: 40px;font-weight: bold;color: brown"><?php echo $company['name'] ?></font><br />
                <font style="color:black;font-size: 18px;">(UNDER THE HOLY APOSTOLIC SEE OF ANTIOCH & ALL THE EAST)</font> <br />
                <font  style="color:black;font-size: 25px;font-weight: bold">ANGAMALY DIOCESE</font><br />
                <font style="color:brown;font-size: 30px;font-weight: bold"><?php echo $company['address'] ?></font><br />
            <table style="padding:18px;">
                <tr>

                    <td style="font-size: 18px;text-align: left    ">
                        No  :............
                    </td>
                    <td></td>
                    <td style="font-size: 18px;text-align: right    ">
                        Date:............
                    </td>
                </tr>
            </table>
            <table style="padding-left:18px;padding-bottom: 10px;padding-top: 10px;">
                <tr>
                    <td style="width: 25%;"></td>
                    <td style="width: 50%;align-content:center"><div style="font-size:20px;font-style: italic;text-align: center;border:1px solid black;background-color: red; border-radius: 35px;">CERTIFICATION OF COMMUNITY</div></td>
                    <td style="width: 25%;"></td>
                </tr>
                <tr>
                    <td style="font-size: 20px;text-align: left" colspan="2">
                        This is to certify that  <b><?php echo $member['name'] ?></b>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-size: 20px;text-align: left" colspan="3">
                       <?php if($member['gender']=='Male'){ echo 'S/o  .';}elseif ($member['gender']=='Female') {
                           echo 'D/o  .'; 
                        }?><b><?php echo $member['father'] ?></b>
                    </td>

                </tr>
                <tr>
                    <td style="font-size: 18px;text-align: left" colspan="3">
                        belongs to Jacobite Syrian Church (Universal Syrian Orthodox Church ) as member of this Pansh
                    </td>

                </tr>
                <br />
            </table>
        </p>

    </div>
</body>

</html>