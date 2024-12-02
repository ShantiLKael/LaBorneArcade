<?= view('commun/header', ['titre' => $titre]) ?>
<div class="container mx-auto px-4 py-8">
        <!-- Barre de navigation -->
        <nav class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Borne</h1>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-lg hover:text-green-400">Trouver ma borne</a></li>
                <li><a href="#" class="text-lg hover:text-green-400">Personnalisez ma borne</a></li>
                <li><a href="#" class="text-lg hover:text-green-400">À propos</a></li>
                <li><a href="#" class="text-lg hover:text-green-400">FAQ</a></li>
                <li><a href="#" class="text-lg hover:text-green-400">Blog</a></li>
            </ul>
        </nav>

        <!-- Section de sélection -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold mb-4">Choisis ta borne préférée</h2>
            <div class="flex justify-center space-x-4">
                <button class="bg-green-500 text-white px-4 py-2 rounded">Sticker</button>
                <button class="bg-gray-700 text-white px-4 py-2 rounded">Classique Wood</button>
                <button class="bg-gray-700 text-white px-4 py-2 rounded">Classique Wood Gravé</button>
            </div>
            <p class="text-gray-400 mt-4">
                Pour toute information complémentaire ou pour passer commande, prenez <a href="#" class="text-green-400 underline">rdv</a>.
            </p>
            <p class="text-gray-400">
                Toutes nos bornes sont équipées de l’émulateur Hyperspin ainsi que 8000 jeux d’arcades et de consoles rétro. <a href="#" class="text-green-400 underline">Lire plus</a>.
            </p>
        </div>

        <!-- Filtres -->
        <div class="flex flex-col md:flex-row md:space-x-8 mb-8">
            <div class="md:w-1/4 bg-gray-800 p-4 rounded">
                <h3 class="text-lg font-bold mb-4">Filtrer par</h3>
                <form>
                    <label class="block mb-2">
                        <input type="checkbox" name="theme" value="anime" class="mr-2"> Anime
                    </label>
                    <label class="block mb-2">
                        <input type="checkbox" name="theme" value="comics" class="mr-2"> Comics
                    </label>
                    <label class="block mb-2">
                        <input type="checkbox" name="theme" value="jeux_video" class="mr-2"> Jeux vidéo
                    </label>
                    <label class="block mb-2">
                        <input type="checkbox" name="theme" value="film" class="mr-2"> Film
                    </label>
                    <label class="block mb-2">
                        <input type="checkbox" name="theme" value="autre" class="mr-2"> Autre
                    </label>
                </form>
            </div>

            <!-- Liste des bornes -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:w-3/4">
                <?php
                $bornesTest = [
                    [
                        'image' => 'https://via.placeholder.com/150',
                        'title' => 'Borne D\'arcade Galaktronik',
                        'price' => '1490,00 €',
                    ],
                    [
                        'image' => 'https://via.placeholder.com/150',
                        'title' => 'Borne D\'arcade Pac-Man',
                        'price' => '1490,00 €',
                    ],
                    [
                        'image' => 'https://via.placeholder.com/150',
                        'title' => 'Borne D\'arcade Ken le survivant',
                        'price' => '1490,00 €',
                    ],
                ];

                foreach ($bornesTest as $borne) {
                    echo "
                    <div class='bg-gray-800 p-4 rounded'>
                        <img src='{$borne['image']}' alt='Image de {$borne['title']}' class='w-full h-64 object-cover mb-4'>
                        <h3 class='text-xl font-bold mb-2'>{$borne['title']}</h3>
                        <p class='text-green-400 font-bold mb-4'>{$borne['price']}</p>
                        <div class='flex justify-between'>
                            <button class='bg-green-600 text-white px-4 py-2 rounded'>Ajouter au panier</button>
                            <button class='bg-blue-600 text-white px-4 py-2 rounded'>Personnaliser</button>
                        </div>
                    </div>
                    ";
                }
                ?>
                <?php foreach ($bornes as $borne) : ?>
                    <div class='bg-gray-800 p-4 rounded'>
                        <img src='<?= $borne->image->chemin; ?>' alt='<?= $borne->nom; ?>' class='w-full h-64 object-cover mb-4'>
                        <h3 class='text-xl font-bold mb-2'><?= $borne->nom; ?></h3>
                        <p class='text-green-600 font-bold mb-4'><?= $borne->prix; ?></p>
                        <div class='flex justify-between'>
                            <a href='ajouter-panier/<?= $borne->id; ?>' class='bg-green-700 text-white px-4 py-2 rounded'>Ajouter au panier</a>
                            <a href='bornes/<?= $borne->id; ?>' class='bg-blue-600 text-white px-4 py-2 rounded'>Personnaliser</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
</div>
<?= view('commun/footer') ?>