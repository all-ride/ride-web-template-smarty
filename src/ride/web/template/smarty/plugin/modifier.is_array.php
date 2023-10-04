<?php

function smarty_modifier_is_array($object) {
    if (is_array($object)) {
        return true;
    }

    return false;
}
