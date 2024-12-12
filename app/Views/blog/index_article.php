<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>

<section class="bg-gray-900 py-10">
    <h2 class="text-center text-white text-3xl font-bold mb-8">Le Blog de La Borne Arcade</h2>
    <div class="bg-medium-blue p-20 rounded-xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
	<?php if (isset($articles)) : ?>
		<?php foreach ($articles as $article): ?>
            <div class="bg-gray-900 rounded-t-lg border-b border-gray-400 shadow-md overflow-hidden">
                <img loading="lazy" src="<?= '' /*$article->image->chemin */ ?>" alt="<?= $article->title ?>" class="w-full h-40 object-cover">
                
                <div class="p-5">
                    <h3 class="text-white text-lg font-semibold mb-3"><?= $article->title ?></h3>
                    <p class="text-gray-400 text-sm mb-5">
						<?= strlen($article->texte) > 200
                            ? substr($article->texte, 0, 200) . '...'
                            : $article->texte; ?>
					</p>
                    <a href="<?= '/blog-articles/'.$article->id ?>" class="inline-block bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-500">
                        Lire plus
                    </a>
                </div>
            </div>
		<?php endforeach; ?>
	<?php else : ?>
		<div class="flex items-center justify-between p-4 border border-gray-700 rounded-lg">
			<p class="mx-auto text-md">Aucun articles pour le moment</p>
		</div>
	<?php endif; ?>
	</div>
</section>
<?= view('commun/footer') ?>
