<?php

namespace App\Controllers;

use App\Entities\BornePerso;
use App\Models\BorneModel;
use App\Models\BornePersoModel;
use App\Models\BoutonModel;
use App\Models\JoystickModel;
use App\Models\MatiereModel;
use App\Models\OptionModel;
use App\Models\ThemeModel;
use App\Models\TMoldingModel;
use App\Models\UtilisateurModel;
use App\ThirdParty\CronJob;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use CodeIgniter\Pager\Pager;

/**
 * @author Gabriel Roche
 */
class ControleurBorne extends BaseController {
	
	/** @var BorneModel $borneModel */
	private BorneModel $borneModel;

	/** @var BornePersoModel $bornePersoModel */
	private BornePersoModel $bornePersoModel;
	
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
	
	/** @var TMoldingModel $utilisateurModel */
	private TMoldingModel $tmoldingModel;
	
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
		$this->tmoldingModel    = new TMoldingModel();
		$this->utilisateurModel = new UtilisateurModel();
		$this->bornePersoModel  = new BornePersoModel();
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
		
		if (($pageGet !== null && !preg_match("#\d#", $pageGet)) || $pageGet == "0") {
			return redirect()->to('/bornes');
		}
		
		$page    = intval($pageGet) ?: 1;
		$perPage = 9;
		$bornes  = $this->borneModel->getBornes($perPage, $theme, $type);
		$total   = $this->borneModel->getNombreBornes();
		
		if ($page < 1) {
			return redirect()->to("/bornes");
		}
		
		if (count($bornes) === 0 && $total > 0) {
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
			if (!$session->has('panier') && !$session->has('user')) {
				$session->set('panier' , []);
				$session->set('options', []);
			}

			$borne = $this->borneModel->find($id_borne);

			$bornePerso = new BornePerso();
			$bornePerso->idTMolding = intval  ($borne->idTMolding);
			$bornePerso->idMatiere  = intval  ($borne->idMatiere);
			$bornePerso->prix       = floatval($borne->prix);
			$bornePerso->idBorne    = intval  ($id_borne);
			$bornePerso->dateCreation = Time::now('Europe/Paris', 'fr_FR');
			$bornePerso->dateModif    = Time::now('Europe/Paris', 'fr_FR');

			if ($session->has('user')) { // Utilisateur connécté
				$idBornePerso = $this->bornePersoModel->insert($bornePerso);

				if (isset($data['options']))
					foreach($data['options'] as $idOption)
						$this->bornePersoModel->insererOptionBorne($idBornePerso, $idOption);
				
				$this->utilisateurModel->insererPanier(session()->get('user')['id'], $idBornePerso);

			} else { // Utilisateur non connécté
				
				if (isset($data['options'])) {
					$options = [];
					foreach ($data['options'] as $idOption)
						$options[] = $this->optionModel->find($idOption);

					$session->push('options', [$options]);
				} else {
					$session->push('options', [null]);
				}

				$session->push('panier', [$bornePerso]);
			}
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
			'titre'     => "Personnaliser une borne",
			'options'   => $this->optionModel->findAll(),
			'tmoldings' => $this->tmoldingModel->findAll(),
			'matieres'  => $this->matiereModel->findAll(),
			'joysticks' => $this->joystickModel->findAll(),
			'boutons'   => $this->boutonModel->findAll(),
			'borne'     => $id_borne ? $this->borneModel->getBorneParId($id_borne) : null,
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
