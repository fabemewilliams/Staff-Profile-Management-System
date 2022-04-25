tinymce.init({
	selector: "textarea",
	plugins: [
		"code ",
		"paste"
	],
	toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code ",
	menubar:false,
    statusbar: false,
	content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
	height: 200	
});


$( document ).ready(function() {	
	$(document).on('submit','#posts', function(event){
		var formData = $(this).serialize();
		$.ajax({
                url: "action.php",
                method: "POST",              
                data: formData,
				dataType:"json",
                success: function(data) {     
					var html = $("#postHtml").html();					
					html = html.replace(/USERNAME/g, data.user);
					html = html.replace(/POSTDATE/g, data.post_date);
					html = html.replace(/POSTMESSAGE/g, data.message);
					$("#postLsit").append(html).fadeIn('slow');
					tinymce.get('message').setContent('');
                }
        });		
		return false;
	});
});