<?php

namespace App\Controllers;

use App\Models\BorneModel;
use App\Models\BoutonModel;
use App\Models\JoystickModel;
use App\Models\MatiereModel;
use App\Models\OptionModel;
use App\Models\ThemeModel;
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
	
	/**
	 * Constructeur du contrôleur Borne.
	 */
	public function __construct() {
		$this->borneModel = new BorneModel();
		$this->boutonModel = new BoutonModel();
		$this->joystickModel = new JoystickModel();
		$this->optionModel = new OptionModel();
		$this->themeModel = new ThemeModel();
		$this->matiereModel = new MatiereModel();
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
	public function voirBorne(int $id_borne) : string {
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
			'titre'=>"Modifier le borne",
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
