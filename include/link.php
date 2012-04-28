<?php
require_once("errorno.php");
require_once("macro_dir.php");

function link_resolve_path($path)
{
	global $errorno;
	global $DATA_PAGE_DIR;
	global $ROOT_DIR;
	
	if(!$path)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	if(file_exists($DATA_PAGE_DIR."/".$path.".php"))
	{
		return $DATA_PAGE_DIR."/".$path.".php";
	}
	
	if(file_exists($ROOT_DIR."/".$path.".php"))
	{
		return $ROOT_DIR."/".$path.".php";
	}
	$errorno=ER_IO;
	return $ROOT_DIR."/404.php";
}

function link_rebuild($url)
{
	global $errorno;
	
	if(!$url)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	$pattern='/{{(.*)}}/';
	$replacement='?path=${1}';
	$url=preg_replace($pattern, $replacement, $url);
	return $url;
}

function link_nav_get()
{
	global $errorno;
	global $DATA_DIR;
	$path=$DATA_DIR."/config.nav.php";
	
	if(FALSE==($fp=fopen($path,"r")))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	
	$links=array();
	while($line=fgets($fp))
	{
		$line=trim($line);
		$n=explode("|", $line);
		array_push($links, $n);
	}
	fclose($fp);
	return $links;
}

function link_nav_update($content)
{
	global $errorno;
	global $DATA_DIR;
	$path=$DATA_DIR."/config.nav.php";

	if(!$content)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	if(FALSE==($fp=fopen($path,"w")))
	{
		$errorno=ER_IO;
		return FALSE;
	}

	fprintf($fp,"%s", $content);
	fclose($fp);
}