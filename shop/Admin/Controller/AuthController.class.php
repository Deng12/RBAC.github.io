<?php

namespace Admin\Controller;
//use Think\Controller;
use Tool\AdminController;
//后台商品控制器
class AuthController extends AdminController{
    //列表展示
    function showlist(){
        //获得权限信息
        $info = D('Auth')->order('auth_path')->select();
        
        
        $this -> assign('info',$info);
        $this -> assign('ge',"--/");
        $this -> display();
    }
    //添加权限
    function tianjia(){
        
        $auth = new \Model\AuthModel();
        if(!empty($_POST)){
            //通过saveData方法制作权限的"auth_path"和"auth_level"进而实现整条记录的存储
            $info = $auth->create(); //过滤非法字段
            if($auth->saveData($info)){
                $this -> redirect('showlist');
            }else{
                echo "fail";
            }
        }
        
        //获得父级权限
        $auth_p_info = $auth->where('auth_level=0')->select();
        
        $this -> assign('auth_p_info',$auth_p_info);
        $this -> display();
    }
}
