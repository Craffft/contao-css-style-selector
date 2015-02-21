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

// Config
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('Craffft\CSSSelector\Selector', 'onSubmitCallback');

// Palettes
foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $k => $v) {
    $GLOBALS['TL_DCA']['tl_content']['palettes'][$k] = str_replace(',cssID', ',cssClassesSelector,cssID', $v);
}

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['cssClassesSelector'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['cssClassesSelector'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_css_selector.title',
    'search'                  => true,
    'eval'                    => array('chosen'=>true, 'multiple'=>true, 'tl_class'=>'w50 clr'),
    'sql'                     => "blob NULL"
);
