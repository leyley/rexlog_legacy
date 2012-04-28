<?PHP
/*
* attachment management;
*/
require_once(dirname(__FILE__)."/../../include/macro_dir.php");
require_once(dirname(__FILE__)."/../../include/errorno.php");

global $DATA_DIR;
$attachment_DIR=$DATA_DIR."/attachment";

function attachment_list()
{
    global $errorno;
    global $attachment_DIR;
    
    $errorno=0;
    
    if(!file_exists($attachment_DIR))
    {
    	mkdir($attachment_DIR, 0777);
    	if(!file_exists($attachment_DIR))
    		return FALSE;
    }
    
    if(!($datt=opendir($attachment_DIR)))
    {
        $errorno=ER_STRUCT;
        return FALSE;
    }
    
    $i=0;
    $aryrt=array();
    
    /* This process do not hide system files(file which is started with a .); */
    while($strfile=readdir($datt))
    {
        if($strfile!="." && $strfile!="..")
        {
            $aryrt[$i]=$strfile;
            $i++;
        }
    }
    
    closedir($datt);
    return $aryrt;
}

/* The argument $uploader should be a html file uploader(input:file); */
function attachment_add($uploader)
{
    global $errorno;
    global $attachment_DIR;
    
    $errorno=0;
    
    if(!$uploader["name"])
    {
        $errorno=ER_IN;
        exit(0);
        return FALSE;
    }
    
    /* !The file upload error codes are not defined in errorno.php; */
    if($uploader["error"])
    {
        $errorno=$uploader["error"];
        return FALSE;
    }

    if(!file_exists($attachment_DIR))
    {
    	mkdir($attachment_DIR, 0777);
    	if(!file_exists($attachment_DIR))
    		return FALSE;
    }
    
    /* File name parsing; if the file is already exists, add [0-n];*/
    $fdest=$attachment_DIR."/".$uploader["name"];
    
    $rfdest=$fdest;
    $n=0;
    while(file_exists($rfdest))
    {
        $rfdest=$fdest.".".$n;
        $n++;
    }
    $fdest=$rfdest;
    
    if(!move_uploaded_file($uploader["tmp_name"],$fdest))
    {
        $errorno=ER_IO;
        exit(0);
        return FALSE;
    }
    
    return TRUE;
}

function attachment_del($fname)
{
    global $errorno;
    global $attachment_DIR;
    
    $errorno=0;
    
    if(!$fname)
    {
        $errorno=ER_IN;
        return FALSE;
    }
    
    if(!file_exists($attachment_DIR))
    {
    	mkdir($attachment_DIR, 0777);
    	if(!file_exists($attachment_DIR))
    		return FALSE;
    }
    
    $path=$attachment_DIR."/".$fname;
    if(!unlink($path))
    {
        $errorno=ER_IO;
        return FALSE;
    }
    
    return TRUE;
}

function attachment_rename($old,$new)
{
    global $errorno;
    global $attachment_DIR;
    
    $errorno=0;
    
    if(!$old || !$new)
    {
        $errorno=ER_IN;
        return FALSE;
    }
    
    if(!file_exists($attachment_DIR))
    {
    	mkdir($attachment_DIR, 0777);
    	if(!file_exists($attachment_DIR))
    		return FALSE;
    }
    
    $old=$attachment_DIR."/".$old;
    $new=$attachment_DIR."/".$new;
    if(!file_exists($old))
    {
        $errorno=ER_NOFILE;
        return FALSE;
    }
    
    if(!rename($old,$new))
    {
        $errorno=ER_IO;
        return FALSE;
    }
    
    return TRUE;
}
    
?>
