<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($themes)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">configuration des theme</h2>

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
	<?php echo form_open('/admin/theme'); ?>

		<table class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto flex items-center justify-start">
			<tbody>
				<tr>
					<td colspan=2 class="mt-5 p-0"><h3 class="text-center text-3xl font-bold mb-4"><?php echo form_label('Ajoutez un thème : ', 'theme'); ?></h3></td>
				</tr>
				<tr class="">
					<td class=""> 	
						<?php echo form_input(
							[
								'name' => 'nom',
								'value' => set_value('nom', ''),
								'placeholder' => 'Entrez votre thème ici...',
								'required' => 'required',
							]);
						?>
					</td>
					<td class="">
						<?php echo form_submit('submit', 'Enregistrer',"class='bouton'"); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<p class=""><?= validation_show_error('texte_theme') ?></p>

	<?php echo form_close(); ?>

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
							<?php echo form_submit('delete', 'Supprimer', "class='text-red-600 hover:text-red-800 font-bold'"); ?>
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