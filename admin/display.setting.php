<?PHP
if(!defined("ADMIN_IN"))
{
    header("Location:../");
    exit();
}
?>
<?PHP
require_once(dirname(__FILE__)."/../data/config.site.php");
?>
<div id="setting" style="display:none;" >
<form method="post" action="?path=admin&submit=setting">
<div class="admin_header">
Site
</div>
<div class="padding">
<span class="p176">Name</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="site_name" value="<?PHP echo $site_name; ?>" />
</div>
<div class="padding">
<span class="p176">Description</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="site_desc" value="<?PHP echo $site_desc; ?>" />
</div>
<div class="padding">
<span class="p176">URL</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="site_url" value="<?PHP echo $site_url; ?>" />
</div>
<div class="padding">
<span class="p176">Logo</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="site_logo" value="<?PHP echo $site_logo; ?>" />
</div>
<div class="admin_header">
Profile
</div>
<div class="padding">
<span class="p176">Name</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_name" value="<?PHP echo $me_name; ?>" />
</div>
<div class="padding">
<span class="p176">Description</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_desc" value="<?PHP echo $me_desc; ?>" />
</div>
<div class="padding">
<span class="p176">Homepage</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_url" value="<?PHP echo $me_url; ?>" />
</div>
<div class="padding">
<span class="p176">Email address</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_email" value="<?PHP echo $me_email; ?>" />
</div>
<div class="padding">
<span class="p176">AIM Account</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_aim" value="<?PHP echo $me_aim; ?>" />
</div>
<div class="padding">
<span class="p176">MSN Address</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_msn" value="<?PHP echo $me_msn; ?>" />
</div>
<div class="padding">
<span class="p176">ICQ Number</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_icq" value="<?PHP echo $me_icq; ?>" />
</div>
<div class="padding">
<span class="p176">Google Talk</span>
<input class="gin" <?PHP if(user_level()>0){ echo "disabled='YES'"; }?> name="me_gtalk" value="<?PHP echo $me_gtalk; ?>" />
</div>
<?PHP if(user_level()==0){?>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
<?PHP } ?>
</form>
</div>
