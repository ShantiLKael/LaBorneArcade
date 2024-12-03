<?php

namespace App\Controllers;

class HomeController extends BaseController 
{
	public function __construct() {
		helper(['form']); // Chargement du helper Form
	}

	/**
	 * Méthode qui affiche une interface de contact 
	 * pour joindre les administrateurs.
	 *
	 * @return string La vue de contact.
	 */
	public function contact(): string {
		$data = $this->request->getPost();
		$validation = \Config\Services::validation();
		$regleValidation = [
			'phone'   => 'required|regex_match[/^[0-9]{10}$/]',
			'email'   => 'required|valid_email',
			'message' => 'required',
		];

		$messageValidation = [
			'phone' => [
				'required'    => 'Champ requis.',
				'regex_match' => 'Entrer un numéro valide.'
			],

			'email'  => [
				'required'    => 'Champ requis.',
				'valid_email' => 'Entrer un émail valide.'
			],

			'message'  => [
				'required'    => 'Champ requis.',
			],
		];

		// Methode POST
		if ($data)
			if (!$this->validate($regleValidation, $messageValidation)) {
				return view('contact/index_contact', [
					'titre' => 'Me Contacter | LBA',
					'erreurs' => $validation->getErrors(),
				]);
			} else {
				// TODO : Envoie de mail
			}

		return view('contact/index_contact', ['titre' => 'Me Contacter | LBA']);
	}

	/**
	 * Méthode qui affiche une interface de contact 
	 * pour joindre les administrateurs.
	 *
	 * @return string La vue de contact.
	 */
	public function quiSommesNous(): string {
		return view('qui_sommes_nous', ['titre' => 'Qui sommes nous | LBA']);
	}

	/**
	 * Méthode qui affiche les conditions générales de vente 
	 *
	 * @return string La vue des conditions de vente.
	 */
	public function cgv(): string {
		return view('cgv', ['titre' => 'Conditions générales de vente | LBA']);
	}

	/**
	 * Méthode qui affiche les réponses des questions fréquemment posées
	 * Rubrique FAQ
	 *
	 * @return string La vue FAQ.
	 */
	public function faq(): string {
		return view('faq/index_faq', ['titre' => 'FAQ | LBA']);
	}
}
