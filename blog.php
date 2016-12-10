<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/23
 * Time: 22:14
 */
define('IN_TG',true);
define('SCRIPT','blog');
require dirname(__FILE__).'/includes/common.inc.php';
global $_pagesize,$_offset;
_page("SELECT tg_id FROM tg_user1",10);
$_sql = "SELECT
                            tg_username,
                            tg_sex,
                            tg_face
                    FROM
                            tg_user1
                  ORDER BY
                             tg_reg_time DESC
                LIMIT $_offset,$_pagesize";
$_result = _query($_sql);
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>多用户留言系统——博友</title>
    <?php
        require ROOT_PATH.'/includes/title.inc.php';
    ?>
</head>
<body>
    <?php
        require ROOT_PATH.'/includes/header.inc.php';
    ?>
<div id="blog">
    <h2>博友列表</h2>
    <?php while(!!$_rows = _fetch_array($_result)){
    ?>
    <dl>
        <dd class="username"><?php echo $_rows['tg_username']?>（<?php echo $_rows['tg_sex']?>）</dd>
        <dt><img src="<?php echo $_rows['tg_face']?>"></dt>
        <dd class="message"><img src="images/x1.gif">发信息</dd>
        <dd class="friends"><img src="images/x2.gif">加为好友</dd>
        <dd class="note"><img src="images/x3.gif">写留言</dd>
        <dd class="flower"><img src="images/x4.gif">给Ta送花</dd>
    </dl>
    <?php } ?>
    <?php _paging('blog.php',1) ?>

</div>
    <?php
        require ROOT_PATH.'/includes/footer.inc.php';
    ?>
</body>
</html>
