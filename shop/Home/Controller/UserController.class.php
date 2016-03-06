<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends Controller {

    function login() {
        if (!empty($_POST)) {
            //校验用户名和密码
            $nm = $_POST['username'];
            $pw = $_POST['password'];
            //利用model模型的"自定义"方法校验用户名和密码
            $user = new \Model\UserModel();
            $info = $user->checkNamePwd($nm, $pw);
            if ($info) {
                //持久化用户信息，并做页面跳转
                session('user_name', $info['username']);
                session('user_id', $info['user_id']);
                
                //操作redis，实现用户信息存储到list列表之中
                //$redis = new Redis();
                //$redis -> connect('192.168.42.130','6379');
                //$redis -> select(5);
                //$redis -> lpush('newlogin',$info['username']);
                $url = "http://192.168.42.130/login.php?username=".$info['username'];
                file_get_contents($url);
                
                $this->redirect('Index/index');
                //$this ->redirect('Index/index', array('goods_id'=>101), 3,'正在登陆系统');
                //$this ->redirect($url, $params, $delay间隔时间, $msg提示信息)
            }
            echo "用户名或密码不正确";
        }

        $this->display();
    }

    function logout(){
        session(null);
        $this->redirect('Index/index');
    }
    
    function register() {
        $user = new \Model\UserModel();
        if (!empty($_POST)) {
            //处理爱好为字符串信息
            $info = $user->create(); //收集表单信息、表单验证、自动完成、过滤非法字段
            if ($info) {
                $info['user_hobby'] = implode(',', $info['user_hobby']);
                if ($user->add($info))
                    $this->redirect('Index/index');
            }else {
                //表单验证失败
                $this->assign('infoError', $user->getError());
            }
        }
        $this->display();
    }

}
