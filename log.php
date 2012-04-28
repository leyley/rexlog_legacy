<?PHP
require_once("include/user.php");
/*
* index.php can not use this page;
*/
if(defined(INDEX_IN))
{
    echo "This page cannot be included by index.";
    exit();
}
/*
* Login;
*/
if($_GET['act']=="in")
{
    if(!user_login($_POST['admin_username'],md5($_POST['admin_password'])))
        echo "<script language='JavaScript'>location.href='index.php?path=login&error=$errorno';</script>";
    else
        echo "<script language='JavaScript'>location.href='index.php?path=admin';</script>";
    
    exit();
}
/*
* Logout
*/
if($_GET['act']=="out")
{
    user_logout();
        echo "<script language='JavaScript'>location.href='index.php?path=home';</script>";
    exit();
}
?>
