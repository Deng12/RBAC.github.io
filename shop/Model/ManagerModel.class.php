<?php

namespace Model;
use Think\Model;

//后台model模型类
class ManagerModel extends Model{
    
    //制作方法实现用户名 和 密码的校验
    //返回值：
    //成功--->当前用户的信息记录
    //失败--->返回false
    function checkNamePwd($name,$pwd){
        //①首先验证名字
        $info = $this ->where("mg_name='$name'")-> find();
        if($info!==null){
            //②其次再验证密码
            if($info['mg_pwd']===$pwd){
                return $info;
            }
        }
        return false;
    }
}
