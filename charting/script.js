$(document).ready(function(){
	
	window.onscroll = positionTheWrapper;
	
	jQuery.scrollTo('max', { duration: 1500 });
	
	$("#cancel").click(function() {
		$("#datePreview").text(" ");
		$("#line1Preview").text(" ");
		$("#line2Preview").text(" ");
		document.getElementById("intercoursePreview").style.display = "none";
		document.getElementById("backgroundPreview").style.background = "white";
		closeDialog();
	});
	
	$("#date").datepicker();
	
	$("#date").bind("change", function() {
		var date = $("#date").val();
		
		var month, day;
		if (parseInt(date.substring(0, 2), 10) < 10)
			month = date.substring(1, 2);
		else
			month = date.substring(0, 2);

		if (parseInt(date.substring(3, 5), 10) < 10)
			day = date.substring(4, 5);
		else
			day = date.substring(3, 5);
		
		var newDate = month + "/" + day;
		$("#datePreview").text(newDate);
	});
	
	$("#line1").keyup(function() {
		if ($("#line1").val() == "")
			$("#line1Preview").text(" ");
		else
			$("#line1Preview").text($("#line1").val());
	});
	
	$("#line2").keyup(function() {
		if ($("#line2").val() == "")
			$("#line2Preview").text(" ");
		else
			$("#line2Preview").text($("#line2").val());
	});
	
	$("#background").bind("change", function() {
		if ($("#background").val() != "")
			document.getElementById("backgroundPreview").style.background = $("#background").val();
		else
			return false;
	});
	
	$("#dialog").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		draggable: false,
		width: 450
	});
	
	$("#intercourse").click(function() {
		var ip = document.getElementById("intercoursePreview");
		if (ip.style.display == "none")
			ip.style.display = "block";
		else
			ip.style.display = "none";
	});
});

function openDialog() {
	document.getElementById("dialogWrapper").style.display = "block";

	wrapper = document.getElementById("dialogWrapper");
	
	shadow = document.getElementById("dialogShadow");
	shadow.style.top = (wrapper.scrollHeight - shadow.scrollHeight)/2 + "px";
	shadow.style.left = (wrapper.scrollWidth - shadow.scrollWidth)/2 + "px";
	
	content = document.getElementById("dialogContent");
	content.style.top = (wrapper.scrollHeight - shadow.scrollHeight)/2 + "px";
	content.style.left = (wrapper.scrollWidth - shadow.scrollWidth)/2 + "px";
}

function closeDialog() {
	document.getElementById("dialogWrapper").style.display = "none";
}

function positionTheWrapper() {
	var pos = f_scrollTop();
	document.getElementById("dialogWrapper").style.top = pos + 'px';
}

function f_scrollTop() {
	return f_filterResults (
		window.pageYOffset ? window.pageYOffset : 0,
		document.documentElement ? document.documentElement.scrollTop : 0,
		document.body ? document.body.scrollTop : 0
	);
}

function f_filterResults(n_win, n_docel, n_body) {
	var n_result = n_win ? n_win : 0;
	if (n_docel && (!n_result || (n_result > n_docel)))
		n_result = n_docel;
	return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
}