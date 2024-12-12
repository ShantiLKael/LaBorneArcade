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
	 * Récupère la borne de la commande.
	 *
	 * @param int $idBorne
	 * @return BornePerso|array|null
	 */
	public function getBorne(int $idBorne): BornePerso|array|null
	{
		$bornePersoModele = new BornePersoModel();
		return $bornePersoModele->find($idBorne);
	}
	
	/**
	 * Récupère l'utilisateur qui a créé la commande.
	 *
	 * @param int $idUtilisateur
	 * @return Utilisateur|array|null
	 */
	public function getUtilisateur(int $idUtilisateur): Utilisateur|array|null
	{
		$utilisateurModele = new UtilisateurModel();
		return $utilisateurModele->find($idUtilisateur);
	}
}
