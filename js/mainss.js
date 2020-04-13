var video1 = document.getElementById('video1');
var video2 = document.getElementById('video2');

video1.onended = function (){
    video2.play();
    video1.style.opacity=0;
    video2.style.opacity=1;


}