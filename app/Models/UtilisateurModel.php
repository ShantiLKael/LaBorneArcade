<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class UtilisateurModel extends Model
{
	/**
	 * @property string $ROLE_SUPER_ADMIN Role super admnistrateur.
	 */
	static string $ROLE_SUPER_ADMIN = 'super_admin';

	/**
	 * @property int $ROLE_ADMIN Role adminiqtrateur.
	 */
	static string $ROLE_ADMIN = 'admin';

	/**
	 * @property int $ROLE_UTILISATEUR Role utilisateur.
	 */
	static string $ROLE_UTILISATEUR = 'utilisateur';

	protected $table      = 'utilisateur';
	protected $autoIncrement = true;
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
	 * @return array<\App\Entities\Borne>
	 */
	public function getPanier(int $idUtilisateur): array
	{
		$builder = $this->builder();
		$builder->select('borne.*')->distinct()->from('panier')
				->join('borne', 'borne.id_borne = panier.id_borne')
				->where('panier.id_utilisateur', $idUtilisateur);
			
		$bornes = $builder->get()->getResult('App\Entities\Borne');
		return $bornes ? $bornes : [];
	}

	/**
	 * Insertion dans la table Panier
	 * @param int $idUtilisateur
	 * @param int $idBorne
	 * @return bool
	 */
	public function insererPanier(int $idUtilisateur, int $idBorne): bool
	{
		$db = \Config\Database::connect();
		$builder = $db->table('panier');

		$data = [
			'id_utilisateur'  => $idUtilisateur,
			'id_borne' => $idBorne,
		];

		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau de Faq d'un utilisateur admin
	 * @param int $idUtilisateur
	 * @return array<\App\Entities\Faq>
	 */
	public function getFaqs(int $idUtilisateur): array
	{
		$faqModele = new FaqModel();
		$faqModele->where('faq.id_utilisateur', $idUtilisateur);

		$faqs = $faqModele->get()->getResult('App\Entities\Faq');
		return $faqs ? $faqs : [];
	}

	/**
	 * Récupère un tableau de Commande de l'utilisateur
	 * @param int $idUtilisateur
	 * @return array<\App\Entities\Commande>
	 */
	public function getCommandes(int $idUtilisateur): array
	{
		$commandeModel = new CommandeModel();
		$commandeModel->where('commande.id_utilisateur', $idUtilisateur);
		
		$commandes = $commandeModel->get()->getResult('App\Entities\Commande');
		return $commandes ? $commandes : [];
	}
}