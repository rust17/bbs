<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/19
 * Time: 16:29
 */

if(!defined('IN_TG')){
    exit('Access Defined!');
}

function _connect(){
    global $_conn;
    $_conn = mysqli_connect(DB_HOST,DB_USER,DB_PWD);
    if(!$_conn){
        _alert_back('数据库连接错误！');
    }
}

function _select_db(){
    global $_conn;
    if(!mysqli_select_db($_conn,DB_NAME)){
        _alert_back('指定的数据库不存在!');
    }
}

function _set_names(){
    global $_conn;
    if(!mysqli_query($_conn,'SET NAMES UTF8')){
        _alert_back('字符集错误！');
    }
}

function _query($_sql){
    global $_conn;
    $_result = mysqli_query($_conn,$_sql);
    if(!$_result){
        _alert_back('SQL执行错误！');
    }
    return $_result;
}

function _fetch_array($_result){
    return mysqli_fetch_array($_result,MYSQLI_ASSOC);
}

function _num_rows($_result){
    return mysql_num_rows($_result);
}

function _mysql_close(){
    global $_conn;
    if(!mysqli_close($_conn)){
        _alert_back('SQL关闭异常！');
    }
}

function _affected_rows(){
    global $_conn;
    return mysqli_affected_rows($_conn);
}