<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\CommandeModel;
use App\Models\BornePersoModel;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * @author Gabriel Roche
 */
class CommandeController extends BaseController {
	
	/** @var CommandeModel $commandeModel */
	private CommandeModel $commandeModel;

	/** @var bornePersoModel $bornePersoModel */
	private bornePersoModel $bornePersoModel;

	/** @var UtilisateurModel $utilisateurModel */
	private UtilisateurModel $utilisateurModel;
	
	/**
	 * Constructeur du contrôleur commande.
	 */
	public function __construct() {
		helper(['form']);
		$this->commandeModel = new CommandeModel();
		$this->utilisateurModel = new UtilisateurModel();
		$this->bornePersoModel = new BornePersoModel();
	}
	
	/**
	 * Méthode qui affiche le panier.
	 *
	 * @return string La vue qui liste les bornes du panier.
	 */
	public function panier() : string {
        $session = session();
		if (!$session->has('panier') && !$session->has('user')) {
			$session->set('panier' , []);
			$session->set('options', []);
		}
        
        // Vérifier si le client est authentifié
        $bornes = ($session->get('user')) ? 
                   $this->utilisateurModel->getPanier($session->get('user')['id']) : // Client authentifié
                   $session->get('panier'); // Client visiteur

		return view('commande/panier_commande', [
			'titre'   => 'Panier',
			'bornes'  => $bornes,
			'options' => $session->get('options') ?: null,
		]);
	}
	
	/**
	 * Méthode qui affiche le panier.
     * Les commandes peuvent uniquement être vue par des utilisateurs authentifiés.
	 *
	 * @return string La vue qui liste les commandes d'un utilisateur.
	 */
	public function index() : string {
	
        $session = session();
        
        $commandes = $this->utilisateurModel->getCommandes($session->get('user')['id']);

		return view('commande/index_commande', [
			'titre'     => 'Panier',
			'commandes' => $commandes,
		]);
	}
	
	/**
	 * Suppresion d'une borne personnalisée .
	 * Et redirection vers le panier utilisateur.
     * 
	 * @return RedirectResponse
	 */
	public function suppressionBorne(int $id) : RedirectResponse {
	
		$session = session();

		if ($session->has('user')) {
			$this->bornePersoModel->deleteCascade($id);
		} else {
			$panier = $session->get('panier');
			$options = $session->get('options');
			unset($panier[$id]);
			unset($options[$id]);
			$session->set('panier', $panier);
			$session->set('options', $options);
		}

		return redirect()->to('/panier');
	}
}
