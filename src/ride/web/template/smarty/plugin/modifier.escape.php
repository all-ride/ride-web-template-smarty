<?php

function smarty_modifier_escape($value) {
    if ($value) {
        return htmlspecialchars($value);
    }
}
