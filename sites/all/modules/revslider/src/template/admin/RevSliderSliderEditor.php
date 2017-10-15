<?php

/**
 * Created by FsFlex.
 * User: VH
 * Date: 7/31/2017
 * Time: 11:31 AM
 */
class RevSliderSliderEditor
{
    public function getTemplate(array $args = array())
    {
        extract($args);
        ob_start();
        //get taxonomies with cats
        $postTypesWithCats = [];//Operations::getPostTypesWithCatsForClient();
        $jsonTaxWithCats = RevSliderFunctions::jsonEncodeForClientSide($postTypesWithCats);

        //check existing slider data:
        $sliderID = RevSliderFunctions::getRequestVariable('id');

        $arrFieldsParams = array();

        $uslider = new RevSliderSlider();

        if (!empty($sliderID)) {
            $slider = new RevSliderSlider();
            $slider->initByID($sliderID);

            //get setting fields
            $settingsFields = $slider->getSettingsFields();
            $arrFieldsMain = $settingsFields['main'];
            $arrFieldsParams = $settingsFields['params'];
            $linksEditSlides = RevSliderFunctions::getViewUrl(RevSliderGlobals::VIEW_SLIDE, array('id' => 'new', 'slider' => intval($sliderID)));


            $template_seg = new RevSliderEditSlider();
            echo $template_seg->getTemplate(array(
                "arrFieldsParams" => $arrFieldsParams,
                "uslider"         => $uslider,
                "sliderID"        => $sliderID,
                "slider"          => $slider,
                "jsonTaxWithCats" => $jsonTaxWithCats,
                'linksEditSlides' => $linksEditSlides,
            ));
        } else {
            $slider = new RevSliderSlider();
            $template_seg = new RevSliderSliderMainOptions();
            echo $template_seg->getTemplate(array(
                "arrFieldsParams" => $arrFieldsParams,
                "uslider"         => $uslider,
                "sliderID"        => $sliderID,
                "slider"          => $slider,
            ));
            ?>

            <script type="text/javascript">
                var g_jsonTaxWithCats = <?php echo $jsonTaxWithCats?>;
                document.addEventListener("DOMContentLoaded", function () {
                    RevSliderAdmin.initAddSliderView();
                });
            </script>
            <?php
        }
        return ob_get_clean();
    }
}