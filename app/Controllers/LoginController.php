<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Entities\Utilisateur;
use CodeIgniter\HTTP\RedirectResponse;

class LoginController extends BaseController
{

	public function inscription()
	{
		helper(['form']);

		if ($this->request->getMethod() === 'GET') {
			// Handle GET request
			return view('inscription');
		}

		$UtilModel = new UtilisateurModel();

		if ($this->validate($UtilModel->getValidationRules(), $UtilModel->getValidationMessages())) {

			$data = [
				'email' => $this->request->getVar('email'), // Utilisation de 'mail'
				'mdp' => password_hash($this->request->getVar('mdp'), PASSWORD_DEFAULT),
				'role' => 'utilisateur',
				'token_mdp' => null,
				'creation_token_mdp' => null
			];

			$UtilModel->insert($data);

			return redirect()->to('/connexion');
		} else {
			// Si les règles ne sont pas respectées, renvoi des erreurs de validation
			$data['validation'] = $this->validator;
			echo view('inscription', $data);
		}
	}
	
	public function connexion()
	{
		$UtilModel = new UtilisateurModel();

		if ($this->request->getMethod() === 'POST') {
			// Règles de validation pour l'email et le mot de passe
			$rules = [
				'email' => 'required|valid_email',
				'mdp' => 'required|min_length[8]',
			];

			// Valider les données d'entrée
			if ($this->validate($rules)) {
				// Récupérer les données soumises
				$email = $this->request->getVar('email');
				$password = $this->request->getVar('mdp');

				// Recherche de l'utilisateur dans la base de données
				$user = $UtilModel->where('email', $email)->first();

				if ($user) {
					// Vérification du mot de passe
					$pass = $user->mdp; // Le mot de passe stocké dans la base de données
					if (password_verify($password, $pass)) {
						// Authentification réussie
						// Stocker l'utilisateur dans la session
						session()->set('user', $user);

						// Rediriger vers la page d'accueil ou le tableau de bord
						return redirect()->to('/Home')->with('success', 'Connexion réussie');
					} else {
						// Mot de passe incorrect
						return redirect()->back()->with('error', 'Mot de passe incorrect');
					}
				} else {
					// L'email n'existe pas
					return redirect()->back()->with('error', 'Email introuvable');
				}
			} else {
				// Si la validation échoue, renvoyer les erreurs
				$data = [
					'validation' => $this->validator // Passer l'objet de validation à la vue
				];
				return view('connexion', $data); // Passer les erreurs à la vue
			}
		}

		// Affiche la vue pour une requête GET
		return view('connexion');
	}
}