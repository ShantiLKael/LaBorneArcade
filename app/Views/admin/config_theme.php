<?= view('commun/headerAdmin', ['titre' => $titre]) ?>
<?php // var_dump($themes)  ?>
<div id="main-content" class=" p-8 w-full">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Configuration des themes</h2>
	
	<!-- Formulaire pour ajouter un theme -->
	<?php echo form_open('/admin/theme'); ?>

	<div class="max-w-3xl mx-auto">
		<!-- Titre centré -->
		<h3 class="text-center text-3xl font-bold mb-6">Ajoutez un thème</h3>

		<!-- Formulaire -->
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<!-- Nom du thème -->
			<div class="flex flex-col md:flex-row md:items-center">
				<label class="text-lg font-medium mb-2 md:mb-0 md:mr-6" for="nom">Nom du thème : *  </label>
				<?php echo form_input([
					'name' => 'nom',
					'id' => 'nom',
					'value' => set_value('nom', ''),
					'placeholder' => 'Entrez votre thème ici...',
					'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
					'required' => 'required',
				]); ?>
			</div>

			<!-- Bouton Enregistrer -->
			<div class="flex justify-start md:justify-center">
				<?php echo form_submit('submit', 'Enregistrer', "class='bg-vert-pastel hover:bg-vert-pastelF text-dark-blue font-medium py-2 px-4 rounded-full'"); ?>
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
	
	<!-- Grille des themes -->
	<h3 class="text-center text-3xl font-bold mb-4">Liste des thèmes</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- themes -->
		<?php if (!empty($themes)) : ?>
			<?php foreach($themes as $theme) : ?>
				<?php // var_dump($theme)  ?>
				<div class="p-4 flex justify-between items-center border-b border-gray-200 py-2 bg-FVertClair">
					<!-- Nom du thème -->
					<div class="text-lg font-medium text-dark-blue font-bold">
						<?= $theme->nom ?>
					</div>
					
					<!-- Bouton Supprimer -->
					<div>
						<?php echo form_open("/admin/theme/delete/$theme->id", ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce thème ?")']); ?>
                            <?php echo form_hidden('id', $theme->id); ?>	
                            <?php echo form_submit('delete', 'Supprimer', "class='bg-rouge-pastel hover:bg-rouge-pastelF text-dark-blue font-medium py-1 px-4 rounded'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucune themes disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<?= view('commun/footerAdmin') ?>