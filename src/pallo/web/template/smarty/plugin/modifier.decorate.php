<?php

function smarty_modifier_decorate($value, $type = null) {
    static $decorators = array();

    if (!$type || !is_string($type)) {
        return '<span class="error">Could not decorate value: invalid decorator type provided</span>';
    }

    if (!isset($decorators[$type])) {
        global $system;

        $decorators[$type] = $system->getDependencyInjector()->get('pallo\\library\\decorator\\Decorator', $type);
    }

    return $decorators[$type]->decorate($value);
}