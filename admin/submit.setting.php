<?PHP
if(!defined("ADMIN_IN"))
{
    header("Location:../");
    exit();
}
?>
<?PHP
/*
* Default values;
*/
$site_name_default="Rexlog.Homepage";
$site_desc_default="Another Rexlog Homepage";
$site_url_default="http://www.rexlog.co.cc";
/*
* Form parsing;
*/
$site_name=$_POST['site_name']?$_POST['site_name']:$site_name_default;
$site_desc=$_POST['site_desc']?$_POST['site_desc']:$site_desc_default;
$site_url=$_POST['site_url']?$_POST['site_url']:$site_url_default;
/*
* Writing;
*/
$strs=file_get_contents(dirname(__FILE__)."/template.config.site.php");
$strs=str_replace("{site_name}",$site_name,$strs);
$strs=str_replace("{site_desc}",$site_desc,$strs);
$strs=str_replace("{site_url}",$site_url,$strs);
$strs=str_replace("{site_logo}",$_POST['site_logo'],$strs);
$strs=str_replace("{me_name}",$_POST['me_name'],$strs);
$strs=str_replace("{me_desc}",$_POST['me_desc'],$strs);
$strs=str_replace("{me_url}",$_POST['me_url'],$strs);
$strs=str_replace("{me_mail}",$_POST['me_email'],$strs);
$strs=str_replace("{me_aim}",$_POST['me_aim'],$strs);
$strs=str_replace("{me_msn}",$_POST['me_msn'],$strs);
$strs=str_replace("{me_icq}",$_POST['me_icq'],$strs);
$strs=str_replace("{me_gtalk}",$_POST['me_gtalk'],$strs);
file_put_contents(dirname(__FILE__)."/../data/config.site.php",$strs);
?>
<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=setting":"?path="+url;
</script>
