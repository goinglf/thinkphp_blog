<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
    public function index(){
        $this->display();
    }


    public function checkLogin()
    {

        $username=I('post.username','');
        $password=I('post.password','');
        $code    =I('post.code','');

        //校验
        if (trim($username)=='' || trim($password)==''){
            check_result(1,'用户名或密码不能为空');
            return;

        }
        if (strlen($password) <6){
            check_result(2,'用户名或密码错误');
            return;
        }
        if (trim($code)=='' ){
            check_result(3,'验证码不能为空');
            return;
        }

        $verify=new \Think\Verify();
        if (!($verify->check($code))){
            check_result(4,'验证码错误');
            return;
        }
        //查询用户名是否存在
        $admin=M('User');
        $data['user_name'] = $username;
//        $result=$admin->where('user_name="'.$username.'"')->find();
        $result=$admin->where($data)->find();
        if (!$result){
            check_result(5,'用户名不存在');
            return;
        }
        if ($result['user_pass'] != md5($password)){
            check_result(6,'密码错误');
            return;
        }


//        $this->redirect('/index.php/admin/index/index');
        //设置session
        session('admin',$result);
        session('admin.username',$result['user_name']);
//        $this->success('登陆成功','/index.php/admin/index/index');
        check_result(0,'登陆成功');



    }

///退出
    public function logout(){
        $_SESSION['admin']=null;
        $this->error('退出成功','/index.php/admin/login/index');
    }


    public function verify()
    {

        $config =    array(
            'fontSize'    =>   40,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useCurve'    =>    false, // 关闭验证码杂点
        );
        $Verify =  new \Think\Verify($config);
        $Verify->entry();



    }

}