<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        
        //通过redis获得最新登录系统用户信息
        //$url = "http://192.168.42.130/listlogin.php";
        //$logininfo = file_get_contents($url);
        //var_dump(json_decode($logininfo));
        //调用模板
        
        $this -> assign('logininfo',json_decode($logininfo));
        $this -> display();  //View/Index/index.html
        //$this -> display('hello');  //View/Index/hello.html
        //$this -> display('User/hello');  //View/User/hello.html
    }
}
