<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/20
 * Time: 21:31
 */

session_start();
define('IN_TG',true);
define('SCRIPT','login');
require dirname(__FILE__).'/includes/common.inc.php';
if(@$_GET['action'] == 'login'){
    _check_code($_POST['code'],$_SESSION['code']);
    require ROOT_PATH.'/includes/login.func.php';
    $_clean = array();
    $_clean['username'] = _check_username($_POST['username'],2,20);
    $_clean['password'] =_check_pass($_POST['password'],6);
    $_clean['keeptime'] = _check_time($_POST['keeptime']);
    $_query = _query("SELECT
                                    tg_username,
                                    tg_uniqid
                        FROM
                                    tg_user1
                        WHERE
                                    tg_username='{$_clean['username']}'
                        AND
                                    tg_password='{$_clean['password']}'
                        AND
                                    tg_active=''
                         LIMIT 1");
    if(!!$_rows = _fetch_array($_query)){
        _mysql_close();
        _set_cookies($_rows['tg_username'],$_rows['tg_uniqid'],$_clean['keeptime']);
        _location('欢迎您'.$_rows['tg_username'],'index.php');
    }else{
        _mysql_close();
        session_destroy();
        _location('用户名不存在或者该用户未被激活','login.php');
    }
}
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
    <title>多用户留言系统——登录</title>
    <?php
        require dirname(__FILE__).'/includes/title.inc.php';
    ?>
</head>
<body>
<?php
    require ROOT_PATH.'/includes/header.inc.php';
?>
<div id="login">
    <h2>登录</h2>
    <form method="post" name="login" action="login.php?action=login">
        <dl>
            <dt></dt>
            <dd>用 户 名：<input type="text" name="username" class="text"></dd>
            <dd>密&nbsp&nbsp码：<input type="password" name="password" class="text"></dd>
            <dd>保&nbsp&nbsp留：<input type="radio" name="keeptime" value="0" checked="checked" class="radio"/>不保留<input type="radio" name="keeptime" value="1" class="radio"/>一天<input type="radio" name="keeptime" value="2" class="radio"/>一周<input type="radio" name="keeptime" value="3" class="radio"/>一月</dd>
            <dd>验 证 码：<input type="text" name="code" class="text code"><img src="code.php" id="code"/></dd>
            <dd>
                <input type="submit" name="submit" value="登录" class="bottom"/>
                <input type="submit" name="buttom" value="注册" class="bottom">
            </dd>
        </dl>
    </form>
</div>
<?php
    require ROOT_PATH.'/includes/footer.inc.php';
?>
</body>
</html>