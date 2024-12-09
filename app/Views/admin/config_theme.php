<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($themes)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Configuration des theme</h2>
	
	<!-- Formulaire pour ajouter un theme -->
	<?php echo form_open('/admin/theme'); ?>

	<div class="max-w-3xl mx-auto">
		<!-- Titre centré -->
		<h3 class="text-center text-3xl font-bold mb-6">Ajoutez un thème</h3>

		<!-- Formulaire -->
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<!-- Nom du thème -->
			<div class="flex flex-col md:flex-row md:items-center">
				<label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Nom du thème :</label>
				<?php echo form_input([
					'name' => 'nom',
					'id' => 'nom',
					'value' => set_value('nom', ''),
					'placeholder' => 'Entrez votre thème ici...',
					'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto',
					'required' => 'required',
				]); ?>
			</div>

			<!-- Bouton Enregistrer -->
			<div class="flex justify-start md:justify-center">
				<?php echo form_submit('submit', 'Enregistrer', "class='bg-[#00bf63] hover:bg-green-700 text-white font-medium py-2 px-4 rounded-full'"); ?>
			</div>
		</div>

		<!-- Erreur validation -->
		<p class="text-red-500 mt-4"><?= validation_show_error('texte_theme') ?></p>
	</div>

	<?php echo form_close(); ?>

	<?php if (session()->has('errors')): ?>
		<div class="alert alert-danger">
			<?php foreach (session('errors') as $error): ?>
				<p><?= $error ?></p>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if (session()->has('success')): ?>
		<div class="alert alert-success">
			<p><?= session('success') ?></p>
		</div>
	<?php endif; ?>
	
	<!-- Grille des article -->
	<h3 class="text-center text-3xl font-bold mb-4">Liste des thèmes</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- Article -->
		<?php if (!empty($themes)) : ?>
			<?php foreach($themes as $theme) : ?>
				<?php // var_dump($theme)  ?>
				<div class="border-b-2 border-white/50 p-4 bg-[#161c2d]" id="div-theme-<?= $theme->id ?>">
					<div class="w-[25vw] h-[30px] flex items-center justify-start"> <h3 class="text-lg font-bold pr-4"><?= $theme->nom ?></h3> </div>
					<div class="w-[45vw] h-[30px] flex items-center justify-start">
						<!-- Formulaire pour supprimer le thème -->
						<?php echo form_open('/admin/theme/delete', ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce thème ?")']); ?>
							<?php echo form_hidden('id', $theme->id); ?>
							<?php echo form_submit('delete', 'Supprimer', "class='bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-full'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucune article disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footer') ?>