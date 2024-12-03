<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Entities\Utilisateur;
use CodeIgniter\HTTP\RedirectResponse;
use \Config\Services;

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
				'date_creation_token' => null
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
					'titre',
					$resetLink
				);

			} else {
				echo 'Adresse e-mail non valide.';
			}
		} else {
			return view('oubliMdp');
		}
		return view('oubliMdp');

	}

	public function resetMdp($token)
	{
		$userModel = new UtilisateurModel();
		if ($this->request->getMethod() === 'POST') {

			

			$token = $this->request->getPost('token');
			$password = $this->request->getPost('mdp');
			$confirmPassword = $this->request->getPost('confirm_password');
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
				return view('resetMdp', ['token' => $token]);
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

		$emailService->setTo($mail);
		$emailService->setFrom('mailingtestIUT@gmail.com');
		$emailService->setSubject($sujet);
		$emailService->setMessage(
			'	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
					<html lang="fr">
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						</head>
						<body style="margin: 0; font-family: Arial, sans-serif; color: black;">
							<div style="height: 100%; display: grid; grid-template-rows: minmax(5%, calc((100% - 376px) / 2)) min-content minmax(5%, calc((100% - 376px) / 2));">
								<div></div>
								<div style="margin: 0 calc(25% / 2); padding: 0 30px; text-align: center; background-color: #f1f1f1; background-image: linear-gradient(46deg, #009a808c, #33ffdc); border-radius: 5px; border: 1px #9A001A solid;">
									<h1 style="margin-bottom: 15px; display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; justify-items: start;">
										<a href="' . base_url() . '" target="_blank">
											<img src="https://i.ibb.co/hdV7vnR/Logo-Nom-Horizontal.png" alt="Quicket logo" height="50">
										</a>
										' . $titre . '
									</h1>
									<h2 style="color: #000000d9; margin-top: 0;">' . $sous_titre . '</h2>
									<div>
										<p>' . $corps . '</p>
									</div>
									<a href="' . $lien_btn . '" target="_blank">
										<button style="margin: 35px 0; width: 150px; height: 40px; border: 2px solid #E60026; border-radius: 7.5px; background-color: #E60026; color: #ffd0d0; font-size: medium; cursor: pointer;">Cliquer ici</button>
									</a>
								</div>
								<div></div>
							</div>
						</body>
					</html>'
		);
		if ($emailService->send())
			return true;
		log_message("error", $emailService->printDebugger());
		return false;
	}

}