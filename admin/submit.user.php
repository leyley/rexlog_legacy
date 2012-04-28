<?PHP
if(!defined("ADMIN_IN"))
{
    header("Location:../");
    exit();
}
?>
<?PHP
if(!$_POST['admin_username'] || !$_POST['admin_password'] || !$_POST['admin_password_confirm'] || $_POST['admin_password']!=$_POST['admin_password_confirm'])
{
?>
<script language="JavaScript">
location.href="?path=admin&redirect=user&error=-3";
</script>
<?PHP
}
else
{
$strs=file_get_contents(dirname(__FILE__)."/template.config.admin.php");
$strs=str_replace("{admin_username}",$_POST['admin_username'],$strs);
$strs=str_replace("{admin_password}",md5($_POST['admin_password']),$strs);
if(!file_put_contents(dirname(__FILE__)."/../data/config.admin.php",$strs))
	$error=-1;
}
?>
<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=user&error=<?PHP echo $error; ?>":"?path="+url;
</script>
