<?PHP
    if(!defined("ADMIN_IN"))
    {
        header("Location:../");
        exit();
    }
?>
<?PHP
    require_once("gallery.php");

    switch($_GET['act'])
    {
            case 'new':
            if(!gallery_update($_POST['newid'],""))
		$error=geterror();
            break;
            case 'del':
            if(!gallery_del($_GET['gid']))
		$error=geterror();
            break;
            case 'update':
            if(!gallery_update($_GET['gid'],$_POST['gtext']))
		$error=geterror();
            break;
    }
?>
<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=gallery&error=<?PHP echo $error; ?>":"?path="+url;
</script>
