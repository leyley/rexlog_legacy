<?PHP
/*
* User login/logout/Check status fuctions;
*/
require_once("errorno.php");

define("USER_DATA_FILE",dirname(__FILE__)."/../data/config.admin.php");

function user_login($admin_username_in,$admin_password_in)
{
    global $errorno;
    
    if(!$admin_username_in || !$admin_password_in)
    {
        $errorno=ER_IN;
        return FALSE;
    }
    
    if(!file_exists(USER_DATA_FILE))
    {
        $errorno=ER_STRUCT;
        return FALSE;
    }
    
    include(USER_DATA_FILE);
    
    if($admin_username_in!=$admin_username || $admin_password_in!=$admin_password)
    {
        $errorno=ER_LOGIN;
        return FALSE;
    }
    
    /*
    * AB01 - username;
    * AC01 - password;
    */
    setcookie("AB01",$admin_username);
    setcookie("AC01",$admin_password);
    
    return TRUE;
}

function user_logout()
{
    setcookie("AB01","");
    setcookie("AC01","");
    
    return TRUE;
}

function log_check()
{
    global $errorno;
    
    if(!file_exists(USER_DATA_FILE))
    {
        $errorno=ER_STRUCT;
        return FALSE;
    }
    
    include(USER_DATA_FILE);
    
    if(!$_COOKIE['AB01'] || !$_COOKIE['AC01'] || $_COOKIE['AB01']!=$admin_username || $_COOKIE['AC01']!=$admin_password)
    {
        $errorno=ER_NOTLOG;
        return FALSE;
    }
    
    return TRUE;
}
?>
