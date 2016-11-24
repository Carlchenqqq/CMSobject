<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/20
 * Time: 13:25
 */
include("./admin/public/acl.php");
include("./admin/public/dbconnect.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>新增博文</title>
    <!--<link rel="stylesheet" type="text/css" href="./admin/css/main.css"/>-->
    <link rel="stylesheet" href="./css/all_style.css" type="text/css">
    <script type="text/javascript" src="./admin/js/libs/modernizr.min.js"></script>
    <script type="text/javascript" src="./admin/js/libs/check.js"></script>
</head>
<body>
<?php include('public/topbar.php') ?>
<?php include('public/sidebar.php')?>
    <form action="./do_add_myarticle.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
        <table class="add_art" width="85%">
            <tbody>
            <tr>
                <th>文章标题：</th>
                <td>
                    <input class="common-text required" id="articleName" name="articleName" size="50" value="" type="text" placeholder="请输入文章标题"  required>
                </td>
            </tr>
            <tr>
                <th>类别：</th>
                <td><?php
                    $sql = "SHOW COLUMNS FROM articles LIKE  'category'";
                    $res = mysql_query($sql);
                    $row = mysql_fetch_assoc($res);
                    $str=$row["Type"];
                    //echo $str;
                    $str=substr($str,5,strlen($str)-6);
                    $a=explode(",",$str);
                    for($x=0;$x<count($a);$x++){
                        $a[$x] = trim($a[$x],"'");//从字符串中去除单引号
                        echo "<input name='category' value='{$a[$x]}' type='radio'/>{$a[$x]}";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th width='120'>次类别：</th>
                <td>
                    <?php
                    $sql = "SHOW COLUMNS FROM articles LIKE  'secCategory'";
                    $res = mysql_query($sql);
                    $row = mysql_fetch_assoc($res);
                    $str=$row["Type"];
                    //echo $str;
                    $str=substr($str,5,strlen($str)-6);
                    $a=explode(",",$str);
                    for($x=0;$x<count($a);$x++){
                        $a[$x] = trim($a[$x],"'");//从字符串中去除单引号
                        echo "<input name='secCategory' value='{$a[$x]}' type='radio'/>{$a[$x]}";
                    }
                    ?>
                </td>
            </tr>
            <th>正文：</th>
            <td>
                <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                "http://www.w3.org/TR/html4/loose.dtd">
                <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
                    <script type="text/javascript" charset="utf-8" src="./admin/ueditor/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8" src="./admin/ueditor/ueditor.all.min.js"> </script>
                    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                    <script type="text/javascript" charset="utf-8" src="./admin/ueditor/lang/zh-cn/zh-cn.js"></script>
                </head>
                <body>
                <div>
                    <script id="editor" type="text/plain" style="width:96%;overflow:auto;"></script>
                </div>
                <script type="text/javascript">

                    //实例化编辑器
                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                    var ue = UE.getEditor('editor');
                                function getContentTxt() {
                                    var arr = [];
                                    arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
                                    arr.push("编辑器的纯文本内容为：");
                                    arr.push(UE.getEditor('editor').getContentTxt());
                                    alert(arr.join("\n"));
                                }
                                function disableBtn(str) {
                                    var div = document.getElementById('btns');
                                    var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
                                    for (var i = 0, btn; btn = btns[i++];) {
                                        if (btn.id == str) {
                                            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                                        } else {
                                            btn.setAttribute("disabled", "true");
                                        }
                                    }
                                }
                                function enableBtn() {
                                    var div = document.getElementById('btns');
                                    var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
                                    for (var i = 0, btn; btn = btns[i++];) {
                                        UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                                    }
                                }
                 </script>
                </body>
                </html>
            </td>
            <tr>
                <th></th>
                <td>
                    <input id="author" name="author"  value="<?php echo $_SESSION['master']['username']?>" type="hidden">
                    <input class="myButton" value="提交" type="submit" >
                    <input class="myButton" onclick="history.go(-1)" value="返回" type="button">
                </td>
            </tr>
            </tbody></table>
    </form>
</body>
</html>