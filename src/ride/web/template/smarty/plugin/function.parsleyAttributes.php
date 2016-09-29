<?php

function smarty_function_parsleyAttributes($params, &$smarty) {
    if (empty($params['attributes'])) {
        throw new Exception('No attributes provided');
    }

    $attributes = $params['attributes'];
    unset($params['attributes']);

    $var = null;
    if (!empty($params['var'])) {
        $var = $params['var'];
        unset($params['var']);
    }

    if (empty($params['validators'])) {
        if ($var) {
            $smarty->assign($var, $url);
        }

        return;
    }

    $validators = $params['validators'];
    unset($params['validators']);

    $type = null;
    if (!empty($params['type'])) {
        $type = $params['type'];
        unset($params['type']);
    }

    foreach ($validators as $validator) {
        $options = $validator->getOptions();
        $class = get_class($validator);

        switch ($class) {
            case 'ride\\library\\validation\\validator\\EmailValidator':
                $attributes['data-parsley-type'] = 'email';

                break;
            case 'ride\\library\\validation\\validator\\MinMaxValidator':
                if (isset($options['minimum']) && isset($options['maximum'])) {
                    $attributes['data-parsley-range'] = '[' . $options['minimum'] . ', ' . $options['maximum'] . ']';
                } elseif (isset($options['minimum'])) {
                    $attributes['min'] = $options['minimum'];
                } elseif (isset($options['maximum'])) {
                    $attributes['max'] = $options['maximum'];
                }

                break;
            case 'ride\\library\\validation\\validator\\NumericValidator':
                if ($type !== 'date') {
                    $attributes['data-parsley-type'] = 'number';
                }

                break;
            case 'ride\\library\\validation\\validator\\RegexValidator':
                if (isset($options['regex'])) {
                    $attributes['pattern'] = $options['regex'];
                }
            case 'ride\\library\\validation\\validator\\SizeValidator':
                if (isset($options['minimum'])) {
                    $attributes['minlength'] = $options['minimum'];
                }
                if (isset($options['maximum'])) {
                    $attributes['maxlength'] = $options['maximum'];
                }

                break;
            case 'ride\\library\\validation\\validator\\WebsiteValidator':
                $attributes['data-parsley-type'] = 'url';

                break;
        }
    }

    if ($var == null) {
        return $attributes;
    } else {
        $smarty->assign($var, $attributes);
    }
}
