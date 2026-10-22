<html>
    <style>
/*        .double-border {
            border-style: double;
            display: block;
            clear: both;
            background: red;
            border: 5px solid brown;
            outline: 5px solid blue;
            transition: 0.7s all ease-in;
            height: 50px;
            width: 50px;
        }*/
        p{
            font-style: italic;
            font-family:fantasy;
        }
        td{
            font-style: italic;
            font-family:fantasy;
        }
        

    </style>
    <body>
<!--<img src="<?php echo base_url()?>assets/images/background1.jpg" width="791" height="1105">-->
        <div class="double-border"  style="padding: 12px;margin: 5;height: 750px !important;">
            <p style="margin: 0; padding: 2px;text-align: center;"><font style="padding: 12px;text-align:right"> <?php echo $company['phone'].''; ?></font><br /><font style="font-size: 35px;font-weight: bold;color: brown"><?php echo $company['name'] ?></font><br />
                <font style="color:black;font-size: 18px;">(UNDER THE HOLY APOSTOLIC SEE OF ANTIOCH & ALL THE EAST)</font> <br />
                <font  style="color:black;font-size: 18px;font-weight: bold">ANGAMALY DIOCESE</font><br />
                <font style="color:brown;font-size: 25px;font-weight: bold"><?php echo $company['address'] ?></font><br />
            <table style="padding:15px;">
                <tr>
                    <td style="font-size: 20px;text-align: left">
                        Ref No : ......................
                    </td>
                    <td style="font-size: 20px;text-align: right    ">
                        No  :............
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 20px;text-align: left">
                    </td>
                    <td style="font-size: 20px;text-align: right    ">
                        Date:............
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 25%;"></td>
                    <td color="brown"  style="background-color: red;border-radius: 25px;border:1px solid black;width: 50%;align-content:center"><div style="font-size: 25px;text-align: center; ">CERTIFICATION OF BAPTISM</div></td>
                    <td style="width: 25%;"></td>
                </tr>
            </table>
        </p>

        <table style="padding-left:25px;padding-bottom: 15px;padding-top: 15px;margin: 0px;">
            <tr>
                <td style="font-size: 20px;width: 40%;">Name of person baptised </td>
                <td style="text-align: left;font-size: 20px;width: 50%;">: <b> <?php echo ucfirst(strtolower($baptised['kidname'])); ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 20px;width: 40%;">Address </td>
                <td style="font-size: 20px;width: 55%;">: <b> <?php echo ucfirst(strtolower($baptised['address'])); ?></b></td>
            </tr>
           
            <tr>
                <td style="font-size: 20px;width: 40%;">Gender </td>
                <td style="font-size: 20px;width: 55%;">:<b> <?php echo ucfirst(strtolower($baptised['child_gender'])); ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 20px;width: 40%;">Place Of Birth </td>
                <td style="font-size: 20px;width: 55%;">:<b> <?php echo ucfirst(strtolower($baptised['place_of_birth'])); ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 20px;width: 40%;">Date Of Birth </td>
                <td style="font-size: 20px;width: 55%;">:<b> <?php echo ucfirst(strtolower($baptised['birthdate'])); ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 20px;width: 40%;">Name & Address of Father </td>
                <td style="font-size: 20px;width: 55%;">:<b> <?php echo ucfirst(strtolower($baptised['dadname'])); ?> ,  <?php echo ucfirst(strtolower($baptised['hed_housename'])); ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 20px;width: 40%;"> </td>
                <td style="font-size: 20px;width: 55%;"><?php
                    if (isset($baptised['post_office'])) {
                        echo '  ' . ucfirst(strtolower($baptised['post_office'])) . ' P.O';
                    } if (isset($baptised['post_office'])) {
                        echo '  ,' . ucfirst(strtolower($baptised['pincode']));
                    }
                    ?></td>
            </tr>
            <tr>
                <td style="font-size: 20px;width: 40%;">Name of Mother </td>
                <td style="font-size: 20px;width: 55%;">:<b> <?php echo ucfirst(strtolower($baptised['momname'])); ?></b></td>
            </tr>

            <tr>
                <td style="font-size: 20px;width: 40%;"> </td>
                <td style="font-size: 20px;width: 55%;"></td>
            </tr>
        </table>    


    </div>
</body>

</html>