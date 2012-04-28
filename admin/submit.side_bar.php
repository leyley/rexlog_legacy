<?PHP
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<?php
require_once(dirname(__FILE__)."/../include/macro_dir.php");

$content=$_POST['side_bar_content'];

file_put_contents($DATA_DIR."/config.side_bar.php",$content);
?>

<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=side_bar":"?path="+url;
</script>
