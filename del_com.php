<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/23
 * Time: 10:54
 */
include("./admin/public/acl.php");
include('./admin/public/dbconnect.php');
$id = $_GET['id'];
$sql = "DELETE FROM comments WHERE id = {$id}";
$res = mysql_query($sql);
echo "<script>window.location.href='./my_com.php'</script>";