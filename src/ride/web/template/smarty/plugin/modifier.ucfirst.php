<?php


function smarty_modifier_ucfirst($value) {
    if ($value) {
        return ucfirst($value);
    }
}
