<html>
<head>
<style type="text/css">
<!--
body {
	background-color: #000000;
	color: #e8f4f8;
	font-size:14px
}
	:link {
	color: #FFFFFF;
}
-->
</style>
</head>
<body>
<center>

<?php
if (!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__).'/../../../');
require_once('../../../wp-admin/admin.php');
$siteurl = get_option('siteurl');

$skofferid = $_GET['skofferid'];
$skofferid= preg_replace ("/[^A-Za-z0-9.-]/","",$skofferid);


if (isset($_GET["skofferid"]))
 
echo "<script language=\"javascript\" type=\"text/javascript\" src=\"$siteurl/wp-includes/js/tinymce/tiny_mce_popup.js\"></script>";

else

echo "<script type=\"text/javascript\">
    if (navigator.javaEnabled() != true) {
    alert(\"Sorry, the screen-recorder can not start. Java has to be enabled in your browser. Please go to www.java.com to download the latest version.\");
	document.write(\"Sorry, Java is not enabled in your browser.<br />Java is available from <a href='http://www.java.com' target='_blank'>http://www.java.com</a>\");
	} 
  </script>
  <center><applet code=\"com.skoffer.SkofferApplet\" archive=\"http://api.skoffer.com/v1/skoffer.jar\" name=\"Skoffer.com Screencast Recorder\" width=\"200\" height=\"180\" MAYSCRIPT></center>";
?>

<script language="javascript" type="text/javascript">
    
function skoffer_insert() {


var text = "[skoffer <?php echo $skofferid ?>]";
		
	if(window.tinyMCE) {
		var ed = tinyMCE.activeEditor;
		ed.execCommand('mceInsertContent', false, '<p>' + text + '</p>');
		ed.execCommand('mceCleanup');
		tinyMCEPopup.close();
	}
	return true;
}

</script>

<?php

   if (isset($_GET["skofferid"]))
   
   if($skofferid == "")
   
    {    
echo "<script language=\"javascript\" type=\"text/javascript\">
tinyMCEPopup.close();
</script>";
    }
	
  else
  
    {
echo "<script language=\"javascript\" type=\"text/javascript\">
skoffer_insert(); 
</script>";
    }

?>


</center>
</body>
</html>