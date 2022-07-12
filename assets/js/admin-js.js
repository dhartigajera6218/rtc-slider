jQuery(document).ready(function ($) {
    $('.rtc-image-upload .dashicons.dashicons-no ').on('click', function () {
        $(this).parents('li').remove();
        return false;
    });

    $( ".rtc-image-upload ul" ).sortable();

    var meta_image_frame;
    $('.image-upload').click(function (e) {
        e.preventDefault()
        var meta_image = $(this).parent().children('.meta-image')
        if (meta_image_frame) {
            meta_image_frame.open()
            return
        }
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            multiple: true,
            button: {
                text: meta_image.button,
            },
        })
        meta_image_frame.on('select', function () {
            var media_attachment = meta_image_frame
                    .state()
                    .get('selection')
            
            var i = 0;
            media_attachment.each(function(attachment) {
                $('.rtc-image-upload ul').append('<li><span class="image-preview"><img src="'+attachment.attributes.url+'"><input type="hidden" name="rtc_image[]" id="rtc_image_'+i+'" class="meta-image" value="'+attachment.attributes.url+'"></span><i class=" dashicons dashicons-no delete-img"></i></li>');
                i++;
            });
        })
        meta_image_frame.open()
    })
});