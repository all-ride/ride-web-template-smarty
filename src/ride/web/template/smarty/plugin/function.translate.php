<?php

function smarty_function_translate($params, &$smarty) {
    if (empty($params['key'])) {
        throw new Exception('No key found to translate');
    }
    $key = $params['key'];
    unset($params['key']);

    $locale = null;
    if (!empty($params['locale'])) {
        $locale = $params['locale'];
        unset($params['locale']);
    }

    $n = null;
    if (!empty($params['n'])) {
        $n = $params['n'];
        unset($params['n']);
    }

    $var = null;
    if (!empty($params['var'])) {
        $var = $params['var'];
        unset($params['var']);
    }

    $app = $smarty->getTemplateVars('app');
    if (!isset($app['system'])) {
        return '<span style="color: red;">Could not translate ' . $key . ': system is not available in the app variable.</span>';
    }

    $i18n = $app['system']->getDependencyInjector()->get('ride\\library\\i18n\\I18n');
    $translator = $i18n->getTranslator($locale);

    if ($n !== null) {
        $translation = $translator->translatePlural($n, $key, $params);
    } else {
        $translation = $translator->translate($key, $params);
    }

    if ($var == null) {
        return $translation;
    } else {
        $smarty->assign($var, $translation);
    }
}
