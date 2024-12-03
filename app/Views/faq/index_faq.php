<?= view('commun/header', ['titre' => $titre]) ?>
<section class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Questions fréquemment posées</h2>
	<h3 class="text-center text-green-500 text-xl font-bold mb-8">FAQ</h3>

	<!-- Grille de FAQ -->
	<div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
		
		<!-- Questions -->
		<?php if (!empty($faqs)) : ?>

			<?php foreach($faqs as $faq) : ?>
			<div class="border-b-2 border-white/50 p-4 hover:bg-white/10" id="div-faq-<?= $faq->id ?>" onmouseover="griserDiv(<?= $faq->id ?>)" onmouseout="degriserDiv(<?= $faq->id ?>)">
				<div class="flex justify-between items-center cursor-pointer" onclick="interrupteurReponse(<?= $faq->id ?>)">
					<p class="font-lg font-bold pr-4"><?= $faq->question ?></p>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path id="fleche-<?= $faq->id ?>" stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
					</svg>
				</div>
				<p id="reponse-<?= $faq->id ?>" class="mt-4 hidden"><?= $faq->reponse ?></p>
			</div>
			<?php endforeach; ?>

			<!-- Contact -->
			<div class="text-center">
				<p>Vous avez d'autres questions ? <a href="/contact" class="text-green-500 font-bold hover:underline">Contactez-nous !</a></p>
			</div>

		<?php else : ?>
		<?php endif; ?>
	</div>
</section>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footer') ?>