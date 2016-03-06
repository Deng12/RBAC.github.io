<?php

namespace Admin\Controller;
//use Think\Controller;
use Tool\AdminController;

//后台商品控制器
class GoodsController extends AdminController{
    //商品列表展示
    function showlist(){
        //限制
        $goods = D('Goods');
        //实现数据分页效果
        //① 获得记录总条数
        $total = $goods -> count();
        $per = 7;
        //② 实例化分页类对象
        $page = new \Tool\Page($total, $per);
        
        //③ 拼装sql语句获得每页数据信息
        //   执行原生sql语句
        //   查询：model->query()   二维数组返回记录信息
        //   添加、修改、删除：model->execute()  受影响的记录条数
        $sql = "select * from sw_goods order by goods_id desc ".$page->limit;
        $info = $goods -> query($sql);//执行原生sql语句,返回二维数组信息
        
        //④ 获得页码列表
        $page_list = $page -> fpage();
        
        //获得全部商品信息，并给模板展示
        //select() “二维”数组返回结果
        //find()   “一维”数组返回唯一的一个记录结果
        //$info = $goods ->order('goods_id desc')-> select();
        $this -> assign('info',$info);
        $this -> assign('page_list',$page_list);
        $this -> display();
    }
    //添加商品
    function tianjia(){
        //限制
        $goods = D('Goods');
        //两个逻辑：展示表单、收集表单
        if(!empty($_POST)){
            
            //实现附件上传处理
            if($_FILES['goods_pic']['error']!=4){
                //A.实现图片上传
                $cfg = array(
                     'rootPath'      =>  './Admin/Public/up/', //保存根路径
                );
                //① 实例化Upload类对象
                $up = new \Think\Upload($cfg);
                //② 附件上传
                //   返回值$z可以获得附件在服务器保存的“路径”及“名字”
                $z = $up ->uploadOne($_FILES['goods_pic']);
                //var_dump($up->getError());
                $picpathname = './Admin/Public/up/'.$z['savepath'].$z['savename'];
                $_POST['goods_big_img'] = $picpathname;
                
                //B. 制作缩略图
                //① 实例化Image类对象
                $im = new \Think\Image();
                //② 打开被制作缩略图的图片
                $im -> open($picpathname);
                //③ 制作缩略图
                $im ->thumb(120, 120, 6);
                //④ 保存缩略图到服务器指定位置
                //./Admin/Public/up/2015-04-16/552f6395a8d42.jpg
                //./Admin/Public/up/2015-04-16/small_552f6395a8d42.jpg
                $smallpicname = './Admin/Public/up/'.$z['savepath'].'small_'.$z['savename'];
                $im -> save($smallpicname);
                $_POST['goods_small_img'] = $smallpicname;
            }
            //通过Model的create方法收集表单信息
            //(过滤非法字段、表单验证、自动完成)
            $info = $goods -> create();
            $z = $goods -> add($info); //add()返回新记录的主键id值
            if($z){
                $this -> redirect('showlist',array(),2,'添加商品成功！');
            }
        }
        $this -> display();
    }
    //修改商品
    function upd(){
        $this -> display();
    }
}
