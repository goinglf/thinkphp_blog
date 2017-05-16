

var Article={
    //添加检查
    addCheck:function () {
        //接收数据
        var cate_pid=$('select[name=cate_pid]').val();
        var art_title=$('input[name=art_title]').val();
        var art_editor=$('input[name=art_editor]').val();
        var art_thumb=$('input[name=art_thumb]').val();
        var art_content = ue.getContent();

        //校验
        if (cate_pid.length ==0 || art_title.length ==0){
            dialog.error('文章分类或文章标题不能为空');
            return;
        }
        if (art_editor.length ==0 ){
            dialog.error('文章作者不能为空');
            return;
        }
        if (art_content.length ==0 ){
            dialog.error('文章内容不能为空');
            return;
        }

        //用post提交数据
        var url='/index.php/admin/article/artAddCheck';
        var data={cate_pid:cate_pid,art_title:art_title,art_editor:art_editor,art_thumb:art_thumb,art_content:art_content};
        $.post(url,data,function ($data) {
            if ($data.status !=0){
                dialog.error($data.message);
                return;
            }
            //成功之后调用的方法
            dialog.success($data.message,'/index.php/admin/article/artList');
        },'JSON');

        },

        del:function (art_id) {
            layer.confirm('确认删除吗？', {
                    btn: ['确认','取消'] //按钮
                }, function() {
                    var url = '/index.php/admin/article/artDel';
                    var data = {art_id:art_id};
                    $.post(url, data, function ($data) {
                        if ($data.status != 0) {
                            dialog.error($data.message);
                            return;
                        }
                        dialog.success($data.message, '/index.php/admin/article/artList');
                    }, 'JSON');
                },
                function () {
                    layer.msg('取消删除', {
                        icon: 2,
                        time: 2000 //
                    });
                });
        },


    edit:function (art_id) {
        var cate_pid=$('select[name=cate_pid]').val();
        var art_title=$('input[name=art_title]').val();
        var art_editor=$('input[name=art_editor]').val();
        var art_thumb=$('input[name=art_thumb]').val();
        var art_content = ue.getContent();

        //校验
        if (cate_pid.length ==0 || art_title.length ==0){
            dialog.error('文章分类或文章标题不能为空');
            return;
        }
        if (art_editor.length ==0 ){
            dialog.error('文章作者不能为空');
            return;
        }
        if (art_content.length ==0 ){
            dialog.error('文章内容不能为空');
            return;
        }

        var url='/index.php/admin/article/artEditCheck';
        var data={art_id:art_id,cate_pid:cate_pid,art_title:art_title,art_editor:art_editor,art_thumb:art_thumb,art_content:art_content};
        $.post(url,data,function ($data) {
            if ($data.status !=0){
                dialog.error($data.message);
                return;
            }
            dialog.success($data.message, '/index.php/admin/article/artList');
        },'JSON');
    },
}