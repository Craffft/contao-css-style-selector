<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2015 Craffft
 *
 * @package CssStyleSelector
 * @link    https://github.com/craffft/contao-css-style-selector
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Craffft\CssStyleSelector;

class CssStyleSelectorModel extends \Model
{
    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_css_style_selector';

    public static function findCssClassesByIds(array $arrIds)
    {
        $t = self::$strTable;
        $objDatabase = \Database::getInstance();

        $objCssStyleSelector = $objDatabase->prepare("SELECT cssClasses FROM $t WHERE id IN(". implode(',', array_map('intval', array_unique($arrIds))) .")")->execute();

        return $objCssStyleSelector->fetchEach('cssClasses');
    }

    public static function findAllCssClasses()
    {
        $t = self::$strTable;
        $objDatabase = \Database::getInstance();

        $objCssStyleSelector = $objDatabase->prepare("SELECT cssClasses FROM $t")->execute();

        return $objCssStyleSelector->fetchEach('cssClasses');
    }
}
