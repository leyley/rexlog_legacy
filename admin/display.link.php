<?PHP
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<div id="link" style="display:none">
<form method="post" action="?path=admin&submit=link">
<div class="admin_header">
Navagation Links Settings (Each line for one link, format: Name|Target|Address)
</div>
<?PHP
    if($_GET['error'])
    echo "<div class='error_message'>Operation failed! Check your inputs. ".strerror($_GET['error'])."</div>";
    ?>
<div class="padding">
<textarea class="garea" name="link_content">
<?PHP
global $DATA_DIR;
echo file_get_contents($DATA_DIR."/config.nav.php");
?>
</textarea>
</div>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
</div>

