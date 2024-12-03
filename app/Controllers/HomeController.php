<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\FaqModel;
use CodeIgniter\Model;

class HomeController extends BaseController
{

    /* ---------------------------------------- */
	/* ----------- Redirection page ----------- */
	/* ---------------------------------------- */
	
	/**
	 * Page d'accueil des visiteurs
	 * @return string la vue accueil
	 */
	public function index():string {
		return view('home', ['titre' => 'Accueil']);
	}

	/**
	 * Page visiteur
	 * Page de contact pour joindre les administrateurs par mail
	 * @return string La vue de contact
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
				'required'    => 'Champ requis',
				'regex_match' => 'Entrer un numéro valide'
			],
			'email'  => [
				'required'    => 'Champ requis',
				'valid_email' => 'Entrer un émail valide'
			],
			'message'  => [
				'required'    => 'Champ requis',
			],
		];

		// Methode POST
		if ($data) {
			if (!$this->validate($regleValidation, $messageValidation)) {
				return view('contact/index_contact', [
					'titre' => 'Me Contacter',
					'erreurs' => $validation->getErrors(),
				]);
			} else {
				// TODO : Envoie de mail
			}
		}
		return view('contact/index_contact', ['titre' => 'Me Contacter']);
	}


    /**
     * Page visiteur A propos
     * @return string la vue qui sommes nous
     */
	public function quiSommesNous():string {
		return view('/qui_sommes_nous', ['titre' => 'A propos']);
	}

	/**
	 * Page visiteur FAQ
	 * @return string la vue faq
	 */
	public function faq():string {
        $faqModele = new FaqModel();
		return view('faq', [
			'titre' => 'FAQ',
			'faqs'  => $faqModele->findAll(),
		]);
	}

    /**
	 * Page visiteur 
	 * Condition générale  de vente
	 * @return string la vue condition générale de vente
	 */
	public function cgv()
	{
		return view('cgv', ['titre' => 'Condition générale de vente']);
	}
}