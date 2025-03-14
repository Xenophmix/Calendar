// const clock = function () {
//     let getDate = new Date();
//     document.getElementById("clock").innerHTML = getDate.toLocaleTimeString(
//         'en-US',
//         { hour: "2-digit", minute: "2-digit", second: "2-digit" }
//     );
// };
// setInterval(function () {
//     clock();
// }, 1000);


// 取得時、分、秒 寫入
const clock = function(){
    NowDate=new Date();
    h=NowDate.getHours();
    m=NowDate.getMinutes();
    s=NowDate.getSeconds();
    document.getElementById('clock').innerHTML = h+'點'+m+'分'+s+'秒';
    
}

window.onload = clock;
// 1000毫秒更新一次 記得寫外面
setInterval(function(){
    clock();
}, 1000);

