<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/19
 * Time: 16:39
 */
include("./admin/public/acl.php");
include("./admin/public/function.php");
include("./admin/public/dbconnect.php");
if($_POST){
    $user = $_POST;
    if($user['password'] == $user['re_password']){
        $user['password'] = md5($user['password']);
        unset($user['re_password']);
    }
    if($_FILES) {
        $user['pic'] = upload($_FILES['pic']);
    }
    $user['createTime'] = time();
    $user = array_filter($user);
    $flieds = implode(',',array_keys($user));
    $values = "'".implode("','",$user)."'";
    $sql = "INSERT INTO user(".$flieds.") VALUE (".$values.")";
    $res = mysql_query($sql);

    if($res){
        echo '<script>window.location.href="./login.php"</script>';
    }else{
        echo '<script>window.location.href="./add_user.php"</script>';
    }
}