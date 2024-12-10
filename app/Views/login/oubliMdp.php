<?= view('commun/header', ['titre' => $titre]) ?>
<?= form_open('/connexion/oubli-mdp', ['class' => 'my-20 max-w-screen-md border border-gray-500 px-5 shadow-xl mx-4 rounded-xl py-5 md:mx-auto bg-gray-800']) ?>
<div class="flex flex-col border-b border-gray-400 py-6 sm:flex-row sm:items-start">
	<div class="shrink-0 mr-auto sm:py-3">
		<p class="text-3xl font-extrabold">Réinitialisation du mot de passe</p>
		<p class="text-medium px-2 mt-2 text-gray-400">Renseignez votre email</p>
	</div>

	
</div>

<div class="flex flex-col gap-2 md:gap-4 border-b border-gray-400 py-6 sm:flex-row">
	<?= form_label('Email', 'email', ['class' => 'shrink-0 w-32 font-medium pl-2']); ?>

	<?php
	$focusRIng = (validation_show_error('email')) ? 'border-red-600 focus:ring-red-500' : 'border border-gray-500 focus:ring-green-500';
	echo form_input([
		'name' => 'email',
		'id' => 'email',
		'class' => 'w-full rounded-md text-sm bg-gray-700 px-2 py-2 outline-none focus:ring-2 ' . $focusRIng,
		'value' => set_value('email'),
		'placeholder' => 'Email@domaine.fr',
	]); ?>
	<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
		<?= validation_show_error('email') ?>
		
	</span>
	<?= form_submit('submit', 'Envoyer', "class='hidden rounded-lg border-2 border-transparent bg-green-600 hover:bg-green-500/60 px-4 py-2 font-medium text-white sm:inline outline-green-600 focus:ring'"); ?>
</div>

<div class="items-center gap-2 md:gap-4 pt-7 pb-2 sm:flex-row"> 
<?php if (session()->getFlashdata('success')): ?>
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
</div>

<div class="flex justify-end py-4 sm:hidden">

	<?= form_submit('submit', 'Envoyer le mail de réinitialisation de mot de passe', "class='rounded-lg border-2 border-transparent bg-green-600 hover:bg-green-500/60 px-4 py-2 font-medium text-white outline-green-600 focus:ring'"); ?>
</div>
<?= form_close() ?>
<?= view('commun/footer') ?>