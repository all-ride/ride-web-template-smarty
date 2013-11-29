<?php

function smarty_modifier_translate($string) {
    static $translator;

    if (!$translator) {
        global $system;

        $i18n = $system->getDependencyInjector()->get('pallo\\library\\i18n\\I18n');
        $translator = $i18n->getTranslator();
    }

    return $translator->translate($string);
}