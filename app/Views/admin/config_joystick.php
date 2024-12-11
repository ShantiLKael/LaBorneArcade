<?= view('commun/headerAdmin', ['titre' => $titre]) ?>
<?php // var_dump($joysticks)  ?>
<div id="main-content" class=" p-8 w-full">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">configuration des joysticks</h2>
	<!-- Formulaire pour ajouter un commentaire -->

    <?php echo form_open('/admin/joystick'); ?>
    <table class="max-w-3xl mx-auto">
		<tbody>
			<tr>
				<td colspan=2 class="mt-5 p-0">
					<h3 class="text-center text-3xl font-bold mb-6">
						<?php echo form_label('Ajoutez un joystick ', 'matierjoysticke'); ?>
					</h3>
				</td>
			</tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Modele du joystick : * </label> </td>
				<td class="">
					<!-- Champ pour le modèle -->
					<?php echo form_input(
						[
							'name' => 'modele',
							'value' => set_value('modele', ''),
							'placeholder' => 'Entrez votre nom du modele ici...',
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
            <tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="couleur">Couleur du joystick : * </label> </td>
				<td class="">
					<!-- Champ pour la couleur -->
					<?php echo form_input(
						[
							'type' => 'color', // Définit le champ comme un sélecteur de couleur
							'name' => 'couleur',
							'value' => set_value('couleur', '#000000'), // Valeur par défaut (noir)
							'class' => '',
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

	<!-- Grille des joysticks -->
	<h3 class="text-center text-3xl font-bold mb-4">Liste des joysticks</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- joystick -->
		<?php if (!empty($joysticks)) : ?>
			<?php foreach($joysticks as $joystick) : ?>
				<div class="flex justify-between items-center border-b border-gray-200 py-2 bg-FVertClair">
					<!-- Nom de la matiere avec une largeur fixe -->
					<div class="text-lg font-medium font-bold w-1/3 min-w-[150px] truncate">
						<?= $joystick->modele ?>
					</div>

					<!-- Pastille de couleur -->
					<div 
						class="w-8 h-8 rounded-full border-2 border-black flex-shrink-0 ml-4" 
						style="background-color: <?= $joystick->couleur ?>;"
						title="Couleur : <?= $joystick->couleur ?>">
					</div>

					<!-- Bouton Supprimer -->
					<div class="ml-auto">
						<?php echo form_open("/admin/joystick/delete/$joystick->id", ['onsubmit' => "return confirm(\"Êtes-vous sûr de vouloir supprimer ce joystick, $joystick->modele, $joystick->couleur  ?\")"]); ?>
							<?php echo form_hidden('id', $joystick->id); ?>		
							<?php echo form_submit('delete', 'Supprimer', "class='bg-rouge-pastel hover:bg-rouge-pastelF font-medium py-1 px-4 rounded'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucun joystick disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footerAdmin') ?>