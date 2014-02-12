<?php

function smarty_modifier_decorate($value, array $parameters = null) {
    static $decorators = array();

    if (!$parameters) {
        return $value;
    }

    $type = array_shift($parameters);
    if (!$type || !is_string($type)) {
        return '<span class="error">Could not decorate value: invalid decorator type provided</span>';
    }

    if (isset($decorators[$type])) {
        global $system;

        $decorators[$type] = $system->getDependencyInjector()->get('pallo\\library\\decorator\\Decorator', $type);
    }

    return $decorators[$type]->decorate($value);
}