<?php

namespace App\Controllers;
use App\Models\FaqModel;
use CodeIgniter\Session\Session;
use CodeIgniter\Validation\Validation;
use Config\Services;

class HomeController extends BaseController
{
	/** @var Session $session */
	private Session $session;
	
	/** @var Validation $validation */
	private Validation $validation;
	
	/** @var FaqModel $validation */
	private FaqModel $faqModel;

	public function __construct() {
		$this->session = session();
		$this->validation = Services::validation();
		$this->faqModel = new FaqModel();
		helper(['form']);
	}

	public function index():string {
		return view('home');
	}

	/**
	 * Méthode qui affiche une interface de contact
	 * pour joindre les administrateurs.
	 *
	 * @return string La vue de contact.
	 */
	public function contact(): string {

		$data = $this->request->getPost();
		
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
					'erreurs' => $this->validation->getErrors(),
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
		$faqs = $this->faqModel->findAll();
		return view('faq/index_faq', [
			'titre' => 'FAQ | LBA',
			'faqs'   => $faqs,
		]);
	}
}
