<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/11
 * Time: 21:15
 */
if(!defined('IN_TG')){
    exit('Access Defined!');
}
mysqli_close($_conn);
?>
<div id="footer">
    <p>本程序执行耗时为：<?php echo round(_runtime()- START_TIME,4)?>秒</p>
    <p>版权所有 翻版必究</p>
    <p>本程序由<a>瓢城Web俱乐部</a>提供 源代码可以任意修改或发布（c）yc60.com</p>
</div>
