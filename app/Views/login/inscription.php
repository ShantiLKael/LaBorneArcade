<?= view('commun/header', ['titre' => $titre]) ?>
<section>
	<div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
		<div class="grid md:grid-cols-2 items-center gap-4 max-w-6xl w-full">
		<div class="bg-gray-800 border border-gray-600 rounded-lg p-6 max-w-md max-md:mx-auto">
		<?= form_open('/inscription') ?>
			<div class="mb-10">
				<h3 class="text-gray-300 text-3xl font-extrabold">Créer votre compte !</h3>
			</div>

			<div class="mb-5">
				<?= form_label('Email', 'email', ['class' => 'text-sm block font-medium mb-1 ml-1']); ?>
				<div class="relative flex items-center">
					<?php
					$focusRIng = isset($erreurs['email']) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-2 focus:ring-green-600';
					echo form_input([
						'name'          => 'email',
						'id'            => 'email',
						'class'         => 'w-full text-sm bg-gray-700 border border-gray-300 px-4 py-3 rounded-lg outline-green-600 focus:outline-none focus:ring-2 '.$focusRIng,
						'value'         => set_value('email'),
            			'placeholder'   => 'Email@domaine.fr',
						'aria-required' => 'true',
						'type'          => 'text',
						'required'
					]); ?>
					<svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
						<circle cx="10" cy="7" r="6" data-original="#000000"></circle>
						<path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
					</svg>

				</div>

				<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
					<?php if(isset($erreurs['email'])) echo $erreurs['email'] ?>
				</span>
			</div>

			<div class="mb-5">
				<?= form_label('Mot de passe', 'mdp', ['class' => 'text-sm block font-medium mb-1 ml-1']); ?>
				<div class="relative flex items-center">
					<?php
					$focusRIng = isset($erreurs['mdp']) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-2 focus:ring-green-600';
					echo form_input([
						'name'          => 'mdp',
						'id'            => 'mdp',
						'class'         => 'w-full text-sm bg-gray-700 border border-gray-300 px-4 py-3 rounded-lg outline-green-600 focus:outline-none focus:ring-2 '.$focusRIng,
						'value'         => set_value('mdp'),
            			'placeholder'   => 'Mot de passe',
						'type'          => 'password',
						'aria-required' => 'true',
						'required'
					]); ?>
					<svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 128 128">
						<path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
					</svg>
				</div>
				<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
					<?php if(isset($erreurs['mdp'])) echo $erreurs['mdp'] ?>
				</span>
			</div>

			<div class="mb-5">
				<?= form_label('Confirmation du mot de passe', 'mdpConf', ['class' => 'text-sm block font-medium mb-1 ml-1']); ?>
				<div class="relative flex items-center">
					<?php
					$focusRIng = isset($erreurs['mdpConf']) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-2 focus:ring-green-600';
					echo form_input([
						'name'          => 'mdpConf',
						'id'            => 'mdpConf',
						'class'         => 'w-full text-sm bg-gray-700 border border-gray-300 px-4 py-3 rounded-lg outline-green-600 focus:outline-none focus:ring-2 '.$focusRIng,
						'value'         => set_value('mdpConf'),
            			'placeholder'   => 'Confirmation du mot de passe',
						'type'          => 'password',
						'aria-required' => 'true',
						'required'
					]); ?>
				</div>
				<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
					<?php if(isset($erreurs['mdpConf'])) echo $erreurs['mdpConf'] ?>
				</span>
			</div>

			<div class="!mt-8">
				<?= form_submit('submit', 'Créer son compte', "class='w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-green-600 hover:bg-green-500/60 focus:outline-none cursor-pointer'"); ?>
			</div>

			<p class="text-sm !mt-8 text-center text-gray-400">Vous avez déjà un compte ? <a href="/connexion" class="text-green-600 hover:text-green-500 font-semibold hover:underline ml-1 whitespace-nowrap">Connectez vous !</a></p>
		<?= form_close() ?>
		</div>
		<div class="rounded-b-lg max-md:mt-8 bg-gradient-to-r from-green-800/70 to-medium-blue">
			<div class="px-4 py-6 text-white md:mx-6 md:p-12">
				<h4 class="mb-2 text-2xl font-semibold">
                Bienvenue sur La Borne d'Arcade
				</h4>
				<p class="text-sm">
					Arcade jeux Borne de jeux vintage personnalisée intégralement votre borne d'arcade retro. 
					Nos bornes arcade jeux retro vintage multi jeux made in France. 
					Délai de 3 à 4 semaines.<br>
				</p>
				<p class="mt-5 text-lg font-semibold bold">Conseil, suivi, fiabilité.</p>
			</div>
		</div>
		</div>
	</div>
</section>
<?= view('commun/footer') ?>
