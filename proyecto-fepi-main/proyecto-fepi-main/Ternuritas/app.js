const img = document.getElementById('carousel');
const rightBtn = document.getElementById('right-btn');
const leftBtn = document.getElementById('left-btn');

// Images are from unsplash
let pictures = ['./img/munieco_mu   .jpg','./img/header-2.jpg','./img/header-3.jpg','./img/header-4.jpg'];

img.src = pictures[0];
let position = 0;

const moveRight = () => {
    if (position >= pictures.length - 1) {
        position = 0
        img.src = pictures[position];
    } else {
        img.src = pictures[position + 1];
        position++;
    }

    updateButtonVisibility();
}

const moveLeft = () => {
    if (position < 1) {
        position = pictures.length - 1;
        img.src = pictures[position];
    } else {
        img.src = pictures[position - 1];
        position--;
    }

    updateButtonVisibility();
}

const updateButtonVisibility = () => {
    // Ocultar el botón derecho si estás en el último elemento
    rightBtn.style.display = position >= pictures.length - 1 ? 'none' : 'block';

    // Ocultar el botón izquierdo si estás en el primer elemento
    leftBtn.style.display = position <= 0 ? 'none' : 'block';
}

rightBtn.addEventListener("click", moveRight);
leftBtn.addEventListener("click", moveLeft);

// Inicializar la visibilidad de los botones
updateButtonVisibility();

// Inicial de usuario
const letter = document.getElementById("usuario")
const nombre = "Arturo".toUpperCase()
const inicial = nombre[0]
letter.textContent = inicial