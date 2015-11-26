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

    $queryParameters = null;
    if (!empty($params['query'])) {
        $queryParameters = $params['query'];
        unset($params['query']);
    }

    $querySeparator = '&';
    if (!empty($params['separator'])) {
        $querySeparator = $params['separator'];
        unset($params['separator']);
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

    $router = $app['system']->getDependencyInjector()->get('ride\\library\\router\\Router');
    $url = $router->getRouteContainer()->getUrl($app['url']['script'], $id, $parameters, $queryParameters, $querySeparator);

    if ($var == null) {
        return $url;
    } else {
        $smarty->assign($var, $url);
    }
}
