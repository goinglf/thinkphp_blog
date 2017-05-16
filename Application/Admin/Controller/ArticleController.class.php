<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController
{
    public function artAdd(){

        //A方法实现跨控制器,调用category控制器
        $data1=A('Category');
        //调用cateList方法
        $data1->cateList();

    }

    public function uploadify()
    {
        $targetFolder = '/Public/uploads'; // Relative to the root
//校验 与客户端的token进行比对
        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
//判断文件是否为空 token是否匹配
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
            //临时文件的名称
            $tempFile = $_FILES['Filedata']['tmp_name'];
            //需要保存的图片路径     根目录下的uploads文件夹
            $targetPath = $_SERVER['DOCUMENT_ROOT'] .$targetFolder;
            //去除右边的 重新拼接地址
            $_name=time().$_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath,'/') . '/' .$_name;

            // Validate the file type 校验文件的类型
            $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);//以数组的形式返回文件路径的信息
            //in_arry搜索数组中是否存在这个值.存在这个图片类型和图片路径
            //extension 返回图片的类型
            if (in_array(strtolower($fileParts['extension']),$fileTypes)) {
                //移动文件    参数:临时文件夹到新的文件夹
                move_uploaded_file($tempFile,$targetFile);
                //并返回文件的地址和名称
                echo $targetFolder.'/'.$_name;
            } else {
                echo '图片格式不正确';
            }
        }

    }






    public function artAddCheck(){

       $cate_id   = I('post.cate_pid','');
       $art_title  = I('post.art_title','');
       $art_editor = I('post.art_editor','');
       $art_thumb  = I('post.art_thumb','');
       $art_content= I('post.art_content','');
        if (trim($cate_id) == '' || trim($art_title) ==''){
            check_result(1,'文章分类或文章标题不能为空');
            return;
        }
        if (trim($art_editor) == '' ){
            check_result(2,'文章作者不能为空');
            return;
        }
//        if (trim($art_content) == '' ){
//            check_result(3,'文章内容不能为空');
//            return;
//        }

        //实例化模型
        $admin=M('Article');
        $data['cate_id']=$cate_id;
        $data['art_title']=$art_title;
        $data['art_editor']=$art_editor;
        $data['art_thumb']=$art_thumb;
        $data['art_content']=$art_content;
        $data['art_time']=time();
        //添加数据
        if ($admin->add($data)){
            check_result(0,'文章添加成功');
            return;
        }
        check_result(4,'文章添加失败');

    }
//显示文章列表+分页
    public function artList(){

        //实例化模型
        $admin= M('Article');
        //得出数据条数
        $count=$admin->count();
        //设置每页显示的条数
        $page=new \Think\Page($count,7);
        //将page方法显示
        $show=$page->show();
        //从数据库查询出符合的数据 根据id排序 从第几条到第几条进行查找
        $data=$admin->order('art_id desc')->limit($page->firstRow.','.$page->listRows)->select();

        //显示出数据
        $this->assign('data',$data);
        $this->assign('page',$show);
        $this->display();
    }


    //删除
    public function artDel(){
        if ($_POST){
            $art_id=I('post.art_id','');
            $admin=M('article');
            $data=$admin->where('art_id='.$art_id)->delete();
            if (!$data){
                check_result(1,'删除失败');
                return;
            }
            check_result(0,'删除成功');
        }
    }





    public function artEdit(){
        $art_id=I('get.art_id','');

        $admin= M('Article');
        $data=$admin->where('art_id='.$art_id)->find();



        $admin1 = M('Category');
        $res = $admin1->order('cate_order')->select();
        $data1=A('Category');
        //调用cateList方法
        $list=$data1->getTree($res);
        $this->assign('list',$list);
        $this->assign('data',$data);
        $this->display();
    }


    public function artEditCheck(){
        $art_id   = I('post.art_id','');
        $cate_pid   = I('post.cate_pid','');
        $art_title  = I('post.art_title','');
        $art_editor = I('post.art_editor','');
        $art_thumb  = I('post.art_thumb','');
        $art_content= I('post.art_content','');
        if (trim($cate_pid) == '' || trim($art_title) ==''){
            check_result(1,'文章分类或文章标题不能为空');
            return;
        }
        if (trim($art_editor) == '' ){
            check_result(2,'文章作者不能为空');
            return;
        }

        $admin=M('article');
        $result=$admin->where('art_id='.$art_id)->save($_POST);
        if ($result){
            check_result(0,'修改成功');
            return;
        }
        check_result(3,'修改失败');
        return;


    }

}