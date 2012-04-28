<?PHP
require_once("include/errorno.php");
?>
<div id="login">
<form method="post" action="log.php?act=in">
<div class="header">
Rexlog Control Panel login
</div>
<div class='padding'>
<?PHP
if($_GET['error'])
    echo "<div class='error_message'>".strerror($_GET['error'])."</div>";
?>
<div class='padding'><span class="p128">Username</span><input class="gin" name="admin_username" /></div>
<div class='padding'><span class="p128">Password</span><input class="gin" type="password" name="admin_password" /></div>
<div class='padding'>
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</div>
</form>
</div>
