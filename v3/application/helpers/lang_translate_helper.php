<?php

function label($label, $obj, $db) { 
    $return = $obj->lang->line($label);
    if ($return)
        return $return;
    else
        return $label;
}
