const box = document.getElementById('rainy');
let boxHeight = box.clientHeight;
let boxWidth = box.clientWidth;
// 頁面大小改變時 改變大小
window.onresize = function () {
  boxHeight = box.clientHeight;
  boxWidth = box.clientWidth;
}
// 隔一段時間增加雨滴
setInterval(() => {
  const rain = document.createElement('div');
  rain.classList.add('rain');
  rain.style.top = 0;
  // 雨點位置隨機
  rain.style.left = Math.random()*boxWidth+'px';
  // 雨點加上透明度(隨機)
  rain.style.opacity = Math.random();
  box.appendChild(rain);
  // 隔一段時間 雨水落下
  let race = 1;
  const timer = setInterval(() => {
    if(parseInt(rain.style.top)>boxHeight){
      clearInterval(timer);
      box.removeChild(rain);
    }
    race++;
    // 下面兩個數字 前面的表示雨落下時間 後面每幾豪秒產生雨滴
    rain.style.top = parseInt(rain.style.top) + race + 'px'
  }, 20)
}, 200)

