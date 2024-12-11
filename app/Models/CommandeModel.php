<?php
namespace App\Models;

use App\Entities\Utilisateur;
use App\Entities\BornePerso;
use CodeIgniter\Model;

class CommandeModel extends Model
{
    protected $table = 'commande';
    protected $primaryKey = 'id_commande';
    protected $allowedFields = ['date_creation', 'date_modif', 'etat', 'id_borneperso', 'id_utilisateur'];
	protected $returnType = 'App\Entities\Commande';

	/**
	 * Récupère la Borne de la commande.
	 * @param int $idBorne
	 * @return BornePerso
	 */
	public function getBorne(int $idBorne): BornePerso
	{
		$bornePersoModele = new BornePersoModel();
		return $bornePersoModele->find($idBorne);
	}

	/**
	 * Récupère l'Utilisateur qui a créer la commande.
	 * @param int $idBorne
	 * @return \App\Entities\Utilisateur
	 */
	public function getUtilisateur(int $idUtilisateur): Utilisateur
	{
		$utilisateurModele = new UtilisateurModel();
		return $utilisateurModele->find($idUtilisateur);
	}
}