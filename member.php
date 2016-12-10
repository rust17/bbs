<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/26
 * Time: 15:35
 */
session_start();
define('IN_TG',true);
define('SCRIPT',member);
require dirname(__FILE__).'/includes/common.inc.php';
if(isset($_COOKIE['username'])) {
    $_query = _query("SELECT
                            tg_username,
                            tg_sex,
                            tg_face,
                            tg_email,
                            tg_url,
                            tg_qq,
                            tg_reg_time
                  FROM
                            tg_user1
                  WHERE
                            tg_username='{$_COOKIE['username']}'
                  LIMIT
                            1");
    $_rows = _fetch_array($_query);
    $_html['username'] = $_rows['tg_username'];
    $_html['sex'] = $_rows['tg_sex'];
    $_html['face'] = $_rows['tg_face'];
    $_html['email'] = $_rows['tg_email'];
    $_html['url'] = $_rows['tg_url'];
    $_html['qq'] = $_rows['tg_qq'];
    $_html['reg_time'] = $_rows['tg_reg_time'];
    $_html = _html($_html);
}
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>多用户留言系统——个人中心</title>
    <?php
        require ROOT_PATH.'/includes/title.inc.php';
    ?>
</head>
<body>

    <?php
        require ROOT_PATH.'/includes/header.inc.php';
    ?>
<div id="member">
    <div id="member_sidebar">
        <h2>中心导航</h2>
        <dl>
            <dt>账号管理</dt>
            <dd><a href="member.php">个人信息</a></dd>
            <dd><a href="member_modify.php">修改资料</a></dd>
        </dl>
        <dl>
            <dt>其他管理</dt>
            <dd><a href="message.php">短信查阅</a></dd>
            <dd><a href="friends.php">好友设置</a></dd>
            <dd><a href="flowers.php">查询花朵</a></dd>
            <dd><a href="images.php">个人相册</a></dd>
        </dl>
    </div>
    <div id="member_main">
        <h2>会员管理中心</h2>
        <form method="post">
            <dl>
                <dd>用 户 名：<?php echo $_html['username']?></dd>
                <dd>性&nbsp&nbsp别：<?php echo $_html['sex']?></dd>
                <dd>头&nbsp&nbsp像：<?php echo $_html['face']?></dd>
                <dd>电子邮件：<?php echo $_html['email']?></dd>
                <dd>主&nbsp&nbsp页：<?php echo $_html['url']?></dd>
                <dd>Q &nbsp&nbsp Q：<?php echo $_html['qq']?></dd>
                <dd>注册时间：<?php echo $_html['reg_time']?></dd>
                <dd>身&nbsp&nbsp份：普通会员</dd>
            </dl>
        </form>
    </div>
</div>
    <?php
        require ROOT_PATH.'/includes/footer.inc.php';
    ?>
</body>
</html>
