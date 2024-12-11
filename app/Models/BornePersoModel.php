<?php
namespace App\Models;

use App\Entities\Bouton;
use App\Entities\Joystick;
use App\Entities\Option;
use App\Entities\Borne;
use CodeIgniter\Model;
use App\Entities\Matiere;
use App\Entities\TMolding;
use Config\Database;

class BornePersoModel extends Model
{
	/**
	 * @property int $MAX_JOYSTICK Le nombre maximum de boutons sur borne personnalisée.
	 * Utilisé pour la clause SQL LIMIT
	 */
	private static int $MAX_BOUTON = 12;
	
	/**
	 * @property int $MAX_JOYSTICK Le nombre maximum de joysticks sur borne personnalisée.
	 * Utilisé pour la clause SQL LIMIT
	 */
	private static int $MAX_JOYSTICK = 2;


	protected $table      = 'borneperso';
	protected $primaryKey = 'id_borneperso';
	protected $returnType = 'App\Entities\BornePerso';

	protected $allowedFields = [
        'id_borne',
        'ordre',
        'prix',
        'id_tmolding',
        'id_matiere',
		'date_creation',
		'date_modif',
    ];
	
	// Règles de validation
	protected $validationRules = [
		'id_tmolding' => 'required',
		'id_matiere'  => 'required',
	];

	protected $validationMessages = [
		'id_tmolding' => [ 'required' => 'Champ requis.'],
		'id_matiere'  => [ 'required' => 'Champ requis.'],
	];
	

	/**
	 * Récupère la Matière de borne personnalisée.
	 * @param int $idMatiere
	 * @return Matiere
	 */
	public function getMatiere(int $idMatiere): Matiere
	{
		$matiereModele = new MatiereModel();
		return $matiereModele->find($idMatiere);
	}

	/**
	 * Récupère la borne originale de la borne personnalisée.
	 * @param int $idTheme
	 * @return Borne|null
	 */
	public function getBorne(int $idBorne): ?Borne
	{
		$borneModel = new BorneModel();
		return $borneModel->find($idBorne);
	}

	/**
	 * Récupère le TMolding de borne personnalisée.
	 * @param int $idTMolding
	 * @return TMolding
	 */
	public function getTMolding(int $idTMolding): TMolding
	{
		$tmoldingModele = new TMoldingModel();
		return $tmoldingModele->find($idTMolding);
	}

	/**
	 * Récupère un tableau de Joystick de borne personnalisée.
	 * @param int $idBorne
	 * @return array<Joystick>
	 */
	public function getJoysticks(int $idBorne): array
	{
		$builder = $this->db->table('joystick');
		$builder->select('joystick.*')
				->join('joystickborneperso', 'joystick.id_joystick = joystickborneperso.id_joystick')
				->where('joystickborneperso.id_borneperso', $idBorne);
			
		return $builder->get(BornePersoModel::$MAX_JOYSTICK)->getResult('App\Entities\Joystick');
	}

	/**
	 * Insertion d'un Joystick de la borne personnalisée.
	 * @param int $idBorne
	 * @param int $idJoystick
	 * @return bool
	 */
	public function insererJoystickBorne(int $idBorne, int $idJoystick, int $ordre): bool
	{
		$db = Database::connect();
		$builder = $db->table('joystickborneperso');

		$data = [
			'id_borneperso'    => $idBorne,
			'id_joystick' => $idJoystick,
			'ordre' => $ordre,
		];

		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau de Bouton de borne personnalisée.
	 * @param int $idBorne
	 * @return array<Bouton>
	 */
	public function getBoutons(int $idBorne): array
	{
		$builder = $this->db->table('bouton');
		$builder->select('bouton.*')
				->join('boutonborneperso', 'bouton.id_bouton = boutonborneperso.id_bouton')
				->where('boutonborneperso.id_borneperso', $idBorne);
			
		return $builder->get(BornePersoModel::$MAX_BOUTON)->getResult('App\Entities\Bouton');
	}

	/**
	 * Insertion d'un Bouton de la borne personnalisée.
	 * @param int $idBorne
	 * @param int $idBouton
	 * @return bool
	 */
	public function insererBoutonBorne(int $idBorne, int $idBouton, int $ordre): bool
	{
		$db = Database::connect();
		$builder = $db->table('boutonborneperso');

		$data = [
			'id_borneperso' => $idBorne,
			'id_bouton'     => $idBouton,
			'ordre'         => $ordre,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau d'Option de borne personnalisée.
	 * @param int $idBorne
	 * @return array<Option>
	 */
	public function getOptions(int $idBorne): array
	{
		$builder = $this->db->table('option');
		$builder->select('option.*')
				->join('optionborneperso', cond: 'option.id_option = optionborneperso.id_option')
				->where('optionborneperso.id_borneperso', $idBorne);
			
		$options = $builder->get()->getResult('App\Entities\Option');
		return $options ?: [];
	}

	/**
	 * Insertion d'une Option de borne personnalisée.
	 * @param int $idBorne
	 * @param int $idOption
	 * @return bool
	 */
	public function insererOptionBorne(int $idBorne, int $idOption): bool
	{
		$db = Database::connect();
		$builder = $db->table('optionborneperso');

		$data = [
			'id_borneperso'  => $idBorne,
			'id_option' => $idOption,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Suppression d'une BornePerso un mois après sa dernière modification.
	 * @return bool
	 */
	public function suppPeriodique(): bool
    {
        $db = Database::connect();
        $builder = $db->table('borneperso');

        $moisDernier = date('d-m-Y H:i:s', strtotime('-1 month'));

        $builder->where('date_modif <', $moisDernier);
        return $builder->delete();
    }

	/**
	 * Suppression d'une borne et de ses composants
	 * (Panier, Option, Joystick, Bouton, Image et Commande)
	 *
	 * @param int $idBorne identifiant de la borne personnalisée
	 * @return void
	 */
	public function deleteCascade(int $idBorne): void
	{
		$db = Database::connect();

		// Chargement des modèles
		$panierModel        = $db->table('panier');
		$optionBorneModel   = $db->table('optionborneperso');
		$joystickBorneModel = $db->table('joystickborneperso');
		$boutonBorneModel   = $db->table('boutonborneperso');

		$joystickModel = new JoystickModel();
		$boutonModel   = new BoutonModel();
		$borneModel    = new BorneModel();

		// Suppression de la borne personnalisée du panier
		$panierModel->where('id_borneperso', $idBorne)->delete();

		// Suppression des options associées
		$optionBorneModel->where('id_borneperso', $idBorne)->delete();

		// Suppression des relations Joysticks-Borne et gestion des joysticks orphelins
		$joysticks = $this->getJoysticks($idBorne);
		foreach ($joysticks as $joystick) {
			$idJoystick = $joystick->id;
			$joystickBorneModel->where('id_borneperso', $idBorne)
								->where('id_joystick', $idJoystick)
								->delete();

			// Vérifier si le joystick est utilisé ailleurs
			if ($joystickBorneModel->where('id_joystick', $idJoystick)->countAllResults() == 0) {
				$joystickModel->delete($idJoystick);
			}
		}

		// Suppression des relations Boutons-Borne et gestion des boutons orphelins
		$boutons = $this->getBoutons($idBorne);
		foreach ($boutons as $bouton) {
			$idBouton = $bouton->id;
			$boutonBorneModel->where('id_borneperso', $idBorne)
								->where('id_bouton', $idBouton)
								->delete();

			// Vérifier si le bouton est utilisé ailleurs
			if ($boutonBorneModel->where('id_bouton', $idBouton)->countAllResults() == 0) {
				$boutonModel->delete($idBouton);
			}
		}

		$borneModel->delete($idBorne);
	}
	
}
