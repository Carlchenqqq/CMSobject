<?php
include('./public/dbconnect.php');
include("./public/acl.php");
include("./public/acl2.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MyArticle文章管理后台管理</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
    <script type=text/javascript src="js/libs/startTime.js"></script>
</head>
<body onload="startTime()">
<?php
include("./public/topbar.php");
?>
<div class="container clearfix">
    <?php
    include("./public/sidebar.php");
    ?>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="result-wrap">
            <div class="result-title">
                <h1>欢迎来到后台管理系统！</h1>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1 >系统基本信息</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">操作系统</label><span class="res-info"><?php echo PHP_OS ?></span>
                    </li>
                    <li>
                        <label class="res-lab">运行环境</label><span class="res-info"><?php echo $_SERVER['SERVER_SOFTWARE']?></span>
                    </li>
                    <li>
                        <label class="res-lab">PHP运行方式</label><span class="res-info"><?php echo php_sapi_name() ?></span>
                    </li>
                    <li>
                        <label class="res-lab">cq设计-版本</label><span class="res-info">v-0.1</span>
                    </li>
                    <li>
                        <label class="res-lab">上传附件限制</label><span class="res-info"><?php echo ini_get('upload_max_filesize')?></span>
                    </li>
                    <li>
                        <label class="res-lab">北京时间</label><span class="res-info"><div id="box1"></div></span>
                    </li>
                    <li>
                        <label class="res-lab">服务器域名</label><span class="res-info"><?php echo $_SERVER['HTTP_HOST'] ?></span>
                    </li>
                    <li>
                        <label class="res-lab">Host</label><span class="res-info"><?php echo $_SERVER['SERVER_ADDR'] ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>