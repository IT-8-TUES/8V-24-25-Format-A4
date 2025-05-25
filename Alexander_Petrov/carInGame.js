const car = document.getElementById('side');
let left = 0;
let calibration = 0;
let angleY = 90;

window.onkeydown = function (event) {
    if (event.key === 'ArrowRight') {
        angleY = 90 + calibration - 15;
        left += 1;
        calibration -= 1;
    } else if (event.key === 'ArrowLeft') {
        angleY = 90 + calibration + 15;
        left -= 1;
        calibration += 1;
    }

    car.style.left = left + 'vw';
    car.style.transform = `rotateY(${angleY}deg)`;
};

window.onkeyup = function () {
    angleY = 90 + calibration;
    car.style.transform = `rotateY(${angleY}deg)`;
};
