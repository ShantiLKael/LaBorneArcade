<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($article)  ?>
<div class="text-white py-12 px-6">
    <!-- Titre principal -->
    <h2 class="center w-[35vw] h-[40px] text-3xl font-bold mb-4 mx-auto">Article de blog</h2>

	<!-- Grille de l'article -->
	<div class="bg-[#161c2d] grid-cols-1 md:grid-cols-1 gap-6 max-w-7xl mx-auto"><br>
	<!-- Article -->
		<?php if (!empty($article)) : ?>
			<?php //var_dump($article)  ?>
			<div class="border-b-2 border-white/50 p-4 " id="div-article-<?= $article->id ?>">
			<div class="center w-[25vw] h-[30px] flex items-center justify-center"> <h3 class="text-center text-1 font-bold mb-4"><?= $article->titre ?></h3>  </div><br>
				<div> <p id="reponse-<?= $article->id  ?>" class="mt-4 "><?= $article->texte ?></p> </div>
				<br><br>
				<!-- Images associées -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
                    <?php if (!empty($images)) : ?>
                        <?php foreach ($images as $image) : ?>
                            <img src="<?= base_url($image->chemin) ?>" alt="Image de l'article" class="rounded shadow-md">
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Aucune image disponible pour cet article.</p>
                    <?php endif; ?>
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
