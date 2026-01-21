<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Fundación Casa de Dios – Fuente de Agua Viva</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --pri: #1f6aa5;
            --sec: #0d3c61;
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Poppins, sans-serif;
            background: linear-gradient(135deg, #e8eef5, #d6e2f1);
            padding: 30px 15px;
        }

        /* ===== HERO ===== */
        .hero {
            background: linear-gradient(135deg, var(--pri), var(--sec));
            color: #fff;
            padding: 60px 20px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .3);
            margin-bottom: 50px;
        }

        .hero img {
            max-width: 140px;
            margin-bottom: 15px;
        }

        .hero h1 {
            margin: 10px 0
        }

        .hero p {
            max-width: 700px;
            margin: auto;
            font-size: 16px
        }

        /* ===== BOTONES ===== */
        .botones {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin: 40px 0;
        }

        .botones button {
            padding: 14px 28px;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            background: #fff;
            color: var(--sec);
            cursor: pointer;
            transition: .3s;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        .botones button:hover {
            background: var(--pri);
            color: #fff;
            transform: translateY(-3px);
        }

        .botones button.activo {
            background: linear-gradient(135deg, var(--pri), var(--sec));
            color: #fff;
        }

        /* ===== CONTENIDO ===== */
        .contenido {
            max-width: 1150px;
            margin: auto
        }

        .seccion {
            display: none;
            background: rgba(255, 255, 255, .9);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .25);
            animation: fade .6s;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(40px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .seccion h2 {
            color: var(--pri);
            border-left: 6px solid var(--pri);
            padding-left: 15px;
            margin-bottom: 25px;
        }

        /* ===== CONTADORES ===== */
        .contadores {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .contador {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .2);
        }

        .contador span {
            font-size: 42px;
            font-weight: 700;
            color: var(--pri);
        }

        /* ===== GALERÍA ===== */
        .galeria {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .galeria img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            border-radius: 18px;
            cursor: pointer;
            transition: .3s;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .3);
        }

        .galeria img:hover {
            transform: scale(1.05)
        }

        /* ===== VIDEO ===== */
        .video {
            position: relative;
            padding-top: 56.25%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .3);
            margin-bottom: 40px;
        }

        .video iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* ===== TIMELINE ===== */
        .timeline {
            border-left: 4px solid var(--pri);
            padding-left: 25px;
        }

        .evento {
            margin-bottom: 25px;
        }

        .evento h4 {
            margin: 0;
            color: var(--pri);
        }

        /* ===== VALORES ===== */
        .valores {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 25px;
        }

        .valor {
            background: #fff;
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .2);
        }

        .valor h4 {
            color: var(--pri)
        }

        /* ===== LIGHTBOX ===== */
        .lightbox {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .85);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 20px;
        }

        /* ===== WHATSAPP ===== */
        .whatsapp {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            color: #fff;
            padding: 15px 18px;
            border-radius: 50%;
            font-size: 24px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .4);
            text-decoration: none;
            z-index: 999;
        }
    </style>
</head>

<body>

    <!-- HERO -->
    <div class="hero">
        <img src="logo.png">
        <h1>Fundación Casa de Dios</h1>
        <p>Transformando vidas con amor, fe y acción social</p>
    </div>

    <!-- BOTONES -->
    <div class="botones">
        <button class="activo" onclick="mostrar('inicio',this)">Inicio</button>
        <button onclick="mostrar('mision',this)">Misión</button>
        <button onclick="mostrar('vision',this)">Visión</button>
        <button onclick="mostrar('proyectos',this)">Proyectos</button>
        <button onclick="mostrar('valores',this)">Valores</button>
    </div>

    <div class="contenido">

        <!-- INICIO -->
        <div id="inicio" class="seccion" style="display:block">
            <h2>Nuestro Impacto</h2>

            <div class="contadores">
                <div class="contador"><span data-num="350">0</span>
                    <p>Niños beneficiados</p>
                </div>
                <div class="contador"><span data-num="25">0</span>
                    <p>Proyectos</p>
                </div>
                <div class="contador"><span data-num="10">0</span>
                    <p>Años de servicio</p>
                </div>
            </div>

            <h2>Video Institucional</h2>
            <div class="video">
                <iframe src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe>
            </div>

            <h2>Evidencias</h2>
            <div class="galeria">
                <img src="e1.jpg" onclick="abrir(this.src)">
                <img src="e2.jpg" onclick="abrir(this.src)">
                <img src="e3.jpg" onclick="abrir(this.src)">
                <img src="e4.jpg" onclick="abrir(this.src)">
            </div>
        </div>

        <!-- MISIÓN -->
        <div id="mision" class="seccion">
            <h2>Misión</h2>
            <p>Promover el desarrollo integral de niños, jóvenes y familias mediante principios cristianos y programas sociales.</p>
        </div>

        <!-- VISIÓN -->
        <div id="vision" class="seccion">
            <h2>Visión</h2>
            <p>Ser una fundación referente en transformación social y espiritual a nivel regional.</p>
        </div>

        <!-- PROYECTOS -->
        <div id="proyectos" class="seccion">
            <h2>Línea de Tiempo</h2>
            <div class="timeline">
                <div class="evento">
                    <h4>2016</h4>
                    <p>Inicio del comedor comunitario</p>
                </div>
                <div class="evento">
                    <h4>2019</h4>
                    <p>Programa educativo infantil</p>
                </div>
                <div class="evento">
                    <h4>2023</h4>
                    <p>Expansión comunitaria</p>
                </div>
            </div>
        </div>

        <!-- VALORES -->
        <div id="valores" class="seccion">
            <h2>Valores</h2>
            <div class="valores">
                <div class="valor">
                    <h4>Compromiso</h4>
                    <p>Servicio constante</p>
                </div>
                <div class="valor">
                    <h4>Transparencia</h4>
                    <p>Honestidad</p>
                </div>
                <div class="valor">
                    <h4>Humanidad</h4>
                    <p>Amor al prójimo</p>
                </div>
            </div>
        </div>

    </div>

    <!-- LIGHTBOX -->
    <div class="lightbox" id="lightbox" onclick="cerrar()">
        <img id="imgLight">
    </div>

    <!-- WHATSAPP -->
    <a href="https://wa.me/573000000000" class="whatsapp">💬</a>

    <script>
        function mostrar(id, btn) {
            document.querySelectorAll('.seccion').forEach(s => s.style.display = 'none');
            document.querySelectorAll('.botones button').forEach(b => b.classList.remove('activo'));
            document.getElementById(id).style.display = 'block';
            btn.classList.add('activo');
        }

        function abrir(src) {
            document.getElementById('lightbox').style.display = 'flex';
            document.getElementById('imgLight').src = src;
        }

        function cerrar() {
            document.getElementById('lightbox').style.display = 'none';
        }

        document.querySelectorAll('[data-num]').forEach(el => {
            let fin = +el.dataset.num,
                act = 0;
            let int = setInterval(() => {
                act++;
                el.textContent = act;
                if (act >= fin) clearInterval(int);
            }, 30);
        });
    </script>

</body>

</html>