<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>inscription</title>
</head>

<body>
	<h1>Formulaire d'inscription</h1>


	<!-- Connexion form -->
	<form action="<?= base_url('inscription') ?>" method="post">
		<!-- Email field -->
		<?php if ($validation->hasError('email')): ?>
			<p><?= esc($validation->getError('email')) ?></p>
		<?php endif; ?>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required maxlength="255">
		<br><br>

		<!-- Password field -->
		<?php if ($validation->hasError('mdp')): ?>
			<p><?= esc($validation->getError('mdp')) ?></p>
		<?php endif; ?>
		<label for="mdp">Password:</label>
		<input type="password" id="mdp" name="mdp" required maxlength="255" minlength="8">
		<br><br>

		<!-- Submit button -->
		<button type="submit">Submit</button>
	</form>
</body>

</html>