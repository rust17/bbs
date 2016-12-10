<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/12
 * Time: 20:29
 */
session_start();
define('IN_TG',true);
define('SCRIPT','register');
require dirname(__FILE__).'/includes/common.inc.php';
if(@$_GET['action'] == 'register'){
    _check_code($_POST['code'],$_SESSION['code']);
    require dirname(__FILE__).'/includes/register.func.php';
    $_clean = array();
    $_clean['uniqid'] = _check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
    $_clean['active'] = _shal_uniqid();
    $_clean['username'] = _check_username($_POST['user'],20,2);
    $_clean['password'] = _check_pass($_POST['password'],6,$_POST['checkpassword']);
    $_clean['pass_hint'] = _check_pass_hint($_POST['hint'],2);
    $_clean['pass_answer'] = _check_hint_answer($_POST['hint'],$_POST['answer'],2);
    $_clean['sex'] = _check_sex($_POST['sex']);
    $_clean['face'] = _check_face($_POST['face']);
    $_clean['email'] = _check_email($_POST['email'],2,30);
    $_clean['qq'] = _check_qq($_POST['qq']);
    $_clean['url'] = _check_url($_POST['url'],30);

    $_query = _query("SELECT tg_username FROM tg_user1 WHERE tg_username='{$_clean['username']}'");
    if(_fetch_array($_query)){
        _alert_back('对不起，此用户已注册！');
    }
    _query("INSERT INTO tg_user1(
                                                  tg_uniqid,
                                                  tg_active,
                                                  tg_username,
                                                  tg_password,
                                                  tg_hint,
                                                  tg_answer,
                                                  tg_email,
                                                  tg_qq,
                                                  tg_url,
                                                  tg_sex,
                                                  tg_face,
                                                  tg_reg_time,
                                                  tg_last_time,
                                                  tg_last_ip)
                                    VALUES      (
                                                  '{$_clean['uniqid']}',
                                                  '{$_clean['active']}',
                                                  '{$_clean['username']}',
                                                  '{$_clean['password']}',
                                                  '{$_clean['pass_hint']}',
                                                  '{$_clean['pass_answer']}',
                                                  '{$_clean['email']}',
                                                  '{$_clean['qq']}',
                                                  '{$_clean['url']}',
                                                  '{$_clean['sex']}',
                                                  '{$_clean['face']}',
                                                  NOW(),
                                                  NOW(),
                                                  '{$_SERVER["REMOVE_ADDR"]}')
                                                  ");
    _mysql_close();
    _location('恭喜你，注册成功','active.php?active='.$_clean['active']);
}else{
    $_SESSION['uniqid'] = $_uniqid = _shal_uniqid();
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
    <title>多用户留言系统——注册</title>
    <?php
        require ROOT_PATH.'/includes/title.inc.php';
    ?>
</head>
<body>
<?php
    require ROOT_PATH.'/includes/header.inc.php';
?>
<div id="register">
    <h2>注册会员</h2>
    <form method="post" name="register" action="register.php?action=register">
        <input type="hidden" name="uniqid" value="<?php echo $_uniqid?>">
        <dl>
        <dt>请认真填写以下内容</dt>
        <dd>用 户 名：<input type="text" name="user" class="text"/>(*必填，至少两位)</dd>
        <dd>密&nbsp&nbsp码：<input type="password" name="password" class="text"/>(*必填，至少六位)</dd>
        <dd>密码确认：<input type="password" name="checkpassword" class="text"/>&nbsp(*必填，同上)&nbsp</dd>
        <dd>密码提示：<input type="text" name="hint" class="text"/>(*必填，至少两位)</dd>
        <dd>密码回答：<input type="text" name="answer" class="text"/>(*必填，至少两位)</dd>
        <dd>性&nbsp&nbsp别：<input type="radio" name="sex" checked="checked" value="男" id="sex"/>男<input type="radio" name="sex" value="女" id="sex">女</dd>
        <dd class="face"><input type="hidden" name="face" value="face/m01.gif"><img src="face/m01.gif" alt="m01.gif" id="faceimg" /></dd>
        <dd>电子邮件：<input type="text" name="email" class="text"/></dd>
        <dd> Q&nbspQ&nbsp&nbsp：<input type="text" name="qq" class="text"/></dd>
        <dd>主页地址：<input type="text" name="url" class="text" value="http://"/></dd>
        <dd>验 证 码：<input type="text" name="code" class="text code"/><img src="code.php" id="code"></dd>
        <dd><input type="submit" value="注册" class="submit"/></dd>
        </dl>
    </form>
</div>

<?php
require ROOT_PATH.'/includes/footer.inc.php';
?>
</body>
</html>
