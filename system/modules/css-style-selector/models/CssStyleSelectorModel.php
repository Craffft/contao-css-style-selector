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
    const TYPE_ARTICLE = 'article';
    const TYPE_CONTENT = 'content';
    const TYPE_LAYOUT = 'layout';
    const TYPE_NEWS = 'news';
    const TYPE_MODEL = 'module';
    const TYPE_PAGE = 'page';

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_css_style_selector';

    public static function getAvailableTypes()
    {
        return array(
            self::TYPE_ARTICLE,
            self::TYPE_CONTENT,
            self::TYPE_LAYOUT,
            self::TYPE_NEWS,
            self::TYPE_MODEL,
            self::TYPE_PAGE
        );
    }

    /**
     * @param array $arrIds
     * @return array
     */
    public static function findCssClassesByIds(array $arrIds)
    {
        $t = self::$strTable;
        $objDatabase = \Database::getInstance();

        $objCssStyleSelector = $objDatabase->prepare("SELECT cssClasses FROM $t WHERE id IN(". implode(',', array_map('intval', array_unique($arrIds))) .")")->execute();

        return $objCssStyleSelector->fetchEach('cssClasses');
    }

    /**
     * @param $strType
     * @return array
     */
    public static function findCssClassesByNotDisabledType($strType)
    {
        if (!in_array($strType, self::getAvailableTypes())) {
            return array();
        }

        $t = self::$strTable;
        $objDatabase = \Database::getInstance();

        $objCssStyleSelector = $objDatabase
            ->prepare("SELECT cssClasses FROM $t WHERE disableIn" . ucfirst($strType) . "=?")
            ->execute(0);

        return $objCssStyleSelector->fetchEach('cssClasses');
    }

    /**
     * @param $strType
     * @return array
     */
    public static function findStyleDesignationByNotDisabledType($strType)
    {
        if (!in_array($strType, self::getAvailableTypes())) {
            return array();
        }

        $t = self::$strTable;
        $objDatabase = \Database::getInstance();

        $objCssStyleSelector = $objDatabase
            ->prepare("SELECT id, styleDesignation FROM $t WHERE disableIn" . ucfirst($strType) . "=? ORDER BY styleDesignation ASC")
            ->execute(0);

        return $objCssStyleSelector->fetchEach('styleDesignation');
    }
}
