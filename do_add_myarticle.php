<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/20
 * Time: 13:47
 */
include("./admin/public/acl.php");
include("./admin/public/function.php");
include("./admin/public/dbconnect.php");
if($_POST){
    $articles = array();
    $articles = $_POST;
    $tem = $_POST["editorValue"];
    //echo $tem;
    $articles["content"] = addslashes(htmlspecialchars($tem));
    unset($articles["editorValue"]);
    if($articles['category']){

    }else{
        echo "<script>alert('请选择一个类别')</script>>";
        echo "<script>window.history.back()</script>>";
    };
    if($articles['category']=='行业资讯'){
        $articles['secCategory']='无';
    }else if($articles['category']=='技术文章'&&$articles['secCategory']=='无'){
        echo "<script>alert('请选择正确的类别')</script>";
        echo "<script>window.history.back()</script>>";
    };
    if($articles['category']=="技术文章"){
        if($articles['secCategory']){

        }else{
            echo "<script>alert('请为文章选择子类别')</script>>";
            echo "<script>window.history.back()</script>>";
        }
    };
    $articles['createTime'] = time();
    $sql = "SELECT username FROM user WHERE username='{$articles['author']}'";
    $res = mysql_query($sql);
    if (mysql_fetch_assoc($res)){
        echo '<script>window.location.href="./my_articles.php"</script>';
    }else{
        echo "<script>alert('该用户还未注册')</script>>";
        echo "<script>window.location.href='./add_Myarticle.php'</script>>";
    };

}
    $articles = array_filter($articles);
    $flieds = implode(',',array_keys($articles));
    $values = "'".implode("','",$articles)."'";
    $sql = "INSERT INTO articles(".$flieds.") VALUE (".$values.")";
    $res = mysql_query($sql);

    if($res){
        echo '<script>window.location.href="./my_articles.php"</script>';
    }else{
        echo "<script>window.location.href='./add_Myarticle.php'</script>>";
    }

/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/5
 * Time: 12:42
 */