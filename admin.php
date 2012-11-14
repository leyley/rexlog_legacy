<?php
// login check
require_once("include/macro_dir.php");
require_once("include/user.php");
if(!log_check() || user_level()<0)
{
    echo "<script language='JavaScript'>location.href='?path=login';</script>";
    exit();
}

//define admin flag
define("ADMIN_IN",1);

//redirect
$redirect=$_GET['redirect']?$_GET['redirect']:"setting";
?>

<!--js-->
<script language="JavaScript">
var onshow="<?php echo $redirect; ?>";

function show(sid)
{
	document.getElementById(onshow).style.display="none";
	onshow=sid;
	document.getElementById(onshow).style.display="block";
}

function logout()
{
	if(confirm("Are you sure to sing out?"))
		location.href="log.php?act=out";
	else
		return false;
}
</script>

<!--js and css-->
<!--
Add the headers for CodeMirror,
which used to deal with highlight of code in <textarea>.
-->
<link rel="stylesheet" href="../include/CodeMirror/lib/codemirror.css" />
<script src="../include/CodeMirror/lib/codemirror.js"></script>
<script src="../include/CodeMirror/mode/xml/xml.js"></script>
<script src="../include/CodeMirror/mode/javascript/javascript.js"></script>
<script src="../include/CodeMirror/mode/clike/clike.js"></script>
<script src="../include/CodeMirror/mode/css/css.js"></script>
<script src="../include/CodeMirror/mode/php/php.js"></script>
<style>
.CodeMirror{border: 1px solid #eee;}
</style>


<!--HTML-->
<div id="admin">
	<table width="100%" border="0">
		<tr>
			<!--left cols-->
			<td width="25%" valign="top" class="menu">
				<?PHP if(user_level()<=0){?><div class="padding"><a href="#" onclick="show('setting')">Setting</a></div><?PHP } ?>
				<div class="padding"><a href="#" onclick="show('user')">User</a></div>
				<?PHP if(user_level()<=1){?><div class="padding"><a href="#" onclick="show('link')">Link</a></div><?PHP } ?>
				<?PHP if(user_level()<=1){?><div class="padding"><a href="#" onclick="show('side_bar')">Sidebar</a></div><?PHP } ?>
				<?PHP if(user_level()<=1){?><div class="padding"><a href="#" onclick="show('page')">Page</a></div><?PHP } ?>
				<?PHP if(user_level()<=2){?><div class="padding"><a href="#" onclick="show('message')">Message</a></div><?PHP } ?>
				<!--plugin config-->
				<?PHP if(user_level()<=1){?>
				<?php
					if(glob($PLUGIN_DIR.'/*/')!=null)
					{
						foreach(glob($PLUGIN_DIR.'/*') as $filename)
						{
							if(is_dir($filename))
							{
								sscanf($filename, $PLUGIN_DIR."/%s", $fn);
								echo "<div class=\"padding\"><a href=\"#\" onclick=\"show('".$fn."')\">".$fn."</a></div>";
							}
						}
					}
					
					// get plugin config
					global $PLUGIN_DIR;
					if(glob($PLUGIN_DIR.'/*/display.php')!=null)
					{
						foreach(glob($PLUGIN_DIR.'/*/display.php') as $filename)
						{
							$preg='/.*\/(.*)\/display.php/';
							preg_match_all($preg,$filename,$n);
							echo "<div  class='padding'><a href='#' onclick='show(\"".$n[1][0]."\")'>".$n[1][0]."</a></div>\n";
						}
					}
				?>
				<?PHP } ?>
				<!--logout-->
				<div  class="padding"><a href="#" onclick="logout()">Sign out</a></div>
			</td>
			
			<!--right cols-->
			<td valign="top" style="font-size:14px">
				<?php
				/*
				* Display or Submit;
				*/
				if($_GET['submit'])
				{
					if(file_exists("admin/submit.".$_GET['submit'].".php"))
					{
						include("admin/submit.".$_GET['submit'].".php");
					}
					else if(file_exists("plugin/".$_GET['submit']."/submit.".$_GET['submit'].".php"))
					{
						include("plugin/".$_GET['submit']."/submit.".$_GET['submit'].".php");
					}
				}
				else
				{
					if(!($dadmin=opendir("admin")))
						echo "Read dirent failed.";
					while(FALSE!=($fname=readdir($dadmin)))
					{
						if(strstr($fname,"display") && $fname!="." && $fname!="..")
						{
							include("admin/$fname");
						}
					}
					closedir($dadmin);
					if(glob($PLUGIN_DIR.'/*/display.*.php')!=null)
					{
						foreach(glob($PLUGIN_DIR.'/*/display.*.php') as $filename)
						{
							include($filename);
						}
					}
				}
				?>
			</td>
		</tr>
	</table>
</div><!-- End of admin -->

<!--action js-->
<script language="javascript">
	show(onshow);
</script>
