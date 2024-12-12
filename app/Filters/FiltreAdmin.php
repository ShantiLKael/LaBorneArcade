<?php

namespace App\Filters;

use App\Models\UtilisateurModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FiltreAdmin implements FilterInterface {
	
	/**
	 * @inheritDoc
	 * @return RedirectResponse|void
	 */
	public function before(RequestInterface $request, $arguments = null) {
		$session = session();
		$user = $session->get('user');
		if (!$user OR ($user['role'] !== UtilisateurModel::ROLE_ADMIN && $user['role'] !== UtilisateurModel::ROLE_SUPER_ADMIN)) {
			return redirect()->to('/connexion');
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void {
	}
}
