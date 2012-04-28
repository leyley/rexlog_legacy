<?PHP
require_once("errorno.php");
require_once("macro_dir.php");

function message_new($msg)
{
    global $errorno;
	global $DATA_MESSAGE_DIR;

	if(!$msg)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	$msg=stripcslashes(strip_tags($msg,"<a><img>"));
	$msg=str_replace("\r\n","<br />",$msg);
	$msg=str_replace("\n","<br />",$msg);
	$msg=str_replace("\r","<br />",$msg);
	
	date_default_timezone_set('Asia/Shanghai');
	$time=date("Y-m-d H:i:s");

	if(!is_dir($DATA_MESSAGE_DIR))
	{
		mkdir($DATA_MESSAGE_DIR,0755);
		chmod($DATA_MESSAGE_DIR,0755); 
	}
	
	$recent_file=$DATA_MESSAGE_DIR."/message.0.php";
	if(glob($DATA_MESSAGE_DIR.'/message.*.php')!=null)
	{
		foreach(glob($DATA_MESSAGE_DIR.'/message.*.php') as $filename)
		{
			$recent_file=$recent_file>$filename?$recent_file:$filename;	
		}
	}
	if(!file_exists($recent_file))
	{
		echo $recent_file;
		if(FALSE==($fp=fopen($recent_file, "w+")))
		{
			return FALSE;
		}
		$content="[<p>".$time."</p>]<p>".$msg."</p>\n";
		fprintf($fp,"%s", $content);
		fclose($fp);
	}
	else if(abs(filesize($recent_file))>10240)
	{
		sscanf($recent_file,$DATA_MESSAGE_DIR."/message.%d.php",$i);
		$i=$i+1;
		$recent_file=$DATA_MESSAGE_DIR."/message.".$i.".php";
		if(FALSE==($fp=fopen($recent_file, "w+")))
		{
			return FALSE;
		}
		$content="[".$time."]".$msg."\n";
		fprintf($fp,"%s", $content);
		fclose($fp);
	}
	else
	{
		$content=file_get_contents($recent_file);
		$content="[".$time."]".$msg."\n".$content;
		file_put_contents($recent_file, $content);
	}
	return TRUE;
}

function message_del($time)
{
	global $errorno;
	global $DATA_MESSAGE_DIR;
	
	if(!$time)
	{
		$errorno=ER_IN;
		return FALSE;
	}

	if(!is_dir($DATA_MESSAGE_DIR))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	if(glob($DATA_MESSAGE_DIR.'/message.*.php')!=null)
	{
		foreach(glob($DATA_MESSAGE_DIR.'/message.*.php') as $filename)
		{
			$content=file_get_contents($filename);
			if(strstr($content,"[".$time."]")=="")
			{
				continue;
			}
			$pattern="/\[".$time."\].*\n/";
			$replacement='';
			$content=preg_replace($pattern, $replacement, $content);
			if($content===FALSE)
				continue;
			file_put_contents($filename, $content);
			break;
		}
	}
    return TRUE;
}

function message_get($base, $count)
{
	global $errorno;
	global $DATA_MESSAGE_DIR;
	
	if(!$base||$base<0)
	{
		$base=0;
	}
	if(!$count||$count<=0)
	{
		$count=10;
	}
	
	if(!is_dir($DATA_MESSAGE_DIR))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	$recent_file=$DATA_MESSAGE_DIR."/message.0.php";
	if(glob($DATA_MESSAGE_DIR.'/message.*.php')!=null)
	{
		foreach(glob($DATA_MESSAGE_DIR.'/message.*.php') as $filename)
		{
			$recent_file=$recent_file>$filename?$recent_file:$filename;
		}
	}
	
	sscanf($recent_file,$DATA_MESSAGE_DIR."/message.%d.php",$i);
	while($i>=0 && $base>0)
	{
		$recent_file=$DATA_MESSAGE_DIR."/message.".$i.".php";
		if(!file_exists($recent_file))
		{
			continue;
		}
		
		if(FALSE==($fp=fopen($recent_file,"r")))
		{
			continue;
		}
		for(;$base>0 && TRUE==($line=fgets($fp));$base--);
		if($base<=0)
			break;
		fclose($fp);
		$i--;
	}
	
	$a=array();
	while($i>=0 && $count>0)
	{
		$recent_file=$DATA_MESSAGE_DIR."/message.".$i.".php";
		$i--;
		if(!file_exists($recent_file))
		{
			continue;
		}
		if(!$fp)
		{
			if(FALSE==($fp=fopen($recent_file,"r")))
			{
				continue;
			}
		}
		while(TRUE==($line=fgets($fp))&&$count>0)
		{
			$line=trim($line);
			$preg='/\[(.*)\](.*)/';
			preg_match_all($preg,$line,$m);
			$c=array($m[0][0],$m[1][0],$m[2][0]);
			array_push($a,$c);
			$count--;
		}
		fclose($fp);
	}
	return $a;
}

?>
