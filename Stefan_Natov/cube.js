let cubeInterval;

function cube() {
    if (window.gameState && window.gameState.isPaused()) return;

    const laneCount = 5;
    const laneWidth = window.innerWidth / laneCount;
    const lane = Math.floor(Math.random() * laneCount);

    const container = document.createElement('div');
    container.className = 'container';
    container.style.position = 'absolute';
    container.style.left = `${lane * laneWidth + laneWidth / 4}px`;
    container.style.top = '50%';
    container.style.zIndex = '5';
    container.style.opacity = '0'; 
    container.style.transform = 'scale(0.2)'; 
    container.style.transition = 'opacity 0.5s ease';

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
    
 
    void container.offsetWidth;
    container.style.opacity = '1';

    let y = 50; 
    let rotation = 0;
    const interval = setInterval(() => {
        if (window.gameState && window.gameState.isPaused()) return;

        y += 0.1;

        const scale = Math.min(1.5, 0.2 + ((y - 50) / 70) * 1.3);
        container.style.top = `${y}%`;
        container.style.transform = `scale(${scale})`;

        rotation += 10;
        cube.style.transform = `rotateY(${rotation}deg)`;

        if (y >= 120) {
            clearInterval(interval);
            container.remove();
        }
    }, 30);
}

setTimeout(() => {
    cubeInterval = setInterval(cube, 2000);
}, 5000);