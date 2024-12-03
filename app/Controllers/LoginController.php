<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Entities\Utilisateur;
use CodeIgniter\Validation\Validation;

class LoginController extends BaseController
{
	/** @var UtilisateurModel $utilisateurModel */
	private UtilisateurModel $utilisateurModel;

	/** @var Validation $validation */
	private Validation $validation;
	

	public function __construct() {
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
				'titre'   => 'Créer un compte',
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
				'mdp'   => 'required|min_length[8]',
			];

			$ruleMessages = [
				'email' => [
					'required'    => 'Champ requis.',
					'valid_email' => 'Email invalide.',
				],

				'mdp' => [
					'required'    => 'Champ requis.',
					'min_length'  => 'Le mot de passe est trop court.',
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
							'id'    => $user->id,
							'email' => $user->email,
						]);

						// Rediriger vers la page d'accueil ou le tableau de bord
						return redirect()->to('/');
					} else {
						// Mot de passe incorrect
						return view('login/connexion', [
							'titre'   => 'Se connecter',
							'erreurs' => ['mdp' => 'Mot de passe incorrect.'], // Passer les erreurs à la vue
						]);
					}
				} else {
					// L'email n'existe pas
					return view('login/connexion', [
						'titre'   => 'Se connecter',
						'erreurs' => ['email' => 'Email introuvable.'], // Passer les erreurs à la vue
					]);
				}
			} else {
				// Si la validation échoue, renvoyer les erreurs
				return view('login/connexion', [
					'titre'   => 'Se connecter',
					'erreurs' => $this->validator->getErrors(), // Passer les erreurs à la vue
				]);
			}
		}

		// Affiche la vue pour une requête GET
		return view('login/connexion', ['titre' => 'Se connecter']);
	}
}