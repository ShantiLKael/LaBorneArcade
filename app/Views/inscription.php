<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <h1>Formulaire d'inscription</h1>

    <!-- Affichage des erreurs de validation globales -->
    <?php if (isset($validation)): ?>
        <?php if ($validation->hasError('email')): ?>
            <p style="color: red;"><?= esc($validation->getError('email')) ?></p>
        <?php endif; ?>

        <?php if ($validation->hasError('mdp')): ?>
            <p style="color: red;"><?= esc($validation->getError('mdp')) ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Formulaire d'inscription -->
    <form action="<?= base_url('inscription') ?>" method="post">
        <!-- Champ Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>" required maxlength="255">
        <br><br>

        <!-- Champ Mot de passe -->
        <label for="mdp">Mot de passe:</label>
        <input type="password" id="mdp" name="mdp" value="<?= old('mdp') ?>" required minlength="8" maxlength="255">
        <br><br>

        <!-- Champ de confirmation du mot de passe -->
        <label for="mdp_confirm">Confirmer le mot de passe:</label>
        <input type="password" id="mdp_confirm" name="mdp_confirm" required minlength="8" maxlength="255">
        <br><br>

        <!-- Affichage des erreurs pour la confirmation du mot de passe -->
        <?php if (isset($validation) && $validation->hasError('mdp_confirm')): ?>
            <p style="color: red;"><?= esc($validation->getError('mdp_confirm')) ?></p>
        <?php endif; ?>

        <!-- Bouton de soumission -->
        <button type="submit">S'inscrire</button>
    </form>

</body>

</html>
