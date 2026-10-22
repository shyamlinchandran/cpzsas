<html>
    <style>

        p{
            font-style: italic;
            font-family:fantasy;
        }
        td{
            font-style: italic;
            font-family:fantasy;
        }
        td.name:before {
            clip: rect(0px, 190px, 20px, 0px);
            content: " ............................................................ ";
            position: absolute;
            z-index: -1;
        }
        u {    
            border-bottom: 1px dotted #000;
            text-decoration: none;
        }

    </style>
    <body>
        <div class="double-border" style="padding: 0px;margin: 5;height: 750px !important;">
            <p style="margin: 0; padding: 0px;text-align: center;"><font style="padding: 12px;text-align:right"> <?php echo $company['phone'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></font><br /><font style="font-size: 40px;font-weight: bold;color: brown"><?php echo $company['name'] ?></font><br />
                <font style="color:black;font-size: 18px;">(UNDER THE HOLY APOSTOLIC SEE OF ANTIOCH & ALL THE EAST)</font> <br />
                <font  style="color:black;font-size: 20px;font-weight: bold">ANGAMALY DIOCESE</font><br />
                <font style="color:brown;font-size: 28px;font-weight: bold"><?php echo $company['address'] ?></font><br />
            <table style="padding-left:20px;padding-bottom: 1px;padding-top: 0px;">
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
            <table style="width: 100%;padding-left:20px;padding-right: 0px;padding-bottom: 1px;padding-top: 0px;">
                <tr style="width:100%">
                    <td style="text-align:right"><div style="font-size: 20px;text-align: center;border:1px solid black;background-color: red; border-radius: 25px;">Certificate of Marriage</div></td>
                </tr>
                <tr  style="width:100%">
                    <td class="name" style=" overflow: hidden; white-space: nowrap;width:100%;font-size: 20px;text-align:center">
                        This is to certify that the marriage of <span class="dottedUnderline">  <b> <?php echo ucfirst(strtolower($married['bridegrname'])); ?> </b></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left;font-size: 20px" >
                        S/o <b><?php echo ucfirst(strtolower($married['dadaname'])); ?> </b>
                    </td>

                </tr>
                <tr>
                    <td style="font-size: 20px;text-align: left">
                        and Mrs.<b><?php echo ucfirst(strtolower($married['bridename'])); ?></b>
                    </td>

                </tr>
                <tr>
                    <td style="font-size: 20px;text-align: left" >
                        d/o <b><?php echo ucfirst(strtolower($married['dadbname'])); ?> </b>
                    </td>

                </tr>
                <tr>
                    <td style="font-size: 20px;text-align: left">
                        the ...................................... Day of.......................in the year  <b>was solemnized at this church on</b>
                    </td>

                </tr>
                <tr>
                    <td style="font-size: 20px;text-align: left">
                        (...........................)  as per the parish Marriage Register
                    </td>

                </tr>
            </table>
        </p>

    </div> 
</body>

</html>