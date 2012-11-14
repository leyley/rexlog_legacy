
<?PHP
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<?php
require_once(dirname(__FILE__)."/../include/message.php");
?>
<div id="message" style="display:none">
<form method="post" action="?path=admin&submit=message&act=add">
<div class="admin_header">
Write a new message
</div>
<?PHP
    if($_GET['error'])
    echo "<div class='error_message'>Operation failed! Check your inputs. ".strerror($_GET['error'])."</div>";
    ?>
<div class='padding'>
<input name="nickname" style="display:none" value="<?PHP echo $_COOKIE['AE01'];?>" />
<textarea class="garea" name="message_content">
</textarea>
</div>
<div class='padding'>
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
<div class="admin_header">
Messages List
</div>
<?PHP
	$arymsg=message_get(0,100);
	if(!$arymsg)
	{
		echo "<div class='padding'>No message</div>\n";
	}
	else
	{
		foreach($arymsg as $msg)
		{
			echo "<div class='padding'><a class='del_button' href='#' onclick='del(\"".$msg[1]."\")'>(X)</a>".$msg[0]."</div>\n";
		}
	}
?>
</div>
<script language="JavaScript">
function del(time)
{
	if(confirm("Are you sure to delete this message?"))
		location.href="?path=admin&submit=message&act=del&time="+time;
	else
		return FALSE;
}
</script>

