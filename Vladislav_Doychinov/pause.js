const pauseBtn = document.getElementById('pauseBtn');
const modal1 = document.getElementById('modal1');
const resetBtn = document.getElementById('resetBtn');
const modal2 = document.getElementById('modal2');
const resumeBtn = document.querySelector('.resumeBtn');
const cancelBtn = document.querySelector('.cancelbtn');

let isPaused = false;

pauseBtn.addEventListener('click', pause);
resumeBtn.addEventListener('click', resume);
resetBtn.addEventListener('click', () => {
    modal2.style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
});
cancelBtn.addEventListener('click', () => {
    modal2.style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
});

function pause() {
    document.getElementById('overlay').style.display = 'block';
    isPaused = true;
    
    document.querySelectorAll('*').forEach(element => {
        if (window.getComputedStyle(element).animationName !== 'none') {
            element.style.animationPlayState = 'paused';
        }
    }); 
}

function resume() {
    isPaused = false;
    document.getElementById('overlay').style.display = 'none';
    modal1.style.display = 'none';
    
    document.querySelectorAll('*').forEach(element => {
        if (window.getComputedStyle(element).animationName !== 'none') {
            element.style.animationPlayState = 'running';
        }
    });
}

window.gameState = {
    isPaused: () => isPaused
};