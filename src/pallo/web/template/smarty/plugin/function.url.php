<?php

function smarty_function_url($params, &$smarty) {
    if (empty($params['id'])) {
        throw new Exception('No id provided');
    }

    $id = $params['id'];
    unset($params['id']);

    $parameters = null;
    if (!empty($params['parameters'])) {
        $parameters = $params['parameters'];
        unset($params['parameters']);
    }

    $var = null;
    if (!empty($params['var'])) {
        $var = $params['var'];
        unset($params['var']);
    }

    $app = $smarty->getTemplateVars('app');
    if (!isset($app['system'])) {
        return '<span style="color: red;">Could not get URL for ' . $id . ': system is not available in the app variable.</span>';
    }

    $router = $app['system']->getDependencyInjector()->get('pallo\\library\\router\\Router');
    $url = $router->getRouteContainer()->getUrl($app['url']['script'], $id, $parameters);

    if ($var == null) {
        return $url;
    } else {
        $smarty->assign($var, $url);
    }
}