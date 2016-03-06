<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>
        <script type='text/javascript' src='<?php echo (ADMIN_JS_URL); ?>jquery-1.4.4.js'></script>
        <link href="<?php echo (ADMIN_CSS_URL); ?>mine.css" type="text/css" rel="stylesheet" />
        <script type='text/javascript'>
            $(function(){
//                $('tr:gt(0)').mouseover(function(){
//                    $(this).css('background-color','lightgray');
//                });
//                $('tr:gt(0)').mouseout(function(){
//                    $(this).css('background-color','');
//                });
                //hover()集成mouseover和mouseout
                //$().hover(f1,f2);
                $('tr:gt(0):not(:last)').hover(
                    function(){
                        $(this).css('background-color','lightblue');
                    },
                    function(){
                        $(this).css('background-color','');
                    }
                );
                
            });
        </script>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="/shop/index.php/Admin/Goods/tianjia">【添加商品】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td><td>商品名称</td><td>库存</td><td>价格</td>
                        <td>图片</td><td>缩略图</td><td>品牌</td><td>创建时间</td>
                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="product1">
                        <td><?php echo ($i); ?></td>
                        <td><a href="#"><?php echo ($v['goods_name']); ?></a></td>
                        <td><?php echo ($v['goods_number']); ?></td>
                        <td><?php echo ($v['goods_price']); ?></td>
                        <td><img src="/shop/<?php echo ($v['goods_big_img']); ?>" height="60" width="60"></td>
                        <td><img src="/shop/<?php echo ($v['goods_small_img']); ?>" height="40" width="40"></td>
                        <td><?php echo ($v['goods_brand_id']); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$v['goods_create_time'])); ?></td>
                        <td><a href="/shop/index.php/Admin/Goods/upd">修改</a></td>
                        <td><a href="javascript:;" onclick="delete_product(1)">删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            <?php echo ($page_list); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>