$(document).ready(function(){
	$("#username").focus();
	$("#password").hide();
	
	$("#title").focus();
	
	$("#pwrow").toggle();
	
	CKEDITOR.replace("blogBody", {
        filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
        filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
        filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        toolbar : [
           ['Preview'],
           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
           ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
           '/',
           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
           ['Link','Unlink','Anchor'],
           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
           '/',
           ['Styles','Format','Font','FontSize'],
           ['TextColor','BGColor'],
           ['Maximize', 'ShowBlocks']
    	]
	}).addCss( 'body { font-family: Georgia, serif; }' );
});

function showText(id) {
	clearText();
	
	document.getElementById(id).style.display = "block";
}

function clearText() {
	document.getElementById('zText').style.display = "none";
	document.getElementById('aText').style.display = "none";
	document.getElementById('cText').style.display = "none";
	document.getElementById('hText').style.display = "none";
}

function showPassword () {
	if ($("#username").val() == "austin" || $("#username").val() == "melissa") {
		$("#password").show();
	} else {
		$("#password").hide();
	}
}
