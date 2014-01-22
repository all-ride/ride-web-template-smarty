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

    $securityManager = $app['system']->getDependencyInjector()->get('pallo\\library\\security\\SecurityManager');

    if (isset($params['route'])) {
        if ($securityManager->isPathAllowed($params['route'])) {
            return $content;
        }
    } elseif (isset($params['url'])) {
        if ($securityManager->isUrlAllowed($params['url'])) {
            return $content;
        }
    } elseif ($securityManager->isPermissionGranted($params['permission'])) {
        return $content;
    }

    return;
}