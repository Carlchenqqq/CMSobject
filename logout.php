<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/4
 * Time: 16:28
 */
session_start();
$_SESSION = array();
session_destroy();
$_SESSION['isLogin'] = 0;
echo "<script>window.location.href='./login.php'</script>";
?>