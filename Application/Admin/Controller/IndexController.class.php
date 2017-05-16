<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController{
    public function index(){
        $this->display();
    }


    public function pass(){
        $this->display();
    }

    public function passCheck(){
        $password_o=I('password_o','');
        $password=I('password','');
        $password_c=I('password_c','');

        if (trim($password_o) =='' || trim($password) =='' || trim($password_c) ==''){
            check_result(1,'密码不能为空');
            return;
        }
        if (strlen($password_o) <6 || strlen($password) <6 || strlen($password_c) <6){
            check_result(6,'密码不能少于6位数');
            return;
        }

        if ($password_o == $password){
            check_result(2,'新密码不能与原密码相同');
            return;
        }
        if ($password_c != $password){
            check_result(3,'确认密码不一致');
            return;
        }

        //判断原密码是否正确
        $admin=M('User');
        $data['username']=$_SESSION['admin']['username'];
        $result=$admin->where($data)->find();
       if ($result['user_pass'] !=md5($password_o)){
           check_result(4,'密码错误');
           return;
       }
       //修改密码
        $data1['user_pass']=md5($password);
        $result1=$admin->where($data)->save($data1);
//       $result1=$admin->where($data)->setField('user_pass',md5($password));
       if (!$result1){
           check_result(5,'修改失败');
           return;
       }
        $_SESSION['admin']=null;
        check_result(0,'修改成功');
//        $this->success('<script>window.top.location ="Login/index"; </script>',0);



    }


    public function info(){
        $this->display();
    }
}