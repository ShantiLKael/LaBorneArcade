<?= view('commun/headerAdmin', ['titre' => $titre]) ?>
<?php // var_dump($faqs)  ?>
<div id="main-content" class=" p-8 w-full">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Configuration de la FAQ</h2>
	
	<!-- Formulaire pour ajouter un faq -->
    <?php echo form_open('/admin/faqs'); ?>
    <table class="max-w-3xl mx-auto">
		<tbody>
			<tr>
				<td colspan=2 class="mt-5 p-0">
					<h3 class="text-center text-3xl font-bold mb-6">
						<?php echo form_label('Ajoutez une question de la FAQ ', 'FAQ'); ?>
					</h3>
				</td>
			</tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Question : * </label> </td>
				<td class="">
					<!-- Champ pour le modèle -->
					<?php echo form_input(
						[
							'name' => 'question',
							'value' => set_value('question', ''),
							'placeholder' => 'Entrez votre question ici...',
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
            <tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="couleur">Réponse : * </label> </td>
				<td class="">
					<!-- Champ pour la couleur -->
					<?php echo form_input(
						[
							'name' => 'reponse',
							'value' => set_value('reponse', ''),
							'placeholder' => 'Entrez votre reponse ici...',
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
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
	<h3 class="text-center text-3xl font-bold mb-4">Liste des FAQ</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- themes -->
		<?php if (!empty($faqs)) : ?>
			<?php foreach($faqs as $faq) : ?>
				<div class="border-b border-gray-200 py-4 bg-FVertClair">
					<!-- Question -->
					<div class="text-lg font-medium text-dark-blue font-bold mb-2">
						<?= $faq->question ?>
					</div>
					<!-- Réponse -->
					<div class="text-md text-dark-blue">
						<?= $faq->reponse ?>
					</div>
					<!-- Bouton Supprimer -->
					<div class="mt-2">
						<?php echo form_open("/admin/faqs/delete/$faq->id", ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer cette FAQ ?")']); ?>
							<?php echo form_hidden('id', $faq->id); ?>    
							<?php echo form_submit('delete', 'Supprimer', "class='bg-rouge-pastel hover:bg-rouge-pastelF text-dark-blue font-medium py-1 px-4 rounded'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucune FAQ disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<?= view('commun/footerAdmin') ?>