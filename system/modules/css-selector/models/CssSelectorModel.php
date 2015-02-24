<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2015 Craffft
 *
 * @package CssSelector
 * @link    https://github.com/craffft/contao-css-selector
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Craffft\CSSSelector;

class CssSelectorModel extends \Model
{
    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_css_style_selector';

    public static function findCssClassesByIds(array $arrIds)
    {
        $t = self::strTable;
        $objDatabase = \Database::getInstance();

        $objCssSelector = $objDatabase->prepare("SELECT cssClasses FROM $t WHERE id IN(". implode(',', array_map('intval', array_unique($arrIds))) .")")->execute();

        return $objCssSelector->fetchEach('cssClasses');
    }

    public static function findAllCssClasses()
    {
        $t = self::strTable;
        $objDatabase = \Database::getInstance();

        $objCssSelector = $objDatabase->prepare("SELECT cssClasses FROM $t")->execute();

        return $objCssSelector->fetchEach('cssClasses');
    }
}
