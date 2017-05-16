
var login ={
    //前台调用 login.check()
    check:function () {
       var username=$('input[name=username]').val();
       var password=$('input[name=password]').val();
       var code=$('input[name=code]').val();

       if (username.length ==0 || password.length ==0){
           dialog.error('用户名或密码不能为空');
           return;
       }
        if (code.length ==0 ){
            dialog.error('验证码不能为空');
            return;
        }
        if (password.length <6 ){
            dialog.error('密码不少于6位数');
            return;
        }

        //使用post传值,有三个参数,地址,数据,和成功之后执行的语句
        var url='/index.php/admin/login/checklogin';
        var data={username:username,password:password,code:code};
        $.post(url,data,function ($data) {
            if ($data.status != 0){
                dialog.error($data.message);
                return;
            }
            dialog.success($data.message,'/index.php/admin/index/index');
        },'JSON');

    },


    logout:function () {
        dialog.confirm('确定要退出吗?','/index.php/admin/login/logout');
    }

}