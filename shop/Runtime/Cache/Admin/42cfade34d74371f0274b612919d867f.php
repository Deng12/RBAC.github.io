<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>给角色分配权限</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link href="<?php echo (ADMIN_CSS_URL); ?>mine.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：角色管理-》分配权限信息【<?php echo ($role_info['role_name']); ?>】</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/shop/index.php/Admin/Role/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action='/shop/index.php/Admin/Role/distribute/role_id/100' method='post'>
                <table cellspacing='1' id="list-table">
                    <?php if(is_array($auth_infoA)): $i = 0; $__LIST__ = $auth_infoA;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                        <td width="25%" valign="top" class="first-cell" style='border-bottom:2px solid gray; font-weight:bold;'>
                            <input type="checkbox" name="auth_id[]" value="<?php echo ($v['auth_id']); ?>" class="checkbox"
                                   <?php if(in_array($v['auth_id'],$authidsarr)): ?>checked='checked'<?php endif; ?>
                                   /><?php echo ($v['auth_name']); ?></td>
                        <td width='75%' style='border-bottom:2px solid gray;'>
                            <?php if(is_array($auth_infoB)): $i = 0; $__LIST__ = $auth_infoB;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i; if($vv['auth_pid'] == $v['auth_id']): ?><div style="width:200px;float:left;">
                                <input type="checkbox" name="auth_id[]" value="<?php echo ($vv['auth_id']); ?>" 
                                       <?php if(in_array($vv['auth_id'],$authidsarr)): ?>checked='checked'<?php endif; ?>
                                       /><?php echo ($vv['auth_name']); ?>
                            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
                <input type='submit' value='分配权限' />
            </form>
        </div>
    </body>
</html>