<?php

function smarty_block_isGranted($params, $content, &$smarty, &$repeat) {
    if ($repeat) {
        return;
    }

    if (!isset($params['route']) && !isset($params['url']) && !isset($params['permission'])) {
        throw new Exception('No route, URL or permission provided');
    }

    $app = $smarty->getTemplateVars('app');
    if (!isset($app['system'])) {
        trigger_error('System is not set in the app variable.');
    }

    $securityManager = $app['system']->getDependencyInjector()->get('ride\\library\\security\\SecurityManager');

    $var = null;
    if (!empty($params['var'])) {
        $var = $params['var'];

        $smarty->assign($var, false);
    }

    if (isset($params['route']) && !$securityManager->isPathAllowed($params['route'])) {
        return;
    }
    if (isset($params['url']) && !$securityManager->isUrlAllowed($params['url'])) {
        return;
    }
    if (isset($params['permission']) && !$securityManager->isPermissionGranted($params['permission'])) {
        return;
    }

    if ($var) {
        $smarty->assign($var, true);
    }

    return $content;
}
