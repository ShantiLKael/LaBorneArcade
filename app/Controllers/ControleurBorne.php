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
use CodeIgniter\Pager\Pager;

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
		$this->borneModel       = new BorneModel();
		$this->boutonModel      = new BoutonModel();
		$this->joystickModel    = new JoystickModel();
		$this->optionModel      = new OptionModel();
		$this->themeModel       = new ThemeModel();
		$this->matiereModel     = new MatiereModel();
		$this->utilisateurModel = new UtilisateurModel();
	}
	
	/*===================================*/
	/*  Méthodes des routes tout public  */
	/*===================================*/
	
	/**
	 * Méthode qui affiche la liste des bornes prédéfinies.
	 *
	 * @return RedirectResponse|string La vue qui liste les bornes prédéfinies.
	 */
	public function indexBorne() : RedirectResponse|string {
		$theme = $this->request->getGet('theme') ?: [];
		$type = $this->request->getGet('type') ?: [];
		/** @var Pager $pager */
		$pager = service('pager');
		
		$pageGet = $this->request->getGet('page');
		
		if ($pageGet !== null && !preg_match("#\d#", $pageGet)) {
			return redirect()->to('/bornes');
		}
		
		$page    = intval($pageGet) ?: 1;
		$perPage = 9;
		$bornes  = $this->borneModel->getBornes($perPage, $theme, $type);
		$total   = $this->borneModel->getNombreBornes();
		
		if ($page < 1) {
			return redirect()->to("/bornes");
		}
		
		if (count($bornes) === 0) {
			$derniere_page = ceil($total / $perPage);
			return redirect()->to("/bornes?page=$derniere_page");
		}
		
		return view('borne/index_borne', [
			'titre'         =>"Liste des bornes prédéfines",
			'themes'        =>$this->themeModel->findAll(),
			'selectionTheme'=>$theme,
			'selectionType' =>$type,
			'bornes'        =>$bornes,
			'pager_links'   =>$pager->makeLinks($page, $perPage, $total),
		]);
	}
	
	/**
	 * Affiche une borne prédéfinie en fonction de son identifiant.
	 *
	 * @param int $id_borne L'identifiant de la borne à afficher.
	 * @return string|RedirectResponse La vue d'une borne.
	 */
	public function voirBorne(int $id_borne) : string|RedirectResponse {

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
