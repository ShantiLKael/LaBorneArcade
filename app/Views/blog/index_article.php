
<?php // var_dump($articles)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Blog</h2>

	<!-- Grille des article -->
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
	<!-- Article 1 -->
		<?php if (!empty($articles)) : ?>
			<?php foreach($articles as $article) : ?>
				<?php //var_dump($article)  ?>
				<br>
				<div class="border-b-2 border-white/50 p-4" id="div-article"<?= $article->id ?>>
				<div class="flex justify-between items-center cursor-pointer" onclick="interrupteurReponse(<?= $article->id  ?>)">
					<h3 class="font-lg font-bold pr-4"><?= $article->titre  ?></h3>
					
				</div>
				<p id="reponse-<?= $article->id  ?>" class="mt-4 hidden"><?= $article->texte ?></p>
				<button class="green justify-between items-center cursor-pointer" > Lire plus </button>
			</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucune article disponible pour le moment.</p>
		<?php endif; ?>
	</div>
</div>
<script src="./assets/js/btn-faq.js">
</script>