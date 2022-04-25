tinymce.init({
	selector: "textarea",
	plugins: [
		"paste"
	],
	toolbar: "undo redo | bold italic | alignleft | numlist ",
	menubar:false,
    statusbar: false,
	content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
	height: 200	
});

