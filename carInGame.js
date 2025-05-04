const car = document.getElementById('side');
let left = 50;
let angleY = 90;

window.onkeydown = function (event) {
    if (event.key === 'ArrowRight') {
        angleY = 80;
        left += 3;
    } else if (event.key === 'ArrowLeft') {
        angleY = 100;
        left -= 3;
    }

    car.style.left = left + '%';
    car.style.transform = `rotateY(${angleY}deg) rotateZ(-0deg)`;
};

window.onkeyup = function () {
    angleY = 90;
    car.style.transform = `rotateY(${angleY}deg)`;
};