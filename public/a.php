<?php

if ($_POST) {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    echo '<hr>';
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="keywords" content="keywords">
<meta name="description" content="description">
<link href="favicon.ico" rel="icon" type="image/x-icon">
<link href="" type="text/css" rel="stylesheet">
<script src=""></script>
<title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="val" value="val"><br />
        <input type="file" name="logo"><br />
        <input type="file" name="pic"><br />
        <input type="file" name="list[]"><br />
        <input type="file" name="list[]"><br />
        <input type="file" name="img-list[]"><br />
        <input type="file" name="img-list[]"><br /><br />

        <!-- 如果有name有值，则就会有一个$_POST[s] = 提交的值 -->
        <input type="submit" name="s" value="提交"><br />
        <!-- 没有提交效果 -->
        <input type="button" name="b" value="提交按钮"><br />
        <!-- 在form中有提交效果，type="submit" 也有提交效果，但是 type="button" 就没有提交效果了 （注意所有的提交按钮必须在form中才能提交除非用js控制） -->
        <button>按钮</button>
    </form>
</body>
</html>
