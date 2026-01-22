/* =========================
   NAVEGACIÓN DE SECCIONES
   ========================= */
function mostrar(id, btn) {
    document.querySelectorAll('.seccion').forEach(s => s.style.display = 'none');
    document.querySelectorAll('.botones button').forEach(b => b.classList.remove('activo'));

    const seccion = document.getElementById(id);
    if (seccion) seccion.style.display = 'block';
    if (btn) btn.classList.add('activo');
}

/* =========================
   LIGHTBOX
========================= */
function abrir(src) {
    document.getElementById('lightbox').style.display = 'flex';
    document.getElementById('imgLight').src = src;
}

function cerrar() {
    document.getElementById('lightbox').style.display = 'none';
}

/* =========================
   CONTADORES
========================= */
document.querySelectorAll('[data-num]').forEach(el => {
    let fin = +el.dataset.num;
    let act = 0;

    const intervalo = setInterval(() => {
        act++;
        el.textContent = act;
        if (act >= fin) clearInterval(intervalo);
    }, 30);
});

/* =========================
   GALERÍA - VER MÁS
========================= */
let contadorImagen = 4;

function verMas() {
    const galeria = document.getElementById('galeria');
    if (!galeria) return;

    for (let i = 0; i < 6; i++) {
        galeria.innerHTML += `
            <div class="card">
                <img src="img/e${contadorImagen}.jpeg" onclick="abrir(this.src)">
                <p>Nueva evidencia de impacto social</p>
            </div>
        `;
        contadorImagen++;
    }
}

/* =========================
   BOTÓN CONOCER MÁS (FUNCIONAL)
========================= */
function mostrarConocenos() {

    // Ocultar todas las secciones principales
    document.querySelectorAll('.seccion').forEach(sec => {
        sec.style.display = "none";
    });

    // Mostrar Misión como inicio del bloque informativo
    const mision = document.getElementById("mision");
    if (mision) mision.style.display = "block";

    // Quitar activo a todos los botones principales
    document.querySelectorAll('.botones button').forEach(btn => {
        btn.classList.remove("activo");
    });

    // Activar visualmente el botón Conocer Más
    event.target.classList.add("activo");

    // Scroll suave hacia el contenido
    document.querySelector(".contenido").scrollIntoView({
        behavior: "smooth"
    });
}
/* =========================
   FORMULARIO DONACIÓN
========================= */
const form = document.getElementById('formDonacion');
const btnDonar = document.getElementById('btnDonar');
const modal = document.getElementById('modalConfirmacion');

const nombreInput = document.getElementById('nombre');
const correoInput = document.getElementById('correo');
const montoInput = document.getElementById('monto');

function setMonto(valor) {
    montoInput.value = valor;
    validar();
}

function validar() {
    const nombre = nombreInput.value.trim();
    const correo = correoInput.value.trim();
    const monto = montoInput.value.trim();
    const metodo = document.querySelector('input[name="metodo"]:checked');

    btnDonar.disabled = !(nombre && correo && monto && metodo);
}

[nombreInput, correoInput, montoInput].forEach(input =>
    input.addEventListener('input', validar)
);

document.querySelectorAll('input[name="metodo"]').forEach(radio =>
    radio.addEventListener('change', validar)
);

if (form) {
    form.addEventListener('submit', e => {
        e.preventDefault();

        document.getElementById('resNombre').textContent = nombreInput.value;
        document.getElementById('resCorreo').textContent = correoInput.value;
        document.getElementById('resMonto').textContent = montoInput.value;
        document.getElementById('resMetodo').textContent =
            document.querySelector('input[name="metodo"]:checked').value.toUpperCase();

        modal.style.display = 'flex';
    });
}

function cerrarModal() {
    modal.style.display = 'none';
}

/* =========================
   HERO - IMÁGENES ALEATORIAS
========================= */
const imagenesHero = [
    "img/e1.jpeg",
    "img/e2.jpeg",
    "img/e3.jpeg",
    "img/e4.jpeg",
    "img/e5.jpeg",
    "img/e6.jpeg"
].sort(() => Math.random() - 0.5);

const heroContenedor = document.getElementById("heroFotos");

if (heroContenedor) {
    imagenesHero.forEach(src => {
        const img = document.createElement("img");
        img.src = src;
        heroContenedor.appendChild(img);
    });
}

/* =========================
   FRASES FLOTANTES
========================= */
const frases = document.querySelectorAll(".hero-frases .frase");
let indiceFrase = 0;

if (frases.length > 0) {
    frases[indiceFrase].classList.add("activa");

    setInterval(() => {
        frases[indiceFrase].classList.remove("activa");
        indiceFrase = (indiceFrase + 1) % frases.length;
        frases[indiceFrase].classList.add("activa");
    }, 6000);
}

/* =========================
   ANIMACIONES SCROLL
========================= */
const elementos = document.querySelectorAll('.seccion, .card, .contador');

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.15 });

elementos.forEach(el => {
    el.style.opacity = 0;
    el.style.transform = 'translateY(40px)';
    el.style.transition = '1s';
    observer.observe(el);
});

/* =========================
   W O M P I
========================= */

function seleccionarMonto(valor) {
    montoSeleccionado = valor;

    // Quitar activo a todos
    document.querySelectorAll('.montos-pro button')
        .forEach(b => b.classList.remove('activo'));

    // Activar el botón seleccionado
    event.target.classList.add('activo');
}

function irADonar() {
    const linkBase = "https://checkout.wompi.co/l/test_VPOS_1GVlws";
    window.location.href = `${linkBase}?amount-in-cents=${montoSeleccionado}00`;
}

function mostrarInterno(id, boton) {

    // Ocultar todos los bloques
    document.querySelectorAll('.bloque-conocer').forEach(div => {
        div.classList.remove('activo');
    });

    // Mostrar el seleccionado
    document.getElementById(id).classList.add('activo');

    // Quitar activo de todos los botones
    document.querySelectorAll('.botones-internos button').forEach(btn => {
        btn.classList.remove('activo');
    });

    // Activar el botón actual
    boton.classList.add('activo');
}

/* =========================
   FRASES ROTATIVAS DONAR (FIX REAL)
========================= */

document.addEventListener("DOMContentLoaded", () => {

    const frasesDonar = document.querySelectorAll(".frases-pro .frase");
    let indiceDonar = 0;

    if (frasesDonar.length > 0) {

        // Mostrar la primera
        frasesDonar[indiceDonar].classList.add("activa");

        setInterval(() => {
            frasesDonar[indiceDonar].classList.remove("activa");
            indiceDonar = (indiceDonar + 1) % frasesDonar.length;
            frasesDonar[indiceDonar].classList.add("activa");
        }, 4500);
    }

});




