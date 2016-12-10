<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/20
 * Time: 21:31
 */
if(!defined('IN_TG')){
    exit('Access Defined');
}
if(!function_exists('_alert_back')){
    exit('function _alert_back doesn\'t exit');
}
function _set_cookies($_username,$_uniqid,$_time){
    switch($_time) {
        case 0:
            setcookie('username', $_username);
            setcookie('uniqid', $_uniqid);
            break;
        case 1:
            setcookie('username', $_username, time() + 86400);
            setcookie('uniqid', $_uniqid, time() + 86400);
            break;
        case 2:
            setcookie('username', $_username, time() + 604800);
            setcookie('uniqid', $_uniqid, time() + 604800);
            break;
        case 3:
            setcookie('username', $_username, time() + 2592000);
            setcookie('uniqid', $_uniqid, time() + 2592000);
            break;
    }
}
function _check_username($_string,$_min_num,$_max_num){
    $_string = trim($_string);
    if(mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num){
        _alert_back('用户名不得小于位'.$_min_num.'或者大于'.$_max_num.'位');
    }
    $_pattern = '/<>\'\"\ /';
    if(preg_match($_pattern,$_string)){
        _alert_back('用户名不得包含<>、单引号和双引号');
    }
    $_mg_string[0] = '习近平';
    $_mg_string[1] = '温家宝';
    $_mg_string[3] = '胡锦涛';

    foreach($_mg_string as $_value){
        @$_mg .= '['.$_value.']'.'\n';
    }
    if(preg_match($_mg,$_string)){
        _alert_back('用户名不得包含'.$_mg);
    }
    return $_string;
}
function _check_pass($_string,$_min_num){
    if(strlen($_string) < $_min_num){
        _alert_back('密码不得小于'.$_min_num.'位');
    }
    return sha1($_string);
}

function _check_time($_string){
    $_time = array('0','1','2','3');
    if(!in_array($_string,$_time)){
        _alert_back('保留信息出错');
    }
    return $_string;
}