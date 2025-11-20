<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FutbolClub/assets/css/home.css">
    <title>Futbol Club | Pagina Principal</title>
</head>
<body>
    <header class="index-header">
        <div class="logo">
            <img src="/FutbolClub/assets/img/club-brand.png" alt="">
        </div>
        <ul>
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#categorias">Categorias</a></li>
            <li><a href="/FutbolClub/login">Mi Cuenta</a></li>
        </ul>
    </header>
    <main>
        <div class="slider-container" id="inicio">
            <div class="slide active">
                <img src="/FutbolClub/assets/img/1.jpg" alt="Descripción foto 1">
            </div>
            <div class="slide">
                <img src="/FutbolClub/assets/img/2.jpg" alt="Descripción foto 2">
            </div>
            <div class="slide">
                <img src="/FutbolClub/assets/img/3.jpg" alt="Descripción foto 3">
            </div>

            <div class="bienvenida">
                <h1>Bienvenidos a la Pagina Oficial</h1>
                <p>Del Club de Futbol</p>
                <h1>AGUA DULCE</h1>
                <img src="/FutbolClub/assets/img/club-brand.png" alt="">
            </div>
        </div>
        <div class="nosotros" id="nosotros">
            <h3>Futbol Club "Agua Dulce" Barinitas</h3>
            <h5>Sobre Nosotros</h5>
            <div class="nosotros-container">
                <img src="/FutbolClub/assets/img/nosotros.jpg" alt="">
                <p>
                    <br><br>
                    El Club Agua Dulce nace de la pasión comunitaria por el deporte. Nuestra misión es simple: utilizar el fútbol como una herramienta poderosa para el desarrollo integral de niños y jóvenes. Nos enfocamos en la excelencia deportiva, la formación de carácter y la promoción de un estilo de vida saludable.
                </p>
            </div>
        </div>
        <div class="categorias-container" id="categorias">
            <h2>Nuestras Categorías de Formación</h2>
            <p class="subtitulo">Conoce a los equipos, periodos de nacimiento y a sus entrenadores a cargo.</p>
            
            <div class="cards-grid">
                <?php foreach ($this->categoria as $cate):?>
                <div class="categoria-card sub-5">
                    <h3 class="card-title">Categoría <?=$cate['nombre_categoria']?></h3>
                    <div class="card-body">
                        <p><strong>Periodo:</strong> <?=$cate['periodo']?></p>
                        <p><strong>Entrenador:</strong> <?=$cate['nombre_entrenador']?></p>
                        <p><strong>Horario:</strong> <?=$cate['horario']?></p>
                    </div>
                </div>
                <?php endforeach;?>
        </div>
            </div>
            
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-info">
                <h3>Fútbol Club "Agua Dulce"</h3>
                <p>Formando talentos y campeones desde el corazón de Barinitas.</p>
                <p>&copy; 2025 Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % totalSlides;
        slides[currentSlide].classList.add('active');
        }

        const intervalId = setInterval(nextSlide, 6000);
        sliderContainer.addEventListener('mouseenter', () => clearInterval(intervalId));
    </script>
</body>
</html>