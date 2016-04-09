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

if (isset($GLOBALS['TL_DCA']['tl_page'])) {
    // Palettes
    foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $k => $v) {
        $GLOBALS['TL_DCA']['tl_page']['palettes'][$k] = str_replace(',cssClass', ',cssStyleSelector,cssClass', $v);
    }

    // Fields
    $GLOBALS['TL_DCA']['tl_page']['fields']['cssStyleSelector'] = array
    (
        'label'            => &$GLOBALS['TL_LANG']['MSC']['cssStyleSelector'],
        'exclude'          => true,
        'inputType'        => 'select',
        'options_callback' => function () {
            return \Craffft\CssStyleSelector\CssStyleSelectorModel::findStyleDesignationByNotDisabledType(
                \Craffft\CssStyleSelector\CssStyleSelectorModel::TYPE_PAGE
            );
        },
        'search'           => true,
        'eval'             => array('chosen' => true, 'multiple' => true, 'tl_class' => 'clr'),
        'save_callback'    => array
        (
            array('Craffft\CssStyleSelector\CssStyleSelectorHelper', 'saveCssClassCallback')
        ),
        'sql'              => "blob NULL"
    );
}
