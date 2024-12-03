<?= view('commun/header', ['titre' => $titre]) ?>
<!-- Section "Qui sommes-nous ?" -->
<section class="container mx-auto px-4 py-8 mb-10">
	<div class="flex flex-col md:flex-row items-center bg-medium-blue rounded-sm p-5 md:p-12 shadow shadow-black/55 mb-10">
		<!-- Image -->
		<div class="md:w-1/2 mb-6 md:mb-0">
			<img src="https://via.placeholder.com/400" alt="Photo Johann Lefebvre" class="rounded-lg shadow-lg">
		</div>

		<!-- Texte -->
		<div class="md:w-1/2 md:pl-4 px-2 mt-6 md:mt-0">
			<h2 class="text-3xl font-bold mb-4 text-center md:text-left">Qui sommes-nous ?</h2>
			<p class="text-gray-300 text-lg mb-4">
				Après une carrière en tant qu'animateur (Level One sur Game One, Gameology sur Gong, Morning Star sur CStar), Johann Lefebvre décide de créer un projet qui lui tient à cœur : La Borne Arcade.
			</p>
			<p class="text-gray-300 text-lg mb-4">
				Il associe son amour des jeux vidéo et l'envie de proposer des bornes d'arcades adaptées à nos intérieurs et à notre époque. Ce meuble mythique d'une génération donne envie de rejouer aux grands classiques du jeu vidéo avec ses amis, ses enfants ou sur son lieu de travail avec des collègues.
			</p>
			<p class="text-gray-300 text-lg">
				Depuis 2015, les bornes sont fabriquées dans notre <span class="text-green-600">atelier de Marne-la-Vallée</span> et expédiées à travers la France et l'Europe. Merci aux nombreux clients qui nous ont fait confiance.
			</p>
		</div>
	</div>

	<iframe class="md:mx-auto" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.447051444019!2d2.6865193764661117!3d48.88781677133617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e61b9db3979f0b%3A0x33ed3fce188f35b0!2sLa%20Borne%20Arcade!5e0!3m2!1sfr!2sfr!4v1733142033742!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
	</iframe>
</section>
<?= view('commun/footer') ?>