<?php
session_start();
include('./public/dbconnect.php');
if($_POST){
    $user = $_POST;
    $user['password'] = md5($user['password']);
    $sql = "SELECT * FROM user WHERE username = '{$user['username']}' AND password = '{$user['password']}'AND isAdmin = 2";
    $res = mysql_query($sql);
    $master = mysql_fetch_assoc($res);
    if($master){
        $_SESSION['master'] = $master;
        $_SESSION['isLogin'] = 1;
        echo "<script>window.location.href='http://localhost/CMSobject/admin/index.php'</script>";
    }else{
        echo "<script>alert('请输入正确的用户名和密码')</script>";
        echo "<script>window.history.back()</script>";
    }
}
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/3
 * Time: 17:47
 */
?>