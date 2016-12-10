<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/11
 * Time: 21:09
 */
if(!defined('IN_TG')){
    exit('Access Defined!');
}
?>
<div id="header">
    <h1><a href="index.php">多用户留言系统</a></h1>
<ul>
    <li><a href="index.php">首页</a></li>
    <?php
    if(isset($_COOKIE['username'])){
        echo '<li>您好!<strong style="color: red;">' .$_COOKIE['username']. '</strong><a href="member.php">·个人中心<a/></li>';
    }else {
        echo '<li ><a href = "register.php" > 注册</a ></li >';

        echo '<li ><a href = "login.php" > 登录</a ></li >';
    }
    ?>
    <li><a href="blog.php">博友</a></li>
    <li>风格</li>
    <li>管理</li>
    <li><?php
        if(isset($_COOKIE['username'])) {
            echo '<a href="logout.php">退出</a>';
        }
        ?></li>
</ul>
</div>