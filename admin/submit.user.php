<?PHP
if(!defined("ADMIN_IN"))
{
    header("Location:../");
    exit();
}
?>
<?PHP
require_once(dirname(__FILE__)."/../include/user.php");
?>
<?PHP
if($_GET['act']!='search' && $_GET['act']!='delete' && (!$_POST['user_username'] || !$_POST['user_nick'] || !$_POST['user_password'] || !$_POST['user_password_confirm'] || $_POST['user_password']!=$_POST['user_password_confirm'] || strstr($_POST['user_nick']," ")))
{
?>
<script language="JavaScript">
location.href="?path=admin&redirect=user&error=-3";
</script>
<?PHP
}
else
{
switch($_GET['act'])
	{
	case 'add':
		if(file_exists(dirname(__FILE__)."/../data/users/".$_POST['user_username'].".php")){
			$error=-10;
			break;
		}
	case 'update':
	case 'edit':
		include(dirname(__FILE__)."/../data/users/".$_POST['user_username'].".php");
		$user_level=($_GET['act']=='update')?$_COOKIE['AD01']:$_POST['user_level'];
		$strs=file_get_contents(dirname(__FILE__)."/template.config.user.php");
		$strs=str_replace("{user_username}",$_POST['user_username'],$strs);
		$strs=str_replace("{user_password}",md5($_POST['user_password']),$strs);
		$strs=str_replace("{user_nick}",$_POST['user_nick'],$strs);
		$strs=str_replace("{user_level}",$user_level,$strs);
		if(!file_put_contents(dirname(__FILE__)."/../data/users/".$_POST['user_username'].".php",$strs)){
			$error=-1;
		}
		/* Updating nick list cache; */
		$cstrs=file_get_contents(dirname(__FILE__)."/../data/cache/nicks.txt");
		if(strstr(cstrs,"{{{".$_POST['user_nick']."}}")){
			$error=-9;
		}
		else{
			if($_GET['act']=='add')
				$cstrs.="{{{".$_POST['user_nick']."}}".$_POST['user_username']."}";
			else
				$cstrs=str_replace("{{{".$user_nick."}}".$user_username."}","{{{".$_POST['user_nick']."}}".$_POST['user_username']."}",$cstrs);
			if(!file_put_contents(dirname(__FILE__)."/../data/cache/nicks.txt",$cstrs)){
				$error=-1;
			}
		}
		if($_GET['act']=="update")
			user_logout();
	break;
	case 'search':
		$nojmp=1;
		$sstrs=file_get_contents(dirname(__FILE__)."/../data/cache/nicks.txt");
		$spreg="/\{\{\{(\w*)\}\}(\w*)\}/";
		preg_match_all($spreg,$sstrs,$sm);
		$rst=array();
		$key=$_POST['user_key'];
		for($i=0;$i<count($sm[1]);$i++){
			if(strstr($sm[1][$i],$key) || strstr($sm[2][$i],$key)){
				$rst[$i]['nickname']=$sm[1][$i];
				$rst[$i]['username']=$sm[2][$i];
			}
		}
		echo "<div class='padding'><div class='admin_header'>Search Result:</div>";
		foreach($rst as $r){
			echo "<table cellpadding='0' cellspacing='0' width='100%'>";
			echo "<tr class='tr_header'><td>Username</td><td>Nickname</td><td>Edit</td><td>Delete</td></tr>";
			echo "<tr class='tr_cell'><td>".$r['username']."</td><td>".$r['nickname']."</td><td><a href='?path=admin&redirect=user&act=edit&username=".$r['username']."'>Edit</a></td><td><a href='?path=admin&submit=user&act=delete&username=".$r['username']."&nickname=".$r['nickname']."'>Delete</a></td></tr>";
			echo "</table>";
		}
		echo "</div>";
	break;
	case 'delete':
		if(user_level()!=0)
			break;
		$userfile=dirname(__FILE__)."/../data/users/".$_GET['username'].".php";
		if(!file_exists($userfile)){
			$errorno=-2;
			break;
		}
		if(!unlink($userfile)){
			$errorno=-1;
			break;
		}
		$cstrs=file_get_contents(dirname(__FILE__)."/../data/cache/nicks.txt");
		$cstrs=str_replace("{{{".$_GET['nickname']."}}".$_GET['username']."}","",$cstrs);
		if(!file_put_contents(dirname(__FILE__)."/../data/cache/nicks.txt",$cstrs)){
				$error=-1;
		}
	break;
	default:
	break;
	}
}
if(!$nojmp){
?>
<script language="JavaScript">
var sValue=location.search.match(new RegExp("[\?\&]url=([^\&]*)(\&?)","i"))
url=sValue?sValue[1]:sValue
location.href=(url==null)?"?path=admin&redirect=user&error=<?PHP echo $error; ?>":"?path="+url;
</script>
<?PHP
}
?>
