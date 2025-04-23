function spawnObstacle() {
    if (window.gameState && window.gameState.isPaused()) return;

    const laneCount = 5;
    const laneWidth = window.innerWidth / laneCount;
    const lane = Math.floor(Math.random() * laneCount);

    const container = document.createElement('div');
    container.className = 'obstacle-container';
    container.style.position = 'absolute';
    container.style.left = `${lane * laneWidth + laneWidth / 4}px`;
    container.style.top = `50%`;
    container.style.transform = `scale(0.2)`;
    container.style.transition = 'transform 0.03s linear';
    container.style.zIndex = '20';

    const cube = document.createElement('div');
    cube.className = 'obstacle-cube';

    const faceNames = ['top1', 'bottom1', 'left1', 'right1', 'front1', 'back1'];
    faceNames.forEach((faceName) => {
        const face = document.createElement('div');
        face.className = `face1 ${faceName}`;
        cube.appendChild(face);
    });

    container.appendChild(cube);
    document.body.appendChild(container);

    let y = 50;
    const interval = setInterval(() => {
        if (window.gameState && window.gameState.isPaused()) return;

        y += 0.1;
        const scale = Math.min(1.5, 0.2 + ((y - 50) / 70) * 1.3);
        container.style.top = `${y}%`;
        container.style.transform = `scale(${scale})`;

        if (y >= 120) {
            clearInterval(interval);
            container.remove();
        }
    }, 30);
}

setInterval(spawnObstacle, 1000);
