/**
 @param {string} color
*/
function colorChange(color) {
    console.log('Changing car color to:', color);

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
        } else {
            console.warn('Car part not found!');
        }
    });

    localStorage.setItem('carColor', color);
    console.log('Color saved to localStorage:', color);
}

function loadCarColor() {
    const savedColor = localStorage.getItem('carColor');
    
    if (savedColor) {
        setTimeout(() => {
            colorChange(savedColor);
        }, 200);
    } 
}

document.addEventListener('DOMContentLoaded', () => {
    loadCarColor();
});

window.colorChange = colorChange;
window.loadCarColor = loadCarColor;

