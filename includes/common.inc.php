<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/11
 * Time: 21:51
 */
if(!defined('IN_TG')){
    exit('Access Defined!');
}
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));
if(PHP_VERSION < '4.0.1'){
    exit('PHP Version is too low!');
}
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'/includes/mysql.func.php';
define('START_TIME',_runtime());
header("Content-Type: text/html; charset=UTF-8");
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','');
define('DB_NAME','testguest1');

_connect();
_select_db();
_set_names();
?>
