$(document).ready(function() {
$('.summernote').summernote({
		placeholder: "Let's write",
		height: 400,
		fontSizes: ['12', '14', '16', '18', '24', '36', '48'],
		toolbar: [
		// [groupName, [list of button]]
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough', 'superscript', 'subscript']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']]
		],
		disableDragAndDrop: true,
		shortcut: false,
		callbacks: {	//FORCE PLAIN TEXT PASTING
		onPaste: function (e) {
		var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

		e.preventDefault();

		// Firefox fix
		setTimeout(function () {
			document.execCommand('insertText', false, bufferText);
		}, 10);
		}
		}
		});
});