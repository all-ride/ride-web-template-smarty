<?php

function smarty_block_isNotGranted($params, $content, &$smarty, &$repeat) {
    if ($repeat) {
        return;
    }

    $isGranted = smarty_block_isGranted_test($params, $smarty);

    if (!empty($params['var'])) {
        $var = $params['var'];

        $smarty->assign($var, !$isGranted);
    }

    if ($isGranted) {
        return;
    }

    return $content;
}
