<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/19
 * Time: 16:05
 */
include "./admin/public/dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>注册</title>
    <link rel="stylesheet" href="./css/all_style.css" type="text/css">
</head>
<body>
<?php include('public/topbar.php')?>
<div class="admin_login_wrap">
    <h1>注册</h1>
    <div class="adming_login_border">
        <div class="admin_input" style="width: 300px">
            <form action="./do_reg.php" method="post" enctype="multipart/form-data">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input class="admin_input_style" id="username" name="username" size="50" value="" type="text" placeholder="中、英文均可，4-20字符" onblur="testb()" required /><p class="hid" id="hid2"></p>
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input class="admin_input_style" id="password" name="password" size="50" value="" type="password" placeholder="4-20位英文、数字，区分大小写" onblur="testc()" required /><p class="hid" id="hid3" />
                    </li>
                    <li>
                        <label for="re_pwd">密码：</label>
                        <input class="admin_input_style" id="re_password" name="re_password" size="50" value="" type="password" placeholder="与上面相同" onblur="testf()" required><p class="hid" id="hid6"></p>
                    </li>
                    <li>
                        <label for="email">邮箱：</label>
                        <input class="admin_input_style" type="email" name="email" id="email" size="50" value="" placeholder="填写你常用的邮箱" onblur="testa()"><p class="hid" id="hid1"></p>
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="./index.php">返回首页</a> </p>
</div>
</body>
<script type="text/javascript" src="./admin/js/libs/check.js"></script>
</html>