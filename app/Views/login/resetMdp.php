<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<?= form_open("/connexion/oubli-mdp/$token", ['class' => 'my-20 max-w-screen-md border border-gray-500 px-5 shadow-xl mx-4 rounded-xl py-5 md:mx-auto bg-gray-800']) ?>
<div class="flex flex-col border-b border-gray-400 py-6 sm:flex-row sm:items-start">
	<div class="shrink-0 mr-auto sm:py-3">
		<p class="text-3xl font-extrabold">Reinitialisation mot de passe</p>
		<p class="text-medium px-2 mt-2 text-gray-400">Modifier vos informations</p>
	</div>
	<?= form_submit('submit', 'Enregistrer', "class='hidden rounded-lg border-2 border-transparent bg-green-600 hover:bg-green-500/60 px-4 py-2 font-medium text-white sm:inline outline-green-600 focus:ring'"); ?>
</div>

<div class="flex flex-col gap-2 md:gap-4 pt-7 pb-2 sm:flex-row">
	<?= form_label('Mot de passe', 'mdp', ['class' => 'shrink-0 w-32 font-medium pl-2']); ?>

	<?php
	$focusRing = (validation_show_error('mdp')) ? 'border-red-600 focus:ring-red-500' : 'border border-gray-500 focus:ring-green-500';
	echo form_input([
		'name' => 'mdp',
		'id' => 'mdp',
		'type' => 'password',
		'class' => 'w-full rounded-md text-sm bg-gray-700 px-2 py-2 outline-none focus:ring-2 ' . $focusRing,
		'value' => set_value('mdp'),
		'placeholder' => 'Nouveau mot de passe',
	]); ?>
	<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
		<?= validation_show_error('mdp') ?>
	</span>
</div>

<div class="flex flex-col gap-2 md:gap-4 py-2 sm:flex-row">
	<?= form_label('Confirmation', 'mdpConf', ['class' => 'shrink-0 w-32 font-medium pl-2']); ?>

	<?php
	$focusRing = (validation_show_error('mdpConf')) ? 'border-red-600 focus:ring-red-500' : 'border border-gray-500 focus:ring-green-500';
	echo form_input([
		'name' => 'mdpConf',
		'id' => 'mdpConf',
		'type' => 'password',
		'class' => 'w-full rounded-md text-sm bg-gray-700 px-2 py-2 outline-none focus:ring-2 ' . $focusRing,
		'value' => set_value('mdpConf'),
		'placeholder' => 'Confirmation du mot de passe',
	]); ?>
	<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
		<?= validation_show_error('mdpConf') ?>
	</span>
</div>


<?= form_close() ?>
<?= view('commun/footer') ?>
