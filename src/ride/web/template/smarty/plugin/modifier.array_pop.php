<?php

function smarty_modifier_array_pop($value) {
    if (is_array($value)) {
        return array_pop($value);
    }
}