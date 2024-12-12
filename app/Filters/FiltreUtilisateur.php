<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FiltreUtilisateur implements FilterInterface {
	
	/**
	 * @inheritDoc
	 * @return RedirectResponse|void
	 */
	public function before(RequestInterface $request, $arguments = null) {
		$session = session();
		if (!$session->get('user')) {
			return redirect()->to('/connexion');
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void {}
}
