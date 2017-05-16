<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/Public/Admin/style/font/css/font-awesome.min.css">
    <script type="text/javascript" src="/Public/Admin/style/js/jquery.js"></script>

</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form  method="post">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>分类：</th>
                <td>
                    <select name="cate_pid">
                        <option value="">==请选择==</option>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['cate_id'] == $data['cate_id']): ?><option value="<?php echo ($vo["cate_id"]); ?>" selected><?php echo ($vo["_cate_name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($vo["cate_id"]); ?>"><?php echo ($vo["_cate_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>文章标题：</th>
                <td>
                    <input type="text" class="lg" name="art_title" value="<?php echo ($data['art_title']); ?>">
                    <p>标题可以写30个字</p>
                </td>
            </tr>
            <tr>
                <th>作者：</th>
                <td>
                    <input type="text" name="art_editor" value="<?php echo ($data['art_editor']); ?>">
                    <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                </td>
            </tr>
            <tr>
                <th>缩略图：</th>
                <td>
                    <input type="text" size="50" name="art_thumb" value="<?php echo ($data['art_thumb']); ?>" readonly>
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                    <script src="/Public/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="/Public/uploadify/uploadify.css">
                    <script type="text/javascript">
                        //                        <?php $timestamp = time();?>
                        <?php echo ($timestamp = time()); ?>;
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText' : '图片上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    'token'     : "<?php echo md5('unique_salt' . $timestamp);?>"
                                },
                                'swf'      : "/Public/uploadify/uploadify.swf",
                                'uploader' : "/index.php/admin/article/uploadify",
                                //如果成功上传
                                'onUploadSuccess' : function(file, data, response) {

                                    $('input[name=art_thumb]').val(data);//填充缩略图地址
                                    $('#art_thumb_img').attr('src',''+data);//给图片添加src
//                                    alert(data);
                                }
                            });
                        });
                    </script>

                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>
                    <img src="<?php echo ($data['art_thumb']); ?>" id="art_thumb_img" width="80">
                </td>
            </tr>
            <tr>
                <th>文章内容：</th>
                <td>
                    <script type="text/javascript" charset="utf-8" src="/Public/Common/ueditor/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8" src="/Public/Common/ueditor/ueditor.all.min.js"></script>
                    <script type="text/javascript" charset="utf-8" src="/Public/Common/ueditor/lang/zh-cn/zh-cn.js"></script>
                    <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;"><?php echo (htmlspecialchars_decode($data["art_content"])); ?></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height:22px;}
                    </style>
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="button" value="提交" onclick="Article.edit(<?php echo ($data['art_id']); ?>)">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>

<script type="text/javascript" src="/Public/Admin/style/js/ch-ui.admin.js"></script>
<script type="text/javascript" src="/Public/Common/dialog/layer.js"></script>
<script type="text/javascript" src="/Public/Common/dialog/dialog.js"></script>
<script type="text/javascript" src="/Public/Admin/style/js/Article.js"></script>
<script type="text/javascript" src="/Public/uploadify/jquery.uploadify.js"></script>