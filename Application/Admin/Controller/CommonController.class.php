<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
       if ($_SESSION['admin'] == ''){
           $this->error('请登录','/index.php/admin/login/index');
//           $this->error('请先登录后再浏览',U('Login/index'));
       }
    }

}