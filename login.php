<?php
include "./admin/public/dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>登陆</title>
    <link rel="stylesheet" href="./css/all_style.css" type="text/css">
    <script type="text/javascript" src="js/allJs.js"></script>
</head>
<body>
<?php include('public/topbar.php')?>
<div class="admin_login_wrap">
    <h1>登陆</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="./do_login.php" method="post">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username"  id="user" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="password"  id="pwd" size="40" class="admin_input_style" />
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
</html>