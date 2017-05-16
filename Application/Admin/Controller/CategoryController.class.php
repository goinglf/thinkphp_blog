<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController
{
    public function cateAdd()
    {
        $admin = M('Category');
        $data = $admin->where('cate_pid=0')->select();
        $this->assign('data', $data);
        $this->display();

    }

   public function cateDel(){

     if ($_POST){
    $cate_id=I('post.cate_id','');

    $admin=M('Category');
     $data=$admin->where('cate_id='.$cate_id)->delete();
    if (!$data){
        check_result(1,'删除失败');
        return;
    }
       check_result(0,'删除成功');
   }
    }
    public function cateAddCheck()
    {

        //接收数据
        $cate_pid = I('get.cate_pid', '');
        $cate_name = I('get.cate_name', '');
        $cate_title = I('get.cate_title', '');
        $cate_order = I('get.cate_order', '');

        //判断数据是否为空
        if (trim($cate_pid) == '' || trim($cate_name) == '') {
            check_result(1, '父类名称或分类名称不能为空');
            return;
        }

        if (trim($cate_order) == '') {
            check_result(3, '排序不能为空');
            return;
        }
        if (!is_numeric($cate_order)){
            check_result(4,'请输入数字');
            return;
        }


        //插入数据
        $admin = M('Category');
        $data['cate_pid'] = $cate_pid;
        $data['cate_name'] = $cate_name;
        $data['cate_title'] = $cate_title;
        $data['cate_order'] = $cate_order;
        if ($admin->add($data)) {
            check_result(0, '添加成功');
            return;
        }
        check_result(2, '添加失败');
        return;

    }

    public function cateList()
    {
        //原有排序
//        $admin = M('Category');
//        $res = $admin->order('cate_order')->select();
//        $data = $this->getTree($res);
////        //调用方法并返回值
//        $this->assign('data', $data);
//        $this->display();



        //分页

        //父类排序和分页测试
        $admin = M('Category');
        $res = $admin->order('cate_order')->select();
        $list = $this->getTree($res);

        $count=count($list);
        $Page=new \Think\Page($count,5);
        $show=$Page->show();
        $data=array_slice($list,$Page->firstRow,$Page->listRows);
        $this->assign('data',$data);
        $this->assign('page',$show);

        $this->assign('list',$list);
        $this->display();





    }

    public function getTree($data)
    {
        $arr = array();
        //获取父类 k为键名 v为值 获取k就可以获取全部的数组
        foreach ($data as $k => $v) {
            if ($v['cate_pid'] == 0) {
                //重新赋值一个cate_name.在前面添加一个制表符
                $data[$k]['_cate_name']=$data[$k]['cate_name'];
                $arr[] = $data[$k];

                //获取子类 子类的pid等于父类的id
                foreach ($data as $m => $n) {
                    if ($n['cate_pid'] == $v['cate_id']) {
                        //重新赋值一个cate_name.在前面添加一个制表符
                        $data[$m]['_cate_name']='--'.$data[$m]['cate_name'];
                        $arr[] = $data[$m];

                    }
                }
            }
        }
        //循环完成之后再执行返回给函数
        return $arr;
    }


    //修改排序
    public function changOrder(){
        if ($_POST){
        $cate_id=I('post.cate_id');
        $cate_order=I('post.cate_order');

            //判断类型是否是数字
        if (!is_numeric($cate_order)){
            check_result(2,'请输入数字');
            return;
        }

        $admin=M('Category');
        $data['cate_order']=$cate_order;

        $result=$admin->where('cate_id='.$cate_id)->save($data);
        if (!$result){
            check_result(1,'更新失败');
            return;
        }
            check_result(0,'更新成功');
    }

    }

    public function cateEdit(){
       $cate_id=I('get.cate_id');
       $admin=M('Category');
       $data=$admin->where('cate_id='.$cate_id)->find();
       $data1=$admin->where('cate_pid=0')->select();

       $this->assign('data1',$data1);
       $this->assign('data',$data);
       $this->display();
        }

    public function cateEditCheck()
    {
        if($_POST){
            $cate_id=I('post.cate_id','');
            $cate_pid = I('post.cate_pid', '');
            $cate_name = I('post.cate_name', '');
            $cate_title = I('post.cate_title', '');
            $cate_order = I('post.cate_order', '');

            //判断数据是否为空
            if (trim($cate_pid) == '' || trim($cate_name) == '') {
                check_result(1, '父类名称或分类名称不能为空');
                return;
            }
            if (trim($cate_order) == '') {
                check_result(2, '排序不能为空');
                return;
            }
            if (!is_numeric($cate_order)){
                check_result(4,'请输入数字');
                return;
            }

            $admin=M('Category');
            $result=$admin->where('cate_id='.$cate_id)->save($_POST);
            if ($result){
                check_result(0,'修改成功');
                return;
            }
            check_result(3,'修改失败');
            return;

        }

    }



}