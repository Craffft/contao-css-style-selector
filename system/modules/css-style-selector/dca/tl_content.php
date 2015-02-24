<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2015 Craffft
 *
 * @package CssStyleSelector
 * @link    https://github.com/craffft/contao-css-selector
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

// Palettes
foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $k => $v) {
    $GLOBALS['TL_DCA']['tl_content']['palettes'][$k] = str_replace(',cssID', ',cssStyleSelector,cssID', $v);
}

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['cssStyleSelector'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['cssStyleSelector'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_css_style_selector.styleDesignation',
    'search'                  => true,
    'eval'                    => array('chosen'=>true, 'multiple'=>true, 'tl_class'=>'w50 clr'),
    'save_callback' => array
    (
        array('Craffft\CssStyleSelector\CssStyleSelectorHelper', 'saveCallback')
    ),
    'sql'                     => "blob NULL"
);
