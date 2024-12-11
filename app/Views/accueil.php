<?= view('commun/header', ['titre' => 'LaBorneArcade']) ?>
<?php
// Récupérer la liste des fichiers PNG pour les carrousels
$carrousel1 = glob('./assets/images/accueil/carrousel1/*.png');
$carrousel2 = glob('./assets/images/accueil/carrousel2/*.png');
$carrousel3 = glob('./assets/images/accueil/carrousel3/*.png');
use App\Controllers\HomeController;
?>


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
    <section class="grid grid-cols-2 justify-items-center justify-center items-center p-20 bg-gray-900 text-white px-8">
        <!-- Carrousel -->

        <div id="customCarousel"
            class="overflow-hidden w-3/4  mx-auto relative relative max-h-[500px] max-w-[500px] shadow-lg">
            <!-- Left Button -->
            <button id="prevBtn-1"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                ‹
            </button>

            <!-- Carousel Items -->
            <div class="carousel-track-1 flex transition-transform duration-500 max-h-[500px] max-w-[500px]"
                style="transform: translateX(0);">
                <?php foreach ($carrousel1 as $image): ?>
                    <div class="carousel-item-1 flex-shrink-0 w-full max-h-[500px]">
                        <img src="<?= $image ?>" alt="Image" class="w-full h-full object-contain max-h-[500px] max-w-[500px]">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Right Button -->
            <button id="nextBtn-1"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                ›
            </button>

        </div>


        <!-- Texte -->
        <div class="w-3/4">

            <h2 class="text-4xl font-bold text-green-400 mb-4">Choisis ta borne parmi les modèles que nous proposons
            </h2>
            <p class="text-lg text-gray-300 mb-6">Voici une description de la section qui peut inclure quelques
                informations importantes sur les produits ou services que vous proposez.</p>
            <a href="/plus-dinformations"
                class="bg-green-500 hover:bg-green-400 text-white py-3 px-6 rounded-lg transition-colors">En savoir
                plus</a>
        </div>


    </section>




    <!-- Section 3 : DEUXIÈME CARROUSEL (texte à gauche) -->
    <section class="grid grid-cols-2 justify-items-center justify-center items-center p-20 bg-gray-900 text-white px-8">
        <div class="w-3/4 pr-10">
            <h2 class="text-4xl font-bold text-green-400 mb-4">Découvrez notre collection unique</h2>
            <p class="text-lg text-gray-300 mb-6">Voici une description de la section avec des détails supplémentaires
                sur nos produits et services exceptionnels.</p>
        </div>
        <!-- Carrousel -->
        <div class="w-3/4  mx-auto relative">
            <div id="customCarousel" class="overflow-hidden relative  shadow-lg max-h-[500px] max-w-[500px]">
                <!-- Left Button -->
                <button id="prevBtn-2"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                    ‹
                </button>

                <!-- Carousel Items -->
                <div class="carousel-track-2 flex transition-transform duration-500 p-2 max-h-[500px] max-w-[500px]"
                    style="transform: translateX(0);">
                    <?php foreach ($carrousel2 as $image2): ?>
                        <div class="carousel-item-2 flex-shrink-0 w-full max-h-[500px]">
                            <img src="<?= $image2 ?>" alt="Image"
                                class="w-full h-full object-contain max-h-[500px] max-w-[500px] ">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Right Button -->
                <button id="nextBtn-2"
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
                <div class="flex bg-gray-700 p-6  shadow-lg">
                    <img src="./assets/images/accueil/logos/Seimitsu.png" alt="Seimitsu" class="w-32 h-32 object-contain object-cover  mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Seimitsu</h3>
                        <p class="text-gray-300">Description de Seimitsu.</p>
                    </div>
                </div>
                <div class="flex bg-gray-700 p-6  shadow-lg">
                    <img src="./assets/images/accueil/logos/Sanwa.png" alt="Sanwa" class="w-32 h-32 object-cover  mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Sanwa</h3>
                        <p class="text-gray-300">Description de Sanwa.</p>
                    </div>
                </div>
                <div class="flex bg-gray-700 p-6  shadow-lg">
                    <img src="./assets/images/accueil/logos/Dell.png" alt="Dell" class="w-32 h-32 object-cover  mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Dell</h3>
                        <p class="text-gray-300">Description de Dell.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6 : TROISIÈME CARROUSEL (titre au-dessus) -->
    <section class="flex justify-items-center justify-center items-center p-20 bg-gray-900 text-white px-8">
    </div>
        <!-- Carrousel -->
        <div class="grid grid-rows-[10%_90%] w-3/4">
        <h2 class="text-4xl mx-auto font-bold text-green-400 mb-4">Nos bornes préférées</h2>
            <div id="customCarousel" class="overflow-hidden relative mx-auto  shadow-lg max-h-[600px] max-w-[600px]">
                <!-- Left Button -->
                <button id="prevBtn-3"
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                    ‹
                </button>

                <!-- Carousel Items -->
                <div class="carousel-track-3 flex transition-transform duration-500 p-2 max-h-[600px] max-w-[600px]"
                    style="transform: translateX(0);">
                    <?php foreach ($carrousel3 as $image3): ?>
                        <div class="carousel-item-3 flex-shrink-0 w-full max-w-[600px] max-h-[600px]">
                            <img src="<?= $image3 ?>" alt="Image"
                                class="w-full h-full  max-h-[600px] max-w-[600px]  object-contain">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Right Button -->
                <button id="nextBtn-3"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-green-400 z-10">
                    ›
                </button>
            </div>
        </div>
    </section>

    <!-- Section 8 : FAQ -->
    <?php $hc = new HomeController();
    echo ($hc->faq(true)); ?>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carousels = [
                {
                    track: document.querySelector('.carousel-track-1'),
                    items: document.querySelectorAll('.carousel-item-1'),
                    prevBtn: document.getElementById('prevBtn-1'),
                    nextBtn: document.getElementById('nextBtn-1'),
                    currentIndex: 0
                },
                {
                    track: document.querySelector('.carousel-track-2'),
                    items: document.querySelectorAll('.carousel-item-2'),
                    prevBtn: document.getElementById('prevBtn-2'),
                    nextBtn: document.getElementById('nextBtn-2'),
                    currentIndex: 0
                },
                {
                    track: document.querySelector('.carousel-track-3'),
                    items: document.querySelectorAll('.carousel-item-3'),
                    prevBtn: document.getElementById('prevBtn-3'),
                    nextBtn: document.getElementById('nextBtn-3'),
                    currentIndex: 0
                }
            ];

            carousels.forEach(carousel => {
                const updateCarousel = () => {
                    const itemWidth = carousel.items[0].getBoundingClientRect().width;
                    carousel.track.style.transform = `translateX(-${carousel.currentIndex * itemWidth}px)`;
                };

                carousel.prevBtn.addEventListener('click', () => {
                    carousel.currentIndex = (carousel.currentIndex > 0) ? carousel.currentIndex - 1 : carousel.items.length - 1;
                    updateCarousel();
                });

                carousel.nextBtn.addEventListener('click', () => {
                    carousel.currentIndex = (carousel.currentIndex < carousel.items.length - 1) ? carousel.currentIndex + 1 : 0;
                    updateCarousel();
                });

                window.addEventListener('resize', updateCarousel);
            });
        });
    </script>

</body>

<?= view('commun/footer') ?>