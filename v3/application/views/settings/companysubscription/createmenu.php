<script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css"  href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css"/>
<script src="<?php echo base_url(); ?>assets/src/js/jquery.tree.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/src/css/jquery.tree.css" rel="stylesheet" type="text/css"/>
<form method="post" home="<?php echo site_url('main/members/index'); ?>"  back="<?php echo site_url('settings/SubscriptionMenuTypes/add'); ?>"   action="<?php echo site_url('settings/SubscriptionMenuTypes/save'); ?>"  class="form-horizontal has-validation-callback">  
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example-0').tree({
            });
        });


        // function checkmenuStatus() {

        //     var type = $("#type").val();

        //     $.ajax({
        //         type: 'post',
        //         url: '<?php echo site_url('Ajaxcall/check_code/'); ?>',
        //         data: {type: type},
        //         success: function (msg) {
        //             if (msg.indexOf('value does exist') > -1)
        //                 $('#msg').html('<span style font-color="red";">' + msg + "</span>");

        //         }
        //     });
        // }
    </script>

    <?php
    $output = array_filter($list, function($object) {
        return ($object['Url'] == '');
    });

    function getchild($list, $val) {
        $filter_rules = array(
            'parent' => $val
        );

        $filter = function ($player) use ($filter_rules) {
            foreach ($filter_rules as $rulekey => $rulevalue) {
                if ($player[$rulekey] != $rulevalue) {
                    return false;
                }
            }
            return true;
        };

        $filtered = array_filter($list, $filter);
        return $filtered;
    }
    ?>

    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">

                        <h3 class="box-title">Menu To Subscription</h3>

                    </div>
                    <div class="box-body">
                        <div id="accordion"> 
                            <div id="example-0"> 


                                <div id="msg">

                                    <div class="col-sm-2" id="name_input_box">
                                        <select name="subcription" data-validation="required" id="subcription" data-validation="required"  class="form-control" >
                                            <option value="">Select</option>
                                            <?php foreach ($drs as $type) { ?>
                                            <option value="<?php echo $type['id']; ?>" selected><?php echo $type['subcription_name']; ?>
                                                </option>                                        
                                            <?php } ?>
                                        </select>

                                    </div> 
                                    </li>
                                    <ul>
                                        <div class="box-body" id="dynamic">


                                        </div>
                                        </li>
                                        <?php foreach ($output as $item) { ?>
                                            <li>
                                                <?php
                                        if ($item['id'] == $item['menu_id']) {
                                            $params = 'checked="checked"'; 
                                        } else {
                                            $params = ''; 
                                        }
                                        ?> 
                                                <input type="checkbox"  <?php echo $params; ?> name="chk[]" value="<?php echo $item['id'] ?>"><span><?php echo $item['ListName'] ?></span>
                                                <br/>
                                                <?php
                                                $aisl = getchild($list, $item['id']);
                                                if (count($aisl) > 0) {
                                                    ?>
                                                    <ul>
                                                        <?php foreach ($aisl as $chi) { ?>

                                                        <?php }
                                                        ?>
                                                    </ul>


                                                    <?php
                                                }
                                            }
                                            ?>
                                            <input type="submit" name="submit" value="Submit">  
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>