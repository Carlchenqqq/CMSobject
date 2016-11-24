<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/1
 * Time: 13:37
 */

include("./admin/public/acl.php");

include("./admin/public/function.php");
include("./admin/public/dbconnect.php");

if($_POST){
    if($_POST['password'] || $_POST['re_password']){
        if($_POST['password'] == $_POST['re_password']){
            $_POST['password'] == md5($_POST['password']);
        }else{
            echo "<script>alert('密码与确认密码不一致')</script>>";
            echo "<script>window.history.back()</script>>";
        }
    }
}

$user = array_filter($_POST);
if($user['info']){

}else{
    $user['info']='';
}
if($_FILES['pic']['name']){
    $user['pic'] = upload($_FILES['pic']);
    $oldPic = "./uploads/".$user['oldPic'];
}
unset($user['oldPic']);
$id = $user['id'];
unset($user['id']);
$str = "";
foreach ($user as $key => $value) {
    $str.=$key."='".$value."',";
}
$str = rtrim($str,',');
$sql = "UPDATE user SET {$str} WHERE id = {$id}";
$res = mysql_query($sql);
if($res){
    @unlink($oldPic);
    echo "<script>window.location.href = './users.php?id={$id}'</script>";
}else{
    $pic = './uploads/'.$user['pic'];
    @unlink($pic);
    echo "<script>alert('修改失败')</script>";
    echo "<script>window.history.back()</script>>";
}