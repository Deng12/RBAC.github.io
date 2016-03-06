<?php

namespace Admin\Controller;
//use Think\Controller;
use Tool\AdminController;
//后台管理员控制器
class ManagerController extends AdminController{
    //登录
    function login(){
        //$obj = D();
        //$obj = D('User');
        //var_dump($obj);
        //两个逻辑：展示表单、收集表单
        if(!empty($_POST)){
            //收集表单信息:校验验证码、校验用户名和密码、跳转到后台品字首页面
            //校验验证码
            $vry = new \Think\Verify();
            if($vry -> check($_POST['captcha'])){
                //校验用户名和密码
                $nm = $_POST['admin_user'];
                $pw = $_POST['admin_psd'];
                //利用model模型的"自定义"方法校验用户名和密码
                $user = new \Model\ManagerModel();
                $info = $user -> checkNamePwd($nm,$pw);
                if($info){
                    //持久化用户信息，并做页面跳转
                    session('admin_user',$info['mg_name']);
                    session('admin_id',$info['mg_id']);
                    $this ->redirect('Index/index');
                    //$this ->redirect('Index/index', array('goods_id'=>101), 3,'正在登陆系统');
                    //$this ->redirect($url, $params, $delay间隔时间, $msg提示信息)
                }
            }
            echo "验证码错误";
        }
        //展示表单信息
        $this -> display();
    }
    
    //退出系统
    function logout(){
        //session(name);//获得name的session信息
        //session(name，value);//设置name的session信息
        //session(name，null);//删除name的session信息
        //session(null);//删除全部session信息
        session(null); //清空session
        $this -> redirect('login');
    }
    
    //展示验证码
    function verifyImg(){
        $cfg = array(
            'imageH'    =>  36,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'fontSize'  =>  15,              // 验证码字体大小(px)
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        //实例化Verify.class.php对象
        $very = new \Think\Verify($cfg);
        echo $very -> entry();
    }
}
