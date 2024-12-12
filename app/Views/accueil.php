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
            class="overflow-hidden w-3/4  mx-auto relative relative max-h-[600px] max-w-[600px] shadow-lg">
            <!-- Left Button -->
            <button id="prevBtn-1"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/50 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-white/70 z-10">
                ‹
            </button>

            <!-- Carousel Items -->
            <div class="carousel-track-1 flex transition-transform duration-500 max-h-[600px] max-w-[600px]"
                style="transform: translateX(0);">
                <?php foreach ($carrousel1 as $image): ?>
                    <div class="carousel-item-1 flex-shrink-0 w-full max-h-[600px]">
                        <img src="<?= $image ?>" alt="Image"
                            class="w-full h-full object-contain max-h-[600px] max-w-[600px]">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Right Button -->
            <button id="nextBtn-1"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/50 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-white/70 z-10">
                ›
            </button>

        </div>


        <!-- Texte -->
        <div class="w-3/4">

            <h2 class="text-4xl font-bold text-green-400 mb-4">Choisis ta borne parmi les modèles que nous proposons
            </h2>
            <p class="text-lg text-gray-300 mb-6">Choisissez parmi les modèles déjà réalisés. De nombreux thèmes sont
                disponibles : Manga, Comics, Films, Classiques de l'arcade, Pac-Man, space Invaders, Mario ....</p>
            <a href="/bornes"
                class="bg-green-500 hover:bg-green-400 text-white py-3 px-6 rounded-3xl transition-colors"> Voir
                tout</a>
        </div>


    </section>




    <!-- Section 3 : DEUXIÈME CARROUSEL (texte à gauche) -->
    <section class="grid grid-cols-2 justify-items-center justify-center items-center p-20 bg-gray-900 text-white px-8">
        <div class="w-3/4 pr-10">
            <h2 class="text-4xl font-bold text-green-400 mb-4">Personnalisez à 100% votre borne d'arcade</h2>
            <p class="text-lg text-gray-300 mb-6">Créez avec l'assistance de notre graphiste votre borne d'arcade.
                Personnalisez avec vos logos, idées, couleurs, images. Customisez chaque partie. Inspirez-vous de nos
                créations</p>
            <a href="/bornes"
                class="bg-green-500 hover:bg-green-400 text-white py-3 px-6 rounded-3xl transition-colors"> Personnalisez</a>
        </div>
        <!-- Carrousel -->
        <div class="w-3/4  mx-auto relative">
            <div id="customCarousel" class="overflow-hidden relative  shadow-lg max-h-[500px] max-w-[500px]">
                <!-- Left Button -->
                <button id="prevBtn-2"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/50 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-white/70 z-10">
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
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/50 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-white/70 z-10">
                    ›
                </button>
            </div>
        </div>
    </section>

    <!-- Section 4 : HYPERSPIN -->
    <section class="grid grid-cols-3 h-screen w-full bg-gray-900 overflow-hidden">
        <!-- Colonne gauche : Texte -->
        <div class="grid grid-rows-2 w-full h-full px-16 pl-52">
            <!-- Haut de section -->
            <div class="items-start p-8">
                <h2 class="text-4xl font-bold text-green-400 mb-4">Votre borne d'arcade livrée avec 8000 jeux</h2>
                <p class="text-lg text-gray-300 mb-6">Nous utilisons l'émulateur de jeux hyperspin</p>
            </div>
            <!-- Textes associés -->
            <div class="space-y-8">
                <div class="flex items-start space-x-4">
                    <!-- Image à gauche -->
                    <img src="./assets/images/accueil/check.png" alt="Check" class="w-10 h-10 flex-shrink-0">

                    <!-- Texte à droite -->
                    <div>
                        <h3 class="text-lg font-bold text-white-300">Haute qualité d'image</h3>
                        <p class="text-sm text-gray-300">La qualité d'image est incomparable. HYPERSPIN est un logciel
                            qui fonctionne sur pc</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <!-- Image à gauche -->
                    <img src="./assets/images/accueil/check.png" alt="Check" class="w-10 h-10 flex-shrink-0">

                    <!-- Texte à droite -->
                    <div>
                        <h3 class="text-lg font-bold text-white-300">Interface agréable</h3>
                        <p class="text-sm text-gray-300">L'interface HYPERSPIN est jolie avec ses vidéos, transitions,
                            Logos et Vidéos</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <!-- Image à gauche -->
                    <img src="./assets/images/accueil/check.png" alt="Check" class="w-10 h-10 flex-shrink-0">

                    <!-- Texte à droite -->
                    <div>
                        <h3 class="text-lg font-bold text-white-300">+8000 jeux</h3>
                        <p class="text-sm text-gray-300">HYPERSPIN permet de lancer plusieurs émulateurs pour jouer aux
                            consoles Retro</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Colonne du milieu : Image 1 -->
        <div class="w-[60%] justify-center items-start">
            <div class="w-[80%] h-64 mt-[30%]">
                <img src="./assets/images/accueil/hyperspin.png" alt="Hyperspin"
                    class="w-full h-full object-contain rounded-md">
            </div>
        </div>

        <!-- Colonne droite : Image 2 -->
        <div class="relative flex justify-center items-start pr-64">
            <div class="w-[100%] h-[150%] ">
                <img src="./assets/images/accueil/borneHyperspin.png" alt="Borne Hyperspin"
                    class=" h-[50%] object-cover rounded-md">
            </div>
        </div>
    </section>




    <!-- Section 5 : PARTENAIRES -->
    <section class="h-screen w-full bg-gray-900 flex items-center justify-center py-20 section-padding">
        <div class="flex w-full max-w-screen-xl mx-auto">
            <div class="w-1/2 pr-10">
                <h2 class="text-4xl font-bold text-green-400 mb-4">Nos Marques partenaires</h2>
                <p class="text-lg text-gray-300 mb-6">Nous sommes Heureux et Fiers de proposer depuis plus de 7 ans des
                    Bornes d'Arcade dans lesquelles nous installons des Ordinateurs Dell Reconditionnés. Les unités
                    centrales sont remises à neuf. Garanties 2 ans, elles permettent de proposer le meilleur de l'Arcade
                    sur PC via Hyperspin... Au Meilleur Prix. Un réel impact sur notre Environnement à notre échelle. Et
                    un SAV simplifié.</p>
            </div>
            <div class="w-1/2 grid grid-cols-1 gap-6">
                <div class="flex bg-gray-700 p-6  shadow-lg">
                    <img src="./assets/images/accueil/logos/Seimitsu.png" alt="Seimitsu"
                        class="w-32 h-32 object-contain object-cover  mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Seimitsu</h3>
                        <p class="text-gray-300">Notre modèle préféré de Joystick est le Seimitsu LS 55-01 en raison de
                            sa qualité.</p>
                    </div>
                </div>
                <div class="flex bg-gray-700 p-6  shadow-lg">
                    <img src="./assets/images/accueil/logos/Sanwa.png" alt="Sanwa"
                        class="w-32 h-32 object-contain  mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Sanwa</h3>
                        <p class="text-gray-300">Pour les boutons, nous préférons installer des boutons Sanwa néanmoins
                            les Seimitsu sont de bonne qualité et ils offrent des gammes de couleurs différentes.</p>
                    </div>
                </div>
                <div class="flex bg-gray-700 p-6  shadow-lg">
                    <img src="./assets/images/accueil/logos/Dell.png" alt="Dell" class="w-32 h-32 object-contain  mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Dell</h3>
                        <p class="text-gray-300">Nous proposons depuis plus de 7 ans des Bornes d'Arcade sous des
                            Ordinateurs Dell Reconditionnés. Les unités centrales sont remises à neuf et Garanties 2
                            ans.</p>
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
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/50 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-white/70 z-10">
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
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/50 text-black w-12 h-12 flex items-center justify-center rounded-full shadow-lg hover:bg-white/70 z-10">
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
