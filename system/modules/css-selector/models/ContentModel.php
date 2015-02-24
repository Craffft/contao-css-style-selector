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

namespace Craffft\CssStyleSelector;

class ContentModel extends \Contao\ContentModel
{
    public static function updateCssIDById($intId, array $arrCssID)
    {
        $objDatabase = \Database::getInstance();

        return $objDatabase->prepare("UPDATE tl_content SET cssID=? WHERE id=?")
                           ->execute(serialize($arrCssID), $intId);
    }
}
