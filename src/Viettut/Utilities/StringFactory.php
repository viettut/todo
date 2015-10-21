<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 9/27/15
 * Time: 11:31 AM
 */
namespace Viettut\Utilities;

trait StringFactory {
    /**
     * generate dash-separated string which is url-friendly
     *
     * @param $str
     * @return string
     */
    protected  function getUrlFriendlyString($str)
    {
        return ereg_replace("[-]+", "-", ereg_replace("[^a-z0-9-]", "", strtolower( str_replace(" ", "-", $str))));
    }

    /**
     * extract the first paragraph from a sequence of string
     *
     * @param $string
     * @return string
     */
    protected function getFirstParagraph($string)
    {
        $string = substr($string,0, strpos($string, "\n"));
        return $string. '...';
    }
}