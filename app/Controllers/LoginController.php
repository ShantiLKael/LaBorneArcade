<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;

class LoginController extends BaseController
{

	public function inscription()
	{
		helper(['form']);

		if ($this->request->getMethod() === 'get') {
			// Handle GET request
			return view('connexion');
		}

		$UtilModel = new UtilisateurModel();

		if ($this->validate($UtilModel->getValidationRules(), $UtilModel->getValidationMessages())) {

			$data = [
				'email' => $this->request->getVar('mail'), // Utilisation de 'mail'
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
}