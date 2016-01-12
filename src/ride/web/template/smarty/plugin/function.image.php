<?php

use ride\library\StringHelper;

function smarty_function_image($params, &$smarty) {
    $src = null;

    try {
        if (empty($params['src']) && empty($params['default'])) {
            throw new Exception('No src parameter provided for the image');
        }

        $transformation = null;
        $var = null;
        $default = null;

        if (isset($params['default'])) {
            $default = $params['default'];
            $src = $default;
            unset($params['default']);
        }
        if (isset($params['src'])) {
            $src = $params['src'];
            unset($params['src']);
        }
        if (isset($params['var'])) {
            $var = $params['var'];
            unset($params['var']);
        }
        if (isset($params['thumbnail'])) {
            $transformation = $params['thumbnail'];
            unset($params['thumbnail']);
        } elseif (isset($params['transformation'])) {
            $transformation = $params['transformation'];
            unset($params['transformation']);
        }

        $app = $smarty->getTemplateVars('app');
        if (!isset($app['system'])) {
            return '<span style="color: red;">Could not load image ' . $src . ': system is not available in the app variable.</span>';
        }

        $dependencyInjector = $app['system']->getDependencyInjector();
        $imageUrlGenerator = $dependencyInjector->get('ride\\library\\image\\ImageUrlGenerator');

        try {
            $src = $imageUrlGenerator->generateUrl($src, $transformation, $params);
        } catch (Exception $exception) {
            $log = $dependencyInjector->get('ride\\library\\log\\Log');

            if ($src != $default && $default) {
                try {
                    $src = $imageUrlGenerator->generateUrl($default, $transformation, $params);
                } catch (Exception $exception) {
                    $log->logException($exception);

                    $src = null;
                }
            } else {
                $log->logException($exception);

                $src = null;
            }
        }

        if ($var) {
            $smarty->assign($var, $src);

            return;
        }

        return $src;
    } catch (Exception $exception) {
        $app = $smarty->getTemplateVars('app');
        if (isset($app['system'])) {
            $log = $app['system']->getDependencyInjector()->get('ride\\library\\log\\Log');
            $log->logException($exception);
        }

        $src = null;

        if (isset($params['var'])) {
            $smarty->assign($params['var'], $src);
        }
    }

    return $src;
}
