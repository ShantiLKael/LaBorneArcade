<?php

namespace App\Controllers;

use App\Entities\Commande;
use App\Models\BorneModel;
use App\Models\UtilisateurModel;
use App\Models\CommandeModel;
use App\Models\BornePersoModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

/**
 * @author Gabriel Roche
 */
class CommandeController extends BaseController
{

	/** @var CommandeModel $commandeModel */
	private CommandeModel $commandeModel;

	/** @var bornePersoModel $bornePersoModel */
	private bornePersoModel $bornePersoModel;

	/** @var UtilisateurModel $utilisateurModel */
	private UtilisateurModel $utilisateurModel;

	/**
	 * Constructeur du contrôleur commande.
	 */
	public function __construct()
	{
		helper(['form']);
		$this->commandeModel = new CommandeModel();
		$this->utilisateurModel = new UtilisateurModel();
		$this->bornePersoModel = new BornePersoModel();
	}

	/**
	 * Méthode qui affiche le panier.
	 *
	 * @return string|RedirectResponse La vue qui liste les bornes du panier.
	 * @throws Exception
	 */
	public function panier(): string|RedirectResponse
	{
		$session = session();
		if (!$session->has('panier') && !$session->has('user')) {
			$session->set('panier', []);
			$session->set('options', []);
		}

		// Vérifier si le client est authentifié
		$bornes = ($session->get('user')) ?
			$this->utilisateurModel->getPanier($session->get('user')['id']) : // Client authentifié
			$session->get('panier'); // Client visiteur

		$data = $this->request->getPost();
		if ($data) {
			$idUtilisateur = $session->get('user')['id'];
			$commande = new Commande();
			$commande->dateCreation = Time::now('Europe/Paris', 'fr_FR');
			$commande->dateModif = Time::now('Europe/Paris', 'fr_FR');
			$commande->etat = "En attente d'acceptation";
			$commande->idBorne = $data['selected_borne'];
			$commande->idUtilisateur = $idUtilisateur;
			$this->utilisateurModel->suppressionBorne($idUtilisateur, intval($data['selected_borne']));
			$this->commandeModel->insert($commande);

			$borneModel = new BorneModel();
			$bornePersoModel = new BornePersoModel();

			$borneMail = $borneModel->getBorneParId($commande->idBorne);
			if ($borneMail == null) {
				$borneMail = $bornePersoModel->getBorne($commande->idBorne);

				$corps = "Borne personnalisée n°" . $borneMail->id_borne . ".\n\n Vous pourrez retrouver facilement cette borne grâce à son id dans les pages admin !" . "\n Cliquez ici pour accèder aux pages administrateurs.";
			}else {
				$corps = "Borne n°" . $borneMail->id_borne . " Nom : ". $borneMail->nom . ".\n\n Vous pourrez retrouver facilement cette borne grâce à son id dans les pages admin !" . "\n Cliquez ici pour accèder aux pages administrateurs.";;
			}

			$lien = site_url("admin/bornes");
			
			//Envoi de mail à Mr LeFebvre (pour l'instant addresse de test, on va pas lui envoyer des mails :) )
			LoginController::envoyer_mail("mailingtestIUT@gmail.com", "Nouvelle commande !", $corps, "Vous avez reçu une nouvelle commande",$lien);
			return redirect()->to('/commandes')->with('msg', 'Vous avez passé votre commande');
		}

		return view('commande/panier_commande', [
			'titre' => 'Panier',
			'bornes' => $bornes,
			'options' => $session->get('options') ?: null,
		]);
	}

	/**
	 * Méthode qui affiche le panier.
	 * Les commandes peuvent uniquement être vues par des utilisateurs authentifiés.
	 *
	 * @return string La vue qui liste les commandes d'un utilisateur.
	 */
	public function index(): string
	{

		$session = session();

		$commandes = $this->utilisateurModel->getCommandes($session->get('user')['id']);

		return view('commande/index_commande', [
			'titre' => 'Panier',
			'commandes' => $commandes,
		]);
	}

	/**
	 * Suppresion d'une borne personnalisée, puis redirection vers le panier utilisateur.
	 *
	 * @param int $id
	 * @return RedirectResponse
	 */
	public function suppressionBorne(int $id): RedirectResponse
	{

		$session = session();

		if ($session->has('user')) {
			$this->bornePersoModel->deleteCascade($id);
		} else {
			$panier = $session->get('panier');
			$options = $session->get('options');
			$joysticks = $session->get('joysticks');
			$boutons = $session->get('boutons');

			unset($panier[$id]);
			unset($options[$id]);
			unset($boutons[$id]);
			unset($joysticks[$id]);

			$session->set('panier', $panier);
			$session->set('joysticks', $joysticks);
			$session->set('boutons', $boutons);
			$session->set('options', $options);
		}

		return redirect()->to('/panier');
	}
}
