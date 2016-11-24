<?php
/**
 * Created by PhpStorm.
 * User: chenqi
 * Date: 2016/11/20
 * Time: 15:32
 */
include("./admin/public/acl.php");
include("./admin/public/dbconnect.php");
$id = $_GET['id'];
$sql = "SELECT id,articleName,author,category,secCategory,articleStatus,createTime,content FROM articles WHERE id = {$id}";
$res = mysql_query($sql);
$article = mysql_fetch_assoc($res);
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
<?php include('public/topbar.php')?>
<div class="result-wrap">
    <div class="result-content">
            <table class="add_art" width="85%" >
                <tbody>
                <tr>
                    <th>文章标题：</th>
                    <td>
                        <?php echo $article['articleName']?>
                    </td>
                </tr>
                <tr>
                    <th>作    者：</th>
                    <td>
                        <?php echo $article['author']?>
                    </td>
                </tr>
                <tr>
                    <th width="120">类别：</th>
                    <td>
                        <?php echo $article['category']?>
                    </td>
                </tr>
                <tr>
                    <th width='120'>次类别：</th>
                    <td >
                        <?php echo $article['secCategory']?>
                    </td>
                </tr>
                <tr>
                    <th width="120">状态：</th>
                    <td>
                        <?php echo $article['articleStatus'] == '1' ? "普通" : "热门" ?>
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
                    <div style="border: 1px solid lavender;height: 500px;overflow: auto;"><?php echo $article['content']?>
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
                        <input class="myButton" onclick="history.go(-1)" value="返回" type="button"/>
                    </td>
                </tr>
                </tbody></table>
    </div>
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