<?php

/**
 * Created by FsFlex.
 * User: VH
 * Date: 9/28/2017
 * Time: 4:34 PM
 */
class RevSliderMasterView
{
    public function getTemplate(array $args = array())
    {
        extract($args);
        ob_start();
        ?>
        <div id="waitaminute">
            <div class="waitaminute-message"><i class="eg-icon-emo-coffee"></i><br><?php echo t("Please Wait...") ?>
            </div>
        </div>

        <div id="div_debug"></div>

        <div class='unite_error_message' id="error_message" style="display:none;"></div>

        <div class='unite_success_message' id="success_message" style="display:none;"></div>

        <div id="viewWrapper" class="view_wrapper">
            <?php switch ($data['view']):
                case 'slider-editor':
                    $template_seg = new RevSliderSliderEditor();
                    break;
                case
                    'slide-editor' :
                    $template_seg = new RevSliderSlideEditor();
                    break;
                default:
                    $template_seg = new RevSliderSliderOverview();
                    break;
            endswitch;
            echo $template_seg->getTemplate();
            ?>
        </div>

        <div id="divColorPicker" style="display:none;"></div>
        <?php
            $system_dialog_template = new RevSliderSystemDialog();
            echo $system_dialog_template->dialog_video_html($data);
            echo $system_dialog_template->add_media_dialog_html();
        ?>
        <div id="rs-preview-wrapper" style="display: none;">
            <div id="rs-preview-wrapper-inner">
                <div id="rs-preview-info">
                    <div class="rs-preview-toolbar">
                        <a class="rs-close-preview"><i class="eg-icon-cancel"></i></a>
                    </div>

                    <div data-type="desktop"
                         class="rs-preview-device_selector_prev rs-preview-ds-desktop selected"></div>
                    <div data-type="notebook" class="rs-preview-device_selector_prev rs-preview-ds-notebook"></div>
                    <div data-type="tablet" class="rs-preview-device_selector_prev rs-preview-ds-tablet"></div>
                    <div data-type="mobile" class="rs-preview-device_selector_prev rs-preview-ds-mobile"></div>

                </div>
                <div class="rs-frame-preview-wrapper">
                    <iframe id="rs-frame-preview" name="rs-frame-preview"></iframe>
                </div>
            </div>
        </div>
        <form id="rs-preview-form" name="rs-preview-form" action="<?php echo $data['url']['ajax_url'] ?>"
              target="rs-frame-preview" method="post">
            <input type="hidden" id="rs-client-action" name="client_action" value="">
            <input type="hidden" id="rs-nonce" name="rs-nonce"
                   value="<?php if (isset($data['nonce'])) echo $data['nonce'] ?>">

            <!-- SPECIFIC FOR SLIDE PREVIEW -->
            <input type="hidden" name="data" value="" id="preview-slide-data">

            <!-- SPECIFIC FOR SLIDER PREVIEW -->
            <input type="hidden" id="preview_sliderid" name="sliderid" value="">
            <input type="hidden" id="preview_slider_markup" name="only_markup" value="">
        </form>


        <div id="dialog_preview_sliders" class="dialog_preview_sliders" title="Preview Slider" style="display:none;">
            <iframe id="frame_preview_slider" name="frame_preview_slider" style="width: 100%;"></iframe>
        </div>

        <script type="text/javascript">
            var rs_plugin_validated = true;
            document.addEventListener("DOMContentLoaded", function () {
                jQuery('body').on('click', '.rs-preview-device_selector_prev', function () {
                    var btn = jQuery(this);
                    jQuery('.rs-preview-device_selector_prev.selected').removeClass("selected");
                    btn.addClass("selected");

                    var w = parseInt(global_grid_sizes[btn.data("type")], 0);
                    if (w > 1450) w = 1450;
                    jQuery('#rs-preview-wrapper-inner').css({maxWidth: w + "px"});

                });

                jQuery(window).resize(function () {
                    var ww = jQuery(window).width();
                    if (global_grid_sizes)
                        jQuery.each(global_grid_sizes, function (key, val) {
                            if (ww <= parseInt(val, 0)) {
                                jQuery('.rs-preview-device_selector_prev.selected').removeClass("selected");
                                jQuery('.rs-preview-device_selector_prev[data-type="' + key + '"]').addClass("selected");
                            }
                        })
                })
            });
        </script>
        <?php
        return ob_get_clean();
    }
}