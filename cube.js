let cubeInterval;

function cube() {
    if (window.gameState && window.gameState.isPaused()) {
        return;
    }
    
    const container = document.createElement('div');
    container.className = 'container';
    container.style.position = 'absolute';
    container.style.left = Math.random() * (window.innerWidth - 20) + "px";
    container.style.top = '50%';

    const cube = document.createElement('div');
    cube.className = 'cube';

    const faces = ['top', 'bottom', 'left', 'right', 'front', 'back'];

    faces.forEach(face => {
        const faceDiv = document.createElement('div');
        faceDiv.className = `face ${face}`;
        cube.appendChild(faceDiv);
    });

    container.appendChild(cube);
    document.body.appendChild(container);
}

setTimeout(() => {
    cubeInterval = setInterval(cube, 5000);
}, 5000);