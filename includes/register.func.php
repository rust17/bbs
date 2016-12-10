<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/18
 * Time: 9:28
 */
if(!defined('IN_TG')){
    exit('Access Defined!');
}
if(!function_exists('_alert_back')){
    exit('function _alert_back() doesn\'t exit!');
}

function _check_username($_string,$_max_num,$_min_num){
    $_string = trim($_string);

    if(mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num){
        _alert_back('用户名长度不得小于'.$_min_num.'位或者大于'.$_max_num.'位!');
    }

    $_pattern = '/[<>\'\"\ \　]/';
    if(preg_match($_pattern,$_string)){
        _alert_back('用户名不得包含<>、单引号、双引号和空格!');
    }

    $_mg_string[0] = '习近平';
    $_mg_string[1] = '温家宝';
    $_mg_string[2] = '胡锦涛';

    foreach($_mg_string as $_value){
        @$_mg .= '['.$_value.']'.'\n';
    }
    if(in_array($_string,$_mg_string)){
        _alert_back('用户名不能包含'.$_mg);
    }

    return $_string;
}

function _check_pass($_password,$_min_num,$_check_password){
    if(strlen($_password) < $_min_num){
        _alert_back('密码不得小于'.$_min_num.'位！');
    }

    if($_password != $_check_password){
        _alert_back('密码和密码确认不一致！');
    }
    return sha1($_password);
}

function _check_pass_hint($_pass_hint,$_min_num){
    if(mb_strlen($_pass_hint,'utf-8') < $_min_num){
        _alert_back('密码提示不得小于'.$_min_num.'位');
    }
    return $_pass_hint;
}

function _check_hint_answer($_pass_hint,$_pass_answer,$_min_num){
    if(mb_strlen($_pass_answer,'utf-8') < $_min_num){
        _alert_back('密码回答不得小于'.$_min_num.'位');
    }
    if($_pass_answer == $_pass_hint){
        _alert_back('密码提示与密码回答不得一致！');
    }
    return $_pass_answer;
}

function _check_sex($_sex){
    return $_sex;
}

function _check_face($_face){
    return $_face;
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

function _check_qq($_qq){
    if(empty($_qq)){
        return null;
    }else{
        $_pattern = '/[1-9]{1}[\d]{4,9}$/';
        if(!preg_match($_pattern,$_qq)){
            _alert_back('qq格式不正确！');
        }
        return $_qq;
    }
}

function _check_uniqid($_first_uniqid,$_second_uniqid){
    if($_first_uniqid!=$_second_uniqid){
        _alert_back('唯一标识符异常！');
    }
    return $_first_uniqid;
}

function _check_url($_url,$_max_num){
    if(empty($_url) || $_url == 'http://'){
        return null;
    }else{
        $_pattern = '/https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/';
        if(!preg_match($_pattern,$_url)){
            _alert_back('网址格式不正确！');
        }
        if(strlen($_url) > $_max_num){
            _alert_back('网址长度过长！');
        }
        return $_url;
    }
}