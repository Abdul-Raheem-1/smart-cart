let pos = {left: 0, x: 0};
let carousel_main = document.querySelector('#prd_carousel_main_wrapper');

const mouseDownHandler = e=>{
    pos = {
        left: carousel_main.scrollLeft, 
        x: e.clientX
    };
    carousel_main.style.cursor = 'grabbing';
    document.addEventListener('mousemove', mouseMoveHandler);
    document.addEventListener('mouseup', mouseUpHandler);
}

const mouseMoveHandler = e=>{
    const dx = e.clientX - pos.x;
    carousel_main.scrollLeft = pos.left - dx;
}

const mouseUpHandler = ()=>{
    document.removeEventListener('mousemove', mouseMoveHandler);
    document.removeEventListener('mouseup', mouseUpHandler);
    carousel_main.style.cursor = 'grab';
}

carousel_main.addEventListener('mousedown', mouseDownHandler);