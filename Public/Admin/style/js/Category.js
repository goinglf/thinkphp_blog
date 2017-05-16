
var Category={
    //添加
    addCheck:function () {
        var cate_pid=$('select[name=cate_pid]').val();
        var cate_name=$('input[name=cate_name]').val();
        var cate_title=$('input[name=cate_title]').val();
        var cate_order=$('input[name=cate_order]').val();


        if (cate_pid.length == 0 || cate_name.length == 0 ){
            dialog.error('父类或分类名称不能为空');
            return;
        }
        if (cate_order.length == 0 ){
            dialog.error('排序不能为空');
            return;
        }
        if (isNaN(cate_order)){
            dialog.error('排序请输入数字');
            return;
        }
        var url='/index.php/admin/category/cateAddCheck';
        var data={cate_pid:cate_pid,cate_name:cate_name,cate_title:cate_title,cate_order:cate_order};
        $.get(url,data,function ($data) {
            if ($data.status !=0){
                dialog.error($data.message);
                return;
            }
            dialog.success($data.message,'/index.php/admin/category/cateList');
        },'JSON');
    },
    //



    //删除
    del:function (cate_id) {
        layer.confirm('确认删除吗？', {
                btn: ['确认','取消'] //按钮
            }, function() {
            var url = '/index.php/admin/category/cateDel';
            var data = {cate_id: cate_id};
            $.post(url, data, function ($data) {
                if ($data.status != 0) {
                    dialog.error($data.message);
                    return;
                }
                dialog.success($data.message, '/index.php/admin/category/cateList');
            }, 'JSON');
            },
                function () {
                    layer.msg('取消删除', {
                        icon: 2,
                        time: 2000 //
                    });
                });
    },



    //修改排序
    changOrder:function (obj,cate_id) {
        //获取ID和order
        var cate_order=$(obj).val();

        //判断类型是否是数字
        if (isNaN(cate_order)){
            dialog.error('请输入数字');
            return;
        }
        var url='/index.php/admin/category/changOrder';
        var data={cate_id:cate_id,cate_order:cate_order};
        $.post(url,data,function ($data) {
            if ($data.status !=0){
                dialog.error($data.message);
                return;
            }
            dialog.toconfirm($data.message);
        },'JSON');

    },
    //修改内容
    edit:function (cate_id) {
        var cate_pid=$('select[name=cate_pid]').val();
        var cate_name=$('input[name=cate_name]').val();
        var cate_title=$('input[name=cate_title]').val();
        var cate_order=$('input[name=cate_order]').val();

        if (cate_pid.length == 0 || cate_name.length == 0 ){
            dialog.error('父类或分类名称不能为空');
            return;
        }
        if (cate_order.length == 0 ){
            dialog.error('排序不能为空');
            return;
        }
        if (isNaN(cate_order)){
            dialog.error('排序请输入数字');
            return;
        }

        var url='/index.php/admin/category/cateEditCheck';
        var data={cate_id:cate_id,cate_pid:cate_pid,cate_name:cate_name,cate_title:cate_title,cate_order:cate_order};
        $.post(url,data,function ($data) {
            if ($data.status !=0){
                dialog.error($data.message);
                return;
            }
            dialog.success($data.message, '/index.php/admin/category/cateList');
        },'JSON');
    },





}