<?php
/**
 * Created by FsFlex.
 * User: VH
 * Date: 8/8/2017
 * Time: 4:39 PM
 */

namespace Drupal\revslider\Helper;


use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RevSliderMedia
{
    public static function getMedia()
    {
        $image_files = RevSliderDB::instance(array(
            'table'=>RevSliderDB::DRUPAL_TABLE_FILE_MANAGER,
            'where'=>array(
                'condition' => 'OR',
                array('filemime','LIKE','image/%'),
                array('filemime','LIKE','video/%'),
                array('filemime','LIKE','audio/%'),
                ),
            'select'=>array('fid','filename','uri','filemime','created','filesize'),
            'order_by'=>array('created','desc')
        ))->get();
        $result=array(
            'images'=>array(),
            'videos'=>array()
        );
        foreach ($image_files as $file)
        {
            $info = array();
            $info['id']=$file['fid'];
            $info['src']=RevSliderFile::wrapToUrl($file['uri']);
            $info['name']=$file['filename'];
            $info['size']=RevSliderFunctions::size_format($file['filesize']);
            $info['created']=date('F d,Y',$file['created']);
            $type = $file['filemime'];
            if(strpos($type,'image') === 0)
                $type = 'image';
            else
                $type = 'video';
            $info['type']=str_replace($type.'/','',$file['filemime']);
            switch ($type)
            {
                case 'video':
                    $result['videos'][$info['id']]= $info;
                    break;
                case 'image':
                    $result['images'][$info['id']]= $info;
                    break;
            }
        }
        return $result;
    }
    public static function uploadMedia(array $args = array())
    {
        $media = RevSliderFunctions::getFileUpload('media_upload');
        $origin_name = $media->getClientOriginalName();
        $mime = $media->getClientMimeType();
        $file_type = '';
        if(strpos($mime,'image') === 0)
            $file_type = 'image';
        if(strpos($mime,'video') === 0)
            $file_type = 'video';
        if(strpos($mime,'audio') === 0)
            $file_type = 'video';
        if(empty($file_type))
            exit('fail');
        $upload_dir = RevSliderFile::getMediaDir().DIRECTORY_SEPARATOR.$file_type;
        $temp_upload_dir = RevSliderFile::getMediaDir().DIRECTORY_SEPARATOR.'temp';
        $temp_file_upload = $media->move($temp_upload_dir,$origin_name);
        $result = RevSliderFile::moveFile($temp_file_upload->getPathName(),$upload_dir);
    }
    public static function removeFile($fid)
    {
        $file =File::load($fid);
        if($file)
            $file->delete();
        //return self::getMedia();
    }
}