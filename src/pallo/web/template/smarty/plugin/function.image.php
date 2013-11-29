<?php

use pallo\library\String;

function smarty_function_image($params, &$smarty) {
    try {
        if (empty($params['src']) && empty($params['default'])) {
            throw new Exception('No src parameter provided for the image');
        }

        if (isset($params['src'])) {
            $src = $params['src'];
        } else {
            $src = $params['default'];
            unset($params['default']);
        }

        $thumbnailer = null;
        $width = 0;
        $height = 0;
        $html = null;

        $params['src'] = $src;
        if (!empty($params['thumbnail'])) {
            if (!isset($params['width'])) {
                $width = 0;
            } elseif (empty($params['width'])) {
                throw new Exception('Invalid width parameter provided for the thumbnailer');
            } else {
                $width = $params['width'];
                unset($params['width']);
            }

            if (!isset($params['height'])) {
                $height = 0;
            } elseif (empty($params['height'])) {
                throw new Exception('Invalid height parameter provided for the thumbnailer sqljfqmlskdjf');
            } else {
                $height = $params['height'];
                unset($params['height']);
            }

            $thumbnailer = $params['thumbnail'];
            unset($params['thumbnail']);
        }

        $src = new String($src);
        if (!$src->startsWith(array('http://', 'https://'))) {
            $app = $smarty->getTemplateVars('app');
            if (!isset($app['system'])) {
                return '<span style="color: red;">Could not load image ' . $src . ': system is not available in the app variable.</span>';
            }

            $imageUrlGenerator = $app['system']->getDependencyInjector()->get('pallo\\library\\image\\ImageUrlGenerator');
            $src = $imageUrlGenerator->generateUrl((string) $src, $thumbnailer, $width, $height);

            $params['src'] = $src;
        }

        if (isset($params['var'])) {
            $smarty->assign($params['var'], $src);

            return;
        }

        $html = '<img';
        foreach ($params as $key => $value) {
            if ($value == '') {
                continue;
            }

            $html .= ' ' . $key . '="' . $value . '"';
        }

        $html .=  ' />';
    } catch (Exception $exception) {
        $app = $smarty->getTemplateVars('app');
        if (isset($app['system'])) {
            $log = $app['system']->getDependencyInjector()->get('pallo\\library\\log\\Log');
            $log->logException($exception);
        }

        if (isset($params['var'])) {
            $smarty->assign($params['var'], $src);
        } else {
            $html = '<span style="color: red;">Could not load image: ' . $src . '</span>';
        }
    }

    return $html;
}