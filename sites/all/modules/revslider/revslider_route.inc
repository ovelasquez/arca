<?php

class RevSliderRoute
{
    protected static $instance = false;
    public static $module_path = false;
    protected static $required_class = array(
        //helper
        "AqResize",
        "CssParser",
        "DB",
        "File",
        "Functions",
        "FunctionsWP",
        "Globals",
        "GoogleFonts",
        "Html",
        "Init",
        "Media",
        "Options",
        "PluginUpdate",
        "TPColorpicker",
        "Wpml",
        //model
        "ElementsBase",
        "Front",
        "Navigation",
        "ObjectLibrary",
        "Operations",
        "Output",
        "Slide",
        "Slider",
        "Template",
        //template
        "EditSlider",
        "IdEsw",
        "MasterView",
        "SettingsPanelLeft",
        "SettingsPanelRight",
        "SlideStage",
        "SliderEditor",
        "SliderMainOptions",
        "SliderOverview",
        "SliderSelector",
        "SlidersList",
        "SlideEditor",
        'SystemDialog',
        //controller
        'ControllerBase',
        'Admin',
        'Ajax',
        //
        'SectionVariable',
        'SlideEditorHelper',
    );

    public static function route($name, $params = array())
    {
        $route_list = array(
            'admin' => 'admin/revslider/main',
            'ajax'  => 'admin/revslider/ajax'
        );
        if (key_exists($name, $route_list))
            return url($route_list[$name], array('query' => $params, 'absolute' => true));
        return '';
    }

    public static function instances()
    {
        if (!self::$instance)
            self::$instance = new  self();
        return self::$instance;
    }

    public function slider_list()
    {
        $required_class = array(
            'DB', 'Functions'
        );
        self::require_class($required_class);
        $slider_lists = RevSliderDB::instance(array(
            'table'  => RevSliderDB::TABLE_SLIDERS,
            'select' => array('alias', 'title')
        ))->get();
        return $slider_lists;
    }

    public function block_slider($alias)
    {
        $required_class = array(
            //helper
            "AqResize",
            "CssParser",
            "DB",
            "File",
            "Functions",
            "FunctionsWP",
            "Globals",
            "GoogleFonts",
            "Html",
            "Init",
            "Media",
            "Options",
            "PluginUpdate",
            "TPColorpicker",
            "Wpml",
            //model
            "ElementsBase",
            "Front",
            "Navigation",
            "ObjectLibrary",
            "Operations",
            "Output",
            "Slide",
            "Slider",
            "Template",
            //
            'FrontView'
        );
        self::require_class($required_class);
        RevSliderInit::start();
        $settings = '';
        $order = '';
        $args = array();
        //
        if ($settings !== '') $settings = json_decode(str_replace(array('({', '})', "'"), array('[', ']', '"'), $settings), true);
        if ($order !== '') $order = explode(',', $order);

        $sliderAlias = ($alias != '') ? $alias : RevSliderFunctions::getVal($args, 0);

        $gal_ids = false;//RevSliderFunctionsWP::check_for_shortcodes($mid_content); //check for example on gallery shortcode and do stuff

        ob_start();
        if (!empty($gal_ids)) { //add a gallery based slider
            $slider = RevSliderOutput::putSlider($sliderAlias, '', $gal_ids);
        } else {
            $slider = RevSliderOutput::putSlider($sliderAlias, '', array(), $settings, $order);
        }
        $content_slider = ob_get_clean();
        $template = new RevSliderFrontView();
        $content = $template->getTemplate($content_slider);
        $block = array();
//        drupal_add_js();
//        drupal_add_js(drupal_get_path('module', 'revslider').'/' .'/assets/admin/js/jquery/jquery.d8.js' ,array('type'=>'file','scope' => 'footer'));
        $block['content'] = array(
            '#markup'   => $content,
            '#attached' => array(
                'css' => array(
                    drupal_get_path('module', 'revslider') . '/assets/public/css/settings.css',
                    drupal_get_path('module', 'revslider') . '/assets/public/css/drupal.css',
                    drupal_get_path('module', 'revslider') . '/assets/public/fonts/font-awesome/css/font-awesome.css',
                    drupal_get_path('module', 'revslider') . '/assets/public/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css',
                ),
                'js'  => array(
                    drupal_get_path('module', 'revslider') . '/assets/admin/js/drupal/revslider_d7_cf_before.js',
                    drupal_get_path('module', 'revslider') . '/assets/admin/js/jquery/jquery.d8.js',
                    drupal_get_path('module', 'revslider') . '/assets/public/js/jquery.themepunch.tools.min.js',
                    drupal_get_path('module', 'revslider') . '/assets/public/js/jquery.themepunch.revolution.min.js',
                    drupal_get_path('module', 'revslider') . '/assets/admin/js/drupal/revslider_d7_cf_after.js',
                ),
            ),
        );
        return $block;
    }

    public function admin()
    {
        $required_class = self::$required_class;
        self::require_class($required_class);

//        $dir = self::$module_path;
//        $list = scandir(self::merge_path($dir,'src/template/admin'));
//        foreach ($list as $class)
//        {
//            if(strpos($class,'RevSlider') === 0)
//                echo "\"".str_replace(array('RevSlider','.php'),'',$class).'",<br>';
//        }
//        die();
        $admin = new RevSliderAdmin();
        return $admin->index();
    }

    public function ajax()
    {
        $required_class = self::$required_class;
        self::require_class($required_class);
        $admin = new RevSliderAjax();
        return $admin->request();
    }

    public static function require_files(array $required)
    {
        $module_path = (self::$module_path === false) ? dirname(__FILE__) : self::$module_path;
        foreach ($required as $file) {
            $path = self::instances()->merge_path($module_path, $file);
            if (file_exists($path))
                require_once $path;
        }
    }

    public static function require_class(array $requred)
    {
        if (!self::$module_path)
            self::$module_path = dirname(__FILE__);
        $module_path = self::$module_path;
        $src_path = self::merge_path($module_path, 'src');

        foreach ($requred as $class) {
            $real_class_name = 'RevSlider' . $class;
            if (class_exists($real_class_name))
                continue;
            $sub_dir = self::get_sub_dir($class);
            if (!empty($sub_dir) && is_string($sub_dir)) {
                $path = self::merge_path($src_path, $sub_dir, $real_class_name . '.php');
                require_once $path;
            }
        }
    }

    protected static function get_sub_dir($class)
    {
        $class_map = array(
            'helper'            => array(
                "AqResize",
                "CssParser",
                "DB",
                "File",
                "Functions",
                "FunctionsWP",
                "Globals",
                "GoogleFonts",
                "Html",
                "Init",
                "Media",
                "Options",
                "PluginUpdate",
                "TPColorpicker",
                "Wpml",
            ),
            'model'             => array(
                "ElementsBase",
                "Front",
                "Navigation",
                "ObjectLibrary",
                "Operations",
                "Output",
                "Slide",
                "Slider",
                "Template",
            ),
            'template/admin'    => array(
                "EditSlider",
                "IdEsw",
                "MasterView",
                "SettingsPanelLeft",
                "SettingsPanelRight",
                "SlideStage",
                "SliderEditor",
                "SliderMainOptions",
                "SliderOverview",
                "SliderSelector",
                "SlidersList",
                "SlideEditor",
                'SystemDialog',
            ),
            'template/public'=>array(
                "FrontView"
            ),
            'controller'        => array(
                'Admin',
                'Ajax',
                'ControllerBase'
            ),
            'controller/handle' => array(
                'SectionVariable',
                'SlideEditorHelper'
            ),

        );
        foreach ($class_map as $key => $class_list) {
            if (in_array($class, $class_list))
                return $key;
        }
        return false;
    }

    public static function merge_path($path1, ...$paths)
    {
        $result = $path1;
        foreach ($paths as $path)
            $result .= '/' . $path;
        return self::validate_dir($result);
    }

    public static function validate_dir($dir, $remove_end_slash = true)
    {
        $dir_result = preg_replace('/[\/]{1,}/i', '/', $dir);
        if ($remove_end_slash && substr($dir_result, -1) === '/')
            return substr($dir_result, 0, -1);
        else
            return $dir_result;
    }
}
