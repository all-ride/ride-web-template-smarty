<?php

function smarty_modifier_in_array($array, $value) {
    if ($value && is_array($array)) {
        return in_array($value, $array);
    }

    return false;
}
