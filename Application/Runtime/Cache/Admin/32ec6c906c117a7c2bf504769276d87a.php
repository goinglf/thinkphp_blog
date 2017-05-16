<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/Public/Admin/style/font/css/font-awesome.min.css">

</head>
<body style="background:#F3F3F4;">
<div class="login_box">
    <h1>Blog</h1>
    <h2>欢迎使用博客管理平台</h2>
    <div class="form">
        <!--<p style="color:red">用户名错误</p>-->
        <!--action="/index.php/admin/login/checklogin"-->
        <form  method="post">
            <ul>
                <li>
                    <input type="text" name="username" class="text"/>
                    <span><i class="fa fa-user"></i></span>
                </li>
                <li>
                    <input type="password" name="password" class="text"/>
                    <span><i class="fa fa-lock"></i></span>
                </li>
                <li>
                    <input type="text" class="code" name="code"/>
                    <span><i class="fa fa-check-square-o"></i></span>
                    <img src="/index.php/admin/login/verify" alt="" onclick="this.src='/index.php/admin/login/verify?'+Math.random()">
                </li>
                <li>
                    <input type="button" value="立即登陆" onclick="login.check()"/>
                </li>
            </ul>
        </form>
        <p><a href="#">返回首页</a> &copy; 2016 Powered by <a href="http://www.houdunwang.com" target="_blank">http://www.houdunwang.com</a></p>
    </div>
</div>


</body>
</html>
<script type="text/javascript" src="/Public/Admin/style/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/style/js/ch-ui.admin.js"></script>
<script type="text/javascript" src="/Public/Common/dialog/layer.js"></script>
<script type="text/javascript" src="/Public/Common/dialog/dialog.js"></script>
<script type="text/javascript" src="/Public/Admin/style/js/login.js"></script>