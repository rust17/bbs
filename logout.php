<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/23
 * Time: 21:53
 */
session_start();
define('IN_TG',true);
define('SCRIPT','logout');
require dirname(__FILE__).'/includes/common.inc.php';
_unset_cookies();
?>