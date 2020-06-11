<?php
session_start();


//Clear Session
$_SESSION["user_name"] = "";
session_destroy();

// clear cookies
/*if (isset($_COOKIE["user_name"])) {
     setcookie("user_name", "");
 }
if (isset($_COOKIE["user_password"])) {
    setcookie("user_password", "");
}

*/
header("Location: login.php");
?>