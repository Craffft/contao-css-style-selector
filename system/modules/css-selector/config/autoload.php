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
    'Craffft\CSSSelector\Selector'        => 'system/modules/css-selector/library/Craffft/CSSSelector/Selector.php',
));
