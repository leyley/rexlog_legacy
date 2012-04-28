<?PHP
    if(!defined("ADMIN_IN"))
    {
        header("Location:../");
        exit();
    }
?>
<?PHP
    require_once("attachment.php");
    $aryatt=attachment_list();
?>
<div id="attachment" style="display:none">
<?PHP
    if($_GET['error'])
    echo "<div class='error_message'>Operation failed! Check your inputs.".strerror($_GET['error'])."</div>";
?>
<div class="admin_header">
New attachment
</div>
<form method="post" action="?path=admin&submit=attachment&act=add" enctype="multipart/form-data">
<div class="padding">
<input type="file" name="uploader" />
</div>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
<div class="admin_header">
attachment management
</div>
<?PHP
    if(!$aryatt)
    {
?>
<div class="padding">
No attachment has been uploaded.
</div>
<?PHP
    }
    else
    {
        for($i=0;$i<count($aryatt);$i++)
        {
?>
<div><a href="#" onclick="attachment_del('<?PHP echo $aryatt[$i]; ?>')">(X)</a>|<a href="#" onclick="attachment_rename('<?PHP echo $aryatt[$i]; ?>')">(R)</a>|<?PHP echo $aryatt[$i]; ?></div>
<?PHP
        }
    }
?>
</div>
<script language="JavaScript">
function attachment_del(name)
{
    if(confirm("Are you sure to delete the file "+name+"?"))
        location.href="?path=admin&submit=attachment&act=del&file="+name;
    else
        return FALSE;
}
function attachment_rename(name)
{
    if(newname=prompt("Enter a new name for the file "+name))
        location.href="?path=admin&submit=attachment&act=rename&file="+name+"&newname="+newname;
    else
        return FALSE;
}
</script>
