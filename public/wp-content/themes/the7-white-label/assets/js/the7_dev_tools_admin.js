jQuery(document).ready(function($){
    $('#dt_dev_tool_upload_image_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Image',
            multiple: false
        }).open()
            .on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#dt_dev_tool_upload_image').val(image_url);
                $('#dt_dev_tool_upload_image_thumb').html("<img height='65' src='" + image_url + "'/>");
            });
    });

    $('#dt_dev_tool_delete_image_button').click(function(e) {
        $('#dt_dev_tool_upload_image').val("");
        $('#dt_dev_tool_upload_image_thumb').html("");
    });

    $('#dt-checkbox-custom-descr').change(function() {
	    if (this.checked) {
			$("#the7-dashboard.dt-dev-tools .dt-custom-descr").show();
	    } else {
			$("#the7-dashboard.dt-dev-tools .dt-custom-descr").hide();		    
	    };

        $("#the7-dashboard.dt-dev-tools .dt-custom-descr :input").prop("disabled", !this.checked);
    });

    if (!$('#dt-checkbox-custom-descr').is(':checked')) {
		$("#the7-dashboard.dt-dev-tools .dt-custom-descr").hide();
	    $("#the7-dashboard.dt-dev-tools .dt-custom-descr :input").prop("disabled", true);
	}
});