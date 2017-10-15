<?php

/**
 * Created by FsFlex.
 * User: VH
 * Date: 6/24/2017
 * Time: 9:24 AM
 */
class RevSliderFile
{
    protected static $data;


    protected static function init()
    {
        if (!empty(self::$data))
            return true;
        self::$data = array(
            'init'          => true,
            'base_dir'      => 'revslider',
            'public_prefix' => 'public://',
            'upload_dir'    => '/upload',
        );
        return true;
    }

    public static function getMediaDir()
    {
        self::init();
        $data = self::$data;
        return RevSliderFunctions::merge_path($data['public_prefix'] , $data['base_dir']);
    }

    public static function uploadDirInfo()
    {
        self::init();
        $data = self::$data;
        $base_dir = RevSliderFunctions::merge_path($data['public_prefix'], $data['base_dir'], $data['upload_dir']);
        $real_dir = self::wrapToPath($base_dir);
        if (!is_dir($real_dir)) {
            self::createUploadDir($base_dir);
        }
        return array(
            'basedir' => $base_dir,
            'baseurl' => self::wrapToUrl($base_dir),
        );
    }

    public static function downloadUrl($url, array $args = array())
    {
        self::init();
        extract(array_merge(array(
            'path'        => null,
            'name'        => null,
            'override'    => false,
            'file_type'   => 'image',
            'return_type' => 'path'
        ), $args));
        $url = self::wrapToUrl($url);
        switch ($file_type) {
            case 'image': {
                if (!($image_size = getimagesize($url)))
                    return false;
                break;
            }
        }
        $base_file_name = basename($url);
        if (empty($name) && $base_file_name)
            $name = $base_file_name;
        $new_path = self::wrapToDrupalUri($path);
        if (empty($new_path))
            $new_path = self::uploadDirInfo()['basedir'];
        $save_path = RevSliderFunctions::merge_path($new_path, $name);
        $raw_file = system_retrieve_file($url, $save_path, true);
        if (empty($raw_file))
            return false;
        switch ($return_type) {
            case 'path': {
                return $raw_file->uri;
                break;
            }
            case 'id': {
                return $raw_file->fid;
            }
            default : {
                return true;
            }
        }

    }

    public static function createUploadDir($path)
    {
        $path = str_replace('\\', '/', $path);
        $public_prefix = self::$data['public_prefix'];
        if (strpos($path, $public_prefix) !== 0)
            return false;
        $relative_path = str_replace($public_prefix, '', $path);
        $real_dir = self::wrapToPath($public_prefix);
        $sub_paths = explode('/', $relative_path);
        $current_path = $real_dir;
        foreach ($sub_paths as $sub_path) {
            $current_path = RevSliderFunctions::merge_path($current_path, $sub_path);
            if (!is_dir($current_path))
                echo '-' . drupal_mkdir($current_path);
        }
        return true;
    }

    public static function moveFile($drupal_path, $new_path, $new_name = null, $override = false)
    {
        global $user;
        $uuid = $user->uid;
        $current_file_path = self::wrapToPath($drupal_path);
        if (!is_file($current_file_path))
            return false;
        if(!is_dir($new_path))
            self::createUploadDir($new_path);
        $new_file_path = RevSliderFunctions::merge_path($new_path, $new_name);
        if (is_string($drupal_path)) {
            $files = file_load_multiple(array(), array('uri' => $drupal_path));
            $file = reset($files);
        } elseif (is_object($drupal_path)) {
            $file = $drupal_path;
        }
        if (is_object($file)) {
            $new_file = file_move($file, $new_file_path);
        } else {
            $new_file_uri = file_unmanaged_move($drupal_path, $new_file_path);
            $real_file_path = self::wrapToPath($new_file_uri);
            $file = (object)array(
                'uri'      => $new_file_uri,
                'filemime' => $mime = mime_content_type($real_file_path),
                'uid'      => $uuid,
                'type'     => explode('/', $mime)[0],
                'status'   => 1,
                'filename' => basename($real_file_path)
            );
            $new_file = file_save($file);
        }
        return $new_file;
    }

    public static function basePath($use_drupal_path = true)
    {
        self::init();
        $path = self::$data['public_prefix'] . self::$data['base_dir'];
        if ($use_drupal_path)
            return $path;
        else
            return self::wrapToPath($path);
    }

    public static function wrapToUrl($drupal_path)
    {
        return file_create_url($drupal_path);
    }

    public static function wrapToDrupalUri($path)
    {
        self::init();
        $public_prefix = self::$data['public_prefix'];
        if (strpos($path, $public_prefix) === 0)
            return $path;
        $public_url = self::wrapToUrl($public_prefix);
        if (($drupal_path = str_replace($public_url, $public_prefix, $path)) === $path)
            return '';
        return $drupal_path;
    }

    public static function getFileIdFromUrl($url, $file_type = 'any')
    {
        $drupal_path = self::wrapToDrupalUri($url);
        $db = RevSliderDB::table(RevSliderDB::DRUPAL_TABLE_FILE_MANAGER);
        $where = array('uri', $drupal_path);
        $result = $db->select('fid')->where($where)->first();
        if (!empty($result))
            return $result['fid'];
        return false;
    }

    public static function getFileUrlFromId($id, $filetype = 'any')
    {
        if (empty($id))
            return '';
        $file = file_load($id);
        if ($file)
            return self::wrapToUrl($file->uri);
//            return RevSliderFile::wrapToUrl($file->getFileUri());
        return '';
    }

    public static function getUrlLocalFile($local_path = '')
    {
        $module_path = '/' . drupal_get_path('module', 'revslider');
        if (empty($local_path) || !is_string($local_path))
            return $module_path;
        $local_path = trim($local_path, '/\\');
        return $module_path . '/' . $local_path;
    }

    public static function getPathLocalFile($local_path = '')
    {
        $module_path = '/' . drupal_get_path('module', 'revslider');
        $site_dir = realpath('');// \Drupal::service('file_system')->realpath('');
        if (empty($site_dir))
            return '';
        $module_dir = $site_dir . $module_path;
        $local_path = trim($local_path, '/\\');
        return $module_dir . '/' . $local_path;
    }

    public static function wrapToPath($drupal_path)
    {
        self::init();;
        $public_prefix = self::$data['public_prefix'];
        if (isset(self::$data['public_path']))
            $public_path = self::$data['public_path'];
        else
            $public_path = self::$data['public_path'] = drupal_realpath($public_prefix) . '/';
        $real_path = (strpos($drupal_path, $public_prefix) === 0) ? str_replace($public_prefix, $public_path, $drupal_path) : $drupal_path;
        return $real_path;
    }

    public static function fileExists($drupal_path)
    {
        $path = self::wrapToDrupalUri($drupal_path);
        return file_exists(self::wrapToPath($path));
    }

    public static function getContents($file_path)
    {
        if (!self::fileExists($file_path))
            return '';
        $use_path = self::wrapToPath($file_path);
        ob_start();
        $content = @readfile($use_path);
        $txt = ob_get_clean();
        return $txt;
    }

    public static function delete($path, $force_folder = false)
    {
        $base_path = self::basePath(false);
        $path_remove = self::wrapToPath($path);
        //do nothing
        if (strpos($path_remove, $base_path) !== 0)
            return false;
        if (is_dir($path_remove) && $force_folder) {
            $paths = scandir($path_remove);
            unset($paths[0]);
            unset($paths[1]);
            $keys = array_keys($paths);

            foreach ($keys as $key) {
                $file = $path_remove . DIRECTORY_SEPARATOR . $paths[$key];
                $file = str_replace(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $file);
                if (is_file($file)) {
                    unlink($file);
                    unset($paths[$key]);
                }
            }
            foreach ($paths as $dir) {
                self::delete($path_remove . DIRECTORY_SEPARATOR . $dir, true);
            }
            rmdir($path_remove);
        }
        if (is_file($path_remove))
            unlink($path_remove);
        return true;
    }
}