<?php

namespace App\Controllers;

use App\Models\BorneModel;
use App\Models\BoutonModel;
use App\Models\JoystickModel;
use App\Models\MatiereModel;
use App\Models\OptionModel;
use App\Models\ThemeModel;
use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Config\Services;

/**
 * @author Gabriel Roche
 */
class ControleurBorne extends BaseController {
	
	/** @var BorneModel $borneModel */
	private BorneModel $borneModel;
	
	/** @var BoutonModel $boutonModel */
	private BoutonModel $boutonModel;
	
	/** @var JoystickModel $joystickModel */
	private JoystickModel $joystickModel;
	
	/** @var OptionModel $optionModel */
	private OptionModel $optionModel;
	
	/** @var ThemeModel $themeModel */
	private ThemeModel $themeModel;
	
	/** @var MatiereModel $matiereModel */
	private MatiereModel $matiereModel;
	
	/** @var UtilisateurModel $utilisateurModel */
	private UtilisateurModel $utilisateurModel;
	
	/**
	 * Constructeur du contrôleur Borne.
	 */
	public function __construct() {
		helper(['form']);
		$this->borneModel = new BorneModel();
		$this->boutonModel = new BoutonModel();
		$this->joystickModel = new JoystickModel();
		$this->optionModel = new OptionModel();
		$this->themeModel = new ThemeModel();
		$this->matiereModel = new MatiereModel();
		$this->utilisateurModel = new UtilisateurModel();
	}
	
	/*===================================*/
	/*  Méthodes des routes tout public  */
	/*===================================*/
	
	/**
	 * Méthode qui affiche la liste des bornes prédéfinies.
	 *
	 * @param string|null $theme Le thème des bornes à sélectionner.
	 * @return string La vue qui liste les bornes prédéfinies.
	 */
	public function index(string $theme = null) : string {
	
//		dd($theme, $this->request->getGet('type'));
//		dd($this->borneModel->getBornes());
		return view('borne/index_borne', [
			'titre' =>"Liste des bornes prédéfines",
			'bornes'=>$this->borneModel->getBornes($theme),
		]);
	}
	
	/**
	 * Affiche une borne prédéfinie en fonction de son identifiant.
	 *
	 * @param int $id_borne L'identifiant de la borne à afficher.
	 * @return string La vue d'une borne.
	 */
	public function voirBorne(int $id_borne) : string|RedirectResponse {

		session()->destroy();
		$session = session();
		$data = $this->request->getPost();

		// Methode POST
		if ($data) {
			if (!$session->has('panier'))
				$session->set('panier', []);

			// si le client est authentifié
			$panier = $session->has('user') ? 
					  $this->utilisateurModel->getPanier($session->get('user')['id']) : // panier de l'utilisateur en bdd
					  $session->get('panier'); // panier de la session

			foreach ($panier as $borne) {
				if ($borne->id == $id_borne)
					return redirect()->to('/bornes/'.$id_borne)->with('flash_erreur', 'Ce produit se trouve déjà dans votre panier.');
			}

			if ($session->has('user'))
				$this->utilisateurModel->insererPanier($session->get('user')['id'], $id_borne);
			else
				$session->push('panier', [$this->borneModel->getBorneParId($id_borne)]);
		}

		return view('borne/voir_borne', [
			'titre'=>"Voir la borne",
			'borne'=>$this->borneModel->getBorneParId($id_borne),
		]);
	}
	
	/**
	 * Affiche la page d'édition de borne.
	 *
	 * @param int|null $id_borne L'identifiant de la borne à modifier, ou <code>null</code> si borne personnalisée.
	 * @return string La vue qui affiche la page de création/modification de borne prédéfinie.
	 */
	public function editBorne(int $id_borne = null) : string {
		return view('borne/edit_borne', [
			'titre'=>"Personnaliser une borne",
			'borne'=>$id_borne ? $this->borneModel->getBorneParId($id_borne) : null,
		]);
	}
	
	/*=============================*/
	/*  Méthodes des routes admin  */
	/*=============================*/
	
	public function creerBorne() : string {
		
		return view('borne/admin_borne', [
			'titre'=>"Modification des bornes"
		]);
	}
	
	public function modifierBorne(int $id_borne) : string {
		
		return view('borne/admin_borne', [
			'titre'=>"Modification des bornes"
		]);
	}
	
	public function supprimerBorne(int $id_borne) : string {
		
		return view('borne/admin_borne', [
			'titre'=>"Modification des bornes"
		]);
	}
	
}
