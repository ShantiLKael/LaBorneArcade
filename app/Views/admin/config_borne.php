<?= view('commun/headerAdmin', ['titre' => $titre]) ?>
<div id="main-content" class=" p-8 w-full ">
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

	<!-- Section de sélection -->
	<section id="section"  class="container px-5 py-16 mx-auto bg-medium-blue rounded-xl ">
		<?php echo form_open('/admin/bornes', ['enctype' => 'multipart/form-data']); ?>
		<div class="px-0 md:px-20">
		<!-- Séléction du produit principal -->
		<div class="flex flex-col md:flex-row gap-8 items-start">

			<!-- Images du produit -->
			<div class="w-full md:w-1/2 lg:w-7/12">
				<?= form_input([
						'type' => 'file',
						'name' => 'id_image',
						'id'   => 'images',
						'class'=> 'bg-gray-900 rounded-lg border px-2 py-2 mb-2 focus:outline-none focus:ring-2 text-lg font-bold text-gray-100',
						'aria-required' => 'true',
						'required' => true,
						'multiple' => true,
					])
				?>
			</div>

			<!-- Informations produit -->
			<div class="flex-1">
				<?= form_label('Nom de la borne <span class="text-green-500/30">(*)</span>', 'email', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
				<?php
					$focusRIng = (validation_show_error('nom')) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-green-500';
					echo form_input([
					'name'          => 'nom',
					'id'            => 'nom',
					'class'         => 'w-full bg-gray-900 rounded-lg border px-2 py-2 mb-2 focus:outline-none focus:ring-2 text-xl md:text-2xl md:text-2xl font-bold text-gray-100 '. $focusRIng,
					'value'         => set_value('nom'),
					'aria-required' => 'true',
					'required'
				])
				?>
				
				<div class="py-5 flex">
					<?= form_label('Prix <span class="text-green-500/30">(*)</span>', 'email', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
					<?php
						$focusRIng = (validation_show_error('prix')) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-green-500';
						echo form_input([
						'name'          => 'prix',
						'id'            => 'prix',
						'type'          => 'number',
						'min'           => 0,
						'class'         => 'w-full bg-gray-900 rounded-lg border mx-5 my-2 pl-2 mb-2 focus:outline-none focus:ring-2 text-lg md:text-xl md:text-2xl font-bold text-green-400 '. $focusRIng,
						'value'         => set_value('prix'),
						'aria-required' => 'true',
						'required'
					])
					?>
					<p class="py-2 text-green-400 text-xl md:text-2xl font-bold mb-4">€</p>
				</div>

				<!-- Contenu de la borne -->
				<div class="bg-gradient-to-r from-dark-blue max-w-100 to-dark-teal p-4 rounded md:mb-2 mb-10">
						<?= form_label('Description <span class="text-green-500/30">(*)</span>', 'message', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
						<?php
						$focusRIng = (validation_show_error('description')) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-green-500';
						echo form_textarea([
							'name'          => 'description',
							'id'            => 'description',
							'rows'          => '4',
							'class'         => 'w-full bg-gray-900 text-gray-300 text-xs rounded-lg border px-4 py-2 mb-2 focus:outline-none focus:ring-2 '.$focusRIng,
							'value'         => set_value('description'),
							'aria-required' => 'true',
							'required'
						]); ?>
					<p class="mt-4">Livrée sur rendez-vous en 3/4 semaines</p>
				</div>

				<!-- Boutons -->
				<div class="text-center md:flex md:items-center gap-4">
					<?= form_submit('submit', 'Enregistrer la borne', "class='bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 my-5 mb-8 rounded-3xl cursor-pointer'"); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Séléction des options -->
	<div class="px-0 md:px-20">
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Options</h2>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
			<?php foreach($options as $option) : ?>
				<div class="relative min-w-[300px] sm:min-w-[350px] md:min-w-[400px] bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-gray-900 shadow-md hover:shadow-lg ease-in-out flex-shrink-0">
					<input type="checkbox" id="option-<?= $option->id ?>" name="idOptions[]" value="<?= $option->id ?>" class="absolute top-3 right-3 w-6 h-6 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
					<img loading="lazy" src="" alt="Option <?= $option->nom ?>" class="w-full h-64 object-cover">
					<div class="p-4">
						<p class="text-green-400 text-lg font-bold mb-2"><?= $option->cout ?> €</p>
						<h3 class="font-bold text-lg text-left mb-2"><?= $option->nom ?></h3>
						<p class="text-left text-sm text-gray-300"><?= $option->description ?>.</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- Séléction Matière -->
	<div class="px-0 md:px-20">
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Matière <span class="text-green-500/30">(*)</span></h2>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['id_matiere']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
			<?php foreach($matieres as $matiere) : ?>
				<div class="relative flex items-center justify-between w-52 h-24 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['id_matiere']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 p-4 ease-in-out">
					<input type="checkbox" id="matiere-<?= $matiere->id ?>" name="id_matiere" value="<?= $matiere->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
					<div class="text-lg font-medium text-gray-300 font-bold text-center"> <?= $matiere->nom ?> </div>
					<div style="background-color: #<?= $matiere->couleur ?>;" class="h-1/4"></div>
				</div>
			<?php endforeach; ?>
			
			<!-- Ajouter Matière -->
			<div class="relative flex items-center justify-center w-52 h-24 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<a href="/admin/matiere" class="flex items-center justify-center w-12 h-12 bg-gray-600 hover:bg-green-600 text-white text-3xl font-bold rounded-full shadow-md transition duration-300 ease-in-out cursor-pointer">
					<svg class="w-8 h-8 text-gray-300 hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
					</svg>
				</a>
			</div>
		</div>
	</div>

	<!-- Sélection thème -->
	<div class="px-0 md:px-20">
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Thème <span class="text-green-500/30">(*)</span></h2>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['id_matiere']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
			<?php foreach($themes as $theme) : ?>
				<div class="relative flex items-center justify-between w-52 h-24 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700  shadow-md shadow-gray-900 p-4 ease-in-out">
					<input type="radio" id="matiere-<?= $theme->id ?>" name="id_theme" value="<?= $theme->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
					<div class="text-lg font-medium text-gray-300 font-bold text-center"> <?= $theme->nom ?> </div>
				</div>
			<?php endforeach; ?>

			<!-- Ajouter thème -->
			<div class="relative flex items-center justify-center w-52 h-24 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<a href="/admin/theme" class="flex items-center justify-center w-12 h-12 bg-gray-600 hover:bg-green-600 text-white text-3xl font-bold rounded-full shadow-md transition duration-300 ease-in-out cursor-pointer">
					<svg class="w-8 h-8 text-gray-300 hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
					</svg>
				</a>
			</div>
		</div>
	</div>

	<!-- Séléction T-Molding -->
	<div class="px-0 md:px-20">
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">T-Molding <span class="text-green-500/30">(*)</span></h2>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['id_tmolding']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
		<?php foreach($tmoldings as $tmolding) : ?>
			<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['id_tmolding']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
				<input type="checkbox" id="tmodling-<?= $tmolding->id ?>" name="id_tmolding" value="<?= $tmolding->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				<img src="" alt="T-Molding <?= $tmolding->nom ?>" class="w-full h-5/6 object-cover" />
				<div class="text-lg font-medium text-gray-300 font-bold text-center"> <?= $tmolding->nom ?> </div>
				<div style="background-color: #<?= $tmolding->couleur ?>;" class="h-1/4"></div>
			</div>
		<?php endforeach; ?>

			<!-- Ajouter T-Molding -->
			<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<div class="flex items-center justify-center w-24 h-24 bg-gray-600 hover:bg-green-600 text-white text-5xl font-bold rounded-full shadow-md transition duration-300 ease-in-out cursor-pointer">
				<a href="/admin/TMolding">
					<svg class="w-24 h-24 text-gray-300 hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
					</svg>
				</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Séléction des joysticks -->
	<div class="px-0 md:px-20">
		<div class="flex items-center justify-between">
		<!-- Nom du modèle -->
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Joystick <span class="text-green-500/30">(*)</span></h2>
		<!-- Sélecteur du modèle -->
		<div class="w-full max-w-sm min-w-[200px]">
			<div class="relative">
				<select id="selection-joysticks" class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease focus:border-b focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md appearance-none cursor-pointer">
					<option class="bg-deep-blue" value="Tous" selected>Tous les joysticks</option>
				</select>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-500">
					<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
				</svg>
			</div>
		</div>
		</div>

		<!-- Liste des joysticks -->
		<div id="liste-joysticks" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['joystick']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
			<?php foreach($joysticks as $joystick) : ?>
			<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['joystick']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out flex-shrink-0">
				<!-- Checkbox -->
				<input type="checkbox" id="joystick-<?= $joystick->id ?>" data-model="<?= $joystick->modele ?>" data-color="#<?= $joystick->couleur ?>" name="joystick" value="<?= $joystick->id ?>" class="absolute top-3 right-3 w-5 h-5 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				
				<!-- Image -->
				<img loading="lazy" src="" alt="Joystick <?= htmlspecialchars($joystick->modele) ?>" class="w-full h-4/6 md:h-5/6 object-cover">

				<!-- Nom et couleur -->
				<div class="p-4 flex items-center justify-between">
					<!-- Nom du modèle -->
					<h3 class="font-bold text-base text-white"><?= $joystick->modele ?></h3>
					
					<!-- Rond de couleur -->
					<div
						style="background-color: #<?= $joystick->couleur ?>;"
						class="w-6 h-6 rounded-full border border-gray-300">
					</div>
				</div>
			</div>
			<?php endforeach; ?>

			<!-- Ajouter Joystick -->
			<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<div class="flex items-center justify-center w-24 h-24 bg-gray-600 hover:bg-green-600 text-white text-5xl font-bold rounded-full shadow-md transition duration-300 ease-in-out cursor-pointer">
				<a href="/admin/joystick">
					<svg class="w-24 h-24 text-gray-300 hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
					</svg>
				</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Séléction Boutons -->
	<div class="px-0 md:px-20">
		<div class="flex items-center justify-between">
			<!-- Nom du modèle -->
			<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Bouton <span class="text-green-500/30">(*)</span></h2>
			<!-- Sélecteur du modèle -->
			<div class="w-full max-w-sm min-w-[200px]">
				<div class="relative">
					<select id="selection-boutons" class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease focus:border-b focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md appearance-none cursor-pointer">
						<option class="bg-deep-blue" value="Tous" selected>Tous les boutons</option>
					</select>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-500">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
					</svg>
				</div>
			</div>
		</div>
		<div id="liste-boutons" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['bouton']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
		<?php foreach($boutons as $bouton) : ?>
			<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['bouton']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
				<input type="checkbox" id="bouton-<?= $bouton->id ?>" data-forme="<?= $bouton->forme ?>" data-model="<?= $bouton->modele ?>" data-color="#<?= $bouton->couleur ?>" name="bouton" value="<?= $bouton->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				<img src="" alt="Boutons <?= $bouton->modele ?>" class="w-full h-5/6 object-cover" />
				<div style="background-color: #<?= $bouton->couleur ?>;" class="h-1/4"></div>
			</div>
		<?php endforeach; ?>
		
			<!-- Ajouter Boutons -->
			<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<div class="flex items-center justify-center w-24 h-24 bg-gray-600 hover:bg-green-600 text-white text-5xl font-bold rounded-full shadow-md transition duration-300 ease-in-out cursor-pointer">
					<a href="/admin/bouton">
						<svg class="w-24 h-24 text-gray-300 hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?=  form_close() ?>
	<div class="px-0 md:px-20 mx-auto my-16">
		<div type="hidden" id="bouton-borneperso"></div>

		<!-- Ligne contenant "Aperçu des touches" et le formulaire -->
		<div class="flex flex-wrap md:flex-nowrap items-center justify-between">
			<!-- Titre -->
			<div class="flex items-center">
				<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-200">Aperçu des touches</h2>
			</div>

			<!-- Formulaire -->
			<?= form_open('/admin/bornes', ['class' => 'flex flex-col md:flex-row md:items-center md:space-x-4 w-full md:w-auto']) ?>
				<!-- Input pour le nombre de joueurs -->
				<div class="flex flex-col items-start w-full md:w-auto mb-4 md:mb-0">
					<?= form_label('Nombre de joueurs', 'nbJoueurs', ['class' => 'pl-2 md:pl-0 text-sm mb-2 font-medium text-gray-300']); ?>
					<?= form_input([
						'name'        => 'nbJoueurs',
						'id'          => 'nbJoueurs',
						'type'        => 'number',
						'min'         => 1,
						'max'         => 2,
						'class'       => 'text-slate-400 w-full md:w-24 px-3 py-2 border border-gray-600 rounded-md text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400',
						'value'       => set_value('nbJoueurs', '2'), // Valeur par défaut
						'placeholder' => '1 - 2',
						'required'
					]); ?>
				</div>

				<!-- Input pour le nombre de boutons -->
				<div class="flex flex-col items-start w-full md:w-auto mb-4 md:mb-0">
					<?= form_label('Nombre de boutons', 'nbBoutons', ['class' => 'pl-2 md:pl-0 text-sm mb-2 font-medium text-gray-300']); ?>
					<?= form_input([
						'name'        => 'nbBoutons',
						'id'          => 'nbBoutons',
						'type'        => 'number',
						'min'         => 0,
						'max'         => 9,
						'class'       => 'text-slate-400 w-full md:w-24 px-3 py-2 border border-gray-600 rounded-md text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400',
						'value'       => set_value('nbBoutons', '6'), // Valeur par défaut
						'placeholder' => '0 - 9',
						'required'
					]); ?>
				</div>

				<!-- Bouton Configurer -->
				<div class="w-full md:w-auto">
					<?= form_submit('submit', 'Configurer la disposition', "class='bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-3xl cursor-pointer w-full md:w-auto'"); ?>
				</div>
		</div>
		<?= form_close() ?>

		<div class="text-lg text-gray-300 flex items-center">
			<p>
				La dispositions et couleurs des joysticks et boutons seront la même pour les tous les joueurs.
				Pour nos bornes d'arcades à 2 joueurs, nous vous ajoutons 2 boutons en plus pour choisir le mode ! (1J - 2J) 
			</p>
		</div>

		<!-- Espacement entre le haut et le canvas -->
		<div class="mt-10">
			<canvas class="border rounded-md border-deep-blue shadow-lg" id="persoBorne" tabindex="0"></canvas>
		</div>
	</div>
	</section>
</div>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<script>
	// Initialize CKEditor
	CKEDITOR.replace('description', {
		height: 300,
		toolbar: [
			['Bold', 'Italic', 'Underline', '-', 'Link', 'Unlink'],
			['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
			['Undo', 'Redo']
		],
		versionCheck: false
	});
</script>
<script>
	const boutons   = <?= json_encode($boutons); ?>;
	const joysticks = <?= json_encode($joysticks); ?>;
	const boutonsBorne   = <?= isset($borne) ? json_encode($borne->boutons) : json_encode(null); ?>;
	const joysticksBorne = <?= isset($borne) ? json_encode($borne->joysticks) : json_encode(null); ?>;
	const affichageUniquement = false;

	let nbJoueur = <?= $nbJoueurs ?>;
	let nbBoutonParJoueur = <?= $nbBoutons ?>;
</script>
<script src="/assets/js/canva-boutons.js"></script>
<script src="/assets/js/filtre-bouton-joystick.js"></script>
<script src="/assets/js/check-option-animation.js"></script>
<?= view('commun/footer', ['confiance' => false, 'adminMode' => true]) ?>