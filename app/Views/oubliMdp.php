<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/assets/css/forgot.css" rel="stylesheet" type="text/css">
	<title>Mot de passe oublié</title>
</head>

<body>

	<form action="/connexion/oubli-mdp" method="post">
		<h3>Mot de passe oublié</h3>
		<label for="email">E-mail :</label>
		<input type="email" name="email" id="email" required>
		<br>
		<button type="submit">Envoyer le lien de réinitialisation</button>
	</form>
</body>

</html>