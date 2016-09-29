<?php

function smarty_modifier_parsley(array $attributes, array $validators = null) {
    if (!$validators) {
        return $attributes;
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
                $attributes['data-parsley-type'] = 'number';

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

    return $attributes;
}
