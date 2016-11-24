<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/20
 * Time: 15:39
 */
include("./admin/public/acl.php");
include('./admin/public/dbconnect.php');
$id = $_GET['id'];
$sql = "DELETE FROM articles WHERE id = {$id}";
$res = mysql_query($sql);
