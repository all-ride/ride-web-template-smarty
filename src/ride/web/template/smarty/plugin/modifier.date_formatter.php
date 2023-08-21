<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifier
 */
/**
 * Smarty date_format modifier plugin
 * Type:     modifier
 * Name:     date_format
 * Purpose:  format datestamps via strftime
 * Input:
 *          - string: input date string
 *          - format: strftime format for output
 *          - default_date: default date if $string is empty
 *
 * @link   https://www.smarty.net/manual/en/language.modifier.date.format.php date_format (Smarty online manual)
 * @author Monte Ohrt <monte at ohrt dot com>
 *
 * @param string $string input date string
 * @param string $format strftime format for output
 * @param string $default_date default date if $string is empty
 * @param string $formatter either 'strftime' or 'auto'
 *
 * @return string |void
 * @uses   smarty_make_timestamp()
 */
function smarty_modifier_date_formatter($string, $format = null) {
    if ($format === null) {
        $format = 'd/m/Y';
    }
    if (empty($string)) {
        $string = time();
    }

    try {
        $dateCarbon = new \Carbon\Carbon($string);
        return $dateCarbon->locale(Locale::getDefault())->isoFormat($format);

    } catch (\Exception $e) {
        return $string;
    }

}