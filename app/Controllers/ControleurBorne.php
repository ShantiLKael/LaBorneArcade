<?php

namespace App\Controllers;

use App\Entities\BornePerso;
use App\Entities\Borne;
use App\Models\BorneModel;
use App\Models\BornePersoModel;
use App\Models\BoutonModel;
use App\Models\JoystickModel;
use App\Models\MatiereModel;
use App\Models\OptionModel;
use App\Models\ThemeModel;
use App\Models\TMoldingModel;
use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use CodeIgniter\Pager\Pager;
use Exception;
use ReflectionException;

/**
 * @author Gabriel Roche
 */
class ControleurBorne extends BaseController {
	
	private BorneModel $borneModel;
	
	private BornePersoModel $bornePersoModel;
	
	private BoutonModel $boutonModel;
	
	private JoystickModel $joystickModel;
	
	private OptionModel $optionModel;
	
	private ThemeModel $themeModel;
	
	private MatiereModel $matiereModel;
	
	private UtilisateurModel $utilisateurModel;
	
	private TMoldingModel $tmoldingModel;
	
	/**
	 * Constructeur du contrôleur Borne.
	 */
	public function __construct() {
		helper(['form', 'cookie']);
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
		/*  Paramètres de recherche  */
		$theme     = $this->request->getGet('theme') ?: [];
		$theme     = array_filter($theme, fn($o) => !empty($o));
		$matiere   = $this->request->getGet('matiere') ?: [];
		$matiere   = array_filter($matiere, fn($o) => !empty($o));
		$type      = $this->request->getGet('type') ?: "";
		$recherche = $this->request->getGet('recherche') ?: "";
		$prix_min  = $this->request->getGet('prix_min') ?: null;
		$prix_max  = $this->request->getGet('prix_max') ?: null;
		
		/** @var Pager $pager */
		$pager = service('pager');
		
		$pageGet = $this->request->getGet('page');
		
		if (($pageGet !== null && !preg_match("#\d#", $pageGet))) {
			$_GET['page'] = 1;
			$query = http_build_query($_GET);
			return redirect()->to('/bornes'. ($query ? "?" : "") . $query);
		}
		
		if ($prix_min && $prix_max && $prix_min > $prix_max) {
			unset($_GET['prix_max']);
			$query = http_build_query($_GET);
			return redirect()->to('/bornes'. ($query ? "?" : "") . $query);
		}
		
		$data = [
			'themes'=>$theme,
			'matieres'=>$matiere,
			'type'=>$type,
			'recherche'=>$recherche,
			'prix_min'=>$prix_min,
			'prix_max'=>$prix_max,
		];
		
		$page    = intval($pageGet) ?: 1;
		$perPage = 9;
		$bornes  = $this->borneModel->getBornes($perPage, $data);
		$total   = $this->borneModel->getNombreBornes();
		
		if ($page < 1) {
			$_GET['page'] = 1;
			$query = http_build_query($_GET);
			return redirect()->to('/bornes'. ($query ? "?" : "") . $query);
		}
		
		if (count($bornes) === 0 && $total > 0 && $page > 1) {
			$_GET['page'] = ceil($total / $perPage);
			$query = http_build_query($_GET);
			return redirect()->to('/bornes'. ($query ? "?" : "") . $query);
		}
		
		return view('borne/index_borne', [
			'titre'           =>"Liste des bornes prédéfines",
			'themes'          =>$this->themeModel->findAll(),
			'selectionTheme'  =>$theme,
			'selectionType'   =>$type,
			'selectionMatiere'=>$matiere,
			'bornes'          =>$bornes,
			'page'            =>$page,
			'matieres'        =>$this->matiereModel->findAll(),
			'pager_links'     =>$pager->makeLinks($page, $perPage, count($bornes)),
		]);
	}
	
	/**
	 * Affiche une borne prédéfinie en fonction de son identifiant.
	 *
	 * @param int $id_borne L'identifiant de la borne à afficher.
	 * @return string|RedirectResponse La vue d'une borne.
	 * @throws ReflectionException
	 * @throws Exception
	 */
	public function voirBorne(int $id_borne) : string|RedirectResponse {

		$session = session();
		$data = $this->request->getPost();
		
		$bornes_recentes = json_decode(get_cookie("bornes_recentes") ?: "[]", true);
		if (($key = array_search($id_borne, $bornes_recentes)) !== false)
			unset($bornes_recentes[$key]);
		$bornes_recentes[time()] = $id_borne;
		$bornes_recentes = array_chunk($bornes_recentes, 10, true)[0];
		uksort($bornes_recentes, fn($o1, $o2) => $o2 > $o1);
		set_cookie("bornes_recentes", json_encode($bornes_recentes), 172800 + 3600);
		
		$bornes_suggerees = [];
		foreach ($bornes_recentes as $index) {
			if ($index == $id_borne)
				continue;
			/** @var Borne $borne */
			$borne = $this->borneModel->getBorneParId($index);
			$images = $this->borneModel->getImages($index);
			if ($borne) {
				$borne->image = count($images) ? $images[0]->chemin : "";
				$bornes_suggerees[] = $borne;
			}
		}

		// Methode POST
		if ($data) {
			if (!$session->has('panier') && !$session->has('user')) {
				$session->set('panier' , []);
				$session->set('options', []);
				$session->set('boutons', []);
				$session->set('joysticks', []);
			}

			/** @var Borne $borne */
			$borne = $this->borneModel->find($id_borne);
			$bornePerso = new BornePerso();
			$bornePerso->idTMolding   = $borne->idTMolding;
			$bornePerso->idMatiere    = $borne->idMatiere;
			$bornePerso->prix         = $borne->prix;
			$bornePerso->idBorne      = $id_borne;
			$bornePerso->dateCreation = Time::now('Europe/Paris', 'fr_FR');
			$bornePerso->dateModif    = Time::now('Europe/Paris', 'fr_FR');

			if ($session->has('user')) { // Utilisateur connecté
				$idBornePerso = $this->bornePersoModel->insert($bornePerso);

				if (isset($data['idOptions']))
					foreach($data['idOptions'] as $idOption)
						$this->bornePersoModel->insererOptionBorne($idBornePerso, $idOption);

				$i = 1;
				if (isset($borne->boutons))
					foreach($borne->boutons as $bouton) {
						$this->bornePersoModel->insererBoutonBorne($idBornePerso, $bouton->id, $i);
						$i++;
					}
		
				$i = 1;
				if (isset($borne->joysticks))
					foreach($borne->joysticks as $joystick) {
						$this->bornePersoModel->insererJoystickBorne($idBornePerso, $joystick->id, $i);
						$i++;
					}
				
				$this->utilisateurModel->insererPanier(session()->get('user')['id'], $idBornePerso);

			} else { // Utilisateur non connecté
				if (isset($data['idOptions'])) {
					$options = [];
					foreach ($data['idOptions'] as $idOption)
						$options[] = $this->optionModel->find($idOption);

					$session->push('options', [$options]);
				} else {
					$session->push('options', [null]);
				}

				if (isset($borne->boutons)) {
					$boutons = [];
					foreach ($borne->boutons as $bouton)
						$boutons[] = $bouton->id;

					$session->push('boutons', [$boutons]);
				} else {
					$session->push('boutons', [null]);
				}

				if (isset($borne->joysticks)) {
					$joysticks = [];
					foreach ($borne->joysticks as $joystick)
						$joysticks[] = $joystick->id;

					$session->push('joysticks', [$joysticks]);
				} else {
					$session->push('joysticks', [null]);
				}

				$session->push('panier', [$bornePerso]);
			}
		}

		return view('borne/voir_borne', [
			'titre'=>"Voir la borne",
			'borne'=>$this->borneModel->getBorneParId($id_borne),
			'suggestion_bornes'=>$bornes_suggerees,
		]);
	}
	
	/**
	 * Affiche la page d'édition de borne.
	 *
	 * @param int|null $id_borne L'identifiant de la borne à modifier, ou <code>null</code> si borne personnalisée.
	 * @return string La vue qui affiche la page de création/modification de borne prédéfinie.
	 * @throws Exception
	 */
	public function editBorne(int $id_borne = null) : string {
		$session = session();
		$data = $this->request->getPost();
		$nbBoutons = isset($id_borne) ? count($this->borneModel->getBoutons  ($id_borne)) : 6;
		$nbJoueurs = isset($id_borne) ? count($this->borneModel->getJoysticks($id_borne)) : 1;
		
		$bornes_recentes = json_decode(get_cookie("bornes_recentes") ?: "[]", true);
		
		$bornes_suggerees = [];
		foreach ($bornes_recentes as $index) {
			if ($index == $id_borne)
				continue;
			/** @var Borne $borne */
			$borne = $this->borneModel->getBorneParId($index);
			$images = $this->borneModel->getImages($index);
			if ($borne) {
				$borne->image = count($images) ? $images[0]->chemin : "";
				$bornes_suggerees[] = $borne;
			}
		}

		if ($data) { // Configuration de l'aperçu de la borne
			if (!$session->has('panier') && !$session->has('user')) {
				$session->set('panier' , []);
				$session->set('joysticks' , []);
				$session->set('boutons' , []);
				$session->set('options', []);
			}

			if (isset($data['nbBoutons']) || isset($data['nbJoueurs'])) {
				$nbBoutons = intval($data['nbBoutons']);
				$nbJoueurs = intval($data['nbJoueurs']);
	
				return view('borne/edit_borne', [
					'nbJoueurs'        =>$nbJoueurs,
					'nbBoutons'        =>$nbBoutons,
					'titre'            =>"Personnaliser une borne",
					'options'          =>$this->optionModel->findAll(),
					'tmoldings'        =>$this->tmoldingModel->findAll(),
					'matieres'         =>$this->matiereModel->findAll(),
					'joysticks'        =>$this->joystickModel->findAll(),
					'boutons'          =>$this->boutonModel->findAll(),
					'borne'            =>$id_borne ? $this->borneModel->getBorneParId($id_borne) : null,
					'suggestion_bornes'=>$bornes_suggerees,
				]);
			}

			$reglesValidation = $this->bornePersoModel->getValidationRules();
			$reglesValidation['joystick'] = 'required';
			$reglesValidation['bouton'] = 'required';

			$regleMessagesValidation = $this->bornePersoModel->getValidationMessages();
			$regleMessagesValidation['joystick'] = ['required' => 'Champs requis.'];
			$regleMessagesValidation['bouton'  ] = ['required' => 'Champs requis.'];
			
			if ($this->validate($reglesValidation, $regleMessagesValidation)) {

				$bornePerso = new BornePerso();
				$bornePerso->fill($data);
				$bornePerso->prix = 1690;
				$bornePerso->dateCreation = Time::now('Europe/Paris', 'fr_FR');
				$bornePerso->dateModif    = Time::now('Europe/Paris', 'fr_FR');
				$idBorne = $this->bornePersoModel->insert($bornePerso);

				if ($session->has('user')) { // Utilisateur connécté
					

					if (isset($data['idOptions']))
						foreach($data['idOptions'] as $option)
							$this->bornePersoModel->insererOptionBorne($idBorne, $option);
	
					$i = 1;
					if (isset($data['idBoutons']))
						foreach($data['idBoutons'] as $bouton) {
							$this->bornePersoModel->insererBoutonBorne($idBorne, $bouton, $i);
							$i++;
						}
	
					$i = 1;
					if (isset($data['idJoysticks']))
						foreach($data['idJoysticks'] as $joystick) {
							$this->bornePersoModel->insererJoystickBorne($idBorne, $joystick, $i);
							$i++;
						}

					$this->utilisateurModel->insererPanier($session->get('user')['id'], $idBorne);
					
				} else { // Utilisateur non connécté

					if (isset($data['idOptions'])) {
						$options = [];
						foreach ($data['idOptions'] as $idOption)
							$options[] = $this->optionModel->find($idOption);
	
						$session->push('options', [$options]);
					} else {
						$session->push('options', [null]);
					}
					
					if (isset($data['idBoutons'])) {
						$boutons = [];
						foreach ($data['idBoutons'] as $idBouton)
							$boutons[] = $idBouton;

						$session->push('boutons', [$boutons]);
					} else {
						$session->push('boutons', [null]);
					}

					if (isset($data['idJoysticks'])) {
						$joysticks = [];
						foreach ($data['idJoysticks'] as $idJoystick)
							$joysticks[] = $idJoystick;

						$session->push('joysticks', [$joysticks]);
					} else {
						$session->push('joysticks', [null]);
					}

					$session->push('panier', [$bornePerso]);
				}

			} else {
				return view('borne/edit_borne', [
					'erreurs'          =>$this->validator->getErrors(),
					'nbJoueurs'        =>$nbJoueurs,
					'nbBoutons'        =>$nbBoutons,
					'titre'            =>"Personnaliser ma borne",
					'options'          =>$this->optionModel->findAll(),
					'tmoldings'        =>$this->tmoldingModel->findAll(),
					'matieres'         =>$this->matiereModel->findAll(),
					'joysticks'        =>$this->joystickModel->findAll(),
					'boutons'          =>$this->boutonModel->findAll(),
					'borne'            =>$id_borne ? $this->borneModel->getBorneParId($id_borne) : null,
					'suggestion_bornes'=>$bornes_suggerees,
				]);
			}

		}

		return view('borne/edit_borne', [
			'nbJoueurs' => $nbJoueurs,
			'nbBoutons' => $nbBoutons,
			'titre'     => "Personnaliser une borne",
			'options'   => $this->optionModel->findAll(),
			'tmoldings' => $this->tmoldingModel->findAll(),
			'matieres'  => $this->matiereModel->findAll(),
			'joysticks' => $this->joystickModel->findAll(),
			'boutons'   => $this->boutonModel->findAll(),
			'borne'     => $id_borne ? $this->borneModel->getBorneParId($id_borne) : null,
			'suggestion_bornes'=>$bornes_suggerees,
		]);
	}
	
}
