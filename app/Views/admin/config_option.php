	<?= view('commun/header', ['titre' => $titre]) ?>
	<?php // var_dump($options)  ?>
	<div class="text-white py-12 px-6">
		<!-- Titre principal -->
		<h2 class="text-center text-3xl font-bold mb-4">configuration des option</h2>

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
		<?php echo form_open('/admin/option'); ?>

			<table class="grid grid-cols-1 md:grid-cols-1 gap-6 max-w-3xl mx-auto flex items-center justify-start">
			<tbody>
				<tr>
					<td colspan=2 class="mt-5 p-0">
						<h3 class="text-center text-3xl font-bold mb-4">
							<?php echo form_label('Ajoutez une option : ', 'option'); ?>
						</h3>
					</td>
				</tr>
				<tr class="">
					<td class="">
						<!-- Champ pour le nom -->
						<?php echo form_input(
							[
								'name' => 'nom',
								'value' => set_value('nom', ''),
								'placeholder' => 'Entrez votre nom d\'option ici...',
								'required' => 'required',
							]
						); ?>
					</td>
				</tr>
				<tr>
					<td class="">
						<!-- Champ pour la description -->
						<?php echo form_input(
							[
                                'type' => 'text',
								'name' => 'description',
								'value' => set_value('description', ''),
								'placeholder' => 'Entrez la description ici...',
								'required' => 'required',
							]
						); ?>
					</td>
				</tr>
				<tr>
					<td class="">
						<!-- Champ pour le coût (nombre avec flèches) -->
						<?php echo form_input(
							[
								'type' => 'number', // Définit le champ comme un champ numérique
								'name' => 'cout',
								'value' => set_value('cout', ''),
								'placeholder' => 'Entrez le coût ici...',
								'required' => 'required',
								'min' => '0', // Limite minimale (peut être ajustée selon vos besoins)
								'step' => '1', // Incrément ou décrément par pas de 1
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
		<p class=""><?= validation_show_error('texte_option') ?></p>

		<?php echo form_close(); ?>

		<!-- Grille des options -->
		<h3 class="text-center text-3xl font-bold mb-4">Liste des options</h3>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
		<!-- option -->
			<?php if (!empty($options)) : ?>
				<?php foreach($options as $option) : ?>
					<?php // var_dump($option)  ?>
					<div class="border-b-2 border-white/50 p-4 bg-[#161c2d]1" id="div-option-<?= $option->id ?>">
						<div class="w-[15vw] h-[30px] flex items-center justify-start"> <h3 class="text-lg font-bold pr-4"><?= $option->nom ?></h3> </div>
						<div class="w-[25vw] h-[30px] flex items-center justify-start"> <h4 class="text-lg font-bold pr-4"><?= $option->description  ?></h4> </div>
						<div class="w-[35vw] h-[30px] flex items-center justify-start"> <h4 class="text-lg font-bold pr-4"><?= $option->cout  ?></h4> </div>
						<div class="w-[45vw] h-[30px] flex items-center justify-start">
							<!-- Formulaire pour supprimer la option -->
							<?php echo form_open('/admin/option/delete', ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer cette option ?")']); ?>
								<?php echo form_hidden('id', $option->id); ?>
								<?php echo form_submit('delete', 'Supprimer', "class='text-red-600 hover:text-red-800 font-bold'"); ?>
							<?php echo form_close(); ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<p class="p-4">Aucune option disponible pour le moment.</p>
			<?php endif; ?>
		</div><br>
	</div>
	<script src="./assets/js/btn-faq.js">
	</script>
	<?= view('commun/footer') ?>