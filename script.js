console.log("GODIVA 活動頁啟動!");
console.log("GODIVA HELLO!");

const banner = document.getElementById("banner");
const images = [
    "images/banner01.jpg",
    "images/banner02.jpg",
    "images/banner03.png"
];

let index = 0;
setInterval(() => {
   index = (index + 1)%images.length;
   banner.style.opacity = 0;
    setTimeout(() => {
        banner.src = images[index];
        banner.style.opacity = 1; 
    }, 900);
}, 5000);

