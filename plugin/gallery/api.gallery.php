<?PHP
/*
* API file for gallery;
* option is the gallery ID;
*/
require_once(dirname(__FILE__)."/../../include/macro_dir.php");

global $site_url;

/* Display a gallery block for a certain gid; */
return "<script language='JavaScript' src='$site_url/plugin/gallery/front.gallery.php?gid=$option'></script>";
?>
