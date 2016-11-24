<?php
include("./admin/public/dbconnect.php");
$id = $_GET['id'];
$sql = "SELECT id,articleName,author,category,secCategory,articleStatus,createTime,content FROM articles WHERE id = {$id}";
$res = mysql_query($sql);
$article = mysql_fetch_assoc($res);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>我的博客</title>
    <link rel="stylesheet" href="./css/all_style.css" type="text/css">
</head>
<body>
<?php include('public/topbar.php')?>
    <div class="result-content">
        <a class="myButton" href="index.php">返回</a>
        <h1 style="text-align: center;font-size: x-large"><?php echo $article['articleName']?></h1>
        <p style="text-align: center;font-size: large">作者：<?php echo $article['author']?></p>
        <p>类别：<?php echo $article['category'] ?>  次类别：<?php echo $article['secCategory'] ?>  状态：<?php echo $article['articleStatus'] == '1' ? "普通" : "热门" ?></p>
        <div><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
            </head>
            <body>
            <div><?php echo $article['content']?>
            </div>
            </body>
            </html>
        </div>
    </div>
<div class="comment" style="position: absolute;margin-left: 62%;margin-top: 25%">
    评论：
    <form class="com" method="post" action="#">
        <textarea rows="5" style="width: 400px" name="comment"></textarea><br>
        <input type="hidden" name="articleName" value="<?php echo $article['articleName']?>"/>
        <input class="myButton" type="submit" value="提交" />
    </form>
    <table class="result-tab" width="105%" style="line-height: 50px">
        <?php
        $sql = "SELECT count(id) count FROM comments WHERE articleName='{$article['articleName']}'";
        $res = mysql_query($sql);
        $count = mysql_fetch_assoc($res);
        $total = $count['count'];
        $sql = "SELECT id,comment,username,rel_com_id,createTime FROM comments WHERE articleName='{$article['articleName']}'";
        $res = mysql_query($sql);
        while(list($id,$comment,$username,$rel_com_id,$createTime) = mysql_fetch_row($res)){
        ?>
            <tr>
                <td><?php echo $total.'楼：'; $total = $total-1; ?> From【<?php echo $username ?>】：<div style="width:400px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php
                        $sql = "SELECT comment,username FROM comments WHERE id= {$rel_com_id}";
                        $re_res = mysql_query($sql);
                        $row = mysql_fetch_assoc($re_res);
                        if($row){
                            echo 'to用户'.$row['username'].':'.$row['comment'];
                        }
                        ?></div></td>
            </tr>
            <tr><td><?php echo $comment ?></td></tr>
            <tr><td><?php echo date('Y-m-d H:i:s',$createTime) ?></td><td><button id='recom' class="myButton" onclick="recom(re_com_text_<?php echo $id?>)">回复</button></td></tr>
            <tr>
                <td>
                    <div id='re_com_text_<?php echo $id?>' style="display: none">
                        <form method="post" action="#">
                            <textarea name="re_comment" style="width: 450px" rows="5"></textarea>
                            <input type="hidden" name="rel_com_id" value="<?php echo $id ?>"/>
                            <input type="hidden" name="articleName" value="<?php echo $article['articleName']?>"/>
                            <input type="submit" class="myButton" value="确定">
                        </form><button class="myButton" onclick="removecom(re_com_text_<?php echo $id?>)">取消</button>
                    </div>
                </td>
            </tr>
            <?php
            }
            ?>
    </table>
</div>
<?php
if($_POST['comment']){
    if($_SESSION['master']){
            $com['articleName'] = $_POST['articleName'];
            $com['createTime'] = time();
            $com['username'] = $_SESSION['master']['username'];
            $com['comment'] = $_POST['comment'];
            //ar_dump($com);
            $flieds = implode(',', array_keys($com));
            $values = "'" . implode("','", $com) . "'";
            //echo $values;
            //echo $flieds;
            $sql = "INSERT INTO comments (" . $flieds . ") VALUE (" . $values . ")";
            $res = mysql_query($sql);
            unset($com);
            echo '<script>location.replace(document.referrer);</script>';
        }else{
        echo "<script>alert('请登录')</script>";
    }
}
if($_POST['re_comment']){
    if($_SESSION['master']){
        $com['rel_com_id'] = $_POST['rel_com_id'];
        $com['articleName'] = $_POST['articleName'];
        $com['createTime'] = time();
        $com['username'] = $_SESSION['master']['username'];
        $com['comment'] = $_POST['re_comment'];
        //ar_dump($com);
        $flieds = implode(',',array_keys($com));
        $values = "'".implode("','",$com)."'";
        //echo $values;
        //echo $flieds;
       echo  $sql = "INSERT INTO comments (".$flieds.") VALUE (".$values.")";
        $res = mysql_query($sql);
        echo '<script>location.replace(document.referrer);</script>';
        }else{
            echo "<script>alert('请登录')</script>";
        }
    }

?>
<div class="hotCont">
    <?php
    $sql = "SELECT id,articleName,author,articleStatus,createTime,content FROM articles WHERE articleStatus=2";
    $res = mysql_query($sql);
    $i =1;
    echo '<div class="hot_cont">';
    echo '热门资讯：';
    while(list($id,$articleName,$author,$articleStatus,$createTime,$content) = mysql_fetch_row($res)){
        ?>

            <h3><?php echo $i++.'、'; ?><a href="./show_articles.php?id=<?php echo $id?>"><?php echo $articleName ?></a></h3>
        <?php
    }
    echo '</div>';
    ?>
</div>
<div class="mylink">
    <?php
    $sql = "SELECT adv_name,adv_link FROM advertisements";
    $res = mysql_query($sql);
    echo '友情链接';
    while(list($adv_name,$adv_link) = mysql_fetch_row($res)){
        ?>
        <a href="http://<?php echo $adv_link?>" target="_blank"><?php echo $adv_name ?></a>
        <?php
    }
    ?>
    <a href="#logo">回到顶部</a>
</div>
</body>
<script type="text/javascript" src="./admin/js/libs/check.js"></script>
</html>