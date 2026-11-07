const sinMovimiento = window.matchMedia('(prefers-reduced-motion: reduce)');

// Al cambiar el monto, solo se mueven las cifras que cambian.
function pintarMonto(salida, texto) {
    const anterior = salida.textContent;

    salida.setAttribute('aria-label', texto);
    salida.replaceChildren(
        ...[...texto].map((caracter, indice) => {
            const cifra = document.createElement('span');
            cifra.textContent = caracter;
            cifra.setAttribute('aria-hidden', 'true');

            if (!sinMovimiento.matches && anterior[indice] !== caracter) {
                cifra.animate(
                    [
                        { transform: 'translateY(55%)', opacity: 0 },
                        { transform: 'translateY(0)', opacity: 1 },
                    ],
                    { duration: 200, delay: indice * 18, easing: 'cubic-bezier(0.23, 1, 0.32, 1)', fill: 'backwards' },
                );
            }

            return cifra;
        }),
    );
}

document.querySelectorAll('[data-donar]').forEach((formulario) => {
    const salida = formulario.querySelector('[data-monto]');

    formulario.addEventListener('change', ({ target }) => {
        if (target.matches('input[name="monto"]')) {
            pintarMonto(salida, target.dataset.pesos);
        }
    });
});

const botonMenu = document.querySelector('[data-menu]');
const menu = document.getElementById('menu');

function alternarMenu(abierto) {
    botonMenu.setAttribute('aria-expanded', String(abierto));
    menu.toggleAttribute('data-abierto', abierto);
}

botonMenu.addEventListener('click', () => {
    alternarMenu(botonMenu.getAttribute('aria-expanded') !== 'true');
});

menu.addEventListener('click', ({ target }) => {
    if (target.closest('a')) {
        alternarMenu(false);
    }
});

document.addEventListener('keydown', ({ key }) => {
    if (key === 'Escape') {
        alternarMenu(false);
    }
});

// La barra de donar del celular aparece siempre que ningún botón de donar esté a la vista.
const barra = document.querySelector('[data-barra]');
const botonesVisibles = new Set();

const observador = new IntersectionObserver((entradas) => {
    entradas.forEach(({ target, isIntersecting }) => {
        if (isIntersecting) {
            botonesVisibles.add(target);
        } else {
            botonesVisibles.delete(target);
        }
    });

    barra.toggleAttribute('data-visible', botonesVisibles.size === 0);
});

document.querySelectorAll('.donar .boton, .portada .boton').forEach((boton) => observador.observe(boton));

// Visor de fotos: amplía cualquier foto de la página y permite recorrerlas.
const visor = document.querySelector('[data-visor]');
const fotos = [...document.querySelectorAll('[data-foto]')];
const visorImagen = visor.querySelector('img');
const visorContador = visor.querySelector('[data-contador]');
let actual = 0;

function mostrarFoto(indice) {
    actual = (indice + fotos.length) % fotos.length;
    visorImagen.src = fotos[actual].href;
    visorImagen.alt = fotos[actual].querySelector('img').alt;
    visorContador.textContent = `${actual + 1} de ${fotos.length}`;
}

fotos.forEach((foto, indice) => {
    foto.addEventListener('click', (evento) => {
        evento.preventDefault();
        mostrarFoto(indice);
        visor.showModal();
    });
});

visor.addEventListener('click', ({ target }) => {
    if (target === visor || target.closest('[data-cerrar]')) {
        visor.close();
    } else if (target.closest('[data-anterior]')) {
        mostrarFoto(actual - 1);
    } else if (target.closest('[data-siguiente]')) {
        mostrarFoto(actual + 1);
    }
});

visor.addEventListener('keydown', ({ key }) => {
    if (key === 'ArrowLeft') {
        mostrarFoto(actual - 1);
    } else if (key === 'ArrowRight') {
        mostrarFoto(actual + 1);
    }
});
