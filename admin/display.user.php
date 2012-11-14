<?PHP
if(!defined("ADMIN_IN"))
{
    header("Location:../");
    exit();
}
?>
<?PHP
require_once(dirname(__FILE__)."/../include/errorno.php");
?>
<div id="user" style="display:none">
<form method="post" action="?path=admin&submit=user&act=update">
<div class="admin_header">
Update your personal information (Need relogin)
</div>
<?PHP
if($_GET['error'])
    echo "<div class='error_message'>Operation failed! Check your inputs. ".$strer[$_GET['error']]."</div>";
?>
<div class="padding">
<span class="p176">Username</span>
<input readonly="readonly" name="user_username" class="gin" value="<?PHP echo $_COOKIE['AB01']; ?>" />
</div>
<div class="padding">
<span class="p176">Nickname</span>
<input name="user_nick" class="gin" value="<?PHP echo $_COOKIE['AE01']; ?>" />
</div>
<div class="padding">
<span class="p176">Password</span>
<input name="user_password" type="password" class="gin" />
</div>
<div class="padding">
<span class="p176">Password Confirm</span>
<input name="user_password_confirm" type="password" class="gin" />
</div>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
<?PHP if(user_level()==0){?>
<?PHP 
if($_GET['act']=='edit'){
	$userfile=dirname(__FILE__)."/../data/users/".$_GET['username'].".php";
	if(file_exists($userfile)){
		include($userfile);
?>
<form name="edituser" method="post" action="?path=admin&submit=user&act=edit">
<div class="admin_header">
Edit '<?PHP echo $_GET['username']; ?>'
</div>
<div class="padding">
<span class="p176">User level</span>
<select name="user_level">
<option value=-1 <? echo ($user_level==-1)?"selected":""; ?>>Disabled</option>
<option value=0 <? echo ($user_level==0)?"selected":""; ?>>Project owner</option>
<option value=1 <? echo ($user_level==1)?"selected":""; ?>>Editor</option>
<option value=2 <? echo ($user_level==2)?"selected":""; ?>>Contributor</option>
</select>
</div>
<div class="padding">
<span class="p176">Username</span>
<input name="user_username" class="gin" readonly="readonly" value="<?PHP echo $user_username;?>" />
</div>
<div class="padding">
<span class="p176">Nickname</span>
<input name="user_nick" class="gin" value="<?PHP echo $user_nick;?>" />
</div>
<div class="padding">
<span class="p176">Password</span>
<input name="user_password" type="password" class="gin" />
</div>
<div class="padding">
<span class="p176">Password Confirm</span>
<input name="user_password_confirm" type="password" class="gin" />
</div>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
<?PHP 
	} 
}
?>
<!-- User administration; -->
<form name="adduser" method="post" action="?path=admin&submit=user&act=add">
<div class="admin_header">
Add new user
</div>
<div class="padding">
<span class="p176">User level</span>
<select name="user_level">
<option value=-1 default>Disabled</option>
<option value=0>Project owner</option>
<option value=1>Editor</option>
<option value=2>Contributor</option>
</select>
</div>
<div class="padding">
<span class="p176">Username</span>
<input name="user_username" class="gin" />
</div>
<div class="padding">
<span class="p176">Nickname</span>
<input name="user_nick" class="gin" />
</div>
<div class="padding">
<span class="p176">Password</span>
<input name="user_password" type="password" class="gin" />
</div>
<div class="padding">
<span class="p176">Password Confirm</span>
<input name="user_password_confirm" type="password" class="gin" />
</div>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
<form name="searchuser" method="post" action="?path=admin&submit=user&act=search">
<div class="admin_header">
Search user
</div>
<div class="padding">
<span class="p176">Keyword</span>
<input name="user_key" class="gin" />
<select name="search_type">
<option value=1>Nickname</option>
<option value=2>Username</option>
</select>
<input type="submit" class="gbtn" />
</div>
</from>
<?PHP } ?>
</div>
