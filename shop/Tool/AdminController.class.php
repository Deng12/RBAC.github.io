<?php

namespace Tool;
use Think\Controller;

class AdminController extends Controller{
    //构造方法
    function __construct() {
        parent::__construct();
        //实现访问权限控制器过滤功能(防止翻墙访问)
        //① 获得当前请求的controller和action
        $nowac = CONTROLLER_NAME."-".ACTION_NAME;
        //② 获得当前用户对应的角色权限
        $adminid = session('admin_id');
        $manager_info = D('Manager')->find($adminid);
        $role_id = $manager_info['mg_role_id'];
        $role_info = D('Role')->find($role_id);
        $auth_ac = $role_info['role_auth_ac'];
        
        //--------------------------------------------------------------------//
        //禁止未登陆系统用户访问后台
        $ac = "Manager-login,Manager-verifyImg";//未登陆系统也允许访问的操作
        if(empty($adminid) && strpos($ac,$nowac)===false){
            $url = U('Manager/login');
            $js = <<<eof
                 <script type="text/javascript">
                    window.top.location.href="$url";
                 </script>
eof;
            echo $js;
            //$this -> redirect('Manager/login');
        }
        //--------------------------------------------------------------------//
        
        //A.判断用户当前请求的controller和action是否在其权限列表中出现
        //B.不要限制admin用户
        //C.允许开放一些不加限制的权限
        //(Manager-login,Manager-verifyImg,Index-index,Index-head,Index-left,Index-right,Manager-logout)
        $allowac = "Manager-login,Manager-verifyImg,Index-index,Index-head,Index-left,Index-right,Manager-logout";
        
        $adminname = session('admin_user');
        if(strpos($auth_ac,$nowac)===false && $adminname!=='admin' && strpos($allowac,$nowac)===false){
            exit('没有权限访问');
        }
    }
}
