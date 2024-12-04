<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Connexion</title>
</head>

<body>
	<h1>Formulaire de connexion</h1>

	<!-- Affichage des erreurs globales (Email introuvable, Mot de passe incorrect, etc.) -->
	<?php if (session()->getFlashdata('error')): ?>
		<p style="color: red;"><?= session()->getFlashdata('error') ?></p>
	<?php endif; ?>

	<!-- Formulaire de connexion -->
	<form action="<?= base_url('connexion') ?>" method="post">
		<!-- Email -->
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?= old('email') ?>" required maxlength="255">
		<!-- Affichage de l'erreur pour l'email -->
		<?php if (isset($validation) && $validation->hasError('email')): ?>
			<p style="color: red;"><?= esc($validation->getError('email')) ?></p>
		<?php endif; ?>
		<br><br>

		<!-- Mot de passe -->
		<label for="mdp">Mot de passe:</label>
		<input type="password" id="mdp" name="mdp" value="<?= old('mdp') ?>" required maxlength="255" minlength="8">
		<!-- Affichage de l'erreur pour le mot de passe -->
		<?php if (isset($validation) && $validation->hasError('mdp')): ?>
			<p style="color: red;"><?= esc($validation->getError('mdp')) ?></p>
		<?php endif; ?>
		<br><br>

		<!-- Bouton de soumission -->
		<button type="submit">Se connecter</button>
	</form>

</body>

</html>