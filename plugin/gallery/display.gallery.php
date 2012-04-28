<?PHP
    if(!defined("ADMIN_IN"))
    {
        header("Location:../");
        exit();
    }
?>
<?PHP
    require_once("gallery.php");
    $aryga=gallery_list();
?>
<div id="gallery" style="display:none">
<div class="admin_header">
About gallery
</div>
<div class="padding">
To use it, add '{gallery:gallery ID}' to a page;
</div>
<?PHP
    if($_GET['error'])
    echo "<div class='error_message'>Operation failed! Check your inputs.".strerror($_GET['error'])."</div>";
    ?>
<div class="admin_header">
New gallery
</div>
<form name="new_gallery" method="post" action="?path=admin&submit=gallery&act=new">
<div class="padding" style="padding:8px">
New ID: <input class="gin" name="newid" /> <input type="submit" class="gbtn" />
</div>
</form>
<div class="admin_header">
Edit gallery
</div>
<form name="edit_gallery" method="post" action="?path=admin&submit=gallery&act=update&gid=<?PHP echo $_GET['gid']; ?>">
<div class="padding" style="padding:8px;">
<textarea name="gtext" class="garea">
<?PHP
if($_GET['act']=="edit")
	echo gallery_get($_GET['gid']);
?>
</textarea>
</div>
<div class="padding" style="padding:8px">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
<div class="admin_header">
Gallery list
</div>
<?PHP
if(!$aryga)
	echo "<div class='padding'>No gallery</div>";
else
	for($i=0;$i<count($aryga);$i++)
		echo "<div class='padding'><a href='?path=admin&submit=gallery&act=del&gid=".$aryga[$i]."'>[X]</a><a href='?path=admin&redirect=gallery&act=edit&gid=".$aryga[$i]."'>[E]</a>".$aryga[$i]."</div>";
?>
</form>
</div>
