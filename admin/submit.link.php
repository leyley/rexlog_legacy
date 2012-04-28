<?PHP
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<?php
require_once(dirname(__FILE__)."/../include/link.php");

$content=$_POST['link_content'];

if(!link_nav_update($content))
	$error=geterror();
?>

<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=link&error=<?PHP echo $error; ?>":"?path="+url;
</script>

