<?php
/**
 * Created by FsFlex.
 * User: VH
 * Date: 8/8/2017
 * Time: 4:39 PM
 */

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
            'select'=>array('fid','filename','uri','filemime','timestamp','filesize'),
            'order_by'=>array('timestamp','desc')
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
            $info['created']=date('F d,Y',$file['timestamp']);
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
        if(empty($media))
            return false;
        $origin_name = $media['name'];
        $mime = $media['type'];
        $file_type = '';
        if(strpos($mime,'image') === 0)
            $file_type = 'image';
        if(strpos($mime,'video') === 0)
            $file_type = 'video';
        if(strpos($mime,'audio') === 0)
            $file_type = 'video';
        if(empty($file_type))
            exit('fail');
        $upload_dir = RevSliderFunctions::merge_path(RevSliderFile::getMediaDir(),$file_type);
        $result = RevSliderFile::moveFile($media['tmp_name'],$upload_dir,$origin_name);
    }
    public static function removeFile($fid)
    {
        $file = file_load($fid);
        if(!empty($file))
            file_delete($file);
        return self::getMedia();
    }
}