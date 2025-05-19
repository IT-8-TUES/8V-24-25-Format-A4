let currentScore = 0;

function score() {
    if (window.gameState && window.gameState.isPaused()) {
        return;
    }
    
    let scoreElement = document.getElementById("score");
    if (scoreElement) {
        currentScore += 1;
        scoreElement.innerHTML = currentScore;
    }
}

setInterval(score, 10);

if (!window.gameState) {
    window.gameState = {
        isPaused: function() {
            return document.getElementById('overlay').style.display === 'block';
        }
    };
}

let count = 0;

document.addEventListener('DOMContentLoaded', function() {

  function collect(cube) {
    cube.style.display = 'none';
    count += 1;
  }
  
  function checkCollision() {
      const frontBumper = document.getElementById('frontBumper');
      const cubes = document.querySelectorAll('.container');
      
      if (!frontBumper || cubes.length === 0) {
          return;
        }
        
        const frontBumperRect = frontBumper.getBoundingClientRect();
        
        cubes.forEach(cube => {
            const cubeRect = cube.getBoundingClientRect();
            
            const overlap = !(
                frontBumperRect.bottom < cubeRect.top ||
                frontBumperRect.top > cubeRect.bottom ||
                frontBumperRect.right < cubeRect.left ||
                frontBumperRect.left > cubeRect.right
            );
            
      if (overlap) {
          console.log("COLLISION DETECTED!");
          collect(cube);
        }
    });
}

setInterval(checkCollision, 50);
});

function saveCollect() {
    window.location.href = "home.php?collect=" + count + "&score=" + currentScore;
}