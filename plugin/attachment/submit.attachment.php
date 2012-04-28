<?PHP
    if(!defined("ADMIN_IN"))
    {
        header("Location:../");
        exit();
    }
?>
<?PHP
    require_once("attachment.php");

    switch($_GET['act'])
    {
            case 'add':
            if(!attachment_add($_FILES["uploader"]))
		$error=geterror();
            break;
            case 'del':
            if(!attachment_del($_GET['file']))
		$error=geterror();
            break;
            case 'rename':
            if(!attachment_rename($_GET['file'],$_GET['newname']))
		$error=geterror();
            break;
    }
?>
<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=attachment&error=<?PHP echo $error; ?>":"?path="+url;
</script>
