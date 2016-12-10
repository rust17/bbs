/**
 * Created by lenovo on 2016/6/14.
 */
window.onload = function() {
    var img = document.getElementsByTagName('img');
    for(i=0;i<img.length;i++){
        img[i].onclick = function(){
            _opener(this.alt);
        }
    }
};
function _opener(src){
    var faceimg =opener.document.getElementById('faceimg');
    faceimg.src = src;
    opener.document.register.face.value = src;
}