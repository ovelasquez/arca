<?php

/**
 * Created by FsFlex.
 * User: VH
 * Date: 7/6/2017
 * Time: 11:06 AM
 */
class RevSliderFunctionsWP
{
    public static $urlSite;
    public static $urlAdmin;

    const SORTBY_NONE = "none";
    const SORTBY_ID = "ID";
    const SORTBY_AUTHOR = "author";
    const SORTBY_TITLE = "title";
    const SORTBY_SLUG = "name";
    const SORTBY_DATE = "date";
    const SORTBY_LAST_MODIFIED = "modified";
    const SORTBY_RAND = "rand";
    const SORTBY_COMMENT_COUNT = "comment_count";
    const SORTBY_MENU_ORDER = "menu_order";

    const ORDER_DIRECTION_ASC = "ASC";
    const ORDER_DIRECTION_DESC = "DESC";

    const THUMB_SMALL = "thumbnail";
    const THUMB_MEDIUM = "medium";
    const THUMB_LARGE = "large";
    const THUMB_FULL = "full";

    const STATE_PUBLISHED = "publish";
    const STATE_DRAFT = "draft";

    public static function getPostTypesAssoc($arrPutToTop = array())
    {
        return array();
    }

    public static function getImageUrlFromPath($pathImage)
    {
        //protect from absolute url
        $pathLower = strtolower($pathImage);
        if (strpos($pathLower, "http://") !== false || strpos($pathLower, "https://") !== false || strpos($pathLower, "www.") === 0)
            return ($pathImage);

        $urlImage = self::getUrlUploads() . '/' . $pathImage;
        return ($urlImage);
    }

    public static function getUrlUploads()
    {

        $info = RevSliderFile::uploadDirInfo();
        return $info['baseurl'];

    }

    public static function import_media($file_url, $folder_name)
    {
        $ul_dir = RevSliderFile::uploadDirInfo();
        $artDir = '';

        if (!file_exists($ul_dir['basedir'] . '/' . $artDir)) mkdir($ul_dir['basedir'] . '/' . $artDir);
        if (!file_exists($ul_dir['basedir'] . '/' . $artDir . $folder_name)) mkdir($ul_dir['basedir'] . '/' . $artDir . $folder_name);

        //rename the file... alternatively, you could explode on "/" and keep the original file name

        $filename = basename($file_url);
        if (@fclose(@fopen($file_url, "r"))) { //make sure the file actually exists

            $saveDir = $ul_dir['basedir'] . '/' . $artDir . $folder_name . $filename;

            $atc_id = self::get_image_id_by_url($artDir . $folder_name . $filename);

            if ($atc_id == false || $atc_id == NULL) {
                $attach_id = RevSliderFile::downloadUrl($file_url, array(
                    'path'        => dirname($saveDir),
                    'name'        => basename($saveDir),
                    'file_type'   => 'any',
                    'return_type' => 'id'
                ));
            } else {
                $attach_id = $atc_id;
            }

            return array("id" => $attach_id, "path" => $artDir . $folder_name . $filename);
        } else {
            return false;
        }
    }

    public static function get_image_id_by_url($image_url)
    {
        $attachment_id = RevSliderFile::getFileIdFromUrl($image_url, 'image');
        return $attachment_id;
    }

    public static function getUrlAttachmentImage($thumbID, $size = self::THUMB_FULL)
    {
        return RevSliderFile::getFileUrlFromId($thumbID);
    }

    public static function getPathContent($path)
    {
        return RevSliderFile::wrapToPath($path);
    }

    public static function getImagePathFromURL($urlImage)
    {

        $baseUrl = self::getUrlUploads();
        $pathImage = str_replace($baseUrl, "", $urlImage);

        return ($pathImage);
    }
}