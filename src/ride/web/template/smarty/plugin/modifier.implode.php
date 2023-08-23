<?php

function smarty_modifier_implode($array, $glue = ', ') {
    if(empty($array)) return '';

    if(!is_array($array)) return $array;

    return implode($glue, $array);
}
