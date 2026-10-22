<!-- start tree configuration --> 
<script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css"  href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css"/>
<script src="<?php echo base_url(); ?>assets/src/js/jquery.tree.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/src/css/jquery.tree.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript">
    $(document).ready(function () {
        $('#example-0').tree({
        });
    });
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
                    <h3 class="box-title">Menus Create</h3>
                </div>
                <div class="box-body">
                    <div id="accordion"> 
                        <div id="example-0"> 

                            <ul>
                                <?php foreach ($output as $item) { ?>
                                    <li>
                                        <input type="checkbox" name="chk[]" value="<?php echo $item['id'] ?>"><span><?php echo $item['ListName'] ?></span>
                                        <?php
                                        $aisl = getchild($list, $item['id']);
                                        if (count($aisl) > 0) {
                                            ?>
                                            <ul>
                                                <?php foreach ($aisl as $chi) { ?>
                                                    <li><input type="checkbox" name="chk[]" value="<?php echo $item['id'] ?>"><span><?php echo $chi['ListName'] ?></span>
                                                   <br/>
                                                        Read<input type="checkbox" name="chk[]" value="<?php echo $item['id'] ?>">
                                                      Write<input type="checkbox" name="chk[]" value="<?php echo $item['id'] ?>">
                                                      Delete<input type="checkbox" name="chk[]" value="<?php echo $item['id'] ?>">
                                                    </li>
                                                <?php }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
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