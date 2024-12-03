<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($article)  ?>
<div class="text-white py-12 px-6">

	<!-- Grille des article -->
	<div class="bg-blue-500 grid-cols-1 md:grid-cols-1 gap-6 max-w-7xl mx-auto">
		<!-- Titre principal -->
		<h2 class="text-3xl font-bold mb-4">Article de blog</h2>
	<!-- Article -->
		<?php if (!empty($article)) : ?>
			<?php //var_dump($article)  ?>
			<div class="bg-light-teal border-b-2 border-white/50 p-4 " id="div-article-<?= $article->id ?>">
			<div class="bg-light-teal center w-[25vw] h-[30px] flex items-center justify-center"> <h3 class="text-center text-3xl font-bold mb-4"><?= $article->titre ?></h3>  </div>
				<div> <p id="reponse-<?= $article->id  ?>" class="mt-4 "><?= $article->texte ?></p> </div>
				<br><br>
				<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto"> 
					<img src="https://via.placeholder.com/150" alt="Image de l'article"> 
					<img src="https://via.placeholder.com/150" alt="Image de l'article">
					<img src="https://via.placeholder.com/150" alt="Image de l'article">
					<img src="https://via.placeholder.com/150" alt="Image de l'article">
					<img src="https://via.placeholder.com/150" alt="Image de l'article">
				</div>
				<br>
			</div>
		<?php else : ?>
			<p class="p-4">Aucun article disponible pour le moment.</p>
		<?php endif; ?>
	</div>
	<br>
	<br>
</div>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footer') ?>