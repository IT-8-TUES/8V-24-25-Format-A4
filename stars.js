const sun = document.querySelector('.sun');

const intervalFunction = setInterval(() => {
    const sunTop = sun.getBoundingClientRect().top;
    console.log('Sun Top Position:', sunTop);

    if (sunTop < -400 || sunTop > 400) {
        stars(sun);
    }
}, 100);

function stars(sun) {
    const sunTop = sun.getBoundingClientRect().top;
    
    if (sunTop < 400) {
        clearInterval(intervalFunction);
        return;
    }
    
    const element = document.createElement("div");
    element.classList.add("stars");
    element.style.position = "absolute";
    element.style.left = Math.random() * (window.innerWidth - 50) + "px";
    
    let position = Math.random() * -50;
    let opacity = 1;
    element.style.top = position + "px";
    element.style.opacity = opacity;
    
    document.body.appendChild(element);

    if (sunTop > 400) {

        const fadeStart = sunTop - 400;
        
        const interval = setInterval(() => {
            position += 0.3;
            element.style.top = position + "px";
            
            if (position > fadeStart) {
                opacity = Math.max(0, opacity - 0.01);
                element.style.opacity = opacity;
            }
            
            if (position > sunTop || opacity <= 0) {
                clearInterval(interval);
                element.remove();
            }
        }, 20);
    }    
}
