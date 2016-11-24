<?php
include "./admin/public/dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>我的博客</title>
    <link rel="stylesheet" href="./css/all_style.css" type="text/css">
    <script type="text/javascript" src="js/allJs.js"></script>
</head>
<body>
    <?php include('public/topbar.php') ?>
    <div class="guide">
        <?php
        $sql = "SHOW COLUMNS FROM articles LIKE  'category'";
        $res = mysql_query($sql);
        $row = mysql_fetch_assoc($res);
        $str=$row["Type"];
        //echo $str;
        $str=substr($str,5,strlen($str)-6);
        $a=explode(",",$str);
        echo "<form method='post' action='#'>";
        echo "<input class='category' id='category' name='all_category' type='submit' value='全部'/>";
        for($x=0;$x<count($a);$x++){
            $a[$x] = trim($a[$x],"'");//从字符串中去除单引号
            echo "<input class='category' id='category' name='category' type='submit' value='{$a[$x]}'/>";
        }
        echo "</form>";
        ?>
    </div>
    <div class="secGuide">
        <?php
        $category= $_POST['category'];
        $sql = "SELECT DISTINCT secCategory From articles WHERE category='{$category}'";
        $res = mysql_query($sql);
        echo "<form method='post' action='#'>";
        echo "<input class='secCategory' id='all_secCategory' name='all_secCategory' type='submit' value='全部'/>";
        while($row = mysql_fetch_row($res)) {
            echo "<input type='hidden' name='category' value='{$category}'>";
            echo "<input class='secCategory' id='secCategory' name='secCategory' type='submit' value='{$row[0]}'/>";
        };
        echo "</form>";
        echo '</div>';
        echo '<div class="content">';
        //echo $_SESSION['cate']."<br/>";//session问题遗留
        //echo $secCategory = $_POST['secCategory'];
        ?>
    </div>
    <div class="ifpage" >
            <?php
            $search = $_REQUEST;
            $category= $_POST['category'];
            $search['articleName'] = $_POST['articleName'];
            $search['category'] =  $category;
            $search['secCategory'] =  $_POST['secCategory'];
            $where = "WHERE articleName LIKE '%{$search['articleName']}%' AND category LIKE '%{$search['category']}%' AND secCategory LIKE '%{$search['secCategory']}%'";
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

            $sql = "SELECT id,articleName,author,articleStatus,category,secCategory,createTime,content FROM articles {$where} LIMIT {$sqlLimit}";
            $res = mysql_query($sql);
            while(list($id,$articleName,$author,$articleStatus,$category,$secCategory,$createTime,$content) = mysql_fetch_row($res)){
                ?>
                <div style="margin-top: 20px">
                    <div class="date"><div><?php echo date('d',$createTime) ?></div>
                        <div><?php echo date('m',$createTime).'月' ?></div></div>
                    <div class="Title"><a href="./show_articles.php?id=<?php echo $id?>"><?php
                            echo $articleName
                            ?></a></div><?php
                            echo $author.'&nbsp;'
                            ?>状态: <?php
                            echo $articleStatus == 2 ? "<font style='color:#FF0000;'>热门&nbsp;</font>":"普通".'&nbsp;'
                            ?>类别：<?php
                            echo $category.'&nbsp;'
                            ?>次类别：<?php
                    echo $secCategory.'&nbsp;'
                    ?>
                    <div style="overflow: hidden;text-overflow: ellipsis;height:45px;margin-top: 10px"><?php echo $content ?></div>
                </div>
                <?php
            }
            ?>
            <div class="list-page">
                <?php
                $args = "articleName={$search['articleName']}";
                if($page>1){
                    echo "<a class='myButton' href='?page=1&{$args}'>首页</a>";
                }
                if($page > 3 ){
                    $end = $page -3;
                }else{
                    $end = 1;
                }
                for($i = $end;$i < $page;$i ++ ){
                    echo "<a class='myButton' href='?page={$i}&{$args}'>{$i}</a>";
                }
                echo "<a  class='myButton' style='color: red;'>{$page}</a>";
                if($page < $pageCount-3){
                    $end =$page + 3;
                }else{
                    $end = $pageCount;
                }
                for($i = $page +1 ;$i <=$end;$i++){
                    echo "<a class='myButton' href='?page={$i}&{$args}'>{$i}</a>";
                }
                if($page < $pageCount) {
                    echo "<a class='myButton' href='?page={$pageCount}&{$args}'>尾页</a>";
                }
                echo "共{$pageCount}页";
                ?>
            </div>
    </div>
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
</html>