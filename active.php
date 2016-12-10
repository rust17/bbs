<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/19
 * Time: 17:58
 */
define('IN_TG',true);
define('SCRIPT','active');
require dirname(__FILE__).'/includes/common.inc.php';
if(!isset($_GET['active'])){
    _alert_back('非法操作');
}
if(isset($_GET['action']) && isset($_GET['active']) && $_GET['action']=='ok'){
    $_active = $_GET['active'];
    $_query =_query("SELECT
                              tg_active
                      FROM
                              tg_user1
                      WHERE
                              tg_active='{$_active}'
                      LIMIT
                                  1");
    if(_fetch_array($_query)){
        _query("UPDATE
                              tg_user1
                  SET
                              tg_active=NULL
                  WHERE
                              tg_active='{$_active}'
                  LIMIT
                                1");
        if(_affected_rows() == 1){
            _mysql_close();
            _location('用户激活成功','login.php');
        }else{
            _mysql_close();
            _location('用户激活失败','register.php');
        }
    }else{
        _alert_back('非法操作！');
    }
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>多用户留言系统——激活</title>
    <?php
        require ROOT_PATH.'/includes/title.inc.php';
    ?>
</head>
<body>
    <?php
        require ROOT_PATH.'/includes/header.inc.php';
    ?>
    <div id="active">
        <h2>激活账户</h2>
        <p>请点击以下超链接以激活您的账户</p>
        <p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']?>?action=ok&amp;active=<?php echo $_GET['active'] ?></a></p>
    </div>
    <?php
        require ROOT_PATH.'/includes/footer.inc.php';
    ?>
</body>
</html>
