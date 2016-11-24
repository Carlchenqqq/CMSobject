<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/19
 * Time: 15:01
 */
include("./admin/public/acl.php");
include("./admin/public/dbconnect.php");
$id = $_GET['id'];
$sql = "SELECT id,username,pic,email,sex,status,isAdmin,info FROM user WHERE id = {$id}";
$res = mysql_query($sql);
$user = mysql_fetch_assoc($res);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>个人作品管理</title>
    <link rel="stylesheet" type="text/css" href="./admin/css/main.css"/>
    <link rel="stylesheet" href="./css/all_style.css" type="text/css">
    <script type="text/javascript" src="./admin/js/libs/modernizr.min.js"></script>
</head>
<body>
<?php include('public/topbar.php') ?>
<?php include('public/sidebar.php')?>
<div class="result-list">
    <a href="./add_Myarticle.php" class="myButton">新增文章</a>
</div>
<form name="myarticle" id="myarticle" method="post">


    <div class="result-content">
        <table class="result-tab" width="150%">
            <tr>
                <th>序号</th>
                <th>文章名</th>
                <th>类别</th>
                <th>子类别</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?php
            session_start();
            $where = "WHERE author = '{$_SESSION['master']['username']}'";
            //echo $where;
            $sql = "SELECT count(id) count FROM articles {$where}";
            $res = mysql_query($sql);
            $count = mysql_fetch_assoc($res);
            $total = $count['count'];
            $limit = 5;
            $page = $_GET['page'] ? $_GET['page'] : 1;

            $pageCount = ceil($total / $limit);
            if($page >$pageCount||$page<1){
                $page =1;
            }
            $sqlLimit = ($page - 1)*$limit.','.$limit;

            $sql = "SELECT id,articleName,category,secCategory,articleStatus,createTime FROM articles {$where} LIMIT {$sqlLimit}";
            $res = mysql_query($sql);
            while(list($id,$articleName,$category,$secCategory,$articleStatus,$createTime) = mysql_fetch_row($res)){
                ?>
                <tr>
                    <td><?php $i = $i + 1;echo $i;?></td>
                    <td><div style="width:300px;overflow: hidden"><a href="./show_Myarticle.php?id=<?php echo $id?>"><?php echo $articleName ?></a></div></td>
                    <td><?php echo $category ?></td>
                    <td><?php echo $secCategory ?></td>
                    <td><?php echo $articleStatus == 2 ? "<font style=\"color:#FF0000;\">热门</font>":"普通" ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$createTime) ?></td>
                    <td>
                        <a class="link-update" href="./mod_article.php?id=<?php echo $id?>&page=<?php echo $page?>">修改</a>
                        <a class="link-del" href="./del_article.php?id=<?php echo $id?>">删除</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div class="list-page">
            <?php
            if($page>1){
                echo "<a class='myButton' href='?page=1'>首页</a>";
            }
            if($page > 3 ){
                $end = $page -3;
            }else{
                $end = 1;
            }
            for($i = $end;$i < $page;$i ++ ){
                echo "<a class='myButton' href='?page={$i}'>{$i}</a>";
            }
            echo "<a class='myButton' style='color: red;'>{$page}</a>";
            if($page < $pageCount-3){
                $end =$page + 3;
            }else{
                $end = $pageCount;
            }
            for($i = $page +1 ;$i <=$end;$i++){
                echo "<a class='myButton' href='?page={$i}'>{$i}</a>";
            }
            if($page < $pageCount) {
                echo "<a class='myButton' href='?page={$pageCount}'>尾页</a>";
            }
            echo "共{$pageCount}页";
            ?>
        </div>
    </div>
</form>
<!--/main-->
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