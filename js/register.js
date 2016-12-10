/**
 * Created by lenovo on 2016/6/20.
 */
window.onload = function(){
    code();
    var faceimg = document.getElementById('faceimg');
    faceimg.onclick = function(){
        window.open('face.php', 'face', 'width=400,height=400,top=0,left=0');
    };
    var fm = document.getElementsByTagName('form')[0];
    fm.onsubmit = function(){
        if(fm.username.value.length < 2 || fm.username.value.length > 20){
            alert('用户名不得小于2位或者大于20位');
            fm.user.value = '';
            fm.user.focus();
            return false;
        }
        if(/[<>\'\"\ ]/.test(fm.username.value)){
            alert('用户名不得包含<>、空格、单引号及双引号');
            fm.user.value = '';
            fm.user.focus();
            return false;
        }
        if(fm.password.value.length < 6){
            alert('密码不得小于6位!');
            fm.password.value = '';
            fm.password.focus();
            return false;
        }
        if(fm.checkpassword.value != fm.password.value){
            alert('密码确认和密码不一致');
            fm.checkpassword.value = '';
            fm.checkpassword.focus();
            return false;
        }
        if(fm.hint.value.length < 2){
            alert('密码提示不得小于2位');
            fm.hint.value = '';
            fm.hint.focus();
            return false;
        }
        if(fm.answer.value == fm.hint.value){
            alert('密码提示与密码回答不得一致');
            fm.answer.value = '';
            fm.answer.focus();
            return false;
        }
        if(fm.answer.value.length < 2){
            alert('密码提示不得小于2位');
            fm.answer.value = '';
            fm.answer.focus();
            return false;
        }
        if(/[\w\-\.]+@[\w\-\.]+(\.\w+)$/.test(fm.email.value)){
            alert('电子邮件格式错误');
            fm.email.value = '';
            fm.email.focus();
            return false;
        }
        if(/[1-9]{1}[\d]{4,9}$/.test(fm.qq.value)){
            alert('qq格式错误');
            fm.qq.value = '';
            fm.qq.focus();
            return false;
        }
        if(/https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/.test(fm.url.value)){
            alert('网址格式不正确');
            fm.url.focus();
            return false;
        }
        if(fm.url.value.length > 30){
            alert('网址长度过长');
            fm.url.focus();
            return false;
        }
        if(fm.code.value.length != 4){
            alert('验证码必须是4位');
            fm.code.value = '';
            fm.code.focus();
            return false;
        }
        return true;
    }
};