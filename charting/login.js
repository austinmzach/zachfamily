$(document).ready(function(){
	$("#firstname").hide();
	$("#lastname").hide();
	$("#confirmpw").hide();
	document.getElementById("username").focus();
});

function register() {
	$("#firstname").show();
	$("#lastname").show();
	$("#confirmpw").show();
	$("#register").hide();

	document.getElementById("firstnameinput").focus();
}
