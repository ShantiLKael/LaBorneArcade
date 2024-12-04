<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($articles)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Blog</h2>

	<!-- Grille des article -->
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- Article -->
		<?php if (!empty($articles)) : ?>
			<?php foreach($articles as $article) : ?>
				<?php //var_dump($article)  ?>
				<div class="border-b-2 border-white/50 p-4 bg-[#161c2d]" id="div-article-<?= $article->id ?>">
					<div class="mb-4 flex items-center"> <img class="flex items-center" src="https://via.placeholder.com/150"  alt="Image de l'article"> </div>
					<div class="w-[25vw] h-[30px] flex items-center justify-start"> <h3 class="text-lg font-bold pr-4"><?= $article->titre ?></h3> </div>
					<div> <p id="reponse-<?= $article->id  ?>" class="mt-4 "><?= mb_substr($article->texte, 0, 150) ?>...</p> </div>
					<div>
						<a href="/blog-articles/<?= $article->id ?>" 
						   class="bg-[#32a64f] text-white px-4 py-2 mt-2 inline-block rounded-md 
								  cursor-pointer hover:bg-[#28a041] transition-all
								  mx-[10px] my-[5px]">
							Lire plus
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucune article disponible pour le moment.</p>
		<?php endif; ?>
	</div>
</div>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footer') ?>