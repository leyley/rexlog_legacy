<?PHP
/*
* User login/logout/Check status fuctions;
*/
require_once("errorno.php");

define("USER_DATA_DIR",dirname(__FILE__)."/../data/users");

/* New user module; */
function user_login($username0,$password0)
{
	/*-----------------------------------------------------
	 * Cookies;
	 * AB01 - username;
	 * AC01 - password;
	 * AD01 - user level(verify when switching responsibilities);
	 * AE01 - nickname;
 	 *---------------------------------------------------*/
	global $errorno;
	if(!$username0 || !$password0)
	{
		$errorno=ER_IN;
		return FALSE;
	}
	$userfile=USER_DATA_DIR."/$username0.php";
	if(!file_exists($userfile))
	{
		$errorno=ER_LOGIN;
		return FALSE;
	}
	include($userfile);
	if($username0!=$user_username || $password0!=$user_password)
	{
		$errorno=ER_LOGIN;
		return FALSE;
	}

	setcookie("AB01",$user_username);
	setcookie("AC01",$user_password);
	setcookie("AD01",$user_level);
	setcookie("AE01",$user_nick);

	return TRUE;
}

function user_logout()
{
    setcookie("AB01","");
    setcookie("AC01","");
    setcookie("AD01","");
    setcookie("AE01","");
    return TRUE;
}

function log_check()
{
	global $errorno;   
	$userfile=USER_DATA_DIR."/".$_COOKIE['AB01'].".php";
	if(!file_exists($userfile))
	{
        $errorno=ER_STRUCT;
        return FALSE;
	}
	include($userfile);
	if(!$_COOKIE['AB01'] || !$_COOKIE['AC01'] || $_COOKIE['AB01']!=$user_username || $_COOKIE['AC01']!=$user_password || $_COOKIE['AD01']!=$user_level)
	{
        $errorno=ER_NOTLOG;
        return FALSE;
	}
   return TRUE;
}

function user_level()
{
	if(!$_COOKIE['AB01'])
		return -2;
	$userfile=USER_DATA_DIR."/".$_COOKIE['AB01'].".php";
	if(!file_exists($userfile))
		return -2;
	include($userfile);
		return $user_level;
}
?>
