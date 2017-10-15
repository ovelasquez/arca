<?php

/**
 * Created by FsFlex.
 * User: VH
 * Date: 9/30/2017
 * Time: 10:46 AM
 */
class RevSliderSystemDialog
{
    public function add_media_dialog_html()
    {
        ob_start();
        ?>
        <div class="media-modal wp-core-ui"  id="revslider-media-modal" style="display: none">
            <button type="button" class="media-modal-close">X</button>
            <div class="media-modal-content">
                <div class="media-frame mode-select wp-core-ui hide-menu">
                    <div class="media-frame-title">
                        <h1 data-filter-trigger="revslider-media-uploader">Upload Media</h1>
                        <h1 data-filter-trigger="revslider-images-select">Select Image</h1>
                        <h1 data-filter-trigger="revslider-videos-select">Select Video</h1>
                    </div>
                    <div class="media-frame-router">
                        <div class="media-router">
                            <a href="#" class="media-menu-item" data-target="revslider-media-uploader">Upload Files</a>
                            <a href="#" class="media-menu-item active" data-media-type="images" data-target="revslider-images-select">Image Library</a>
                            <a href="#" class="media-menu-item active" data-media-type="videos" data-target="revslider-videos-select">Video Library</a>
                            <a href="#" class="media-menu-item active" data-target="revslider-media-uploading" style="display: none">Uploading</a>
                        </div>
                    </div>
                    <div class="media-frame-content" data-columns="10">
                        <div class="uploader-inline" data-filter-trigger="revslider-media-uploader">
                            <input type="file" name="revslider-media-upload" id="revslider-media-upload">
                            <div class="uploader-inline-content has-upload-message">
                                <div class="upload-ui">
                                    <h2 class="upload-message">No items found.</h2>
                                    <h2 class="upload-instructions drop-instructions">Drop files here to upload</h2>
                                    <p class="upload-instructions drop-instructions">or</p>
                                    <label id="revslider-media-upload-mask" for="revslider-media-upload" class="browser button button-hero"
                                           style="display: inline; position: relative; z-index: 1;">Select Files</label>
                                </div>
                                <div class="upload-inline-status"></div>
                            </div>
                        </div>
                        <div class="uploading" data-filter-trigger="revslider-media-uploading">
                            <div class="waitaminute-message"><i class="eg-icon-emo-coffee"></i><br><?php echo t("Uploading Please Wait...") ?></div>
                        </div>
                        <div class="attachments-browser" data-media-type="images" data-filter-trigger="revslider-images-select">
                    <textarea style="display: none" class="raw_media_element" data-element-type="images">
                        <li tabindex="0" aria-checked="false" data-id="{{_id_}}" class="attachment"
                            data-element-type="images">
                            <div class="attachment-preview">
                                <div class="thumbnail">
                                    <div class="centered">
                                        <img src="{{_src_}}""
                                             draggable="false" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </textarea>
                            <ul tabindex="-1" class="media-attachments attachments ui-sortable ui-sortable-disabled" >
                            </ul>
                            <div class="media-sidebar">
                                <div tabindex="0" data-id="1097" class="attachment-details save-ready">
                                    <h2> Attachment Details </h2>
                                    <div class="attachment-info">
                                        <div class="thumbnail thumbnail-image">
                                            <div class="centered">
                                                <img src="" draggable="false" alt="">
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="file-url"></div>
                                            <div class="filename"></div>
                                            <div class="uploaded"></div>
                                            <div class="file-size"></div>
                                            <div class="dimensions"></div>
                                            <div style="color: red;" class="button-link delete-attachment">
                                                Delete Permanently
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="attachments-browser" data-media-type="videos" data-filter-trigger="revslider-videos-select">
                    <textarea style="display: none" class="raw_media_element" data-element-type="videos">
                        <li tabindex="0" aria-checked="false" data-id="{{_id_}}" class="attachment"
                            data-element-type="videos">
                            <div class="attachment-preview">
                                <div class="thumbnail">
                                    <div class="centered">
                                        <video>
                                            <source src="{{_src_}}">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </textarea>
                            <ul tabindex="-1" class="media-attachments attachments ui-sortable ui-sortable-disabled" >
                            </ul>
                            <div class="media-sidebar">
                                <div tabindex="0" data-id="1097" class="attachment-details save-ready">
                                    <h2> Attachment Details </h2>
                                    <div class="attachment-info">
                                        <div class="thumbnail thumbnail-image">
                                            <div class="centered">
                                                <video controls>
                                                    <source src="">
                                                </video>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="file-url"></div>
                                            <div class="filename"></div>
                                            <div class="uploaded"></div>
                                            <div class="file-size"></div>
                                            <div class="dimensions"></div>
                                            <div style="color: red;" class="button-link delete-attachment">
                                                Delete Permanently
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="media-frame-toolbar">
                        <div class="media-toolbar">
                            <button type="button" id="revslider-add-image-submit"
                                    class="button media-button button-primary button-large media-button-select" data-filter-trigger="revslider-images-select">Insert
                            </button>
                            <button type="button" id="revslider-add-video-submit"
                                    class="button media-button button-primary button-large media-button-select" data-filter-trigger="revslider-videos-select">Insert
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    public function copy_move_dialog_html($data)
    {
        extract($data['global']['dialog_copy_move']);
        ob_start();
        ?>
        <div id="dialog_copy_move" data-textclose="<?php echo t("Close") ?>"
        data-textupdate="<?php echo t("Do It!") ?>"
        title="<?php echo t("Copy / move slide") ?>" style="display:none">
        <br>
        <?php echo t("Choose Slider") ?>:
        <?php echo $selectSliders ?>
        <br><br>
        <?php echo t("Choose Operation") ?>:
        <input type="radio" id="radio_copy" value="copy" name="copy_move_operation" checked />
        <label for="radio_copy" style="cursor:pointer;"><?php echo t("Copy") ?></label>
        &nbsp; &nbsp;
        <input type="radio" id="radio_move" value="move" name="copy_move_operation" />
        <label for="radio_move" style="cursor:pointer;"><?php echo t("Move") ?></label>

        </div>
        <?php
        return ob_get_clean();
    }
    public function dialog_video_html($data)
    {
        $url = $data['url'];
        extract($data['global']['dialog_video']);
        ob_start();
        ?>
        <!-- //Youtube dialog: -->
        <div id="dialog_video" class="dialog-video" title="<?php echo t('Add Video Layer')?>" style="display:none">

            <form id="video_dialog_form" name="video_dialog_form" onkeypress="return event.keyCode != 13;">
                <div id="video_content" style="display:none"></div>

                <div id="video-dialog-wrap">
                    <div id="video_dialog_tabs" class="box-closed tp-accordion disabled" style="background:#fff">
                        <ul class="rs-layer-settings-tabs">
                            <li class="selected" data-content="#rs-video-source" id="reset_video_dialog_tab"><i
                                    style="height:45px"
                                    class="rs-mini-layer-icon eg-icon-export rs-toolbar-icon"></i><?php echo t('Source') ?></li>
                            <li class="rs-hide-on-audio" data-content="#rs-video-size"><i style="height:45px; font-size:16px"
                                                                                          class="rs-mini-layer-icon eg-icon-resize-full-alt rs-toolbar-icon"></i><?php echo t('Sizing') ?>
                            </li>
                            <li class="" data-content="#rs-video-settings"><i style="height:45px; font-size:16px"
                                                                              class="rs-mini-layer-icon eg-icon-cog rs-toolbar-icon"></i><?php echo t('Settings') ?>
                            </li>
                            <li class="rs-hide-on-audio" data-content="#rs-video-thumbnails"><i
                                    style="height:45px; font-size:16px"
                                    class="rs-mini-layer-icon eg-icon-eye rs-toolbar-icon"></i><?php echo t('Poster/Mobile Visibility') ?>
                            </li>
                            <li class="" data-content="#rs-video-arguments"><i style="height:45px; font-size:16px"
                                                                               class="rs-mini-layer-icon eg-icon-th rs-toolbar-icon"></i><?php echo t('Arguments') ?>
                            </li>
                        </ul>
                        <div style="clear:both"></div>
                    </div>

                </div>

                <div id="rs-video-source">
                    <!-- Type chooser -->
                    <div id="video_type_chooser" class="video-type-chooser" style="margin-bottom:25px">
                        <label><?php echo t('Choose video type') ?></label>
                        <input type="radio" id="video_radio_youtube" name="video_select">
                        <span for="video_radio_youtube"><?php echo t('YouTube') ?></span>
                        <input type="radio" id="video_radio_vimeo" name="video_select" style="margin-left:20px">
                        <span for="video_radio_vimeo"><?php echo t('Vimeo') ?></span>
                        <input type="radio" id="video_radio_html5" name="video_select" style="margin-left:20px">
                        <span for="video_radio_html5"><?php echo t('HTML5') ?></span>

                        <span class="rs-show-when-youtube-stream" style="display: none;">
					<input type="radio" id="video_radio_streamyoutube" name="video_select" style="margin-left:20px">
					<span for="video_radio_streamyoutube"><?php echo t('From Stream') ?></span>
				</span>
                        <span class="rs-show-when-vimeo-stream" style="display: none;">
					<input type="radio" id="video_radio_streamvimeo" name="video_select" style="margin-left:20px">
					<span for="video_radio_streamvimeo"><?php echo t('From Stream') ?></span>
				</span>
                        <span class="rs-show-when-instagram-stream" style="display: none;">
					<input type="radio" id="video_radio_streaminstagram" name="video_select" style="margin-left:20px">
					<span for="video_radio_streaminstagram"><?php echo t('From Stream') ?></span>
				</span>

                        <input type="radio" id="video_radio_audio" name="video_select" style="display: none;">
                    </div>


                    <!-- Vimeo block -->
                    <div id="video_block_vimeo" class="video-select-block" style="display:none;">
                        <label><?php echo t('Vimeo ID or URL') ?></label>
                        <input type="text" id="vimeo_id" value="">
                        <input type="button" style="vertical-align:middle" id="button_vimeo_search"
                               class="button-regular video_search_button" value="search">
                        <span class="video_example"><?php echo t('example: 30300114') ?></span>
                        <img id="vimeo_loader" src="<?php echo $url['gif_vimeo_loader'] ?>" style="display:none">
                    </div>

                    <!-- Youtube block -->
                    <div id="video_block_youtube" class="video-select-block">
                        <label><?php echo t('YouTube ID or URL') ?></label>
                        <input type="text" id="youtube_id" value="">
                        <input type="button" style="vertical-align:middle" id="button_youtube_search"
                               class="button-regular video_search_button" value="search">
                        <span class="video_example"><?php echo t('example') ?>
                    : <?php echo $youtube_video_example ?></span>
                        <img id="youtube_loader" src="<?php echo $url['gif_youtube_loader'] ?>" style="display:none">
                    </div>

                    <!-- Html 5 block -->
                    <div id="video_block_html5" class="video-select-block" style="display:none;">
                        <label><?php echo t('Poster Image Url') ?></label>
                        <input style="width:330px" type="text" id="html5_url_poster" name="html5_url_poster" value="">
                        <span class="imgsrcchanger-div" style="margin-left:20px;">
					<a href="javascript:void(0)"
                       class="button-image-select-html5-video button-primary revblue"><?php echo t('Choose from Library') ?></a>
				</span>
                        <span class="video_example">&nbsp;</span>


                        <label><?php echo t('Video MP4 Url') ?></label>
                        <input style="width:330px" type="text" id="html5_url_mp4" name="html5_url_mp4" value="">
                        <span class="vidsrcchanger-div" style="margin-left:20px;">
					<a href="javascript:void(0)" data-inptarget="html5_url_mp4"
                       class="button_change_video button-primary revblue"><?php echo t('Choose from Library') ?></a>
				</span>
                        <span class="video_example"><?php echo t("example") ?>
                    : http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4</span>

                        <label><?php echo t('Video WEBM Url') ?></label>
                        <input style="width:330px" type="text" id="html5_url_webm" name="html5_url_webm" value="">
                        <span class="vidsrcchanger-div" style="margin-left:20px;">
					<a href="javascript:void(0)" data-inptarget="html5_url_webm"
                       class="button_change_video button-primary revblue"><?php echo t('Choose from Library') ?></a>
				</span>
                        <span class="video_example"><?php echo t('example') ?>
                    : http://clips.vorwaerts-gmbh.de/big_buck_bunny.webm</span>

                        <label><?php echo t('Video OGV Url') ?></label>
                        <input style="width:330px" type="text" id="html5_url_ogv" name="html5_url_ogv" value="">
                        <span class="vidsrcchanger-div" style="margin-left:20px;">
					<a href="javascript:void(0)" data-inptarget="html5_url_ogv"
                       class="button_change_video button-primary revblue"><?php echo t('Choose from Library') ?></a>
				</span>
                        <span class="video_example"><?php echo t('example') ?>
                    : http://clips.vorwaerts-gmbh.de/big_buck_bunny.ogv</span>

                    </div>

                    <div id="video_block_audio" class="video-select-block" style="display:none;">
                        <label><?php echo t('Audio Url') ?></label>
                        <input style="width:330px" type="text" id="html5_url_audio" name="html5_url_audio" value="">
                        <span class="vidsrcchanger-div" style="margin-left:20px;">
					<a href="javascript:void(0)" data-inptarget="html5_url_audio"
                       class="button_change_video button-primary revblue"><?php echo t('Choose from Library') ?></a>
				</span>
                    </div>
                </div>


                <div id="rs-video-size" style="display:none">
                    <!-- Video Sizing -->
                    <div id="video_size_wrapper" class="youtube-inputs-wrapper">
                        <label for="input_video_fullwidth"><?php echo t('Full Screen:') ?></label>
                        <input type="checkbox" class="tp-moderncheckbox rs-staticcustomstylechange tipsy_enabled_top"
                               id="input_video_fullwidth">
                        <div class="clearfix mb10"></div>
                    </div>

                    <label for="input_video_cover" class="video-label"><?php echo t('Force Cover:') ?></label>
                    <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox mb10" id="input_video_cover">

                    <div id="fullscreenvideofun1" class="video-settings-line mb10">
                        <label for="input_video_dotted_overlay" class="video-label" id="input_video_dotted_overlay_lbl">
                            <?php echo t('Dotted Overlay:') ?>
                        </label>
                        <select id="input_video_dotted_overlay" style="width:100px">
                            <option value="none"><?php echo t('none') ?></option>
                            <option value="twoxtwo"><?php echo t('2 x 2 Black') ?></option>
                            <option value="twoxtwowhite"><?php echo t('2 x 2 White') ?></option>
                            <option value="threexthree"><?php echo t('3 x 3 Black') ?></option>
                            <option value="threexthreewhite"><?php echo t('3 x 3 White') ?></option>
                        </select>
                        <div class="clearfix mb10"></div>
                        <label for="input_video_ratio" class="video-label" id="input_video_ratio_lbl">
                            <?php echo t('Aspect Ratio:') ?>
                        </label>
                        <select id="input_video_ratio" style="width:100px">
                            <option value="16:9"><?php echo t('16:9') ?></option>
                            <option value="4:3"><?php echo t('4:3') ?></option>
                        </select>
                    </div>
                    <div id="video_full_screen_settings" class="video-settings-line">
                        <div class="mb10">
                            <label for="input_video_leave_fs_on_pause"><?php echo t('Leave Full Screen on Pause/End:') ?></label>
                            <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox"
                                   id="input_video_leave_fs_on_pause">
                        </div>
                    </div>
                </div>

                <div id="rs-video-settings" style="display:none">
                    <div class="mb10">
                        <label for="input_video_loop"><?php echo t("Loop:") ?></label>
                        <select id="input_video_loop" style="width: 200px;">
                            <option value="none"><?php echo t('Disable') ?></option>
                            <option class="rs-hide-on-audio" value="loop"><?php echo t('Loop, Slide is paused') ?></option>
                            <option class="rs-hide-on-audio"
                                    value="loopandnoslidestop"><?php echo t('Loop, Slide does not stop') ?></option>
                            <option class="rs-show-on-audio" value="loopandnoslidestop"><?php echo t('Loop Segment') ?></option>
                        </select>
                    </div>

                    <div class="mb10">
                        <label for="input_video_autoplay"><?php echo t('Autoplay:') ?></label>
                        <select id="select_video_autoplay">
                            <option value="false"><?php echo t('Off') ?></option>
                            <option value="true"><?php echo t('On') ?></option>
                            <option value="1sttime"><?php echo t('On 1st Time') ?></option>
                            <option value="no1sttime"><?php echo t('Not on 1st Time') ?></option>
                        </select>
                    </div>

                    <div class="mb10">
                        <label for="input_video_stopallvideo"><?php echo t('Stop Other Media:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_stopallvideo">
                    </div>

                    <div class="mb10 hide-for-vimeo rs-hide-on-audio">
                        <label for="input_video_allowfullscreen"><?php echo t('Allow FullScreen:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_allowfullscreen">
                    </div>

                    <div class="mb10">
                        <label for="input_video_nextslide"><?php echo t('Next Slide On End:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_nextslide">
                    </div>

                    <div class="mb10">
                        <label for="input_video_force_rewind"><?php echo t('Rewind at Slide Start:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_force_rewind">
                    </div>

                    <div class="mb10">
                        <label for="input_video_control"><?php echo t('Hide Controls:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_control">
                        <span style="vertical-align:middle; margin-left:15px; display:none"
                              class="description hidecontroldepend"><?php echo t('Layer Action may needed to start/stop Video') ?></span>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            jQuery('#input_video_control').on('change', function () {
                                if (jQuery(this).attr('checked') === "checked")
                                    jQuery('.hidecontroldepend').show();
                                else
                                    jQuery('.hidecontroldepend').hide();
                            })
                        });
                    </script>

                    <div class="mb10 rs-hide-on-audio">
                        <label for="input_video_mute"><?php echo t('Mute:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_mute">
                    </div>

                    <div class="mb10 video-volume">
                        <label for="input_video_volume"><?php echo t('Volume (0 - 100):') ?></label>
                        <input type="text" class="input_video_dialog" style="width: 50px;" id="input_video_volume">
                    </div>

                    <div class="mb10">
                        <span class="rs-hide-on-audio"><label for="input_video_start_at"><?php echo t('Start at:') ?></label></span>
                        <span class="rs-show-on-audio"><label
                                for="input_video_start_at"><?php echo t('Segment Start:') ?></label></span>
                        <input type="text" id="input_video_start_at" style="width: 50px;"> <?php echo t('i.e.: 0:17') ?>
                    </div>

                    <div class="mb10">
                        <span class="rs-hide-on-audio"><label for="input_video_end_at"><?php echo t('End at:') ?></label></span>
                        <span class="rs-show-on-audio"><label for="input_video_end_at"><?php echo t('Segment End:') ?></label></span>
                        <input type="text" id="input_video_end_at" style="width: 50px;"> <?php echo t('i.e.: 2:41') ?>
                    </div>

                    <div class="mb10 rs-hide-on-audio">
                        <label for="input_video_show_cover_pause"><?php echo t('Show Cover at Pause:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox"
                               id="input_video_show_cover_pause">
                    </div>

                    <div class="mb10 rs-show-on-audio">
                        <label for="input_video_show_visibility"><?php echo t('Invisible on Frontend:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_show_visibility">
                    </div>

                    <div id="rev-youtube-options" class="video-settings-line mb10 rs-hide-on-audio">
                        <div class="mb10">
                            <label for="input_video_speed"><?php echo t('Video Speed:') ?></label>
                            <select id="input_video_speed" style="width:75px">
                                <option value="0.25"><?php echo t('0.25') ?></option>
                                <option value="0.50"><?php echo t('0.50') ?></option>
                                <option value="1" selected="selected"><?php echo t('1') ?></option>
                                <option value="1.5"><?php echo t('1.5') ?></option>
                                <option value="2"><?php echo t('2') ?></option>
                            </select>
                        </div>
                        <div class="mb10">
                            <label for="input_video_play_inline"><?php echo t('Play Video Inline:') ?></label>
                            <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_video_play_inline">
                        </div>
                    </div>

                    <div class="mb10 rs-show-on-audio" style="display: none">
                        <div class="mb10">
                            <label for="input_audio_preload" class="video-label">
                                <?php echo t("Audio Preload:") ?>
                            </label>
                            <select id="input_audio_preload" style="width:200px">
                                <option value="none"><?php echo t('Disable') ?></option>
                                <option value="metadata"><?php echo t('Metadata') ?></option>
                                <option value="progress"><?php echo t('Progress') ?></option>
                                <option value="canplay"><?php echo t('Can Play') ?></option>
                                <option value="canplaythrough"><?php echo t('Can Play Through') ?></option>
                            </select>
                        </div>
                        <div class="mb10">
                            <label for="input_audio_preload" class="video-label">
                                <?php echo t("Ignore Preload after ") ?>
                            </label>
                            <select id="input_video_preload_wait">
                                <option value="0"><?php echo t('0') ?></option>
                                <option value="1"><?php echo t('1') ?></option>
                                <option value="2"><?php echo t('2') ?></option>
                                <option value="3"><?php echo t('3') ?></option>
                                <option value="4"><?php echo t('4') ?></option>
                                <option value="5"><?php echo t('5') ?></option>
                                <option value="6"><?php echo t('6') ?></option>
                                <option value="7"><?php echo t('7') ?></option>
                                <option value="8"><?php echo t('8') ?></option>
                                <option value="9"><?php echo t('9') ?></option>
                                <option value="10"><?php echo t('10') ?></option>
                            </select><?php echo t(" seconds") ?>
                        </div>
                    </div>

                    <div id="rev-html5-options" style="display: none;">

                        <div class="mb10">
                            <label for="input_video_preload" class="video-label">
                                <?php echo t("Video Preload:") ?>
                            </label>
                            <select id="input_video_preload" style="width:200px">
                                <option value="auto"><?php echo t('Auto') ?></option>
                                <option value="none"><?php echo t('Disable') ?></option>
                                <option value="metadata"><?php echo t('Metadata') ?></option>
                            </select>
                        </div>

                        <div class="mb10">
                            <label for="input_video_large_controls"><?php echo t('Large Controls:') ?></label>
                            <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox"
                                   id="input_video_large_controls">
                        </div>
                    </div>
                </div>

                <div id="rs-video-thumbnails" style="display:none">
                    <div id="preview-image-video-wrap" class="mb10">
                        <label><?php echo t('Poster Image') ?></label>
                        <input type="text" class="checkbox_video_dialog " id="input_video_preview">
                        <input type="button" id="" class="button-image-select-video button-primary revblue"
                               value="<?php echo t('Image Library') ?>">
                        <input type="button" id="" class="button-image-select-video-default button-primary revblue"
                               value="<?php echo t('Video Thumbnail') ?>">
                        <input type="button" id="" class="button-image-remove-video button-primary revblue"
                               value="<?php echo t('Remove') ?>">
                        <div class="clear"></div>
                    </div>

                    <div class="mb10">
                        <label for="input_disable_on_mobile"><?php echo t('Disable Video and Show<br>only Poster on Mobile:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_disable_on_mobile">
                    </div>

                    <div class="mb10">
                        <label for="input_use_poster_on_mobile"><?php echo t('No Poster on Mobile:') ?></label>
                        <input type="checkbox" class="checkbox_video_dialog tp-moderncheckbox" id="input_use_poster_on_mobile">
                        <div style="width:100%;height:10px"></div>
                    </div>

                </div>

                <div id="rs-video-arguments" style="display:none">
                    <div>
                        <label><?php echo t('Arguments:') ?></label>
                        <input type="text" id="input_video_arguments" style="width:350px;" value=""
                               data-youtube="<?php echo $default_youtube_arguments ?>"
                               data-vimeo="<?php echo $default_vimeo_arguments ?>">
                    </div>
                </div>

                <div class="add-button-wrapper" style="margin-left:25px;">
                    <a href="javascript:void(0)" class="button-primary revblue" id="button-video-add"
                       data-textadd="<?php echo t('Add This Video') ?>"
                       data-textupdate="<?php echo t('Update Video') ?>" style="display:none"><?php echo t('Add This Video') ?></a>
                    <a href="javascript:void(0)" class="button-primary revblue" style="display: none;" id="button-audio-add"
                       data-textadd="<?php echo t('Add This Audio') ?>"
                       data-textupdate="<?php echo t('Update Audio') ?>"><?php echo t('Add This Audio') ?></a>
                </div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}