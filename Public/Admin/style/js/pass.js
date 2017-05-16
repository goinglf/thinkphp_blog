
var pass={
    check:function () {
        var password_o = $('input[name=password_o]').val();
        var password = $('input[name=password]').val();
        var password_c = $('input[name=password_c]').val();


        if (password_o.length ==0 || password.length ==0 || password_c.length ==0){
            dialog.error('密码不能为空');
            return;
        }
        if (password_o.length <6 || password.length <6 || password_c.length <6){
            dialog.error('密码不能少于6位数');
            return;
        }

        if (password_o == password){
            dialog.error('新密码不能与原密码相同');
            return;
        }
        if (password_c != password){
            dialog.error('确认密码不一致');
            return;
        }

        var url = '/index.php/admin/index/passcheck';
        var data = {password_o: password_o, password: password, password_c: password_c};
        $.post(url, data, function ($data) {
            if($data.status !=0){
                dialog.error($data.message);
                return;
            }
            dialog.passCheck($data.message,'/index.php/admin/Login/index');

        },'JSON');
    },

}