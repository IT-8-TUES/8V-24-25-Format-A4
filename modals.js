function openWarningModal() {
    const warningModal = document.getElementById('warningModal');
    warningModal.style.display = 'flex';
    let opacity = 0;
    warningModal.style.opacity = opacity;

    const fadeIn = setInterval(() => {
        if (opacity < 1) {
            opacity += 0.02;
            warningModal.style.opacity = opacity;
        } else {
            clearInterval(fadeIn);
        }
    }, 10);
}

function closeWarningModal() {
    const warningModal = document.getElementById('warningModal');
    let opacity = 1;

    const fadeOut = setInterval(() => {
        if (opacity > 0) {
            opacity -= 0.02;
            warningModal.style.opacity = opacity;
        } else {
            clearInterval(fadeOut);
            warningModal.style.display = 'none';
        }
    }, 10);
}