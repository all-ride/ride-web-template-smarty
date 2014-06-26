<?php

use ride\library\StringHelper;

function smarty_modifier_safe($value) {
    return StringHelper::safeString($value);
}
