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
    <title>个人管理</title>
    <link rel="stylesheet" href="./css/all_style.css" type="text/css">
    <script type="text/javascript" src="./admin/js/libs/modernizr.min.js"></script>
</head>
<body>
<?php include('public/topbar.php') ?>
<?php include('public/sidebar.php')?>
    <form id="myform" name="myform" enctype="multipart/form-data">
        用 户 名：<?php echo $user['username']?><br/>
        邮 &nbsp; 箱：<?php echo $user['email']?><br/>
        头 &nbsp; 像：<img width="50" src="./uploads/<?php echo $user['pic']?>"><br/>
        性 &nbsp; 别：<?php echo $user['sex']?><br/>
        个人简介：<textarea name="info" class="common-textarea" id="content" cols="30" style="width: 98%;font-size: medium;" rows="10" readonly ><?php echo $user['info']?></textarea></td>
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