<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/12
 * Time: 7:14
 */
function _runtime(){
    $mtime = explode(' ', microtime());
    return $mtime[1] + $mtime[0];
}
function _location($_info,$_url){
    echo "<script type='text/javascript'>alert('".$_info."');location.href='$_url';</script>";
    exit;
}

function _page($_sql,$_size){
    global $_pages,$_page,$_pagesize,$_offset,$_num;
    $_pagesize = $_size;
    $_query = _query($_sql);
    $_num = $_query->num_rows;
    $_pages = ceil($_num/$_pagesize);
    if(isset($_GET['page'])){
        $_page = $_GET['page'];
    }else{
        $_page = 1;
    }
    $_offset = ($_page-1) * $_pagesize;
}

function _paging($_url,$_style){
    global $_pages,$_page,$_num;
    if($_style == 1) {
        echo '<div id="page_num">';
        echo '<ul>';
        for ($_i = 0; $_i < $_pages; $_i++) {
            if ($_page == $_i + 1) {
                echo '<li class="selected"><a href="' . $_url . '?page=' . ($_i + 1) . '">' . ($_i + 1) . '</a></li>';
            } else {
                echo '<li><a href="' . $_url . '?page=' . ($_i + 1) . '">' . ($_i + 1) . '</a></li>';
            }
        }
        echo '</ul>';
        echo '</div>';
    }elseif($_style == 2){
        echo  '<div id="page_text">';
        echo  '<ul>';
        echo     '<li>'.$_page.'/'.$_pages.'页 |</li>';
        echo    '<li>共有<strong>'.$_num.'</strong>个会员 |</li>';
        if($_page == 1) {
            echo '<li>首页 |</li>';
            echo '<li>上一页 |</li>';
        }else{
            echo '<li><a href="'.$_url.'?page=1">首页 |</a></li>';
            echo '<li><a href="'.$_url.'?page='.($_page-1).'">上一页 |</a></li>';
        }
        if($_page == $_pages) {
            echo '<li>下一页 |</li>';
            echo '<li>尾页</li>';
        }else{
            echo '<li><a href="'.$_url.'?page='.($_page+1).'">下一页 |</a></li>';
            echo '<li><a href="'.$_url.'?page='.$_pages.'">尾页</a></li>';
        }
        echo    '</ul>';
        echo    '</div>';
    }
}

function _html($_string){
    if(is_array($_string)){
        foreach ($_string as $_key => $_value) {
            $_string[$_key] = _html($_value);
        }
    }else{
        return htmlspecialchars($_string);
    }
    return $_string;
}

function _unset_cookies(){
    setcookie('username','',time()-1);
    setcookie('uniqid','',time()-1);
    session_destroy();
    _location('退出成功','index.php');
}
function _shal_uniqid(){
    return sha1(uniqid(rand(),true));
}
function _check_code($_first_code,$_second_code){
    if($_first_code != $_second_code){
        _alert_back('验证码错误！');
    }
}
function _alert_back($_info){
    echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
    exit;
}
function _code(){
    $_rand_code = 4;

    for($_i=0;$_i<$_rand_code;$_i++){
        @$_rand .= dechex(mt_rand(0,15));
    }

    $_SESSION['code'] = $_rand;

    $_width = 75;
    $_height = 25;

    $_img = imagecreatetruecolor($_width,$_height);

    $_white = imagecolorallocate($_img,255,255,255);

    imagefill($_img,0,0,$_white);

    $_flag = false;
    if($_flag) {
        $_black = imagecolorallocate($_img, 0, 0, 0);
        imagerectangle($_img, 0, 0, $_width - 1, $_height - 1, $_black);
    }

    for($_i=0;$_i<6;$_i++){
        $_rand_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rand_color);
    }

    for($_i=0;$_i<100;$_i++){
        $_rand_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagestring($_img,1,mt_rand(0,$_width),mt_rand(0,$_height),'*',$_rand_color);
    }

    for($_i=0;$_i<strlen($_SESSION['code']);$_i++){
        $_rand_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
        imagestring($_img,5,$_i*$_width/4+mt_rand(0,10),mt_rand(1,$_height/2),$_SESSION['code'][$_i],$_rand_color);
    }

    header('Content-Type:image/png');
    imagepng($_img);

    imagedestroy($_img);
}
?>