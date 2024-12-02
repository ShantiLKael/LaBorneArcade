<?php
namespace App\Models;

use App\Entities\Utilisateur;
use App\Entities\Borne;
use CodeIgniter\Model;

class CommandeModel extends Model
{
    protected $table = 'commande';
    protected $primaryKey = 'id_commande';
    protected $allowedFields = ['date_creation', 'date_modif', 'etat', 'id_borne', 'id_utilisateur'];
    protected $useTimestamps = false;

	/**
	 * Récupère la Borne de la commande.
	 * @param int $idBorne
	 * @return \App\Entities\Borne
	 */
	public function getBorne(int $idBorne): Borne
	{
		$borneModele = new BorneModel();
		return $borneModele->find($idBorne);
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