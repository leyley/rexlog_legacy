<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once("data/config.site.php");
require_once("include/link.php");
require_once("include/plugin.php");
define("INDEX_IN",1);
$subtitle=$_GET['path']?$_GET['path']:"home";
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php echo $subtitle." - ".$site_name; ?></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<script type="Text/JavaScript" src="include/jquery-1.7.1.min.js"></script>
</head>

<body>
<div id="main">
	<!-- header -->
	<div id="header">
		<div id="logo">
			<?php $site_logo=$site_logo?$site_logo:"images/logo.default.png"; ?>
			<a href="<?php echo $site_url; ?>"><img src="<?php echo $site_logo; ?>" /></a>
		</div>
		<div id="banner">
			<?php echo $site_desc; ?>
		</div>
	</div>
	
	<!-- navigation -->
	<div id="navigation">
		<ul>
			<li>
				
			</li>
			<?php
			$links=link_nav_get();
			foreach($links as $link)
			{
				echo "<li><a href='".link_rebuild($link[2])."' target='".$link[1]."'";
				if("?path=".$subtitle==link_rebuild($link[2]))
					echo " class='onpath'";
				echo ">".$link[0]."</a></li>\n";
			}
			?>
		</ul>
	</div><!-- end of navigation -->

	<!--vector-->
	<div id="vector">
		<?php
		if($_GET['path']!="admin")
		{
			echo "<div id=\"contents\">";
		}
		else
		{
			echo "<div id=\"admin_contents\">";
		}

		//Path parsing;
		$path=$_GET['path']?$_GET['path']:"home";
		//For security;
		include(link_resolve_path($path));
		echo "</div>";
		
		//sidebar
		if($path!="admin")
		{
			echo "<!--side_bar-->";
			echo "<div id=\"side_bar\">";
			include(link_resolve_path("side_bar"));
			echo "</div>";
		}
		?>
	</div>

	<!--footer-->
	<div id="footer">
		Powered By <a href="http://www.rexlog.co.cc" target="_blank">Rexlog.HomePage</a>
		Version:1.5.10 2010 - 2012 Lei Peng, All Rights Reserved |
		<a href="?path=admin">CPanel</a>
	</div>
</div>
</body>

</html>
