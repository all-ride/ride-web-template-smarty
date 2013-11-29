<?php

function smarty_function_translate($params, &$smarty) {
    if (empty($params['key'])) {
        throw new Exception('No key found to translate');
    }
    $key = $params['key'];
    unset($params['key']);

    $var = null;
    if (!empty($params['var'])) {
        $var = $params['var'];
        unset($params['var']);
    }

    $translator = $smarty->getTemplateVars('translator');
    if (!$translator) {
        $app = $smarty->getTemplateVars('app');
        if (!isset($app['system'])) {
            return '<span style="color: red;">Could not translate ' . $key . ': system is not available in the app variable.</span>';
        }

        $i18n = $app['system']->getDependencyInjector()->get('pallo\\library\\i18n\\I18n');
        $translator = $i18n->getTranslator();

        $smarty->assign('translator', $translator);
    }

    $translation = $translator->translate($key, $params);

    if ($var == null) {
        return $translation;
    } else {
        $smarty->assign($var, $translation);
    }
}