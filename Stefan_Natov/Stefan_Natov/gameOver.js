document.addEventListener('DOMContentLoaded', function() {
    let isGameRunning = true;
    let gameLoopId = null;

    function gameOver() {
      console.log('Game Over!');
      isGameRunning = false;
    
      if (gameLoopId) {
        clearInterval(gameLoopId);
      }
      
      const obstacles = document.querySelectorAll('.obstacle-container');
      obstacles.forEach(obstacle => {
        if (obstacle.style.animation) {
          obstacle.style.animationPlayState = 'paused';
        }
      });

      pause();
      
      document.getElementById('gameOverModal').style.display = 'block';
    }
    
    window.gameOver = gameOver;
    
    function checkCollision() {
      if (!isGameRunning) return;
      
      const frontBumper = document.getElementById('frontBumper');
      const obstacles = document.querySelectorAll('.obstacle-container');
      
      if (!frontBumper || obstacles.length === 0) {
        return;
      }
      
      const frontBumperRect = frontBumper.getBoundingClientRect();
      
      obstacles.forEach(obstacle => {
        const obsRect = obstacle.getBoundingClientRect();
        
        const overlap = !(
          frontBumperRect.bottom < obsRect.top ||
          frontBumperRect.top > obsRect.bottom ||
          frontBumperRect.right < obsRect.left ||
          frontBumperRect.left > obsRect.right
        );
        
        if (overlap) {
          console.log("COLLISION DETECTED!");
          gameOver();
        }
      });
    }
    
    gameLoopId = setInterval(checkCollision, 50);
    console.log('Collision detection started');
});