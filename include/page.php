<?php

require_once("errorno.php");
require_once("macro_dir.php");

function page_new($name, $content, $php_supported)
{
	global $errorno;
	global $DATA_PAGE_DIR;
	
	if(!$name)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	
	/*
	 * if do not supported php, delete php code.
	 */ 
	if(!$php_supported || $php_supported==0)
	{
		$pattern='/\<\?([\w\W]*?)\?\>/i';
		$replacement='<!-- PHP CODE HERE HAD BEEN REMOVED! -->';
		$content=preg_replace($pattern, $replacement, $content);
	}
	
	if(!is_dir($DATA_PAGE_DIR))
	{
		mkdir($DATA_PAGE_DIR,0755);
		chmod($DATA_PAGE_DIR,0755); 
	}
    
	/*
     * Plugin: API call;
     * 2011/09/27 - added by pyp126@gmail.com;
     */
    $preg="/\{(.*):(.*)\}/";
    preg_match_all($preg,$content,$arymatch);
    for($i=0;$i<count($arymatch);$i++)
    {
        preg_match($preg,$content,$arymatch2);
        $content=str_replace($arymatch2[0],plugin_load($arymatch2[1],$arymatch2[2]),$content);
    }
    
	$path=$DATA_PAGE_DIR."/".$name.".php";
	if(FALSE==($fp=(fopen($path,"w+"))))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	fprintf($fp,"%s", $content);
	fclose($fp);
	return TRUE;
}

function page_del($name)
{
	global $errorno;
	global $DATA_PAGE_DIR;
	
	if(!$name)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	if(!is_dir($DATA_PAGE_DIR))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	
	$path=$DATA_PAGE_DIR."/".$name.".php";
	if(!file_exists($path))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	unlink($path);
	return TRUE;
}

function page_get_content($name)
{
	global $errorno;
	global $DATA_PAGE_DIR;
	
	if(!$name)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	
	if(!is_dir($DATA_PAGE_DIR))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	
	$path=$DATA_PAGE_DIR."/".$name.".php";
	if(!file_exists($path))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	$content=file_get_contents($path);
	return $content;
}

function page_get()
{
	global $errorno;
	global $DATA_PAGE_DIR;
	
	if(!is_dir($DATA_PAGE_DIR))
	{
		$errorno=ER_IO;
		return FALSE;
	}
	
	$a=array();
	if(glob($DATA_PAGE_DIR.'/*.php')!=null)
	{
		foreach(glob($DATA_PAGE_DIR.'/*.php') as $filename)
		{
			sscanf($filename,$DATA_PAGE_DIR."/%s", $name);
			$name=explode(".",$name);
			if($name[0])
				array_push($a,$name[0]);
		}
	}
	return $a;
}

function page_convert($content)
{
	$pattern='/\&/i';
	$replacement='&amp;';
	$content=preg_replace($pattern, $replacement, $content);
	
	$pattern='/\</i';
	$replacement='&lt;';
	$content=preg_replace($pattern, $replacement, $content);
	
	$pattern='/\>/i';
	$replacement='&gt;';
	$content=preg_replace($pattern, $replacement, $content);
	
	return $content;
	
}
