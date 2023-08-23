<?php

function smarty_modifier_trim($value) {
    if ($value) {
        return trim($value);
    }
}
