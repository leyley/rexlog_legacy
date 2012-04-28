<?PHP
/*
*	API of Comment;
*/
require_once(dirname(__FILE__)."/../../include/macro_dir.php");

global $site_url;

/* Display a comment box for a certain entry; */
return "<script language='JavaScript' src='$site_url/plugin/comment/front.comment.php?id=$option'></script>";

?>
