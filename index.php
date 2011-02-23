<?php
	require_once("header.php");
?>

<div style="display:block;width:100%;text-align:center;">
	<div id="zach">
		<a href="#" id="z" onmouseover="showText('zText')" onmouseout="clearText()">
			<span id="zText">Zach Family<br /><i style="font-weight:normal;">(About Us)</i></span>
		</a>
		<a href="#" id="a" onmouseover="showText('aText')" onmouseout="clearText()">
			<span id="aText">Albums</span>
		</a>
		<a href="#" id="c" onmouseover="showText('cText')" onmouseout="clearText()">
			<span id="cText">Careers</span>
		</a>
		<a href="blog.php" id="h" onmouseover="showText('hText')" onmouseout="clearText()">
			<span id="hText">Home Life</span>
		</a>
	</div>

	<div id="scripture">
		<span style="font-weight:normal;">"How can I ever express the happiness of the marriage that is joined together by the Church, strengthened by an offering, sealed by a blessing, announced by angels and ratified by the Father? ...How wonderful the bond between two believers with a single hope, a single desire, a single observance, a single service! They are both brethren and both fellow-servants; there is no separation between them in spirit or flesh; in fact they are truly two in one flesh and where the flesh is one, one is the spirit."</span> - Tertullian
	</div>
</div>

<?php require_once("footer.php"); ?>
