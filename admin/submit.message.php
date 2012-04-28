<?PHP
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<?PHP
require_once(dirname(__FILE__)."/../include/message.php");

	/*
	 * Delete a message;
	 */
	if($_GET['act'])
	{
		switch($_GET['act'])
		{
			case 'add':
				if (get_magic_quotes_gpc())
				{
					$content = stripslashes($_POST['message_content']);
				}
				else
				{
					$content = $_POST['message_content'];
				}
				if(!message_new($content))
					$error=geterror();
				break;
			case 'del':
				if(!message_del($_GET['time']))
					$error=geterror();
			
		}
	}
?>
<script language="JavaScript">
	var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
	url=sValue?sValue[1]:sValue
	location.href=(url==null)?"?path=admin&redirect=message&error=<?PHP echo $error;?>":"?path="+url;
</script>
