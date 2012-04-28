<?PHP
if(!defined("ADMIN_IN"))
{
    header("Location:../");
    exit();
}
?>
<?PHP
require_once(dirname(__FILE__)."/../data/config.admin.php");
?>
<div id="user" style="display:none">
<form method="post" action="?path=admin&submit=user">
<div class="admin_header">
Username and Password (For the system administrator)
</div>
<?PHP
if($_GET['error'])
    echo "<div class='error_message'>Operation failed! Check your inputs.</div>";
?>
<div class="padding">
<span class="p176">Username</span>
<input name="admin_username" class="gin" value="<?PHP echo $admin_username; ?>" />
</div>
<div class="padding">
<span class="p176">Password</span>
<input name="admin_password" type="password" class="gin" />
</div>
<div class="padding">
<span class="p176">Password Confirm</span>
<input name="admin_password_confirm" type="password" class="gin" />
</div>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
</div>
