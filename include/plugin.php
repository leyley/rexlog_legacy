<?PHP
/*
* Plugin functions; 
*/
require_once("errorno.php");
require_once("macro_dir.php");
    
function plugin_load($plugin,$option)
{
    global $PLUGIN_DIR;
    global $errorno;
    
    $errorno=0;
    
    $api=$PLUGIN_DIR."/$plugin/api.$plugin.php";
    if(!file_exists($api))
    {
        $errorno=ER_STRUCT;
        return FALSE;
    }
    
    return include($api);
}

?>
