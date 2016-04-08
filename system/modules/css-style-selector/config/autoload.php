<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2014 Daniel Kiesel
 *
 * @package AccountMail
 * @link    https://github.com/craffft/contao-accountmail
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'Craffft',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Library
    'Craffft\CssStyleSelector\CssStyleSelectorHelper'   => 'system/modules/css-style-selector/library/Craffft/CssStyleSelector/CssStyleSelectorHelper.php',

    // Models
    'Craffft\CssStyleSelector\CssStyleSelectorModel'    => 'system/modules/css-style-selector/models/CssStyleSelectorModel.php',
));
