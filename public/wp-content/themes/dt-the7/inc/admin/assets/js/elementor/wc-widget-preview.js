(function ($) {

    // Make sure you run this code under Elementor.
    $(window).on("elementor/frontend/init", function () {
        var carouselRefreshTimeout;
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:thumbs_width", refreshProduct);
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:thumbs_items", refreshProduct);
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:thumbs_spacing", refreshProduct);
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:thumbs_preserve_ratio", refreshProduct);
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:thumbs_side_ratio", refreshProduct);

        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:gallery_spacing", refreshProduct);
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:gallery_image_border_width", refreshProduct);
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:gallery_ratio", refreshProduct);
        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:gallery_preserve_ratio", refreshProduct);

        elementorEditorAddOnChangeHandler("the7-woocommerce-product-images:show_image_zoom", refreshProduct);

        function refreshProduct(controlView, widgetView) {
            clearTimeout(carouselRefreshTimeout);
            var $widget = window.jQuery(widgetView.$el);
            var galleryData = $widget.data('productGallery');
            if (typeof galleryData !== 'undefined'){
                galleryData.clearPrecisionSizes();
                carouselRefreshTimeout = setTimeout(function () {
                    galleryData.refresh();
                }, 600);
            }
        }

        elementorFrontend.hooks.addAction("frontend/element_ready/the7-woocommerce-product-images.default", function ($widget, $) {
            $( document ).ready(function() {
                $widget.productGallery();
                var debounceResize = debounce(function(){
                    var galleryData = $widget.data('productGallery');
                    if (typeof galleryData !== 'undefined'){
                        galleryData.refresh();
                    }
                },600);
                var $gallery = $widget.find(".dt-wc-product-gallery");
                var lastWidth = $gallery.width();
                function checkWidthChanges()
                {
                    if ($gallery.width() !== lastWidth)
                    {
                        debounceResize();
                        lastWidth = $gallery.width();
                    }
                    setTimeout(checkWidthChanges, 500);
                }
                checkWidthChanges();
            });
        })
    });
    function elementorEditorAddOnChangeHandler(widgetType, handler) {
        widgetType = widgetType ? ":" + widgetType : "";
        elementor.channels.editor.on("change" + widgetType, handler);
    }

    function debounce(func, wait, immediate) {
        if (immediate === void 0) {
            immediate = false;
        }
        var timeout;
        return function () {
            var context = this, args = arguments;
            timeout !== null && clearTimeout(timeout);
            timeout = window.setTimeout(function () {
                timeout = null;
                if (!immediate)
                    func.apply(context, args);
            }, wait);
            if (immediate && !timeout)
                func.apply(context, args);
        };
    }

})(jQuery);