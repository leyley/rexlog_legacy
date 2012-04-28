<?PHP
/*
* This file defines the error code;
* ER_IO: I/O Error;
* ER_STRUCT: Spoiled structure;
* ER_IN: Illegal input;
* ER_NOMSG: No such message;
*/

$errorno=0;

define("ER_IO",-1);
define("ER_STRUCT",-2);
define("ER_IN",-3);
define("ER_NOMSG",-4);
define("ER_LOGIN",-5);
define("ER_NOTLOG",-6);
define("ER_NOFILE",-7);
define("ER_HASFILE",-8);

$strer[ER_IO]="I/O Error, check permission first.";
$strer[ER_STRUCT]="Spoiled structure, the program might be damaged.";
$strer[ER_IN]="Illegal input, besure you have inputed all arguments.";
$strer[ER_NOMSG]="No such message, operate failed.";
$strer[ER_LOGIN]="Login failed, wrong username or password.";
$strer[ER_NOTLOG]="To visit this page, you need to login.";
$strer[ER_NOFILE]="The file is not exist.";
$strer[ER_HASFILE]="The file is alread exists.";

/*
* Return the errorno;
*/
function geterror()
{
	global $errorno;
	return $errorno;
}
/*
* This function return error string when excpetion raised;
*/
function strerror($errorno)
{
    global $strer;
    return $strer[$errorno];
}
?>
