<table cellpadding="0" cellspacing="0" border="0" class=" table table-hover display groceryCrudTable" id="<?php echo uniqid(); ?>">
    <thead>
        <tr>
            <?php foreach ($columns as $column) { ?>
                <th><?php echo $column->display_as; ?></th>
            <?php } ?>
            <?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
                <th class='actions'>
<!--                    <?php// echo $this->l('list_actions'); ?> -->
                </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $num_row => $row) { ?>
            <tr id='row-<?php echo $num_row ?>'>

                <?php
                $res = 0;
                $val = '';
                foreach ($columns as $column) {
                    ?>
                    <td><?php
                        if ($res == 0) {
                            $val = $row->{$column->field_name};
                        }$res++;
                        echo $row->{$column->field_name}
                        ?></td>
                <?php } ?>
                <?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
                    <td class='actions'>
                        <?php
                        if (!empty($row->action_urls)) {
                            foreach ($row->action_urls as $action_unique_id => $action_url) {
                                $action = $actions[$action_unique_id];
                                ?>
                                                                        <!--						<a href="<?php echo $action_url; ?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
                                                                                                                    <span class="ui-button-icon-primary ui-icon <?php echo $action->css_class; ?> <?php echo $action_unique_id; ?>"></span><span class="ui-button-text">&nbsp;<?php echo $action->label ?></span>
                                                                                                                        </a>-->
                                <a href="<?php echo $action_url; ?>" class="btn " role="button">
                                    <span class="glyphicon glyphicon-edit <?php echo $action->css_class; ?> <?php echo $action_unique_id; ?>"></span><span class="ui-button-text">&nbsp;<?php echo $action->label ?></span>
                                </a>

                                <?php
                            }
                        }
                        ?>
                        <?php if (!$unset_read) { ?>

                            <a href="<?php echo $row->read_url ?>" data-toggle="tooltip" title="<?php echo $this->l('list_view'); ?>"  class="btn btn-info" role="button">
                                <span class="glyphicon glyphicon-eye-open"></span>
            <!--                                <span class="ui-button-text">&nbsp;<?php echo $this->l('list_view'); ?></span>-->
                            </a>
                        <?php } ?>

                        <?php if (!$unset_edit) { ?>
                            <a href="<?php echo $row->edit_url ?>" data-toggle="tooltip" title="<?php echo $this->l('list_edit'); ?>"  class="btn btn-success" role="button">
                                <span class="glyphicon glyphicon-edit"></span>
            <!--                                <span class="ui-button-text">&nbsp;<?php echo $this->l('list_edit'); ?></span>-->
                            </a>
                        <?php } ?>
                        <?php if (!$unset_delete) { ?>
                            <a data-toggle="tooltip" title="<?php echo $this->l('list_delete'); ?>"  onclick = "javascript: return delete_row('<?php echo $row->delete_url ?>', '<?php echo $num_row ?>', '<?php echo $val; ?>')"
                               class="btn btn-danger" role="button">
                                <span class="glyphicon glyphicon-remove-sign "></span>
            <!--                                <span class="ui-button-text">&nbsp;<?php echo $this->l('list_delete'); ?></span>-->
                            </a>
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
<!--    <tfoot>
        <tr>
    <?php foreach ($columns as $column) { ?>
                                            <th><input type="text" name="<?php echo $column->field_name; ?>" placeholder="<?php echo $this->l('list_search') . ' ' . $column->display_as; ?>" class="search_<?php echo $column->field_name; ?>" /></th>
    <?php } ?>
    <?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
                                            <th>
                                                <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only floatR refresh-data" role="button" data-url="<?php echo $ajax_list_url; ?>">
                                                    <span class="ui-button-icon-primary ui-icon ui-icon-refresh"></span><span class="ui-button-text">&nbsp;</span>
                                                </button>
                                                <a href="javascript:void(0)" role="button" class="clear-filtering ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary floatR">
                                                    <span class="ui-button-icon-primary ui-icon ui-icon-arrowrefresh-1-e"></span>
                                                    <span class="ui-button-text"><?php echo $this->l('list_clear_filtering'); ?></span>
                                                </a>
                                            </th>
    <?php } ?>
        </tr>
    </tfoot>-->
</table>
<script type="text/javascript">
    $('.groceryCrudTable').DataTable({
        "language": lan
    });
</script>