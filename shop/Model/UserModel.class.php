<?php

namespace Model;
use Think\Model;

//用户model模型类
class UserModel extends Model{
    
    // 是否批处理验证
    protected $patchValidate    =   true;
    
    //表单验证规则指定
    //// 自动验证定义
    protected $_validate        =   array(
        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        //① 用户名验证-必须填写、名字唯一
        array('username','require','用户名必须填写'),
        array('username','','请换一个用户名',0,'unique'),
        //② 密码验证-必须填写
        array('password','require','密码必须填写'),
        array('password','5,10','密码位数必须5-10之间',0,'length'),
        
        //③ 确认密码-与密码保持一致
        array('password2','require','确认密码必须填写'),
        array('password2','password','两次密码必须一致',0,'confirm'),
        
        //④ 邮箱验证
        array('user_email','email','邮箱格式不正确',2),//值不为空验证

        //⑤ qq验证
        array('user_qq','number','qq号码必须是数字内容',1), //必须验证
        array('user_qq','5,12','qq号码位数5到12之间',0,'length'),
        
        //⑥ 手机号码验证
        array('user_tel','/^13\d{9}$/','手机号码格式不正确'),

        //⑦ 验证学历-必须选择一个
        //array('user_xueli','2,3,4,5','学历必须选择一个',0,'in'),
        array('user_xueli','1','学历必须选择一个',0,'notin'),
        
        //⑧ 验证爱好-不能少于两个项目
        array('user_hobby','check_hobby','爱好不能少于两个项目',0,'callback'),
    );
    //验证爱好的方法
    //params:$arg代表被验证项目的信息值
    function check_hobby($arg){
        if(count($arg)<2){
            return false;
        }
        return true;
    }
    
    //自动完成
    // 自动完成定义
    protected $_auto            =   array(
        //array(完成字段1,完成规则,[完成条件,附加规则]),
        array('user_time','time',1,'function'),  //user_time在新增用户的时候通过time()函数给填充起来
        array('password','md5',1,'function'),//对用户的密码进行md5加密
        array('last_time','time',2,'function'),//用户信息修改的是自动完成last_time字段的填充
    );  
    
    
    //制作方法实现用户名 和 密码的校验
    //返回值：
    //成功--->当前用户的信息记录
    //失败--->返回false
    function checkNamePwd($name,$pwd){
        //①首先验证名字
        $info = $this ->where("username='$name'")-> find();
        if($info!==null){
            //②其次再验证密码
            if($info['password']===$pwd){
                return $info;
            }
        }
        return false;
    }
}
