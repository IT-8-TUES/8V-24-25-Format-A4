const car = document.getElementById('side');
let angleX = 0;
let angleY = 0;

window.onkeydown = function (event) {
    if (event.key === 'ArrowRight') {
        angleY += 10;
    } else if (event.key === 'ArrowLeft') {
        angleY -= 10;
    } else if (event.key === 'ArrowUp') {
        angleX += 10;
    } else if (event.key === 'ArrowDown') {
        angleX -= 10;
    }

    car.style.transform = `rotateY(${angleY}deg) rotateX(${angleX}deg)`;
};

function colorChange(color) {
    const carParts = [
        document.getElementById('front'),
        document.getElementById('back'),
        document.getElementById('left'),
        document.getElementById('top'),
        document.getElementById('bottom'),
        document.getElementById('frontBumper'),
        document.getElementById('leftFender'),
        document.getElementById('rightFender'),
        document.getElementById('hood')
    ];

    carParts.forEach(part => {
        if (part) {
            part.style.backgroundColor = color;
        }
    });
}