<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/Public/Admin/style/font/css/font-awesome.min.css">
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">id</th>
                    <th>文章标题</th>
                    <th>作者</th>
                    <th>缩略图</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
                <td class="tc"><?php echo ($v['art_id']); ?><td>
                <a href="#"><?php echo ($v['art_title']); ?></a>
                </td>
                <td><?php echo ($v['art_editor']); ?></td>
                <td ><img src="<?php echo ($v['art_thumb']); ?>" width="30" height="30"></td>
                <td><?php echo (date('Y-m-d H:i:s',$v['art_time'] )); ?></td>

                <td>
                    <a href="/index.php/admin/Article/artEdit?art_id=<?php echo ($v['art_id']); ?>" >修改</a>
                    <a onclick="Article.del(<?php echo ($v['art_id']); ?>)">删除</a>
                </td>
                </tr><?php endforeach; endif; ?>
            </table>

            <div class="page_list">
                <ul>
                    <li class="active"><?php echo ($page); ?></li>
                </ul>
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
</body>
</html>
<script type="text/javascript" src="/Public/Admin/style/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/style/js/ch-ui.admin.js"></script>
<script type="text/javascript" src="/Public/Common/dialog/layer.js"></script>
<script type="text/javascript" src="/Public/Common/dialog/dialog.js"></script>
<script type="text/javascript" src="/Public/Admin/style/js/Article.js"></script>