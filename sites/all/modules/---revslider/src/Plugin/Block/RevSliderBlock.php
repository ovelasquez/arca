<?php

/**
 * Created by FsFlex.
 * User: VH
 * Date: 7/28/2017
 * Time: 2:10 PM
 */
namespace Drupal\revslider\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\revslider\Helper\RevSliderFunctions;
use Drupal\revslider\Helper\RevSliderInit;
use Drupal\revslider\Model\Output;

/**
 * Provides a 'RevSlider' Block.
 *
 * @Block(
 *   id = "revslider_block",
 *   admin_label = @Translation("RevSlider block"),
 *   category = @Translation("RevSlider block"),
 *   deriver = "Drupal\revslider\Plugin\Derivative\RevSliderBlock",
 * )
 */
class RevSliderBlock extends BlockBase
{
    public function build()
    {
        RevSliderInit::start();
        //test
        $args = array();
        $settings ='';
        $order = '';
        $slider_name = $this->getDerivativeId();
//        $entry = array(
//            'machine_name' => $slider_name
//        );
        $alias = $slider_name;
        //
        if($settings !== '') $settings = json_decode(str_replace(array('({', '})', "'"), array('[', ']', '"'), $settings) ,true);
        if($order !== '') $order = explode(',', $order);

        $sliderAlias = ($alias != '') ? $alias : RevSliderFunctions::getVal($args,0);

        $gal_ids = false;//RevSliderFunctionsWP::check_for_shortcodes($mid_content); //check for example on gallery shortcode and do stuff

        ob_start();
        if(!empty($gal_ids)){ //add a gallery based slider
            $slider = Output::putSlider($sliderAlias, '', $gal_ids);
        }else{
            $slider = Output::putSlider($sliderAlias, '', array(), $settings, $order);
        }
        $content = ob_get_clean();

        return array(
            '#theme' => 'revslider_front_view',
            '#attached' => array(
                'library'        => array('revslider/front-view'),
            ),
            '#data' => $content,
        );
    }
    public function getCacheTags()
    {
        $tag = $this->getDerivativeId();
        $tag = 'revslider_'.$tag;
        return Cache::mergeTags(parent::getCacheTags(),array($tag));
    }
}