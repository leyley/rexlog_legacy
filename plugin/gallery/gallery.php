<?PHP
/*
* Gallery;
* <gallery>
* <name>Display name</name>
* <img>Img path</img>
* </gallery>
*/
require_once(dirname(__FILE__)."/../../include/macro_dir.php");
require_once(dirname(__FILE__)."/../../include/errorno.php");

global $DATA_DIR;
$GALLERY_DIR=$DATA_DIR."/gallery";

function gallery_get($gid)
{
	global $errorno;
	global $GALLERY_DIR;	

	$fname=$GALLERY_DIR."/$gid.php";

	if(!file_exists($fname))
	{
		$errorno=ER_NOFILE;
		return "";
	}

	return file_get_contents($fname);
}

function gallery_make($gid)
{	
	$str=gallery_get($gid);
	
	$str=str_replace("<gallery>","<div class=\"gallery_block\">",$str);
	$str=str_replace("</gallery>","</div>",$str);
	$str=str_replace("<name>","<div class=\"gallery_title\">",$str);
	$str=str_replace("</name>","</div>",$str);
	$preg="/<img>(.*?)<\/img>/";
	$tostr="<a href=\"\\1\"><div class=\"gallery_item\"><img class=\"gallery_img\" src=\"\\1\"></div></a>";
	$str=preg_replace($preg,$tostr,$str);

	return $str;
}

function gallery_del($gid)
{
	global $errorno;
	global $GALLERY_DIR;	
	
	$fname=$GALLERY_DIR."/$gid.php";

	if(!file_exists($fname))
	{
		$errorno=ER_NOFILE;
		return FALSE;
	}

	if(!unlink($fname))
	{
		$errorno=ER_IO;
		return FALSE;
	}

	return TRUE;
}

function gallery_update($gid,$str)
{
	global $errorno;
	global $GALLERY_DIR;	
	
	$fname=$GALLERY_DIR."/$gid.php";

	if(!$gid)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	
	//Create new;
	if(!$str)
	{
		$str=file_get_contents("plugin/gallery/template.gallery.php");
	}

	/*
	This function will create a new gallery when the gid is not exists;
	*/

	if(!file_put_contents($fname,$str))
	{
		$errorno=ER_IO;
		return FALSE;
	}

	return TRUE;
}

function gallery_list()
{
	global $errorno;
	global $GALLERY_DIR;	
	
	if(!file_exists($GALLERY_DIR))
	{
    		mkdir($GALLERY_DIR, 0777);
    		if(!file_exists($GALLERY_DIR))
    		return FALSE;
	}
    
	if(!($dga=opendir($GALLERY_DIR)))
	{
		$errorno=ER_STRUCT;
		return FALSE;
	}

	$i=0;
	$aryga=array();

	while($strfile=readdir($dga))
	{
	        if($strfile!="." && $strfile!="..")
	        {
	            $aryga[$i]=basename($strfile,".php");
	            $i++;
	        }
	}

	closedir($dga);

	return $aryga;
}
?>
