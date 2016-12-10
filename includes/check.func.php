<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/29
 * Time: 21:42
 */
if(!defined('IN_TG')){
    exit('Access Defined!');
}
if(!function_exists('alert_bck')){
    exit('function _alert_back doesn\'t exit!');
}
function _check_password($_string,$_min_num){
    if(strlen($_string) < $_min_num){
        _alert_back('密码不得小于'.$_min_num.'位');
    }
    return sha1($_string);
}
function _check_email($_email,$_min_num,$_max_num){
    if(empty($_email)){
        return null;
    }else{
        $_pattern = '/[\w\-\.]+@[\w\-\.]+(\.\w+)$/';
        if(!preg_match($_pattern,$_email)){
            _alert_back('邮件格式不正确！');
        }
        if(strlen($_email) < $_min_num || strlen($_email) > $_max_num){
            _alert_back('邮件不得小于'.$_min_num.'位或者大于'.$_max_num.'位');
        }
        return $_email;
    }
}
function _check_url(){

}
function _check_qq(){

}