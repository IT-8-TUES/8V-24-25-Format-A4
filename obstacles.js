function obstacle() {
    const element = document.createElement("div");
    element.classList.add("obstacle");
    element.style.left = Math.random() * (window.innerWidth - 50) + "px";
    document.body.appendChild(element);
    let position = 50;

    const interval = setInterval(() => {
        position += 0.1;

        element.style.top = position + "%";

        if (position >= 100) {
            clearInterval(interval);
            element.remove();
        }
    }, 20);
}

setTimeout(() => {
    setInterval(obstacle, 2000);
}, 5000);