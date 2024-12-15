<?php
namespace App\Models;

use App\Entities\Bouton;
use App\Entities\Image;
use App\Entities\Joystick;
use App\Entities\Option;
use App\Entities\Theme;
use App\ThirdParty\CronJob;
use CodeIgniter\Database\Query;
use CodeIgniter\Entity\Cast\IntegerCast;
use CodeIgniter\Model;
use App\Entities\Matiere;
use App\Entities\TMolding;
use App\Entities\Borne;
use CodeIgniter\Pager\Pager;
use Config\Database;

class BorneModel extends Model
{
	/**
	 * @property int $MAX_JOYSTICK Le nombre maximum de boutons sur la borne.
	 * Utilisé pour la clause SQL LIMIT
	 */
	private static int $MAX_BOUTON = 12;
	
	/**
	 * @property int $MAX_JOYSTICK Le nombre maximum de joysticks sur la borne.
	 * Utilisé pour la clause SQL LIMIT
	 */
	private static int $MAX_JOYSTICK = 2;


	protected $table      = 'borne';
	protected $primaryKey = 'id_borne';
	protected $returnType = 'App\Entities\Borne';

	protected $allowedFields = [
        'nom',
        'description',
        'prix',
        'id_tmolding',
        'id_matiere',
		'id_image',
        'id_theme',
    ];
	
	// Règles de validation
	protected $validationRules = [
        'nom'         => 'required|max_length[50]|min_length[5]|regex_match[/^[^<>;{}]*$/]',
        'description' => 'required|max_length[500]',
        'prix'        => 'required|greater_than[0]',
		'id_tmolding' => 'required',
		'id_matiere'  => 'required',
		'id_theme'    => 'required',
	];

	protected $validationMessages = [
		'nom' => [
            'required'    => 'nom requis.',
			'max_length'  => 'Le nom de la borne est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom de la borne est trop court (min. 5 caractères).',
			'regex_match' => 'nom Les caractères < > ; { } sont interdits.',
		],

		'description' => [
			'required'    => 'description requis.',
			'max_length'  => 'La description est trop longue (max. 500 caractères).',
		],

		'prix' => [
			'required'     => 'prix requis.',
			'greater_than' => 'Le prix doit être supérieur à zéro.',
		],

		'id_tmolding' => [ 'required' => 'id_tmolding requis.'],
		'id_matiere'  => [ 'required' => 'id_matiere requis.'],
		'id_theme'    => [ 'required' => 'id_theme requis.'],
	];
	
	/**
	 * Recupération de toutes les bornes selon des critères.
	 *
	 * @param int $max_par_page
	 * @param array $parametres
	 * @return Borne[] tableau de bornes
	 */
	public function getBornes(int $max_par_page, array $parametres): array {
		extract($parametres);
		$sql = "SELECT b.*, (SELECT i.id_image FROM imageborne i WHERE i.id_borne = b.id_borne LIMIT 1) AS image\n";
		$sql .= "FROM Borne b\n";
		$sql .= "WHERE b.nom ILIKE '%$recherche%' ESCAPE '!'";
		$type = match($type) {
			"sticker"=>1,
			"wood"=>2,
			"gravure"=>3,
			default=>null,
		};
		if (count($themes) || count($matieres) || $type || $prix_min || $prix_max) {
			$sql .= " AND (";
			$close = "";
			if ($prix_min > $prix_max)
				$prix_max = null;
			if ($prix_min && $prix_max) {
				$sql .= "b.prix BETWEEN $prix_min AND $prix_max";
			} else {
				if ($prix_min) {
					$sql .= "b.prix >= $prix_min";
				}
				if ($prix_max) {
					$sql .= "b.prix <= $prix_max";
				}
			}
			if ((count($themes) || count($matieres) || $type) && ($prix_min || $prix_max))
				$sql .= " AND (";
			if (count($themes))
				$close .= "b.id_theme IN (".implode(",", $themes).") OR ";
			if (count($matieres)) {
				$close .= "b.id_matiere IN (".implode(",", $matieres).") OR ";
			}
			if ($type) {
				$close .= "$type IN (SELECT ob.id_option FROM OptionBorne ob WHERE ob.id_borne = b.id_borne) OR ";
			}
			if (count($themes) || count($matieres) || $type)
				$close .= "FALSE";
			if ($prix_min || $prix_max)
				$close .= ")";
			$sql .= $close;
			$sql .= ")\n";
		}
		$sql .= " GROUP BY id_borne, nom, description, prix, id_tmolding, id_matiere, id_theme";
		/*  Pager  */
		/** @var Pager $pager */
		$pager = service('pager');
		$offset      = ($pager->getCurrentPage() - 1) * $max_par_page;
		/*  Pager fin  */
		$sql .= " LIMIT $max_par_page OFFSET $offset";
		return $this->db->prepare(fn($db) => (new Query($db))->setQuery($sql))->execute()->getCustomResultObject($this->returnType);
	}
	
	public function getBorneParId(int $id): Borne|array|null {
		return $this->find($id);
	}
	
	public function getNombreBornes(): int {
		$sql = $this->builder()->from("Borne", true)->selectCount("*", "count")->getCompiledSelect();
		$sql = str_replace('"', "", $sql);
		/** @var IntegerCast[] $result */
		$result = $this->db->prepare(fn($db) => (new Query($db))->setQuery($sql))->execute()->getResult(IntegerCast::class);
		return intval($result[0]->{'count'}) ?: 0;
	}

	/**
	 * Récupère la Matière de la borne.
	 * @param int $idMatiere
	 * @return Matiere|array
	 */
	public function getMatiere(int $idMatiere): Matiere|array
	{
		$matiereModele = new MatiereModel();
		return $matiereModele->find($idMatiere);
	}

	/**
	 * Récupère le thème de la borne.
	 * @param int $idTheme
	 * @return Theme|array
	 */
	public function getTheme(int $idTheme): Theme|array
	{
		$themeModel = new ThemeModel();
		return $themeModel->find($idTheme);
	}

	/**
	 * Récupère le TMolding de la borne.
	 * @param int $idTMolding
	 * @return TMolding|array
	 */
	public function getTMolding(int $idTMolding): TMolding|array
	{
		$tmoldingModele = new TMoldingModel();
		return $tmoldingModele->find($idTMolding);
	}

	/**
	 * Récupère un tableau de Joystick de la borne.
	 * @param int $idBorne
	 * @return array<Joystick>
	 */
	public function getJoysticks(int $idBorne): array
	{
		$builder = $this->db->table('joystick');
		$builder->select('joystick.*')
				->join('joystickborne', 'joystick.id_joystick = joystickborne.id_joystick')
				->where('joystickborne.id_borne', $idBorne);
		
		$joysticks = $builder->get(BorneModel::$MAX_JOYSTICK)->getResult('App\Entities\Joystick');
		return $joysticks ?: [];
	}
	
	/**
	 * Insertion d'un Joystick de la borne.
	 *
	 * @param int $idBorne
	 * @param int $idJoystick
	 * @param int $ordre
	 * @return bool
	 */
	public function insererJoystickBorne(int $idBorne, int $idJoystick, int $ordre): bool
	{
		$db = Database::connect();
		$builder = $db->table('joystickborne');

		$data = [
			'id_borne'    => $idBorne,
			'id_joystick' => $idJoystick,
			'ordre' => $ordre,
		];

		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau de Bouton de la borne.
	 * @param int $idBorne
	 * @return array<Bouton>
	 */
	public function getBoutons(int $idBorne): array
	{
		$builder = $this->db->table('bouton');
		$builder->select('bouton.*')
        	->join('boutonborne', 'bouton.id_bouton = boutonborne.id_bouton')
        	->where('boutonborne.id_borne', $idBorne);
		
		$boutons = $builder->get(BorneModel::$MAX_BOUTON)->getResult('App\Entities\Bouton');
		return $boutons ?: [];
	}
	
	/**
	 * Insertion d'un Bouton de la borne.
	 *
	 * @param int $idBorne
	 * @param int $idBouton
	 * @param int $ordre
	 * @return bool
	 */
	public function insererBoutonBorne(int $idBorne, int $idBouton, int $ordre): bool
	{
		$db = Database::connect();
		$builder = $db->table('boutonborne');

		$data = [
			'id_borne'  => $idBorne,
			'id_bouton' => $idBouton,
			'ordre'     => $ordre,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau d'Image de la borne.
	 * @param int $idBorne
	 * @return Image[]
	 */
	public function getImages(int $idBorne): array
	{
		$builder = $this->db->table('image');
		$builder->select('image.*')
				->join('imageborne', 'image.id_image = imageborne.id_image')
				->where('imageborne.id_borne', $idBorne);
			
		$images = $builder->get()->getResult('App\Entities\Image');
		return $images ?: [];
	}

	/**
	 * Insertion d'une Image de la borne
	 * @param int $idBorne
	 * @param int $idImage
	 * @return bool
	 */
	public function insererImageBorne(int $idBorne, int $idImage): bool
	{
		$db = Database::connect();
		$builder = $db->table('imageborne');

		$data = [
			'id_borne' => $idBorne,
			'id_image' => $idImage,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau d'Option de la borne.
	 * @param int $idBorne
	 * @return array<Option>
	 */
	public function getOptions(int $idBorne): array
	{
		$builder = $this->db->table('option');
		$builder->select('option.*')
				->join('optionborne', 'option.id_option = optionborne.id_option')
				->where('optionborne.id_borne', $idBorne);
			
		$options = $builder->get()->getResult('App\Entities\Option');
		return $options ?: [];
	}
	
	/**
	 * Suppression d'une BornePerso un mois après sa dernière modification.
	 *
	 * @return bool
	 */
	#[CronJob(BorneModel::class, "suppPeriodiqueBornePerso")]
	public function suppPeriodiqueBornePerso(): bool
	{
		$db = Database::connect();
		$builder = $db->table('borneperso');
		
		$moisDernier = date('d-m-Y H:i:s', strtotime('-1 month'));
		
		$builder->where('date_modif <', $moisDernier);
		return $builder->delete();
	}

	/**
	 * Insertion d'une option de la borne.
	 *
	 * @param int $idBorne L'identifiant de la borne.
	 * @param int $idOption L'identifiant de l'option.
	 * @return bool <b>Vrai</b> si l'insertion a réussi, sinon <b>faux</b>.
	 */
	public function insererOptionBorne(int $idBorne, int $idOption): bool
	{
		$db = Database::connect();
		$builder = $db->table('optionborne');
		
		$data = [
			'id_borne'  => $idBorne,
			'id_option' => $idOption,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Suppression d'une borne et de ses composants.
	 * (Panier, Option, Joystick, Bouton, Image et Commande)
	 *
	 * @param int $idBorne L'identifiant de la borne.
	 * @return void
	 */
	public function deleteCascade(int $idBorne): void
	{
		$db = Database::connect();

		// Chargement des modèles
		$panierModel        = $db->table('panier');
		$optionBorneModel   = $db->table('optionborne');
		$joystickBorneModel = $db->table('joystickborne');
		$boutonBorneModel   = $db->table('boutonborne');
		$imageBorneModel    = $db->table('imageborne');

		$joystickModel = new JoystickModel();
		$boutonModel   = new BoutonModel();
		$borneModel    = new BorneModel();

		// Suppression de la borne des images
		$imageBorneModel->where('id_borne', $idBorne)->delete();

		// Suppression de la borne du panier
		$panierModel->where('id_borne', $idBorne)->delete();

		// Suppression des options associées
		$optionBorneModel->where('id_borne', $idBorne)->delete();

		// Suppression des relations Joysticks-Borne et gestion des joysticks orphelins
		$joysticks = $this->getJoysticks($idBorne);
		foreach ($joysticks as $joystick) {
			$idJoystick = $joystick->id;
			$joystickBorneModel->where('id_borne', $idBorne)
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
			$boutonBorneModel->where('id_borne', $idBorne)
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
