<?= view('commun/header', ['titre' => 'LaBorneArcade']) ?>
<?php
// Récupérer la liste des fichiers PNG dans le dossier des bornes
$images = glob('./assets/images/logos/*.png');
use App\Controllers\HomeController;
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
</head>

<body class="bg-gray-900 text-white">

    <!-- Section 1 : GIF en arrière-plan avec images superposées -->
    <section class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        <!-- GIF de fond -->
        <video autoplay loop muted playsinline class="absolute inset-0 h-full w-full object-cover">
            <source src="./assets/images/accueil/bg_video.mp4" type="video/mp4">
            Votre navigateur ne prend pas en charge la lecture des vidéos.
        </video>

        <div class="relative z-10 h-screen w-full flex items-center justify-center">
            <!-- Image principale -->
            <div class="relative w-full h-full">
                <img loading="lazy" src="./assets/images/accueil/borne_vierge.png" alt="Borne"
                    class="absolute inset-0 w-full h-full object-contain mx-auto">

                <!-- Liens superposés -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <!-- Lien 1 -->
                    <a href="connexion" class="absolute top-1/3 -translate-x-1/2 left-[40%] w-100 h-100 
                flex items-center justify-center transition-transform hover:scale-105">
                        <img src="./assets/images/accueil/Textes/1P.png" alt="1Player"
                            class="w-full h-full object-cover   ">
                    </a>

                    <!-- Lien 2 -->
                    <a href="inscription" class="absolute top-1/3 -translate-x-1/2 left-[60%] w-100 h-100  
                flex items-center justify-center transition-transform hover:scale-105">
                        <img src="./assets/images/accueil/Textes/2P.png" alt="2Player"
                            class="w-full h-full object-cover ">
                    </a>
                </div>
            </div>
        </div>


    </section>


    <!-- Section 2 : PREMIER CARROUSEL -->
    <section class="flex items-center justify-between py-20 px-6 bg-gray-900 text-white">
        <!-- Carrousel d'images à gauche -->
        <div class="w-full max-w-screen-lg mx-auto">
            <div id="carouselExample" class="slick-carousel">
                <?php
                // Boucle pour afficher les images du carrousel
                foreach ($images as $image) {
                    echo '<div><img src="' . $image . '" class="w-full h-auto object-cover max-h-[500px]" alt="Borne image"></div>';
                }
                ?>
            </div>
        </div>

        <!-- Titre, description et bouton à droite -->
        <div class="w-1/2 pl-10">
            <h2 class="text-4xl font-bold text-green-400 mb-4">Titre de la section</h2>
            <p class="text-lg text-gray-300 mb-6">
                Voici une description de la section qui peut inclure quelques informations importantes sur les produits
                ou services que vous proposez.
            </p>
            <a href="/plus-dinformations"
                class="bg-green-500 hover:bg-green-400 text-white py-3 px-6 rounded-lg transition-colors">
                En savoir plus
            </a>
        </div>
    </section>






    <!-- Section 3 SECOND CARROUSEL-->
    <section class="h-screen w-full bg-gray-900 flex items-center justify-center">
        <h2 class="text-3xl font-bold text-green-400">Section 3</h2>
    </section>

    <!-- Section 4 HYPERSPIN -->
    <section class="h-screen w-full bg-gray-900 flex items-center justify-center">
        <h2 class="text-3xl font-bold text-green-400">Section 4</h2>
    </section>

    <!-- Section 5 PARTENAIRES-->
    <section class="h-screen w-full bg-gray-900 flex items-center justify-center py-20 px-6">
        <div class="flex w-full max-w-screen-xl mx-auto">
            <!-- Titre et description à gauche -->
            <div class="w-1/2 pr-10">
                <h2 class="text-4xl font-bold text-green-400 mb-4">Titre de la section</h2>
                <p class="text-lg text-gray-300 mb-6">
                    Voici une description de la section qui peut inclure quelques informations importantes sur les
                    produits
                    ou services que vous proposez.
                </p>
            </div>

            <!-- Colonne de 3 cases à droite -->
            <div class="w-1/2 grid grid-cols-1 gap-6">
                <!-- Case 1 -->
                <div class="flex bg-gray-700 p-6 rounded-lg shadow-lg">
                    <img src="./assets/images/accueil/image1.png" alt="Image 1"
                        class="w-32 h-32 object-cover rounded-lg mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Seimitsu</h3>
                        <p class="text-gray-300">Description de la case 1 avec plus d'informations sur le contenu.</p>
                    </div>
                </div>

                <!-- Case 2 -->
                <div class="flex bg-gray-700 p-6 rounded-lg shadow-lg">
                    <img src="./assets/images/accueil/image2.png" alt="Image 2"
                        class="w-32 h-32 object-cover rounded-lg mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Sanwa</h3>
                        <p class="text-gray-300">Description de la case 2 avec plus d'informations sur le contenu.</p>
                    </div>
                </div>

                <!-- Case 3 -->
                <div class="flex bg-gray-700 p-6 rounded-lg shadow-lg">
                    <img src="./assets/images/accueil/image3.png" alt="Image 3"
                        class="w-32 h-32 object-cover rounded-lg mr-6">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Dell</h3>
                        <p class="text-gray-300">Description de la case 3 avec plus d'informations sur le contenu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6  FAQ-->

    <?php $hc = new HomeController();
    echo ($hc->faq(true)); ?>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>

        $(document).ready(function () {
            // Initialiser le carrousel Slick
            $('#carouselExample').slick({
                autoplay: true,
                autoplaySpeed: 2000, // Durée de chaque slide
                dots: true, // Afficher des points de navigation
                arrows: true, // Afficher les flèches
                infinite: true, // Recommencer au début après la dernière image
                speed: 500, // Vitesse de transition
                fade: false, // Transition entre les slides (false: glisser, true: fondu)
                cssEase: 'linear', // Type de transition
            });
        });
    </script>

</body>

</html>


<?= view('commun/footer') ?>