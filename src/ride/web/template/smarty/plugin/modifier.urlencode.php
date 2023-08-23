<?php


function smarty_modifier_urlencode($value) {
    if ($value) {
        return urlencode($value);
    }
}
