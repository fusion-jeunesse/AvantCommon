<?php

class AvantCommon
{
    public static function elementHasPostedValue($elementId)
    {
        // Get the values from all of this element's input fields. Return true if any have a value.
        $values = $_POST['Elements'][$elementId];

        foreach ($values as $value)
        {
            if (strlen(trim($value['text'])) > 0)
            {
                return true;
            }
        }
        return false;
    }

    public static function getPostedValues($elementId)
    {
        $texts = array();

        if (!isset($_POST['Elements'][$elementId]))
        {
            $texts = array('');
        }
        else
        {
            $values = $_POST['Elements'][$elementId];

            foreach ($values as $value)
            {
                $texts[] = $value['text'];
            }
        }

        return $texts;
    }

    public static function getPostTextForElementName($elementName)
    {
        // Return the element's posted value. If it has more than one, only return the first.
        $text = '';
        $elementId = ItemMetadata::getElementIdForElementName($elementName);

        if (!empty($elementId))
        {
            // Use current() instead of [0] in case the 0th element was deleted using the Remove button.
            $values = $_POST['Elements'][$elementId];
            $text = empty($values) ? '' : current($values)['text'];
        }
        return $text;
    }

    public static function initializePrivateElementFilters(&$filters)
    {
        $privateElementsData = CommonConfig::getOptionDataForPrivateElements();
        foreach ($privateElementsData as $elementName)
        {
            $elementSetName = ItemMetadata::getElementSetNameForElementName($elementName);
            if (!empty($elementSetName))
            {
                // Set up a call to be made when this element is displayed on a Show page.
                $filters['filterPrivateElement' . $elementName] = array('Display', 'Item', $elementSetName, $elementName);
            }
        }
    }

    public static function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function setPostTextForElementId($elementId, $text)
    {
        $_POST['Elements'][$elementId][0]['text'] = $text;
    }
}