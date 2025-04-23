function score() {
    if (window.gameState && window.gameState.isPaused()) {
        return;
    }
    
    let scoreElement = document.getElementById("score");
    let currentScore = parseInt(scoreElement.innerHTML) || 0;
    currentScore += 1;
    scoreElement.innerHTML = currentScore;
}

setInterval(score, 10);