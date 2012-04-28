<?PHP
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<?php
require_once(dirname(__FILE__)."/../include/page.php");
if($_GET['act'])
{
	switch($_GET['act'])
	{
		case 'add':
			if (get_magic_quotes_gpc())
			{
				$content = stripslashes($_POST['page_content']);
			}
			else
			{
				$content = $_POST['page_content'];
			}
			if(!page_new($_POST['page_name'],$content,$_GET['php']))
				$error=geterror();
			break;
		case 'del':
			if(!page_del($_GET['name']))
				$error=geterror();
			break;
		case 'php_switch':
			$page_php_supported=$_GET['php']!=null?$_GET['php']:0;
			$strs=file_get_contents(dirname(__FILE__)."/template.config.page.php");
			$strs=str_replace("{page_php_supported}",$page_php_supported,$strs);
			file_put_contents(dirname(__FILE__)."/../data/config.page.php",$strs);
			break;
		default:
			break;
	}
}
?>

<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=page&error=<?PHP echo $error; ?>":"?path="+url;
</script>
