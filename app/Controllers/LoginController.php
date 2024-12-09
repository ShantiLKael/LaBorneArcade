<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Entities\Utilisateur;
use CodeIgniter\Validation\Validation;
use \Config\Services;

class LoginController extends BaseController
{
	/** @var UtilisateurModel $utilisateurModel */
	private UtilisateurModel $utilisateurModel;

	/** @var Validation $validation */
	private Validation $validation;


	public function __construct()
	{
		helper(['form']);
		$this->utilisateurModel = new UtilisateurModel();
		$this->validation = \Config\Services::validation();
	}

	public function inscription()
	{
		if ($this->request->getMethod() === 'GET') {
			// Handle GET request
			return view('login/inscription', ['titre' => 'Créer un compte']);
		}

		$regleValidation = $this->utilisateurModel->getValidationRules();
		$regleValidation['mdpConf'] = 'required_with[mdp]|matches[mdp]';

		$messagesValidation = $this->utilisateurModel->getValidationMessages();
		$messagesValidation['mdpConf'] = [
			'required_with' => 'Champ requis.',
			'matches' => 'Les mots de passe ne correspondent pas.',
		];

		if ($this->validate($regleValidation, $messagesValidation)) {

			$data = $this->request->getPost();
			$utilisateur = new Utilisateur();
			$utilisateur->fill($data);
			$utilisateur->setRole($this->utilisateurModel::$ROLE_UTILISATEUR);

			$this->utilisateurModel->insert($utilisateur);

			return redirect()->to('/connexion');
		} else {
			// Si les règles ne sont pas respectées, renvoi des erreurs de validation
			return view('login/inscription', [
				'titre' => 'Créer un compte',
				'erreurs' => $this->validator->getErrors(),
			]);
		}
	}

	public function connexion()
	{
		$this->utilisateurModel = new UtilisateurModel();

		if ($this->request->getMethod() === 'POST') {
			// Règles de validation pour l'email et le mot de passe
			$rules = [
				'email' => 'required|valid_email',
				'mdp' => 'required|min_length[8]',
			];

			$ruleMessages = [
				'email' => [
					'required' => 'Champ requis.',
					'valid_email' => 'Email invalide.',
				],

				'mdp' => [
					'required' => 'Champ requis.',
					'min_length' => 'Le mot de passe est trop court.',
				],
			];

			// Valider les données d'entrée
			if ($this->validate($rules, $ruleMessages)) {
				// Récupérer les données soumises
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('mdp');

				// Recherche de l'utilisateur dans la base de données
				$user = $this->utilisateurModel->where('email', $email)->first();

				if ($user) {
					// Vérification du mot de passe
					$pass = $user->mdp; // Le mot de passe stocké dans la base de données
					if (password_verify($password, $pass)) {
						// Authentification réussie
						// Stocker l'utilisateur dans la session
						session()->set('user', [
							'id' => $user->id,
							'email' => $user->email,
						]);

						// Rediriger vers la page d'accueil ou le tableau de bord
						return redirect()->to('/');
					} else {
						// Mot de passe incorrect
						return view('login/connexion', [
							'titre' => 'Se connecter',
							'erreurs' => ['mdp' => 'Mot de passe incorrect.'], // Passer les erreurs à la vue
						]);
					}
				} else {
					// L'email n'existe pas
					return view('login/connexion', [
						'titre' => 'Se connecter',
						'erreurs' => ['email' => 'Email introuvable.'], // Passer les erreurs à la vue
					]);
				}
			} else {
				// Si la validation échoue, renvoyer les erreurs
				return view('login/connexion', [
					'titre' => 'Se connecter',
					'erreurs' => $this->validator->getErrors(), // Passer les erreurs à la vue
				]);
			}
		}

		// Affiche la vue pour une requête GET
		return view('login/connexion', ['titre' => 'Se connecter']);
	}

	public function oubliMdp()
	{

		if ($this->request->getMethod() === 'POST') {
			$email = $this->request->getPost('email');
			$userModel = new UtilisateurModel();
			$user = $userModel->where('email', $email)->first();

			if ($user) {
				echo 'Utilisateur trouvé :';
			} else {
				echo 'Utilisateur introuvable pour l\'e-mail : ' . $email;
			}

			echo 'Adresse e-mail soumise : ' . $email;

			if ($user) {
				// Générer un jeton de réinitialisation de MDP et enregistrer-le dans BD
				$token = bin2hex(random_bytes(16));
				$expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
				$userModel->set('token_mdp', $token)
					->set('date_creation_token', $expiration)
					->update($user->id_utilisateur);

				// Envoyer l'e-mail avec le lien de réinitialisation Message très basique
				$resetLink = site_url("connexion/oubli-mdp/$token");

				//envoi du mailech
				LoginController::envoyer_mail(
					$email,
					'LaBorneArcade - Réinitialisation de mot de passe',
					'Cliquez pour réinitialiser votre mot de passe',
					'Réinitialisation de mot de passe',
					$resetLink
				);

			} else {
				echo 'Adresse e-mail non valide.';
			}
		} else {
			return view('login/oubliMdp', ['titre' => "Profile"]);
		}
		return view('login/oubliMdp', ['titre' => "Profile"]);

	}

	public function resetMdp(string $token)
	{
		$userModel = new UtilisateurModel();
		if ($this->request->getMethod() === 'POST') {


			$password = $this->request->getPost('mdp');
			$confirmPassword = $this->request->getPost('mdpConf');
			// Valider et traiter les données du formulaire


			$user = $userModel->where('token_mdp', $token)
				->where('date_creation_token >', date('Y-m-d H:i:s'))
				->first();
			if ($user && $password === $confirmPassword) {
				// Mettre à jour le mot de passe et réinitialiser le jeton
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				$userModel->set('mdp', $hashedPassword)
					->set('token_mdp', null)
					->set('date_creation_token', null)
					->update($user->id_utilisateur);
				return 'Mot de passe réinitialisé avec succès.';
			} else {
				return 'Erreur lors de la réinitialisation du mot de passe.';
			}

		} else {
			helper(['form']);

			$user = $userModel->where('token_mdp', $token)
				->where('date_creation_token >', date('Y-m-d H:i:s'))
				->first();
			if ($user) {
				return view('login/resetMdp', ['token' => $token, 'titre' => "Profile"]);
			} else {
				return 'Lien de réinitialisation non valide.';
			}
		}

	}

	public static function envoyer_mail(
		string $mail,
		string $sujet,
		string $corps,
		string $titre,
		string $lien_btn,
		string $sous_titre =
		""
	): bool {
		$emailService = Services::email();

		echo $titre;
		$emailService->setTo($mail);
		$emailService->setFrom('mailingtestIUT@gmail.com');
		$emailService->setSubject($sujet);
		$emailService->setMessage(
			"
    <!DOCTYPE HTML>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background-color: #1f2937; /* Bleu-noir */
                color: #ffffff; /* Texte blanc */
                text-align: center;
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 10vh;
				max-height: 100vh;
                padding: 20px;
            }
            .card {
                background-color: #2d3748; /* Fond de la carte */
                border: 1px solid #4a5568; /* Bordure gris foncé */
                border-radius: 8px;
                padding: 20px;
                max-width: 600px;
                width: 100%;
            }
            h1 {
				text-color : #ffffff;
				color : #ffffff;
                font-size: 24px;
                margin-bottom: 10px;
            }
            h2 {
                font-size: 18px;
                margin-bottom: 15px;
                color: #a0aec0; /* Gris clair */
            }
            p {
                font-size: 16px;
                margin-bottom: 20px;
                color: #cbd5e0; /* Gris clair */
            }
            a.button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #38a169; /* Vert */
                color: #ffffff; /* Blanc */
                text-decoration: none;
                border-radius: 4px;
                font-weight: bold;
            }
            a.button:hover {
                background-color: #2f855a; /* Vert plus foncé */
            }
            .footer {
                font-size: 12px;
                margin-top: 15px;
                color: #718096; /* Gris foncé */
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='card'>
                <h1>$titre</h1>
                <h2>$sous_titre</h2>
                <p>$corps</p>
                <a href='$lien_btn' class='button' target='_blank'>Cliquer ici</a>
                <div class='footer'>
                    &copy; " . date('Y') . " La Borne d'Arcade. Tous droits réservés.
                </div>
            </div>
        </div>
    </body>
    </html>"
		);


		if ($emailService->send())
			return true;
		log_message("error", $emailService->printDebugger());
		return false;
	}

}