/**
 * Created by lenovo on 2016/6/14.
 */
function code(){
    var code = document.getElementById('code');
    code.onclick = function(){
        this.src = 'code.php?tm='+Math.random();
    }
};