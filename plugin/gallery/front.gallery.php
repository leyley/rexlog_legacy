<?PHP
/*
* Front JS file for gallery;
*/
require_once("gallery.php");

$strga=gallery_make($_GET['gid']);
$strga=str_replace("\r\n","",$strga);
$strga=str_replace("\n","",$strga);
$strga=str_replace("\r","",$strga);

echo "document.write('$strga');";

?>
