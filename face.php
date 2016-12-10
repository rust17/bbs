<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/13
 * Time: 21:01
 */
define('IN_TG',true);
define('SCRIPT','face');
require dirname(__FILE__).'/includes/common.inc.php';
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>多用户留言系统——头像选择</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <?php
    require ROOT_PATH.'/includes/title.inc.php';
    ?>
    <script type="text/javascript" src="js/opener.js"></script>
</head>
<body>
<div id="face">
    <h2>头像选择</h2>
    <dl>
        <?php foreach(range(1,9) as $_num){?>
        <dd><img src="face/m0<?php echo $_num?>.gif" alt="face/m0<?php echo $_num?>.gif" title="头像<?php echo $_num?>"></dd>
        <?php }?>
    </dl>
    <dl>
        <?php foreach(range(10,64) as $_num){?>
        <dd><img src="face/m<?php echo $_num?>.gif" alt="face/m<?php echo $_num?>.gif" title="头像<?php echo $_num?>"></dd>
        <?php }?>
    </dl>
</div>
</body>
</html>
