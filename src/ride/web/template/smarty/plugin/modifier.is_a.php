<?php

function smarty_modifier_is_a($object, $class) {
    if (is_a($object, $class)) {
        return true;
    }
    
    return false;
}
