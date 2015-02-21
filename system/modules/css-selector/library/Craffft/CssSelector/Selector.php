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

class Selector
{
    public function onSubmitCallback(\DataContainer $dc)
    {
        if (!$dc->activeRecord) {
            return false;
        }
    }
}
