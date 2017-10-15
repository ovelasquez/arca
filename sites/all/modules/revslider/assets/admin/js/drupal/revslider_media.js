/**
 * Created by Vh on 8/8/2017.
 */
var RevSliderMedia = {};
RevSliderMedia.init = function (args) {
    var $ = jQuery;
    var _this = this;
    _this.main = $('#revslider-media-modal');
    this.raw_media_element = {};
    _this.main.find('.raw_media_element').each(function () {
        var type = $(this).attr('data-element-type');
        if(type)
            _this.raw_media_element[type] = $(this).val();
    });
    this.fields = {};
    //attachments-browser
    _this.main.find('.attachments-browser').each(function () {
        var type = $(this).attr('data-media-type');
        if(!type)
            return;
        _this.fields[type] = $(this);
    });
    _this.main.find('.attachments-browser').on('click','.attachment',function () {
        $(this).parent().find('.attachment').removeClass('selected');
        $(this).addClass('selected');
    });
    _this.main.on('click','.attachment',function () {
        var id = $(this).attr('data-id');
        var type=$(this).attr('data-element-type');
        _this.attachInfo({
            type:type,
            id:id
        });
    });
    _this.main.find('.delete-attachment').on('click',function () {
        RevSliderMedia.removeMedia();
    });
    _this.main.find('.media-modal-close').on('click',function () {
        RevSliderMedia.hide();
    });
    _this.main.find('.media-router .media-menu-item').on('click',function () {
        $(this).parent().find('.media-menu-item').removeClass('active');
        $(this).addClass('active');
        var target = $(this).attr('data-target');
        _this.main.find('[data-filter-trigger]').hide();
        _this.main.find('[data-filter-trigger="'+ target +'"]').show();
        _this.main.find('.delete-attachment').hide();
    });
    _this.main.find('#revslider-add-image-submit').on('click',function () {
        var media_selected = _this.attach_element;
        var data_media = {
            url:media_selected['src'],
            id:media_selected['id'],
            width:media_selected['dimensions']['width'],
            height:media_selected['dimensions']['height']
        };
        if(typeof window.send_to_editor === 'function')
        {
            window.send_to_editor(data_media)
        }
    });
    _this.main.find('#revslider-add-video-submit').on('click',function () {
        var media_selected = _this.attach_element;
        var data_media = {
            url:media_selected['src'],
            id:media_selected['id'],
            width:media_selected['dimensions']['width'],
            height:media_selected['dimensions']['height']
        };
        if(typeof window.send_to_editor === 'function')
        {
            window.send_to_editor(data_media)
        }
    });
    var upload_mask_click = false;
    _this.main.find('#revslider-media-upload').on('click',function () {
        if(!upload_mask_click)
            return false;
        upload_mask_click = false;
    });
    _this.main.find('#revslider-media-upload-mask').css('z-index',_this.main.find('#revslider-media-upload').css('z-index'));
    _this.main.find('#revslider-media-upload-mask').on('click',function () {
        upload_mask_click = true;
    });
    _this.main.find('#revslider-media-upload').on('change',function () {
        var message_field = _this.main.find('.upload-message');
        if(this.files.length < 1)
        {
            //No items found.
            message_field.text("No items found.");
            return;
        }
        var current_file = this.files[0];
        var types_allow = ['image','video','audio'];
        var pass_type_check = false;
        types_allow.forEach(function (type) {
            if(current_file.type.indexOf(type) === 0)
                pass_type_check = true;
        });
        if(pass_type_check)
        {
            message_field.text(this.files[0].name);
            _this.upload();
            return;
        }
        message_field.text('Please upload file type image or video');
        $(this).val('');
    });
    this.inited = true;
};
RevSliderMedia.upload = function () {
    var media_upload = RevSliderMedia.main.find('#revslider-media-upload')[0].files;
    if(media_upload.length < 1)
        return;
    RevSliderMedia.main.find('a[data-target="revslider-media-uploading"]').click();
    var data = new FormData();
    data.append('media_upload',media_upload[0]);
    data.append('route','media');
    data.append('action','upload_media');
    RevSliderMedia.main.find('#revslider-media-upload').val('');
    jQuery.ajax({
        url: ajaxurl,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        dataType:'JSON',
        success:function (response) {
            RevSliderMedia.ajaxSuccess(response);
        }
    });
};
RevSliderMedia.ajaxSuccess = function (response) {
    RevSliderMedia.data = response;
    RevSliderMedia.showMedia();
};
RevSliderMedia.show = function (args) {
    var action = (args && args.action) ? args.action : '';
    var select = (args && args.select) ? args.select : '';
    if(select !== '' )
    {
        RevSliderMedia.type_selected = select;
        RevSliderMedia.main.find('[data-media-type]').hide();
        RevSliderMedia.main.find('[data-media-type="'+select+'"]').show();
    }
    if(action == 'upload')
        RevSliderMedia.main.find('[data-target="revslider-media-uploader"]').click();
    else
    {
        RevSliderMedia.loadMedia();
        if(select !== '' )
            RevSliderMedia.main.find('[data-target="revslider-'+select+'-select"]').click();
        else
            RevSliderMedia.main.find('[data-target="revslider-images-select"]').click();
    }
    RevSliderMedia.main.show();
};
RevSliderMedia.hide = function () {
    RevSliderMedia.main.hide();
};
RevSliderMedia.loadMedia = function (args) {
    var force_load = (args && args.reload) ? args.reload : '';
    if(!force_load && typeof RevSliderMedia.data != 'undefined' )
    {
        RevSliderMedia.showMedia();
        return;
    }
    var data = {
        'route':'media'
    };
    jQuery.post({
        url:ajaxurl,
        dataType:'JSON',
        data : data,
        success : function (response) {
            RevSliderMedia.ajaxSuccess(response);
        }
    });
};
RevSliderMedia.removeMedia = function (args) {
    var fid = (RevSliderMedia.attach_element) ? RevSliderMedia.attach_element.id : '';
    if(!fid)
        return;
    if (0 == confirm(rev_lang.really_want_to_delete + " ?"))return !0;
    var data = {
        'route':'media',
        'action':'delete_media',
        'fid':fid
    };
    jQuery.post({
        url:ajaxurl,
        dataType:'JSON',
        data : data,
        success : function (response) {
            RevSliderMedia.ajaxSuccess(response);
        }
    });
};
RevSliderMedia.showMedia = function (args) {
    var _this = RevSliderMedia;
    var select_type = (_this.type_selected) ? _this.type_selected : 'images';
    jQuery('a[data-target="revslider-'+select_type+'-select"]').click();
    jQuery.each(_this.data,function (type,element) {
        var sigle_media_html= _this.raw_media_element[type];
        var attachments_field = _this.fields[type].find('.media-attachments');
        attachments_field.empty();
        jQuery.each(_this.data[type],function () {
            var element_html = sigle_media_html;
            element_html = element_html.replace("{{_id_}}",this.id);
            element_html = element_html.replace("{{_src_}}",this.src);
            attachments_field.prepend(element_html);
        });
        if(select_type == type)
            attachments_field.children().first().click();
    });
};
RevSliderMedia.attachInfo = function (args) {
    var _this = RevSliderMedia;
    var element_data = (args) ? args.data : '';
    if(!element_data)
    {
        var type =(args) ? args.type : '';
        var id = (args) ? args.id : '';
        if(!(type && id))
            return;
        element_data = _this.data[type][id];
    }
    _this.attach_element = element_data;
    var preview_field;
    switch (type)
    {
        case 'images':
            preview_field = _this.fields[type].find('.attachment-info');
            var thumbnail_field = preview_field.find('.thumbnail img');
            thumbnail_field.attr('src',element_data['src']);
            _this.attach_element.dimensions={
                width: thumbnail_field[0].naturalWidth,
                height:thumbnail_field[0].naturalHeight
            };
            preview_field.find('.dimensions').html(_this.attach_element.dimensions.width  + ' x '+ _this.attach_element.dimensions.height);
            break;
        case 'videos':
            preview_field = _this.fields[type].find('.attachment-info');
            var video_field = preview_field.find('.thumbnail video');
            video_field.find('source').attr('src',element_data['src']);
            video_field[0].load();
            _this.attach_element.dimensions = {};
            video_field[0].addEventListener( "loadedmetadata", function (e) {
                _this.attach_element.dimensions={
                    width: video_field[0].videoWidth,
                    height:video_field[0].videoHeight
                };
                preview_field.find('.dimensions').html(_this.attach_element.dimensions.width  + ' x '+ _this.attach_element.dimensions.height);
            }, false );
            break;
    }
    preview_field.find('.file-url').html(element_data['src']);
    preview_field.find('.filename').html(element_data['name']);
    preview_field.find('.uploaded').html(element_data['created']);
    preview_field.find('.file-size').html(element_data['size']);
    preview_field.find('.delete-attachment').show();
};
jQuery(document).ready(function ($) {
    RevSliderMedia.init();
    //RevSliderMedia.show();
});
