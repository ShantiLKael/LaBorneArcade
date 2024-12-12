<?= view('commun/headerAdmin', ['titre' => $titre]) ?>
<?php // var_dump($articles)  ?>
<div id="main-content" class=" p-8 w-full">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Configuration des articles</h2>
	
	<!-- Formulaire pour ajouter un article -->
    <?php echo form_open('/admin/articles', ['enctype' => 'multipart/form-data']); ?>
    <table class="max-w-3xl mx-auto">
		<tbody>
			<tr>
				<td colspan=2 class="mt-5 p-0">
					<h3 class="text-center text-3xl font-bold mb-6">
						<?php echo form_label('Ajoutez un article ', 'article'); ?>
					</h3>
				</td>
			</tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Titre de l'article : * </label> </td>
				<td class="">
					<!-- Champ pour le modèle -->
					<?php echo form_input(
						[
							'name' => 'titre',
							'value' => set_value('titre', ''),
							'placeholder' => 'Entrez votre question ici...',
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
            <tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="texte">Texte de l'article : * </label> </td>
				<td class="">
					<!-- Champ pour la couleur -->
					<?php echo form_textarea(
						[
							'name' => 'texte',
							'value' => set_value('texte', ''),
							'placeholder' => 'Entrez votre reponse ici...',
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
            <tr><td><br></td></tr>
            <tr class="flex flex-col md:flex-row md:items-center mb-4">
                <td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="image1"> Image de l'article 1 : * </label></td>
                <td>
                    <!-- Champ pour télécharger une image -->
                    <?php echo form_input([
                        'type' => 'file',
                        'name' => 'images[]', // Utilisation d'un tableau pour permettre plusieurs fichiers
                        'id' => 'image1',
                        'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
                        'accept' => 'image/*', // Permet uniquement les fichiers image
						'required' => 'required',
                    ]); ?>
                </td>
            </tr>
			<?php for ($i = 2; $i <= 6; $i++): ?>
				<tr class="flex flex-col md:flex-row md:items-center mb-4">
					<td>
						<label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="image<?= $i; ?>">
							Image de l'article <?= $i; ?> :
						</label>
					</td>
					<td>
						<!-- Champ pour télécharger une image -->
						<?php echo form_input([
							'type' => 'file',
							'name' => 'images[]', // Utilisation d'un tableau pour permettre plusieurs fichiers
							'id' => 'image' . $i,
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
							'accept' => 'image/*', // Permet uniquement les fichiers image
						]); ?>
					</td>
				</tr>
            <?php endfor; ?>
            <tr><td><br></td></tr>
			<tr>
				<td class="flex justify-start md:justify-center">
					<!-- Bouton d'enregistrement -->
					<?php echo form_submit('submit', 'Enregistrer', "class='bg-vert-pastel hover:bg-vert-pastelF font-medium py-2 px-4 rounded-full'"); ?>
				</td>
			</tr>
			<tr><td><br></td></tr>
		</tbody>
	</table>
	<p class=""><?= validation_show_error('texte_joystick') ?></p>
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
	<h3 class="text-center text-3xl font-bold mb-4">Liste des articles</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- themes -->
		<?php if (!empty($articles)) : ?>
			<?php foreach($articles as $article) : ?>
				<div class="border-b border-gray-200 py-4 bg-FVertClair">
					<!-- Question -->
					<div class="text-lg font-medium text-[#00bf63] font-bold mb-2">
						<?= $article->titre ?>
					</div>
					<!-- Réponse -->
					<div class="text-md text-dark-blue">
						<?= $article->texte ?>
					</div>
					<!-- Bouton Supprimer -->
					<div class="mt-2">
						<?php echo form_open("/admin/articles/delete/$article->id", ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer cette article ?")']); ?>
							<?php echo form_hidden('id', $article->id); ?>    
							<?php echo form_submit('delete', 'Supprimer', "class='bg-rouge-pastel hover:bg-rouge-pastelF text-dark-blue font-medium py-1 px-4 rounded'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucun article disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<?= view('commun/footerAdmin') ?>