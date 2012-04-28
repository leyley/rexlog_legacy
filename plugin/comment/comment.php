<?PHP
/*
*	Comment functions;
*	The data structure of a certain comment is defined as
*	<comment>
*	<name>Name</name>
*	<email>Email</email>
*	<time>Time</time>
*	<contents>Contents</contents>
*	</comment>
*/
require_once(dirname(__FILE__)."/../../include/macro_dir.php");
require_once(dirname(__FILE__)."/../../include/errorno.php");

global $DATA_DIR;
$comment_DIR=$DATA_DIR."/comment";

function comment_add($eid,$name,$email,$contents)
{
	global $errorno;
	global $comment_DIR;
	
	$cfile=$comment_DIR."/$eid.php";
	/* Create a new comment file when no comment; */
	$fcmt=fopen($cfile,"a+");
	
	date_default_timezone_set('Asia/Shanghai');
	$time=date("Y-m-d H:i:s");
	$name=trim(strip_tags($name));
	$email=strip_tags($email);
	$contents=strip_tags($contents);
	$contents=str_replace("\r\n","<br>",$contents);
	$contents=str_replace("\n","<br>",$contents);
	$contents=str_replace("\r","<br>",$contents);
	$contents=str_replace("<comment>","",$contents);
	$contents=str_replace("</comment>","",$contents);
	$contents=str_replace("<name>","",$contents);
	$contents=str_replace("</name>","",$contents);
	$contents=str_replace("<email>","",$contents);
	$contents=str_replace("</email>","",$contents);
	$contents=str_replace("<time>","",$contents);
	$contents=str_replace("</time>","",$contents);
	$contents=str_replace("<contents>","",$contents);
	$contents=str_replace("</contents>","",$contents);
	//Reply operations;
	$contents=str_replace("[quote]","<div class='comment_quote'>",$contents);
	$contents=str_replace("[/quote]","</div>",$contents);
	$contents=str_replace("[br]","<br>",$contents);
	$strtodo="<comment>\r\n<name>$name</name>\r\n<email>$email</email>\r\n<time>$time</time>\r\n<contents>$contents</contents>\r\n</comment>\r\n";
	
	if(!fputs($fcmt,$strtodo))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	
	fclose($fcmt);
	
	return TRUE;
}

function comment_del($eid,$time)
{
	global $errorno;
	global $comment_DIR;

	$cfile=$comment_DIR."/$eid.php";
	if(!file_exists($cfile))
	{
		$errorno=ER_NOFILE;
		return FALSE;
	}
	
	$str=file_get_contents($cfile);
	$preg="/<comment>\r\n<name>(.*?)<\/name>\r\n<email>(.*?)<\/email>\r\n<time>$time<\/time>\r\n<contents>(.*?)<\/contents>\r\n<\/comment>\r\n/";
	$str=preg_replace($preg,"",$str);

	if(!@file_put_contents($cfile,$str))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	
	return TRUE;
}

function comment_get($eid)
{
	global $errorno;
	global $comment_DIR;
	
	$cfile=$comment_DIR."/$eid.php";
	if(!file_exists($cfile))
		return FALSE;
	
	$str=file_get_contents($cfile);
	$preg="/<comment>\r\n<name>(.*?)<\/name>\r\n<email>(.*?)<\/email>\r\n<time>(.*?)<\/time>\r\n<contents>(.*?)<\/contents>\r\n<\/comment>/";
	preg_match_all($preg,$str,$rawarray);
	
	if(!$rawarray)
	{
		$errorno=ER_STRUCT;
		return FALSE;
	}

	$a=array();
	for($i=substr_count($str,"<comment>")-1,$j=0;$i>=0;$i--,$j++)
	{
		$a[$j]['name']=$rawarray[1][$i];
		$a[$j]['email']=$rawarray[2][$i];
		$a[$j]['time']=$rawarray[3][$i];
		$a[$j]['contents']=$rawarray[4][$i];
	}	
		
	return $a;
}
?>
