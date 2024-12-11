<?= view('commun/header', ['titre' => $titre]) ?>
<?= form_open('/profile', ['class' => 'my-20 max-w-screen-md border border-gray-500 px-5 shadow-xl mx-4 rounded-xl py-5 md:mx-auto bg-gray-800']) ?>
    <div class="flex flex-col border-b border-gray-400 py-6 sm:flex-row sm:items-start">
        <div class="shrink-0 mr-auto sm:py-3">
            <p class="text-3xl font-extrabold">Détails du compte</p>
            <p class="text-medium px-2 mt-2 text-gray-400">Modifier vos informations</p>
        </div>
        <a href="/deconnexion" class="mr-2 hidden rounded-lg border-2 px-4 py-2 font-medium border-gray-700 text-gray-400 hover:text-red-500 sm:inline outline-red-900 focus:ring hover:bg-gray-700">Se déconnecter</a>
		<?= form_submit('submit', 'Enregistrer', "class='hidden rounded-lg border-2 border-transparent bg-green-600 hover:bg-green-500/60 px-4 py-2 font-medium text-white sm:inline outline-green-600 focus:ring'"); ?>
    </div>

    <div class="flex flex-col gap-2 md:gap-4 border-b border-gray-400 py-6 sm:flex-row">
        <?= form_label('Email <span class="text-green-500/30">(*)</span>', 'email', ['class' => 'shrink-0 w-32 font-medium pl-2']); ?>

        <?php
        $focusRIng = isset($erreurs['email']) ? 'border-red-600 focus:ring-2 focus:ring-red-500' : 'border-gray-600 focus:ring-2 focus:ring-green-600';
        echo form_input([
            'name'        => 'email',
            'id'          => 'email',
            'class'       => 'w-full rounded-md text-sm bg-gray-700 px-2 py-2 border focus:outline-none '.$focusRIng,
            'value'       => set_value('email', session()->get('user')['email']),
            'placeholder' => 'Email@domaine.fr',
		]); ?>

        <!-- Affichage du message d'erreur -->
        <?php if (isset($erreurs['email'])) : ?>
            <span class="font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $erreurs['email'] ?>
            </span>
        <?php endif; ?>
    </div>
    
    <div class="flex flex-col gap-2 md:gap-4 pt-7 pb-2 sm:flex-row">
        <?= form_label('Mot de passe', 'mdp', ['class' => 'shrink-0 w-32 font-medium pl-2']); ?>

        <?php
        // Vérifie s'il y a une erreur sur le champ 'mdp'
        $focusRIng = validation_show_error('mdp') ? 'border-red-600 focus:ring-2 focus:ring-red-500' : 'border-gray-600 focus:ring-2 focus:ring-green-600';

        // Affiche le champ input avec la classe dynamique
        echo form_input([
            'name'        => 'mdp',
            'id'          => 'mdp',
            'class'       => 'w-full rounded-md text-sm bg-gray-700 px-2 py-2 border focus:outline-none ' . $focusRIng,
            'value'       => set_value('mdp'),
            'placeholder' => 'Nouveau mot de passe',
        ]);
        ?>

        <!-- Affichage du message d'erreur -->
        <?php if (validation_show_error('mdp')) : ?>
            <span class="font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= validation_show_error('mdp') ?>
            </span>
        <?php endif; ?>
    </div>


    <div class="flex flex-col gap-2 md:gap-4 py-2 sm:flex-row">
        <?= form_label('Confirmation', 'mdpConf', ['class' => 'shrink-0 w-32 font-medium pl-2']); ?>

        <?php
        $focusRIng = isset($erreurs['mdpConf']) ? 'border-red-600 focus:ring-2 focus:ring-red-500' : 'border-gray-600 focus:ring-2 focus:ring-green-600';
        echo form_input([
            'name'        => 'mdpConf',
            'id'          => 'mdpConf',
            'type'        => 'password',
            'class'       => 'w-full rounded-md text-sm bg-gray-700 px-2 py-2 border focus:outline-none '.$focusRIng,
            'value'       => set_value('mdpConf'),
            'placeholder' => 'Confirmation du mot de passe',
		]); ?>
        <span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
            <?= validation_show_error('mdpConf') ?>
        </span>
    </div>
    
    <div class="flex justify-end py-4 sm:hidden">
        <a href="/profile/delete-<?= session()->get('user')['id'] ?>" class="mr-2 rounded-lg border-2 px-4 py-2 font-medium border-gray-700 text-gray-400 hover:text-red-500 outline-red-900 focus:ring hover:bg-gray-700">Se déconnecter</a>
		<?= form_submit('submit', 'Enregistrer', "class='rounded-lg border-2 border-transparent bg-green-600 hover:bg-green-500/60 px-4 py-2 font-medium text-white outline-green-600 focus:ring'"); ?>
    </div>
<?= form_close() ?>
<?= view('commun/footer') ?>