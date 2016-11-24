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
    <form action="./do_mod_user.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
        用 户 名：<input class="common-text required" id="username" name="username" size="50" type="text" placeholder="中、英文均可，4-20字符" onblur="testb()" value="<?php echo $user['username']?>" required><p class="hid" id="hid2"></p><br/>
        密 &nbsp; 码：<input class="common-text required" id="password" name="password" size="50" value="" type="password" placeholder="4-20位英文、数字，区分大小写"  ><p class="hid" id="hid3"></p><br/>
        确认密码：<input class="common-text required" id="re_password" name="re_password" size="50" value="" type="password" placeholder="与上面相同" onblur="testf()" ><p class="hid" id="hid6"></p><br/>
        邮 &nbsp; 箱：<input class="common-text" name="email" id="email" size="50" value="<?php echo $user['email']?>" type="email" placeholder="填写你常用的邮箱" onblur="testa()"><p class="hid" id="hid1"></p><br/>
        头 &nbsp; 像：<img width="50" src="./uploads/<?php echo $user['pic']?>"><input name="pic" id="pic" type="file" ><input type="hidden" name="oldPic" value="<?php echo $user['pic']?>"><br/>
        性 &nbsp; 别：<input name="sex" id="sex" value="男" type="radio" <?php echo $user['sex'] == '男' ? "checked" : "" ?>/>男
                        <input name="sex" id="sex" value="女" type="radio" <?php echo $user['sex'] == '女' ? "checked" : "" ?>/>女<br/>
        个人简介：<textarea name="info" class="common-textarea" id="content" cols="30" style="width: 98%;font-size: medium;" rows="10"  ><?php echo $user['info']?></textarea></td>
        <input type="hidden" name="id" value="<?php echo $user['id']?>"/>
        <input class="myButton" value="提交" type="submit" />
        <input class="myButton" onclick="history.go(-1)" value="返回" type="button"/>
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