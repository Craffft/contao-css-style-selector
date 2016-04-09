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

/**
 * Table tl_css_style_selector
 */
$GLOBALS['TL_DCA']['tl_css_style_selector'] = array
(
    // Config
    'config'   => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 11,
            'fields'                  => array('styleDesignation'),
            'panelLayout'             => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('styleDesignation', 'cssClasses', 'articleEnabled', 'contentEnabled', 'moduleEnabled'),
            'showColumns'             => true,
            'label_callback' => function ($row, $label, DataContainer $dc, $args) {
                $args[2] = $GLOBALS['TL_LANG']['MSC'][($row['disableInArticle'] ? 'no' : 'yes')];
                $args[3] = $GLOBALS['TL_LANG']['MSC'][($row['disableInContent'] ? 'no' : 'yes')];
                $args[4] = $GLOBALS['TL_LANG']['MSC'][($row['disableInModule'] ? 'no' : 'yes')];

                return $args;
            }
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_css_style_selector']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy'   => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_css_style_selector']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_css_style_selector']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_css_style_selector']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        'default' => '{style_legend},styleDesignation;{css_legend},cssClasses;{permissions_legend},disableInArticle,disableInContent,disableInModule'
    ),
    // Fields
    'fields'   => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'styleDesignation' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['styleDesignation'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'cssClasses' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['cssClasses'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'rgxp'=>'alphanumeric', 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'disableInArticle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['disableInArticle'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'sql'                     => "int(1) NOT NULL default '0'"
        ),
        'disableInContent' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['disableInContent'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'sql'                     => "int(1) NOT NULL default '0'"
        ),
        'disableInModule' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['disableInModule'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'sql'                     => "int(1) NOT NULL default '0'"
        ),
        'articleEnabled' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['articleEnabled'],
        ),
        'contentEnabled' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['contentEnabled'],
        ),
        'moduleEnabled' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_css_style_selector']['moduleEnabled'],
        )
    )
);
