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

function saveScore() {
    window.location.href = "home.php?msg=" + encodeURIComponent(currentScore);
}

setInterval(score, 10);

if (!window.gameState) {
    window.gameState = {
        isPaused: function() {
            return document.getElementById('overlay').style.display === 'block';
        }
    };
}