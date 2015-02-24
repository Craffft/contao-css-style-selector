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

class SelectorHelper
{
    /**
     * @param $varValue
     * @param \DataContainer $dc
     * @return mixed
     */
    public function saveCallback($varValue, \DataContainer $dc)
    {
        if (!$dc->activeRecord) {
            return false;
        }

        $arrCssID = $this->getCssIDValue($dc);
        $arrClasses = $this->getClassesFromCssIDAsArray($arrCssID);

        // Remove all known cssSelector classes from cssID classes
        $arrClasses = array_diff($arrClasses, $this->getAllCssSelectorClasses());

        // Add all selected classes of cssSelector to the classes of cssID
        $arrCssClassesSelectorIds = $this->convertSerializedCssSelectorToArray($varValue);
        $arrClasses = array_merge($arrClasses, $this->getCssSelectorClassesByIds($arrCssClassesSelectorIds));

        $arrClasses = array_unique($arrClasses);

        $this->saveClassesToCssID($arrClasses, $dc);

        return $varValue;
    }

    /**
     * @param integer $intId
     * @return string
     */
    protected function getCssIDName($intId)
    {
        return 'cssID' . ((\Input::get('act') == 'editAll') ? '_' . $intId : '');
    }

    /**
     * @param \DataContainer $dc
     * @return array
     */
    protected function getCssIDValue(\DataContainer $dc)
    {
        $arrCssID = \Input::post($this->getCssIDName($dc->id));

        if ($arrCssID === null) {
            $arrCssID = deserialize($dc->activeRecord->cssID);
        }

        if (!is_array($arrCssID)) {
            $arrCssID = array();
        }

        return $arrCssID;
    }

    /**
     * @param string $strValue
     * @return array
     */
    protected function convertSerializedCssSelectorToArray($strValue)
    {
        $arrCssClassesSelectorIds = deserialize($strValue);

        if (!is_array($arrCssClassesSelectorIds)) {
            $arrCssClassesSelectorIds = array();
        }

        return $arrCssClassesSelectorIds;
    }

    /**
     * @param array $arrClasses
     * @param \DataContainer $dc
     */
    protected function saveClassesToCssID(array $arrClasses, \DataContainer $dc)
    {
        $strCssIDName = $this->getCssIDName($dc->id);

        $arrPostedCssID = \Input::post($strCssIDName);
        $arrPostedCssID[1] = implode(' ', $arrClasses);
        $arrPostedCssID[1] = str_replace('  ', ' ', $arrPostedCssID[1]);
        $arrPostedCssID[1] = trim($arrPostedCssID[1]);

        $dc->activeRecord->cssID = serialize($arrPostedCssID);
        \Input::setPost($strCssIDName, $arrPostedCssID);
        ContentModel::updateCssIDById($dc->id, $arrPostedCssID);
    }

    /**
     * @param array $arrCssID
     * @return array
     */
    protected function getClassesFromCssIDAsArray(array $arrCssID)
    {
        list($strId, $strClasses) = $arrCssID;

        $arrClasses = $this->convertClassesStringToArray($strClasses);

        return $arrClasses;
    }

    /**
     * @param array $arrIds
     * @return array
     */
    protected function getCssSelectorClassesByIds(array $arrIds)
    {
        if (empty($arrIds)) {
            return array();
        }

        $arrClasses = CssSelectorModel::findCssClassesByIds($arrIds);

        return $this->convertCombinedClassesToSingleClasses($arrClasses);
    }

    /**
     * @return array
     */
    protected function getAllCssSelectorClasses()
    {
        $arrClasses = CssSelectorModel::findAllCssClasses();
        $arrClasses = $this->convertCombinedClassesToSingleClasses($arrClasses);

        return $arrClasses;
    }

    /**
     * @param array $arrClasses
     * @return array
     */
    protected function convertCombinedClassesToSingleClasses(array $arrClasses)
    {
        $arrSingleClasses = array();

        if (is_array($arrClasses)) {
            foreach ($arrClasses as $k => $v) {
                $arrSingleClasses = array_merge($arrSingleClasses, $this->convertClassesStringToArray($v));
            }
        }

        $arrSingleClasses = array_unique($arrSingleClasses);

        return $arrSingleClasses;
    }

    /**
     * @param string $strClasses
     * @return array
     */
    protected function convertClassesStringToArray($strClasses)
    {
        $arrClasses = explode(' ', $strClasses);

        if (empty($arrClasses)) {
            $arrClasses = array();
        }

        return $arrClasses;
    }
}
