<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($joysticks)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">configuration des joysticks</h2>

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
	<!-- Formulaire pour ajouter un commentaire -->
	<?php echo form_open('/admin/joystick'); ?>

		<table class="grid grid-cols-1 md:grid-cols-1 gap-6 max-w-3xl mx-auto flex items-center justify-start">
		<tbody>
		<tr>
			<td colspan=2 class="mt-5 p-0">
				<h3 class="text-center text-3xl font-bold mb-4">
					<?php echo form_label('Ajoutez un joystick : ', 'joystick'); ?>
				</h3>
			</td>
		</tr>
		<tr class="">
			<td class="">
				<!-- Champ pour le modèle -->
				<?php echo form_input(
					[
						'name' => 'modele',
						'value' => set_value('modele', ''),
						'placeholder' => 'Entrez votre modèle ici...',
						'required' => 'required',
					]
				); ?>
			</td>
		</tr>
		<tr>
			<td class="">
				<!-- Champ pour la couleur -->
				<?php echo form_input(
					[
						'type' => 'color', // Définit le champ comme un sélecteur de couleur
						'name' => 'couleur',
						'value' => set_value('couleur', '#000000'), // Valeur par défaut (noir)
						'required' => 'required',
					]
				); ?>
			</td>
		</tr>
		<tr>
			<td class="">
				<!-- Bouton d'enregistrement -->
				<?php echo form_submit('submit', 'Enregistrer', "class='bouton'"); ?>
			</td>
		</tr>
	</tbody>
</table>
<p class=""><?= validation_show_error('texte_joystick') ?></p>

<?php echo form_close(); ?>

	<!-- Grille des joysticks -->
	<h3 class="text-center text-3xl font-bold mb-4">Liste des joysticks</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- joystick -->
		<?php if (!empty($joysticks)) : ?>
			<?php foreach($joysticks as $joystick) : ?>
				<?php // var_dump($joystick)  ?>
				<div class="border-b-2 border-white/50 p-4 bg-[#161c2d]1" id="div-joystick-<?= $joystick->id ?>">
					<div class="w-[25w] h-[30px] flex items-center justify-start"> <h3 class="text-lg font-bold pr-4"><?= $joystick->modele  ?></h3> </div>
					<div 
						class="w-6 h-6 rounded-full border-2 border-black" 
						style="background-color: <?= $joystick->couleur ?>;"
						title="Couleur : <?= $joystick->couleur ?>">
					</div>
					<div class="w-[45vw] h-[30px] flex items-center justify-start">
						<!-- Formulaire pour supprimer la joystick -->
						<?php echo form_open('/admin/joystick/delete', ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce joystick ?")']); ?>
							<?php echo form_hidden('id', $joystick->id); ?>
							<?php echo form_submit('delete', 'Supprimer', "class='text-red-600 hover:text-red-800 font-bold'"); ?>
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
<?= view('commun/footer') ?>