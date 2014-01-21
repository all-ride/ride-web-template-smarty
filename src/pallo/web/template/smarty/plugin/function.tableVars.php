<?php

use pallo\library\html\table\FormTable;

function smarty_function_tableVars($params, &$smarty) {
    $smarty->assign('tableActionField', FormTable::FIELD_ACTION);
    $smarty->assign('tableIdField', FormTable::FIELD_ID);
    $smarty->assign('tableOrderField', FormTable::FIELD_ORDER_METHOD);
    $smarty->assign('tableSearchQueryField', FormTable::FIELD_SEARCH_QUERY);
    $smarty->assign('tablePageRowsField', FormTable::FIELD_PAGE_ROWS);
}