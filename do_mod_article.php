<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/20
 * Time: 15:30
 */
include("./admin/public/acl.php");

include("./admin/public/function.php");
include("./admin/public/dbconnect.php");
if($_POST['category']=='行业资讯'){
    $_POST['secCategory']='无';
}else if($_POST['category']=='技术文章'&&$_POST['secCategory']=='无'){
    echo "<script>alert('请选择正确的类别')</script>";
    echo "<script>window.history.back()</script>>";
}
//var_dump($_POST);
$article = array_filter($_POST);
$tem = $_POST["editorValue"];
//echo $tem;
$article["content"] = addslashes(htmlspecialchars($tem));
unset($article["editorValue"]);
$id = $article['id'];
unset($article['id']);
$str = "";
foreach ($article as $key => $value) {
    $str.=$key."='".$value."',";
}
$str = rtrim($str,',');
$sql = "UPDATE articles SET {$str} WHERE id = {$id}";
$res = mysql_query($sql);
if($res){
    echo "<script>window.location.href = './my_articles.php'</script>";
}else{
    echo "<script>alert('修改失败2')</script>";
    echo "<script>window.history.back()</script>";
}