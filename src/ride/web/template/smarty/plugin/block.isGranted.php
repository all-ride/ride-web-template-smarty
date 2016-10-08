<?php

function smarty_block_isGranted($params, $content, &$smarty, &$repeat) {
    if ($repeat) {
        return;
    }

    $isGranted = smarty_block_isGranted_test($params, $smarty);

    if (!empty($params['var'])) {
        $var = $params['var'];

        $smarty->assign($var, $isGranted);
    }

    if (!$isGranted) {
        return;
    }

    return $content;
}

function smarty_block_isGranted_test($params, &$smarty) {
    if (!isset($params['route']) && !isset($params['url']) && !isset($params['permission'])) {
        throw new Exception('No route, URL or permission provided');
    }

    $strategy = 'OR';
    if (isset($params['strategy'])) {
        $strategy = strtoupper($params['strategy']);
    }

    $app = $smarty->getTemplateVars('app');
    if (!isset($app['system'])) {
        trigger_error('System is not set in the app variable.');
    }

    $securityManager = $app['system']->getDependencyInjector()->get('ride\\library\\security\\SecurityManager');

    if ($strategy == 'AND') {
        $isRouteAllowed = true;
        $isUrlAllowed = true;
        $isPermissionGranted = true;
    } else {
        $isRouteAllowed = false;
        $isUrlAllowed = false;
        $isPermissionGranted = false;
    }

    if (isset($params['route'])) {
        $isRouteAllowed = $securityManager->isPathAllowed($params['route']);
    }
    if (isset($params['url'])) {
        $isUrlAllowed = $securityManager->isUrlAllowed($params['url']);
    }
    if (isset($params['permission'])) {
        $isPermissionGranted = $securityManager->isPermissionGranted($params['permission']);
    }

    if ($strategy == 'AND') {
        $isGranted = $isRouteAllowed && $isUrlAllowed && $isPermissionGranted;
    } else {
        $isGranted = $isRouteAllowed || $isUrlAllowed || $isPermissionGranted;
    }

    return $isGranted;
}
