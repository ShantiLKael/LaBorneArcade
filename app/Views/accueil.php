<?= view('commun/header', ['titre' => 'LaBorneArcade']) ?>
<?php
// Récupérer la liste des fichiers PNG pour les carrousels
$carrousel1 = glob('./assets/images/accueil/carrousel1/*.png');
$carrousel2 = glob('./assets/images/accueil/carrousel2/*.png');
$carrousel3 = glob('./assets/images/accueil/carrousel3/*.png');
use App\Controllers\HomeController;
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <style>
        body {
            margin: 0;
        }

        .slick-carousel img {
            max-height: 400px;
        }

        #carousel3 h2 {
            font-size: 2.5rem;
        }

        .section-padding {
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .carousel-container {
            margin-left: 2rem;
            margin-right: 2rem;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">

    <!-- Section 1 : GIF en arrière-plan avec images superposées -->
    <section class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        <video autoplay loop muted playsinline class="absolute inset-0 h-full w-full object-cover">
            <source src="./assets/images/accueil/bg_video.mp4" type="video/mp4">
            Votre navigateur ne prend pas en charge la lecture des vidéos.
        </video>
        <div class="relative z-10 h-screen w-full flex items-center justify-center">
            <div class="relative w-full h-full">
                <img src="./assets/images/accueil/borne_vierge.png" alt="Borne"
                    class="absolute inset-0 w-full h-full object-contain mx-auto">
                <div class="absolute inset-0 flex items-center justify-center">
                    <a href="connexion"
                        class="absolute top-1/3 -translate-x-1/2 left-[40%] w-100 h-100 transition-transform hover:scale-105">
                        <img src="./assets/images/accueil/Textes/1P.png" alt="1Player"
                            class="w-full h-full object-cover">
                    </a>
                    <a href="inscription"
                        class="absolute top-1/3 -translate-x-1/2 left-[60%] w-100 h-100 transition-transform hover:scale-105">
                        <img src="./assets/images/accueil/Textes/2P.png" alt="2Player"
                            class="w-full h-full object-cover">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2 : CARROUSEL-->
    <section class="flex items-center justify-center p-20 bg-gray-900 text-white px-8">
        <!-- Carrousel -->
        <div class="max-w  mx-auto relative">
            <div id="customCarousel" class="overflow-hidden relative rounded-lg shadow-lg">
                <!-- Left Button -->
                <button id="prevBtn"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                    ‹
                </button>

                <!-- Carousel Items -->
                <div class="carousel-track flex transition-transform duration-500 p-2"
                    style="transform: translateX(0);">
                    <?php foreach ($carrousel1 as $image): ?>
                        <div class="carousel-item flex-shrink-0 w-full">
                            <img src="<?= $image ?>" alt="Image" class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Right Button -->
                <button id="nextBtn"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                    ›
                </button>
            </div>
        </div>


        <!-- Texte -->
        <div class="w-2/5 pl-16">

            <h2 class="text-4xl font-bold text-green-400 mb-4">Choisis ta borne parmi les modèles que nous proposons
            </h2>
            <p class="text-lg text-gray-300 mb-6">Voici une description de la section qui peut inclure quelques
                informations importantes sur les produits ou services que vous proposez.</p>
            <a href="/plus-dinformations"
                class="bg-green-500 hover:bg-green-400 text-white py-3 px-6 rounded-lg transition-colors">En savoir
                plus</a>
        </div>

        
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.querySelector('.carousel-track');
            const items = document.querySelectorAll('.carousel-item');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            let currentIndex = 0;

            const updateCarousel = () => {
                const itemWidth = items[0].getBoundingClientRect().width;
                track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
            };

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
                updateCarousel();
            });

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
                updateCarousel();
            });

            // Réinitialise le carrousel au redimensionnement
            window.addEventListener('resize', updateCarousel);
        });
    </script>


    <style>
        .carousel-container {
            position: relative;
            margin-left: 2rem;
            margin-right: 2rem;
        }

        .carousel-track {
            display: flex;
        }

        .carousel-item {
            flex-shrink: 0;
            width: 100%;
        }
    </style>


    <!-- Section 3 : DEUXIÈME CARROUSEL (texte à gauche) -->
    <section class="flex items-center justify-between py-20 bg-gray-900 text-white section-padding">
        <div class="w-1/2 pr-10">
            <h2 class="text-4xl font-bold text-green-400 mb-4">Découvrez notre collection unique</h2>
            <p class="text-lg text-gray-300 mb-6">Voici une description de la section avec des détails supplémentaires
                sur nos produits et services exceptionnels.</p>
        </div>
        <!-- Carrousel -->
        <div class="max-w  mx-auto relative">
            <div id="customCarousel" class="overflow-hidden relative rounded-lg shadow-lg">
                <!-- Left Button -->
                <button id="prevBtn"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                    ‹
                </button>

                <!-- Carousel Items -->
                <div class="carousel-track flex transition-transform duration-500 p-2"
                    style="transform: translateX(0);">
                    <?php foreach ($carrousel2 as $image2): ?>
                        <div class="carousel-item flex-shrink-0 w-full">
                            <img src="<?= $image2 ?>" alt="Image" class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Right Button -->
                <button id="nextBtn"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                    ›
                </button>
            </div>
        </div>
    </section>

    <!-- Section 4 : HYPERSPIN -->
    <section class="h-screen w-full bg-gray-900 flex items-center justify-center">
        <h2 class="text-3xl font-bold text-green-400">Section 4</h2>
    </section>

    <!-- Section 5 : PARTENAIRES -->
    <section class="h-screen w-full bg-gray-900 flex items-center justify-center py-20 section-padding">
        <div class="flex w-full max-w-screen-xl mx-auto">
            <div class="w-1/2 pr-10">
                <h2 class="text-4xl font-bold text-green-400 mb-4">Nos partenaires</h2>
                <p class="text-lg text-gray-300 mb-6">Voici une description des partenaires avec lesquels nous
                    collaborons pour offrir les meilleures expériences de jeu.</p>
            </div>
            <div class="w-1/2 grid grid-cols-1 gap-6">
                <div class="flex bg-gray-700 p-6 rounded-lg shadow-lg">
                    <img src="./assets/images/accueil/image1.png" alt="Image 1"
                        class="w-32 h-32 object-cover rounded-lg mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Seimitsu</h3>
                        <p class="text-gray-300">Description de Seimitsu.</p>
                    </div>
                </div>
                <div class="flex bg-gray-700 p-6 rounded-lg shadow-lg">
                    <img src="./assets/images/accueil/image2.png" alt="Image 2"
                        class="w-32 h-32 object-cover rounded-lg mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Sanwa</h3>
                        <p class="text-gray-300">Description de Sanwa.</p>
                    </div>
                </div>
                <div class="flex bg-gray-700 p-6 rounded-lg shadow-lg">
                    <img src="./assets/images/accueil/image3.png" alt="Image 3"
                        class="w-32 h-32 object-cover rounded-lg mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Dell</h3>
                        <p class="text-gray-300">Description de Dell.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6 : TROISIÈME CARROUSEL (titre au-dessus) -->
    <section class="py-20 bg-gray-900 text-white section-padding">
        <div class="w-full max-w-screen-lg mx-auto text-center mb-8">
            <h2 class="text-4xl font-bold text-green-400">Notre Galerie</h2>
        </div>
        <div id="carousel3" class="slick-carousel carousel-container">
            <?php foreach ($carrousel3 as $image) {
                echo '<div><img src="' . $image . '" class="w-full h-auto object-cover" alt="Image"></div>';
            } ?>
        </div>
    </section>

    <!-- Section 8 : FAQ -->
    <?php $hc = new HomeController();
    echo ($hc->faq(true)); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialisation des carrousels
            $('#carousel1, #carousel2, #carousel3').slick({
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                arrows: true,
                infinite: true,
                speed: 500,
                fade: false,
                cssEase: 'linear',
            });
        });
    </script>
</body>

<?= view('commun/footer') ?>