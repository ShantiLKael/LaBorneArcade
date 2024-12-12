<?php
namespace App\Models;

use App\Entities\Commande;
use App\Entities\Faq;
use CodeIgniter\Model;
use App\Entities\BornePerso;

class UtilisateurModel extends Model
{
	/**
	 * @property string ROLE_SUPER_ADMIN Role super admnistrateur.
	 */
	const ROLE_SUPER_ADMIN = 'super_admin';

	/**
	 * @property string ROLE_ADMIN Role adminiqtrateur.
	 */
	const ROLE_ADMIN = 'admin';

	/**
	 * @property string ROLE_UTILISATEUR Role utilisateur.
	 */
	const ROLE_UTILISATEUR = 'utilisateur';

	protected $table      = 'utilisateur';
	protected $useAutoIncrement = true;
	protected $primaryKey = 'id_utilisateur';
	protected $returnType = 'App\Entities\Utilisateur';
	protected $allowedFields = [
		'email',
		'mdp',
		'role',
		'token_mdp',
		'date_creation_token',
	];
	
	// Règles de validation
	protected $validationRules = [
		'email'  => 'required|max_length[255]|valid_email|is_unique[utilisateur.email]',
		'mdp'    => 'required|max_length[255]|min_length[8]', // TODO regex pour la sécurité du mdp
	];

	protected $validationMessages = [
		'mdp' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Votre mot de passe est trop long (max. 255 caractères).',
			'min_length'  => 'Votre mot de passe est trop court (min. 8 caractères).',
		],

		'email' => [
			'required'    => 'Champ requis.',
			'is_unique'   => 'Cet émail est déjà utilisé.',
			'max_length'  => 'Email inexistant.',
			'valid_email' => 'Entrer un émail valide.',
		]
	];

	/**
	 * Récupère un tableau de Borne de l'utilisateur.
	 * Récupère le panier de l'utilisateur.
	 * @param int $idUtilisateur
	 * @return array<BornePerso>
	 */
	public function getPanier(int $idUtilisateur): array
	{
		$builder = $this->db->table('borneperso');
		$builder->select('borneperso.*')
				->join('panier', 'borneperso.id_borneperso = panier.id_borneperso')
				->where('panier.id_utilisateur', $idUtilisateur)
				->orderBy('date_modif', 'desc');
			
		$bornes = $builder->get()->getResult('App\Entities\BornePerso');
		return $bornes ?: [];
	}

	/**
	 * Insertion dans la table Panier.
	 *
	 * @param int $idUtilisateur
	 * @param int $idBorne
	 * @return bool
	 */
	public function insererPanier(int $idUtilisateur, int $idBorne): bool
	{
//		$db = Database::connect();
		$builder = $this->db->table('panier');

		$data = [
			'id_utilisateur'  => $idUtilisateur,
			'id_borneperso' => $idBorne,
		];

		return $builder->insert($data);
	}

	/**
	 * Suppression d'une borne dans le panier de l'utilisateur.
	 *
	 * @param int $idUtilisateur
	 * @param int $idBorne
	 * @return bool
	 */
	public function suppressionBorne(int $idUtilisateur, int $idBorne): bool
	{
//		$db = Database::connect();
		$builder = $this->db->table('panier');
		
		return $builder->where('id_utilisateur', $idUtilisateur)
				->where('id_borneperso', $idBorne)
				->delete();
	}

	/**
	 * Récupère un tableau de Faq d'un utilisateur admin
	 * @param int $idUtilisateur
	 * @return array<Faq>
	 */
	public function getFaqs(int $idUtilisateur): array
	{
		$faqModele = new FaqModel();
		$builder = $faqModele->builder()->where('faq.id_utilisateur', $idUtilisateur);
		
		$faqs = $builder->get()->getResult('App\Entities\Faq');
		return $faqs ?: [];
	}

	/**
	 * Récupère un tableau de Commande de l'utilisateur.
	 *
	 * @param int $idUtilisateur
	 * @return array<Commande>
	 */
	public function getCommandes(int $idUtilisateur): array
	{
		$commandeModel = new CommandeModel();
		$builder = $commandeModel->builder()->where('commande.id_utilisateur', $idUtilisateur);
		
		$commandes = $builder->get()->getResult('App\Entities\Commande');
		return $commandes ?: [];
	}
}
