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
if($_POST['action'] == 'member_modify'){
    _check_code($_POST['code'],$_SESSION['code']);
    require ROOT_PATH.'/includes/check.func.php';
    $_query = _query("SELECT
                            tg_username,
                            tg_password,
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
}
if(isset($_COOKIE['username'])) {
    $_query = _query("SELECT
                            tg_username,
                            tg_password,
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
    $_html['password'] = $_rows['tg_password'];
    $_html['sex'] = $_rows['tg_sex'];
    $_html['face'] = $_rows['tg_sex'];
    $_html['email'] = $_rows['tg_email'];
    $_html['url'] = $_rows['tg_url'];
    $_html['qq'] = $_rows['tg_qq'];
    $_html = _html($_html);

    if ($_html['sex'] == '男') {
        $_html['sex'] = '<input type="radio" value="男" name="sex" checked="checked" /> 男 <input type="radio" value="女" name="sex" /> 女';
    } elseif ($_html['sex'] == '女') {
        $_html['sex'] = '<input type="radio" value="男" name="sex" /> 男 <input type="radio" value="女" name="sex" checked="checked" /> 女';
    }

    $_html['face'] = '<select>';
    foreach (range(1, 9) as $_num ) {
        $_html['face'] .= '<option>face/m0'.$_num.'.gif</option>';
    }
    foreach (range(10, 64) as $_num ) {
        $_html['face'] .= '<option>face/m'.$_num.'.gif</option>';
    }
    $_html['face'] .='</select>';

}else{
    _alert_back('非法登录');
}
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>多用户留言系统——个人中心</title>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/member_modify.js"></script>
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
        <form method="post" action="?action=member_modify">
            <dl>
                <dd>用 户 名：<?php echo $_html['username']?></dd>
                <dd>密&nbsp&nbsp码：<input type="text" name="password" class="text">(留空则不修改密码)</dd>
                <dd>性&nbsp&nbsp别：<?php echo $_html['sex']?></dd>
                <dd>头&nbsp&nbsp像：<?php echo $_html['face']?></dd>
                <dd>电子邮件：<input type="text" name="email" value="<?php echo $_html['email']?>" class="text" /></dd>
                <dd>主&nbsp&nbsp页：<input type="text" name="url" value="<?php echo $_html['url']?>" class="text"/></dd>
                <dd>Q &nbsp&nbsp Q：<input type="text" name="qq" value="<?php echo $_html['qq']?>" class="text"/></dd>
                <dd>验 证 码：<input type="text" name="code" class="code" /><img src="code.php" id="code" /></dd>
                <dd><input type="submit" value="修改资料" class="buttom"/></dd>
            </dl>
        </form>
    </div>
</div>
<?php
require ROOT_PATH.'/includes/footer.inc.php';
?>
</body>
</html>
